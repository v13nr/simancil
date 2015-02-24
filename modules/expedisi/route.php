<?php @session_start();
die("Fungsi Dimatikan.");
	include "../../otentik.php";
	include "../../config_sistem.php";
	include "../../include/functions.php";
	
	//insert	
	
	if(isset($_GET["action"]) && $_GET["action"]=="add_route"){
		$sql = "INSERT INTO donasi SET
			noresi = '".$_POST["resi"]."',
			dari = '".$_POST["dari"]."',
			tujuan = '".$_POST["tujuan"]."'
		";
		$hasil = mysql_query($sql) or die(mysql_error());
		
	}
	
	
		
	
	//delete
	if(isset($_GET["cmd"]) && $_GET["cmd"] == "delete"){
		$sql = "DELETE FROM donasi WHERE
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

		
			 window.location.href = "route.php?noresi="+$('#resi').val();

     })
	 
	//simpan route
    $("#submit-form-route").click(function(){

		$.loader({content:"<div>Mengirim Data Ke Server ...</div>"});
         $.ajax({
           url : "route.php?action=add_route", 
           type: "post", //form method
           data: $("#frmijin").serialize(),
           //dataType:"json", 
           beforeSend:function(){
           },
           success:function(result){
             if(result.status){
             }else{
             }
			 $.loader('setContent', '<div>Datas received !<br /> Still processing ...</div>');
			$('#test3response').fadeIn(4000, function(){$.loader('close');});
			 alert("Data Telah Tersimpan");
             $(".loading").html("");
			 window.location.href = "route.php?noresi="+$('#resi').val();
			  
			 //$(":input").not(":button,:button, :submit, :reset, :hidden").each( function() {
					//this.value = this.defaultValue;     
				//}); //reset
	
           },
           error: function(xhr, Status, err) {
			 $.loader('close');
             alert("Terjadi error : "+Status);
           }
         });
       return false;
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
      <tr>
        <td width="12%">&nbsp;</td>
        <td width="37%"><input type="text" name="dari" id="dari" size="40" /></td>
        <td width="40%"><input type="text" name="tujuan" id="tujuan" size="40" /></td>
        <td width="11%"><input type="button"  id="submit-form-route"
value="Tambah" /></td>
      </tr>
      <tr bgcolor="#CCCCCC" class="rowTengah">
        <td>No.</td>
        <td>Dari</td>
        <td>Tujuan</td>
        <td>#</td>
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
        <td align="center"><a href="route.php?cmd=delete&amp;noresi=<?php echo $_GET["noresi"];?>&amp;id_detail=<?php echo $barisjunal["id"];?>" >Hapus</a></td>
      </tr>
      <?php } ?>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
    </tr>
</table>
</form>