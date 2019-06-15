<?php  include "otentik_gli.php"; ?><head>
 
	<script type="text/javascript" src="../assets/jquery-1.2.3.pack.js"></script>
<script type="text/javascript" src="../assets/jquery.validate.pack.js"></script>
 <script language="javascript" src="../assets/thickbox/thickbox.js"></script>
 <link href="../assets/thickbox/thickbox.css" rel="stylesheet" type="text/css" />
 
 
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
	color: #00000000;
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
	color: #00000FF;
}
</style>
<?php  
	include "../include/globalx.php";
	include "../include/functions.php";



cekAkses($_SESSION["sess_user_id"], 'rekeningp_ls');
?>
  <?php  $SQL = "select * from $database.rekening WHERE status = 1";
	 	if ($_GET['id']<>"")
		{ 
			$SQL = $SQL." AND norek = '". $_GET['id']."'";
		}
		
		$hasil = mysql_query($SQL, $dbh_jogjaide) or die(mysql_error());
		if($_GET['id']<>""){
			while ($baris=mysql_fetch_array($hasil)) {
				$induk = substr($baris['norek'],0,4);
					$SQLc = "SELECT namarek FROM $database.rek WHERE norek LIKE '$induk%' AND status = 1";
					$hasilc = mysql_query($SQLc, $dbh_jogjaide);
					$barisc = mysql_fetch_array($hasilc);
					$namarekeninginduk = $barisc[0];
					$split = split('-',$baris['norek']);
				$norek = $split[1];
				$namarekening = $baris['namarek'];
				$tipe = $baris['tipe'];
				$saldoawal = $baris['saldoawal'];
				$saldoakhir = $baris['saldoakhir'];
				$debet = $baris['debet'];
				$kredit = $baris['kredit'];
				$saldonormal = $baris['saldonormal'];
				$saldoakhir = $baris['saldoakhir'];
			}
		}
	?>
<table width="1140" border="0">
  <tr>
    <td width="40"><img src="../images/vcard_add.png" width="32" height="32" /></td>
    <td width="1090"><span class="style9">FORM REKENING PEMBANTU
      </span>
      <hr /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><form id="pegForm" method="post" name="pegForm" action="submission_gli.php">
      <?php  if($_GET['id']<>""){ ?>
      <input type="hidden" name="cmd" value="upd_rekeningp" />
      <input type="hidden" name="id" value="<?php  echo $norek?>" />
      <?php  } else { ?>
      <input type="hidden" name="cmd" value="add_rekeningp" />
      <?php  } ?>
      <table align="left" class="x1">
        <tr background="../images/impactg.png" height="30">
          <td colspan="3" align="center"><span class="style1">Form Rekening Pembantu </span></td>
        </tr>
        <tr>
          <td><span class="style6">Nomor Rekening Induk </span></td>
          <td>:</td>
          <td><input name="induk" type="text" id="induk"  maxlength="4" class="required " title="Nomor Rekening harus diisi" value="<?php  echo $induk?>" readonly="true" />
            <a href="daftar_rek.php?width=400&amp;height=350&amp;TB_iframe=true" class="thickbox"><img src="../assets/button_search.png" alt="Pilih Akun" border="0" /></a>
            <div id="divAlert"></div></td>
        </tr>
        <tr>
          <td><span class="style6">Nama Rekening Induk </span></td>
          <td>:</td>
          <td><input name="namarekeninginduk" size="40" type="text" class="required " id="namarekeninginduk"  title="Nama Rekening induk harus terisi" value="<?php  echo $namarekeninginduk?>" readonly="true" /></td>
        </tr>
        <tr>
          <td><span class="style6">Tipe</span></td>
          <td><span class="style6">:</span></td>
          <td><input type="text" name="tipe" id="tipe" class="required" title="Tipe Rekening harus terisi" value="<?php  echo $tipe?>"  readonly="true"  /></td>
        </tr>
        <tr> 
          <td><span class="style6">Nomor Rekening </span></td>
          <td><span class="style6">:</span></td>
          <td><input name="norek" type="text" id="suggest"  maxlength="4" class="required " title="Nomor Rekening Pembantu harus diisi" value="<?php  echo $norek?>" <?php  if($_GET['id']<>""){?>readonly="true" <?php  }?> /></td>
        </tr>
        <tr>
          <td><span class="style6">Nama Rekening </span></td>
          <td><span class="style6">:</span></td>
          <td><input name="namarekening" size="40" type="text" class="required " id="namarekening"  title="Nama Rekening harus diisi" value="<?php  echo $namarekening?>" /></td>
        </tr>
        <tr>
          <td>Saldo Normal </td>
          <td>:</td>
          <td><select name="saldonormal" class="required">
		  	<option value="">-Pilih-</option>
			<option value="D" <?php  if($saldonormal == "D") { ?>selected="selected" <?php  } ?>>Debet</option>
			<option value="K" <?php  if($saldonormal == "K") { ?>selected="selected" <?php  } ?>>Kredit</option>
		  </select></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><input name="saldoawal" type="hidden" class="required " id="saldoawal"  title="Saldo Awal harus diisi" value="0" maxlength="12" />          <input name="debet" type="hidden" class="required " id="debet"  title="Debet harus diisi" value="0" maxlength="12" />
            <input name="kredit" type="hidden" class="required " id="kredit"  title="Kredit harus diisi" value="0" maxlength="12" />
            <input name="saldoakhir" type="hidden" class="required " id="saldoakhir"  title="Saldo Akhir harus diisi" value="0" maxlength="12" /></td>
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
