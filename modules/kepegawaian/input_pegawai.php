<? include "otentik_kepeg.php"; include "../../config_sistem.php"; ?><head>
	<script type="text/javascript" src="../../assets/kalendar_files/jsCalendar.js"></script>
	<link href="../../assets/kalendar_files/calendar.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="../../assets/jquery-1.2.3.pack.js"></script>
	<!--
<script type="text/javascript" src="../../assets/jquery.validate.pack.js"></script>
	-->
<link href="../../assets/thickbox/thickbox.css" rel="stylesheet" type="text/css" />
 <script language="javascript" src="../../assets/thickbox/thickbox.js"></script>
<script type="text/javascript">

$(document).ready(function() {
	/*
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
	*/
})
</script>
  <script language="javascript">
   function selectBuku(no){
	   $('input[@name=finger]').val(no);
   }
  </script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /><style type="text/css">
<!--
body {
	background-image: url(../../images/bg2.png);
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
</style>
<? 
	include "include/globalx.php";
	include "include/functions.php";
?>
  <? $SQL = "select * from mastpegawai WHERE status = 1";
	 	if ($_GET['id']<>"")
		{ 
			$SQL = $SQL." AND idno = ". $_GET['id'];
		}
		$hasil = mysql_query($SQL);
		if($_GET['id']<>""){
			while ($baris=mysql_fetch_array($hasil)) {
				$idno = $baris['idno'];
				$noinduk = $baris['noinduk'];
				$nama = $baris['nama'];
				$alamat = $baris['alamat'];
				$notelp = $baris['notelp'];
				$jkel = $baris['jkel'];
				$tgl_lahir = $baris['tgllahir'];
				$jabatan = $baris['jabatan'];
				$departemen = $baris['departemen'];
				$tgl_mkerja= $baris['mulkerja'];
				$gaji_tipe = $baris['gaji_tipe'];
				$pendidikan = $baris['ri_pendidikan'];
				$pekerjaan = $baris['ri_pekerjaan'];
				$keluarga = $baris['ri_keluarga'];
				$finger = $baris['finger'];
				
			}
		}
	?>
<table width="1140" border="0">
  <tr>
    <td width="40"><img src="../../images/vcard_add.png" width="32" height="32" /></td>
    <td width="1090"><span class="style9">FORM KEPEGAWAIAN
      </span>
    <hr /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><form id="pegForm" method="post" name="pegForm" action="pegawai_submission.php">
      <? if($_GET['id']<>""){ ?>
      <input type="hidden" name="cmd" value="upd_peg" />
      <input type="hidden" name="id" value="<?=$idno?>" />
      <? } else { ?>
      <input type="hidden" name="cmd" value="add_pegawai" />
      <? } ?>
      <table align="left" class="x1">
        <tr background="../../images/impactg.png" height="30">
          <td colspan="3" align="center"><span class="style1">Form Kepegawaian</span></td>
        </tr>
        <tr>
          <td><span class="style6">Nomor Induk </span></td>
          <td><span class="style6">:</span></td>
          <td><input name="noinduk" type="text" class="required " id="noinduk"  title="Nomor Induk harus diisi" value="<?=$noinduk?>" <? if($_GET['id']<>""){?>readonly="true" <? }?> />
          </td>
        </tr>
        <tr>
          <td><span class="style6">Nama</span></td>
          <td><span class="style6">:</span></td>
          <td><input name="nama" type="text" class="required " id="nama"  title="Nama Induk harus diisi" value="<?=$nama?>" /></td>
        </tr>
        <tr>
          <td><span class="style6">Alamat</span></td>
          <td><span class="style6">:</span></td>
          <td><textarea name="alamat" cols="40" class="required style2 style7" id="alamat" title="Alamat harus diisi"><?=$alamat?>
    </textarea></td>
        </tr>
        <tr>
          <td><span class="style6">No. Telp</span></td>
          <td><span class="style6">:</span></td>
          <td><input name="notelp" type="text" class="required " id="notelp"  title="Nomor Telp harus diisi" value="<?=$notelp?>" maxlength="12" />
          </td>
        </tr>
        <tr>
          <td><span class="style6">Kelamin</span></td>
          <td><span class="style6">:</span></td>
          <td><span class="style6">
            <input type="radio" name="kelamin" value="L" <? if ($jkel == "L") {?> checked="checked" <? } ?>  class="required" />
            Laki - Laki &nbsp;&nbsp;
            <input type="radio" name="kelamin" value="P" <? if ($jkel == "P") {?> checked="checked" <? } ?>  class="required" />
            Perempuan</span></td>
        </tr>
        <tr>
          <td><span class="style6">Tanggal Lahir </span></td>
          <td><span class="style6">:</span></td>
          <td><span class="style6">
            <input name="tgl_lahir" id="tgl_lahir" size="10" type="text"  class="required"  title="Tanggal lahir harus diisi" value="<? if($tgl_lahir<>""){ echo baliktglindo($tgl_lahir);}?>" />
          <a href="javascript:showCalendar('tgl_lahir')"><img src="../../assets/kalendar_files/calendar_icon.gif" alt="2" border="0" /></a></span></td>
        </tr>
        <tr>
          <td><span class="style6">Jabatan</span></td>
          <td><span class="style6">:</span></td>
          <td><select name="slJabatan" class="required style2 style7"  title="Jabatan harus dipilih">
              <option value="">- Jabatan -</option>
              <?
		  		$SQL = "SELECT * FROM mastjabatan WHERE namajab <>'' AND status = 1";
				$hasil = mysql_query($SQL);
				while ($baris = mysql_fetch_array($hasil)) {
		  ?>
              <option value="<?=$baris["idjab"]?>" <? if ($baris["idjab"]==$jabatan) { ?>selected="selected" <? } ?>>
                <?=$baris["namajab"]?>
                </option>
              <?	} ?>
          </select></td>
        </tr>
        <tr>
          <td><span class="style6">Departemen</span></td>
          <td><span class="style7"></span></td>
          <td><select name="slDepartemen" class="required style2 style7"  title="Departemen harus dipilih">
              <option value="">- Departemen -</option>
              <?
		  		$SQL = "SELECT * FROM master_dept WHERE namadept <>'' AND status = 1";
				$hasil = mysql_query($SQL);
				while ($baris = mysql_fetch_array($hasil)) {
		  ?>
              <option value="<?=$baris["iddep"]?>" <? if ($baris["iddep"]==$departemen) { ?>selected="selected" <? } ?>>
              <?=$baris["namadept"]?>
              </option>
              <?	} ?>
          </select></td>
        </tr>
        <tr>
          <td><span class="style6">Mulai Bekerja </span></td>
          <td><span class="style6">:</span></td>
          <td><span class="style6">
            <input name="tgl_mkerja" id="tgl_mkerja" size="10" type="text" value="<? if($tgl_lahir<>""){ echo baliktglindo($tgl_mkerja);}?>" />
          <a href="javascript:showCalendar('tgl_mkerja')"><img src="../../assets/kalendar_files/calendar_icon.gif" alt="1" border="0" /></a></span></td>
        </tr>
        <tr>
          <td><span class="style6">Tipe Gaji </span></td>
          <td><span class="style6">:</span></td>
          <td><select name="gaji_tipe" class="required style2 style7" title="Pilih Tipe Penggajian">
              <option value="">-Tipe Gaji-</option>
              <option value="Bulanan" <? if($gaji_tipe =="Bulanan") {?> selected="selected" <? }?>>Bulanan</option>
              <option value="Mingguan" <? if($gaji_tipe =="Mingguan") {?> selected="selected" <? }?>>Mingguan</option>
              <option value="Harian" <? if($gaji_tipe =="Harian") {?> selected="selected" <? }?>>Harian</option>
            </select>
          </td>
        </tr>
        <tr>
          <td><span class="style6">Riwayat Pendidikan </span></td>
          <td><span class="style6">:</span></td>
          <td><textarea name="pendidikan" cols="40" rows="2" class="style2 style7" id="pendidikan"><?=$pendidikan?>
    </textarea></td>
        </tr>
        <tr>
          <td><span class="style6">Riwayat Pekerjaan </span></td>
          <td><span class="style6">:</span></td>
          <td><textarea name="pekerjaan" cols="40" rows="2" class="style2 style7" id="pekerjaan"><?=$pekerjaan?>
    </textarea></td>
        </tr>
        <tr>
          <td><span class="style6">Riwayat Keluarga </span></td>
          <td><span class="style6">:</span></td>
          <td><textarea name="keluarga" cols="40" rows="2" class="style2 style7" id="keluarga"><?=$keluarga?>
    </textarea></td>
        </tr>
        <tr>
          <td><span class="style6">Finger Print </span></td>
          <td><span class="style6">:</span></td>
          <td><span class="style6">
            <input type="text" name="finger" id="finger" readonly="true" size="10" value="<?=$finger?>"/>
          <a href="daftar_finger.php?width=500&amp;height=400&amp;TB_iframe=true" class="thickbox"></a> </span></td>
        </tr>
        <tr>
          <td><span class="style7"></span></td>
          <td><span class="style7"></span></td>
          <td><span class="style6">
            <? if($_GET['id']<>""){ ?>
            <input name="submit" type="submit" value="Update" />
            <? } else { ?>
            <input name="submit" type="submit" value="Simpan" />
            <? } ?>
            <input name="button" type="button" onclick="javascript:history.back()" value="Batal" />
          </span></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>
