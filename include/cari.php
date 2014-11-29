<?php 
 // pastikan file ini diakses dengan mengirimkan variable POST dengan nama "nip"
 isset($_GET['id']) or die('Kirim parameter id');

 include 'globalx.php';
 $id = $_GET['id'];
 switch($_GET['cari']){
	case "rekening" :
		if ($_GET['mode']=="induk") {
 			$query = mysql_query("SELECT namarek FROM $database.rek WHERE norek = '$id'", $dbh_jogjaide);
		}
		if ($_GET['mode']=="rekp") {
 			$query = mysql_query("SELECT namarek FROM $database.dbfm WHERE norek = '$id'", $dbh_jogjaide);
		}
		break;
	case "supplier" :
		if($_GET['mode']=="nama"){
			$query = mysql_query("SELECT nama FROM $database.supplier WHERE kode = '$id'", $dbh_jogjaide);
		}
		if($_GET['mode']=="alamat"){
			$query = mysql_query("SELECT alamat FROM $database.supplier WHERE kode = '$id'", $dbh_jogjaide);
		}
		if($_GET['mode']=="kota"){
			$query = mysql_query("SELECT kota FROM $database.supplier WHERE kode = '$id'", $dbh_jogjaide);
		}
		if($_GET['mode']=="telp"){
			$query = mysql_query("SELECT telp FROM $database.supplier WHERE kode = '$id'", $dbh_jogjaide);
		}
		if($_GET['mode']=="rek"){
			$query = mysql_query("SELECT norek FROM $database.supplier WHERE kode = '$id'", $dbh_jogjaide);
		}
		if($_GET['mode']=="namarek"){
			$query = mysql_query("SELECT namarek FROM $database.rek a, $database.supplier b WHERE a.norek = b.norek AND b.kode = '$id'", $dbh_jogjaide);
		}
	break;
	case "pembeli" :
		if($_GET['mode']=="nama"){
			$query = mysql_query("SELECT nama FROM $database.konsumen WHERE kode = '$id'", $dbh_jogjaide);
		}
		if($_GET['mode']=="alamat"){
			$query = mysql_query("SELECT alamat FROM $database.konsumen WHERE kode = '$id'", $dbh_jogjaide);
		}
		if($_GET['mode']=="kota"){
			$query = mysql_query("SELECT kota FROM $database.konsumen WHERE kode = '$id'", $dbh_jogjaide);
		}
		if($_GET['mode']=="telp"){
			$query = mysql_query("SELECT telp FROM $database.konsumen WHERE kode = '$id'", $dbh_jogjaide);
		}
		if($_GET['mode']=="rek"){
			$query = mysql_query("SELECT norek FROM $database.konsumen WHERE kode = '$id'", $dbh_jogjaide);
		}
		if($_GET['mode']=="namarek"){
			$query = mysql_query("SELECT namarek FROM $database.rek a, $database.konsumen b WHERE a.norek = b.norek AND b.kode = '$id'", $dbh_jogjaide);
		}
	break;
	case "barang" :
		if($_GET['mode']=="nama"){
			$query = mysql_query("SELECT namabrg FROM $database.stock WHERE kodebrg = '$id'", $dbh_jogjaide);
		}
		if($_GET['mode']=="harga"){
			$query = mysql_query("SELECT modal FROM $database.stock WHERE kodebrg = '$id'", $dbh_jogjaide);
		}
		if($_GET['mode']=="hargajual"){
			$query = mysql_query("SELECT hargaeceran FROM $database.stock WHERE kodebrg = '$id'", $dbh_jogjaide);
		}
		if($_GET['mode']=="isi"){
			$query = mysql_query("SELECT isi FROM $database.stock WHERE kodebrg = '$id'", $dbh_jogjaide);
		}
		if($_GET['mode']=="satuanb"){
			$query = mysql_query("SELECT satuanb FROM $database.stock WHERE kodebrg = '$id'", $dbh_jogjaide);
		}
		if($_GET['mode']=="satuank"){
			$query = mysql_query("SELECT satuank FROM $database.stock WHERE kodebrg = '$id'", $dbh_jogjaide);
		}
	break;
	case "tes"	 :
		$query = mysql_query("SELECT nama, alamat FROM $database.mastpegawai WHERE status = 1 AND noinduk = '$id'", $dbh_jogjaide);
		break;
 }
 // cara mengambil nilai nama pegawai dari query diatas
// @list($nama) = mysql_fetch_row($query);
 @list($nama) = mysql_fetch_row($query);
 echo $nama; // beri response nilai nama pegawai
?>
