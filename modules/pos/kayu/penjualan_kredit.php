<?php  session_start(); ?>
<?php  include "otentik_inv.php";  include ("../include/globalx.php");  include ("../include/functions.php");?>
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

input.kanan{ text-align:right; }
</style>
<script type="text/javascript" src="../assets/kalendar_files/jsCalendar.js"></script>
<link href="../assets/kalendar_files/calendar.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../assets/jquery-1.2.3.pack.js"></script>
<script type="text/javascript" src="../assets/jquery.validate.pack.js"></script>
 <script language="javascript" src="../assets/thickbox/thickbox.js"></script>
 <link href="../assets/thickbox/thickbox.css" rel="stylesheet" type="text/css" />

 <script language="JavaScript">
<!--
	function confirmDelete(delUrl) {
		if (confirm("Data ini akan dihapus!\nApakah Anda yakin untuk menghapusnya ?")) {
			document.location = delUrl;
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
 </script>
 <script type="text/javascript">



function clearNum(number){
	while(String(number).indexOf(',') > -1){
	 number = String(number).replace(',','');
	}
	return number;
}
	function hitung(){
		//qty = clearNum(document.getElementById("kubikasi").value) * 1;
		harga = clearNum(document.getElementById("harga").value) * 1;
		batang = clearNum(document.getElementById("batang").value) * 1;
		ukuran1 = clearNum(document.getElementById("ukuran1").value) * 1;
		ukuran2 = clearNum(document.getElementById("ukuran2").value) * 1;
		ukuran3 = clearNum(document.getElementById("ukuran3").value) * 1;
		disc = 0; //clearNum(document.getElementById("disc").value) * 1;
		disc2 = 0; //clearNum(document.getElementById("disc2").value) * 1;
		disc3 = 0; //clearNum(document.getElementById("disc3").value) * 1;
		discrp = 0; //clearNum(document.getElementById("discrp").value) * 1;
		if(disc != 0 || disc2 != 0 || disc3 != 0){
			netto = (qty * harga)-((disc + disc2 + disc3) / 100 * harga * qty);
			document.getElementById("discrp").value = formatCurrency((disc + disc2 + disc3) / 100 * harga * qty)
		} else {
			//netto = (qty * harga) - discrp;
		}
		document.getElementById("kubikasi").value = formatCurrency(ukuran1*ukuran2*ukuran3*batang);
		document.getElementById("nilai").value = formatCurrency(harga*ukuran1*ukuran2*ukuran3*batang);
		//document.getElementById("netto").value = formatCurrency(netto);
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
			
  
</script>

<script type="text/javascript">

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
		//qty = clearNum(document.getElementById("kubikasi").value) * 1;
		harga = clearNum(document.getElementById("harga").value) * 1;
		batang = clearNum(document.getElementById("batang").value) * 1;
		ukuran1 = clearNum(document.getElementById("ukuran1").value) * 1;
		ukuran2 = clearNum(document.getElementById("ukuran2").value) * 1;
		ukuran3 = clearNum(document.getElementById("ukuran3").value) * 1;
		disc = 0; //clearNum(document.getElementById("disc").value) * 1;
		disc2 = 0; //clearNum(document.getElementById("disc2").value) * 1;
		disc3 = 0; //clearNum(document.getElementById("disc3").value) * 1;
		discrp = 0; //clearNum(document.getElementById("discrp").value) * 1;
		if(disc != 0 || disc2 != 0 || disc3 != 0){
			netto = (qty * harga)-((disc + disc2 + disc3) / 100 * harga * qty);
			document.getElementById("discrp").value = formatCurrency((disc + disc2 + disc3) / 100 * harga * qty)
		} else {
			//netto = (qty * harga) - discrp;
		}
		document.getElementById("kubikasi").value = formatCurrency(ukuran1*ukuran2*ukuran3*batang);
		document.getElementById("nilai").value = formatCurrency(harga*ukuran1*ukuran2*ukuran3*batang);
		//document.getElementById("netto").value = formatCurrency(netto);
	}
</script>
<link rel='stylesheet' type='text/css' href='jquery.autocomplete.css'/>
    <script type='text/javascript' src='jquery.autocomplete.js'></script>
<script type="text/javascript">
$(document).ready(function(){
	
	function log(event, data, formatted) {
		$("<li>").html( !data ? "No match!" : "Selected: " + formatted).appendTo("#result");
	}

	function formatItem(row) {
		return row[0] + " (<strong>id: " + row[1] + "</strong>)";
	}
	function formatResult(row) {
		return row[0].replace(/(<.+?>)/gi, '');
	}
	
	$("#namapl").autocomplete("ajax_auto_pl.php?divisi=01", {
		width: 300,
		max: 20,
		matchContains: true,
		formatResult: function(row) {
			return row[0];
		}
	});
	$("#namapl").result(function(event, data, formatted) {
		if (data){			//$(this).parent().next().find("input").val(data[1]);
			//--- plus
			$("#pembeli").val(data[1]);
			// -----
			//alert("Cari detail pembeli.., tekan TAB 2 Kali");

			$("#pembeli").blur();
		}
			//nng
			
	});
	

	
	$("#ppk").autocomplete("ajax_auto_barang.php?divisi=01", {
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
			 $.get('../include/cari.php?cari=barang&mode=hargajual',{id: $("#brg").val()},
				function(nama_pegawai){
				  // jika response tidak kosong nilainya maka masukkan nilai ke inputan nama pegawai
				  if(nama_pegawai.length > 0){ 
					$('input[@name=harga]').val(formatCurrency(nama_pegawai));	
					hitung();
					//	document.forms["frmijin"].submit();
				  }else {
					$('input[@name=harga]').val("");
				   }
				}
			  );
			 $.get('../include/cari.php?cari=barang&mode=ukuran1',{id: $("#brg").val()},
				function(nama_pegawai){
				  // jika response tidak kosong nilainya maka masukkan nilai ke inputan nama pegawai
				  if(nama_pegawai.length > 0){ 
					$('input[@name=ukuran1]').val(nama_pegawai);	
					hitung();
					//	document.forms["frmijin"].submit();
				  }else {
					$('input[@name=ukuran1]').val("");
				   }
				}
			  );
			 $.get('../include/cari.php?cari=barang&mode=ukuran2',{id: $("#brg").val()},
				function(nama_pegawai){
				  // jika response tidak kosong nilainya maka masukkan nilai ke inputan nama pegawai
				  if(nama_pegawai.length > 0){ 
					$('input[@name=ukuran2]').val(nama_pegawai);	
					hitung();
					//	document.forms["frmijin"].submit();
				  }else {
					$('input[@name=ukuran2]').val("");
				   }
				}
			  );
			 $.get('../include/cari.php?cari=barang&mode=ukuran3',{id: $("#brg").val()},
				function(nama_pegawai){
				  // jika response tidak kosong nilainya maka masukkan nilai ke inputan nama pegawai
				  if(nama_pegawai.length > 0){ 
					$('input[@name=ukuran3]').val(nama_pegawai);	
					hitung();
					//	document.forms["frmijin"].submit();
				  }else {
					$('input[@name=ukuran3]').val("");
				   }
				}
			  );
			// -----
			
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
	
	
});

</script>
	<table width="1140" border="0">
  <tr>
    <td width="32"><img src="../images/calendar.png" width="32" height="32" /></td>
    <td width="1090"><span class="style1">PENJUALAN KAYU/ BARANG KELUAR </span></td>
  </tr>
  <tr>
    <td width="32">&nbsp;</td>
    <td>
	
	<table width="663" class="x1">
	<form name="frmijin" id="frmijin" method="post" action="submission_inv.php">
          <input type="hidden" name="cmd" value="add_jual_kredit" />
		  <input type="hidden" name="nobukti" value="<?php  echo $_GET['nobukti']?>" />
		  <input type="hidden" name="namasupp" value="<?php  echo $_GET['namasupp']?>" id="namasupp" />
		  <input type="hidden" name="namabrg" value="" id="namabrg" />
		  <input type="hidden" name="nomor" value="<?php  echo $_GET['nomor']?>" />
      <tr>
        <td width="143">No. Faktur </td>
        <td width="205"><input type="text" name="nonota" id="nonota" value=""  required   class="required" /></td>
        <td width="107">Tanggal</td>
        <td width="188"><input type="text" name="tgl_transaksi" id="tgl_transaksi" size="10" class="required" title="*" value="<?php  echo $_GET['tgl_transaksi']?>" <?php  if($_GET['nomor']<>""){ ?>  readonly="true"  <?php  }?> />
          <a href="javascript:showCalendar('tgl_transaksi')"><img src="../assets/kalendar_files/calendar_icon.gif" border="0"></a></td>
      </tr>
      <tr>
        <td>Divisi..</td>
        <td>
          
            
			
			<select name="divisi" id="divisi" class="required" title="Pilih Divisi">
            <?php 
			$SQL = "SELECT * FROM divisi WHERE subdiv <> ''";
				$SQL = $SQL . " AND subdiv = '".$_SESSION["sess_tipe"]."'";
			$hasil = mysql_query($SQL);
			while($baris = mysql_fetch_array($hasil)){
		?>
            <option value="<?php  echo $baris['subdiv']?>" <?php  if($_GET['divisi']==$baris['subdiv']){?> selected="selected" <?php  }?>>
            <?php  echo $baris['namadiv']." -- ".$baris['subdiv']?>
            </option>
            <?php  } ?>
          </select>
		  
		  </td>
        <td>Angsuran x</td>
        <td><input type="text" name="angsuran" id="angsuran" class="kanan" value="<?php  echo $_GET['angsuran']?>" /></td>
      </tr>
      <tr>
        <td>Konsumen </td>
        <td><input name="namapl" type="text" id="namapl"  required  class="data-entry-kanan"/>
          <input name="pembeli" type="text" id="pembeli"  required  value="" size="8" readonly="readonly" class="required" title="Kode Konsumen Harus Terisi !"/></td>
        <td>Saldo</td>
        <td><input type="text" name="saldo" id="saldo" class="kanan" readonly="true" value="<?php  echo $_GET['saldo']?>"></td>
      </tr>
      <tr>
        <td>Alamat</td>
        <td><input type="text" name="alamat" id="alamat" readonly="true" size="40" value="<?php  echo $_GET['alamat']?>"></td>
        <td>Rek</td>
        <td><input type="text" name="rek" id="rek" readonly="true" value="<?php  echo $_GET['rek']?>"></td>
      </tr>
      <tr>
        <td>Kota</td>
        <td><input type="text" name="kota" id="kota" readonly="true" value="<?php  echo $_GET['kota']?>"></td>
        <td>Nama Rek </td>
        <td><input type="text" name="namarek" readonly="true" value="<?php  echo $_GET['namarek']?>"></td>
      </tr>
      <tr>
        <td>Telp.</td>
        <td><input type="text" name="telp" id="telp" readonly="true" value="<?php  echo $_GET['telp']?>"></td>
        <td>No. Bukti </td>
        <td><input type="text" readonly="true" id="nobukti" name="nobukti"></td>
      </tr>
    </table>
	<br />
	<table border="1" align="left" cellpadding="3" cellspacing="0" bordercolorlight="silver" bordercolordark="#FFFFFF">
      <?php  if ($_GET['id']<>"") {?>
      <tr>
        <td background="../images/impactg.png" colspan="12" align="center"><font color="white"><b>Edit Transaksi </b></font></td>
      </tr>
      <?php  } else { ?>
      <tr>
        <td background="../images/impactg.png" colspan="12" align="center"><strong><font color="white"> TRANSAKSI </font></strong></td>
      </tr>
      <?php  } ?>
      <tr bgcolor="#FFCC00">
        <td width="34" align="center"><strong>No</strong></td>
        <td align="center">Jenis Kayu</td>
       <td align="center" colspan="3"><strong>Ukuran (Cm)</strong></td>
	   <td align="center"><strong>Batang <div id="output"></div></strong></strong></td>
		<td align="center"><strong>Kubikasi</strong></td>
		<td align="center"><strong>Harga</strong></td>
		<td align="center"><strong>Nilai</strong></td>
        <?php  if ($_GET['id']<>"") { ?>
        <td width="58" align="center"><b>Update</b></td>
        <td width="58" align="center"><b>Batal</b></td>
        <?php  } else { ?>
        <td width="58" align="center"><strong>Edit</strong></td>
        <td width="58" align="center"><b>Hapus</b></td>
        <?php  } ?>
      </tr>
      <?php  if ($_GET['id']=="") { ?>
      <tr bgcolor="yellow">
        
          <td align="center"><img src="../images/kal_next.gif" alt="Selanjutnya" border="0" /></td>
          <td align="center"><input name="namabrg" type="text" id="ppk" class="data-entry-kanan" required />
          <input name="brg" type="text" id="brg" value="" size="8" readonly="readonly" class="required" required title="Jenis Kayu Harus Terisi !"/></td>
          <td align="center"><input type="text" name="ukuran1" id="ukuran1" readonly  oninput="hitung()"  size="5" class="required kanan" required title="*" value="0"/></td>
		  <td align="center"><input type="text" name="ukuran2" id="ukuran2" readonly oninput="hitung()"  size="5" class="required kanan" required title="*" value="0"    /></td>
		  <td align="center"><input type="text" name="ukuran3" id="ukuran3" readonly oninput="hitung()"  size="5" class="required kanan" required title="*" value="0"    /></td>
		  <td align="center"><input type="text" name="batang" id="batang"  oninput="hitung()"  size="10"  class="required kanan" required title="*" value="0"/></td>
		  <td align="center"><input type="text" id="kubikasi" name="kubikasi" readonly size="10" class="required kanan" required title="*" value="0"  /></td>
		  <td align="center"><input type="text" id="harga" name="harga" readonly size="10" class="required kanan" required title="*" value="0"/></td>
		  <td align="center"><input type="text" id="nilai" name="nilai" size="15" readonly class="required kanan" required title="*" value="0" /></td>
          <td align="center" colspan="4"><input name="image" type="image" src="../images/add.gif" border="0" /></td>
        </form>
      </tr>
      <?php  } ?>
      <?php 
	  	
		$SQLj = "SELECT * FROM mutasi WHERE status = 1 AND model = 'KRE' AND nota = '".$_GET['nonota']."'";
		//echo $SQLj; 		
		$hasilj = mysql_query($SQLj);
		$nRecord = 1;
		if (mysql_num_rows($hasilj) > 0) { 
		while ($row=mysql_fetch_array($hasilj)) { 
	?>
      <tr <?php 	 if (($nRecord % 2)==0) {?>bgcolor="#FFFFFF"<?php  } else {?> else="else" bgcolor="#CCCCCC"<?php  }?>>
        <form action="submission_inv.php" method="post" name="frmijin" id="frmijin">
          <input type="hidden" name="id" value="<?php  echo $_GET['id']?>" />
          <input type="hidden" name="cmd" value="upd_jurnal" />
          <td align="center"><?php  echo $nRecord?></td>
          <td align="center"><?php  echo ($row['kodebrg'])?> - <?php  echo $row['namabrg']?></td>
          <td align="left"><?php  echo $row['qtyout']?></td>
          <td align="right"><?php  echo number_format($row["harga"],2,'.',',');?></td>
		  <td align="right"><?php  echo number_format($row["disc"],2,'.',',');?></td>
		  <td align="right"><?php  echo number_format($row["disc2"],2,'.',',');?></td>
		  <td align="right"><?php  echo number_format($row["disc3"],2,'.',',');?></td>
		  <td align="right"><?php  echo number_format($row["harga"] * $row["qtyout"],2,'.',',')?></td>
		  <?php  $t_jumlah = $t_jumlah + ($row["harga"] * $row["qtyout"]); ?>
		  <td align="right"><?php  echo number_format($row["discrp"],2,'.',',')?></td>
		  <td align="right"><?php  echo number_format($row["kredit"],2,'.',',');?></td>
		  <?php  $t_debet = $t_debet + $row["kredit"]; ?>
          <?php  if ($_GET['id']<>"") { ?>
          <td align="center"><input name="image" type="image" src="../images/approve.gif" border="0" /></td>
          <td align="center"><a href="javascript:history.back()"><img src="../images/kal_prev.gif" alt="Sebelumnya" border="0" /></a></td>
          <?php  } else { ?>
          <td align="center"><a href=""></a></td>
          <td align="center"><a href="javascript:confirmDelete('submission_inv.php?id=<?php  echo $row["id"]?>&cmd=del_jual_kredit&nonota=<?php  echo $_GET['nonota']?>&supp=<?php  echo $_GET['supp']?>&alamat=<?php  echo $_GET['alamat']?>&kota=<?php  echo $_GET['kota']?>&telp=<?php  echo $_GET['telp']?>&tgl_transaksi=<?php  echo $_GET['tgl_transaksi']?>&saldo=<?php  echo $_GET['saldo']?>&rek=<?php  echo $_GET['rek']?>&namarek=<?php  echo $_GET['namarek']?>&nomor=<?php  echo $_GET['nomor']?>&namasupp=<?php  echo $_GET['namasupp']?>&brg=<?php  echo $row['kodebrg']?>&qtyout=<?php  echo $row['qtyout']?>&netto=<?php  echo $row["kredit"]?>')">
		  <img src="../images/hapus.gif" alt="Hapus" border="0" /></a></td>
          <?php  } ?>
        </form>
      </tr>
      <?php   
		 $nRecord = $nRecord + 1;
		} ?>
		<tr>
		  <td align="center">&nbsp;</td>
	      <td align="center">&nbsp;</td>
	      <td align="center">&nbsp;</td>
	      <td align="center">&nbsp;</td>
	      <td align="center">&nbsp;</td>
	      <td align="center">&nbsp;</td>
	      <td align="center">&nbsp;</td>
		  <td align="right"><?php  echo number_format($t_jumlah,2,'.',',');?></td>
		  <td align="center">&nbsp;</td>
	      <td align="right"><?php  echo number_format($t_debet,2,'.',',');?></td>
	      <td align="center">&nbsp;</td>
	      <td align="center">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="20" align="center">
			<a href="cetak_penjualan.php?model=INV&nomor=<?php  echo $_GET['nomor']?>">[ CETAK ]</a>&nbsp;<a href="index.php?mn=penjualan">[ SELESAI ATAU KE NOMOR INV BERIKUTNYA ]</a>		  </td>
		</tr>
		<?php 
	} else { ?>
      <tr>
        <td align="center" colspan="12"><font color="red">Mohon maaf, tidak ada Data dimaksud.</font></td>
      </tr>
      <?php   } ?>
    </table>	
	<p>&nbsp;</p></td>
  </tr>
</table>
