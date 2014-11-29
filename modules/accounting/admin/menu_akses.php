<?php  include "../include/otentik_admin.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>


<SCRIPT language=javascript src="popcalendar.js"></SCRIPT>
<script type="text/javascript" src="../assets/jquery.js"></script>
<script language"javascript" type="text/javascript">
	
	function jqCheckAll2( id, name )
{
	//$("INPUT[@name=" + name + "][type='checkbox']").attr('checked', $('#' + id).is(':checked'));
	$("INPUT[@name^=" + name + "][type='checkbox']").attr('checked', $('#' + id).is(':checked')); 	
}

	function PopUp(url){
	window.open(url,'', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=400,height=100,left = 200,top = 200');
	}
</script>
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
	background-image: url(../images/ok.jpg);
	background-repeat: repeat;
}
.style3 { font-family: "Segoe UI"; font-size: 12px; }
.style4 {color: #FFFFFF}
.style5 {color: #000000; }
-->
</style></head>

<body>
<div align="center">

<form method="post" action="admin_submission.php">
<input type="hidden" name="cmd" value="upd_menu" />
<input type="hidden" name="user_id" value="<?php  echo $_GET['id']?>" />
  <table width="758" border="0" cellspacing="1" class="style3">
    <tr>
      <td width="2" rowspan="4">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="53" rowspan="3" valign="bottom"><div align="center" class="style4"><a href="index.php?mn=input_kons"></a></div></td>
      <td width="51" rowspan="3" valign="bottom"><div align="center" class="style4"><input type="image" src="../draft/images/user_add.png" width="32" height="32" /></div></td>
      <td width="50" rowspan="3" valign="bottom"><div align="center" class="style4"></div></td>
      <td width="50" rowspan="3" valign="bottom"><div align="center"><a href=""><img src="../images/fileex.png" border="0" width="32" height="32" /></a></div></td>
      <td width="48" rowspan="3">&nbsp;</td>
      <td width="1" rowspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td width="17"><div align="center"><img src="../draft/images/calendar.png" width="16" height="16" /></div></td>
      <td width="4"><div align="center">:</div></td>
      <td width="722">&nbsp; 
	  <?php  date_default_timezone_set('Asia/Shanghai'); echo date('l, j F Y'); ?></td>
      </tr>
    <tr>
      <td class="style3"><div align="center"><img src="../draft/images/Gnome-Appointment-New-48.png" width="16" height="16" /></div></td>
      <td class="style3"><div align="center">:</div></td>
      <td class="style3"><div align="left"> &nbsp;<?php  echo gmdate(" H:i:s", time()+60*60*7); ?>  </div></td>
    </tr>
    <tr>
      <td class="style3"><div align="center"><img src="../draft/images/user.png" width="16" height="16" /></div></td>
      <td class="style3"><div align="center">:</div></td>
      <td class="style3"><div align="left"> Menu Untuk : <?php  echo $_GET['nama']?></div></td>
      <td class="style3"><div align="center" class="style5"></div></td>
      <td class="style3"><div align="center" class="style5">Update</div></td>
      <td class="style3"><div align="center" class="style5"></div></td>
      <td class="style3" colspan="2"><div align="left"><span class="style5"></span>Export To MS-Excell</div></td>
      <td><span class="style5"></span></td>
    </tr>
    <tr>
      <td colspan="10">&nbsp;</td>
    </tr>
  </table>
  <table width="569" border="0" bgcolor="#000000" cellspacing="1">
    <tr height="30" background="../images/impactg.png">
	  <td width="56" class="style3"><div align="center" class="style4">No.</div></td>
      <td width="64" class="style3"><div align="center" class="style4">
        <input name="checkAllYourCB" id="checkAllYourCB" onclick="jqCheckAll2( this.id, 'tambah' )" type="checkbox" />
      </div></td>
      <td width="173" class="style3"><div align="center" class="style4">Modul</div></td>
      <td width="190" class="style3"><div align="center" class="style4">Type</div></td>
	  <td width="501" class="style3"><div align="center" class="style4">Menu</div></td>
      <td width="50" class="style3"><div align="center" class="style4">Delete</div></td>
    </tr>
	<?php 
		$SQL = "SELECT * FROM jo_menu WHERE status = 1 AND aktif = 1 AND parent_id = 0";
//		$SQL = $SQL." ORDER BY norek ASC";
		$hasil=mysql_query($SQL) or die(mysql_error());
		$id = 0;
	?>
	<?php  
		 $nRecord = 1;
			if (mysql_num_rows($hasil) > 0) { 
			while ($row=mysql_fetch_array($hasil)) { 
 	?>
    <tr <?php 	 if (($No % 2)==0) {?>bgcolor="#e4e4e4"<?php  }  else {?>bgcolor="#FFFFCC"<?php  } ?>>
      <td align="center" class="style3"><?php  echo ++$No?></td>
	  <td class="style3" align="center">
	  	<input type="checkbox" id="tambah" name="tambah[]" value="<?php  echo $row['id'] ?>" 
		<?php 
			$SQLc = "SELECT * FROM jo_menu_detail WHERE user_id = '".$_GET['id']."' AND menu_id = '".$row['id']."'";
			$hasilc = mysql_query($SQLc) or die(mysql_error());
			if (mysql_num_rows($hasilc)<>0) {
		?>
		checked="checked"
		<?php  } ?>
		
		 /></td>
	  <td class="style3" align="left"><?php  echo $row['title']?></td>
      <td class="style3" align="left">&nbsp;</td>
	  <td class="style3" align="left">&nbsp;</td>
      <td align="center" class="style7"><a href="javascript:confirmDelete('admin_submission.php?cmd=del_menu&amp;id=<?php  echo $row["id"]?>&user_id=<?php  echo $_GET['id']?>&nama=<?php  echo $_GET['nama']?>')"><img src="../images/icons/hapus.gif" alt="Hapus" border="0" /></a></td>
    </tr>
		<?php 
					$SQLa = "SELECT * FROM jo_menu WHERE status = 1 AND aktif = 1 AND parent_id = '".$row['id']."'";
					$hasila= mysql_query($SQLa);
					while($barisa = mysql_fetch_array($hasila)){
				?>
				
				<tr <?php 	 if (($No % 2)==0) {?>bgcolor="#e4e4e4"<?php  }  else {?>bgcolor="#FFFFCC"<?php  } ?>>
				  <td align="center" class="style3"><?php  echo ++$No?></td>
				  <td class="style3" align="center">
					<input type="checkbox" id="tambah" name="tambah[]" value="<?php  echo $barisa['id'] ?>"  
		<?php 
			$SQLc = "SELECT * FROM jo_menu_detail WHERE user_id = '".$_GET['id']."' AND menu_id = '".$barisa['id']."'";
			$hasilc = mysql_query($SQLc) or die(mysql_error());
			if (mysql_num_rows($hasilc)<>0) {
		?>
		checked="checked"
		<?php  } ?>/></td>
				  <td class="style3" align="left">&nbsp;</td>
				  <td class="style3" align="left"><?php  echo $barisa['title']?></td>
				  <td class="style3" align="left">&nbsp;</td>
				  <td align="center" class="style7"><a href="javascript:confirmDelete('admin_submission.php?cmd=del_menu&amp;id=<?php  echo $barisa["id"]?>&user_id=<?php  echo $_GET['id']?>&nama=<?php  echo $_GET['nama']?>')"><img src="../images/icons/hapus.gif" alt="Hapus" border="0" /></a></td>
				</tr>
						<?php 
							$SQLab = "SELECT * FROM jo_menu WHERE status = 1 AND aktif = 1 AND parent_id = '".$barisa['id']."'";
							$hasilab= mysql_query($SQLab);
							while($barisab = mysql_fetch_array($hasilab)){
						?>	
								<tr <?php 	 if (($No % 2)==0) {?>bgcolor="#e4e4e4"<?php  }  else {?>bgcolor="#FFFFCC"<?php  } ?>>
								  <td align="center" class="style3"><?php  echo ++$No?></td>
								  <td class="style3" align="center">
									<input type="checkbox" id="tambah" name="tambah[]" value="<?php  echo $barisab['id'] ?>"  
		<?php 
			$SQLc = "SELECT * FROM jo_menu_detail WHERE user_id = '".$_GET['id']."' AND menu_id = '".$barisab['id']."'";
			$hasilc = mysql_query($SQLc) or die(mysql_error());
			if (mysql_num_rows($hasilc)<>0) {
		?>
		checked="checked"
		<?php  } ?>/></td>
								  <td class="style3" align="left">&nbsp;</td>
								  <td class="style3" align="left">&nbsp;</td>
								  <td class="style3" align="left"><?php  echo $barisab['title']?></td>
								  <td align="center" class="style7"><a href="javascript:confirmDelete('admin_submission.php?cmd=del_menu&amp;id=<?php  echo $barisab["id"]?>&user_id=<?php  echo $_GET['id']?>&nama=<?php  echo $_GET['nama']?>')"><img src="../images/icons/hapus.gif" alt="Hapus" border="0" /></a></td>
								</tr>
				
						<?php  } // end of child 2?>
						
				<?php  $nRecord = $nRecord + 1; } // end of child 1?>
	<?php   
		 $nRecord = $nRecord + 1;
		} //end of parent_id = 0
	} else { ?>
	  <tr bgcolor="white">
		<td align="center" colspan="17"><font color="red">Mohon maaf, tidak ada Data dimaksud.</font></td>
	  </tr>
	<?php   } ?>
  </table>
  </form>
</div>
</body>
</html>
