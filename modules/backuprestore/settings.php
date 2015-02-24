<?php 
//SETTINGS START
//Main Admin Page Settings

include "../../otentik_admin.php";
include "../../config_sistem.php";

$settings['headertext'] = 'SiMA'; //Header Text
$settings['footertext'] = 'Copyright '.date('Y').' | SiMA'; //Footer Text

//Login Settings
$settings['username'] = 'admin'; //Username
$settings['password'] = 'admin'; //Password

//Data file locations
$settings['backupfolder'] = 'backups';  //The location for all the backup files to be placed

//Data file compression
$settings['compression'] = 'off';  //This chooses whether to compress both the backup file saved to the server and the backup file emailed to the user (optional).
//Set to 'off' if you do not wish to compress the backup files.

//Automatic backup file cleanup (CRON Jobs Only)
$settings['autocleanup'] = '1';  //Set to 1 for automatic deletion of old backup files, set to 0 to turn off
$settings['hourstokeep'] = '168'; //If the above set to 1, this controls how many hours backup files should be kept for (EXAMPLES: 24 = 1 day, 168 = 1 week)

//Email Settings
$settings['emailto'] = 'nanang.rusti@gmail.com';  //The email address to send backups to
$settings['emailfrom'] = 'mysql-backups@yourdomain.com';  //The email address backups will come from

//Reserved Words
//It is generally bad practice to use MySQL reserved words as table names, however in reality this is
//sometimes the case.  If you are having problems backing up particular tables in your database using this script
//check that your table name isn't using a MySQL reserved word (full list http://dev.mysql.com/doc/refman/5.1/en/reserved-words.html).  If it is, add the word to the array below IN LOWERCASE and the table will backup successfully.
$settings['reserved_words'] = array('group', 'key', 'order', 'like');

//Quick Backup Settings
//Use the below to define new quick backups
$settings['quickbackup'] = array(

//The friendly name is used to easily recognise which database you wish to backup and is shown in the drop-down list
//on the quick backup page.  Add and delete as required taking note of the location of the commas (,)
'friendlyname' => array('Database SiMA'),

//The hostname is the MySQL hostname, usually localhost
//'hostname' => array('localhost1', 'localhost2', 'localhost3', 'localhost4'),
'hostname' => array($host),

//The database name is the name of the database you want to backup
'database' => array($database),

//The username is the username required to connect to the database you want to backup
'username' => array($user),

//The password is the password required to connect to the database you want to backup
'password' => array($password)

);

//SETTINGS END
?>