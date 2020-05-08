<?php

if (isset($_POST['signUp-submit'])) {
    include_once 'db.inc.php'; //ou on a la db pour utiliser $conn

    // $firstname = mysqli_real_escape_string($conn, $_POST['first']); // to protect from sql injection attack
    $firstname = $_POST['firstName'];
    $lastname = $_POST['lastName'];
    $email = $_POST['email'];
    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];
    $pwdReapeat = $_POST['pwd2'];

    if (empty($firstname) || empty($lastname) || empty($email) || empty($uid) || empty($pwd)) {
        header("Location: ../signUp.php?error=emptyFields&firstName=" . $firstname . "&lastName=" . $lastname . "&uid=" . $uid . "&email=" . $email);
        exit(); // to exit
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && (!preg_match("/^[a-zA-Z0-9]*$/", $uid))) {
        header("Location: ../signUp.php?error=InvalideEmailUid&firstName=" . $firstname . "&lastName=" . $lastname);
        exit(); // to exit
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signUp.php?error=InvalideEmail&firstName=" . $firstname . "&lastName=" . $lastname . "&uid=" . $uid);
        exit(); // to exit
    } else if (!preg_match("/^[a-zA-Z0-9]*$/", $uid)) {
        header("Location: ../signUp.php?error=InvalideUid&firstName=" . $firstname . "&lastName=" . $lastname . "&email=" . $email);
        exit(); // to exit
    } else if (strlen((string) $pwd) < 8) {
        header("Location: ../signUp.php?error=ShortPassword");
        exit(); // to exit
    } else if ($pwd !== $pwdReapeat) {
        header("Location: ../signUp.php?error=passwordcheck&firstName=" . $firstname . "&lastName=" . $lastname . "&email=" . $email . "&uid=" . $uid);
        exit(); // to exit
    } else {
        $sql = "SELECT * FROM users WHERE uid=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../signUp.php?error=sqlError");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $uid);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt); // hadi ma3arefch bdabete chno kader
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                header("location: ../signUp.php?userTaken&firstName=" . $firstname . "&lastName=" . $lastname . "&email=" . $email);
                exit();
            } else {
                // hna ghadi nbda nbadal
                $sql = "SELECT * FROM users WHERE emailUsers=?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("location: ../signUp.php?error=sqlError");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $email);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt); // hadi ma3arefch bdabete chno kader
                    $resultCheck = mysqli_stmt_num_rows($stmt);
                    if ($resultCheck > 0) {
                        header("location: ../signUp.php?error=EmailAlreadyExists&firstName=" . $firstname . "&lastName=" . $lastname . "&email=" . $email . "&uid=" . $uid);
                        exit();
                    } else {
                        $sql = "INSERT INTO users (firstNames,lastNames,uid,emailUsers,pwdUsers) VALUES(?,?,?,?,?);";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            header("location: ../signUp.php?error=sqlError");
                            exit();
                        } else {
                            $hashedPassword = password_hash($pwd, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt, "sssss", $firstname, $lastname, $uid, $email, $hashedPassword);
                            mysqli_stmt_execute($stmt);
                            header("location: ../index.php?signUp=success");
                            exit();
                        }
                    }
                }

                // hna sala tbdal
                // nda5lo les information dyal utilisateur f data base

            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header("location: ../signUp.php");
    exit();
}
