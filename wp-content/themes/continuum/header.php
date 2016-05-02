<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<title><?php woo_title(); ?></title>
<?php woo_meta(); ?>
<?php global $woo_options; ?>

<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'stylesheet_url' ); ?>" media="screen" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php if ( isset( $woo_options['woo_feed_url'] ) && ( $woo_options['woo_feed_url'] != '' ) ) { echo $woo_options['woo_feed_url']; } else { echo get_bloginfo_rss( 'rss2_url' ); } ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php wp_head(); ?>
<?php woo_head(); ?>

</head>

<body <?php body_class(); ?>>
<?php woo_top(); ?>

<div id="wrapper">
	<div id="strip">
		<div class="col-full"></div>
	</div>

	<div id="header">
		<div class="col-full">

			<div id="logo">

			<?php if ( isset( $woo_options['woo_texttitle'] ) && $woo_options['woo_texttitle'] != 'true' ) : $logo = $woo_options['woo_logo']; ?>
	            <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'description' ) ); ?>">
	                <img src="<?php if ( $logo ) { echo $logo; } else { echo get_template_directory_uri(); ?>/images/logo.png<?php } ?>" alt="<?php bloginfo( 'name' ); ?>" />
	            </a>
	        <?php endif; ?>

	        <?php if( is_singular() && ! is_front_page() ) : ?>
	            <span class="site-title"><a href="<?php echo home_url( '/' ); ?>"><?php bloginfo( 'name' ); ?></a></span>
	        <?php else : ?>
	            <h1 class="site-title"><a href="<?php echo home_url( '/' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
	        <?php endif; ?>
	            <span class="site-description"><?php bloginfo( 'description' ); ?></span>

			</div><!-- /#logo -->

			<?php if ( isset( $woo_options['woo_ad_top'] ) && $woo_options['woo_ad_top'] == 'true' ) { ?>
	        <div id="topad">
				<?php if ( $woo_options['woo_ad_top_adsense'] != '' ) { echo stripslashes( $woo_options['woo_ad_top_adsense'] ); ?>

				<?php } else { ?>

					<a href="<?php echo $woo_options['woo_ad_top_url']; ?>"><img src="<?php echo $woo_options['woo_ad_top_image']; ?>" width="468" height="60" alt="advert" /></a>

				<?php } ?>
			</div><!-- /#topad -->
	        <?php } ?>

			<div class="clear"></div>

			<div id="navigation">
				<?php
if ( function_exists( 'has_nav_menu' ) && has_nav_menu( 'primary-menu' ) ) {
	wp_nav_menu( array( 'depth' => 6, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'main-nav', 'menu_class' => 'nav fl', 'theme_location' => 'primary-menu' ) );
} else {
?>
		        <ul id="main-nav" class="nav fl">
					<?php
	if ( isset( $woo_options['woo_custom_nav_menu'] ) and $woo_options['woo_custom_nav_menu'] == 'true' ) {
		if ( function_exists( 'woo_custom_navigation_output' ) )
			woo_custom_navigation_output();

	} else { ?>

			            <?php if ( is_home() or is_front_page() ) $highlight = "page_item current_page_item"; else $highlight = "page_item"; ?>
			            <li class="<?php echo $highlight; ?>"><a href="<?php echo home_url( '/' ); ?>"><?php _e( 'Home', 'woothemes' ); ?></a></li>
			            <?php
		wp_list_pages( 'sort_column=menu_order&depth=6&title_li=&exclude=' );

	}
?>
		        </ul><!-- /#nav -->
		        <?php } ?>

				<div class="search_main fr">
				    <form method="get" class="searchform" action="<?php echo home_url( '/' ); ?>" >
				        <input type="text" class="field" name="s" id="s"  value="<?php esc_attr_e( 'Search...', 'woothemes' ); ?>" onfocus="if (this.value == '<?php esc_attr_e( 'Search...', 'woothemes' ); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php esc_attr_e( 'Search...', 'woothemes' ); ?>';}" />
				        <input type="image" src="<?php echo get_template_directory_uri(); ?>/images/search-btn.png" class="submit" name="submit" />
				    </form>
				    <div class="fix"></div>
				</div>

			</div><!-- /#navigation -->

		</div><!-- /.col-full -->
	</div><!-- /#header -->       