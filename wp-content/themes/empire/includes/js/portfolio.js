// PrettyPhoto (lightbox)
jQuery(document).ready(function($){
	jQuery("a[rel^='prettyPhoto']").prettyPhoto();
});

// Portfolio thumbnail hover effect
jQuery(document).ready(function () {
	jQuery('#portfolio li.group img').mouseover(function() {
		jQuery(this).stop().fadeTo(300, 0.5);
	});
	jQuery('#portfolio li.group img').mouseout(function() {
		jQuery(this).stop().fadeTo(400, 1.0);
	});
});

/*-----------------------------------------------------------------------------------*/
/* Portfolio tag toggle on page load, based on hash in URL */
/*-----------------------------------------------------------------------------------*/

jQuery(document).ready(function(){
	if ( jQuery( '.port-cat a' ).length ) {
		var currentHash = '';
		currentHash = window.location.hash;
		
		// If we have a hash, begin the logic.
		if ( currentHash != '' ) {
			currentHash = currentHash.replace( '#', '' );
			
			if ( jQuery( '#portfolio .' + currentHash ).length ) {
			
				// Select the appropriate item in the category menu.
				jQuery( '.port-cat a.current' ).removeClass( 'current' );
				jQuery( '.port-cat a[rel="' + currentHash + '"]' ).addClass( 'current' );
				
				// Show only the items we want to show.
				jQuery( '#portfolio li.group' ).hide();
				jQuery( '#portfolio .' + currentHash ).fadeIn( 400 );
			
			}
		}

	}
});

// Portfolio tag sorting
jQuery(document).ready(function(){
								
	jQuery('.port-cat a').click(function(evt){
		var clicked_cat = jQuery(this).attr('rel');
		if(clicked_cat == 'all'){
			jQuery('#portfolio li.group').hide().fadeIn(200);
		} else {
			jQuery('#portfolio li.group').hide()
			jQuery('#portfolio .' + clicked_cat).fadeIn(400);
		 }
		//eq_heights();
		evt.preventDefault();
	})	

	// Thanks @johnturner, I owe you a beer!
	var postMaxHeight = 0;
	jQuery("#portfolio li.group").each(function (i) {
		 var elHeight = jQuery(this).height();
		 if(parseInt(elHeight) > postMaxHeight){
			 postMaxHeight = parseInt(elHeight);
		 }
	});
	jQuery("#portfolio li.group").each(function (i) {
		jQuery(this).css('height',postMaxHeight+'px');
	});
														
});