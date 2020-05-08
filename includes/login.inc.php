
<?php

if (isset($_POST['login-submit'])) {
    include_once 'db.inc.php'; //ou on a la db pour utiliser $conn

    $emailOrUid = $_POST["emailOrUid"];
    $pwd = $_POST["pwd"];

    if (empty($pwd) || empty($emailOrUid)) {
        header("location: ../index.php?error=emptyFields&emailOrUid=" . $emailOrUid);
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE uid=? OR emailUsers=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../index.php?error=sqlError");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $emailOrUid, $emailOrUid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $passwordCheck = password_verify($pwd, $row["pwdUsers"]);
                if ($passwordCheck == false) {
                    header("location: ../index.php?error=wrongPassword&emailOrUid=" . $emailOrUid);
                    exit();
                } else if ($passwordCheck == true) {
                    session_start(); // you have to star a session in all pages in order to use those global variables i will add session_start() in the header page
                    $_SESSION["uid"] = $row["uid"];
                    $_SESSION["id"] = $row["id"];
                    header("location: ../order.php?login=success");
                    exit();
                } else {
                    header("location: ../index.php?error=wrongPassword&emailOrUid=" . $emailOrUid);
                    exit();
                }
            } else {
                header("location: ../index.php?error=noUser");
                exit();
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header("location: ../index.php");
    exit();
}

?>