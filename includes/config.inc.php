<?php  session_start();

include_once("../../../config_sistem.php");

// include common file
include_once 'library.php';
// include database class
include_once 'class.database.php';
// include image class
include_once 'class.img.php';



//chart
	// define database settings
	define('HOSTNAME',$host);
	define('DB_USERNAME',$user);
	define('DB_PASSWORD',$password);
	define('DB_NAME',$database);
	// admin email address
	define('ADMINISTRATOR_EMAIL','anangr2001@yahoo.com');

?>