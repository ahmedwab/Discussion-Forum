<?php
include("config.php");
session_start();
error_reporting(0);


$conn = new mysqli($servername,$username,$password,$databaseName);

$username= $_POST['username'];
$password= $_POST['update-password'];

$sql = "UPDATE ACCOUNTS SET password=MD5('$password') WHERE username='$username'";

$_SESSION["user"] = $username;
header('Location: main.php');


$conn->close();
?>