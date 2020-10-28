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
$activeuser=$_SESSION["user"];
$userprofile=$_GET["user"];
echo "<script> document.title='$userprofile'</script>";


echo" <div id='topnav'>
        <a href='main.php'>Discussion Forum</a>
        <div id='topnav-right'>";
        if($userprofile==$_SESSION["user"]){
         echo" <a href='updateprofile.php?user=$userprofile'><img src='images/profile-icon.png' alt='My profile'</a>";
        }
        echo "
          <a href='destroy.php'>Sign Out</a>
        </div>
      </div><br>";





      $sql = "SELECT * FROM ACCOUNTS WHERE username='$userprofile' ";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          if(empty($row['image'])){
              echo "<img id='profileimage' src='images/default.png'/><br>";
          }
          else{
          echo '<img id="profileimage" src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'"/><br>';
        }
          echo "<h1 align='center'>" .$row['firstname'] .' ' . $row['lastname'].'</h1><br>';
        }
      } 
      if($userprofile!=$_SESSION["user"]){
        $sql = "SELECT * FROM FRIENDS WHERE (username1='$userprofile' AND username2='$activeuser') OR (username2='$userprofile' AND username1='$activeuser')";
        $result = $conn->query($sql);

        if ($result->num_rows <=0) {  
          $_SESSION["friend"]=$userprofile;

        echo" <form method='POST' action='addfriend.php'> 
              <input type='submit' id='add-friend' name='add-friend' value='Add Friend'>
              </form>";
       }
        else echo "<div id='added' name='added'>Friends</div>";
      }

      echo "<button id='postbutton' onclick='posts_section()'>Posts</button>";
      echo "<button id='friendsbutton' onclick='friends_section()'>Friends</button>";
      $sql = "SELECT * FROM TOPIC WHERE username='$userprofile' ORDER BY DATE DESC ";
      $result = $conn->query($sql);

      echo "<div id='posts-section'>";

      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          $topicid=$row["tid"];
          $topictitle=$row["ttitle"];
          echo "<div id='userpost'>";
          $profileuser=$row['username'];
            echo "<a href='profile.php?user=$profileuser'>" . $row['username'] ."</a>" . " wrote on " ."<a href='redirect-topic.php?topicid=$topicid&topicname=$topictitle'>". $row['ttitle']. "</a><br>";
            if(!empty($row['topicimage'])){
                echo '<img  class="postimg"src="data:image/jpeg;base64,'.base64_encode( $row['topicimage'] ).'"/><br>';
            }
            echo  $row['textbox'] . '<br>';

          echo "</div>";
        }
      }
      echo "</div>";
      

      


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Forums</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="stylesheets/profilestyles.css">
</head>
<body>

<?php

$sql = "SELECT * FROM FRIENDS WHERE username1='$userprofile' OR username2='$userprofile'";
$result = $conn->query($sql);

echo "<div id='friends-section'>";

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    if($row["username1"]==$userprofile) $friend= $row["username2"];
    else $friend= $row["username1"];

    $stmnt = "SELECT * FROM ACCOUNTS WHERE username='$friend' ";
      $res = $conn->query($stmnt);

      echo  '<a class="friend" href="profile.php?user='.$friend.'">';
        while($r = $res->fetch_assoc()) {
          if(empty($r['image'])){
              echo "<img class='friend-image' src='images/default.png'/><br>";
          }
          else{
          echo '<img class="friend-image" src="data:image/jpeg;base64,'.base64_encode( $r['image'] ).'"/><br>';
        }
          echo "<h6 align='center'>" .$r['firstname'] .' ' . $r['lastname'].'</h1><br>';
        }
      echo '</a>';
       


  }
}
 else {
  echo "No friends to show.";
}
echo "</div>";
$conn->close();
?>

</body>
</html>

<script>


function posts_section(){
  document.getElementById("posts-section").style.display = "block";
  document.getElementById("friends-section").style.display = "none";
  document.getElementById("friendsbutton").style.color="#1E90FF";
  document.getElementById("postbutton").style.color="#0a192f";

}
function friends_section(){
  document.getElementById("posts-section").style.display = "none";
  document.getElementById("friends-section").style.display = "block";
  document.getElementById("friendsbutton").style.color="#0a192f";
  document.getElementById("postbutton").style.color="#1E90FF";

}
</script>
