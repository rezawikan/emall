var http        = require('http');
var querystring = require('querystring');

function accountExists (email) {
  var mysql = require('mysql');

  var connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'e_mall'
  });
  connection.connect();

  var query = connection.query('select email from seller');
  
  var emails = ['you@email.com', 'alex@email.com', 'admin@email.com'];
  return emails.indexOf(email) > -1;
}

// website.com/valid?email=...
var server = http.createServer(function(req, res) {

  var params = req.url.split('?')[1];
  var data   = querystring.parse(params);
  var email  = data.email;

  res.statusCode = 200;
  res.setHeader("Content-Type", "application/json");
  res.setHeader("Access-Control-Allow-Origin", "*");
  res.setHeader("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");

  if (accountExists(email)) {
    res.write('""');
  } else {
    res.write('"true"');
  }
  
  res.end();
});
server.listen(3000);