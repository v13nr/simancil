<?php 
   $handler->loadModel("rekanan_m"); 
  $people = new Person;
  
  $rs = $people->doReport($_POST); 
  
  switch($_POST['mode']){
	case "pdf" :
		$include_file = "pdf.php";
		break;
	case "xls" :
		$include_file = "xls.php";
		break;
	case "html" :
		$include_file = "html.php";
		break;
			
  }
  
 // $include_file = ($_POST['mode']=='pdf')?'pdf.php':'xls.php'; 
  
  include 'rekanan/'.$include_file;
  
  
?>