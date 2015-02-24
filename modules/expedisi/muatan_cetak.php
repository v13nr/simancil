<?php @session_start();

	include "../../otentik.php";
	include "../../config_sistem.php";
	include "../../include/functions.php";
	include "../../include/infoclient.php";
	
	$sql = "SELECT * FROM muatan WHERE notamuatan = '".$_GET["id"]."'";
	$hasil = mysql_query($sql) or die(mysql_error());
	$baris = mysql_fetch_array($hasil);
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
.kiribesar {text-align: left;
	font-size: 24px;
	font-family: Arial, Helvetica, sans-serif;
}
.tengahBesar {
	font-size: 24px;
}
.rowTengah {	text-align: center;
}
</style>
</head>

<body onload="window.print()">
<table width="1000" border="0" align="center">
  <tr>
    <td width="149" height="63" align="center" valign="top"><img src="../../logo.jpg" width="203" height="100" /><br /></td>
    <td width="506" align="center" valign="top"><span class="tengahBesar"><?php echo $namaclient; ?></span>
      <hr size="2" />
    <?php echo $jalamclient;?></td>
    <td valign="top" width="331" rowspan="2"><table width="100%" border="1" style="border-collapse:collapse">
      <tr>
        <td width="45%">Nopol</td>
        <td width="55%">: <?php echo $baris["nopol"];?></td>
      </tr>
      <tr>
        <td>Sopir</td>
        <td>: <?php echo $baris["sopir"];?></td>
      </tr>
      <tr>
        <td>PA</td>
        <td>: <?php echo $baris["pa"];?></td>
      </tr>
      <tr>
        <td>Tanggal Berangkat</td>
        <td>: <?php echo baliktglindo($baris["tanggal"]);?></td>
      </tr>
      <tr>
        <td>Tujuan</td>
        <td>: <?php echo $baris["tujuan"];?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="1" style="border-collapse:collapse">
      <tr>
        <td align="center">NOMOR NOTA : JPB<?php echo $_GET["id"];?></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="1000" border="1" style="border-collapse: collapse;" align="center">
  <tr>
    <td colspan="10" align="center">DAFTAR MUATAN</td>
  </tr>
  <tr bgcolor="#99CCCC" style="text-align: center" >
    <td width="51" rowspan="2">No.</td>
    <td width="124" rowspan="2">Nomor SA</td>
    <td width="144" rowspan="2">Pengirim</td>
    <td width="135" rowspan="2">Penerima</td>
    <td width="98" rowspan="2">Jenis Packing</td>
    <td colspan="3">Banyaknya</td>
    <td width="106" rowspan="2">Ongkos</td>
    <td width="103" rowspan="2">Keterangan</td>
  </tr>
  <tr bgcolor="#99CCCC" style="text-align: center" >
    <td width="72">Colli</td>
    <td width="54">Berat</td>
    <td width="49">Satuan</td>
  </tr>
    <?php
	  	$SQL = "SELECT * FROM muatan_detail WHERE notamuatan = '".$_GET["id"]."'";
		$hasil = mysql_query($SQL) or die(mysql_error());
		while($baris=mysql_fetch_array($hasil)){
	  ?>
      <tr>
    	<td align="center"><?php echo ++$no; ?>.</td>
        <td align="center"><?php echo $baris["resi"];?></td>
        <?php
			$sqlr = "SELECT * FROM expedisi where nonota = '".$baris["resi"]."'";
			$hasilr = mysql_query($sqlr);
			$barisr = mysql_fetch_array($hasilr);
		?>
    <td>&nbsp;&nbsp;<?php echo $barisr["nama_pengirim"];?></td>
    <td>&nbsp;&nbsp;<?php echo $barisr["nama_penerima"];?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center"><?php echo $barisr["berat_barang"];?></td>
    <td align="center"><?php echo $barisr["satuan"];?></td>
    <td align="center" style="padding"><?php echo ($barisr["jenis_pembayaran"]);?></td>
    <td>&nbsp;</td>
  </tr>
  <?php } ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="1000px" border="0" align="center">
  <tr>
    <td colspan="2" valign="top"><table width="100%" border="1" style="border-collapse:collapse">
      <tr>
        <td width="14%">&nbsp;</td>
        <td width="55%">BIAYA BIAYA</td>
        <td width="15%">&nbsp;</td>
        </tr>
      <tr bgcolor="#CCCCCC" class="rowTengah">
        <td>No.</td>
        <td>Keterangan</td>
        <td>Jumlah</td>
        </tr>
      <?php
	  	$sqljurnal = "SELECT * FROM jurnal_srb WHERE muatan_id = '".$_GET["id"]."' AND kk = 'AL1-1111'"; 
		$hasiljurnal = mysql_query($sqljurnal);
		while($barisjunal = mysql_fetch_array($hasiljurnal)){
	  ?>
      <tr>
        <td align="center"><?php echo ++$no3; ?>.</td>
        <td><?php echo ($barisjunal["ket"]);?></td>
        <td align="right"><?php $jumlah = $jumlah + $barisjunal["jumlah"] ; echo number_format($barisjunal["jumlah"]);?></td>
        </tr>
      <?php } ?>
      <tr>
        <td>&nbsp;</td>
        <td>JUMLAH</td>
        <td align="right"><?php  echo number_format($jumlah);?></td>
        </tr>
    </table></td>
    <td width="357" valign="top"><table width="100%" border="1" style="border-collapse:collapse">
      <tr>
        <td width="14%">&nbsp;</td>
        <td width="55%">FRANCO DLL</td>
        <td width="15%">&nbsp;</td>
        </tr>
      <tr bgcolor="#CCCCCC" class="rowTengah">
        <td>No.</td>
        <td>Keterangan</td>
        <td>Jumlah</td>
        </tr>
      <?php
	  	$sqljurnal = "SELECT * FROM jurnal_srb WHERE muatan_id = '".$_GET["id"]."' AND kd = 'AL1-1111'"; 
		$hasiljurnal = mysql_query($sqljurnal);
		while($barisjunal = mysql_fetch_array($hasiljurnal)){
	  ?>
      <tr>
        <td align="center"><?php echo ++$no2; ?>.</td>
        <td><?php echo ($barisjunal["ket2"]);?></td>
        <td align="right"><?php echo number_format($barisjunal["jumlah"]);?></td>
        </tr>
      <?php } ?>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
    </table></td>
    <td width="305" valign="top"><table width="305" border="0" align="center">
      <tr>
        <td width="499" height="63" align="center" valign="top">Tanda Tangan Sopir / PA<br /></td>
      </tr>
      <tr>
        <td align="center">( &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>