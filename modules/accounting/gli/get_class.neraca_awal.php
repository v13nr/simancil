<?php 

	/*
		lisensi @Nanang Rustianto http://facebook.com/nanang.rustianto 
	*/

	include ("class/class.neraca_awal.php");

	$nawal = new neraca_awal();
	$ok = $nawal->hitung_saldo_awal();
	//$jeson = $nawal->getJeson();
	$result = new stdClass(); 
    	$result->success = ($ok)?true:false; 
    	$result->pesan = ($ok) ? 'Selamat, data terkirim karena BALANCE.' : 'Maaf,  data tidak terekam dikarenakan TIDAK BALANCE !'; 
		echo json_encode($result); 
?>