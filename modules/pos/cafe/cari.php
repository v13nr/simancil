<?php 
 // pastikan file ini diakses dengan mengirimkan variable POST dengan nama "nip"
 isset($_GET['id']) or die('Kirim parameter id');

 include '../include/globalx.php';
 $id = $_GET['id'];
 switch($_GET['cari']){
	case "barang" :
		if($_GET['mode']=="nama"){
			$query = mysql_query("SELECT namabrg FROM $database.stock WHERE kodebrg = '$id'", $dbh_jogjaide);
		}
		if($_GET['mode']=="harga"){
			$sql = "SELECT hargaeceran FROM $database.stock WHERE kodebrg = '$id'";
			$query = mysql_query($sql, $dbh_jogjaide);
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
	case "update"	 :
		if($_GET['mode']=="qty"){
			$query = mysql_query("update mutasi set $database.qtyout = 3", $dbh_jogjaide);
		}
		break;
 }
 // cara mengambil nilai nama pegawai dari query diatas
// @list($nama) = mysql_fetch_row($query);
 @list($nama) = mysql_fetch_row($query);
 echo $nama; // beri response nilai nama pegawai
?>
