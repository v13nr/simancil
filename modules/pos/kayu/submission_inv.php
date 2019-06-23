<?php 
session_start();


include ("../include/globalx.php");
include ("../../accounting/include/globalx.php");
include ("../include/functions.php");
include ("otentik_inv.php");

$cmd = $_POST['cmd'];
if ($cmd==""){
	$cmd = $_GET['cmd'];
}

		date_default_timezone_set('Asia/Shanghai');
		$wkt_disimpan = Date("Y-m-d H:i:s");
		$xbulan = $_REQUEST['slBulan'];
		$xtanggal = $_REQUEST['slTanggal'];
		$TanggalLahir=$_REQUEST['slTahun']."-".$xbulan."-".$xtanggal." 00:00:00"; 
	
$a = session_id();
	
switch ($cmd) {
	case "add_jual_kredit" :
		//print_r($_POST);
		//die();
		//0
		//prevent from zero
		$SQL = "SELECT hargaeceran from stock where kodebrg = '".$_POST['barang']."'";
		$hasil = mysql_query($SQL);
		$baris = mysql_fetch_array($hasil);
		$iszero = $baris[0];
		if($iszero <= 0){
			//die("Harga Jual belum diinput! Klik Tombol Back");
		}
		//prevent from zero
		$SQL = "SELECT modal from stock where kodebrg = '".$_POST['brg']."'";
		$hasil = mysql_query($SQL);
		$baris = mysql_fetch_array($hasil);
		$iszero = $baris[0];
		if($iszero <= 0){
			//die("Harga Beli belum diinput! Klik Tombol Back");
		}
		//1. cari divisi dan nomor lpb
		$nomor = 1;
		$tipe = "YFD";
		$SQL = "SELECT max(nomor) FROM mutasi WHERE model = 'INV'";
		$hasil = mysql_query($SQL) or die(mysql_error());
		$baris = mysql_fetch_array($hasil);
		if ($baris[0]>=0) {
			$nomor = $baris[0] + 1;
		}
		if($_POST['nomor']<>""){
			$nomor = $_POST['nomor'];
		}
		if($_POST['nonota']<>""){
			$nomor = $_POST['nonota'];
		}
		
		
		//2. insert mutasi
		
		$harga = preg_replace('#[^0-9]#', '', $_POST['harga']);
		$ukuran1 = preg_replace('#[^0-9]#', '', $_POST['ukuran1']);
		$ukuran2 = preg_replace('#[^0-9]#', '', $_POST['ukuran2']);
		$ukuran3 = preg_replace('#[^0-9]#', '', $_POST['ukuran3']);
		$netto = preg_replace('#[^0-9]#', '', $_POST['nilai']);

		
		$SQL = "INSERT INTO mutasi(id, model, nota, tgl, nobukti, kode, sub, nomor, nama, alamat, kota, tlp, kodebrg, namabrg, qtyout,   satuan, ukuran1, ukuran2, ukuran3, batang, harga, kredit, user_id, status) VALUES(
		'',
		'KRE',
		'".$_POST['nonota']."',
		'".baliktgl($_POST['tgl_transaksi'])."',
		'',
		'".$_POST['pembeli']."',
		'".$_POST["divisi"]."',
		'".$_POST['nonota']."',
		'".$_POST['namasupp']."',
		'".$_POST['alamat']."',
		'".$_POST['kota']."',
		'".$_POST['telp']."',
		'".$_POST['brg']."',
		'".$_POST['namabrg']."',
		'".$_POST['kubikasi']."',
		'".$_POST['satuan']."',
		'$ukuran1',
		'$ukuran2',
		'$ukuran3',
		'".$_POST['batang']."',
		'$harga',
		'".$_POST['nilai']."',
		'".$_SESSION["sess_user_id"]."', 1
		)";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		
		$mutasi_id = mysql_insert_id();
		
		//3. update stok
		$SQL = "UPDATE stock SET qtyout = qtyout + $qty WHERE kodebrg = '".$_POST['brg']."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		
		//5. insert/update piutang
		//5a. cari rekening kredit
		$SQL = "SELECT norek FROM setting WHERE setting = 'PENDAPATAN'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$baris = mysql_fetch_array($hasil);
		$rekkredit = $baris['norek'];
		
		//5b. cek
		$SQL = "SELECT * FROM piutang WHERE kode = '".$_POST["pembeli"]."' AND nomor = '".$nomor."'";
		$hasil = mysql_query($SQL) or die(mysql_error());
		if(mysql_num_rows($hasil) < 1){
			//insert ke piutang
			$SQLi = "INSERT into piutang(id, tgl, kode, nota, nama, alamat, saldo, rekdebet, rekkredit, keterangan, sub, nomor) VALUES(
			'',
			'".baliktgl($_POST['tgl_transaksi'])."',
			'".$_POST['pembeli']."',
			'".$_POST['nonota']."',
			'".$_POST['namasupp']."',
			'".$_POST['alamat']."',
			'$netto',
			'1030000',
			'$rekkredit',
			'',
			'".$_POST['divisi']."',
			'".$_POST['nonota']."'
			)";
			$hasili = mysql_query($SQLi);
			$idp = mysql_insert_id();
		} else {
			//update ke piutang
			$SQLu = "UPDATE piutang SET saldo = saldo + '".$netto."' WHERE kode = '".$_POST["pembeli"]."' AND nomor = '".$_POST['nonota']."'";
			$hasilu = mysql_query($SQLu);
		}
		
		// detail angsuran
			
			$purchase_date = baliktgl($_POST['tgl_transaksi']);
			$nilai = ($netto) / $_POST['angsuran']; //gak dipakai karena manual ji
			for ($i=1;$i<= $_POST['angsuran'];$i++) {
				$purchase_date_timestamp = strtotime($purchase_date);
				$purchase_date_1month = strtotime("+$i months", $purchase_date_timestamp);
				$jtempo = date("Y-m-d", $purchase_date_1month);
				$SQL = "INSERT INTO piutang_detail(id, posted, piutang_id, jtempo, nilai, bunga) VALUES('', 0, '$idp', '$jtempo', '0', '$bunga')";
				$hasil=mysql_query($SQL);
			}
		// cleaning
			$SQL = "DELETE FROM piutang_detail WHERE piutang_id = 0";
			$hasil = mysql_query($SQL);

		//Konek ke akunting
		//1. Jurnal Pembelian Kredit
		//1.a Terhadap  keuangan
				
				$SQL = "INSERT INTO $database.jurnal_srb(id, tanggal, jenis, kd, kk, ket, ket2, jumlah, dollar, sub, divisi, nobukti, bulan, user_id, mutasi_id, tipe_jurnal) VALUES (
				'',
				'".baliktgl($_POST['tgl_transaksi'])."',
				'Debet',
				'AL2-1112',
				'PD1-411',
				'Piutang Dagang',
				'Penjualan',
				'".($harga * $_POST["kubikasi"])."',
				'".$_POST['dollar']."',
				'$tipe',
				'".$_SESSION["divisi"]."',
				'$nomor',
				'$bulan',
				'".$_SESSION["sess_user_id"]."',
				'".$mutasi_id."',
				'JPK'
				)";
			
			$hasil = mysql_query($SQL, $dbh_jogjaide);
			
			//1.b mengurangi Terhadap persediaan
				
				$sql = "select modal from stock where kodebrg = '". $_POST['brg'] ."'";
				$hasil = mysql_query($sql);
				$baris = mysql_fetch_array($hasil);
				$hpp = $baris[0];
				
				$SQL = "INSERT INTO $database.jurnal_srb(id, tanggal, jenis, kd, kk, ket, ket2, jumlah, dollar, sub, divisi, nobukti, bulan, user_id, mutasi_id, tipe_jurnal) VALUES (
				'',
				'".baliktgl($_POST['tgl_transaksi'])."',
				'Debet',
				'HPP-5100',
				'AL6-1117',
				'Harga Pokok Penjualan',
				'Persediaan',
				'".($hpp * $_POST["kubikasi"])."',
				'".$_POST['dollar']."',
				'$tipe',
				'".$_SESSION["divisi"]."',
				'$nomor',
				'$bulan',
				'".$_SESSION["sess_user_id"]."',
				'".$mutasi_id."',
				'JPK'
				)";
			
			$hasil = mysql_query($SQL, $dbh_jogjaide);
			
		//link back
		
			$strurl = "penjualan_kredit_edit.php?mn=penjualan&pembeli=".$_POST['pembeli']."&nonota=".$_POST['nonota']."&supp=".$_POST['pembeli']."&alamat=".$_POST['alamat']."&kota=".$_POST['kota']."&telp=".$_POST['telp']."&tgl_transaksi=".$_POST['tgl_transaksi']."&saldo=".$_POST['saldo']."&rek=".$_POST['rek']."&namarek=".$_POST['namarek']."&nomor=".$_POST['nonota']."&namasupp=".$_POST['namasupp']."&angsuran=".$_POST['angsuran'];
		
	break;
}
//echo $SQL; echo "<br>"; echo $strurl; echo "<br>"; echo $cmd; 
header("location: ".$strurl);
?>
