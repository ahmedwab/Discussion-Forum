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
$userprofile=$_GET["user"];
echo "<script> document.title='$userprofile'</script>";


echo" <div id='topnav'>
        <a href='main.php'>Discussion Forum</a>
        <div id='topnav-right'>
          <a href='updateprofile.php?user=$userprofile'><img src='images/profile-icon.png' alt='My profile'</a>
          <a href='destroy.php'>Sign Out</a>
        </div>
      </div><br>";





      $sql = "SELECT * FROM ACCOUNTS WHERE username='$userprofile' ";
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
        echo "0 results";
      }

      $sql = "SELECT * FROM FRIENDS WHERE username1='$userprofile' ";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {

          echo $result['username1'];
        }
      }

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Forums</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="stylesheets/profilestyles.css">
</head>
<body>

</body>
</html>
