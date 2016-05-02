jQuery(document).ready(function() {
	
	jQuery('#next-post-scroll').click(function() {
		scrollnext();
		return false;
	});
	
	jQuery('#previous-post-scroll').click(function() {
		scrollprevious();
		return false;
	});
	
	jQuery('#post-scroll').click(function() {
		scrollprevious();
		return false;
	});
	
	jQuery('#comments-scroll').click(function() {
		scrollnext();
		return false;
	});
	
	//Internet Explorer Keypress and Keydown events
	var ieInputHack = false;
	
	jQuery('html input').focus(function() {
		ieInputHack = true;
	});
	
	jQuery('html textarea').focus(function() {
		ieInputHack = true;
	});
	
	jQuery('html input').blur(function() {
		ieInputHack = false;
	});
	
	jQuery('html textarea').blur(function() {
		ieInputHack = false;
	});
	
	//Browser check for keypress and keydown events
	if (jQuery.browser.mozilla) {
    	jQuery('html').keydown(function(event) {
			var success = false;
			var code = (event.keyCode ? event.keyCode : event.which);
			var focusedInputs = jQuery('html input:focus');
			var focusedTextArea = jQuery('html textarea:focus');
			if (focusedInputs != null && focusedInputs.length > 0) { 
				success = true; 
			}
			else if (focusedTextArea != null && focusedTextArea.length > 0) { 
				success = true; 
			}
			else {
				//LEFT Keypress
	   			if (code.toString() == '37') {
	   				prevpage()
	   				success = false;
	   			}
				//UP Keypress
				else if (code.toString() == '38') {	
	   				scrollprevious();
	   				success = false;
	   			}
	   			//RIGHT Keypress
	   			else if (code.toString() == '39') {
	   				nextpage()
	   				success = false;
	   			}
	  	 		//DOWN Keypress
	   			else if (code.toString() == '40') {	
	   				scrollnext();
	   				success = false;
	   			}
	   			//F Keypress
	   			else if (code.toString() == '102' || code.toString() == '70') {
	   				var url = jQuery('#rss-link').attr('href');
	   				window.location.replace(url);
	   			}
	   			//H KeyPress
	   			else if (code.toString() == '104' || code.toString() == '72') {
	   				var url = jQuery('#home-scroll').attr('href');
	   				window.location.replace(url);
	   			}
	   			//S Keypress
	   			else if (code.toString() == '115' || code.toString() == '83') {
	   				jQuery('.searchform .field').focus();
	   			}
	   			//DO NOTHING
	   			else { success = true; }
			}
			return success;
		});
	} else {
	    jQuery('html').keydown(function(event) {
			var success = false;
			var code = (event.keyCode ? event.keyCode : event.which);
			var focusedInputs = jQuery('html input:focus');
			var focusedTextArea = jQuery('html textarea:focus');
			if (focusedInputs != null && ieInputHack) { 
				success = true; 
			}
			else if (focusedTextArea != null && ieInputHack) { 
				success = true; 
			}
			else {
				ieInputHack = false;
				//LEFT Keypress
	   			if (code.toString() == '37') {
	   				prevpage()
	   				success = false;
	   			}
				//UP Keypress
				else if (code.toString() == '38') {	
	   				scrollprevious();
	   				success = false;
	   			}
	   			//RIGHT Keypress
	   			else if (code.toString() == '39') {
	   				nextpage()
	   				success = false;
	   			}
	  	 		//DOWN Keypress
	   			else if (code.toString() == '40') {	
	   				scrollnext();
	   				success = false;
	   			}
	   			//F Keypress
	   			else if (code.toString() == '102' || code.toString() == '70') {
	   				var url = jQuery('#rss-link').attr('href');
	   				window.location.replace(url);
	   			}
	   			//H KeyPress
	   			else if (code.toString() == '104' || code.toString() == '72') {
	   				var url = jQuery('#home-scroll').attr('href');
	   				window.location.replace(url);
	   			}
	   			//S Keypress
	   			else if (code.toString() == '115' || code.toString() == '83') {
					jQuery('.searchform .field').focus();
	   			}
	   			//DO NOTHING
	   			else { success = true; }
			}
			return success;
		});
	}
	
	
});

function scrollnext() {
	if (jQuery('#comments-scroll').length) {
		var windowobject = window.pageYOffset;
		var postobject = jQuery('#comments');
		var postposition = postobject.offset().top;
		var calculatedposition = windowobject + 80;
		if (calculatedposition === postposition) {
		}
		else {
			var postobject = jQuery('#comments');
			var postposition = postobject.offset().top;
			jQuery('html,body').animate({scrollTop: postposition - 80}, 800);
		}
	}
	else {
		
		var currentpost = jQuery('#currentpost').text();
		var maxposts = jQuery('#maxposts').text();
			
		var intcurrentpost = currentpost * 1;
		var intmaxposts = maxposts * 1;
			
		var incrementpost = 0;
		if (intcurrentpost == intmaxposts) {
			incrementpost = 1;
		}
		else {
			incrementpost = intcurrentpost + 1;
		} 
		var postobject = jQuery('#post-' + incrementpost.toString());
		var postposition = postobject.offset().top;
		jQuery('html,body').animate({scrollTop: postposition - 80}, 800);

		jQuery('#currentpost').text(incrementpost.toString());	
	}
}

function scrollprevious() {
	if (jQuery('#post-scroll').length) {
		var windowobject = window.pageYOffset;
		var postobject = jQuery('#main div.post');
		var postposition = postobject.offset().top;
		var calculatedposition = windowobject + 80;
		if (calculatedposition === postposition) {
		}
		else {
			var postobject = jQuery('#main div.post');
			var postposition = postobject.offset().top;
			jQuery('html,body').animate({scrollTop: postposition - 80}, 800);
		}
	}
	else {
		var currentpost = jQuery('#currentpost').text();
		var maxposts = jQuery('#maxposts').text();
		
		var intcurrentpost = currentpost * 1;
		var intmaxposts = maxposts * 1;
		
		var incrementpost = 0;
		if (intcurrentpost <= 1) {
			incrementpost = intmaxposts;
		}
		else {	
			incrementpost = intcurrentpost - 1;
		} 
		
		var postobject = jQuery('#post-' + incrementpost.toString());
		var postposition = postobject.offset().top;
		jQuery('html,body').animate({scrollTop: postposition - 80}, 800);

		jQuery('#currentpost').text(incrementpost.toString());
	
	}
}

function nextpage() {
	var url = '';
	if (jQuery('#next-page a').length) {
		url = jQuery('#next-page a').attr('href').toString();
		window.location.replace(url);
	}
}

function prevpage() {
	var url = '';
	if (jQuery('#prev-page a').length) {
		url = jQuery('#prev-page a').attr('href').toString();
		window.location.replace(url);
	}
}