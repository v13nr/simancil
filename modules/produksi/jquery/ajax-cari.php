<?php 
 // pastikan file ini diakses dengan mengirimkan variable POST dengan nama "nip"
 isset($_GET['id']) or die('Kirim parameter id');

 require_once("globalx.php");
  $id = $_GET['id'];
 switch($_GET['cari']){
	case "supplier" :
		if ($_GET['mode']=="cp") {
 			$query = mysql_query("SELECT cp FROM supplier WHERE id = '$id'");
		}
	break;
 }
 @list($nama) = mysql_fetch_array($query);
 echo $nama; // beri response nilai 
?>