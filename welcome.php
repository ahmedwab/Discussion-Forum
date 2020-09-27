<?php
session_start();
$servername = "localhost";
$username = "id14970710_admin";
$password = "M3e>ah-cdPUz?ByK";
$databaseName = "id14970710_discussionforum";

$conn = new mysqli($servername,$username,$password,$databaseName);

$accountusername= $accountpassword = '';

$accountusername = $_SESSION["user"];

$sql = "SELECT * FROM POSTS";

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    echo "id: " . $row["postID"]. " - Name: " . $row["username"]. " " . $row["textbox"]. "<br>";
  }
} else {
  echo "0 results";
}








$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title id="title">User</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--  Include the CSS Bootstrap library from a CDN (MaxCDN) by inserting the following line
 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="welcome-styles.css">
</head>
<body>
  <div id= "page-header"><h3>Discussion Forum</h3></div>


</body>
</html>
