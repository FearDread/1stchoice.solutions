<?php
global $woo_options;
$count = 0;
?>
<div id="slides" class="col-full">

	<?php if ( isset($woo_options['woo_featured_title']) && $woo_options['woo_featured_title'] != '' ) { ?><h3><?php echo $woo_options['woo_featured_title']; ?></h3><?php } ?>

	<?php $woo_featured_tags = get_option('woo_featured_tags'); if ( ( $woo_featured_tags != '' ) && (isset($woo_featured_tags)) ) { ?>
    <?php
    	$shownposts = array(); // An array for storing the posts we don't want to display on the homepage (they're in the featured slider already).
		global $shownposts;
		$featposts = 4; // Number of featured entries to be shown
		$feat_tags_array = explode( ',', get_option( 'woo_featured_tags' ) ); // Tags to be shown
		$tag_array = array(); // declare array
        foreach ( $feat_tags_array as $tags ) {
			$tag = get_term_by( 'name', trim( $tags ), 'post_tag', 'ARRAY_A' );
			if ( $tag['term_id'] > 0 ) {
				$tag_array[] = $tag['term_id'];
			}
		}
    ?>
	
		<?php $saved = $wp_query; query_posts( array( 'post_type' => 'post', 'tag__in' => $tag_array, 'showposts' => $featposts, 'suppress_filters' => 0 ) ); ?>
			
		<?php if ( have_posts() ) { $count = 0; ?>
		
		<div id="slides_container" class="col-right">
	
			<?php while ( have_posts() ) { the_post(); ?>
			<?php if ( ! woo_image( 'return=true' ) ) continue; // Skip post if it doesn't have an image ?>
	        <?php $shownposts[] = $post->ID; $count++; ?>
	
			<div class="slide">
	
				<?php woo_image( 'key=image&width=709&height=483' ); ?>
	
				<div class="caption">
				
					<div class="meta">
						<span class="post-meta date"><?php the_time( get_option( 'date_format' ) ); ?></span>
					</div>
					
					<h2 class="title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					
					<div class="entry">
						<p><?php echo woo_text_trim( get_the_excerpt(), 30 ); ?></p>
					</div>
				</div><!-- /.caption -->
	
			</div><!-- /.slide -->
	
			<?php } ?>
	
		</div><!-- /#slides_container -->
		<?php } ?>
		<?php if ( $count > 0 ) { ?>
		<div id="slide-nav" class="pagination col-left">
	
		<?php rewind_posts(); ?>
		<?php if ( have_posts() ) { $count = 0; ?>
			<ul>
				<?php
					while ( have_posts() ) { the_post();
					if ( ! woo_image( 'return=true' ) ) continue; // Skip post if it doesn't have an image
					$team_role = get_the_author_meta( 'teamtitle' );
				?>
					<li>
						<a href="#">
							<?php woo_image( 'key=image&width=250&height=120&link=img' ); ?>
	
							<?php $category = get_the_category(); ?>
							<span class="info">
								<span class="post-meta date"><?php the_time( get_option( 'date_format' ) ); ?></span>
								<span class="title"><?php echo get_the_title(); ?></span>
							</span>
							<span class="rollover">
								<span class="rollover-inside">
									<span class="avatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), '48' ); ?></span>
									<span class="author"><?php _e( 'Written by', 'woothemes' ); ?> <strong><?php the_author(); ?></strong></span>
									<?php if ( $team_role != '' ) { ?><span class="link"><?php echo $team_role; ?></span><?php } ?>
								</span>
							</span>
						</a>
					</li>
				<?php } ?>
			</ul>
		<?php
			}
			$wp_query = $saved;
		?>
		</div><!-- /#slide-nav -->
		<?php } ?>
			
	     <?php } else { ?>
	     	<p class="woo-sc-box info"><?php _e( 'Please setup Featured Panel tag(s) in your options panel. You must setup tags that are used on active posts.', 'woothemes' ); ?></p>
	     <?php } ?>

</div><!-- /#slides -->