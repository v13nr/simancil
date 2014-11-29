<?php  include "otentik_gli.php"; 
include ("../include/functions.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title><SCRIPT language=javascript src="popcalendar.js"></SCRIPT>
</SCRIPT><script language"javascript" type="text/javascript">
	function PopUp(url){
	window.open(url,'', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=400,height=100,left = 200,top = 200');
	}
</script><script type="text/javascript" src="../assets/jquery-1.2.3.pack.js"></script><script type="text/javascript" src="../assets/jquery.validate.pack.js"></script><script language="javascript" src="../assets/thickbox/thickbox.js"></script>
 <link href="../assets/thickbox/thickbox.css" rel="stylesheet" type="text/css" /><style type="text/css">
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

<form method="post" action="submission_gli.php">
<input type="hidden" name="cmd" value="del_aktiva" />
  <table width="1024" border="0" cellspacing="1" class="style3">
    <tr>
      <td width="2" rowspan="4">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="53" rowspan="3" valign="bottom"><div align="center" class="style4"><a href="index.php?mn=input_inv"><img src="../images/user_add.png" width="32" height="32" border="0" align="absbottom" class="style3" /></a></div></td>
      <td width="51" rowspan="3" valign="bottom"><div align="center" class="style4"><input type="image" src="../images/user_delete.png" width="32" height="32" /></div></td>
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
      <td class="style3"><div align="left">&nbsp;Admin General Ledger </div></td>
      <td class="style3"><div align="center" class="style5">Tambah</div></td>
      <td class="style3"><div align="center" class="style5">Hapus</div></td>
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
	  <td width="29" class="style3"><div align="center" class="style4">No.</div></td>
      <td width="34" class="style3"><div align="center" class="style4">#</div></td>
      <td width="91" class="style3"><div align="center" class="style4">Tanggal Beli </div></td>
      <td width="231" class="style3"><div align="center" class="style4">Nama Barang </div></td>
      <td width="90" class="style3"><div align="center" class="style4">Nilai</div></td>
	  <td width="58" class="style3"><div align="center" class="style4">Tarif </div></td>
      <td width="88" class="style3"><div align="center" class="style4">Nilai Susut / Thn </div></td>
      <td width="95" class="style3"><div align="center" class="style4">Akhir Periode </div></td>
	  <td width="84" class="style3"><div align="center" class="style4">Rek. Debet</div></td>
	  <td width="78" class="style3"><div align="center" class="style4">Rek. Kredit </div></td>
	  <td width="84" class="style3"><div align="center" class="style4">BB. Peny. </div></td>
	  <td width="78" class="style3"><div align="center" class="style4">AP. Peny. </div></td>
      <td width="88" class="style3"><div align="center" class="style4">
                Todo
              </div></td>
    </tr>
	<?php 
		$SQL = "select * FROM $database.aktiva WHERE status = 1" ;
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
      <td class="style3"><?php  echo $row['nama']?></td>
      <td class="style3" align="right"><?php  echo number_format($row['nilai'],2,'.',',')?></td>
	  <td class="style3" align="center"><?php  echo $row['tarif']?></td>
      <td class="style3" align="right"><?php  echo number_format($row['susut'],2,'.',',')?></td>
      <td class="style3" align="center"><font color="red"><?php  
			$SQLcari = "SELECT mano_post FROM $database.aktiva_details WHERE aktiva_id = '" . $row['id'] . "' ORDER BY id DESC LIMIT 1";
			$hasilcari = mysql_query($SQLcari, $dbh_jogjaide);
			while ($bariscari = mysql_fetch_array($hasilcari)){
				echo baliktglindo($bariscari[0]);
			};
	?></font></td>
	  <td class="style3" align="center"><?php  echo $row['rekdebet']?></td>
	  <td class="style3" align="center"><?php  echo $row['rekkredit']?></td>
	  <td class="style3" align="center"><?php  echo $row['rek_d_bbsusut']?></td>
	  <td class="style3" align="center"><?php  echo $row['rek_k_akmsusut']?></td>
      <td class="style3"><div align="center">
	<a href="penyusutan.php?ida=<?php  echo $row['id'] ?>&amp;width=600&amp;height=350&amp;TB_iframe=true" class="thickbox"><img src="../assets/button_search.png" alt="Pilih Akun" border="0" /></a>
	  <a href="index.php?mn=input_inv&id=<?php  echo $row['id'] ?>"></a>
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
