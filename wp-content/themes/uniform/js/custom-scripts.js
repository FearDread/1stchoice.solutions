jQuery(document).ready(function(){
   jQuery(".search-main i").click(function(){
   		jQuery(".search-form-main").slideToggle('slow');
   });
   
   jQuery('#testimonials-slider .bx-slider').bxSlider({
        adaptiveHeight: true,
        pager:false,
   });
   
   jQuery('#site-navigation .menu-toggle').click(function(){
        jQuery("#site-navigation .main-menu-wrapper").slideToggle('slow');
   });
   
   	jQuery('#site-navigation .main-menu-wrapper .menu-item-has-children').append('<span class="sub-toggle"> <i class="fa fa-angle-right"></i> </span>');

	jQuery('#site-navigation .main-menu-wrapper .sub-toggle').click(function() {
		jQuery(this).parent('.menu-item-has-children').children('ul.sub-menu').first().slideToggle('1000');
		jQuery(this).children('.fa-angle-right').first().toggleClass('fa-angle-down');
	});
    
    // Scroll To Top
    jQuery(window).scroll(function () {
        if (jQuery(this).scrollTop() > 200) {
            jQuery('.scrollup').fadeIn();
        } else {
            jQuery('.scrollup').fadeOut();
        }
    });

    jQuery('.scrollup').click(function () {
        jQuery("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });
});