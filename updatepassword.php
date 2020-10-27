<?php
session_start();
error_reporting(0);
$servername = "mysql.discussionthreads.online";
$username = "ahmedwab";
$password = "251056Cc";
$databaseName = "discussionthreads_discussion";

$conn = new mysqli($servername,$username,$password,$databaseName);

$username= $_POST['username'];
$password= $_POST['update-password'];

$sql = "UPDATE ACCOUNTS SET password=MD5('$password') WHERE username='$username'";

$_SESSION["user"] = $username;
header('Location: main.php');


$conn->close();
?>