<? session_start(); ?><?php
include("../include/globalx.php");
include("../include/functions.php");
include("../include/infoclient.php");
include "otentik_gli.php";

date_default_timezone_set('Asia/Shanghai');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>HPP</title>
	<script type="text/javascript" src="../assets/jquery-1.2.3.pack.js"></script>
<script type="text/javascript" src="../assets/jquery.validate.pack.js"></script>
 <script language="javascript" src="../assets/thickbox/thickbox.js"></script>
 <link href="../assets/thickbox/thickbox.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function selectrm(rm){	
	  $('input[@name=pajak]').val(rm);
	 }
	</script>
</head>

<body>
<div align="center">
  <p>LAPORAN LABA RUGI</p>
  <p>PR JAYA PRATAMA<br />
    Periode
    <?=$_SESSION["periode"];?>
  </p>
</div>
<br />

<table width="70%" border="0" style="border-collapse:collapse" align="center">
  <tr>
    <td colspan="2">Penjualan</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"></div></td>
    <td><div align="right"><?php echo number_format($_SESSION["PD1-411_rr"],2,'.',','); ?></div></td>
  </tr>
  <tr>
    <td colspan="2">PPN Penjualan </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"></div></td>
    <td><div align="right"><u><?php echo number_format($_SESSION["AL3-1121_rr"],2,'.',','); ?></u></div></td>
  </tr>
  <tr>
    <td colspan="2"> Penjualan netto </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"></div></td>
    <td><div align="right"><?php echo number_format(($_SESSION["PD1-411_rr"]-$_SESSION["AL3-1121_rr"]),2,'.',','); ?></div></td>
  </tr>
  <tr>
    <td colspan="2">Harga Pokok Penjualan </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"></div></td>
    <td><div align="right"><?=number_format($_SESSION["hppa"],2,'.',',')?></div></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td colspan="2">Laba Kotor </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"></div></td>
    <td><div align="right"><?php echo number_format(($_SESSION["PD1-411_rr"]-$_SESSION["AL3-1121_rr"]-$_SESSION["hppa"]),2,'.',','); $labakotor = ($_SESSION["PD1-411_rr"]-$_SESSION["AL3-1121_rr"]-$_SESSION["hppa"]); ?></div></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td colspan="2">Beban Operasional: </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td width="6%">&nbsp;</td>
    <td width="41%">Beban Gaji </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"><?php echo number_format($_SESSION["BA1-5311_rr"],2,'.',','); ?></div></td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Beban Administrasi Kantor </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"><?php echo number_format($_SESSION["BA1-5312_rr"],2,'.',','); ?></div></td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Beban BBM &amp; Parkir </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"><?php echo number_format($_SESSION["BA1-5313_rr"],2,'.',','); ?></div></td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Beban Sumbangan </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"><?php echo number_format($_SESSION["BO1-5314_rr"],2,'.',','); ?></div></td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Beban STNK, PBB, dan lainnya </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"><?php echo number_format($_SESSION["BO1-5315_rr"],2,'.',','); ?></div></td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Beban Konsumsi </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"><?php echo number_format($_SESSION["BO1-5316_rr"],2,'.',','); ?></div></td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Beban RT kantor </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"><?php echo number_format($_SESSION["BO1-5317_rr"],2,'.',','); ?></div></td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Beban Ongkos Turun Tembakau </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"><?php echo number_format($_SESSION["BP1-5114_rr"],2,'.',','); ?></div></td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Beban PNBP </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"><?php echo number_format($_SESSION["BO1-5318_rr"],2,'.',','); ?></div></td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Beban Pajak Penghasilan </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"><?php echo number_format($_SESSION["BO1-5319_rr"],2,'.',','); ?></div></td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Beban Sewa </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"><?php echo number_format($_SESSION["BO1-5332_rr"],2,'.',','); ?></div></td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Beban Pemasaran &amp; Promosi </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"><?php echo number_format($_SESSION["BO1-5321_rr"],2,'.',','); ?></div></td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Beban Penyusutan Inventaris Kantor </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"><?php echo number_format($_SESSION["BA1-5223_rr"],2,'.',','); ?></div></td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Lain-lain</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"><?php echo number_format($_SESSION["BO1-5320_rr"],2,'.',','); ?></div></td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td colspan="2">Jumlah Beban Operasional </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"></div></td>
    <td><div align="right"><?php echo number_format($_SESSION["BA1-5311_rr"]+$_SESSION["BA1-5312_rr"]+
	$_SESSION["BA1-5313_rr"]+
	$_SESSION["BO1-5314_rr"]+
	$_SESSION["BO1-5315_rr"]+
	$_SESSION["BO1-5316_rr"]+
	$_SESSION["BO1-5317_rr"]+
	$_SESSION["BP1-5114_rr"]+
	$_SESSION["BO1-5318_rr"]+
	$_SESSION["BO1-5319_rr"]+
	$_SESSION["BO1-5332_rr"]+
	$_SESSION["BO1-5332_rr"]+
	$_SESSION["BO1-5321_rr"]+
	$_SESSION["BA1-5223_rr"]+$_SESSION["BO1-5320_rr"],2,'.',','); ?><?php $bebanoperasional = $_SESSION["BA1-5311_rr"]+$_SESSION["BA1-5312_rr"]+
	$_SESSION["BA1-5313_rr"]+
	$_SESSION["BO1-5314_rr"]+
	$_SESSION["BO1-5315_rr"]+
	$_SESSION["BO1-5316_rr"]+
	$_SESSION["BO1-5317_rr"]+
	$_SESSION["BP1-5114_rr"]+
	$_SESSION["BO1-5318_rr"]+
	$_SESSION["BO1-5319_rr"]+
	$_SESSION["BO1-5332_rr"]+
	$_SESSION["BO1-5332_rr"]+
	$_SESSION["BO1-5321_rr"]+
	$_SESSION["BA1-5223_rr"]+$_SESSION["BO1-5320_rr"]; ?></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td colspan="2">Laba (Rugi) Bersih </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"></div></td>
    <td><div align="right"><?php echo number_format($labakotor - $bebanoperasional,2,'.',','); ?></div></td>
  </tr>
  <tr>
    <td colspan="2">Pendapatan Lainnya </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"></div></td>
    <td><div align="right"><?php echo number_format($_SESSION["PD1-412_rr"],2,'.',','); ?></div></td>
  </tr>
  
  <form method="post" action="">
  <tr>
    <td colspan="2">Laba (Rugi) Sebelum Pajak </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"></div></td>
    <td><div align="right"><?php echo number_format($labakotor - $bebanoperasional - $_SESSION["PD1-412_rr"],2,'.',','); $_SESSION["laba_sebelum_pajak"] = $labakotor - $bebanoperasional - $_SESSION["PD1-412_rr"];?></div></td>
  </tr>
  <input type="hidden" name="sbm_pajak" value="<?php echo $labakotor - $bebanoperasional - $_SESSION["PD1-412_rr"];?>"  />
  <tr>
    <td colspan="2">Pajak Penghasilan </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"></div></td>
    <td><div align="right"><input type="text" name="pajak" size="16" value="<?php echo $_POST["pajak"]?>" /><a href="pajak.php?width=600&amp;height=350&amp;TB_iframe=true" class="thickbox"><img src="../assets/button_search.png" alt="Pilih Akun" border="0" /></a></div></td>
  </tr>
  
  <tr>
    <td colspan="2">Laba (Rugi) Setelah Pajak </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"></div></td>
    <td><div align="right"><?php
		echo number_format($_POST["sbm_pajak"] - $_POST["pajak"],2,'.',',');
		$_SESSION["laba"] = $_POST["sbm_pajak"] - $_POST["pajak"];
	?>
	</div></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"></div></td>
    <td><div align="right"><input type="submit" value="Simpan" /></div></td>
  </tr>
  </form>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"></div></td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td width="8%"><div align="right"></div></td>
    <td width="4%"><div align="right"></div></td>
    <td width="19%"><div align="right"></div></td>
    <td width="22%"><div align="right"></div></td>
  </tr>
</table>
</body>
</html>
