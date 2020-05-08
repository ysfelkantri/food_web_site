<?php

session_start(); // you have to star a session in all pages in order to use those global variables i will add session_start() in the header page


$email =  $_SESSION["email"];
$code = $_POST["code"];


if (!isset($_POST["submit"])) {
    header("location: ../index.php");
    exit();
} else if (empty($_POST["code"])) {
    header("location: ../verify-reset-password.php?error=emptyFields");
    exit();
} else {
    include "db.inc.php";
    $sql = 'SELECT * FROM resetPasswd WHERE email=?;';
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../reset-passwor.php?error=sqlError");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $row = mysqli_fetch_assoc($result);
        $emailDB =  $row["email"];
        $codeDB =  $row["codeReset"];
        echo "code" . $code . "<br> codedb : " . $codeDB;

        $expiration = "expiration : " . $row["expiration"];

        $codeCheck = password_verify(hex2bin($code), $row["codeReset"]);
        echo "<br>codeCheck : " . $codeCheck;
        $dateNow = date("U");
        if ($codeCheck) {
            $sql = 'DELETE FROM resetPasswd WHERE email=?;';
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("location: ../reset-passwor.php?error=codeExpired");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
            }
            if ($expiration < $dateNow) {
                header("location: ../resetPassword.php");
                exit();
            } else {
                header("location: ../resetPasswordMakeNewOne.php");
                exit();
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
