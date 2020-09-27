<?php
$servername = "sql9.freemysqlhosting.net";
$username = "sql9367403";
$password = "SS5Hr8L81X";
$databaseName = "sql9367403";

$conn = new mysqli($servername,$username,$password,$databaseName);
session_start();
 $accountusername= $accountpassword = '';

 $userid=$_SESSION["id"];
 if (  $userid=NULL) {
   header('Location: index.php');
   }

 if(isset($_POST['submit-register']))
{
    $accountfirstname = $_POST['register-firstname'];
    $accountlastname = $_POST['register-lastname'];
    $accountpassword = $_POST['register-password'];
    $accountuser = $_POST['register-username'];
    $accountemail = $_POST['register-email'];

    $sql = "INSERT INTO ACCOUNTS (firstname, lastname, username,email,password)
    VALUES ('$accountfirstname', '$accountlastname', '$accountuser','$accountemail','$accountpassword')";








}




$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sign Up</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--  Include the CSS Bootstrap library from a CDN (MaxCDN) by inserting the following line
 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="styles.css">
<script src="script.js"></script>

</head>
<body>



<div class="container" id="register">
  <br>
  <h2 align="center" id="login-txt">Sign up</h2>
  <form name="register-form" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
    <br>
    <h6 id="taken-text"> Username or Email is already taken </h3>
    <div class="form-group">
      <input type="text" class="form-control" id="firstname" placeholder="First Name" name="register-firstname" required>
    </div>
    <div class="form-group">
      <input type="text" class="form-control" id="lastname" placeholder="Last Name" name="register-lastname" required>
    </div>
    <div class="form-group">
      <input type="text" class="form-control" id="email" placeholder="Email" name="register-email" required>
    </div>
    <div class="form-group">
      <input type="text" class="form-control" id="username" placeholder="Username" name="register-username" required>
    </div>
    <div class="form-group">
      <input type="password" class="form-control" id="password" placeholder="Password" name="register-password" required>
    </div>

    <button type="submit" class="btn btn-primary" class="submit" name="submit-register">Submit</button>
    <br>
      <a href="index.php"><h6 onclick="change_form()"class="click-here">  Already have an account? click here</h5></a>

  </form>
  <br>

</div>




</body>
</html>
