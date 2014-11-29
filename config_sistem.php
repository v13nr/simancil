<?php 

	$host ="localhost";
    $user="simancil";
    $password="simancil";
    $database="simancil";
    $dbh_jogjaide = mysql_connect($host,$user,$password) or die("Koneksi server gagal");
    mysql_select_db($database);
	$url_site = "http://localhost/simancil/modules/accounting/gli/";
	
	define('SQL_HOST',     'localhost');
	define('SQL_USER',     'simancil');
	define('SQL_PASSWD',   'simancil');
	define('SQL_DATABASE', 'simancil');
	define('SQL_PREFIX',   'phpc_');
	define('SQL_TYPE',     'mysqli');
	
	// MySQL configuration
define('HOST','localhost');        // Your database server
define('USER','simancil');        // Your mysql username
define('PASS','simancil');                // Your mysql password
define('DB','simancil');        // Your mysql database name
define('SITE_TITLE','CV. Berkah');
define('MENU_TITLE','');
define( 'ABSPATH', dirname(__FILE__) . '/' );
	
?>