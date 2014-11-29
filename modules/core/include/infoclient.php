<?php  if ($_GET['update']<>"") { ?>

	<script language="JavaScript">

	<!--

		alert ("Identitas Telah Terupdate. \nTerima kasih.");

	//-->

	</script>

<?php  } ?>
<?php 
include "globalx.php";
$SQL = "select * from $database.laporanid";
$hasil = mysql_query($SQL, $dbh_jogjaide);
$baris = mysql_fetch_array($hasil);
$namaclient = $baris["nama"];
$jalamclient = $baris["alamat"];
$telpon = $baris["telpon"];

?>
<form method="post" action="user_submission.php">
<input type="hidden" name="cmd" value="upd_ident" /> 
  
  <table width="90%" border="1" style="border-collapse:collapse">
    <tr>
      <td>Nama</td>
      <td>Alamat</td>
      <td>Telpon</td>
    </tr>
    <tr>
      <td><input type="text" value="<?php  echo $namaclient;?>" name="nama" size="50" /></td>
      <td><input type="text"  value="<?php  echo $jalamclient;?>" name="alamat" size="60" /></td>
      <td><input type="text" value="<?php  echo $telpon;?>" name="telpon"  size="50" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" value="Update" name="submit" /></td>
      <td>&nbsp;</td>
    </tr>
  </table>

</form>
