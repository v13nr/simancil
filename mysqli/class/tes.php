<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "MysqliDb.php";
$db = new MysqliDb ('localhost', 'root', '', 'sima') or die("unhost");


$cols = Array ("namabrg", "kodebrg");
$users = $db->get ("stock", null, $cols);
if ($db->count > 0)
    foreach ($users as $user) { 
        print_r ($user);
    }
	
?>