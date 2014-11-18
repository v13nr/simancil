
<style type="text/css">
#customers
{
font-family:"Arial", Helvetica, sans-serif;
width:100%;
border-collapse:collapse;
}
#customers td, #customers th 
{
font-size:1.2em;
border:1px solid #000000;
padding:3px 7px 2px 7px;
}
#customers th 
{
font-size:1.0em;
text-align:left;
padding-top:5px;
padding-bottom:4px;
background-color:#FFFFCC;
color:#000;
}
#customers tr.alt td 
{
color:#000;
background-color:#EAF2D3;
}
.style1 {font-size: 24px}
</style>
<p align="center"><span class="style1">RUMAH SAKIT Dr. WAHIDIN SUDIROHUSODO MAKASSAR <BR /> 
  DAFTAR PENGENDALIAN DAN EVALUASI ANGGARAN PNBP <BR />
  TAHUN ANGGARAN 2012</span><BR />
  _________________________________________________________________<BR /> 
NOMOR KENDALI : </p>
<table width="100%" border="1" align="center"  id="customers">
  <tr>
    <td rowspan="2"><div align="center">PAGU ANGGARAN </div></td>
    <td><div align="center">TRI</div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="center">WULAN</div></td>
    <td><div align="center">SEBELUMNYA</div></td>
    <td><div align="center">SAAT INI </div></td>
    <td><div align="center">TOTAL</div></td>
    <td><div align="center">SISA</div></td>
  </tr>
  <tr>
    <td><div align="center">1</div></td>
    <td><div align="center">2</div></td>
    <td><div align="right">3</div></td>
    <td><div align="center">4</div></td>
    <td><div align="center">5=3+4</div></td>
    <td><div align="center">6=1-5</div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<?php
echo '<table id="customers">';

 while ($row=$rs->FetchNextObject()) {
	echo '<tr>';
    echo "<td>".$row->NAME."</td>"; 
	echo "<td>".$row->BIRTHDAY."</td>"; 
	echo "<td>".$row->HEIGHT."</td>"; 
	echo "</tr>";
  }
echo "</table>";


?>
