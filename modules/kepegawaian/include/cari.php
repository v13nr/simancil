<?php 
 // pastikan file ini diakses dengan mengirimkan variable POST dengan nama "nip"
 isset($_GET['id']) or die('Kirim parameter id');

 include 'globalx.php';
 $id = $_GET['id'];
 switch($_GET['cari']){
	case "pegawai" :
		if ($_GET['mode']=="nama") {
 			$query = mysql_query("SELECT nama FROM mastpegawai WHERE status = 1 AND noinduk = '$id'");
		}
		if ($_GET['mode']=="alamat") {
 			$query = mysql_query("SELECT alamat FROM mastpegawai WHERE status = 1 AND  noinduk = '$id'");
		}
		if ($_GET['mode']=="jkel") {
 			$query = mysql_query("SELECT jkel FROM mastpegawai WHERE status = 1 AND  noinduk = '$id'");
		}
		if ($_GET['mode']=="departemen") {
 			$query = mysql_query("SELECT namadept FROM master_dept a, mastpegawai b WHERE a.iddep = b.departemen AND b.status = 1 AND  b.noinduk = '$id'");
		}
		if ($_GET['mode']=="jabatan") {
 			$query = mysql_query("SELECT namajab FROM mastjabatan a, mastpegawai b WHERE a.idjab = b.jabatan AND b.status = 1 AND  b.noinduk = '$id'");
		}
		if ($_GET['mode']=="gaji_tipe") {
 			$query = mysql_query("SELECT gaji_tipe FROM mastpegawai WHERE status = 1 AND  noinduk = '$id'");
		}
		break;
	case "barang"	 :
		if ($_GET['mode']=="nama") {
 			$query = mysql_query("SELECT nmbrg FROM master_databrg WHERE status = 1 AND kode = '$id' AND stok > 0");
		}
		if ($_GET['mode']=="jenis") {
 			$query = mysql_query("SELECT jenisbrg FROM master_barang, master_databrg WHERE master_databrg.status = 1 AND master_barang.idbrg = master_databrg.jnsbrg AND master_databrg.kode = '$id' AND stok > 0");
		}
		if ($_GET['mode']=="harga") {
 			$query = mysql_query("SELECT hrgjual FROM master_databrg WHERE status = 1 AND kode = '$id' AND stok > 0");
		}
		if ($_GET['mode']=="keterangan") {
 			$query = mysql_query("SELECT keterangan FROM master_databrg WHERE status = 1 AND kode = '$id' AND stok > 0");
		}
		break;
	case "packing" :
		if ($_GET['mode']=="idpack") {
 			$query = mysql_query("SELECT id FROM daily_packing WHERE status = 1 AND barcode = '$id'");
		}
		if ($_GET['mode']=="tgl") {
 			$query = mysql_query("SELECT DATE_FORMAT(tanggal, '%d-%m-%Y') as tanggal FROM daily_packing WHERE status = 1 AND barcode = '$id'");
		}
		if ($_GET['mode']=="ikan") {
 			$query = mysql_query("SELECT b.ikan FROM daily_packing a, master_ikan b WHERE a.status = 1 AND a.ikanpack = b.id AND barcode = '$id'");
		}
		if ($_GET['mode']=="size") {
 			$query = mysql_query("SELECT size FROM daily_packing WHERE status = 1 AND barcode = '$id'");
		}
		if ($_GET['mode']=="total") {
 			$query = mysql_query("SELECT total FROM daily_packing WHERE status = 1 AND barcode = '$id'");
		}
		if ($_GET['mode']=="no") {
 			$query = mysql_query("SELECT no FROM daily_packing WHERE status = 1 AND barcode = '$id'");
		}
		if ($_GET['mode']=="lbs") {
 			$query = mysql_query("SELECT lbs FROM daily_packing WHERE status = 1 AND barcode = '$id'");
		}
		if ($_GET['mode']=="kgs") {
 			$query = mysql_query("SELECT kgs FROM daily_packing WHERE status = 1 AND barcode = '$id'");
		}
		if ($_GET['mode']=="totkgs") {
 			$query = mysql_query("SELECT totkgs FROM daily_packing WHERE status = 1 AND barcode = '$id'");
		}
		if ($_GET['mode']=="realkgs") {
 			$query = mysql_query("SELECT realkgs FROM daily_packing WHERE status = 1 AND barcode = '$id'");
		}
		if ($_GET['mode']=="bar") {
 			$query = mysql_query("SELECT barcode FROM daily_packing WHERE status = 1 AND barcode = '$id'");
		}
		if ($_GET['mode']=="buyer") {
 			$query = mysql_query("SELECT b.buyer FROM daily_packing a, master_buyer b WHERE a.buyer = b.id AND a.status = 1 AND barcode = '$id'");
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
