<?php 
@session_start();
include("config_sistem.php");



if (!isset($_SESSION['is_login']))

{

	echo "<h1>Maaf Anda tidak diizinkan mengakses halaman ini.</h1>";
	exit;

}



?>