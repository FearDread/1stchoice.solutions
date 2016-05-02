<?php
/*
Template Name: Image Gallery
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
	            
	            	<?php query_posts('showposts=60'); ?>
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>				
                    <?php $wp_query->is_home = false; ?>

                    <?php woo_get_image('image',110,110,'thumbnail alignleft'); ?>
                
                <?php endwhile; endif; ?>
	    		
	    		</div><!-- /.entry -->
            	
            </div><!-- /.middle -->
                
            <div class="fix"></div>
                
      	</div><!-- /.post -->
		
	</div><!-- /#main -->
        
<?php get_sidebar(); ?>
    
<?php get_footer(); ?>	