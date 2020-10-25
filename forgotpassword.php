<?php
session_start();
error_reporting(0);
$servername = "mysql.discussionthreads.online";
$username = "ahmedwab";
$password = "251056Cc";
$databaseName = "discussionthreads_discussion";

$conn = new mysqli($servername,$username,$password,$databaseName);

 $accountusername= $_POST['forgot-username'];



 $sql="SELECT email FROM ACCOUNTS WHERE username='$accountusername' ";
 $result = $conn->query($sql);

$email=NULL;
$answer=NULL;
   while($row = $result->fetch_assoc()){
    $email=$row['email'];

   }
   $to = $email;
         $subject = "Password recovery";
         
         $message = "<b>This is HTML message.</b>";
         $message .= "<h1>This is headline.</h1>";
         
         $header = "From:no-reply@discussionthreads.online \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         
         $retval = mail ($to,$subject,$message,$header);
         if( $retval == true ) {
          echo "Message sent successfully...";
       }else {
          echo "Message could not be sent...";
       }



 echo '
 <div class="container" id="sign-in">
   <div>
   <br>
   <h2 align="center" id="login-txt">An Email has been sent to<br>' .$email.'</h2><br>
   <a align="center" href="index.php"><h3> Go back</h3></a><br>
   <h6> feature is currently not working</h6>
   
 </div>';


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
<link rel="stylesheet" href="stylesheets/login-signup-style.css">
<script src="script.js"></script>

</head>
<body>









</body>
</html>
