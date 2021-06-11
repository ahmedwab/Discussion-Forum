<?php

include("config.php");
session_start();
error_reporting(0);


$conn = new mysqli($servername,$username,$password,$databaseName);

 $token= $_GET['token'];
 $accountusername=NULL;

 $sql="SELECT username FROM PASSWORD WHERE token='$token' ";
 $result = $conn->query($sql);
 if($result-> num_rows>0){
    while($row = $result->fetch_assoc()){
        $accountusername=$row['username'];
    }
 }
 else{
     echo "something went wrong";
 }







 $conn->close();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Recover Password</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--  Include the CSS Bootstrap library from a CDN (MaxCDN) by inserting the following line
 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="stylesheets/login-signup-style.css">
<script src="script.js"></script>

</head>
<body>
<div class="container" id="sign-in">
      <div>
      <br>
      <h2 align="center" id="login-txt"><?php echo $accountusername;?></h2><br>
    <form name="login-form" action="updatepassword.php" method="post">  
        <input type="hidden" name="username" value="<?php echo $accountusername;?>">
            <div class="form-group">
            <input type="password" class="form-control" id="password" placeholder="Password" name="update-password" required>
        </div>
       

        <button type="submit" class="submit" id="update-submit" name="submit-password">Submit</button>
    </form>
        <a align="center" href="index.php"><h3> Go back</h3></a><br>
      
    </div>









</body>
</html>
