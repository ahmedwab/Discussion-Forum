<?php
session_start();
$servername = "localhost";
$username = "id14970710_admin";
$password = "M3e>ah-cdPUz?ByK";
$databaseName = "id14970710_discussionforum";

 $connect = new mysqli($servername,$username,$password,$databaseName);

 if ($_SESSION["user"] == NULL)
 {
    header('Location: index.php');
 }
 $accountusername = $_SESSION["user"];
 $topicid= $_SESSION['topicid'];
 $topicname= $_SESSION['topicname'];

 $query = "SELECT image FROM ACCOUNTS WHERE username='$accountusername' LIMIT 1";
 $result = mysqli_query($connect, $query);

$profileimage=NULL;
 while($row = mysqli_fetch_array($result))
 {
   $profileimage=$row['image'];
 }

echo "<script> document.title='$topicname'</script>";
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



if(isset($_POST["insert"]))
 {
      $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
      $posttext=$_POST['textbox'];

      $postusername=$accountusername;


      $query = "INSERT INTO TOPIC (username, textbox,topicimage,tid,ttitle)
      VALUES ( '$postusername', '$posttext','$file','$topicid','$topicname')";

      if(mysqli_query($connect, $query))
      {
           echo '';
      }
 }
 ?>
 <!DOCTYPE html>
 <html>
      <head>
           <title>Topic</title>
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
           <link rel="stylesheet" href="stylesheets/topic-style.css">
           <script src="script.js"></script>
      </head>
      <body>
           <br /><br />
           <div class="container">

             <form method="post" enctype="multipart/form-data" id='post-form'>

                 Write something below and/or upload image<br>
                 <div contentEditable="true" id="input-section">
                 <p id='imageposted'></p>

                 <textarea  id='input-item' name="textbox" placeholder="New post..."></textarea>

               </div>
               <table id='upload-section'>
                 <tr>
                   <td class='upload-item' id="image-upload">
                     <div class="image-upload">
                       <label for="file-input">
                         <img src="images/upload-black.png"/>
                       </label>

                       <input id="file-input" type="file" name="image" id="image" multiple onchange="showname()" />
                     </div>
                   </td>

                   <td class='upload-item'>
                  <input type="submit" name="insert" id="submit-post" value="Post" />
                  </td>
                  </tr>
               </table>
             </form>
                <br />
                <br />
                <div class="posts-section">

                <?php
                $topicid=$_SESSION['topicid'];
                $query = "SELECT lower(username),username,textbox,topicimage,date,tid FROM TOPIC WHERE tid='$topicid' ORDER BY DATE DESC ";
                $result = mysqli_query($connect, $query);

              if($result-> num_rows>0){
                while($row = mysqli_fetch_array($result))
                {
                  echo "<div id='userpost'>";
                  echo "<div class='profile-tab'>";
                  $profileuser=$row['username'];

                    echo "<a href='profile.php?user=$profileuser'>" . '<img  src="images/default.png" width="50px" height="50px"/> '.$row['username'] ."</a>" . "<p class='post-date'>".$row['date']."</p> <br>";
                    echo "</div><br>";
                    echo  $row['textbox'] . '<br>';
                    if(!empty($row['topicimage'])){
                        echo '<img  class="postimg" src="data:image/jpeg;base64,'.base64_encode( $row['topicimage'] ).'"/><br>';
                    }



                  echo "</div>";
                }

              }
              else {
                echo "Be the first person to post";
              }
                ?>
           </div>
      </body>
 </html>
