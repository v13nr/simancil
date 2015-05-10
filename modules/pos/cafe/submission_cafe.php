<?php 
session_start();
include_once "../../../config_sistem.php";
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
		
switch ($cmd) {
	case "add_sft" :
		$SQL = "INSERT INTO $database.shift(id, user_id, tanggal) VALUES ('','".$_POST["nama"]."','".baliktgl($_POST["tanggal"])."')";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "index.php?mn=shift";
	break;
	case "upd_sft" :
		$SQL = "update $database.shift set user_id = '".$_POST["nama"]."', tanggal = '".baliktgl($_POST["tanggal"])."'  where id=".$_POST["id"];
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "index.php?mn=shift";
	break;
	case "open_sft" :
		$SQL = "update $database.shift set status = 0";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$SQL = "update $database.shift set status = 1 where id=".$_GET["id"];
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "index.php?mn=shift";
	break;
	case "add_meja" :
		$SQL = "INSERT INTO $database.meja(id, nama) VALUES ('','".$_POST["nama"]."')";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "index.php?mn=meja";
	break;
	case "upd_meja" :
		$SQL = "UPDATE $database.meja set nama= '".$_POST["nama"]."' where id = ".$_POST["id"];
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "index.php?mn=meja";
	break;
	case "del_meja" :
		$SQL = "delete from $database.meja Where id = ".$_GET["id"];
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "index.php?mn=meja";
	break;
	case "del_jual" :
		$SQL = "UPDATE $database.mutasi SET status = 0 WHERE id = '".$_GET['id']."'";
		$hasil=mysql_query($SQL, $dbh_jogjaide);
		
		//update stok
		$SQL = "UPDATE $database.stock SET qtyout = qtyout - ".$_GET['qtyout']." WHERE kodebrg = '".$_GET['barang']."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		
		//update piutang
		$SQL = "UPDATE $database.piutang SET saldo = saldo - '".$_GET['jumlah']."' WHERE sub = '".$_GET["sub"]."' AND nomor = '".$_GET['nomor']."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		
		$strurl = "penjualan_edit.php?nonota=".$_GET['nonota']."&supp=".$_GET['supp']."&alamat=".$_GET['alamat']."&kota=".$_GET['kota']."&telp=".$_GET['telp']."&tgl_transaksi=".$_GET['tgl_transaksi']."&saldo=".$_GET['saldo']."&rek=".$_GET['rek']."&namarek=".$_GET['namarek']."&nomor=".$_GET['nomor']."&namasupp=".$_GET['namasupp']."&meja=".$_GET['meja'];
		if($_GET['cmd2']=="edit"){
		$strurl = "penjualan_edit.php?nonota=".$_GET['nonota']."&supp=".$_GET['supp']."&alamat=".$_GET['alamat']."&kota=".$_GET['kota']."&telp=".$_GET['telp']."&tgl_transaksi=".$_GET['tgl_transaksi']."&saldo=".$_GET['saldo']."&rek=".$_GET['rek']."&namarek=".$_GET['namarek']."&nomor=".$_GET['nomor']."&namasupp=".$_GET['namasupp']."&sub=".$_GET['sub']."&meja=".$_GET['meja'];
		}
	break;
	case "del_jualRetail" :
		$SQL = "UPDATE $database.mutasi SET status = 0 WHERE id = '".$_GET['id']."'";
		$hasil=mysql_query($SQL, $dbh_jogjaide);
		
		//update stok
		$SQL = "UPDATE $database.stock SET qtyout = qtyout - ".$_GET['qtyout']." WHERE kodebrg = '".$_GET['barang']."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		
		//update piutang
		$SQL = "UPDATE $database.piutang SET saldo = saldo - '".$_GET['jumlah']."' WHERE sub = '".$_GET["sub"]."' AND nomor = '".$_GET['nomor']."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		
		//delete jurnal
		$SQL = "delete from $database.jurnal_srb where mutasi_id = '".$_GET['id']."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		
		
		$strurl = "penjualan_retail_edit.php?nonota=".$_GET['nonota']."&supp=".$_GET['supp']."&alamat=".$_GET['alamat']."&kota=".$_GET['kota']."&telp=".$_GET['telp']."&tgl_transaksi=".$_GET['tgl_transaksi']."&saldo=".$_GET['saldo']."&rek=".$_GET['rek']."&namarek=".$_GET['namarek']."&nomor=".$_GET['nomor']."&namasupp=".$_GET['namasupp']."&meja=".$_GET['meja'];
		if($_GET['cmd2']=="edit"){
		$strurl = "penjualan_retail_edit.php?nonota=".$_GET['nonota']."&supp=".$_GET['supp']."&alamat=".$_GET['alamat']."&kota=".$_GET['kota']."&telp=".$_GET['telp']."&tgl_transaksi=".$_GET['tgl_transaksi']."&saldo=".$_GET['saldo']."&rek=".$_GET['rek']."&namarek=".$_GET['namarek']."&nomor=".$_GET['nomor']."&namasupp=".$_GET['namasupp']."&sub=".$_GET['sub']."&meja=".$_GET['meja'];
		}
	break;
	case "del_pemesanan" :
		$SQL = "UPDATE $database.po SET status = 0 WHERE id = '".$_GET['id']."'";
		$hasil=mysql_query($SQL, $dbh_jogjaide);
		
		
		//update pesanan
		$SQL = "UPDATE $database.pesanan SET saldo = saldo - '".$_GET['jumlah']."' WHERE sub = '".$_GET["sub"]."' AND nomor = '".$_GET['nomor']."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		//echo $SQL; exit();
		//delete jurnal
			
		
		$strurl = "pemesanan_barang_edit.php?nonota=".$_GET['nonota']."&supp=".$_GET['supp']."&alamat=".$_GET['alamat']."&kota=".$_GET['kota']."&telp=".$_GET['telp']."&tgl_transaksi=".$_GET['tgl_transaksi']."&saldo=".$_GET['saldo']."&rek=".$_GET['rek']."&namarek=".$_GET['namarek']."&nomor=".$_GET['nomor']."&namasupp=".$_GET['namasupp']."&meja=".$_GET['meja'];
		if($_GET['cmd2']=="edit"){
		$strurl = "pemesanan_barang_edit.php?nonota=".$_GET['nonota']."&supp=".$_GET['supp']."&alamat=".$_GET['alamat']."&kota=".$_GET['kota']."&telp=".$_GET['telp']."&tgl_transaksi=".$_GET['tgl_transaksi']."&saldo=".$_GET['saldo']."&rek=".$_GET['rek']."&namarek=".$_GET['namarek']."&nomor=".$_GET['nomor']."&namasupp=".$_GET['namasupp']."&sub=".$_GET['sub']."&meja=".$_GET['meja'];
		}
	break;
	case "add_jual" :
	//0
		//prevent from zero
		$SQL = "SELECT hargaeceran from stock where kodebrg = '".$_POST['barang']."'";
		$hasil = mysql_query($SQL);
		$baris = mysql_fetch_array($hasil);
		$iszero = $baris[0];
		if($iszero <= 0){
			die("Harga Jual belum diinput! Klik Tombol Back");
		}
		//prevent from zero
		$SQL = "SELECT modal from stock where kodebrg = '".$_POST['barang']."'";
		$hasil = mysql_query($SQL);
		$baris = mysql_fetch_array($hasil);
		$iszero = $baris[0];
		if($iszero <= 0){
			die("Harga Beli belum diinput! Klik Tombol Back");
		}
		//1. cari divisi dan nomor lpb
		$nomor = 1;
		$tipe = "CFD";
		$SQL = "SELECT max(nomor) FROM $database.mutasi WHERE model = 'INV'";
		$hasil = mysql_query($SQL, $dbh_jogjaide) or die(mysql_error());
		$baris = mysql_fetch_array($hasil);
		if ($baris[0]>=0) {
			$nomor = $baris[0] + 1;
		}
		if($_POST['nomor']<>""){
			$nomor = $_POST['nomor'];
		}
		
		
	
			$harga = preg_replace('#[^0-9]#', '', $_POST['harga']);
			$disc = preg_replace('#[^0-9]#', '', $_POST['disc']);
			$disc2 = preg_replace('#[^0-9]#', '', $_POST['disc2']);
			$disc3 = preg_replace('#[^0-9]#', '', $_POST['disc3']);
			$discrp = preg_replace('#[^0-9]#', '', $_POST['discrp']);
			$netto = preg_replace('#[^0-9]#', '', $_POST['netto']);
			$qty = preg_replace('#[^0-9]#', '', $_POST['qty']);
			
		//cek apakah barang dalam keranjang
		$sql = "select * from $database.mutasi where nomor = '$nomor' and kodebrg = '". $_POST['barang'] ."' AND model = 'INV'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$baris = mysql_fetch_array($hasil);
		$ada = mysql_num_rows($hasil);
		if($ada > 0){
			//update
			$sqlu = "update $database.mutasi set  qtyout = qtyout + $qty  where id = ".$baris["id"];
			$hasilu = mysql_query($sqlu, $dbh_jogjaide);
			//echo $sqlu; exit();
		}  else {
		//2. insert mutasi

			$SQL = "select namabrg from $database.stock where kodebrg = '". $_POST['barang'] ."'";
			$hasil = mysql_query($SQL, $dbh_jogjaide);
			$baris = mysql_fetch_array($hasil);
			$namabarang = mysql_real_escape_string($baris[0]);
			$SQLt = "select id from $database.shift where status = 1";
			$hasilt= mysql_query($SQLt, $dbh_jogjaide);
			$barist = mysql_fetch_array($hasilt);
			$shift_id = $barist[0];
			
			$SQL = "INSERT INTO $database.mutasi(id, model, tgl, nobukti, kode, sub, nomor, nama, alamat, kota, tlp, kodebrg, namabrg, qtyout,   satuan, disc, disc2, disc3, discrp, harga, kredit, user_id, status, meja_id, shift_id) VALUES(
			'',
			'INV',
			'".baliktgl($_POST['tgl_transaksi'])."',
			'',
			'".$_POST['pembeli']."',
			'".$_POST["divisi"]."',
			'$nomor',
			'".$_POST['namasupp']."',
			'".$_POST['alamat']."',
			'".$_POST['kota']."',
			'".$_POST['telp']."',
			'".$_POST['barang']."',
			'$namabarang',
			'".$qty."',
			'".$_POST['satuan']."',
			'$disc',
			'$disc2',
			'$disc3',
			'$discrp',
			'$harga',
			'$netto',
			'".$_SESSION["sess_user_id"]."', 1, 
			'".$_POST["meja"]."', 
			'". $shift_id ."'
			)";
			//echo $SQL; exit();
			$hasil = mysql_query($SQL, $dbh_jogjaide);
		}
		//3. update stok
		$SQL = "UPDATE $database.stock SET qtyout = qtyout + $qty WHERE kodebrg = '".$_POST['barang']."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		//echo $SQL; exit();
		//5. insert/update piutang
		//5a. cari rekening kredit
		/*
		$SQL = "SELECT norek FROM setting WHERE setting = 'PENDAPATAN'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$baris = mysql_fetch_array($hasil);
		$rekkredit = $baris['norek'];
		*/
		//5b. cek
		$SQL = "SELECT * FROM $database.piutang WHERE kode = '".$_POST["pembeli"]."' AND nomor = '".$nomor."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide) or die(mysql_error());
		if(mysql_num_rows($hasil) < 1){
			//insert ke piutang
			$SQLi = "INSERT into $database.piutang(id, tgl, kode, nota, nama, alamat, saldo, rekdebet, rekkredit, keterangan, sub, nomor) VALUES(
			'',
			'".baliktgl($_POST['tgl_transaksi'])."',
			'".$_POST['pembeli']."',
			'INV/".nobukti($nomor)."',
			'".$_POST['namasupp']."',
			'".$_POST['alamat']."',
			'$harga',
			'1030000',
			'$rekkredit',
			'',
			'".$_POST['divisi']."',
			'$nomor'
			)";
			$hasili = mysql_query($SQLi, $dbh_jogjaide);			
		} else {
			//update ke piutang
			$SQLu = "UPDATE $database.piutang SET saldo = saldo + '".($harga * $qty)."' WHERE kode = '".$_POST["pembeli"]."' AND nomor = '".$nomor."'";
			$hasilu = mysql_query($SQLu, $dbh_jogjaide);
		}
		
		//link back
		if($_POST['nomor']<>""){
			$strurl = "penjualan_edit.php?mn=penjualan&nonota=".$_POST['nonota']."&supp=".$_POST['pembeli']."&alamat=".$_POST['alamat']."&kota=".$_POST['kota']."&telp=".$_POST['telp']."&tgl_transaksi=".$_POST['tgl_transaksi']."&saldo=".$_POST['saldo']."&rek=".$_POST['rek']."&namarek=".$_POST['namarek']."&nomor=".$_POST['nomor']."&namasupp=".$_POST['namasupp']."&sub=".$_POST['sub']."&meja=".$_POST['meja'];
			if($_POST['cmd2']=="edit"){
				$strurl = "penjualan_edit.php?nomor=".$_POST['nomor']."&sub=".$_POST['sub']."&meja=".$_POST['meja'];
			}
		} else {
			$strurl = "penjualan_edit.php?mn=penjualan&nonota=".$_POST['nonota']."&supp=".$_POST['pembeli']."&alamat=".$_POST['alamat']."&kota=".$_POST['kota']."&telp=".$_POST['telp']."&tgl_transaksi=".$_POST['tgl_transaksi']."&saldo=".$_POST['saldo']."&rek=".$_POST['rek']."&namarek=".$_POST['namarek']."&nomor=".$nomor."&namasupp=".$_POST['namasupp']."&sub=".$_POST['divisi']."&meja=".$_POST['meja'];
		}
	break;
	case "add_jualRetail" :
		//0
		//prevent from zero
		$SQL = "SELECT hargaeceran from stock where kodebrg = '".$_POST['barang']."'";
		$hasil = mysql_query($SQL);
		$baris = mysql_fetch_array($hasil);
		$iszero = $baris[0];
		if($iszero <= 0){
			die("Harga Jual belum diinput! Klik Tombol Back");
		}
		//prevent from zero
		$SQL = "SELECT modal from stock where kodebrg = '".$_POST['barang']."'";
		$hasil = mysql_query($SQL);
		$baris = mysql_fetch_array($hasil);
		$iszero = $baris[0];
		if($iszero <= 0){
			die("Harga Beli belum diinput! Klik Tombol Back");
		}
		//1. cari divisi dan nomor lpb
		$nomor = 1;
		$tipe = "CFD";
		$SQL = "SELECT max(nomor) FROM $database.mutasi WHERE model = 'INV'";
		$hasil = mysql_query($SQL, $dbh_jogjaide) or die(mysql_error());
		$baris = mysql_fetch_array($hasil);
		if ($baris[0]>=0) {
			$nomor = $baris[0] + 1;
		}
		if($_POST['nomor']<>""){
			$nomor = $_POST['nomor'];
		}
		
		
	
			$harga = preg_replace('#[^0-9]#', '', $_POST['harga']);
			$disc = preg_replace('#[^0-9]#', '', $_POST['disc']);
			$disc2 = preg_replace('#[^0-9]#', '', $_POST['disc2']);
			$disc3 = preg_replace('#[^0-9]#', '', $_POST['disc3']);
			$discrp = preg_replace('#[^0-9]#', '', $_POST['discrp']);
			$netto = preg_replace('#[^0-9]#', '', $_POST['netto']);
			$qty = preg_replace('#[^0-9]#', '', $_POST['qty']);
			
		//cek apakah barang dalam keranjang
		$sql = "select * from $database.mutasi where nomor = '$nomor' and kodebrg = '". $_POST['barang'] ."' AND model = 'INV'";
		$hasil = mysql_query($sql, $dbh_jogjaide);
		$baris = mysql_fetch_array($hasil);
		$ada = mysql_num_rows($hasil);
		if($ada > 0){
			//update
			$sqlu = "update $database.mutasi set  qtyout = qtyout + $qty  where id = ".$baris["id"];
			$hasilu = mysql_query($sqlu, $dbh_jogjaide);
			//echo $sqlu; exit();
		}  else {
		//2. insert mutasi

			$SQL = "select namabrg from $database.stock where kodebrg = '". $_POST['barang'] ."'";
			$hasil = mysql_query($SQL, $dbh_jogjaide);
			$baris = mysql_fetch_array($hasil);
			$namabarang = mysql_real_escape_string($baris[0]);
			$SQLt = "select id from $database.shift where status = 1";
			$hasilt= mysql_query($SQLt, $dbh_jogjaide);
			$barist = mysql_fetch_array($hasilt);
			$shift_id = $barist[0];
			
			$SQLt = "select modal from $database.stock where kodebrg = '". $_POST['barang'] ."'";
			$hasilt= mysql_query($SQLt, $dbh_jogjaide);
			$barist = mysql_fetch_array($hasilt);
			$modal = $barist[0];
			
			$SQL = "INSERT INTO $database.mutasi(id, model, tgl, nobukti, kode, sub, nomor, nama, alamat, kota, tlp, kodebrg, namabrg, qtyout,   satuan, disc, disc2, disc3, discrp, harga, kredit, user_id, status, meja_id, shift_id, modal) VALUES(
			'',
			'INV',
			'".baliktgl($_POST['tgl_transaksi'])."',
			'',
			'".$_POST['pembeli']."',
			'".$_POST["divisi"]."',
			'$nomor',
			'".$_POST['namasupp']."',
			'".$_POST['alamat']."',
			'".$_POST['kota']."',
			'".$_POST['telp']."',
			'".$_POST['barang']."',
			'$namabarang',
			'".$qty."',
			'".$_POST['satuan']."',
			'$disc',
			'$disc2',
			'$disc3',
			'$discrp',
			'$harga',
			'$netto',
			'".$_SESSION["sess_user_id"]."', 1, 
			'".$_POST["meja"]."', 
			'". $shift_id ."',
			'$modal'
			)";
			//echo $SQL; exit();
			$hasil = mysql_query($SQL, $dbh_jogjaide);
			$mutasi_id = mysql_insert_id();
		}
		//3. update stok
		$SQL = "UPDATE $database.stock SET qtyout = qtyout + $qty WHERE kodebrg = '".$_POST['barang']."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		//echo $SQL; exit();
		//5. insert/update piutang
		//5a. cari rekening kredit
		/*
		$SQL = "SELECT norek FROM setting WHERE setting = 'PENDAPATAN'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$baris = mysql_fetch_array($hasil);
		$rekkredit = $baris['norek'];
		*/
		//5b. cek
		$SQL = "SELECT * FROM $database.piutang WHERE kode = '".$_POST["pembeli"]."' AND nomor = '".$nomor."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide) or die(mysql_error());
		if(mysql_num_rows($hasil) < 1){
			//insert ke piutang
			$SQLi = "INSERT into $database.piutang(id, tgl, kode, nota, nama, alamat, saldo, rekdebet, rekkredit, keterangan, sub, nomor) VALUES(
			'',
			'".baliktgl($_POST['tgl_transaksi'])."',
			'".$_POST['pembeli']."',
			'INV/".nobukti($nomor)."',
			'".$_POST['namasupp']."',
			'".$_POST['alamat']."',
			'$harga',
			'1030000',
			'$rekkredit',
			'',
			'".$_POST['divisi']."',
			'$nomor'
			)";
			$hasili = mysql_query($SQLi, $dbh_jogjaide);			
		} else {
			//update ke piutang
			$SQLu = "UPDATE $database.piutang SET saldo = saldo + '".($harga * $qty)."' WHERE kode = '".$_POST["pembeli"]."' AND nomor = '".$nomor."'";
			$hasilu = mysql_query($SQLu, $dbh_jogjaide);
		}
		
		//Konek ke akunting
		//1. Jurnal Penjualan Tunai
		//1.a mendapatkan id mutasi sudah
				
				$SQL = "INSERT INTO $database.jurnal_srb(id, tanggal, jenis, kd, kk, ket, ket2, jumlah, dollar, sub, divisi, nobukti, bulan, user_id, mutasi_id) VALUES (
				'',
				'".baliktgl($_POST['tgl_transaksi'])."',
				'Debet',
				'AL1-1111',
				'PD1-411',
				'Kas',
				'Penjualan',
				'".($harga * $qty)."',
				'".$_POST['dollar']."',
				'$tipe',
				'".$_SESSION["divisi"]."',
				'$nomor',
				'$bulan',
				'".$_SESSION["sess_user_id"]."',
				'".$mutasi_id."'
				)";
			
			//echo $SQL;
			//exit();
			$hasil = mysql_query($SQL, $dbh_jogjaide);
			
		//2. Jurnal pengurangan barang dagang
		//2.1 Cari HPP
			$sqlh = "select modal from $database.stock where kodebrg ='".$_POST['barang']."'";
			$hasilh = mysql_query($sqlh, $dbh_jogjaide) or die(mysql_error());
			$barish = mysql_fetch_array($hasilh);
			$hpp = $barish[0];
			//$nomorNext = intval($nomor)+1;
			$SQL = "INSERT INTO $database.jurnal_srb(id, tanggal, jenis, kd, kk, ket, ket2, jumlah, dollar, sub, divisi, nobukti, bulan, user_id, mutasi_id) VALUES (
				'',
				'".baliktgl($_POST['tgl_transaksi'])."',
				'Debet',
				'HPP-5100',
				'AL6-1117',
				'Harga Pokok Penjualan',
				'Persediaan Barang Retail',
				'".$hpp."',
				'".$_POST['dollar']."',
				'$tipe',
				'".$_SESSION["divisi"]."',
				'". $nomor ."',
				'$bulan',
				'".$_SESSION["sess_user_id"]."',
				'".$mutasi_id."'
				)";
			
			$hasil = mysql_query($SQL, $dbh_jogjaide);
			
		//link back
		if($_POST['nomor']<>""){
			$strurl = "penjualan_retail_edit.php?mn=penjualan&nonota=".$_POST['nonota']."&supp=".$_POST['pembeli']."&alamat=".$_POST['alamat']."&kota=".$_POST['kota']."&telp=".$_POST['telp']."&tgl_transaksi=".$_POST['tgl_transaksi']."&saldo=".$_POST['saldo']."&rek=".$_POST['rek']."&namarek=".$_POST['namarek']."&nomor=".$_POST['nomor']."&namasupp=".$_POST['namasupp']."&sub=".$_POST['sub']."&meja=".$_POST['meja'];
			if($_POST['cmd2']=="edit"){
				$strurl = "penjualan_edit.php?nomor=".$_POST['nomor']."&sub=".$_POST['sub']."&meja=".$_POST['meja'];
			}
		} else {
			$strurl = "penjualan_retail_edit.php?mn=penjualan&nonota=".$_POST['nonota']."&supp=".$_POST['pembeli']."&alamat=".$_POST['alamat']."&kota=".$_POST['kota']."&telp=".$_POST['telp']."&tgl_transaksi=".$_POST['tgl_transaksi']."&saldo=".$_POST['saldo']."&rek=".$_POST['rek']."&namarek=".$_POST['namarek']."&nomor=".$nomor."&namasupp=".$_POST['namasupp']."&sub=".$_POST['divisi']."&meja=".$_POST['meja'];
		}
	break;
	case "rinci_to_mutasi" :
		//1. cari divisi dan nomor lpb
		$nomor = 1;
		$tipe = "PRJ";
		$SQL = "SELECT max(nomor) FROM $database.mutasi WHERE model = 'PRJ'";
		$hasil = mysql_query($SQL, $dbh_jogjaide) or die(mysql_error());
		$baris = mysql_fetch_array($hasil);
		if ($baris[0]>=0) {
			$nomor = $baris[0] + 1;
		}
		if($_POST['nomor']<>""){
			$nomor = $_POST['nomor'];
		}
		
		
	
			$harga = preg_replace('#[^0-9]#', '', $_POST['harga']);
			$disc = preg_replace('#[^0-9]#', '', $_POST['disc']);
			$disc2 = preg_replace('#[^0-9]#', '', $_POST['disc2']);
			$disc3 = preg_replace('#[^0-9]#', '', $_POST['disc3']);
			$discrp = preg_replace('#[^0-9]#', '', $_POST['discrp']);
			$netto = preg_replace('#[^0-9]#', '', $_POST['netto']);
			$qty = preg_replace('#[^0-9]#', '', $_POST['qty']);
			
		//cek apakah barang dalam keranjang
		$sql = "select * from $database.mutasi where nomor = '$nomor' and kodebrg = '". $_POST['barang'] ."' AND model = 'PRJ'";
		$hasil = mysql_query($sql, $dbh_jogjaide);
		$baris = mysql_fetch_array($hasil);

		//2. insert mutasi

			$SQL = "select namabrg from $database.stock where kodebrg = '". $_POST['barang'] ."'";
			$hasil = mysql_query($SQL, $dbh_jogjaide);
			$baris = mysql_fetch_array($hasil);
			$namabarang = mysql_real_escape_string($baris[0]);
			$SQLt = "select id from $database.shift where status = 1";
			$hasilt= mysql_query($SQLt, $dbh_jogjaide);
			$barist = mysql_fetch_array($hasilt);
			$shift_id = $barist[0];
			
			$SQL = "INSERT INTO $database.mutasi(id, model, tgl, nobukti, kode, sub, nomor, nama, alamat, kota, tlp, kodebrg, namabrg, qtyout,   satuan, disc, disc2, disc3, discrp, harga, kredit, user_id, status, meja_id, shift_id) VALUES(
			'',
			'PRJ',
			'".baliktgl($_POST['tgl_transaksi'])."',
			'',
			'".$_POST['pembeli']."',
			'".$_POST["divisi"]."',
			'$nomor',
			'".$_POST['namasupp']."',
			'".$_POST['alamat']."',
			'".$_POST['kota']."',
			'".$_POST['telp']."',
			'".$_POST['barang']."',
			'$namabarang',
			'".$qty."',
			'".$_POST['satuan']."',
			'$disc',
			'$disc2',
			'$disc3',
			'$discrp',
			'$harga',
			'$netto',
			'".$_SESSION["sess_user_id"]."', 1, 
			'".$_POST["meja"]."', 
			'". $shift_id ."'
			)";
			//echo $SQL; exit();
			$hasil = mysql_query($SQL, $dbh_jogjaide);
			$mutasi_id = mysql_insert_id();
		
		//3. update stok
		$SQL = "UPDATE $database.stock SET qtyout = qtyout + $qty WHERE kodebrg = '".$_POST['barang']."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		/*
		//Konek ke akunting
		//1. Jurnal ???
		//1.a mendapatkan id mutasi sudah
				
				$SQL = "INSERT INTO $database.jurnal_srb(id, tanggal, jenis, kd, kk, ket, ket2, jumlah, dollar, sub, divisi, nobukti, bulan, user_id, mutasi_id) VALUES (
				'',
				'".baliktgl($_POST['tgl_transaksi'])."',
				'Debet',
				'1110001',
				'7100001',
				'Kas',
				'Penjualan',
				'".($harga * $qty)."',
				'".$_POST['dollar']."',
				'$tipe',
				'".$_SESSION["divisi"]."',
				'$nomor',
				'$bulan',
				'".$_SESSION["sess_user_id"]."',
				'".$mutasi_id."'
				)";
			
			//echo $SQL;
			//exit();
			$hasil = mysql_query($SQL, $dbh_jogjaide);
			
		//2. Jurnal pengurangan barang dagang
		//2.1 Cari HPP
			$sqlh = "select modal from $database.stock where kodebrg ='".$_POST['barang']."' and divisi = '".$_SESSION["divisi"]."'";
			$hasilh = mysql_query($sqlh, $dbh_jogjaide);
			$barish = mysql_fetch_array($hasilh);
			$hpp = $barish[0];
			//$nomorNext = intval($nomor)+1;
			$SQL = "INSERT INTO $database.jurnal_srb(id, tanggal, jenis, kd, kk, ket, ket2, jumlah, dollar, sub, divisi, nobukti, bulan, user_id, mutasi_id) VALUES (
				'',
				'".baliktgl($_POST['tgl_transaksi'])."',
				'Debet',
				'1300001',
				'2000100',
				'Harga Pokok Penjualan',
				'Persediaan Barang Dagang',
				'".$hpp."',
				'".$_POST['dollar']."',
				'$tipe',
				'".$_SESSION["divisi"]."',
				'". $nomor ."',
				'$bulan',
				'".$_SESSION["sess_user_id"]."',
				'".$mutasi_id."'
				)";
			
			//echo $SQL;
			//exit();
			$hasil = mysql_query($SQL, $dbh_jogjaide);
			*/
		//link back
		if($_POST['nomor']<>""){
			$strurl = "pemesanan_project_rinci.php?mn=penjualan&nonota=".$_POST['nonota']."&supp=".$_POST['pembeli']."&alamat=".$_POST['alamat']."&kota=".$_POST['kota']."&telp=".$_POST['telp']."&tgl_transaksi=".$_POST['tgl_transaksi']."&saldo=".$_POST['saldo']."&rek=".$_POST['rek']."&namarek=".$_POST['namarek']."&nomor=".$_POST['nomor']."&namasupp=".$_POST['namasupp']."&sub=".$_POST['sub']."&meja=".$_POST['meja'];
			if($_POST['cmd2']=="edit"){
				$strurl = "pemesanan_project_rinci.php?nomor=".$_POST['nomor']."&sub=".$_POST['sub']."&meja=".$_POST['meja'];
			}
		} else {
			$strurl = "pemesanan_project_rinci.php?mn=penjualan&nonota=".$_POST['nonota']."&supp=".$_POST['pembeli']."&alamat=".$_POST['alamat']."&kota=".$_POST['kota']."&telp=".$_POST['telp']."&tgl_transaksi=".$_POST['tgl_transaksi']."&saldo=".$_POST['saldo']."&rek=".$_POST['rek']."&namarek=".$_POST['namarek']."&nomor=".$nomor."&namasupp=".$_POST['namasupp']."&sub=".$_POST['divisi']."&meja=".$_POST['meja'];
		}
	break;
	case "add_pesanBarang" :
		//1. cari divisi dan nomor lpb
		$nomor = 1;
		$tipe = "PO";
		$SQL = "SELECT max(nomor) FROM $database.po WHERE model = 'PO'";
		$hasil = mysql_query($SQL, $dbh_jogjaide) or die(mysql_error());
		$baris = mysql_fetch_array($hasil);
		if ($baris[0]>=0) {
			$nomor = $baris[0] + 1;
		}
		if($_POST['nomor']<>""){
			$nomor = $_POST['nomor'];
		}
		
		
	
			$harga = preg_replace('#[^0-9]#', '', $_POST['harga']);
			$disc = preg_replace('#[^0-9]#', '', $_POST['disc']);
			$disc2 = preg_replace('#[^0-9]#', '', $_POST['disc2']);
			$disc3 = preg_replace('#[^0-9]#', '', $_POST['disc3']);
			$discrp = preg_replace('#[^0-9]#', '', $_POST['discrp']);
			$netto = preg_replace('#[^0-9]#', '', $_POST['netto']);
			$harga = preg_replace('#[^0-9]#', '', $_POST['jumlah']);
			$qty = preg_replace('#[^0-9]#', '', $_POST['qty']);
			
		//cek apakah barang dalam keranjang
		$sql = "select * from $database.po where nomor = '$nomor' and kodebrg = '". $_POST['barang'] ."' AND model = 'PO'";
		$hasil = mysql_query($sql, $dbh_jogjaide);
		$baris = mysql_fetch_array($hasil);
		$ada = mysql_num_rows($hasil);
		if(($ada > 0) && ($baris["posted"] != "1")){
			//update
			$sqlu = "update $database.po set  qtyin = qtyin + $qty  where id = ".$baris["id"];
			$hasilu = mysql_query($sqlu, $dbh_jogjaide);
			//echo $sqlu; exit();
		}  else {
		//2. insert mutasi

			$SQL = "select namabrg from $database.stock where kodebrg = '". $_POST['barang'] ."'";
			$hasil = mysql_query($SQL, $dbh_jogjaide);
			$baris = mysql_fetch_array($hasil);
			$namabarang = mysql_real_escape_string($baris[0]);
			$SQLt = "select id from $database.shift where status = 1";
			$hasilt= mysql_query($SQLt, $dbh_jogjaide);
			$barist = mysql_fetch_array($hasilt);
			$shift_id = $barist[0];
			
			$SQL = "INSERT INTO $database.po(id, model, tgl, nobukti, kode, sub, nomor, nama, alamat, kota, tlp, kodebrg, namabrg, qtyin,   satuan, disc, disc2, disc3, discrp, harga, kredit, user_id, status, meja_id, shift_id) VALUES(
			'',
			'PO',
			'".baliktgl($_POST['tgl_transaksi'])."',
			'',
			'".$_POST['pembeli']."',
			'".$_POST["divisi"]."',
			'$nomor',
			'".$_POST['namasupp']."',
			'".$_POST['alamat']."',
			'".$_POST['kota']."',
			'".$_POST['telp']."',
			'".$_POST['barang']."',
			'$namabarang',
			'".$qty."',
			'".$_POST['satuan']."',
			'$disc',
			'$disc2',
			'$disc3',
			'$discrp',
			'$harga',
			'$netto',
			'".$_SESSION["sess_user_id"]."', 1, 
			'".$_POST["meja"]."', 
			'". $shift_id ."'
			)";
			//echo $SQL; exit();
			$hasil = mysql_query($SQL, $dbh_jogjaide);
			$mutasi_id = mysql_insert_id();
		}
		//3. update stok = NO 
		//echo $SQL; exit();
		//5. insert/update piutang
		//5a. cari rekening kredit
		/*
		$SQL = "SELECT norek FROM setting WHERE setting = 'PENDAPATAN'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$baris = mysql_fetch_array($hasil);
		$rekkredit = $baris['norek'];
		*/
		//5b. cek
		$SQL = "SELECT * FROM $database.pesanan WHERE kode = '".$_POST["pembeli"]."' AND nomor = '".$nomor."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide) or die(mysql_error());
		if(mysql_num_rows($hasil) < 1){
			//insert ke piutang
			$SQLi = "INSERT into $database.pesanan(id, tgl, kode, nota, nama, alamat, saldo, rekdebet, rekkredit, keterangan, sub, nomor) VALUES(
			'',
			'".baliktgl($_POST['tgl_transaksi'])."',
			'".$_POST['pembeli']."',
			'PO/".nobukti($nomor)."',
			'".$_POST['namasupp']."',
			'".$_POST['alamat']."',
			'$harga',
			'1030000',
			'$rekkredit',
			'',
			'".$_POST['divisi']."',
			'$nomor'
			)";
			$hasili = mysql_query($SQLi, $dbh_jogjaide);			
		} else {
			//update ke piutang
			$SQLu = "UPDATE $database.pesanan SET saldo = saldo + '".($harga * $qty)."' WHERE kode = '".$_POST["pembeli"]."' AND nomor = '".$nomor."'";
			$hasilu = mysql_query($SQLu, $dbh_jogjaide);
		}
		
		
		//link back
		if($_POST['nomor']<>""){
			$strurl = "pemesanan_barang_edit.php?mn=penjualan&nonota=".$_POST['nonota']."&supp=".$_POST['pembeli']."&alamat=".$_POST['alamat']."&kota=".$_POST['kota']."&telp=".$_POST['telp']."&tgl_transaksi=".$_POST['tgl_transaksi']."&saldo=".$_POST['saldo']."&rek=".$_POST['rek']."&namarek=".$_POST['namarek']."&nomor=".$_POST['nomor']."&namasupp=".$_POST['namasupp']."&sub=".$_POST['sub']."&meja=".$_POST['meja'];
			if($_POST['cmd2']=="edit"){
				$strurl = "pemesanan_barang_edit.php?nomor=".$_POST['nomor']."&sub=".$_POST['sub']."&meja=".$_POST['meja'];
			}
		} else {
			$strurl = "pemesanan_barang_edit.php?mn=penjualan&nonota=".$_POST['nonota']."&supp=".$_POST['pembeli']."&alamat=".$_POST['alamat']."&kota=".$_POST['kota']."&telp=".$_POST['telp']."&tgl_transaksi=".$_POST['tgl_transaksi']."&saldo=".$_POST['saldo']."&rek=".$_POST['rek']."&namarek=".$_POST['namarek']."&nomor=".$nomor."&namasupp=".$_POST['namasupp']."&sub=".$_POST['divisi']."&meja=".$_POST['meja'];
		}
	break;

	case "add_pesanProject" :
		//1. cari divisi dan nomor lpb
		$nomor = 1;
		$tipe = "PR";
		$SQL = "SELECT max(nomor) FROM $database.po WHERE model = 'PR'";  //memberi nomor ke po misal satu nomor po ada dua id
		$hasil = mysql_query($SQL, $dbh_jogjaide) or die(mysql_error());
		$baris = mysql_fetch_array($hasil);
		if ($baris[0]>=0) {
			$nomor = $baris[0] + 1;
		}
		if($_POST['nomor']<>""){
			$nomor = $_POST['nomor'];
		}
		
		
	
			$harga = preg_replace('#[^0-9]#', '', $_POST['harga']);
			$disc = preg_replace('#[^0-9]#', '', $_POST['disc']);
			$disc2 = preg_replace('#[^0-9]#', '', $_POST['disc2']);
			$disc3 = preg_replace('#[^0-9]#', '', $_POST['disc3']);
			$discrp = preg_replace('#[^0-9]#', '', $_POST['discrp']);
			$netto = preg_replace('#[^0-9]#', '', $_POST['netto']);
			$harga = preg_replace('#[^0-9]#', '', $_POST['jumlah']);
			$qty = preg_replace('#[^0-9]#', '', $_POST['qty']);
			
		//cek apakah barang dalam keranjang
		$sql = "select * from $database.po where nomor = '$nomor' and kodebrg = '". $_POST['barang'] ."' AND model = 'PR'";
		$hasil = mysql_query($sql, $dbh_jogjaide);
		$baris = mysql_fetch_array($hasil);
		$ada = mysql_num_rows($hasil);
		if(($ada > 0) && ($baris["posted"] != "1")){
			//update
			$sqlu = "update $database.po set  qtyin = qtyin + $qty  where id = ".$baris["id"];
			$hasilu = mysql_query($sqlu, $dbh_jogjaide);
			//echo $sqlu; exit();
		}  else {
		//2. insert ke po jika tidak ada dalam keranjang... emang mata keranjang apa ! puih

			$SQL = "select namabrg, satuank from $database.stock where kodebrg = '". $_POST['barang'] ."'";
			$hasil = mysql_query($SQL, $dbh_jogjaide);
			$baris = mysql_fetch_array($hasil);
			$namabarang = mysql_real_escape_string($baris[0]);
			$satuan = mysql_real_escape_string($baris[1]);
			
			//jika ada shift yaa
			$SQLt = "select id from $database.shift where status = 1";
			$hasilt= mysql_query($SQLt, $dbh_jogjaide);
			$barist = mysql_fetch_array($hasilt);
			$shift_id = $barist[0];
			
			$SQL = "INSERT INTO $database.po(id, model, tgl, nobukti, kode, sub, nomor, nama, alamat, kota, tlp, kodebrg, namabrg, qtyin,   satuan, disc, disc2, disc3, discrp, harga, kredit, user_id, status, meja_id, shift_id) VALUES(
			'',
			'PR',
			'".baliktgl($_POST['tgl_transaksi'])."',
			'',
			'".$_POST['pembeli']."',
			'".$_POST["divisi"]."',
			'$nomor',
			'".$_POST['namasupp']."',
			'".$_POST['alamat']."',
			'".$_POST['kota']."',
			'".$_POST['telp']."',
			'".$_POST['barang']."',
			'$namabarang',
			'".$qty."',
			'$satuan',
			'$disc',
			'$disc2',
			'$disc3',
			'$discrp',
			'$harga',
			'$netto',
			'".$_SESSION["sess_user_id"]."', 1, 
			'".$_POST["meja"]."', 
			'". $shift_id ."'
			)";
			//echo $SQL; exit();
			$hasil = mysql_query($SQL, $dbh_jogjaide);
			
			//disini insert ke project detail
		
			//3. update stok = NO 
			//echo $SQL; exit();
			//5. insert/update piutang
			//5a. cari rekening kredit
			/*
			$SQL = "SELECT norek FROM setting WHERE setting = 'PENDAPATAN'";
			$hasil = mysql_query($SQL, $dbh_jogjaide);
			$baris = mysql_fetch_array($hasil);
			$rekkredit = $baris['norek'];
			*/
			//5b. cek
			$SQL = "SELECT * FROM $database.project WHERE kode = '".$_POST["pembeli"]."' AND nomor = '".$nomor."'";
			//echo $SQL; exit();
			$hasil = mysql_query($SQL, $dbh_jogjaide) or die(mysql_error());
			if(mysql_num_rows($hasil) < 1){
				//insert ke piutang
				$SQLi = "INSERT into $database.project(id, tgl, kode, nota, nama, alamat, saldo, rekdebet, rekkredit, keterangan, sub, nomor) VALUES(
				'',
				'".baliktgl($_POST['tgl_transaksi'])."',
				'".$_POST['pembeli']."',
				'PR/".nobukti($nomor)."',
				'".$_POST['namasupp']."',
				'".$_POST['alamat']."',
				'$harga',
				'1030000',
				'$rekkredit',
				'',
				'".$_POST['divisi']."',
				'$nomor'
				)";
				$hasili = mysql_query($SQLi, $dbh_jogjaide);	
				
				$project_id = mysql_insert_id();
				//insert ke project detail
					
				
				
				
					
			} else {
				//update ke piutang
				$SQLu = "UPDATE $database.project SET saldo = saldo + '".($harga * $qty)."' WHERE kode = '".$_POST["pembeli"]."' AND nomor = '".$nomor."'";
				$hasilu = mysql_query($SQLu, $dbh_jogjaide);
			}
			
			
		}
		
		$sql = "select * from $database.po where nomor = '$nomor' and kodebrg = '". $_POST['barang'] ."' AND model = 'PR'";
		$hasil = mysql_query($sql, $dbh_jogjaide);
		while($baris = mysql_fetch_array($hasil)) {
		
					//loop sejumlah item project 
				$SQLs1 = "SELECT * from $database.bahanjadi WHERE kodeinduk = '".$_POST['barang']."' AND status = 1";
				//echo $SQLs1; exit();
				$hasils1 = mysql_query($SQLs1, $dbh_jogjaide);
					while($bariss1 = mysql_fetch_array($hasils1)){
						
						$SQLi = "INSERT INTO $database.project_detail(id, kodeinduk, kodeanak, nama, qty, satuan, kemasan, status, project_id) VALUES('', '".$bariss1["kodeinduk"] ."', '".$bariss1['kodeanak']."', '".$bariss1['namabrg']."', '".$bariss1['qty']."', '".$bariss1['satuan']."', '".$bariss1['kemasan']."', 1, '$nomor')";
						//echo $SQLi; exit();
						$hasili = mysql_query($SQLi, $dbh_jogjaide);
					
					}
		}
		
		//link back
		if($_POST['nomor']<>""){
			$strurl = "pemesanan_project_edit.php?mn=penjualan&nonota=".$_POST['nonota']."&supp=".$_POST['pembeli']."&alamat=".$_POST['alamat']."&kota=".$_POST['kota']."&telp=".$_POST['telp']."&tgl_transaksi=".$_POST['tgl_transaksi']."&saldo=".$_POST['saldo']."&rek=".$_POST['rek']."&namarek=".$_POST['namarek']."&nomor=".$_POST['nomor']."&namasupp=".$_POST['namasupp']."&sub=".$_POST['sub']."&meja=".$_POST['meja'];
			if($_POST['cmd2']=="edit"){
				$strurl = "pemesanan_barang_edit.php?nomor=".$_POST['nomor']."&sub=".$_POST['sub']."&meja=".$_POST['meja'];
			}
		} else {
			$strurl = "pemesanan_project_edit.php?mn=penjualan&nonota=".$_POST['nonota']."&supp=".$_POST['pembeli']."&alamat=".$_POST['alamat']."&kota=".$_POST['kota']."&telp=".$_POST['telp']."&tgl_transaksi=".$_POST['tgl_transaksi']."&saldo=".$_POST['saldo']."&rek=".$_POST['rek']."&namarek=".$_POST['namarek']."&nomor=".$nomor."&namasupp=".$_POST['namasupp']."&sub=".$_POST['divisi']."&meja=".$_POST['meja'];
		}
	break;
	
	case "add_to_mutasi" :
		$id       = $_POST[pr_detail_id];
	  	$jml_data = count($id);
		$po_id   = $_POST[po_id];
	  	$jml_data_po = count($po_id);
		$pr_detail_id_val   = $_POST[pr_detail_id_val];
		$po_id_val = $_POST[po_id_val];
		$kodebrg = $_POST["kodebrg"];
		for ($i=0; $i < $jml_data; $i++){
			$SQL = "SELECT hargaeceran from $database.stock where kodebrg = '".$kodebrg[$i]."'";
			//echo $SQL;
			$hasil = mysql_query($SQL, $dbh_jogjaide) or die(mysql_error());
			$baris = mysql_fetch_array($hasil);
			$harga = $baris[0];
			$SQL = "INSERT INTO $database.mutasi(status, po_id, qtyout, kodebrg, harga, tgl) VALUES(1, '".$po_id[$i]."', '".$po_id_val[$i]*$pr_detail_id_val[$i]."','".$kodebrg[$i]."', '".$harga."', '".baliktgl($_POST["tgl_transaksi"])."')";
			$hasil = mysql_query($SQL, $dbh_jogjaide) or die(mysql_error());
			$SQL = "update $database.po set final = 1 where id = '".$po_id[$i]."'";
			$hasil=mysql_query($SQL, $dbh_jogjaide);
		}
		$strurl = "pemesanan_project_rinci.php?project_id=".$_POST["project_id"]."&nomor=".$_POST["nomor"]."&sub=".$_POST["sub"]."&tgl_transaksi=".$_POST["tgl_transaksi"];
	break;
}
//echo $SQL; echo "<br>"; echo $strurl; echo "<br>"; echo $cmd; 
header("location: ".$strurl);
?>