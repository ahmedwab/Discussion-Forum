<?php
session_start();
error_reporting(0);
$servername = "localhost";
$username = "id14970710_admin";
$password = "M3e>ah-cdPUz?ByK";
$databaseName = "id14970710_discussionforum";

$conn = new mysqli($servername,$username,$password,$databaseName);

if ($_SESSION["user"] == NULL)
{
   header('Location: index.php');
}
$accountusername = $_SESSION["user"];

$postusername=$accountusername;
$posttext=$_POST['textbox'];
$postimage=$_POST['input-image'];
$topicid=$_GET['topicid'];
$topicname=$_GET['topicname'];

if($posttext!=''){
$sql = "INSERT INTO TOPIC (username, textbox,topicimage,tid,ttitle)
VALUES ( '$postusername', '$posttext','$postimage','$topicid','$topicname')";


if ($conn->query($sql) === TRUE) {
  echo "";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

}

header('Location: topic.php?topicid=' .$topicid .'&topicname=' . $topicname);
$conn->close();
?>
