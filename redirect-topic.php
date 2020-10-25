<?php

 session_start();
$_SESSION['topicid']=$_GET['topicid'];
$_SESSION['topicname']=$_GET['topicname'];
$date=$_GET['date'];


    $url = "topic.php";
    header("Location: $url");
    exit();



 ?>
