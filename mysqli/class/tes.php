<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include "../../config_sistem_i.php";


$cols = Array ("namabrg", "kodebrg");
$users = $db->get ("stock_copy", null, $cols);
if ($db->count > 0)
    foreach ($users as $user) { 
        print_r ($user);
    }
	
?>