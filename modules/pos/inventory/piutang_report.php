<?php  @session_start(); include "otentik_inv.php"; 
include ("../include/functions.php");

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
</script><script type="text/javascript" src="../assets/jquery-1.2.3.pack.js"></script><script type="text/javascript" src="../assets/jquery.validate.pack.js"></script><script language="javascript" src="../assets/thickbox/thickbox.js"></script>
 <link href="../assets/thickbox/thickbox.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--

.style3 { font-family: "Segoe UI"; font-size: 12px; }
.style4 {color: #FFFFFF}
.style5 {color: #000000; }
-->
</style></head>

<body onload="window.print()">
<div align="center">

<form method="post" action="">
  <table width="100%" border="0" bgcolor="#000000" cellspacing="1">
    <tr height="30" background="../images/impactg.png">
      <td width="26" rowspan="2" class="style3"><div align="center" class="style4">No.</div></td>
      <td width="206" rowspan="2" class="style3"><div align="center" class="style4">Nama</div></td>
      <td width="63" rowspan="2" class="style3"><div align="center" class="style4">Blok</div></td>
      <td width="60" rowspan="2" class="style3"><div align="center" class="style4">Luas </div></td>
      <td colspan="3" class="style3"><div align="center" class="style4">Penambahan</div></td>
      <td width="72" rowspan="2" class="style3"><div align="center" class="style4">Harga Rumah </div></td>
      <td width="62" rowspan="2" class="style3"><div align="center" class="style4">Total </div></td>
      <td width="69" rowspan="2" class="style3"><div align="center" class="style4">DP</div></td>
      <td width="63" rowspan="2" class="style3"><div align="center" class="style4">KPR</div></td>
      <td width="73" rowspan="2" class="style3"><div align="center" class="style4">Sisa</div></td>
      <td width="98" rowspan="2" class="style3"><div align="center" class="style4">Keterangan</div></td>
    </tr>
    <tr height="30" background="../images/impactg.png">
	  <td width="70" class="style3"><div align="center" class="style4">Tanah</div></td>
	  <td width="78" class="style3"><div align="center" class="style4">Bangunan</div></td>
	  <td width="64" class="style3"><div align="center" class="style4">Pajak</div></td>
	  </tr>
	<?php 
		$SQL = "select * FROM piutang" ;
		if($_GET['c_no']<>""){
			$SQL = $SQL . " AND noinduk LIKE '%".$_GET['c_no']."%'";
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
//		$SQL = $SQL." ORDER BY norek ASC";
		$hasil=mysql_query($SQL, $dbh_jogjaide);
		$id = 0;
	?>
	<?php  
		 $nRecord = 1;
			if (mysql_num_rows($hasil) > 0) { 
			while ($row=mysql_fetch_array($hasil)) { 
 	?>
    
    <tr <?php 	 if (($nRecord % 2)==0) {?>bgcolor="#e4e4e4"<?php  }  else {?>bgcolor="#FFFFCC"<?php  } ?>>
      <td align="center" class="style3"><?php  echo ++$No?></td>
	  <td class="style3" align="left"><?php  echo $row['nama']?></td>
	  <td class="style3" align="center"><?php  echo ($row['blok'])?></td>
      <td class="style3" align="center"><?php  echo ($row['luas']);?></td>
	  <td align="left" class="style3"><div align="right">
	    <?php  echo number_format($row['tanah'],2,'.',',')?>
	  </div></td>
	  <td align="left" class="style3"><div align="right">
        <?php  echo number_format($row['bangunan'],2,'.',',')?>
      </div></td>
	  <td align="left" class="style3"><div align="right">
        <?php  echo number_format($row['pajak'],2,'.',',')?>
      </div></td>
	  <td align="left" class="style3"><div align="right">
        <?php  echo number_format($row['hargarumah'],2,'.',',')?>
      </div></td>
	  <td align="left" class="style3"><div align="right">
        <?php 
		$total_kons = 0;
		echo number_format($row['tanah']+$row['bangunan']+$row['pajak']+$row['hargarumah'],2,'.',',');
		$total_kons = $row['tanah']+$row['bangunan']+$row['pajak']+$row['hargarumah'];
		?>
      </div></td>
	  <td align="left" class="style3"><div align="right">
        <?php 
			$dp = 0;
		 $SQLc = "SELECT SUM(nilai) FROM $database.piutang_detail WHERE piutang_id = '".$row['id']."'";
			$hasilc = mysql_query($SQLc, $dbh_jogjaide) or die(mysql_error());
			$barisc = mysql_fetch_array($hasilc);
		echo number_format($barisc[0],2,'.',',');
		$dp = $barisc[0];
		?>
      </div></td>
	  <td align="left" class="style3"><div align="right">
        <?php  echo number_format($row['kpr'],2,'.',',')?>
      </div></td>
	  <td class="style3" align="right">
	  <?php  echo number_format($total_kons - $dp - $row['kpr'],2,'.',',')?>
	  <?php  $total = $total + $total_kons - $dp - $row['kpr'];?>	  </td>
      
	  
	  
      <td class="style3"><div align="center">
        <?php  echo $row['tipebayar']?>
      </div></td>
    </tr>
	<?php   
		 $nRecord = $nRecord + 1;
		} 
	} else { ?>
	  <tr bgcolor="white">
		<td align="center" colspan="22"><font color="red">Mohon maaf, tidak ada Data dimaksud.</font></td>
	  </tr>
	<?php   } ?>
	
	<tr <?php 	 if (($nRecord % 2)==0) {?>bgcolor="#e4e4e4"<?php  }  else {?>bgcolor="#FFFFCC"<?php  } ?>>
      <td align="center" class="style3">&nbsp;</td>
      <td class="style3" align="center">&nbsp;</td>
      <td class="style3" align="center">&nbsp;</td>
      <td class="style3" align="let">&nbsp;</td>
      <td align="left" class="style3">&nbsp;</td>
      <td align="left" class="style3">&nbsp;</td>
      <td align="left" class="style3">&nbsp;</td>
      <td align="left" class="style3">&nbsp;</td>
      <td align="left" class="style3">&nbsp;</td>
      <td align="left" class="style3">&nbsp;</td>
      <td align="left" class="style3">&nbsp;</td>
      <td class="style3" align="right"><?php  echo number_format($total,2,'.',',')?></td>
      
      <td class="style3">&nbsp;</td>
    </tr>
  </table>
  </form>
</div>
</body>
</html>
