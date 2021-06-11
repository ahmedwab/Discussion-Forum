<html>
        <head>
                <title>Upload an image</title>
        </head>
        <body>
    <?php

    include("config.php");
    session_start();
    error_reporting(0);
     
     $image = $_FILES['Image']['tmp_name'];

     $id = 2;

     echo $_POST['submit'];
     if($_POST['submit']) {

 
      echo "dd";

     }





  
        
    ?>
            <form action="" method="POST" enctype="multipart/form-data">
                File:
                <input type="file" name="Image">
                <input type="submit" value="Upload">
            </form>
        </body>
    </html>