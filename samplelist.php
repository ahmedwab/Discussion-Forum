<?php
session_start();
error_reporting(0);
$servername = "mysql.discussionthreads.online";
$username = "ahmedwab";
$password = "251056Cc";
$databaseName = "discussionthreads_discussion";

 $conn = new mysqli($servername,$username,$password,$databaseName);

 if ($_SESSION["user"] == NULL)
 {
    header('Location: index.php');
 }
 $accountusername = $_SESSION["user"];
 $topicid= $_SESSION['topicid'];
 $topicname= $_SESSION['topicname'];

 $query = "SELECT image FROM ACCOUNTS WHERE username='$accountusername' LIMIT 1";
 $result = mysqli_query($conn, $query);

$profileimage=NULL;
 while($row = mysqli_fetch_array($result))
 {
   $profileimage=$row['image'];
 }


echo "<div id='page'>";
 echo" <div id='topnav'>
         <a href='main.php'>Discussion Forum</a>
         <div id='topnav-right'>";
         if($profileimage==NULL){
           echo      " <a href='profile.php?user=$accountusername'>" ."<img id='profileImage' src='images/default.png'></a>";

         }
         else{
  echo      " <a href='profile.php?user=$accountusername'>" ."<img id='profileImage' src='data:image/jpeg;base64,".base64_encode( $profileimage )."'></a>";
}
  echo"         <a href='destroy.php'>Sign Out</a>
         </div>
       </div>";

       echo "<form  action='search.php' method='post' id='search-form'>
       <input type='text' id='search-text' name='search-text' placeholder='Search...'>
       <button type='submit' id='search-submit' name='search-submit' src='images/search.png'>
       <img src='images/search.png' alt='Search icon'/></button>
       </form>";





$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <title>Forums</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="stylesheets/topiclist-style.css">
</head>
<body>
<main>
<div class="forums">
<div class="thread-class">
<div class="list-title">Sports</div>
<div class="thread">
    <img class="thread-icon" src="images/discussion-icon.png" alt="discusssion">
    <div class="thread-name"> A thread name</div>
    <div class="thread-count"> 2<br>posts</div>
</div>
<div class="thread">
    <img class="thread-icon" src="images/discussion-icon.png" alt="discusssion">
    <div class="thread-name"> A thread name</div>
    <div class="thread-count"> 2<br>posts</div>
</div>
</div>
</div>
<div class="forums">
    <div class="thread-class">
    <div class="list-title">Economics</div>
    <div class="thread">
        <img class="thread-icon" src="images/discussion-icon.png" alt="discusssion">
        <div class="thread-name"> A thread name</div>
        <div class="thread-count"> 2<br>posts</div>
    </div>
    <div class="thread">
        <img class="thread-icon" src="images/discussion-icon.png" alt="discusssion">
        <div class="thread-name"> A thread name</div>
        <div class="thread-count"> 2<br>posts</div>
    </div>
    </div>
    </div>
</main>

<aside>
    <div id="social-media">
       <a href="https://www.linkedin.com/in/ahmedwab/"> <img  src="images/linkedin-icon.png" alt="discusssion"></a>
       <a href="https://github.com/ahmedwab" ><img  src="images/github-icon.png" alt="discusssion"></a>
    </div>
    <image src="images/300x250.png">
        <div class="forums">
            <div class="thread-class">
            <div class="list-title">New threads</div>
            <div class="thread">
                <img class="thread-icon" src="images/discussion-icon.png" alt="discusssion">
                <div class="thread-right-name"> A thread name</div>
               
            </div>
            <div class="thread">
                <img class="thread-icon" src="images/discussion-icon.png" alt="discusssion">
                <div class="thread-right-name"> A thread name</div>
               
            </div>
            </div>
            </div>
</aside>
</body>
</html>
