<?php  include "otentik_gli.php"; 



cekAkses($_SESSION["sess_user_id"], 'inventaris_ls');


?><head>
 
	<script type="text/javascript" src="../assets/jquery-1.2.3.pack.js"></script>
<script type="text/javascript" src="../assets/jquery.validate.pack.js"></script>
 <script language="javascript" src="../assets/thickbox/thickbox.js"></script>
 <link href="../assets/thickbox/thickbox.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="../assets/kalendar_files/jsCalendar.js"></script>
<link href="../assets/kalendar_files/calendar.css" rel="stylesheet" type="text/css">
 
 <script type="text/javascript">

$(document).ready(function(){
	
		$("#pegForm").validate({
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
});
	
</script>

  <script type="text/javascript">

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
			
  $('input[@name=norek]').blur( // beri event pada saat onBlur inputan kode pegawai
	function(){		
		$('#divAlert').text('');		
	  var vNIP = $(this).val();
	  $.get('../include/cari.php?cari=rekening&mode=rekp',{id: vNIP},
		function(nama_pegawai){
		  // jika response tidak kosong nilainya maka masukkan nilai ke inputan nama pegawai
		  if(nama_pegawai.length > 0){ 
			$('input[@name=namarek]').val(nama_pegawai);	
		  }else {
		   $('#divAlert').text('No Rekening dengan Kode "'+vNIP+'" Tidak Ditemukan').css('color','red');
		   $('input[@name=norek]').val('');
		   $('input[@name=namarek]').val('');
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
	function hitungSusut(){
		nilai = clearNum(document.getElementById("nilai").value) * 1;
		bagi = clearNum(document.getElementById("bagi").value) * 1;
		tarif = clearNum(document.getElementById("tarif").value) * 1;
		susut = nilai / 1 * tarif / 100;
		document.getElementById("susut").value = formatCurrency(susut);
		document.getElementById("tarif").value = 100/bagi;
	}
	
</script>

 <script type="text/javascript">
 function selectBuku(no, nama, tipe){
  $('input[@name=induk]').val(no);
  $('input[@name=namarekeninginduk]').val(nama);
  $('input[@name=tipe]').val(tipe);
  //tb_remove(); // hilangkan dialog thickbox
}
 </script>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /><style type="text/css">
<!--
body {
	background-image: url(../images/bg2.png);
}
-->
</style></head>

<style type="text/css">
* { font: 11px/20px Verdana, sans-serif; }
h4 { font-size: 18px; }
input { padding: 3px; border: 1px solid #999; }
input.error, select.error { border: 1px solid red; }
label.error { color:red; margin-left: 10px; }
td { padding: 5px; }
.style1 {
	color: #000000;
	font-family: "Segoe UI";
	font-size: 12;
}
.style2 {font-family: "Segoe UI"}
.style6 {font-family: "Segoe UI"; font-size: 12; }
.style7 {font-size: 12}
.style9 {
	font-family: "Segoe UI";
	font-size: 12px;
	font-weight: bold;
	color: #0000FF;
}
input.kanan{ text-align:right; }
</style>
<?php  
	include "../include/globalx.php";
	include "../include/functions.php";
?>
  <?php  $SQL = "select * from $database.aktiva WHERE status = 1";
	 	if ($_GET['id']<>"")
		{ 
			$SQL = $SQL." AND id = ". $_GET['id'];
		}
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		if($_GET['id']<>""){
			while ($baris=mysql_fetch_array($hasil)) {
				$id = $baris['id'];
				$tgl = $baris['tgl'];
				$nama = $baris['nama'];
				$nilai = $baris['nilai'];
				$bagi = $baris['bagi'];
				$susut = $baris['susut'];
				$tarif = $baris['tarif'];
				$tgl_akhir = $baris['tgl_akhir'];
				$rekdebet = $baris['rekdebet'];
				$rekkredit = $baris['rekkredit'];
			}	
		}
	?>
<table width="1140" border="0">
  <tr>
    <td width="40"><img src="../images/vcard_add.png" width="32" height="32" /></td>
    <td width="1090"><span class="style9">FORM INVENTARIS
      </span>
      <hr /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><form id="pegForm" method="post" name="pegForm" action="submission_gli.php">
      <?php  if($_GET['id']<>""){ ?>
      <input type="hidden" name="cmd" value="upd_inv" />
      <input type="hidden" name="id" value="<?php  echo $id?>" />
      <?php  } else { ?>
      <input type="hidden" name="cmd" value="add_inv" />
      <?php  } ?>
      <table align="left" class="x1">
        <tr background="../images/impactg.png" height="30">
          <td colspan="3" align="center"><span class="style1">Form Inventaris </span></td>
        </tr>
        <tr>
          <td><span class="style6">Tanggal Beli  </span></td>
          <td>:</td>
          <td><input type="text" name="tgl" id="tgl" size="10" class="required" title="Harap Mengisi Tanggal Beli Dahulu" <?php  if($_GET['id']<>""){?> value="<?php  echo baliktglindo($tgl)?>" <?php  }?>/>
            <a href="javascript:showCalendar('tgl')"><img src="../assets/kalendar_files/calendar_icon.gif" border="0" /></a><a href="daftar_rek.php?width=400&amp;height=350&amp;TB_iframe=true" class="thickbox"></a>
            <div id="divAlert"></div></td>
        </tr>
        <tr>
          <td><span class="style6">Nama Barang </span></td>
          <td>:</td>
          <td><input name="nama" size="40" type="text" class="required " id="nama"  title="Nama Barang harus terisi" value="<?php  echo $nama?>" /></td>
        </tr>
        <tr>
          <td><span class="style6">Nilai</span></td>
          <td><span class="style6">:</span></td>
          <td><input type="text" name="nilai" id="nilai" class="required kanan"  onkeyup="hitungSusut()" title="Nilai harus terisi" value="<?php  echo $nilai?>" /></td>
        </tr>
        <tr> 
          <td><span class="style6">Umur Ekonomis (Thn)  </span></td>
          <td><span class="style6">:</span></td>
          <td><input name="bagi" type="text" id="bagi" maxlength="3" onkeyup="hitungSusut()" class="required " title="Bagi per Bulan harus diisi" value="0"/></td>
        </tr>
		<tr>
          <td>Tarif</td>
          <td>:</td>
          <td><input type="text" name="tarif" id="tarif"  onkeyup="hitungSusut()" readonly="true" title="Nilai harus terisi" value="<?php  echo $tarif?>" /></td>
        </tr>
        
        <tr>
          <td><span class="style6">Penyusutan / Tahun </span></td>
          <td><span class="style6">:</span></td>
          <td><input name="susut" type="text" class="required kanan" id="susut" readonly="true"   title="Nilai Susut harus diisi" value="<?php  echo $susut?>" / ></td>
        </tr>
		<tr>
          <td><span class="style6">Ay Jr. Perolehan Aktiva : (D)</span> </td>
          <td>:</td>
          <td><select name="rekdebet" class="required" title="*" >
              <option value="">-Pilih-</option>
              <?php 
				$SQL = "SELECT * FROM $database.rekening WHERE substr(norek, -3) <> '000' ORDER BY norek";
				$hasil = mysql_query($SQL, $dbh_jogjaide);
				while($baris = mysql_fetch_array($hasil)){
			?>
              <option value="<?php  echo $baris['norek']?>" <?php  if($rekdebet == $baris['norek']){?>selected="selected" <?php  }?>>
              <?php  echo $baris['norek']?>
                -
                <?php  echo $baris['namarek']?>
              </option>
              <?php  } ?>
            </select>
          </td>
        </tr>
        <tr>
          <td><span class="style6">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(K)</span> </td>
          <td>:</td>
          <td><select name="rekkredit" class="required" title="*" >
              <option value="">-Pilih-</option>
              <?php 
				$SQL = "SELECT * FROM $database.rekening WHERE substr(norek, -3) <> '000' ORDER BY norek";
				$hasil = mysql_query($SQL, $dbh_jogjaide);
				while($baris = mysql_fetch_array($hasil)){
			?>
              <option value="<?php  echo $baris['norek']?>"  <?php  if($rekkredit == $baris['norek']){?>selected="selected" <?php  }?>>
              <?php  echo $baris['norek']?>
                -
                <?php  echo $baris['namarek']?>
              </option>
              <?php  } ?>
            </select>
          </td>
        </tr>
        <tr>
          <td><span class="style6">Penyusutan : (D)</span>Beban</td>
          <td>:</td>
          <td><select name="rek_d_bbsusut" class="required" title="*" >
              <option value="">-Pilih-</option>
              <?php 
				$SQL = "SELECT * FROM $database.rekening WHERE substr(norek, -3) <> '000' ORDER BY norek";
				$hasil = mysql_query($SQL, $dbh_jogjaide);
				while($baris = mysql_fetch_array($hasil)){
			?>
              <option value="<?php  echo $baris['norek']?>" <?php  if($rekdebet == $baris['norek']){?>selected="selected" <?php  }?>>
              <?php  echo $baris['norek']?>
                -
                <?php  echo $baris['namarek']?>
              </option>
              <?php  } ?>
            </select>
          </td>
        </tr>
        <tr>
          <td><span class="style6">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(K)Akm.</span></td>
          <td>:</td>
          <td><select name="rek_k_akmsusut" class="required" title="*" >
              <option value="">-Pilih-</option>
              <?php 
				$SQL = "SELECT * FROM $database.rekening WHERE substr(norek, -3) <> '000' ORDER BY norek";
				$hasil = mysql_query($SQL, $dbh_jogjaide);
				while($baris = mysql_fetch_array($hasil)){
			?>
              <option value="<?php  echo $baris['norek']?>"  <?php  if($rekkredit == $baris['norek']){?>selected="selected" <?php  }?>>
              <?php  echo $baris['norek']?>
                -
                <?php  echo $baris['namarek']?>
              </option>
              <?php  } ?>
            </select>
          </td>
        </tr>
        
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><span class="style7"></span></td>
          <td><span class="style7"></span></td>
          <td><span class="style6">
            <?php  if($_GET['id']<>""){ ?>
            <input name="submit" type="submit" value="Update" />
            <?php  } else { ?>
            <input name="submit" type="submit" value="Simpan" />
            <?php  } ?>
            <input name="button" type="button" onClick="javascript:history.back()" value="Batal" />
          </span></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>
