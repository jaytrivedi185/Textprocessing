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



	include ( 'PdfToText.phpclass' ) ;

	function  output ( $message )
	   {
		if  ( php_sapi_name ( )  ==  'cli' )
			echo ( $message ) ;
		else
			echo ( nl2br ( $message ) ) ;
	    }
	    
	$file	=  $temp;
	$pdf	=  new PdfToText ( "$file" ) ;

	$data = file_get_contents($file);
	$array = json_decode($data, true);


	$txt = (string)$pdf;



$myfile = fopen("out.txt", "w") or die("Unable to open file!");
fwrite($myfile, $pdf);

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
       echo $line;
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
  echo 'INVOICE';
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
include('h.php');
?>