<?php get_header(); ?>

	<div id="main" class="col-left">
		           
            <?php if (have_posts()) : $count = 0; ?>
            <?php while (have_posts()) : the_post(); $count++; ?>
                                                                        
            <div class="post page">
            
            	<div class="icon">
            	</div><!-- /.icon -->
            	
            	<div class="middle">
            	                
          		    <h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
          		    
          		    <div class="entry">
                  		<?php the_content(); ?>
                	</div>
            	
            	</div><!-- /.middle -->
                
                <div class="fix"></div>
                
            </div><!-- /.post -->
                
                <?php if ('open' == $post->comment_status) : ?>
	                <?php comments_template(); ?>
				<?php endif; ?>
                                                    
			<?php endwhile; else: ?>
		
				<div class="post page">
            
           			<div class="icon">
           			</div><!-- /.icon -->
            	
           			<div class="middle">
            	            	    
       				    <h2 class="title"><?php _e('Error 404 - Page not found!', 'woothemes') ?></h2>
        				<p><?php _e('Sorry, no posts matched your criteria.', 'woothemes') ?></p>
            	
          	 		</div><!-- /.middle -->
                
          			<div class="fix"></div>
                
      			</div><!-- /.post -->
          
            <?php endif; ?>  
		
	</div><!-- /#main -->
        
<?php get_sidebar(); ?>
    
<?php get_footer(); ?>	