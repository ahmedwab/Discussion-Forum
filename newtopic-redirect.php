<?php
session_start();
error_reporting(0);
$servername = "localhost";
$username = "id14970710_admin";
$password = "M3e>ah-cdPUz?ByK";
$databaseName = "id14970710_discussionforum";

$conn = new mysqli($servername,$username,$password,$databaseName);

$topictitle=$_POST['topicname'];
 $postcolor=$_POST['category'];
$sql = "INSERT INTO TOPICLIST (topic_title,color)
VALUES ('$topictitle','$postcolor')";

if ($conn->query($sql) === TRUE) {
  echo "";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}


header('Location: main.php');

$conn->close();
?>