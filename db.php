<!DOCTYPE html>
<?php 
require_once "config_sistem.php";
?>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>DB - Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">

    <!-- Bootstrap -->
    <link href="db_files/bootstrap.css" rel="stylesheet">
    <link href="db_files/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="db_files/animate.css">
    <link type="text/css" rel="stylesheet" media="all" href="db_files/jquery.css">
    <link rel="stylesheet" href="db_files/jquery_002.css">
    <link rel="stylesheet" href="db_files/bootstrap-checkbox.css">

    <link rel="stylesheet" href="db_files/rickshaw.css">
    <link rel="stylesheet" href="db_files/morris.css">
    <link rel="stylesheet" href="db_files/tabdrop.css">
    <link rel="stylesheet" href="db_files/summernote.css">
    <link rel="stylesheet" href="db_files/summernote-bs3.css">
    <link rel="stylesheet" href="db_files/chosen.css">
    <link rel="stylesheet" href="db_files/chosen-bootstrap.css">

    <link href="db_files/minimal.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  <style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style></head>
  <body style="position: relative;" class="bg-1"><div id="mmenu" class="right-panel mm-menu mm-horizontal mm-right mm-next"><!-- Nav tabs --><ul id="mm-m0-p0" class="nav nav-tabs nav-justified mm-panel mm-opened mm-current">
            <li class="active"><a href="#mmenu-users" data-toggle="tab"><i class="fa fa-users"></i></a></li>
            <li class=""><a href="#mmenu-history" data-toggle="tab"><i class="fa fa-clock-o"></i></a></li>
            <li class=""><a href="#mmenu-friends" data-toggle="tab"><i class="fa fa-heart"></i></a></li>
            <li class=""><a href="#mmenu-settings" data-toggle="tab"><i class="fa fa-gear"></i></a></li>
          </ul><!-- Tab panes --><div id="mm-m0-p1" class="tab-content mm-panel">
            <div class="tab-pane active" id="mmenu-users">
              <h5><strong>Online</strong> Users</h5>

              <ul class="users-list">
                
                <li class="online">
                  <div class="media">
                    <a class="pull-left profile-photo" href="#">
                      <img class="media-object" src="db_files/ici-avatar.jpg" alt="">
                    </a>
                    <div class="media-body">
                      <h6 class="media-heading">Ing. Imrich <strong>Kamarel</strong></h6>
                      <small><i class="fa fa-map-marker"></i> Ulaanbaatar, Mongolia</small>
                      <span class="badge badge-outline status"></span>
                    </div>
                  </div>
                </li>

                <li class="online">
                  <div class="media">
                    
                    <a class="pull-left profile-photo" href="#">
                      <img class="media-object" src="db_files/arnold-avatar.jpg" alt="">
                    </a>
                    <span class="badge badge-red unread">3</span>

                    <div class="media-body">
                      <h6 class="media-heading">Arnold <strong>Karlsberg</strong></h6>
                      <small><i class="fa fa-map-marker"></i> Bratislava, Slovakia</small>
                      <span class="badge badge-outline status"></span>
                    </div>

                  </div>
                </li>

                <li class="online">
                  <div class="media">
                    <a class="pull-left profile-photo" href="#">
                      <img class="media-object" src="db_files/peter-avatar.jpg" alt="">

                    </a>
                    <div class="media-body">
                      <h6 class="media-heading">Peter <strong>Kay</strong></h6>
                      <small><i class="fa fa-map-marker"></i> Kosice, Slovakia</small>
                      <span class="badge badge-outline status"></span>
                    </div>
                  </div>
                </li>

                <li class="online">
                  <div class="media">
                    <a class="pull-left profile-photo" href="#">
                      <img class="media-object" src="db_files/george-avatar.jpg" alt="">
                    </a>
                    <div class="media-body">
                      <h6 class="media-heading">George <strong>McCain</strong></h6>
                      <small><i class="fa fa-map-marker"></i> Prague, Czech Republic</small>
                      <span class="badge badge-outline status"></span>
                    </div>
                  </div>
                </li>

                <li class="busy">
                  <div class="media">
                    <a class="pull-left profile-photo" href="#">
                      <img class="media-object" src="db_files/random-avatar1.jpg" alt="">
                    </a>
                    <div class="media-body">
                      <h6 class="media-heading">Lucius <strong>Cashmere</strong></h6>
                      <small><i class="fa fa-map-marker"></i> Wien, Austria</small>
                      <span class="badge badge-outline status"></span>
                    </div>
                  </div>
                </li>

                <li class="busy">
                  <div class="media">
                    <a class="pull-left profile-photo" href="#">
                      <img class="media-object" src="db_files/random-avatar2.jpg" alt="">
                    </a>
                    <div class="media-body">
                      <h6 class="media-heading">Jesse <strong>Phoenix</strong></h6>
                      <small><i class="fa fa-map-marker"></i> Berlin, Germany</small>
                      <span class="badge badge-outline status"></span>
                    </div>
                  </div>
                </li>

              </ul>

              <h5><strong>Offline</strong> Users</h5>

              <ul class="users-list">
                
                <li class="offline">
                  <div class="media">
                    <a class="pull-left profile-photo" href="#">
                      <img class="media-object" src="db_files/random-avatar4.jpg" alt="">
                    </a>
                    <div class="media-body">
                      <h6 class="media-heading">Dell <strong>MacApple</strong></h6>
                      <small><i class="fa fa-map-marker"></i> Paris, France</small>
                      <span class="badge badge-outline status"></span>
                    </div>
                  </div>
                </li>

                <li class="offline">
                  <div class="media">
                    
                    <a class="pull-left profile-photo" href="#">
                      <img class="media-object" src="db_files/random-avatar5.jpg" alt="">
                    </a>

                    <div class="media-body">
                      <h6 class="media-heading">Roger <strong>Flopple</strong></h6>
                      <small><i class="fa fa-map-marker"></i> Rome, Italia</small>
                      <span class="badge badge-outline status"></span>
                    </div>
                    
                  </div>
                </li>

                <li class="offline">
                  <div class="media">
                    <a class="pull-left profile-photo" href="#">
                      <img class="media-object" src="db_files/random-avatar6.jpg" alt="">

                    </a>
                    <div class="media-body">
                      <h6 class="media-heading">Nico <strong>Vulture</strong></h6>
                      <small><i class="fa fa-map-marker"></i> Kyjev, Ukraine</small>
                      <span class="badge badge-outline status"></span>
                    </div>
                  </div>
                </li>

                <li class="offline">
                  <div class="media">
                    <a class="pull-left profile-photo" href="#">
                      <img class="media-object" src="db_files/random-avatar7.jpg" alt="">
                    </a>
                    <div class="media-body">
                      <h6 class="media-heading">Bobby <strong>Socks</strong></h6>
                      <small><i class="fa fa-map-marker"></i> Moscow, Russia</small>
                      <span class="badge badge-outline status"></span>
                    </div>
                  </div>
                </li>

                <li class="offline">
                  <div class="media">
                    <a class="pull-left profile-photo" href="#">
                      <img class="media-object" src="db_files/random-avatar8.jpg" alt="">
                    </a>
                    <div class="media-body">
                      <h6 class="media-heading">Anna <strong>Opichia</strong></h6>
                      <small><i class="fa fa-map-marker"></i> Budapest, Hungary</small>
                      <span class="badge badge-outline status"></span>
                    </div>
                  </div>
                </li>

              </ul>

            </div>

            <div class="tab-pane" id="mmenu-history">
              <h5><strong>Chat</strong> History</h5>

              <ul class="history-list">
                
                <li class="online">
                  <div class="media">
                    <a class="pull-left profile-photo" href="#">
                      <img class="media-object" src="db_files/ici-avatar.jpg" alt="">
                    </a>
                    <div class="media-body">
                      <h6 class="media-heading">Ing. Imrich <strong>Kamarel</strong></h6>
                      <small>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor</small>
                      <span class="badge badge-outline status"></span>
                    </div>
                  </div>
                </li>

                <li class="busy">
                  <div class="media">
                    
                    <a class="pull-left profile-photo" href="#">
                      <img class="media-object" src="db_files/arnold-avatar.jpg" alt="">
                    </a>
                    <span class="badge badge-red unread">3</span>

                    <div class="media-body">
                      <h6 class="media-heading">Arnold <strong>Karlsberg</strong></h6>
                      <small>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur</small>
                      <span class="badge badge-outline status"></span>
                    </div>

                  </div>
                </li>

                <li class="offline">
                  <div class="media">
                    <a class="pull-left profile-photo" href="#">
                      <img class="media-object" src="db_files/peter-avatar.jpg" alt="">

                    </a>
                    <div class="media-body">
                      <h6 class="media-heading">Peter <strong>Kay</strong></h6>
                      <small>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit </small>
                      <span class="badge badge-outline status"></span>
                    </div>
                  </div>
                </li>

              </ul>
                
            </div>

            <div class="tab-pane" id="mmenu-friends">
              <h5><strong>Friends</strong> List</h5>
                <ul class="favourite-list">
                
                <li class="online">
                  <div class="media">
                    
                    <a class="pull-left profile-photo" href="#">
                      <img class="media-object" src="db_files/arnold-avatar.jpg" alt="">
                    </a>
                    <span class="badge badge-red unread">3</span>

                    <div class="media-body">
                      <h6 class="media-heading">Arnold <strong>Karlsberg</strong></h6>
                      <small><i class="fa fa-map-marker"></i> Bratislava, Slovakia</small>
                      <span class="badge badge-outline status"></span>
                    </div>

                  </div>
                </li>

                <li class="offline">
                  <div class="media">
                    <a class="pull-left profile-photo" href="#">
                      <img class="media-object" src="db_files/random-avatar8.jpg" alt="">
                    </a>
                    <div class="media-body">
                      <h6 class="media-heading">Anna <strong>Opichia</strong></h6>
                      <small><i class="fa fa-map-marker"></i> Budapest, Hungary</small>
                      <span class="badge badge-outline status"></span>
                    </div>
                  </div>
                </li>

                <li class="busy">
                  <div class="media">
                    <a class="pull-left profile-photo" href="#">
                      <img class="media-object" src="db_files/random-avatar1.jpg" alt="">
                    </a>
                    <div class="media-body">
                      <h6 class="media-heading">Lucius <strong>Cashmere</strong></h6>
                      <small><i class="fa fa-map-marker"></i> Wien, Austria</small>
                      <span class="badge badge-outline status"></span>
                    </div>
                  </div>
                </li>

                <li class="online">
                  <div class="media">
                    <a class="pull-left profile-photo" href="#">
                      <img class="media-object" src="db_files/ici-avatar.jpg" alt="">
                    </a>
                    <div class="media-body">
                      <h6 class="media-heading">Ing. Imrich <strong>Kamarel</strong></h6>
                      <small><i class="fa fa-map-marker"></i> Ulaanbaatar, Mongolia</small>
                      <span class="badge badge-outline status"></span>
                    </div>
                  </div>
                </li>

              </ul>
            </div>

            <div class="tab-pane pane-settings" id="mmenu-settings">
              <h5><strong>Chat</strong> Settings</h5>

              <ul class="settings">
               
                <li>
                  <div class="form-group">
                    <label class="col-xs-8 control-label">Show Offline Users</label>
                    <div class="col-xs-4 control-label">
                      <div class="onoffswitch greensea">
                        <input name="onoffswitch" class="onoffswitch-checkbox" id="show-offline" checked="checked" type="checkbox">
                        <label class="onoffswitch-label" for="show-offline">
                          <span class="onoffswitch-inner"></span>
                          <span class="onoffswitch-switch"></span>
                        </label>
                      </div>
                    </div>
                  </div>
                </li>

                <li>
                  <div class="form-group">
                    <label class="col-xs-8 control-label">Show Fullname</label>
                    <div class="col-xs-4 control-label">
                      <div class="onoffswitch greensea">
                        <input name="onoffswitch" class="onoffswitch-checkbox" id="show-fullname" type="checkbox">
                        <label class="onoffswitch-label" for="show-fullname">
                          <span class="onoffswitch-inner"></span>
                          <span class="onoffswitch-switch"></span>
                        </label>
                      </div>
                    </div>
                  </div>
                </li>

                <li>
                  <div class="form-group">
                    <label class="col-xs-8 control-label">History Enable</label>
                    <div class="col-xs-4 control-label">
                      <div class="onoffswitch greensea">
                        <input name="onoffswitch" class="onoffswitch-checkbox" id="show-history" checked="checked" type="checkbox">
                        <label class="onoffswitch-label" for="show-history">
                          <span class="onoffswitch-inner"></span>
                          <span class="onoffswitch-switch"></span>
                        </label>
                      </div>
                    </div>
                  </div>
                </li>

                <li>
                  <div class="form-group">
                    <label class="col-xs-8 control-label">Show Locations</label>
                    <div class="col-xs-4 control-label">
                      <div class="onoffswitch greensea">
                        <input name="onoffswitch" class="onoffswitch-checkbox" id="show-location" checked="checked" type="checkbox">
                        <label class="onoffswitch-label" for="show-location">
                          <span class="onoffswitch-inner"></span>
                          <span class="onoffswitch-switch"></span>
                        </label>
                      </div>
                    </div>
                  </div>
                </li>

                <li>
                  <div class="form-group">
                    <label class="col-xs-8 control-label">Notifications</label>
                    <div class="col-xs-4 control-label">
                      <div class="onoffswitch greensea">
                        <input name="onoffswitch" class="onoffswitch-checkbox" id="show-notifications" type="checkbox">
                        <label class="onoffswitch-label" for="show-notifications">
                          <span class="onoffswitch-inner"></span>
                          <span class="onoffswitch-switch"></span>
                        </label>
                      </div>
                    </div>
                  </div>
                </li>

                <li>
                  <div class="form-group">
                    <label class="col-xs-8 control-label">Show Undread Count</label>
                    <div class="col-xs-4 control-label">
                      <div class="onoffswitch greensea">
                        <input name="onoffswitch" class="onoffswitch-checkbox" id="show-unread" checked="checked" type="checkbox">
                        <label class="onoffswitch-label" for="show-unread">
                          <span class="onoffswitch-inner"></span>
                          <span class="onoffswitch-switch"></span>
                        </label>
                      </div>
                    </div>
                  </div>
                </li>

              </ul>
                
            </div><!-- tab-pane -->
              
          </div><!-- tab-content --></div>

    <!-- Preloader -->
    <div class="mm-page"><div style="display: none;" class="mask"><div style="display: none;" id="loader"></div></div><div id="wrap">

      


      <!-- Make page fluid -->
      <div class="row">
        




        <!-- Fixed navbar -->
        <div class="navbar navbar-default navbar-fixed-top navbar-transparent-black mm-fixed-top" role="navigation" id="navbar">
          


          <!-- Branding -->
          
          <!-- Branding end -->


          <!-- .nav-collapse -->
          
          <!--/.nav-collapse -->


		<BR>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DASHBOARD

        </div>
        <!-- Fixed navbar end -->
        




        
        <!-- Page content -->
        <div tabindex="5001" style="overflow: hidden; padding-left: 25px;" id="content" class="col-md-12">
          
          <!-- content main container -->
          <div class="main">

            <!-- cards -->
            <div class="row cards">
              
              <div class="card-container col-lg-3 col-sm-6 col-sm-12">
                <div class="card card-redbrown hover">
                  <div class="front"> 

                    <div class="media">        
                      <span class="pull-left">
                        <i class="fa fa-users media-object"></i>
                      </span>

                      <div class="media-body">
                        <small>Jumlah Pelanggan Tetap</small>
						<?php  
						$sql = "select count(kode) from konsumen";
						$hasil = mysql_query($sql) or die(mysql_error());
						$baris = mysql_fetch_array($hasil); 
						$jum_user = $baris[0]; 
						?>
                        <h2 class="media-heading animate-number" data-value="<?php  echo $jum_user;?>" data-animation-duration="1500"><?php  echo number_format($jum_user);?></h2>
                      </div>
                    </div> 

                    <div class="progress-list">
                      <div class="details">
                        <div class="title">This month plan %</div>
                      </div>
                      <div class="status pull-right bg-transparent-black-1">
                        <span class="animate-number" data-value="83" data-animation-duration="1500">83</span>%
                      </div>
                      <div class="clearfix"></div>
                      <div class="progress progress-little progress-transparent-black">
                        <div style="width: 83%;" class="progress-bar animate-progress-bar" data-percentage="83%"></div>
                      </div>
                    </div>

                  </div>
                  <div class="back">
                    <a href="#">
                      <i class="fa fa-bar-chart-o fa-4x"></i>
                      <span>Check Summary</span>
                    </a>  
                  </div>
                </div>
              </div>


              <div class="card-container col-lg-3 col-sm-6 col-sm-12">
                <div class="card card-blue hover">
                  <div class="front">        
                    
                    <div class="media">                  
                      <span class="pull-left">
                        <i class="fa fa-usd media-object"></i>
                      </span>

                      <div class="media-body">
                        <small>Total Pendapatan Kotor</small>
						<?php  
						$sql = "select sum((harga-modal)*qtyout) from mutasi WHERE model = 'INV'";
						$hasil = mysql_query($sql) or die(mysql_error());
						$baris = mysql_fetch_array($hasil); 
						$jum_untung = $baris[0]; 
						?>
                        <h2 class="media-heading animate-number" data-value="<?php  echo number_format($jum_untung);?>" data-animation-duration="1500">
						<?php  echo  number_format($jum_untung);?></h2>
                      </div>
                    </div> 

                    <div class="progress-list">
                      <div class="details">
                        <div class="title">This month plan %</div>
                      </div>
                      <div class="status pull-right bg-transparent-black-1">
                        <span class="animate-number" data-value="100" data-animation-duration="1500">100</span>%
                      </div>
                      <div class="clearfix"></div>
                      <div class="progress progress-little progress-transparent-black">
                        <div style="width: 100%;" class="progress-bar animate-progress-bar" data-percentage="100%"></div>
                      </div>
                    </div>

                  </div>
                  <div class="back">
                    <a href="#">
                      <i class="fa fa-bar-chart-o fa-4x"></i>
                      <span>Check Summary</span>
                    </a>
                  </div>
                </div>
              </div>



              <div class="card-container col-lg-3 col-sm-6 col-sm-12">
                <div class="card card-greensea hover">
                  <div class="front">        
                    
                    <div class="media">
                      <span class="pull-left">
                        <i class="fa fa-shopping-cart media-object"></i>
                      </span>

                      <div class="media-body">
                        <small>Sales</small>
						<?php  
						$sql = "select sum(harga*qtyout) from mutasi WHERE model = 'INV'";
						$hasil = mysql_query($sql) or die(mysql_error());
						$baris = mysql_fetch_array($hasil); 
						$jum_sales = $baris[0]; 
						?>
                        <h2 class="media-heading animate-number" data-value="<?php  echo  number_format($jum_sales);?>" data-animation-duration="1500"><?php  echo  number_format($jum_sales);?></h2>
                      </div>
                    </div>

                    <div class="progress-list">
                      <div class="details">
                        <div class="title">This month plan %</div>
                      </div>
                      <div class="status pull-right bg-transparent-black-1">
                        <span class="animate-number" data-value="42" data-animation-duration="1500">42</span>%
                      </div>
                      <div class="clearfix"></div>
                      <div class="progress progress-little progress-transparent-black">
                        <div style="width: 42%;" class="progress-bar animate-progress-bar" data-percentage="42%"></div>
                      </div>
                    </div>

                  </div>
                  <div class="back">
                    <a href="#">
                      <i class="fa fa-bar-chart-o fa-4x"></i>
                      <span>Check Summary</span>
                    </a>
                  </div>
                </div>
              </div>


              <div class="card-container col-lg-3 col-sm-6 col-xs-12">
                <div class="card card-slategray hover">
                  <div class="front"> 

                    <div class="media">                   
                      <span class="pull-left">
                        <i class="fa fa-eye media-object"></i>
                      </span>

                      <div class="media-body">
                        <small>Visits</small>
                        <h2 class="media-heading animate-number" data-value="9634" data-animation-duration="1500">9,634</h2>
                      </div>
                    </div> 

                    <div class="progress-list">
                      <div class="details">
                        <div class="title">This month plan %</div>
                      </div>
                      <div class="status pull-right bg-transparent-black-1">
                        <span class="animate-number" data-value="25" data-animation-duration="1500">25</span>%
                      </div>
                      <div class="clearfix"></div>
                      <div class="progress progress-little progress-transparent-black">
                        <div style="width: 25%;" class="progress-bar animate-progress-bar" data-percentage="25%"></div>
                      </div>
                    </div>

                  </div>
                  <div class="back">
                    <a href="#">
                      <i class="fa fa-bar-chart-o fa-4x"></i>
                      <span>Check Summary</span>
                    </a>
                  </div>
                </div>
              </div>


            </div>
            <!-- /cards -->
            
            


            <!-- row -->
            <div class="row">


              <!-- col 8 -->
              <div class="col-lg-8 col-md-12">




                <!-- tile -->
                <section class="tile transparent">




                  <!-- tile header -->
                  <div class="tile-header color transparent-black textured rounded-top-corners">
                    <h1><strong>Grafik</strong> Penjualan</h1>
                    <div class="controls">
                      <a href="#" class="minimize"><i class="fa fa-chevron-down"></i></a>
                      <a href="#" class="refresh"><i class="fa fa-refresh"></i></a>
                      <a href="#" class="remove"><i class="fa fa-times"></i></a>
                    </div>
                  </div>
                  <!-- /tile header -->


                  <!-- tile widget -->
                  <div class="tile-widget color transparent-black textured">
                    <div id="statistics-chart" class="chart statistics" style="height: 250px; padding: 0px; position: relative;"><canvas height="250" width="677" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 677px; height: 250px;" class="flot-base"></canvas><div style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; font-size: smaller; color: rgb(84, 84, 84);" class="flot-text"><div style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;" class="flot-x-axis flot-x1-axis xAxis x1Axis">
					
					<div style="position: absolute; max-width: 56px; top: 225px; font: 300 14px/24px &quot;Roboto&quot;,&quot;Arial&quot;,sans-serif; color: rgb(255, 255, 255); left: 33px; text-align: center;">JAN</div>
					
					<div style="position: absolute; max-width: 56px; top: 225px; font: 300 14px/24px &quot;Roboto&quot;,&quot;Arial&quot;,sans-serif; color: rgb(255, 255, 255); left: 90px; text-align: center;">FEB</div><div style="position: absolute; max-width: 56px; top: 225px; font: 300 14px/24px &quot;Roboto&quot;,&quot;Arial&quot;,sans-serif; color: rgb(255, 255, 255); left: 143px; text-align: center;">MAR</div><div style="position: absolute; max-width: 56px; top: 225px; font: 300 14px/24px &quot;Roboto&quot;,&quot;Arial&quot;,sans-serif; color: rgb(255, 255, 255); left: 201px; text-align: center;">APR</div><div style="position: absolute; max-width: 56px; top: 225px; font: 300 14px/24px &quot;Roboto&quot;,&quot;Arial&quot;,sans-serif; color: rgb(255, 255, 255); left: 256px; text-align: center;">MAY</div><div style="position: absolute; max-width: 56px; top: 225px; font: 300 14px/24px &quot;Roboto&quot;,&quot;Arial&quot;,sans-serif; color: rgb(255, 255, 255); left: 313px; text-align: center;">JUN</div><div style="position: absolute; max-width: 56px; top: 225px; font: 300 14px/24px &quot;Roboto&quot;,&quot;Arial&quot;,sans-serif; color: rgb(255, 255, 255); left: 370px; text-align: center;">JUL</div><div style="position: absolute; max-width: 56px; top: 225px; font: 300 14px/24px &quot;Roboto&quot;,&quot;Arial&quot;,sans-serif; color: rgb(255, 255, 255); left: 424px; text-align: center;">AUG</div><div style="position: absolute; max-width: 56px; top: 225px; font: 300 14px/24px &quot;Roboto&quot;,&quot;Arial&quot;,sans-serif; color: rgb(255, 255, 255); left: 482px; text-align: center;">SEP</div><div style="position: absolute; max-width: 56px; top: 225px; font: 300 14px/24px &quot;Roboto&quot;,&quot;Arial&quot;,sans-serif; color: rgb(255, 255, 255); left: 537px; text-align: center;">OCT</div><div style="position: absolute; max-width: 56px; top: 225px; font: 300 14px/24px &quot;Roboto&quot;,&quot;Arial&quot;,sans-serif; color: rgb(255, 255, 255); left: 592px; text-align: center;">NOV</div><div style="position: absolute; max-width: 56px; top: 225px; font: 300 14px/24px &quot;Roboto&quot;,&quot;Arial&quot;,sans-serif; color: rgb(255, 255, 255); left: 649px; text-align: center;">DEC</div></div><div style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;" class="flot-y-axis flot-y1-axis yAxis y1Axis"><div style="position: absolute; top: 199px; font: 300 11px/13px &quot;Roboto&quot;,&quot;Arial&quot;,sans-serif; color: rgb(255, 255, 255); left: 20px; text-align: right;">0</div><div style="position: absolute; top: 166px; font: 300 11px/13px &quot;Roboto&quot;,&quot;Arial&quot;,sans-serif; color: rgb(255, 255, 255); left: 7px; text-align: right;">500</div><div style="position: absolute; top: 133px; font: 300 11px/13px &quot;Roboto&quot;,&quot;Arial&quot;,sans-serif; color: rgb(255, 255, 255); left: 1px; text-align: right;">1000</div><div style="position: absolute; top: 100px; font: 300 11px/13px &quot;Roboto&quot;,&quot;Arial&quot;,sans-serif; color: rgb(255, 255, 255); left: 1px; text-align: right;">1500</div><div style="position: absolute; top: 67px; font: 300 11px/13px &quot;Roboto&quot;,&quot;Arial&quot;,sans-serif; color: rgb(255, 255, 255); left: 1px; text-align: right;">2000</div><div style="position: absolute; top: 34px; font: 300 11px/13px &quot;Roboto&quot;,&quot;Arial&quot;,sans-serif; color: rgb(255, 255, 255); left: 1px; text-align: right;">2500</div><div style="position: absolute; top: 1px; font: 300 11px/13px &quot;Roboto&quot;,&quot;Arial&quot;,sans-serif; color: rgb(255, 255, 255); left: 1px; text-align: right;">3000</div></div></div><canvas height="250" width="677" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 677px; height: 250px;" class="flot-overlay"></canvas></div>
                  </div>
                  <!-- /tile widget -->


                  <!-- tile body -->
                  <div class="tile-body color transparent-white rounded-bottom-corners">
                   
                  </div>
                  <!-- /tile body -->



                </section>
                <!-- /tile -->



                <!-- tile -->
                <section class="tile color transparent-black">




                  <!-- tile header -->
                  <div class="tile-header">
                    <h1><strong>Hutang</strong>- On-Going</h1>
                    <div class="search">
                      <input placeholder="Search..." type="text">
                    </div>
                    <div class="controls">
                      <a href="#" class="minimize"><i class="fa fa-chevron-down"></i></a>
                      <a href="#" class="refresh"><i class="fa fa-refresh"></i></a>
                      <a href="#" class="remove"><i class="fa fa-times"></i></a>
                    </div>
                  </div>
                  <!-- /tile header -->


                  <!-- tile body -->
                  <div class="tile-body no-vpadding">
                    <div class="table-responsive">
                      <table class="table table-custom table-sortable nomargin">
                        <thead>
                          <tr>
                            <th class="sortable sort-numeric sort-asc">ID</th>
                            <th class="sortable sort-alpha">Project</th>
                            <th class="sortable">Priority</th>
                            <th class="sortable sort-amount">Status</th>
                            <th class="text-right">Chart</th>
                          </tr>
                        </thead>
                        <tbody>
						<?php 
							$sql = "select * from hutang";
							$hasil = mysql_query($sql) or die(mysql_error());
							while($baris = mysql_fetch_array($hasil)){
						?>
                          <tr>
                            <td>1</td>
                            <td><?php  echo $baris["nama"]; ?> <i class="fa fa-heart"><i class="fa fa-smile-o"> </i> </i></td>
                            <td class="color-red priority">High priority</td>
                            <td class="progress-cell">
                              <div class="progress-info">
                                <div class="percent"><span class="animate-number" data-value="50" data-animation-duration="1500">50</span>%</div>
                              </div>
                              <div class="progress progress-little">
                                <div style="width: 50%;" class="progress-bar progress-bar-transparent-white animate-progress-bar" data-percentage="50%"></div>
                              </div>
                            </td>
                            <td class="text-right"><span id="projectbar1"><canvas height="20" width="39" style="display: inline-block; width: 39px; height: 20px; vertical-align: top;"></canvas></span></td>
                          </tr>
                         <?php  } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <!-- /tile body -->


                  <!-- tile footer -->
                  <div class="tile-footer text-center">
                    <ul class="pagination pagination-sm nomargin pagination-custom">
                      <li class="disabled"><a href="#"><i class="fa fa-angle-double-left"></i></a></li>
                      <li class="active"><a href="#">1</a></li>
                      <li><a href="#">2</a></li>
                      <li><a href="#">3</a></li>
                      <li><a href="#">4</a></li>
                      <li><a href="#">5</a></li>
                      <li><a href="#"><i class="fa fa-angle-double-right"></i></a></li>
                    </ul>
                  </div>
                  <!-- /tile footer -->



                </section>
                <!-- /tile -->


              </div>
              <!-- /col 8 -->



              <!-- col 4 -->
              <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                






                <!-- tile -->
                <section class="tile color transparent-black">



                  <!-- tile header -->
                  <div class="tile-header">
                    <h1><strong>Day2Day</strong> Operations</h1>
                    <div class="controls">
                      <a href="#" class="minimize"><i class="fa fa-chevron-down"></i></a>
                      <a href="#" class="refresh"><i class="fa fa-refresh"></i></a>
                      <a href="#" class="remove"><i class="fa fa-times"></i></a>
                    </div>
                  </div>
                  <!-- /tile header -->

                  <!-- tile body -->
                  <div class="tile-body">
                    <div id="browser-usage" style="height: 230px;" class="morris-chart"><svg style="overflow: hidden; position: relative; left: -0.333313px;" xmlns="http://www.w3.org/2000/svg" width="309" version="1.1" height="230"><desc>Created with Raphaël 2.1.2</desc><defs></defs><path opacity="1" stroke-width="2" d="M154.5,185A70,70,0,0,0,224.4551653642948,117.50496284486826" stroke="#00a3d8" fill="none" style="opacity: 1;"></path><path stroke-width="3" d="M154.5,188A73,73,0,0,0,227.45324387990743,117.6123183953626L259.43274804644216,118.75744426730238A105,105,0,0,1,154.5,220Z" stroke="rgba(0,0,0,0)" fill="#00a3d8" style=""></path><path opacity="0" stroke-width="2" d="M224.4551653642948,117.50496284486826A70,70,0,0,0,179.4407140967063,49.59387811262346" stroke="#2fbbe8" fill="none" style="opacity: 0;"></path><path stroke-width="3" d="M227.45324387990743,117.6123183953626A73,73,0,0,0,180.509601843708,46.79075860316446L190.12959156672326,21.56268301803351A100,100,0,0,1,254.43595052042113,118.57851834981179Z" stroke="rgba(0,0,0,0)" fill="#2fbbe8" style=""></path><path opacity="0" stroke-width="2" d="M179.4407140967063,49.59387811262346A70,70,0,0,0,115.83011872366656,56.65070452803842" stroke="#72cae7" fill="none" style="opacity: 0;"></path><path stroke-width="3" d="M180.509601843708,46.79075860316446A73,73,0,0,0,114.17283809753798,54.150020436382924L99.2573124623808,31.643863611483454A100,100,0,0,1,190.12959156672326,21.56268301803351Z" stroke="rgba(0,0,0,0)" fill="#72cae7" style=""></path><path opacity="0" stroke-width="2" d="M115.83011872366656,56.65070452803842A70,70,0,0,0,97.58468525216037,74.24896385177001" stroke="#d9544f" fill="none" style="opacity: 0;"></path><path stroke-width="3" d="M114.17283809753798,54.150020436382924A73,73,0,0,0,95.14545747725295,72.50249087398872L73.19240750308623,56.78423407395715A100,100,0,0,1,99.2573124623808,31.643863611483454Z" stroke="rgba(0,0,0,0)" fill="#d9544f" style=""></path><path opacity="0" stroke-width="2" d="M97.58468525216037,74.24896385177001A70,70,0,0,0,84.54405113058007,117.48298565825587" stroke="#ffc100" fill="none" style="opacity: 0;"></path><path stroke-width="3" d="M95.14545747725295,72.50249087398872A73,73,0,0,0,81.54593903617635,117.58939932932398L54.56293018654296,118.54712236893695A100,100,0,0,1,73.19240750308623,56.78423407395715Z" stroke="rgba(0,0,0,0)" fill="#ffc100" style=""></path><path opacity="0" stroke-width="2" d="M84.54405113058007,117.48298565825587A70,70,0,0,0,154.47800885178657,184.9999965456385" stroke="#1693a5" fill="none" style="opacity: 0;"></path><path stroke-width="3" d="M81.54593903617635,117.58939932932398A73,73,0,0,0,154.47706637400597,187.99999639759443L154.4685840739808,214.99999506519785A100,100,0,0,1,54.56293018654296,118.54712236893695Z" stroke="rgba(0,0,0,0)" fill="#1693a5" style=""></path><text stroke-width="0.6" transform="matrix(1.6667,0,0,1.6667,-102.9167,-77)" font-weight="800" font-size="15px" fill="#000000" stroke="none" font="10px &quot;Arial&quot;" text-anchor="middle" y="105" x="154.5" style="text-anchor: middle; font: 800 15px &quot;Arial&quot;;"><tspan dy="5.5">Vehicles</tspan></text><text stroke-width="0.8142857142857143" transform="matrix(1.2281,0,0,1.2281,-35.2178,-26.3421)" font-size="14px" fill="#000000" stroke="none" font="10px &quot;Arial&quot;" text-anchor="middle" y="125" x="154.5" style="text-anchor: middle; font: 14px &quot;Arial&quot;;"><tspan dy="5.5">25</tspan></text></svg></div>
                    <ul class="inline text-center chart-legend">
                      <li><span class="badge badge-outline" style="border-color: #00a3d8"></span> Vehicles <small>25%</small>,</li>
                      <li><span class="badge badge-outline" style="border-color: #1693A5"></span> Electric Utilization <small>25%</small>,</li>
                      <li><span class="badge badge-outline" style="border-color: #2fbbe8"></span> Motorcycle <small>20%</small>,</li>
                      <li><span class="badge badge-outline" style="border-color: #72cae7"></span> Visitor <small>15%</small>,</li>
                      <li><span class="badge badge-outline" style="border-color: #ffc100"></span> Water Utilization <small>10%</small>,</li>
                      <li><span class="badge badge-outline" style="border-color: #d9544f"></span> Complaint <small>5%</small></li>
                    </ul>
                  </div>
                  <!-- /tile body --> 




                </section>
                <!-- /tile -->



                <!-- tile -->
                <section class="tile transparent">




                  <!-- tile header -->
                  <div class="tile-header color redbrown rounded-top-corners text-center">               
                    <button class="btn pull-left btn-black-transparent" type="button"><i class="fa fa-caret-square-o-down"></i></button>
                    <h2><strong>Todo</strong> List</h2>
                    <div class="controls">
                      <a href="#" class="minimize"><i class="fa fa-chevron-down"></i></a>
                      <a href="#" class="refresh"><i class="fa fa-refresh"></i></a>
                      <a href="#" class="remove"><i class="fa fa-times"></i></a>
                    </div>
                  </div>
                  <!-- /tile header -->

                  <!-- tile body -->
                  <div class="tile-body color transparent-black rounded-bottom-corners">
                    <input placeholder="Add new todo..." class="form-control w100p bottommargin" type="text">
                    <ul class="nolisttypes" id="todolist">
                      <li>
                        <div class="checkbox check-transparent">
                          <input value="1" id="todo-01" type="checkbox">
                          <label for="todo-01">Civil Works</label>
                        </div>
                      </li>
                      <li>
                        <div class="checkbox check-transparent">
                          <input checked="checked" value="1" id="todo-02" type="checkbox">
                          <label for="todo-02" class="done">Security Check</label>
                        </div>
                      </li>
                      <li>
                        <div class="checkbox check-transparent">
                          <input value="1" id="todo-03" type="checkbox">
                          <label for="todo-03">Space Sizing</label>
                        </div>
                      </li>
                      <li>
                        <div class="checkbox check-transparent">
                          <input value="1" id="todo-04" type="checkbox">
                          <label for="todo-04">Manage Complaints</label>
                        </div>
                      </li>
                      <li>
                        <div class="checkbox check-transparent">
                          <input value="1" id="todo-05" type="checkbox">
                          <label for="todo-05">Contact Tenant</label>
                        </div>
                      </li>
                      <li>
                        <div class="checkbox check-transparent">
                          <input value="1" id="todo-06" type="checkbox">
                          <label for="todo-06">Print Invoice</label>
                        </div>
                      </li>
                    </ul>
                  </div>
                  <!-- /tile body -->
                


                </section>
                <!-- /tile -->


              </div>
              <!-- /col 4 -->
              
              
            </div>
            <!-- /row -->


            <!-- row -->
            <div class="row">




              <!-- col 6 -->
              <div class="col-md-6">

                
                


              </div>
              <!-- /col 6 -->




              <!-- col 6 -->
              <div class="col-md-6">



                              


              </div>
              <!-- /col 6 -->
              



            </div>
            <!-- /row -->  



          </div>
          <!-- /content container -->






        </div>
        <!-- Page content end -->




        






      </div>
      <!-- Make page fluid-->




    </div></div>
    <!--/Preloader -->

    <!-- Wrap all page content here -->
    
    <!-- Wrap all page content end -->



    <section class="videocontent" id="video"></section>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="db_files/jquery_013.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="db_files/bootstrap.js"></script>
    <script type="text/javascript" src="db_files/jquery_008.js"></script>
    <script type="text/javascript" src="db_files/jquery_005.js"></script>
    <script type="text/javascript" src="db_files/jquery_002.js"></script>
    <script type="text/javascript" src="db_files/jquery.js"></script>
    <script type="text/javascript" src="db_files/jquery_009.js"></script>
    <script type="text/javascript" src="db_files/jquery_007.js"></script>

    <script src="db_files/jquery_012.js"></script>
    <script src="db_files/jquery_011.js"></script>
    <script src="db_files/jquery_004.js"></script>
    <script src="db_files/jquery_003.js"></script>
    <script src="db_files/jquery_006.js"></script>
    <script src="db_files/jquery_010.js"></script>

    <script src="db_files/raphael-min.js"></script> 
    <script src="db_files/d3.js"></script>
    <script src="db_files/rickshaw.js"></script>

    <script src="db_files/morris.js"></script>

    <script src="db_files/bootstrap-tabdrop.js"></script>

    <script src="db_files/summernote.js"></script>

    <script src="db_files/chosen.js"></script>

    <script src="db_files/minimal.js"></script>

    <script>
    $(function(){

      // Initialize card flip
      $('.card.hover').hover(function(){
        $(this).addClass('flip');
      },function(){
        $(this).removeClass('flip');
      });

      // Initialize flot chart
      var d1 =[ [1, <?php  $sql = "select sum(harga*qtyout) from mutasi WHERE MONTH(tgl) = '01' AND YEAR(tgl) = '". date('Y') ."' "; 
	  $hasil = mysql_query($sql) or die(mysql_error());
	  $baris = mysql_fetch_array($hasil);
	  echo $baris[0] != null?$baris[0]:0;
	  ?>],
            [2, <?php  $sql = "select sum(harga*qtyout) from mutasi WHERE MONTH(tgl) = '02' AND YEAR(tgl) = '". date('Y') ."' "; 
	  $hasil = mysql_query($sql) or die(mysql_error());
	  $baris = mysql_fetch_array($hasil);
	  echo $baris[0] != null?$baris[0]:0;
	  ?>],
            [3, <?php  $sql = "select sum(harga*qtyout) from mutasi WHERE MONTH(tgl) = '03' AND YEAR(tgl) = '". date('Y') ."' "; 
	  $hasil = mysql_query($sql) or die(mysql_error());
	  $baris = mysql_fetch_array($hasil);
	  echo $baris[0] != null?$baris[0]:0;
	  ?>],
            [4, <?php  $sql = "select sum(harga*qtyout) from mutasi WHERE MONTH(tgl) = '04' AND YEAR(tgl) = '". date('Y') ."' "; 
	  $hasil = mysql_query($sql) or die(mysql_error());
	  $baris = mysql_fetch_array($hasil);
	  echo $baris[0] != null?$baris[0]:0;
	  ?>],
            [5, <?php  $sql = "select sum(harga*qtyout) from mutasi WHERE MONTH(tgl) = '05' AND YEAR(tgl) = '". date('Y') ."' "; 
	  $hasil = mysql_query($sql) or die(mysql_error());
	  $baris = mysql_fetch_array($hasil);
	  echo $baris[0] != null?$baris[0]:0;
	  ?>],
            [6, <?php  $sql = "select sum(harga*qtyout) from mutasi WHERE MONTH(tgl) = '06' AND YEAR(tgl) = '". date('Y') ."' "; 
	  $hasil = mysql_query($sql) or die(mysql_error());
	  $baris = mysql_fetch_array($hasil);
	  echo $baris[0] != null?$baris[0]:0;
	  ?>],
            [7, <?php  $sql = "select sum(harga*qtyout) from mutasi WHERE MONTH(tgl) = '07' AND YEAR(tgl) = '". date('Y') ."' "; 
	  $hasil = mysql_query($sql) or die(mysql_error());
	  $baris = mysql_fetch_array($hasil);
	  echo $baris[0] != null?$baris[0]:0;
	  ?>],
            [8, <?php  $sql = "select sum(harga*qtyout) from mutasi WHERE MONTH(tgl) = '08' AND YEAR(tgl) = '". date('Y') ."' "; 
	  $hasil = mysql_query($sql) or die(mysql_error());
	  $baris = mysql_fetch_array($hasil);
	  echo $baris[0] != null?$baris[0]:0;
	  ?>],
            [9, <?php  $sql = "select sum(harga*qtyout) from mutasi WHERE MONTH(tgl) = '09' AND YEAR(tgl) = '". date('Y') ."' "; 
	  $hasil = mysql_query($sql) or die(mysql_error());
	  $baris = mysql_fetch_array($hasil);
	  echo $baris[0] != null?$baris[0]:0;
	  ?>],
            [10, <?php  $sql = "select sum(harga*qtyout) from mutasi WHERE MONTH(tgl) = '10' AND YEAR(tgl) = '". date('Y') ."' "; 
	  $hasil = mysql_query($sql) or die(mysql_error());
	  $baris = mysql_fetch_array($hasil);
	  echo $baris[0] != null?$baris[0]:0;
	  ?>],
            [11, <?php  $sql = "select sum(harga*qtyout) from mutasi WHERE MONTH(tgl) = '11' AND YEAR(tgl) = '". date('Y') ."' "; 
	  $hasil = mysql_query($sql) or die(mysql_error());
	  $baris = mysql_fetch_array($hasil);
	  echo $baris[0] != null?$baris[0]:0;
	  ?>],
            [12, <?php  $sql = "select sum(harga*qtyout) from mutasi WHERE MONTH(tgl) = '12' AND YEAR(tgl) = '". date('Y') ."' "; 
	  $hasil = mysql_query($sql) or die(mysql_error());
	  $baris = mysql_fetch_array($hasil);
	  echo $baris[0] != null?$baris[0]:0;
	  ?>]
      ];
      var d2 =[ [1, 1000],
                [2, 578],
                [3, 327],
                [4, 984],
                [5, 1268],
                [6, 1684],
                [7, 1425],
                [8, 1233],
                [9, 1354],
                [10, 1200],
                [11, 1260],
                [12, 1320]
      ];
      var months = ["January", "February", "March", "April", "May", "Juny", "July", "August", "September", "October", "November", "December"];

      // flot chart generate
      var plot = $.plotAnimator($("#statistics-chart"), 
        [
          {
            label: 'Sales', 
            data: d1,    
            lines: {lineWidth:3}, 
            shadowSize:0,
            color: '#ffffff'
          },
          { label: "Visits",
            data: d2, 
            animator: {steps: 99, duration: 500, start:200, direction: "right"},   
            lines: {        
              fill: .15,
              lineWidth: 0
            },
            color:['#ffffff']
          },{
            label: 'Sales',
            data: d1, 
            points: { show: true, fill: true, radius:6,fillColor:"rgba(0,0,0,.5)",lineWidth:2 }, 
            color: '#fff',        
            shadowSize:0
          },
          { label: "Visits",
            data: d2, 
            points: { show: true, fill: true, radius:6,fillColor:"rgba(255,255,255,.2)",lineWidth:2 }, 
            color: '#fff',        
            shadowSize:0
          }
        ],{ 
        
        xaxis: {

          tickLength: 0,
          tickDecimals: 0,
          min:1,
          ticks: [[1,"JAN"], [2, "FEB"], [3, "MAR"], [4, "APR"], [5, "MAY"], [6, "JUN"], [7, "JUL"], [8, "AUG"], [9, "SEP"], [10, "OCT"], [11, "NOV"], [12, "DEC"]],

          font :{
            lineHeight: 24,
            weight: "300",
            color: "#ffffff",
            size: 14
          }
        },
        
        yaxis: {
          ticks: 4,
          tickDecimals: 0,
          tickColor: "rgba(255,255,255,.3)",

          font :{
            lineHeight: 13,
            weight: "300",
            color: "#ffffff"
          }
        },
        
        grid: {
          borderWidth: {
            top: 0,
            right: 0,
            bottom: 1,
            left: 1
          },
          borderColor: 'rgba(255,255,255,.3)',
          margin:0,
          minBorderMargin:0,              
          labelMargin:20,
          hoverable: true,
          clickable: true,
          mouseActiveRadius:6
        },
        
        legend: { show: false}
      });

      $(window).resize(function() {
        // redraw the graph in the correctly sized div
        plot.resize();
        plot.setupGrid();
        plot.draw();
      });

      $('#mmenu').on(
        "opened.mm",
        function()
        {
          // redraw the graph in the correctly sized div
          plot.resize();
          plot.setupGrid();
          plot.draw();
        }
      );

      $('#mmenu').on(
        "closed.mm",
        function()
        {
          // redraw the graph in the correctly sized div
          plot.resize();
          plot.setupGrid();
          plot.draw();
        }
      );

      // tooltips showing
      $("#statistics-chart").bind("plothover", function (event, pos, item) {
        if (item) {
          var x = item.datapoint[0],
              y = item.datapoint[1];

          $("#tooltip").html('<h1 style="color: #418bca">' + months[x - 1] + '</h1>' + '<strong>' + y + '</strong>' + ' ' + item.series.label)
            .css({top: item.pageY-30, left: item.pageX+5})
            .fadeIn(200);
        } else {
          $("#tooltip").hide();
        }
      });

      
      //tooltips options
      $("<div id='tooltip'></div>").css({
        position: "absolute",
        //display: "none",
        padding: "10px 20px",
        "background-color": "#ffffff",
        "z-index":"99999"
      }).appendTo("body");

      //generate actual pie charts
      $('.pie-chart').easyPieChart();


      
      // Morris donut chart
      Morris.Donut({
        element: 'browser-usage',
        data: [
          {label: "Vehicles", value: 25},
          {label: "Motorcycle", value: 20},
          {label: "Visitor", value: 15},
          {label: "Complaint", value: 5},
          {label: "Water Utilization", value: 10},
          {label: "Electric Utilization", value: 25}
        ],
        colors: ['#00a3d8', '#2fbbe8', '#72cae7', '#d9544f', '#ffc100', '#1693A5']
      });

      $('#browser-usage').find("path[stroke='#ffffff']").attr('stroke', 'rgba(0,0,0,0)');

      //sparkline charts
      $('#projectbar1').sparkline('html', {type: 'bar', barColor: '#22beef', barWidth: 4, height: 20});
      $('#projectbar2').sparkline('html', {type: 'bar', barColor: '#cd97eb', barWidth: 4, height: 20});
      $('#projectbar3').sparkline('html', {type: 'bar', barColor: '#a2d200', barWidth: 4, height: 20});
      $('#projectbar4').sparkline('html', {type: 'bar', barColor: '#ffc100', barWidth: 4, height: 20});
      $('#projectbar5').sparkline('html', {type: 'bar', barColor: '#ff4a43', barWidth: 4, height: 20});
      $('#projectbar6').sparkline('html', {type: 'bar', barColor: '#a2d200', barWidth: 4, height: 20});

      // sortable table
      $('.table.table-sortable th.sortable').click(function() {
        var o = $(this).hasClass('sort-asc') ? 'sort-desc' : 'sort-asc';
        $('th.sortable').removeClass('sort-asc').removeClass('sort-desc');
        $(this).addClass(o);
      });

      //todo's
      $('#todolist li label').click(function() {
        $(this).toggleClass('done');
      });

      // Initialize tabDrop
      $('.tabdrop').tabdrop({text: '<i class="fa fa-th-list"></i>'});

      //load wysiwyg editor
      $('#quick-message-content').summernote({
        toolbar: [
          //['style', ['style']], // no style button
          ['style', ['bold', 'italic', 'underline', 'clear']],
          ['fontsize', ['fontsize']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['height', ['height']],
          //['insert', ['picture', 'link']], // no insert buttons
          //['table', ['table']], // no table button
          //['help', ['help']] //no help button
        ],
        height: 143   //set editable area's height
      });

      //multiselect input
      $(".chosen-select").chosen({disable_search_threshold: 10});
      
    })
      
    </script>
  

      
<div id="mm-blocker"></div><div style="width: 7px; z-index: 999999; cursor: default; position: fixed; top: 45px; left: 0px; height: 622px; display: none;" class="nicescroll-rails" id="ascrail2000"><div style="position: relative; top: 0px; float: right; width: 7px; height: 0px; background-color: rgb(0, 0, 0); background-clip: padding-box; border-radius: 0px;"></div></div><div style="height: 7px; z-index: 999999; top: 615px; left: 0px; position: fixed; cursor: default; display: none;" class="nicescroll-rails" id="ascrail2000-hr"><div style="position: relative; top: 0px; height: 7px; width: 0px; background-color: rgb(0, 0, 0); background-clip: padding-box; border-radius: 0px;"></div></div><div style="padding-left: 2px; padding-right: 2px; width: 11px; z-index: 999999; background: none repeat scroll 0% 0% rgba(0, 0, 0, 0.1); cursor: default; position: absolute; top: 0px; left: 1355px; height: 577px; opacity: 0.4;" class="nicescroll-rails" id="ascrail2001"><div style="position: relative; top: 0px; float: right; width: 7px; height: 251px; background-color: rgb(0, 0, 0); background-clip: padding-box; border-radius: 7px;"></div></div><div style="height: 7px; z-index: 999999; background: none repeat scroll 0% 0% rgba(0, 0, 0, 0.1); top: 570px; left: 0px; position: absolute; opacity: 0.4; cursor: default; display: none; width: 1355px;" class="nicescroll-rails" id="ascrail2001-hr"><div style="position: relative; top: 0px; height: 7px; width: 1366px; background-color: rgb(0, 0, 0); background-clip: padding-box; border-radius: 7px;"></div></div><div style="position: absolute; padding: 10px 20px; background-color: rgb(255, 255, 255); z-index: 99999;" id="tooltip"></div></body></html>
<!-- Localized -->