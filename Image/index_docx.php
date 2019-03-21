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
	
	$file	=  $temp;
$docObj = new Filetotext("$file");
//$docObj = new Filetotext("test.pdf");
$return = $docObj->convertToText();


$data = file_get_contents($file);
	$array = json_decode($data, true);


	$txt = (string)$return;



$myfile = fopen("out.txt", "w") or die("Unable to open file!");
fwrite($myfile, $return);

include('h.php');


$search = 'PURCHASE';
$search1 = 'INVOICE';
$lines = file('out.txt');
// Store true when the text is found
$found = false; 
foreach($lines as $line)
{
  if(strpos($line, $search) !== false)
  {
    $found = true;
    echo $line.'<br>';

$input = array(
	"Doctype" => $search,
	"Orderingcompany"=> "",
	"Suppliercompany" => "",
	"shipto" => "",
	"ponum" => "",
	"Podate" => "",
	"totalamount" => "",
	"currency" => ""
);

$data_array[]=$input;
$data_array=json_encode($data_array, JSON_PRETTY_PRINT);
file_put_contents('PO.json', $data_array);
}
}

// If the text was not found, show a message
if(!$found)
{
  echo 'INVOICE \\n';
  $input = array(
	"Doctype" => $search1,
	"Suppliercompany"=> "",
	"billto" => "",
	"shipto" => "",
	"invoicenum" => "",
	"ponum" => "",
	"invoicedate" => "",
	"totalamount" => "",
	"currency" => ""
);

$data_array[]=$input;
$data_array=json_encode($data_array, JSON_PRETTY_PRINT);
file_put_contents('invoice.json', $data_array);
}



fclose($myfile);


?>