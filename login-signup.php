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
      <h6 onclick="change_form()"id="click-here"> Don't have an account? click here</h5>

    </form>
    <br>

  </div>



<div class="container" id="sign-up">
  <br>
  <h2 align="center" id="login-txt">Sign up</h2>
  <form name="register-form" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
    <br>
    <div class="form-group">
      <input type="text" class="form-control" id="firstname" placeholder="First Name" name="firstname" required>
    </div>
    <div class="form-group">
      <input type="text" class="form-control" id="lastname" placeholder="Last Name" name="lastname" required>
    </div>
    <div class="form-group">
      <input type="text" class="form-control" id="email" placeholder="Email" name="email" required>
    </div>
    <div class="form-group">
      <input type="text" class="form-control" id="username" placeholder="Username" name="username" required>
    </div>
    <div class="form-group">
      <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
    </div>

    <button type="submit" class="btn btn-primary" class="submit" name="submit-register">Submit</button>
    <br>
    <h6 onclick="change_form2()"id="click-here"> Already have an account? click here</h5>

  </form>
  <br>

</div>


<?php
$servername = "sql9.freemysqlhosting.net";
$username = "sql9367403";
$password = "SS5Hr8L81X";
$databaseName = "sql9367403";

$conn = new mysqli($servername,$username,$password,$databaseName);
session_start();
 $accountusername= $accountpassword = '';

 $userid=$_SESSION["id"];
 if (  $userid!=NULL) {
   header('Location: index.php');

   }

if(isset($_POST['submit-login']))
{
    $accountusername = $_POST['login-username'];
    $accountpassword = $_POST['login-password'];

    // sql to select items
    $sql = "SELECT id FROM ACCOUNTS WHERE username='$accountusername' AND password='$accountpassword' LIMIT 1 ";
    $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $_SESSION["id"] = $row["id"];
    header('Location: welcome.php');

    }
  } else {
    echo "<script type='text/javascript'>
    document.getElementById('invalid-text').style.visibility='visible';
    </script>";

  }


}




$conn->close();
?>

</body>
</html>
