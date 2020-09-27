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


$profileuser=$_GET['user'];
echo" <div id='topnav'>
        <a href='main.php'>Discussion Forum</a>
        <div id='topnav-right'>
          <a href='destroy.php'>Sign Out</a>
        </div>
      </div>
      <br>";

$sql = "SELECT firstname,lastname,username,email FROM ACCOUNTS   WHERE username=  '$profileuser'  ";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
  echo "Username: " . $row['username'] ."<br>";
  echo "Name: " . $row['firstname'] ." ". $row['lastname'] ."<br>";
  echo "Email: " . $row['email'] ."<br>";


}



$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Profile</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="profile-style.css">
</head>
<body>

</body>
</html>
