<?php 
session_start();
include ("../include/globalx.php");
include ("../include/functions.php");
include ("otentik_gli.php");


$divisi = $_POST['divisi'];
if ($divisi==""){
	$divisi = $_GET['divisi'];
}
if($divisi != $_SESSION["sess_tipe"]){
	//die("Maaf Anda tidak mempunyai Akses ke Divisi ini.");
}
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
	case "upd_pajak" :
		$SQL = "UPDATE $database.pajak_detail SET 
		lr_sbl_pajak = '".$_POST["lr_sbl_pajak"]."',
		koreksi_fis = '".$_POST["koreksi_fis"]."',
		bb_gajipimpinan = '".$_POST["bb_gajipimpinan"]."',
		bb_sumbangan = '".$_POST["bb_sumbangan"]."',
		bb_pajak_penghsl = '".$_POST["bb_pajak_penghsl"]."',
		bb_rt_kantor = '".$_POST["bb_rt_kantor"]."',
		total_koreksi_fis = '".$_POST["total_koreksi_fis"]."',
		lr_fiskal = '".$_POST["lr_fiskal"]."',
		tkp = '".$_POST["tkp"]."',
		pdpt_kena_pajak = '".$_POST["pdpt_kena_pajak"]."',
		pdpt_kena_pajak_bulat = '".$_POST["pdpt_kena_pajak_bulat"]."',
		tarif_1 = '".$_POST["tarif_1"]."',
		tarif_2 = '".$_POST["tarif_2"]."',
		pph_terhutang = '".$_POST["pph_terhutang"]."' WHERE tahun = '".$_POST["tahun"]."'
		";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "pajak.php";
	break;
	case "upd_tahunaktif" :
			$SQL = "UPDATE periode set tahun = '".$_POST["tahun_next"]."'";
			$hasil = mysql_query($SQL, $dbh_jogjaide);
			$strurl = "tutup_tahun.php";
	break;
	case "upd_inv" :
		$nilai = ereg_replace("[^0-9]", "", $_POST['nilai']);
		$susut = ereg_replace("[^0-9]", "", $_POST['susut']);
		$SQL = "UPDATE $database.aktiva SET tgl = '".baliktgl($_POST['tgl'])."', nama = '".$_POST['nama']."', nilai = '".$nilai."', bagi = '".$_POST['bagi']."', susut = '".$susut."', tgl_akhir = '".baliktgl($_POST['tgl_akhir'])."', rekdebet = '".$_POST['rekdebet']."', rekkredit = '".$_POST['rekkredit']."' WHERE id = '".$_POST['id']."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "index.php?mn=inv";
	break;
	case "add_inv" :
		$nilai = ereg_replace("[^0-9]", "", $_POST['nilai']);
		$susut = ereg_replace("[^0-9]", "", $_POST['susut']);
		$SQL = "INSERT INTO $database.aktiva(id, tgl, nama, nilai, tarif, bagi, susut, tgl_akhir, rekdebet, rekkredit, 
		rek_d_bbsusut,
		rek_k_akmsusut,
		divisi, user_id, status) VALUES('', '".baliktgl($_POST['tgl'])."', '".$_POST['nama']."', '".$nilai."', '".$_POST['tarif']."', '".$_POST['bagi']."', '".$susut."', '".baliktgl($_POST['tgl_akhir'])."', '".$_POST['rekdebet']."', '".$_POST['rekkredit']."', 
		'".$_POST['rek_d_bbsusut']."',
		'".$_POST['rek_k_akmsusut']."',
		'".$_SESSION["sess_tipe"]."', '".$_SESSION["sess_user_id"]."', 1)";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
			$ida = mysql_insert_id();

		
		//input ke jurnal
		//1. cari divisi dan nomor jurnal
		$nomor = 1;
		$tipe = $_POST['divisi'];
		//13/08/2011
		$bulan = substr($_POST['tgl'],3,2).substr($_POST['tgl'],6,4);
		$SQL = "SELECT max(nobukti) FROM $database.jurnal_srb WHERE bulan = '$bulan'";
		//echo $SQL; exit();
		$hasil = mysql_query($SQL, $dbh_jogjaide) or die(mysql_error());
		$baris = mysql_fetch_array($hasil);
		if ($baris[0]>=0) {
			$nomor = $baris[0] + 1;
		}
		if($_POST['nobukti']<>""){
			$nomor = $_POST['nobukti'];
		}

		$nilai = ereg_replace("[^0-9]", "", $_POST['nilai']);
		$susut = ereg_replace("[^0-9]", "", $_POST['susut']);
			
		$SQL = "INSERT INTO $database.jurnal_srb(id, tanggal, aktiva_id, jenis, kd, kk, ket, ket2, jumlah, dollar, sub, divisi, nobukti, bulan, user_id) VALUES (
		'',
		'".baliktgl($_POST['tgl'])."',
		'".$ida."',
		'Debet',
		'".$_POST['rekdebet']."',
		'".$_POST['rekkredit']."',
		'".$_POST['nama']."',
		'".$_POST['nama']."',
		'".$nilai."',
		'0',
		'".$_SESSION["sess_tipe"]."',
		'".$_SESSION["sess_tipe"]."',
		'$nomor',
		'$bulan',
		'".$_SESSION["sess_user_id"]."'
		)";
		$hasil=mysql_query($SQL, $dbh_jogjaide);
		
		//setup detail penyusutan
		$purchase_date = baliktgl($_POST['tgl']);
		$tahunperolehan = substr($purchase_date, 0,4);
		$bulanperolehan = substr($purchase_date, 5,2);
		
		$akhirperiode = $tahunperolehan."-12-31";
		$nilaiawal = ($nilai / $_POST["bagi"]) * ((12 - ($bulanperolehan * 1) + 1) / 12);
		$SQL = "INSERT INTO aktiva_details(id, posted, aktiva_id, nilai, mano_post) VALUES('', 0, '$ida', '$nilaiawal', '".$akhirperiode."')";
		$hasil=mysql_query($SQL, $dbh_jogjaide);
		
				$SQL = "SELECT a.rek_d_bbsusut as debet, a.rek_k_akmsusut as kredit, b.nilai as susut FROM $database.aktiva a, aktiva_details b WHERE a.id = b.aktiva_id AND a.id = '".$ida."'";
					$hasil=mysql_query($SQL, $dbh_jogjaide);
					$baris = mysql_fetch_array($hasil);
					$p_debet = $baris[0];
					$p_kredit = $baris[1];
					$susut = $baris[2];
					
					if($p_debet == "" || $p_kredit == ""){
						exit("Rekening default belum di set");
					}
			
					$SQL = "INSERT INTO $database.jurnal_srb(id, tanggal, jenis, kd, kk, ket, ket2, jumlah, dollar, sub, divisi, nobukti, bulan, user_id, aktiva_id) VALUES (
					'',
					'".$akhirperiode."',
					'Debet',
					'$p_debet',
					'$p_kredit',
					'Beban Penyusutan',
					'Akm. Penyusutan',
					'".$nilaiawal."',
					'0',
					'".$_SESSION["sess_tipe"]."',
					'".$_SESSION["sess_tipe"]."',
					'$nomor',
					'$bulan',
					'".$_SESSION["sess_user_id"]."',
					'".$ida."'
					)";
					$hasil=mysql_query($SQL, $dbh_jogjaide);
			
			
		for ($i=1;$i<= $_POST['bagi'];$i++) {
			$purchase_date_timestamp = strtotime($akhirperiode);
			$purchase_date_1year = strtotime("+$i year", $purchase_date_timestamp);
			$jtempo = date("Y-m-d", $purchase_date_1year);
			$SQL = "INSERT INTO aktiva_details(id, posted, aktiva_id, nilai, mano_post) VALUES('', 0, '$ida', '".$nilai / $_POST["bagi"]."', '$jtempo')";
			$hasil=mysql_query($SQL, $dbh_jogjaide);
			
					//cari pasangan norek untuk penyusutan
					$SQL = "SELECT a.rek_d_bbsusut as debet, a.rek_k_akmsusut as kredit, b.nilai as susut FROM $database.aktiva a, aktiva_details b WHERE a.id = b.aktiva_id AND a.id = '".$ida."'";
					$hasil=mysql_query($SQL, $dbh_jogjaide);
					$baris = mysql_fetch_array($hasil);
					$p_debet = $baris[0];
					$p_kredit = $baris[1];
					$susut = $baris[2];
					
					if($p_debet == "" || $p_kredit == ""){
						exit("Rekening default belum di set");
					}
			
					$SQL = "INSERT INTO $database.jurnal_srb(id, tanggal, jenis, kd, kk, ket, ket2, jumlah, dollar, sub, divisi, nobukti, bulan, user_id, aktiva_id) VALUES (
					'',
					'".$jtempo."',
					'Debet',
					'$p_debet',
					'$p_kredit',
					'Beban Penyusutan',
					'Akm. Penyusutan',
					'".$susut."',
					'0',
					'".$_SESSION["sess_tipe"]."',
					'".$_SESSION["sess_tipe"]."',
					'$nomor',
					'$bulan',
					'".$_SESSION["sess_user_id"]."',
					'".$ida."'
					)";
					$hasil=mysql_query($SQL, $dbh_jogjaide);
					
					$SQL = "UPDATE $database.aktiva_details SET posted = 1 WHERE aktiva_id = ".$ida;
					$hasil = mysql_query($SQL, $dbh_jogjaide);
					

		}

		$nilaiakhir = ($nilai / $_POST["bagi"] - $nilaiawal);
			
		$SQL = "UPDATE aktiva_details SET nilai = '".$nilaiakhir."' WHERE mano_post = '".$jtempo."' AND aktiva_id = ".$ida;
		$hasil=mysql_query($SQL, $dbh_jogjaide);
		$SQL = "UPDATE jurnal_srb SET jumlah = '".$nilaiakhir."' WHERE tanggal = '".$jtempo."' AND aktiva_id = ".$ida;
		$hasil=mysql_query($SQL, $dbh_jogjaide);
	
		
		$strurl = "inventaris_ls.php";

	break;
	case "del_aktiva" :
		$id = $_POST[tambah];
		$banyaknya = count($id);
		for ($i=0; $i<$banyaknya; $i++) {
			$SQL = "DELETE FROM $database.aktiva WHERE id = '".$id[$i]."'";
			$hasil = mysql_query($SQL, $dbh_jogjaide);
			$SQL = "DELETE FROM $database.aktiva_details WHERE aktiva_id = '".$id[$i]."'";
			$hasil = mysql_query($SQL, $dbh_jogjaide);
			$SQL = "DELETE FROM $database.jurnal_srb WHERE aktiva_id = '".$id[$i]."'";
			$hasil = mysql_query($SQL, $dbh_jogjaide);
		}
		$strurl = "inventaris_ls.php";
	break;
	case "add_divisi" :
		$SQL = "Insert into $database.divisi(subdiv, namadiv) VALUES('".$_POST['subdiv']."', '".$_POST['namadiv']."')";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "index.php?mn=div";
	break;
	case "upd_divisi" :
		$SQL = "UPDATE $database.divisi SET subdiv = '".$_POST['subdiv']."', namadiv = '".$_POST['namadiv']."' WHERE subdiv = '".$_POST['id']."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "index.php?mn=div";
	break;
	case "del_divisi" :
		$SQL = "DELETE FROM $database.divisi WHERE subdiv = '".$_GET['id']."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "index.php?mn=div";
	break;
	case "add_rekeningp" :
		$SQL = "INSERT INTO $database.rekening(norek, namarek, saldonormal, tipe, saldoawal, debet, kredit, saldoakhir, status, divisi) VALUES('".$_POST['induk'].$_POST['norek']."', '".$_POST['namarekening']."',  '".$_POST['saldonormal']."', '".$_POST['tipe']."', '".$_POST['saldoawal']."', '".$_POST['debet']."', '".$_POST['kredit']."', '".$_POST['saldoakhir']."', 1, '".$_SESSION['sess_tipe']."')";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "index.php?mn=rekp";
	break;
	case "upd_rekeningp" :
		$SQL = "UPDATE rekening SET namarek = '".$_POST['namarekening']."',  saldonormal = '".$_POST['saldonormal']."', tipe = '".$_POST['tipe']."' WHERE norek = '".$_POST['induk'].$_POST['norek']."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "index.php?mn=rekp";
	break;
	case "add_rekening" :
		$SQL = "INSERT INTO $database.rek(norek, namarek, tipe, tglinput, status, id_divisi) VALUES('".$_POST['norek']."', '".$_POST['namarek']."', '".$_POST['tipe']."', '".$wkt_disimpan."', 1, '".$_SESSION["sess_tipe"]."')";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		//insert juga ke rek pembantu
		$SQL = "INSERT INTO $database.rekening(norek, namarek, tipe, status, divisi) VALUES('".$_POST['norek']."0000', '".$_POST['namarek']."', '".$_POST['tipe']."', 1,'".$_SESSION["sess_tipe"]."')";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "../../../index.php?mn=rekening_ls&getmodule=".base64_encode('accounting/gli/');
	break;
	case "upd_rekening" :
		$SQL = "UPDATE $database.rek SET norek = '".$_POST['norek']."', namarek = '".$_POST['namarek']."', tipe = '".$_POST['tipe']."' WHERE norek = '".$_POST['id']."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		//update juga ke rekning pembantu
		//$SQL = "UPDATE $database.rekening SET namarek = '".$_POST['namarek']."', tipe = '".$_POST['tipe']."' WHERE norek = '".$_POST['id'].'0000'."'";
		//$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "../../../index.php?mn=rekening_ls&getmodule=".base64_encode('accounting/gli/');
	break;
	case "del_rekening" :
		$SQL = "DELETE FROM $database.rek WHERE norek = '".$_GET['id']."'";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		//delete juga di rek pembantu
		$SQL = "DELETE FROM $database.rekening where norek LIKE '".$_GET['id'].'%'."'";
		$hasil=mysql_query($SQL, $dbh_jogjaide);
		$strurl = "../../../index.php?mn=rekening_ls&getmodule=".base64_encode('accounting/gli/');
	break;
	case "del_rekp" :
		$id = $_POST[tambah];
		$banyaknya = count($id);
		for ($i=0; $i<$banyaknya; $i++) {
			$SQL = "DELETE FROM $database.rekening where norek = '".$id[$i]."'";
			$hasil=mysql_query($SQL, $dbh_jogjaide);
		}
		$strurl = "index.php?mn=rekp";
	break;
	case "add_jurnal" :
		periode($_POST['tgl_transaksi']);
		$tipe = $_POST['divisi'];
		$nomor = $_POST['bukti'];
		if(isset($_POST['karyawan_id'])){
			$split1 = explode('@',$_POST['keterangantransaksi']);
			$karyawan_id = $split1[1];
		}
		//asumsi jika nomor bukti terkirim berarti harus disimpan, karena nomor bukti harus unique
		$SQL = "INSERT INTO $database.nomorbukti(id, nomorbukti) VALUES ('', '". $nomor ."')";
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		//2. input jurnal
			
			$jumlah = ereg_replace("[^0-9.]", "", $_POST['jumlah']);
			if($_POST['dk']=="Kredit"){
				$SQL = "INSERT INTO $database.jurnal_srb(id, tipe_jurnal, tanggal, jenis, kd, kk, ket, ket2, jumlah, karyawan_id, dollar, sub, divisi, nobukti, bulan, user_id) VALUES (
				'',
				'".$_POST['tipe_jurnal']."',
				'".baliktgl($_POST['tgl_transaksi'])."',
				'".$_POST['dk']."',
				'".$_POST['norek2']."',
				'".$_POST['norek']."',
				'".$_POST['keterangantransaksi']."',
				'".$_POST['keteranganheader']."',
				'".$jumlah."',
				'$karyawan_id',
				'".$_POST['dollar']."',
				'$tipe',
				'".$_POST['divisi']."',
				'$nomor',
				'$bulan',
				'".$_SESSION["sess_user_id"]."'
				)";
			}
			if($_POST['dk']=="Debet"){
				$SQL = "INSERT INTO $database.jurnal_srb(id, tipe_jurnal, tanggal, jenis, kd, kk, ket, ket2, jumlah, karyawan_id, dollar, sub, divisi, nobukti, bulan, user_id) VALUES (
				'',
				'".$_POST['tipe_jurnal']."',
				'".baliktgl($_POST['tgl_transaksi'])."',
				'".$_POST['dk']."',
				'".$_POST['norek']."',
				'".$_POST['norek2']."',
				'".$_POST['keteranganheader']."',
				'".$_POST['keterangantransaksi']."',
				'".$jumlah."',
				'$karyawan_id',
				'".$_POST['dollar']."',
				'$tipe',
				'".$_POST['divisi']."',
				'$nomor',
				'$bulan',
				'".$_SESSION["sess_user_id"]."'
				)";
			}
			//echo $SQL;
			//exit();
			$hasil = mysql_query($SQL, $dbh_jogjaide);
			//$jurnal_id = mysql_insert_id();
		
		//3. lempar nilai default
		if($_POST['nobukti']<>""){
			 if ($_POST["khusus"]=="gaji" ) {
				$strurl = "index.php?mn=trans_jurnal_gaji&nobukti=".$nomor
				."&tgl_transaksi=".$_POST['tgl_transaksi']
				."&divisi=".$_POST['divisi']
				."&dk=".$_POST['dk']
				."&norek=".$_POST['norek']
				."&namarek=".$_POST['namarek']
				."&keteranganheader=".$_POST['keteranganheader']
				."&bulan=".$bulan;
			} elseif ($_POST["khusus"]=="kasbon" ) {
				$strurl = "jurnal_kasbon.php?nobukti=".$nomor
				."&tgl_transaksi=".$_POST['tgl_transaksi']
				."&divisi=".$_POST['divisi']
				."&dk=".$_POST['dk']
				."&norek=".$_POST['norek']
				."&namarek=".$_POST['namarek']
				."&keteranganheader=".$_POST['keteranganheader']
				."&bulan=".$bulan;
			} else {
				$strurl = "index.php?mn=trans_jurnal&nobukti=".$_POST['nobukti']
				."&tgl_transaksi=".$_POST['tgl_transaksi']
				."&divisi=".$_POST['divisi']
				."&dk=".$_POST['dk']
				."&norek=".$_POST['norek']
				."&namarek=".$_POST['namarek']
				."&keteranganheader=".$_POST['keteranganheader']
				."&bulan=".$_POST['bulan']
				;
			}
		} else if ($_POST["khusus"]=="pembelian" ) {
			$strurl = "index.php?mn=trans_jurnal_pbm&nobukti=".$nomor
			."&tgl_transaksi=".$_POST['tgl_transaksi']
			."&divisi=".$_POST['divisi']
			."&dk=".$_POST['dk']
			."&norek=".$_POST['norek']
			."&namarek=".$_POST['namarek']
			."&keteranganheader=".$_POST['keteranganheader']
			."&bulan=".$bulan;
		} else if ($_POST["khusus"]=="gaji" ) {
			$strurl = "index.php?mn=trans_jurnal_gaji&nobukti=".$nomor
			."&tgl_transaksi=".$_POST['tgl_transaksi']
			."&divisi=".$_POST['divisi']
			."&dk=".$_POST['dk']
			."&norek=".$_POST['norek']
			."&namarek=".$_POST['namarek']
			."&keteranganheader=".$_POST['keteranganheader']
			."&bulan=".$bulan;
		} else if ($_POST["khusus"]=="kasbon" ) {
			$strurl = "jurnal_kasbon.php?nobukti=".$nomor
			."&tgl_transaksi=".$_POST['tgl_transaksi']
			."&divisi=".$_POST['divisi']
			."&dk=".$_POST['dk']
			."&norek=".$_POST['norek']
			."&namarek=".$_POST['namarek']
			."&keteranganheader=".$_POST['keteranganheader']
			."&bulan=".$bulan;
		}
		else {
			$strurl = "index.php?mn=trans_jurnal&nobukti=".$nomor
			."&tgl_transaksi=".$_POST['tgl_transaksi']
			."&divisi=".$_POST['divisi']
			."&dk=".$_POST['dk']
			."&norek=".$_POST['norek']
			."&namarek=".$_POST['namarek']
			."&keteranganheader=".$_POST['keteranganheader']
			."&bulan=".$bulan
			;	
		}
	break;
	case "del_jurnal" :
		$SQL = "DELETE FROM $database.jurnal_srb WHERE id = ".$_GET['id'];
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$SQL = "UPDATE $database.mutasi SET status = 0 WHERE jurnal_id = '".$_GET['id']."'";
		$hasil=mysql_query($SQL);
		
		$strurl = "index.php?mn=trans_jurnal&nobukti=".$_GET['nobukti']
			."&tgl_transaksi=".$_GET['tgl_transaksi']
			."&dk=".$_GET['dk']
			."&norek=".$_GET['norek']
			."&namarek=".$_GET['namarek']
			."&keteranganheader=".$_GET['keteranganheader']
			."&divisi=".$_GET['divisi']
			."&bulan=".$_GET['bulan'];
	break;
	case "del_jurnal_gaji" :
		$SQL = "DELETE FROM $database.jurnal_srb WHERE id = ".$_GET['id'];
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$SQL = "UPDATE $database.mutasi SET status = 0 WHERE jurnal_id = '".$_GET['id']."'";
		$hasil=mysql_query($SQL);
		
		$strurl = "index.php?mn=trans_jurnal_gaji&nobukti=".$_GET['nobukti']
			."&tgl_transaksi=".$_GET['tgl_transaksi']
			."&dk=".$_GET['dk']
			."&norek=".$_GET['norek']
			."&namarek=".$_GET['namarek']
			."&keteranganheader=".$_GET['keteranganheader']
			."&divisi=".$_GET['divisi']
			."&bulan=".$_GET['bulan'];
	break;
	case "del_jurnal_kasbon" :
		$SQL = "DELETE FROM $database.jurnal_srb WHERE id = ".$_GET['id'];
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		$SQL = "UPDATE $database.mutasi SET status = 0 WHERE jurnal_id = '".$_GET['id']."'";
		$hasil=mysql_query($SQL);
		$strurl = "jurnal_kasbon.php?nobukti=".$_GET['nobukti']
			."&tgl_transaksi=".$_GET['tgl_transaksi']
			."&dk=".$_GET['dk']
			."&norek=".$_GET['norek']
			."&namarek=".$_GET['namarek']
			."&keteranganheader=".$_GET['keteranganheader']
			."&divisi=".$_GET['divisi']
			."&bulan=".$_GET['bulan'];
	break;
	case "posting_susut" :

		//input ke jurnal
		//1. cari divisi dan nomor jurnal
		$nomor = 1;
		//13/08/2011
		$bulan = substr($_GET['tgl'],3,2).substr($_GET['tgl'],6,4);
		$wkt_posting = Date("Y-m-d");

		$SQL = "SELECT max(nobukti) FROM $database.jurnal_srb WHERE bulan = '$bulan'";
		//echo $SQL; exit();
		$hasil = mysql_query($SQL, $dbh_jogjaide) or die(mysql_error());
		$baris = mysql_fetch_array($hasil);
		if ($baris[0]>=0) {
			$nomor = $baris[0] + 1;
		}
		if($_POST['nobukti']<>""){
			$nomor = $_POST['nobukti'];
		}
		//cari pasangan norek untuk penyusutan
		$SQL = "SELECT a.rek_d_bbsusut as debet, a.rek_k_akmsusut as kredit, b.nilai as susut FROM $database.aktiva a, aktiva_details b WHERE a.id = b.aktiva_id AND a.id = '".$_GET["ida"]."' AND b.id = ".$_GET["id"];
		$hasil=mysql_query($SQL, $dbh_jogjaide);
		$baris = mysql_fetch_array($hasil);
		$p_debet = $baris[0];
		$p_kredit = $baris[1];
		$susut = $baris[2];
		
		if($p_debet == "" || $p_kredit == ""){
			exit("Rekening default belum di set");
		}

		$SQL = "INSERT INTO $database.jurnal_srb(id, tanggal, jenis, kd, kk, ket, ket2, jumlah, dollar, sub, divisi, nobukti, bulan, user_id, aktiva_id) VALUES (
		'',
		'".baliktgl($_GET['tgl'])."',
		'Debet',
		'$p_debet',
		'$p_kredit',
		'Beban Penyusutan',
		'Akm. Penyusutan',
		'".$susut."',
		'0',
		'".$_SESSION["sess_tipe"]."',
		'".$_SESSION["sess_tipe"]."',
		'$nomor',
		'$bulan',
		'".$_SESSION["sess_user_id"]."',
		'".$_GET["ida"]."'
		)";
		$hasil=mysql_query($SQL, $dbh_jogjaide);
		
		$SQL = "UPDATE $database.aktiva_details SET posted = 1 WHERE id = ".$_GET['id'];
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		
		$strurl = "penyusutan.php?ida=".$_GET['ida'];
	break;
	
}
//echo $SQL; echo "<br>"; echo $strurl; echo "<br>"; echo $cmd; 
@header("location: ".$strurl);
?>