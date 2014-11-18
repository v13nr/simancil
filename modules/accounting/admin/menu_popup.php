<? session_start(); include ("../include/otentik_admin.php");?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Add/Edit Menu</title>
<script type="text/javascript">
	function CloseAndRefresh() 
{
    window.opener.location.href = window.opener.location.href;
    window.close();
}
</script>
</head>

<body onblur="CloseAndRefresh();">
<div align="center">
<?
	$SQLmenu = "SELECT * FROM jo_menu WHERE id = '".$_GET['id']."'";
	$hasilmenu = mysql_query($SQLmenu);
	$barismenu = mysql_fetch_array($hasilmenu);
	$id = $barismenu['id'];
	$nama = $barismenu['title'];
	$link = $barismenu['url'];
	$parent = $barismenu['parent_id'];
?>
<form method="post" action="admin_submission.php">
<? if($_GET['id']==""){?>
<input type="hidden" name="cmd" value="add_master_menu" />
<? } else { ?>
<input type="hidden" name="cmd" value="upd_master_menu" />
<input type="hidden" name="id" value="<?=$id?>" />
<? } ?>
<table>
	<tr>
		<td>Nama</td>
		<td>: <input type="text" name="nama" value="<?=$nama?>" /><br /></td>
	</tr>
	<tr>
		<td>Link</td>
		<td>: <input type="text" name="link" value="<?=$link?>" /><br /></td>
	</tr>
	<tr>
		<td>Parent</td>
		<td>: 
			<select name="parent">
				<option value="0">No Parent</option>
				<?
					$SQL = "SELECT * FROM jo_menu WHERE status = 1 AND aktif = 1 AND parent_id = 0";
					$hasil = mysql_query($SQL);
					while ($baris = mysql_fetch_array($hasil)){;
				?>
					<option value="<?=$baris['id']?>" <? if($baris['id']==$parent) { ?>selected="selected" <? }?> ><?=$baris['title']?></option>
						<?
						$SQLa = "SELECT * FROM jo_menu WHERE status = 1 AND aktif = 1 AND parent_id = '".$baris['id']."'";
						$hasila = mysql_query($SQLa);
						while ($barisa = mysql_fetch_array($hasila)){;
						?>
						<option value="<?=$barisa['id']?>"  <? if($barisa['id']==$parent) { ?>selected="selected" <? }?>>--<?=$barisa['title']?></option>
						<? } ?>
				<? } ?>
			</select>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<? if($_GET['id']==""){?>
		<td>&nbsp;&nbsp;<input type="submit" value="Simpan"  /></td>
		<? } else {?>
		<td>&nbsp;&nbsp;<input type="submit" value="Update"  /></td>
		<? } ?>
	</tr>

</table>
</form>
</div>
</body>
</html>
