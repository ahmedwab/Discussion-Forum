<!DOCTYPE html>
<html lang="en">
<head>
  <title id="title">User</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--  Include the CSS Bootstrap library from a CDN (MaxCDN) by inserting the following line
 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
  <?php
  session_start();
  $servername = "sql9.freemysqlhosting.net";
  $username = "sql9367403";
  $password = "SS5Hr8L81X";
  $databaseName = "sql9367403";

  $conn = new mysqli($servername,$username,$password,$databaseName);

  $userid=$_SESSION["id"];
  if (  $userid==NULL) {
    header('Location: login-signup.php');

    }
     else {
    echo "<script type='text/javascript'>
    document.getElementById('invalid-text').style.visibility='visible';
    </script>";



  $sql = "SELECT firstname,lastname FROM ACCOUNTS WHERE id='$userid'";
  $result = $conn->query($sql);


  while($row = $result->fetch_assoc()) {
  echo "<div id='pageheader'>";
  echo "<h2 id='user-title'>" . $row['firstname']." ". $row['lastname'] . "</h2>";
  echo '</div>';

  }
}





  $conn->close();
  ?>

</body>
</html>
