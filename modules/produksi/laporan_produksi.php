
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
<form method="get" action="csck1.php" id="frmijin">
<table width="536" align="center" cellspacing="1" bgcolor="#000000">
	<tr background="../images/impactg.png" height="30">
		<td colspan="5" align="center"><strong><font color="#FFFFFF">LAPORAN CSCK </font></strong></td>
	</tr>
	<tr bgcolor="#FFFFCC">
		<td width="81">Periode</td>
	  <td width="171"><select name="bulan"  id="dynamic_select" class="required">
        <?php
						$tahun = $_POST["tahun"];
						$tahunx = date('Y');
						//echo $tahun;
						for ($i=2010; $i<=$tahunx+1;$i++){
							for ($j=1; $j<=12;$j++){
					?>
        <option value="<?php echo $j.'-'.$i;?>" <?php if($_GET["bulan"]==$j.'-'.$i){ echo 'selected="selected"';} ?>><?php echo $j.'-'.$i;?></option>
        <?php } 
		  } ?>
      </select>
      <a href="javascript:showCalendar('tgl_awal')"></a></td>
		<td width="43" rowspan="2"></td>
		<td width="74">&nbsp;</td>
		<td width="149">&nbsp;</td>
	</tr>
	<tr bgcolor="#FFFFCC">
		<td>&nbsp;</td>
	  <td><a href="javascript:showCalendar('tgl_akhir')"></a></td>
		<td>&nbsp;</td>
	  <td>&nbsp;</td>
	</tr>
	<tr  bgcolor="#FFFFCC">
		<td colspan="5" align="center"><input type="submit" name="pdf" value="Cetak" /></td>
	</tr>
</table>
</form>
</body>

</html>
