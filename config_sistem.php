<?php 
	@session_start();
	$host ="localhost";
    $user="root";
    $password="TidakAda";
    $database="sima_expedisi";
    $dbh_jogjaide = mysql_connect($host,$user,$password) or die("Koneksi server gagal");
    mysql_select_db($database);
	$url_site = "http://localhost/sima_expedisi/modules/accounting/gli/";
	
	define('SQL_HOST',     'localhost');
	define('SQL_USER',     'root');
	define('SQL_PASSWD',   'TidakAda');
	define('SQL_DATABASE', 'sima_expedisi');
	define('SQL_PREFIX',   'phpc_');
	define('SQL_TYPE',     'mysqli');
	
	// MySQL configuration
define('HOST','localhost');        // Your database server
define('USER','root');        // Your mysql username
define('PASS','TidakAda');                // Your mysql password
define('DB','sima_expedisi');        // Your mysql database name
define('SITE_TITLE','CV. GGE');
define('MENU_TITLE','');
define( 'ABSPATH', dirname(__FILE__) . '/' );

		
?>