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

       echo "<form  action='search.php' method='post' id='search-form'>
       <input type='text' id='search-text' name='search-text' placeholder='Search...'>
       <button type='submit' id='search-submit' name='search-submit' >Search</button>
       </form>";





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
    <div class="list-title">Results</div>
    <?php
    $searchitem= $_POST["search-text"];
    $sql = "SELECT * FROM TOPICLIST WHERE topic_title LIKE '%$searchitem%'  ORDER BY last_date DESC";
     $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        $topicid=$row["topic_id"];
        $topictitle=$row["topic_title"];
        $date=$row["last_date"];

        echo'<div class="thread">';
          echo'    <img class="thread-icon" src="images/discussion-icon.png" alt="discusssion">';
          echo'<div class="thread-name">';
          echo "<a href='redirect-topic.php?topicid=$topicid&topicname=$topictitle'> " . $row["topic_title"] ."</a>";
          echo '</div>';
       echo' <div class="thread-count">'.$date.'</div>';
    echo '</div>';
      }
    }
  
    
    ?>
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
    <div class="list-title">New Threads</div>
    <?php
    $sql = "SELECT * FROM TOPICLIST  ORDER BY last_date DESC LIMIT 10";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        $topicid=$row["topic_id"];
        $topictitle=$row["topic_title"];
        $date=$row["last_date"];

        echo'<div class="thread">';
          echo'    <img class="thread-icon" src="images/discussion-icon.png" alt="discusssion">';
          echo'<div class="thread-right-name">';
          echo "<a href='redirect-topic.php?topicid=$topicid&topicname=$topictitle'&date=$date'> " . $row["topic_title"] ."</a>";
          echo '</div>';
    echo '</div>';
      }
    }
  
    
    ?>
    </div>
  </div>
  
  <div id="new-topic">
  <form  name="topic-form" action="newtopic-redirect.php" method="post">
    <input  type="text"  id="topicname" name="topicname" placeholder="Enter new topic name" maxlength="50" required><br>
    <label for="cars">Choose a category:</label>
    <select name="category"  >
      <option value="sports">Sports</option>
      <option value="economics">Economics</option>
      <option value="politics">Politics</option>
      <option value="environment">Environment</option>
      <option value="social">Social</option>
      <option value="travel">travel</option>
      <option value="other">Other</option>

    </select>
    <input  type="submit"  name"text-submit"  value="Add Topic">
  </form>
</div> 
</aside>

</body>
</html>
