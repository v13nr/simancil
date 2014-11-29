<?php 
	// Agar memastikan bahwa halaman ini diakses dengan parameter POST: cari
	//isset($_POST['cari']) or die('Error parameter');
	
	include ("../include/globalx.php");	

	include 'JSON.php'; // panggil library untuk konversi variable PHP ke JSON
	$json = new Services_JSON();
	
	$cari = $_POST['cari'];
	$hasil = mysql_query("SELECT * FROM rekening WHERE substr(norek,-3) !='000' AND namarek LIKE '%$cari%'", $dbh_jogjaide);
//	if($query && mysql_num_rows($query, $dbh_jogjaide) > 0){
	  $data = array(); // variable ini akan menampung keseluruhan hasil query
	  while($row = mysql_fetch_array($hasil)){
		$data[] = $row;
	  }
	  echo $json->encode($data); // fungsi untuk konversi variable PHP ke JSON
	//}
	//else 
	echo $json->encode(NULL);
?>
