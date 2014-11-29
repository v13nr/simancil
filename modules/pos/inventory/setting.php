<?php  include "otentik_inv.php"; ?><head>


	<script type="text/javascript" src="../assets/jquery-1.2.3.pack.js"></script>
<script type="text/javascript" src="../assets/jquery.validation.nanang.js"></script>

 <script type="text/javascript">

$(document).ready(function(){
	
		$("#pegForm").validate({
		rules: {
            "norek[]": "required"
        },
        messages: {
            "norek[]": "Kotak Merah Harus Terisi"
        },
		errorPlacement: function(error, element) {
			error.appendTo(element.parent("td"));
		}
	});
});
	
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
.style6 {font-family: "Segoe UI"; font-size: 12; }
.style7 {font-size: 12}
.style9 {
	font-family: "Segoe UI";
	font-size: 12px;
	font-weight: bold;
	color: #0000FF;
}
input.kanan{ text-align:right; }
.style10 {color: #FFFFFF}
</style>
<?php  
	include "../include/globalx.php";
	include "../include/functions.php";
?>

<table width="1140" border="0">
  <tr>
    <td width="40"><img src="../images/vcard_add.png" width="32" height="32" /></td>
    <td width="1090"><span class="style9">SETTING REKENING DEFAULT
      </span>
      <hr /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><form id="pegForm" method="post" name="pegForm" action="submission_inv.php">
      <input type="hidden" name="cmd" value="upd_setting" />
      <table align="left">
        <tr background="../images/impactg.png" height="30">
          <td align="center"><span class="style10">NAMA</span></td>
          <td align="center">&nbsp;</td>
          <td align="center"><span class="style10">NOREK</span></td>
        </tr>
		<?php 
			$SQL = "SELECT * FROM setting";
			$hasil = mysql_query($SQL, $dbh_jogjaide);
			while($baris = mysql_fetch_array($hasil)){
		?>
		<input type="hidden" name="id[]" value="<?php  echo $baris['id']?>" />
        <tr bgcolor="#CCCCCC">
          <td><?php  echo $baris['setting']?></td>
          <td>:</td>
          <td><input type="text" name="norek[]" class="required" maxlength="7" size="15" title="Harus Terisi" value="<?php  echo $baris['norek']?>"></td>
        </tr>
		<?php  }?>
        <tr bgcolor="#CCCCCC">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2"><div id="divAlert"></div></td>
        </tr>
        <tr bgcolor="#CCCCCC">
          <td><span class="style7"></span></td>
          <td><span class="style7"></span></td>
          <td colspan="2"><span class="style6">
            <input name="submit" type="submit" value="Update" />
            <input name="button" type="button" onClick="javascript:history.back()" value="Batal" />
          </span></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>
 <?php  if ($_GET['confirm']<>"") { ?>

	<script language="JavaScript">

	<!--

		alert ("Jika Norek Kembali Kosong, Artinya Norek Tersebut tidak ditemukan. \nTerima kasih.");

	//-->

	</script>

<?php  } ?>