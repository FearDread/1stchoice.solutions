<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Header Template
 *
 * Here we setup all logic and XHTML that is required for the header section of all screens.
 *
 * @package WooFramework
 * @subpackage Template
 */
 
 global $woo_options, $woocommerce;
 
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php woo_title( '' ); ?></title>
<?php woo_meta(); ?>
<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>" />

<?php
wp_head();
woo_head();

?>
</head>
<body <?php body_class(); ?>>
<?php woo_top(); ?>

<!-- <div id="wrapper"> disabled in demo , enable in live site -->

<?php $cur_page_id = $wp_query->post->ID;  // added for DEMO site, remove on live site
 if($cur_page_id == '320') { echo '<div id="wrapper" class="fullwidth-cover-area">';} else echo '<div id="wrapper">';   // added for DEMO site, remove on live site
?>
   
<div class="top">

    <?php woo_header_before(); ?>
	
	<?php	// following code is for for demo website only. 
	if ( $cur_page_id == '320' ) { 
	add_filter( 'body_class','studio_cover_body_class', 20 ); 	 // added for DEMO site, remove on live site
	?>
	<section class="fullslider">
	<?php echo do_shortcode( '[rev_slider studio-fullwidth]' ); ?>
	</section>
	<?php
	}
	// end of demo website code. 
	?>
	
	<header id="header" class="col-full">
		<?php woo_header_inside(); ?>
	    
		<? studio_last_tweet(); // display latest tweet on top right header ?>
	    <hgroup>
			<span class="nav-toggle"><a href="#navigation">&#9776; <span><?php _e( 'Navigation', 'woothemes' ); ?></span></a></span>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</hgroup>

        <?php woo_nav_before(); ?>    

		<nav id="navigation" class="col-full" role="navigation">
			
			<?php
			if ( function_exists( 'has_nav_menu' ) && has_nav_menu( 'primary-menu' ) ) {
				wp_nav_menu( array( 'depth' => 6, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'main-nav', 'menu_class' => 'nav fl', 'theme_location' => 'primary-menu' ) );
			} else {
			?>
	        <ul id="main-nav" class="nav fl">
				<?php if ( is_page() ) $highlight = 'page_item'; else $highlight = 'page_item current_page_item'; ?>
				<li class="<?php echo $highlight; ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e( 'Home', 'woothemes' ); ?></a></li>
				<?php wp_list_pages( 'sort_column=menu_order&depth=6&title_li=&exclude=' ); ?>
			</ul><!-- /#nav -->
	        <?php } ?>
	
		</nav><!-- /#navigation -->
		
		<?php woo_nav_after(); ?>
	
	</header><!-- /#header -->

		<?php woo_header_after(); ?>

	<?php
	// following code is for for demo website only.  Homepage3
	if ( $cur_page_id == '341' ) { ?>
	<section class="wrapp content-parallax">
			<div>
				<img alt="" src="http://templatation.com/demo/studio9/wp-content/themes/studio9/images/homeslider-v4/iphone.png">
                <h1>high quality theme</h1>
                <h2>You can easily apply your own graphics on the screen with the use of smart layers.</h2>
                <div class="readmore-button"><a href="#">Read more</a></div>
			</div>
	</section>
	<?php
	}
	// following code is for for demo website only.  homepage
	elseif ( $cur_page_id == '363' ) { echo do_shortcode( '[studioroundslider category=home]' ); } 
	elseif ( $cur_page_id == '291' ) { echo "<section id='homepage-cover' class='col-full'>" . do_shortcode( '[rev_slider studio9-basic]' ) . "</section>"; } 
	elseif ( $cur_page_id != '320' ) {?> <div class="no-slide"></div> <? }?>
	<?php
	// end of demo website code. 
	//studio_homepage_cover(); // enable on live site. 
	?>

		
</div><!-- /.top -->
	<?php woo_content_before(); ?>