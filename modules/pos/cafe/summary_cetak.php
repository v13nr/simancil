<? //include "../otentik_inv.php"; 
include ("../include/functions.php");
include ("../include/globalx.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<SCRIPT language=javascript src="popcalendar.js"></SCRIPT>
</SCRIPT>
	<script language"javascript" type="text/javascript">
	function PopUp(url){
	window.open(url,'', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=400,height=100,left = 200,top = 200');
	}
</script>
<style type="text/css">
<!--

.style3 { font-family: "Segoe UI"; font-size: 12px; }
.style4 {color: #FFFFFF}
.style5 {color: #000000; }

-->
</style>

<style type="text/css">
.mystri {text-decoration: line-through;}
</style>
</head>

<body onload="window.print()">
<table width="659">
  <tr>
    <td colspan="3"><strong>SUMMARY  REPORT</strong></td>
  </tr>
  <tr>
    <td>PERIODE</td>
    <td>:</td>
    <td><?=$_POST['tgl_awal']?>
      s/d
      <?=$_POST['tgl_akhir']?></td>
  </tr>
  <tr>
    <td width="87">SHIFT</td>
    <td width="8">:</td>
    <td width="548"><?php 
			$SQL = "select * from ml_user b where id = '". $_POST['shift'] ."'";
			$hasil = mysql_query($SQL, $dbh_jogjaide);
			$baris = mysql_fetch_array($hasil);
			if($_POST['shift'] <> ""){ echo $baris["nama"]; } else { echo "ALL";}
		?></td>
  </tr>
</table>
<div align="center">
  <form method="post" action="submission_cafe.php">
<input type="hidden" name="cmd" value="del_mutasi" />
  <table border="0" cellspacing="1" class="style3">
    <tr>
      <td><span class="style5"></span></td>
    </tr>
  </table>
  <table width="1000" border="0" bgcolor="#000000" cellspacing="1">
    <tr height="30" background="../images/impactg.png">
	  <td width="31" class="style3"><div align="center" class="style4">No.</div></td>
      <td width="35" class="style3"><div align="center" class="style4">#</div></td>
      <td width="107" class="style3"><div align="center" class="style4">Tanggal</div></td>
      <td width="71" class="style3"><div align="center" class="style4">Nota</div></td>
      <td width="247" class="style3"><div align="center" class="style4">No Bukti </div></td>
	  <td width="247" class="style3"><div align="center" class="style4">Meja</div></td>
	  <td width="55" class="style3"><div align="center" class="style4">Shift</div></td>
      <td width="80" class="style3"><div align="center" class="style4">Nama</div></td>
      <td width="74" class="style3"><div align="center" class="style4">Alamat</div></td>
	  <td width="135" class="style3"><div align="center" class="style4">KodeBrg</div></td>
	  <td width="85" class="style3"><div align="center" class="style4">Nama Barang </div></td>
	  <td width="85" class="style3"><div align="center" class="style4">Qty In </div></td>
	  <td width="85" class="style3"><div align="center" class="style4">Qty Out </div></td>
	  <td width="85" class="style3"><div align="center" class="style4">Satuan </div></td>
	  <td width="85" class="style3"><div align="center" class="style4">Disc </div></td>
	  <td width="85" class="style3"><div align="center" class="style4">Disc 2 </div></td>
	  <td width="85" class="style3"><div align="center" class="style4">Dis 3 </div></td>
	  <td width="85" class="style3"><div align="center" class="style4">Disc Rp </div></td>
	  <td width="85" class="style3"><div align="center" class="style4">Harga </div></td>
	  <td width="85" class="style3"><div align="center" class="style4">Debet </div></td>
	  <td width="85" class="style3"><div align="center" class="style4">Kredit </div></td>
	  <td width="85" class="style3"><div align="center" class="style4">User </div></td>
    </tr>
	<?
		$SQL = "select * FROM mutasi where status = 1" ;
		if($_POST['shift']<>""){
			$SQL = $SQL . " AND user_id = '".$_POST['shift']."%'";
		}
		if($_GET['c_nama']<>""){
			$SQL = $SQL . " AND nama LIKE '%".$_GET['c_nama']."%'";
		}
		if($_GET['c_jk']<>""){
			$SQL = $SQL . " AND jkel = '".$_GET['c_jk']."'";
		}
		if($_GET['c_dep']<>""){
			$SQL = $SQL . " AND departemen = '".$_GET['c_dep']."'";
		}
		$SQL = $SQL . " AND tgl BETWEEN '". baliktgl($_POST['tgl_awal']) ."' AND  '". baliktgl($_POST['tgl_akhir']) ."'";
		$SQL = $SQL." ORDER BY tgl DESC, nota ASC, sub ASC, nomor DESC";
		$hasil=mysql_query($SQL, $dbh_jogjaide);
		$id = 0;
	?>
	<? 
		 $nRecord = 1;
			if (mysql_num_rows($hasil) > 0) { 
			while ($row=mysql_fetch_array($hasil)) { 
 	?>
    
    <tr <?	 if (($nRecord % 2)==0) {?>bgcolor="#e4e4e4"<? }  else {?>bgcolor="#FFFFCC"<? } ?>>
      <td align="center" class="style3"><?=++$No?></td>
	  <td class="style3" align="center">&nbsp;</td>
	  <td class="style3 <? if($row['status']=="0"){?> mystri <? }?>" align="center"><?=baliktglindo($row['tgl'])?></td>
	  <?
	  	$nota = $row['nota'];
	  	if($row['model']=="INV"){
			$nota = "INV/".$row['sub']."/".nobukti($row['nomor']);
		}
	  ?>
      <td class="style3 <? if($row['status']=="0"){?> mystri <? }?>" align="center"><?=$nota?></td>
      <td class="style3 <? if($row['status']=="0"){?> mystri <? }?>" align="left"><?=$row['nobukti']?></td>
	  <td class="style3 <? if($row['status']=="0"){?> mystri <? }?>" align="left"><span class="style3">
	    <?
	  	$SQLc = "SELECT nama FROM meja WHERE id = '".$row['meja_id']."'";
		$hasilc = mysql_query($SQLc);
		$barisc = mysql_fetch_array($hasilc);
		echo $barisc[0];
	  ?>
	  </span></td>
	  <td class="style3 <? if($row['status']=="0"){?> mystri <? }?>" align="center"><?
	  	
		echo $row["shift_id"];
	  ?></td>
      <td class="style3 <? if($row['status']=="0"){?> mystri <? }?>" align="center"><?=$row['nama']?></td>
      <td class="style3 <? if($row['status']=="0"){?> mystri <? }?>" align="center"><?=$row['alamat']?></td>
	  <td class="style3 <? if($row['status']=="0"){?> mystri <? }?>" align="center"><?=auto($row['kodebrg'])?></td>
	  <td class="style3 <? if($row['status']=="0"){?> mystri <? }?>" align="center"><?=$row['namabrg']?></td>
	  <td width="85" class="style3 <? if($row['status']=="0"){?> mystri <? }?>"><div align="right">
	    <?=number_format($row['qtyin'],2,'.',',')?>
	  </div></td>
	  <td width="85" class="style3 <? if($row['status']=="0"){?> mystri <? }?>"><div align="right">
	    <?=number_format($row['qtyout'],2,'.',',')?>
	  </div></td>
	  <td width="85" class="style3 <? if($row['status']=="0"){?> mystri <? }?>"><div align="center">
	    <?=$row['satuan']?>
	    </div></td>
	  <td width="85" class="style3 <? if($row['status']=="0"){?> mystri <? }?>"><div align="right">
	    <?=number_format($row['disc'],2,'.',',')?>
	  </div></td>
	  <td width="85" class="style3 <? if($row['status']=="0"){?> mystri <? }?>"><div align="right">
	    <?=number_format($row['disc2'],2,'.',',')?>
	  </div></td>
	  <td width="85" class="style3 <? if($row['status']=="0"){?> mystri <? }?>"><div align="right">
	    <?=number_format($row['disc3'],2,'.',',')?>
	  </div></td>
	  <td width="85" class="style3 <? if($row['status']=="0"){?> mystri <? }?>"><div align="right">
	    <?=number_format($row['discrp'],2,'.',',')?>
	  </div></td>
	  <td width="85" class="style3 <? if($row['status']=="0"){?> mystri <? }?>"><div align="right">
	    <?=number_format($row['harga'],2,'.',',')?>
	  </div></td>
	  <td width="85" class="style3 <? if($row['status']=="0"){?> mystri <? }?>"><div align="right">
	    <?=number_format($row['debet'],2,'.',',')?>
	  </div></td>
	  <td width="85" class="style3 <? if($row['status']=="0"){?> mystri <? }?>"><div align="right">
	    <?=number_format(($row['harga']*$row['qtyout']),2,'.',',')?>
		<? if($row['status']!="0"){ $total = $total + ($row['harga'] * $row['qtyout']); } ?>
	  </div></td>
	  <td width="85" class="style3 <? if($row['status']=="0"){?> mystri <? }?>"><div align="center">
	  <?
			$SQLuser = "SELECT nama FROM ml_user WHERE id = ".$row['user_id'];
			$hasiluser= mysql_query($SQLuser);
			$barisuser = mysql_fetch_array($hasiluser);
			echo $barisuser[0];
		?>
	   </div></td>
    </tr>
	<?  
		 $nRecord = $nRecord + 1;
		} 
	} else { ?>
	  <tr bgcolor="white">
		<td align="center" colspan="27"><font color="red">Mohon maaf, tidak ada Data dimaksud.</font></td>
	  </tr>
	<?  } ?>
	<tr <?	 if (($nRecord % 2)==0) {?>bgcolor="#e4e4e4"<? }  else {?>bgcolor="#FFFFCC"<? } ?>>
      <td align="center" class="style3">&nbsp;</td>
      <td class="style3" align="center">&nbsp;</td>
      <td class="style3 <? if($row['status']=="0"){?> mystri <? }?>" align="center">&nbsp;</td>
      <td class="style3 <? if($row['status']=="0"){?> mystri <? }?>" align="center">&nbsp;</td>
      <td class="style3 <? if($row['status']=="0"){?> mystri <? }?>" align="left">&nbsp;</td>
      <td class="style3 <? if($row['status']=="0"){?> mystri <? }?>" align="left">&nbsp;</td>
      <td class="style3 <? if($row['status']=="0"){?> mystri <? }?>" align="center">&nbsp;</td>
      <td class="style3 <? if($row['status']=="0"){?> mystri <? }?>" align="center">&nbsp;</td>
      <td class="style3 <? if($row['status']=="0"){?> mystri <? }?>" align="center">&nbsp;</td>
      <td class="style3 <? if($row['status']=="0"){?> mystri <? }?>" align="center">&nbsp;</td>
      <td class="style3 <? if($row['status']=="0"){?> mystri <? }?>" align="center">&nbsp;</td>
      <td class="style3 <? if($row['status']=="0"){?> mystri <? }?>">&nbsp;</td>
      <td class="style3 <? if($row['status']=="0"){?> mystri <? }?>">&nbsp;</td>
      <td class="style3 <? if($row['status']=="0"){?> mystri <? }?>">&nbsp;</td>
      <td class="style3 <? if($row['status']=="0"){?> mystri <? }?>">&nbsp;</td>
      <td class="style3 <? if($row['status']=="0"){?> mystri <? }?>">&nbsp;</td>
      <td class="style3 <? if($row['status']=="0"){?> mystri <? }?>">&nbsp;</td>
      <td class="style3 <? if($row['status']=="0"){?> mystri <? }?>">&nbsp;</td>
      <td class="style3 <? if($row['status']=="0"){?> mystri <? }?>">&nbsp;</td>
      <td class="style3 <? if($row['status']=="0"){?> mystri <? }?>">&nbsp;</td>
      <td align="right" class="style3 <? if($row['status']=="0"){?> mystri <? }?>"><?=number_format(($total),2,'.',',')?></td>
      <td class="style3 <? if($row['status']=="0"){?> mystri <? }?>">&nbsp;</td>
    </tr>
  </table>
  </form>
</div>
</body>
</html>
