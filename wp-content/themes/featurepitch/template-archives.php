<?php
/*
Template Name: Archives Page
*/
?>

<?php get_header(); ?>

	<div id="main_content" class="outer">
	
		<div class="inner">
		
			<div id="content">
				
				<?php if ( get_option( 'woo_breadcrumbs' ) == 'true') { yoast_breadcrumb('<div id="breadcrumb"><p>','</p></div>'); } ?>
				
				<div id="archives">
				
                <div class="block">
                    <h2><?php _e('The Last 30 Posts', 'woothemes' ); ?></h2>
        
                    <ul>
                        <?php query_posts('showposts=30'); ?>
                        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                            <?php $wp_query->is_home = false; ?>
                            <li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a> - <?php the_time('j F Y') ?> - <?php echo $post->comment_count ?> <?php _e('comments', 'woothemes' ); ?></li>
                        
                        <?php endwhile; endif; ?>	
                    </ul>				
                </div><!-- /block -->
                
                <div class="block">
            
                    <h2><?php _e('Categories', 'woothemes' ); ?></h2>
        
                    <ul>
                        <?php wp_list_categories('title_li=&hierarchical=0&show_count=1') ?>	
                    </ul>	
                </div><!-- /block -->

                <div class="block">
                    <h2><?php _e('Monthly Archives', 'woothemes' ); ?></h2>
        
                    <ul>
                        <?php wp_get_archives('type=monthly&show_post_count=1') ?>	
                    </ul>				
                </div><!-- /block -->             
			
				<div class="clear"></div>
					
				</div><!-- /#posts -->
					
			</div><!-- /#content -->
			
			<?php get_sidebar(); ?>
			
			<div class="clear"></div>
			
		</div><!-- /.inner -->
	
	</div><!-- /#main_content .outer -->
			
<?php get_footer(); ?>