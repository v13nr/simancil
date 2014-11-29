<?php  session_start();
include "otentik_kepeg.php"; 
include ("../include/functions.php");
include ("../include/infoclient.php");
?>
<?php 
//taruh skrip ini di file tujuan, misal dari tes.php ke excell.php
$filename = "Data Karyawan - " . date('Y-m-d') . ".xls";
header("Content-Disposition: attachment; filename=\"$filename\"");
header ("Content-Type: application/vnd.ms-excel");
header ("Expires: 0");
header ("Cache-Control : must-revalidate, post-check=0, pre-check=0");
?>
<style type="text/css">
* { font: 11px/20px Verdana, sans-serif; }
b { font-weight:bold;}
h4 { font-size:36px}
</style>
	<table width="1800" border="1" cellspacing="1">
	 <tr>
		<td colspan="12"><h2>Daftar Pegawai <?php  echo $namaclient?></h2></td>
	  </tr>
	<tr height="40" bgcolor="#1973C1">
	  <td width="44" class="style3"><div align="center" class="style4">No.</div></td>
      <td width="74" class="style3"><div align="center" class="style4">No. Induk </div></td>
      <td width="154" class="style3"><div align="center" class="style4">Nama</div></td>
      <td width="189" class="style3"><div align="center" class="style4">Alamat</div></td>
	  <td width="105" class="style3"><div align="center" class="style4">No. Telp</div></td>
      <td width="94" class="style3"><div align="center" class="style4">Tgl. Lahir </div></td>
      <td width="44" class="style3"><div align="center" class="style4">Jkel.</div></td>
      <td width="159" class="style3"> <div align="center" class="style4">Jabatan </div></td>
      <td width="90" class="style3"><div align="center"><span class="style4">Mulai Kerja</span> </div></td>
      <td width="259" class="style3"><div align="center"><span class="style4">Riwayat Pendidikan</span> </div></td>
      <td width="259" class="style3"><div align="center"><span class="style4">Riwayat Pekerjaan</span> </div></td>
      <td width="266" class="style3"><div align="center"><span class="style4">Riwayat Keluarga</span> </div></td>
    </tr>
	<?php 
		$SQL = "select a.*, b.namajab from mastpegawai a, mastjabatan b WHERE a.status = 1 AND a.jabatan = b.idjab" ;
		if($_GET['id']<>""){
		//$SQL = $SQL." AND id = ". $_GET['id'];
		}
		$SQL = $SQL." ORDER BY idno";
		$hasil=mysql_query($SQL);
		$id = 0;
	?>
	<?php  
		while ($row=mysql_fetch_array($hasil)) { 
 	?>
	<tr valign="top">
    <td height="76" align="center" class="style3"><?php  echo ++$id?></td>
	  <td class="style3" align="center"><?php  echo $row['noinduk']?></td>
      <td class="style3"><?php  echo $row['nama']?></td>
      <td class="style3"><?php  echo $row['alamat']?></td>
	  <td class="style3" align="center">&nbsp;<?php  echo $row["notelp"]?></td>
      <td class="style3" align="center"><?php  echo baliktglindo($row['tgllahir'])?></td>
      <td class="style3" align="center"><?php  echo $row['jkel']?></td>
      <td class="style3"><?php  echo $row['namajab']?></td>
      <td class="style3" align="center"><?php  echo baliktglindo($row['mulkerja'])?></td>
      <td class="style3" align="center"><?php  echo $row['ri_pendidikan']?></td>
      <td class="style3" align="center"><?php  echo $row['ri_pekerjaan']?></td>
      <td class="style3" align="center"><?php  echo $row['ri_keluarga']?></td>
    </tr>
    <?php  } ?>
	</table>