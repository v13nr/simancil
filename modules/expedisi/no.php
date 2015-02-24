<?php 
	
	include "../../otentik.php";
	include "../../config_sistem.php";
	include "../../include/functions.php";
	if(isset($_GET["q"]) && $_GET["q"]=="jogjaide"){
		$SQLurut = "INSERT INTO no_urut(id) VALUES('')";
		$hasilurut = mysql_query($SQLurut)or die(mysql_error());
		$last = mysql_insert_id();
		echo $last;
	}
	if(isset($_GET["q"]) && $_GET["q"]=="jogjaide_muatan"){
		$SQLurut = "INSERT INTO nourut_nota(id) VALUES('')";
		$hasilurut = mysql_query($SQLurut)or die(mysql_error());
		$last = mysql_insert_id();
		echo $last;
	}
	?>