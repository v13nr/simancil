<?
//error_reporting(0);
session_start();
$host ="localhost";
    $user="root";
    $password="BiasaAjaLahdulu";
    $database="nas_produksi";
    $dbh1 = mysql_connect($host,$user,$password) or die("Koneksi server gagal");
    mysql_select_db($database);

	$site_path = "http://localhost/nanang";
	$group_id = $_SESSION['group_id'];
	/*
	if(!isset($_SESSION["userid"])) { 
		echo "Anda tidak mempunyai hak Akses. ";
		exit(); 
	} 
	else {
		$group_id = $_SESSION['group_id'];
		//echo " ID : " . $_SESSION["userid"];
	}
	*/
	
	function menuAkses($id){
		$group_id = $_SESSION['group_id'];
		$SQL = "SELECT group_id FROM role_menu_group WHERE menu_id = '$id' AND group_id = '".$group_id."' AND is_active = 1";
		//echo $SQL;
		$hasil = mysql_query($SQL);
		if(mysql_num_rows($hasil) < 1){
			echo "ANDA TIDAK MEMILIKI HAK AKSES MENU INI !";
			exit();
		}
	}
?>
