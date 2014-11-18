<? session_start(); ?>
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
<?	
date_default_timezone_set('Asia/Shanghai');
include "../include/globalx.php"; 
include "otentik_gli.php"; 
switch($_GET['mn']) {
	case "rek" :
		include "rekening_ls.php";
		break;
	case "rekp" :
		include "rekeningp_ls.php";
		break;
	case "input_rp" :
		include "rekeningp_form.php";
		break;
	case "trans_jurnal" :
		include "jurnal_form.php";
		break;
	case "trans_jurnal_gaji" :
		include "jurnal_gaji.php";
		break;
	case "div" :
		include "divisi_ls.php";
		break;
	case "jurnal" :
		include "jurnal_ls.php";
		break;
	case "lap_jurnal" :
		include "laporan_jurnal.php";
		break;
	case "lap_bb" :
		include "laporan_bb.php";
		break;
	case "neraca" :
		include "laporan_neraca.php";
		break;
	case "rl" :
		include "cetak_rl.php";
		break;
	case "neraca99" :
		include "cetak_neraca99.php";
		break;
	case "inv" :
		include "inventaris_ls.php";
		break;
	case "input_inv" :
		include "inventaris_form.php";
		break;
	case "jurnal_memorial":
		require_once('jurnal_memorial.php');
		break;
	}
?>
</body>
</html>