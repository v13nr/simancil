<? session_start(); ?>
<? include "otentik_gli.php"; include ("../include/functions.php");
if($_GET["khusus"] != "pembelian"){}

?><style type="text/css">
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
</style><style type="text/css">
* { font: 11px/20px Verdana, sans-serif; }
h4 { font-size: 18px; }
input.error, select.error { border: 1px solid red; }
label.error { color:red; margin-left: 10px; }
td { padding: 5px; }
input.kanan{ text-align:right; }
</style><script type="text/javascript" src="../assets/kalendar_files/jsCalendar.js"></script>
<link href="../assets/kalendar_files/calendar.css" rel="stylesheet" type="text/css"><script type="text/javascript" src="../assets/jquery-1.2.3.pack.js"></script><script type="text/javascript" src="../assets/jquery.validate.pack.js"></script><script language="javascript" src="../assets/thickbox/thickbox.js"></script>
 <link href="../assets/thickbox/thickbox.css" rel="stylesheet" type="text/css" /><script language="JavaScript">
<!--
	function confirmDelete(delUrl) {
		if (confirm("Data ini akan dihapus!\nApakah Anda yakin untuk menghapusnya ?")) {
			document.location = delUrl;
		}
	}
//-->
</script><script type="text/javascript">
 function selectBuku(no, nama){
  $('input[@name=norek]').val(no);
  $('input[@name=namarek]').val(nama);
  //tb_remove(); // hilangkan dialog thickbox
} 
function selectSupp(no, nama){
  $('input[@name=supp]').val(no);
  $('input[@name=namasupp]').val(nama);
  //tb_remove(); // hilangkan dialog thickbox
}
 </script><script type="text/javascript">

$(document).ready(function(){

	function formatCurrency(num) {
		num = num.toString().replace(/\$|\,/g,'');
		if(isNaN(num))
		num = "0";
		sign = (num == (num = Math.abs(num)));
		num = Math.floor(num*100+0.50000000001);
		cents = num%100;
		num = Math.floor(num/100).toString();
		if(cents<10)
		cents = "0" + cents;
		for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
		num = num.substring(0,num.length-(4*i+3))+','+
		num.substring(num.length-(4*i+3));
		//return (((sign)?'':'-') + '$' + num + '.' + cents);
		return (((sign)?'':'-') + num);
	}
	
    $.each($('.kanan'), function()
    {
       $(this).keyup( function(){ 
	   		$(this).val(formatCurrency($(this).val()));
		} );
    });
			
 
  // beri event pada saat keyup kode pegawai agar kode yang dimasukan font-nya UPPERCASE semua (optional)
  $('input[@name=namarekening]').keyup(
	function(){
	  $(this).val(String($(this).val()).toUpperCase());
	}
  );
});
	
</script><script type="text/javascript">
$(document).ready(function() {
	
	$("#frmijin").validate({
		rules: {
			password: "required",
			password_again: {
		equalTo: "#password"
			}
		},
		messages: {
			email: {
				required: "E-mail harus diisi",
				email: "Masukkan E-mail yang valid"
			}
		},
		errorPlacement: function(error, element) {
			error.appendTo(element.parent("td"));
		}
	});
})
</script><script type="text/javascript">
	$(document).ready(function(){
		$("#output").html("Debet");
		$("#dk").change(onSelectChange);
		$("#divisi").change(onSelectChange);
	});

	function onSelectChange(){
		var selected = $("#dk option:selected");
		var selecteddiv = $("#divisi option:selected");		
		var output = "Debet";
		if(selected.val() != 0){
			if(selected.val()=="Debet"){
				output = "Kredit";
			}
			if(selected.val()=="Kredit"){
				output = "Debet";
			}
		}
		//$("#bukti").val(selecteddiv.val()+'/');
		$("#output").html(output);
	}
	</script><table width="1140" border="0">
  <tr>
    <td width="32"><img src="../images/calendar.png" width="32" height="32" /></td>
    <td width="1090"><span class="style1">JURNAL PENJUALAN </span>
      <hr /></td>
  </tr>
  <tr>
    <td width="32">&nbsp;</td>
    <td>
	
	<table class="x1">
	<form name="frmijin" id="frmijin" method="post" action="submission_gli.php">
          <input type="hidden" name="cmd" value="add_jurnal" />
          <input type="hidden" name="khusus" value="pembelian" />
		  <input type="hidden" name="nobukti" value="<?=$_GET['nobukti']?>" />
		  <input type="hidden" name="bulan" value="<?=$_GET['bulan']?>" />
      <tr>
        <td>Tanggal</td>
        <td><input type="text" name="tgl_transaksi" id="tgl_transaksi" size="10" class="required" title="Harap Mengisi Tanggal Terlebih Dahulu" value="<?=$_GET['tgl_transaksi']?>" <? if($_GET['tgl_transaksi']<>""){?> readonly="true" <? } ?> />
		<? if($_GET['tgl_transaksi']==""){?>
          <a href="javascript:showCalendar('tgl_transaksi')"><img src="../assets/kalendar_files/calendar_icon.gif" border="0"></a></td>
		  <? } ?>
      </tr>
      <tr>
        <td>Divisi</td>
        <td><select name="divisi" id="divisi" class="required" title="Pilih Divisi">
		<? if($_SESSION["sess_kelasuser"]<>"User" && $_GET["divisi"] == ""){?>
          <option value="">-Pilih-</option>
		 <? } ?>
          <?
			$SQL = "SELECT * FROM $database.divisi WHERE subdiv <> ''";
			if($_SESSION["sess_kelasuser"]=="User" && $_GET["divisi"] == ""){
				$SQL = $SQL . " AND subdiv = '".$_SESSION["sess_tipe"]."'";
				$div = $_SESSION["divisi"];
			}
			if($_SESSION["sess_kelasuser"]<>"User" && $_GET["divisi"] != ""){
				$SQL = $SQL . " AND subdiv = '".$_GET["divisi"]."'";
				$div = $_GET["divisi"];
			}
			if($_SESSION["sess_kelasuser"]=="User" && $_GET["divisi"] != ""){
				$SQL = $SQL . " AND subdiv = '".$_GET["divisi"]."'";
				$div = $_GET["divisi"];
			}
			
			$hasil = mysql_query($SQL, $dbh_jogjaide);
			while($baris = mysql_fetch_array($hasil)){
		?>
          <option value="<?=$baris['subdiv']?>" <? if($_GET['divisi']==$baris['subdiv']){?> selected="selected" <? }?>>
          <?=$baris['namadiv']." -- ".$baris['subdiv']?>
          </option>
          <? } ?>
        </select></td>
      </tr>
      <tr>
        <td>No. Bukti </td>
        <td><input type="text" name="bukti" id="bukti" readonly="true" value="<?php echo $div; ?>/<?=nobukti($_GET['nobukti'])?>/<?=substr($_GET['bulan'],0,2)?>" /></td>
      </tr>
      <tr>
        <td>D/K</td>
        <td><select name="dk" id="dk" class="required" title="*">
		 <? if ($_GET['dk']<>""){?> 
		 <option value="<?=$_GET['dk']?>" selected="selected"><?=$_GET['dk']?></option>
		 <? } else { ?>
          <option value="Kredit" <? if ($_GET['dk']=="Kredit"){?> selected="selected" <? }?>>Kredit</option>
		  <? } ?>
        </select>
        <div id="divAlert"></div>		</td>
      </tr>
      <tr>
        <td>Konsumen </td>
        <td><input type="text" name="supp" id="supp" maxlength="7" size="10" class="required" title="*" value="<?=$_GET['supp']?>"  readonly="true" />
		<? if($_GET['supp']==""){?>
		<a href="daftar_konsumen.php?width=400&amp;height=350&amp;TB_iframe=true" class="thickbox"><img src="../assets/button_search.png" alt="Pilih Supplier" border="0" /></a>
		<? } ?>
		<input type="text" name="namasupp" size="30" value="<?=$_GET['namasupp']?>" readonly="true" />        </td>
      </tr>
      <tr>
        <td>No. Perkiraan </td>
        <td><input type="text" name="norek" id="norek" maxlength="7" size="10" class="required" title="*" value="2110100"  readonly="true"  />
		
		<input type="text" name="namarek" size="30" value="Hutang Dagang" readonly="true" />        </td>
      </tr>
      <tr>
        <td>Uraian</td>
        <td><input type="text" name="keteranganheader" size="50" class="required" title="*" value="Pembelian Barang Dagang"   readonly="true" ></td>
      </tr>
      <tr>
        <td>TOTAL</td>
        <td>
			<?
				$SQLt = "SELECT SUM(jumlah) FROM $database.jurnal_srb WHERE bulan = '".$_GET['bulan']."' AND nobukti = '".$_GET['nobukti']."'";
				$hasilt= mysql_query($SQLt,$dbh_jogjaide);
				$barist = mysql_fetch_array($hasilt);
				$total = number_format($barist[0],2,'.',',');
				echo $total;
			
			?>		</td>
      </tr>
    </table>
	<br />
	<table border="1" align="left" cellpadding="3" cellspacing="0" bordercolorlight="silver" bordercolordark="#FFFFFF">
      <? if ($_GET['id']<>"") {?>
      <tr>
        <td background="../images/impactg.png" colspan="9" align="center"><font color="white"><b>Edit Transaksi </b></font></td>
      </tr>
      <? } else { ?>
      <tr>
        <td background="../images/impactg.png" colspan="9" align="center"><strong><font color="white"> TRANSAKSI </font></strong></td>
      </tr>
      <? } ?>
      <tr bgcolor="#FFCC00">
        <td width="34" align="center"><strong>No</strong></td>
        <td width="150" align="center">
		<? if ($_GET['nobukti']=="") {?>
			<div id="output"></div>
		<? } else {
				if($_GET['dk']=="Debet"){
					echo "Kredit";
				} else {
					echo "Debet";
				}
			}
		?>
		</td>
        <td width="150" align="center"><strong>Uraian</strong></td>
        <td width="104" align="center"><strong>Jumlah</strong></td>
        <? if ($_GET['id']<>"") { ?>
        <td width="58" align="center"><b>Update</b></td>
        <td width="58" align="center"><b>Batal</b></td>
        <? } else { ?>
        <td width="58" align="center"><strong>Edit</strong></td>
        <td width="58" align="center"><b>Hapus</b></td>
        <? } ?>
      </tr>
      <? if ($_GET['id']=="") { ?>
      <tr bgcolor="yellow">
        
          <td align="center"><img src="../images/kal_next.gif" alt="Selanjutnya" border="0" /></td>
          <td align="center">
		  <select name="norek2" class="required" title="*" >
            <option value="">-Pilih-</option>
            <?
				$SQL = "SELECT * FROM $database.rekening WHERE substr(norek, -3) <> '000' ORDER BY norek";
				$hasil = mysql_query($SQL, $dbh_jogjaide);
				while($baris = mysql_fetch_array($hasil)){
			?>
            <option value="<?=$baris['norek']?>">
            <?=$baris['norek']?>
              -
  <?=$baris['namarek']?>
            </option>
            <? } ?>
          </select></td>
          <td align="center"><textarea name="keterangantransaksi" class="required" title="*" cols="20" rows="2"></textarea></td>
          <td align="center">Rp.
            <input type="text" name="jumlah"  class="required kanan" title="*" />
            $.
            <input type="text" name="dollar"  title="Dollar" /></td>
          <td align="center" colspan="4"><input name="image" type="image" src="../images/add.gif" border="0" /></td>
        </form>
      </tr>
      <? } ?>
      <?
	  	
		$SQLj = "SELECT * FROM $database.jurnal_srb WHERE bulan = '".$_GET['bulan']."' AND nobukti = '".$_GET['nobukti']."'";
		//echo $SQLj; 		
		$hasilj = mysql_query($SQLj, $dbh_jogjaide);
		$nRecord = 1;
		if (mysql_num_rows($hasilj) > 0) { 
		while ($row=mysql_fetch_array($hasilj)) { 
	?>
      <tr <?	 if (($nRecord % 2)==0) {?>bgcolor="#FFFFFF"<? } else {?> else="else" bgcolor="#CCCCCC"<? }?>>
        <form action="submission_gli.php" method="post" name="frmijin" id="frmijin">
          <input type="hidden" name="id" value="<?=$_GET['id']?>" />
          <input type="hidden" name="cmd" value="upd_jurnal" />
          <td align="center"><?=$nRecord?></td>
          <td align="center"><? if ($_GET['id']<>"") { ?>
              <input type="text" name="norek2" size="20" class="required" title="*" maxlength="4" value="<?=$row['norek']?>" />
              <? } else { ?>
              <?
			  if($row["jenis"]=="Kredit"){
					echo $row["kd"]." -- ".$row["divisi"];
				}
				if($row["jenis"]=="Debet"){
					echo $row["kk"]." -- ".$row["divisi"];
				}
			  
			  ?>
              <? } ?>
          </td>
          <td align="left"><? if ($_GET['id']<>"") { ?>
              <input type="text" name="namarek" size="50" class="required" title="*"  value="<?=$row['namarek']?>" />
              <? } else { ?>
              <?
			  	//tambah kondisi debet kredit
				if($row["jenis"]=="Kredit"){
					echo $row["ket"];
				}
				if($row["jenis"]=="Debet"){
					echo $row["ket2"];
				}
			  ?>
              <? } ?></td>
          <td align="right"><? if ($_GET['id']<>"") { ?>
              <select name="tipe" id="tipe" class="required" title="*">
                <option value="A" <? if($row['tipe']=="A") {?> selected="selected" <? }?>>A</option>
                <option value="P" <? if($row['tipe']=="P") {?> selected="selected" <? }?>>P</option>
                <option value="R" <? if($row['tipe']=="R") {?> selected="selected" <? }?>>R</option>
              </select>
              <? } else { ?>
              <?=number_format($row["jumlah"],2,'.',',');?>
              <? } ?></td>
          <? if ($_GET['id']<>"") { ?>
          <td align="center"><input name="image" type="image" src="../images/approve.gif" border="0" /></td>
          <td align="center"><a href="javascript:history.back()"><img src="../images/kal_prev.gif" alt="Sebelumnya" border="0" /></a></td>
          <? } else { ?>
          <td align="center"><a href="?mn=<?=$_GET['mn']?>&amp;id=<?=$row["norek"]?>"></a></td>
          <td align="center"><a href="javascript:confirmDelete('submission_gli.php?id=<?=$row["id"]?>&amp;cmd=del_jurnal&nobukti=<?=$_GET['nobukti']?>&tgl_transaksi=<?=$_GET['tgl_transaksi']?>&dk=<?=$_GET['dk']?>&norek=<?=$_GET['norek']?>&namarek=<?=$_GET['namarek']?>&divisi=<?=$_GET['divisi']?>&bulan=<?=$_GET['bulan']?>&keteranganheader=<?=$_GET['keteranganheader']?>')"><img src="../images/hapus.gif" alt="Hapus" border="0" /></a></td>
          <? } ?>
        </form>
      </tr>
      <?  
		 $nRecord = $nRecord + 1;
		} ?>
		<tr>
			<td colspan="20" align="center">
			<a href="index.php?mn=trans_jurnal">[ SELESAI ATAU KE NOMOR BUKTI BERIKUTNYA ]</a>
			<a href="cetak_pdf.php?divisi=<?php echo $div; ?>&nobukti=<?=$_GET['nobukti']?>&bulan=<?=$_GET['bulan']?>&tanggal=<?=$_GET['tgl_transaksi']?>">
			[ CETAK ]</a>
			</td>
		</tr>
		<?
	} else { ?>
      <tr>
        <td align="center" colspan="9"><font color="red">Mohon maaf, tidak ada Data dimaksud.</font></td>
      </tr>
      <?  } ?>
    </table>	<p>&nbsp;</p></td>
  </tr>
</table>
