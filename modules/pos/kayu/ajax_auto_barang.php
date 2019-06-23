<?php 
include "../include/globalx.php";
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
			case "Project" : 
				$SQL = "SELECT kodebrg, namabrg FROM $database.stock WHERE (namabrg LIKE '%$q%' OR kodebrg LIKE '%$q%') AND grup = '". $_GET["tipe"] ."'  LIMIT 20";
				break;
			case  "NonProject" :
				$SQL = "SELECT kodebrg, namabrg FROM $database.stock WHERE (namabrg LIKE '%$q%' OR kodebrg LIKE '%$q%') AND grup != 'Project' AND grup != 'Rumah' AND grup != 'Jasa'  LIMIT 20";
				break;
			default :
				$SQL = "SELECT kodebrg, namabrg FROM $database.stock WHERE (namabrg LIKE '%$q%' OR kodebrg LIKE '%$q%')  LIMIT 20";
			break;
		}	
	}
    $query = mysql_query($SQL, $dbh_jogjaide);
    if($query) {
           
            while ($result = mysql_fetch_array($query)) {
                echo "$result[namabrg] - $result[kodebrg] |$result[kodebrg]\n";
            }
    } else {
            echo 'ERROR: There was a problem with the query.';
    }
}
?>
