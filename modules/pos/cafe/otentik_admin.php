<?
include("../include/globalx.php");
switch($_SESSION['sess_kelasuser'])
{
	case "Super Admin" :
	break;
	case "Admin" :
	break;
	default :
	echo "<h1>Maaf Anda tidak diizinkan mengakses halaman ini.</h1>";
	//echo "<br><a href=\"$site_path\">Kembali Ke Halaman Login</a>";
	exit;
}



?>