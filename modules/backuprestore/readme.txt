Easy MySQL Backup & Restore

Easy MySQL Backup& Restore is a script which allows you to easily backup, store and restore MySQL Database backups from any number of databases you have access to on your server. A CRON compatible version is also included allowing you to automate your MySQL backups quickly and easily!

It is ideal for web designers who want to be able to backup all of their clients sites with one click, or for personal use if you have one or more databases you want to be able to backup quickly and easily. It has the following features:


Quick Backup 
Quick Backup allows you to backup databases defined in the settings file with a single click. These files are stored on the server with a timestamp for download later if required. You can also choose to email the backup file to the email address specified in the settings file.

Manual Backup 
Manual backup allows you to manually backup a database using the hostname, username, password etc. The added feature of the manual backup is that you can choose to backup specific tables only or the entire database. You can also choose to email the backup file to the email address specified in the settings file.

List Backups 
All backups are listed in an easy to navigate structure with their timestamp. Backup files can easily be downloaded to disk or deleted from the server with the click of a button.

Upload Backups
Upload your own SQL backup files to the server which you can then use to restore a database.

Restore Backups 
Easily restore any one of your backups by simply clicking the restore icon and filling in the relevant database connection details. You can also choose to view a full restore report, giving you line-by-line details on screen of the restoration operation.

Purge Backups
Easily purge the backup files stored on the server for a specifed database.  Simply specify a time in hours and any files on the server older than that time will be deleted.

CRON Compatible 
Automatically backup a single database or all databases using a scheduled CRON job using the CRON compatible version inlcluded in the download.  It will even email you the job log!

Automatic Backup Purge
When using CRON jobs you can choose to automatically purge backup files stored on the server.  Simply specify a time in hours and the CRON job will delete any files older than that time.

Completely Flat File Driven
Other than the databases you are backing up, no MySQL database is required to install this script.


Both the PHP and CSS code is extensively commented and should (i hope!) be easy enough to follow.

It uses CSS for styling so again should be easy to modify if you would like it to match your website’s design, I’ve tried to make it as simple looking as possible so it should match a wide range of site designs without requiring too much modification.




Simple Instructions:

1.  Open in your favourite editor (notepad will suffice) settings.php and amend $settings['username'] 
    and $settings['password'] to your required settings.

2.  Amend $settings['emailto'] and $settings['emailfrom'] to your required settings.

3.  Move down to $settings['quickbackup'] and amend the entries as appropriate.  You can add or remove
    as you wish but please take note of the location of the commas (,).  As a general rule every entry 
    you make will require a comma (,) after it unless it is the final entry.

4.  Upload all files to your webserver and browse to http://www.yourdomain.com/mysql-backup/login.php to
    login and start using the script.  (If you do not plan to use this script with a Cron job you will not need to     upload the "cron-mysql-backup.php" file.)

Advanced Instructions:

$settings['headertext'] - This is the text shown at the top of the admin pages
$settings['footertext'] - This is the text shown at the bottom of the admin pages
$settings['backupfolder'] - This is the location all backups will be saved.  Recommended to keep the default
			    setting.

Icon Credits:  famfamfam.com and wefunction.com

OverLib Javascript Library by Erik Bosrup at http://www.bosrup.com/web/overlib/