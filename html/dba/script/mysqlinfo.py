#!/usr/bin/env python

import MySQLdb

# connect to the database
print "<h3>Database Connection Status:</h3>"

try:
	db = MySQLdb.connect("localhost","hmredford","hR085757","WIAB" )
except:
	print "<p style='color:red;'>Not Connected</p>"
# setup a cursor object using cursor() method
cursor = db.cursor()


cursor.execute("SHOW GLOBAL STATUS LIKE 'Uptime'")
uptime = cursor.fetchone()

# begin printing data to the screen


print "<p style='color:green;'>Connected; uptime since page load: %s </p>" % str(uptime)
	

# run a query
cursor.execute("SELECT VERSION()")

# grab one result
data = cursor.fetchone()


print "<h3>Database Version :</h3> %s " % data


print """<h3>Database Usage (last 36 hours):</h3>
<table border =1>
 <tr>
 <td>table_schema</td>
 <td>table_name</td>
 <td>update_time</td>   
 </tr>

"""

cursor.execute("SELECT table_schema,table_name,update_time FROM information_schema.tables WHERE update_time > (NOW() - INTERVAL 36 HOUR)")
result = cursor.fetchall()

for row in result:
	print "<tr>"
	for item in row:
  		print "<td>" + str(item) + "</td>"
	print "</tr>"
print "</table>"

print """<h3>Table Status:</h3>
<table border =1>
 <tr>
 <td>Name</td>
 <td>Engine</td>
 <td>Version</td>
 <td>Row_format</td>
 <td>Rows</td>
 <td>Avg_row_length</td>
 <td>Data_length</td>
 <td>Max_data_length</td>
 <td>Index_length</td>
 <td>Data_free</td>
 <td>Auto_increment</td>
 <td>Create_time</td>
 <td>Update_time</td>
 <td>Check_time</td>
 <td>Collation</td>
 <td>Checksum</td>
 <td>Create_options</td>
 <td>Comment</td>
 </tr>

"""

cursor.execute("SHOW TABLE STATUS")
result2 = cursor.fetchall()

for row in result2:
	print "<tr>"
	for item in row:
  		print "<td>" + str(item) + "</td>"
	print "</tr>"
print "</table>"
# close the mysql database connection
db.close()