<?php 
	include "../../otentik.php";
	include "../../config_sistem.php";
	include "../../include/functions.php";
?>

<script language="JavaScript">
<!--
	function confirmDelete(delUrl) {
		if (confirm("Data ini akan dihapus!\nApakah Anda yakin untuk menghapusnya ?")) {
			document.location = delUrl;
		}
	}
//-->
</script>
<style type="text/css">
<!--
body {
	font-family: "Segoe UI";
	font-size: 12px;
	background-image: url(../../images/bg.png);
}
.style1 {
	color: #0000FF;
	font-weight: bold;
	font-size: 12px;
}

-->
</style>
<?php 
	$tsql0 = "select * from route_tarif where id <> ''";
	if ($_GET['iddep']<>"") {
		$tsql0 = $tsql0." and id=".$_GET['iddep'];
	}
	$tsql0 = $tsql0." ORDER BY id ASC";
	$hasil=mysql_query($tsql0);
?>
<table width="1140" border="0">
  <tr>
    <td width="32"><img src="../../images/shape_align_bottom.png" width="32" height="32" /></td>
    <td width="1098"><span class="style1">DATA TARIF</span>
      <hr /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><table border="1" width="60%" bordercolorlight="#FFFFFF" cellspacing="0" cellpadding="3" bordercolordark="#FFFFFF" align="left">
      <?php  if ($_GET['iddep']<>"") {?>
      <tr>
        <td  background="../../images/impactg.png" height="30" colspan="9" align="center"><font color="white"><b>EDIT TARIF</b></font></td>
      </tr>
      <?php  } else { ?>
      <tr>
        <td  background="../../images/impactg.png" height="30" colspan="9" align="center"><font color="white"><b> DATA TARIF </b></font> </td>
      </tr>
      <?php  }?>
      <tr bgcolor="#FFCC00">
        <td width="5%" align="center"><div align="center"><strong>No</strong></div></td>
        <td align="center"><strong>Dari </strong></td>
        <td align="center"><strong>Tujuan</strong></td>
        <td align="center"><strong>Biaya</strong></td>
        <?php  if ($_GET['iddep']<>"") { ?>
        <td  width="5%" align="center"><b>Update</b></td>
        <td  width="5%" align="center"><b>Batal</b></td>
        <?php  } else { ?>
        <td width="5%" align="center"><strong>Edit</strong></td>
        <td width="5%" align="center"><b>Hapus</b></td>
        <?php  } ?>
      </tr>
      <?php 	 $nRecord = 1;
	if ($hasil) { 
		 while ($row=mysql_fetch_array($hasil)) { ?>
      <tr <?php 	 if (($nRecord % 2)==0) {?>bgcolor="#FFFFCC"<?php  } else{ ?>bgcolor="#E4E4E4" <?php  } ?>>
        <form method="post" action="expedisi_submission.php">
          <input type="hidden" name="iddep" value="<?php  echo $_GET['iddep']?>" />
          <input type="hidden" name="cmd" value="upd_tarif" />
          <td align="right"><div align="center">
            <?php  echo $nRecord?>
          </div></td>
          <td align="left"><?php  if ($_GET['iddep']<>"") { ?>
              <input type="text" name="layanan" size="40" class="form_isian" value="<?php  echo $row["dari"];?>" />
              <?php  } else { ?>
              <?php  echo $row["dari"]?>
              <?php  } ?>          </td>
          <td align="center"><?php  if ($_GET['iddep']<>"") { ?>
            <input type="text" name="satuan" size="40" class="form_isian" value="<?php  echo $row["tujuan"];?>" />
            <?php  } else { ?>
            <?php  echo $row["tujuan"]?>
            <?php  } ?></td>
          <td align="right"><?php  if ($_GET['iddep']<>"") { ?>
            <input type="text" name="harga" size="25" class="form_isian" value="<?php  echo $row["tarif"];?>" />
            <?php  } else { ?>
            <?php  echo number_format($row["tarif"])?>
            <?php  } ?></td>
          <?php  if ($_GET['iddep']<>"") { ?>
          <td align="center"><input name="image" type="image" src="../../images/approve.gif" border="0" />          </td>
          <td align="center"><a href="javascript:history.back()"><img src="../../images/kal_prev.gif" alt="Sebelumnya" border="0" /></a></td>
          <?php  } else { ?>
          <td align="center"><a href="route_tarif.php?iddep=<?php  echo $row["id"]?>"><img src="../../images/edit.gif" alt="Edit" border="0" /></a></td>
          <td align="center"><a href="javascript:confirmDelete('expedisi_submission.php?id=<?php  echo $row["id"]?>&amp;cmd=del_tarif')"><img src="../../images/hapus.gif" alt="Hapus" border="0" /></a></td>
          <?php  } ?>
        </form>
      </tr>
      <?php   
		 $nRecord = $nRecord + 1;
		} 
	} else { ?>
      <tr>
        <td align="center" colspan="9"><font color="red">Mohon maaf, tidak ada Data dimaksud.</font></td>
      </tr>
      <?php   } ?>
      <?php  if ($_GET['iddep']=="") { ?>
      <tr bgcolor="yellow">
        <form method="post" action="expedisi_submission.php">
          <input type="hidden" name="cmd" value="add_tarif" />
          <td align="right"><img src="../../images/kal_next.gif" alt="Selanjutnya" border="0" /></td>
          <td align="left"><input type="text" name="layanan" size="40" class="form_isian" /></td>
          <td align="left"><input type="text" name="satuan" size="40" class="form_isian" value="" /></td>
          <td align="left"><input type="text" name="harga" size="25" class="form_isian" value="" /></td>
          <td colspan="3" align="center"><input name="image" type="image" src="../../images/add.gif" border="0" /></td>
        </form>
      </tr>
      <?php  } ?>
    </table></td>
  </tr>
</table>
