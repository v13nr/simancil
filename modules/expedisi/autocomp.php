<?php 
 include '../../config_sistem.php';
$q = strtolower($_GET["q"]);
//if (!$q) return;
//$db = new mysqli($host, $user ,$password, $database);

if(!$dbh_jogjaide) {
        echo 'ERROR: Could not connect to the database.';
} else {
	//AND divisi = '".$_GET['divisi']."'
	$SQL = "SELECT kodebrg, namabrg FROM $database.stock WHERE (namabrg LIKE '%$q%' OR kodebrg LIKE '%$q%') LIMIT 20";
	if(isset($_GET["tipe"])){
		switch($_GET["tipe"]){
			case "resi" : 
				$SQL = "SELECT nonota as kode, nama_pengirim as ket, alamat_penerima as ket2 FROM expedisi WHERE nonota LIKE '%".$q."%' OR nama_pengirim LIKE '%".$q."%'  OR alamat_penerima LIKE '%".$q."%'  LIMIT 20";
				break;
			case "armada" : 
				$SQL = "SELECT id as kode, sopir as ket, nopol as ket2 FROM armada WHERE nopol LIKE '%".$q."%' OR sopir LIKE '%".$q."%'  LIMIT 20";
				break;
			default :
				$SQL = "SELECT kodebrg, namabrg FROM $database.stock WHERE (namabrg LIKE '%$q%' OR kodebrg LIKE '%$q%')  LIMIT 20";
			break;
		}	
	}
    $query = mysql_query($SQL, $dbh_jogjaide);
    if($query) {
           
            while ($result = mysql_fetch_array($query)) {
                echo "$result[kode] - $result[ket] - $result[ket2] |$result[kode]-$result[ket]-$result[ket2]\n";
            }
    } else {
            echo 'ERROR: There was a problem with the query.';
    }
}
?>
