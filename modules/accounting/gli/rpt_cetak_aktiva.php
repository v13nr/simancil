<?php  include "otentik_gli.php"; include ("../include/functions.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="../assets/kalendar_files/jsCalendar.js"></script>
<link href="../assets/kalendar_files/calendar.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../assets/jquery-1.2.3.pack.js"></script>
<script type="text/javascript" src="../assets/jquery.validate.pack.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
* { font: 11px/20px Verdana, sans-serif; }
h4 { font-size: 18px; }
input.error, select.error { border: 1px solid red; }
label.error { color:red; margin-left: 10px; }
td { padding: 5px; }
input.kanan{ text-align:right; }
</style>
<script type="text/javascript">
$(document).ready(function() {
	
	$("#frmijin").validate({
		rules: {
			password: "required",
			password_again: {
		equalTo: "#password"
			}
		},
		messages: {
			email: {
				required: "E-mail harus diisi",
				email: "Masukkan E-mail yang valid"
			}
		},
		errorPlacement: function(error, element) {
			error.appendTo(element.parent("td"));
		}
	});
})
</script>

</head>

<body>

<br />
<form method="post" action="cetak_aktiva.php" id="frmijin">
<table width="536" align="center" cellspacing="1" bgcolor="#000000">
	<tr background="../images/impactg.png" height="30">
		<td align="center" colspan="5"><strong><font color="#FFFFFF">LAPORAN DAFTAR AKTIVA TETAP</font></strong></td>
	</tr><tr   bgcolor="#FFFFCC">
			<td width="256" align="right">Tahun</td>
			<td width="9">:</td>
			<td width="259">
				<select name="tahun">
					<?php 
						$tahun = $_POST["tahun"];
						$tahunx = date('Y');
						//echo $tahun;
						for ($i=2009; $i<=$tahunx+5;$i++){
					?>
					<option value="<?php  echo $i;?>" <?php  if($tahunx==$i){ echo 'selected="selected"';} ?>><?php  echo $i;?></option>
					<?php  } ?>
				</select>
	  </td>
		</tr>
	<tr  bgcolor="#FFFFCC">
		<td align="center" colspan="5"><input type="submit" value="Cetak" /></td>
	</tr>
</table>
</form>
</body>

</html>
