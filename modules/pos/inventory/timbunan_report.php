<script type="text/javascript" src="assets/kalendar_files/jsCalendar.js"></script>
<link href="assets/kalendar_files/calendar.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
	function confirmDelete(delUrl){
		if (confirm("Data ini akan dihapus!\nApakah Anda yakin untuk menghapusnya ?")){
			document.location = delUrl;
		}
	}
	</script>
<?php
	@session_start();
	require_once('../include/globalx.php');
	require_once('../include/functions.php');
	require_once('otentik_inv.php');
?>
<body onload="window.print()">
<table width="90%" border="1">
  <tr>
    <td width="14%" rowspan="2"><div align="center">TOTAL TIMBUNAN </div></td>
    <td width="17%" rowspan="2"><div align="center">HARGA / RET </div></td>
    <td width="18%" rowspan="2"><div align="center">SUBTOTAL</div></td>
    <td colspan="2"><div align="center">TERBAYAR</div></td>
    <td width="15%" rowspan="2"><div align="center">SISA</div></td>
  </tr>
  <tr>
    <td width="15%"><div align="center">TANGGAL</div></td>
    <td width="14%"><div align="center">JUMLAH</div></td>
  </tr>
  <form method="post" action="submission_inv.php">
  <input type="hidden" name="cmd" value="add_timbunan_bayar" />
  </form>
  
  <?php
  		$SQL = "select * from timbunan_bayar";
		$hasil = mysql_query($SQL);
		while($baris = mysql_fetch_array($hasil)) {
  ?>
  <tr>
    <td><div align="right">
      <?=number_format($baris["total_timbunan"])?>
    </div></td>
    <td><div align="right">
      <?=number_format($baris["harga_peret"])?>
    </div></td>
    <td><div align="right">
      <?=number_format($baris["total_timbunan"]*$baris["harga_peret"])?>
    </div></td>
    <td><div align="center">
      <?php echo baliktglindo($baris["terbayar_tgl"]);?>
    </div></td>
    <td><div align="right">
      <?=number_format($baris["terbayar_jumlah"])?>
    </div></td>
    <td><div align="right">
      <?=number_format($baris["sisa"])?>
    </div></td>
  </tr>
  <?php } ?>
</table>
</body>