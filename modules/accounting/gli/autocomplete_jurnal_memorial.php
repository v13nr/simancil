<?php
	require_once "../include/globalx.php";
	$cmd = $_GET['cmd'];
	if($cmd == 'autocomplete'){
		$norek = $_GET['term'];
		$rekening = array();
		$sql = mysql_query("SELECT norek FROM rekening WHERE norek LIKE '%$norek%' AND RIGHT(norek, 3) <> '000' ORDER BY norek LIMIT 0,10");
		while($data = mysql_fetch_array($sql)){
			array_push($rekening, $data['norek']);
		}
	}else if($cmd == 'finish'){
		$norek = $_GET['norek'];
		$sql = mysql_query("SELECT namarek, tipe FROM rekening WHERE norek = '$norek'");
		$rekening = mysql_fetch_array($sql);
	}
	echo json_encode($rekening);		
?>