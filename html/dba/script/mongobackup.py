import os

print "Backing up wiab Database ....<br>"

os.system('/usr/bin/mongodump -d wiab -o ../dbbackup/wiab')

print "<br>Backup complete.<br>"

print """ 
<br><a href='mysql.php'><button>Back to DBA MySQL site</button></a>
"""