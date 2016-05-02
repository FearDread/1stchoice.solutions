<?php
/**
 * Template Name: Sitemap
 *
 * The sitemap page template displays a user-friendly overview
 * of the content of your website.
 *
 * @package WooFramework
 * @subpackage Template
 */

 global $woo_options; 
 get_header();
?>      
    <!-- #content Starts -->
	<?php woo_content_before(); ?>
    <div id="content" class="col-full">

    	<div id="main-sidebar-container">

            <!-- #main Starts -->
            <?php woo_main_before(); ?>
            <div id="main">      
                                                                                
				<?php woo_loop_before(); ?>
                <!-- Post Starts -->
                <?php woo_post_before(); ?>
                <div class="post">
                
                    <?php woo_post_inside_before(); ?>
    
                    <h1 class="title"><?php the_title(); ?></h1>
                    
                    <div class="entry">
                    
                        <h3><?php _e( 'Pages', 'woothemes' ); ?></h3>
                        <ul>
                            <?php wp_list_pages( 'depth=0&sort_column=menu_order&title_li=' ); ?>		
                        </ul>				
            
                        <h3><?php _e( 'Categories', 'woothemes' ); ?></h3>
                        <ul>
                            <?php wp_list_categories( 'title_li=&hierarchical=0&show_count=1' ); ?>	
                        </ul>
                        
                        <h3><?php _e( 'Posts per category', 'woothemes' ); ?></h3>
                        <?php $saved = $wp_query;
                            $cats = get_categories();
                            foreach ($cats as $cat) {
                            query_posts('cat='.$cat->cat_ID);
                        ?>
                            <h4><?php echo $cat->cat_name; ?></h4>
                            <ul>	
                                <?php while (have_posts()) : the_post(); ?>
                                <li style="font-weight:normal !important;"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> - <?php _e( 'Comments', 'woothemes' ); ?> (<?php echo $post->comment_count ?>)</li>
                                <?php endwhile;  ?>
                            </ul>
            
                        <?php } $wp_query = $saved; ?>
                    
                    </div><!-- /.entry -->
                                    
                    <?php woo_post_inside_after(); ?>
    
                </div><!-- /.post -->
                <?php woo_post_after(); ?>
                <div class="fix"></div>                
                                                                
            </div><!-- /#main -->
            <?php woo_main_after(); ?>
    
            <?php get_sidebar(); ?>

		</div><!-- /#main-sidebar-container -->         

		<?php get_sidebar( 'alt' ); ?>

    </div><!-- /#content -->
	<?php woo_content_after(); ?>
		
<?php get_footer(); ?>