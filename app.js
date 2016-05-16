/* 1st Choice Business Solutions *
 *                               *
 * Main Application Script       *
 * ----------------------------- */
var app, routes, server;

var express = require('express'),
    path = require('path'),
    favicon = require('serve-favicon'),
    logger = require('morgan'),
    cookieParser = require('cookie-parser'),
    bodyParser = require('body-parser');

routes = require('./routes');

app = express();

app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());

app.set('views', path.join(__dirname, '/public/views'));
app.set('view engine', 'jade');

app.use(favicon(__dirname + '/public/favicon.ico'));
app.use(logger('dev'));

app.use(cookieParser());
app.use(express.static(path.join(__dirname, '/public')));

routes.add(app);

app.use(function (req, res, next) {
    var err = new Error('Not Found');

    err.status = 404;

    next(err);
});

if (app.get('env') === 'development') {
    
    app.use(function (err, req, res, next) {
    
        res.status(err.status || 500);
        res.render('404', {
            message: err.message,
            error: err
        });

    });

}

app.use(function (err, req, res, next) {

    app.use(function (err, req, res, next) {
    
        res.status(err.status || 500);
        res.render('404', {
            message: err.message,
            error: {} 
        });

    });

});

server = app.listen(5000, function () {
    var host, port;

    host = server.address().address;
    port = server.address().port;

    console.log('1stchoice solutions listening at http://%s:%s', host, port); 
});
