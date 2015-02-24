<?php @session_start();

	include "../../otentik.php";
	include "../../config_sistem.php";
	include "../../include/functions.php";
	include "../../include/infoclient.php";
	
	$sql = "SELECT * FROM expedisi WHERE id = '".$_GET["id"]."'";
	$hasil = mysql_query($sql) or die(mysql_error());
	$baris = mysql_fetch_array($hasil);
	?>
	
	<style type="text/css">
.tengah {
	text-align: center;
	font-size: 24px;
	font-family: Arial, Helvetica, sans-serif;
}
.kecil {
	text-align: center;
	font-size: 12px;
	font-family: Arial, Helvetica, sans-serif;
}
.miring {
	font-style: italic;
	text-decoration: underline;
}
.tebal {
	font-weight: bold;
}
.tengahTabel {	text-align: center;
}
    .kiri {
	text-align: left;
}
    .kiribesar {	text-align: left;
	font-size: 24px;
	font-family: Arial, Helvetica, sans-serif;
}
    </style>
    <body onLoad="window.print()">
<table width="1000" border="0" align="center">
  <tr>
    <td width="135" rowspan="3" align="center"><img src="../../logo.jpg"></td>
    <td width="199" rowspan="3"><table width="100%" border="2" style="border-collapse: collapse;">
      <tr>
        <td>&nbsp;<br />No. Resi Pengiriman&nbsp;<br /><span style=" font-size: 24px;"><span class="tengahTabel"><?php echo $baris["nonota"];?></span><br />&nbsp;</span></td>
      </tr>
    </table></td>
    <td width="652" class="tengah"><span class="kiribesar"><?php echo $namaclient; ?></span></td>
  </tr>
  <tr>
    <td valign="top" align="center"><hr size="5" noshade="noshade" />
    <?php echo $jalamclient;?>      <hr size="5" noshade="noshade" /></td>
  </tr>
  <tr>
    <td class="tengah"><span style=" font-size: 20px; font:Arial, Helvetica, sans-serif">BUKTI TANDA TERIMA KIRIMAN BARANG (BTTKB)</span></td>
  </tr>
</table>
<table width="1000" border="0" align="center">
  <tr>
    <td width="652" align="center" valign="top"><hr size="5" noshade="noshade" /></td>
  </tr>
</table>
<table width="1000" border="1" align="center" style="text-align: left; border-collapse: collapse">
  <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td>No. Urut</td>
    <td style="text-align: left"><span class="kiri"><?php echo $baris["nourut"];?></span></td>
    <td width="23" rowspan="10">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="154">Tanggal</td>
    <td width="300" class="kiri" style="text-align: left"><?php echo baliktglindo($baris["tanggal"]);?></td>
    <td width="149">Jenis Pembayaran</td>
    <td width="340"><span class="kiri"><?php echo $baris["jenis_pembayaran"];?></span></td>
  </tr>
  <tr>
    <td>Nama Pengirim</td>
    <td class="kiri" style="text-align: left"><?php echo ($baris["nama_pengirim"]);?></td>
    <td>Nama Penerima</td>
    <td><span class="kiri"><?php echo $baris["nama_penerima"];?></span></td>
  </tr>
  <tr>
    <td valign="top">Alamat Pengirim</td>
    <td class="kiri" style="text-align: left"><?php echo ($baris["alamat_pengirim"]);?></td>
    <td valign="top">Alamat Penerima</td>
    <td><span class="kiri"><?php echo $baris["alamat_penerima"];?></span></td>
  </tr>
  <tr>
    <td>Telepon Pengirim</td>
    <td class="kiri" style="text-align: left"><?php echo ($baris["telpon_pengirim"]);?></td>
    <td>Telepon Penerima</td>
    <td><span class="kiri"><?php echo $baris["telepon_penerima"];?></span></td>
  </tr>
  <tr>
    <td>Isi Kiriman</td>
    <td class="kiri" style="text-align: left"><?php echo ($baris["isi_kiriman"]);?></td>
    <td>Banyak Barang</td>
    <td><span class="kiri"><?php echo $baris["banyak_barang"];?></span></td>
  </tr>
  <tr>
    <td>Memo Pengirim</td>
    <td class="kiri" style="text-align: left"><?php echo ($baris["memo_pengirim"]);?></td>
    <td>Jenis Layanan</td>
    <td><?php
		
			$sqlj = "select layanan from jenis_layanan WHERE id = '".$baris["jenis_layanan"]."'";
			$hasilj = mysql_query($sqlj);
			$barisj = mysql_fetch_array($hasilj);
			echo $barisj[0];
		 ?></td>
  </tr>
  <tr>
    <td>Harga Barang Titipan</td>
    <td class="kiri" style="text-align: left"><?php echo number_format($baris["harga_barang_ttp"]);?></td>
    <td>Biaya Administrasi</td>
    <td><span class="kiri"><?php echo number_format($baris["biaya_administrasi"]);?></span></td>
  </tr>
  <tr>
    <td>Berat Barang</td>
    <td class="kiri" style="text-align: left"><span class="kiri" style="text-align: left"><?php echo ($baris["berat_barang"]);?></span><span class="kiri" style="text-align: left"> <?php echo ($baris["satuan"]);?></span></td>
    <td>Biaya Lainnya</td>
    <td><span class="kiri"><?php echo number_format($baris["biaya_lainnya"]);?></span></td>
  </tr>
  <tr>
    <td>Total Biaya</td>
    <td class="kiri" style="text-align: left"><?php echo number_format($baris["total_biaya"]);?></td>
    <td>Total Ongkos</td>
    <td><span class="kiri"><?php echo number_format($baris["total_ongkos"]);?></span></td>
  </tr>
</table>
<table width="1000" border="0" align="center">
  <tr>
    <td width="328" rowspan="3" align="left"><span class="tebal" style="font-size: 14px; text-align: left;">PERHATIAN !!!</span><span class="tebal" style="font-size: 12px; text-align: left;"></span><span style="font-size: 12px; text-align: left;"><BR />1. Kehilangan/Kerusakan dalam verpaking resiko si pengirim.<br />
    2. 
    Tidak diberikan penggantian disebabkan force majeur.<br />
    3. 
    CLAIM dilayani dalam tempo 30 hari.<br />
    4. 
    Jika si penerima tidak membayar ongkos angkutan, maka si pengirim harus membayar ongkosnya. </span></td>
    <td width="224" valign="top" class="tengah kecil"><strong>Pengirim</strong></td>
    <td width="434" class="tengah kecil">Cap Perusahaan</td>
  </tr>
  <tr>
    <td width="224" valign="bottom" class="tengah kecil">&nbsp;</td>
    <td valign="top" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td width="224" valign="bottom" class="tengah kecil">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; )<br />tanda tangan dan nama terang</td>
    <td valign="bottom" class="tengah kecil">Administrator</td>
  </tr>
</table>
</body>