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
$accountusername= $accountpassword = '';
$accountusername = $_SESSION["user"];


echo" <div id='topnav'>
        <a href='main.php'>Discussion Forum</a>
        <div id='topnav-right'>
        <a href='profile.php?user=$accountusername'><img src='images/profile-icon.png' alt='My profile'</a>
          <a href='destroy.php'>Sign Out</a>
        </div>
      </div>";





$postusername=$accountusername;
$posttext=$_POST['textbox'];
$postimage=$_POST['input-image'];
$topicid=$_GET['topicid'];
$topicname=$_GET['topicname'];






$sql = "SELECT * FROM TOPIC   WHERE tid=  '$topicid' ORDER BY DATE DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  echo "<div id='message-board'>";

  while($row = $result->fetch_assoc()) {
    echo "<div class='message'>";
    $postuser=$row['username'];
    $postimage=$row['topicimage'];
    echo  "<a href='profile.php?user=$postuser'><h6 class='message-user'>" . $row['username'] . "  </a>said</h6>";
    echo  "<h6 class='message-date' >" .  $row['date'] . "</h6><br>";
    if(!empty($postimage)){
    echo '<img src="data:image/jpeg;base64,'.base64_encode( $postimage).'"/>';
    }
    echo  "<h6 class='message-text' >" .  $row['textbox'] . "</h6>";


  echo "</div>";

  }
  echo "</div>";
} else {
  echo "Be the first to write in this forum";


}
echo"<div id='message-post'>
      <form id='message-post' name='text-form' action='posttopic-redirect.php?topicid=$topicid&topicname=$topicname' method='post'>
        <input id='input-item' type='text' id='textbox' name='textbox' value=''>
        <label for='img'>Upload photo (optional)</label><br><br>
        <input type='file' id='input-image' name='input-image' accept='image/*' value='Choose Image'>
        <input  type='submit' id='text-submit' name='text-submit' value='post'>
      </form>
    </div>";


$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title id="title">Discussion </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--  Include the CSS Bootstrap library from a CDN (MaxCDN) by inserting the following line
 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="stylesheets/topic-style.css">
</head>
<body>





</body>
</html>
