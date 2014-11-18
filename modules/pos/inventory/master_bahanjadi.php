<? 
session_start();
include "otentik_inv.php"; 
include ("../include/functions.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Master Bahan Jadi</title>
	<script type="text/javascript" src="../assets/jquery-1.2.3.pack.js"></script>
	<script type="text/javascript" src="../assets/jquery.validate.pack.js"></script>

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

	$('#kodeanak').change( // beri event pada saat onBlur inputan kode pegawai
	function(){			
	  var vNIP = $(this).val();
	  $.get('../include/cari.php?cari=barang&mode=satuank',{id: vNIP},
		function(nama_pegawai){
		  // jika response tidak kosong nilainya maka masukkan nilai ke inputan nama pegawai
		  if(nama_pegawai.length > 0){ 
			$('#satuan').attr("value", nama_pegawai);
			hitung();
		  }else {
			$('#satuan').attr("value", "");
		   }
		}
	  );
	}
  );
});
	
</script>
<script language="JavaScript">
<!--
	function confirmDelete(delUrl) {
		if (confirm("Data ini akan dihapus!\nApakah Anda yakin untuk menghapusnya ?")) {
			document.location = delUrl;
		}
	}
		function CloseAndRefresh() 
{
    window.opener.location.href = window.opener.location.href;
    window.close();
}
//-->
</script>
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

</head>

<body>
<?
	$SQL = "SELECT namabrg FROM stock WHERE kodebrg = '".$_GET['id']."'";
	$hasil = mysql_query($SQL, $dbh_jogjaide);
	$baris = mysql_fetch_array($hasil);
	$barang = $baris[0];
	$tsql0 = "select * from bahanjadi a, stock b where a.status=1 AND kodeinduk = '".$_GET['id']."' And a.kodeanak = b.kodebrg";
	$tsql0 = $tsql0." ORDER BY id ASC";
	//echo $tsql0;
	$hasil=mysql_query($tsql0);
?>
<table border="1" width="50%" bordercolorlight="silver" cellspacing="0" cellpadding="3" bordercolordark="#FFFFFF" align="center">
  <? if ($_GET['idtt']<>"") {?>
    <tr>
		<td background="../images/impactg.png" colspan=17 align="center"><font color="white"><B>Edit Bahan Jadi </B></font></td>
  </tr>
  <? } else { ?>
    <tr>
		<td background="../images/impactg.png" colspan=17 align="center"><font color=white>
			DAFTAR BAHAN JADI : <?=$barang?></font></td>
  </tr>
  <? }?>
    <tr bgcolor="silver">
		<td background="images/fraglight.gif" width="5%" align="center"><strong>No</strong></td>
		<td background="images/fraglight.gif" align="center" width="75%"><strong>Nama Barang </strong></td>
		<td background="images/fraglight.gif" align="center" width="75%"><strong>Satuan </strong></td>
		<td background="images/fraglight.gif" align="center" width="75%"><strong>Qty</strong></td>
		<td background="images/fraglight.gif" align="center" width="75%"><strong>Kemasan</strong></td>
			<? if ($_GET['idtt']<>"") { ?>
		<td background="images/fraglight.gif" width="5%" align="center"><B>Update</B></td>
		<td background="images/fraglight.gif" width="5%" align="center"><B>Batal</B></td>
			<? } else { ?>
		<!--
		<td background="images/fraglight.gif" width="5%" align="center"><strong>Edit</strong></td> -->
		<td background="images/fraglight.gif" width="5%" align="center"><B>Hapus</B></td>
			<? } ?>
  </tr>
<?	 $nRecord = 1;
	if (mysql_num_rows($hasil) > 0) { 
		 while ($row=mysql_fetch_array($hasil)) { ?>
		  <tr <?	 if (($nRecord % 2)==0) {?>bgcolor="#FFFFCC"<? } ?>>
			<form method="post" action="submission.php">
				<input type=hidden name="id" value="<?=$_GET['id']?>">
				<input type=hidden name="cmd" value="update_tt">
				<input type="hidden" name="idtt" value="<?=$row["id"];?>" />
			<td align="right"><?=$nRecord?></td>
			<? if ($_GET['idtt']<>"") { ?>
					<td align="left"><INPUT TYPE="text" NAME="namatt" size=40 class="form_isian" value="<?=$row["namatt"];?>"></td>
					<td align="left"><INPUT TYPE="text" NAME="namatt" size=40 class="form_isian" value="<?=$row["namatt"];?>"></td>
					<td align="left"><INPUT TYPE="text" NAME="namatt" size=40 class="form_isian" value="<?=$row["namatt"];?>"></td>
					<td align="left"><INPUT TYPE="text" NAME="namatt" size=40 class="form_isian" value="<?=$row["namatt"];?>"></td>
				<? } else { ?>
					<td><?=$row["namabrg"]?></td>
					<td><?=$row["satuan"]?></td>
					<td><?=$row["qty"]?></td>
					<td><?=$row["kemasan"]?></td>
				<? } ?>
			
			<? if ($_GET['idtt']<>"") { ?>
				<td align="center">
					<input type=image src="../images/approve.gif" border=0>
				</td>
				
				<td align="center"><a href="javascript:history.back()"><img src="../images/kal_prev.gif" width="10" height="18" border=0></a></td>
			<? } else { ?>
				<!--
				<td align="center"><a href=""><img src="../images/edit.gif" border=0></a></td> -->
				<td align="center"><a href="javascript:confirmDelete('submission_inv.php?iddel=<?=$row['id']?>&cmd=del_bj&id=<?=$_GET['id']?>')"><img src="../images/hapus.gif" border=0></a></td>
			<? } ?>
		  </form></tr>
		<?  
		 $nRecord = $nRecord + 1;
		} 
	} else { ?>
	  <tr>
		<td align="center" colspan="71"><font color="red">Mohon maaf, tidak ada Data dimaksud.</font></td>
	  </tr>
	<?  } ?>
		<? if ($_GET['idtt']=="") { ?>
			  <tr bgcolor="yellow">
				<form method="post" action="submission_inv.php" id="pegForm" >
				<input type=hidden name="cmd" value="add_bj">
				<input type="hidden" name="id" value="<?=$_GET['id']?>" />
				<td align="right"><img src="../images/kal_next.gif" border=0></td>
				<td align="left">
				<select name="kodeanak" id="kodeanak" class="required" title="Pilih Kode Barang">
					<option value="">-Pilih-</option>
					<?
						$SQLa = "SELECT * FROM stock where status = 1 AND grup NOT LIKE 'BAHAN JADI%'";
						$hasila = mysql_query($SQLa);
						while($barisa = mysql_fetch_array($hasila)){
					?>
					<option value="<?=$barisa['kodebrg']?>"><?=$barisa['kodebrg']?> -- <?=$barisa['namabrg']?></option>
					<? }?>
				</select>
				</td>
				<td><input type="text" name="satuan" id="satuan" class="required" readonly="true" title="Satuan harus terisi" size="20"/></td>
				<td><input type="text" name="isi" id="satuan2" class="required" title="Satuan harus terisi" size="5"/></td>
				<td><select name="kemasan" class="required" title="Kemasan harus dipilih">
                  <option value="">-Pilih-</option>
                  <option value="Y" <?if($kemasan=="Y"){?> selected="selected"<?}?>>Y</option>
                  <option value="T" <?if($kemasan=="T"){?> selected="selected"<?}?>>T</option>
                </select></td>
				<td colspan=3 align="center"><input type=image src="../images/add.gif" border=0></td>
			  </form></tr>
		<? } ?>
</table>
</body>
</html>
