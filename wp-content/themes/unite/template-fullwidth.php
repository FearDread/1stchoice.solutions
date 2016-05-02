<?php
/*
Template Name: Full Width
*/
?>
<?php get_header(); ?>

	<div id="main" class="col-left">
         
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                                                        
		<div class="post fullwidth">
            
        	<div class="icon">
            </div><!-- /.icon -->
            	
            <div class="middle">
            	
            	<?php woo_get_image('image',$GLOBALS['thumb_w'],$GLOBALS['thumb_h'],'thumbnail '.$GLOBALS['thumb_align']); ?> 
            	
    		    <h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
    		    
    		    <div class="entry">
    	  			<?php the_content(); ?>
    			</div>
            	
            </div><!-- /.middle -->
                
            <div class="fix"></div>
                
      	</div><!-- /.post -->
		
		<?php endwhile; endif; ?>
		
	</div><!-- /#main -->
    
<?php get_footer(); ?>	