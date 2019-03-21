<?php
 $targetfolder = "";

 $targetfolder = $targetfolder . basename( $_FILES['images']['name']) ;
 $temp = basename( $_FILES['images']['name']);
if(move_uploaded_file($_FILES['images']['tmp_name'], $targetfolder))

 {


 }

 else {

 echo "Problem uploading file";

 }
require("class.filetotext.php");
	function  output ( $message )
	   {
		if  ( php_sapi_name ( )  ==  'cli' )
			echo ( $message ) ;
		else
			echo ( nl2br ( $message ) ) ;
	    }
	$file	=  $temp;
$docObj = new Filetotext("$file");
//$docObj = new Filetotext("test.pdf");
$return = $docObj->convertToText();


$data = file_get_contents($file);
	$array = json_decode($data, true);


	$txt = (string)$return;



$myfile = fopen("out.txt", "w") or die("Unable to open file!");
fwrite($myfile, $return);




fclose($myfile);
echo $return;

?>