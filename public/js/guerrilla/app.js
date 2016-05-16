/* Guerilla UI Module */
/* ================== */
$.GUI().create('1stchoice', function ($gui) {

    function init_plugins() {
        $gui.log('running jquery plugins');

        $gui.$("#slider1").revolution({
	      sliderType:"standard",
	      startDelay:2500,
	      spinner:"spinner2",
	      sliderLayout:"auto",
	      viewPort:{
		      enable:false,
		      outof:'wait',
		      visible_area:'100%'
	      },
	      delay:9000,
	      navigation: {
		  keyboardNavigation:"off",
		  keyboard_direction: "horizontal",
		  mouseScrollNavigation:"off",
		  onHoverStop:"off",
		  arrows: {
		      style:"erinyen",
		      enable:true,
		      hide_onmobile:true,
		      hide_under:600,
		      hide_onleave:true,
		      hide_delay:200,
		      hide_delay_mobile:1200,
		      tmp:'<div class="tp-title-wrap">      <div class="tp-arr-imgholder"></div>    <div class="tp-arr-img-over"></div> <span class="tp-arr-titleholder">{{title}}</span> </div>',
		      left: {
			  h_align:"left",
			  v_align:"center",
			  h_offset:30,
			  v_offset:0
		      },
		      right: {
			  h_align:"right",
			  v_align:"center",
			  h_offset:30,
			  v_offset:0
		      }
		  },
		  touch:{
		      touchenabled:"on",
		      swipe_treshold : 75,
		      swipe_min_touches : 1,
		      drag_block_vertical:false,
		      swipe_direction:"horizontal"
		  },
		  bullets: {
		      enable:true,
		      hide_onmobile:true,
		      hide_under:600,
		      style:"hermes",
		      hide_onleave:true,
		      hide_delay:200,
		      hide_delay_mobile:1200,
		      direction:"horizontal",
		      h_align:"center",
		      v_align:"bottom",
		      h_offset:0,
		      v_offset:30,
		      space:5
		  }
	      },
	      gridwidth:1240,
	      gridheight:497
	  });
    }

    function init_effects() {

    }

    return {

        load: function () {
	    $gui.log('loading 1stchoice app');

	    Royal_Preloader.config({
	        mode: 'number',
		showProgress: false,
		background: '#000000'
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
