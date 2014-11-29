<?php  session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>

<style type="text/css">
<!--
body {
	background-image: url(../images/back.png);
	font-family: "Segoe UI";
	font-size: 12px;
}
table.x1 {
	border-collapse: collapse;
}
table.x1 td {
	font-size: 11pt; 
	background-color: #F0F0F0;
	padding-left: 8px;
	padding-right: 8px;
	padding-top: 2px;
	padding-bottom: 2px;
	border: 1px solid #cccccc;
}
-->
</style>
</head>
<body>
<?php 	
date_default_timezone_set('Asia/Shanghai');
include "../include/globalx.php"; 
include "otentik_inv.php"; 
switch($_GET['mn']) {
	case "sp" :
		include "supplier_ls.php";
		break;
	case "input_supp" :
		include "supplier_form.php";
		break;
	case "kons" :
		include "konsumen_ls.php";
		break;
	case "input_kons" :
		include "konsumen_form.php";
		break;
	case "input_persediaan" :
		include "persediaan_form.php";
		break;
	case "input_persediaanRumah" :
		include "persediaanRumah_form.php";
		break;
	case "persediaan" :
		include "stok_ls.php";
		break;
	case "pembelian" :
		include "pembelian.php";
		break;
	case "penjualan" :
		include "penjualan.php";
		break;
	case "mutasi" :
		include "mutasi_ls.php";
		break;
	case "setting" :
		include "setting.php";
		break;
	case "hutang" :
		include "hutang_ls.php";
		break;
	case "piutang" :
		include "piutang_ls.php";
		break;
	case "lap_stok_br" :
		include "laporan_stok_per_barang.php";
		break;
	case "pb" :
		include "hitung_pb.php";
		break;
	case "cetak_pj" :
		include "cetak_penjualan.php";
		break;
        case "bj" :
		include "bahanjadi_ls.php";
		break;
        case "input_bj" :
		include "bahanjadi_form.php";
		break;
		
	}
?>
</body>
</html>