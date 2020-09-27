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

echo" <div id='topnav'>
        <a href='main.php'>Discussion Forum</a>
        <div id='topnav-right'>
          <a href='destroy.php'>Sign Out</a>
        </div>
      </div>";


$accountusername= $accountpassword = '';

$accountusername = $_SESSION["user"];


$postusername=$accountusername;
$posttext=$_POST['textbox'];
$topicid=$_GET['topicid'];

if($posttext!=''){
$sql = "INSERT INTO TOPIC (username, textbox,tid)
VALUES ( '$postusername', '$posttext','$topicid')";


if ($conn->query($sql) === TRUE) {
  echo "";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

}



$sql = "SELECT * FROM TOPIC   WHERE tid=  '$topicid' ORDER BY DATE DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  echo "<div id='message-board'>";

  while($row = $result->fetch_assoc()) {
    echo "<div class='message'>";
    $postuser=$row['username'];
    echo  "<a href='profile.php?user=$postuser'><h6 class='message-user'>" . $row['username'] . "  </a>said</h6>";
    echo  "<h6 class='message-date' >" .  $row['date'] . "</h6><br>";
    echo  "<h6 class='message-text' >" .  $row['textbox'] . "</h6>";


  echo "</div>";

  }
  echo "</div>";
} else {
  echo "Be the first to write in this forum";


}
echo"<div id='message-post'>
      <form id='message-post' name='text-form' action='topic.php?topicid=$topicid' method='post'>
        <input id='input-item' type='text' id='textbox' name='textbox' value=''>
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
<link rel="stylesheet" href="topic-style.css">
</head>
<body>





</body>
</html>
