<?
session_start();
include ("../include/globalx.php");
include ("../include/functions.php");
include ("otentik_adkeu.php");

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
	case "add_memorial" :
		//1. cari tipe dan nomor jurnal
		/*
		$nomor = 1;
		$tipe = "JKopMemorial";
		$SQL = "SELECT max(nomor) FROM jurnal_srb WHERE tipe = '$tipe'";
		$hasil = mysql_query($SQL);
		$baris = mysql_fetch_array($hasil);
		if ($baris[0]>=0) {
			$nomor = $baris[0] + 1;
		}
		*/
		
				//header
					$SQLa = "insert into $database.jurnal_header(id, name, address, information, tanggal) values(
					'',
					'".$_POST['namapl']."',
					'$nomor',
					'".$_POST['information']."',
					'".baliktgl($_POST['tgl_transaksi'])."'
					)";
					//echo $SQLa; exit();
					$hasila = mysql_query($SQLa, $dbh_jogjaide);
					$id_jh = mysql_insert_id();
					
		//looping inputan
		for ($i=1; $i<=10; $i++) {
			if($_POST['coa_skada_'.$i] <> ""){
					
				if ($_POST['dk_'.$i] == "debet"){
					//echo $i."<br>";	
					$SQLa = "insert into $database.jurnal(id, buyer_id, coa, keterangan, debet, kredit, user_id, nobukti) values(
					'',
					'$id_jh',
					'". $_POST["coa_skada_".$i] ."',
					'". $_POST["description_".$i] ."',
					'". $_POST["jumlah_".$i] ."',
					'0',
					'".$_SESSION["sess_user_id"]."',
					'".$_POST["no_referensi_".$i]."'
					)";
					//echo $SQLa; exit();
					$hasila = mysql_query($SQLa, $dbh_jogjaide);
				} // end if debet
				if ($_POST['dk_'.$i] == "kredit"){
					//echo $i."<br>";	
					$SQLa = "insert into $database.jurnal(id, buyer_id, coa, keterangan, debet, kredit, user_id, nobukti) values(
					'',
					'$id_jh',
					'". $_POST["coa_skada_".$i] ."',
					'". $_POST["description_".$i] ."',
					'0',
					'". $_POST["jumlah_".$i] ."',
					'".$_SESSION["sess_user_id"]."',
					'".$_POST["no_referensi_".$i]."'
					)";
					//echo $SQLa; exit();
					$hasila = mysql_query($SQLa, $dbh_jogjaide);
					$jumlah = $jumlah + $_POST["jumlah_".$i];
				} // end if kredit
			} //end if coa tidak kosong
		} // looping inputan
		// link ke jurnal_srb
					//cari jumlah dari memorial sudah di atas
					$SQL = "INSERT INTO $database.jurnal_srb(id, tanggal, jumlah, memorial_id) VALUES('', 
					'".baliktgl($_POST['tgl_transaksi'])."', '".$jumlah."', '$id_jh')";
					//echo $SQL; exit();
					$hasil = mysql_query($SQL, $dbh_jogjaide);
		$strurl = "index.php?mn=jurnal";
	break;
}
//echo $SQL; echo "<br>"; echo $strurl; echo "<br>"; echo $cmd; 
//echo '<pre>'; var_dump($_POST); echo '</pre>';
header("location: ".$strurl);
?>