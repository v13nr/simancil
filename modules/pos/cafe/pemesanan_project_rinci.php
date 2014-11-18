<? @session_start(); ?>
<? include ("../include/functions.php");?>
<? include ("../include/globalx.php");?>
<style type="text/css">
<!--
body {
	background-image: url(../images/bg.png);
}
.style1 {
	font-family: "Segoe UI";
	font-size: 12px;
	font-weight: bold;
	color: #0000FF;
}
-->
</style>
<style type="text/css">
* { font: 11px/20px Verdana, sans-serif; }
h4 { font-size: 18px; }
input.error, select.error { border: 1px solid red; }
label.error { color:red; margin-left: 10px; }
td { padding: 5px; }
input.kanan{ text-align:right; }
</style>
<script type="text/javascript" src="../assets/kalendar_files/jsCalendar.js"></script>
<link href="../assets/kalendar_files/calendar.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../assets/jquery-1.2.3.pack.js"></script>
<script type="text/javascript">

	function UpdateQty(id){	
	  $.ajax({
		type: "POST",
		url: "update_qty_rinci.php",
		data: "id="+id,
		cache: false,
		success: function(){
			document.location.reload(true); 
		 }
		});
		 
		}
	function hitungUlang(id){	
	  $.ajax({
		type: "POST",
		url: "update_qty_pesanan.php",
		data: "id="+id,
		cache: false,
		success: function(){
			document.location.reload(true); 
		 }
		});
		 
		}
$(document).ready(function() {
	function hitungUlang(id){	
	  $.ajax({
		type: "POST",
		url: "update_qty_pesanan.php",
		data: "id="+id,
		cache: false,
		success: function(){
			document.location.reload(true); 
		 }
		});
		 
		}
	function UpdateQty(id){	
	  $.ajax({
		type: "POST",
		url: "update_qty_rinci.php",
		data: "id="+id,
		cache: false,
		success: function(){
			document.location.reload(true); 
		 }
		});
		 
		}
})
</script>
 
	<table width="1140" border="0">
  <tr>
    <td width="32"><img src="../images/calendar.png" width="32" height="32" /></td>
    <td width="1090"><span class="style1">PO : <?=$_GET['pesan_id']?> </span>
      <hr /></td>
  </tr>
  <tr>
    <td width="32">&nbsp;</td>
    <td>
	
	<table width="663" class="x1">
	<form name="frmijin" id="frmijin" method="post" action="submission_cafe.php">
          <input type="hidden" name="cmd" value="add_to_mutasi" />
		  <input type="hidden" name="project_id" value="<?=$_GET['project_id']?>" />
		  <input type="hidden" name="sub" value="<?=$_GET['sub']?>"/>
		  <input type="hidden" name="tgl_transaksi" value="<?=$_GET['tgl_transaksi']?>" />
		  <input type="hidden" name="nomor" value="<?=$_GET['nomor']?>" />
      <tr>
        <td width="143">No. Faktur </td>
        <td width="205"><input type="text" name="nonota" value="PR/<?=nobukti($_GET['nomor'])?>" readonly="true" /></td>
        <td width="107">Tanggal</td>
        <td width="188"><input type="text" name="tgl_transaksi" id="tgl_transaksi" size="10" class="required" title="*" value="<?=$_GET['tgl_transaksi']?>" <? if($_GET['nomor']<>""){ ?>  readonly="true"  <? }?> />
          <a href="javascript:showCalendar('tgl_transaksi')"></a></td>
      </tr>
	  
	  <?php if($_SESSION["sess_kelasuser"]!= "Logistik") { ?>
	  
	  <?php } ?>
    </table>
	<br />
	<table border="1" width="95%" a style="border-collapse:collapse" lign="left" cellpadding="3" cellspacing="0" bordercolorlight="silver" bordercolordark="#FFFFFF">
      <? if ($_GET['id']<>"") {?>
      <tr>
        <td background="../images/impactg.png" colspan="13" align="center"><font color="white"><b>Edit Transaksi </b></font></td>
      </tr>
      <? } else { ?>
      <tr>
        <td background="../images/impactg.png" colspan="13" align="center"><strong><font color="white"> TRANSAKSI </font></strong></td>
      </tr>
      <? } ?>
      <tr bgcolor="#FFCC00">
        <td width="37" align="center"><strong>No</strong></td>
        <td width="81" align="center">Kode Barang </td>
        <td width="284" align="center">Nama Barang</td>
        <td width="51" align="center"><strong>Qty</strong></td>
        <td width="57" align="center"><strong>Satuan </strong></strong></td>
		<td width="72" align="center"><strong>Harga</strong></td>
		<td width="84" align="center"><strong>Jumlah</strong></td>
        <? if ($_GET['id']<>"") { ?>
        <td width="63" align="center"><b>Update</b></td>
        <td width="63" align="center"><b>Batal</b></td>
        <? } else { ?>
        <td width="63" align="center">&nbsp;</td>
        <? } ?>
      </tr>
     
      <?
	  	
		$SQLj = "SELECT * FROM $database.po WHERE status = 1 AND model = 'PR' AND nomor = '".$_GET['nomor']."'";
		//echo $SQLj; 		
		$hasilj = mysql_query($SQLj, $dbh_jogjaide);
		$nRecord = 1;
		if (mysql_num_rows($hasilj) > 0) { 
		while ($row=mysql_fetch_array($hasilj)) { 
	?>
	<?php $id_posting = $row["id"]?>
      <tr <?	 if (($nRecord % 2)==0) {?>bgcolor="#CCCCCC"<? } else {?> else="else" bgcolor="#CCCCCC"<? }?>>
        
          <td align="center"><?=$nRecord?></td>
          <td align="left"><?=$row['kodebrg']?></td>
          <td align="left"><?=$row['namabrg']?></td>
          <td align="right">
		  <?php if($row['final'] == "0") { ?>
		  <input type="text" class="kanan" value="<?=$row['qtyin']?>" name="<?=$row['id']?>" size="5"  onBlur="hitungUlang(this.value+'-'+this.name+'-'+'<?=$row['kodebrg']?>'+'-'+'<?=$_GET['nomor']?>'+'-'+<?=$row['harga']?>);" onfocus= "this.select()" />
		  <?php } else { 
		  
		  echo $row['qtyin']; 
		  } ?>		  </td>
          <td align="left"><?=$row["satuan"]; ?></td>
		  <td align="right">&nbsp;</td>
		  <td align="right">&nbsp;</td>
		  <? $t_jumlah = $t_jumlah + (($row["harga"] * $row["qtyin"])-($row["harga"] * $row["qtyin"]*$row["disc"]/100)); ?>
		  <? $t_debet = $t_debet + $row["kredit"]; ?>
          <? if ($_GET['id']<>"") { ?>
          <td align="center"><input name="image" type="image" src="../images/approve.gif" border="0" /></td>
          <td align="center"><a href="javascript:history.back()"><img src="../images/kal_prev.gif" alt="Sebelumnya" border="0" /></a></td>
          <? } else { ?>
          <? } ?>
	    <td width="83">      </tr>
	   <? if ($_GET['id']=="") { ?>
	   <?php 
	   		//fetch komposisi
			$SQLk = "SELECT *, a.id as id FROM project_detail a, project b WHERE a.project_id = b.id AND a.project_id = '". $_GET["project_id"] ."' AND kodeinduk = '".$row['kodebrg']."'";
			//echo $SQLk; exit();
			$hasilk = mysql_query($SQLk);
	   		while($barisk = mysql_fetch_array($hasilk)){
	   ?>
	   
      <tr bgcolor="#FFFCCC">
        
          <td align="center"><img src="../images/kal_next.gif" alt="Selanjutnya" border="0" /></td>
          <td align="left"><?=$barisk['kodeanak']?><input type="hidden" name="barang" value="<?php echo $barisk['kodeanak']?>" />
          <input name="brg" style="display:none" type="text" id="brg" value="" size="8" readonly="readonly"  title="Kode Barang Harus Terisi !"/></td>
          <td align="left"><?php
		  	$sqlc = "SELECT namabrg, hargaeceran FROM stock WHERE kodebrg = '".$barisk['kodeanak']."'";
			$hasilc = mysql_query($sqlc);
			$barisc = mysql_fetch_array($hasilc);
			echo $barisc[0];
		  	$hargaeceran = $barisc[1];
		  ?></td>
          <td align="right">
		   <?php if($row['final'] == "1") { ?>
		  <?=$barisk['qty']?>
		   <?php } else { ?> 
		  <input type="text" class="kanan" value="<?=$barisk['qty']?>" name="<?=$barisk['id']?>" size="5"  onblur="UpdateQty(this.value+'-'+this.name+'-'+'<?=$row['kodebrg']?>'+'-'+'<?=$_GET['nomor']?>'+'-'+<?=$row['harga']?>);" onfocus= "this.select()"  /><input type="hidden" name="pr_detail_id[]" value="<?php echo $barisk["id"]; ?>" />
		  
		  <input type="hidden" name="pr_detail_id_val[]" value="<?php echo $barisk["qty"]; ?>" />
		  
		  <input type="hidden" name="po_id[]" value="<?php echo $row["id"]; ?>" />
		  <input type="hidden" name="po_id_val[]" value="<?php echo $row["qtyin"]; ?>" />
		  <input type="hidden" name="kodebrg[]" value="<?php echo $barisk["kodeanak"]; ?>" />
		  
		  <? } ?>	  </td>
          <td align="left"><?=$barisk["satuan"]; ?> <input type="hidden" name="satuan" value="<?php echo $barisk['satuan']?>" /></td>
		  
		  <td align="right"><?php echo number_format($hargaeceran); ?><input type="hidden" name="harga" value="<?php echo $barisk['hargaeceran']?>" /></td>
		  <td align="right"><?php echo number_format($hargaeceran * $barisk['qty'] * $row['qtyin']); $t_harga = $t_harga + ($hargaeceran * $barisk['qty'] * $row['qtyin']); $grand_t = $grand_t +  ($hargaeceran * $barisk['qty']) * $row['qtyin']; ?><input type="hidden" name="netto" value="<?php echo $hargaeceran * $barisk['qty'] * $row['qtyin'];?>" /></td>
          <td align="center" colspan="1">&nbsp;</td>
      </tr>
      <? } } ?>
	  <tr>
		  <td align="center">&nbsp;</td>
		  <td align="center">&nbsp;</td>
		  <td align="center">&nbsp;</td>
		  <td align="center">&nbsp;</td>
		  <td colspan="2" align="center">Total Rp. </td>
		  <td align="right"><?php echo number_format($t_harga); $t_harga = 0; ?></td>
		  <td align="center">
	      <?php if($row['final'] == "0") { $Final = 0; ?></td>
		  <?php } else { ?>
		  	Final.
		  
		  <? } ?>
	    </tr>
      <?  
		 $nRecord = $nRecord + 1;
		} //end while PO ?>
		<tr>
		  <td align="center">&nbsp;</td>
		  <td align="center">&nbsp;</td>
		  <td align="center">&nbsp;</td>
		  <td colspan="3" align="right">GRAND TOTAL Rp.</td>
		  <td align="right"><?php echo number_format($grand_t); ?></td>
		  <td align="center">
		  <?php if($Final == "0") { ?>
		  <input name="submit" type="submit" value="FINAL !" />
		  <? } else { echo "FINAL.";} ?>
		  </td>
		</tr></form>
		<tr>
		  <td align="center">&nbsp;</td>
	      <td align="center">&nbsp;</td>
	      <td align="center">&nbsp;</td>

	      <td align="center">&nbsp;</td>
	      <td colspan="2" align="center">&nbsp;</td>
	      
		  <td align="right">&nbsp;</td>
	      <td align="right">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="21" align="center">
			<a href="popup_bayar.php?width=500&height=300&nonota=<?=$_GET['nomor']?>&TB_iframe=true" id="cari" class="thickbox" title="Pembayaran">[ CETAK ]</a></td>
		</tr>
		<?
	} else { ?>
      <tr>
        <td align="center" colspan="13"><font color="red">Mohon maaf, tidak ada Data dimaksud.</font></td>
      </tr>
      <?  } ?>
    </table>	
	<p>&nbsp;</p></td>
  </tr>
</table>
