<?php
/**
 * Loop - Portfolio
 *
 * This is a custom loop file, containing the looping logic for use in the "portfolio" page template, 
 * as well as the "portfolio-gallery" taxonomy archive screens. The custom query is only run on the page
 * template, as we already have the data we need when on the taxonomy archive screens.
 *
 * @package WooFramework
 * @subpackage Template
 */

global $woo_options;
global $more; $more = 0;

/* Setup parameters for this loop. */
/* Make sure we only run our custom query when using the page template, and not in a taxonomy. */

$thumb_width = 207;
$thumb_height = 212;

/* The Variables */
$settings = array(
					'portfolio_enable_pagination' => 'false', 
					'portfolio_posts_per_page' => get_option( 'posts_per_page' ),
					'portfolio_thumb_width'	=>	'',
					'portfolio_thumb_height'	=> '',
					'portfolio_excludenav'	=>	'',
					'portfolio_area_gallery_term' => ''
				);
				
$settings = woo_get_dynamic_values( $settings );

/* Setup array of booleans to make filtering of this setting easier. */
$settings_toggle = array( 'true' => true, 'false' => false );

/* Add toggle for the pagination vs portfolio filter bar. */
$toggle_pagination = apply_filters( 'woo_portfolio_toggle_pagination', $settings_toggle[$settings['portfolio_enable_pagination']] ); // Default: false
$filtering_css_class = 'has-filtering';
if ( $toggle_pagination == true || is_tax( 'portfolio-gallery' ) ) {
	$filtering_css_class = 'no-filtering';
}

/* Make sure our thumbnail dimensions come through from the theme options. */
if ( isset( $settings['portfolio_thumb_width'] ) && ( $settings['portfolio_thumb_width'] != '' ) ) {
	$thumb_width = $settings['portfolio_thumb_width'];
}

if ( isset( $settings['portfolio_thumb_height'] ) && ( $settings['portfolio_thumb_height'] != '' ) ) {
	$thumb_height = $settings['portfolio_thumb_height'];
}

/* Setup portfolio galleries navigation. */
$galleries = array();
$galleries = get_terms( 'portfolio-gallery' );
$exclude_str = '';
$to_exclude = array();
if ( isset( $settings['portfolio_excludenav'] ) && ( $settings['portfolio_excludenav'] != '' ) ) {
	$exclude_str = $settings['portfolio_excludenav'];
}

// Allow child themes/plugins to filter here.
$exclude_str = apply_filters( 'woo_portfolio_gallery_exclude', $exclude_str );

/* Optionally exclude navigation items. */
if ( $exclude_str != '' ) {
	$to_exclude = explode( ',', $exclude_str );
	
	if ( is_array( $to_exclude ) ) {
		foreach ( $to_exclude as $k => $v ) {
			$to_exclude[$k] = str_replace( ' ', '', $v );
		}
		
		/* Remove the galleries to be excluded. */
		foreach ( $galleries as $k => $v ) {
			if ( in_array( $v->slug, $to_exclude ) ) {
				unset( $galleries[$k] );
			}
		}
	}
}

/* Save the current state before we perform a new query. */
$screen_type = 'page';
$archive_title = '';
$current = 'all';
if ( is_post_type_archive() ) { $screen_type = 'post-type-archive'; }
if ( is_tax() ) {
	$screen_type = 'taxonomy';
	$archive_title = '';
	
	$obj = get_queried_object();
	if ( isset( $obj->name ) ) {
		$archive_title = $obj->name;
		$current = $obj->term_id;
	}
}

if ( ! is_tax() ) {

if ( get_query_var( 'page' ) > 1) { $paged = get_query_var( 'page' ); } elseif ( get_query_var( 'paged' ) > 1) { $paged = get_query_var( 'paged' ); } else { $paged = 1; } 
$query_args = array(
				'post_type' => 'portfolio', 
				'paged' => $paged, 
				'posts_per_page' => -1
			);

if ( $toggle_pagination == true ) {
	$query_args['posts_per_page'] = $settings['portfolio_posts_per_page'];
}

/* If we have galleries, make sure we only get items from those galleries. */
if ( count( $galleries ) > 0 ) {

$gallery_slugs = array();
foreach ( $galleries as $g ) { $gallery_slugs[] = $g->slug; }

$query_args['tax_query'] = array(
								array(
									'taxonomy' => 'portfolio-gallery',
									'field' => 'slug',
									'terms' => $gallery_slugs
								)
							);
}

wp_reset_query();

/* The Query. */			   
$the_query = new WP_Query( $query_args );

} // End IF Statement ( is_tax() )

if ( $settings['portfolio_area_gallery_term'] != '' ) {

	// Get the Featured Gallery
	$featured_term = get_term_by('id', $settings['portfolio_area_gallery_term'], 'portfolio-gallery');
	$featured_gallery = '';
	if ($featured_term) {

		$featured_gallery = $featured_term->slug;

		/* Get Featured Posts and move them to the top of the array */
		$temp = $the_query->posts;
		$temp_featured = array();
		$featured_ids = array();

		/* Get Featured Gallery Stuff */
		$featured_args = array(
			'post_type' => 'portfolio', 
			'posts_per_page' => -1,
			'tax_query' => array(
								array(
									'taxonomy' => 'portfolio-gallery',
									'field' => 'slug',
									'terms' => array($featured_gallery)
								)
							)
			);

		// Get featured posts ids
		$featured_query = new WP_Query($featured_args);
		if ( $featured_query->have_posts() ) {
			while( $featured_query->have_posts() ) { $featured_query->the_post();
				$featured_ids[] = $post->ID;
			}
		}

		// run through posts and move them to the top of the list
		foreach ($temp as $k => $v) {
			if ( in_array($v->ID, $featured_ids) ) {
				$temp_featured = $temp[$k];
				unset($temp[$k]);
				array_unshift($temp, $temp_featured);
				$temp_featured = array();
			}
		}

		// now add the ordered array back to the query
		$the_query->posts = $temp;

	}

}

/* The Loop. */	
if ( $the_query->have_posts() ) : $count = 0; ?>
	<header class="<?php echo $filtering_css_class; ?> section-title portfolio page_title">

		<h1><?php _e('Portfolio', 'woothemes'); ?></h1>

		<?php
		/* Display the gallery navigation (from theme-functions.php). */
		woo_portfolio_navigation( $galleries, array( 'current' => $current ), $toggle_pagination );
		?>
					    	
	</header>

	<div id="portfolio" class="portfolio-items fix">
	<?php
	while ( $the_query->have_posts() ) : $the_query->the_post(); $count++;
	
		/* Get the settings for this portfolio item. */
		$settings = woo_portfolio_item_settings( $post->ID );

		/* If the theme option is set to link to the single portfolio item, adjust the $settings. */
		if ( isset( $woo_options['woo_portfolio_linkto'] ) && ( $woo_options['woo_portfolio_linkto'] == 'post' ) ) {
			$settings['large'] = get_permalink( $post->ID );
			$settings['rel'] = '';
		}

		// Check for custom URL on item
		$custom_url = get_post_meta( $post->ID, '_portfolio_url', true ); 
		if ( $custom_url != '' )
			$settings['large'] = $custom_url;

		// Get the video (if any)
		$video = woo_embed('key=embed&width=420&height=300');

		// Setup initial array of post classes
		$post_classes = array();
		$post_classes[] = 'portfolio-item';

		// Is this post featured?
		$is_featured = false;
		$post_tags = array();
		$array_terms = get_the_terms($post->ID, 'portfolio-gallery');
		if ( $array_terms ) {
			foreach( $array_terms as $tag ) $post_tags[] = $tag->slug;
		}		
		if ( in_array($featured_gallery, $post_tags) ) { 
			$post_classes[] = 'featured';
			$is_featured = true;
		} else {
			$post_classes[] = 'not-featured';
		}

?>
			<?php
			global $image_size; global $port_image_height; global $port_type; // grab the image size from parent page for given portfolio columns 
			$post_classes[] = $port_type; // adding column number in class to fix the item width using css 
			?>
			<article id="portfolio-item-id-<?php the_ID(); ?>" <?php post_class( $post_classes ); ?>>
		
			<?php

			// Setup image sizes
			//$image_size = 308; // moved to parent page by Dinesh, $image_size is now defined in parent page
			if ( $is_featured ) $image_size = 932;

			/* Setup image for display and for checks, to avoid doing multiple queries. */
			$image = woo_image( 'width=' . $image_size . '&height=' . $port_image_height . '&noheight=true&link=img&return=true&class=thumbnail' ); 
			$image_src = woo_image( 'width=' . $image_size . '&noheight=true&link=url&return=true&class=thumbnail' );
				if ( !$image )
					$image = '<img src="' . get_template_directory_uri() . '/images/temp-portfolio.png" alt="" />';
			?>
			<?php 
			//setup terms
			$tag_list = get_the_term_list( $post->ID, 'portfolio-gallery', '' , ', ' , ''  );
			$tag_list = strip_tags($tag_list);

			// If there's a video, replace with the appropriate markup.
			if ( !empty( $video ) ) {
				$settings['rel'] = 'data-rel="lightbox"';
				$settings['large'] = '#video-'.$post->ID;
			}

			?>
			<?php if( $port_type == "one-one" ) { // if one column portfolio ?>
			<div class="content-wrapper">
				<div class="portfolio-title overflow">
					<h2><?php the_title(); ?></h2>
					<span class="portfolio-author"><?php _e( 'by', 'woothemes' ); ?> <a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php the_author_meta('display_name'); ?></a></span>
				</div>
				<div class="fix"></div>

				<figure class="over">
					<div class="overview" style="visibility: hidden;">
						<span href="#" class="over-view"><a href="<?php echo $settings['large']; ?>" class="over-cap item drop-shadow curved curved-hz-1" title="<?php echo $settings['caption']; ?>" ></a><a href="<?php the_permalink(); ?>" class="over-details"></a></span>
					</div>
					<?php echo $image; ?>
				</figure>
				
						<div class="fix"></div>
    					<?php global $more; $more = 0; ?>	                                        
                        <?php if ( isset( $woo_options['woo_post_content'] ) && $woo_options['woo_post_content'] == 'content' ) { the_content(__( 'Read More...', 'woothemes' ) ); } else { the_excerpt(); } ?>
						<a href="<?php the_permalink(); ?>"><?php _e('View Details', 'woothemes') ?></a> <?php if ($custom_url != ''): ?> | <a href="<?php echo $custom_url ?>"><?php _e('Visit Project', 'woothemes') ?></a><?php endif; ?>
		
			</div>

			<?php } elseif( $port_type == "one-hex" ) { // if hex portfolio ?>
			<div class="content-wrapper">


				<figure class="over-hex">
					<div class="over-content" style="visibility: hidden;">
					<span class="over-view"><a href="<?php echo $settings['large']; ?>" class="over-cap item drop-shadow curved curved-hz-1" title="<?php echo $settings['caption']; ?>" ></a><a href="<?php the_permalink(); ?>" class="over-details"></a></span>

					</div>
					<span class="maskhex"></span>
					<div class="overview" style="visibility: hidden;"></div>
					<?php echo $image; ?>
				</figure>

				<div class="fix"></div>
			</div>

			<?php } else { // if not one column and not hex portfolio ?>
			<div class="content-wrapper">

				<figure class="over">
					<div class="overview" style="visibility: hidden;">
						<span href="#" class="over-view"><a href="<?php echo $settings['large']; ?>" class="over-cap item drop-shadow curved curved-hz-1" title="<?php echo $settings['caption']; ?>" ></a><a href="<?php the_permalink(); ?>" class="over-details"></a></span>
					</div>
					<?php echo $image; ?>
				</figure>

				<div class="fix"></div>
				<div class="portfolio-title overflow">
					<h2><?php the_title(); ?></h2>
					<span class="portfolio-two-author"><?php _e( 'by', 'woothemes' ); ?> <a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php the_author_meta('display_name'); ?></a></span>
				</div>
			</div>

			<?php } ?>
		<?php
			// Output image gallery for lightbox
        	if ( ! empty( $settings['gallery'] ) && empty( $video ) ) {
            	foreach ( array_slice( $settings['gallery'], 1 ) as $img => $attachment ) {
            		if ( $attachment['url'] != $image_src ) {
            			echo '<a ' . $settings['rel'] . ' title="' . $attachment['caption'] . '" href="' . $attachment['url'] . '" class="gallery-image"></a>' . "\n";	
            		}                    
            	}
            }
            // Output video div
            if ( ! empty( $video ) ) {
            	echo '<div class="hide" id="video-' . $post->ID . '">' . $video . '</div>';
            }
		?>
		
		</article>		
<?php
	endwhile;
?>
	</div><!--/.portfolio-items-->
<?php
	if ( $toggle_pagination == true ) {
		woo_pagenav();
	}
?>
<?php else : ?>
	<div <?php post_class(); ?>>
		<p><?php _e( 'Sorry, no posts matched your criteria.', 'woothemes' ); ?></p>
	</div><!-- .post -->
<?php
endif;
rewind_posts();
wp_reset_query();
?>