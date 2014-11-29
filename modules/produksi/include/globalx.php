<?php 
	
	$host ="localhost";
    $user="root";
    $password="BiasaAjaLahdulu";
    $database="nas_produksi";
    $dbh_produksi = mysql_connect($host,$user,$password) or die("Koneksi server gagal");
    mysql_select_db($database);
	//error_reporting(0);

?>
