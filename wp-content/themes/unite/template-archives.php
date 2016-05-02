<?php
/*
Template Name: Archives Page
*/
?>

<?php get_header(); ?>

	<div id="main" class="col-left">
                                                                        
		<div class="post page">
            
        	<div class="icon">
            </div><!-- /.icon -->
            	
            <div class="middle">
            	
            	<?php woo_get_image('image',$GLOBALS['thumb_w'],$GLOBALS['thumb_h'],'thumbnail '.$GLOBALS['thumb_align']); ?> 
                
          	    <h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
          		    
          	    <div class="entry">
	            
	            	<h3><?php _e('The Last 30 Posts', 'woothemes') ?></h3>
																	  
				    <ul>											  
				        <?php query_posts('showposts=30'); ?>		  
				        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				            <?php $wp_query->is_home = false; ?>	  
				            <li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a> - <?php the_time(get_option('date_format')); ?> - <?php echo $post->comment_count ?> <?php _e('comments', 'woothemes') ?></li>
				        <?php endwhile; endif; ?>					  
				    </ul>											  
																	  
				    <h3><?php _e('Categories', 'woothemes') ?></h3>	  
																	  
				    <ul>											  
				        <?php wp_list_categories('title_li=&hierarchical=0&show_count=1') ?>	
				    </ul>											  
				     												  
				    <h3><?php _e('Monthly Archives', 'woothemes') ?></h3>
																	  
				    <ul>											  
				        <?php wp_get_archives('type=monthly&show_post_count=1') ?>	
				    </ul>
	    		
	    		</div><!-- /.entry -->
            	
            </div><!-- /.middle -->
                
            <div class="fix"></div>
                
      	</div><!-- /.post -->
		
	</div><!-- /#main -->
        
<?php get_sidebar(); ?>

<?php get_footer(); ?>	
