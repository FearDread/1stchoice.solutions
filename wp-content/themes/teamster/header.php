<?php
/**
 * Header Template
 *
 * Here we setup all logic and XHTML that is required for the header section of all screens.
 *
 */
 global $woo_options;
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php woo_title(); ?></title>
<?php woo_meta(); ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'stylesheet_url' ); ?>" media="screen" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php wp_head(); ?>
<?php woo_head(); ?>

</head>

<body <?php body_class(); ?>>
<?php woo_top(); ?>

<div id="wrapper" class="col-full">

	<?php if ( function_exists( 'has_nav_menu') && has_nav_menu( 'top-menu' ) ) { ?>

	<div id="top">
		<div class="col-full">
			<?php wp_nav_menu( array( 'depth' => 6, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'top-nav', 'menu_class' => 'nav fl', 'theme_location' => 'top-menu' ) ); ?>
		</div>
	</div><!-- /#top -->

    <?php } ?>

	<div id="header" class="col-full">

		<div id="header-left">
		
			<div id="logo">
	
			<?php if ($woo_options['woo_texttitle'] != 'true' ) : $logo = $woo_options['woo_logo']; ?>
				<a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo( 'description' ); ?>">
					<img src="<?php if ($logo) echo $logo; else { echo get_template_directory_uri(); ?>/images/logo.png<?php } ?>" alt="<?php bloginfo( 'name' ); ?>" />
				</a>
	        <?php endif; ?>
	
	        <?php if( is_singular() && !is_front_page() ) : ?>
				<span class="site-title"><a href="<?php echo home_url( '/' ); ?>"><?php bloginfo( 'name' ); ?></a></span>
	        <?php else : ?>
				<h1 class="site-title"><a href="<?php echo home_url( '/' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
	        <?php endif; ?>
				<span class="site-description"><?php bloginfo( 'description' ); ?></span>
	
			</div><!-- /#logo -->
		
		</div><!-- /#header-left -->

        <div id="header-right">
        
        	<div id="tagline"><p><?php bloginfo( 'description' ); ?></p></div><!-- /#tagline -->
        	
        	<div id="social-top">
        		<ul>
					<li><a href="<?php if ( $woo_options['woo_feed_url'] ) { echo $woo_options['woo_feed_url']; } else { echo get_bloginfo_rss('rss2_url'); } ?>" title="<?php _e('Subscribe','woothemes'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/ico-top-rss.png" alt="" /></a></li>
					<?php if ($woo_options['woo_social_dribbble']): ?><li><a href="<?php echo $woo_options['woo_social_dribbble']; ?>" title="Dribbble"><img src="<?php bloginfo('template_directory'); ?>/images/ico-top-dribbble.png" alt="" /></a></li><?php endif; ?>
					<?php if ($woo_options['woo_social_twitter']): ?><li><a href="<?php echo $woo_options['woo_social_twitter']; ?>" title="Twitter"><img src="<?php bloginfo('template_directory'); ?>/images/ico-top-twitter.png" alt="" /></a></li><?php endif; ?>
					<?php if ($woo_options['woo_social_facebook']): ?><li><a href="<?php echo $woo_options['woo_social_facebook']; ?>" title="Facebook"><img src="<?php bloginfo('template_directory'); ?>/images/ico-top-facebook.png" alt="" /></a></li><?php endif; ?>
				</ul>        	

        	</div><!-- /#social-top -->
        	
			<div id="navigation">
			
				<?php
				if ( function_exists( 'has_nav_menu') && has_nav_menu( 'primary-menu') ) {
					wp_nav_menu( array( 'depth' => 6, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'main-nav', 'menu_class' => 'nav fl', 'theme_location' => 'primary-menu' ) );
				} else {
				?>
			    <ul id="main-nav" class="nav fl">
					<?php
			    	if ( isset($woo_options[ 'woo_custom_nav_menu' ]) AND $woo_options[ 'woo_custom_nav_menu' ] == 'true' ) {
			    		if ( function_exists( 'woo_custom_navigation_output') )
							woo_custom_navigation_output();
					} else { ?>
			            <?php if ( is_page() ) $highlight = "page_item"; else $highlight = "page_item current_page_item"; ?>
			            <li class="<?php echo $highlight; ?>"><a href="<?php echo home_url( '/' ); ?>"><?php _e( 'Home', 'woothemes' ) ?></a></li>
			            <?php
			    			wp_list_pages( 'sort_column=menu_order&depth=6&title_li=&exclude=' );
					}
					?>
			    </ul><!-- /#nav -->
			    <?php } ?>
			
				<div class="fix"></div>
			
			</div><!-- /#navigation -->
						
		</div><!-- /#header-right -->
		
	</div><!-- /#header -->