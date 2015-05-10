<?php 

	$host ="localhost";
    $user="root";
    $password="TidakAda";
    $database="danar";
    $dbh_jogjaide = mysql_connect($host,$user,$password) or die("Koneksi server gagal");
    mysql_select_db($database);
	$url_site = "http://localhost/sima/modules/accounting/gli/";
	
	define('SQL_HOST',     'localhost');
	define('SQL_USER',     'root');
	define('SQL_PASSWD',   'TidakAda');
	define('SQL_DATABASE', 'sima');
	define('SQL_PREFIX',   'phpc_');
	define('SQL_TYPE',     'mysqli');
	
	// MySQL configuration
define('HOST','localhost');        // Your database server
define('USER','root');        // Your mysql username
define('PASS','TidakAda');                // Your mysql password
define('DB','sima');        // Your mysql database name
define('SITE_TITLE','PT. Bumi Permai');
define('MENU_TITLE','');
define( 'ABSPATH', dirname(__FILE__) . '/' );
	
?>