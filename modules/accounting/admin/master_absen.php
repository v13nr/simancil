<? include "../include/otentik_admin.php"; 
require_once('phppagination.absen.class.php');

 $nTotalItems = 0;
 $nItemsPerPage = 15; // set length of page

// get page number passed via GET method
if (isset($_GET['page']))
    $nCurrentPage = $_GET['page'];
else
    $nCurrentPage = 1;
	
	$sSQL = "select count(*) FROM ml_absen a, ml_user b WHERE b.id = a.IDUser";
	$result = mysql_query($sSQL)
        or die ("Invalid query '$sSQL'");
$row=mysql_fetch_row($result);
$nTotalItems=$row[0];

// create pagination object
$oPagination = new phpPagination ($nTotalItems, $nItemsPerPage);

	$SQL = "SELECT a.*, b.* FROM ml_absen a, ml_user b WHERE b.id = a.IDUser";
	$SQL = $SQL . " ORDER BY a.waktu_datang DESC LIMIT "
    .($nCurrentPage-1)*$nItemsPerPage
    .", $nItemsPerPage";
	$hasil=mysql_query($SQL, $dbh_jogjaide);
	
?><style type="text/css">
<!--
body {
	background-image: url(../images/ok.jpg);
}
.style3 {font-family: "Segoe UI"; font-weight: bold; font-size: 12px; }
.style4 {
	font-size: 12px;
	font-family: "Segoe UI";
}
.style6 {font-family: "Segoe UI"; font-weight: bold; font-size: 12px; color: #FFFFFF; }
-->
</style>
<br>
<table width="750" align="center" cellpadding="3" cellspacing="1" bgcolor="#000000">
	<tr bgcolor="#DDDDDD">
		<td colspan="10" align="center" bgcolor="#0000FF"><span class="style6">MASTER LOGIN SYSTEM </span></td>
	</tr>
	<tr bgcolor="#DDDDDD">
		<td bgcolor="#FFCC33"><div align="center"><span class="style3">No.</span></div></td>
		<td bgcolor="#FFCC33"><div align="center"><span class="style3">Username</span></div></td>
		<td bgcolor="#FFCC33"><div align="center"><span class="style3">Nama</span></div></td>
		<td bgcolor="#FFCC33"><div align="center"><span class="style3">Waktu Login </span></div></td>
		<td bgcolor="#FFCC33"><div align="center"><span class="style3">Browser</span></div></td>
		<td bgcolor="#FFCC33"><div align="center"><span class="style3">Version</span></div></td>
		<td bgcolor="#FFCC33"><div align="center"><span class="style3">OS</span></div></td>
		<td bgcolor="#FFCC33"><div align="center"><span class="style3">IP</span></div></td>
		<td bgcolor="#FFCC33"><div align="center"><span class="style3">Waktu Logout </span></div></td>
	</tr>
	<? $nRecord = 1; while ($row=mysql_fetch_array($hasil)) { ?>
	<tr <?	 if (($nRecord % 2)==0) {?>bgcolor="#FFFFCC"<? } else{ ?>bgcolor="#FFFFFF" <? } ?>>
		<td><div align="center" class="style4">
          <?=++$No + (($nCurrentPage -1 ) * $nItemsPerPage)?>
	    .</div></td>
		<td><span class="style4">
	    <?=$row['user']?>
		</span></td>
		<td><span class="style4">
	    <?=$row['nama']?>
		</span></td>
		<td><span class="style4">
	    <?=$row['waktu_datang']?>
		</span></td>
		<td><span class="style4">
	    <?=$row['browser']?>
		</span></td>
		<td><span class="style4">
	    <?=$row['version']?>
		</span></td>
		<td><span class="style4">
	    <?=$row['os']?>
		</span></td>
		<td><span class="style4">
	    <?=$row['ip']?>
		</span></td>
		<td><span class="style4">
	    <?=$row['waktu_pulang']?>
		</span></td>
	</tr>
	<? $nRecord = $nRecord + 1;} ?>
</table>
<div align="center">
<span class="style4">Halaman :</span> 
<? // print pagination for current page
echo $oPagination->GetHtml($nCurrentPage)."\n"; ?>
</div>
