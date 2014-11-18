<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>

<script type="text/javascript" src="../assets/jquery-1.2.3.pack.js"></script>
<link rel='stylesheet' type='text/css' href='jquery.autocomplete.css'/>
    <script type='text/javascript' src='jquery.autocomplete.js'></script>
	
<script type="text/javascript">
$().ready(function() {

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

	$("#sales").autocomplete("ajax_auto_user.php?grup=user&divisi="+nilaix, {
		width: 300,
		max: 20,
		matchContains: true,
		formatResult: function(row) {
			return row[0];
		}
	});
	$("#sales").result(function(event, data, formatted) {
		if (data)
			//$(this).parent().next().find("input").val(data[1]);
			//--- plus
			$("#kode_sales").val(data[1]);
			// -----
	});
	$("#ppk").autocomplete("ajax_auto_barang.php?grup=rumah&divisi="+nilaix, {
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
			$("#kode").val(data[1]);
			// -----
	});
	$("#namapl").autocomplete("ajax_auto_pl.php?divisi="+nilaix, {
		width: 300,
		max: 20,
		matchContains: true,
		formatResult: function(row) {
			return row[0];
		}
	});
	$("#namapl").result(function(event, data, formatted) {
		if (data)
			//$(this).parent().next().find("input").val(data[1]);
			//--- plus
			$("#pembeli").val(data[1]);
			
			
	//function(){			
	  var vNIP = data[1];
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
	//}
	
			// -----
	});
	

});

function kosongtext(){
	document.frmijin.nama.value = "";
	document.frmijin.kode.value = "";
}
function kosongtextpl(){
	document.frmijin.namapl.value = "";
	document.frmijin.pembeli.value = "";
}
function kosongtext_user(){
	document.frmijin.sales.value = "";
	document.frmijin.kode_sales.value = "";
}
function kosongtextarray(){
	$('input[@name=text_array]').click(
	function(){
	  $(this).val('');
	}
  );
}
</script>

</head>

<body onload="window.print()">
<table width="90%" border="1" style="border-collapse:collapse">
  <tr>
    <td rowspan="4"><div align="center">No.</div>      <div align="center"></div>      <div align="center"></div></td>
    <td rowspan="4"><div align="center">Nama User </div>      <div align="center"></div>      <div align="center"></div></td>
    <td rowspan="4"><div align="center">Blok</div>      <div align="center"></div>      <div align="center"></div></td>
    <td rowspan="4"><div align="center">Type</div>      <div align="center"></div>      <div align="center"></div></td>
    <td rowspan="4"><div align="center">Nilai KPR </div>      <div align="center"></div>      <div align="center"></div></td>
    <td colspan="8"><div align="center">USER KPR MANDIRI </div></td>
    <td>&nbsp;</td>
    <td rowspan="3"><div align="center"></div>
    <div align="center"></div>      <div align="center"></div></td>
    <td rowspan="3"><div align="center"></div>
    <div align="center"></div>      <div align="center"></div></td>
    <td rowspan="4"><div align="center"></div>      <div align="center"></div>      <div align="center">Tanggal Akad </div></td>
  </tr>
  <tr>
    <td colspan="8"><div align="center">PENCAIRAN</div>      <div align="center"></div>      <div align="center"></div>      <div align="center"></div>      <div align="center"></div>      <div align="center"></div>      <div align="center"></div>      <div align="center"></div>      <div align="center"></div>      <div align="center"></div></td>
    <td><div align="center"></div></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">Pencairan I </div>      
      <div align="center"></div></td>
    <td colspan="2"><div align="center">Pencairan II </div>      </td>
    <td colspan="2"><div align="center">Pencairan III </div>      </td>
    <td colspan="2"><div align="center">Pencairan IV </div></td>
    <td><div align="center"></div></td>
  </tr>
  <tr>
    <td><div align="center">Tanggal</div></td>
    <td><div align="center">Jumlah Cair </div></td>
    <td><div align="center">Tanggal</div></td>
    <td><div align="center">Jumlah Cair </div></td>
    <td><div align="center">Tanggal </div></td>
    <td><div align="center">Jumlah Cair </div></td>
    
    <td>Tanggal</td>
    <td>Jumlah Cair </td>
    <td><div align="center">Total Cair </div></td>
    <td><div align="center">10%</div></td>
    <td><div align="center">Sisa
    </div>
    <div align="center"></div></td>
  </tr>
  <form action="submission_keu.php" method="post" name="frmijin" id="frmijin">
  <?php
	include ("../include/globalx.php");
	include ("../include/functions.php");
	if(isset($_GET['id'])){
		$sql = mysql_query("SELECT * FROM kpr_mandiri WHERE id = '".$_GET['id']."' ORDER BY nama");
		$data = mysql_fetch_array($sql);
	}
  ?>
  </form>
	<?php
		$sql = mysql_query("SELECT * FROM kpr_mandiri ORDER BY nama");
		$no = 1;
		while($data = mysql_fetch_array($sql)){
	?>
		
		<tr>
			<td><?php echo $no;?></td>
			<td><?php echo $data['nama']?></td>
			<td align="center"><?php echo $data['blok']?></td>
			<td align="center"><?php echo $data['tipe']?></td>
			<td align="right"><?php echo number_format($data['kpr']); $kpr = $kpr + $data['kpr'];?></td>
			<td><?php echo (baliktglindo($data['tanggal_t1']) <> '00-00-0000') ? baliktglindo($data['tanggal_t1']) : ''; ?></td>
			<td align="right"><?php echo number_format($data['cair_t1'])?></td>
			<td><?php echo (baliktglindo($data['tanggal_t2'])  != '00-00-0000') ? baliktglindo($data['tanggal_t2']) : '';?></td>
			<td align="right"><?php echo number_format($data['cair_t2'])?></td>
			<td><?php echo (baliktglindo($data['tanggal_t3'])  != '00-00-0000') ? baliktglindo($data['tanggal_t3']) : '';?></td>
			<td align="right"><?php echo number_format($data['cair_t3'])?></td>
			
			<td align="center"><?php echo (baliktglindo($data['tanggal_t4'])  != '00-00-0000') ? baliktglindo($data['tanggal_t4']) : '';?></td>
			<td align="right"><?php echo number_format($data['cair_t4'])?></td>
			<td align="right"><?php echo number_format($data['totalcair']); $t_cair = $t_cair + $data['totalcair']; ?></td>
			<td align="right"><?php echo number_format($data['persen10']); $t10 = $t10 + $data['persen10'];?></td>
			<td align="right"><?php echo number_format($data['sisa']); $terhold2 = $terhold2 + $data['sisa']; ?></td>
			<td><?php echo (baliktglindo($data['tanggal_akad'])  != '00-00-0000') ? baliktglindo($data['tanggal_akad']) : '';?></td>
		</tr>
	<?php
			$no++;
		}
	?>
	<tr>
		  <td colspan="3"><div align="center">TOTAL KPR </div></td>
		  <td align="center">&nbsp;</td>
		  <td align="right"><?php echo number_format($kpr); ?></td>
		  <td colspan="8"><div align="center">TOTAL TERHOLD </div></td>
		  <td align="right"><?php echo number_format($t_cair); ?></td>
		  <td align="right"><?php echo number_format($t10);?></td>
		  <td align="right">&nbsp;</td>
		  <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
