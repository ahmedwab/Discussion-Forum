<?php
session_start();
error_reporting(0);
$servername = "mysql.discussionthreads.online";
$username = "ahmedwab";
$password = "251056Cc";
$databaseName = "discussionthreads_discussion";

$conn = new mysqli($servername,$username,$password,$databaseName);

if ($_SESSION["user"] == NULL)
{
   header('Location: login.php');
}
$user= $_SESSION["user"];
$friend= $_SESSION["friend"];

$sql = "INSERT INTO FRIENDS (username1, username2)
VALUES ('$user', '$friend')";

if ($conn->query($sql) === TRUE) {
    header('Location: profile.php?user='.$friend);
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

      
$_SESSION["friend"]=null;

?>


