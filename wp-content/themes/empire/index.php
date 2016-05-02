<?php get_header(); ?>
<?php global $woo_options; ?>

	<?php if ( isset($woo_options[ 'woo_slider' ]) && ($woo_options[ 'woo_slider' ] == 'true') && is_home() ) get_template_part( 'includes/featured' ); ?>

    <div id="content" class="col-full">
		<div id="main" class="col-full">    
		     
		    <!-- Optional page insert #1 --> 
        	<?php if ( isset($woo_options['woo_main_page1']) && $woo_options['woo_main_page1'] <> "Select a page:" ) { ?>
        	<div id="main-page1" class="entry">
				<?php query_posts('pagename=' . $woo_options['woo_main_page1']); ?>
        	    <?php if (have_posts()) : the_post(); ?>		        					
			    <?php the_content(); ?>
        	    <?php endif; ?>
        	    <div class="fix"></div>
        	</div><!-- /#main-page1 -->
        	<?php } ?>
        	<!-- /Optional page insert #1 --> 
                        
			<div id="home-widgets">
				
				
			    <div class="home-left">
				    <?php if ( woo_active_sidebar( 'home-left' ) ) : ?>
						<?php woo_sidebar( 'home-left' ); ?>
					<?php endif; ?>							           
				</div>        

			    <div class="home-center">
				    <?php if ( woo_active_sidebar( 'home-center' ) ) : ?>
						<?php woo_sidebar( 'home-center' ); ?>
					<?php endif; ?>							           
				</div>        

			    <div class="home-right">
				    <?php if ( woo_active_sidebar( 'home-right' ) ) : ?>
						<?php woo_sidebar( 'home-right' ); ?>
					<?php endif; ?>							           
				</div>        
				
				<div class="fix"></div>
			
			</div><!-- /#home-widgets -->
            
            <!-- Optional page insert #2 --> 
        	<?php if ( isset($woo_options['woo_main_page2']) && $woo_options['woo_main_page2'] <> "Select a page:" ) { ?>
        	<div id="main-page2" class="entry">
				<?php query_posts('pagename=' . $woo_options['woo_main_page2']); ?>
        	    <?php if (have_posts()) : the_post(); ?>		        					
			    <?php the_content(); ?>
        	    <?php endif; ?>
        	    <div class="fix"></div>
        	</div><!-- /#main-page1 -->
        	<?php } ?>
        	<!-- /Optional page insert #2 --> 
        	    
		</div><!-- /#main -->

    </div><!-- /#content -->
		
<?php get_footer(); ?>