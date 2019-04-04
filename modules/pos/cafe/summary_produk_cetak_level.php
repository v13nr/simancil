<?php

ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "../include/globalx.php";
include "../include/functions.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<table width="659">
	<tr>
		<td colspan="3"><strong>SUMMARY PRODUCT REPORT</strong></td>
	</tr>
	<tr>
	  <td>PERIODE</td>
	  <td>:</td>
	  <td><?php echo $_POST['tgl_awal'] ?> s/d <?php echo $_POST['tgl_akhir'] ?></td>
  </tr>
	<tr>
		<td width="87">SHIFT</td>
		<td width="8">:</td>
		<td width="548"><?php
$SQL = "select * from ml_user b where id = '" . $_POST['shift'] . "'";
$hasil = mysql_query($SQL, $dbh_jogjaide);
$baris = mysql_fetch_array($hasil);
if ($_POST['shift'] <> "")
{
    echo $baris["nama"];
}
else
{
    echo "ALL";
}
?></td>
	</tr>
</table>
<form method="post" action="summary_produk_cetak2.php">
<input type="hidden" name="shift" value="<?php echo $_POST['shift'] ?>" />
<input type="hidden" name="tgl_awal" value="<?php echo $_POST['tgl_awal'] ?>" />
<input type="hidden" name="tgl_akhir" value="<?php echo $_POST['tgl_akhir'] ?>" />
<table width="100%" border="1">
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" value="Cetak" /></td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td width="4%">No.</td>
    <td width="44%">Produk</td>
    <td width="26%">Total Terjual </td>
    <td width="13%">Total Discount Rp. </td>
    <td width="13%" align="right">Nilai</td>
  </tr>
  <?php

$SQL = "SELECT * from jenjang_produk WHERE parent_id = 0";
$hasil = mysql_query($SQL, $dbh_jogjaide);
while ($baris = mysql_fetch_array($hasil))
{

?>
									
									
					  <tr>
						<td><?php echo ++$no; ?></td>
						<td><?php echo $baris["label"]; ?></td>
						<td>
							<?php

?>	</td>
						<td align="right"><?php

?></td>
						<td align="right"><?php

?></td>
					  </tr>
								<?php

    $SQL2 = "SELECT * from jenjang_produk WHERE parent_id = " . $baris["id"];
    $hasil2 = mysql_query($SQL2, $dbh_jogjaide);
    while ($baris2 = mysql_fetch_array($hasil2))
    {

?>
																
																
												  <tr>
													<td><?php ?></td>
													<td>&nbsp;&nbsp;&nbsp;+<?php echo $baris2["label"]; ?></td>
													<td>
														<?php

?>	</td>
													<td align="right"><?php

?></td>
													<td align="right"><?php

?></td>
												  </tr>
																		<?php

        $SQL3 = "SELECT * from jenjang_produk WHERE parent_id = " . $baris2["id"];
        $hasil3 = mysql_query($SQL3, $dbh_jogjaide);
        while ($baris3 = mysql_fetch_array($hasil3))
        {

?>
																										
																										
																						  <tr>
																							<td><?php ?></td>
																							<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+<?php echo $baris3["label"]; ?></td>
																							<td>
																								<?php

?>	</td>
																							<td align="right"><?php

?></td>
																							<td align="right"><?php

?></td>
																						  </tr>
																					
																										<?php

            $SQL4 = "SELECT * from jenjang_produk WHERE parent_id = " . $baris3["id"];
            $hasil4 = mysql_query($SQL4, $dbh_jogjaide);
            while ($baris4 = mysql_fetch_array($hasil4))
            {

?>
																																		
																																		
																														  <tr>
																															<td><?php ?></td>
																															<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																															+<?php echo $baris4["label"]; ?></td>
																															<td>
																																<?php

?>	</td>
																															<td align="right"><?php

?></td>
																															<td align="right"><?php

?></td>
																														  </tr>
																																	
																					
																																	<?php

                $SQL5 = "SELECT * from jenjang_produk WHERE parent_id = " . $baris4["id"];
                $hasil5 = mysql_query($SQL5, $dbh_jogjaide);
                while ($baris5 = mysql_fetch_array($hasil5))
                {

?>
																																									
																																									
																																					  <tr>
																																						<td><?php ?></td>
																																						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																																						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																																						+<?php echo $baris5["label"]; ?></td>
																																						<td>
																																							<?php

?>	</td>
																																						<td align="right"><?php

?></td>
																																						<td align="right"><?php

?></td>
																																					  </tr>
																																				
																																														<?php

                    $SQL6 = "SELECT * from stock WHERE level_5 = '" . $baris5["id"] . "'";
                    $hasil6 = mysql_query($SQL6, $dbh_jogjaide) or die(mysql_error());
                   // echo $SQL6 . "<br>";
                    //die("wagu");
                    while ($baris6 = mysql_fetch_array($hasil6))
                    {
                        

                            $sqlk = "SELECT SUM(qtyout) as jumlah FROM mutasi where kodebrg = '" . $baris6["kodebrg"] . "' AND status = 1";
$sqlk = $sqlk . " AND mutasi.tgl between '". baliktgl($_POST["tgl_awal"]) ."' AND '". baliktgl($_POST["tgl_akhir"]) ."'";
				//echo $sqlk;
                            $hasilk = mysql_query($sqlk) or die(mysql_error());;
                            $barisk = mysql_fetch_array($hasilk);

?>
																																																					
																																																					
																																																	  <tr>
																																																		<td></td>
																																																		<td><?php 
                             ?><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																																						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;++<?php echo $baris6["namabrg"] ?></b></td>
																																																		<td>
																																																			<?php

                            echo $barisk["jumlah"];
?>	</td>
																																																		<td align="right"><?php
                            $sqld = "SELECT SUM(qtyout*harga*disc/100) as jumlah FROM mutasi where kodebrg = '" . $baris6["kodebrg"] . "' ";
                            if ($_POST['shift'] <> "")
                            {
                                $sqld = $sqld . " AND user_id = '" . $_POST['shift'] . "'";
                            }

                            $sqld = $sqld . " AND mutasi.tgl between '" . baliktgl($_POST["tgl_awal"]) . "' AND '" . baliktgl($_POST["tgl_akhir"]) . "'";
                            //echo $sqlk;
                            $hasild = mysql_query($sqld) or die(mysql_error());
                            $barisd = mysql_fetch_array($hasild);
                            echo " ". number_format($barisd["jumlah"]);

                            //$totalp = $totalp + ($baris["harga"] * $baris["qtyout"]);
                            
?></td>
																																																		<td align="right"><?php
                            $sqld = "SELECT SUM(qtyout*harga-(qtyout*harga*disc/100)) as jumlah FROM mutasi where kodebrg = '" . $baris6["kodebrg"] . "' AND status = 1";
                            if ($_POST['shift'] <> "")
                            {
                                $sqld = $sqld . " AND user_id = '" . $_POST['shift'] . "'";
                            }

                            $sqld = $sqld . " AND mutasi.tgl between '" . baliktgl($_POST["tgl_awal"]) . "' AND '" . baliktgl($_POST["tgl_akhir"]) . "'";
                            //echo $sqlk;
                            $hasild = mysql_query($sqld);
                            $barisd = mysql_fetch_array($hasild);
                            echo number_format($barisd["jumlah"]);
                            $totalp = $totalp + $barisd["jumlah"];
                            //$totalp = $totalp + ($baris["harga"] * $baris["qtyout"]);
                            
?></td>
																																																	  </tr>
																																																
																																																
																																																<?php

?>
																																													  <?php
                         ?>
																																													  <?php
                    } ?>
																																				<?php

?>
																																  <?php
                } ?>
																													
																													<?php

?>
																									  <?php
            } ?>
																					<?php

?>
																	  <?php
        } ?>
											
											<?php

?>
							  <?php
    } ?>
				
				<?php

?>
  <?php
} ?>
  
 
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right"><?php echo number_format($totalp) ?></td>
  </tr>
</table>
</form>
</body>
</html>
