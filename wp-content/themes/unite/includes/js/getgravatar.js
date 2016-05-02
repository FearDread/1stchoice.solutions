/*

Get Gravatar v1.0
Copyright © 2009 Josh Pyles / Pixelmatrix Design LLC
http://pixelmatrixdesign.com

Requires jQuery 1.3 or newer

Thanks to Tim Van Damme for the inspiration and the pretty demo page

License:
MIT License - http://www.opensource.org/licenses/mit-license.php

Usage:

jQuery("input#email-addresss").getGravatar();

Or you can specify some custom options:

jQuery("input#email-address").getGravatar({
	url: '/includes/get-gravatar.php',
	fallback: 'http://mysite.com/images/default.png',
	avatarSize: 128,
	avatarContainer: "#gravatar-preview",
	start: function(){
		alert("starting!");
	},
	stop: function(){
		alert("stopping!");
	}
});

Enjoy!

*/

(function(jQuery) {
  jQuery.fn.getGravatar = function(options) {
    //debug(this);
    // build main options before element iteration
    var opts = jQuery.extend({}, jQuery.fn.getGravatar.defaults, options);
    // iterate and reformat each matched element
    return this.each(function() {
      jQuerythis = jQuery(this);
      // build element specific options
      var o = jQuery.meta ? jQuery.extend({}, opts, jQuerythis.data()) : opts;
			var t = "";
			//check to see if we're working with an text input first
      if(jQuerythis.is("input[type='text']")){
				//do an initial check of the value
				jQuery.fn.getGravatar.getUrl(o, jQuerythis.val());
				
				//do our ajax call for the MD5 hash every time a key is released
				jQuerythis.keyup(function(){
					clearTimeout(t);
					var email = jQuerythis.val();
					t = setTimeout(function(){jQuery.fn.getGravatar.getUrl(o, email);}, 500);
				});
			}
    });
  };
  //
  // define and expose our functions
  //
	jQuery.fn.getGravatar.getUrl = function(o, email){
		//call the start function if in use
		if(o.start) o.start(jQuerythis);
		
		jQuery.get(o.url, "email="+email, function(data){
			//when we have our MD5 hash, generate the gravatar URL
			var id = data.gravatar_id;
			var gravatar_url = "http://gravatar.com/avatar.php?gravatar_id="+id+"&default="+o.fallback+"&size="+o.avatarSize;
			//call our function to output the avatar to the container
     	jQuery.fn.getGravatar.output(o.avatarContainer, gravatar_url, o.stop);
		}, "json");
	}
  jQuery.fn.getGravatar.output = function(avatarContainer, gravatar_url, stop) {
		//replace the src of our avatar container with the gravatar url
		img = new Image();
		jQuery(img)
		.load(function(){
			jQuery(avatarContainer).attr("src", gravatar_url);
			if(stop) stop();
		})
		.attr("src", gravatar_url);
  };
  //
  // plugin defaults
  //
  jQuery.fn.getGravatar.defaults = {
   	url: 'get-gravatar.php',
    fallback: '',
		avatarSize: 50,
		avatarContainer: '#gravatar',
		start: null,
		stop: null
  };
})(jQuery);