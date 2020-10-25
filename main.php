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





?>



<!DOCTYPE html>
<html lang="en">
<head>
  <title>Forums</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="stylesheets/home-style.css">
</head>
<body>
<main>

  <div class="forums">
    <div class="thread-class">
    <div class="list-title">Sports</div>
    <?php
    $sql = "SELECT * FROM TOPICLIST  WHERE category='sports' ORDER BY last_date DESC LIMIT 5";
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


  <div class="forums">
    <div class="thread-class">
    <div class="list-title">Economics</div>
    <?php
    $sql = "SELECT * FROM TOPICLIST  WHERE category='economics' ORDER BY last_date DESC LIMIT 5";
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
          echo "<a href='redirect-topic.php?topicid=$topicid&topicname=$topictitle'&date=$date'> " . $row["topic_title"] ."</a>";
          echo '</div>';
       echo' <div class="thread-count">'.$date.'</div>';
    echo '</div>';
      }
    }
  
    
    ?>
    </div>
  </div>

  <div class="forums">
    <div class="thread-class">
    <div class="list-title">Politics</div>
    <?php
    $sql = "SELECT * FROM TOPICLIST  WHERE category='politics' ORDER BY last_date DESC LIMIT 5";
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
          echo "<a href='redirect-topic.php?topicid=$topicid&topicname=$topictitle'&date=$date'> " . $row["topic_title"] ."</a>";
          echo '</div>';
       echo' <div class="thread-count">'.$date.'</div>';
    echo '</div>';
      }
    }
  
    
    ?>
    </div>
  </div>

  <div class="forums">
    <div class="thread-class">
    <div class="list-title">Environment</div>
    <?php
    $sql = "SELECT * FROM TOPICLIST  WHERE category='environment' ORDER BY last_date DESC LIMIT 5";
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
          echo "<a href='redirect-topic.php?topicid=$topicid&topicname=$topictitle'&date=$date'> " . $row["topic_title"] ."</a>";
          echo '</div>';
       echo' <div class="thread-count">'.$date.'</div>';
    echo '</div>';
      }
    }
  
    
    ?>
    </div>
  </div>

  <div class="forums">
    <div class="thread-class">
    <div class="list-title">Social</div>
    <?php
    $sql = "SELECT * FROM TOPICLIST  WHERE category='social' ORDER BY last_date DESC LIMIT 5";
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
          echo "<a href='redirect-topic.php?topicid=$topicid&topicname=$topictitle'&date=$date'> " . $row["topic_title"] ."</a>";
          echo '</div>';
       echo' <div class="thread-count">'.$date.'</div>';
    echo '</div>';
      }
    }
  
    
    ?>
    </div>
  </div>

  <div class="forums">
    <div class="thread-class">
    <div class="list-title">Travel</div>
    <?php
    $sql = "SELECT * FROM TOPICLIST  WHERE category='travel' ORDER BY last_date DESC LIMIT 5";
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
          echo "<a href='redirect-topic.php?topicid=$topicid&topicname=$topictitle'&date=$date'> " . $row["topic_title"] ."</a>";
          echo '</div>';
       echo' <div class="thread-count">'.$date.'</div>';
    echo '</div>';
      }
    }
  
    
    ?>
    </div>
  </div>

  
  <div class="forums">
    <div class="thread-class">
    <div class="list-title">Other</div>
    <?php
    $sql = "SELECT * FROM TOPICLIST  WHERE category='other' ORDER BY last_date DESC LIMIT 5";
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
          echo "<a href='redirect-topic.php?topicid=$topicid&topicname=$topictitle'&date=$date'> " . $row["topic_title"] ."</a>";
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
