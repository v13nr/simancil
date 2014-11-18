<html>
 <head>
  <title>Daftar Buku</title>
  <style>
   body,table,input{
   	font-size:12px
   }
  </style>
	<script language="javascript">
	  function pickCOA(id,skada,untush,name){
		  parent.pickCOA(id,skada,untush,name);
	  }
	</script>
 </head>
<body>
<?
 require_once('phppagination.class.php');
 include '../include/globalx.php';
 
 $nTotalItems = 0;
 $nItemsPerPage = 10; // set length of page

// get page number passed via GET method
if (isset($_GET['page']))
    $nCurrentPage = $_GET['page'];
else
    $nCurrentPage = 1;
	
	$sSQL = "select count(*) from coax WHERE transaksi = 1 AND unit = '1002' AND cabang = 10";
	$result = mysql_query($sSQL)
        or die ("Invalid query '$sSQL'");
$row=mysql_fetch_row($result);
$nTotalItems=$row[0];

// create pagination object
$oPagination = new phpPagination ($nTotalItems, $nItemsPerPage);

 $SQL = "select * from coax WHERE  transaksi = 1 AND unit = '1002' AND cabang = 10 LIMIT "
    .($nCurrentPage-1)*$nItemsPerPage
    .", $nItemsPerPage";
 if(isset($_POST['search'])){
 $SQL = "select * from coax WHERE  transaksi = 1 AND unit = '1002' AND cabang = 10 AND (name LIKE '%$_POST[search_name]%' OR coa LIKE '%$_POST[search_name]%') LIMIT "
    .($nCurrentPage-1)*$nItemsPerPage
    .", $nItemsPerPage";
 }
 $query = mysql_query($SQL);
 //echo $SQL;
?>
<form action="" method="post">
 Cari nama: <input type="text" name="search_name" size="15" value="<?php echo @$_POST['search_name']; ?>" />
 <input type="submit" name="search" value="Cari" />
</form>
<table width="100%" bgcolor="#000000" cellspacing="1" cellpadding="3">	
	<tr bgcolor="#DDDDDD">
		<th>COA</th>
		<th>Nama</th>
	</tr>
	<? while($row = mysql_fetch_object($query)): ?>
	<?
		$jkel = "Laki-laki";
		if($row->jkel=="P"){ $jkel = "Perempuan"; }
	?>
	<tr bgcolor="#FFFFFF">
		<!-- fungsi selectBuku di deklarasikan di index.html dan file ini bisa memanggilnya selama file ini
			 dipanggil oleh thickbox dari index.html, fungsi dari selectPegawai adalah untuk memasukan nilai
			 NIP dan nama pegawai dari masing-masing baris di daftar pegawai ini -->
		<td align="center"><a href="javascript:pickCOA(<?=$row->coa?>,'<?=$row->coa?>','<?=$row->coa?>','<?=$row->name?>')"><?=$row->coa?></a></td>
		<td><?=$row->name?></td>
	</tr>
	<? endwhile; ?>
</table>
Halaman : <? // print pagination for current page
echo $oPagination->GetHtml($nCurrentPage)."\n"; ?>
</body>
</html>
