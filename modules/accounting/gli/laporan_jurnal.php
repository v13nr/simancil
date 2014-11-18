<? include "otentik_gli.php"; include ("../include/functions.php");?>
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
<form method="post" action="cetak_jurnal.php" id="frmijin">
<table width="476" align="center" cellspacing="1" bgcolor="#000000">
	<tr background="../images/impactg.png" height="30">
		<td colspan="5" align="center"><strong><font color="#FFFFFF">LAPORAN JURNAL</font></strong> </td>
	</tr>
	<tr bgcolor="#FFFFCC">
		<td width="70">Periode</td>
		<td width="126"><input type="text" name="tgl_awal" id="tgl_awal" size="10" class="required" title="Harap Mengisi Tanggal Awal Dahulu" value="01-01-2014" />
      <a href="javascript:showCalendar('tgl_awal')"><img src="../assets/kalendar_files/calendar_icon.gif" border="0" /></a></td>
		<td width="65" rowspan="2"></td>
		<td width="64">Divisi</td>
		<td width="133">
		<select name="divisi">
		<? if($_SESSION["sess_kelasuser"]<>"User"){?>
		<option value="">-ALL-</option>
		<? }?>
		<?
			$SQL = "SELECT * FROM divisi WHERE subdiv <> ''";
			if($_SESSION["sess_kelasuser"]=="User"){
				$SQL = $SQL . " AND subdiv = '".$_SESSION["sess_tipe"]."'";
			}
			$hasil = mysql_query($SQL);
			while($baris = mysql_fetch_array($hasil)){
		?>
		<option value="<?=$baris['subdiv']?>"><?=$baris['namadiv']?></option>
		<? } ?>
		</select>	  </td>
	</tr>
	<tr bgcolor="#FFFFCC">
		<td>S/d</td>
		<td><input type="text" name="tgl_akhir" id="tgl_akhir" size="10" class="required" title="Harap Mengisi Tanggal Akhir Dahulu" value="31-12-2014" />
          <a href="javascript:showCalendar('tgl_akhir')"><img src="../assets/kalendar_files/calendar_icon.gif" border="0" /></a></td>
		<td>User</td>
		<td><select name="user">
          <option value="">-ALL-</option>
          <?
			$SQL = "SELECT * FROM ml_user WHERE status = 1 AND id <> 1";
			$hasil = mysql_query($SQL);
			while($baris = mysql_fetch_array($hasil)){
		?>
          <option value="<?=$baris['id']?>">
            <?=$baris['nama']?>
          </option>
          <? } ?>
        </select></td>
	</tr>
	<tr  bgcolor="#FFFFCC">
		<td colspan="5" align="center"><input type="submit" name="pdf" value="Cetak PDF" /><input type="submit" name="excell" value="Export to Excell" /></td>
	</tr>
</table>
</form>
</body>

</html>
