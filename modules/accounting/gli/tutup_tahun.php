<? if ($_GET['update']<>"") { ?>

	<script language="JavaScript">

	<!--

		alert ("Identitas Telah Terupdate. \nTerima kasih.");

	//-->

	</script>

<? } ?>
<?
include "../include/globalx.php";
require_once("otentik_gli.php");
$SQL = "select * from $database.periode";
$hasil = mysql_query($SQL, $dbh_jogjaide);
$baris = mysql_fetch_array($hasil);
$tahun = $baris["tahun"];

?>
<form method="post" action="submission_gli.php">
<input type="hidden" name="cmd" value="upd_tahunaktif" /> 
  
  <table width="90" border="1" style="border-collapse:collapse">
    <tr>
      <td>Tahun Aktif </td>
      <td>Tahun Yang Akan diaktifkan </td>
    </tr>
    <tr>
      <td><input type="text" value="<?php echo $tahun;?>" name="tahun" size="50" /></td>
      <td><input type="text"  value="<?php echo $tahun + 1;?>" name="tahun_next" size="60" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" value="Update" name="submit" /></td>
    </tr>
  </table>

</form>
