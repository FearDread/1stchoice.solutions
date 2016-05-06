/* Guerilla UI Module */
/* ================== */
$.GUI().create('1stchoice', function ($gui) {

    function init_plugins() {

    }

    function init_effects() {

    }

    return {

        load: function () {
	    $gui.log('loading 1stchoice app');
	    console.log('loading 1stchoice app ... console');

	    Royal_Preloader.config({
	        mode: 'number',
		showProgress: false,
		background: '#CCCCCC'
	    });

	    $gui.timeout(function () {

		init_plugins();

		init_effects();

 	    }, 500);

	},

	unload: function () {

	}

    }

}).start();
