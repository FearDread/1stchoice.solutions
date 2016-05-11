
exports.add = function (app) {

    app.get('/', function (req, res) {
        var props = {

        };

        res.render('index', props);

    });

};

