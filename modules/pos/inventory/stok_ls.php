<?php  include "otentik_inv.php"; 
include ("../include/functions.php");
include "phppagination.persediaan.class.php";

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
		
		$("#group").focus(function(){
			// Select input field contents
			this.select();
		});
		$("#kdbarang").focus(function(){
			// Select input field contents
			this.select();
		});
		$("#nama").focus(function(){
			// Select input field contents
			this.select();
		});

		$('.simplehighlight').hover(function(){
			$(this).children().addClass('datahighlight');
		},function(){
			$(this).children().removeClass('datahighlight');
		});

	});
	function onSelectChange(){
		//alert (nilai);
		$("#formula").attr("href", "javascript:PopUp('master_bahanjadi.php?id="+$("input[@name='tambah[]']:checked").val()+"')");
	} 
	function uncek() {
	//$('input[name=tambah]').attr('checked', checked);
	//$("#tambah").removeAttr("checked");
	
	// Check anything that is not already checked:
	//jQuery(':checkbox:not(:checked)').attr('checked', 'checked');
	 
	// Remove the checkbox
	jQuery(':checkbox:checked').removeAttr('checked');
}

function jqCheckAll2( id, name )
{
	//$("INPUT[@name=" + name + "][type='checkbox']").attr('checked', $('#' + id).is(':checked'));
	$("INPUT[@name^=" + name + "][type='checkbox']").attr('checked', $('#' + id).is(':checked')); 	
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
<input type="hidden" name="cmd" value="del_stok" />
  <table width="1024" border="0" cellspacing="1" class="style3">
    <tr>
      <td width="2" rowspan="4">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="53" rowspan="3" valign="bottom"><div align="center" class="style4"><a href="index.php?mn=input_persediaan"><img src="../draft/images/user_add.png" width="32" height="32" border="0" align="absbottom" class="style3" /></a></div></td>
      <td width="51" rowspan="3" valign="bottom"><div align="center" class="style4"><input type="image" src="../draft/images/user_delete.png" width="32" height="32" /></div></td>
      <td width="50" rowspan="3" valign="bottom"><div align="center" class="style4">
        <a id="formula"><img src="../images/Packing-32.png" width="32" height="32" /></a>
      </div></td>
	  <td width="50" rowspan="3" valign="bottom"><div align="center" class="style4">
        <input name="image" type="image" src="../images/cari.png" width="32" height="32" />
      </div></td>
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
      <td class="style3"><div align="left">&nbsp;Admin Inventory </div></td>
      <td class="style3"><div align="center" class="style5">Tambah</div></td>
      <td class="style3"><div align="center" class="style5">Hapus</div></td>
      <td class="style3"><div align="center" class="style5">Formula</div></td>
	  <td class="style3"><div align="center" class="style5">Cari</div></td>
      <td class="style3" colspan="2"><div align="left"><span class="style5"></span>Export To MS-Excell</div></td>
      <td><span class="style5"></span></td>
    </tr>
    <tr>
      <td colspan="10">&nbsp;</td>
    </tr>
  </table>
  
 <!-- Filter -->
 <table width="1000" border="0" bgcolor="#000000" cellspacing="1">
    <tr height="30" background="../images/impactg.png">
      <td class="style3">&nbsp;</td>
      <td class="style3">&nbsp;</td>
      <td class="style3">&nbsp;</td>
      <td class="style3">&nbsp;</td>
      <td class="style3"><input type="text" name="group" size="10" value="<?php  echo $_GET['group']?>" id="group"  onclick="uncek()" /></td>
      <td class="style3"><input type="text" name="kdbarang" size="5"  value="<?php  echo $_GET['kdbarang']?>" id="kdbarang" onclick="uncek()"/></td>
      <td class="style3"><input type="text" name="nama" value="<?php  echo $_GET['nama']?>" id="nama" onclick="uncek()"/></td>
      <td class="style3">&nbsp;</td>
      <td class="style3">&nbsp;</td>
      <td class="style3">&nbsp;</td>
      <td class="style3">&nbsp;</td>
      <td class="style3">&nbsp;</td>
      <td class="style3">&nbsp;</td>
    </tr>
    <tr height="30" background="../images/impactg.png">
	  <td width="31" class="style3"><div align="center" class="style4">No.</div></td>
      <td width="35" class="style3"><div align="center" class="style4"><input name="checkAllMyCB" id="checkAllMyCB" onClick="jqCheckAll2( this.id, 'tambah' )" type="checkbox"></div></td>
	  <td width="35" class="style3"><div align="center" class="style4">Divisi</div></td>
          <td width="35" class="style3"><div align="center" class="style4">Expedisi</div></td>
      <td width="107" class="style3"><div align="center" class="style4">Group</div></td>
      <td width="71" class="style3"><div align="center" class="style4">Kode Barang </div></td>
      <td width="247" class="style3"><div align="center" class="style4">Nama Barang </div></td>
	  <td width="55" class="style3"><div align="center" class="style4">Stok</div></td>
	  <td width="55" class="style3"><div align="center" class="style4">Isi</div></td>
      <td width="80" class="style3"><div align="center" class="style4">Eceran</div></td>
      <td width="74" class="style3"><div align="center" class="style4">Partai</div></td>
	  <td width="85" class="style3"><div align="center" class="style4">Norek</div></td>
      <td width="46" class="style3"><div align="center" class="style4">Edit</div></td>
    </tr>
	<?php 
	
	 $nTotalItems = 0;
 $nItemsPerPage = 15; // set length of page

// get page number passed via GET method
if (isset($_GET['page']))
    $nCurrentPage = $_GET['page'];
else
    $nCurrentPage = 1;
	
	$sSQL = "select count(*) FROM stock where status = 1";
	if($_GET['kdbarang']<>""){
			$sSQL = $sSQL . " AND kodebrg LIKE '%".$_GET['kdbarang']."%'";
		}
	if($_GET['group']<>""){
			$sSQL = $sSQL . " AND grup LIKE '%".$_GET['group']."%'";
		}
	if($_GET['nama']<>""){
			$sSQL = $sSQL . " AND namabrg LIKE '%".$_GET['nama']."%'";
		}
	$result = mysql_query($sSQL)
        or die ("Invalid query '$sSQL'");
	$row=mysql_fetch_row($result);
	$nTotalItems=$row[0];
	
	// create pagination object
	$oPagination = new phpPagination ($nTotalItems, $nItemsPerPage);

	$SQL = "SELECT * FROM stock where status = 1";
	if($_GET['kdbarang']<>""){
			$SQL = $SQL . " AND kodebrg LIKE '%".$_GET['kdbarang']."%'";
		}
	if($_GET['group']<>""){
			$SQL = $SQL . " AND grup LIKE '%".$_GET['group']."%'";
		}
	if($_GET['nama']<>""){
			$SQL = $SQL . " AND namabrg LIKE '%".$_GET['nama']."%'";
		}
	$SQL = $SQL." ORDER BY divisi, grup LIMIT "
    .($nCurrentPage-1)*$nItemsPerPage
    .", $nItemsPerPage";
	$hasil=mysql_query($SQL, $dbh_jogjaide);
		//echo $SQL;
		$id = 0;
	?>
	<?php  
		 $nRecord = 1;
			if (mysql_num_rows($hasil) > 0) { 
			while ($row=mysql_fetch_array($hasil)) { 
 	?>
    <tr <?php 	 if (($nRecord % 2)==0) {?>bgcolor="#e4e4e4"<?php  }  else {?>bgcolor="#FFFFCC"<?php  } ?>  class="simplehighlight">
      <td align="center" class="style3"><?php  echo ++$No + (($nCurrentPage -1 ) * $nItemsPerPage)?></td>
	  <td class="style3" align="center">
	  	<input type="checkbox" id="tambah" name="tambah[]" value="<?php  echo $row['kodebrg'] ?>" /></td>
	  <td class="style3" align="center"><?php 
	  	$SQLc = "SELECT namadiv FROM divisi WHERE subdiv = '".$row['divisi']."'";
		$hasilc = mysql_query($SQLc);
		$barisc = mysql_fetch_array($hasilc);
		echo $barisc[0];
	  ?></td>
          <td class="style3" align="center"><?php  echo $row['expedisi']?></td>
	  <td class="style3" align="center"><?php  echo $row['grup']?></td>
      <td class="style3" align="center"><?php  echo ($row['kodebrg'])?></td>
      <td class="style3" align="left"><?php  echo $row['namabrg']?></td>
	  <td class="style3" align="center"><?php  echo number_format(($row['qtyin']-$row['qtyout']),2,'.',',')?></td>
	  <td class="style3" align="center"><?php  echo number_format($row['isi'],2,'.',',')?></td>
      <td class="style3" align="center"><?php  echo $row['satuank']?></td>
      <td class="style3" align="center"><?php  echo $row['satuanb']?></td>
	  <td class="style3" align="center"><?php  echo $row['norek']?></td>
	  
      <td class="style3"><div align="center">
	  <a href="index.php?mn=input_persediaan&id=<?php  echo $row['kodebrg'] ?>"><img src="../draft/images/user_go.png" border="0" width="16" height="16"></a>
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
  <?php  // print pagination for current page
  	if ($nTotalItems>0){
		echo $oPagination->GetHtml($nCurrentPage)."\n"; 
	} else {	}	
	
	?>
	
</div>
</body>
</html>
