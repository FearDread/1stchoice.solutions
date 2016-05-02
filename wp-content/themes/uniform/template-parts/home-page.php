<?php
/**
 * Template Name: Home Page
 *
 * This is the template that display sections in home page.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Uniform
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		
        <!-- Section Slider -->
        <section class="uniform-home-section" id="section-slider">
            <?php get_template_part( 'template-parts/section', 'homesider' ); ?>
        </section>
        
        <!-- section services -->        
		<?php 
			if( get_theme_mod( 'service_section_control', 'enable' ) == 'enable' ) {
				get_template_part( 'template-parts/section', 'services' );
			}
		?>  
		
        <!-- section call to action -->
        <?php if( get_theme_mod( 'call_to_action_option', 'show' ) == 'show' ) { ?>
        <section class="uniform-home-section" id="section-callaction">
            <div class="mt-container">
                <?php
                    if ( is_active_sidebar( 'uniform_call_to_action_area' ) ) {
                    	dynamic_sidebar( 'uniform_call_to_action_area' );
                    }
                ?>      
            </div>
        </section>
        <?php } ?>
        
        <!--Section About -->        
        <?php
            if( get_theme_mod( 'about_section_control', 'enable' ) == 'enable' ) {
				get_template_part( 'template-parts/section', 'about' );
			}
        ?>
        
        <!--Section Latest Blog-->
        <?php
            if( get_theme_mod( 'blog_section_control', 'enable' ) == 'enable' ) {
				get_template_part( 'template-parts/section', 'blog' );
			}
        ?>
        </main><!-- #main -->
	</div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>