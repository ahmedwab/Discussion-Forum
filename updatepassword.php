<?php
session_start();
error_reporting(0);
$servername = "mysql.discussionthreads.online";
$username = "ahmedwab";
$password = "251056Cc";
$databaseName = "discussionthreads_discussion";

$conn = new mysqli($servername,$username,$password,$databaseName);


$accountusername= $_POST['forgot-username'];
$accountpassword=$_POST['password'];
$sql="UPDATE ACCOUNTS SET password=MD5('$accountpassword') WHERE username='$accountusername'  ";

$_SESSION["user"] = $accountusername;
header('Location: main.php');
$conn->close();
?>