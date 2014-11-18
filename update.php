<?php
/**
 *  Copyright (C) PT. Netsindo Sentra Computama
 *  Project Manager : Andi Micro
 *  Lead Programmer : Nanang Rustianto
 *  Email : info@netsindo.com
 *  Date: April 2014
**/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Update SiMancil</title>
<?php
include "otentik_admin.php";
		include "config_sistem.php";

		$fp = @fsockopen("repo.simancil.com", 80, $errno, $errstr, 10);
		$onoff = (!$fp) ? "Offline" : "Online";
		echo "<br>Status : ".$onoff."<br>";

		$handle = @fopen("http://repo.simancil.com/update/release.txt", "r");
		if ($handle) {
			while (($buffer = fgets($handle, 4096)) !== false) {
				$versi_server = $buffer;
			}
			if (!feof($handle)) {
				echo "Error: unexpected fgets() fail\n";
			}
			fclose($handle);
		}

		echo $onoff == "Online" ? "Versi Server : ".$versi_server."<br>" : "<br>";

		$sql = "SELECT versi from versi order by id DESC LIMIT 1";
		$hasil = mysql_query($sql);
		$baris = mysql_fetch_array($hasil);
		echo "Versi Anda Saat ini adalah ".$baris[0];

		//hitungan update
		$split_server = explode('.', $versi_server);
		$userver = $split_server[2];
		$split_client = explode('.', $baris[0]);
		$uclient = $split_client[2];
		$paket = ($userver - $uclient);
		echo "<br>Anda Akan Update Minor dari versi : ". ($uclient). " s/d " .$userver;
		echo "<br> Paket Update : ".$paket;
		//

if(isset($_GET["cmd"])) {
		if($paket==1){
			echo "<br>Paket.....".$paket."......<br>";
			$hostfile = fopen("http://repo.simancil.com/update/latest.zip", 'r');
			$fh = fopen("latest.zip", 'w');
			while (!feof($hostfile)) {
				$output = fread($hostfile, 8192);
				fwrite($fh, $output);
			}
			fclose($hostfile);
			fclose($fh);
			  require_once('pclzip.lib.php');
			  $archive = new PclZip('latest.zip');
			  if (($v_result_list = $archive->extract()) == 0) {
				die("Error : ".$archive->errorInfo(true));
			  }
			  echo "<pre>";
			  echo "</pre>";
			unlink('latest.zip');
			
			//simpan versi update

			$handle = @fopen("version.txt", "r");
			if ($handle) {
				while (($buffer = fgets($handle, 4096)) !== false) {
					$versi = $buffer;
				}
				if (!feof($handle)) {
					echo "Error: unexpected fgets() fail\n";
				}
				fclose($handle);
			}

			$sql = "INSERT INTO versi(id,versi,keterangan) VALUES('','$versi','Update Sukses')";
			$hasil = mysql_query($sql);
		} else {
			//loop ?
			for($i=($uclient + 1);$i<=$userver; $i++){


				unlink('version.txt');
				$hostfile = fopen("http://repo.simancil.com/update/arsip/1.2.".$i.".zip", 'r');
				$fh = fopen("1.2.".$i.".zip", 'w');
				while (!feof($hostfile)) {
					$output = fread($hostfile, 8192);
					fwrite($fh, $output);
				}
				fclose($hostfile);
				fclose($fh);
				  require_once('pclzip.lib.php');
				  $archive = new PclZip('1.2.'.$i.'.zip');
				  if (($v_result_list = $archive->extract()) == 0) {
					die("Error : ".$archive->errorInfo(true));
				  }
				  echo "<pre>";
				  echo "</pre>";
				unlink('1.2.'.$i.'.zip');
			
				//simpan versi update
				$handle = @fopen("version.txt", "r");
				if ($handle) {
					while (($buffer = fgets($handle, 4096)) !== false) {
						$versi = $buffer;
					}
					if (!feof($handle)) {
						echo "Error: unexpected fgets() fail\n";
					}
					fclose($handle);
				}

				$sql = "INSERT INTO versi(id,versi,keterangan) VALUES('','$versi','Update Sukses')";
				$hasil = mysql_query($sql);

				echo "<br>Paket.....1.2.".$i.".zip......[done]";
			}
		}
	
	
		echo "<meta http-equiv=\"refresh\" content=\"3;url=sukses_update.php\" />";
}
?>
</head>




<body>
<p>Proses Update memerlukan waktu tergantung seberapa besar release update terbaru....</p>
<p>Pada saat update screen anda akan berpindah sendiri jadi harap menunggu, pastikan koneksi internet berjalan dengan baik.</p>
<p>&nbsp;</p>
<form method="get" action="">
<input type="hidden" name="cmd" value="update" />
<input type="submit" value="Proses Update Sekarang !" <?php if(!$fp){ ?>disabled="disabled"<?php } ?> />
</form>
</body>
</html>
