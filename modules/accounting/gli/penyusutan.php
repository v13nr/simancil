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
 
 $SQL = "SELECT * FROM $database.aktiva_details WHERE aktiva_id = '".$_GET["ida"]."' ORDER BY mano_post ASC";
 if(isset($_POST['search'])){
 }
 $query = mysql_query($SQL, $dbh_jogjaide);
?>

<table width="100%" bgcolor="#000000" cellspacing="1" cellpadding="3">	
	<tr bgcolor="#DDDDDD">
		<th width="20%">No </th>
		<th>Generator Tanggal posting</th>
		<th>Nilai</th>
		<th>Sisa</th>
		<th width="30%">Posting</th>
	</tr>
	<tr  bgcolor="#FFFFFF">
	  <td align="center">Tanggal Perolehan </td>
	  <td align="center"><?php
	  		$sqlp = "SELECT tgl, nilai from aktiva WHERE id = ".$_GET["ida"];
	  		$hasilp = mysql_query($sqlp, $dbh_jogjaide);
			$barisp = mysql_fetch_array($hasilp);
			echo baliktglindo($barisp[0]);
	  ?></td>
	  <td align="right"><?php $sisa = $barisp[1]; echo number_format($sisa,2,",",".");?></td>
	  <td align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
  </tr>
	<? 
	$nourut = 1; while($row = mysql_fetch_object($query)): ?>

	<tr  bgcolor="#FFFFFF">
		<td align="center"><?php echo $nourut++;?></td>
		<td align="center"><?=baliktglindo($row->mano_post)?></td>
		<td align="right"><?=number_format($row->nilai,2,",",".")?></td>
		<td align="right"><?php $sisa = $sisa - ($row->nilai); echo number_format($sisa,2,",",".");  ?></td>
		<td align="center">
		<?php  if($row->posted == 0){ ?>
			<a href="submission_gli.php?cmd=posting_susut&id=<?php echo $row->id; ?>&ida=<?=$_GET["ida"] ?>&tgl=<?php echo baliktglindo($row->mano_post); ?>">Posting Now</a>
		<?php } else {echo "OK"; } ?>		</td>
	</tr>
	<? endwhile; ?>
</table>
</body>
</html>
