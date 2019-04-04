<?php  @session_start(); include "otentik_admin.php"; ?><head>
<?php  
	include "../../../config_sistem.php";
	include "../include/functions.php";
?>
  <?php  $SQL = "select * from stock WHERE kodebrg <> ''";
	 	if ($_GET['id']<>"")
		{ 
			$SQL = $SQL." AND kodebrg = '". $_GET['id']."'";
		}
		//die($SQL);
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		if($_GET['id']<>""){
			while ($baris=mysql_fetch_array($hasil)) {
				$id = $_GET['id'];
				$namabrg = $baris['namabrg'];
				$satuank = $baris['satuank'];
				$isi = $baris['isi'];
				$satuanb = $baris['satuanb'];
				$group = $baris['grup'];
				$modal = $baris['modal'];
				$divisi = $baris['divisi'];
                $expedisi = $baris['expedisi'];
				$hargaeceran = $baris['hargaeceran'];
				$hargapartai = $baris['hargapartai'];
				$tarif = $baris['tarif'];
				$supplier_id = $baris['supplier_id'];
				$level_1 = $baris['level_1'];
				//die($level_1);
				$level_2 = $baris['level_2'];
				$level_3 = $baris['level_3'];
				$level_4 = $baris['level_4'];
				$level_5 = $baris['level_5'];
					$SQLc = "SELECT nama FROM supplier WHERE kode = '$supplier_id' AND status = 1";
					$hasilc = mysql_query($SQLc);
					$barisc = mysql_fetch_array($hasilc);
					$namaSupp = $barisc[0];
			}	
		}
	?> 


<script type="text/javascript" src="../assets/jquery.validate.pack.js"></script>
 <script language="javascript" src="../assets/thickbox/thickbox.js"></script>
 <link href="../assets/thickbox/thickbox.css" rel="stylesheet" type="text/css" />j
 <script type="text/javascript" src="../assets/kalendar_files/jsCalendar.js"></script>
<link href="../assets/kalendar_files/calendar.css" rel="stylesheet" type="text/css">
<script src="../../../assets/jquery-3.2.1.slim.min.js"></script>
<script src="../../../assets/bootstrap.min.js"></script>
<link href="../../../assets/bootstrap.min.css" rel="stylesheet">
  <script type="text/javascript" src="../../../assets/jquery.min.js"></script>
  <script>
  
  function tambahJenjang(){
    str = $("#labeljenjang").val();
    var str1 = str.trim();
    var n = str1.length;
    if(n<1){

      alert("Silahkan isi data denga benar");
      return false;

    }

    $.ajax({
        url: "../../../mysqli/api/tes.php", 
        dataType: "json",
        type: "post",
        data: $(".sending").serialize(),
        success: function(result){
          alert(result.pesan);
          $("#labeljenjang").val('');
          reloadjenjang();
          reloadjenjang2();
          reloadjenjang3();
          reloadjenjang4();
      }
    });
  }

  
  function tambahJenjang2(){
    str = $("#labeljenjang2").val();
    var str1 = str.trim();
    var n = str1.length;
    if(n<1){

      alert("Silahkan isi data denga benar");
      return false;

    }

    $.ajax({
        url: "../../../mysqli/api/jenjang2.php", 
        dataType: "json",
        type: "post",
        data: {
                jenjang2: $("#labeljenjang2").val(),
                parent: $("#jenjang1").val()

              },
        success: function(result){
          alert(result.pesan);
          $("#labeljenjang2").val('');
          reloadjenjang2();
          reloadjenjang3();
          reloadjenjang4();
      }
    });
  }

  
  function tambahJenjang3(){
    str = $("#labeljenjang3").val();
    var str1 = str.trim();
    var n = str1.length;
    if(n<1){

      alert("Silahkan isi data denga benar");
      return false;

    }

    $.ajax({
        url: "../../../mysqli/api/jenjang2.php", 
        dataType: "json",
        type: "post",
        data: {
                jenjang2: $("#labeljenjang3").val(),
                parent: $("#jenjang2").val()

              },
        success: function(result){
          alert(result.pesan);
          $("#labeljenjang3").val('');
          reloadjenjang3();
          reloadjenjang4();
      }
    });
  }


  
  function tambahJenjang4(){
    str = $("#labeljenjang4").val();
    var str1 = str.trim();
    var n = str1.length;
    if(n<1){

      alert("Silahkan isi data denga benar");
      return false;

    }

    $.ajax({
        url: "../../../mysqli/api/jenjang2.php", 
        dataType: "json",
        type: "post",
        data: {
                jenjang2: $("#labeljenjang4").val(),
                parent: $("#jenjang3").val()

              },
        success: function(result){
          alert(result.pesan);
          $("#labeljenjang4").val('');
          reloadjenjang4();
      }
    });
  }


  
  function tambahJenjang5(){
    str = $("#labeljenjang5").val();
    var str1 = str.trim();
    var n = str1.length;
    if(n<1){

      alert("Silahkan isi data denga benar");
      return false;

    }

    $.ajax({
        url: "../../../mysqli/api/jenjang2.php", 
        dataType: "json",
        type: "post",
        data: {
                jenjang2: $("#labeljenjang5").val(),
                parent: $("#jenjang4").val()

              },
        success: function(result){
          alert(result.pesan);
          $("#labeljenjang5").val('');
          reloadjenjang5();
      }
    });
  }

  function statenol(){
    
          $("#jenjang1").empty();

          $('#jenjang1').append($('<option></option>').val('-1').html('0'));
    
          $("#jenjang2").empty();

          $('#jenjang2').append($('<option></option>').val('-1').html('0'));
    
          $("#jenjang3").empty();

          $('#jenjang3').append($('<option></option>').val('-1').html('0'));
  }

$(document).ready(function(){
    reloadjenjang();
    reloadjenjang2();
    reloadjenjang3();
    reloadjenjang4();
});


  function reloadjenjang(){
          $("#jenjang1").empty();

          $('#jenjang1').append($('<option></option>').val('-1').html('0'));

          $.ajax({
              url: "../../../mysqli/api/jenjang1_list.php", 
              dataType: "json",
              type: "get",
              data: {},
              success: function(respose){
                 $.each(respose, function(i, item) 
                {
                   // var option=$('<option val="'+item.id+'"></option>').text(item.label);
                    $('#jenjang1').append($('<option></option>').val(item.id).html(item.label));
						$('#jenjang1').val(<?php echo $level_1;?>);
						$("#jenjang1").trigger('change');
                });

                 //statenol();
            }
          });


  }
  
  function reloadjenjang2(){
          $("#jenjang2").empty();

          $('#jenjang2').append($('<option></option>').val('-1').html('0'));

          $.ajax({
              url: "../../../mysqli/api/jenjang2_list.php", 
              dataType: "json",
              type: "get",
              data: {
                parent: $("#jenjang1").val(),
              },
              success: function(respose){
                 $.each(respose, function(i, item) 
                {
                   // var option=$('<option val="'+item.id+'"></option>').text(item.label);
                    $('#jenjang2').append($('<option></option>').val(item.id).html(item.label));

						$('#jenjang2').val(<?php echo $level_2;?>);
						
						$("#jenjang2").trigger('change');
                });
            }
          });


  }


  
  function reloadjenjang3(){
          $("#jenjang3").empty();

          $('#jenjang3').append($('<option></option>').val('-1').html('0'));

          $.ajax({
              url: "../../../mysqli/api/jenjang2_list.php", 
              dataType: "json",
              type: "get",
              data: {
                parent: $("#jenjang2").val(),
              },
              success: function(respose){
                 $.each(respose, function(i, item) 
                {
                   // var option=$('<option val="'+item.id+'"></option>').text(item.label);
                    $('#jenjang3').append($('<option></option>').val(item.id).html(item.label));

						$('#jenjang3').val(<?php echo $level_3;?>);
						
						$("#jenjang3").trigger('change');
                });
            }
          });


  }

  
  function reloadjenjang4(){
          $("#jenjang4").empty();

          $('#jenjang4').append($('<option></option>').val('-1').html('0'));

          $.ajax({
              url: "../../../mysqli/api/jenjang2_list.php", 
              dataType: "json",
              type: "get",
              data: {
                parent: $("#jenjang3").val(),
              },
              success: function(respose){
                 $.each(respose, function(i, item) 
                {
                   // var option=$('<option val="'+item.id+'"></option>').text(item.label);
                    $('#jenjang4').append($('<option></option>').val(item.id).html(item.label));

						$('#jenjang4').val(<?php echo $level_4;?>);
						
						$("#jenjang4").trigger('change');
                });
            }
          });


  }

  
  function reloadjenjang5(){
          $("#jenjang5").empty();

          $('#jenjang5').append($('<option></option>').val('-1').html('0'));

          $.ajax({
              url: "../../../mysqli/api/jenjang2_list.php", 
              dataType: "json",
              type: "get",
              data: {
                parent: $("#jenjang4").val(),
              },
              success: function(respose){
                 $.each(respose, function(i, item) 
                {
                   // var option=$('<option val="'+item.id+'"></option>').text(item.label);
                    $('#jenjang5').append($('<option></option>').val(item.id).html(item.label));

						$('#jenjang5').val(<?php echo $level_5;?>);
						
                });
            }
          });


  }


</script>
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
 function selectBuku(no, nama){
  $('#supplier_id').val(no);
  $('#namaSupp').val(nama);
  //tb_remove(); // hilangkan dialog thickbox
}

function cekstring(){	
	var checkString = document.pegForm.namabrg.value;
	if (checkString != "") {
		if ( /[^A-Za-z\d]\s/.test(checkString)) {
			alert("Hanya diperbolehkan Karakter Huruf dan Angka");
			$('input[@name=namabrg]').val('');
			return (false);
		}
	}

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

	<script>
	
	$(document).ready(function(){
			
			
		
	});
	
	
	
	
	</script>
<table width="1140" border="0">
  <tr>
    <td width="40"><img src="../images/vcard_add.png" width="32" height="32" /></td>
    <td width="1090"><span class="style9">FORM PERSEDIAAN
      </span>
      <hr /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><form id="pegForm" method="post" name="pegForm" action="submission_inv.php">
      <?php  if($_GET['id']<>""){ ?>
      <input type="hidden" name="cmd" value="upd_stok" />
      <input type="hidden" name="id" value="<?php  echo $id?>" />
      <?php  } else { ?>
      <input type="hidden" name="cmd" value="add_stok" />
      <?php  } ?>
      <table align="left" class="x1">
        <tr background="../images/impactg.png" height="30">
          <td colspan="3" align="center"><span class="style1">Form Persediaan </span></td>
        </tr>
        <tr>
          <td><span class="style6">Kode   </span></td>
          <td>:</td>
          <td><input type="text" name="kodebrg" id="kodebrg"  value="<?php  echo ($id)?>" size="10"  class="required" title="Harap Mengisi Kode Barang Dahulu" />            </td>
        </tr>
        <tr>
          <td><span class="style6">Nama Barang  </span></td>
          <td>:</td>
          <td><input name="namabrg" size="40" type="text" onblur="cekstring();" class="required " id="namabrg"  title="Nama Barang harus terisi" value="<?php  echo $namabrg?>" /></td>
        </tr>
        <tr>
          <td><span class="style6">Satuan Eceran</span></td>
          <td><span class="style6">:</span></td>
          <td><input type="text" name="satuank" id="satuank"  title="Satuan Kecil harus terisi" value="<?php  echo $satuank?>" /></td>
        </tr>
        <tr>
          <td><span class="style6">Satuan Partai </span></td>
          <td><span class="style6">:</span></td>
          <td><input name="satuanb" type="text" id="satuanb"  title="Satuan Besar harus diisi" value="<?php  echo $satuanb?>" /></td>
        </tr>
        <tr>
          <td><span class="style6">Isi </span></td>
          <td>&nbsp;</td>
          <td><input name="isi" type="text" id="isi"  class="required kanan" title="Isi harus diisi" value="<?php  echo number_format($isi)?>" /></td>
        </tr>
        <tr>
          <td>HJE </td>
          <td>:</td>
          <td><input name="hargaeceran" type="text" id="hargaeceran"  class="required kanan" title="Harga eceran harus diisi" value="<?php  echo number_format($hargaeceran)?>" /></td>
        </tr>
        <tr>
          <td>Harga Partai </td>
          <td>:</td>
          <td><input name="hargapartai" type="text" id="hargapartai"  class="required kanan" title="Harga Partai harus diisi" value="<?php  echo number_format($hargapartai)?>" /></td>
        </tr>
        <tr>
          <td>Tarif / Cukai </td>
          <td>:</td>
          <td><input name="tarif" type="text" id="tarif"  class="" title="" value="<?php  echo ($tarif)?>" /></td>
        </tr>
        <tr>
          <td><span class="style6">Group</span></td>
          <td>:</td>
          <td><input type="text" name="group"  value="<?php  echo ($group)?>" /></td>
        </tr>
        <tr>
          <td><span class="style6">Modal/Harga Beli </span></td>
          <td>:</td>
          <td><input name="modal" type="text" class="required kanan" id="modal"  title="Modal harus diisi" value="<?php  echo number_format($modal)?>" /></td>
        </tr>
        <tr>
          <td><span class="style6">Supplier </span></td>
          <td>:</td>
          <td><input type="hidden" name="norek" id="norek" maxlength="10" size="10" readonly="true" class="" title="Harap Mengisi Nomor Rekening Dahulu" value="<?php  echo $norek?>"/>
            <input type="text" name="supplier_id" id="supplier_id" maxlength="10" size="10" class="" title="Harap Mengisi Kode Supplier Dahulu" value="<?php  echo $supplier_id?>"/>
            <a href="#" class="thickbox"  data-toggle="modal" data-target="#exampleModal6"><img src="../assets/button_search.png" alt="Pilih Akun" border="0" /></a>   <div id="divAlert"></div>         </td>
        </tr>
        <tr>
          <td><span class="style6">Nama Supplier</span></td>
          <td>:</td>
          <td><input type="text" name="namaSupp"  id="namaSupp" value="<?php  echo $namaSupp; ?>" readonly="true" size="40" class="" title="Nama Rekening Harus Terisi" /></td>
        </tr>
        <tr>
          <td>Divisi</td>
          <td>:</td>
          <td><input type="text" name="divisi" value="01" readonly="true" /></td>
        </tr>
        <tr>
          <td><span class="style6">Expedisi </span></td>
          <td>:</td>
          <td><input type="text" name="expedisi" value="<?php  echo $expedisi?>" class="" title="isi Expedisi" /></td>
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

      <table align="left" class="x1" width="300px">
        <tr background="../images/impactg.png" height="30">
          <td colspan="3" align="center"><span class="style1"><font color="white">Jenjang Produk</font> </span></td>
        </tr>
        <tr>
          <td>Level 1</td>
          <td>:</td>
          <td><select name="jenjang1"  id="jenjang1" style="height: 30px; width: 170px" onchange="reloadjenjang2()" />
              <option value="0">0</option>
          </select><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
 +
</button></td>
        </tr>
        <tr>
          <td>Level 2</td>
          <td>:</td>
          <td><select name="jenjang2"  id="jenjang2"  style="height: 30px; width: 170px"  onchange="reloadjenjang3()" />
              <option value="0">0</option>
          </select><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2">
 +
</button></td>
        </tr>
        <tr>
          <td>Level 3</td>
          <td>:</td>
          <td><select name="jenjang3"  id="jenjang3"  style="height: 30px; width: 170px"  onchange="reloadjenjang4()"/>
              <option value="0">0</option>
          </select><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal3">
 +
</button></td>
        </tr>
        <tr>
          <td>Level 4</td>
          <td>:</td>
          <td><select name="jenjang4"  id="jenjang4"  style="height: 30px; width: 170px"  onchange="reloadjenjang5()" />
              <option value="0">0</option>
          </select><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal4">
 +
</button></td>
        </tr>
        </tr>
        <tr>
          <td>Level 5</td>
          <td>:</td>
          <td><select name="jenjang5"  id="jenjang5"  style="height: 30px; width: 170px" />
              <option value="0">0</option>
          </select><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal5">
 +
</button></td>
        </tr>
      </table>

    </form></td>
  </tr>
</table>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Label Jenjang 1</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" id="labeljenjang" name="jenjang" class="sending">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="tambahJenjang()">Save changes</button>
      </div>
    </div>
  </div>
</div>




<!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Label Jenjang 2</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" id="labeljenjang2" name="jenjang2" class="sending2">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="tambahJenjang2()">Save changes</button>
      </div>
    </div>
  </div>
</div>





<!-- Modal -->
<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Label Jenjang 3</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" id="labeljenjang3" name="jenjang3" class="sending2">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="tambahJenjang3()">Save changes</button>
      </div>
    </div>
  </div>
</div>






<!-- Modal -->
<div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Label Jenjang 4</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" id="labeljenjang4" name="jenjang4" class="sending4">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="tambahJenjang4()">Save changes</button>
      </div>
    </div>
  </div>
</div>






<!-- Modal -->
<div class="modal fade" id="exampleModal5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Label Jenjang 5</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" id="labeljenjang5" name="jenjang5" class="sending4">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="tambahJenjang5()">Save changes</button>
      </div>
    </div>
  </div>
</div>




<!-- Modal -->
<div class="modal fade" id="exampleModal6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">DAFTAR SUPPLIER</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
			include "daftar_supp.php";
		?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>





