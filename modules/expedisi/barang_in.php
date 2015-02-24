<?php @session_start();

	include "../../otentik.php";
	include "../../config_sistem.php";
	include "../../include/functions.php";
	
	
		$nomer = strlen($_POST["nourut"]);
		$tahun = date('Y');
		$bulan = date('m');
		if($nomer == 1){
			$nota = "GGE$tahun$bulan"."000".$_POST["nourut"];	
		}
		if($nomer == 2){
			$nota = "GGE$tahun$bulan"."00".$_POST["nourut"];	
		}
		if($nomer == 3){
			$nota = "GGE$tahun$bulan"."0".$_POST["nourut"];	
		}
		if($nomer == 4){
			$nota = "GGE$tahun$bulan".$_POST["nourut"];	
		}
		
	//proses simpan
	if(isset($_GET["action"]) && $_GET["action"]=="add"){
		$SQL = "INSERT INTO expedisi SET
				id = '',
				nourut = '". $_POST["nourut"] ."',
				satuan = '". $_POST["satuan"] ."',
				nonota = '". $nota ."',
				jenis_pembayaran = '". $_POST["jenis_pembayaran"] ."',
				tanggal = '". baliktgl($_POST["tanggal"]) ."',
				nama_pengirim = '". $_POST["nama_pengirim"] ."',
				alamat_pengirim = '". $_POST["alamat_pengirim"] ."',
				telpon_pengirim = '". $_POST["telpon_pengirim"] ."',
				isi_kiriman = '". $_POST["isi_kiriman"] ."',
				memo_pengirim = '". $_POST["memo_pengirim"] ."',
				harga_barang_ttp = '". ereg_replace("[^0-9]", "", $_POST['harga_barang_ttp']) ."',
				satuan_packing = '". ereg_replace("[^0-9]", "", $_POST['satuan_packing']) ."',
				berat_barang = '". $_POST["berat_barang"] ."',
				total_biaya = '". ereg_replace("[^0-9]", "", $_POST['total_biaya']) ."',
				nama_penerima = '". $_POST["nama_penerima"] ."',
				alamat_penerima = '". $_POST["alamat_penerima"] ."',
				telepon_penerima = '". $_POST["telepon_penerima"] ."',
				banyak_barang = '". $_POST["banyak_barang"] ."',
				kubikasi = '". ereg_replace("[^0-9]", "", $_POST['kubikasi']) ."',
				jenis_layanan = '". $_POST["jenis_layanan"] ."',
				biaya_administrasi = '". ereg_replace("[^0-9]", "", $_POST['biaya_administrasi']) ."',
				biaya_lainnya = '". ereg_replace("[^0-9]", "", $_POST['biaya_lainnya']) ."',
				discount = '". ereg_replace("[^0-9]", "", $_POST['discount']) ."',
				total_ongkos = '". ereg_replace("[^0-9]", "", $_POST['total_ongkos']) ."'
		";
		
		$hasil = mysql_query($SQL) or die(mysql_error());
		$ex_id = mysql_insert_id();
		
		//cari tujuan
		$SQL = "SELECT layanan FROM jenis_layanan WHERE id= '". $_POST["jenis_layanan"] ."'";
		$hasil = mysql_query($SQL);
		$baris = mysql_fetch_array($hasil);
		$tujuan = $baris[0];
		
		//insert ke donasi rout
		$SQL = "INSERT INTO donasi SET
			id='',
			noresi = '". $nota ."',
			dari = 'Jakarta',
			tujuan = '$tujuan'
			";
		$hasil = mysql_query($SQL);
		//jurnal
		if($_POST["jenis_pembayaran"]=="Tunai"){
			$SQL = "INSERT INTO $database.jurnal_srb(id, tipe_jurnal, tanggal, jenis, kd, kk, ket, ket2, jumlah, karyawan_id, dollar, sub, divisi, nobukti, bulan, user_id, expedisi_id) VALUES (
				'',
				'JEX',
				'".baliktgl($_POST['tanggal'])."',
				'Debet',
				'AL1-1111',
				'PD1-412',
				'Kas',
				'Pendapatan Jasa',
				'".ereg_replace("[^0-9]", "", $_POST['total_ongkos'])."',
				'$karyawan_id',
				'".$_POST['dollar']."',
				'$tipe',
				'".$_POST['divisi']."',
				'$nota',
				'$bulan',
				'".$_SESSION["sess_user_id"]."',
				'$ex_id'
				)";
			$hasil = mysql_query($SQL);
		}
		if($_POST["jenis_pembayaran"]=="Kredit"){
			$SQL = "INSERT INTO $database.jurnal_srb(id, tipe_jurnal, tanggal, jenis, kd, kk, ket, ket2, jumlah, karyawan_id, dollar, sub, divisi, nobukti, bulan, user_id, expedisi_id) VALUES (
				'',
				'JEX',
				'".baliktgl($_POST['tanggal'])."',
				'Debet',
				'AL2-1112',
				'PD1-412',
				'Piutang Usaha',
				'Pendapatan Jasa',
				'".ereg_replace("[^0-9]", "", $_POST['total_ongkos'])."',
				'$karyawan_id',
				'".$_POST['dollar']."',
				'$tipe',
				'".$_POST['divisi']."',
				'$nota',
				'$bulan',
				'".$_SESSION["sess_user_id"]."',
				'$ex_id'
				)";
			$hasil = mysql_query($SQL);
		}
		$SQL = "insert into nomorbukti(nomorbukti) VALUES('$nota')";
		$hasil = mysql_query($SQL);
	}
		//proses edit
	if(isset($_GET["action"]) && $_GET["action"]=="edit"){
		$SQL = "UPDATE expedisi SET
				
				nourut = '". $_POST["nourut"] ."',
				satuan = '". $_POST["satuan"] ."',
				jenis_pembayaran = '". $_POST["jenis_pembayaran"] ."',
				tanggal = '". baliktgl($_POST["tanggal"]) ."',
				nama_pengirim = '". $_POST["nama_pengirim"] ."',
				alamat_pengirim = '". $_POST["alamat_pengirim"] ."',
				telpon_pengirim = '". $_POST["telpon_pengirim"] ."',
				isi_kiriman = '". $_POST["isi_kiriman"] ."',
				memo_pengirim = '". $_POST["memo_pengirim"] ."',
				harga_barang_ttp = '". ereg_replace("[^0-9]", "", $_POST['harga_barang_ttp']) ."',
				berat_barang = '". $_POST["berat_barang"] ."',
				total_biaya = '". ereg_replace("[^0-9]", "", $_POST['total_biaya']) ."',
				nama_penerima = '". $_POST["nama_penerima"] ."',
				alamat_penerima = '". $_POST["alamat_penerima"] ."',
				telepon_penerima = '". $_POST["telepon_penerima"] ."',
				satuan_packing = '". $_POST["satuan_packing"] ."',
				banyak_barang = '". $_POST["banyak_barang"] ."',
				kubikasi = '". ereg_replace("[^0-9]", "", $_POST['kubikasi']) ."',
				jenis_layanan = '". $_POST["jenis_layanan"] ."',
				biaya_administrasi = '". ereg_replace("[^0-9]", "", $_POST['biaya_administrasi']) ."',
				biaya_lainnya = '". ereg_replace("[^0-9]", "", $_POST['biaya_lainnya']) ."',
				discount = '". ereg_replace("[^0-9]", "", $_POST['discount']) ."',
				total_ongkos = '". ereg_replace("[^0-9]", "", $_POST['total_ongkos']) ."'
				
				WHERE id = '". $_POST["id"] ."'
		";
		$hasil = mysql_query($SQL) or die(mysql_error());
		
		
		//cari tujuan
		$SQL = "SELECT layanan FROM jenis_layanan WHERE id= '". $_POST["jenis_layanan"] ."'";
		$hasil = mysql_query($SQL);
		$baris = mysql_fetch_array($hasil);
		$tujuan = $baris[0];
		
		//insert ke donasi rout
		$SQL = "UPDATE donasi SET
			tujuan = '$tujuan'
			WHERE noresi = '". $nota ."'";
		
		$hasil = mysql_query($SQL);
		
		$SQL = "UPDATE jurnal_srb SET jumlah = '". ereg_replace("[^0-9]", "", $_POST['total_ongkos']) ."' WHERE expedisi_id = '". $_POST["id"] ."'";
		$hasil = mysql_query($SQL);
	}
	
	//proses edit
	if(isset($_GET["id"])){
		$SQLData = "select * from expedisi WHERE id = '". $_GET["id"] ."' AND closing = 0";
		$hasildata = mysql_query($SQLData) or die(mysql_error());
		$datas = mysql_fetch_array($hasildata);
		if($datas["closing"]=="Y"){
			die("Data sudah di Closing.");
		}
	}
?>

<script type="text/javascript" src="../../assets/jquery-1.2.3.pack.js"></script>
<script src="../../assets/jquery-1.10.2.min.js"></script>

<script src="../../assets/jquery.loader.js"></script>
<link href="../../assets/jquery.loader.css" rel="stylesheet" /></script>
 <script type='text/javascript' src='../../assets/thickbox/thickbox.js'></script>
<link  href="../../assets/thickbox/thickbox.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../assets/kalendar_files/jsCalendar.js"></script>
<link href="../../assets/kalendar_files/calendar.css" rel="stylesheet" type="text/css">
<style type="text/css">

h4 { font-size: 18px; }
input.error, select.error { border: 1px solid red; }

label.error { color:red; margin-left: 10px; }

input.kanan{ text-align:right; }
input.kananDes{ text-align:right; }
</style>
<script language="javascript">
	

		
function clearNum(number){
	while(String(number).indexOf(',') > -1){
	 number = String(number).replace(',','');
	}
	return number;
}
	function hitung(){
		harga_barang_ttp = clearNum(document.getElementById("harga_barang_ttp").value) * 1;
		berat_barang = (document.getElementById("berat_barang").value) * 1;
		biaya_lainnya = clearNum(document.getElementById("biaya_lainnya").value) * 1;
		biaya_administrasi = clearNum(document.getElementById("biaya_administrasi").value) * 1;
		
		document.getElementById("kubikasi").value = formatCurrency(harga_barang_ttp*berat_barang);
		kubikasi = clearNum(document.getElementById("kubikasi").value) * 1;
		document.getElementById("total_biaya").value = formatCurrency((kubikasi)+(biaya_lainnya)+(biaya_administrasi));
		total_biaya = clearNum(document.getElementById("total_biaya").value) * 1;
		discount = clearNum(document.getElementById("discount").value) * 1;
		document.getElementById("total_ongkos").value = formatCurrency((total_biaya)-(discount));
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
	  function pindah(){
				window.location.href="barang_ls.php";	
			}
			
	function no_urut(){
		var response = '';
		$.ajax({ type: "GET",   
				 url: "no.php?q=jogjaide",   
				 async: false,
				 success : function(text)
				 {
					 response = text;
				 }
		});
		
		$('#nourut').val(response);
		}		
			
			
$(document).ready(function(){




		  function pindah(){
				window.location.href="barang_ls.php";	
			}

    $.each($('.kanan'), function()
    {
       $(this).keyup( function(){ 
	   		$(this).val(formatCurrency($(this).val()));
		} );
    });
	
	
	
	//simpan
    $("#submit-form").click(function(){
		if ( $('#nourut').val()==""){
			alert("Nomer Urut Harus Terisi. Klik Baru Dahulu.");
				//document.pengiriman-form.norm.focus();
				return false;
		}
		$.loader({content:"<div>Mengirim Data Ke Server ...</div>"});
         $.ajax({
           url : "barang_in.php?action=add", 
           type: "post", //form method
           data: $("#pengiriman-form").serialize(),
           //dataType:"json", 
           beforeSend:function(){
           },
           success:function(result){
             if(result.status){
             }else{
             }
			 $.loader('setContent', '<div>Datas received !<br /> Still processing ...</div>');
			$('#test3response').fadeIn(4000, function(){$.loader('close');});
			 alert("Data Telah Tersimpan");
             $(".loading").html("");
			 
			  
			 $(":input").not(":button,:button, :submit, :reset, :hidden").each( function() {
					this.value = this.defaultValue;     
				}); //reset
			  $('#jenis_layanan').prop('selectedIndex',0);
              //$('#nourut').val('');
		   //OpenInNewTab("surat_angkutan_cetak.php?id=GGE2014120001");
           },
           error: function(xhr, Status, err) {
			 $.loader('close');
             alert("Terjadi error : "+Status);
           }
         });
       return false;
     })
	 	
		function OpenInNewTab(url) {
		  var win = window.open(url, '_blank');
		  win.focus();
		}
	
    $("#edit").click(function(){
		$.loader({content:"<div>Mengirim Data Ke Server ...</div>"});
         $.ajax({
           url : "barang_in.php?action=edit", 
           type: "post", //form method
           data: $("#pengiriman-form").serialize(),
           //dataType:"json", 
           beforeSend:function(){
             //$(".loading").html("<span style=\"font: red\">Please wait....</span>");
           },
           success:function(result){
             if(result.status){
             }else{
             }
			 $.loader('setContent', '<div>Datas received !<br /> Still processing ...</div>');
			$('#test3response').fadeIn(4000, function(){$.loader('close');});
			 alert("Data Telah Ter Update");
             $(".loading").html("");
			 
			  
           
			 
           },
           error: function(xhr, Status, err) {
			 $.loader('close');
             alert("Terjadi error : "+Status);
           }
         });
       return false;
     })
	 	
		
		  
	$("#jenis_layanan").change( // beri event pada saat onBlur inputan kode pegawai
	function(){	
		var vNIP = $(this).val();
		$.get('ajax.php?cari=expedisi&mode=harga_layanan',{id: vNIP},
		function(nama_pegawai){
		  // jika response tidak kosong nilainya maka masukkan nilai ke inputan nama pegawai
		  if(nama_pegawai.length > 0){ 
		  	var str = nama_pegawai;
			var res = str.split("-"); 
			$('#harga_barang_ttp').val(formatCurrency(res[0]));	 
			$('#satuan').val((res[1]));	
			hitung();
		  }else {
			$('#harga_barang_ttp').val("");
			hitung();
		   }
		}
	  );
	});
	
	
				
  });
  

</script>
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
</style>
<table width="1000" border="0" align="center">
  <tr>
    <td width="652" align="center" valign="top"><?php echo isset($_GET["id"]) ? "EDIT" : "INPUT"; ?> PENGIRIMAN BARANG
      <hr size="5" noshade="noshade" /></td>
  </tr>
</table>
<form name="pengiriman-form" id="pengiriman-form" method="post" action="">
<input type="hidden" name="id" value="<?php echo $_GET["id"];?>" />
<table width="1000" border="0" align="center" style="border-collapse:collapse">
  <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5"><span class="loading"></span><div id="test3response"></div></td>
  </tr>
  <tr>
    <td>No. Urut</td>
    <td><input type="text" size="47"  name="nourut" id="nourut" readonly="readonly" value="<?php 
	$SQLn = "SELECT nourut FROM expedisi WHERE id = '".$_GET["id"]."'";
	$hasiln = mysql_query($SQLn);
	$barisn = mysql_fetch_array($hasiln);
	echo isset($_GET["id"]) ? $barisn[0] : ""; ?>" /></td>
    <td width="20" rowspan="12">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="249">Tanggal</td>
    <td width="227"><input type="text" name="tanggal" id="tanggal" size="42" class="required" title="*" value="<?php 
		echo date('d/m/Y');
		?>" <?php  if($_GET['nomor']<>""){ ?>  readonly="true"  <?php  }?> />
          <a href="javascript:showCalendar('tanggal')"><img src="../../assets/kalendar_files/calendar_icon.gif" border="0"></a></td>
    <td width="243">Jenis Pembayaran</td>
    <td width="227">
    <?php if(isset($_GET["id"])){ ?>
    	<input name="jenis_pembayaran" value="<?php echo $datas["jenis_pembayaran"]; ?>" readonly="readonly" />
    <?php } else { ?>
    	<select name="jenis_pembayaran">
      <option value="Tunai" <?php if($datas["jenis_pembayaran"]=="Tunai") { ?> selected="selected" <?php } ?>>Tunai</option>
      <option value="Kredit" <?php if($datas["jenis_pembayaran"]=="Kredit") { ?> selected="selected" <?php } ?>>Kredit</option>
    </select>
    
    <?php } ?></td>
  </tr>
  <tr>
    <td>Nama Pengirim</td>
    <td><input type="text" size="47"  name="nama_pengirim"  value="<?php echo $datas["nama_pengirim"];?>" /></td>
    <td>Nama Penerima</td>
    <td><input type="text" size="47"  name="nama_penerima" value="<?php echo $datas["nama_penerima"];?>" /></td>
  </tr>
  <tr>
    <td valign="top">Alamat Pengirim</td>
    <td><textarea name="alamat_pengirim" cols="35" rows="4"><?php echo $datas["alamat_pengirim"];?></textarea></td>
    <td valign="top">Alamat Penerima</td>
    <td><textarea name="alamat_penerima" cols="35" rows="4"><?php echo $datas["alamat_penerima"];?></textarea></td>
  </tr>
  <tr>
    <td>Telepon Pengirim</td>
    <td><input type="text" size="47"  name="telpon_pengirim" value="<?php echo $datas["telpon_pengirim"];?>"/></td>
    <td>Telepon Penerima</td>
    <td><input type="text" size="47"  name="telepon_penerima"  value="<?php echo $datas["telepon_penerima"];?>" /></td>
  </tr>
  <tr>
    <td>Isi Kiriman</td>
    <td><input type="text" size="47" value="<?php echo $datas["isi_kiriman"];?>"  name="isi_kiriman" /></td>
    <td>Banyak Packing</td>
    <td><input type="text" size="8" value="<?php echo $datas["banyak_barang"];?>"   name="banyak_barang" />
    &nbsp;&nbsp;Satuan Packing <input type="text" size="10" value="<?php echo $datas["satuan_packing"];?>"   name="satuan_packing" /></td>
  </tr>
  <tr>
    <td>Memo Pengirim</td>
    <td><input type="text" size="47"  name="memo_pengirim" value="<?php echo $datas["memo_pengirim"];?>" /></td>
    <td>Biaya Administrasi</td>
    <td><input type="text" size="47"  name="biaya_administrasi"   id="biaya_administrasi"  value="<?php echo isset($_GET["id"])? number_format($datas["biaya_administrasi"]) : "0.0";?>"    onkeyup="hitung();" class="kanan" /></td>
  </tr>
  <tr>
    <td>Daerah Tujuan</td>
    <td><select name="jenis_layanan" id="jenis_layanan" style="width:304px" >
      <option value="">--Pilih--</option>
      <?php
		$SQLL = "SELECT * FROM jenis_layanan WHERE layanan <> ''";
		$hasill = mysql_query($SQLL);
		while($barisl = mysql_fetch_array($hasill)){
	?>
      <option value="<?php echo $barisl["id"]; ?>" <?php if($barisl["id"]==$datas["jenis_layanan"]) { ?> selected="selected" <?php } ?>><?php echo $barisl["layanan"]; ?> 1 <?php echo $barisl["satuan"]; ?> @ <?php echo number_format($barisl["harga"]); ?></option>
      <?php } ?>
    </select></td>
    <td>Biaya Lainnya</td>
    <td><input type="text" size="47"  name="biaya_lainnya" id="biaya_lainnya"  value="<?php echo isset($_GET["id"])? number_format($datas["biaya_lainnya"]) : "0";?>"  class="kanan" onkeyup="hitung();" /></td>
  </tr>
  <tr>
    <td>Harga Kiriman</td>
    <td><input type="text" size="47"   onkeyup="hitung();" name="harga_barang_ttp" id="harga_barang_ttp" value="<?php echo number_format($datas["harga_barang_ttp"]);?>" class="kanan" /></td>
    <td>&nbsp;</td>
    <td><input type="hidden" size="47" readonly="readonly" class="kanan"  id="total_biaya"  value="<?php echo number_format($datas["total_biaya"]);?>"   name="total_biaya" /></td>
  </tr>
  <tr>
    <td>Byk/QTY</td>
    <td><input type="text" class="kananDes" size="25"  name="berat_barang"   id="berat_barang" onkeyup="hitung();"  value="<?php echo isset($_GET["id"])?($datas["berat_barang"]) : "1.0";?>" /> @ <input type="text" name="satuan" id="satuan"   value="<?php echo isset($_GET["id"])?($datas["satuan"]) : "";?>"  size="10" /></td>
    <td>Discount</td>
    <td><input type="text" size="47" class="kanan"  name="discount" id="discount" onkeyup="hitung()"  value="<?php echo number_format($datas["discount"]);?>"    /></td>
  </tr>
  <tr>
    <td>Jumlah Harga Kirim</td>
    <td><input type="text" size="47" class="kanan" readonly="readonly"  name="kubikasi" value="<?php echo number_format($datas["kubikasi"]);?>"   id="kubikasi" /></td>
    <td>Total Biaya Kirim</td>
    <td><input type="text" size="47" class="kanan" readonly="readonly"  id="total_ongkos"  value="<?php echo number_format($datas["total_ongkos"]);?>"     name="total_ongkos" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>
    <?php if(isset($_GET["id"])){ ?>
    <input type="button"  id="edit" value="Update" />
    <input type="button"  id="edit" value="Kembali" onclick="window.history.back()" />
    <?php } else { ?>
    <input type="button" id="submit-form" value="Simpan" />
    <input type="button" id="baru" value="Baru" onclick="no_urut();" />
<input type="button" id="list" value="List" onclick="pindah()"; />    <?php } ?>
<input type="button"  id="print" value="Print" onclick="printing_sa()" /></td>
  </tr>
</table>
</form>