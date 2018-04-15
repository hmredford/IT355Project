#!/usr/bin/env python


#mongostat
#db.serverStatus()
#db.stats()
#db.reveiews.stats()

from pprint import pprint
from pymongo import MongoClient 

# connect to the database
client = MongoClient()

# setup an object
db = client["wiab"]
coll = db["reviews"]

print """<h3>Database Stats</h3>"""

result = db.command("dbstats")

pprint(result)


print """<h3>Reviews Collection Stats</h3>"""

result2 = db.command("collstats", "reviews")

pprint(result2)

print """<h3>Server Status</h3>"""

result3 = db.command("serverStatus")

pprint(result3)
