<?
include("globalx.php");
if ($_SESSION['sess_kelasuser']<>"Super Admin")
{
	echo "<h1>Maaf Anda tidak diizinkan mengakses halaman ini.</h1>";
	//echo "<br><a href=\"$site_path\">Kembali Ke Halaman Login</a>";
	exit;
}



?>