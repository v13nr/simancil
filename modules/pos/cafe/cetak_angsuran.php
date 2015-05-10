<html>
 <head>
  <title>Cetak Angsuran</title>
  <style>
   body,table,input{
   	font-size:12px
   }
  </style>
  <style type="text/css">
input.kanan{ text-align:right; }
</style>
<script type="text/javascript" src="../assets/jquery-1.2.3.pack.js"></script>
  <script language="javascript">
   function selectBuku(no,nama){
	   window.parent.selectBuku(no,nama);
	   window.parent.tb_remove();
   }
   $(document).ready(function(){

function clearNum(number){
	while(String(number).indexOf(',') > -1){
	 number = String(number).replace(',','');
	}
	return number;
}
	function hitung(){
		qty = clearNum(document.getElementById("qty").value) * 1;
		harga = clearNum(document.getElementById("harga").value) * 1;
		disc = clearNum(document.getElementById("disc").value) * 1;
		disc2 = clearNum(document.getElementById("disc2").value) * 1;
		disc3 = clearNum(document.getElementById("disc3").value) * 1;
		discrp = clearNum(document.getElementById("discrp").value) * 1;
		if(disc != 0 || disc2 != 0 || disc3 != 0){
			netto = (qty * harga)-((disc + disc2 + disc3) / 100 * harga * qty);
			document.getElementById("discrp").value = formatCurrency((disc + disc2 + disc3) / 100 * harga * qty)
		} else {
			netto = (qty * harga) - discrp;
		}
		document.getElementById("jumlah").value = formatCurrency(harga*qty);
		document.getElementById("netto").value = formatCurrency(netto);
	}

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
	
    $.each($('.kanan'), function()
    {
       $(this).keyup( function(){ 
	   		$(this).val(formatCurrency($(this).val()));
		} );
    });
});
  </script>
 </head>
<body onLoad="window.print()">
<?
 include '../include/globalx.php';
include ("../include/functions.php");
 
 $SQL = "SELECT * FROM piutang WHERE id = '".$_GET["ida"]."'";
 $query = mysql_query($SQL);
 $hasil = mysql_fetch_array($query);
 
?>

<table width="80%" bgcolor="" cellspacing="1" cellpadding="3">	
	<tr bgcolor="">
	  <th width="20%"><div align="left">Nama</div></th>
	  <th width="2%">:</th>
	  <th width="78%"><div align="left"><?php echo $hasil["nama"];?></div></th>
  </tr>
	<tr bgcolor="">
	  <th><div align="left">Alamat</div></th>
	  <th>:</th>
	  <th><div align="left"><?php echo $hasil["alamat"];?></div></th>
  </tr>
	<tr bgcolor="">
	  <th><div align="left">Nilai </div></th>
	  <th>:</th>
	  <th><div align="left"><?php echo number_format($hasil["saldo"]);?></div></th>
  </tr>
	<tr bgcolor="">
	  <th>&nbsp;</th>
	  <th>&nbsp;</th>
	  <th>&nbsp;</th>
  </tr>
</table>
<table width="100%" bgcolor="#000000" cellspacing="1" cellpadding="3">
  <tr bgcolor="#DDDDDD">
    <th width="13%">Angsuran Ke </th>
    <th width="9%">Tgl Bayar </th>
    <th width="11%">Bunga</th>
    <th width="17%">Angsuran</th>
    <th width="15%">Jumlah Pembayaran </th>
    <th width="16%">Sisa Nilai Piutang </th>
  </tr>
  <?php  
	  $SQL = "SELECT * FROM piutang WHERE id = '".$_GET["ida"]."'";
 if(isset($_POST['search'])){
 }
 $query = mysql_query($SQL, $dbh_jogjaide) or die(mysql_error());

	 while($row = mysql_fetch_object($query)){ ?>
  <tr  bgcolor="#FFFFFF">
    <td align="center">Nilai Piutang</td>
    <td align="center"><?php  echo baliktglindo($row->jtempo)?></td>
    <td align="center">-</td>
    <td align="center">-</td>
    <td align="center">-</td>
    <td align="center"><div align="right">
      <?php  
	  	$SQLt = "SELECT saldo from piutang WHERE id = ".$_GET["ida"];
	  	$hasilt = mysql_query($SQLt);
		$barist = mysql_fetch_array($hasilt);
		$kontrak = $barist[0];
	  ?>
      <?php  $sisa = $kontrak -  $sisa; echo number_format($sisa);?>
    </div></td>
  </tr>
  <?php  } ?>
  <?php  
	 
 $SQL = "SELECT * FROM piutang_detail WHERE piutang_id = '".$_GET["ida"]."' AND ket <> 'Uang Muka'";
 if(isset($_POST['search'])){
 }
 $query = mysql_query($SQL, $dbh_jogjaide) or die(mysql_error());

	$nourut = 1; 
	while($row = mysql_fetch_object($query)): ?>
  <form method="post" action="submission_inv.php">
    <input type="hidden" name="cmd" value="upd_angsuran">
    <input type="hidden" name="ida" value="<?php  echo $_GET["ida"]; ?>">
    <input type="hidden" name="nomor" value="<?php  echo $_GET["nomor"]; ?>">
    <tr  bgcolor="#FFFFFF">
      <td align="center"><?php  echo $nourut++;?>
        <input type="hidden" name="id" value="<?php  echo $row->id; ?>"></td>
      <td align="center"><input type="text" value="<?php  echo baliktglindo($row->jtempo)?>" name="jtempo" readonly="true" size="10"></td>
      <td align="center"><div align="right">
        <?php 
			$bunga =  ($row->bunga /100) * (1/12) * $sisa;
			echo number_format($bunga);
			$tbunga = $tbunga + $bunga;
		?>
      </div>
        <div align="right"></div></td>
      <td align="center"><div align="right">
        <input type="text" size="15" class="kanan" value="<?php  echo number_format($row->nilai); ?>"  readonly="true"name="nilai">
        <?php  $angsuran = $angsuran + $row->nilai; ?>
      </div></td>
      <td align="center"><div align="right">
        <?php  echo number_format($row->nilai + $bunga); $tbayar = $tbayar + $row->nilai  + $bunga; ?>
      </div></td>
      <td align="center"><div align="right">
        <?php  $bayar = $row->nilai; $sisa =   $sisa -$bayar ;
		  if(($row->nilai + $bunga)!="0"){
		   echo number_format($sisa); 
		   } else {
		   	echo "0";
		   } ?>
      </div></td>
    </tr>
  </form>
  <?php  endwhile; ?>
  <tr  bgcolor="#FFFFFF">
    <td colspan="2" align="center">Jumlah Total </td>
    <td align="center"><div align="right">
      <?php 
			$bunga =  ($row->bunga /100) * (1/12) * $sisa;
			echo number_format($tbunga);
		?>
    </div></td>
    <td align="center"><div align="right">
      <?php  echo number_format($angsuran);  ?>
    </div></td>
    <td align="center"><div align="right">
      <?php  echo number_format($tbayar);  ?>
    </div></td>
    <td align="center">&nbsp;</td>
  </tr>
</table>
</body>
</html>
