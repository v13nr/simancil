<?php session_start(); ?></SCRIPT>
	<script language"javascript" type="text/javascript">
	function PopUp(url){
	window.open(url,'', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=600,height=100,left = 200,top = 200');
	}
</script>
<style type="text/css">
<!--
.style3 {font-family: "Segoe UI"; font-size: 12px; }
.style4 {color: #FFFFFF}
-->
</style>
<table width="50%" border="0" cellspacing="1" bgcolor="#FFFFFF">
<?php
		include "../include/otentik_admin.php";
		include "../../../config_sistem.php";
		$SQL = "select * from logo limit 1";
		$hasil=mysql_query($SQL) or die(mysql_error());
		$row = mysql_fetch_array($hasil);
?>

  <tr >
    <td height="76" align="center" class="style3">Klik Foto untuk Upload </td>
  </tr>
  <tr>
    <td height="76" align="center" class="style3"><a href='javascript:PopUp(&quot;upload.php?idusr=<?php echo "1"; ?>&amp;modx=ok&quot;)'><img src="foto/<?=$row['foto']?>" width="100" /></a></td>
  </tr>
</table>
