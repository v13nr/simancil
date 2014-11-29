<?php  include "otentik_inv.php"; 
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
</style>

<style type="text/css">
.mystri {text-decoration: line-through;}
</style>
</head>

<body>
<div align="center">

<form method="post" action="submission_cafe.php">
<input type="hidden" name="cmd" value="del_mutasi" />
  <table border="0" cellspacing="1" class="style3">
    <tr>
      <td width="2" rowspan="4">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="53" rowspan="3" valign="bottom"><div align="center"><a href="index.php?mn=input_persediaan"></a></div></td>
      <td width="51" rowspan="3" valign="bottom"><div align="center"></div></td>
      <td width="50" rowspan="3"><div align="center"></div></td>
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
      <td class="style3"><div align="center" class="style5"></div></td>
      <td class="style3"><div align="center" class="style5"></div></td>
      <td class="style3"><div align="center" class="style5"></div></td>
      <td class="style3" colspan="2"><div align="left"><span class="style5"></span>Export To MS-Excell</div></td>
      <td><span class="style5"></span></td>
    </tr>
    <tr>
      <td colspan="10">&nbsp;</td>
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
      <td width="46" class="style3"><div align="center" class="style4">Edit</div></td>
    </tr>
	<?php 
		$SQL = "select * FROM mutasi where id <> ''" ;
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
		$SQL = $SQL." ORDER BY tgl DESC, nota ASC, sub ASC, nomor DESC";
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
	  <td class="style3" align="center">&nbsp;</td>
	  <td class="style3 <?php  if($row['status']=="0"){?> mystri <?php  }?>" align="center"><?php  echo baliktglindo($row['tgl'])?></td>
	  <?php 
	  	$nota = $row['nota'];
	  	if($row['model']=="INV"){
			$nota = "INV/".$row['sub']."/".nobukti($row['nomor']);
		}
	  ?>
      <td class="style3 <?php  if($row['status']=="0"){?> mystri <?php  }?>" align="center"><?php  echo $nota?></td>
      <td class="style3 <?php  if($row['status']=="0"){?> mystri <?php  }?>" align="left"><?php  echo $row['nobukti']?></td>
	  <td class="style3 <?php  if($row['status']=="0"){?> mystri <?php  }?>" align="left"><span class="style3">
	    <?php 
	  	$SQLc = "SELECT nama FROM meja WHERE id = '".$row['meja_id']."'";
		$hasilc = mysql_query($SQLc);
		$barisc = mysql_fetch_array($hasilc);
		echo $barisc[0];
	  ?>
	  </span></td>
	  <td class="style3 <?php  if($row['status']=="0"){?> mystri <?php  }?>" align="center"><?php 
	  	
		echo $row["shift_id"];
	  ?></td>
      <td class="style3 <?php  if($row['status']=="0"){?> mystri <?php  }?>" align="center"><?php  echo $row['nama']?></td>
      <td class="style3 <?php  if($row['status']=="0"){?> mystri <?php  }?>" align="center"><?php  echo $row['alamat']?></td>
	  <td class="style3 <?php  if($row['status']=="0"){?> mystri <?php  }?>" align="center"><?php  echo auto($row['kodebrg'])?></td>
	  <td class="style3 <?php  if($row['status']=="0"){?> mystri <?php  }?>" align="center"><?php  echo $row['namabrg']?></td>
	  <td width="85" class="style3 <?php  if($row['status']=="0"){?> mystri <?php  }?>"><div align="right">
	    <?php  echo number_format($row['qtyin'],2,'.',',')?>
	  </div></td>
	  <td width="85" class="style3 <?php  if($row['status']=="0"){?> mystri <?php  }?>"><div align="right">
	    <?php  echo number_format($row['qtyout'],2,'.',',')?>
	  </div></td>
	  <td width="85" class="style3 <?php  if($row['status']=="0"){?> mystri <?php  }?>"><div align="center">
	    <?php  echo $row['satuan']?>
	    </div></td>
	  <td width="85" class="style3 <?php  if($row['status']=="0"){?> mystri <?php  }?>"><div align="right">
	    <?php  echo number_format($row['disc'],2,'.',',')?>
	  </div></td>
	  <td width="85" class="style3 <?php  if($row['status']=="0"){?> mystri <?php  }?>"><div align="right">
	    <?php  echo number_format($row['disc2'],2,'.',',')?>
	  </div></td>
	  <td width="85" class="style3 <?php  if($row['status']=="0"){?> mystri <?php  }?>"><div align="right">
	    <?php  echo number_format($row['disc3'],2,'.',',')?>
	  </div></td>
	  <td width="85" class="style3 <?php  if($row['status']=="0"){?> mystri <?php  }?>"><div align="right">
	    <?php  echo number_format($row['discrp'],2,'.',',')?>
	  </div></td>
	  <td width="85" class="style3 <?php  if($row['status']=="0"){?> mystri <?php  }?>"><div align="right">
	    <?php  echo number_format($row['harga'],2,'.',',')?>
	  </div></td>
	  <td width="85" class="style3 <?php  if($row['status']=="0"){?> mystri <?php  }?>"><div align="right">
	    <?php  echo number_format($row['debet'],2,'.',',')?>
	  </div></td>
	  <td width="85" class="style3 <?php  if($row['status']=="0"){?> mystri <?php  }?>"><div align="right">
	    <?php  echo number_format(($row['harga']*$row['qtyout']),2,'.',',')?>
		<?php  $total = $total + ($row['harga'] * $row['qtyout']); ?>
	  </div></td>
	  <td width="85" class="style3 <?php  if($row['status']=="0"){?> mystri <?php  }?>"><div align="center">
	  <?php 
			$SQLuser = "SELECT nama FROM ml_user WHERE id = ".$row['user_id'];
			$hasiluser= mysql_query($SQLuser);
			$barisuser = mysql_fetch_array($hasiluser);
			echo $barisuser[0];
		?>
	   </div></td>
	  
      <td class="style3"><div align="center">
	  <a href="index.php?mn=&id=<?php  echo $row['id'] ?>"></a>
	  </div></td>
    </tr>
	<?php   
		 $nRecord = $nRecord + 1;
		} 
	} else { ?>
	  <tr bgcolor="white">
		<td align="center" colspan="27"><font color="red">Mohon maaf, tidak ada Data dimaksud.</font></td>
	  </tr>
	<?php   } ?>
	<tr <?php 	 if (($nRecord % 2)==0) {?>bgcolor="#e4e4e4"<?php  }  else {?>bgcolor="#FFFFCC"<?php  } ?>>
      <td align="center" class="style3">&nbsp;</td>
      <td class="style3" align="center">&nbsp;</td>
      <td class="style3 <?php  if($row['status']=="0"){?> mystri <?php  }?>" align="center">&nbsp;</td>
      <td class="style3 <?php  if($row['status']=="0"){?> mystri <?php  }?>" align="center">&nbsp;</td>
      <td class="style3 <?php  if($row['status']=="0"){?> mystri <?php  }?>" align="left">&nbsp;</td>
      <td class="style3 <?php  if($row['status']=="0"){?> mystri <?php  }?>" align="left">&nbsp;</td>
      <td class="style3 <?php  if($row['status']=="0"){?> mystri <?php  }?>" align="center">&nbsp;</td>
      <td class="style3 <?php  if($row['status']=="0"){?> mystri <?php  }?>" align="center">&nbsp;</td>
      <td class="style3 <?php  if($row['status']=="0"){?> mystri <?php  }?>" align="center">&nbsp;</td>
      <td class="style3 <?php  if($row['status']=="0"){?> mystri <?php  }?>" align="center">&nbsp;</td>
      <td class="style3 <?php  if($row['status']=="0"){?> mystri <?php  }?>" align="center">&nbsp;</td>
      <td class="style3 <?php  if($row['status']=="0"){?> mystri <?php  }?>">&nbsp;</td>
      <td class="style3 <?php  if($row['status']=="0"){?> mystri <?php  }?>">&nbsp;</td>
      <td class="style3 <?php  if($row['status']=="0"){?> mystri <?php  }?>">&nbsp;</td>
      <td class="style3 <?php  if($row['status']=="0"){?> mystri <?php  }?>">&nbsp;</td>
      <td class="style3 <?php  if($row['status']=="0"){?> mystri <?php  }?>">&nbsp;</td>
      <td class="style3 <?php  if($row['status']=="0"){?> mystri <?php  }?>">&nbsp;</td>
      <td class="style3 <?php  if($row['status']=="0"){?> mystri <?php  }?>">&nbsp;</td>
      <td class="style3 <?php  if($row['status']=="0"){?> mystri <?php  }?>">&nbsp;</td>
      <td class="style3 <?php  if($row['status']=="0"){?> mystri <?php  }?>">&nbsp;</td>
      <td align="right" class="style3 <?php  if($row['status']=="0"){?> mystri <?php  }?>"><?php  echo number_format(($total),2,'.',',')?></td>
      <td class="style3 <?php  if($row['status']=="0"){?> mystri <?php  }?>">&nbsp;</td>
      <td class="style3">&nbsp;</td>
    </tr>
  </table>
  </form>
</div>
</body>
</html>
