<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login Form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--  Include the CSS Bootstrap library from a CDN (MaxCDN) by inserting the following line
 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="style.css">
</head>
<body>
  <?php
  $servername = "sql9.freemysqlhosting.net";
  $username = "sql9367403";
  $password = "SS5Hr8L81X";
  $databaseName = "sql9367403";

  $conn = new mysqli($servername,$username,$password,$databaseName);


  $username = $_POST["username"];
  $password = $_POST["password"];



  // sql to create table
  $sql = "SELECT firstname,lastname FROM ACCOUNTS WHERE username='$username' AND password='$password'";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo "Welcome " . $row["firstname"] . "<br>";
    }
  } else {
    echo "0 results";
  }




  $conn->close();
  ?>

</body>
</html>
