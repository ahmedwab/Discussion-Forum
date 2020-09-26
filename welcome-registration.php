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

  $firstname = $_POST["firstname"];
  $lastname = $_POST["lastname"];
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];

  $sql = "SELECT username FROM ACCOUNTS WHERE username='$username'";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      echo "username is already taken";
    }
  else {
  $sql = "INSERT INTO ACCOUNTS (firstname, lastname, username,email,password)
  VALUES ('$firstname', '$lastname', '$username','$email','$password')";

  $result = $conn->query($sql);

  if ($conn->query($sql) === TRUE) {
      echo "Welcome $firstname $lastname ";
  } else {
    echo "Error";
  }
}




  $conn->close();
  ?>

</body>
</html>
