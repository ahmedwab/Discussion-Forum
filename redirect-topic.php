<?php

 session_start();
$_SESSION['topicid']=$_GET['topicid'];
$_SESSION['topicname']=$_GET['topicname'];


    $url = "topic.php";
    header("Location: $url");
    exit();



 ?>
