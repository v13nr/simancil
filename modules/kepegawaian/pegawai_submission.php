<?
session_start();
include ("../../config_sistem.php");
include ("include/functions.php");
include ("otentik_kepeg.php");


$cmd = $_POST['cmd'];
if ($cmd==""){
	$cmd = $_GET['cmd'];
}

switch ($cmd) {
	case "add_pegawai" :
		$SQL = "INSERT INTO mastpegawai(idno, noinduk, nama, alamat, notelp, jkel, tgllahir, jabatan, departemen, mulkerja, ri_pendidikan, ri_pekerjaan, ri_keluarga, gaji_tipe, finger, status) VALUES('', '".$_POST['noinduk']."', '".$_POST['nama']."', '".$_POST['alamat']."', '".$_POST['notelp']."', '".$_POST['kelamin']."', '".baliktgl($_POST['tgl_lahir'])."', '".$_POST['slJabatan']."', '".$_POST['slDepartemen']."', '".baliktgl($_POST['tgl_mkerja'])."', '".$_POST['pendidikan']."', '".$_POST['pekerjaan']."', '".$_POST['keluarga']."', '".$_POST['gaji_tipe']."', '".$_POST['finger']."', 1)";
		$hasil=mysql_query($SQL);
		$strurl = "master_pegawai.php";
	break;
	case "add_jab" :
		$SQL = "INSERT INTO mastjabatan(idjab, namajab, status) VALUES('', '".$_POST['jabatan']."', 1)";
		$hasil=mysql_query($SQL) or die(mysql_error());
		$strurl = "index.php?mn=masterjab";
	break;
	case "add_dept";
		$SQL = "INSERT INTO master_dept(iddep, namadept, status) VALUES('', '".$_POST['departemen']."', 1)";
		$hasil=mysql_query($SQL);
		$strurl = "index.php?mn=masterdep";
	break;
	case "update_jab" :
		$SQL = "UPDATE mastjabatan SET namajab='".$_POST['namajab']."' WHERE idjab=".$_POST['idjab'];
		$hasil=mysql_query($SQL);
		$strurl = "index.php?mn=masterjab";
	break;
	case "upd_dept" :
		$SQL = "update master_dept SET  namadept='".$_POST['departemen']."' WHERE iddep=".$_POST['iddep'];
		$hasil=mysql_query($SQL);
		$strurl = "index.php?mn=masterdep";
	break;
	case "upd_peg" :
		$SQL = "UPDATE mastpegawai SET noinduk='".$_POST['noinduk']."', nama='".$_POST['nama']."', alamat ='".$_POST['alamat']."', notelp ='".$_POST['notelp']."', jkel='".$_POST['kelamin']."', tgllahir='".baliktgl($_POST['tgl_lahir'])."', jabatan='".$_POST['slJabatan']."', departemen ='".$_POST['slDepartemen']."', mulkerja='".baliktgl($_POST['tgl_mkerja'])."', gaji_tipe = '".$_POST['gaji_tipe']."', ri_pendidikan = '".$_POST['pendidikan']."', ri_pekerjaan = '".$_POST['pekerjaan']."', ri_keluarga = '".$_POST['keluarga']."', finger = '".$_POST['finger']."' WHERE idno=".$_POST['id'];
		$hasil=mysql_query($SQL);
		$strurl = "index.php?mn=masterpeg";
	break;
	case "del_jab" :
		$SQL = "UPDATE mastjabatan SET status=0 WHERE idjab=".$_GET['id'];
		$hasil=mysql_query($SQL);
		$strurl = "index.php?mn=masterjab";
	break;
	case "del_dep" :
		$SQL = "UPDATE master_dept SET status = 0 where iddep = ".$_GET['id'];
		$hasil=mysql_query($SQL);
		$strurl = "index.php?mn=masterdep";
	break;
	case "del_peg" :
		$id = $_POST[tambah];
		$banyaknya = count($id);
		for ($i=0; $i<$banyaknya; $i++) {
			$SQL = "UPDATE mastpegawai SET status = 0 where idno=".$id[$i];
			$hasil=mysql_query($SQL);
		}
		$strurl = "master_pegawai.php";
	break;
	
}
//echo $SQL; echo "<br>"; echo $strurl; echo "<br>"; echo $cmd; 
header("location: ".$strurl);
?>