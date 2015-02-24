Cron Job Setup

1.  Follow the step in the readme.txt file

2.  Once you have defined all of your quick backups in the settings.php file navigate to 
    http://www.yourdomain.com/mysql-backup/cron-mysql-backup.php and take note of the ID 
    numbers listed to the quick backups.

3.  Set up your CRON jobs to backup the quick backup sets by using the following URL conventions:

    http://www.yourdomain.com/mysql-backup/cron-mysql-backup.php?&id=xx (Where xx is the ID number
    for the quick backup you wish to backup)

All backup notifications will be sent via email each time a backup job is run.


EMAIL ATTACHMENT OPTION:
By default, when you run a CRON backup the backup log will get emailed to you and the file will be
copied to the relevant folder on your webserver - you can then login to the admin panel to download,
restore or delete the file. 

If you would also like to have the backed up files attached to this job log email, simply use the "attach"
switch.  For example:

http://www.yourdomain.com/mysql-backup/cron-mysql-backup.php?&id=xx&attach=yes
(Where xx is the ID number for the quick backup you wish to backup)


IMPORTANT NOTE:
If you are limited to the amount of CRON jobs you're able to run, or if you would just like to backup
all defined databases via one job, simply use the "all" switch.  For example:

http://www.yourdomain.com/mysql-backup/cron-mysql-backup.php?&id=all

OR

http://www.yourdomain.com/mysql-backup/cron-mysql-backup.php?&id=all&attach=yes 
(if you would like each backup file to be emailed to you as an attachment)


All backup notifications will be sent via email each time a backup job is run.


AUTO CLEANUP OPTION:
You can configure the script to delete any backup files older than a set amount of time every time a CRON job is run.

To do this, ensure the $settings['autocleanup'] option in the settings.php file is set to '1'.  You can then specify a time (in hours) using the $settings['hourstokeep'] option for the backup files to be kept.  Any files older than this specified time will be cleared out each time the CRON job is run.

Some common settings for the $settings['hourstokeep'] option could be:

1 - 1 hour
24 - 1 day
48 - 2 days
120 - 5 days
168 - 7 days
336 - 14 days

Although you can specify any time you like.