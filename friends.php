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
    header('Location: login.php');
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

       echo "<form  action='friends.php' method='post' id='search-form'>
       <input type='text' id='search-text' name='search-text' placeholder='Search for Users ...'>
       <button type='submit' id='search-submit' name='search-submit' >Search</button>
       </form>";





?>



<!DOCTYPE html>
<html lang="en">
<head>
  <title>Forums</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="stylesheets/homestyles.css">
</head>
<body>
<main>


<div class="forums">
    <div class="thread-class">
    <div class="list-title">Users</div>
    <?php
   $searchitem= $_POST["search-text"];
   $sql = "SELECT * FROM ACCOUNTS WHERE username LIKE '%$searchitem%' ";
   $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        $username=$row["username"];

        echo'<div class="thread">';
          echo'<div class="thread-name">';
          if(empty($row['image'])){
            echo "<a href='profile.php?user=".$username."'>";
              echo "<img class='friend-image' src='images/default.png'/><br>";
              echo $username."</a>";
          }
          else{
            echo "<a href='profile.php?user=".$username."'>";
          echo '<img class="friend-image" src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'"/><br>';
          echo $username."</a>";
        }
          echo '</div>';
      echo '</div>';
      }
    }
  
    
    ?>
    </div>
  </div>



  
</main>

  


</body>
</html>
