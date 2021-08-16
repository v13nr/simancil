<?php 

	$host ="localhost";
    $user="root";
    $password="99";
    $database="simapos2";
    $dbh_jogjaide = mysql_connect($host,$user,$password) or die("Koneksi server gagal");
    mysql_select_db($database);
	$url_site = "http://localhost/sima/modules/accounting/gli/";
	
	define('SQL_HOST',     'localhost');
	define('SQL_USER',     'root');
	define('SQL_PASSWD',   '99');
	define('SQL_DATABASE', 'simapos2');
	define('SQL_PREFIX',   'phpc_');
	define('SQL_TYPE',     'mysqli');
	
	// MySQL configuration
define('HOST','localhost');        // Your database server
define('USER','root');        // Your mysql username
define('PASS','99');                // Your mysql password
define('DB','simapos2');        // Your mysql database name
define('SITE_TITLE','NEGARA AIR');
define('MENU_TITLE','');
define( 'ABSPATH', dirname(__FILE__) . '/' );


	
?>