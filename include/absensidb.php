<?php 
//include("globalx.php");
//error_reporting(0);
//$dbh_jogjaide=odbc_connect("dbabsensi","" ,"") or die("Tidak Terkoneksi ke Server Absensi");
?>
<?php 

//$server = "192.168.200.252";
$server = "JOGJAIDE\ATIKAH";
$username = "sa"; 
$password = "99";  
$namaDB = "BioFinger";  

$dbh_jogjaide = mssql_connect($server, $username, $password) or die ("Gagal Koneksi ke MS-SQL Server");

mssql_select_db($namaDB, $dbh_jogjaide) or die ("Gagal Pilih Database Bio Finger");
?>