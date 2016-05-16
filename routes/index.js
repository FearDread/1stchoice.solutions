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

    app.get('/packages', function (req, res) {

        res.render('packages', {});

    });

};
