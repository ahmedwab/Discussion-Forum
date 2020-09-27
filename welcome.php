<?php
session_start();
error_reporting(0);
$servername = "localhost";
$username = "id14970710_admin";
$password = "M3e>ah-cdPUz?ByK";
$databaseName = "id14970710_discussionforum";

$conn = new mysqli($servername,$username,$password,$databaseName);

$accountusername= $accountpassword = '';

$accountusername = $_SESSION["user"];


echo "<h3 id='heading'>Discussion Forum</h3>
<form name='sign-out' action='destroy.php' method='post'>
  <input type='submit' id='sign-out' name='sign-out' value='sign-out'>
</form><br><br>";


$postusername=$accountusername;
$posttext=$_POST['textbox'];

if($posttext!=''){
$sql = "INSERT INTO MESSAGES (username, textbox)
VALUES ( '$postusername', '$posttext')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
}


$sql = "SELECT * FROM MESSAGES ORDER BY DATE DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  echo "<div id='message-board'>";

  while($row = $result->fetch_assoc()) {
    echo "<div class='message'>";
    echo  "<h6 class='message-user'>" . $row['username'] . " said </h6>";
    echo  "<h6 class='message-date' >" .  $row['date'] . "</h6><br>";
    echo  "<h6 class='message-text' >" .  $row['textbox'] . "</h6>";


  echo "</div>";

  }
  echo "</div>";
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

  <div id="message-post">
  <form id="message-post" name="text-form" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
    <input id="input-item" type="text" id="textbox" name="textbox" value="">
    <input  type="submit" id="text-submit" name"text-submit" value="post">
  </form>
</div>



</body>
</html>
