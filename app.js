const express = require('express');
const handlebars  = require('express-handlebars');
const path = require('path');
const app = express();

const parentDir = path.normalize(__dirname+'/..');
app.engine('handlebars', handlebars({
  layoutsDir: parentDir + '/views/layouts',
}));
app.set('view engine', 'handlebars');
app.set('view engine', 'handlebars');
app.set('views', parentDir + '/views');

app.use(express.static('assets'));
app.use('/assets', express.static(parentDir + '/assets'));

app.get('/', function (req, res) {
  res.render('index');
});

app.get('/login', function (req, res) {
  res.render('login');
});

app.get('/login_ok', function (req, res) {
  res.render('logOK');
});

app.get('/pass', function (req, res) {
  res.render('pass');
});

app.get('/pass_ok', function (req, res) {
  res.render('passOK');
});

app.get('/toiawase', function (req, res) {
  res.render('toiawase');
});
app.get()


app.get('/heartbeat', (req, res) => {
//Serves the body of the page aka "main.handlebars" to the container //aka "index.handlebars"
  res.send('SERVER IS WORKING!!');
});

app.listen(8080);
