<?php
/**
 * Portfolio carousel component.
 *
 * Displays a carousel of items with the post type of "portfolio".
 *
 * @author Matty
 * @date 2011-04-24
 * @since 1.0.0
 * @uses get_posts(), has_post_thumbnail(). get_post_thumbnail_id(), woo_image()
 */
 
 global $woo_options;
 
 $carousel_id = 'homepage-portfolio-carousel';
 $args = array();
 $args['post_type'] = 'portfolio';
 $entries_to_show = 5;
 if ( is_array( $woo_options ) && @$woo_options['woo_portfolio_entries'] ) {
 	$entries_to_show = $woo_options['woo_portfolio_entries'];
 }
 
 $args['posts_per_page'] = $entries_to_show;
 
 $entries = get_posts( $args );
 
 $items_link_to = 'image';
 if ( is_array( $woo_options ) && @$woo_options['woo_portfolio_link'] && in_array( $woo_options['woo_portfolio_link'], array( 'image', 'page' ) ) ) {
 	$items_link_to = $woo_options['woo_portfolio_link'];
 }
 
 // Remove any items that don't have images.
 
 if ( ! empty( $entries ) ) {
	foreach ( $entries as $k => $post ) {
		setup_postdata( $post );
		
		if ( ! woo_image( 'key=portfolio-image&return=true' ) ) { unset( $entries[$k] ); }
	}
 }
 
 $html = '';
 
 if ( is_array( $entries ) && ! is_wp_error( $entries ) && count( $entries ) > 0 ) {
 
 	$count = 0;
 
 	$html .= '<div id="' . $carousel_id . '" class="portfolio-carousel">' . "\n";
 	$html .= '<ul class="slides">' . "\n";
 	
 		foreach ( $entries as $post ) {
 			setup_postdata( $post );
 			$count++;
 			
 			$image_url = get_post_meta( $post->ID, 'portfolio-image', true );
 			$video_url = get_post_meta( $post->ID, 'embed-url', true );
 			
 			// If we don't have an image in the portfolio-image custom field and a post thumbnail is set, use it.
 			if ( ! $image_url && has_post_thumbnail( $post->ID ) ) {
 				$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
 				$image_url = $image_url[0];
 			}
 			
 			$link = $image_url;
 			$rel = ' rel="lightbox[\'homepage\']"';
 			
 			if ( $video_url != '' ) { $link = $video_url; }
 			
 			if ( $items_link_to == 'page' ) {
 				$link = get_permalink( get_the_ID() );
 				$rel = '';
 			}
 			
 			$item_plus = '<span class="maximize-thumbnail"><span class="plus"></span></span>' . "\n";
 			$item_link = '<a href="' . $link . '" title="' . the_title_attribute( array( 'echo' => 0 ) ) . '"' . $rel . '>' . $item_plus . woo_image( 'key=portfolio-image&width=159&height=100&return=true&link=img' ) . '</a>';
 			
 			$html .= '<li id="' . $carousel_id . '-item-number-' . $count . '" class="item-number-' . $count . ' item-id-' . get_the_ID() . '">' . $item_link . '</li>' . "\n";
 		}
 	
 	$html .= '</ul><!--/.slides-->' . "\n";
 	 	
 	$html .= '</div><!--/#homepage-portfolio-carousel .portfolio-carousel-->' . "\n";
 	
 	if ( count( $entries ) > 5 ) {
	 	$html .= '<a href="#" class="btn-prev">' . __( 'Previous', 'woothemes' ) . '</a>' . "\n";
	 	$html .= '<a href="#" class="btn-next">' . __( 'Next', 'woothemes' ) . '</a>' . "\n";
 	}
 
 }
 
 echo $html;
?>