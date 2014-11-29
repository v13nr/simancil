<?php 
@session_start();
switch ($_SESSION['sess_kelasuser']) {
	case "Super Admin" :
		break;
	case "Admin" :
		break;
	case "User" :
		break;	
	default :
		echo "<h1>Maaf Anda tidak diizinkan mengakses halaman Kepegawaian.</h1>";
		exit;
		
}

?>