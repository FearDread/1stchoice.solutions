jQuery(document).ready(function() {

// Remove Borders from li's ,etc...

jQuery("#nav li ul li:last-child").css("border-bottom","0");

// Equal heights for the footer panels (left and right)

var footer_left;
footer_left = jQuery("#about").height();

var footer_right;
footer_right = jQuery("#contact").height();

	if(footer_left > footer_right){
		jQuery('#contact').height(footer_left);
	}
	else if(footer_right > footer_left){
		jQuery('#about').height(footer_right - 40);						
	};

});