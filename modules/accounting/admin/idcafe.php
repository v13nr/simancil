<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?php 
	$sql = "select * from cafeid where id = 1";
	$hasil = mysql_query($sql);
	$baris = mysql_fetch_array($hasil);
?>
<form method="post" action="admin_submission.php">
<input type="hidden" name="cmd" value="upd_cafe" />
<table width="372" border="1">
  <tr>
    <td width="101">Nama Cafe </td>
    <td width="6">:</td>
    <td width="243"><input type="text" name="nama" size="40" value="<?php  echo $baris["nama"]?>" /></td>
  </tr>
  <tr>
    <td>Alamat</td>
    <td>:</td>
    <td><input type="text" name="alamat" size="40" value="<?php  echo $baris["alamat"]?>" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="submit" value="Update" /></td>
  </tr>
</table>
</form>
</body>
</html>
