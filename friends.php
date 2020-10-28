<?php
session_start();
error_reporting(0);
$servername = "mysql.discussionthreads.online";
$username = "ahmedwab";
$password = "discussion1407";
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

 $sql = "SELECT * FROM NOTIFICATIONS  WHERE otheruser='$accountusername' AND viewed='0' ORDER BY time DESC";
 $result = $conn->query($sql);

$notif_num=$result->num_rows ;
echo "<div id='page'>";
 echo" <div id='topnav'>
         <a href='main.php'>Discussion Forum</a>
         <div id='topnav-right'>
         <a href='notifications.php'>" ."<img id='profileImage' src='images/bell.png'><p>".$notif_num."</p></a> 
         <a href='friends.php'>" ."<img id='profileImage' src='images/friends.png'></a> ";
         if($profileimage==NULL){
           echo      " <a href='profile.php?user=$accountusername'>" ."<img id='profileImage' src='images/default.png'></a>";

         }
         else{
  echo      " <a href='profile.php?user=$accountusername'>" ."<img id='profileImage' src='data:image/jpeg;base64,".base64_encode( $profileimage )."'></a>";
}
  echo"   
        
         </div>
       </div>";

      





?>



<!DOCTYPE html>
<html lang="en">
<head>
  <title>Forums</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="stylesheets/home-styles.css">
</head>
<body>
<main>
<div class="forums">
    <div class="thread-class">
    <div class="list-title">Friends</div>
    <?php
    $sql = "SELECT * FROM FRIENDS WHERE username1='$accountusername' OR username2='$accountusername'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        if($row["username1"]==$accountusername) $username= $row["username2"];
        else $username= $row["username1"];
        


        echo'<div class="thread">';
          echo'<div class="thread-right-name">';
          $stmnt = "SELECT * FROM ACCOUNTS WHERE username='$username' ";
          $res = $conn->query($stmnt);
    
            while($r = $res->fetch_assoc()) {
              if(empty($r['image'])){
                echo "<a href='profile.php?user=".$username."'>";
                  echo "<img class='friend-image' src='images/default.png'/><br>";
                  echo "<p>".$username."</p></a>";
                }
              else{
                echo "<a href='profile.php?user=".$username."'>";
              echo '<img class="friend-image" src="data:image/jpeg;base64,'.base64_encode( $r['image'] ).'"/><br>';
              echo "<p>".$username."</p></a>";
            }
        }
          echo '</div>';
    echo '</div>';
      }
    }
    else{
        echo "  You have no notifications";
    }
    $sql = "UPDATE NOTIFICATIONS SET viewed='1' WHERE otheruser='$accountusername'";

      if ($conn->query($sql) === TRUE) {
      echo "";
      } 

  
    
    ?>
    </div>
  </div>
</main>

<aside>
<div class="forums">
    <div class="thread-class">
    <div class="list-title">Search for Users</div>
    <form  action='friends.php' method='post' id='search-form'>
       <input type='text' id='search-user'  name='search-text' placeholder='Search...' >
        <button type='submit' id='user-submit'  name='search-submit' >Search</button>
       </form>
    <?php
        
        $searchitem= $_POST["search-text"];

        echo'<div class="thread">';
          echo'<div class="thread-right-name">';
          $stmnt = "SELECT * FROM ACCOUNTS WHERE username LIKE '%$searchitem%'LIMIT 10 ";
          $res = $conn->query($stmnt);
    
            while($r = $res->fetch_assoc()) {
              if(empty($r['image'])){
                echo "<a href='profile.php?user=".$r[username]."'>";
                  echo "<img class='friend-image' src='images/default.png'/><br>";
                  echo "<p>".$r[username]."</p></a>";
                }
              else{
                echo "<a href='profile.php?user=".$r[username]."'>";
              echo '<img class="friend-image" src="data:image/jpeg;base64,'.base64_encode( $r['image'] ).'"/><br>';
              echo "<p>".$r[username]."</p></a>";
            }
        }
          echo '</div>';
    echo '</div>';
      
    

  
    
    ?>
    </div>
  </div>
</aside>
</body>
</html>
