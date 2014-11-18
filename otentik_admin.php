<?
@session_start();
if ($_SESSION['sess_kelasuser']<>"Super Admin")
{
	echo "<h1>Maaf Hanya Administrator yang diizinkan mengakses halaman ini.</h1>";
	echo "<br><a href=\"index.php\">Kembali Ke Halaman Utama</a>";
	exit;
}



?>