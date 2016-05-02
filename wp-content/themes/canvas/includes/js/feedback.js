jQuery(document).ready(function($){

/*-----------------------------------------------------------------------------------*/
/* Feedback slide/fade setup. */
/*-----------------------------------------------------------------------------------*/
	if ( jQuery( '.feedback' ).length ) {
		jQuery( '.feedback' ).each( function () {
			var effect = 'none';
			
			if ( jQuery( this ).hasClass( 'fade' ) ) { effect = 'fade'; }
			
			if ( effect != 'none' ) {
				var autoSpeed = 5000;
				var fadeSpeed = 350;
				
				if ( jQuery( this ).parent().find( 'input[name="auto_speed"]' ).length && ( jQuery( this ).parent().find( 'input[name="auto_speed"]' ).val() != '' ) ) {
					autoSpeed = parseInt( jQuery( this ).parent().find( 'input[name="auto_speed"]' ).val() );
					jQuery( this ).parent().find( 'input[name="auto_speed"]' ).remove();
				}
				
				if ( jQuery( this ).parent().find( 'input[name="fade_speed"]' ).length && ( jQuery( this ).parent().find( 'input[name="fade_speed"]' ).val() != '' ) ) {
					fadeSpeed = parseInt( jQuery( this ).parent().find( 'input[name="fade_speed"]' ).val() );
					 jQuery( this ).parent().find( 'input[name="fade_speed"]' ).remove();
				}
				
				jQuery( this ).slides({
					container: 'feedback-list', 
					next: 'btn-next', 
					prev: 'btn-prev', 
					effect: effect, 
					play: autoSpeed, 
					fadeSpeed: fadeSpeed, 
					autoHeight: true, 
					generatePagination: false, 
					hoverPause: true, 
					animationComplete: function () { jQuery( this ).stop(); }, 
					slidesLoaded: function () { jQuery( '.feedback-list .slides_control' ).css( 'height', jQuery( '.feedback-list .quote:first' ).height() ); }
				});
			}
		});
	}				

/*-----------------------------------------------------------------------------------*/
/* Make sure feedback widgets have the correct width on each feedback item. */
/*-----------------------------------------------------------------------------------*/

	if ( jQuery( '.widget_woo_feedback .feedback-list' ).length ) {
		jQuery('.widget_woo_feedback .feedback-list' ).each( function () {
			var width = jQuery( this ).parent().width();
			if ( width ) {
				jQuery( this ).find( '.quote' ).css( 'width', width + 'px' );
			}	
		});
	}
							
}); // End jQuery()