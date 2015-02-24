<?php @session_start();

	include "../../otentik.php";
	include "../../config_sistem.php";
	include "../../include/functions.php";
	
	//insert	
	
	
	
	//delete
	if(isset($_GET["cmd"]) && $_GET["cmd"] == "update_status"){
		$sql = "UPDATE donasi SET statusx = 'Arrived' WHERE
			id = '".$_GET["id_detail"]."'
		";
		$hasil = mysql_query($sql) or die(mysql_error());
	}
	//delete
	
	if(isset($_GET["cmd"]) && $_GET["cmd"] == "update_status2"){
		$sql = "UPDATE donasi SET statusx = 'Not Arrived' WHERE
			id = '".$_GET["id_detail"]."'
		";
		$hasil = mysql_query($sql) or die(mysql_error());
	}
?>

<script type="text/javascript" src="../../assets/jquery.js"></script>
<script src="../../assets/jquery.loader.js"></script>
<link href="../../assets/jquery.loader.css" rel="stylesheet" /></script>
<link rel='stylesheet' type='text/css' href='../../assets/jquery.autocomplete.css'/>
    <script type='text/javascript' src='../../assets/jquery.autocomplete.js'></script>
    <script type='text/javascript' src='../../assets/localdata.js'></script>
<script type="text/javascript" src="../../assets/kalendar_files/jsCalendar.js"></script>
<link href="../../assets/kalendar_files/calendar.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
function validasi(){
	if ( $('#notamuatan').val()==""){
			alert("Nomer Nota  Harus Terisi. Klik Baru Dahulu.");
				//document.pengiriman-form.norm.focus();
				return false;
		}	
}
$().ready(function() {
	

	 
	//cari route
    $("#cari").click(function(){

		
			 window.location.href = "route_status.php?noresi="+$('#resi').val();

     })
	 

	
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
	nilaix = "<?php  echo $_SESSION["sess_tipe"]?>";

	$("#ppk").autocomplete("autocomp.php?divisi="+nilaix+"&tipe=resi", {
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
			var str = data[1];
			var res = str.split("-"); 
			$("#resi").val(res[0]);
			// -----
	});
	

	

});

function kosongtext(){
	document.frmijin.ppk.value = "";
	document.frmijin.resi.value = "";
}
function kosongtextArmada(){
	document.frmijin.nopol.value = "";
	document.frmijin.angkutan_id.value = "";
}
function kosongtextarray(){
	$('input[@name=text_array]').click(
	function(){
	  $(this).val('');
	}
  );
}


		
</script>
<style type="text/css">
.rowTengah {
	text-align: center;
}
.rowKanan {
	text-align: right;
}
.rowKiri {
	text-align: left;
}
</style>
<form name="frmijin" id="frmijin" method="post" action="route.php">
<input type="hidden" name="cmd" value="search" /><span class="loading"></span><div id="test3response"></div>
  <?php 
  	$SQLe = "SELECT * FROM muatan WHERE notamuatan = '". $_GET["id"] ."'";
	$hasile = mysql_query($SQLe) or die(mysql_error());
	$barise = mysql_fetch_array($hasile);
  
  ?>
<table width="1000px" border="0" align="center">
  <tr class="rowTengah">
    <td colspan="3" class="rowTengah">DAFTAR ROUTE</td>
  </tr>
  <tr class="rowTengah">
    <td colspan="3" class="rowTengah"><table width="100%" border="1" style="border-collapse:collapse">
      <tr>
        <td width="100%">&nbsp;
          <input type="text" name="resisearch" id="ppk" size="50" onclick="kosongtext()"  />
          &nbsp;<input name="resi" type="text" id="resi" value="<?php echo $_GET["noresi"]; ?>" size="18" readonly="readonly" class="required" title="Kode Resi Harus Terisi !"/><input type="button" id="cari" value="Search" /></td>
        </tr>
      <?php
	  	$SQL = "SELECT * FROM muatan_detail WHERE notamuatan = '".$_GET["id"]."'";
		$hasil = mysql_query($SQL) or die(mysql_error());
		while($baris=mysql_fetch_array($hasil)){
	  ?>
      <?php
	  
		}
		
		?>
    </table></td>
  </tr>
  <tr class="rowTengah">
    <td width="492" class="rowTengah">&nbsp;</td>
    <td width="490">&nbsp;</td>
  </tr>
  <tr class="rowTengah">
    <td colspan="2" class="rowTengah"><table width="100%" border="1" style="border-collapse:collapse">
      <tr bgcolor="#CCCCCC" class="rowTengah">
        <td width="12%">No.</td>
        <td width="26%">Dari</td>
        <td width="29%">Tujuan</td>
        <td width="22%">Status</td>
        <td width="11%">#</td>
      </tr>
      <?php
	  	$sqljurnal = "SELECT * FROM donasi WHERE noresi = '".$_GET["noresi"]."' ORDER BY id ASC"; 
		$hasiljurnal = mysql_query($sqljurnal);
		while($barisjunal = mysql_fetch_array($hasiljurnal)){
	  ?>
      <tr>
        <td align="center"><?php echo ++$no; ?>.</td>
        <td align="center"><?php echo ($barisjunal["dari"]);?></td>
        <td align="center"><?php echo ($barisjunal["tujuan"]);?></td>
        <td align="center"><?php echo ($barisjunal["statusx"]);?></td>
        <td align="center">
        <?php if($barisjunal["statusx"]=="Not Arrived") { ?>
        <a href="route_status.php?cmd=update_status&amp;noresi=<?php echo $_GET["noresi"];?>&amp;id_detail=<?php echo $barisjunal["id"];?>" >Do!</a>
        <?php } else { ?>
        <a href="route_status.php?cmd=update_status2&amp;noresi=<?php echo $_GET["noresi"];?>&amp;id_detail=<?php echo $barisjunal["id"];?>" >Do!</a>
		
		<?php } ?>
        </td>
      </tr>
      <?php } ?>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="center">&nbsp;</td>
      </tr>
    </table></td>
    </tr>
</table>
</form>