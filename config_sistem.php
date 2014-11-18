<?php

	$host ="localhost";
    $user="root";
    $password="AdaAdaSaja";
    $database="simancil";
    $dbh_jogjaide = mysql_connect($host,$user,$password) or die("Koneksi server gagal");
    mysql_select_db($database);
	$url_site = "http://localhost/simancil/modules/accounting/gli/";
	
	define('SQL_HOST',     'localhost');
	define('SQL_USER',     'root');
	define('SQL_PASSWD',   'AdaAdaSaja');
	define('SQL_DATABASE', 'simancil');
	define('SQL_PREFIX',   'phpc_');
	define('SQL_TYPE',     'mysqli');
	
	// MySQL configuration
define('HOST','localhost');        // Your database server
define('USER','root');        // Your mysql username
define('PASS','AdaAdaSaja');                // Your mysql password
define('DB','simancil');        // Your mysql database name
define('SITE_TITLE','Toko Berkah');
define('MENU_TITLE','');
define( 'ABSPATH', dirname(__FILE__) . '/' );
	
?>