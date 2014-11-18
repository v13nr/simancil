<? include "../include/otentik_admin.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<SCRIPT language=javascript src="popcalendar.js"></SCRIPT>
<script type="text/javascript" src="../assets/jquery.js"></script>
</SCRIPT>
	<script language"javascript" type="text/javascript">
	function PopUp(url){
	window.open(url,'', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=400,height=150,left = 400,top = 300');
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
<input type="hidden" name="cmd" value="del_master_menu" />
<input type="hidden" name="user_id" value="<?=$_GET['id']?>" />
  <table width="758" border="0" cellspacing="1" class="style3">
    <tr>
      <td width="2" rowspan="4">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="53" rowspan="3" valign="bottom"><div align="center" class="style4"><a href='javascript:PopUp("menu_popup.php")'><img src="../draft/images/user_add.png" width="32" height="32" border="0" align="absbottom" class="style3" /></a></div></td>
      <td width="51" rowspan="3" valign="bottom"><div align="center" class="style4"><input type="image" src="../draft/images/user_delete.png" width="32" height="32" /></div></td>
      <td width="50" rowspan="3" valign="bottom"><div align="center" class="style4"></div></td>
      <td width="50" rowspan="3" valign="bottom"><div align="center"><a href=""><img src="../images/fileex.png" border="0" width="32" height="32" /></a></div></td>
      <td width="48" rowspan="3">&nbsp;</td>
      <td width="1" rowspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td width="17"><div align="center"><img src="../draft/images/calendar.png" width="16" height="16" /></div></td>
      <td width="4"><div align="center">:</div></td>
      <td width="722">&nbsp; 
	  <? date_default_timezone_set('Asia/Shanghai'); echo date('l, j F Y'); ?></td>
      </tr>
    <tr>
      <td class="style3"><div align="center"><img src="../draft/images/Gnome-Appointment-New-48.png" width="16" height="16" /></div></td>
      <td class="style3"><div align="center">:</div></td>
      <td class="style3"><div align="left"> &nbsp;<?php echo gmdate(" H:i:s", time()+60*60*7); ?>  </div></td>
    </tr>
    <tr>
      <td class="style3"><div align="center"><img src="../draft/images/user.png" width="16" height="16" /></div></td>
      <td class="style3"><div align="center">:</div></td>
      <td class="style3"><div align="left"> &nbsp; Super Admin</div></td>
      <td class="style3"><div align="center" class="style5">Add</div></td>
      <td class="style3"><div align="center" class="style5">Delete</div></td>
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
      <td width="64" class="style3"><div align="center" class="style4"><input name="checkAllYourCB" id="checkAllYourCB" onClick="jqCheckAll2( this.id, 'yourCB' )" type="checkbox"></div></td>
      <td width="173" class="style3"><div align="center" class="style4">Modul </div></td>
      <td width="190" class="style3"><div align="center" class="style4">Type</div></td>
	  <td width="501" class="style3"><div align="center" class="style4">Menu</div></td>
      <td width="50" class="style3"><div align="center" class="style4">Edit</div></td>
    </tr>
	<?
		$SQL = "SELECT * FROM jo_menu WHERE status = 1 AND aktif = 1 AND parent_id = 0";
//		$SQL = $SQL." ORDER BY norek ASC";
		$hasil=mysql_query($SQL) or die(mysql_error());
		$id = 0;
	?>
	<? 
		 $nRecord = 1;
			if (mysql_num_rows($hasil) > 0) { 
			while ($row=mysql_fetch_array($hasil)) { 
 	?>
    <tr <?	 if (($No % 2)==0) {?>bgcolor="#e4e4e4"<? }  else {?>bgcolor="#FFFFCC"<? } ?>>
      <td align="center" class="style3"><?=++$No?></td>
	  <td class="style3" align="center">
	  	<input type="checkbox" id="tambah" name="tambah[]" value="<?=$row['id'] ?>" 
		<?
			$SQLc = "SELECT * FROM jo_menu_detail WHERE user_id = '".$_GET['id']."' AND menu_id = '".$row['id']."'";
			$hasilc = mysql_query($SQLc) or die(mysql_error());
			if (mysql_num_rows($hasilc)<>0) {
		?>
		checked="checked"
		<? } ?>
		
		 /></td>
	  <td class="style3" align="left"><?=$row['title']?></td>
      <td class="style3" align="left">&nbsp;</td>
	  <td class="style3" align="left">&nbsp;</td>
      <td align="center" class="style7"><a href='javascript:PopUp("menu_popup.php?id=<?=$row["id"]?>")'"><img src="../draft/images/user_go.png" alt="Update" border="0" /></a></td>
    </tr>
		<?
					$SQLa = "SELECT * FROM jo_menu WHERE status = 1 AND aktif = 1 AND parent_id = '".$row['id']."'";
					$hasila= mysql_query($SQLa);
					while($barisa = mysql_fetch_array($hasila)){
				?>
				
				<tr <?	 if (($No % 2)==0) {?>bgcolor="#e4e4e4"<? }  else {?>bgcolor="#FFFFCC"<? } ?>>
				  <td align="center" class="style3"><?=++$No?></td>
				  <td class="style3" align="center">
					<input type="checkbox" id="tambah" name="tambah[]" value="<?=$barisa['id'] ?>"  
		<?
			$SQLc = "SELECT * FROM jo_menu_detail WHERE user_id = '".$_GET['id']."' AND menu_id = '".$barisa['id']."'";
			$hasilc = mysql_query($SQLc) or die(mysql_error());
			if (mysql_num_rows($hasilc)<>0) {
		?>
		checked="checked"
		<? } ?>/></td>
				  <td class="style3" align="left">&nbsp;</td>
				  <td class="style3" align="left"><?=$barisa['title']?></td>
				  <td class="style3" align="left">&nbsp;</td>
				  <td align="center" class="style7"><a href='javascript:PopUp("menu_popup.php?id=<?=$barisa["id"]?>")'"><img src="../draft/images/user_go.png" alt="Update" border="0" /></a><a href="javascript:confirmDelete('admin_submission.php?cmd=del_menu&amp;id=<?=$barisa["id"]?>&user_id=<?=$_GET['id']?>&nama=<?=$_GET['nama']?>')"></a></td>
				</tr>
						<?
							$SQLab = "SELECT * FROM jo_menu WHERE status = 1 AND aktif = 1 AND parent_id = '".$barisa['id']."'";
							$hasilab= mysql_query($SQLab);
							while($barisab = mysql_fetch_array($hasilab)){
						?>	
								<tr <?	 if (($No % 2)==0) {?>bgcolor="#e4e4e4"<? }  else {?>bgcolor="#FFFFCC"<? } ?>>
								  <td align="center" class="style3"><?=++$No?></td>
								  <td class="style3" align="center">
									<input type="checkbox" id="tambah" name="tambah[]" value="<?=$barisab['id'] ?>"  
		<?
			$SQLc = "SELECT * FROM jo_menu_detail WHERE user_id = '".$_GET['id']."' AND menu_id = '".$barisab['id']."'";
			$hasilc = mysql_query($SQLc) or die(mysql_error());
			if (mysql_num_rows($hasilc)<>0) {
		?>
		checked="checked"
		<? } ?>/></td>
								  <td class="style3" align="left">&nbsp;</td>
								  <td class="style3" align="left">&nbsp;</td>
								  <td class="style3" align="left"><?=$barisab['title']?></td>
								  <td align="center" class="style7"><a href='javascript:PopUp("menu_popup.php?id=<?=$barisab["id"]?>")'><img src="../draft/images/user_go.png" alt="Update" border="0" /></a><a href="javascript:confirmDelete('admin_submission.php?cmd=del_menu&amp;id=<?=$barisab["id"]?>&user_id=<?=$_GET['id']?>&nama=<?=$_GET['nama']?>')"></a></td>
								</tr>
				
						<? } // end of child 2?>
						
				<? $nRecord = $nRecord + 1; } // end of child 1?>
	<?  
		 $nRecord = $nRecord + 1;
		} //end of parent_id = 0
	} else { ?>
	  <tr bgcolor="white">
		<td align="center" colspan="17"><font color="red">Mohon maaf, tidak ada Data dimaksud.</font></td>
	  </tr>
	<?  } ?>
  </table>
  </form>
</div>
</body>
</html>
