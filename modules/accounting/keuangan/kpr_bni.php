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

<body>
<table width="90%" border="1" style="border-collapse:collapse">
  <tr>
    <td rowspan="4"><div align="center">No.</div>      <div align="center"></div>      <div align="center"></div></td>
    <td rowspan="4"><div align="center">Nama User </div>      <div align="center"></div>      <div align="center"></div></td>
    <td rowspan="4"><div align="center">Blok</div>      <div align="center"></div>      <div align="center"></div></td>
    <td rowspan="4"><div align="center">Type</div>      <div align="center"></div>      <div align="center"></div></td>
    <td rowspan="4"><div align="center">Nilai KPR </div>      <div align="center"></div>      <div align="center"></div></td>
    <td colspan="6"><div align="center">USER KPR BNI </div></td>
    <td>&nbsp;</td>
    <td rowspan="3"><div align="center">Terhold</div>
      <div align="center"></div>      <div align="center"></div></td>
    <td rowspan="3"><div align="center">Terhold 5% </div>
      <div align="center"></div>      <div align="center"></div></td>
    <td rowspan="4"><div align="center"></div>      <div align="center"></div>      <div align="center">Tanggal Akad </div></td>
    <td rowspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6"><div align="center">PENCAIRAN</div>      <div align="center"></div>      <div align="center"></div>      <div align="center"></div>      <div align="center"></div>      <div align="center"></div>      <div align="center"></div>      <div align="center"></div>      <div align="center"></div>      <div align="center"></div></td>
    <td><div align="center"></div></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">Pencairan I </div>      
      <div align="center"></div></td>
    <td colspan="2"><div align="center">Pencairan II </div>      </td>
    <td colspan="2"><div align="center">Pencairan III </div>      </td>
    <td><div align="center"></div></td>
  </tr>
  <tr>
    <td><div align="center">Tanggal</div></td>
    <td><div align="center">Jumlah Cair </div></td>
    <td><div align="center">Tanggal</div></td>
    <td><div align="center">Jumlah Cair </div></td>
    <td><div align="center">Tanggal </div></td>
    <td><div align="center">Jumlah Cair </div></td>
    
    <td><div align="center">Total Cair </div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div>
    <div align="center"></div></td>
  </tr>
  <form action="submission_keu.php" method="post" name="frmijin" id="frmijin">
  <?php
	include ("../include/globalx.php");
	include ("../include/functions.php");
	if(isset($_GET['id'])){
		$sql = mysql_query("SELECT * FROM kpr_bni WHERE id = '".$_GET['id']."' ORDER BY nama");
		$data = mysql_fetch_array($sql);
	}
  ?>
  <tr>
    <td>&nbsp;</td>
    <td><input type="text" name="nama" value="<?php echo $data['nama']; ?>" id="ppk" size="20" onclick="kosongtext()"  />
	<input name="cmd" type="hidden" value="<?php echo isset($_GET['id']) ? 'upd_kpr_bni' : 'add_kpr_bni'; ?>">
	<input name="id" type="hidden" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
    <input name="kode" type="hidden" id="kode" value="<?php echo $data['kode']; ?>" size="8" readonly="readonly" class="required" title="Kode Barang Harus Terisi !"/></td>
    <td><input type="text" name="blok" value="<?php echo $data['blok']; ?>" size="5" /></td>
    <td><input type="text" name="tipe" value="<?php echo $data['tipe']; ?>" size="5" /></td>
    <td><input type="text" name="kpr" value="<?php echo $data['kpr']; ?>" size="12" /></td>
    <td><input type="text" name="tanggal_t1" value="<?php echo baliktglindo($data['tanggal_t1']); ?>" size="10" /></td>
    <td><input type="text" name="cair_t1" value="<?php echo $data['cair_t1']; ?>" size="12" /></td>
    <td><input type="text" name="tanggal_t2" value="<?php echo baliktglindo($data['tanggal_t2']); ?>" size="10" /></td>
    <td><input type="text" name="cair_t2" value="<?php echo $data['cair_t2']; ?>" size="12" /></td>
    <td><input type="text" name="tanggal_t3" value="<?php echo baliktglindo($data['tanggal_t3']); ?>" size="10" /></td>
    <td><input type="text" name="cair_t3" value="<?php echo $data['cair_t3']; ?>" size="12" /></td>
    
    <td><input type="text" name="totalcair" value="<?php echo $data['totalcair']; ?>" size="12" /></td>
    <td><input type="text" name="terhold" value="<?php echo $data['terhold']; ?>" size="12" /></td>
    <td><input type="text" name="terhold5" value="<?php echo $data['terhold5']; ?>" size="12" /></td>
    <td><input type="text" name="tanggal_akad" value="<?php echo baliktglindo($data['tanggal_akad']); ?>" size="10" /></td>
    <td><input type="submit" value="<?php echo isset($_GET['id']) ? 'Ubah' : 'Tambah'; ?>" /></td>
  </tr>
  </form>
	<?php
		$sql = mysql_query("SELECT * FROM kpr_bni ORDER BY nama");
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
			
			<td align="right"><?php echo number_format($data['totalcair']); $t_cair = $t_cair + $data['totalcair']; ?></td>
			<td align="right"><?php echo number_format($data['terhold']); $terhold1 = $terhold1 + $data['terhold'];?></td>
			<td align="right"><?php echo number_format($data['terhold5']); $terhold2 = $terhold2 + $data['terhold5']; ?></td>
			<td><?php echo (baliktglindo($data['tanggal_akad'])  != '00-00-0000') ? baliktglindo($data['tanggal_akad']) : '';?></td>
			<td>
				<a href="submission_keu.php?cmd=del_kpr_bni&id=<?php echo $data['id']; ?>" onclick="return confirm('Apakah anda yakin ?')">Delete</a>
				<a href="?mn=kpr_bni&id=<?php echo $data['id']; ?>">Edit</a>			</td>
		</tr>
	<?php
			$no++;
		}
	?>
	<tr>
		  <td colspan="3"><div align="center">TOTAL KPR </div></td>
		  <td align="center">&nbsp;</td>
		  <td align="right"><?php echo number_format($kpr); ?></td>
		  <td colspan="6"><div align="center">TOTAL TERHOLD </div></td>
		  <td align="right"><?php echo number_format($t_cair); ?></td>
		  <td align="right"><?php echo number_format($terhold1);?></td>
		  <td align="right"><?php echo number_format($terhold2);?></td>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
