<?php 
/**
 *	Copyright (C) CV. Jogjaide Ent.
 *  Project Manager : Nanang Rustianto
 *  Lead Programmer : Nanang Rustianto
 *  Email : anangr2001@yahoo.com
 *	Date: April 2014
**/
?>
<?php  
	if (!isset($_SESSION['is_login'])) { exit; }
	include "../include/otentik_admin.php"; 
	
	if($_GET['id']<>""){
		$SQL = "SELECT * FROM ml_user WHERE status = 1 AND id = ".$_GET['id'];
		$hasil = mysql_query($SQL, $dbh_jogjaide);
		while($row=mysql_fetch_array($hasil)) {
			$id = $row['id'];
			$user = $row['user'];
			$nama = $row['nama'];
			$kelasuser = $row['kelasuser'];
			$aktif = $row['aktif'];
			$password = "";
			$tipe = $row['tipe'];
		}
	}
?>
<script type="text/javascript" src="../assets/jquery-1.2.3.pack.js"></script>
<script type="text/javascript" src="../assets/jquery.validate.pack.js"></script>
<script type="text/javascript">

$(document).ready(function() {
	
<?php  if($_GET['id']==""){ ?>	
    $("#username").val('');
	$("#password").val('');
	$("#password_again").val('');
<?php  } ?>
	
	$("#userForm").validate({
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
<style type="text/css">
* { font: 11px/20px Verdana, sans-serif; }
h4 { font-size: 18px; }
input { padding: 3px; border: 1px solid #999; }
input.error, select.error { border: 1px solid red; }
label.error { color:red; margin-left: 10px; }
td { padding: 5px; }
</style>
<br>
<form id="userForm" method="post" action="admin_submission.php">
<?php  if($_GET['id']<>""){ ?>
<input type="hidden" name="cmd" value="upd_user">
<input type="hidden" name="id" value="<?php  echo $id?>" />
<?php  } else { ?>
<input type="hidden" name="cmd" value="add_user">
<?php  } ?>
<table align="center" class="x1">
	<tr>
		<td>Username</td>
		<td>:</td>
		<td><input type="text" id="username" name="username"  class="required"  title="Username harus diisi" value="<?php  echo $user?>"/></td>
	</tr>
	<?php  if($_GET['id']==""){ ?>
	<tr>
		<td>Password</td>
		<td>:</td>
		<td><input type="password" id="password" name="password"  class="required"  title="Password harus diisi" value="<?php  echo $password?>"/>		</td>
	</tr>
	<tr>
		<td>Confirm Password</td>
		<td>:</td>
		<td><input type="password" name="password_again" id="password_again"   class="required"  title="isikan Password yg sama di atas" value="<?php  echo $password?>" /></td>
	</tr>
	<?php  } ?>
	<tr>
		<td>Nama</td>
		<td>:</td>
		<td><input type="text" name="nama"  class="required"  title="Nama harus diisi" value="<?php  echo $nama?>"/></td>
	</tr>
	<tr>
		<td>Kelas User</td>
		<td>:</td>
		<td><select name="slKelas" class="required"  title="Tipe Login harus diisi">
          <option value="">- Pilih Tipe Login -</option>
		  <option value="User" <?php  if($kelasuser=="User") { ?>selected="selected" <?php  } ?>>User</option>
		  <option value="Admin" <?php  if($kelasuser=="Admin") { ?>selected="selected" <?php  } ?>>Admin</option>
		  <option value="Super Admin" <?php  if($kelasuser=="Super Admin") { ?>selected="selected" <?php  } ?>>Super Admin</option>
        </select></td>
	</tr>
	<tr>
	  <td>Divisi</td>
	  <td>:</td>
	  <td><select name="slTipe" class="required"  title="Tipe Akses harus diisi">
        <option value="">- Pilih -</option>
		<?php 
			$SQL = "SELECT * FROM divisi";
			$hasil = mysql_query($SQL);
			while($baris=mysql_fetch_array($hasil)){
		?>
	        <option value="<?php  echo $baris['subdiv']?>" <?php  if($tipe==$baris['subdiv']) { ?>selected="selected" <?php  } ?>><?php  echo $baris['namadiv']?></option>
		<?php  } ?>
      </select></td>
    </tr>
	<tr>
		<td>Status</td>
		<td>:</td>
		<td><input type="radio" name="status" value="1" <?php  if ($aktif == "1") {?> checked="checked" <?php  } ?>  class="required" title="Pilih On atau Off">On &nbsp;&nbsp;<input type="radio" name="status" value="0" <?php  if ($aktif == "0") {?> checked="checked" <?php  } ?>  class="required"  title="Pilih On atau Off">Off</td>
	</tr><tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>
			<?php  if($_GET['id']<>""){ ?>
			<input type="submit" value="Update">
			<?php  } else { ?>
			<input type="submit" value="Tambah">
			<?php  } ?>
			<input type="button" value="Batal" onclick="javascript:history.back()">		</td>
	</tr>
</table>
</form>