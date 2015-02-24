<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
	<title>Easy MySQL Backup</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link href="css/mysql-backup.css" rel="stylesheet" type="text/css" />
	
	</head>
	<body>
	 
<?php
//Include the settings.php file
require('settings.php');

//This function is the Quick Backup function
function quickbackup()
{
global $settings;

$id = addslashes($_GET['id']);
$attach = addslashes($_GET['attach']);

if(is_numeric($id))
	{
	//Get the POSTed ID and match to the array definied in the settings.php file
	$hostname = addslashes($settings['quickbackup']['hostname'][$id]);
	$database = addslashes($settings['quickbackup']['database'][$id]);
	$username = addslashes($settings['quickbackup']['username'][$id]);
	$password = addslashes($settings['quickbackup']['password'][$id]);
	
	backup($hostname,$database,$username,$password,$tables,$attach,$id);

	}
elseif($id=="all")
	{
	//If the POSTed ID is "all" then backup every database defined in the settings.php file
	foreach($settings['quickbackup']['friendlyname'] as $key => $val)
	{
	$hostname = addslashes($settings['quickbackup']['hostname'][$key]);
	$database = addslashes($settings['quickbackup']['database'][$key]);
	$username = addslashes($settings['quickbackup']['username'][$key]);
	$password = addslashes($settings['quickbackup']['password'][$key]);
	
	backup($hostname,$database,$username,$password,$tables,$attach,$key);
	}
	}
else
	{
	$content .= '<div class="placeholder">';

  	$content .= '<b class="container">';
  	$content .= '<b class="container1"></b>';
  	$content .= '<b class="container2"><b></b></b>';
  	$content .= '<b class="container3"></b>';
  	$content .= '<b class="container4"></b>';
  	$content .= '<b class="container5"></b></b>';

  	$content .= '<div class="containercontent">';
  	
    $content .= '<fieldset><legend>Quick Backups</legend>';
    $content .= '<p>Currently defined Quick Backups:</p>';
	//For each quick backup defined in the settings.php file list it as a drop-down selection
	foreach($settings['quickbackup']['friendlyname'] as $key => $val)
	{
	$content .= '<div>ID: '.$key.' | Friendly Name: '.$val.'</div>';
	}
	$content .= '</fieldset>';
	
	$content .= '</div>';
  
  	$content .= '<b class="container">';
  	$content .= '<b class="container5"></b>';
  	$content .= '<b class="container4"></b>';
  	$content .= '<b class="container3"></b>';
  	$content .= '<b class="container2"><b></b></b>';
  	$content .= '<b class="container1"><b></b></b></b>';
	$content .= '<div class="footer">'.$settings['footertext'].'</div>';
	$content .= '</div>';
	
	echo $content;
	}
}


//This function is the backup function and performs the actual backup of the database
function backup($hostname, $database, $username, $password, $tables, $attach, $id)
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
		$message .= "Backup Progress:\n\n";
		$message .= "There was an error backing up the database.  Please check the database name and try again.\n\n";
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	
	if($tables)
	{
	$message .=  "Backup Progress:\n\n";
	
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
		$return.= 'DROP TABLE '.$table.';';
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
		$message .=  "Successfully backed up table: ".ereg_replace('`','',$table)."\n";
	}
		else 
		{
		$message .=  "Failed to back up table: ".ereg_replace('`','',$table)."\n";
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
	
	//If auto cleanup is switched on in the settings file, clear out any old backup files older than the time specified in the settings file
	if($settings['autocleanup']==1)
	{
	cleanup_dir($settings['backupfolder'].'/'.$subfolder.'/',$settings['hourstokeep']);
	}
		
	$message .=   "\n\nThe Database has been backed up.  Please check above for any table specific errors.\n\n";

	}
}
}
else
{
	$message .=  "Backup Progress:\n\n";
	$message .=  "Failed to connect to database\n\n";
}
if($attach=='yes')
{
$subject = "Your Backup for $database";
sendBackup($subject,$message,$filename,$database);
}
else
{
$to = $settings['emailto'];
$from = $settings['emailfrom'];
$subject = "Your Backup for $database";

mail($to, $subject, $message, "From: $from");    
}
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

//This function attaches the backup file to an email and sends to the "To" address defined in the settings.php file
function sendBackup($subject,$message,$filename, $name){
 
global $settings;

//Read POST request params into global vars
$to = $settings['emailto'];
$from = $settings['emailfrom'];

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
}

//This function formats the display of the timestamp
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
}
?>