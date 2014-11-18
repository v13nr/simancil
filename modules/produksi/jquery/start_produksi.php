<?php
include ("globalx.php");	
	
	$purchase_date_timestamp = strtotime('2009-12-31');
	for ($i=1;$i<= 2000 ;$i++) {
			$purchase_date_1year = strtotime("+$i day", $purchase_date_timestamp);
			$jtempo = date("Y-m-d", $purchase_date_1year);
			$sql = "insert into produksi(tanggal) values('".$jtempo."')";
			$hasil = mysql_query($sql);
			
	}
?>