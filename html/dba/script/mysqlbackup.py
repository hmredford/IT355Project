import os
os.system('/usr/bin/mysqldump -u hmredford --password="hR085757" WIAB > ../dbbackup/WIAB.sql')

print "Backing up WIAB Database ....<br>"

print "<br>Backup complete.<br>"

print """ 
<br><a href='mysql.php'><button>Back to DBA MySQL site</button></a>
"""