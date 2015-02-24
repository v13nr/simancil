<?php @session_start();

	include "../../otentik.php";
	include "../../config_sistem.php";
	include "../../include/functions.php";
	
	//insert	
	
	if(isset($_GET["action"]) && $_GET["action"]=="add"){
		$sql = "INSERT INTO muatan SET
			notamuatan = '".$_POST["notamuatan"]."',
			nopol = '".$_POST["nopol"]."',
			sopir = '".$_POST["sopir"]."',
			pa = '".$_POST["pa"]."',
			tanggal = '".baliktgl($_POST["tanggal"])."',
			tujuan = '".$_POST["tujuan"]."'
		";
		$hasil = mysql_query($sql) or die(mysql_error());
		$last = mysql_insert_id();
		
		
		//cek jika sudah diinput
		$SQL = "SELECT resi FROM muatan_detail WHERE notamuatan = '". $_POST["notamuatan"] ."' AND resi = '". $_POST["resi"] ."'";
		$hasil = mysql_query($SQL);
		if(mysql_num_rows($hasil)>0){
			die("Data sudah diinputkan.");
		}
	
		$sql = "INSERT INTO muatan_detail SET
			muatan_id = '$last',
			notamuatan = '".$_POST["notamuatan"]."',
			resi = '".$_POST["resi"]."'
		";
		$hasil = mysql_query($sql) or die(mysql_error());
		
	}
	
	
		
	//edit header
	if(isset($_GET["action"]) && $_GET["action"]=="edit"){
		$sql = "UPDATE muatan SET
			notamuatan = '".$_POST["notamuatan"]."',
			nopol = '".$_POST["nopol"]."',
			angkutan_id = '".$_POST["angkutan_id"]."',
			sopir = '".$_POST["sopir"]."',
			pa = '".$_POST["pa"]."',
			tanggal = '".baliktgl($_POST["tanggal"])."',
			tujuan = '".$_POST["tujuan"]."'
		";
		$hasil = mysql_query($sql) or die(mysql_error());		
	}
	
	//insert biaya
	if(isset($_GET["action"]) && $_GET["action"]=="add_biaya"){
			$jumlah = ereg_replace("[^0-9.]", "", $_POST['jum_biaya']);
				$SQL = "INSERT INTO $database.jurnal_srb(id, tipe_jurnal, muatan_id, tanggal, jenis, kd, kk, ket, ket2, jumlah, karyawan_id, dollar, sub, divisi, nobukti, bulan, user_id) VALUES (
				'',
				'JPB',
				'".$_POST["notamuatan"]."',
				'".baliktgl($_POST['tanggal'])."',
				'Kredit',
				'BA1-5324',
				'AL1-1111',
				'".$_POST['ket_biaya']."',
				'Kas Untuk Biaya Pengiriman',
				'".$jumlah."',
				'$karyawan_id',
				'".$_POST['dollar']."',
				'$tipe',
				'".$_POST['divisi']."',
				'JPB". $_POST["notamuatan"] ."-K',
				'$bulan',
				'".$_SESSION["sess_user_id"]."'
				)";
		
		$hasil = mysql_query($SQL) or die(mysql_error());
		
	}
	
	//insert pemasukan
	if(isset($_GET["action"]) && $_GET["action"]=="add_pemasukan"){
			$jumlah = ereg_replace("[^0-9.]", "", $_POST['jum_pemasukan']);
				$SQL = "INSERT INTO $database.jurnal_srb(id, tipe_jurnal, muatan_id, tanggal, jenis, kd, kk, ket, ket2, jumlah, karyawan_id, dollar, sub, divisi, nobukti, bulan, user_id) VALUES (
				'',
				'JPB',
				'".$_POST["notamuatan"]."',
				'".baliktgl($_POST['tanggal'])."',
				'Debet',
				'AL1-1111',
				'BA1-5324',
				'Kas',
				'".$_POST['ket_pemasukan']."',
				'".$jumlah."',
				'$karyawan_id',
				'".$_POST['dollar']."',
				'$tipe',
				'".$_POST['divisi']."',
				'JPB". $_POST["notamuatan"] ."-D',
				'$bulan',
				'".$_SESSION["sess_user_id"]."'
				)";
		
		$hasil = mysql_query($SQL) or die(mysql_error());
		
	}
	
	
	//delete
	if(isset($_GET["cmd"]) && $_GET["cmd"] == "delete"){
		$sql = "DELETE FROM muatan_detail WHERE
			id = '".$_GET["id_detail"]."'
		";
		$hasil = mysql_query($sql) or die(mysql_error());
	}
	//delete jurnal
	if(isset($_GET["cmd"]) && $_GET["cmd"] == "delete_jurnal"){
		$sql = "DELETE FROM jurnal_srb WHERE
			id = '".$_GET["id_detail"]."'
		";
		$hasil = mysql_query($sql) or die(mysql_error());
	}
?>

<script type="text/javascript" src="../../assets/jquery.js"></script>
<script src="../../assets/jquery.loader.js"></script>
<link href="../../assets/jquery.loader.css" rel="stylesheet" /></script>
<link rel='stylesheet' type='text/css' href='../../assets/jquery.autocomplete.css'/>
    <script type='text/javascript' src='../../assets/jquery.autocomplete.js'></script>
    <script type='text/javascript' src='../../assets/localdata.js'></script>
<script type="text/javascript" src="../../assets/kalendar_files/jsCalendar.js"></script>
<link href="../../assets/kalendar_files/calendar.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
function validasi(){
	if ( $('#notamuatan').val()==""){
			alert("Nomer Nota  Harus Terisi. Klik Baru Dahulu.");
				//document.pengiriman-form.norm.focus();
				return false;
		}	
}
$().ready(function() {
	
	
	//simpan
    $("#submit-form").click(function(){
		if ( $('#notamuatan').val()==""){
			alert("Nomer Nota Harus Terisi. Klik Baru Dahulu.");
				//document.pengiriman-form.norm.focus();
				return false;
		}		
		if ( $('#tanggal').val()==""){
			alert("Tanggal Harus Terisi. ");
				//document.pengiriman-form.norm.focus();
				return false;
		}
		$.loader({content:"<div>Mengirim Data Ke Server ...</div>"});
         $.ajax({
           url : "daftar_muatan.php?action=add", 
           type: "post", //form method
           data: $("#frmijin").serialize(),
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
			 window.location.href = "daftar_muatan.php?id="+$('#notamuatan').val();
			  
			 //$(":input").not(":button,:button, :submit, :reset, :hidden").each( function() {
					//this.value = this.defaultValue;     
				//}); //reset
	
           },
           error: function(xhr, Status, err) {
			 $.loader('close');
             alert("Terjadi error : "+Status);
           }
         });
       return false;
     })
	 
	 
	 //edit
    $("#submit-form-edit").click(function(){
		if ( $('#notamuatan').val()==""){
			alert("Nomer Nota Harus Terisi. Klik Baru Dahulu.");
				//document.pengiriman-form.norm.focus();
				return false;
		}		
		if ( $('#tanggal').val()==""){
			alert("Tanggal Harus Terisi. ");
				//document.pengiriman-form.norm.focus();
				return false;
		}
		$.loader({content:"<div>Mengirim Data Ke Server ...</div>"});
         $.ajax({
           url : "daftar_muatan.php?action=edit", 
           type: "post", //form method
           data: $("#frmijin").serialize(),
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
			 window.location.href = "daftar_muatan.php?id="+$('#notamuatan').val();
			  
			 //$(":input").not(":button,:button, :submit, :reset, :hidden").each( function() {
					//this.value = this.defaultValue;     
				//}); //reset
	
           },
           error: function(xhr, Status, err) {
			 $.loader('close');
             alert("Terjadi error : "+Status);
           }
         });
       return false;
     })
	 
	 
	 
	//simpan biaya
    $("#submit-form-biaya").click(function(){
		if ( $('#notamuatan').val()==""){
			alert("Nomer Nota Harus Terisi. Klik Baru Dahulu.");
				//document.pengiriman-form.norm.focus();
				return false;
		}
		if ( $('#tanggal').val()==""){
			alert("Tanggal Harus Terisi. ");
				//document.pengiriman-form.norm.focus();
				return false;
		}
		$.loader({content:"<div>Mengirim Data Ke Server ...</div>"});
         $.ajax({
           url : "daftar_muatan.php?action=add_biaya", 
           type: "post", //form method
           data: $("#frmijin").serialize(),
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
			 window.location.href = "daftar_muatan.php?id="+$('#notamuatan').val();
			  
			 //$(":input").not(":button,:button, :submit, :reset, :hidden").each( function() {
					//this.value = this.defaultValue;     
				//}); //reset
	
           },
           error: function(xhr, Status, err) {
			 $.loader('close');
             alert("Terjadi error : "+Status);
           }
         });
       return false;
     })
	 
	
	//simpan pemasukan
    $("#submit-form-pemasukan").click(function(){
		if ( $('#notamuatan').val()==""){
			alert("Nomer Nota Harus Terisi. Klik Baru Dahulu.");
				//document.pengiriman-form.norm.focus();
				return false;
		}
		if ( $('#tanggal').val()==""){
			alert("Tanggal Harus Terisi. ");
				//document.pengiriman-form.norm.focus();
				return false;
		}
		$.loader({content:"<div>Mengirim Data Ke Server ...</div>"});
         $.ajax({
           url : "daftar_muatan.php?action=add_pemasukan", 
           type: "post", //form method
           data: $("#frmijin").serialize(),
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
			 window.location.href = "daftar_muatan.php?id="+$('#notamuatan').val();
			  
			 //$(":input").not(":button,:button, :submit, :reset, :hidden").each( function() {
					//this.value = this.defaultValue;     
				//}); //reset
	
           },
           error: function(xhr, Status, err) {
			 $.loader('close');
             alert("Terjadi error : "+Status);
           }
         });
       return false;
     })
	 
	
	
	
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
	nilaix = "<?php  echo $_SESSION["sess_tipe"]?>";

	$("#ppk").autocomplete("autocomp.php?divisi="+nilaix+"&tipe=resi", {
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
			var str = data[1];
			var res = str.split("-"); 
			$("#resi").val(res[0]);
			// -----
	});
	
	$("#nopol").autocomplete("autocomp.php?divisi="+nilaix+"&tipe=armada", {
		width: 300,
		max: 20,
		matchContains: true,
		formatResult: function(row) {
			return row[0];
		}
	});
	$("#nopol").result(function(event, data, formatted) {
		if (data)
			$(this).parent().next().find("input").val(data[1]);
			//--- plus
			var str = data[1];
			var res = str.split("-"); 
			$("#angkutan_id").val(res[0]);
			$("#sopir").val(res[1]);
			$("#nopol").val(res[2]);
			// -----
	});

	

});

function kosongtext(){
	document.frmijin.ppk.value = "";
	document.frmijin.resi.value = "";
}
function kosongtextArmada(){
	document.frmijin.nopol.value = "";
	document.frmijin.angkutan_id.value = "";
}
function kosongtextarray(){
	$('input[@name=text_array]').click(
	function(){
	  $(this).val('');
	}
  );
}

	function no_urut(){
		var response = '';
		$.ajax({ type: "GET",   
				 url: "no.php?q=jogjaide_muatan",   
				 async: false,
				 success : function(text)
				 {
					 response = text;
				 }
		});
		
		//$('#notamuatan').val(response);
		window.location.href = "daftar_muatan.php?id="+response;
		}	
		
</script>
<style type="text/css">
.rowTengah {
	text-align: center;
}
.rowKanan {
	text-align: right;
}
.rowKiri {
	text-align: left;
}
</style>
<form name="frmijin" id="frmijin" method="post" action="daftar_muatan.php" onsubmit="validasi(); return false;">
<input type="hidden" name="cmd" value="add" /><span class="loading"></span><div id="test3response"></div>
  <?php 
  	$SQLe = "SELECT * FROM muatan WHERE notamuatan = '". $_GET["id"] ."'";
	$hasile = mysql_query($SQLe) or die(mysql_error());
	$barise = mysql_fetch_array($hasile);
  
  ?>
<table width="1000px" border="0" align="center">
  <tr class="rowKanan">
    <td>No Nota :</td>
    <td align="left"><input type="text" name="notamuatan" id="notamuatan" size="40" readonly="readonly" value="<?php echo isset($_GET["id"]) ? $_GET["id"] : ""; ?>" /></td>
    <td>PA :</td>
    <td align="left"><input type="text" name="pa" id="pa" size="40"  value="<?php echo $barise["pa"]; ?>" /></td>
  </tr>

  <tr class="rowTengah">
    <td class="rowKanan">Nopol :</td>
    <td align="left"><input type="text" name="nopol" id="nopol" size="40"  value="<?php echo $barise["nopol"]; ?>" onclick="kosongtextArmada()" /><input type="hidden" name="angkutan_id"  id="angkutan_id" value="" /></td>
    <td class="rowKanan">Tanggal Berangkat :</td>
    <td align="left"><input type="text" name="tanggal" id="tanggal" size="40" value="<?php echo baliktglindo($barise["tanggal"]); ?>" /><a href="javascript:showCalendar('tanggal')"><img src="../../assets/kalendar_files/calendar_icon.gif" border="0"></a></td>
  </tr>
  <tr class="rowTengah">
    <td width="196" class="rowKanan">Sopir :</td>
    <td width="296" align="left"><input type="text" name="sopir" id="sopir" size="40"  value="<?php echo $barise["sopir"]; ?>" /></td>
    <td width="180" class="rowKanan">Tujuan :</td>
    <td width="310" align="left"><input type="text" name="tujuan" id="tujuan" size="40"   value="<?php echo $barise["tujuan"]; ?>"/></td>
  </tr>
  <tr class="rowTengah">
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr class="rowTengah">
    <td colspan="4" class="rowTengah">DAFTAR MUATAN</td>
  </tr>
  <tr class="rowTengah">
    <td colspan="4" class="rowTengah"><table width="100%" border="1" style="border-collapse:collapse">
      <tr>
        <td colspan="6">&nbsp;
          <input type="text" name="resisearch" id="ppk" size="50" onclick="kosongtext()"  />
          &nbsp;<input name="resi" type="text" id="resi" value="" size="18" readonly="readonly" class="required" title="Kode Resi Harus Terisi !"/>
          
<?php if(isset($_GET["cmd"]) && $_GET["cmd"] == "edit") { ?>
          <input type="button" name="submit-form-edit"
value="Update" id="submit-form-edit" /><?php } else { ?>
<input type="button" name="tambah"
value="Tambah" id="submit-form" />
<?php } ?>
<input type="button" id="baru" value="Baru" onclick="no_urut();" /></td>
        </tr>
      <tr bgcolor="#CCCCCC" class="rowTengah">
        <td width="19%">No Expedisi</td>
        <td width="15%">Pengirim</td>
        <td width="38%">Daerah Penerima</td>
        <td width="9%">Qty Barang</td>
        <td width="11%">Cara Bayar</td>
        <td width="8%">#</td>
      </tr>
      <?php
	  	$SQL = "SELECT * FROM muatan_detail WHERE notamuatan = '".$_GET["id"]."'";
		$hasil = mysql_query($SQL) or die(mysql_error());
		while($baris=mysql_fetch_array($hasil)){
	  ?>
      <tr>
        <td align="center"><?php echo $baris["resi"];?></td>
        <?php
			$sqlr = "SELECT * FROM expedisi where nonota = '".$baris["resi"]."'";
			$hasilr = mysql_query($sqlr);
			$barisr = mysql_fetch_array($hasilr);
		?>
        <td><?php echo $barisr["nama_pengirim"];?></td>
        <td><?php echo $barisr["alamat_penerima"];?></td>
        <td align="center"><?php echo $barisr["banyak_barang"];?></td>
        <td align="center"><?php echo $barisr["jenis_pembayaran"];?></td>
        <td align="center"><a href="daftar_muatan.php?cmd=delete&id=<?php echo $_GET["id"];?>&id_detail=<?php echo $baris["id"];?>" >Hapus</a></td>
      </tr>
      <?php
	  
		}
		
		?>
    </table></td>
  </tr>
  <tr class="rowTengah">
    <td colspan="2" class="rowTengah">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr class="rowTengah">
    <td colspan="2" class="rowTengah">BIAYA BIAYA</td>
    <td colspan="2">PEMASUKAN / FRANCO</td>
  </tr>
  <tr>
    <td colspan="2" valign="top"><table width="100%" border="1" style="border-collapse:collapse">
      <tr>
        <td width="14%">&nbsp;</td>
        <td width="55%"><input type="text" name="ket_biaya" id="ket_biaya" size="40" /></td>
        <td width="15%"><input type="text" name="jum_biaya" id="jum_biaya" size="20" /></td>
        <td width="16%"><input type="button"  id="submit-form-biaya"
value="Tambah" /></td>
      </tr>
      <tr bgcolor="#CCCCCC" class="rowTengah">
        <td>No.</td>
        <td>Keterangan</td>
        <td>Jumlah</td>
        <td>#</td>
      </tr>
      <?php
	  	$sqljurnal = "SELECT * FROM jurnal_srb WHERE muatan_id = '".$_GET["id"]."' AND kk = 'AL1-1111'"; 
		$hasiljurnal = mysql_query($sqljurnal);
		while($barisjunal = mysql_fetch_array($hasiljurnal)){
	  ?>
      <tr>
        <td align="center"><?php echo ++$no; ?>.</td>
        <td><?php echo ($barisjunal["ket"]);?></td>
        <td align="right"><?php echo number_format($barisjunal["jumlah"]);?></td>
        <td align="center"><a href="daftar_muatan.php?cmd=delete_jurnal&id=<?php echo $_GET["id"];?>&id_detail=<?php echo $barisjunal["id"];?>" >Hapus</a></td>
      </tr>
      <?php } ?>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
    <td colspan="2" valign="top"><table width="100%" border="1" style="border-collapse:collapse">
      <tr>
        <td width="14%">&nbsp;</td>
        <td width="55%"><input type="text" name="ket_pemasukan" id="ket_pemasukan" size="40" /></td>
        <td width="15%"><input type="text" name="jum_pemasukan" id="jum_pemasukan" size="20" /></td>
        <td width="16%"><input type="button"  id="submit-form-pemasukan"
value="Tambah" /></td>
      </tr>
      <tr bgcolor="#CCCCCC" class="rowTengah">
        <td>No.</td>
        <td>Keterangan</td>
        <td>Jumlah</td>
        <td>#</td>
      </tr>
      <?php
	  	$idMuatan = isset($_GET["id"])?$_GET["id"]:"-1";
	  	$sqljurnal = "SELECT * FROM jurnal_srb WHERE muatan_id = '". $idMuatan ."' AND kd = 'AL1-1111'"; 
		$hasiljurnal = mysql_query($sqljurnal) or die($sqljurnal);
		while($barisjunal = mysql_fetch_array($hasiljurnal)){
	  ?>
      <tr>
        <td align="center"><?php echo ++$no2; ?>.</td>
        <td><?php echo ($barisjunal["ket2"]);?></td>
        <td align="right"><?php echo number_format($barisjunal["jumlah"]);?></td>
        <td align="center"><a href="daftar_muatan.php?cmd=delete_jurnal&id=<?php echo $_GET["id"];?>&id_detail=<?php echo $barisjunal["id"];?>" >Hapus</a></td>
      </tr>
      <?php } ?>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
</form>