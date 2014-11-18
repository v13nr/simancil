<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<script type="text/javascript" src="../assets/jquery-1.2.3.pack.js"></script>
<script src="../assets/app.js" type="text/javascript"></script>
<title>Tes</title>
<? include "../include/globalx.php";?>
<script type='text/javascript'>
  function show(page,div){
    do_scroll(0);
    var site = "<?=$site_path;?>";
    $.ajax({
      url: site+"/"+page,
      success: function(response){			
        $(div).html(response);
		$('#content').load("http:/localhost/");
      },
      dataType:"html"  		
    });
    return false;
  }
  function load(page,div){
    do_scroll(0);
    var site = "<?php echo $site_path;?>";
    $.ajax({
      url: site+"/"+page,
      success: function(response){			
      $(div).html(response);
      },
    dataType:"html"  		
    });
    return false;
  }
  function showx(page, div){
var site = "<?=$site_path;?>";
    url= site+"/"+page;
window.location.href = url;      
    return false;
  }  
</script>

</head>

<body>
<a href="javascript:void(0)" onclick='show("admin/index.php?mn=user","#content")' >Ubah Password</a>
<div id="content">
      <?php
        //$this->load->view('admin/index.php?mn=user');
      ?>
    </div>
</body>
</html>
