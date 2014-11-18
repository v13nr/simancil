<? session_start(); ?>

<?php
include("../include/globalx.php");
require_once "../include/functions.php";
include("../include/infoclient.php");
include "otentik_gli.php";

?>
<script language="javascript">
function viksel(delUrl) {
	if (confirm("Apakah akan mengekspor ke Excell ?")) {
			//var password;
			//var pass1 = "kafet4"; // place password here
			//password=prompt("Please enter your password:","");
			//if (password==pass1) {
				document.location = delUrl;
			//}
		}
}
</script>
<body onLoad="viksel('cetak_rl_dagang_excell.php');">
<table width="90%" border="1">
  <tr>
    <td><div align="center">Norek</div></td>
    <td><div align="center">Uraian</div></td>
    <td><div align="center">Awal</div></td>
    <td><div align="center">Debet</div></td>
    <td><div align="center">Kredit</div></td>
    <td><div align="center">Saldo</div></td>
  </tr>
  <?php
  	
	$a = session_id();

	//looping aktiva
	$sr_passiva = 0;
	$SQL = "SELECT * FROM $database.dbfn WHERE tipe = 'R' AND id = '".$a."' ORDER BY norek";
	$hasil = mysql_query($SQL, $dbh_jogjaide);
	while($baris = mysql_fetch_array($hasil)){
  ?>
  <? if(substr($baris['norek'],-4)=="0000"){ ?>
  <tr>
    <td align="center">&nbsp;</td>
    <td><?=($baris['namarek'])?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <? } else { ?>
  
	  <tr>
		<td align="center"><?=noreknn($baris['norek'])?></td>
		<td><?=($baris['namarek'])?></td>
		<td><div align="right"><?php echo number_format($baris['saldoawal'],2,',','.'); $sa_passiva = $sa_passiva + $baris['saldoawal'];?></div></td>
		<td><div align="right">
		  <?php echo number_format($baris['debet'],2,',','.'); $d_passiva = $d_passiva +  $baris['debet'];?>
	    </div></td>
		<td><div align="right">
		  <?php echo number_format($baris['kredit'],2,',','.'); $k_passiva = $k_passiva + $baris['kredit'];?>
		</div></td>
		<td><div align="right">
		  <?php echo minuss($baris['saldoawal']-$baris['debet']+$baris['kredit']); $sr_passiva = $sr_passiva + ($baris['saldoawal']-$baris['debet']+$baris['kredit']);?>
		</div></td>
	  </tr>
  <?php } } ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php $ketrl = "";
if(substr($sr_passiva,0,1) == "0"){
	$ketrl = "NIHIL";
}
elseif(substr($sr_passiva,0,1) == "-"){
	$ketrl = "RUGI";
}
else{
	$ketrl = "LABA";
}
?>
  <tr>
    <td><div align="right"></div></td>
    <td><div align="right"><?php echo $ketrl; ?></div></td>
    <td><div align="right"><?php echo number_format($sa_passiva,2,'.',',');?></div></td>
    <td><div align="right"><?php echo number_format($d_passiva,2,'.',',');?></div></td>
    <td><div align="right"><?php echo number_format($k_passiva,2,'.',',');?></div></td>
    <td><div align="right"><?php echo number_format($sr_passiva,2,'.',',');?></div></td>
  </tr>
</table>