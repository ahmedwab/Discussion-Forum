<?php
include("config.php");
session_start();
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Forums</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="stylesheets/home-style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script><!-- Angular JS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

  <div id='topnav'>
         <a href='main.php'><img id='logoIcon' src='images/discussion-icon.png'>Discussion Forum</a>
         <div id='topnav-right'>
            <button id="newTopic" onclick="openPop()"> Start new topic </button>


<?php



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

    
        if($profileimage==NULL){
           echo      " <a href='profile.php?user=$accountusername'>" ."<img id='profileImage' src='images/default.png'></a>";

         }
         else{
  echo      " <a href='profile.php?user=$accountusername'>" ."<img id='profileImage' src='data:image/jpeg;base64,".base64_encode( $profileimage )."'></a>";
}




?>

      </div>
       </div>
  <form  action='search.php' method='get' id='search-form'>
       <input type='text' id='search-text' name='search-text' ng-model="search "placeholder='Search...'>
        <button type='submit' id='search-submit' name='search-submit' ><i class="fa fa-search"></i></button>
  </form>

  

 
  
  

  <div id="leftPage">
  <div class="scrollmenu">
    <h1> #Trending </h1>
  <?php
      $query = "SELECT * FROM TOPIC ORDER BY DATE DESC LIMIT 5";
      $result = mysqli_query($conn, $query);
      while($row = mysqli_fetch_array($result))
      {
        
          echo '<a href="topic.php?topicid='.$row['TopicID'].'&topicname='.$row['TITLE'].'">'.$row['TITLE'].'</a>';
      }

  ?>
  </div>

  <?php
      $query = "SELECT * FROM ACCOUNTS, TOPIC WHERE ACCOUNTS.USERNAME = TOPIC.USERNAME ORDER BY DATE DESC";
      $result = mysqli_query($conn, $query);
      while($row = mysqli_fetch_array($result))
      {
          $topicImage='<img class="topic-image" src="images/default.png">';
          
          if($row['image']!=NULL)
            $topicImage= "<a href='profile.php?user=$accountusername'>" ."<img class='topic-image' src='data:image/jpeg;base64,".base64_encode( $row['image'] )."'></a>";
       
        echo'
        <div class="topic">
        <div class="topic-person">'
          .$topicImage.
        '</div>
        <div class="topic-info">
          <div class="topic-name">
            <a href="topic.php?topicid='.$row['TopicID'].'&topicname='.$row['TITLE'].'"><h1>'.$row['TITLE'].'</h1></a>
            <p>'.$row['DESCRIPTION'].' </p>
          </div>
          <div class="topic-stats">
            <h1>'.$row['views'].'</h1>
            <i class="fa fa-eye"></i>
          </div>
        </div>
        
       </div>';
      }

  ?>
  </div>

   
  <div id="rightPage">
    <div id='categories'>
      <h2> Popular Categories </h2>
      <hr> 
      <ul>
      <?php
      $query = "SELECT CATEGORY,VIEWS FROM TOPIC ORDER BY VIEWS DESC LIMIT 20";
      $result = mysqli_query($conn, $query);
      while($row = mysqli_fetch_array($result))
      {
         
        echo' <li><a href="search.php?search-text='.$row['CATEGORY'].'">#'.$row['CATEGORY'].'</a></li>';
      }
      

  ?>
     
        
      </ul>
    </div>

    <div id='users'>
      <h2> Active Users </h2>
      <hr>
      <ul>
      <?php
      $query = "SELECT username,image From ACCOUNTS LIMIT 6";
      $result = mysqli_query($conn, $query);
      while($row = mysqli_fetch_array($result))
      {
        $userImage = '<img class="userImage" src="images/default.png">';
        if ($row['image']!=NULL){
          $userImage = "<img class='userImage' src='data:image/jpeg;base64,".base64_encode( $row['image'] )."'>";
        }
         
        echo' <li><a href="profile.php?user='.$row['username'].'">'.$userImage.$row['username'].'</a></li>';
      }
      

  ?>
      </ul>
    </div>

  </div>



    <div id="createTopic" ng-app="">
    <h1 id="close" onclick="closePop()">X</h1>
      <h1>Add Topic</h1>
      <form  action='' method='POST' id='postTopic' name='postTopic'>
        <input type='text' id='topic-title' name='topic-title' placeholder='Title...'>
        <br><br>
        <textarea id="topic-description" name="topic-description" ng-trim="false" ng-model="countmodel" placeholder='Description...'rows="4" cols="50" maxlength="140"></textarea>
        <p id="charCount">{{140 - countmodel.length}} characters left</p>

        <input type='text' id='topic-category' name='topic-category' placeholder='Category...'>
        <br><br>
        <input type='submit' id='topic-submit' name='topic-submit' >
      </form>
    </div>
</body>
</html>
<script>


  function closePop(){
  
    document.getElementById('createTopic').style.display='none';
  }
  function openPop(){
  
  document.getElementById('createTopic').style.display='block';
}
</script>
<?php



if( isset($_POST['topic-submit']) )
{
  echo "dss";
  $title = $_POST['topic-title'];
  $description = $_POST['topic-description'];
  $category = $_POST['topic-category'];
  $sql = "INSERT INTO `TOPIC` (`TopicID`, `TITLE`, `DESCRIPTION`, `CATEGORY`, `username`, `date`, `views`) 
  VALUES (NULL, '$title', '$description', '$category', '$accountusername', CURRENT_TIMESTAMP, '0');";
  
  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  header('Location: login.php');
}



?>

<hr>
<footer>

  <a href="https:github.com/ahmedwab"> Developed by Ahmed Abdelfattah </a>
</footer>




  