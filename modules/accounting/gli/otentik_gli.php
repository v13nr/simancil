<?php 
/**
 *  Copyright (C) PT. Netsindo Sentra Computama
 *  Project Manager : Andi Micro
 *  Lead Programmer : Nanang Rustianto
 *  Email : info@netsindo.com
 *  Date: April 2014
**/
?>
<?php 
@session_start();
include("../include/globalx.php");
switch ($_SESSION['sess_kelasuser']) {
	case "Super Admin" :
		break;
	case "Admin" :
		break;
	case "User" :
		echo "<h1>Maaf Anda tidak diizinkan mengakses halaman General Ledger.</h1>";
		exit;
		break;	
	default :
		echo "<h1>Maaf Anda tidak diizinkan mengakses halaman General Ledger.</h1>";
		exit;
		
}

?>