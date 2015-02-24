<?php
//Start the session
session_start();
error_reporting(0);
include "../../otentik_admin.php";
include "../../config_sistem.php";
//Is the user accessing this page logged in or not?
//tutup aja nanang 
/*
if (!isset($_SESSION['basic_is_logged_in']) 
    || $_SESSION['basic_is_logged_in'] !== true) {

    //User is not logged in, move to login page
    header('Location: login.php');
    exit;
}
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
	<title>SiMa MySQL Backup & Restore Administration</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link href="css/mysql-backup.css" rel="stylesheet" type="text/css" />
	
	</head>
	<body>
	
	<?php 
	//Include the top menu function
	require('settings.php'); topmenu(); 
	?>
	
<div class='placeholder'>

  <b class='container'>
  <b class='container1'></b>
  <b class='container2'><b></b></b>
  <b class='container3'></b>
  <b class='container4'></b>
  <b class='container5'></b></b>

  <div class='containercontent'>
  
<?php
//Include the settings.php file
require('settings.php');

//This function displays the text header and the navigation menu
function topmenu()
{
	global $settings;
	
	$content .= '<div class="header">'.$settings['headertext'].'</div>';
	$content .= '<ul id="nav_rounded_white">'; 
	$content .= '<li><a href="?">Quick Backup</a></li>';
	$content .= '<li><a href="?fct=manualbackup">Manual Backup</a></li>';
	$content .= '<li><a href="?fct=listbackups">List Backups</a></li>';
	$content .= '</ul>';
	
	echo $content;
}

//This function attaches the backup file to an email and sends to the "To" address defined in the settings.php file
function sendBackup($filename, $name){
 
global $errors, $success, $settings;

//Read POST request params into global vars
$to = $settings['emailto'];
$from = $settings['emailfrom'];
$subject = 'Your Backup for '.$name;
$message = 'Backup for '.$name.' made on '.format_timestamp(mktime(),5).'';

//Obtain file upload vars
$attachment = $filename;
$attachmenttype = "application/x-sql";
$attachmentname = $filename;

$attachmentname = explode('/',$attachmentname);
$attachmentname = $attachmentname[2];

$headers = "From: $from";

//Read the file to be attached, get the filesize and close
  $file = fopen($attachment,'rb');
  $data = fread($file,filesize($attachment));
  fclose($file);

  //Generate a MIME boundary string
  $semi_rand = md5(time());
  $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
  
  //Add the headers required for a file attachment
  $headers .= "\nMIME-Version: 1.0\n" .
              "Content-Type: multipart/mixed;\n" .
              " boundary=\"{$mime_boundary}\"";

  //Add a multipart boundary  
  $message = "This is a multi-part message in MIME format.\n\n" .
             "--{$mime_boundary}\n" .
             "Content-Type: text/plain; charset=\"iso-8859-1\"\n" .
             "Content-Transfer-Encoding: 7bit\n\n" .
             $message . "\n\n";

  //Base64 encode the attachment, this is to ensure the attachment survives delivery
  $data = chunk_split(base64_encode($data));

  //Add the actual attachment to the message
  $message .= "--{$mime_boundary}\n" .
              "Content-Type: {$attachmenttype};\n" .
              " name=\"{$attachmentname}\"\n" .
              //"Content-Disposition: attachment;\n" .
              //" filename=\"{$fileatt_name}\"\n" .
              "Content-Transfer-Encoding: base64\n\n" .
              $data . "\n\n" .
              "--{$mime_boundary}--\n";

// Send the message
$ok = @mail($to, $subject, $message, $headers);
if ($ok) {
echo '<div class="successtext">The Database has been successfully backed up and an email with the backup attached has been sent.</div>';
} else {
echo '<div class="informationtext">Mail could not be sent but the database has been backed up.</div>';
}
}

//This function is the Quick Backup function
function quickbackup()
{

global $settings;

if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
	//Get the POSTed ID and match to the array definied in the settings.php file
	$id = addslashes($_POST['backupid']);
	$hostname = addslashes($settings['quickbackup']['hostname'][$id]);
	$database = addslashes($settings['quickbackup']['database'][$id]);
	$username = addslashes($settings['quickbackup']['username'][$id]);
	$password = addslashes($settings['quickbackup']['password'][$id]);
	$email = addslashes($_POST['email']);
	$suppress = addslashes($_POST['suppress']);
	
	//If the POSted ID is empty report the below error
	if(!isset($id))
	{
		$errors .= '<div class="errortext">You must supply an ID number.</div>';
	}
	//If the POSTed ID is not a number report the below error
	if(!is_numeric($id))
	{
		$errors .= '<div class="errortext">You have supplied an invalid ID number.</div>';
	}	
	//If no errors were found call the backup function and perform the backup
	if(!$errors)
	{
		backup($hostname,$database,$username,$password,$tables,$email,$suppress,$id);
	}
	}
	
    $content .= '<form method="POST" class="backupform">';
    $content .= '<fieldset><legend>Quick Backup</legend>';
    $content .= ''.$errors.''.$success.'';
    $content .= '<p>Choose a quick backup:</p>';
	$content .= '<select name="backupid" class="input">';
	//For each quick backup defined in the settings.php file list it as a drop-dwon selection
	foreach($settings['quickbackup']['friendlyname'] as $key => $val)
	{
	$content .= '<option value="'.$key.'">'.$val.'</option>';
	}
	$content .= '</select>';
	$content .= '<p>Email Backup File?';	
	$content .= '<input type="checkbox" name="email" /></p>';
	$content .= '<p>Suppress Output?';	
	$content .= '<input type="checkbox" name="suppress" /></p>';
	$content .= '<p><input type="submit" name="submit" value="Backup" class="inputbutton"/></p>';
	$content .= '</fieldset>';
	$content .= '</form>';	
	
	echo $content;
}

//This function is the Manual Backup function
function manualbackup()
{

if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
	//Get the POSTed data and perform some sanitisation
	$hostname = addslashes($_POST['hostname']);
	$database = addslashes($_POST['database']);
	$username = addslashes($_POST['username']);
	$password = addslashes($_POST['password']);
	$tables = addslashes($_POST['table']);
	$email = addslashes($_POST['email']);
	$suppress = addslashes($_POST['suppress']);
	
	//If $hostname is empty report the below error
	if(!$hostname)
	{
		$errors .= '<div class="errortext">You must supply a hostname.</div>';
	}
	//If $database is empty report the below error
	if(!$database)
	{
		$errors .= '<div class="errortext">You must supply a database name.</div>';
	}
	//If $username is empty report the below error
	if(!$username)
	{
		$errors .= '<div class="errortext">You must supply a username.</div>';
	}
	//If $password is empty report the below error
	if(!$password)
	{
		$errors .= '<div class="errortext">You must supply a password.</div>';
	}
	//If no errors were found call the backup function and perform the backup
	if(!$errors)
	{
		backup($hostname,$database,$username,$password,$tables,$email,$suppress);
		unset($_POST['hostname'],$_POST['database'],$_POST['username'],$_POST['password'],$_POST['table']);
	}
	}

$content .= '<script type="text/javascript" src="js/overlib.js"></script>';
$content .= '<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>';
$content .= '<form method="POST" class="backupform">';
$content .= '<fieldset><legend>Manual Backup</legend>';
$content .= ''.$errors.''.$success.'';
$content .= '<p><span class="inputlabel">Hostname:</span>';	
//////////////////////edit nanang
$content .= '<input type="text" name="hostname" class="input" value="localhost"/>';
$content .= '<img src="images/information.png" class="adminicon" alt="" onmouseover="return overlib(\'Enter the hostname of your MySQL server (usually localhost)\');" onmouseout="return nd();"/>';
$content .= '</p>';
$content .= '<p><span class="inputlabel">Database Name:</span>';	
$content .= '<input type="text" name="database" class="input" value="'.$database.'"/>';
$content .= '<img src="images/information.png" class="adminicon" alt="" onmouseover="return overlib(\'Enter the name of the database you want to backup\');" onmouseout="return nd();"/>';
$content .= '</p>';
$content .= '<p><span class="inputlabel">Username:</span>';	
$content .= '<input type="text" name="username" class="input" value="'.$user.'"/>';
$content .= '<img src="images/information.png" class="adminicon" alt=""/ onmouseover="return overlib(\'Enter the username for this database\');" onmouseout="return nd();">';
$content .= '</p>';
$content .= '<p><span class="inputlabel">Password:</span>';	
$content .= '<input type="password" name="password" class="input" value="'.$password.'"/>';
$content .= '<img src="images/information.png" class="adminicon" alt="" onmouseover="return overlib(\'Enter the password for this database\');" onmouseout="return nd();"/>';
$content .= '</p>';
$content .= '<p><span class="inputlabel">Table:</span>';	
$content .= '<input type="text" name="table" class="input" value="'.$_POST['table'].'"/>';
$content .= '<img src="images/information.png" class="adminicon" alt="" onmouseover="return overlib(\'If you wish to backup specific tables enter their names here (separate multiple table names with a comma ,) Leave this field blank to backup the entire database\');" onmouseout="return nd();"/>';
$content .= '</p>';
$content .= '<p><span class="inputlabel">Email Backup File?</span>';	
$content .= '<input type="checkbox" name="email" class="inputcheckbox" /></p>';
$content .= '<p><span class="inputlabel">Suppress Output?</span>';	
$content .= '<input type="checkbox" name="suppress" class="inputcheckbox" /></p>';
$content .= '<p><input type="submit" name="submit" value="Backup" class="inputbutton" /></p>';
$content .= '</fieldset>';
$content .= '</form>';	

echo $content;
}

//This function is the backup function and performs the actual backup of the database
function backup($hostname, $database, $username, $password, $tables, $email, $suppress, $id)
{
	global $settings;
	
	$link = mysql_connect($hostname,$username,$password);
	mysql_select_db($database,$link);
	
	if ($link && mysql_select_db)
	{
	
	//Get all of the tables
	if(!$tables)
	{
		$tables = array();
		$result = mysql_query('SHOW TABLES');
		if($result)
		{
		while($row = mysql_fetch_row($result))
		{
			$tables[] = $row[0];
		}
		}
		else
		{
		echo '<fieldset><legend>Backup Progress</legend>';
		echo '<div class="errortext">There was an error backing up the database.  Please check the database name and try again.</div>';
		echo '</fieldset>';
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	
	if($tables)
	{
	echo '<fieldset><legend>Backup Progress</legend>';
	
	//Cycle through
	foreach($tables as $table)
	{
		if(in_array(strtolower($table), $settings['reserved_words']))
		{
		$table = '`'.$table.'`';
		}
		
		$result = mysql_query('SELECT * FROM '.$table);
		
		if($result)
		{
		$num_fields = mysql_num_fields($result);		
		$return.= 'DROP TABLE IF EXISTS '.$table.';';
		$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";

		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = mysql_fetch_row($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++) 
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = ereg_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";

		if(!$suppress)
		{
		echo '<div class="successtext">Successfully backed up table: <strong>'.ereg_replace('`','',$table).'</strong></div>';
		}
	}
		else 
		{
		echo '<div class="errortext">Failed to back up table: <strong>'.ereg_replace('`','',$table).'</strong></div>';
		}
	}

	//Save the backup file
	if($row2)
	{
	if(isset($id))
	{
		make_path($settings['backupfolder'].'/'.$id);
		$subfolder = $id;
	}
	else
	{
		make_path($settings['backupfolder'].'/manualbackups');
		$subfolder = 'manualbackups';
	}
	
	$handle = fopen($settings['backupfolder'].'/'.$subfolder.'/'.date("Y-m-d-H-i-s", mktime()).'_'.$database.'-backup.sql','w+');
	$filename = $settings['backupfolder'].'/'.$subfolder.'/'.date("Y-m-d-H-i-s", mktime()).'_'.$database.'-backup.sql';
	fwrite($handle,$return);
	fclose($handle);
	
	if($settings['compression']=='on')
	{
	$destination = $settings['backupfolder'].'/'.$subfolder.'/'.date("Y-m-d-H-i-s", mktime()).'_'.$database.'-backup.zip';
	$compress=array(''.$filename.'');
	create_zip($compress, $destination);
	unlink($filename);
	$filename=$destination;
	}

		if($email=='on')
		{
			sendBackup($filename,$database);
		}
		else
		{
			echo  '<div class="successtext">The Database has been backed up.  Please check above for any table specific errors.</div>';
			echo '</fieldset>';
		}
	}
}
}
else
{
	echo '<fieldset><legend>Backup Progress</legend>';
	echo '<div class="errortext">Failed to connect to database</div>';
	echo '</fieldset>';
}
}

//This function lists all of the backup files which have been saved
function listbackups()
{
	global $settings;
	
	$dir = $settings['backupfolder'];
	
	$content .= '<script type="text/javascript" src="js/jquery.js"></script>';
  	$content .= '<script type="text/javascript" src="js/jquery-ui.js"></script>';
  	$content .= '<script type="text/javascript" src="js/accordion.js"></script>';
	$content .= '<div id="accordion">';
		
	foreach($settings['quickbackup']['friendlyname'] as $key => $val)
	{
	
		//Create an array to hold directory list
    	$results = array();

    	//Create a handler for the directory
    	$handler = opendir($dir.'/'.$key.'/');

    	//Keep going until all files in directory have been read
    	while ($file = readdir($handler)) {

        //Iif $file isn't this directory or its parent add it to the results array
        if ($file != '.' && $file != '..')
            $results[] = $file;
            
    }

	//Close the handler
    closedir($handler);
      	
		if($results)
		{
		$content .= '<div class="section">';
		$content .= '<h2>Backups for '.$settings['quickbackup']['friendlyname'][$key].'</h2>';
		$content .= '<div class="section-content">';
		$content .= '<table border="0" class="backuplisttable">';
		$content .= '<tr>';
		$content .= '<td class="backupitemheader">Filename</td>';
		$content .= '<td class="backupitemheader">Timestamp</td>';
		$content .= '<td class="backupitemheader">Filesize</td>';
		$content .= '<td class="backupitemheader">Actions</td>';
		$content .= '</tr>';
		
		foreach(array_reverse($results) as $result)
		{
		list($timestamp) = explode('_',$result);
		$unixtimestamp = strtotime(str_replace("-","",$timestamp));
  		
		$content .= '<tr>';
		$content .= '<td class="backupitem">'.$result.'</td>';
		$content .= '<td class="backupitem">'.date('F jS Y : H:i', $unixtimestamp).'</td>';
		$content .= '<td class="backupitem">'.returnFilesize(filesize($settings['backupfolder'].'/'.$key.'/'.$result)).'</td>';
		$content .= '<td class="backupitem"><a href="?fct=deletebackup&id='.$key.'&filename='.$result.'"><img src="images/delete.png" alt="Delete Backup File" title="Delete Backup File" class="adminicon" /></a>';
		$content .= '<a href="?fct=restore&filename='.$settings['backupfolder'].'/'.$key.'/'.$result.'"><img src="images/restore.png" alt="Restore this Backup" title="Restore this Backup" class="adminicon" /></a>';
		$content .= '<a href="'.$settings['backupfolder'].'/'.$key.'/'.$result.'"><img src="images/disk.png" alt="Save To Disk" title="Save To Disk" class="adminicon" /></a>';
		$content .= '</td>';
		$content .= '</tr>';
		}

		$content .= '<tr><td><p><img src="images/folder_delete.png" alt="Purge backup files" class="adminicon" /><a href="?fct=purge&folder='.$settings['backupfolder'].'/'.$key.'/&id='.$key.'" class="purgelink">Purge Backup Files</a>';
		$content .= '<img src="images/folder_add.png" alt="Upload backup file" class="adminicon" /><a href="?fct=uploadbackup&folder='.$settings['backupfolder'].'/'.$key.'/&id='.$key.'" class="purgelink">Upload Backup File</a></p></td></tr>';
		$content .= '</table>';
		$content .= '</div></div>';  
	}
		else
		{
		$content .= '<div class="section">';
		$content .= '<h2>Backups for '.$settings['quickbackup']['friendlyname'][$key].'</h2>';
		$content .= '<div class="section-content">';
		$content .= '<div class="informationtext">There are no Quick Backups to list</div>';	
		$content .= '</div></div>';		
		}
	}
	
	if(count(glob("$dir/manualbackups/*")) === 0)
	{
	$content .= '<div class="section">';
	$content .= '<h2>Manual backups</h2>';
	$content .= '<div class="section-content">';
	$content .= '<div class="informationtext">There are no Manual Backups to list</div>';	
	$content .= '</div></div>';	
	}
	else
	{
	//Create an array to hold directory list
    $manualresults = array();

    //Create a handler for the directory
    $handler = opendir($dir.'/manualbackups/');

    //Keep going until all files in directory have been read
    while ($file = readdir($handler)) {

    //Iif $file isn't this directory or its parent add it to the results array
    if ($file != '.' && $file != '..')
    $manualresults[] = $file;	
	}
	
	if($manualresults)
	{
		$content .= '<div class="section">';
		$content .= '<h2>Manual Backups</h2>';
		$content .= '<div class="section-content">';
		$content .= '<table border="0" class="backuplisttable">';
		$content .= '<tr>';
		$content .= '<td class="backupitemheader">Filename</td>';
		$content .= '<td class="backupitemheader">Timestamp</td>';
		$content .= '<td class="backupitemheader">Actions</td>';
		$content .= '</tr>';
		
		foreach(array_reverse($manualresults) as $manualresult)
		{
		list($timestamp) = explode('_',$manualresult);
		$unixtimestamp = strtotime(str_replace("-","",$timestamp));
  		
		$content .= '<tr>';
		$content .= '<td class="backupitem">'.$manualresult.'</td>';
		$content .= '<td class="backupitem">'.date('F jS Y : H:i', $unixtimestamp).'</td>';
		$content .= '<td class="backupitem"><a href="?fct=deletebackup&id=m&filename='.$manualresult.'"><img src="images/delete.png" alt="Delete Backup File" title="Delete Backup File" class="adminicon" /></a>';
		$content .= '<a href="?fct=restore&filename='.$settings['backupfolder'].'/manualbackups/'.$manualresult.'"><img src="images/restore.png" alt="Restore this Backup" title="Restore this Backup" class="adminicon" /></a>';
		$content .= '<a href="'.$settings['backupfolder'].'/manualbackups/'.$manualresult.'"><img src="images/disk.png" alt="Save To Disk" title="Save To Disk" class="adminicon" /></a>';
		$content .= '</td>';
		$content .= '</tr>';
		}
		
		$content .= '<tr><td><p><img src="images/folder_delete.png" alt="Purge backup files" class="adminicon" /><a href="?fct=purge&folder='.$settings['backupfolder'].'/manualbackups/" class="purgelink">Purge Backup Files</a>';
		$content .= '<img src="images/folder_add.png" alt="Upload backup file" class="adminicon" /><a href="?fct=uploadbackup&folder='.$settings['backupfolder'].'/'.$key.'/&id='.$key.'" class="purgelink">Upload Backup File</a></p></td></tr>';
		$content .= '</table>';
		$content .= '</div></div>';  
	}
	}
	
	$content .= '</div>';
	echo $content;
}

//This function deletes a backup file from the server
function deletebackup()
	{
		global $settings;
			if ($_SERVER['REQUEST_METHOD'] == 'POST')
			{
		 	$id = $_POST['id'];
		 	$filename = $_POST['filename'];
			
			if($id=='m')
			{$subfolder = 'manualbackups';}
			else
			{$subfolder = $id;}
			
			//If an empty line number is posted, show below
		 	if (!isset($_POST['filename']) || !isset($_POST['id']))
		 	{
			$content .= '<div class="blackout">';
			$content .= '<div class="box"><div class="boxtext"><span class="boxheader">Delete Backup File</span><br />';
			$content .= '<div class="renameerror"></div>';
			$content .= 'You did not supply a filename to delete.';
			$content .= '<a href="?fct=listbackups" class="button">OK</a></div></div></div>';	
			}
			else
			{
			unlink(''.$settings['backupfolder'].'/'.$subfolder.'/'.$filename.'');
			$content .= '<div class="blackout">';
			$content .= '<div class="box"><div class="boxtext"><span class="boxheader">Delete Backup File</span><br />';
			$content .= '<div class="renameerror"></div>';
			$content .= '<strong>'.$filename.'</strong> has been successfully deleted.';
			$content .= '<a href="?fct=listbackups" class="button">OK</a></div></div></div>';				
			}
			}
			
			else
			{
			//If a delete request is received, display a confirmation message
			$id = $_GET['id'];
			$filename = $_GET['filename'];
			
			$content .= '<div class="blackout">';
			$content .= '<div class="box"><div class="boxtext"><span class="boxheader">Delete Backup File</span>';
			
			//If either of the POSTed values are empty display the error message below
			if(!isset($_GET['filename']) || !isset($_GET['id']))
			{
			$content .= '<div class="renameerror"></div>';
			$content .= 'You did not supply a filename to delete.';
			$content .= '<a href="?fct=listbackups" class="button">OK</a>';	
			}
			//Otherwise display the below confirmation message
			else
			{
			$content .= '<form method="POST" class="emailform">';
			$content .= 'Are you sure you want to delete <strong>'.$filename.'</strong>?<br />';
			$content .= '<div class="buttoncontainer"><input type="submit" name="submit" value="Delete" class="inputbutton"></input>';
			$content .= '<a href="?fct=listbackups" class="button">Cancel</a>';
			$content .= '<input type="hidden" name="id" value="'.$id.'"></input>';
			$content .= '<input type="hidden" name="filename" value="'.$filename.'"></input>';
			$content .= '</form>';
			}
			$content .= '</div></div></div></div>';
			}
			echo $content;
	}

//This function purges the backup files from the server
function purge()
	{
		global $settings;
			if ($_SERVER['REQUEST_METHOD'] == 'POST')
			{
		 	$hourstokeep = $_POST['hourstokeep'];
		 	$folder = $_POST['folder'];

			//If an folder value or hourstokeep value is posted, show below
		 	if (!isset($folder))
		 	{
			$content .= '<div class="blackout">';
			$content .= '<div class="box"><div class="boxtext"><span class="boxheader">Purge Backup Files</span><br />';
			$content .= '<div class="renameerror"></div>';
			$content .= 'You did not supply a folder to purge.';
			$content .= '<a href="?fct=listbackups" class="button">OK</a></div></div></div>';	
			}
			else if (empty($hourstokeep))
		 	{
			$content .= '<div class="blackout">';
			$content .= '<div class="box"><div class="boxtext"><span class="boxheader">Purge Backup Files</span><br />';
			$content .= '<div class="renameerror"></div>';
			$content .= 'You did not specify a time in hours.';
			$content .= '<a href="?fct=listbackups" class="button">OK</a></div></div></div>';	
			}
			else
			{
			cleanup_dir($folder.'/',$hourstokeep);
			$content .= '<div class="blackout">';
			$content .= '<div class="box"><div class="boxtext"><span class="boxheader">Delete Backup File</span><br />';
			$content .= '<div class="renameerror"></div>';
			$content .= 'The purge has been successfully completed according to your specified settings.';
			$content .= '<a href="?fct=listbackups" class="button">OK</a></div></div></div>';				
			}
			}
			
			else
			{
			//If a purge request is received, display a confirmation message
			$folder = $_GET['folder'];
			$key = $_GET['id'];
			
			if(!isset($key))
			{
				$purgefor = 'Manual Backups';
			}
			else
			{
				$purgefor = $settings['quickbackup']['friendlyname'][$key];
			}
			
			$content .= '<div class="blackout">';
			$content .= '<div class="box"><div class="boxtext"><span class="boxheader">Purge Backup Files</span>';
			
			//If the GET value is empty display the error message below
			if(!isset($_GET['folder']))
			{
			$content .= '<div class="renameerror"></div>';
			$content .= 'You did not supply a folder to purge.';
			$content .= '<a href="?fct=listbackups" class="button">OK</a>';	
			}
			//Otherwise display the below confirmation message
			else
			{
			$content .= '<form method="POST" class="emailform">';
			$content .= 'You have requested a purge on all backup files stored for <strong>'.$purgefor.'</strong>.<br /><br />';
			$content .= 'Specify an amount of time in hours below:<br /><br />';
			$content .= 'Purge all files older than <input type="text" name="hourstokeep" size="2"></input> hours';
			$content .= '<div class="buttoncontainer"><input type="submit" name="submit" value="Purge" class="inputbutton"></input>';
			$content .= '<a href="?fct=listbackups" class="button">Cancel</a>';
			$content .= '<input type="hidden" name="folder" value="'.$folder.'"></input>';
			$content .= '</form>';
			}
			$content .= '</div></div></div></div>';
			}
			echo $content;
	}

//Cleanup the backup directory, deleting any files older than set amount of hours.  
function cleanup_dir($dir,$ret_hr) {  
//Get retention in epoch (hours * 60 min * 60 seconds)
$del_date=time()-($ret_hr * 60 * 60);                                                  
//Get a handle of the directory    
if (is_readable($dir) && $handle = opendir($dir)) {                                                  
//Clear cached dir data
clearstatcache();                                                           
//If there are still files
while (false !== ($file = readdir($handle))) {                              
//Get the file time
$t=filemtime( $dir.$file );                                               
//If this is older than the specified retention
if ($file != "." && $file != ".." & $t < $del_date) {                     
//Delete the file(s)
@unlink($dir.$file);  
}  
}  
closedir($handle);  
}  
}

function restore()
{
	$getfilename = $_GET['filename'];

	$actualfilename = explode('/',$getfilename);
	$timestamp = explode('-',$actualfilename[2]);

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
	//Get the POSTed data and perform some sanitisation
	$filename = addslashes($_POST['filename']);
	$hostname = addslashes($_POST['hostname']);
	$database = addslashes($_POST['database']);
	$username = addslashes($_POST['username']);
	$password = addslashes($_POST['password']);
	$restorereport = addslashes($_POST['restorereport']);
	
	//If $hostname is empty report the below error
	if(!$filename)
	{
		$errors .= '<div class="errortext">You must supply a filename to restore.</div>';
	}
	elseif(!file_exists($filename))
	{
		$errors .= '<div class="errortext">The backup file specified cannot be found.</div>';
	}
	//If $hostname is empty report the below error
	if(!$hostname)
	{
		$errors .= '<div class="errortext">You must supply a hostname.</div>';
	}
	//If $database is empty report the below error
	if(!$database)
	{
		$errors .= '<div class="errortext">You must supply a database name.</div>';
	}
	//If $username is empty report the below error
	if(!$username)
	{
		$errors .= '<div class="errortext">You must supply a username.</div>';
	}
	//If $password is empty report the below error
	if(!$password)
	{
		$errors .= '<div class="errortext">You must supply a password.</div>';
	}
	//If no errors were found call the restore function and perform the restore
	if(!$errors)
	{
		dorestore($hostname,$database,$username,$password,$filename,$restorereport);
		unset($_POST['filename'],$_POST['hostname'],$_POST['database'],$_POST['username'],$_POST['password']);
	}
	}

$content .= '<script type="text/javascript" src="js/overlib.js"></script>';
$content .= '<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>';
$content .= '<form method="POST" class="backupform">';
$content .= '<fieldset><legend>Restore</legend>';
$content .= ''.$errors.''.$success.'';
$content .= '<p><span class="inputlabel">Filename:</span>';	
$content .= '<input type="text" name="actualfilename" class="input" value="'.$actualfilename[2].'" readonly/>';
$content .= '<img src="images/information.png" class="adminicon" alt="" onmouseover="return overlib(\'This is the filename you wish to restore\');" onmouseout="return nd();"/>';
$content .= '</p>';
$content .= '<p><span class="inputlabel">Backup Timestamp:</span>';	
$content .= '<input type="text" name="actualfilename" class="input" value="'.format_timestamp($timestamp[0],3).'" readonly/>';
$content .= '<img src="images/information.png" class="adminicon" alt="" onmouseover="return overlib(\'This is the time and date this backup file was created\');" onmouseout="return nd();"/>';
$content .= '</p>';
$content .= '<p><span class="inputlabel">Hostname:</span>';	
////edit nanang
$content .= '<input type="text" name="hostname" class="input" value="localhost"/>';
$content .= '<img src="images/information.png" class="adminicon" alt="" onmouseover="return overlib(\'Enter the hostname of your MySQL server (usually localhost)\');" onmouseout="return nd();"/>';
$content .= '</p>';
$content .= '<p><span class="inputlabel">Database Name:</span>';	
$content .= '<input type="text" name="database" class="input" value="sima"/>';
$content .= '<img src="images/information.png" class="adminicon" alt="" onmouseover="return overlib(\'Enter the name of the database you want to backup\');" onmouseout="return nd();"/>';
$content .= '</p>';
$content .= '<p><span class="inputlabel">Username:</span>';	
$content .= '<input type="text" name="username" class="input" value="root"/>';
$content .= '<img src="images/information.png" class="adminicon" alt=""/ onmouseover="return overlib(\'Enter the username for this database\');" onmouseout="return nd();">';
$content .= '</p>';
$content .= '<p><span class="inputlabel">Password:</span>';	
$content .= '<input type="password" name="password" class="input" value="kosong1n"/>';
$content .= '<img src="images/information.png" class="adminicon" alt="" onmouseover="return overlib(\'Enter the password for this database\');" onmouseout="return nd();"/>';
$content .= '</p>';
$content .= '<p><span class="inputlabel">Full Restore Report?</span>';	
$content .= '<input type="checkbox" name="restorereport" class="inputcheckbox" /></p>';
$content .= '<input type="hidden" name="filename" class="input" value="'.$getfilename.'"/>';
$content .= '<p><input type="submit" name="submit" value="Restore" class="inputbutton" /></p>';
$content .= '</fieldset>';
$content .= '</form>';	

echo $content;
}

//This funtion performs the actual restore of the specified database
function dorestore($hostname, $database, $username, $password, $filename, $restorereport='')
{
	global $settings;
	
	$link = mysql_connect($hostname,$username,$password);
	mysql_select_db($database,$link);
	
	if ($link && mysql_select_db)
	{
	
	if(file_exists($filename))
	{
	echo '<fieldset><legend>Restore Progress</legend>';
	
	// Temporary variable, used to store current query
	$templine = '';
	// Read in entire file
	$lines = file($filename);
	// Loop through each line
	foreach ($lines as $line)
	{
	// Skip it if it's a comment
	if (substr($line, 0, 2) == '--' || $line == '')
		continue;
 
	// Add this line to the current segment
	$templine .= $line;
	// If it has a semicolon at the end, it's the end of the query
	if (substr(trim($line), -1, 1) == ';')
	{
		// Perform the query
		if(!mysql_query($templine))
		{
		echo '<div class="errortext">Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '</div>';
		$error = 1;
		}
		if($restorereport=='on')
		{
		echo '<div class="informationtext">'.$templine.'</div>';
		}
		// Reset temp variable to empty
		$templine = '';
	}
	}
	if(!$error)
	{
		echo '<div class="successtext">The restore operation completed successfully.</div>';
	}
	echo '</fieldset>';	
}
	else
	{
		echo '<div class="errortext">The backup file specified cannot be found</div>';
	}
}
	else 
	{
		echo '<fieldset><legend>Restore Progress</legend>';
		echo '<div class="errortext">Failed to connect to database</div>';
		echo '</fieldset>';
	}
}
//This funtion formats the display of the timestamp
function format_timestamp($time = null,$format = 6)
	{
		if ($format == 1)
		{
			return gmdate('d M y',$time); #01 01 04
		}
		if ($format == 2)
		{
			return gmdate('D dS Y',$time);  #Mon 18th 2005
		}
		if ($format == 3)
		{
			return gmdate('F jS Y : H:i T',$time); #01 01 04 - 23:24
		}
		if ($format == 4)
		{
			return gmdate('D jS F Y',$time);   #January Mon ,18th 2005  
		}
		if ($format == 5)
		{
			return gmdate('l jS F Y - g:i a',$time);   #January Monday ,18th 2005 - 12:54 am 
		}
		if ($format == 6) 
		{
			return ($time); #returns timestamp
		}
	}

//This function creates the subdirectories for the backup files if they do not exist
function make_path($pathname, $is_filename=false){
	if($is_filename){
		$pathname = substr($pathname, 0, strrpos($pathname, '/'));
	}
	//Check if directory already exists
	if (is_dir($pathname) || empty($pathname)) {
		return true;
	}
	//Ensure a file does not already exist with the same name
	$pathname = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $pathname);
	if (is_file($pathname)) {
		trigger_error('mkdirr() File exists', E_USER_WARNING);
		return false;
	}
	//Crawl up the directory tree
	$next_pathname = substr($pathname, 0, strrpos($pathname, DIRECTORY_SEPARATOR));
	if (make_path($next_pathname, 0755)) {
		if (!file_exists($pathname)) {
			return mkdir($pathname, 0755);
		}
	}
	return false;
}

//This function purges the backup files from the server
function uploadbackup()
	{
		global $settings;

			//If an upload request is received, display a confirmation message
			$folder = $_GET['folder'];
			$key = $_GET['id'];
			
			if(!isset($key))
			{
				$uploadfor = 'Manual Backups';
			}
			else
			{
				$uploadfor = $settings['quickbackup']['friendlyname'][$key];
			}
			
			$content .= '<div class="blackout">';
			$content .= '<div class="box"><div class="boxtext"><span class="boxheader">Upload Backup File</span>';
			
			//If the GET value is empty display the error message below
			if(!isset($_GET['folder']))
			{
			$content .= '<div class="renameerror"></div>';
			$content .= 'You did not supply a folder to upload to.';
			$content .= '<a href="?fct=listbackups" class="button">OK</a>';	
			}
			//Otherwise display the below confirmation message
			else
			{
			$content .= '<script type="text/javascript"> function displayLoading() {  if (document.getElementById(\'upload-progress\')) {   document.getElementById(\'upload-progress\').style.display=\'block\';  } } </script>';
			$content .= '<form method="POST" action="?fct=doupload" class="emailform" enctype="multipart/form-data">';
			$content .= 'You have requested to upload a file to <strong>'.$uploadfor.'</strong>.<br /><br />';
			$content .= 'Select a file to upload:<br /><br />';
			$content .= '<input type="file" name="file" size="40" class="fileinput" ></input>';
			$content .= '<div id="upload-progress" style="display:none" class="uploadprogress">Please wait, uploading file.</div>';
			$content .= '<div class="buttoncontainer"><input type="submit" name="upload" value="Upload" class="inputbutton" onClick="displayLoading();">';
			$content .= '<a href="?fct=listbackups" class="button">Cancel</a>';
			$content .= '<input type="hidden" name="folder" value="'.$folder.'"></input>';
			$content .= '</form>';
			}
			$content .= '</div></div></div></div>';
			
			echo $content;
			}
			

function doupload()
	{
	 global $settings, $message;
	 		
	 		$folder = $_POST['folder'];
	 		$uploadedfile = $_FILES['file']['tmp_name'];
	 		

			//Check if an empty upload request has been made and return an error
			if (!$uploadedfile)
			{
			$content .= '<div class="blackout">';
			$content .= '<div class="box"><div class="boxtext"><span class="boxheader">Upload Backup File</span>';	
			$content .= '<div class="renameerror"></div>';
			$content .= 'Please select a file to upload.';
			$content .= '<a href="?fct=listbackups" class="button">OK</a>';		
			$content .= '</div></div></div></div>';
			}
		
			if (extension($_FILES['file']['name'])=="sql")
			{
			$content .= '<div class="blackout">';
			$content .= '<div class="box"><div class="boxtext"><span class="boxheader">Upload Backup File</span>';
	
			if(move_uploaded_file()) 
 			{ 
 			$content .= '<div class="renameerror"></div>';
			$content .= 'The file <strong>'.$_FILES['file']['name'].'</strong> has been uploaded'; 
			$content .= '<a href="?fct=listbackups" class="button">OK</a>';
 			} 
 			else 
 			{ 
 			$content .= '<div class="renameerror"></div>';
			$content .= 'There was a problem uploading your file.';
			$content .= '<a href="?fct=listbackups" class="button">OK</a>'; 
 			} 
 		
 			$content .= '</div></div></div></div>';
			}
			
			else
			{
			$content .= '<div class="blackout">';
			$content .= '<div class="box"><div class="boxtext"><span class="boxheader">Upload Backup File</span>';	
			$content .= '<div class="renameerror"></div>';
			$content .= 'You may only upload files with a .sql extension.';
			$content .= '<a href="?fct=listbackups" class="button">OK</a>';		
			$content .= '</div></div></div></div>';
 			}
 		
			echo $content;	
	}

function extension($string) {
		$file = $string;
  		$i = strrpos($file,'.');
  		$extension = substr($file,$i+1);
  		return $extension;
	}

//This function returns the filesize of the backed up files
function returnFilesize($file_size)
	{
		if ($file_size >= 1073741824) 
		{
			$show_filesize = number_format(($file_size / 1073741824),2) . " GB";
		} 
		elseif ($file_size >= 1048576) 
		{
		$show_filesize = number_format(($file_size / 1048576),2) . " MB";
		} 
		elseif ($file_size >= 1024) 
		{
			$show_filesize = number_format(($file_size / 1024),2) . " KB";
		} 
		elseif ($file_size >= 0) 
		{
			$show_filesize = $file_size . " bytes";
		} 
		else 
		{
			$show_filesize = "0 bytes";
		}
		
		return $show_filesize;
	}

//This function creates a compressed zip file of the data files
function create_zip($files = array(),$destination = '',$overwrite = true) {

	//if the zip file already exists and overwrite is false, return false
	if(file_exists($destination) && !$overwrite) { return false; }
	//vars
	$valid_files = array();
	//if files were passed in...
	if(is_array($files)) {
		//cycle through each file
		foreach($files as $file) {
			//make sure the file exists
			if(file_exists($file)) {
				$valid_files[] = $file;
			}
		}
	}
	//if we have good files...
	if(count($valid_files)) {
		//create the archive
		$zip = new ZipArchive();
		if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
			return false;
		}
		//add the files
		foreach($valid_files as $file) {
			$zip->addFile($file,$file);
		}
		//debug
		//echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
		
		//close the zip -- done!
		$zip->close();
		
		//check to make sure the file exists
		return file_exists($destination);
	}
	else
	{
		return false;
	}
}


switch ($_GET['fct'])
{
default:
quickbackup();
break;

case 'manualbackup':
manualbackup();
break;

case 'listbackups':
listbackups();
break;

case 'deletebackup':
deletebackup();
break;

case 'purge':
purge();
break;

case 'restore':
restore();
break;

case 'uploadbackup':
uploadbackup();
break;

case 'doupload':
doupload();
break;
}
?>

</div>
  
  <b class='container'>
  <b class='container5'></b>
  <b class='container4'></b>
  <b class='container3'></b>
  <b class='container2'><b></b></b>
  <b class='container1'><b></b></b></b>
<div class="footer"><?php echo $settings['footertext'] ?></div>
</div>