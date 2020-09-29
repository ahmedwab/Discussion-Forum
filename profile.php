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
$userprofile=$_SESSION["user"]; //user logged in

$profileuser=$_GET['user'];
echo" <div id='topnav'>
        <a href='main.php'>Discussion Forum</a>
        <div id='topnav-right'>
        <a href='profile.php?user=$userprofile'><img src='images/profile-icon.png' alt='My profile'</a>
          <a href='destroy.php'>Sign Out</a>
        </div>
      </div>
      <br>";

echo "<script type='text/javascript'>" . "document.title = '$profileuser';" . "</script>";

$sql = "SELECT image FROM DEFAULT_IMAGES   WHERE image_id=  '1'  ";
$result = $conn->query($sql);


$defaultimage=NULL;
while($row = $result->fetch_assoc()) {
  $defaultimage=$row['image'];
}


$sql = "SELECT image,firstname,lastname,username,email FROM ACCOUNTS   WHERE username=  '$profileuser'  LIMIT 1";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
  $userimage=$row['image'];
  if($row['image']==NULL){
    $userimage=$defaultimage;
  }
  echo '<div id="image-section">
  <img src="data:image/jpeg;base64,'.base64_encode($userimage ).'" height="200" width="200" class="img-thumbnail" />';
  echo "<h2> " . $row['firstname'] ." ". $row['lastname'] ."</h2>";
  echo "</div><br>";



}

$sql = "SELECT * FROM TOPIC WHERE username= '$profileuser'  ORDER BY DATE DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  echo "<div id='message-board'>";

  $accountusername = $_SESSION["user"];

  while($row = $result->fetch_assoc()) {
    echo "<div class='message'>";
    $topicid=$row["tid"];
    $topicname=$row["ttitle"];
    $postuser=$row['username'];
    echo  "<h6 class='message-user'>"  ."<a href='profile.php?user=$postuser'>" . $row['username']. "</a>" . " wrote on "."<a href='topic.php?topicid=$topicid&topicname=$topicname'>" .$topicname .  "</a></h6>";
    echo  "<h6 class='message-date' >" .  $row['date'] . "</h6><br>";
    echo  "<h6 class='message-text' >" .  $row['textbox'] . "</h6>";


  echo "</div>";

  }
  echo "</div>";
} else {
  echo $profileuser . " has no posts";


}


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Profile</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="stylesheets/profilestyle.css">
</head>
<body>

</body>
</html>
