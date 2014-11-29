<?php  include "otentik_inv.php"; ?><head>
 
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
	  $.get('../include/cari.php?cari=rekening&mode=induk',{id: vNIP},
		function(nama_pegawai){
		  // jika response tidak kosong nilainya maka masukkan nilai ke inputan nama pegawai
		  if(nama_pegawai.length > 0){ 
			$('input[@name=namarekeninginduk]').val(nama_pegawai);	
		  }else {
		   $('#divAlert').text('No Rekening dengan Kode "'+vNIP+'" Tidak Ditemukan').css('color','red');
		   $('input[@name=norek]').val('');
		   $('input[@name=namarekeninginduk]').val('');
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
 function selectBuku(no, nama, tipe){
  $('input[@name=norek]').val(no);
  $('input[@name=namarekeninginduk]').val(nama);
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
  <?php  
    $SQL = "select * from bahanjadi WHERE kode = '". $_GET['id']."'";

    $hasil = mysql_query($SQL, $dbh_jogjaide);

    while ($baris=mysql_fetch_array($hasil)) {
        $id = $_GET['id'];
        $namabrg = $baris['nama'];
        $satuan = $baris['satuan'];
        $isi = $baris['qty'];
        $kemasan = $baris['kemasan'];
    }	
	?>
<table width="1140" border="0">
  <tr>
    <td width="40"><img src="../images/vcard_add.png" width="32" height="32" /></td>
    <td width="1090"><span class="style9">FORM BAHAN JADI
      </span>
      <hr /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><form id="pegForm" method="post" name="pegForm" action="submission_inv.php">
      <?php  if($_GET['id']<>""){ ?>
      <input type="hidden" name="cmd" value="upd_bj" />
      <input type="hidden" name="id" value="<?php  echo $id?>" />
      <?php  } else { ?>
      <input type="hidden" name="cmd" value="add_bj" />
      <?php  } ?>
      <table align="left" class="x1">
        <tr background="../images/impactg.png" height="30">
          <td colspan="3" align="center"><span class="style1">Form Bahan Jadi </span></td>
        </tr>
        <tr>
          <td><span class="style6">Kode</span></td>
          <td>:</td>
          <td><input type="text" name="kode" id="kodebrg" size="10" maxlength="6" class="required" title="Harap Mengisi Kode Barang Dahulu" value="<?php  echo ($id)?>"/>            </td>
        </tr>
        <tr>
          <td><span class="style6">Nama Barang  </span></td>
          <td>:</td>
          <td><input name="namabrg" size="40" type="text" class="required " id="namabrg"  title="Nama Barang harus terisi" value="<?php  echo $namabrg?>" /></td>
        </tr>
        <tr>
          <td><span class="style6">Satuan</span></td>
          <td><span class="style6">:</span></td>
          <td><input type="text" name="satuan" id="satuan" class="required" title="Satuan harus terisi" value="<?php  echo $satuan?>" /></td>
        </tr>
        <tr> 
          <td><span class="style6">Isi  </span></td>
          <td><span class="style6">:</span></td>
          <td><input name="isi" type="text" id="isi"  class="required kanan" title="Isi harus diisi" value="<?php  echo $isi?>" /></td>
        </tr>
        <tr>
          <td><span class="style6">Kemasan </span></td>
          <td><span class="style6">:</span></td>
          <td>
              <select name="kemasan" class="required" title="Kemasan harus dipilih">
                  <option value="">-Pilih-</option>
                  <option value="Y" <?php if($kemasan=="Y"){?> selected="selected"<?php }?>>Y</option>
                  <option value="T" <?php if($kemasan=="T"){?> selected="selected"<?php }?>>T</option>
              </select>
          </td>
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
