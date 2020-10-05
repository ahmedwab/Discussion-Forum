<?php
session_start();
error_reporting(0);
$servername = "localhost";
$username = "id14970710_admin";
$password = "M3e>ah-cdPUz?ByK";
$databaseName = "id14970710_discussionforum";

$conn = new mysqli($servername,$username,$password,$databaseName);

 $accountusername= $_POST['forgot-username'];

 $sql="SELECT username FROM ACCOUNTS WHERE username='$accountusername' ";
 $result = $conn->query($sql);
 if($result -> num_rows<=0){
    header('Location: index.php');
 }

else{
 $sql="SELECT securityquestion,securityanswer FROM ACCOUNTS WHERE username='$accountusername' ";
 $result = $conn->query($sql);

$question=NULL;
$answer=NULL;
   while($row = $result->fetch_assoc()){
     $question=$row['securityquestion'];
     $answer=$row['securityanswer'];

   }



 echo '
 <div class="container" id="sign-in">
   <div>
   <br>
   <h2 align="center" id="login-txt">Forgot Password</h2>
   <form name="login-form" action=" htmlentities'.($_SERVER["PHP_SELF"]); echo ' method="post">
     <br>
     <div class="form-group">
      <h3 style="color:white;">'.$question.'</h3>' ;
      echo'
     </div>
     <div class="form-group">
       <input type="text" class="form-control" id="answer" placeholder="answer" name="login-password" required>
     </div>
     <div class="form-group">
       <input type="password" class="form-control" id="password" placeholder="password" name="password" required>
     </div>
     <div class="form-group">
       <input type="password" class="form-control" id="answer" placeholder="confirm password" name="confirm-password" required>
     </div>

     <button type="submit" class="submit" id="submit" name="submit-login">Submit</button>
     <br>


   </form>
 </div>
 </div>';
}


 $conn->close();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Forgot Password</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--  Include the CSS Bootstrap library from a CDN (MaxCDN) by inserting the following line
 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="stylesheets/login-signup-stylesheet.css">
<script src="script.js"></script>

</head>
<body>









</body>
</html>
