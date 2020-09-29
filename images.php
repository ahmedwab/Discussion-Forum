<?php
session_start();
error_reporting(0);
$servername = "localhost";
$username = "id14970710_admin";
$password = "M3e>ah-cdPUz?ByK";
$databaseName = "id14970710_discussionforum";




$conn = new mysqli($servername,$username,$password,$databaseName);

$sql = "SELECT * FROM IMAGES" ;
$result = $conn->query($sql);

if ($result -> num_rows > 0){
   while($row = $result->fetch_assoc()){
     echo $row['image_id'];
     echo '<img src="data:image/jpeg;base64,'.base64_encode($row['IMAGES'] ).'" height="200" width="200" class="img-thumnail" />';

   }
   header('Location: main.php');

 }
else{
  echo "no images";
}





$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
 <title>Images</title>


</head>
<body>
  <form action="/action_page.php">
  <label for="img">Select image:</label>
  <input type="file" id="img" name="img" accept="image/*">
  <input type="submit">
</form>




</body>
</html>
