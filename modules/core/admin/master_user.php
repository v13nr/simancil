<?php 
/**
 *  Copyright (C) CV. Jogjaide Ent.
 *  Project Manager : Nanang Rustianto
 *  Lead Programmer : Nanang Rustianto
 *  Email : anangr2001@yahoo.com
 *  Date: April 2014
**/
?>
<?php  @session_start(); ?>
<script language="JavaScript">
<!--
	function confirmDelete(delUrl) {
		if (confirm("Data ini akan dihapus!\nApakah Anda yakin untuk menghapusnya ?")) {
			document.location = delUrl;
		}
	}
//-->
</script>
<?php  include "../include/otentik_admin.php"; 

	$SQL = "SELECT * FROM ml_user WHERE status = 1";
	if(isset($_GET['id'])){
		$SQL = $SQL." AND id = ".$_GET['id'];
	}
	
	$hasil=mysql_query($SQL, $dbh_jogjaide);
	
?>
<style type="text/css">
<!--
body {
	background-image: url(../images/ok.jpg);
}
.style7 {
	font-family: "Segoe UI";
	font-size: 12px;
}
.style12 {
	font-family: "Segoe UI";
	font-size: 12px;
	font-weight: bold;
	color: #0000FF;
}
.style13 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>

<table width="1140" border="0">
  <tr>
    <td width="37"><img src="../images/Users-folder-32.png" width="32" height="32" /></td>
    <td width="1093"><span class="style12">HAK AKSES USER
      </span>
    <hr /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><table width="700" align="left" cellpadding="3" cellspacing="1" bgcolor="#000000">
      <tr bgcolor="#DDDDDD">
        <td colspan="10" align="center" bgcolor="#0000FF" class="style7"><span class="style13">MASTER USER</span></td>
      </tr>
      <tr bgcolor="#DDDDDD">
        <td bgcolor="#CCCC66" class="style7"><div align="center">
            <div align="center">No.</div>
        </div></td>
        <td bgcolor="#CCCC66" class="style7"><div align="center">Username</div></td>
        <td bgcolor="#CCCC66" class="style7"><div align="center">Nama</div></td>
        <td bgcolor="#CCCC66" class="style7"><div align="center">Kelas User</div></td>
		<td bgcolor="#CCCC66" class="style7"><div align="center">Divisi</div></td>
        <td bgcolor="#CCCC66" class="style7"><div align="center">Status</div></td>
		<td bgcolor="#CCCC66" class="style7"><div align="center">Menu</div></td>
        <td bgcolor="#CCCC66" class="style7"><div align="center">Edit</div></td>
        <td bgcolor="#CCCC66" class="style7"><div align="center">Hapus</div></td>
      </tr>
      <?php  $nRecord = 1; while ($row=mysql_fetch_array($hasil)) { ?>
      <tr <?php 	 if (($nRecord % 2)==0) {?>bgcolor="#FFFFCC"<?php  } else{ ?>bgcolor="#FFFFFF" <?php  } ?>>
        <td class="style7"><div align="center">
            <?php  echo ++$no?>
          .</div></td>
        <td class="style7"><?php  echo $row['user']?>
        </td>
        <td class="style7"><?php  echo $row['nama']?>
        </td>
        <td class="style7"><?php  echo $row['kelasuser']?>
        </td>
		<td align="center" class="style7">
			<?php 
				$SQLc = "SELECT namadiv FROM divisi WHERE subdiv = '".$row['tipe']."'";
				$hasilc = mysql_query($SQLc);
				$barisc = mysql_fetch_array($hasilc);
				echo $barisc[0];
			?>
		</td>
        <?php  if ($row['aktif']=="1"){?>
        <td align="center" class="style7">On</td>
        <?php  } else { ?>
        <td align="center" class="style7">Off</td>
        <?php  } ?>
		
        <?php  if ($row['id']=="1"){?>
        <td class="style7">&nbsp;</td>
        <td class="style7">&nbsp;</td>
		<td class="style7">&nbsp;</td>
        <?php  }else { ?>
		<td align="center" class="style7"><a href="index.php?mn=user_akses&amp;id=<?php  echo $row["id"]?>&nama=<?php  echo $row['nama']?>"><img src="../images/icons/icon-key.png" alt="Edit" width="16" height="16" border="0" /></a></td>
        <td align="center" class="style7"><a href="index.php?mn=user_form&amp;id=<?php  echo $row["id"]?>"><img src="../images/icons/edit2.gif" alt="Edit" border="0" /></a></td>
        <td align="center" class="style7"><a href="javascript:confirmDelete('admin_submission.php?cmd=del_user&amp;id=<?php  echo $row["id"]?>')"><img src="../images/icons/hapus.gif" alt="Hapus" border="0" /></a></a></td>
        <?php  } ?>
      </tr>
      <?php  $nRecord = $nRecord + 1; } ?>
      <tr bgcolor="white">
        <td colspan="10" align="center" class="style7"><a href="index.php?mn=user_form">Tambah User</a></td>
      </tr>
    </table></td>
  </tr>
</table>
<span class="style7"><br>
</span>