<?php  session_start(); ?>
<?php  include "../include/otentik_admin.php"; include ("../include/functions.php");?><head>
<script type="text/javascript" src="../assets/kalendar_files/jsCalendar.js"></script>
<link href="../assets/kalendar_files/calendar.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../assets/jquery-1.2.3.pack.js"></script>
<script type="text/javascript" src="../assets/jquery.validate.pack.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	
	$("#frmijin").validate({
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
})
</script>
<script type="text/javascript">
function confirmDelete(delUrl) {
	if (confirm("Data ini akan dihapus!\nApakah Anda yakin untuk menghapusnya ?")) {
			document.location = delUrl;
		}
	}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /><style type="text/css">
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
</style></head>



<style type="text/css">
* { font: 11px/20px Verdana, sans-serif; }
h4 { font-size: 18px; }
input.error, select.error { border: 1px solid red; }
label.error { color:red; margin-left: 10px; }
td { padding: 5px; }
</style>
<?php   
	include "../include/globalx.php"; ?>
<?php 
	$SQL = "SELECT * FROM $database.jenis WHERE kode <> ''";
	if ($_GET['id']<>"") {
		$SQL = $SQL." and kode='".$_GET['id']."'";
	}
	$SQL = $SQL." ORDER BY nama ASC";
	//echo $SQL;
	$hasil=mysql_query($SQL, $dbh_jogjaide);
?>
<table width="1140" border="0">
  <tr>
    <td width="32"><img src="../images/calendar.png" width="32" height="32" /></td>
    <td width="1090"><span class="style1">SETUP JENIS 
      </span>
      <hr /></td>
  </tr>
  <tr>
    <td width="32">&nbsp;</td>
    <td><table border="1" align="left" cellpadding="3" cellspacing="0" bordercolorlight="silver" bordercolordark="#FFFFFF">
      <?php  if ($_GET['id']<>"") {?>
      <tr>
        <td background="../images/impactg.png" colspan="9" align="center"><font color="white"><b>Edit Divisi </b></font></td>
      </tr>
      <?php  } else { ?>
      <tr>
        <td background="../images/impactg.png" colspan="9" align="center"><strong><font color="white">MASTER JENIS </font></strong></td>
      </tr>
      <?php  } ?>
      <tr bgcolor="#FFCC00">
        <td width="34" align="center"><strong>No</strong></td>
        <td width="150" align="center"><strong>Kode  </strong></td>
        <td width="150" align="center"><strong>Nama  </strong></td>
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
        <form name="frmijin" id="frmijin" method="post" action="submission_cafe.php">
          <input type="hidden" name="cmd" value="add_jenis" />
          <td align="center"><img src="../images/kal_next.gif" alt="Selanjutnya" border="0" /></td>
          <td align="center"><input type="text" name="kode" size="20" class="required" title="*" maxlength="2"></td>
          <td align="center"><input type="text" name="nama" size="50" class="required" title="*"></td>
          <td align="center" colspan="4"><input name="image" type="image" src="../images/add.gif" border="0" /></td>
        </form>
      </tr>
      <?php  } ?>
      <?php 	 
		$nRecord = 1;
		if (mysql_num_rows($hasil) > 0) { 
		while ($row=mysql_fetch_array($hasil)) { 
	?>
      <tr <?php 	 if (($nRecord % 2)==0) {?>bgcolor="#FFFFFF"<?php  } else {?> else="else" bgcolor="#CCCCCC"<?php  }?>>
        <form action="submission_cafe.php" method="post" name="frmijin" id="frmijin">
          <input type="hidden" name="id" value="<?php  echo $_GET['id']?>" />
          <input type="hidden" name="cmd" value="upd_jenis" />
          <td align="center"><?php  echo $nRecord?></td>
          <td align="center"><?php  if ($_GET['id']<>"") { ?>
            <input type="text" name="kode" size="20" class="required" title="*" maxlength="2" value="<?php  echo $row['kode']?>">
            <?php  } else { ?>
              <?php  echo $row["kode"]?>
              <?php  } ?>
          </td>
          <td align="left"><?php  if ($_GET['id']<>"") { ?>
            <input type="text" name="nama" size="50" class="required" title="*"  value="<?php  echo $row['nama']?>">
            <?php  } else { ?>
              <?php  echo $row["nama"]?>
              <?php  } ?></td>
          <?php  if ($_GET['id']<>"") { ?>
          <td align="center"><input name="image" type="image" src="../images/approve.gif" border="0" /></td>
          <td align="center"><a href="javascript:history.back()"><img src="../images/kal_prev.gif" alt="Sebelumnya" border="0" /></a></td>
          <?php  } else { ?>
          <td align="center"><a href="?id=<?php  echo $row["kode"]?>"><img src="../images/edit.gif" alt="Edit" border="0" /></a></td>
          <td align="center"><a href="javascript:confirmDelete('submission_cafe.php?id=<?php  echo $row["kode"]?>&amp;cmd=del_jenis')"><img src="../images/hapus.gif" alt="Hapus" border="0" /></a></td>
          <?php  } ?>
        </form>
      </tr>
      <?php   
		 $nRecord = $nRecord + 1;
		} 
	} else { ?>
      <tr>
        <td align="center" colspan="9"><font color="red">Mohon maaf, tidak ada Data dimaksud.</font></td>
      </tr>
      <?php   } ?>
    </table></td>
  </tr>
</table>
