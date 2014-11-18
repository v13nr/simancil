<html>
 <head>
  <title>Daftar Buku</title>
  <style>
   body,table,input{
   	font-size:12px
   }
  </style>
  <script language="javascript">
   function selectBuku(no,nama){
	   window.parent.selectBuku(no,nama);
	   window.parent.tb_remove();
   }
  </script>
 </head>
<body>
<?
 include '../include/globalx.php';
include ("../include/functions.php");
 
 $SQL = "SELECT * FROM $database.piutang_detail WHERE piutang_id = '".$_GET["ida"]."'";
 if(isset($_POST['search'])){
 }
 $query = mysql_query($SQL, $dbh_jogjaide);
?>

<table width="100%" bgcolor="#000000" cellspacing="1" cellpadding="3">	
	<tr bgcolor="#DDDDDD">
		<th width="13%">Angsuran Ke  </th>
		<th width="6%">Tgl Bayar </th>
		<th width="14%">Bunga</th>
		<th width="17%">Angsuran</th>
		<th width="18%">Jumlah Pembayaran </th>
		<th width="18%">Sisa Harga Kontrak </th>
		<th width="14%">Posting</th>
	</tr>
	<? 
	 
 $SQL = "SELECT * FROM $database.piutang_detail WHERE piutang_id = '".$_GET["ida"]."' AND ket = 'Uang Muka'";
 if(isset($_POST['search'])){
 }
 $query = mysql_query($SQL, $dbh_jogjaide);

	 while($row = mysql_fetch_object($query)){ ?>
	<tr  bgcolor="#FFFFFF">
	  <td align="center">&nbsp;</td>
	  <td align="center"><?=baliktglindo($row->jtempo)?></td>
	  <td align="center">-</td>
	  <td align="center">-</td>
	  <td align="center">-</td>
	  <td align="center"><div align="right">
	    <?php 
	  	$SQLt = "SELECT saldo from piutang WHERE nomor = ".$_GET["nomor"];
	  	$hasilt = mysql_query($SQLt, $dbh_jogjaide);
		$barist = mysql_fetch_array($hasilt);
		$kontrak = $barist[0];
	  ?>
	    <?php $sisa = $kontrak -  $sisa; echo number_format($sisa);?>
      </div></td>
	  <td align="center">&nbsp;</td>
  </tr>
	<tr  bgcolor="#FFFFFF">
	  <td align="center">Uang Muka </td>
	  <td align="center"><?=baliktglindo($row->jtempo)?></td>
	  <td align="center">-</td>
	  <td align="center"><div align="right">
        <?php echo number_format($row->nilai); $angsuran = $angsuran + $row->nilai; ?>
      </div></td>
	  <td align="center"><div align="right"> <?php echo number_format($row->nilai + $bunga); $tbayar = $tbayar + $row->nilai  + $bunga; ?> </div></td>
	  <td align="center"><div align="right">
	    <?php $bayar = $row->nilai; $sisa =   $sisa -$bayar ; echo number_format($sisa);?>
	  </div></td>
	  <td align="center">&nbsp;</td>
  </tr>
  <?php } ?>
	<? 
	 
 $SQL = "SELECT * FROM $database.piutang_detail WHERE piutang_id = '".$_GET["ida"]."' AND ket <> 'Uang Muka'";
 if(isset($_POST['search'])){
 }
 $query = mysql_query($SQL, $dbh_jogjaide);

	$nourut = 1; while($row = mysql_fetch_object($query)): ?>
	
	
	<tr  bgcolor="#FFFFFF">
		<td align="center"><?php echo $nourut++;?></td>
		<td align="center"><?=baliktglindo($row->jtempo)?></td>
		<td align="center"><div align="right"><?php
			$bunga =  ($row->bunga /100) * (1/12) * $sisa;
			echo number_format($bunga);
			$tbunga = $tbunga + $bunga;
		?></div>
	      <div align="right"></div></td>
		<td align="center"><div align="right"><input type="text" value="<?php echo number_format($row->nilai); ?>" name="tes"> <?php $angsuran = $angsuran + $row->nilai; ?></div></td>
		<td align="center"><div align="right"> <?php echo number_format($row->nilai + $bunga); $tbayar = $tbayar + $row->nilai  + $bunga; ?> </div></td>
		<td align="center"><div align="right">
		  <?php $bayar = $row->nilai; $sisa =   $sisa -$bayar ; echo number_format($sisa);?>
		</div></td>
		<td align="center">
		<?php  if($row->posted == 0){ ?>
			<a href="submission_gli.php?cmd=posting_susut&id=<?php echo $row->id; ?>&ida=<?=$_GET["ida"] ?>&tgl=<?php echo baliktglindo($row->mano_post); ?>">Posting Now</a>
		<?php } else {echo "OK"; } ?>		</td>
	</tr>
	<? endwhile; ?>
	<tr  bgcolor="#FFFFFF">
	  <td colspan="2" align="center">Jumlah Total </td>
	  <td align="center"><div align="right">
	    <?php
			$bunga =  ($row->bunga /100) * (1/12) * $sisa;
			echo number_format($tbunga);
		?>
      </div></td>
	  <td align="center"><div align="right"><?php echo number_format($angsuran);  ?></div></td>
	  <td align="center"><div align="right"> <?php echo number_format($tbayar);  ?> </div></td>
	  <td align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
  </tr>
</table>
</body>
</html>
