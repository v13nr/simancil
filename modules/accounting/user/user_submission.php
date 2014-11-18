<?
session_start();
include ("../include/globalx.php");
include ("../otentik.php");

$cmd = $_POST['cmd'];
if ($cmd==""){
	$cmd = $_GET['cmd'];
}

		date_default_timezone_set('Asia/Shanghai');
		$wkt_disimpan = Date("Y-m-d H:i:s");
		$xbulan = $_REQUEST['slBulan'];
		$xtanggal = $_REQUEST['slTanggal'];
		$TanggalLahir=$_REQUEST['slTahun']."-".$xbulan."-".$xtanggal." 00:00:00"; 
		
switch ($cmd) {
	case "upd_passwd" :
		$SQL = "UPDATE ml_user SET pass = md5('".$_POST['passwd']."'), pass2 = '".$_POST['passwd']."' WHERE id = ".$_SESSION["sess_user_id"];
		$hasil=mysql_query($SQL);
		$strurl = "index.php?mn=passwd&update=y";
	break;
}
//echo $SQL; echo "<br>"; echo $strurl; echo "<br>"; echo $cmd; 
header("location: ".$strurl);
?>