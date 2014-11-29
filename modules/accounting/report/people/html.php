<style type="text/css">
#customers
{
font-family:"Arial", Helvetica, sans-serif;
width:100%;
border-collapse:collapse;
}
#customers td, #customers th 
{
font-size:1.2em;
border:1px solid #000000;
padding:3px 7px 2px 7px;
}
#customers th 
{
font-size:1.0em;
text-align:left;
padding-top:5px;
padding-bottom:4px;
background-color:#FFFFCC;
color:#000;
}
#customers tr.alt td 
{
color:#000;
background-color:#EAF2D3;
}
</style>
<?php 
echo '<table id="customers">';
	echo '<tr>';
    echo "<th>NAMA</th>"; 
	echo "<th>TANGGAL</th>"; 
	echo "<th>TINGGI</th>"; 
	echo "</tr>";
 while ($row=$rs->FetchNextObject()) {
	echo '<tr>';
    echo "<td>".$row->NAME."</td>"; 
	echo "<td>".$row->BIRTHDAY."</td>"; 
	echo "<td>".$row->HEIGHT."</td>"; 
	echo "</tr>";
  }
echo "</table>";


?>
<script type="text/javascript">
window.onload=function(){
	window.print();
};

</script>