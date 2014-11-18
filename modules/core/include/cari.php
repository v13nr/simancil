<?
 // pastikan file ini diakses dengan mengirimkan variable POST dengan nama "nip"
 isset($_GET['id']) or die('Kirim parameter id');

 include 'globalx.php';
 $id = $_GET['id'];
 switch($_GET['cari']){
	case "rekening" :
		if ($_GET['mode']=="induk") {
 			$query = mysql_query("SELECT namarek FROM rek WHERE norek = '$id'");
		}
		if ($_GET['mode']=="rekp") {
 			$query = mysql_query("SELECT namarek FROM dbfm WHERE norek = '$id'");
		}
		break;
	case "supplier" :
		if($_GET['mode']=="nama"){
			$query = mysql_query("SELECT nama FROM supplier WHERE kode = '$id'");
		}
		if($_GET['mode']=="alamat"){
			$query = mysql_query("SELECT alamat FROM supplier WHERE kode = '$id'");
		}
		if($_GET['mode']=="kota"){
			$query = mysql_query("SELECT kota FROM supplier WHERE kode = '$id'");
		}
		if($_GET['mode']=="telp"){
			$query = mysql_query("SELECT telp FROM supplier WHERE kode = '$id'");
		}
		if($_GET['mode']=="rek"){
			$query = mysql_query("SELECT norek FROM supplier WHERE kode = '$id'");
		}
		if($_GET['mode']=="namarek"){
			$query = mysql_query("SELECT namarek FROM rek a, supplier b WHERE a.norek = b.norek AND b.kode = '$id'");
		}
	break;
	case "pembeli" :
		if($_GET['mode']=="nama"){
			$query = mysql_query("SELECT nama FROM konsumen WHERE kode = '$id'");
		}
		if($_GET['mode']=="alamat"){
			$query = mysql_query("SELECT alamat FROM konsumen WHERE kode = '$id'");
		}
		if($_GET['mode']=="kota"){
			$query = mysql_query("SELECT kota FROM konsumen WHERE kode = '$id'");
		}
		if($_GET['mode']=="telp"){
			$query = mysql_query("SELECT telp FROM konsumen WHERE kode = '$id'");
		}
		if($_GET['mode']=="rek"){
			$query = mysql_query("SELECT norek FROM konsumen WHERE kode = '$id'");
		}
		if($_GET['mode']=="namarek"){
			$query = mysql_query("SELECT namarek FROM rek a, konsumen b WHERE a.norek = b.norek AND b.kode = '$id'");
		}
	break;
	case "barang" :
		if($_GET['mode']=="nama"){
			$query = mysql_query("SELECT namabrg FROM stock WHERE kodebrg = '$id'");
		}
		if($_GET['mode']=="harga"){
			$query = mysql_query("SELECT modal FROM stock WHERE kodebrg = '$id'");
		}
		if($_GET['mode']=="isi"){
			$query = mysql_query("SELECT isi FROM stock WHERE kodebrg = '$id'");
		}
		if($_GET['mode']=="satuanb"){
			$query = mysql_query("SELECT satuanb FROM stock WHERE kodebrg = '$id'");
		}
		if($_GET['mode']=="satuank"){
			$query = mysql_query("SELECT satuank FROM stock WHERE kodebrg = '$id'");
		}
	break;
	case "tes"	 :
		$query = mysql_query("SELECT nama, alamat FROM mastpegawai WHERE status = 1 AND noinduk = '$id'");
		break;
 }
 // cara mengambil nilai nama pegawai dari query diatas
// @list($nama) = mysql_fetch_row($query);
 @list($nama) = mysql_fetch_row($query);
 echo $nama; // beri response nilai nama pegawai
?>
