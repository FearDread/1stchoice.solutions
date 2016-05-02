<?php
// File Security Check
if ( ! function_exists( 'wp' ) && ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?><?php
/**
 * Index Template
 *
 * Here we setup all logic and XHTML that is required for the index template, used as both the homepage
 * and as a fallback template, if a more appropriate template file doesn't exist for a specific context.
 *
 * @package WooFramework
 * @subpackage Template
 */
	get_header();
	global $woo_options;
	
	$settings = array(
				'homepage_enable_round_slider' => 'true',
				'homepage_enable_intro_message' => 'true', 
				'homepage_featured_blocks' => 'true', 
				'homepage_enable_blog_posts' => 'true', 
				'homepage_enable_promotion' => 'true', 
				'homepage_enable_featured_products' => 'true'
				);
					
	$settings = woo_get_dynamic_values( $settings );
	?>

    <div id="content" class="col-full">
    
 		<header class="page_title">
			<h1><?php echo $woo_options[ 'woo_homepage_heading' ]; ?></h1>
		</header>

   	<?php woo_main_before(); ?>
    
		<section id="main" class="col-full fullwidth">      
		<?php if ( is_home() && ! dynamic_sidebar( 'homepage' ) ) {
			if ( 'true' == $settings['homepage_enable_intro_message'] ) {
				get_template_part( 'includes/intro-message' );
			}
			if ( 'true' == $settings['homepage_featured_blocks'] ) {
				get_template_part( 'includes/featured-blocks' );
			}

			if ( 'true' == $settings['homepage_enable_blog_posts'] ) {
				get_template_part( 'includes/blog-posts' );
			}

			if ( 'true' == $settings['homepage_enable_promotion'] ) {
				get_template_part( 'includes/promotion' );
			}

    	?>
		<?php } ?>    
		</section><!-- /#main -->
		
		<?php woo_main_after(); ?>

    </div><!-- /#content -->
		
<?php get_footer(); ?>