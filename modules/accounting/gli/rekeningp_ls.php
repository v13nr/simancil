<?php  @session_start; 
include "../../../config_sistem.php";
include "otentik_gli.php"; 
include ("../include/functions.php");

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script  type="text/javascript"  src="../assets/jquery.js"></script>
<script type='text/javascript'>

		function formatCurrency(num) {
		num = num.toString().replace(/\$|\,/g,'');
		if(isNaN(num))
		num = "0";
		sign = (num == (num = Math.abs(num)));
		num = Math.floor(num*100+0.50000000001);
		cents = num%100;
		num = Math.floor(num/100).toString();
		if(cents<10)
		cents = "0" + cents;
		for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
		num = num.substring(0,num.length-(4*i+3))+','+
		num.substring(num.length-(4*i+3));
		//return (((sign)?'':'-') + '$' + num + '.' + cents);
		return (((sign)?'':'-') + num);
	}
	
   
</script>
<script  type="text/javascript"  src="../assets/app.js"></script>
<script language="javascript" type="text/javascript">
	var site = '<?php   echo $url_site_neraca_awal; ?>';
	//var site = 'http://indowebit.web.id/modules/accounting/gli/';
	function neraca_awal()
	{
		ajaxSubmit(document.myform,"get_class.neraca_awal.php","#konten");
	}
	function PopUp(url){
	window.open(url,'', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=400,height=100,left = 200,top = 200');
	}
	$(document).ready(function(){
		a = "";
		$.each( $('#konten :text'), function() {
             a = a + $(this).attr("name") + "#";
        });
		$('input[@name=cekb]').val(a);
		
		 $.each($('.kanan'), function()
    {
       $(this).keyup( function(){ 
	   		$(this).val(formatCurrency($(this).val()));
		} );
    });

		});
</script>

<SCRIPT language=javascript src="../assets/app.js"></SCRIPT>
<style type="text/css">
<!--
body {
	background-image: url(../images/ok.jpg);
	background-repeat: repeat;
}
.style3 { font-family: "Segoe UI"; font-size: 12px; }
.style4 {color: #FFFFFF}
.style5 {color: #000000; }
-->
</style></head>

<body>
<div id="konten" align="center">

<form id='myform' method="post" action="submission_gli.php">

<input type="hidden" name="cekb"/>
<input type="hidden" name="cmd" value="del_rekp" />
  <table width="1024" border="0" cellspacing="1" class="style3">
    <tr>
      <td width="2" rowspan="4">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="53" rowspan="3" valign="bottom"><div align="center" class="style4"><a href="index.php?mn=input_rp"><img src="../images/user_add.png" width="32" height="32" border="0" align="absbottom" class="style3" /></a></div></td>
      <td width="51" rowspan="3" valign="bottom"><div align="center" class="style4"><input type="image" src="../images/user_delete.png" width="32" height="32" /></div></td>
      <td width="24" rowspan="3" valign="bottom"><div align="center"><a  onclick="neraca_awal()" href="javascript:void(0)" ><img src="../images/fileex.png" border="0" width="32" height="32" /></a></div></td>
      <td width="25" rowspan="3" valign="bottom">&nbsp;</td>
      <td width="50" rowspan="3" valign="bottom"><div align="center"><a href="exportrp.php"><img src="../images/fileex.png" border="0" width="32" height="32" /></a></div></td>
      <td width="48" rowspan="3">&nbsp;</td>
      <td width="1" rowspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td width="17"><div align="center"><img src="../images/calendar.png" width="16" height="16" /></div></td>
      <td width="4"><div align="center">:</div></td>
      <td width="722">&nbsp; 
	  <?php  date_default_timezone_set('Asia/Shanghai'); echo date('l, j F Y'); ?></td>
      </tr>
    <tr>
      <td class="style3"><div align="center"><img src="../images/Gnome-Appointment-New-48.png" width="16" height="16" /></div></td>
      <td class="style3"><div align="center">:</div></td>
      <td class="style3"><div align="left"> &nbsp;<?php  echo gmdate(" H:i:s", time()+60*60*7); ?>  </div></td>
    </tr>
    <tr>
      <td class="style3"><div align="center"><img src="../images/user.png" width="16" height="16" /></div></td>
      <td class="style3"><div align="center">:</div></td>
      <td class="style3"><div align="left">&nbsp;Admin General Ledger </div></td>
      <td class="style3"><div align="center" class="style5">Tambah</div></td>
      <td class="style3"><div align="center" class="style5">Hapus</div></td>
      <td colspan="2" class="style3"><div align="center" class="style5">Saldo Awal</div></td>
      <td class="style3" colspan="2"><div align="left"><span class="style5"></span>Export To MS-Excell</div></td>
      <td><span class="style5"></span></td>
    </tr>
    <tr>
      <td colspan="11">&nbsp;</td>
    </tr>
  </table>
  <table width="1000" border="0" bgcolor="#000000" cellspacing="1">
    <tr height="30" background="../images/impactg.png">
	  <td width="46" class="style3"><div align="center" class="style4">No.</div></td>
      <td width="53" class="style3"><div align="center" class="style4">#</div></td>
      <td width="142" class="style3"><div align="center" class="style4">No. Rekening </div></td>
      <td width="382" class="style3"><div align="center" class="style4">Nama Rekening </div></td>
      <td width="54" class="style3"><div align="center" class="style4">Type</div></td>
      <td width="80" class="style3"><div align="center" class="style4">Saldo Normal</div></td>
	  <?php  if($_SESSION['sess_kelasuser']=="Super Admin"){?>
	  <td width="107" class="style3"><div align="center" class="style4">Saldo Awal </div></td>
	  <?php  }?>
      <td width="111" class="style3"><div align="center" class="style4">Edit</div></td>
    </tr>
	<?php 
		$SQL = "select * FROM $database.rekening WHERE status = 1 AND divisi = '".$_SESSION["sess_tipe"]."'" ;
		
		$SQL = $SQL." ORDER BY  tipe, norek ASC";
		$hasil=mysql_query($SQL, $dbh_jogjaide);
		$id = 0;
	?>
	<?php  
		$tampil = 0; 
		 $nRecord = 1;
		 $No = 0;
			if (mysql_num_rows($hasil) > 0) { 
			while ($row=mysql_fetch_array($hasil)) { 
			$tampil = (substr($row['norek'],-3)<>"000" && ($row['tipe']=="A"  || $row['tipe']=="P" )) ? 1 : 0;
 	?>
    <tr <?php 	 if (($nRecord % 2)==0) {?>bgcolor="#e4e4e4"<?php  }  else {?>bgcolor="#FFFFCC"<?php  } ?>>
      <td align="center" class="style3"><?php  echo ++$No?></td>
	  <td class="style3" align="center">
	  <?php  if(substr($row['norek'],-4)<>"0000") {?>
	  	<input type="checkbox" id="tambah" name="tambah[]" value="<?php  echo $row['norek'] ?>" /></td>
		<?php  } ?>
	  <td class="style3" style="padding-left:10" align="center"><?php 
	  
	  if(substr($row["norek"],-4)=="0000"){
			echo "";		  
	  } else {
	  		$split = split("-",$row["norek"]);
		  	echo $split[1];
	  }
	  ?></td>
      <td class="style3" style="padding-left:10" ><?php 
	  
	  if(substr($row["norek"],-4)=="0000"){
	  		echo "<b>". $row['namarek'] ."</b>";
	  } else {
	  		echo $row['namarek'] ;
	  
	  }
	  ?></td>
      <td class="style3" align="center"><?php  echo $row['tipe']?></td>
      <td class="style3" align="center"><?php  echo $row['saldonormal']?></td>
	  <?php  if($_SESSION['sess_kelasuser']=="Super Admin" ){?>
	  <td class="style3" align="center"><?php  echo  ($tampil == 1) ? '<input type="textbox"  class=""  name="'.$row['norek'].','.$row['tipe'].'" value="'. ($row['saldoawal']) .'">' : ""; ?></td>
	  <?php  } ?>
      <td class="style3"><div align="center">
	  <?php  if(substr($row['norek'],-4)<>"0000" && $row['defaul'] != "1"){ ?>
	  <a href="index.php?mn=input_rp&id=<?php  echo $row['norek'] ?>"><img src="../images/user_go.png" border="0" width="16" height="16"></a>
	  <?php   } ?>
	  </div></td>
    </tr>
	<?php   
		 $nRecord = $nRecord + 1;
		} 
	} else { ?>
	  <tr bgcolor="white">
		<td align="center" colspan="17"><font color="red">Mohon maaf, tidak ada Data dimaksud.</font></td>
	  </tr>
	<?php   } ?>
  </table>
  </form>
</div>
</body>
</html>
