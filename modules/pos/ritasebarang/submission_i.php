<?php
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */

$cmd = $_POST['cmd'];
if ($cmd==""){
	$cmd = $_GET['cmd'];
}

date_default_timezone_set('Asia/Shanghai');
		
include "../../../config_sistem_i.php";

function generateRandomString($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

switch ($cmd) {
	case "add_ritase" :
		$key = $_POST["kodebrg"];
		$namabrg = $_POST["namabrg"];
		$banyaknya = count($key);
		$sesi = generateRandomString();
		for($i=0;$i<$banyaknya; $i++){
			$data = array(
				'sesi'		 => $sesi,
				'nama_sales' => 'ari',
				'kd_barang'	 => $key[$i],
				'nama_barang'	=> $namabrg[$i]
			);

			$id = $db->insert ("ritase_barang", $data);
		}
		$strurl = "ritase.php";
}

@header("location: ".$strurl);
