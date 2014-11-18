<?php
include "../include/globalx.php";
$q = strtolower($_GET["q"]);
//if (!$q) return;
//$db = new mysqli($host, $user ,$password, $database);

if(!$dbh_jogjaide) {
        echo 'ERROR: Could not connect to the database.';
} else {
	//AND divisi = '".$_GET['divisi']."'
	if(isset($_GET["grup"])){
	$SQL = "SELECT kodebrg, namabrg FROM $database.stock WHERE namabrg LIKE '%$q%' AND divisi = '".$_GET['divisi']."' AND grup = '".$_GET['grup']."' LIMIT 20";
	} else {
	$SQL = "SELECT kodebrg, namabrg FROM $database.stock WHERE namabrg LIKE '%$q%' AND divisi = '".$_GET['divisi']."' LIMIT 20";
	
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
