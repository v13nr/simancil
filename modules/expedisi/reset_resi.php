<?php
	include "../../otentik_admin.php";
	include "../../config_sistem.php";
	$str1 = date('Y');
	$str2 = date('m');
	$str = $str1.$str2;
	echo date('d-m-Y H:i:s')."<br>";
	$SQL = "SELECT * FROM jurnal_srb WHERE nobukti LIKE '%".$str."%'";
	$hasil = mysql_query($SQL);
	if(mysql_num_rows($hasil)>0){
		die("Tidak Dapat Di Reset, Sudah ada Transaksi Pada Bulan Bersangkutan. ".$str."");
	} else {
		$sql = "TRUNCATE TABLE no_urut";	
		$hasil = mysql_query($sql);
		echo "Nomor Urut Telah Di Reset.";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>