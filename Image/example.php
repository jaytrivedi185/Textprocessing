<?php

include ( '../../PdfToText.phpclass' ) ;

	function  output ( $message )
	   {
		if  ( php_sapi_name ( )  ==  'cli' )
			echo ( $message ) ;
		else
			echo ( nl2br ( $message ) ) ;
	    }
	    
	$file	=  'Report' ;
	$pdf	=  new PdfToText ( "$file.pdf" ) ;

	output ( "Original file contents :\n" ) ;
	//output ( file_get_contents ( "$file.pdf" ) ) ;
	output ( "-----------------------------------------------------------\n" ) ;

	output ( "Extracted file contents :\n" ) ;
	output ( $pdf -> Text ) ;

	$txt = (string)$pdf;


	$myfile = fopen("$pdf", "w");
$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
fwrite($myfile, $pdf);
fwrite($myfile, $pdf);
fclose($myfile);

	?>