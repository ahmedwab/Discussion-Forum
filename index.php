<?php
session_start();
$servername = "localhost";
$username = "id14970710_admin";
$password = "M3e>ah-cdPUz?ByK";
$databaseName = "id14970710_discussionforum";

$conn = new mysqli($servername,$username,$password,$databaseName);

 $accountusername= $accountpassword = '';

 if(isset($_POST['submit-login']))
{

 $accountusername=$_POST['login-username'];
 $accountpassword=$_POST['login-password'];


 $sql = "SELECT username,password FROM ACCOUNTS WHERE username='$accountusername' AND PASSWORD='$accountpassword' LIMIT 1" ;
 $result = $conn->query($sql);


if ($result -> num_rows > 0){
   while($row = $result->fetch_assoc()){
     $_SESSION["user"] = $accountusername;

   }
   header('Location: welcome.php');

 }



}

 $conn->close();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login Form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--  Include the CSS Bootstrap library from a CDN (MaxCDN) by inserting the following line
 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="styles.css">
<script src="script.js"></script>

</head>
<body>
  <div class="container" id="sign-in">
    <br>
    <h2 align="center" id="login-txt">Sign in</h2>
    <form name="login-form" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
      <br>
      <h6 id="invalid-text"> Username and Password combination is invalid</h3>
      <div class="form-group">
        <input type="text" class="form-control" id="username" placeholder="username" name="login-username" required>
      </div>
      <div class="form-group">
        <input type="password" class="form-control" id="password" placeholder="Password" name="login-password" required>
      </div>

      <button type="submit" class="btn btn-primary" class="submit" name="submit-login">Submit</button>
      <br>
      <a href="signup.php"><h6 onclick="change_form()"class="click-here"> Don't have an account? click here</h5></a>

    </form>
    <br>

  </div>







</body>
</html>
