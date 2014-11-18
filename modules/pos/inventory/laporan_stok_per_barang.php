<? include "otentik_inv.php"; ?><head>
 
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
<? 
	include "../include/globalx.php";
	include "../include/functions.php";
?>
  <? $SQL = "select * from konsumen WHERE status = 1";
	 	if ($_GET['id']<>"")
		{ 
			$SQL = $SQL." AND kode = ". $_GET['id'];
		}
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		if($_GET['id']<>""){
			while ($baris=mysql_fetch_array($hasil)) {
				$id = $_GET['id'];
				$nama = $baris['nama'];
				$alamat = $baris['alamat'];
				$kota = $baris['kota'];
				$telp = $baris['telp'];
				$norek = $baris['norek'];
					$SQLc = "SELECT namarek FROM rek WHERE norek = '$norek' AND status = 1";
					$hasilc = mysql_query($SQLc);
					$barisc = mysql_fetch_array($hasilc);
					$namarekeninginduk = $barisc[0];
			}	
		}
	?>
<table width="100%" border="0">
  <tr>
    <td width="40"><img src="../images/vcard_add.png" width="32" height="32" /></td>
    <td width="1090"><span class="style9">LAPORAN STOK BARANG
      </span>
    <hr /></td>
  </tr>
  <tr>
  
    <td>&nbsp;</td>
    <td><table width="100%" border="1">
      <tr>
        <td colspan="11">
		<form method="get" action="" id="pegForm">
  <input type="hidden" name="mn" value="<?=$_GET['mn']?>" />
  <input type="hidden" name="tampil" value="1" />
		<table width="100%" border="1">
          <tr>
            <td width="11%">Nama Barang                </td>
            <td width="15%"><select name="brg" id="brg" class="required" title="*">
              <option value="">-Pilih-</option>
              <?
				$SQL = "SELECT * FROM stock WHERE status = 1";
				$hasil = mysql_query($SQL, $dbh_jogjaide);
				while($baris = mysql_fetch_array($hasil)){
			?>
              <option value="<?=$baris['kodebrg']?>" <? if($_GET['brg']==$baris['kodebrg']){?>selected="selected"<? }?>>
              <?=auto($baris['kodebrg'])?>
                -
  <?=$baris['namabrg']?>
  <?=$baris['namarek']?>
              </option>
              <? } ?>
            </select></td>
            <td width="13%"><select name="slBulan" class="required" title="*">
              <option value="">-Bulan-</option>
              <option value="01" <? if($_GET['slBulan']=="01"){?> selected="selected" <? }?>>Januari</option>
              <option value="02" <? if($_GET['slBulan']=="02"){?> selected="selected" <? }?>>Februari</option>
              <option value="03" <? if($_GET['slBulan']=="03"){?> selected="selected" <? }?>>Maret</option>
              <option value="04" <? if($_GET['slBulan']=="04"){?> selected="selected" <? }?>>April</option>
              <option value="05" <? if($_GET['slBulan']=="05"){?> selected="selected" <? }?>>Mei</option>
              <option value="06" <? if($_GET['slBulan']=="06"){?> selected="selected" <? }?>>Juni</option>
              <option value="07" <? if($_GET['slBulan']=="07"){?> selected="selected" <? }?>>Juli</option>
              <option value="08" <? if($_GET['slBulan']=="08"){?> selected="selected" <? }?>>Agustus</option>
              <option value="09" <? if($_GET['slBulan']=="09"){?> selected="selected" <? }?>>September</option>
              <option value="10" <? if($_GET['slBulan']=="10"){?> selected="selected" <? }?>>Oktober</option>
              <option value="11" <? if($_GET['slBulan']=="11"){?> selected="selected" <? }?>>September</option>
              <option value="12" <? if($_GET['slBulan']=="12"){?> selected="selected" <? }?>>Desember</option>
            </select></td>
            <td width="18%"><select name="slTahun" class="required" title="*">
              <option value="">-Tahun-</option>
              <?
				$hariini = getdate(); 										
				$taun = $hariini['year']+1; 
				for ($yz=0;$yz<5;$yz++){ ?>
              <option  value="<?=($taun-$yz)?>" <? if ($_GET['slTahun']==($taun-$yz)) {?> selected="selected" <? }else {}?>>
              <?=($taun-$yz) ?>
              </option>
              <? } ?>
            </select></td>
            <td width="43%"><input name="submit" type="submit" value="Tampilkan"></td>
          </tr>
        </table></form>        </td>
        </tr>
      <tr>
        <td rowspan="2">Tanggal</td>
        <td rowspan="2">No Bukti </td>
        <td colspan="3"><div align="center">Penambahan</div></td>
        <td colspan="3"><div align="center">Pengurangan</div></td>
        <td colspan="3"><div align="center">Saldo</div></td>
        </tr>
      <tr>
        <td>Banyak</td>
        <td>Harga Pokok Per Unit </td>
        <td>Jumlah</td>
        <td>Banyak</td>
        <td>Harga Pokok Per Unit </td>
        <td>Jumlah</td>
        <td>Banyak</td>
        <td>Harga Pokok Per Unit </td>
        <td>Jumlah</td>
      </tr>
	  <?
	  		if($_GET['tampil']==1){
			//AWAL
			$i++;
			$SQLawal = "SELECT SUM(qtyin)-SUM(qtyout) AS saldo, SUM(debet-kredit) AS jumlah  FROM mutasi WHERE tgl < '".$_GET['slTahun']."-".$_GET['slBulan']."-01'";
			$hasilawal = mysql_query($SQLawal);
			$barisawal = mysql_fetch_array($hasilawal);
			$saldoawal = $barisawal['saldo'];
			$jumlahawal = $barisawal['jumlah'];
			$hp[$i] = $jumlahawal/$saldoawal;
	  ?> 
	    
      <tr>
        <td align="center">Awal</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="center"><?	
							//echo $SQLawal;		
							echo number_format($saldoawal);
							
							?></td>
        <td align="center"><?	
							//echo $SQLb;		
							echo number_format($hp[$i]);
							
							?></td>
        <td align="center"><?	
							//echo $SQLb;		
							echo number_format($jumlahawal);
							
							?></td>
      </tr>
	  
	  <?
	  	
	  		$SQL = "SELECT DISTINCT tgl FROM mutasi WHERE MONTH(tgl) = '".$_GET['slBulan']."' AND YEAR(tgl) = '".$_GET['slTahun']."' AND kode = '".$_GET['brg']."' ORDER BY tgl ASC";
			$hasil = mysql_query($SQL, $dbh_jogjaide);
			while($baris = mysql_fetch_array($hasil)){
	  ?>
      <tr>
        <td align="center"><?=baliktglindo($baris['tgl'])?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
	  <?
	  		//mutasi 
			$SQLa = "SELECT * FROM mutasi WHERE tgl = '".$baris['tgl']."' AND status = 1 ORDER by tgl ASC, id ASC";
			$hasila = mysql_query($SQLa);
			while($barisa = mysql_fetch_array($hasila)){
				$counter_hp++;
				$nota = $barisa['nota'];
				if($barisa['model']=="INV"){
					$nota = "INV/".$barisa['sub']."/".nobukti($barisa['nomor']);
				}
	  ?>
	  <tr>
        <td align="center">&nbsp;</td>
        <td align="center"><?=$nota?></td>
        <td align="center"><?=number_format($barisa['qtyin'])?></td>
        <td align="center"><?
								if($barisa['model']==""){
									echo number_format($barisa['harga']);
								}
								?></td>
        <td align="center"><?
								if($barisa['model']==""){
									echo number_format($barisa['qtyin'] * $barisa['harga']);
								}
								?></td>
        <td align="center"><?
							
							echo number_format($barisa['qtyout']);
							
							?></td>
        <td align="center"><?
								if($barisa['model']=="INV"){
									
									echo number_format($hp[$i]);
								}
								?></td>
        <td align="center"><?
								if($barisa['model']=="INV"){
									echo number_format($barisa['qtyout'] * $hp[$i]);
								}
								?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
	  <?
	  		//saldo  
			$i++;
			$SQLb = "SELECT SUM(qtyin)-SUM(qtyout) AS saldo, SUM(debet-kredit) AS jumlah  FROM mutasi WHERE tgl BETWEEN '".$_GET['slTahun']."-".$_GET['slBulan']."-01' AND '".$baris['tgl']."'";
			$hasilb = mysql_query($SQLb);
			$barisb = mysql_fetch_array($hasilb);
			$saldo = $barisb['saldo']+$saldoawal;
			$jumlah = $barisb['jumlah']+$jumlahawal;
			$hp[$i] = $jumlah/$saldo;
	  ?>
	  <tr>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="center"><?	
							//echo $SQLb;		
							echo number_format($saldo);
							
							?></td>
        <td align="center"><?	
							//echo $SQLb;		
							echo number_format($hp[$i]);
							
							?></td>
        <td align="center"><?	
							//echo $SQLb;		
							echo number_format($jumlah);
							
							?></td>
      </tr>
	  <?			
	  			} // end while mutasi
	  		} // end while distinct tgl
	  	} // end if tampil
	  ?>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
