jQuery(document).ready(function($){
    "use strict";
    
    /**
     * Script for switch option
     */
    $('.switch_options').each(function() {
        //This object
        var obj = $(this);

        var enb = obj.children('#switch_1'); //cache first element, this is equal to ON
        var dsb = obj.children('#switch_2'); //cache first element, this is equal to OFF
        var input = obj.children('input'); //cache the element where we must set the value
        var input_val = obj.children('input').val(); //cache the element where we must set the value
        var checkedValFirst = obj.children('#switch_1').attr('class');
        var firstVal = checkedValFirst.split('_');
        var checkedValSecond = obj.children('#switch_2').attr('class');
        var secondVal = checkedValSecond.split('_');
        //alert(firstVal);
        //alert(checkedValSecond);

        /* Check selected */
        if (secondVal[1] == input_val) {
            dsb.addClass('selected');
        }
        else if (firstVal[1] == input_val) {
            enb.addClass('selected');
        }

        //Action on user's click(ON)
        enb.on('click', function() {
            $(dsb).removeClass('selected'); //remove "selected" from other elements in this object class(OFF)
            $(this).addClass('selected'); //add "selected" to the element which was just clicked in this object class(ON) 
            $(input).val(firstVal[1]).change(); //Finally change the value to 1
        });

        //Action on user's click(OFF)
        dsb.on('click', function() {
            $(enb).removeClass('selected'); //remove "selected" from other elements in this object class(ON)
            $(this).addClass('selected'); //add "selected" to the element which was just clicked in this object class(OFF) 
            $(input).val(secondVal[1]).change(); // //Finally change the value to 0
        });

    });
    
    /**
     * Script for image selected from radio option
     */
     $('.controls#uniform-img-container li img').click(function(){
		$('.controls#uniform-img-container li').each(function(){
			$(this).find('img').removeClass ('uniform-radio-img-selected') ;
		});
		$(this).addClass ('uniform-radio-img-selected') ;
	});
    
    /**
     * Theme info
     */
     $('#customize-info .preview-notice').append(
         '<div class="uniform-info">'+
         '<a class="uniform-demo-link" href="http://demo.mysterythemes.com/uniform/" target="_blank">Live Demo</a>'+
         '<a class="uniform-pro-info" href="http://mysterythemes.com/wp-themes/uniform-pro/" target="_blank">Uniform Pro</a>'+
         '<a class="uniform-pro-info" href="http://demo.mysterythemes.com/uniform-pro-landing/" target="_blank">Uniform Pro Demo</a>'+
         '</div>'
    );
});