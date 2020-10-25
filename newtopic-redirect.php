<?php
session_start();
error_reporting(0);
$servername = "mysql.discussionthreads.online";
$username = "ahmedwab";
$password = "251056Cc";
$databaseName = "discussionthreads_discussion";

$conn = new mysqli($servername,$username,$password,$databaseName);

$topictitle=$_POST['topicname'];
 $postcolor=$_POST['category'];
$sql = "INSERT INTO TOPICLIST (topic_title,category)
VALUES ('$topictitle','$postcolor')";

if ($conn->query($sql) === TRUE) {
  echo "";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}


header('Location: main.php');

$conn->close();
?>
