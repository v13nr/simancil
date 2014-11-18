<?php

	//Table Base Classs
	require_once("class.fpdf_table.php");
	
	//Class Extention for header and footer	
	require_once("header_footer.inc");
	
	//Table Defintion File
	require_once("table_def.inc");
	
	
	$pdf = new pdf_usage('L');		
	$pdf->Open();
	$pdf->SetAutoPageBreak(true, 20);
    $pdf->SetMargins(4, 20, 20);
	$pdf->AddPage();
	$pdf->AliasNbPages(); 

	$columns = 7; //five columns

	//Initialize the table class
	$pdf->tbInitialize($columns, true, true);
	
	//set the Table Type
	$pdf->tbSetTableType($table_default_table_type);
	
	//Table Header
	for($i=0; $i<$columns; $i++) {
		$header_type1[$i] = $table_default_header_type;
	}

	$header_type1[0]['WIDTH'] = 10;
	$header_type1[1]['WIDTH'] = 25;
	$header_type1[2]['WIDTH'] = 50;
	$header_type1[3]['WIDTH'] = 30;
	$header_type1[4]['WIDTH'] = 30;
	$header_type1[5]['WIDTH'] = 75;
	$header_type1[6]['WIDTH'] = 30;
	
	$fsize = 10;
	$header_type1[0]['TEXT'] = "No.";
	$header_type1[0]['T_SIZE'] = $fsize;
	$header_type1[1]['TEXT'] = "Kode Anggota";
	$header_type1[1]['T_SIZE'] = $fsize;
	$header_type1[2]['TEXT'] = "Nama";
	$header_type1[2]['T_SIZE'] = $fsize;
	$header_type1[3]['TEXT'] = "Tgl. Lahir";
	$header_type1[3]['T_SIZE'] = $fsize;
	$header_type1[4]['TEXT'] = "No. Identitas";
	$header_type1[4]['T_SIZE'] = $fsize;
	$header_type1[5]['TEXT'] = "Alamat";
	$header_type1[5]['T_SIZE'] = $fsize;
	$header_type1[6]['TEXT'] = "No. Telpon";
	$header_type1[6]['T_SIZE'] = $fsize;
	
	$aHeaderArray = array(
		$header_type1
	);	

	//set the Table Header
	$pdf->tbSetHeaderType($aHeaderArray, true);
	
	//Draw the Header
	$pdf->tbDrawHeader();

	//Table Data Settings
	$data_type = Array();//reset the array
	for ($i=0; $i<$columns; $i++) $data_type[$i] = $table_default_data_type;

	$pdf->tbSetDataType($data_type);
	

$host ="localhost";
    $user="root";
    $password="999";
    $database="jopustaka";
    mysql_connect($host,$user,$password) or die("Koneksi server gagal");
    mysql_select_db($database);
	
	
$sql = mysql_query("SELECT * FROM anggota WHERE kode <> '' ORDER BY nama ASC");

while ($daftar = mysql_fetch_array($sql))
{	
		//$data = Array();
		$data[0]['TEXT'] = ++$no;
		$data[0]['T_SIZE'] = $fsize;
		$data[1]['TEXT'] = $daftar[kode];
		$data[1]['T_SIZE'] = $fsize;
		$data[2]['TEXT'] = $daftar[nama];
		$data[2]['T_ALIGN'] = 'L';
		$data[2]['T_SIZE'] = $fsize;
		$data[3]['TEXT'] = substr($daftar[tgllahir],0,10);
		$data[3]['T_SIZE'] = $fsize;
		$data[4]['TEXT'] = $daftar[identitas];
		$data[4]['T_ALIGN'] = 'L';
		$data[4]['T_SIZE'] = $fsize;
		$data[5]['TEXT'] = $daftar[alamat];
		$data[5]['T_ALIGN'] = 'L';
		$data[5]['T_SIZE'] = $fsize;
		$data[6]['TEXT'] = $daftar[telpon];
		$data[6]['T_ALIGN'] = 'L';
		$data[6]['T_SIZE'] = $fsize;
		
		$pdf->tbDrawData($data);
	
}	
	//output the table data to the pdf
	$pdf->tbOuputData();
	
	//draw the Table Border
	$pdf->tbDrawBorder();	

	$pdf->Output();

?>