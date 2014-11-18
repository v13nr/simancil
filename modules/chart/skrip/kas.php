<?php @session_start();
	include "../libchart/libchart/classes/libchart.php";

	header("Content-type: image/png");
	
	$chart = new PieChart(1000, 520);

	$dataSet = new XYDataSet();
	$dataSet->addPoint(new Point("Debet (". number_format($_SESSION["AL1-1111"]+$_SESSION["AL1-1111_rd"],0,'.',',') .")", $_SESSION["AL1-1111"]+$_SESSION["AL1-1111_rd"]));
	$dataSet->addPoint(new Point("Kredit (". number_format($_SESSION["AL1-1111_rk"],0,'.',',') .")", $_SESSION["AL1-1111_rk"]));
	$dataSet->addPoint(new Point("Saldo (". number_format($_SESSION["AL1-1111"]+$_SESSION["AL1-1111_rd"]-$_SESSION["AL1-1111_rk"]) .")", 0));
	$dataSet->addPoint(new Point("Note : (". "Untuk update grafik, akses dulu Laporan Buku Besar".")", 0));
	
	 
	$chart->setDataSet($dataSet);

	$chart->setTitle("Kondisi Kas Pada Buku Besar Aktif");
	$chart->render();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Grafik Cash Flow</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
	<img alt="Horizontal bars chart"  src="generated/demoKas.png" style="border: 1px solid gray;"/>
</body>
</html>
