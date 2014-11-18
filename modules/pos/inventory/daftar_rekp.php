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
 include '../../accounting/include/globalx.php';
 
 $SQL = "SELECT * FROM $database.rekening WHERE substr(norek, -3) <> '000' ORDER BY norek";
 if(isset($_POST['search'])){
	 $SQL = "SELECT * FROM $database.rekening WHERE substr(norek, -3) <> '000' AND namarek LIKE '%$_POST[search_name]%'";
 }
 $query = mysql_query($SQL, $dbh_jogjaide);
 //echo $SQL;
?>
<form action="" method="post">
 Cari Nama Rekening: <input type="text" name="search_name" size="15" value="<?php echo @$_POST['search_name']; ?>" />
 <input type="submit" name="search" value="Cari" />
</form>
<table width="100%" bgcolor="#000000" cellspacing="1" cellpadding="3">	
	<tr bgcolor="#DDDDDD">
		<th>No Rekening</th>
		<th>Nama Rekening</th>
	</tr>
	<? while($row = mysql_fetch_object($query)): ?>
	<tr bgcolor="#FFFFFF">
		<!-- fungsi selectBuku di deklarasikan di index.html dan file ini bisa memanggilnya selama file ini
			 dipanggil oleh thickbox dari index.html, fungsi dari selectPegawai adalah untuk memasukan nilai
			 NIP dan nama pegawai dari masing-masing baris di daftar pegawai ini -->
		<td align="center"><a href="javascript:selectBuku('<?=$row->norek?>','<?=$row->namarek?>')"><?=$row->norek?></a></td>
		<td><?=$row->namarek?></td>
	</tr>
	<? endwhile; ?>
</table>
</body>
</html>
