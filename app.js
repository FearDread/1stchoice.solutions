/* 1st Choice Business Solutions *
 *                               *
 * Main Application Script       *
 * ----------------------------- */
var app, routes, users;

var express = require('express'),
    path = require('path'),
    favicon = require('serve-favicon'),
    logger = require('morgan'),
    cookieParser = require('cookie-parser'),
    bodyParser = require('body-parser');

routes = require('./routes');
//users = require('./routes/users');

app = express();

app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'jade');

app.use(favicon(__dirname + '/public/favicon.ico'));
app.use(logger('dev'));

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));

app.use(cookieParser());
app.use(express.static(path.join(__dirname, 'public')));

// Make our db accessible to our router
app.use(function (req, res, next) {

    //req.db = db;

    next();

});

// app.use('/', routes);
// app.use('/users', users);

routes.add(app);

/// catch 404 and forwarding to error handler
app.use(function (req, res, next) {
    var err = new Error('Not Found');

    err.status = 404;

    next(err);

});

// development error handler
if (app.get('env') === 'development') {

    app.use(function (err, req, res, next) {

        res.status(err.status || 500);
        res.render('error', {
            message: err.message,
            error: err
        });

    });

}

// production error handler
app.use(function (err, req, res, next) {

    res.status(err.status || 500);
    res.render('error', {
        message: err.message,
        error: {}
    });

});

module.exports = app;

var server = app.listen(5000, function () {
    var host, port;

    host = server.address().address;
    port = server.address().port;

    console.log('1stchoice solutions listening at http://%s:%s', host, port); 

});
