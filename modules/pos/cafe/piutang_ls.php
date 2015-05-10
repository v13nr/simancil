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

<form method="post" action="">
<input type="hidden" name="cmd" value="" />
  <table width="1024" border="0" cellspacing="1" class="style3">
    <tr>
      <td width="2" rowspan="4">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="53" rowspan="3" valign="bottom"><div align="center" class="style4"><a href="index.php?mn=penjualan"><img src="../draft/images/user_add.png" width="32" height="32" border="0" align="absbottom" class="style3" /></a></div></td>
      <td width="51" rowspan="3" valign="bottom"><div align="center" class="style4"></div></td>
      <td width="50" rowspan="3"><div align="center" class="style4"></div></td>
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
      <td class="style3"><div align="center" class="style5"></div></td>
      <td class="style3"><div align="center" class="style5"></div></td>
      <td class="style3" colspan="2"><div align="left"><span class="style5"></span>Export To MS-Excell</div></td>
      <td><span class="style5"></span></td>
    </tr>
    <tr>
      <td colspan="10">&nbsp;</td>
    </tr>
  </table>
  <table width="100%" border="0" bgcolor="#000000" cellspacing="1">
    <tr height="30" background="../images/impactg.png">
	  <td width="39" class="style3"><div align="center" class="style4">No.</div></td>
      <td width="32" class="style3"><div align="center" class="style4">#</div></td>
      <td width="77" class="style3"><div align="center" class="style4">Tanggal</div></td>
      <td width="74" class="style3"><div align="center" class="style4">Faktur </div></td>
      <td width="126" class="style3"><div align="center" class="style4">Nama</div></td>
	  <td width="114" class="style3"><div align="center" class="style4">Divisi</div></td>
	  <td width="345" class="style3"><div align="center" class="style4">Alamat</div></td>
	  <td width="85" class="style3"><div align="center" class="style4">Saldo</div></td>
      
	  
      <td width="124" class="style3"><div align="center" class="style4">Todo</div></td>
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
	  <td class="style3" align="center">
	  	<input type="checkbox" id="tambah" name="tambah[]" value="<?php  echo $row['id'] ?>" /></td>
	  <td class="style3" align="center"><?php  echo baliktglindo($row['tgl'])?></td>
      <td class="style3" align="let"><?php  echo $row['nota'];?></td>
      <td class="style3" align="left"><?php  echo $row['nama']?></td>
	  <td class="style3" align="left"><?php 
	  	$SQLc = "SELECT namadiv FROM divisi WHERE subdiv = '".$row['sub']."'";
		$hasilc = mysql_query($SQLc);
		$barisc = mysql_fetch_array($hasilc);
		echo $barisc[0];
	  ?></td>
	  <td class="style3" align="left"><?php  echo $row['alamat']?></td>
	  <td class="style3" align="right">
	  <?php  echo number_format($row['saldo'],2,'.',',')?>
	  <?php  $total = $total + $row['saldo'];?>
	  </td>
      
	  
	  
      <td class="style3"><div align="center">
	  <?php  //if($_SESSION["sess_tipe"]==$row['sub']) 
	  { ?>[
	  <a href="angsuran.php?ida=<?php  echo $row['id'] ?>&nomor=<?php  echo $row['nota']; ?>&amp;width=600&amp;height=350&amp;TB_iframe=true" class="thickbox">Posting Angsuran </a>]
	  <a href="penjualan_kredit_edit.php?nonota=<?php  echo $row['nota']?>&sub=<?php  echo $row['sub']?>"><img src="../draft/images/user_go.png" border="0" width="16" height="16"></a>
	  <?php  } ?>
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
	
	<tr <?php 	 if (($nRecord % 2)==0) {?>bgcolor="#e4e4e4"<?php  }  else {?>bgcolor="#FFFFCC"<?php  } ?>>
      <td align="center" class="style3">&nbsp;</td>
      <td class="style3" align="center">&nbsp;</td>
      <td class="style3" align="center">&nbsp;</td>
      <td class="style3" align="let">&nbsp;</td>
      <td class="style3" align="left">&nbsp;</td>
      <td class="style3" align="left">&nbsp;</td>
      <td class="style3" align="left">&nbsp;</td>
      <td class="style3" align="right"><?php  echo number_format($total,2,'.',',')?></td>
      
      <td class="style3">&nbsp;</td>
    </tr>
  </table>
  </form>
</div>
</body>
</html>
