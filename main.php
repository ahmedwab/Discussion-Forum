<?php
session_start();
error_reporting(0);
$servername = "localhost";
$username = "id14970710_admin";
$password = "M3e>ah-cdPUz?ByK";
$databaseName = "id14970710_discussionforum";

$conn = new mysqli($servername,$username,$password,$databaseName);

if ($_SESSION["user"] == NULL)
{
   header('Location: index.php');
}


echo" <div id='topnav'>
        <a href='main.php'>Discussion Forum</a>
        <div id='topnav-right'>
          <a href='destroy.php'>Sign Out</a>
        </div>
      </div>
      <form action='search.php' method='post'>
        <input id='search' type='text' name='topicsearch' placeholder='Search..'>
        <input id='search-btn' type='submit' name='search-btn' value='&#128269;'>

      </form><br>";
echo " <div id='topic-list'>";

// adding topics

$topictitle=$_POST['topicname'];
$sql = "INSERT INTO TOPICLIST (topic_title)
VALUES ('$topictitle')";

if ($conn->query($sql) === TRUE) {
  echo "";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

      $sql = "SELECT * FROM TOPICLIST ORDER BY last_date DESC";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          $topicid=$row["topic_id"];
          echo "<div class='topic-item'> ";
          echo "<a href='topic.php?topicid=$topicid'> " . $row["topic_title"] ."</a>";
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
  <link rel="stylesheet" href="topiclist-style.css">
</head>
<body>
  <div id="topic-post">
  <form id="topic-post" name="topic-form" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
    <input  type="text" id="topicname" name="topicname" value="">
    <input  type="submit" id="text-submit" name"text-submit" value="Add Topic">
  </form>
</div>
</body>
</html>
