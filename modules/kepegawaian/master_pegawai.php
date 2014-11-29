<?php 
include "otentik_kepeg.php"; 
include ("../../config_sistem.php");
include ("include/functions.php");
$s = "SELECT * FROM $database.master_dept where status = 1 AND namadept <> ''";
				$h = mysql_query($s) or die (mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</SCRIPT>
	<script language"javascript" type="text/javascript">
	function PopUp(url){
	window.open(url,'', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=400,height=100,left = 200,top = 200');
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
-->
</style></head>

<body>
<div align="center">
<form method="get" action="">
<input type="hidden" name="mn" value="<?php  echo $_GET['mn']?>" />
<table  class="style3" cellspacing="1" bgcolor="#000000">
	<tr height="30" background="images/impactg.png" align="center">
		<td><span class="style4">No. Induk</span></td>
		<td><span class="style4">Nama</span></td>
		<td><span class="style4">JK</span></td>
		<td><span class="style4">Departemen</span></td>
		<td><span class="style4"></span></td>
	</tr>
	<tr bgcolor="#FFCC00">
		<td align="center"><input type="text" name="c_no" size="15" value="<?php  echo $_GET['c_no']?>" /></td>
		<td><input type="text" name="c_nama" value="<?php  echo $_GET['c_nama']?>" /></td>
		<td>
			<select name="c_jk">
				<option value="">-ALL-</option>
				<option value="L" <?php  if($_GET['c_jk']=="L") {?> selected="selected" <?php  }?>>Laki-Laki</option>
				<option value="P" <?php  if($_GET['c_jk']=="P") {?> selected="selected" <?php  }?>>Perempuan</option>
			</select>		</td>
		<td><select name="c_dep">
          <option value="">-ALL-</option>
          <?php  
				$s = "SELECT * FROM master_dept where status = 1 AND namadept <> ''";
				$h = mysql_query($s);
				while ($r = mysql_fetch_array($h)) {
			?>
          <option value="<?php  echo $r['iddep']?>" <?php  if ($_GET['c_dep']==$r['iddep']) {?>selected="selected"<?php  } ?>>
          <?php  echo $r['namadept']?>
          </option>
          <?php  } ?>
        </select>		</td>
	  <td><input type="submit" value="Cari" />	</tr>
</table>
</form>
<form method="post" action="pegawai_submission.php">
<input type="hidden" name="cmd" value="del_peg" />
  <table width="1024" border="0" cellspacing="1" class="style3">
    <tr>
      <td width="2" rowspan="4">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="53" rowspan="3" valign="bottom"><div align="center" class="style4"><a href="input_pegawai.php"><img src="../../images/user_add.png" width="32" height="32" border="0" align="absbottom" class="style3" /></a></div></td>
      <td width="51" rowspan="3" valign="bottom"><div align="center" class="style4"><input type="image" src="../../images/user_delete.png" width="32" height="32" />
      </div></td>
      <td width="50" rowspan="3"><div align="center" class="style4"></div></td>
      <td width="50" rowspan="3" valign="bottom"><div align="center"><a href="export.php?c_no=<?php  echo $_GET['c_no']?>&c_jk=<?php  echo $_GET['c_jk']?>&c_nama=<?php  echo $_GET['c_nama']?>&c_dep=<?php  echo $_GET['c_dep']?>"><img src="../../images/fileex.png" border="0" width="32" height="32" /></a></div></td>
      <td width="48" rowspan="3">&nbsp;</td>
      <td width="1" rowspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td width="17"><div align="center"><img src="../../assets/draft/images/calendar.png" width="16" height="16" /></div></td>
      <td width="4"><div align="center">:</div></td>
      <td width="722">&nbsp; 
	  <?php  echo date('l, j F Y'); ?></td>
      </tr>
    <tr>
      <td class="style3"><div align="center"><img src="../../assets/draft/images/Gnome-Appointment-New-48.png" width="16" height="16" /></div></td>
      <td class="style3"><div align="center">:</div></td>
      <td class="style3"><div align="left"> &nbsp;<?php  echo gmdate(" H:i:s", time()+60*60*7); ?>  </div></td>
    </tr>
    <tr>
      <td class="style3"><div align="center"><img src="../../assets/draft/images/user.png" width="16" height="16" /></div></td>
      <td class="style3"><div align="center">:</div></td>
      <td class="style3"><div align="left">&nbsp;Admin Kepegawaian </div></td>
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
    <tr height="30" background="images/impactg.png">
	  <td width="25" class="style3"><div align="center" class="style4">No.</div></td>
      <td width="23" class="style3"><div align="center" class="style4">#</div></td>
	  <td width="68" class="style3"><div align="center" class="style4">Foto </div></td>
      <td width="80" class="style3"><div align="center" class="style4">No. Induk </div></td>
      <td width="121" class="style3"><div align="center" class="style4">Nama</div></td>
      <td width="247" class="style3"><div align="center" class="style4">Alamat</div></td>
	  <td width="76" class="style3"><div align="center" class="style4">No. Telp</div></td>
      <td width="72" class="style3"><div align="center" class="style4">Tgl. Lahir </div></td>
      <td width="22" class="style3"><div align="center" class="style4">Jkel.</div></td>
	  <td width="176" class="style3"> <div align="center" class="style4">Koperasi </div></td>
      <td width="56" class="style3"><div align="center" class="style4">Edit</div></td>
    </tr>
	<?php 
	require_once('phppagination.pegawai.class.php');

 $nTotalItems = 0;
 $nItemsPerPage = 10; // set length of page

// get page number passed via GET method
if (isset($_GET['page']))
    $nCurrentPage = $_GET['page'];
else
    $nCurrentPage = 1;
	
	$sSQL = "select count(*) FROM mastpegawai a, mastjabatan b WHERE a.status = 1 AND a.jabatan = b.idjab";
	$result = mysql_query($sSQL, $dbh_jogjaide) or die (mysql_error());
$row=mysql_fetch_row($result);
$nTotalItems=$row[0];

// create pagination object
$oPagination = new phpPagination ($nTotalItems, $nItemsPerPage);

		$SQL = "select a.* from mastpegawai a WHERE a.status = 1" ;
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
		$SQL = $SQL." ORDER BY idno DESC LIMIT "
    .($nCurrentPage-1)*$nItemsPerPage
    .", $nItemsPerPage";
	$hasil=mysql_query($SQL, $dbh1);
	
		$hasil=mysql_query($SQL);
		$id = 0;
	?>
	<?php  
		 $nRecord = 1;
			if ($hasil) { 
			while ($row=mysql_fetch_array($hasil)) { 
 	?>
    <tr <?php 	 if (($nRecord % 2)==0) {?>bgcolor="#e4e4e4"<?php  }  else {?>bgcolor="#FFFFCC"<?php  } ?>>
      <td height="76" align="center" class="style3"><?php  echo ++$No + (($nCurrentPage -1 ) * 10)?></td>
	  <td class="style3" align="center"><input type="checkbox" id="tambah" name="tambah[]" value="<?php  echo $row['idno'] ?>" /></td>
      <td class="style3" align="center"><a href='javascript:PopUp("upload.php?idusr=<?php  echo $row['idno']?>&modx=ok")'><img src="foto/<?php  echo $row['foto']?>" width="61" /></a></td>
	  <td class="style3" align="center"><?php  echo $row['noinduk']?></td>
      <td class="style3"><?php  echo $row['nama']?></td>
      <td class="style3"><?php  echo $row['alamat']?></td>
	  <td class="style3" align="center"><?php  echo $row['notelp']?></td>
      <td class="style3" align="center"><?php  echo baliktglindo($row['tgllahir'])?></td>
      <td class="style3" align="center"><?php  echo $row['jkel']?></td>
      <td width="176" class="style3"> <div align="left" class="style4"><font color="#000000">
	  <?php 
	  	//simpanan
		$s_simpanan = "SELECT SUM(jumlah) FROM kop_simpanan_detail WHERE noinduk = '".$row['noinduk']."'";
		$h_simpanan = mysql_query($s_simpanan);
		$b_simpanan = mysql_fetch_array($h_simpanan);
		echo "Simpanan : " . number_format($b_simpanan[0]);
	  ?>
	  
	  <br />
	  <?php 
	  	//Pinjaman
		$s_pj = "SELECT SUM(totalangsuran) FROM kop_pinjaman WHERE noinduk = '".$row['noinduk']."'";
		$h_pj = mysql_query($s_pj);
		$b_pj = mysql_fetch_array($h_pj);
		echo "Pinjaman : " . number_format($b_pj[0]);
	  ?>

	  <br />
	   <?php 
	  	//sisa ANgsuran
		$s_a = "SELECT SUM(b.totalpb) FROM kop_pinjaman a, kop_pinjaman_detail b WHERE a.idp = b.idp AND a.noinduk = '".$row['noinduk']."' AND lunas = 0";
		$h_a = mysql_query($s_a);
		$b_a = mysql_fetch_array($h_a);
		echo "Sisa Angsuran : " . number_format(round($b_a[0],-3));
	  ?>
	  </font>
	   </div></td>
      <td class="style3"><div align="center"><a href="input_pegawai.php?id=<?php  echo $row['idno'] ?>"><img src="../../images/user_go.png" border="0" width="16" height="16"></a></div></td>
    </tr>
	<?php   
		 $nRecord = $nRecord + 1;
		} 
	} else { ?>
	  <tr>
		<td align="center" colspan="17"><font color="red">Mohon maaf, tidak ada Data dimaksud.</font></td>
	  </tr>
	<?php   } ?>
  </table>
  </form>
  <div align="center">
Halaman : <?php  // print pagination for current page
echo $oPagination->GetHtml($nCurrentPage)."\n"; ?>
</div>
</div>
</body>
</html>
