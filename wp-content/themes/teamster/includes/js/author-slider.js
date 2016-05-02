
jQuery(document).ready(function(){

/*-----------------------------------------------------------------------------------*/
/* Author Scroller Carousel */
/*-----------------------------------------------------------------------------------*/	

	if(jQuery( '#author-sorter ul li a' ).length > 8){
		jQuery('#author-sorter ul').jcarousel({
	    	visible: 8,
	    	wrap: 'both'
	    });	
	}
/*-----------------------------------------------------------------------------------*/
/* Author Scroller Open/Close */
/*-----------------------------------------------------------------------------------*/

	var pagination = '#author-sorter ul li a';
	
	jQuery(pagination).click(function() {
		
		if ( jQuery( this ).hasClass( 'noclick' ) ) { return false; }
		
		jQuery( '#author-sorter ul li a' ).addClass( 'noclick' );
				
		var slidesHolder = jQuery('#author-slides-holder');
		var pag = jQuery( this );	
		
		if( !slidesHolder.hasClass('open') ){
			
			slidesHolder.addClass('open');
			
		}	
		
		//Show the loader
		woo_show_loader(slidesHolder);
		jQuery( '.author-slides-container' ).slideUp('slow', function() {
			
			
			//Make the call to get the author slider	
			jQuery.post(
				the_ajax_script.ajaxurl, 
				{ 
					'action': 'author_slider' , 
					'author_id' : pag.attr("id"),
					'ajax_author_slider_nonce' : the_ajax_script.author_slider_nonce
				} ,
				function(author_slider_response){
				
					jQuery(pag).find('.author_loading').hide();
					
					// Remove now class from previous elements
					jQuery('#author-sorter ul li').each(function(index) {
					    jQuery( this ).removeClass( 'now' );
					})
					
					//Add now class to clicked link
					pag.parent().addClass( 'now' );
					
					//Add the content into the container
					jQuery( '.author-slides-container' ).html( author_slider_response );
					
					//Slide back down
					woo_remove_loader( slidesHolder );
					jQuery( '.author-slides-container' ).slideDown( 'slow', 0 , function(){
						
						jQuery( '#author-sorter ul li a' ).removeClass( 'noclick' );
					});
										
				}
				
			);
		});
		
		return false;
		
	});
	
}); // End jQuery()	


/*-----------------------------------------------------------------------------------
  - function woo_show_loader()
-----------------------------------------------------------------------------------*/
function woo_show_loader( slidesHolder ){

    jQuery(slidesHolder).css('background' , '#eee');
    jQuery('.author_slide_loading').show();
}// End woo_show_loader()

/*-----------------------------------------------------------------------------------
  - function woo_remove_loader()
-----------------------------------------------------------------------------------*/
function woo_remove_loader( slidesHolder ){
	jQuery('.author_slide_loading').hide();
}// End woo_show_loader()	