<?php  session_start();
include ("config_sistem.php");

class Browser {
    /**
        Figure out what browser is used, its version and the platform it is
        running on.

        The following code was ported in part from JQuery v1.3.1
    */
    public static function detect() {
        $userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);

        // Identify the browser. Check Opera and Safari first in case of spoof. Let Google Chrome be identified as Safari.
        if (preg_match('/opera/', $userAgent)) {
            $name = 'opera';
        }
        elseif (preg_match('/webkit/', $userAgent)) {
            $name = 'chrome';
        }
        elseif (preg_match('/msie/', $userAgent)) {
            $name = 'msie';
        }
        elseif (preg_match('/mozilla/', $userAgent) && !preg_match('/compatible/', $userAgent)) {
            $name = 'mozilla';
        }
        else {
            $name = 'unrecognized';
        }

        // What version?
        if (preg_match('/.+(?:rv|it|ra|ie)[\/: ]([\d.]+)/', $userAgent, $matches)) {
            $version = $matches[1];
        }
        else {
            $version = 'unknown';
        }

        // Running on what platform?
        if (preg_match('/linux/', $userAgent)) {
            $platform = 'linux';
        }
        elseif (preg_match('/macintosh|mac os x/', $userAgent)) {
            $platform = 'mac';
        }
        elseif (preg_match('/windows|win32/', $userAgent)) {
            $platform = 'windows';
        }
        else {
            $platform = 'unrecognized';
        }

        return array(
            'name'      => $name,
            'version'   => $version,
            'platform'  => $platform,
            'userAgent' => $userAgent
        );
    }
	
	function getRealIpAddr()
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
		{
		  $ip=$_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
		{
		  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else
		{
		  $ip=$_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
}


//$browser = Browser::detect();
//$ip = Browser::getRealIpAddr();
//echo 'You browser is '.$browser['name'].' version '.$browser['version'].' running on '.$browser['platform'].' ip : '.$ip;

$user_name = $_POST["user_name"];
$passwd = $_POST["passwd"];
date_default_timezone_set("Asia/Shanghai"); 

$query = "SELECT * FROM $database.ml_user WHERE user = '$user_name' AND status = 1 AND aktif = 1";
   $hasil = mysql_query($query, $dbh_jogjaide);

if (mysql_num_rows($hasil) > 0) {
   $data = mysql_fetch_array($hasil);
   if (md5($passwd) == $data['pass']){
	$_SESSION["is_login"] = "yes";
	$_SESSION["sess_kelasuser"] = trim($data["kelasuser"]);
	$_SESSION["sess_tipe"] = trim($data["tipe"]);
	$_SESSION["sess_user_id"] = $data["id"];
	$_SESSION["sess_name"] = $data["nama"];
	$_SESSION["sess_uname"] = $data["user"];
	$tgl_skrg = Date("Y-m-d");
	$wkt_disimpan = Date("Y-m-d H:i:s");
	$query = "select * from $database.ml_absen where IDUser=".$_SESSION["sess_user_id"]." and waktu_datang like '%".$tgl_skrg."%'";
	$hasil = mysql_query($query, $dbh_jogjaide);
	if (mysql_num_rows($hasil) < 1){
		$browser = Browser::detect();
		$ip = Browser::getRealIpAddr();
		$query = "insert into $database.ml_absen values ('', ".$_SESSION["sess_user_id"].", '".$wkt_disimpan."', '', '".$browser[name]."', '".$browser[version]."', '".$browser[platform]."', '".$ip."')";
		$hasil = mysql_query($query);
		//echo "kurang 1";
	}
	header("location: index.php");
   }
   else { 
//   		echo " error ";
		header("Location: login.php?err=y");  
   }
}
   else { header("Location: login.php?err=y");  
   }

?>