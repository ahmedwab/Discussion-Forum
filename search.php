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
  echo '  <button type="button" id="topic-submit" onclick="showform()">Add topic</button><br><br>';

// adding topics
echo '<script>
  function removeform(){
    var post=  document.getElementById("topic-post");
    post.style.display="none";
    document.getElementById("page").style.opacity="1";
    post.style.opacity="0";
      }
  function showform(){
    var post=  document.getElementById("topic-post");
    post.style.display="block";
    document.getElementById("page").style.opacity="0.5";
    post.style.opacity="1";
  }
   </script>';


    $searchitem= $_POST["search-text"];
      $sql = "SELECT * FROM TOPICLIST WHERE topic_title LIKE '%$searchitem%'  ORDER BY last_date DESC";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          $topicid=$row["topic_id"];
          $topictitle=$row["topic_title"];

          echo "<div class='topic-item' style='background-color:".$row["color"].";'> ";
          echo "<a href='redirect-topic.php?topicid=$topicid&topicname=$topictitle'> " . $row["topic_title"] ."</a>";
          echo "</div> ";
        }
      } else {
        echo "0 results";
      }
echo " </div>";



$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Forums</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="stylesheets/topiclist-styles.css">
</head>
<body>
  </div>
  <div id="topic-post">
  <form id="topic-form" name="topic-form" action="newtopic-redirect.php" method="post">
    <p id="close-topic" onclick="removeform()">x</p><br>
    <input  type="text" id="topicname" name="topicname" placeholder="Enter new topic name" maxlength="50" required><br>
    <label for="cars">Choose a category:</label>
    <select name="category" id="category" >
      <option value="red">Sports</option>
      <option value="blue">Economics</option>
      <option value="purple">Politics</option>
      <option value="green">Environment</option>
      <option value="orange">Social</option>
      <option value="lightgreen">travel</option>
      <option value="#ADD8E6">Other</option>

    </select>
    <input  type="submit" id="text-submit" name"text-submit"  value="Add Topic">
  </form>
</div>
</body>
</html>
