<?php
/**
 * Template Name: Portfolio Two col
 *
 * This template is a full-width version of the page.php template file. It removes the sidebar area.
 *
 * @package WooFramework
 * @subpackage Template
 */
    get_header();
    global $woo_options;
?>
       
    <div id="content" class="page col-full">
        
        <section id="portfolio-gallery">            
        
        <?php if ( have_posts() ) : $count = 0; ?>                                                           
            <article <?php post_class(); ?>>

               <?php $image_size = 454; $port_image_height = 269; $port_type = "one-two";// set thumb dimensions for 2 column portfolio ?>
                <?php get_template_part( 'loop', 'portfolio' ); ?>
        
                <?php edit_post_link( __( '{ Edit }', 'woothemes' ), '<span class="small">', '</span>' ); ?>
                
            </article><!-- /.post -->
            
        <?php else : ?>
            <article <?php post_class(); ?>>
                <p><?php _e( 'Sorry, no posts matched your criteria.', 'woothemes' ); ?></p>
            </article><!-- /.post -->
        <?php endif; ?>  
        
        </section><!-- /#portfolio-gallery -->
        
        <?php woo_main_after(); ?>
        
    </div><!-- /#content -->
        
<?php get_footer(); ?>