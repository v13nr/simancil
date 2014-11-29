<?php 
include ("../include/globalx.php");	

$tahunx = date('Y');
						//echo $tahun;
						for ($i=2009; $i<=$tahunx+1;$i++){
							for ($j=1; $j<=12;$j++){
								$sqli = "insert into produksi(tanggal) values(
								'".$baris["norek"]."0000',
								'".$baris["namarek"]."',
								'".$baris["tipe"]."'
								)";
								$hasili = mysql_query($sqli);
							}
						}
						

?>