<?php


ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "../class/MysqliDb.php";
include "konek.php";

$jenjang = $_POST["jenjang2"];
$parent = $_POST["parent"];

$data = Array (
    "parent_id" => $parent,
    "label" => $jenjang,
    "lastUpdated" => $db->now()
);
$id = $db->insert ("jenjang_produk", $data);

$respon = array(
		"sukses" => true,
		"pesan" => "Data Berhasil disimpan"
	);

echo json_encode($respon);

?>