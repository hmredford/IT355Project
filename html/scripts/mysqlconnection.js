var mysql = require('mysql')
var con = mysql.createConnection({
  host     : 'localhost',
  user     : 'hmredford',
  password : 'hR085757',
  database : 'WIAB'
});

con.connect(function(err) {
  if (err) throw err;
  console.log("Connected!");
});