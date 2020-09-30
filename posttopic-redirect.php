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

 $topicid=$_GET['topicid'];
 $topicname=$_GET['topicname'];
 if(isset($_POST["insert"]))
  {
       $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
       $posttext=$_POST['textbox'];
       $postusername=$accountusername;
       $query = "INSERT INTO TOPIC (username, textbox,topicimage,tid,ttitle)
       VALUES ( '$postusername', '$posttext','$file','$topicid','$topicname')";

       if(mysqli_query($connect, $query))
       {
            echo '<script>alert("Image Inserted into Database")</script>';
       }
  }

exit(header('Location: main.php'));
$conn->close();

?>
