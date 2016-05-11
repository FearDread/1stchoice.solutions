
exports.add = function (app) {

    app.use(function (req, res, next) {
        console.log('1stchoice ....');

        var err = new Error('Not Found');
        err.status = 404;
        
        next();

    });

    app.get('/', function (req, res) {
        var props = {

        };

        res.render('index', props);

    });

};

