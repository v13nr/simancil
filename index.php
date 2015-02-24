<?php 
/**
 *  Copyright (C) CV. Jogjaide Ent.
 *  Project Manager : Nanang Rustianto
 *  Lead Programmer : Nanang Rustianto
 *  Email : anangr2001@yahoo.com
 *  Date: April 2014
**/
?>
<?php  @session_start();  
	
	function menuAkses($id){
		$group_id = $_SESSION['sess_user_id'];
		$SQL = "SELECT menu_id FROM jo_menu_detail WHERE menu_id = '$id' AND user_id = '".$group_id."'";
		//echo "<br>".($SQL);
		$hasil = mysql_query($SQL);
		if(mysql_num_rows($hasil) < 1){
			echo "ANDA TIDAK MEMILIKI HAK AKSES MENU INI !";
			exit();
		}
	}
	
if($_SESSION["is_login"] != "yes")
{
echo'
<script>
window.location="login.php";

</script>
';
}
include ("config_sistem.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>SAJI: Sistem Informasi Jasa Ekspedisi</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <!-- stylesheets -->
    <link rel="stylesheet" type="text/css" href="resources/css/reset.css" />
    <link rel="stylesheet" type="text/css" href="resources/css/style.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="resources/css/style_full.css" />
    <link id="color" rel="stylesheet" type="text/css" href="resources/css/colors/blue.css" />
    <!-- scripts (jquery) -->
    <script src="resources/scripts/jquery-1.6.4.min.js" type="text/javascript">
	
    </script>
    <!--[if IE]>
<script language="javascript" type="text/javascript" src="resources/scripts/excanvas.min.js">
</script>
<![endif]-->
      <script src="resources/scripts/jquery-ui-1.8.16.custom.min.js" type="text/javascript">
      </script>
      <script src="resources/scripts/jquery.ui.selectmenu.js" type="text/javascript">
      </script>
      <script src="resources/scripts/jquery.flot.min.js" type="text/javascript">
      </script>
      <script src="resources/scripts/tiny_mce/jquery.tinymce.js" type="text/javascript">
      </script>
      <!-- scripts (custom) -->
      <script src="resources/scripts/smooth.js" type="text/javascript">
      </script>
      <script src="resources/scripts/smooth.menu.js" type="text/javascript">
      </script>
      <script src="resources/scripts/smooth.chart.js" type="text/javascript">
      </script>
      <script src="resources/scripts/smooth.table.js" type="text/javascript">
      </script>
      <script src="resources/scripts/smooth.form.js" type="text/javascript">
      </script>
      <script src="resources/scripts/smooth.dialog.js" type="text/javascript">
      </script>
      <script src="resources/scripts/smooth.autocomplete.js" type="text/javascript">
      </script>
      <script type="text/javascript">
        $(document).ready(function () {
          style_path = "resources/css/colors";
          
          $("#date-picker").datepicker();
          
          $("#box-tabs, #box-left-tabs").tabs();
        }
                         );
      </script>
	  <link rel="shortcut icon" href="logo.gif" />
  </head>
  <body>
    <div id="colors-switcher" class="color">
      <a href="" class="blue" title="Blue">
      </a>
      <a href="" class="green" title="Green">
      </a>
      <a href="" class="brown" title="Brown">
      </a>
      <a href="" class="purple" title="Purple">
      </a>
      <a href="" class="red" title="Red">
      </a>
      <a href="" class="greyblue" title="GreyBlue">
      </a>
    </div>
    <!-- dialogs -->
    <!-- end dialogs -->
    <!-- header -->
    <div id="header">
      <!-- logo -->
      <div id="logo">
        
         
		  <ul id="user">
		  	<li style="color:#FFFFFF"><strong><?php  echo SITE_TITLE; ?></strong></li>
		  </ul>
      </div>
      <!-- end logo -->
      <!-- user -->
      <ul id="user">
        <li class="first">
          <a href="">
            <?php  echo $_SESSION["sess_name"]?>
          </a>
        </li>
        <li>
          <a href="index.php?mn=update_passwd&getmodule=
<?php  echo base64_encode('user'); ?>
&box=1">
  Account
                  </a>
              </li>
              <li>
                <a href="">
                  Messages (0)
                </a>
              </li>
              <li>
                <a href="sb_logout.php">
                  Logout
                </a>
              </li>
              <li class="last highlight">
                <a href="#">
                  View Site
                </a>
              </li>
  </ul>
  <!-- end user -->
  <div id="header-inner">
    <div id="home">
      <a href="">
      </a>
    </div>
    <!-- quick -->
    <ul id="quick">
      <li>
        <a href="index.php" title="Home">
          <span class="normal">
            Home
          </span>
        </a>
      </li>
  <?php  if($_SESSION["sess_kelasuser"]=="Super Admin" || $_SESSION["sess_kelasuser"]=="Admin" || $_SESSION["sess_kelasuser"]=="User"){ ?>
				  
				  <?php  $SQL_0 = "SELECT *, a.id as ibu1 FROM jo_menu a, jo_menu_detail b WHERE a.id = b.menu_id AND a.status = 1 AND a.aktif = 1 AND a.parent_id = 0 AND b.user_id = '".$_SESSION["sess_user_id"]."'"; $hasil_0 = mysql_query($SQL_0); while($baris_0=mysql_fetch_array($hasil_0)) { ?>
                  <li>
                    <a href="#" title="">
                      <span class="icon">
                        <img src="resources/images/icons/<?php  echo $baris_0['icon']; ?>" alt="Products" />
                      </span>
                      <span>
                        <?php  echo $baris_0['title']; ?>
                      </span>
                    </a>
                    <ul>
						<?php  $SQL_1 = "SELECT *, a.id as ibu2 FROM jo_menu a, jo_menu_detail b WHERE a.id = b.menu_id AND a.status = 1 AND a.aktif = 1 AND a.parent_id = '".$baris_0['ibu1']."' AND b.user_id = '".$_SESSION["sess_user_id"]."'"; $hasil_1 = mysql_query($SQL_1); while($baris_1=mysql_fetch_array($hasil_1)) { ?>
                      <li>
                        <a href="" title="Settings"  class="childs">
                          <?php  echo $baris_1['title']; ?>
                        </a>
                        <ul>
									<?php  $SQL_2 = "SELECT *, a.id as ibu3 FROM jo_menu a, jo_menu_detail b WHERE a.id = b.menu_id AND a.status = 1 AND a.aktif = 1 AND a.parent_id = '".$baris_1['ibu2']."' AND b.user_id = '".$_SESSION["sess_user_id"]."' ORDER BY menu_order"; $hasil_2 = mysql_query($SQL_2); while($baris_2=mysql_fetch_array($hasil_2)) { ?>
                                  <li class="">
                                    <a href="index.php?mn=<?php  echo $baris_2['file']; ?>&getmodule=
<?php  echo base64_encode($baris_2['modul']); ?>&box=<?php  echo $baris_2['frame']; ?>">
  <?php  echo $baris_2['title']; ?>
                                      </a>
                                  </li>
								  <?php  } //level 3 ?>
                        </ul>
                       </li>
						   <?php  } //level 2 ?>
                      </ul>
                  </li>
				  <?php  } //level 1 ?>
				    <li>    
					<a href="#" title="">
                      <span class="icon">
                        <img src="resources/images/icons/calendar.png" alt="Products" />
                      </span>
                      <span>
                        Update & Tools
                      </span>
                    </a>
					
						<ul>
							<li>
								<a href="update.php" title="<?php  $sql = "SELECT versi from versi order by id DESC LIMIT 1";
								$hasil = mysql_query($sql);
								$baris = mysql_fetch_array($hasil);
								echo "Versi Anda Saat ini adalah ".$baris[0]; ?>">           Update </a>   
							</li>
							<li>
								<a href="index.php?mn=rec_stok_ls&getmodule=
<?php  echo base64_encode("pos/inventory"); ?>" title="Recycle Inventory">Recycle Inventory</a>   
							</li>
							<li>
								<a href="index.php?mn=mysql-backup&getmodule=
<?php  echo base64_encode("backuprestore/"); ?>&box=1" title="Recycle Inventory">Backup Restore</a>   
							</li>
						</ul>			
					</li>
              </ul>
  </li>
  <?php  } ?>
  
      </ul>
      <!-- end quick -->
      <div class="corner tl">
      </div>
      <div class="corner tr">
      </div>
  </div>
</div>
<!-- end header -->
<!-- content -->
<div id="content">
  <!-- table -->
  <!-- end table -->
  
  
  <div class="box">
    <div class="title">
      <h5>
        <?php  $split = explode('/', base64_decode($_GET["getmodule"])); echo isset($_GET["getmodule"]) ? ucfirst($split[0]) : ""; ?>
      </h5>
      <ul class="links">
        <li>
          <a href=""></a>        </li>
      </ul>
    </div>
    <div class="table">
      <?php 
if($_GET["mn"]
<>
"") 
{ 
$menu = $_GET["mn"]; 
$module = $_GET["getmodule"]; 
$box =	isset($_GET["box"])? $_GET["box"] : ""; 
switch($_GET["mn"]){case "about" :	include "about.php";	break;case "$menu" :	if ($box == "")		include  "modules/".base64_decode($module)."/"."$menu.php";		break;	}	if (isset($_GET["box"])) {		include  "box.php";	}}
?>
      
      
	</div>
  </div>
  
  <?php 
if($_GET["mn"]==""){		  
?>
  <div class="box">
	<iframe src="db.php" width="100%" height="600"></iframe>
  </div>
  <?php  } ?>
  <!-- messages -->
  <!-- end messages -->
  <!-- forms -->
  <!-- end forms -->
  <!-- box / left -->
  <!-- end box / left -->
  <!-- box / right -->
  <!-- end box / right -->
</div>
<!-- end content -->
<!-- footer -->
<div id="footer">
  <p>
    Copyright &copy; 2014-2015 
    <a href="http://www.jogjaide.web.id" target="_blank">
      #
    </a>
    . All Rights Reserved.
  </p>
</div>
<!-- end footert -->
</body>
</html>