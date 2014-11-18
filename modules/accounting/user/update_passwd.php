<? if ($_GET['update']<>"") { ?>

	<script language="JavaScript">

	<!--

		alert ("Password Telah Terupdate. \nTerima kasih.");

	//-->

	</script>

<? } ?>
<script type="text/javascript" src="../assets/jquery-1.2.3.pack.js"></script>
<script type="text/javascript" src="../assets/jquery.validate.pack.js"></script>
<script type="text/javascript">

$(document).ready(function() {
	
<? if($_GET['id']==""){ ?>	
    $("#username").val('');
	$("#password").val('');
	$("#password_again").val('');
<? } ?>
	
	$("#userForm").validate({
		rules: {
			passwd: "required",
			passwd2: {
		equalTo: "#passwd"
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
<form id="userForm" method="post" action="user_submission.php">
<input type="hidden" name="cmd" value="upd_passwd">
<table class="x1">
	<tr>
		<td>Nama</td>
		<td><input type="text" name="nama" id="nama" readonly="true" class="required" title="*" value="<?=$_SESSION["sess_name"]?>" /></td>
	</tr>
	<tr>
		<td>User Name</td>
		<td><input type="text" name="usernama" readonly="true" id="usernama" class="required" title="*" value="<?=$_SESSION["sess_uname"]?>" /></td>
	</tr>
	<tr>
		<td>Password Baru</td>
		<td><input type="password" name="passwd" id="passwd" title="Harus Terisi." class="required" /></td>
	</tr>
	<tr>
		<td>Ulangi Password</td>
		<td><input type="password" name="passwd2" id="passwd2" title="Harus sama dengan Password Baru." class="required" /></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" value="Simpan"></td>
	</tr>
</table>
</form>