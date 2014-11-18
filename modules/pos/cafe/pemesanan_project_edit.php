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
<script type="text/javascript" src="../assets/jquery.validate.pack.js"></script>
 <script language="javascript" src="../assets/thickbox/thickbox.js"></script>
 <link href="../assets/thickbox/thickbox.css" rel="stylesheet" type="text/css" />

<? 
 if($_SESSION["sess_kelasuser"]<>"User"){
 	include "load_sp.php"; 
 }
 ?>
 
 <script language="JavaScript">
 window.onload = function() {
  document.getElementById("ppk").focus();
}
<!--
function kosongtext(){
		$("#ppk").val("");
		$("#brg").val("");
	}

	function confirmDelete(delUrl) {
	
		
		if (confirm("Data ini akan dihapus!\nApakah Anda yakin untuk menghapusnya ?")) {
			//var password;
			//var pass1 = "kafet4"; // place password here
			//password=prompt("Please enter your password:","");
			//if (password==pass1) {
				document.location = delUrl;
			//}
		}
		}
	function confirmPOS(delUrl) {
	
		
		if (confirm("Data ini akan di Posting ke Inventory!\nApakah Anda yakin, Data tidak bisa di Cancel ?")) {
			//var password;
			//var pass1 = "kafet4"; // place password here
			//password=prompt("Please enter your password:","");
			//if (password==pass1) {
				document.location = delUrl;
			//}
		}
	}
//-->
</script>
 <script type="text/javascript">
 function selectBuku(no, nama){
  $('input[@name=norek]').val(no);
  $('input[@name=namarek]').val(nama);
  //tb_remove(); // hilangkan dialog thickbox
}
	
function hitung(){
		qty = clearNum(document.getElementById("qty").value) * 1;
		harga = clearNum(document.getElementById("harga").value) * 1;
		disc = clearNum(document.getElementById("disc").value) * 1;
		document.getElementById("jumlah").value = formatCurrency((harga*qty)-((disc/100)*harga*qty));
	}

 </script>
 <link rel='stylesheet' type='text/css' href='jquery.autocomplete.css'/>
    <script type='text/javascript' src='jquery.autocomplete.js'></script>
<script type="text/javascript">
$().ready(function() {
	function kosongtext(){
		$("#ppk").val("");
		$("#brg").val("");
	}
	function log(event, data, formatted) {
		$("<li>").html( !data ? "No match!" : "Selected: " + formatted).appendTo("#result");
	}

	function formatItem(row) {
		return row[0] + " (<strong>id: " + row[1] + "</strong>)";
	}
	function formatResult(row) {
		return row[0].replace(/(<.+?>)/gi, '');
	}
	//nilaix = $('#combobox_carabayar option:selected').val();
	//nilaix = $('#combobox_carabayar').val();
	nilaix = "<?=$_SESSION["sess_tipe"]?>";

	$("#ppk").autocomplete("ajax_auto_barang.php?divisi="+nilaix+"&tipe=Project", {
		width: 300,
		max: 20,
		matchContains: true,
		formatResult: function(row) {
			return row[0];
		}
	});
	$("#ppk").result(function(event, data, formatted) {
		if (data)
			//$(this).parent().next().find("input").val(data[1]);
			//--- plus
			$("#barang").val(data[1]);
			$("#brg").val(data[1]);
			 $.get('../include/cari.php?cari=barang&mode=hargabeli',{id: $("#brg").val()},
				function(nama_pegawai){
				  // jika response tidak kosong nilainya maka masukkan nilai ke inputan nama pegawai
				  if(nama_pegawai.length > 0){ 
					$('input[@name=harga]').val(formatCurrency(nama_pegawai));	
					hitung();
					document.forms["frmijin"].submit();
				  }else {
					$('input[@name=harga]').val("");
				   }
				}
			  );
			// -----
	});
	

}); </script>
 <script type="text/javascript">

$(document).ready(function(){

function kosongtext(){
		$("#ppk").val("");
		$("#brg").val("");
	}
	
$("#barang").change(function() {
    nwval =  $(this).val();
    //$('#harga').val(nwval);
});

function clearNum(number){
	while(String(number).indexOf(',') > -1){
	 number = String(number).replace(',','');
	}
	return number;
}
function hitung(){
		qty = clearNum(document.getElementById("qty").value) * 1;
		harga = clearNum(document.getElementById("harga").value) * 1;
		disc = clearNum(document.getElementById("disc").value) * 1;
		document.getElementById("jumlah").value = formatCurrency((harga*qty)-((disc/100)*harga*qty));
	}

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
			
  $('#pembeli').blur( // beri event pada saat onBlur inputan kode pegawai
	function(){			
	  var vNIP = $(this).val();
	  $.get('../include/cari.php?cari=pembeli&mode=alamat',{id: vNIP},
		function(nama_pegawai){
		  // jika response tidak kosong nilainya maka masukkan nilai ke inputan nama pegawai
		  if(nama_pegawai.length > 0){ 
			$('input[@name=alamat]').val(nama_pegawai);	
		  }else {
			$('input[@name=alamat]').val("");
		   }
		}
	  );
	  $.get('../include/cari.php?cari=pembeli&mode=kota',{id: vNIP},
		function(nama_pegawai){
		  // jika response tidak kosong nilainya maka masukkan nilai ke inputan nama pegawai
		  if(nama_pegawai.length > 0){ 
			$('input[@name=kota]').val(nama_pegawai);	
		  }else {
			$('input[@name=kota]').val("");
		   }
		}
	  );
	  $.get('../include/cari.php?cari=pembeli&mode=telp',{id: vNIP},
		function(nama_pegawai){
		  // jika response tidak kosong nilainya maka masukkan nilai ke inputan nama pegawai
		  if(nama_pegawai.length > 0){ 
			$('input[@name=telp]').val(nama_pegawai);	
		  }else {
			$('input[@name=telp]').val("");
		   }
		}
	  );
	  $.get('../include/cari.php?cari=pembeli&mode=rek',{id: vNIP},
		function(nama_pegawai){
		  // jika response tidak kosong nilainya maka masukkan nilai ke inputan nama pegawai
		  if(nama_pegawai.length > 0){ 
			$('input[@name=rek]').val(nama_pegawai);	
		  }else {
			$('input[@name=rek]').val("");
		   }
		}
	  );
	  $.get('../include/cari.php?cari=pembeli&mode=namarek',{id: vNIP},
		function(nama_pegawai){
		  // jika response tidak kosong nilainya maka masukkan nilai ke inputan nama pegawai
		  if(nama_pegawai.length > 0){ 
			$('input[@name=namarek]').val(nama_pegawai);	
		  }else {
			$('input[@name=namarek]').val("");
		   }
		}
	  );
	  $.get('../include/cari.php?cari=pembeli&mode=nama',{id: vNIP},
		function(nama_pegawai){
		  // jika response tidak kosong nilainya maka masukkan nilai ke inputan nama pegawai
		  if(nama_pegawai.length > 0){ 
			$('#namasupp').attr("value", nama_pegawai);
		  }else {
			$('#namasupp').attr("value", "");
		   }
		}
	  );
	}
  );
    $('#barang').click( 
	function(){			
	  var vNIP = $(this).val();
	  $.get('cari.php?cari=barang&mode=harga',{id: vNIP},
		function(nama_pegawai){
		  // jika response tidak kosong nilainya maka masukkan nilai ke inputan nama pegawai
		  if(nama_pegawai.length > 0){ 
			$('input[@name=harga]').val(formatCurrency(nama_pegawai));	
			hitung();
		  }else {
			$('input[@name=harga]').val("0");
		   }
		}
	  );
	  	 
	  $.get('../include/cari.php?cari=barang&mode=nama',{id: vNIP},
		function(nama_pegawai){
		  // jika response tidak kosong nilainya maka masukkan nilai ke inputan nama pegawai
		  if(nama_pegawai.length > 0){ 
			$('#namabrg').attr("value", nama_pegawai);
			hitung();
		  }else {
			$('#namabrg').attr("value", "");
		   }
		}
	  );
	}
  );
  
  // beri event pada saat keyup kode pegawai agar kode yang dimasukan font-nya UPPERCASE semua (optional)
  $('input[@name=namarekening]').keyup(
	function(){
	  $(this).val(String($(this).val()).toUpperCase());
	}
  );
});
	
</script>

<script type="text/javascript">
$(document).ready(function() {
	
	$('#combobox_subcarabayar').change( // beri event pada saat onBlur inputan kode pegawai
	function(){			
	  var vNIP = $(this).val();
	  $.get('../include/cari.php?cari=supplier&mode=alamat',{id: vNIP},
		function(nama_pegawai){
		  // jika response tidak kosong nilainya maka masukkan nilai ke inputan nama pegawai
		  if(nama_pegawai.length > 0){ 
			$('input[@name=alamat]').val(nama_pegawai);	
		  }else {
			$('input[@name=alamat]').val("");
		   }
		}
	  );
	  $.get('../include/cari.php?cari=supplier&mode=kota',{id: vNIP},
		function(nama_pegawai){
		  // jika response tidak kosong nilainya maka masukkan nilai ke inputan nama pegawai
		  if(nama_pegawai.length > 0){ 
			$('input[@name=kota]').val(nama_pegawai);	
		  }else {
			$('input[@name=kota]').val("");
		   }
		}
	  );
	  $.get('../include/cari.php?cari=supplier&mode=telp',{id: vNIP},
		function(nama_pegawai){
		  // jika response tidak kosong nilainya maka masukkan nilai ke inputan nama pegawai
		  if(nama_pegawai.length > 0){ 
			$('input[@name=telp]').val(nama_pegawai);	
		  }else {
			$('input[@name=telp]').val("");
		   }
		}
	  );
	  $.get('../include/cari.php?cari=supplier&mode=rek',{id: vNIP},
		function(nama_pegawai){
		  // jika response tidak kosong nilainya maka masukkan nilai ke inputan nama pegawai
		  if(nama_pegawai.length > 0){ 
			$('input[@name=rek]').val(nama_pegawai);	
		  }else {
			$('input[@name=rek]').val("");
		   }
		}
	  );
	  $.get('../include/cari.php?cari=supplier&mode=namarek',{id: vNIP},
		function(nama_pegawai){
		  // jika response tidak kosong nilainya maka masukkan nilai ke inputan nama pegawai
		  if(nama_pegawai.length > 0){ 
			$('input[@name=namarek]').val(nama_pegawai);	
		  }else {
			$('input[@name=namarek]').val("");
		   }
		}
	  );
	  $.get('../include/cari.php?cari=supplier&mode=nama',{id: vNIP},
		function(nama_pegawai){
		  // jika response tidak kosong nilainya maka masukkan nilai ke inputan nama pegawai
		  if(nama_pegawai.length > 0){ 
			$('#namasupp').attr("value", nama_pegawai);
		  }else {
			$('#namasupp').attr("value", "");
		   }
		}
	  );
	  
	  
	  
		var _href = $("a.posted_url").attr("href");
		$("a.posted_url").attr("href", _href + '&supplier='+vNIP+'\')');


	}
  );


	function kosongtext(){
		document.frmijin.ip.value = "";
		document.frmijin.brg.value = "";
	}
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
}) //doc ready end
</script>
	<script type="text/javascript">
	$(document).ready(function(){
		$("#satuan").change(onSelectChange);
	});

	function onSelectChange(){
		var selected = $("#satuan option:selected");		
		if(selected.val() == satuanx){
			//alert("ok");
			
			hitung();

		} else {
			//hitung();
		}
	}
	</script>
<script type="text/javascript">
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
function clearNum(number){
	while(String(number).indexOf(',') > -1){
	 number = String(number).replace(',','');
	}
	return number;
}
	function hitung(){
		qty = clearNum(document.getElementById("qty").value) * 1;
		harga = clearNum(document.getElementById("harga").value) * 1;
		document.getElementById("jumlah").value = formatCurrency(harga*qty);
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
	function stop() {
		event.preventDefault();
		if (window.event.keyCode == 13 ) return false;
	}
	$(document).ready(function() {
	  $(window).keydown(function(event){
		if( (event.keyCode == 13) && (validationFunction() == false) ) {
		  event.preventDefault();
		  return false;
		}
	  });
	});
</script>
</script>
	<script type="text/javascript">
	$(document).ready(function(){
		$("#output").html("Pilih D/K");
		$("#dk").change(onSelectChange);
		$("#divisi").change(onSelectChange);
	});
	
function hitung(){
		qty = clearNum(document.getElementById("qty").value) * 1;
		harga = clearNum(document.getElementById("harga").value) * 1;
		disc = clearNum(document.getElementById("disc").value) * 1;
		document.getElementById("jumlah").value = formatCurrency((harga*qty)-((disc/100)*harga*qty));
	}
	function onSelectChange(){
		var selected = $("#dk option:selected");
		var selecteddiv = $("#divisi option:selected");		
		var output = "Pilih D/K";
		if(selected.val() != 0){
			if(selected.val()=="Debet"){
				output = "Kredit";
			}
			if(selected.val()=="Kredit"){
				output = "Debet";
			}
		}
		//$("#bukti").val(selecteddiv.val()+'/');
		$("#harga").html(output);
	}
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
          <input type="hidden" name="cmd" value="add_pesanProject" />
		  <input type="hidden" name="nobukti" value="<?=$_GET['nobukti']?>" />
		  <input type="hidden" name="namasupp" value="<?=$_GET['namasupp']?>" id="namasupp" />
		  <input type="hidden" name="namabrg" value="" id="namabrg" />
		  <input type="hidden" name="nomor" value="<?=$_GET['nomor']?>" />
      <tr>
        <td width="143">No. Faktur </td>
        <td width="205"><input type="text" name="nonota" value="PR/<?=nobukti($_GET['nomor'])?>" readonly="true" /></td>
        <td width="107">Tanggal</td>
        <td width="188"><input type="text" name="tgl_transaksi" id="tgl_transaksi" size="10" class="required" title="*" value="<?=$_GET['tgl_transaksi']?>" <? if($_GET['nomor']<>""){ ?>  readonly="true"  <? }?> />
          <a href="javascript:showCalendar('tgl_transaksi')"></a></td>
      </tr>
	  
	  <?php if($_SESSION["sess_kelasuser"]!= "Logistik") { ?>
	  
	   <tr>
        <td>Supplier </td>
        <td>
		<? //if($_SESSION["sess_kelasuser"]<>"User"){ 
		
			// <select name="supp" id="combobox_subcarabayar" class="required" title="Harus pilih Supplier"></select>
		?>
		<? //} else {?>
		<select name="supp" id="combobox_subcarabayar" class="required" title="Pilih Supplier">
		 <option value="">-Pilih-</option>
          <?
			$SQL = "SELECT * FROM $database.supplier WHERE kode <> ''";
			$SQL = $SQL . " AND divisi = '".$_SESSION["sess_tipe"]."'";
				
			$hasil = mysql_query($SQL, $dbh_jogjaide);
			while($baris = mysql_fetch_array($hasil)){
		?>
          <option value="<?=$baris['kode']?>" <? if($_GET['kode']==$baris['kode']){?> selected="selected" <? }?>>
          <?=$baris['nama']?>
          </option>
          <? } ?>
        </select>
		
		<? //} 
		?>		</td>
        <td>Saldo</td>
        <td><input type="text" name="saldo" id="saldo" class="kanan" readonly="true"></td>
      </tr>
      <tr>
        <td>Alamat</td>
        <td><input type="text" name="alamat" id="alamat" readonly="true" size="40"></td>
        <td>Rek</td>
        <td><input type="text" name="rek" id="rek" readonly="true"></td>
      </tr>
      <tr>
        <td>Kota</td>
        <td><input type="text" name="kota" id="kota" readonly="true"></td>
        <td>Nama Rek </td>
        <td><input type="text" name="namarek" readonly="true"></td>
      </tr>
      <tr>
        <td>Telp.</td>
        <td><input type="text" name="telp" id="telp" readonly="true"></td>
        <td>LPB</td>
        <td><input type="text" readonly="true" id="lpb" name="lpb" value="YFD/<?=nobukti($_GET['nomor'])?>"></td>
      </tr>
	  
	  <?php } ?>
	  
    </table>
	<br />
	<table border="1" a style="border-collapse:collapse" lign="left" cellpadding="3" cellspacing="0" bordercolorlight="silver" bordercolordark="#FFFFFF">
      <? if ($_GET['id']<>"") {?>
      <tr>
        <td background="../images/impactg.png" colspan="12" align="center"><font color="white"><b>Edit Transaksi </b></font></td>
      </tr>
      <? } else { ?>
      <tr>
        <td background="../images/impactg.png" colspan="12" align="center"><strong><font color="white"> TRANSAKSI </font></strong></td>
      </tr>
      <? } ?>
      <tr bgcolor="#FFCC00">
        <td width="34" align="center"><strong>No</strong></td>
        <td align="center">Auto Complete / Barcode </td>
        <td align="center">Nama Barang</td>
        <td align="center"><strong>Qty</strong></td>
        <td align="center"><strong>Harga </strong></strong></td>
		<td align="center"><strong>Discount(%)</strong></td>
		<td align="center"><strong>Jumlah</strong></td>
        <? if ($_GET['id']<>"") { ?>
        <td width="58" align="center"><b>Update</b></td>
        <td width="58" align="center"><b>Batal</b></td>
        <? } else { ?>
        <td width="58" align="center"><strong>Post</strong></td>
        <td width="58" align="center"><b>Hapus</b></td>
        <? } ?>
      </tr>
      <? if ($_GET['id']=="") { ?>
      <tr bgcolor="yellow">
        
          <td align="center"><img src="../images/kal_next.gif" alt="Selanjutnya" border="0" /></td>
          <td align="center"><input name="ip" type="text" id="ppk" class="data-entry-kanan" onclick="kosongtext()" />
          <input name="brg" style="display:none" type="text" id="brg" value="" size="8" readonly="readonly"  title="Kode Barang Harus Terisi !"/></td>
          <td align="center">
		  <select name="barang" id="barang">
		  	<option value="0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
		  <?php
		  		$sql = "select * from $database.stock";
				$hasil = mysql_query($sql, $dbh_jogjaide);
				while($baris=mysql_fetch_array($hasil)){
		  ?>
		  	<option value="<?=$baris["kodebrg"]?>"><?=$baris["namabrg"]?></option>
			<? }?>
		  </select>
		  </td>
          <td align="center"><input type="text" name="qty" id="qty" size="5" value="1" class="required kanan" title="*" onKeyUp="hitung()" /></td>
          <td align="center"><input type="text" name="harga" id="harga"  class="required kanan" title="*" onKeyUp="hitung()" readonly="true"/></td>
		  
		  <td align="right"><input type="text" name="disc" id="disc" size="10" class="required kanan" title="*" value="0" onkeyup="hitung()" readonly="true" /></td>
		  <td align="center"><input type="text" id="jumlah" name="jumlah" size="15" class="required kanan" title="*" value="0"  readonly="true"" /></td>
          <td align="center" colspan="4"><input name="image2" type="image" src="../images/add.gif" border="0" /></td>
        </form>
      </tr>
      <? } ?>
      <?
	  	
		$SQLj = "SELECT * FROM $database.po WHERE status = 1 AND model = 'PR' AND nomor = '".$_GET['nomor']."'";
		//echo $SQLj; 		
		$hasilj = mysql_query($SQLj, $dbh_jogjaide);
		$nRecord = 1;
		if (mysql_num_rows($hasilj) > 0) { 
		while ($row=mysql_fetch_array($hasilj)) { 
	?>
	<?php $id_posting = $row["id"]?>
      <tr <?	 if (($nRecord % 2)==0) {?>bgcolor="#FFFFFF"<? } else {?> else="else" bgcolor="#CCCCCC"<? }?>>
        
          <td align="center"><?=$nRecord?></td>
          <td align="left"><?=$row['kodebrg']?></td>
          <td align="left"><?=$row['namabrg']?></td>
          <td align="right">
		  <?php if($row["posted"] != "1") { ?>
		  <input type="text" class="kanan" value="<?=$row['qtyin']?>" name="<?=$row['id']?>" size="5"  onBlur="hitungUlang(this.value+'-'+this.name+'-'+'<?=$row['kodebrg']?>'+'-'+'<?=$_GET['nomor']?>'+'-'+<?=$row['harga']?>);" onfocus= "this.select()"/>
		  <?php } else { ?>
		  
		  <?php echo $row['qtyin']; } ?>
		  </td>
          <td align="right"><?=number_format($row["harga"],2,'.',',');?></td>
		  <td align="right"><?=$row["disc"];?></td>
		  <td align="right"><?=number_format(($row["harga"] * $row["qtyin"])-($row["harga"] * $row["qtyin"]*$row["disc"]/100),2,'.',',')?></td>
		  <? $t_jumlah = $t_jumlah + (($row["harga"] * $row["qtyin"])-($row["harga"] * $row["qtyin"]*$row["disc"]/100)); ?>
		  <? $t_debet = $t_debet + $row["kredit"]; ?>
          <? if ($_GET['id']<>"") { ?>
          <td align="center"><input name="image" type="image" src="../images/approve.gif" border="0" /></td>
          <td align="center"><a href="javascript:history.back()"><img src="../images/kal_prev.gif" alt="Sebelumnya" border="0" /></a></td>
          <? } else { ?>
          <td align="center">
		  <?php if($_SESSION["sess_kelasuser"]!= "Logistik" && $row["posted"] != "1") { ?>
		  <a class="posted_url" href="javascript:confirmPOS('submission_inv.php?id=<?=$id_posting;?>&harga=<?=$row["harga"]?>&qty=<?=$row["qtyin"]?>&cmd=add_to_inv&nonota=PO/<?=nobukti($_GET['nomor'])?>&supp=<?=$_GET['supp']?>&alamat=<?=$_GET['alamat']?>&kota=<?=$_GET['kota']?>&
		  telp=<?=$_GET['telp']?>&tgl_transaksi=<?=$_GET['tgl_transaksi']?>&saldo=<?=$_GET['saldo']?>&rek=<?=$_GET['rek']?>&namarek=<?=$_GET['namarek']?>&nomor=<?=$_GET['nomor']?>&namasupp=<?=$_GET['namasupp']?>&brg=<?=$row['kodebrg']?>&qtyin=<?=$row['qtyin']?>&netto=<?=$row["kredit"]?>&meja=<?=$row["meja_id"]?>&jumlah=<?=($row["harga"] * $row["qtyin"])-($row["harga"] * $row["qtyin"]*$row["disc"]/100)?>"> Posting</a>
		  <? } ?>
		  <?php if($row["posted"] == "1") { ?>
		  Posted
		  <? } ?>
		  </td>
          <td align="center">
		  <?php if($row["posted"] == "0") { ?>
		  <a href="javascript:confirmDelete('submission_cafe.php?id=<?=$row["id"]?>&cmd=del_pemesanan&nonota=<?=$_GET['nonota']?>&supp=<?=$_GET['supp']?>&alamat=<?=$_GET['alamat']?>&kota=<?=$_GET['kota']?>&telp=<?=$_GET['telp']?>&tgl_transaksi=<?=$_GET['tgl_transaksi']?>&saldo=<?=$_GET['saldo']?>&rek=<?=$_GET['rek']?>&namarek=<?=$_GET['namarek']?>&nomor=<?=$_GET['nomor']?>&namasupp=<?=$_GET['namasupp']?>&brg=<?=$row['kodebrg']?>&qtyin=<?=$row['qtyin']?>&netto=<?=$row["kredit"]?>&meja=<?=$row["meja_id"]?>&jumlah=<?=($row["harga"] * $row["qtyin"])-($row["harga"] * $row["qtyin"]*$row["disc"]/100)?>')">
		  <img src="../images/hapus.gif" alt="Hapus" border="0" /></a>
		  <?php } ?>
		  </td>
          <? } ?>
        </form>
      </tr>
      <?  
		 $nRecord = $nRecord + 1;
		} ?>
		<tr>
		  <td align="center">&nbsp;</td>
	      <td align="center">&nbsp;</td>
	      <td align="center">&nbsp;</td>

	      <td align="center">&nbsp;</td>
	      <td align="center">&nbsp;</td>
	      
	      <td align="center">&nbsp;</td>
		  <td align="right"><h3><?=number_format($t_jumlah,2,'.',',');?></h3></td>
	      <td align="right">&nbsp;</td>
	      <td align="center">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="20" align="center">
			<a href="popup_bayar.php?width=500&height=300&nonota=<?=$_GET['nomor']?>&TB_iframe=true" id="cari" class="thickbox" title="Pembayaran">[ CETAK ]</a>&nbsp;<a href="pemesanan_project.php">[ SELESAI ATAU KE NOMOR PR BERIKUTNYA ]</a>
		  </td>
		</tr>
		<?
	} else { ?>
      <tr>
        <td align="center" colspan="12"><font color="red">Mohon maaf, tidak ada Data dimaksud.</font></td>
      </tr>
      <?  } ?>
    </table>	
	<p>&nbsp;</p></td>
  </tr>
</table>
