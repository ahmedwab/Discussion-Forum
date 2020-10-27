<?php
session_start();
error_reporting(0);
$servername = "mysql.discussionthreads.online";
$username = "ahmedwab";
$password = "251056Cc";
$databaseName = "discussionthreads_discussion";

$conn = new mysqli($servername,$username,$password,$databaseName);


  $accountimage = addslashes(file_get_contents($_FILES["register-image"]["tmp_name"]));
$accountfirstname=$_POST['register-firstname'];
 $accountlasttname=$_POST['register-lastname'];
 $accountemail=$_POST['register-email'];
 $accountusername=$_POST['register-username'];
 $accountpassword=$_POST['register-password'];






if($accountusername!=''){

    $sql = "INSERT INTO ACCOUNTS (image,firstname, lastname, username,email,password)
    VALUES ('$accountimage','$accountfirstname', '$accountlasttname', '$accountusername','$accountemail',MD5('$accountpassword'))";

    if ($conn->query($sql) === TRUE) {
      $_SESSION["user"] = $accountusername;
      header('Location: main.php');

  } else {
    echo "<script> alert('Username is already taken')</script>";

}
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
<link rel="stylesheet" href="stylesheets/login-signup-style.css">
<script src="script.js"></script>

</head>
<body>



<div class="container" id="register">
  <br>
  <h2 align="center" id="login-txt">Sign up</h2>
  <form name="register-form" method="post" enctype="multipart/form-data">
    <br>
    <img src="images/default.png" id="profile-pic" alt="Girl in a jacket" width="200" height="200"><br>
      <div class="form-group">
        <h6> Choose a Profile Photo (optional) 16MB Max Size</h6>
        <input type="file" id="img" name="register-image" accept="image/*"  onchange="document.getElementById('profile-pic').src = window.URL.createObjectURL(this.files[0])">
      </div>
    <div class="form-group">
      <input type="text" class="form-control" id="firstname" placeholder="First Name *" name="register-firstname" required>
    </div>
    <div class="form-group">
      <input type="text" class="form-control" id="lastname" placeholder="Last Name *" name="register-lastname" required>
    </div>
    <div class="form-group">
      <input type="text" class="form-control" id="email" placeholder="Email *" name="register-email" required>
    </div>
    <div class="form-group">
      <input type="text" class="form-control" id="username" placeholder="Username *" name="register-username" required>
    </div>
    <div class="form-group">
      <input type="password" class="form-control" id="password" placeholder="Password *" name="register-password" required>
    </div>
    

      <button type="submit" class="submit" id="submit" name="submit-login">Submit</button>
    <br>
      <a href="login.php"><h6 onclick="change_form()"class="click-here">  Already have an account? click here</h5></a>

  </form>
  <br>

</div>




</body>
</html>
