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
			$data = array(
				'sesi'		 => generateRandomString(),
				'nama_sales' => 'ari',
				'kd_barang'	 => 'ad',
				'nama_barang'	=> 'dddd'
			);

			$id = $db->insert ("ritase_barang", $data);
}
