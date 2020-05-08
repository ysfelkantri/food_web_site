<?php


require "../header.php";

include_once 'db.inc.php';

if (!isset($_POST["reset-request-submit"])) {
    header("location: ../index.php");
    exit();
} else {
    $email = $_POST["email"];
    if (empty($email)) {
        header("location: ../reset-passwor.php?error=emptyFields");
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("location: ../reset-passwor.php?error=InvalideEmail");
        exit();
    } else {
        $code = random_bytes(8); // daba rah bl binaire
        // sending msg
        $sql = 'SELECT * FROM users WHERE emailUsers=?;';
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../reset-passwor.php?error=sqlError");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);

            mysqli_stmt_store_result($stmt); // yla mdertich hadi star liouraha ghadi nl9aw return dima 0 wa5a ykoun normalamet ktar mn 0

            $resultCheck = mysqli_stmt_num_rows($stmt);

            if ($resultCheck > 0) {
                $sql = 'DELETE FROM resetPasswd WHERE email=?;';

                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("location: ../reset-passwor.php?error=sqlErrorDelete");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $email);
                    mysqli_stmt_execute($stmt);
                    // insert in resetPasswd table
                    $expiration = date("U") + 1800;
                    $sql = "INSERT INTO resetPasswd (email,codeReset,expiration) VALUES(?,?,?);";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("location: ../reset-passwor.php?error=sqlError");
                        exit();
                    } else {
                        $hashedCode = password_hash($code, PASSWORD_DEFAULT);
                        mysqli_stmt_bind_param($stmt, "sss", $email, $hashedCode, $expiration);
                        mysqli_stmt_execute($stmt);
                        require '../email/PHPMailerAutoload.php';
                        try {
                            $mail = new PHPMailer(true);
                            // Enable verbose debug output
                            $code = bin2hex($code);
                            $mail->isSMTP();                                 // Set mailer to use SMTP
                            $mail->Host = "smtp.gmail.com";
                            $mail->SMTPDebug = 0;
                            // Specify main and backup SMTP servers
                            $mail->SMTPAuth = true;                               // Enable SMTP authentication
                            $mail->Username = 'lviragistlwinnery1998@gmail.com';                 // SMTP username
                            $mail->Password = 'rachidneymar832906041998';                           // SMTP password
                            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                            $mail->Port = 587;                                    // TCP port to connect to

                            $mail->setFrom('lviragistlwinnery1998@gmail.com', 'anas mansouri food project');
                            $mail->addAddress($email);     // Add a recipient

                            $mail->addReplyTo('lviragistlwinnery1998@gmail.com');
                            // print_r($_FILES['file']); exit;
                            $mail->isHTML(false);                                  // Set email format to HTML

                            $mail->Subject = "test ";
                            $mail->Body    = 'code : ' . $code;
                            $mail->AltBody = "msg from GSEII";
                            if ($mail->send()) {
                                //   echo "message envoyer";
                                // you have to star a session in all pages in order to use those global variables i will add session_start() in the header page
                                $_SESSION["email"] = $email;
                            } else {
                                echo "error" . $mail->ErrorInfo;
                            }
                        } catch (Exception $e) {
                            echo "ERROR";
                        } finally {
                            mysqli_stmt_close($stmt);
                            mysqli_close($conn);
                        }
                        echo "<script>window.location.assign('../verify-reset-password.php')</script>";
                    } // end of sending msg
                }
            }
        }
    }
}
