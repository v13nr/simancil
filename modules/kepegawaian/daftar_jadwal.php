<?php  //include "otentik_kepeg.php"; 
include "../include/globalx.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Daftar User Fingerprint</title>
  <script language="javascript">
   function selectBuku(no){
	   window.parent.selectBuku(no);
	   window.parent.tb_remove();
   }
  </script>
<style type="text/css">
<!--
body {
	/*background-image: url(../images/back.png);*/
}
table.x1 {
	border-collapse: collapse;
}
table.x1 td {
	font-size: 11pt; 
	background-color: #F0F0F0;
	padding-left: 8px;
	padding-right: 8px;
	padding-top: 2px;
	padding-bottom: 2px;
	border: 1px solid #cccccc;
}
-->
</style>

</head>

<body>
<?php  

	$SQL = "select * from absen where status = 1" ;
	$SQL = $SQL." ORDER BY id";
		$hasil=mysql_query($SQL);

?>

<table align="center" class="x1">
	<tr>
		<td><b>Kode Jadwal </b></td>
		<td><b>Nama</b></td>
	</tr>
	<?php     while ($baris=mysql_fetch_array($hasil)) { ?>
	<tr>
		<td align="center"><a href="javascript:selectBuku('<?php  echo $baris['KaryaCode']?>')"><?php  echo $baris['KaryaCode']?></a></td>
		<td><?php  echo $baris['KaryaName']?></td>
	</tr>
	<?php  } ?>
</table>

</body>
</html>
