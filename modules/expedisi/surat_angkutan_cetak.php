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
.kiribesar {
	text-align: left;
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
.ratakanan {
	text-align: right;
}
    .tebal {
	font-weight: bold;
}
    .rataKanan {
	text-align: right;
}
    .tengahTabel {
	text-align: center;
}
    </style>
    <body onLoad="window.print()">
<table width="1000" border="0" align="center">
  <tr>
    <td width="181" align="left"><img src="../../logo.jpg" width="203" height="100"></td>
    <td width="381" align="left"><span class="kiribesar"><?php echo $namaclient; ?></span><br />
    <?php echo $jalamclient;?></td>
    <td width="195">&nbsp;</td>
    <td width="225" valign="top" class="ratakanan">Truk No. :___________<br />
      <br />
    PA Sopir :___________</td>
  </tr>
  <tr>
    <td colspan="4" align="center"><hr size="5" noshade="noshade" /></td>
  </tr>
  <tr>
    <td colspan="4" align="center"><span class="tebal">SURAT ANGKUTAN</span><br /><hr size="2" /></td>
  </tr>
  <tr>
    <td colspan="4" align="center"><table width="100%" border="0">
      <tr>
        <td width="33%">No. Urut : <?php echo $baris["nourut"];?></td>
        <td width="40%">Tanggal Register : <?php echo baliktglindo($baris["tanggal"]);?></td>
        <td width="27%">Jenis Layanan : <?php
		
			$sqlj = "select layanan from jenis_layanan WHERE id = '".$baris["jenis_layanan"]."'";
			$hasilj = mysql_query($sqlj);
			$barisj = mysql_fetch_array($hasilj);
			echo $barisj[0];
		 ?></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="4" align="center"><table width="100%" border="1" bordercolor="#CCCCCC" style="border-collapse:collapse">
      <tr>
        <td width="29%" rowspan="2">Pengirim : <?php echo $baris["nama_pengirim"];?></td>
        <td width="9%">Alamat</td>
        <td width="62%"> : <?php echo $baris["alamat_pengirim"];?></td>
      </tr>
      <tr>
        <td>Telepon</td>
        <td> : <?php echo $baris["telpon_pengirim"];?></td>
      </tr>
      <tr>
        <td rowspan="2">Penerima : <?php echo $baris["alamat_penerima"];?></td>
        <td>Alamat </td>
        <td>: <?php echo $baris["nama_pengirim"];?></td>
      </tr>
      <tr>
        <td>Telepon </td>
        <td>: <?php echo $baris["telepon_penerima"];?></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="1000" border="0" align="center">
  <tr>
    <td width="652" align="center" valign="top"><hr size="5" noshade="noshade" /></td>
  </tr>
</table>
<table width="1000" border="1" align="center" style="border-collapse:collapse">
  <tr bgcolor="#999999" style="text-align: center">
    <td>Jumlah</td>
    <td>Isi Kiriman</td>
    <td>Berat Barang</td>
  </tr>
  <tr>
    <td width="171" valign="middle"><p class="tengahTabel"><br /><?php echo $baris["banyak_barang"];?></p>
      <p class="tengahTabel"><br />
    </p></td>
    <td width="463" class="tengahTabel"><?php echo $baris["isi_kiriman"];?></td>
    <td width="100" class="tengahTabel"><?php echo $baris["berat_barang"];?> <?php echo $baris["satuan"];?></td>
  </tr>
</table>
<table width="1000" border="0" align="center">
  <tr>
    <td width="342" align="left"><span class="tebal" style="font-size: 14px; text-align: left;">PERHATIAN !!!</span><span class="tebal" style="font-size: 12px; text-align: left;"></span><span style="font-size: 12px; text-align: left;"><br />
      1. Kehilangan/Kerusakan dalam verpaking resiko si pengirim.<br />
      2. 
      Tidak diberikan penggantian disebabkan force majeur.<br />
      3. 
      CLAIM dilayani dalam tempo 30 hari.<br />
      4. 
      Jika si penerima tidak membayar ongkos angkutan, maka si pengirim harus membayar ongkosnya. </span></td>
    <td width="648" align="left"><table width="100%" border="0" align="center">
      <tr>
        <td colspan="3" align="left">Memo Pengirim</td>
      </tr>
      <tr>
        <td width="328" rowspan="4" align="left" valign="top"><table width="100%" border="2" style="border-collapse: collapse;">
          <tr>
            <td>&nbsp;<br />
              No. Resi Pengiriman&nbsp;<br />
              <span style=" font-size: 24px;"><span class="tengahTabel"><?php echo $baris["nonota"];?></span><br />
                &nbsp;</span></td>
          </tr>
        </table></td>
        <td width="326" valign="bottom" class="tengah kecil">Barang Telah diterima dengan Baik Tanggal</td>
        <td width="332" align="center" valign="top">Cap Perusahaan</td>
      </tr>
      <tr>
        <td valign="bottom" class="tengah kecil">&nbsp;</td>
        <td valign="bottom" class="tengah kecil">&nbsp;</td>
      </tr>
      <tr>
        <td valign="bottom" class="tengah kecil">&nbsp;</td>
        <td valign="bottom" class="tengah kecil">&nbsp;</td>
      </tr>
      <tr>
        <td width="326" valign="bottom" class="tengah kecil">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; )<br />
          tanda tangan dan nama terang</td>
        <td valign="bottom" class="tengah kecil">Administrator</td>
      </tr>
      <tr>
        <td colspan="15">Dicetak pada Tanggal : <?php echo date('d-m-Y H:i:s'); ?></td>
      </tr>
    </table></td>
  </tr>
</table><br />
</body>