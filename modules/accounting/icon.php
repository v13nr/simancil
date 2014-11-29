<?php 
		include_once("../../config_sistem.php");
		include_once("../../class/class.msDB.php"); 
		include_once("../../class/class.grid.php");
		include_once("../../class/class.grid.akun.php");

		$grid = new grid(true); 
		$gridakun = new gridakun(true);
		
		$task = $_REQUEST['task']; 
		
		switch($task) {
			case 'getIcon': 
				$grid->setTable("iconcls"); 
				$grid->addField(
						array(
							"field"=>"id",
							"name"=>"id"
				));
				$grid->addField(
						array(
							"field"=>"title",
							"name"=>"title"
				));
				$grid->addField(
						array(
							"field"=>"clsname",
							"name"=>"clsname"
				));
				$grid->addField(
						array(
							"field"=>"icon",
							"name"=>"icon"
				));
				
				$result = $grid->doRead($_REQUEST); 	
				header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
				header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . 'GMT');
				header('Cache-Control: no-cache, must-revalidate');
				header('Pragma: no-cache');
				header('Content-Type: application/json');
				echo $result; 
			break; 
			case 'getCoa': 
				$gridakun->setTable("$database.kendali_akun"); 
				if(isset($_REQUEST['query'])){
					$q = $_REQUEST['query'];
					$gridakun->setManualFilter(" AND sektor = 'GLGPL' AND (title like '%".$q."%' OR kode like '%".$q."%') AND status = 1 AND published = 1 AND substr(kode, -3) <> '000' and kode <> ''");
					//$gridakun->setOrderBy("parent_id");
				}
				$gridakun->setOrderBy("kode");
				$gridakun->addField(
						array(
							"field"=>"id",
							"name"=>"id"
				));
				$gridakun->addField(
						array(
							"field"=>"title",
							"name"=>"title"
				));
				$gridakun->addField(
						array(
							"field"=>"kode",
							"name"=>"kode"
				));
				$gridakun->addField(
						array(
							"field"=>"sort_id",
							"name"=>"sort_id"
				));
				
				$result = $gridakun->doRead($_REQUEST); 	
				header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
				header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . 'GMT');
				header('Cache-Control: no-cache, must-revalidate');
				header('Pragma: no-cache');
				header('Content-Type: application/json');
				echo $result; 
			break; 
		}
		
?> 