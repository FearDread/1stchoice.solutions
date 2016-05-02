<?php
global $woo_options;
global $post;
$use_timthumb = false; 		// Set to false to disable for this section of theme. Images will be downsized instead of resized to 640px width
$repeat = 20; 				// Number of maximum attachments to get 
$photo_size = 'large';		// The WP "size" to use for the large image
$thumb_size = 'thumbnail';	// The WP "size" to use for the thumbnail
$thumb_width = 160;			// Size of thumbnails
$thumb_height = 160;

$width_setting = 540;

$id = $post->ID;
$attachments = get_children( array(
'post_parent' => $id,
'numberposts' => $repeat,
'post_type' => 'attachment',
'post_mime_type' => 'image',
'order' => 'DESC', 
'orderby' => 'menu_order date')
);

// This is the custom code where we strip out all the images that are listed in custom meta fields.
// 2011-01-05.

$image_meta_fields = array( 'image', '_wp_post_thumbnail' );

$image_meta_fields = apply_filters( 'bookclubtheme_nongallery_fields', $image_meta_fields );

$attachments = woo_remove_meta_from_array( $attachments, $image_meta_fields );

if ( !empty($attachments) ) :
	$counter = 0;
	$photo_output = '';
	$thumb_output = '';	
	foreach ( $attachments as $att_id => $attachment ) {
		$counter++;

		/* Set the position of all non-first slides to "out of the view", while loading.
		This gets overridden by loopedSlider when the gallery is fully loaded.
		This is to prevent other images with longer heights than the first, from displaying
		underneath the first while the gallery is loading. */
		
		$style = '';
		
		$position_setting = $width_setting + 6;

		if ( $counter == 1 ) {} else {
		
			$style = ' style="position: absolute; left: -' . $position_setting . 'px;"';
		
		} // End IF Statement

		// Caption text
		$caption = "";
		if ($attachment->post_excerpt) 
			$caption = '<span class="photo-caption">'.$attachment->post_excerpt.'</span>';	
			
		// Save large photo
		$src = wp_get_attachment_image_src($att_id, $photo_size, true);
		
		if ( ( get_option('woo_resize') == "true" && $use_timthumb == "true" ) || ( $src[1] > 540 ) )
  			$photo_output .= '<div><a href="'. $src[0] .'" rel="prettyPhoto['. $id .']" title="'.$attachment->post_excerpt.'">'.woo_image('src=' . $src[0] . '&key=image&width=' . $width_setting . '&noheight=true&link=img&return=false&alt=' . $caption . '&class=single-photo').'</a></div>';
		else
  			$photo_output .= '<div' . $style . '><a href="'. $src[0] .'" rel="prettyPhoto['. $id .']" title="'.$attachment->post_excerpt.'"><img src="'. $src[0] .'" class="single-photo" alt="'.$attachment->post_excerpt.'" /></a>'.$caption.'</div>'; 
		
		// Save thumbnail
		$src = wp_get_attachment_image_src($att_id, $thumb_size, true);
		$thumb_output .= '<li><a href="#"><img src="'. $src[0] .'" height="'.$thumb_height.'" width="'.$thumb_width.'" class="single-thumb" alt="'.$attachment->post_excerpt.'" />' . "</a></li>\n"; 
	}  
endif; ?>

<!-- Start Photo Slider -->
<?php 
	if ($counter == 1) {
		?><div id="single-gallery-image"><?php
			echo $photo_output; // This will show the large photo in the slider
		?></div><?php
	} else {
?>

<div id="loopedSlider" class="gallery sidebar">
    <div class="container">
        <div class="slides">
            <?php echo $photo_output; // This will show the large photo in the slider ?>
        </div>
    </div>
    
    <?php if ($counter > 1) : ?>
	
	<div class="fix"></div>
	                      
    <ul class="pagination">
		<?php echo $thumb_output; // This will show the thumbs ?>
    </ul>                      
    <?php endif; ?>
    
<div class="fix"></div>
</div>
<?php $counter_limit = 4; ?>
<?php if ($counter < $counter_limit) { ?>
<style type="text/css">

.jcarousel-prev { display:none!important; }
.jcarousel-next { display:none!important; }

</style>
<?php } ?>
<?php } ?>
<!-- End Photo Slider -->