<?php
session_start();
error_reporting(0);
$servername = "localhost";
$username = "id14970710_admin";
$password = "M3e>ah-cdPUz?ByK";
$databaseName = "id14970710_discussionforum";

$conn = new mysqli($servername,$username,$password,$databaseName);


 $accountfirstname = $accountlastname = $accountuser = $accountemail = $accountpassword = '';

 $accountfirstname=$_POST['register-firstname'];
 $accountlasttname=$_POST['register-lastname'];
 $accountemail=$_POST['register-email'];
 $accountusername=$_POST['register-username'];
 $accountpassword=$_POST['register-password'];






    $sql = "INSERT INTO ACCOUNTS (firstname, lastname, username,email,password)
    VALUES ('$accountfirstname', '$accountlasttname', '$accountusername','$accountemail','$accountpassword')";

    if ($conn->query($sql) === TRUE) {
      $_SESSION["user"] = $accountusername;
      header('Location: welcome.php');

  } else {
  echo "Username is already taken";
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
