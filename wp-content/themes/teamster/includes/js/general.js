/*-------------------------------------------------------------------------------------

FILE INFORMATION

Description: JavaScript on the "Teamster" WooTheme.
Date Created: 2011-10-12.
Author: Tiago, Matty, Warren.
Since: 1.0.0


TABLE OF CONTENTS

- Add rel="lightbox" to image links if the lightbox is enabled
- Add alt-row styling to tables
- Author Scroller Open/Close
- Detect and adjust the heights of the main columns to match

- Superfish navigation dropdown
- clearText() - Clear Comment Form.

-------------------------------------------------------------------------------------*/

jQuery(document).ready(function(){

/*-----------------------------------------------------------------------------------*/
/* Add rel="lightbox" to image links if the lightbox is enabled */
/*-----------------------------------------------------------------------------------*/

if ( jQuery( 'body' ).hasClass( 'has-lightbox' ) && ! jQuery( 'body' ).hasClass( 'portfolio-component' ) ) {
	jQuery( 'a[href$=".jpg"], a[href$=".jpeg"], a[href$=".gif"], a[href$=".png"]' ).each( function () {
		var imageTitle = '';
		if ( jQuery( this ).next().hasClass( 'wp-caption-text' ) ) {
			imageTitle = jQuery( this ).next().text();
		}
		
		jQuery( this ).attr( 'rel', 'lightbox' ).attr( 'title', imageTitle );
	});
	
	jQuery( 'a[rel^="lightbox"]' ).prettyPhoto();
}

/*-----------------------------------------------------------------------------------*/
/* Add alt-row styling to tables */
/*-----------------------------------------------------------------------------------*/

	jQuery( '.entry table tr:odd').addClass( 'alt-table-row' );

}); // End jQuery()

jQuery( window ).load( function () {

/*-----------------------------------------------------------------------------------*/
/* Detect and adjust the heights of the main columns to match */
/*-----------------------------------------------------------------------------------*/

	// Detect the heights of the two main columns.
	
	var content;
	content = jQuery( '#main' );
	
	var contentHeight = content.height();
	
	var sidebar;
	sidebar = jQuery( '#sidebar' );
	
	var sidebar_primary;
	sidebar_primary = jQuery( '.primary' );
	
	var sidebarHeight = sidebar.height();
	
	// Determine the ideal new sidebar height.
	
	var newSidebarHeight;
	var contentPadding;
	var sidebarPadding;
	
	contentPadding = parseInt( content.css( 'padding-top' ) ) + parseInt( content.css( 'padding-bottom' ) );
	sidebarPadding = parseInt( sidebar.css( 'padding-top' ) ) + parseInt( sidebar.css( 'padding-bottom' ) );
	
	if( contentHeight < sidebarHeight ) {
	
		content.height( sidebarHeight + sidebarPadding );
		sidebar.height( sidebarHeight + contentPadding );
		sidebar_primary.height( sidebarHeight + contentPadding );
	
	} // End IF Statement
	
	if( contentHeight > sidebarHeight ) {
	
		sidebar.height( contentHeight + contentPadding );
		sidebar_primary.height( contentHeight + contentPadding );
		content.height( contentHeight );
	
	} // End IF Statement

}); // End jQuery()

/*-----------------------------------------------------------------------------------*/
/* Superfish navigation dropdown */
/*-----------------------------------------------------------------------------------*/

;(function($){$.fn.superfish=function(op){var sf=$.fn.superfish,c=sf.c,$arrow=$(['<span class="',c.arrowClass,'"> &#187;</span>'].join( '')),over=function(){var $$=$(this),menu=getMenu($$);clearTimeout(menu.sfTimer);$$.showSuperfishUl().siblings().hideSuperfishUl()},out=function(){var $$=$(this),menu=getMenu($$),o=sf.op;clearTimeout(menu.sfTimer);menu.sfTimer=setTimeout(function(){o.retainPath=($.inArray($$[0],o.$path)>-1);$$.hideSuperfishUl();if(o.$path.length&&$$.parents(['li.',o.hoverClass].join( '')).length<1){over.call(o.$path)}},o.delay)},getMenu=function($menu){var menu=$menu.parents(['ul.',c.menuClass,':first'].join( ''))[0];sf.op=sf.o[menu.serial];return menu},addArrow=function($a){$a.addClass(c.anchorClass).append($arrow.clone())};return this.each(function(){var s=this.serial=sf.o.length;var o=$.extend({},sf.defaults,op);o.$path=$( 'li.'+o.pathClass,this).slice(0,o.pathLevels).each(function(){$(this).addClass([o.hoverClass,c.bcClass].join( ' ')).filter( 'li:has(ul)').removeClass(o.pathClass)});sf.o[s]=sf.op=o;$( 'li:has(ul)',this)[($.fn.hoverIntent&&!o.disableHI)?'hoverIntent':'hover'](over,out).each(function(){if(o.autoArrows)addArrow($( '>a:first-child',this))}).not( '.'+c.bcClass).hideSuperfishUl();var $a=$( 'a',this);$a.each(function(i){var $li=$a.eq(i).parents( 'li' );$a.eq(i).focus(function(){over.call($li)}).blur(function(){out.call($li)})});o.onInit.call(this)}).each(function(){var menuClasses=[c.menuClass];if(sf.op.dropShadows&&!($.browser.msie&&$.browser.version<7))menuClasses.push(c.shadowClass);$(this).addClass(menuClasses.join( ' '))})};var sf=$.fn.superfish;sf.o=[];sf.op={};sf.IE7fix=function(){var o=sf.op;if($.browser.msie&&$.browser.version>6&&o.dropShadows&&o.animation.opacity!=undefined)this.toggleClass(sf.c.shadowClass+'-off')};sf.c={bcClass:'sf-breadcrumb',menuClass:'sf-js-enabled',anchorClass:'sf-with-ul',arrowClass:'sf-sub-indicator',shadowClass:'sf-shadow'};sf.defaults={hoverClass:'sfHover',pathClass:'overideThisToUse',pathLevels:1,delay:800,animation:{opacity:'show'},speed:'normal',autoArrows:true,dropShadows:true,disableHI:false,onInit:function(){},onBeforeShow:function(){},onShow:function(){},onHide:function(){}};$.fn.extend({hideSuperfishUl:function(){var o=sf.op,not=(o.retainPath===true)?o.$path:'';o.retainPath=false;var $ul=$(['li.',o.hoverClass].join( ''),this).add(this).not(not).removeClass(o.hoverClass).find( '>ul').hide().css( 'visibility','hidden' );o.onHide.call($ul);return this},showSuperfishUl:function(){var o=sf.op,sh=sf.c.shadowClass+'-off',$ul=this.addClass(o.hoverClass).find( '>ul:hidden').css( 'visibility','visible' );sf.IE7fix.call($ul);o.onBeforeShow.call($ul);$ul.animate(o.animation,o.speed,function(){sf.IE7fix.call($ul);o.onShow.call($ul)});return this}})})(jQuery);

if(jQuery().superfish) {
	jQuery(document).ready(function() {
		jQuery( 'ul.nav').superfish({
			delay: 200,
			animation: {opacity:'show', height:'show'},
			speed: 'fast',
			dropShadows: false
		});
	});
}

/*-----------------------------------------------------------------------------------*/
/* clearText() - Clear Comment Form */
/*-----------------------------------------------------------------------------------*/

function clearText( field ) {

    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;

}