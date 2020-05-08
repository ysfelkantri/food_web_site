<?php
session_start();
$email =  $_SESSION["email"];
$pwd = $_POST["pwd"];
$pwd2 = $_POST["pwd2"];

if (!isset($_POST["submit"])) {
    header("location: ../index.php");
    exit();
} else if (empty($_POST["pwd"]) || empty($_POST["pwd2"])) {
    header("location: ../resetPasswordMakeNewOne.php?error=emptyFields");
    exit();
} else if (strlen((string) $pwd) < 8) {
    header("location: ../resetPasswordMakeNewOne.php?error=ShortPassword");
    exit();
} else if ($pwd !== $pwd2) {
    header("location: ../resetPasswordMakeNewOne.php?error=passwordsDon_tMatch");
    exit();
} else {
    include "db.inc.php";
    $sql = "UPDATE users SET pwdUsers=? WHERE emailUsers=?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../resetPasswordMakeNewOne.php?error=sqlError");
        exit();
    } else {
        $hashedPassword = password_hash($pwd, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ss", $hashedPassword, $email);
        mysqli_stmt_execute($stmt);
        session_start();
        session_unset();
        session_destroy();
        header("location: ../index.php");
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);


    // in the final you hace to close session


}
