<?php 
include "../include/globalx.php";
$q = strtolower($_GET["q"]);
//if (!$q) return;
//$db = new mysqli($host, $user ,$password, $database);

if(!$dbh_jogjaide) {
        echo 'ERROR: Could not connect to the database.';
} else {
	//AND divisi = '".$_GET['divisi']."'
	$SQL = "SELECT kode, nama FROM konsumen WHERE nama LIKE '%$q%' AND divisi = '".$_GET['divisi']."' LIMIT 20";
    $query = mysql_query($SQL, $dbh_jogjaide);
    if($query) {
           
            while ($result = mysql_fetch_array($query)) {
                echo "$result[nama] - $result[kode] |$result[kode]\n";
            }
    } else {
            echo 'ERROR: There was a problem with the query.';
    }
}
?>
