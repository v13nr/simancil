<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
		$header = array(
			'sesi' 	=>	$sesi,
			'nama_sales' => $_POST["nama_sales"],
			'tanggal' => $_POST["tanggal"]

		);
		
		$db->insert ("ritase_barang", $header);
		
		for($i=0;$i<$banyaknya; $i++){
			$data = array(
				'sesi'		 => $sesi,
				'nama_sales' => $_POST["nama_sales"],
				'kd_barang'	 => $key[$i],
				'nama_barang'	=> $namabrg[$i]
			);

			$id = $db->insert ("ritase_barang_detail", $data);
		}
		$strurl = "ritase.php";
		break;
	case "del_ritase" :
		$strurl = "ritase.php";
		$db->where('sesi', $_GET["sesi"]);
		$db->delete('ritase_barang_detail');
		$db->where('sesi', $_GET["sesi"]);
		$db->delete('ritase_barang');
		break;
	
	
}

@header("location: ".$strurl);
