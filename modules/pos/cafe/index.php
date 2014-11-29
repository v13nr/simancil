<?php  
session_start();
include "../include/globalx.php";
include "../include/functions.php";
if( !isset($_SESSION['sess_kelasuser']) ) {
    header("location: index.php");
}
 ?>
 
<?php 
					if($_GET["mn"]<>"") 
					{ 
						$menu = $_GET["mn"]; 
							
						switch($_GET["mn"]){
							case "$menu" :
								include "$menu.php";
							break;
						}
					}
			
			
?>