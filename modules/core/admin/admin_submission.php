<?php 
session_start();
include ("../include/globalx.php");
include ("../include/otentik_admin.php");

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
	case "add_user" :
		$SQL = "INSERT INTO ml_user(id, user, pass, pass2, kelasuser, nama, status, aktif, tipe) VALUES('', '".$_POST['username']."', md5('".$_POST['password']."'), '".$_POST['password']."', '".$_POST['slKelas']."', '".$_POST['nama']."', 1, ".$_POST['status'].", '".$_POST['slTipe']."')";
		$hasil=mysql_query($SQL);
		$strurl = "index.php?mn=user";
	break;
	case "upd_user" :
		$SQL = "UPDATE ml_user SET user = '".$_POST['username']."', kelasuser = '".$_POST['slKelas']."', nama = '".$_POST['nama']."', aktif = ".$_POST['status'].", tipe = '".$_POST['slTipe']."' WHERE id = ".$_POST['id'];
		$hasil=mysql_query($SQL);
		$strurl = "index.php?mn=user";
	break;
	case "del_user" :
		$SQL = "UPDATE ml_user SET status = 0 WHERE id = ".$_GET['id'];
		$hasil=mysql_query($SQL);
		$strurl = "index.php?mn=user";
	break;
	case "upd_menu" :
		$id = $_POST[tambah];
		$banyaknya = count($id);
		for ($i=0; $i<$banyaknya; $i++) {
			$SQLc = "SELECT * FROM jo_menu_detail WHERE user_id = '".$_POST['user_id']."' AND menu_id = '".$id[$i]."'";
			$hasilc = mysql_query($SQLc);
			if (mysql_num_rows($hasilc)==0) {
				$SQL = "INSERT INTO jo_menu_detail(id, user_id, menu_id) VALUES ('', '".$_POST['user_id']."', '".$id[$i]."')";
				$hasil = mysql_query($SQL);
			}
		}
		$strurl = "index.php?mn=user";
	break;
	case "del_menu" :
		$SQL = "DELETE from jo_menu_detail WHERE user_id = '".$_GET['user_id']."' AND menu_id = '".$_GET['id']."'";
		$hasil = mysql_query($SQL);
		$strurl = "index.php?mn=user_akses&id=".$_GET['user_id']."&nama=".$_GET['nama'];
	break;
	case "add_master_menu" :
		$SQL = "INSERT INTO jo_menu(id, parent_id, title, file, modul, menu_order, status, aktif) VALUES('', '".$_POST['parent']."', '".$_POST['nama']."', '".$_POST['file']."', '".$_POST['modul']."', 0, 1, 1)";
		$hasil = mysql_query($SQL);
		$strurl = "menu_popup.php";
	break;
	case "del_master_menu" :
		$id = $_POST[tambah];
		$banyaknya = count($id);
		for ($i=0; $i<$banyaknya; $i++) {
			$SQLc = "UPDATE jo_menu SET status = 0 WHERE id = '".$id[$i]."'";
			$hasilc = mysql_query($SQLc);
		}
		$strurl = "index.php?mn=menu";
	break;
	case "upd_master_menu" :
		$SQL = "UPDATE jo_menu SET parent_id = '".$_POST['parent']."', title =  '".$_POST['nama']."',  modul =  '".$_POST['modul']."', file = '".$_POST['file']."' WHERE id = '".$_POST['id']."'";
		$hasil = mysql_query($SQL);
		$strurl = "menu_popup.php";
	break;
	
}
//echo $SQL; echo "<br>"; echo $strurl; echo "<br>"; echo $cmd; 
header("location: ".$strurl);
?>