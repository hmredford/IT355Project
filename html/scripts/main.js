var http = require("http");

http.createServer(function (request, response) {

   // Send the HTTP header 
   // HTTP Status: 200 : OK
   // Content Type: text/plain
   response.writeHead(200, {'Content-Type': 'text/plain'});
   
   // Send the response body as "Hello World"
   response.end('Hello World\n');
}).listen(8081);

// Console will print the message
console.log('Server running at http://127.0.0.1:8081/');

var mysql = require('/usr/local/nodejs/node_modules/mysql')
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

/*con.query("SELECT * FROM game", function (err, result, fields) {
    if (err) throw err;
    console.log(result);
    });

document.getElementById('image1').src='https://cf.geekdo-images.com/micro/img/h-Ejv31TdN2d4KNPXwopv6w8pF0=/fit-in/64x64/pic860217.jpg'
*/