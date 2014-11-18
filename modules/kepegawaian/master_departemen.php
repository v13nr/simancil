<?php
	include "../../config_sistem.php";	

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
<? include "otentik_kepeg.php"; ?>
<?
	$tsql0 = "select * from master_dept where namadept <> '' and status = 1";
	if ($_GET['iddep']<>"") {
		$tsql0 = $tsql0." and iddep=".$_GET['iddep'];
	}
	$tsql0 = $tsql0." ORDER BY iddep ASC";
	$hasil=mysql_query($tsql0);
?>
<table width="1140" border="0">
  <tr>
    <td width="32"><img src="../../images/shape_align_bottom.png" width="32" height="32" /></td>
    <td width="1098"><span class="style1">DATA DEPARTEMEN</span>
    <hr /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><table border="1" width="60%" bordercolorlight="silver" cellspacing="0" cellpadding="3" bordercolordark="#FFFFFF" align="left">
      <? if ($_GET['iddep']<>"") {?>
      <tr>
        <td  background="../../images/impactg.png" height="30" colspan="7" align="center"><font color="white"><b>EDIT DEPARTEMEN </b></font></td>
      </tr>
      <? } else { ?>
      <tr>
        <td  background="../../images/impactg.png" height="30" colspan="7" align="center"><font color="white"><b> DATA DEPARTEMEN </b></font> </td>
      </tr>
      <? }?>
      <tr bgcolor="#FFCC00">
        <td width="5%" align="center"><div align="center"><strong>No</strong></div></td>
        <td align="center"><strong>Nama Departemen </strong></td>
        <? if ($_GET['iddep']<>"") { ?>
        <td  width="5%" align="center"><b>Update</b></td>
        <td  width="5%" align="center"><b>Batal</b></td>
        <? } else { ?>
        <td width="5%" align="center"><strong>Edit</strong></td>
        <td width="5%" align="center"><b>Hapus</b></td>
        <? } ?>
      </tr>
      <?	 $nRecord = 1;
	if ($hasil) { 
		 while ($row=mysql_fetch_array($hasil)) { ?>
      <tr <?	 if (($nRecord % 2)==0) {?>bgcolor="#FFFFCC"<? } else{ ?>bgcolor="#E4E4E4" <? } ?>>
        <form method="post" action="pegawai_submission.php">
          <input type="hidden" name="iddep" value="<?=$_GET['iddep']?>" />
          <input type="hidden" name="cmd" value="upd_dept" />
          <td align="right"><div align="center">
            <?=$nRecord?>
          </div></td>
          <td align="left"><? if ($_GET['iddep']<>"") { ?>
              <input type="text" name="departemen" size="40" class="form_isian" value="<?=$row["namadept"];?>" />
              <? } else { ?>
              <?=$row["namadept"]?>
              <? } ?>          </td>
          <? if ($_GET['iddep']<>"") { ?>
          <td align="center"><input name="image" type="image" src="../../images/approve.gif" border="0" />          </td>
          <td align="center"><a href="javascript:history.back()"><img src="../../images/kal_prev.gif" alt="Sebelumnya" border="0" /></a></td>
          <? } else { ?>
          <td align="center"><a href="?mn=<?=$_GET['mn']?>&amp;iddep=<?=$row["iddep"]?>"><img src="../../images/edit.gif" alt="Edit" border="0" /></a></td>
          <td align="center"><a href="javascript:confirmDelete('pegawai_submission.php?id=<?=$row["iddep"]?>&amp;cmd=del_dep')"><img src="../../images/hapus.gif" alt="Hapus" border="0" /></a></td>
          <? } ?>
        </form>
      </tr>
      <?  
		 $nRecord = $nRecord + 1;
		} 
	} else { ?>
      <tr>
        <td align="center" colspan="7"><font color="red">Mohon maaf, tidak ada Data dimaksud.</font></td>
      </tr>
      <?  } ?>
      <? if ($_GET['iddep']=="") { ?>
      <tr bgcolor="yellow">
        <form method="post" action="pegawai_submission.php">
          <input type="hidden" name="cmd" value="add_dept" />
          <td align="right"><img src="../../images/kal_next.gif" alt="Selanjutnya" border="0" /></td>
          <td align="left"><input type="text" name="departemen" size="40" class="form_isian" /></td>
          <td colspan="3" align="center"><input name="image" type="image" src="../../images/add.gif" border="0" /></td>
        </form>
      </tr>
      <? } ?>
    </table></td>
  </tr>
</table>
