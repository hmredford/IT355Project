var express = require('express');

var app = express();
var multer = require('multer')
//var constants = require('constants');
//var constant = require('./config/constants');


var port = process.env.PORT || 8081; //8042
//var mongoose = require('mongoose');
var passport = require('passport');
//var flash = require('connect-flash');
var path = require('path');

//var morgan = require('morgan');
var cookieParser = require('cookie-parser');
var bodyParser = require('body-parser');
var session = require('express-session');
//var bodyParser = require('body-parser');
var dateFormat = require('dateformat');
var now = new Date();

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({extended: true}));


/***************Mongodb configuratrion********************/
//var mongoose = require('mongoose');
//var configDB = require('./config/database.js');
//configuration ===============================================================
//mongoose.connect(configDB.url); // connect to our database

var mysql = require('mysql');

var connection = mysql.createConnection({
  host: 'localhost',
  user: 'hmredford',
  password: 'hR085757',
  database: 'WIAB'
})

connection.connect(function(err) {
  if (err) throw err
  console.log('You are now connected...')
      

      connection.query('SElECT * FROM game', function(err, rows, columns)
      {
        if (err) throw err
          for (i = 0; i < rows.length; i++) { 

          console.log(rows[i].name);
      
      }
      })
}) 




//require('./config/passport')(passport); // pass passport for configuration

//set up our express application
//app.use(morgan('dev')); // log every request to the console
//app.use(cookieParser()); // read cookies (needed for auth)
//app.use(bodyParser()); // get information from html forms

//view engine setup
app.use(express.static(path.join(__dirname, 'public')));
app.set('views', path.join(__dirname, 'app/views'));
app.set('view engine', 'ejs');
app.set('view engine', 'ejs'); // set up ejs for templating


//required for passport
app.use(session({cookieName:'session', secret: 'butteredbannanatoast', 
  resave: true, saveUninitialized: true, duration: 30 * 60 * 1000,
  activeDuration: 5 * 60 * 1000, })); // session secret

var ssn;
app.use(passport.initialize());
app.use(passport.session()); // persistent login sessions
//app.use(flash()); // use connect-flash for flash messages stored in session

// routes ======================================================================
//require('./config/routes.js')(app, passport); // load our routes and pass in our app and fully configured passport


//launch ======================================================================
app.listen(port);
console.log('The magic happens on port ' + port);




app.get('/login', function(req, res){

     res.render('login');
  
});
app.post('/login', function(req, res) {
  console.log(req.body.user.username);
  console.log(req.body.user.password);
  console.log(req.session);

   connection.query("SElECT customerID, username, firstName, lastName FROM customer WHERE username=? AND password=SHA2(?, 256) LIMIT 1",
    [req.body.user.username, req.body.user.password], function(err, userID, columns)
  {
    
      if (err) throw err
      if (userID.length > 0)
      {

       req.session.userinfo = userID[0];
       console.log(req.session);
        console.log("Welcome " + req.session.userinfo.firstName);
        
        res.redirect('/customer');
      }
      else
      {
        console.log("invalid login!");
        res.redirect('/login');
      }
      
     
  })
});




app.get('/signup', function(req, res){

     res.render('signup');
  
});

app.post('/signup', function(req, res) {
  
   connection.query("INSERT INTO customer (username, password, firstName,lastName, email, address, city, state, zip) VALUES(?,?,?,?,?,?,?,?,?)",
    [req.body.newuser.username, req.body.newuser.password, req.body.newuser.firstName,req.body.newuser.lastName, 
    req.body.newuser.email, req.body.newuser.address, req.body.newuser.city, req.body.newuser.state, req.body.newuser.zip],
     function(err, userID, columns)
  {
    
      if (err) throw err
      else
      {
        console.log("signed up!");
        res.redirect('/login');
      }
      
     
  })
});






app.get('/customer', function(req, res) {
  if (!req.session || !req.session.userinfo) { // Check if session exists
    // lookup the user in the DB by pulling their email from the session
    console.log("not signed in, back to login");
    res.redirect('/login');
  }

  connection.query("SElECT * FROM custOrderSummary WHERE customerID=?",[req.session.userinfo.customerID], function(err, orders, columns)
  {
      if (err) throw err
        var order_string = JSON.stringify(orders);
      
     res.render('customer', {sorders: order_string});
  })
});




app.get('/', function(req, res){

  ssn=req.session;
  if (ssn[0])
  {
  console.log("ssn is " + ssn);
  }
  else 
  {
    console.log("no session");
  }
  connection.query('SElECT productID, name, price, imagePath FROM game', function(err, gamerows, columns)
  {
    
      if (err) throw err
        var games_string = JSON.stringify(gamerows);
      
     res.render('index', {sgames: games_string});
  })
  
});

app.get('/product/:id', function(req, res){


  connection.query("SElECT * FROM game WHERE productID=" + connection.escape(req.params.id) + "LIMIT 1", function(err, gameinfo, columns)
  {
      if (err) throw err
        var game_string = JSON.stringify(gameinfo);
      
     res.render('product', {sgame: game_string});
  })
  
});




app.get('/cart/:pid/', function(req, res){


  connection.query("SElECT * FROM game WHERE productID=" + connection.escape(req.params.id) + "LIMIT 1", function(err, gameinfo, columns)
  {
      if (err) throw err
        var game_string = JSON.stringify(gameinfo);
      
     res.render('product', {sgame: game_string});
  })
  
});



//catch 404 and forward to error handler
app.use(function (req, res, next) {
    res.status(404).render('404', {title: "Sorry, page not found", session: req.sessionbo});
});

//catch 404 and forward to error handler
app.use(function (req, res, next) {
    res.status(404).render('404', {title: "Sorry, page not found", session: req.sessionbo});
});

app.use(function (req, res, next) {
    res.status(500).render('404', {title: "Sorry, page not found"});
});
exports = module.exports = app;