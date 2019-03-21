<?php
session_start();

if(isset($_POST['submit'])){
$file_name = $_FILES['images']['name'];
$file_tmp =$_FILES['images']['tmp_name'];
$file_store="images/".$file_name;
$file_type= $_FILES["images"]["type"];
$file_size= $_FILES["images"]["size"];





$f_type=$_FILES['images']['type'];

if ($f_type== "image/gif" OR $f_type== "image/png" OR $f_type== "image/jpeg" OR $f_type== "image/JPEG" OR $f_type== "image/PNG" OR $f_type== "image/GIF")
{
	if (move_uploaded_file($file_tmp,$file_store)) {
echo "<h3>Image Upload Success</h3>";
$_SESSION["name"]=$_FILES['images']['name'];
header ("location:try.php");
}
     
}
else
{
    include('upload.php');
}


}
else{
var_dump($file_type);
}
?>