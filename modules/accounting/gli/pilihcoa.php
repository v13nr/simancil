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
	
	$sSQL = "SELECT count(*) FROM $database.rekening WHERE substr(norek, -3) <> '000' ORDER BY norek";
 if(isset($_POST['search'])){
	 $sSQL = "SELECT count(*) FROM $database.rekening WHERE substr(norek, -3) <> '000' AND namarek LIKE '%$_POST[search]%'";
 }
	$result = mysql_query($sSQL, $dbh_jogjaide)
        or die ("Invalid query '$sSQL'");
$row=mysql_fetch_row($result);
$nTotalItems=$row[0];

// create pagination object
$oPagination = new phpPagination ($nTotalItems, $nItemsPerPage);

 $SQL =  "SELECT * FROM $database.rekening WHERE substr(norek, -3) <> '000' order by norek LIMIT  "
    .($nCurrentPage-1)*$nItemsPerPage
    .", $nItemsPerPage";
 if(isset($_POST['search'])){
 $SQL = "select * FROM $database.rekening WHERE substr(norek, -3) <> '000' AND namarek LIKE '%$_POST[search]%' OR norek LIKE '%$_POST[search]%' LIMIT "
    .($nCurrentPage-1)*$nItemsPerPage
    .", $nItemsPerPage";
 }
 $query = mysql_query($SQL, $dbh_jogjaide) or die(mysql_error());
?>
<form action="" method="post">
 Cari nama: <input type="text" name="search" size="15" value="<?php echo @$_POST['search']; ?>" />
 <input type="submit" name="search_bt" value="Cari" />
</form>
<table width="100%" bgcolor="#000000" cellspacing="1" cellpadding="3">	
	<tr bgcolor="#DDDDDD">
		<th>COA</th>
		<th>Nama</th>
	</tr>
	<? while($row = mysql_fetch_object($query)): ?>
	<tr bgcolor="#FFFFFF">
		<td align="center"><a href="javascript:pickCOA('<?=$row->norek?>','<?=$row->norek?>','<?=$row->norek?>','<?=$row->namarek?>')"><?=$row->norek?></a></td>
		<td><?=$row->namarek?></td>
	</tr>
	<? endwhile; ?>
</table>
Halaman : <? // print pagination for current page
echo $oPagination->GetHtml($nCurrentPage)."\n"; ?>
</body>
</html>
