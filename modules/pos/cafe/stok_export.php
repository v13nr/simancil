<?php 
/**
 *	Copyright (C) CV. Jogjaide Ent.
 *  Project Manager : Nanang Rustianto
 *  Lead Programmer : Nanang Rustianto
 *  Email : anangr2001@yahoo.com
 *	Date: April 2014
**/
?>
<?php  @session_start(); include "otentik_admin.php"; 
include ("../include/functions.php");
include "phppagination.persediaan.class.php";

?>
<?php 
	$excel = "tes";
  $filename1= 'Stok Barang_'.date('Y-m-d').'.doc';
  $filename2= 'Stok Barang_'.date('Y-m-d').'.xls';
  $pdf_output= 'Stok Barang_'.date('Y-m-d').'.pdf';
  if ($_GET["etype"] == 'Word') {
  header("Content-type: application/msword");
  header("Content-Disposition: attachment; filename=$filename1");
  header("Pragma: no-cache");
  header("Expires: 0");
  //print $excel;
  }
  elseif ($_GET["etype"] == 'Excel') {
  header("Content-type: application/msexcel");
  header("Content-Disposition: attachment; filename=$filename2");
  header("Pragma: no-cache");
  header("Expires: 0");
  //print $excel;
  }
  elseif ($_GET["etype"] == 'Cetak') {
  print'<title>Stok Barang</title>
  <script type="text/javascript">
  window.onload = function () {
    window.print();
  }
  </script>
  ';
  }
?>

<div align="center">

  
 <!-- Filter -->
 <table width="1000" border="0" bgcolor="#000000" cellspacing="1">
    
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
      <td width="80" class="style3"><div align="center" class="style4">HJE</div></td>
      <td width="74" class="style3"><div align="center" class="style4">Partai</div></td>
	  <td width="85" class="style3"><div align="center" class="style4">Tarif</div></td>
    </tr>
	<?php 
	
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
	$SQL = $SQL." ORDER BY grup DESC";
	$hasil=mysql_query($SQL, $dbh_jogjaide);
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
      <td class="style3" align="center"><?php  echo number_format($row['hargaeceran'])?></td>
      <td class="style3" align="center"><?php  echo number_format($row['hargapartai'])?></td>
	  <td class="style3" align="center"><?php  echo $row['tarif']?></td>
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

	
</div>
