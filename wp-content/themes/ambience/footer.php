				</div><!-- End container -->
					
				<div id="footer-columns">
						
					<div class="container">
								
						<ul id="footer-list" class="clearfix">
						
							<li>
								<h5 class="footer-title"><?php _e('Recent Comments',woothemes); ?></h5>
								
									<ul>
										<?php woothemes_get_comments('7', '100'); ?>
									</ul>
							</li><!-- End Recent Comments -->
				
							<li>
								<h5 class="footer-title"><?php _e('Just Added',woothemes); ?></h5>
										
								<ul>
								<?php query_posts('showposts=7'); if (have_posts()) : ?>
							
									<?php while (have_posts()) : the_post(); ?>
									
										<li>
											<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to',woothemes); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
										</li>
											
									<?php endwhile; ?>
										
								<?php endif; ?>
								</ul>
									
							</li><!-- End Just Added -->
						
							<li>
								<h5 class="footer-title"><?php _e('Links',woothemes); ?></h5>
										
								<ul id="footer-links">
									<?php wp_list_bookmarks('categorize=0&title_li=&show_description=1&between= - &limit=8'); ?>
								</ul>
							</li><!-- End Links -->
							
						</ul><!-- End footer-list -->
								
					</div><!-- End container -->
				
				</div><!-- End footer-columns -->		
						
				<div id="footer-repeat">
				
					<div id="footer-copyright">
						
						<div class="container">
						
							<div class="left">
								<?php _e('Copyright',woothemes); ?> &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>
							</div>
							
							<div class="right">
								<?php _e('Powered by',woothemes); ?> <a href="http://wordpress.org" title="<?php _e('Powered By:',woothemes); ?> WordPress">WordPress</a>. <a href="http://www.siteslike.com" title="Similar Websites" class="woothemes">SitesLike</a>
							</div>
						</div><!-- End container -->
						
					</div><!-- End footer-copyright -->
					
				</div><!-- End footer-repeat -->				
		
	</div><!-- End main-back -->
	
	<?php wp_footer(); ?>		
	
	<?php if ( get_option('woo_twitter') ) { ?>
		<script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
		<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/<?php echo get_option('woo_twitter'); ?>.json?callback=twitterCallback2&amp;count=1"></script>
	<?php } ?>
	
</body>
</html>