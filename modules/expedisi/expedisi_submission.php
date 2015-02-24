<?php 
session_start();
	include "../../otentik.php";
	include "../../config_sistem.php";
	include "../../include/functions.php";


$cmd = $_POST['cmd'];
if ($cmd==""){
	$cmd = $_GET['cmd'];
}

switch ($cmd) {
	case "add_layanan" :
		$SQL = "INSERT INTO jenis_layanan SET  
		layanan='".$_POST['layanan']."',  
		satuan='".$_POST['satuan']."',  
		harga='".$_POST['harga']."'";
		$hasil=mysql_query($SQL);
		$strurl = "jenis_layanan.php";
	break;
	case "add_armada" :
		$SQL = "INSERT INTO armada SET  
		keterangan='".$_POST['layanan']."',  
		nopol='".$_POST['satuan']."',  
		sopir='".$_POST['harga']."'";
		$hasil=mysql_query($SQL);
		$strurl = "sopir.php";
	break;
	case "add_tarif" :
		$SQL = "INSERT INTO route_tarif SET  
		dari='".$_POST['layanan']."',  
		tujuan='".$_POST['satuan']."',  
		tarif='".$_POST['harga']."'";
		$hasil=mysql_query($SQL);
		$strurl = "route_tarif.php";
	break;
	case "upd_layanan" :
		$SQL = "update jenis_layanan SET  layanan='".$_POST['layanan']."',  
		satuan='".$_POST['satuan']."',  
		harga='".$_POST['harga']."'
		WHERE id=".$_POST['iddep'];
		$hasil=mysql_query($SQL);
		$strurl = "jenis_layanan.php";
	break;
	case "upd_armada" :
		$SQL = "update armada SET  keterangan='".$_POST['layanan']."',  
		nopol='".$_POST['satuan']."',  
		sopir='".$_POST['harga']."'
		WHERE id=".$_POST['iddep'];
		$hasil=mysql_query($SQL);
		$strurl = "sopir.php";
	break;
	case "upd_tarif" :
		$SQL = "update route_tarif SET  dari='".$_POST['layanan']."',  
		tujuan='".$_POST['satuan']."',  
		tarif='".$_POST['harga']."'
		WHERE id=".$_POST['iddep'];
		$hasil=mysql_query($SQL);
		$strurl = "route_tarif.php";
	break;
	case "del_expedisi" :
		$id = $_POST["tambah"];
		$banyaknya = count($id);
		for ($i=0; $i<$banyaknya; $i++) {
			$SQL = "DELETE FROM expedisi WHERE id = '".$id[$i]."'";
			$hasil = mysql_query($SQL, $dbh_jogjaide);
			$SQL = "DELETE FROM jurnal_srb WHERE expedisi_id = '".$id[$i]."'";
			$hasil = mysql_query($SQL, $dbh_jogjaide);
			//die($SQL);
		}
		$strurl = "barang_ls.php?mn=persediaan&nama=".$_POST['nama']."&kdbarang=".$_POST['kdbarang']."&group=".$_POST['group'];
	break;
	case "del_muatan" :
		$id = $_POST["tambah"];
		$banyaknya = count($id);
		for ($i=0; $i<$banyaknya; $i++) {
			$SQL = "DELETE FROM muatan WHERE notamuatan = '".$id[$i]."'";
			$hasil = mysql_query($SQL, $dbh_jogjaide);
			$SQL = "DELETE FROM muatan_detail WHERE notamuatan = '".$id[$i]."'";
			$hasil = mysql_query($SQL, $dbh_jogjaide);
			$SQL = "DELETE FROM jurnal_srb WHERE muatan_id = '".$id[$i]."'";
			$hasil = mysql_query($SQL, $dbh_jogjaide);
			//die($SQL);
		}
		$strurl = "muatan_ls.php?mn=persediaan&nama=".$_POST['nama']."&kdbarang=".$_POST['kdbarang']."&group=".$_POST['group'];
	break;
	case "del_layanan" :
		$SQL = "DELETE FROM jenis_layanan 
		WHERE id=".$_GET['id'];
		$hasil=mysql_query($SQL);
		$strurl = "jenis_layanan.php";
	break;
	case "del_armada" :
		$SQL = "DELETE FROM armada 
		WHERE id=".$_GET['id'];
		$hasil=mysql_query($SQL);
		$strurl = "sopir.php";
	break;
	case "del_tarif" :
		$SQL = "DELETE FROM route_tarif 
		WHERE id=".$_GET['id'];
		$hasil=mysql_query($SQL);
		$strurl = "route_tarif.php";
	break;
	
	
}
//echo $SQL; echo "<br>"; echo $strurl; echo "<br>"; echo $cmd; 
header("location: ".$strurl);
?>