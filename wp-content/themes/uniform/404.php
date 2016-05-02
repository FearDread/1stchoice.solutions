<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Uniform
 */

get_header(); ?>
<div class="mt-container">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

    			<section class="error-404 not-found">
                     <div class="number-404"><?php echo esc_attr( '404', 'uniform' );?></div>
                     <div class="not-found-text"><?php echo esc_attr( 'Page Not found', 'uniform' ); ?></div>
                     <div class="looks-text"> <?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'uniform' ); ?> </div>
     			</section><!-- .error-404 -->
		</main><!-- #main -->
	</div><!-- #primary -->
    
<?php uniform_sidebar_select(); ?>
</div>
<?php get_footer(); ?>
