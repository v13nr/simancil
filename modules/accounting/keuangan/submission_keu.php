<?php 
session_start();
include ("../include/globalx.php");
include ("../include/functions.php");
include ("otentik_keu.php");

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
	case "upd_inv" :
		$nilai = ereg_replace("[^0-9]", "", $_POST['nilai']);
		$susut = ereg_replace("[^0-9]", "", $_POST['susut']);
		$SQL = "UPDATE $database.aktiva SET tgl = '".baliktgl($_POST['tgl'])."', nama = '".$_POST['nama']."', nilai = '".$nilai."', bagi = '".$_POST['bagi']."', susut = '".$susut."', tgl_akhir = '".baliktgl($_POST['tgl_akhir'])."', rekdebet = '".$_POST['rekdebet']."', rekkredit = '".$_POST['rekkredit']."' WHERE id = '".$_POST['id']."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "index.php?mn=inv";
	break;
	case "add_opname" :
		$SQL = "INSERT INTO opname(id, tanggal, keterangan) VALUES (
		'',
		'". baliktgl($_POST["tanggal"]) ."',
		'". $_POST["keterangan"] ."'
		)";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "opname_setup.php";
	break;
	case "add_opname_ket" :
		$SQL = "INSERT INTO opname_detail(id, opname_id, parent_id, keterangan) VALUES (
		'',
		'". $_POST["id"] ."',
		0,
		'". $_POST["opname_ket"] ."'
		)";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "opname_detail.php?id=".$_POST["id"]."&tanggal=".$_POST["tanggal"]."&keterangan=".$_POST["keterangan"];
	break;
	case "add_opname_rinci" :
		$SQL = "INSERT INTO opname_detail(id, opname_id, parent_id, keterangan, harikerja, upah) VALUES (
		'',
		'". $_POST["id"] ."',
		'". $_POST["parent_id"] ."',
		'". $_POST["keterangan_child"] ."',
		'". $_POST["harikerja"] ."',
		'". $_POST["upah"] ."'
		)";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "opname_detail.php?id=".$_POST["id"]."&tanggal=".$_POST["tanggal"]."&keterangan=".$_POST["keterangan"];
	break;
	case "del_opname_parent" :
		$SQL = "DELETE FROM opname_detail WHERE id = '". $_GET["parent_id"] ."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$SQL = "DELETE FROM opname_detail WHERE parent_id = '". $_GET["parent_id"] ."' and opname_id = '". $_GET["id"] ."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "opname_detail.php?id=".$_GET["id"]."&tanggal=".$_GET["tanggal"]."&keterangan=".$_GET["keterangan"];
	break;
	case "del_opname_rinci" :
		$SQL = "DELETE FROM opname_detail WHERE id = '". $_GET["del_id"] ."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "opname_detail.php?id=".$_GET["id"]."&tanggal=".$_GET["tanggal"]."&keterangan=".$_GET["keterangan"];
	break;
	case "add_kpr_bri" :
		$SQL = "INSERT INTO kpr_bri VALUES(NULL, '".$_POST['kode']."', '".$_POST['nama']."', '".$_POST['blok']."', '".$_POST['tipe']."',
		'".$_POST['kpr']."', '".baliktgl($_POST['tanggal75'])."', '".$_POST['cair75']."', '".baliktgl($_POST['tanggal60'])."',
		'".$_POST['cair60']."', '".baliktgl($_POST['tanggal40'])."', '".$_POST['cair40']."', '".baliktgl($_POST['tanggal20'])."',
		'".$_POST['cair20']."', '".baliktgl($_POST['tanggal15'])."', '".$_POST['cair15']."', '".$_POST['totalcair']."',
		'".$_POST['jumlah_terhold_1']."', '".$_POST['persen_terhold_1']."', '".$_POST['jumlah_terhold_2']."',
		'".$_POST['persen_terhold_2']."', '".baliktgl($_POST['tanggal_akad'])."')";
		$hasil = mysql_query($SQL, $dbh_jogjaide) or die(mysql_error());
		$strurl = "kpr_bri.php";
	break;
	case "upd_kpr_bri" :
		$SQL = "UPDATE kpr_bri SET nama='".$_POST['nama']."', blok='".$_POST['blok']."', tipe='".$_POST['tipe']."',
		kpr='".$_POST['kpr']."', tanggal75='".baliktgl($_POST['tanggal75'])."', cair75='".$_POST['cair75']."',
		tanggal60='".baliktgl($_POST['tanggal60'])."', cair60='".$_POST['cair60']."', tanggal40='".baliktgl($_POST['tanggal40'])."',
		cair40='".$_POST['cair40']."', tanggal20='".baliktgl($_POST['tanggal20'])."', cair20='".$_POST['cair20']."',
		tanggal15='".baliktgl($_POST['tanggal15'])."', cair15='".$_POST['cair15']."', totalcair='".$_POST['totalcair']."',
		jumlah_terhold_1='".$_POST['jumlah_terhold_1']."', persen_terhold_1='".$_POST['persen_terhold_1']."',
		jumlah_terhold_2='".$_POST['jumlah_terhold_2']."', persen_terhold_2='".$_POST['persen_terhold_2']."',
		tanggal_akad='".baliktgl($_POST['tanggal_akad'])."' WHERE id = '". $_POST["id"] ."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide) or die(mysql_error());
		$strurl = "kpr_bri.php";
	break;
	case "del_kpr_bri" :
		$SQL = "DELETE FROM kpr_bri WHERE id = '". $_GET["id"] ."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "kpr_bri.php";
	break;
	case "add_kpr_mandirisy" :
		$SQL = "INSERT INTO kpr_mandirisy VALUES(NULL, '".$_POST['kode']."', '".$_POST['nama']."', '".$_POST['blok']."', '".$_POST['tipe']."',
		'".$_POST['kpr']."', '".baliktgl($_POST['tanggal70'])."', '".$_POST['cair70']."', '".baliktgl($_POST['tanggal20'])."',
		'".$_POST['cair20']."', '".baliktgl($_POST['tanggal10'])."', '".$_POST['cair10']."',  '".$_POST['totalcair']."',
		'".$_POST['sisa']."', '".$_POST['terhold10']."', '".baliktgl($_POST['tanggal_akad'])."')";
		$hasil = mysql_query($SQL, $dbh_jogjaide) or die(mysql_error());
		$strurl = "kpr_mandiri_syariah.php";
	break;
	case "upd_kpr_mandirisy" :
		$SQL = "UPDATE kpr_mandirisy SET nama='".$_POST['nama']."', blok='".$_POST['blok']."', tipe='".$_POST['tipe']."',
		kpr='".$_POST['kpr']."', tanggal70='".baliktgl($_POST['tanggal70'])."', cair70='".$_POST['cair70']."',
		tanggal20='".baliktgl($_POST['tanggal20'])."', cair20='".$_POST['cair20']."', tanggal10='".baliktgl($_POST['tanggal10'])."',
		cair10='".$_POST['cair10']."', totalcair='".$_POST['totalcair']."',
		sisa='".$_POST['sisa']."', terhold10='".$_POST['terhold10']."',
		tanggal_akad='".baliktgl($_POST['tanggal_akad'])."' WHERE id = '". $_POST["id"] ."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide) or die(mysql_error());
		$strurl = "kpr_mandiri_syariah.php";
	break;
	case "del_kpr_mandirisy" :
		$SQL = "DELETE FROM kpr_mandirisy WHERE id = '". $_GET["id"] ."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "kpr_mandiri_syariah.php";
	break;	
	
	case "add_kpr_btnsy" :
		$SQL = "INSERT INTO kpr_btnsy VALUES(NULL, '".$_POST['kode']."', '".$_POST['nama']."', '".$_POST['blok']."', '".$_POST['tipe']."',
		'".$_POST['kpr']."', '".baliktgl($_POST['tanggal_t1'])."', '".$_POST['cair_t1']."', '".baliktgl($_POST['tanggal_t2'])."',
		'".$_POST['cair_t2']."', '".baliktgl($_POST['tanggal_t3'])."', '".$_POST['cair_t3']."', '".$_POST['totalcair']."',
		'".$_POST['persen5']."', '".$_POST['total']."',
		'".baliktgl($_POST['tanggal_akad'])."')";
		$hasil = mysql_query($SQL, $dbh_jogjaide) or die(mysql_error());
		$strurl = "kpr_btn_syariah.php";
	break;
	case "upd_kpr_btnsy" :
		$SQL = "UPDATE kpr_btnsy SET nama='".$_POST['nama']."', blok='".$_POST['blok']."', tipe='".$_POST['tipe']."',
		kpr='".$_POST['kpr']."', tanggal_t1='".baliktgl($_POST['tanggal_t1'])."', cair_t1='".$_POST['cair_t1']."',
		tanggal_t2='".baliktgl($_POST['tanggal_t2'])."', cair_t2='".$_POST['cair_t2']."', tanggal_t3='".baliktgl($_POST['tanggal_t3'])."', cair_t3='".$_POST['cair_t3']."', totalcair='".$_POST['totalcair']."',
		persen5='".$_POST['persen5']."', total='".$_POST['total']."',
		tanggal_akad='".baliktgl($_POST['tanggal_akad'])."' WHERE id = '". $_POST["id"] ."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide) or die(mysql_error());
		$strurl = "kpr_btn_syariah.php";
	break;
	case "del_kpr_btnsy" :
		$SQL = "DELETE FROM kpr_btnsy WHERE id = '". $_GET["id"] ."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "kpr_btn_syariah.php";
	break;	
	case "add_kpr_bni" :
		$SQL = "INSERT INTO kpr_bni VALUES(NULL, '".$_POST['kode']."', '".$_POST['nama']."', '".$_POST['blok']."', '".$_POST['tipe']."',
		'".$_POST['kpr']."', '".baliktgl($_POST['tanggal_t1'])."', '".$_POST['cair_t1']."', '".baliktgl($_POST['tanggal_t2'])."',
		'".$_POST['cair_t2']."', '".baliktgl($_POST['tanggal_t3'])."', '".$_POST['cair_t3']."', '".$_POST['totalcair']."',
		'".$_POST['terhold']."', '".$_POST['terhold5']."',
		'".baliktgl($_POST['tanggal_akad'])."')";
		$hasil = mysql_query($SQL, $dbh_jogjaide) or die(mysql_error());
		$strurl = "kpr_bni.php";
	break;
	case "upd_kpr_bni" :
		$SQL = "UPDATE kpr_bni SET nama='".$_POST['nama']."', blok='".$_POST['blok']."', tipe='".$_POST['tipe']."',
		kpr='".$_POST['kpr']."', tanggal_t1='".baliktgl($_POST['tanggal_t1'])."', cair_t1='".$_POST['cair_t1']."',
		tanggal_t2='".baliktgl($_POST['tanggal_t2'])."', cair_t2='".$_POST['cair_t2']."', tanggal_t3='".baliktgl($_POST['tanggal_t3'])."', cair_t3='".$_POST['cair_t3']."', totalcair='".$_POST['totalcair']."',
		terhold='".$_POST['terhold']."', terhold5='".$_POST['terhold5']."',
		tanggal_akad='".baliktgl($_POST['tanggal_akad'])."' WHERE id = '". $_POST["id"] ."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide) or die(mysql_error());
		$strurl = "kpr_bni.php";
	break;
	case "del_kpr_bni" :
		$SQL = "DELETE FROM kpr_bni WHERE id = '". $_GET["id"] ."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "kpr_bni.php";
	break;	
	case "add_kpr_bnisy" :
		$SQL = "INSERT INTO kpr_bnisy VALUES(NULL, '".$_POST['kode']."', '".$_POST['nama']."', '".$_POST['blok']."', '".$_POST['tipe']."',
		'".$_POST['kpr']."', '".baliktgl($_POST['tanggal_t1'])."', '".$_POST['cair_t1']."', '".baliktgl($_POST['tanggal_t2'])."',
		'".$_POST['cair_t2']."', '".baliktgl($_POST['tanggal_t3'])."', '".$_POST['cair_t3']."', '".$_POST['totalcair']."',
		'".$_POST['terhold']."', '".$_POST['terhold5']."',
		'".baliktgl($_POST['tanggal_akad'])."')";
		$hasil = mysql_query($SQL, $dbh_jogjaide) or die(mysql_error());
		$strurl = "kpr_bni_syariah.php";
	break;
	case "upd_kpr_bnisy" :
		$SQL = "UPDATE kpr_bnisy SET nama='".$_POST['nama']."', blok='".$_POST['blok']."', tipe='".$_POST['tipe']."',
		kpr='".$_POST['kpr']."', tanggal_t1='".baliktgl($_POST['tanggal_t1'])."', cair_t1='".$_POST['cair_t1']."',
		tanggal_t2='".baliktgl($_POST['tanggal_t2'])."', cair_t2='".$_POST['cair_t2']."', tanggal_t3='".baliktgl($_POST['tanggal_t3'])."', cair_t3='".$_POST['cair_t3']."', totalcair='".$_POST['totalcair']."',
		terhold='".$_POST['terhold']."', terhold5='".$_POST['terhold5']."',
		tanggal_akad='".baliktgl($_POST['tanggal_akad'])."' WHERE id = '". $_POST["id"] ."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide) or die(mysql_error());
		$strurl = "kpr_bni_syariah.php";
	break;
	case "del_kpr_bnisy" :
		$SQL = "DELETE FROM kpr_bnisy WHERE id = '". $_GET["id"] ."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "kpr_bni_syariah.php";
	break;	
	case "add_kpr_mandiri" :
		$SQL = "INSERT INTO kpr_mandiri VALUES(NULL, '".$_POST['kode']."', '".$_POST['nama']."', '".$_POST['blok']."', '".$_POST['tipe']."',
		'".$_POST['kpr']."', '".baliktgl($_POST['tanggal_t1'])."', '".$_POST['cair_t1']."', '".baliktgl($_POST['tanggal_t2'])."',
		'".$_POST['cair_t2']."', '".baliktgl($_POST['tanggal_t3'])."', '".$_POST['cair_t3']."', '".baliktgl($_POST['tanggal_t4'])."', '".$_POST['cair_t4']."', '".$_POST['totalcair']."',
		'".$_POST['persen5']."', '".$_POST['total']."',
		'".baliktgl($_POST['tanggal_akad'])."')";
		$hasil = mysql_query($SQL, $dbh_jogjaide) or die(mysql_error());
		$strurl = "kpr_btn_mandiri.php";
	break;
	case "upd_kpr_mandiri" :
		$SQL = "UPDATE kpr_mandiri SET nama='".$_POST['nama']."', blok='".$_POST['blok']."', tipe='".$_POST['tipe']."',
		kpr='".$_POST['kpr']."', tanggal_t1='".baliktgl($_POST['tanggal_t1'])."', cair_t1='".$_POST['cair_t1']."',
		tanggal_t2='".baliktgl($_POST['tanggal_t2'])."', cair_t2='".$_POST['cair_t2']."', tanggal_t3='".baliktgl($_POST['tanggal_t3'])."', cair_t3='".$_POST['cair_t3']."',tanggal_t4='".baliktgl($_POST['tanggal_t4'])."', cair_t4='".$_POST['cair_t4']."', totalcair='".$_POST['totalcair']."',
		persen10='".$_POST['persen10']."', sisa='".$_POST['sisa']."',
		tanggal_akad='".baliktgl($_POST['tanggal_akad'])."' WHERE id = '". $_POST["id"] ."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide) or die(mysql_error());
		$strurl = "kpr_btn_mandiri.php";
	break;
	case "del_kpr_mandiri" :
		$SQL = "DELETE FROM kpr_mandiri WHERE id = '". $_GET["id"] ."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "kpr_btn_mandiri.php";
	break;
	case "add_total_dh":
		$SQL = "INSERT INTO total_dh VALUES(NULL, '".$_POST['namaBank']."', '".$_POST['totalKpr']."',
		'".$_POST['totalCair']."', '".$_POST['tahan5']."', '".$_POST['tahan10']."')";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "total_dh.php";
	break;

	case "upd_total_dh":
		$SQL = "UPDATE total_dh SET namaBank='".$_POST['namaBank']."', totalKpr='".$_POST['totalKpr']."', totalCair='".$_POST['totalCair']."',
		tahan5='".$_POST['tahan5']."', tahan10='".$_POST['tahan10']."' WHERE id = '".$_POST['id']."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide) or die(mysql_error());
		$strurl = "total_dh.php";
	break;
	case "del_total_dh":
		$SQL = "DELETE FROM total_dh WHERE id = '". $_GET["id"] ."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "total_dh.php";
	break;		
}
//echo $SQL; echo "<br>"; echo $strurl; echo "<br>"; echo $cmd; 
header("location: ".$strurl);
?>