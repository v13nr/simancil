<?php
include "../../../config_sistem.php";
$q = strtolower($_GET["q"]);
//if (!$q) return;
//$db = new mysqli($host, $user ,$password, $database);

if(!$dbh_jogjaide) {
        echo 'ERROR: Could not connect to the database.';
} else {
	//AND divisi = '".$_GET['divisi']."'
	if(isset($_GET["user"])){
	$SQL = "SELECT user_name, real_name FROM $database.users WHERE real_name LIKE '%$q%' AND divisi = '".$_GET['divisi']."' AND grup = '".$_GET['grup']."' LIMIT 20";
	} else {
	$SQL = "SELECT user_name, real_name FROM $database.users WHERE real_name LIKE '%$q%' AND divisi = '".$_GET['divisi']."' LIMIT 20";
	
	}
    $query = mysql_query($SQL, $dbh_jogjaide);
    if($query) {
           
            while ($result = mysql_fetch_array($query)) {
                echo "$result[real_name]  |$result[user_name]\n";
            }
    } else {
            echo 'ERROR: There was a problem with the query.';
    }
}
?>
