<?php 
session_start();


include ("../../accounting/include/globalx.php");
include ("../include/globalx.php");
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
	case "upd_subkon_detail" :
		$jumlah = preg_replace('#[^0-9]#', '', $_POST['jumlah']);
		$material = preg_replace('#[^0-9]#', '', $_POST['material']);
		$tambahan = preg_replace('#[^0-9]#', '', $_POST['tambahan']);
		$sisa = preg_replace('#[^0-9]#', '', $_POST['sisa']);
		$SQL = "update subkon_detail set jumlah = '". $jumlah ."', material = '". $material ."', tambahan = '". $tambahan ."', sisa = '". $sisa ."', tanggal = '". baliktgl($_POST["tanggal"]) ."' WHERE id = '". $_POST["id_detail"] ."'";
		$hasil = mysql_query($SQL);
		$strurl = "subkon_setup.php?id=".$_POST["id"];
	break;
	case "add_subkon" :
		$kontrak = preg_replace('#[^0-9]#', '', $_POST['kontrak']);
		$SQL = "INSERT into subkon(id, nama, tipe_luas, blok, kontrak) VALUES('', '".($_POST['nama'])."','".$_POST['tipe_luas']."','".$_POST['blok']."','".$kontrak."')";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$subkon_id = mysql_insert_id();
		//insert detail
		for ($i=1; $i < 5; $i++){
			$SQL = "INSERT INTO subkon_detail(id, subkon_id, keterangan) VALUES('', '$subkon_id', 
			'TERMIN ". $i ."'
			)";
			$hasil = mysql_query($SQL);
		}
			$SQL = "INSERT INTO subkon_detail(id, subkon_id, keterangan) VALUES('', '$subkon_id', 
			''
			)";
			//$hasil = mysql_query($SQL);
		$strurl = "subkon_ls.php";
	break;
	case "add_timbunan" :
		$SQL = "INSERT into timbunan(id, tanggal, ret) VALUES('', '".baliktgl($_POST['tanggal'])."','".$_POST['ret']."')";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "../../../index.php?mn=timbunan_ls&getmodule=".base64_encode('pos/inventory');
	break;
	case "add_timbunan_bayar" :
		$SQL = "INSERT into timbunan_bayar(id, total_timbunan, harga_peret, terbayar_tgl, terbayar_jumlah, sisa) VALUES(
		'',
		'".$_POST['total_timbunan']."',
		'".$_POST['harga_peret']."',
		'".baliktgl($_POST['tanggal'])."',
		'".$_POST['terbayar_jumlah']."',
		'".(($_POST['total_timbunan'] * $_POST['harga_peret']) - ($_POST['terbayar_jumlah']))."'
		)";
		//Secho $SQL; exit();
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "timbunan_bayar.php";
	break;
	case "del_timbunan" :
		$SQL = "DELETE FROM timbunan WHERE id = '".$_GET['id']."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "../../../index.php?mn=timbunan_ls&getmodule=".base64_encode('pos/inventory');
	break;
	case "del_timbunan_bayar" :
		$SQL = "DELETE FROM timbunan_bayar WHERE id = '".$_GET['id']."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "timbunan_bayar.php";
	break;
	case "upd_setting" :
		$id       = $_POST[id];
	  	$jml_data = count($id);
		$norek   = $_POST[norek];
		for ($i=0; $i < $jml_data; $i++){
			$s = "SELECT * FROM dbfm WHERE norek = '".$norek[$i]."'";
			$h = mysql_query($s);
			if(mysql_num_rows($h) < 1 ){
				$s = "UPDATE setting SET norek = '' WHERE id = '".$id[$i]."'";
				$h = mysql_query($s);
			} else {
				$s = "UPDATE setting SET norek = '".$norek[$i]."' WHERE id = '".$id[$i]."'";
				$h = mysql_query($s);
			}
		}
		$strurl = "index.php?mn=setting&confirm=y";
	break;
	case "add_jual" :
		//1. cari divisi dan nomor lpb
		$nomor = 1;
		$tipe = "IDN";
		$SQL = "SELECT max(nomor) FROM mutasi WHERE model = 'IDN'";
		$hasil = mysql_query($SQL) or die(mysql_error());
		$baris = mysql_fetch_array($hasil);
		if ($baris[0]>=0) {
			$nomor = $baris[0] + 1;
		}
		if($_POST['nomor']<>""){
			$nomor = $_POST['nomor'];
		}
		//2. insert mutasi
		$harga = preg_replace('#[^0-9]#', '', $_POST['harga']);
		$disc = preg_replace('#[^0-9]#', '', $_POST['disc']);
		$disc2 = preg_replace('#[^0-9]#', '', $_POST['disc2']);
		$disc3 = preg_replace('#[^0-9]#', '', $_POST['disc3']);
		$discrp = preg_replace('#[^0-9]#', '', $_POST['discrp']);
		$netto = preg_replace('#[^0-9]#', '', $_POST['netto']);
		$qty = preg_replace('#[^0-9]#', '', $_POST['qty']);
		$um = preg_replace('#[^0-9]#', '', $_POST['uangmuka']);
		$bunga = preg_replace('#[^0-9]#', '', $_POST['bunga']);
		$dpx = preg_replace('#[^0-9]#', '', $_POST['dpx']);
		$tanah = preg_replace('#[^0-9]#', '', $_POST['tanah']);
		$bangunan = preg_replace('#[^0-9]#', '', $_POST['bangunan']);
		$pajak = preg_replace('#[^0-9]#', '', $_POST['pajak']);
		$kpr = preg_replace('#[^0-9]#', '', $_POST['kpr']);

		$adminis = preg_replace('#[^0-9]#', '', $_POST['adminis']);
		//cari harga pokok rumah tidak jadi karena yang di kelola DP
		/*
		$SQL = "SELECT modal from stock WHERE kodebrg = '".$_POST['brg']."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$baris = mysql_fetch_array($hasil);
		$hpp_rumah = $baris[0];
		$laba_penjualan_rumah = $netto - $hpp_rumah;
		*/
		
		
		$SQL = "INSERT INTO mutasi(id, model, tgl, nobukti, kode, sub, nomor, nama, alamat, kota, tlp, kodebrg, namabrg, qtyout,   satuan, disc, disc2, disc3, discrp, harga, kredit, user_id, status, dpx) VALUES(
		'',
		'IDN',
		'".baliktgl($_POST['tgl_transaksi'])."',
		'IDN/$nomor',
		'".$_POST['pembeli']."',
		'".$_POST["divisi"]."',
		'$nomor',
		'".$_POST['namasupp']."',
		'".$_POST['alamat']."',
		'".$_POST['kota']."',
		'".$_POST['telp']."',
		'".$_POST['brg']."',
		'".$_POST['namabrg']."',
		'".$qty."',
		'".$_POST['satuan']."',
		'$disc',
		'$disc2',
		'$disc3',
		'$discrp',
		'$harga',
		'$netto',
		'".$_SESSION["sess_user_id"]."', 1,
		'". $dpx ."'
		)";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		//3. update stok
		$SQL = "UPDATE stock SET qtyout = qtyout + $qty WHERE kodebrg = '".$_POST['brg']."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		
		//5. insert/update piutang
		//5a. cari rekening kredit
		/*
		$SQL = "SELECT norek FROM setting WHERE setting = 'PENDAPATAN'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$baris = mysql_fetch_array($hasil);
		$rekkredit = $baris['norek'];
		*/
		
		//5b. cek
		$SQL = "SELECT * FROM piutang WHERE kode = '".$_POST["pembeli"]."' AND nomor = '".$nomor."'";
		$hasil = mysql_query($SQL) or die(mysql_error());
		if(mysql_num_rows($hasil) < 1){
			//insert ke piutang, istilahnya kurang tepat.. hanya sekedar pencatatan
			$SQLi = "INSERT into piutang(id, tgl, kode, nota, nama, alamat, saldo, rekdebet, rekkredit, keterangan, sub, nomor,angsuran, uangmuka, bunga, disc, sales, kode_sales, adminis, tipebayar, tanah, bangunan, pajak, kpr, blok, luas, hargarumah) VALUES(
			'',
			'".baliktgl($_POST['tgl_transaksi'])."',
			'".$_POST['pembeli']."',
			'IDN/".nobukti($nomor)."',
			'".$_POST['namasupp']."',
			'".$_POST['alamat']."',
			'$dpx',
			'1030000',
			'$rekkredit',
			'',
			'".$_POST['divisi']."',
			'$nomor',
			'".$_POST['angsuran']."',
			'$um',
			'$bunga',
			'$disc',
			'".$_POST['sales']."',
			'".$_POST['kode_sales']."',
			'".$_POST['adminis']."',
			'".$_POST['tipebayar']."',
			'$tanah',
			'$bangunan',
			'$pajak',
			'$kpr',
			'".$_POST['blok']."',
			'".$_POST['luas']."',
			'$harga'
			)";
			$hasili = mysql_query($SQLi);
			$idp = mysql_insert_id();
			
			//uang muka
			
				$SQL = "INSERT INTO piutang_detail(id, posted, piutang_id, jtempo, nilai, ket, bunga) VALUES('', 0, '$idp', '".baliktgl($_POST['tgl_transaksi'])."', '$um', 'Uang Muka', '$bunga')";
				$hasil=mysql_query($SQL, $dbh_jogjaide);
				
			// detail angsuran
			$purchase_date = baliktgl($_POST['tgl_transaksi']);
			$nilai = ($netto - $dpx) / $_POST['angsuran']; //gak dipakai karena manual ji
			for ($i=1;$i<= $_POST['angsuran'];$i++) {
				$purchase_date_timestamp = strtotime($purchase_date);
				$purchase_date_1month = strtotime("+$i months", $purchase_date_timestamp);
				$jtempo = date("Y-m-d", $purchase_date_1month);
				$SQL = "INSERT INTO piutang_detail(id, posted, piutang_id, jtempo, nilai, bunga) VALUES('', 0, '$idp', '$jtempo', '0', '$bunga')";
				$hasil=mysql_query($SQL, $dbh_jogjaide);
			}
			
				
			
		} else {
			//update ke piutang
			$SQLu = "UPDATE piutang SET saldo = saldo + '".$dpx."' WHERE kode = '".$_POST["pembeli"]."' AND nomor = '".$nomor."'";
			$hasilu = mysql_query($SQLu);
		}
		//insert jurnal
				//1. memorial  // gak perlu hehe, transaksi langsung masuk di pendapatan pada transaksi pertam
				
				/*
					//$penerimaan_kas = adminis + booking fee
					//piutang DP = dpx - booking fee
					//pendapatan di terima dimuka = dpx    ===== identik dengan hutang sehingga kalau sudah akad dia jadi debet melawan kredit penjualan rumah
					$penerimaan_kas = $adminis + $um;
					$SQLa = "insert into $database.jurnal_header(id, name, address, tanggal) values(
					'',
					'".$_POST['namapl']."',
					'$nomor',
					'".baliktgl($_POST['tgl_transaksi'])."'
					)";
					//echo $SQLa; exit();
					$hasila = mysql_query($SQLa, $dbh_jogjaide);
					$id_jh = mysql_insert_id();
					//1. kas debet a
					$SQLa = "insert into $database.jurnal(id, buyer_id, coa, keterangan, debet, kredit, user_id) values(
					'',
					'$id_jh',
					'1110001',
					'Kas',
					'$penerimaan_kas',
					'0',
					'".$_SESSION["sess_user_id"]."'
					)";
					//echo $SQLa; exit();
					$hasila = mysql_query($SQLa, $dbh_jogjaide);
					//2. piutang DP 1130002 A
					$piutang_angsuran = $dpx - $um;
					$SQLa = "insert into $database.jurnal(id, buyer_id, coa, keterangan, debet, kredit, user_id) values(
					'',
					'$id_jh',
					'1130002',
					'Piutang Angsuran',
					'$piutang_angsuran',
					'0',
					'".$_SESSION["sess_user_id"]."'
					)";
					$hasila = mysql_query($SQLa, $dbh_jogjaide);
					//3.  pendapatan dit dimuka Utang P
					$pendapatan_muka = $dpx;
					$SQLa = "insert into $database.jurnal(id, buyer_id, coa, keterangan, debet, kredit, user_id) values(
					'',
					'$id_jh',
					'2110200',
					'Pendapatan di Terima di Muka',
					'0',
					'$dpx',
					'".$_SESSION["sess_user_id"]."'
					)";
					//echo $SQLa; exit();
					$hasila = mysql_query($SQLa, $dbh_jogjaide);
					//4. pendapatan administrasi RL
					$SQLa = "insert into $database.jurnal(id, buyer_id, coa, keterangan, debet, kredit, user_id) values(
					'',
					'$id_jh',
					'4110002',
					'Laba Penjualan Angsuran',
					'0',
					'$adminis',
					'".$_SESSION["sess_user_id"]."'
					)";
					$hasila = mysql_query($SQLa, $dbh_jogjaide);
					
					// link ke jurnal_srb
					$SQL = "INSERT INTO $database.jurnal_srb(id, tanggal, memorial_id) VALUES('', 
					'".baliktgl($_POST['tgl_transaksi'])."', '$id_jh')";
					//echo $SQL; exit();
					$hasil = mysql_query($SQL, $dbh_jogjaide);
					
					//pemasukan kas dari administrasi 500k
					$id_jh_text = 'DPA-' . $id_jh;
					$SQL = "INSERT INTO $database.jurnal_srb(id, tanggal, jenis, kd, kk, ket, ket2, jumlah, dollar, sub, divisi, nobukti, bulan, user_id) VALUES (
					'',
					'".baliktgl($_POST['tgl_transaksi'])."',
					'Debet',
					'1110001',
					'5160001',
					'Kas',
					'Biaya Administrasi DP',
					'".$adminis."',
					'".$_POST['dollar']."',
					'$tipe',
					'".$_POST['divisi']."',
					'$id_jh_text',
					'$bulan',
					'".$_SESSION["sess_user_id"]."'
					)";
				
				//echo $SQL;
				//exit();
				$hasil = mysql_query($SQL, $dbh_jogjaide);
				*/
				
				//jurnal srb aja kas lawan booking fee dan administrasi
					$SQL = "INSERT INTO $database.jurnal_srb(id, tanggal, jenis, kd, kk, ket, ket2, jumlah, dollar, sub, divisi, nobukti, bulan, user_id) VALUES (
					'',
					'".baliktgl($_POST['tgl_transaksi'])."',
					'Debet',
					'1110001',
					'5160001',
					'Kas',
					'Pendapatan Administrasi',
					'".$adminis."',
					'0',
					'".$_SESSION["sess_tipe"]."',
					'".$_SESSION["sess_tipe"]."',
					'". $idp ."',
					'$bulan',
					'".$_SESSION["sess_user_id"]."'
					)";
					$hasil=mysql_query($SQL, $dbh_jogjaide);	
					
					//kas lawan Booking Fee
					$SQL = "INSERT INTO $database.jurnal_srb(id, tanggal, jenis, kd, kk, ket, ket2, jumlah, dollar, sub, divisi, nobukti, bulan, user_id) VALUES (
					'',
					'".baliktgl($_POST['tgl_transaksi'])."',
					'Debet',
					'1110001',
					'5160002',
					'Kas',
					'Pendapatan Booking Fee',
					'".$um."',
					'0',
					'".$_SESSION["sess_tipe"]."',
					'".$_SESSION["sess_tipe"]."',
					'". $idp ."',
					'$bulan',
					'".$_SESSION["sess_user_id"]."'
					)";
					$hasil=mysql_query($SQL, $dbh_jogjaide);	
					
		//link back
		if($_POST['nomor']<>""){
			$strurl = "penjualan_edit.php?mn=penjualan&nonota=".$_POST['nonota']."&supp=".$_POST['pembeli']."&alamat=".$_POST['alamat']."&kota=".$_POST['kota']."&telp=".$_POST['telp']."&tgl_transaksi=".$_POST['tgl_transaksi']."&saldo=".$_POST['saldo']."&rek=".$_POST['rek']."&namarek=".$_POST['namarek']."&nomor=".$_POST['nomor']."&namasupp=".$_POST['namasupp']."&sub=".$_POST['sub']."&angsuran=".$_POST['angsuran']."&bunga=".$_POST['bunga']."&sales=".$_POST['sales']."&kode_sales=".$_POST['kode_sales']."&adminis=".$_POST['adminis'];
			if($_POST['cmd2']=="edit"){
				$strurl = "penjualan_edit.php?nomor=".$_POST['nomor']."&sub=".$_POST['sub'];
			}
		} else {
			$strurl = "penjualan_edit.php?mn=penjualan&nonota=".$_POST['nonota']."&supp=".$_POST['pembeli']."&alamat=".$_POST['alamat']."&kota=".$_POST['kota']."&telp=".$_POST['telp']."&tgl_transaksi=".$_POST['tgl_transaksi']."&saldo=".$_POST['saldo']."&rek=".$_POST['rek']."&namarek=".$_POST['namarek']."&nomor=".$nomor."&namasupp=".$_POST['namasupp']."&sub=".$_POST['divisi']."&angsuran=".$_POST['angsuran']."&bunga=".$_POST['bunga']."&sales=".$_POST['sales']."&kode_sales=".$_POST['kode_sales']."&adminis=".$_POST['adminis'];
		}
	break;
	case "add_beli" :
		//1. cari divisi dan nomor lpb
		$nomor = 1;
		$tipe = "JE";
		$SQL = "SELECT max(nomor) FROM mutasi WHERE model = ''";
		$hasil = mysql_query($SQL) or die(mysql_error());
		$baris = mysql_fetch_array($hasil);
		if ($baris[0]>=0) {
			$nomor = $baris[0] + 1;
		}
		if($_POST['nomor']<>""){
			$nomor = $_POST['nomor'];
		}
		//2. insert mutasi
		/*
		$harga = ereg_replace("[^0-9]", "", $_POST['harga']);
		$disc = ereg_replace("[^0-9]", "", $_POST['disc']);
		$disc2 = ereg_replace("[^0-9]", "", $_POST['disc2']);
		$disc3 = ereg_replace("[^0-9]", "", $_POST['disc3']);
		$discrp = ereg_replace("[^0-9]", "", $_POST['discrp']);
		$netto = ereg_replace("[^0-9]", "", $_POST['netto']);
		$qty = ereg_replace("[^0-9]", "", $_POST['qty']);
		*/
		$harga = preg_replace('#[^0-9]#', '', $_POST['harga']);
		$disc = preg_replace('#[^0-9]#', '', $_POST['disc']);
		$disc2 = preg_replace('#[^0-9]#', '', $_POST['disc2']);
		$disc3 = preg_replace('#[^0-9]#', '', $_POST['disc3']);
		$discrp = preg_replace('#[^0-9]#', '', $_POST['discrp']);
		$netto = preg_replace('#[^0-9]#', '', $_POST['netto']);
		$qty = preg_replace('#[^0-9]#', '', $_POST['qty']);


		$SQL = "INSERT INTO mutasi(id, tgl, nota, nobukti, kode, sub, nomor, nama, alamat, kota, tlp, kodebrg, namabrg, qtyin,   satuan, disc, disc2, disc3, discrp, harga, debet, user_id, status) VALUES(
		'',
		'".baliktgl($_POST['tgl_transaksi'])."',
		'".$_POST['nonota']."',
		'',
		'".$_POST['supp']."',
		'".$_POST["divisi"]."',
		'$nomor',
		'".$_POST['namasupp']."',
		'".$_POST['alamat']."',
		'".$_POST['kota']."',
		'".$_POST['telp']."',
		'".$_POST['brg']."',
		'".$_POST['namabrg']."',
		'".$qty."',
		'".$_POST['satuan']."',
		'$disc',
		'$disc2',
		'$disc3',
		'$discrp',
		'$harga',
		'$netto',
		'".$_SESSION["sess_user_id"]."', 1
		)";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		//3. update stok
		$SQL = "UPDATE stock SET qtyin = qtyin + $qty WHERE kodebrg = '".$_POST['brg']."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		//echo $SQL; exit();
		//4. update hargabeli
		$SQL = "UPDATE stock SET modal = ".$harga." WHERE kodebrg = '".$_POST['brg']."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		
		//5. insert/update hutang
		//5a. cari rekening kredit
		$SQL = "SELECT norek FROM setting WHERE setting = 'PERSEDIAAN'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$baris = mysql_fetch_array($hasil);
		$rekkredit = $baris['norek'];
		
		//5b. cek
		$SQL = "SELECT * FROM hutang WHERE kode = '".$_POST["supp"]."' AND nomor = '".$nomor."'";
		$hasil = mysql_query($SQL) or die(mysql_error());
		if(mysql_num_rows($hasil) < 1){
			//insert ke hutang
			$SQLi = "INSERT into hutang(id, tgl, kode, nota, nama, alamat, saldo, rekdebet, rekkredit, keterangan, sub, nomor) VALUES(
			'',
			'".baliktgl($_POST['tgl_transaksi'])."',
			'".$_POST['supp']."',
			'".$_POST['nonota']."',
			'".$_POST['namasupp']."',
			'".$_POST['alamat']."',
			'$netto',
			'3010000',
			'$rekkredit',
			'',
			'".$_POST['divisi']."',
			'$nomor'
			)";
			$hasili = mysql_query($SQLi);			
		} else {
			//update ke hutang
			$SQLu = "UPDATE hutang SET saldo = saldo + '".$netto."' WHERE kode = '".$_POST["supp"]."' AND nomor = '".$nomor."'";
			$hasilu = mysql_query($SQLu);
			//echo $SQLu; exit();
		}
		
		//link back
		if($_POST['nomor']<>""){
			$strurl = "index.php?mn=pembelian_edit&nonota=".$_POST['nonota']."&supp=".$_POST['supp']."&alamat=".$_POST['alamat']."&kota=".$_POST['kota']."&telp=".$_POST['telp']."&tgl_transaksi=".$_POST['tgl_transaksi']."&saldo=".$_POST['saldo']."&rek=".$_POST['rek']."&namarek=".$_POST['namarek']."&nomor=".$_POST['nomor']."&namasupp=".$_POST['namasupp']."&sub=".$_POST['sub'];
			if($_POST['cmd2']=="edit"){
				$strurl = "pembelian_edit.php?nonota=".$_POST['nonota']."&supp=".$_POST['supp']."&alamat=".$_POST['alamat']."&kota=".$_POST['kota']."&telp=".$_POST['telp']."&tgl_transaksi=".$_POST['tgl_transaksi']."&saldo=".$_POST['saldo']."&rek=".$_POST['rek']."&namarek=".$_POST['namarek']."&nomor=".$_POST['nomor']."&namasupp=".$_POST['namasupp']."&sub=".$_POST['sub'];
			}
		} else {
			$strurl = "pembelian_edit.php?nonota=".$_POST['nonota']."&supp=".$_POST['supp']."&alamat=".$_POST['alamat']."&kota=".$_POST['kota']."&telp=".$_POST['telp']."&tgl_transaksi=".$_POST['tgl_transaksi']."&saldo=".$_POST['saldo']."&rek=".$_POST['rek']."&namarek=".$_POST['namarek']."&nomor=".$nomor."&namasupp=".$_POST['namasupp']."&sub=".$_POST['divisi'];
		}
	break;
	case "del_beli" :
		$SQL = "SELECT sub FROM mutasi WHERE id = '".$_GET['id']."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$baris = mysql_fetch_array($hasil);
		if($_SESSION["sess_kelasuser"]=="User" && $baris[0] <> $_SESSION["sess_tipe"]){
			include "otentik_inv_user.php";
			exit(); 
		}
		
		$SQL = "UPDATE mutasi SET status = 0 WHERE id = '".$_GET['id']."'";
		$hasil=mysql_query($SQL, $dbh_jogjaide);
		
		//update stok
		$SQL = "UPDATE stock SET qtyin = qtyin - ".$_GET['qtyin']." WHERE kodebrg = '".$_GET['brg']."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		
		//update hutang
		$SQL = "UPDATE hutang SET saldo = saldo - '".$_GET['netto']."' WHERE kode = '".$_GET["supp"]."' AND nomor = '".$_GET['nomor']."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		//echo $SQL; exit();

		$strurl = "index.php?mn=pembelian&nonota=".$_GET['nonota']."&supp=".$_GET['supp']."&alamat=".$_GET['alamat']."&kota=".$_GET['kota']."&telp=".$_GET['telp']."&tgl_transaksi=".$_GET['tgl_transaksi']."&saldo=".$_GET['saldo']."&rek=".$_GET['rek']."&namarek=".$_GET['namarek']."&nomor=".$_GET['nomor']."&namasupp=".$_GET['namasupp'];
		if($_GET['cmd2']=="edit"){
		$strurl = "pembelian_edit.php?nonota=".$_GET['nonota']."&supp=".$_GET['supp']."&alamat=".$_GET['alamat']."&kota=".$_GET['kota']."&telp=".$_GET['telp']."&tgl_transaksi=".$_GET['tgl_transaksi']."&saldo=".$_GET['saldo']."&rek=".$_GET['rek']."&namarek=".$_GET['namarek']."&nomor=".$_GET['nomor']."&namasupp=".$_GET['namasupp']."&sub=".$_GET['sub'];
		}
	break;
	case "del_jual" :
		$SQL = "UPDATE mutasi SET status = 0 WHERE id = '".$_GET['id']."'";
		$hasil=mysql_query($SQL, $dbh_jogjaide);
		
		//update stok
		$SQL = "UPDATE stock SET qtyout = qtyout - ".$_GET['qtyout']." WHERE kodebrg = '".$_GET['brg']."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		
		//update piutang
		$SQL = "UPDATE piutang SET saldo = saldo - '".$_GET['netto']."' WHERE sub = '".$_GET["sub"]."' AND nomor = '".$_GET['nomor']."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		
		$strurl = "index.php?mn=penjualan&nonota=".$_GET['nonota']."&supp=".$_GET['supp']."&alamat=".$_GET['alamat']."&kota=".$_GET['kota']."&telp=".$_GET['telp']."&tgl_transaksi=".$_GET['tgl_transaksi']."&saldo=".$_GET['saldo']."&rek=".$_GET['rek']."&namarek=".$_GET['namarek']."&nomor=".$_GET['nomor']."&namasupp=".$_GET['namasupp'];
		if($_GET['cmd2']=="edit"){
		$strurl = "penjualan_edit.php?nonota=".$_GET['nonota']."&supp=".$_GET['supp']."&alamat=".$_GET['alamat']."&kota=".$_GET['kota']."&telp=".$_GET['telp']."&tgl_transaksi=".$_GET['tgl_transaksi']."&saldo=".$_GET['saldo']."&rek=".$_GET['rek']."&namarek=".$_GET['namarek']."&nomor=".$_GET['nomor']."&namasupp=".$_GET['namasupp']."&sub=".$_GET['sub'];
		}
	break;
	case "del_mutasi" :
		$id = $_POST[tambah];
		$banyaknya = count($id);
		for ($i=0; $i<$banyaknya; $i++) {
			$SQL = "UPDATE mutasi SET status = 0 WHERE id = '".$id[$i]."'";
			$hasil = mysql_query($SQL, $dbh_jogjaide);
		}
		$strurl = "index.php?mn=mutasi";
	break;
	case "del_stok" :
		$id = $_POST[tambah];
		$banyaknya = count($id);
		for ($i=0; $i<$banyaknya; $i++) {
			$SQL = "UPDATE stock SET status = 0 WHERE kodebrg = '".$id[$i]."'";
			$hasil = mysql_query($SQL, $dbh_jogjaide);
		}
		$strurl = "index.php?mn=persediaan&nama=".$_POST['nama']."&kdbarang=".$_POST['kdbarang']."&group=".$_POST['group'];
	break;
	case "del_subkon" :
		$id = $_POST[tambah];
		$banyaknya = count($id);
		for ($i=0; $i<$banyaknya; $i++) {
			$SQL = "DELETE FROM subkon  WHERE id = '".$id[$i]."'";
			$hasil = mysql_query($SQL, $dbh_jogjaide);
			$SQL = "DELETE FROM subkon_detail WHERE subkon_id = '". $id[$i] ."'";
			$hasil = mysql_query($SQL, $dbh_jogjaide);
		}
		$strurl = "subkon_ls.php?mn=persediaan&nama=".$_POST['nama']."&blok=".$_POST['blok']."&tipe_luas=".$_POST['tipe_luas'];
	break;
	case "add_stok" :
		$isi = ereg_replace("[^0-9]", "", $_POST['isi']);
		$modal = ereg_replace("[^0-9]", "", $_POST['modal']);
		$hargaeceran = ereg_replace("[^0-9]", "", $_POST['hargaeceran']);
		$hargapartai = ereg_replace("[^0-9]", "", $_POST['hargapartai']);
		$SQL = "INSERT into stock(kodebrg, divisi, expedisi, namabrg, satuank, isi, satuanb, grup, modal, norek, hargaeceran, hargapartai, status) VALUES('".$_POST['kodebrg']."','".$_POST['divisi']."','".$_POST['expedisi']."','".$_POST['namabrg']."','".$_POST['satuank']."','".$isi."','".$_POST['satuanb']."','".$_POST['group']."','".$modal."','".$_POST['norek']."',  '".$hargaeceran."',  '".$hargapartai."', 1)";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "index.php?mn=persediaan";
	break;
	case "add_stokRumah" :
		$isi = preg_replace('#[^0-9]#', '', $_POST['isi']);
		$modal = preg_replace('#[^0-9]#', '', $_POST['modal']);
		$hargaeceran = preg_replace('#[^0-9]#', '', $_POST['hargaeceran']);
		$hargapartai = preg_replace('#[^0-9]#', '', $_POST['hargapartai']);
		$kpr = preg_replace('#[^0-9]#', '', $_POST['kpr']);

		$SQL = "INSERT into stock(kodebrg, divisi, expedisi, namabrg, satuank, isi, satuanb, grup, modal, norek, hargaeceran, hargapartai, status, kpr) VALUES('".$_POST['kodebrg']."','".$_POST['divisi']."','".$_POST['expedisi']."','".$_POST['namabrg']."','".$_POST['satuank']."','".$isi."','".$_POST['satuanb']."','".$_POST['group']."','".$modal."','".$_POST['norek']."',  '".$hargaeceran."',  '".$hargapartai."', 1, '".$kpr."')";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "rumah_ls.php";
	break;
	case "upd_stok" :
		$isi = preg_replace('#[^0-9]#', '', $_POST['isi']);
		$modal = preg_replace('#[^0-9]#', '', $_POST['modal']);
		$hargaeceran = preg_replace('#[^0-9]#', '', $_POST['hargaeceran']);
		$hargapartai = preg_replace('#[^0-9]#', '', $_POST['hargapartai']);
		$SQL = "UPDATE stock SET namabrg = '".$_POST['namabrg']."', divisi = '".$_POST['divisi']."', expedisi = '".$_POST['expedisi']."', satuank = '".$_POST['satuank']."', isi = '".$isi."', satuanb = '".$_POST['satuanb']."', grup = '".$_POST['group']."', modal = '".$modal."', norek = '".$_POST['norek']."', kodebrg = '".$_POST['kodebrg']."', hargaeceran = '".$hargaeceran."', hargapartai = '".$hargapartai."' WHERE kodebrg = '".$_POST['id']."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "index.php?mn=persediaan";
	break;
	case "upd_stokRumah" :
		$isi = preg_replace('#[^0-9]#', '', $_POST['isi']);
		$modal = preg_replace('#[^0-9]#', '', $_POST['modal']);
		$hargaeceran = preg_replace('#[^0-9]#', '', $_POST['hargaeceran']);
		$hargapartai = preg_replace('#[^0-9]#', '', $_POST['hargapartai']);
		$kpr = preg_replace('#[^0-9]#', '', $_POST['kpr']);
		$SQL = "UPDATE stock SET namabrg = '".$_POST['namabrg']."', divisi = '".$_POST['divisi']."', expedisi = '".$_POST['expedisi']."', satuank = '".$_POST['satuank']."', isi = '".$isi."', satuanb = '".$_POST['satuanb']."', grup = '".$_POST['group']."', modal = '".$modal."', norek = '".$_POST['norek']."', kodebrg = '".$_POST['kodebrg']."', hargaeceran = '".$hargaeceran."', hargapartai = '".$hargapartai."', kpr = '".$kpr."' WHERE kodebrg = '".$_POST['id']."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "rumah_ls.php";
	break;
	case "del_supp" :
		$id = $_POST[tambah];
		$banyaknya = count($id);
		for ($i=0; $i<$banyaknya; $i++) {
			$SQL = "UPDATE supplier SET status = 0 WHERE kode = '".$id[$i]."'";
			$hasil = mysql_query($SQL, $dbh_jogjaide);
		}
		$strurl = "index.php?mn=sp&nama=".$_POST['nama']."&alamat=".$_POST['alamat']."&kota=".$_POST['kota'];
	break;
	case "add_supp" :
		$SQL = "INSERT INTO supplier(kode, nama, alamat, kota, telp, norek, namabank, rekbank, anbank, divisi, status) VALUES('".$_POST['kode']."', '".$_POST['nama']."', '".$_POST['alamat']."', '".$_POST['kota']."', '".$_POST['telp']."', '".$_POST['norek']."', '".$_POST['namabank']."', '".$_POST['rekbank']."', '".$_POST['anbank']."', '".$_POST['divisi']."',  1)";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "index.php?mn=sp";
	break;
	case "upd_supp" :
		$SQL = "UPDATE supplier SET nama = '".$_POST['nama']."', alamat = '".$_POST['alamat']."', kota = '".$_POST['kota']."', telp = '".$_POST['telp']."', norek = '".$_POST['norek']."', namabank = '".$_POST['namabank']."', rekbank = '".$_POST['rekbank']."', anbank = '".$_POST['anbank']."',  divisi = '".$_POST['divisi']."', kode = '".$_POST['kode']."' WHERE kode = '".$_POST['id']."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "index.php?mn=sp";
	break;
	case "del_kons" :
		$id = $_POST[tambah];
		$banyaknya = count($id);
		for ($i=0; $i<$banyaknya; $i++) {
			$SQL = "UPDATE konsumen SET status = 0 WHERE kode = '".$id[$i]."'";
			$hasil = mysql_query($SQL, $dbh_jogjaide);
		}
		$strurl = "index.php?mn=kons&nama=".$_POST['nama']."&alamat=".$_POST['alamat']."&kota=".$_POST['kota'];
	break;
	case "add_kons" :
		$SQL = "INSERT INTO konsumen(kode, nama, alamat, kota, telp, norek, plafon, umur, divisi, status) VALUES('".$_POST['kode']."', '".$_POST['nama']."', '".$_POST['alamat']."', '".$_POST['kota']."', '".$_POST['telp']."', '".$_POST['norek']."', '".$_POST['plafon']."', '".$_POST['umur']."', '".$_POST['divisi']."', 1)";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "index.php?mn=kons";
	break;
	case "upd_kons" :
		$SQL = "UPDATE konsumen SET nama = '".$_POST['nama']."', alamat = '".$_POST['alamat']."', kota = '".$_POST['kota']."', telp = '".$_POST['telp']."', norek = '".$_POST['norek']."', plafon = '".$_POST['plafon']."', umur = '".$_POST['umur']."', divisi = '".$_POST['divisi']."', kode = '".$_POST['kode']."' WHERE kode = '".$_POST['id']."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "index.php?mn=kons";
	break;
        case "add_bj" :
		$SQL = "INSERT INTO bahanjadi(id, kodeinduk, kodeanak, nama, qty, satuan, kemasan, status) VALUES('', '".$_POST['id']."', '".$_POST['kodeanak']."', '".$_POST['namabrg']."', '".$_POST['isi']."', '".$_POST['satuan']."', '".$_POST['kemasan']."', 1)";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "master_bahanjadi.php?id=".$_POST['id'];
	break;
     case "upd_bj" :
		$SQL = "UPDATE bahanjadi SET kode = '".$_POST['kode']."', nama = '".$_POST['namabrg']."', 
                    qty = '".$_POST['isi']."', satuan = '".$_POST['satuan']."', kemasan = '".$_POST['kemasan']."' WHERE kode = '".$_POST['id']."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "index.php?mn=bj";
     case "upd_angsuran" :
		$nilai = preg_replace('#[^0-9]#', '', $_POST['nilai']);
		$SQL = "UPDATE $database.piutang_detail SET posted = 1, nilai = '".$nilai."', jtempo = '".baliktgl($_POST['jtempo'])."' WHERE id = '".$_POST['id']."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		if(isset($_POST["cancel_angsuran"])){			
			$SQL = "UPDATE $database.piutang_detail SET posted = 0 WHERE id = '".$_POST['id']."'";
			$hasil = mysql_query($SQL, $dbh_jogjaide);
		}
		// jurnal
			// kas vs piutang angsuran
			// link ke jurnal_srb
					$tglposjtempo = $_POST['jtempo'];
					$SQL = "INSERT INTO $database.jurnal_srb(id, tanggal, jenis, kd, kk, ket, ket2, jumlah, dollar, sub, divisi, nobukti, bulan, user_id) VALUES (
					'',
					'".baliktgl($_POST['jtempo'])."',
					'Debet',
					'1110001',
					'1130002',
					'Kas',
					'Piutang Angsuran @$tglposjtempo',
					'".$nilai."',
					'0',
					'".$_SESSION["sess_tipe"]."',
					'".$_SESSION["sess_tipe"]."',
					'". $_POST["ida"] ."',
					'$bulan',
					'".$_SESSION["sess_user_id"]."'
					)";
					$hasil=mysql_query($SQL, $dbh_jogjaide);

		$strurl = "angsuran.php?ida=".$_POST["ida"]."&nomor=".$_POST["nomor"];
	break;

     case "cancel_angsuran" :
		$nilai = preg_replace('#[^0-9]#', '', $_POST['nilai']);
	break;
    case "del_bj" :
	$SQL = "UPDATE bahanjadi SET status = 0 WHERE id = '".$_GET['iddel']."'";
	$hasil = mysql_query($SQL, $dbh_jogjaide);
	$strurl = "master_bahanjadi.php?id=".$_GET['id'];
	break;
}
//echo $SQL; echo "<br>"; echo $strurl; echo "<br>"; echo $cmd; 
header("location: ".$strurl);
?>
