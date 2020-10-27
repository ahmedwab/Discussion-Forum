<?php
session_start();
error_reporting(0);
$servername = "mysql.discussionthreads.online";
$username = "ahmedwab";
$password = "251056Cc";
$databaseName = "discussionthreads_discussion";

$conn = new mysqli($servername,$username,$password,$databaseName);

$accountuser=$_GET["user"];

if ($_SESSION["user"] != $accountuser)
{
   header('Location: login.php');
}

echo" <div id='topnav'>
        <a href='main.php'>Discussion Forum</a>
        <div id='topnav-right'>
          <a href='updateprofile.php?user=$userprofile'><img src='images/profile-icon.png' alt='My profile'</a>
          <a href='destroy.php'>Sign Out</a>
        </div>
      </div><br>";





      $sql = "SELECT * FROM ACCOUNTS WHERE username='$accountuser' ";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          if(empty($row['image'])){
              echo "<img id='profileimage' src='images/default.png'/><br>";
          }
          else{
          echo '<img id="profileimage" src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'"/><br>';
        }
          echo "<h1 align='center'>" .$row['firstname'] .' ' . $row['lastname'].'</h1><br>';
        }
      } else {
        header('Location: main.php');
      }

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Forums</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="stylesheets/profile-styles.css">
</head>
<body>

</body>
