<?php  @session_start(); include "otentik_inv.php"; 
include ("../include/functions.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script type="text/javascript" src="../assets/jquery.js"></script>
<SCRIPT language=javascript src="popcalendar.js"></SCRIPT>
</SCRIPT>
	<script language"javascript" type="text/javascript">
	function PopUp(url){
		window.open(url,'', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=750,height=400,left = 300,top = 150');
	}
	
	$(document).ready(function(){
		$("input[@name='tambah[]']").click(onSelectChange);
		//nilai = $("input[@name='tambah[]']").val();
		
		$('.simplehighlight').hover(function(){
			$(this).children().addClass('datahighlight');
		},function(){
			$(this).children().removeClass('datahighlight');
		});

	});
	function onSelectChange(){
		//alert (nilai);
		$("#kartu").attr("href", "javascript:PopUp('kartu_pl.php?id="+$("input[@name='tambah[]']:checked").val()+"')");
	} 
function uncek() {
	//$('input[name=tambah]').attr('checked', checked);
	//$("#tambah").removeAttr("checked");
	
	// Check anything that is not already checked:
	//jQuery(':checkbox:not(:checked)').attr('checked', 'checked');
	 
	// Remove the checkbox
	jQuery(':checkbox:checked').removeAttr('checked');
}
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
.datahighlight {
        background-color: #ffdc87 !important;
}
-->
</style></head>

<body>
<div align="center">

<form method="post" action="submission_inv.php">
<input type="hidden" name="cmd" value="del_kons" />
  <table width="1024" border="0" cellspacing="1" class="style3">
    <tr>
      <td width="2" rowspan="4">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="53" rowspan="3" valign="bottom"><div align="center" class="style4"><a href="index.php?mn=input_kons"><img src="draft/images/user_add.png" width="32" height="32" border="0" align="absbottom" class="style3" /></a></div></td>
      <td width="51" rowspan="3" valign="bottom"><div align="center" class="style4"><input type="image" src="draft/images/user_delete.png" width="32" height="32" /></div></td>
	  <td width="50" rowspan="3" valign="bottom"><div align="center" class="style4">
        <a id="kartu"><img src="../images/Packing-32.png" width="32" height="32" /></a>
      </div></td>
      <td width="50" rowspan="3" valign="bottom"><div align="center" class="style4">
        <input name="image" type="image" src="../images/cari.png" width="32" height="32" />
      </div></td>
      <td width="50" rowspan="3" valign="bottom"><div align="center"><a href=""><img src="../images/fileex.png" border="0" width="32" height="32" /></a></div></td>
      <td width="48" rowspan="3">&nbsp;</td>
      <td width="1" rowspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td width="17"><div align="center"><img src="draft/images/calendar.png" width="16" height="16" /></div></td>
      <td width="4"><div align="center">:</div></td>
      <td width="722">&nbsp; 
	  <?php  date_default_timezone_set('Asia/Shanghai'); echo date('l, j F Y'); ?></td>
      </tr>
    <tr>
      <td class="style3"><div align="center"><img src="draft/images/Gnome-Appointment-New-48.png" width="16" height="16" /></div></td>
      <td class="style3"><div align="center">:</div></td>
      <td class="style3"><div align="left"> &nbsp;<?php  echo gmdate(" H:i:s", time()+60*60*7); ?>  </div></td>
    </tr>
    <tr>
      <td class="style3"><div align="center"><img src="draft/images/user.png" width="16" height="16" /></div></td>
      <td class="style3"><div align="center">:</div></td>
      <td class="style3"><div align="left">&nbsp;Admin Inventory </div></td>
      <td class="style3"><div align="center" class="style5">Tambah</div></td>
      <td class="style3"><div align="center" class="style5">Hapus</div></td>
      <td class="style3"><div align="center" class="style5">Kartu</div></td>
	  <td class="style3"><div align="center" class="style5">Cari</div></td>
      <td class="style3" colspan="2"><div align="left"><span class="style5"></span>Export To MS-Excell</div></td>
      <td><span class="style5"></span></td>
    </tr>
    <tr>
      <td colspan="10">&nbsp;</td>
    </tr>
  </table>
  <table width="1000" border="0" bgcolor="#000000" cellspacing="1">
    <tr height="30" background="../images/impactg.png">
      <td class="style3">&nbsp;</td>
      <td class="style3">&nbsp;</td>
      <td class="style3">&nbsp;</td>
      <td class="style3">&nbsp;</td>
	  <td class="style3">&nbsp;</td>
      <td class="style3" align="center"><input type="text" name="nama" value="<?php  echo $_GET['nama']?>"  onclick="uncek()"/></td>
      <td class="style3" align="center"><input type="text" name="alamat" size="40" value="<?php  echo $_GET['alamat']?>"  onclick="uncek()"/></td>
      <td class="style3" align="center"><input type="text" name="kota" value="<?php  echo $_GET['kota']?>"  onclick="uncek()"/></td>
      <td class="style3">&nbsp;</td>
      <td class="style3">&nbsp;</td>
    </tr>
    <tr height="30" background="../images/impactg.png">
	  <td width="35" class="style3"><div align="center" class="style4">No.</div></td>
      <td width="41" class="style3"><div align="center" class="style4">#</div></td>
      <td width="63" class="style3"><div align="center" class="style4">Norek</div></td>
      <td width="94" class="style3"><div align="center" class="style4">Kode Konsumen </div></td>
	   <td width="132" class="style3"><div align="center" class="style4">Divisi</div></td>
      <td width="125" class="style3"><div align="center" class="style4">Nama</div></td>
	  <td width="365" class="style3"><div align="center" class="style4">Alamat</div></td>
      <td width="100" class="style3"><div align="center" class="style4">Kota</div></td>
      <td width="103" class="style3"><div align="center" class="style4">Telp.</div></td>
      <td width="46" class="style3"><div align="center" class="style4">Edit</div></td>
    </tr>
	<?php 
		$SQL = "select * FROM konsumen WHERE status = 1" ;
		if($_GET['nama']<>""){
			$SQL = $SQL . " AND nama LIKE '%".$_GET['nama']."%'";
		}
		if($_GET['alamat']<>""){
			$SQL = $SQL . " AND alamat LIKE '%".$_GET['alamat']."%'";
		}
		if($_GET['kota']<>""){
			$SQL = $SQL . " AND kota LIKE '%".$_GET['kota']."%'";
		}
		$SQL = $SQL." ORDER BY divisi";
		$hasil=mysql_query($SQL, $dbh_jogjaide);
		$id = 0;
	?>
	<?php  
		 $nRecord = 1;
			if (mysql_num_rows($hasil) > 0) { 
			while ($row=mysql_fetch_array($hasil)) { 
 	?>
    <tr <?php 	 if (($nRecord % 2)==0) {?>bgcolor="#e4e4e4"<?php  }  else {?>bgcolor="#FFFFCC"<?php  } ?>  class="simplehighlight">
      <td align="center" class="style3"><?php  echo ++$No?></td>
	  <td class="style3" align="center">
	  	<input type="checkbox" id="tambah" name="tambah[]" value="<?php  echo $row['kode'] ?>" /></td>
	  <td class="style3" align="center"><?php  echo $row['norek']?></td>
      <td class="style3" align="center"><?php  echo ($row['kode'])?></td>
      <td class="style3" align="left"><?php 
	  	$SQLc = "SELECT namadiv FROM divisi WHERE subdiv = '".$row['divisi']."'";
		$hasilc = mysql_query($SQLc);
		$barisc = mysql_fetch_array($hasilc);
		echo $barisc[0];
	  ?></td>
	  <td class="style3" align="left"><?php  echo $row['nama']?></td>
	  <td class="style3" align="left"><?php  echo $row['alamat']?></td>
      <td class="style3" align="left"><?php  echo $row['kota']?></td>
      <td class="style3" align="left"><?php  echo $row['telp']?></td>
	  
      <td class="style3"><div align="center">
	  <a href="index.php?mn=input_kons&id=<?php  echo $row['kode'] ?>"><img src="draft/images/user_go.png" border="0" width="16" height="16"></a>
	  </div></td>
    </tr>
	<?php   
		 $nRecord = $nRecord + 1;
		} 
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
