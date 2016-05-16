/* Global Routes */
var utils = require('../src/utils');

exports.add = function (app) {

    app.use(function (req, res, next) {
        console.log('1stchoice ....');

        next();
    });

    app.get('/', function (req, res) {

        res.render('index', {});

    });

    app.get('/about', function (req, res) {
   
        res.render('about', {});

    });

    app.get('/packages', function (req, res) {

        res.render('packages', {});

    });

    app.get('/order', function (req, res) {

        res.render('order', {});

    });

    app.get('/faq', function (req, res) {
  
        res.render('faq', {});

    });

    app.get('/contact', function (req, res) {

        res.render('contact', {});

    });

    app.post('/contact', function (req, res) {
        console.log('posting to /contact');

        res.send('200');
    });

};
