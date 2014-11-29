<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script type="text/javascript" src="../assets/kalendar_files/jsCalendar.js"></script>
<link href="../assets/kalendar_files/calendar.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../assets/jquery-1.2.3.pack.js"></script>
<script type="text/javascript" src="../assets/jquery.validate.pack.js"></script>
 <script language="javascript" src="../assets/thickbox/thickbox.js"></script>
 <link href="../assets/thickbox/thickbox.css" rel="stylesheet" type="text/css" />

</head>

<body>
<form method="post" action="summary_produk_cetak.php">
<table width="482" border="1">
  <tr>
    <td colspan="3">Filter Summary </td>
  </tr>
  <tr>
    <td width="142">Tanggal Awal </td>
    <td width="35">&nbsp;</td>
    <td width="283"><input type="text" name="tgl_awal" id="tgl_awal" size="10" class="required" title="*" value="<?php 
		echo date('d/m/Y');
		?>" <?php  if($_GET['nomor']<>""){ ?>  readonly="true"  <?php  }?> />
    <a href="javascript:showCalendar('tgl_awal')"><img src="../assets/kalendar_files/calendar_icon.gif" border="0"></a></td>
  </tr>
  <tr>
    <td>Tanggal Akhir </td>
    <td>&nbsp;</td>
    <td><input type="text" name="tgl_akhir" id="tgl_akhir" size="10" class="required" title="*" value="<?php 
		echo date('d/m/Y');
		?>" <?php  if($_GET['nomor']<>""){ ?>  readonly="true"  <?php  }?> />
          <a href="javascript:showCalendar('tgl_akhir')"><img src="../assets/kalendar_files/calendar_icon.gif" border="0"></a></td>
  </tr>
  <tr>
    <td>Shift</td>
    <td>&nbsp;</td>
    <td><select name="shift">
      <option value="">Pilih Shift</option>
      <?php  
	 		$SQL = "select * FROM ml_user b where kelasuser = 'User' and status = 1";
			$hasil = mysql_query($SQL, $dbh_jogjaide);
			while($baris = mysql_fetch_array($hasil)){
		 ?>
      <option value="<?php  echo $baris["id"]?>">
        <?php  echo ($baris["nama"])?>
        </option>
      <?php  }?>
    </select></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="submit" value="Go !"/></td>
  </tr>
</table>
</form>
</body>
</html>
