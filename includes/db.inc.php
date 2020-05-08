<?php


$dbServerName = 'localhost';
$dbUserName = 'root';
$dbPassword = '';
$dbName = 'loginSystem';

$conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);

if (!$conn) {
    header("location: https://stackoverflow.com/");
    die("error connextion to data base" . mysqli_connect_error());
}
