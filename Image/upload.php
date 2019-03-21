<?php

if(isset($_FILES['image'])){
$file_name = $_FILES['image']['name'];
$file_tmp =$_FILES['image']['tmp_name'];
$file_store="images/".$file_name;
move_uploaded_file($file_tmp, $file_store);

shell_exec('"C:\\Program Files (x86)\\Tesseract-OCR\\tesseract" "C:\\xampp\\htdocs\\Final\\image\\'.$file_name.'" out');

$search = 'PURCHASE';
$search1 = 'INVOICE';
$lines = file('out.txt');

if($line="PURCHASE" || $line="purchase" || $line="PURCHASE ORDER" || $line="PO" || $line="PO.NO" || $line="PO DATE")
{
	if ($line="purchase" || $line="PURCHASE ORDER" || $line="PO" || $line="PO.NO" || $line="PO DATE") {

		if ($line="PURCHASE ORDER" || $line="PO DATE" || $line="PO" || $line="PO.NO" ) {
			
			if($line="PO" || $line="PO.NO" || $line="PO.DATE") {

				if ($line="PO.NO" || $line="PO.DATE") {

					if ($line="PO DATE") {
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
					}
				}

			}
		}
	}
}   


else{
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
}
include('h.php');
?>