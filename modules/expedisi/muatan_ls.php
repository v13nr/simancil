<?php
	include "../../otentik.php";
	include "../../config_sistem.php";
	include "../../include/functions.php";
	include "phppagination.persediaan.class.php";
?>
<?php 
/**
 *	Copyright (C) CV. Jogjaide Ent.
 *  Project Manager : Nanang Rustianto
 *  Lead Programmer : Nanang Rustianto
 *  Email : anangr2001@yahoo.com
 *	Date: April 2014
**/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script type="text/javascript" src="../assets/jquery.js"></script>
<SCRIPT language=javascript src="popcalendar.js"></SCRIPT>
</SCRIPT>
 <script type='text/javascript' src='assets/thickbox/thickbox.js'></script>
<link  href="assets/thickbox/thickbox.css" rel="stylesheet" type="text/css" />
	<script language"javascript" type="text/javascript">
	function PopUp(url){
		window.open(url,'', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=800,height=400,left = 300,top = 150');
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

  function thickboxPopup3(){
	 var str = $('#dynamic_select').val();
	var n=str.split("=");
	  var vNIP = n[1];
	tb_show('Adjust Stock', 'adj_stok.php?kdbarang='+vNIP+'&TB_iframe=true&height=380&width=720', null);
}
	</script>
<style type="text/css">
<!--
body {
	background-image: url(../../images/ok.jpg);
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

<form method="post" action="expedisi_submission.php">
<input type="hidden" name="cmd" value="del_muatan" />
  <table width="1024" border="0" cellspacing="1" class="style3">
    <tr>
      <td width="2" rowspan="4">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="53" rowspan="3" valign="bottom"><div align="center" class="style4"><a href="daftar_muatan.php"><img src="../../images/user_add.png" width="32" height="32" border="0" align="absbottom" class="style3" /></a></div></td>
      <td width="51" rowspan="3" valign="bottom"><div align="center" class="style4"><input type="image" src="../../images/user_delete.png" width="32" height="32" /></div></td>
      <td width="50" rowspan="3" valign="bottom"><div align="center" class="style4"></div></td>
	  <td width="50" rowspan="3" valign="bottom"><div align="center" class="style4">
        <input name="image" type="image" src="../../images/cari.png" width="32" height="32" />
      </div></td>
      <td width="50" rowspan="3" valign="bottom"><div align="center"><a href="stok_export.php?etype=Excel"><img src="../../images/fileex.png" border="0" width="32" height="32" /></a></div></td>
      <td width="50" rowspan="3" valign="bottom"><div align="center"><a href="stok_export.php?etype=Cetak"><img src="../../images/icons/cetak.jpeg" border="0" width="32" height="32" /></a></div></td>
      <td width="48" rowspan="3">&nbsp;</td>
      <td width="1" rowspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td width="17"><div align="center"><img src="../../images/calendar.png" width="16" height="16" /></div></td>
      <td width="4"><div align="center">:</div></td>
      <td width="722">&nbsp; 
	  <?php  date_default_timezone_set('Asia/Shanghai'); echo date('l, j F Y'); ?></td>
      </tr>
    <tr>
      <td class="style3"><div align="center"><img src="../../images/Gnome-Appointment-New-48.png" width="16" height="16" /></div></td>
      <td class="style3"><div align="center">:</div></td>
      <td class="style3"><div align="left"> &nbsp;<?php  echo gmdate(" H:i:s", time()+60*60*7); ?>  </div></td>
    </tr>
    <tr>
      <td class="style3"><div align="center"><img src="../../images/user.png" width="16" height="16" /></div></td>
      <td class="style3"><div align="center">:</div></td>
      <td class="style3"><div align="left">&nbsp;Admin Expedisi </div></td>
      <td class="style3"><div align="center" class="style5">Tambah</div></td>
      <td class="style3"><div align="center" class="style5">Hapus</div></td>
      <td class="style3"><div align="center" class="style5"></div></td>
	  <td class="style3"><div align="center" class="style5">Cari</div></td>
      <td class="style3" colspan="1"><div align="left"><span class="style5"></span>Export </div></td>
      <td class="style3" colspan="1"><div align="left"><span class="style5"></span>&nbsp;&nbsp;Cetak</div></td>
      <td><span class="style5"></span></td>
    </tr>
    <tr>
      <td colspan="10">&nbsp;</td>
    </tr>
  </table>
  
 <!-- Filter -->
 <table width="1000" border="0" bgcolor="#000000" cellspacing="1">
    <tr height="30" background="../../images/impactg.png">
      <td class="style3">&nbsp;</td>
      <td class="style3">&nbsp;</td>
      <td class="style3">&nbsp;</td>
      <td class="style3"><input type="text" name="group" size="10" value="<?php  echo $_GET['group']?>" id="group"  onclick="uncek()" /></td>
      <td class="style3"><input type="text" name="kdbarang" size="5"  value="<?php  echo $_GET['kdbarang']?>" id="kdbarang" onclick="uncek()"/></td>
      <td class="style3"><input type="text" name="nama" value="<?php  echo $_GET['nama']?>" id="nama" onclick="uncek()"/></td>
      
      <td class="style3">&nbsp;</td>
      <td class="style3">&nbsp;</td>
    </tr>
    <tr height="30" background="../../images/impactg.png">
	  <td width="44" class="style3"><div align="center" class="style4">No.</div></td>
      <td width="50" class="style3"><div align="center" class="style4"><input name="checkAllMyCB" id="checkAllMyCB" onClick="jqCheckAll2( this.id, 'tambah' )" type="checkbox"></div></td>
          <td width="61" class="style3"><div align="center" class="style4">Tanggal</div></td>
      <td width="150" class="style3"><div align="center" class="style4">Nama Sopir</div></td>
      <td width="100" class="style3"><div align="center" class="style4">No Nota</div></td>
      <td width="310" class="style3"><div align="center" class="style4">Tujuan</div></td>
	  
	  <td width="123" class="style3"><div align="center" class="style4">PA</div></td>
      <td width="137" class="style3"><div align="center" class="style4">Action</div></td>
    </tr>
	<?php 
	
	 $nTotalItems = 0;
 $nItemsPerPage = 15; // set length of page

// get page number passed via GET method
if (isset($_GET['page']))
    $nCurrentPage = $_GET['page'];
else
    $nCurrentPage = 1;
	
	$sSQL = "select count(*) FROM muatan where id <> ''";
	
	if($_GET['kdbarang']<>""){
			$SQL = $SQL . " AND nonota LIKE '%".$_GET['kdbarang']."%'";
		}
	if($_GET['group']<>""){
			$sSQL = $sSQL . " AND nama_pengirim LIKE '%".$_GET['group']."%'";
		}
	if($_GET['nama']<>""){
			$sSQL = $sSQL . " AND alamat_penerima LIKE '%".$_GET['nama']."%'";
		}
		$sSQL .= " GROUP BY notamuatan";
	$result = mysql_query($sSQL) or die(mysql_error());
        
	$row=mysql_fetch_row($result);
	$nTotalItems=$row[0];
	
	// create pagination object
	$oPagination = new phpPagination ($nTotalItems, $nItemsPerPage);

	$SQL = "SELECT * FROM muatan where id <> ''";
	if($_GET['kdbarang']<>""){
			$SQL = $SQL . " AND nonota LIKE '%".$_GET['kdbarang']."%'";
		}
	if($_GET['group']<>""){
			$SQL = $SQL . " AND nama_pengirim LIKE '%".$_GET['group']."%'";
		}
	if($_GET['nama']<>""){
			$SQL = $SQL . " AND alamat_penerima LIKE '%".$_GET['nama']."%'";
		}
	$SQL = $SQL." GROUP BY notamuatan  ORDER BY tanggal DESC, notamuatan ASC  LIMIT "
    .($nCurrentPage-1)*$nItemsPerPage
    .", $nItemsPerPage";
	$hasil=mysql_query($SQL, $dbh_jogjaide) or die(mysql_error());
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
	  	<input type="checkbox" id="tambah" name="tambah[]" value="<?php  echo $row['notamuatan'] ?>" /></td>
          <td class="style3" align="center"><?php  echo baliktglindo($row['tanggal'])?></td>
	  <td class="style3" align="left" style="padding-left:10px"><?php  echo $row['sopir']?></td>
      <td class="style3" align="center"><?php  echo ($row['notamuatan'])?></td>
      <td class="style3" align="left"><?php  echo $row['tujuan']?></td>
	  
	  <td class="style3" align="center" style="padding-right:5px"><?php  echo ($row['pa'])?></td>
	  
      <td class="style3"><div align="center">[
	  <a href="daftar_muatan.php?cmd=edit&id=<?php  echo $row['notamuatan'] ?>">Edit</a>]
      
	  [<a href="muatan_cetak.php?id=<?php echo $row['notamuatan']; ?>" target="_blank">Cetak</a>]
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
