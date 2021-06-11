<?php
include("config.php");
session_start();
error_reporting(0);


 $accountusername= $_POST['forgot-username'];

 $emailtext=md5($accountusername). md5(date_default_timezone_get());
 


 $sql="SELECT email FROM ACCOUNTS WHERE username='$accountusername' ";
 $result = $conn->query($sql);

 if($result-> num_rows>0){
  $query = "INSERT INTO PASSWORD (TOKEN, username)
  VALUES ( '$emailtext', '$accountusername')";
     if(mysqli_query($conn, $query))
     {
          echo 'added';
     }
     else{
       echo'nothing';
     }

$email=NULL;
$answer=NULL;
   while($row = $result->fetch_assoc()){
    $email=$row['email'];

   }
   $to = $email;
         $subject = "Password recovery";
         
         $message = "<b>Click the link to recover password.</b>";
         $message .= "http://www.discussionthreads.online/recoverpassword.php?token=" . $emailtext;
         
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
   <h2 align="center" id="login-txt">An Email has been sent to recover password</h2><br>
   <a align="center" href="index.php"><h3> Go back</h3></a><br>
   
 </div>';
      }
      else{
        echo '
 <div class="container" id="sign-in">
   <div>
   <br>
   <h2 align="center" id="login-txt">Invalid username</h2><br>
   <a align="center" href="index.php"><h3> Go back</h3></a><br>
   
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
<link rel="stylesheet" href="stylesheets/login-signup-style.css">
<script src="script.js"></script>

</head>
<body>









</body>
</html>
