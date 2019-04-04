<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "../class/MysqliDb.php";
include "konek.php";


$db->where ("parent_id", 0);
$users = $db->get("jenjang_produk");
if ($db->count > 0)
    foreach ($users as $user) { 
        $data[] = $user["label"];
    }	

 echo  json_encode($users);
?>