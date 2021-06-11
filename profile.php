<?php
include("config.php");
session_start();
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $_GET['user'] ?></title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="stylesheets/topic-style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script><!-- Angular JS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

  <div id='topnav'>
         <a href='main.php'><img id='logoIcon' src='images/discussion-icon.png'>Discussion Forum</a>
         <div id='topnav-right'>
            


<?php



if ($_SESSION["user"] == NULL)
{
    header('Location: login.php');
}
$accountusername = $_SESSION["user"];




$conn->query($sql);

$query = "SELECT image FROM ACCOUNTS WHERE username='$accountusername' LIMIT 1";
$result = mysqli_query($conn, $query);

$profileimage = NULL;
while ($row = mysqli_fetch_array($result))
{
    $profileimage = $row['image'];
}

if ($profileimage == NULL)
{
    echo " <a href='profile.php?user=$accountusername'>" . "<img id='profileImage' src='images/default.png'></a>";

}
else
{
    echo " <a href='profile.php?user=$accountusername'>" . "<img id='profileImage' src='data:image/jpeg;base64," . base64_encode($profileimage) . "'></a>";
}

  $userprofile =$_GET['user'];

  if($userprofile ==$accountusername){
    echo "<a id='signOut'href='destroy.php'> Sign Out</a>";
  }

  echo '</div>
  </div>';


  $query = "SELECT * FROM ACCOUNTS 
  WHERE username='$userprofile'
  LIMIT 1";
  $result = mysqli_query($conn, $query);

$userImage = NULL;

while ($row = mysqli_fetch_array($result))
{
  echo '<div id="Profile">';

  if ($row['image'] == NULL)
{
  echo " <a href='profile.php?user=$userprofile'>" . "<img id='userImage' src='images/default.png'></a>";

}
else
{
    echo " <a href='profile.php?user=$userprofile'>" . "<img id='userImage' src='data:image/jpeg;base64," . base64_encode($row['image']) . "'></a>";
}
  
  echo '<h1>'.$row['firstname'].' '.$row['lastname'].'</h1>';
  echo '</div>
  ';
}



 


$query = "SELECT * FROM ACCOUNTS A, POSTS P,TOPIC T 
WHERE A.username = P.username
AND T.TopicID = P.TopicID
AND A.username = '$userprofile'
ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($result))
{
    $topicImage = '<img class="post-profileImage" src="images/default.png">';

    if ($row['image'] != NULL) $topicImage = "<img class='post-profileImage' src='data:image/jpeg;base64," . base64_encode($row['image']) . "'>";

    $postImage = NULL;
    if ($row['postImage'] != NULL) $postImage = "<img class='post-image' src='data:image/jpeg;base64," . base64_encode($row['postImage']) . "'>";

    echo '
        <div class="post">
        <a href="topic.php?topicid='.$row['TopicID'].'&topicname='.$row['TITLE'].'">'.
            '<div class="post-topic">

              '.$row['TITLE'].'

            </div>
           </a>
           <hr>
          <a href="profile.php?user='.$accountusername.'">'.
            '<div class="post-person">

              <div class="post-personImage">' . $topicImage . '</div>
              <div class="post-personName">' . $row['username'] . '</div>

            </div>
           </a>
           <hr>

        <div class="post-content">

            <div class="post-contentImage">' . $postImage . '</div>
            <div class="post-contentText">' . $row['textbox'] . '</div>

        </div>
          
        
        
       </div>';
}




?>
