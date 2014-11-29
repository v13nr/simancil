<?php 

include "globalx.php";
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
	case "bahanbaku_masuk" :
		$str = $_POST['dk'];
		$supp_id = split('=',$str);
		//13-12-2012
		$tgl = substr($_POST['tgl_transaksi'],6,4) . "-" . substr($_POST['tgl_transaksi'],3,2) . "-" . substr($_POST['tgl_transaksi'],0,2);
		$SQL = "INSERT INTO sales_in(supp_id, name, address)
			VALUES(
				'".$supp_id[1]."',
				'".$_POST['cp']."',
				'".$tgl."'
			)";
		$hasil = mysql_query($SQL);
		$SQL = "SELECT MAX(id) FROM sales_in";
		$hasil = mysql_query($SQL);
		$baris = mysql_fetch_array($hasil);
		$buyer = $baris[0];
		$id = $_POST['nng'];
		$item = $_POST['nngqty'];
		$nama = $_POST['nngnama'];
		$satuan = $_POST['nngsatuan'];
		$harga = $_POST['nngharga'];
		$banyaknya = count($id);
		for ($i=0; $i<$banyaknya; $i++) {
			$SQL = "INSERT INTO temp_sales_in_detail(buyer_id, bb_id, name, price, count, jumlah) VALUES(
			'".$buyer."',
			'".$id[$i]."',
			'".$nama[$i]." :: ".$satuan[$i]."',
			'".$harga[$i]."',
			'".$item[$i]."',
			'".$item[$i] * $harga[$i]."'
			)";
			$hasil=mysql_query($SQL);
		}
		$SQLambil = "SELECT * FROM temp_sales_in_detail WHERE count >= 1 AND buyer_id = '".$buyer."'";
		$hasilambil = mysql_query($SQLambil);
			while($barisambil = mysql_fetch_array($hasilambil)) {
				$SQL = "INSERT INTO sales_in_detail(buyer_id, bb_id, name, price, count, jumlah) VALUES(
				'".$barisambil["buyer_id"]."',
				'".$barisambil["bb_id"]."',
				'".$barisambil["name"]."',
				'".$barisambil["price"]."',
				'".$barisambil["count"]."',
				'".$barisambil["jumlah"]."'
				)";
				echo $SQL."<br>";
				$hasil=mysql_query($SQL);
			}
		
		$strurl = "str_bahan_masuk.php?tes=ok";
	break;
}
//echo $SQLambil; echo "<br>"; echo $strurl; echo "<br>"; echo $cmd; 
header("location: ".$strurl);
 
?>