<?php
session_start();
error_reporting(0);
$servername = "mysql.discussionthreads.online";
$username = "ahmedwab";
$password = "discussion1407";
$databaseName = "discussionthreads_discussion";

$conn = new mysqli($servername,$username,$password,$databaseName);

if ($_SESSION["user"] == NULL)
{
   header('Location: login.php');
}
$user= $_SESSION["user"];
$friend= $_SESSION["friend"];

$stmnt = "INSERT INTO NOTIFICATIONS (username, text,otheruser)
VALUES ('$user', 'Added you as a friend!','$friend')";
if ($conn->query($stmnt) === TRUE) {
  echo "";
}

$sql = "INSERT INTO FRIENDS (username1, username2)
VALUES ('$user', '$friend')";

if ($conn->query($sql) === TRUE) {
    header('Location: profile.php?user='.$friend);
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

      
$_SESSION["friend"]=null;

?>


