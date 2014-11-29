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
<table width="90%" border="1">
  <tr>
    <td width="14%" rowspan="2"><div align="center">TOTAL TIMBUNAN </div></td>
    <td width="17%" rowspan="2"><div align="center">HARGA / RET </div></td>
    <td width="18%" rowspan="2"><div align="center">SUBTOTAL</div></td>
    <td colspan="2"><div align="center">TERBAYAR</div></td>
    <td width="15%" rowspan="2"><div align="center">SISA</div></td>
    <td width="7%" rowspan="2"><div align="center">Todo</div>      <div align="center"></div></td>
  </tr>
  <tr>
    <td width="15%"><div align="center">TANGGAL</div></td>
    <td width="14%"><div align="center">JUMLAH</div></td>
  </tr>
  <form method="post" action="submission_inv.php">
  <input type="hidden" name="cmd" value="add_timbunan_bayar" />
  <tr>
    <td><input type="text" name="total_timbunan" /></td>
    <td><input type="text" name="harga_peret" /></td>
    <td>&nbsp;</td>
    <td><input type="text" name="tanggal" value="" id="tanggal" size="10" class="required" title="Harap Mengisi Tanggal Terlebih Dahulu"  />
      <a href="javascript:showCalendar('tanggal')"><img src="assets/kalendar_files/calendar_icon.gif" border="0"></a></td>
    <td><input type="text" name="terbayar_jumlah" /></td>
    <td>&nbsp;</td>
    <td><input type="submit" value="Simpan" /></td>
  </tr>
  </form>
  
  <?php 
  		$SQL = "select * from timbunan_bayar";
		$hasil = mysql_query($SQL);
		while($baris = mysql_fetch_array($hasil)) {
  ?>
  <tr>
    <td><div align="right">
      <?php  echo number_format($baris["total_timbunan"])?>
    </div></td>
    <td><div align="right">
      <?php  echo number_format($baris["harga_peret"])?>
    </div></td>
    <td><div align="right">
      <?php  echo number_format($baris["total_timbunan"]*$baris["harga_peret"])?>
    </div></td>
    <td><div align="center">
      <?php  echo baliktglindo($baris["terbayar_tgl"]);?>
    </div></td>
    <td><div align="right">
      <?php  echo number_format($baris["terbayar_jumlah"])?>
    </div></td>
    <td><div align="right">
      <?php  echo number_format($baris["sisa"])?>
    </div></td>
    <td align="center"><a href="javascript:confirmDelete('submission_inv.php?id=<?php  echo $baris['id']; ?>&amp;cmd=del_timbunan_bayar')" title="Hapus"><img src="../../../resources/images/delete.gif" /></a></td>
  </tr>
  <?php  } ?>
</table>
