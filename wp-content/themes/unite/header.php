<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">

<title><?php woo_title(); ?></title>
<?php woo_meta(); ?>

<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/css/effects.css" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php $GLOBALS[feedurl] = get_option('woo_feed_url'); if ( $feedurl ) { echo $feedurl; } else { echo get_bloginfo_rss('rss2_url'); } ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' );  ?>
<?php wp_head(); ?>
<?php woo_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php woo_top(); ?>

<div id="wrapper">

<div class="ribbon">
		
		<div id="logo">
		   
		<?php if (get_option('woo_texttitle') <> "true") { ?>
			<a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('description'); ?>"><img src="<?php if ( get_option('woo_logo') <> "" ) {  echo get_option('woo_logo'); } else { ?><?php bloginfo('template_directory'); ?>/<?php woo_style_path(); ?>/logo.png<?php } ?>" alt="" /></a>
		<?php } else if( is_singular() ) : ?>
		    <span class="site-title"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></span>
		    <span class="site-description"><?php bloginfo('description'); ?></span>
		<?php else : ?>
		    <h1 class="site-title"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
		    <span class="site-description"><?php bloginfo('description'); ?></span>
		<?php endif; ?>   
		  	
		</div><!-- /#logo -->
		
		<div id="navigation">
			<?php
			if ( function_exists('has_nav_menu') && has_nav_menu('primary-menu') ) {
				wp_nav_menu( array( 'depth' => 1, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'nav', 'menu_class' => 'fl', 'theme_location' => 'primary-menu' ) );
			} else {
			?>
	        <ul id="nav" class="fl">
	
			<?php 
	        if ( get_option('woo_custom_nav_menu') == 'true' && function_exists('woo_custom_navigation_output') ) {
	            woo_custom_navigation_output('depth=1');
	
			} else { ?>
	        
	            <?php if (is_page()) { $highlight = "page_item"; } else {$highlight = "page_item current_page_item"; } ?>
	            <li class="<?php echo $highlight; ?>"><a href="<?php bloginfo('url'); ?>"><?php _e('Home', 'woothemes') ?></a></li>
	            <?php 
	    		if (get_option('woo_cat_menu') == 'true') 
	    			wp_list_categories('sort_column=menu_order&depth=1&title_li=&exclude='.get_option('woo_nav_exclude')); 
	            else
	    			wp_list_pages('sort_column=menu_order&depth=6&title_li=&exclude='.get_option('woo_nav_exclude')); 
	    		?>
	
			<?php } ?>
	
	        </ul><!-- /#nav -->
	       <?php } ?>
	        
		</div><!-- /#navigation -->
<div class="clear"></div>
<div style="display: none;">
	<a href="http://w3vina.com" title="W3vina.COM | Joomla, Wordpress, Drupal templates">W3vina.COM</a>
	<a href="http://www.wpdaily.org" title="Wordpress Themes Download">Free Wordpress Themes</a>
	<a href="http://www.joomladaily.org" title="Joomla Templates Download">Joomla Templates</a>
	<a href="http://www.bestwpdaily.com" title="Best Wordpress Themes">Best Wordpress Themes</a>
	<a href="http://www.zinthemes.com" title="Premium Wordpress Themes">Premium Wordpress Themes</a>
	<a href="http://www.topthemesdeal.com" title="Top Best Wordpress Themes">Top Best Wordpress Themes 2012</a>
</div>
<div class="search">
<form method="get" class="searchform" action="<?php bloginfo('url'); ?>" >
				       	 <input type="text" class="field s" name="s" value="<?php _e('Search...', 'woothemes') ?>" onfocus="if (this.value == '<?php _e('Search...', 'woothemes') ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Search...', 'woothemes') ?>';}" />
				    	  <input type="hidden" class="submit" name="submit" value="<?php _e('Search', 'woothemes'); ?>" />
						</form>
		</div><!-- /.search -->
		
</div><!-- /.ribbon -->