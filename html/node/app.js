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

//var jsonConcat = require("json-concat");

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
});

connection.connect(function(err) {
  if (err) throw err
  console.log('You are now connected to mysql...')
      

      connection.query('SElECT * FROM game', function(err, rows, columns)
      {
        if (err) throw err
          for (i = 0; i < rows.length; i++) { 

          console.log(rows[i].name);
      
      }
      })
}) 

var mongo = require('mongodb')
var sanitize = require('mongo-sanitize');

var MongoClient = mongo.MongoClient;
var database = undefined;
var dbUrl = 'mongodb://127.0.0.1:27017/wiab';
MongoClient.connect(dbUrl, function(err, db) {
  if (err) {
    throw err;
  } else {
    database = db;
    console.log('MongoDB connection successful!');
}
});


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
app.use(session({name:'session', secret: 'friedbuttered5bannanatoast', 
  resave: false, saveUninitialized: true, duration: 30 * 60 * 1000,
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

     res.render('login', {message: req.session.message});
  
});
app.post('/login', function(req, res) {
  console.log(req.body.user.username);
  console.log(req.body.user.password);
  console.log(req.session);

   connection.query("SElECT customerID, username, firstName, lastName FROM customer WHERE username=? AND password=SHA2(?, 256) LIMIT 1",
    [req.body.user.username, req.body.user.password], function(err, userID, columns)
  {
    
      if (err) {req.session.message = "Invalid Login."; throw err;}
      if (userID.length > 0)
      {

       req.session.userinfo = userID[0];
       console.log(req.session);
        console.log("Welcome " + req.session.userinfo.firstName);
        req.session.message = "Login Successful!";
        res.redirect('/customer');
      }
      else
      {
        console.log("invalid login!");
        req.session.message = "Invalid Login!";
        req.session.userinfo = "";
        console.log(req.session);
        res.redirect('/login');
      }
      
     
  })
});

app.get('/logout', function(req, res){
    req.session.destroy();
    console.log(req.session);
     res.render('login', {message: "Logout successful"});
  
});



app.get('/signup', function(req, res){

     res.render('signup');
  
});

app.post('/signup', function(req, res) {
  
   connection.query("INSERT INTO customer (username, password, firstName,lastName, email, address, city, state, zip) VALUES(?,SHA2(?,256),?,?,?,?,?,?,?)",
    [req.body.newuser.username, req.body.newuser.password, req.body.newuser.firstName,req.body.newuser.lastName, 
    req.body.newuser.email, req.body.newuser.address, req.body.newuser.city, req.body.newuser.state, req.body.newuser.zip],
     function(err, userID, columns)
  {
    
      if (err) {req.session.message = "Failed to create account."; throw err;}
      else
      {
        console.log("signed up!");
        req.session.message = "Your account is ready to go! please sign in below.";
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

var orderJSON;
var userJSON;
  connection.query("SElECT * FROM custOrderSummary WHERE customerID=?",[req.session.userinfo.customerID], function(err, orders, columns)
  {
      if (err) throw err
      orderJSON = orders;
    
    connection.query("SElECT * FROM customer WHERE customerID=?",[req.session.userinfo.customerID], function(err, userdata, columns)
    {
       if (err) throw err
       userJSON = userdata;
     //console.log("Userdata is" + JSON.stringify(userJSON));

     var dataJSON = JSON.stringify(orderJSON.concat(userJSON));
    // console.log("JSON is " + dataJSON);

 res.render('customer', {data: dataJSON});
  
    });

  });

});

app.post('/editinfo', function(req, res) {
  
   connection.query("UPDATE customer SET " + req.body.changeItem + "=? WHERE customerID=? LIMIT 1",
    [req.body.changeText, req.session.userinfo.customerID],
     function(err, userID, columns)
  {
    
      if (err) {req.session.message = "Failed to update."; throw err;}
      else
      {
        console.log("record changed!");
        console.log("req.body");
        req.session.message = "Your account has been updated";
        res.redirect('/customer');
      }
      
     
  })
});



app.post('/cancel', function(req, res) {
  
   connection.query("UPDATE shipping SET status='canceled' WHERE custOrder=? LIMIT 1",
    [req.body.tocancel],
     function(err, userID, columns)
  {
    
      if (err) {req.session.message = "Failed to update."; throw err;}
      else
      {
        console.log("order canceled!");
        req.session.message = "Your account has been updated";
        res.redirect('/customer');
      }
      
     
  })
});



app.get('/', function(req, res){


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
  });
  
});

app.get('/review/:id', function(req, res){
  if (!req.session || !req.session.userinfo) { // Check if session exists
    // lookup the user in the DB by pulling their email from the session
    console.log("not signed in, back to login");
    res.redirect('/login');
  }
  var name=[]; 
  connection.query("SElECT name FROM game WHERE productID=" + connection.escape(req.params.id) + "LIMIT 1", function(err, gameinfo, columns)
  {
      if (err) throw err
        name = {name: gameinfo[0].name};

        console.log("game name from query: " + name);

       MongoClient.connect(dbUrl, function(err, database) {
  
        var wiab = database.db('wiab');
        var reviews = wiab.collection('reviews');
       reviews.find({game: name.name}).toArray(function(err, result) {
          if (err) throw err;
          var rev = result;

          rev = rev.concat(name);

          console.log("Reviews for game: " + JSON.stringify(rev));


          res.render('review', {reviews: JSON.stringify(rev)});
          });

       });
  });
  
});

app.post('/addreview', function(req, res) {
  if (!req.session || !req.session.userinfo) { // Check if session exists
    // lookup the user in the DB by pulling their email from the session
    console.log("not signed in, back to login");
    res.redirect('/login');
  }
  
   var mongoq = MongoClient.connect(dbUrl, function(err, database) {
  
        var wiab = database.db('wiab');
        var reviews = wiab.collection('reviews');
       reviews.insertOne({game: sanitize(req.body.review.game), 
        description: sanitize(req.body.review.description),
         customer: sanitize(req.session.userinfo.customerID),
          rating: sanitize(req.body.review.rating),
           likes:0 }, function(err, result) {
          if (err) throw err;
          console.log("Review added");


          res.redirect('/');
          });

       });
});




app.get('/cart', function(req, res){

if (!req.session || !req.session.userinfo) { // Check if session exists
    // lookup the user in the DB by pulling their email from the session
    console.log("not signed in, back to login");
    res.redirect('/login');
  }
  req.session.cart;
  
    res.render("cart", {cartdata: JSON.stringify(req.session.cart)});
 
    
  
});


app.post('/cart', function(req, res) {
  if (!req.session || !req.session.userinfo) { // Check if session exists
    // lookup the user in the DB by pulling their email from the session
    console.log("not signed in, back to login");
    res.redirect('/login');
  }

  console.log(req.body.pid);
  console.log(req.body.quantity);
  console.log(req.body.pname);
  console.log(req.body.image);

  var id = req.body.pid;
  var quan = req.body.quantity;
  var name = req.body.pname;
  var im = req.body.image;
  var pri = req.body.price;

  if (!req.session.cart)
  {
    req.session.cart = [];
  }

  var obj = {pid: id, quantity: quan, name: name, imagePath: im, price: pri};
  req.session.cart = req.session.cart.concat(obj);
       console.log("updated cart:" + JSON.stringify(req.session));

       res.render("cart",{cartdata : JSON.stringify(req.session.cart)});
        
});

app.post('/removefromcart', function(req, res) {
  
      console.log("Wil remove " + req.body.toremove);
      
      req.session.cart;
      if (req.session.cart !== undefined)
      {
      
      req.session.cart = [];
      

      }

    res.redirect("/cart");

});

app.get('/confirm', function(req, res){

if (!req.session || !req.session.userinfo) { // Check if session exists
    // lookup the user in the DB by pulling their email from the session
    console.log("not signed in, back to login");
    res.redirect('/login');
  }
  req.session.cart;
  req.session.cart.total=req.body.price;
  
    res.render("confirm", {cartdata: JSON.stringify(req.session.cart)});
});


app.post('/purchase', function(req, res){

if (!req.session || !req.session.userinfo) { // Check if session exists
    // lookup the user in the DB by pulling their email from the session
    console.log("not signed in, back to login");
    res.redirect('/login');
  }

  req.session.cart;
  req.session.userdata;
  if (req.session.cart !== undefined)
  {


   var date;
   date = new Date().toISOString().slice(0, 19).replace('T', ' ');
    console.log(date);


  //Create Customer Order
  connection.query("INSERT INTO custOrder(orderDate,paymentMethod,paymentTotal,PaymentDate,customerID) VALUES(?, 'PayPal', ?, ?, ?)",
  [date, req.body.total, date, req.session.userinfo.customerID],   
  function(err, result)
  { if (err) throw err
    var order = result.insertId; 

    console.log("working with order : " + order);
    //Create Shipping Record
    connection.query("INSERT INTO shipping (custOrder,warehouseID,status) VALUES(?,1,'pending')",
    [order],   
    function(err, gameinfo, columns)
    { if (err) throw err });
    
    //Create ProductList
      for (var i = 0; i < req.session.cart.length; i++)
      {
        console.log("purchase item: " + JSON.stringify(req.session.cart[i]));

        connection.query("INSERT INTO custOrderList(custOrder,productID, quantity) VALUES(?,?,?)",
        [order, req.session.cart[i].pid, req.session.cart[i].quantity],
        function(err, gameinfo, columns)
        { if (err) throw err });

     }
      delete req.session["cart"];
  
  });

  }

    res.redirect("/cart");
 
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
