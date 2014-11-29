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
include "otentik_kepeg.php"; 
switch($_GET['mn']) {
	case "user" :
		include "master_pegawai.php";
		break;
	case "in_dept" :
		include "input_dept.php";
		break;
	case "pegawai" :
		include "input_pegawai.php";
		break;
	case "masterpeg" :
		include "master_pegawai.php";
		break;
	case "masterjab" :
		include "master_jabatan.php";
		break;
	case "masterdep" :
		include "master_departemen.php";
		break;
}
?>
</body>
</html>