<?php
	include "otentik_keu.php";
	
include ("../include/globalx.php");
include ("../include/functions.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script language="JavaScript">

<!--
	function confirmDelete(delUrl) {
		if (confirm("Data ini akan dihapus!\nApakah Anda yakin untuk menghapusnya ?")) {
			document.location = delUrl;
		}
	}
	</script></SCRIPT>
	<script language"javascript" type="text/javascript">
	function PopUp(url){
	window.open(url,'', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=500,height=500,left = 400,top = 300');
	}
</script>
<script type="text/javascript">
	function CloseAndRefresh() 
{
    window.opener.location.href = window.opener.location.href;
    window.close();
}
</script>
</head>

<body>
<table width="90%" border="1" align="center">
  <tr>
    <td colspan="7" style="background:red"><div align="center"><?=$_GET["keterangan"]?></div></td>
  </tr>
  <tr>
    <td width="4%">
      <div align="center">
        <?=$_GET["tanggal"]?>
      </div></td>
    <td width="40%"><div align="center">KETERANGAN</div></td>
    <td width="6%"><div align="center">HARI KERJA </div></td>
    <td width="9%"><div align="center">UPAH</div></td>
    <td width="13%"><div align="center">RINCIAN</div></td>
    <td width="18%"><div align="center">TOTAL</div></td>
    <td width="10%"><div align="center">Todo</div></td>
  </tr>
  <form method="post" action="submission_keu.php">
  <input type="hidden" name="cmd" value="add_opname_ket" />
  <input type="hidden" name="tanggal" value="<?=$_GET["tanggal"]?>" />
  <input type="hidden" name="keterangan" value="<?=$_GET["keterangan"]?>" />
  <input type="hidden" name="id" value="<?=$_GET["id"]?>" />
  <tr>
    <td>&nbsp;</td>
    <td><input type="text" name="opname_ket" size="60" style="background:yellow" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center"><input type="submit" value="Tambah" /></td>
  </tr>
  </form>
  <?php
  		$SQLket = "select * from opname_detail where opname_id = '". $_GET["id"] ."' AND parent_id = 0";
		$hasilket = mysql_query($SQLket);
		while($barisket = mysql_fetch_array($hasilket)){
  ?>
  <tr style="background-color:#FFFF66">
    <td>&nbsp;</td>
    <td bgcolor="#FFFF00"><div align="right">
      <?=$barisket["keterangan"]?>
    </div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right">Rp.
			<?php
					$SQLr = "SELECT SUM(harikerja * upah) from opname_detail WHERE opname_id = '". $_GET["id"] ."' and parent_id = '". $barisket["id"] ."'";
					$hasilr = mysql_query($SQLr);
					$barisr = mysql_fetch_array($hasilr);
					echo number_format($barisr[0]);
					$total = $total + ($barisr[0]);
			?> </td>
    <td align="center"><a href="javascript:confirmDelete('submission_keu.php?id=<?=$_GET["id"]?>&amp;cmd=del_opname_parent&keterangan=<?=$_GET["keterangan"]?>&tanggal=<?=$_GET["tanggal"]?>&parent_id=<?=$barisket["id"]?>')"><img src="../images/hapus.gif" alt="Hapus" border="0" /></a></td>
  </tr>
	<form method="post" action="submission_keu.php">
  <input type="hidden" name="cmd" value="add_opname_rinci" />
  <input type="hidden" name="tanggal" value="<?=$_GET["tanggal"]?>" />
  <input type="hidden" name="keterangan" value="<?=$_GET["keterangan"]?>" />
  <input type="hidden" name="id" value="<?=$_GET["id"]?>" />
 
		  <tr>
			<td>&nbsp;</td>
			<td> <input type="hidden" name="parent_id" value="<?=$barisket["id"]?>" /><input type="text" name="keterangan_child" size="60" style="background-color:#CCCFFF" /></td>
			<td align="center"><input type="text" name="harikerja" size="5"  style="background-color:#CCCFFF" /></td>
			<td><input type="text" name="upah" size="10" style="background-color:#CCCFFF"  /></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td align="center"><input name="submit" type="submit" value="Simpan" /></td>
		  </tr>
		  </form>
		  
	<?php
			$SQLc = "select * from opname_detail where opname_id = '". $_GET["id"] ."' AND parent_id = '". $barisket["id"] ."'";
			$hasilc = mysql_query($SQLc);
			while($barisc = mysql_fetch_array($hasilc)){
	?>		  
			<tr>
			<td>&nbsp;</td>
			<td><?=$barisc["keterangan"];?></td>
			<td><div align="right">
			  <?=$barisc["harikerja"];?>
			</div></td>
			<td><div align="right">
              <?=number_format($barisc["upah"]);?>
            </div></td>
			<td><div align="right">
              <?=number_format($barisc["harikerja"]*$barisc["upah"]);?>
            </div></td>
			<td><div align="right"></div></td>
			<td align="center"><a href="javascript:confirmDelete('submission_keu.php?id=<?=$_GET["id"]?>&amp;cmd=del_opname_rinci&keterangan=<?=$_GET["keterangan"]?>&tanggal=<?=$_GET["tanggal"]?>&del_id=<?=$barisc["id"]?>')"><img src="../images/hapus.gif" alt="Hapus" border="0" /></a></td>
		  </tr>
	
  <?php 
  	} // end child
  } // end keternangan opname 
  ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right">Rp. 
        <?php
					echo number_format($total);
			?>
    </div></td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
