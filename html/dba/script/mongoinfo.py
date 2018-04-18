#!/usr/bin/env python


#mongostat
#db.serverStatus()
#db.stats()
#db.reveiews.stats()

from pprint import pprint
from pymongo import MongoClient 
import json
from bson import BSON
from bson import json_util


try:
	print "<h3>Database Connection Status:</h3>"
except:
	print "<p style='color:red;'>Not Connected</p>"
# connect to the database
client = MongoClient()

# setup an object
db = client.wiab
coll = db.reviews

print "<p style='color:green;'>Connected</p>" 
	

print """<h3>Database Stats</h3>"""

result = db.command("dbstats")
json1 = json.dumps(result, sort_keys=True, indent=3, default=json_util.default)
str1 = str(json1)
print(str1.replace("}","}<br>").replace(",", ",<br>"))

print """<h3>Reviews collection Stats</h3>"""

result2 = db.command("collstats", "reviews")
json2 = json.dumps(result2, sort_keys=True, indent=3, default=json_util.default)
str2 = str(json2)
print(str2.replace("}","}<br>").replace(",", ",<br>"))

print """<h3>Server Status</h3>"""

result3 = db.command("serverStatus")
json3 = json.dumps(result3, sort_keys=True, indent=3, default=json_util.default)
str3 = str(json3)
print(str3.replace("}","}<br>").replace(",", ",<br>"))
