<?php 
session_start();
include ("include/globalx.php");
include ("include/functions.php");
include ("otentik_produksi_nonBox.php");

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

	case "add_jenis" :
		$SQL = "INSERT INTO nas_produksi.jenis(kode, nama) VALUES ('".$_POST["kode"]."','".($_POST["nama"])."')";
		$hasil = mysql_query($SQL, $dbh_produksi);
		$strurl = "jenis_ls.php";
	break;case "add_gudang" :
		$SQL = "INSERT INTO nas_produksi.gudang(kode, nama) VALUES ('".$_POST["kode"]."','".($_POST["nama"])."')";
		$hasil = mysql_query($SQL, $dbh_produksi);
		$strurl = "gudang_ls.php";
	break;
	case "upd_jenis" :
		$SQL = "UPDATE nas_produksi.jenis set nama= '".$_POST["nama"]."' where kode = '".$_POST["kode"]."'";
		$hasil = mysql_query($SQL, $dbh_produksi);
		$strurl = "jenis_ls.php";
	case "upd_gudang" :
		$SQL = "UPDATE nas_produksi.gudang set nama= '".$_POST["nama"]."' where kode = '".$_POST["kode"]."'";
		$hasil = mysql_query($SQL, $dbh_produksi);
		$strurl = "gudang_ls.php";
	break;
	case "del_jenis" :
		$SQL = "delete from nas_produksi.jenis Where kode = '".$_GET["id"]."'";
		$hasil = mysql_query($SQL, $dbh_produksi);
		$strurl = "jenis_ls.php";
	case "del_gudang" :
		$SQL = "delete from nas_produksi.gudang Where kode = '".$_GET["id"]."'";
		$hasil = mysql_query($SQL, $dbh_produksi);
		$strurl = "gudang_ls.php";
	break;
	case "add_tk" :
		$SQL = "INSERT INTO nas_produksi.tk(kode, nama, jenis) VALUES ('".$_POST["kode"]."','".$_POST["nama"]."','".$_POST["jenis"]."')";
		$hasil = mysql_query($SQL, $dbh_produksi);
		$strurl = "../../index.php?mn=tk_ls&getmodule=".base64_encode('produksi/');
	break;
	case "add_pjadi" :
		$SQL = "INSERT INTO nas_produksi.produksi(tanggal, terima, unit) VALUES ('".baliktgl($_POST["tanggal"])."','".$_POST["terima"]."','".$_POST["unit"]."')";
		$hasil = mysql_query($SQL, $dbh_produksi);
		$strurl = "../../index.php?mn=penerimaan_jadi_ls&getmodule=".base64_encode('produksi/');
	break;
	
	case "upd_keluarjadi" :
		$SQL = "UPDATE nas_produksi.produksi SET pengeluaran = '".$_POST["keluar"]."' WHERE id = ". $_POST["id"];
		$hasil = mysql_query($SQL, $dbh_produksi);
		$strurl = "../../index.php?mn=keluar_jadi_ls&getmodule=".base64_encode('produksi/');
	break;
	case "upd_pjadi" :
		$SQL = "UPDATE nas_produksi.produksi SET tanggal = '".baliktgl($_POST["tanggal"])."', terima = '".$_POST["terima"]."', unit = '".$_POST["unit"]."' WHERE id = ". $_POST["id"];
		$hasil = mysql_query($SQL, $dbh_produksi);
		$strurl = "../../index.php?mn=penerimaan_jadi_ls&getmodule=".base64_encode('produksi/');
	break;
	case "upd_pjadi_produksi" :
		$SQL = "UPDATE nas_produksi.produksi SET produksi = '".$_POST["produksi"]."' WHERE id = ". $_POST["id"];
		$hasil = mysql_query($SQL, $dbh_produksi);
		$strurl = "../../index.php?mn=hasil_jadi_ls&getmodule=".base64_encode('produksi/');
	break;
	case "upd_produksi" :
		$SQL = "";
		$hasil = mysql_query($SQL, $dbh_produksi);
		$strurl = "produksi.php?bulan=".$_POST["bulan"];
	break;
	case "del_pjadi" :
		$SQL = "DELETE FROM nas_produksi.produksi WHERE id = ".$_GET["id"];
		$hasil = mysql_query($SQL, $dbh_produksi);
		$strurl = "../../index.php?mn=penerimaan_jadi_ls&getmodule=".base64_encode('produksi/');
	break;
	
	case "add_batangan" :
		$SQL = "INSERT INTO nas_produksi.batangan(tanggal, nama, jenis) VALUES ('".$_POST["kode"]."','".$_POST["nama"]."','".$_POST["jenis"]."')";
		$hasil = mysql_query($SQL, $dbh_produksi);
		$strurl = "../../index.php?mn=tk_ls&getmodule=".base64_encode('produksi/');
	break;
}
//echo $SQL; echo "<br>"; echo $strurl; echo "<br>"; echo $cmd; 
header("location: ".$strurl);
?>