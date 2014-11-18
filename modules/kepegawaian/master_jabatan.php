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
	$tsql0 = "select * from mastjabatan where namajab <>'' and status=1";
	if ($_GET['idjab']<>"") {
		$tsql0 = $tsql0." and idjab=".$_GET['idjab'];
	}
	$tsql0 = $tsql0." ORDER BY idjab ASC";
	$hasil=mysql_query($tsql0);
?>
<table width="1140" border="0">
  <tr>
    <td width="32"><img src="../../images/medal_bronze_1.png" width="32" height="32" /></td>
    <td width="1098"><span class="style1">DATA JABATAN</span>
    <hr /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><table border="1" width="70%" bordercolorlight="silver" cellspacing="0" cellpadding="3" bordercolordark="#FFFFFF" align="left">
      <? if ($_GET['idjab']<>"") {?>
      <tr>
        <td background="../../images/impactg.png" height="30" colspan="7" align="center"><font color="white"><b>Edit Jabatan</b></font></td>
      </tr>
      <? } else { ?>
      
      <? }?>
      <tr bgcolor="#FFCC00">
        <td width="5%" align="center"><div align="center"><strong>No</strong></div></td>
        <td align="center"><strong>Nama Jabatan </strong></td>
        <? if ($_GET['idjab']<>"") { ?>
        <td width="5%" align="center"><b>Update</b></td>
        <td width="5%" align="center"><b>Batal</b></td>
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
          <input type="hidden" name="idjab" value="<?=$_GET['idjab']?>" />
          <input type="hidden" name="cmd" value="update_jab" />
          <td align="right"><div align="center">
            <?=$nRecord?>
          </div></td>
          <td align="left"><? if ($_GET['idjab']<>"") { ?>
              <input type="text" name="namajab" size="40" class="form_isian" value="<?=$row["namajab"];?>" />
              <? } else { ?>
              <?=$row["namajab"]?>
              <? } ?>          </td>
          <? if ($_GET['idjab']<>"") { ?>
          <td align="center"><input name="image" type="image" src="../../images/approve.gif" border="0" />          </td>
          <td align="center"><a href="javascript:history.back()"><img src="../../images/kal_prev.gif" alt="Sebelumnya" border="0" /></a></td>
          <? } else { ?>
          <td align="center"><a href="?mn=<?=$_GET['mn']?>&amp;idjab=<?=$row["idjab"]?>"><img src="../../images/edit.gif" alt="Edit" border="0" /></a></td>
          <td align="center"><a href="javascript:confirmDelete('pegawai_submission.php?id=<?=$row["idjab"]?>&amp;cmd=del_jab')"><img src="../../images/hapus.gif" alt="Hapus" border="0" /></a></td>
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
      <? if ($_GET['idjab']=="") { ?>
      <tr bgcolor="yellow">
        <form method="post" action="pegawai_submission.php">
          <input type="hidden" name="cmd" value="add_jab" />
          <td align="right"><img src="../../images/kal_next.gif" alt="Selanjutnya" border="0" /></td>
          <td align="left"><input type="text" name="jabatan" size="40" class="form_isian" /></td>
          <td colspan="3" align="center"><input name="image" type="image" src="../../images/add.gif" border="0" /></td>
        </form>
      </tr>
      <? } ?>
    </table></td>
  </tr>
</table>
