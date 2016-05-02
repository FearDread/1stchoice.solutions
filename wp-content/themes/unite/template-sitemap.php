<?php
/*
Template Name: Sitemap
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
	            
	            	<h3><?php _e('Pages', 'woothemes') ?></h3>
	
	            	<ul>
	           	    	<?php wp_list_pages('depth=0&sort_column=menu_order&title_li=' ); ?>		
	            	</ul>				
	    
		            <h3><?php _e('Categories', 'woothemes') ?></h3>
	
		            <ul>
	    	            <?php wp_list_categories('title_li=&hierarchical=0&show_count=1') ?>	
	        	    </ul>
			        
			        <h3>Posts per category</h3>
			        
			        <?php
			    
			            $cats = get_categories();
			            foreach ($cats as $cat) {
			    
			            query_posts('cat='.$cat->cat_ID);
			
			        ?>
	        
	        		<h4><?php echo $cat->cat_name; ?></h4>
						
			       	<ul>	
	    	       	    <?php while (have_posts()) : the_post(); ?>
	            	    <li style="font-weight:normal !important;"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a> - <?php _e('Comments', 'woothemes') ?> (<?php echo $post->comment_count ?>)</li>
	            		    <?php endwhile;  ?>
			       	</ul>
	    
	    		    <?php } ?>
	    		
	    		</div><!-- /.entry -->
            	
            </div><!-- /.middle -->
                
            <div class="fix"></div>
                
      	</div><!-- /.post -->
		
	</div><!-- /#main -->
        
<?php get_sidebar(); ?>

<?php get_footer(); ?>	