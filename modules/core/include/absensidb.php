<?
//include("globalx.php");
//error_reporting(0);
//$dbh2=odbc_connect("dbabsensi","" ,"") or die("Tidak Terkoneksi ke Server Absensi");
?>
<?PHP

//$server = "192.168.200.252";
$server = "JOGJAIDE\ATIKAH";
$username = "sa"; 
$password = "99";  
$namaDB = "BioFinger";  

$dbh2 = mssql_connect($server, $username, $password) or die ("Gagal Koneksi ke MS-SQL Server");

mssql_select_db($namaDB, $dbh2) or die ("Gagal Pilih Database Bio Finger");
?>