<?php 
/**
 *  Copyright (C) CV. Jogjaide Ent.
 *  Project Manager : Nanang Rustianto
 *  Lead Programmer : Nanang Rustianto
 *  Email : anangr2001@yahoo.com
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