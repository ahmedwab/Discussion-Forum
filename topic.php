<?php
include("config.php");
session_start();
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $_GET['topicname'] ?></title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="stylesheets/topic-style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script><!-- Angular JS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

  <div id='topnav'>
         <a href='main.php'><img id='logoIcon' src='images/discussion-icon.png'>Discussion Forum</a>
         <div id='topnav-right'>
            <form  action='search.php' method='get' id='search-form'>
              <input type='text' id='search-text' name='search-text' ng-model="search "placeholder='Search...'>
              <button type='submit' id='search-submit' name='search-submit' ><i class="fa fa-search"></i></button>
            </form>


<?php

if ($_SESSION["user"] == NULL)
{
    header('Location: login.php');
}
$accountusername = $_SESSION["user"];
$topicid = $_SESSION['topicid'];
$topicname = $_SESSION['topicname'];

$views = 1;
$topicid= $_GET['topicid'];
$query = "SELECT views FROM TOPIC WHERE TopicID ='$topicid' LIMIT 1";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_array($result))
{
    $views= $row['views']+1;
}


$sql = "UPDATE TOPIC SET views='$views' WHERE TopicID ='$topicid' ";

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
  echo '</div>
  </div>';

  $topicname = $_GET['topicname'];
  $topicid = $_GET['topicid'];

 
echo '<div id="newPost">';
      if ($profileimage == NULL)
{
    echo " <a href='profile.php?user=$accountusername'>" . "<img id='newPost-profileImage' src='images/default.png'>".$accountusername."</a>";

}
else
{
    echo " <a href='profile.php?user=$accountusername'>" . "<img id='newPost-profileImage' src='data:image/jpeg;base64," . base64_encode($profileimage) . "'>".$accountusername."</a>";
} 
    
      echo '
      <hr>
      <form id="createPost" name="createPost" enctype="multipart/form-data" method="post" action="#">
      <div ng-app="">
     
      <textarea id="post-text" ng-trim="false" ng-model="countmodel" name="post-text" rows="4" cols="50" maxlength="140"></textarea>

      <p id="charCount">{{140 - countmodel.length}} characters left</p>
      </div>
      <input type="hidden"  name="topicid" value="'.$topicid.'" >
      <input type="hidden" name="topicname" value="'.$topicname.'">
      <input input type="file" name="image" id = "uploadImage">
      <input type="submit" value="Post" id="uploadPost" name="uploadPost">


      

      </form>
      </div>';


      


  if( isset($_POST['uploadPost']) )
{
  $posttext=$_POST['post-text'];
  $postusername=$accountusername;
  $topicid =$_POST['topicid'];
  $image = $_FILES['image']['tmp_name'];


  $img = file_get_contents($image);
  $id= (int)$topicid;


  /*
  $sql = "INSERT INTO POSTS (topicID, username, textbox,postImage)
  VALUES ($id,'$postusername', '$posttext','$img')";

  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  */

  
}





$topicid = $_GET['topicid'];
$query = "SELECT * FROM ACCOUNTS A, POSTS P,TOPIC T 
WHERE A.username = P.username
AND T.TopicID = P.TopicID
AND T.topicID = '$topicid'
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
