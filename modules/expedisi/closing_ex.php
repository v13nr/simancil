<?php 
	include "../../otentik_admin.php";
	include "../../config_sistem.php";
	include "../../include/functions.php";
	
	if(isset($_POST["closing"])){
	
		$tanggal = baliktgl($_POST["tanggal_closing"]);
		$SQL = "UPDATE expedisi SET closing = 'Y' WHERE tanggal <= '".$tanggal."'";
		$hasil = mysql_query($SQL);
	}
?>
<form method="POST" action="closing_ex.php">
Closing for Now <input type="text" name="tanggal_closing" value="<?php echo date('d-m-Y');?>"><input type="submit" name="closing" value="Close Now"></form>