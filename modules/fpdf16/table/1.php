<?

	//Table Base Classs
	require_once("class.fpdf_table.php");
	
	//Class Extention for header and footer	
	require_once("header_footer.inc");
	
	//Table Defintion File
	require_once("table_def.inc");
	
	$pdf = new pdf_usage('L');		
	$pdf->Open();
	$pdf->SetAutoPageBreak(true, 20);
    $pdf->SetMargins(20, 20, 20);
	$pdf->AddPage();
	$pdf->AliasNbPages(); 

	$columns = 5; //five columns
	
	//Initialize the table class
	$pdf->tbInitialize($columns, true, true);
	
	//set the Table Type
	$pdf->tbSetTableType($table_default_table_type);
	
	//Table Data Settings
	$data_type = Array();//reset the array
	for ($i=0; $i<$columns; $i++) $data_type[$i] = $table_default_data_type;

	$pdf->tbSetDataType($data_type);
	
	$data = Array();
		$data[0]['TEXT'] = "Row No - $j";
		$data[0]['T_SIZE'] = $fsize;
		$data[1]['TEXT'] = "Test Text Column 1- $j";
		$data[1]['T_SIZE'] = 13 - $fsize;
		$data[2]['TEXT'] = "Test Text Column 2- $j";
		$data[3]['TEXT'] = "Longer text, this will split sometimes...";
		$data[3]['T_SIZE'] = 15 - $fsize;
		$data[4]['TEXT'] = "Short 4- $j";
		$data[4]['T_SIZE'] = 7;
	
	$pdf->tbDrawData($data);
	
	//output the table data to the pdf
	$pdf->tbOuputData();
	
	//draw the Table Border
	$pdf->tbDrawBorder();
	
	$pdf->Output();

?>