jQuery(window).load(function() {
	
	//SET SIDEBAR HEIGHT
	
	var window = jQuery(document).height();
	var sidebar = jQuery('#sidebar').height();
	var main = jQuery('#main').height();
	if(sidebar < main){
		jQuery('#sidebar').height(main);
	}
	
});

jQuery(document).ready(function() {
	
	//Hide ajax loader
	jQuery('#ajax-loader').hide();
	
	//SET SIDEBAR HEIGHT
	
	var window = jQuery(document).height();
	var sidebar = jQuery('#sidebar').height();
	var main = jQuery('#main').height();
	
	if(sidebar < main){
		jQuery('#sidebar').height(main);
	}
	
	//SOCIAL PROFILES WIDGET
	
	jQuery('#social li:odd').css('background-color','#4f8fbf');
	
	//CHAT POST LI STYLING
	
	
	jQuery('.post.chat .media ul li:odd').css('background-color','#d9d7bd').css('text-align','right');
	jQuery('.post.chat .media ul li:odd .name').css('padding','0 0 0 10px');
	jQuery('.post.chat .media ul li:even .name').css('padding','0 10px 0 0');
	
	//COMMENTFORM
	
	var author = jQuery('#commentform #author').val();
	var email = jQuery('#commentform #email').val();
	var url = jQuery('#commentform #url').val();
	
	if (author == '') { jQuery('#commentform #author').val('Your Name') };
	if (email == '') { jQuery('#commentform #email').val('Your Email') };
	if (url == '') { jQuery('#commentform #url').val('Your URL') };
	
	jQuery('#commentform p.subscribe-to-comments label').text('Receive Updates?');
	
	//BLUR AND FOCUS FUNCTIONS
	//author focus
	jQuery('#commentform #author').focus(function() {
	
		var val = jQuery(this).val();
	
		if(val == 'Your Name'){	jQuery(this).val(''); }
	
	});
	//author blur
	jQuery('#commentform #author').blur(function() {
	
		var val = jQuery(this).val();
	
		if(val == ''){	jQuery(this).val('Your Name'); }
	
	});
	//email focus
	jQuery('#commentform #email').focus(function() {
	
		var val = jQuery(this).val();	
		if(val == 'Your Email'){ jQuery(this).val(''); }
	
	});
	//email blur
	jQuery('#commentform #email').blur(function() {
	
		var val = jQuery(this).val();	
		if(val == ''){ jQuery(this).val('Your Email'); }
	
	});
	//url focus
	jQuery('#commentform #url').focus(function() {
	
		var val = jQuery(this).val();	
		if(val == 'Your URL'){ jQuery(this).val(''); }
	
	});
	//url blur
	jQuery('#commentform #url').blur(function() {
	
		var val = jQuery(this).val();	
		if(val == ''){ jQuery(this).val('Your URL'); }
	
	});
	
	//KEYCHANGE EVENTS
	
	//onchange event for comments message area
	jQuery('#comment').keyup(function(event) {
		var success = false;
		var code = (event.keyCode ? event.keyCode : event.which);
		//@ Keypress
   		if (code.toString() == '50') {
   			//code here
   			//display list of commenters and allow user to choose them
   			jQuery('#comment-author-hidden').val('@').focus();
			//simulate keydown stroke
			e = jQuery.Event("keydown");
			e.which = 40 ;
			jQuery("#comment-author-hidden").trigger(e);
			
   			success = true;
   		}
		//update the comment preview div
   		else { 
   			updatePreviewComment();
   			updatePreviewGravatar();
   			success = true; 
   		}
		var hoverdisplay = jQuery('div.ac_results').css('display');
		if (hoverdisplay == undefined) { 
			//Do Nothing
		} else if (hoverdisplay == 'block') { 
			if (jQuery('#close-authors').length > 0) {
			
			} else {
				jQuery('div.ac_results').append('<a id="close-authors" title="Submit Comment" style="">Close</a>');
			}
		} else {
			//do nothing
			if (jQuery('#close-authors').length > 0) {
			
			} else {
				jQuery('div.ac_results').append('<a id="close-authors" title="Submit Comment" style="">Close</a>');
			}
		}
		return success;
	});
	
	//onchange event for comments message area
	jQuery('#author').keyup(function(event) {
		var success = false;
		var code = (event.keyCode ? event.keyCode : event.which);
		//update the comment preview div	
		updatePreviewComment();
   		updatePreviewGravatar();
   		success = true; 
   		return success;
	});
	
	//onchange event for comments message area
	jQuery('#comment-author-hidden').keydown(function(event) {
		var success = false;
		var code = (event.keyCode ? event.keyCode : event.which);
		success = true; 
   		return success;
	});
	
		
	//onchange event for comments message area
	jQuery('#url').keyup(function(event) {
		var success = false;
		var code = (event.keyCode ? event.keyCode : event.which);
		//update the comment preview div	
		updatePreviewComment();
   		updatePreviewGravatar();
   		success = true; 
   		return success;
	});
	
	//onchange event for comments email area
	jQuery('#email').keyup(function(event) {
		var success = false;
		var code = (event.keyCode ? event.keyCode : event.which);
		//update the comment preview div	
		updatePreviewComment();
   		updatePreviewGravatar();
   		success = true; 
   		return success;
	});
	
	//custom cancel function - based on wordpress built in js
	jQuery('#custom-cancel-reply').live('click', function () {
		var t = addComment, temp = t.I('wp-temp-form-div'), respond = t.I(t.respondId);
		if ( ! temp || ! respond )
			return;
		t.I('comment_parent').value = '0';
		temp.parentNode.insertBefore(respond, temp);
		temp.parentNode.removeChild(temp);
		//hide elements
		jQuery('#cancel-comment-reply-link').attr('style', "display:none;");
		jQuery('#custom-cancel-reply').attr('style', 'display:none;');
		jQuery('#cancel-comment-reply-link').onclick = null;
		//remove preview
		jQuery('#li-comment-XXXX').each(function() {
			jQuery('#li-comment-XXXX').remove();
		});
		jQuery('#respond').attr('style','display:none;');
		jQuery('#close-authors').click();
		return false;
	});

	//reply click event - live for ajax added reply buttons
	jQuery('.comment-reply-link').live('click', function () {
		jQuery('#respond').attr('style','');
		//remove preview
		jQuery('#li-comment-XXXX').each(function() {
			jQuery('#li-comment-XXXX').remove();
		});
		jQuery('#custom-cancel-reply').attr('style', '');
		//check for child ul
		var parent_id = jQuery(this).parent().parent().parent().parent().attr('id');
		if (jQuery('#' + parent_id + ' ul.children').length > 0) {
			//do nothing
		} else {
			jQuery('#' + parent_id).append('<ul class="children"></ul>');
		}
		//output preview
		outputPreviewComment('#' + parent_id + ' ul.children');
	});

	//click event to close the author hover
	jQuery('#close-authors').live('click', function () {
	
		jQuery('div.ac_results').remove();
		var sourcearray = new Array();
				
				jQuery('span.name a.url').each(function(){
					sourcearray.push('@' + jQuery(this).text());
				});
				
				sourcearray = unique(sourcearray);
				sourcearray.sort(charOrdA);
				
				jQuery("#comment-author-hidden").autocomplete(sourcearray);
		
	});
	
	//outputs comment preview div
	function updatePreviewComment() {
	
		var currentCommentText = jQuery('#comment').val().replace(/\n/g, "<br />").replace(/\n\n+/g, '<br /><br />').replace(/(<\/?)script/g,"$1noscript");
   		var currentCommentAuthor = jQuery('#author').val();
   		var currentURLText = jQuery('#url').val();
   		if (!(currentURLText=='') && !(currentURLText=='http://yoururl/') && !(currentURLText=='http://yoururl') && !(currentURLText=='your url') && !(currentURLText=='Your URL')) {
   			jQuery('#li-comment-XXXX span.name a.url').attr('href',currentURLText);
   		} else {
   			jQuery('#li-comment-XXXX span.name a.url').removeAttr('href');
   		}
   		jQuery('#li-comment-XXXX span.name a.url').text(currentCommentAuthor);
		jQuery('#comment-XXXX span.comment-content').html(currentCommentText);
	}
});