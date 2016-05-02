<?php 
/**
 * Woothemes Tumblog Functionality
 * FrontEnd
 *
 * @version 2.0.0
 *
 * @package WooFramework
 * @subpackage Tumblog
 */
 
/*-----------------------------------------------------------------------------------

TABLE OF CONTENTS

- ReTweet Button
- Tumblog - Category Link
- Tumblog Posts Output
-- Default
-- Articles
-- Videos
-- Images
-- Links
-- Quotes
-- Audio
- Tumblog Feed

-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Retweet Counter */
/*-----------------------------------------------------------------------------------*/

function tweetButton($url, $title = 'Read this Post') {
	$maxTitleLength = 140 - (strlen($url)+1);
	if (strlen($title) > $maxTitleLength) {
		$title = substr($title, 0, ($maxTitleLength-3)).'...';
	}
	$url = woo_short_url($url);
	$output = $title.' '.$url;
	$tweet_link = 'http://twitter.com/home?status='.urlencode($output);
	//Output button
	echo '<a href="'.$tweet_link.'" title="'. __('On Twitter', 'woothemes') .'" target="_blank">'. __('On Twitter', 'woothemes') .'</a>';
}

/*-----------------------------------------------------------------------------------*/
/* Tumblog - Category Link */
/*-----------------------------------------------------------------------------------*/

function woo_tumblog_category_link($post_id = 0, $type = 'articles') {

	$category_link = '';
	
	if (get_option('woo_tumblog_content_method') == 'post_format') {
		
		$post_format = get_post_format();
		if ($post_format == '') { 
			$category = get_the_category(); 
			$category_name = $category[0]->cat_name;
			// Get the ID of a given category
   			$category_id = get_cat_ID( $category_name );
    		// Get the URL of this category
    		$category_link = get_category_link( $category_id );
		} else {
			$category_link = get_post_format_link( $post_format );
    	}
    	
	} else {
		$tumblog_list = get_the_term_list( $post_id, 'tumblog', '' , '|' , ''  );
		$tumblog_array = explode('|', $tumblog_list);
		?>
		<?php $tumblog_items = array(	'articles'	=> get_option('woo_articles_term_id'),
										'images' 	=> get_option('woo_images_term_id'),
										'audio' 	=> get_option('woo_audio_term_id'),
										'video' 	=> get_option('woo_video_term_id'),
										'quotes'	=> get_option('woo_quotes_term_id'),
										'links' 	=> get_option('woo_links_term_id')
									);
		?>
		<?php
    	// Get the ID of Tumblog Taxonomy
    	$category_id = $tumblog_items[$type];
    	$term = &get_term($category_id, 'tumblog');
    	// Get the URL of Articles Tumblog Taxonomy
    	$category_link = get_term_link( $term, 'tumblog' );
    }

	return $category_link;
}

/*-----------------------------------------------------------------------------------*/
/* Tumblog Posts - Default */
/*-----------------------------------------------------------------------------------*/

function woo_tumblog_default( $post_id = 0, $count = 0, $pagetype = '' ) {
	$service = get_option('woo_url_shorten');
	?>
	<div id="post-<?php echo $count; ?>" class="post article">

          <h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2> 

		<div class="meta">
     	    	<?php if ( is_single() ) { ?>
       		    	<div class="meta-but"><?php next_post_link('%link', 'Next'); ?>
       		    	<?php previous_post_link('%link', 'Previous'); ?></div>
     	    	<?php } ?>
			<span class="date"><?php the_time(get_option('date_format')); ?></span>
			<ul>
				<li class="comments"><?php comments_popup_link(__('0 Comments', 'woothemes'), __('1 Comment', 'woothemes'), __('% Comments', 'woothemes')); ?></li>
				<?php $category = get_the_category(); // To show only 1 Category ?>            
				<li class="category"><?php _e('Categories','woothemes'); ?></li>
				<li class="meta-link"><?php the_category(); ?></li>
				<li class="tags"><?php _e('Tags','woothemes'); ?></li>
				<?php the_tags('<li class="meta-link">', '', '</li>'); ?>
				<li class="share"><?php _e('Share','woothemes'); ?></li>
				<li class="meta-link"><?php tweetButton(get_permalink(), get_the_title()); ?></li>
				<li class="meta-link"><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>"><?php _e('On Facebook', 'woothemes') ?></a></li>
			</ul>
        </div><!-- /.post-meta -->
			
			<?php 
			if ( ( ( is_single() ) && ( get_option('woo_thumb_single') == 'true' ) ) || ( is_home() || is_front_page() || is_archive() || is_search() ) ) {	?>
				<?php if (get_post_meta($post_id, "image", true) != '') { ?>
			<div class="media">
    	    	<?php if (is_single()) { $width = get_option('woo_single_w'); $height = get_option('woo_single_h'); } else { $width = get_option('woo_thumb_w'); $height = get_option('woo_thumb_h'); }   ?>
    	    	<?php if (get_option('woo_dynamic_img_height') != 'true') { $height = '&height='.$height; } else { $height = ''; } ?>
    	    	<?php if (get_option('woo_image_link_to') == 'image') {
  				?><a href="<?php echo get_post_meta($post_id, "image", true); ?>" title="image" rel="lightbox"><?php woo_image('key=image&width='.$width.$height.'&link=img'); ?></a><?php  
  				} else { ?>
    	    	<a href="<?php the_permalink(); ?>" title="image">
    	    	<?php echo woo_image('key=image&width='.$width.$height.'&link=img'); ?>
    	    	</a><?php } ?>
	   		</div><!-- /.media -->
	   		<?php }
			} else {
				//do not display image
			} ?>
				   		
        <div class="middle"> 
           
       	    <div class="entry">
           		<?php if (( ( get_option('woo_home_content') == 'false' ) && ( is_home() ) ) || (( get_option('woo_archive_content') == 'false' ) && ( is_archive() || is_search() || is_tax() ))) {	the_excerpt(); } elseif ( ( $pagetype == 'archive' ) && ( get_option('woo_archive_content') == 'false' ) ) { the_excerpt(); } elseif ( ( $pagetype == 'home' ) && ( get_option('woo_home_content') == 'false' ) ) { the_excerpt(); } else { the_content(); } ?>
           	</div>
           	<?php if (!is_singular()) { ?><div class="post-more">       
               	<span class="read-more"><?php if (( ( get_option('woo_home_content') == 'false' ) && ( is_home() ) ) || (( get_option('woo_archive_content') == 'false' ) && ( is_archive() || is_search() || is_tax() ))) { ?><a class="but" href="<?php the_permalink() ?>" title="<?php _e('Read More','woothemes'); ?>"><?php _e('Read More','woothemes'); ?></a><?php } else { comments_popup_link(__('Leave a Comment', 'woothemes'), __('Leave a Comment', 'woothemes'), __('Leave a Comment', 'woothemes')); } ?></span>            
           	</div><?php } ?>
       	</div><!-- /.middle -->
                
        <div class="fix"></div>
                
    </div><!-- /.post -->
	<?php
}

/*-----------------------------------------------------------------------------------*/
/* Tumblog Posts - Articles */
/*-----------------------------------------------------------------------------------*/

function woo_tumblog_articles( $post_id = 0, $count = 0, $pagetype = '' ) {
	$service = get_option('woo_url_shorten');
	?>
	<div id="post-<?php echo $count; ?>" class="post article">

          <h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2> 

		<div class="meta">
     	    	<?php if ( is_single() ) { ?>
       		    	<div class="meta-but"><?php next_post_link('%link', 'Next'); ?>
       		    	<?php previous_post_link('%link', 'Previous'); ?></div>
     	    	<?php } ?>
			<span class="date"><?php the_time(get_option('date_format')); ?></span>
			<ul>
				<li class="comments"><?php comments_popup_link(__('0 Comments', 'woothemes'), __('1 Comment', 'woothemes'), __('% Comments', 'woothemes')); ?></li>
				<?php $category = get_the_category(); // To show only 1 Category ?>            
				<li class="category"><?php _e('Categories','woothemes'); ?></li>
				<li class="meta-link"><?php the_category(); ?></li>
				<li class="tags"><?php _e('Tags','woothemes'); ?></li>
				<?php the_tags('<li class="meta-link">', '', '</li>'); ?>
				<li class="share"><?php _e('Share','woothemes'); ?></li>
				<li class="meta-link"><?php tweetButton(get_permalink(), get_the_title()); ?></li>
				<li class="meta-link"><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>"><?php _e('On Facebook', 'woothemes') ?></a></li>
			</ul>
        </div><!-- /.post-meta -->

        <div class="middle"> 
           
       	    <div class="entry">
           		<?php if (( ( get_option('woo_home_content') == 'false' ) && ( is_home() ) ) || (( get_option('woo_archive_content') == 'false' ) && ( is_archive() || is_search() || is_tax() ))) {	the_excerpt(); } elseif ( ( $pagetype == 'archive' ) && ( get_option('woo_archive_content') == 'false' ) ) { the_excerpt(); } elseif ( ( $pagetype == 'home' ) && ( get_option('woo_home_content') == 'false' ) ) { the_excerpt(); } else { the_content(); } ?>
           	</div>
           	<?php if (!is_singular()) { ?><div class="post-more">       
               	<span class="read-more"><?php if (( ( get_option('woo_home_content') == 'false' ) && ( is_home() ) ) || (( get_option('woo_archive_content') == 'false' ) && ( is_archive() || is_search() || is_tax() ))) { ?><a class="but" href="<?php the_permalink() ?>" title="<?php _e('Read More','woothemes'); ?>"><?php _e('Read More','woothemes'); ?></a><?php } else { comments_popup_link(__('Leave a Comment', 'woothemes'), __('Leave a Comment', 'woothemes'), __('Leave a Comment', 'woothemes')); } ?></span>            
           	</div><?php } ?>
       	</div><!-- /.middle -->
                
        <div class="fix"></div>
                
    </div><!-- /.post -->
	<?php
}

/*-----------------------------------------------------------------------------------*/
/* Tumblog Posts - Videos */
/*-----------------------------------------------------------------------------------*/

function woo_tumblog_videos( $post_id = 0, $count = 0, $pagetype = '' ) {
	$service = get_option('woo_url_shorten');
	?>
	<div id="post-<?php echo $count; ?>" class="post video">

           	<h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2> 
           
     	    	<div class="media">
       		    	<?php echo woo_get_embed('video-embed', '460', ''); ?>	
    	    	</div><!-- /.media -->  

		<div class="meta">
     	    	<?php if ( is_single() ) { ?>
       		    	<div class="meta-but"><?php next_post_link('%link', 'Next'); ?>
       		    	<?php previous_post_link('%link', 'Previous'); ?></div>
     	    	<?php } ?>
			<span class="date"><?php the_time(get_option('date_format')); ?></span>
			<ul>
				<li class="comments"><?php comments_popup_link(__('0 Comments', 'woothemes'), __('1 Comment', 'woothemes'), __('% Comments', 'woothemes')); ?></li>
				<?php $category = get_the_category(); // To show only 1 Category ?>            
				<li class="category"><?php _e('Categories','woothemes'); ?></li>
				<li class="meta-link"><?php the_category(); ?></li>
				<li class="tags"><?php _e('Tags','woothemes'); ?></li>
				<?php the_tags('<li class="meta-link">', '', '</li>'); ?>
				<li class="share"><?php _e('Share','woothemes'); ?></li>
				<li class="meta-link"><?php tweetButton(get_permalink(), get_the_title()); ?></li>
				<li class="meta-link"><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>"><?php _e('On Facebook', 'woothemes') ?></a></li>
			</ul>
        </div><!-- /.post-meta --> 
        	
       	<div class="middle">

    	    <div class="entry">

           		<?php if (( ( get_option('woo_home_content') == 'false' ) && ( is_home() ) ) || (( get_option('woo_archive_content') == 'false' ) && ( is_archive() || is_search() || is_tax() ))) {	the_excerpt(); } elseif ( ( $pagetype == 'archive' ) && ( get_option('woo_archive_content') == 'false' ) ) { the_excerpt(); } elseif ( ( $pagetype == 'home' ) && ( get_option('woo_home_content') == 'false' ) ) { the_excerpt(); } else { the_content(); } ?>
           	</div>
           	<?php if (!is_singular()) { ?><div class="post-more">       
               	<span class="read-more"><?php if (( ( get_option('woo_home_content') == 'false' ) && ( is_home() ) ) || (( get_option('woo_archive_content') == 'false' ) && ( is_archive() || is_search() || is_tax() ))) { ?><a class="but" href="<?php the_permalink() ?>" title="<?php _e('Read More','woothemes'); ?>"><?php _e('Read More','woothemes'); ?></a><?php } else { comments_popup_link(__('Leave a Comment', 'woothemes'), __('Leave a Comment', 'woothemes'), __('Leave a Comment', 'woothemes')); } ?></span>            
           	</div><?php } ?>
       	</div><!-- /.middle -->
                
        <div class="fix"></div>
                
    </div><!-- /.post -->
	<?php
}

/*-----------------------------------------------------------------------------------*/
/* Tumblog Posts - Images */
/*-----------------------------------------------------------------------------------*/

function woo_tumblog_images( $post_id = 0, $count = 0, $pagetype = '' ) {
	$service = get_option('woo_url_shorten');
	?>
	<div id="post-<?php echo $count; ?>" class="post image">

             	<h2 class="title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>          

		<div class="meta">
     	    	<?php if ( is_single() ) { ?>
       		    	<div class="meta-but"><?php next_post_link('%link', 'Next'); ?>
       		    	<?php previous_post_link('%link', 'Previous'); ?></div>
     	    	<?php } ?>
			<span class="date"><?php the_time(get_option('date_format')); ?></span>
			<ul>
				<li class="comments"><?php comments_popup_link(__('0 Comments', 'woothemes'), __('1 Comment', 'woothemes'), __('% Comments', 'woothemes')); ?></li>
				<?php $category = get_the_category(); // To show only 1 Category ?>            
				<li class="category"><?php _e('Categories','woothemes'); ?></li>
				<li class="meta-link"><?php the_category(); ?></li>
				<li class="tags"><?php _e('Tags','woothemes'); ?></li>
				<?php the_tags('<li class="meta-link">', '', '</li>'); ?>
				<li class="share"><?php _e('Share','woothemes'); ?></li>
				<li class="meta-link"><?php tweetButton(get_permalink(), get_the_title()); ?></li>
				<li class="meta-link"><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>"><?php _e('On Facebook', 'woothemes') ?></a></li>
			</ul>
        </div><!-- /.post-meta --> 
            	
    	    	<div class="media">
    	    		<?php 
    	    		// Get Meta Data
    	    		$attachments = get_children(array('post_parent' => $post_id,'numberposts' => 1,'post_type' => 'attachment','post_mime_type' => 'image','order' => 'DESC','orderby' => 'menu_order date'));
  					foreach ( $attachments as $att_id => $attachment ) { $meta_data = $attachment->post_title; }
  					if ($meta_data == '') {	$meta_data = get_the_title(); }
    	    		?>
    	    		<?php if (is_single()) { $width = get_option('woo_single_w'); $height = get_option('woo_single_h'); } else { $width = get_option('woo_thumb_w'); $height = get_option('woo_thumb_h'); }   ?>
    	    		<?php if (get_option('woo_dynamic_img_height') != 'true') { $height = '&height='.$height; } else { $height = ''; } ?>
    	    		<?php if (get_option('woo_image_link_to') == 'image') {
  					?><a href="<?php echo get_post_meta($post_id, "image", true); ?>" title="<?php echo $meta_data; ?>" rel="lightbox"><?php woo_image('key=image&width='.$width.$height.'&link=img'); ?></a><?php  
  					} else { ?>
    	    		<a href="<?php the_permalink(); ?>" title="<?php echo $meta_data; ?>">
    	    		<?php echo woo_image('key=image&width='.$width.$height.'&link=img'); ?>
    	    		</a><?php } ?>
	   		    </div><!-- /.media -->

       	<div class="middle"> 

    	    <div class="entry">
          		<?php if (( ( get_option('woo_home_content') == 'false' ) && ( is_home() ) ) || (( get_option('woo_archive_content') == 'false' ) && ( is_archive() || is_search() || is_tax() ))) {	the_excerpt(); } elseif ( ( $pagetype == 'archive' ) && ( get_option('woo_archive_content') == 'false' ) ) { the_excerpt(); } elseif ( ( $pagetype == 'home' ) && ( get_option('woo_home_content') == 'false' ) ) { the_excerpt(); } else { the_content(); } ?>
           	</div>
           	<?php if (!is_singular()) { ?><div class="post-more">       
               	<span class="read-more"><?php if (( ( get_option('woo_home_content') == 'false' ) && ( is_home() ) ) || (( get_option('woo_archive_content') == 'false' ) && ( is_archive() || is_search() || is_tax() ))) { ?><a class="but" href="<?php the_permalink() ?>" title="<?php _e('Read More','woothemes'); ?>"><?php _e('Read More','woothemes'); ?></a><?php } else { comments_popup_link(__('Leave a Comment', 'woothemes'), __('Leave a Comment', 'woothemes'), __('Leave a Comment', 'woothemes')); } ?></span>            
           	</div><?php } ?>
       	</div><!-- /.middle -->
                
        <div class="fix"></div>
                
    </div><!-- /.post -->
	<?php
} 

/*-----------------------------------------------------------------------------------*/
/* Tumblog Posts - Links */
/*-----------------------------------------------------------------------------------*/

function woo_tumblog_links( $post_id = 0, $count = 0, $pagetype = '' ) {
	$service = get_option('woo_url_shorten');
	?>
	<div id="post-<?php echo $count; ?>" class="post link">

           	<h2 class="title"><a href="<?php echo get_post_meta($post_id,'link-url',true); ?>" rel="bookmark" title="<?php the_title(); ?>" target="_blank"><?php the_title(); ?></a></h2>
            
		<div class="meta">
     	    	<?php if ( is_single() ) { ?>
       		    	<div class="meta-but"><?php next_post_link('%link', 'Next'); ?>
       		    	<?php previous_post_link('%link', 'Previous'); ?></div>
     	    	<?php } ?>
			<span class="date"><?php the_time(get_option('date_format')); ?></span>
			<ul>
				<li class="comments"><?php comments_popup_link(__('0 Comments', 'woothemes'), __('1 Comment', 'woothemes'), __('% Comments', 'woothemes')); ?></li>
				<?php $category = get_the_category(); // To show only 1 Category ?>            
				<li class="category"><?php _e('Categories','woothemes'); ?></li>
				<li class="meta-link"><?php the_category(); ?></li>
				<li class="tags"><?php _e('Tags','woothemes'); ?></li>
				<?php the_tags('<li class="meta-link">', '', '</li>'); ?>
				<li class="share"><?php _e('Share','woothemes'); ?></li>
				<li class="meta-link"><?php tweetButton(get_permalink(), get_the_title()); ?></li>
				<li class="meta-link"><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>"><?php _e('On Facebook', 'woothemes') ?></a></li>
			</ul>
        </div><!-- /.post-meta -->
            	
       	<div class="middle">

    	    <div class="entry">
    	    	<?php if (( ( get_option('woo_home_content') == 'false' ) && ( is_home() ) ) || (( get_option('woo_archive_content') == 'false' ) && ( is_archive() || is_search() || is_tax() ))) {	the_excerpt(); } elseif ( ( $pagetype == 'archive' ) && ( get_option('woo_archive_content') == 'false' ) ) { the_excerpt(); } elseif ( ( $pagetype == 'home' ) && ( get_option('woo_home_content') == 'false' ) ) { the_excerpt(); } else { the_content(); } ?>
           	</div>
           	<?php if (!is_singular()) { ?><div class="post-more">       
               	<span class="read-more"><?php if (( ( get_option('woo_home_content') == 'false' ) && ( is_home() ) ) || (( get_option('woo_archive_content') == 'false' ) && ( is_archive() || is_search() || is_tax() ))) { ?><a class="but" href="<?php the_permalink() ?>" title="<?php _e('Read More','woothemes'); ?>"><?php _e('Read More','woothemes'); ?></a><?php } else { comments_popup_link(__('Leave a Comment', 'woothemes'), __('Leave a Comment', 'woothemes'), __('Leave a Comment', 'woothemes')); } ?></span>            
           	</div><?php } ?>
       	</div><!-- /.middle -->
                
        <div class="fix"></div>
                
    </div><!-- /.post -->
	<?php
} 

/*-----------------------------------------------------------------------------------*/
/* Tumblog Posts - Quotes */
/*-----------------------------------------------------------------------------------*/

function woo_tumblog_quotes( $post_id = 0, $count = 0, $pagetype = '' ) {
	$service = get_option('woo_url_shorten');
	?>                  
    <div id="post-<?php echo $count; ?>" class="post quote">

           	<h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

		<div class="meta">
     	    	<?php if ( is_single() ) { ?>
       		    	<div class="meta-but"><?php next_post_link('%link', 'Next'); ?>
       		    	<?php previous_post_link('%link', 'Previous'); ?></div>
     	    	<?php } ?>
			<span class="date"><?php the_time(get_option('date_format')); ?></span>
			<ul>
				<li class="comments"><?php comments_popup_link(__('0 Comments', 'woothemes'), __('1 Comment', 'woothemes'), __('% Comments', 'woothemes')); ?></li>
				<?php $category = get_the_category(); // To show only 1 Category ?>            
				<li class="category"><?php _e('Categories','woothemes'); ?></li>
				<li class="meta-link"><?php the_category(); ?></li>
				<li class="tags"><?php _e('Tags','woothemes'); ?></li>
				<?php the_tags('<li class="meta-link">', '', '</li>'); ?>
				<li class="share"><?php _e('Share','woothemes'); ?></li>
				<li class="meta-link"><?php tweetButton(get_permalink(), get_the_title()); ?></li>
				<li class="meta-link"><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>"><?php _e('On Facebook', 'woothemes') ?></a></li>
			</ul>
        </div><!-- /.post-meta -->
           
       	<div class="middle">

    	    <div class="entry">
        		<blockquote><?php echo get_post_meta($post_id,'quote-copy',true); ?> </blockquote><cite><a href="<?php echo get_post_meta($post_id,'quote-url',true); ?>" title="<?php the_title(); ?>"><?php echo get_post_meta($post_id,'quote-author',true); ?></a></cite>
            	<?php if (( ( get_option('woo_home_content') == 'false' ) && ( is_home() ) ) || (( get_option('woo_archive_content') == 'false' ) && ( is_archive() || is_search() || is_tax() ))) {	the_excerpt(); } elseif ( ( $pagetype == 'archive' ) && ( get_option('woo_archive_content') == 'false' ) ) { the_excerpt(); } elseif ( ( $pagetype == 'home' ) && ( get_option('woo_home_content') == 'false' ) ) { the_excerpt(); } else { the_content(); } ?>  		
            </div>
            <?php if (!is_singular()) { ?><div class="post-more">       
               	<span class="read-more"><?php if (( ( get_option('woo_home_content') == 'false' ) && ( is_home() ) ) || (( get_option('woo_archive_content') == 'false' ) && ( is_archive() || is_search() || is_tax() ))) { ?><a class="but" href="<?php the_permalink() ?>" title="<?php _e('Read More','woothemes'); ?>"><?php _e('Read More','woothemes'); ?></a><?php } else { comments_popup_link(__('Leave a Comment', 'woothemes'), __('Leave a Comment', 'woothemes'), __('Leave a Comment', 'woothemes')); } ?></span>            
           	</div><?php } ?>
       	</div><!-- /.middle -->
                
        <div class="fix"></div>
                
    </div><!-- /.post -->
	<?php
}   

/*-----------------------------------------------------------------------------------*/
/* Tumblog Posts - Audio */
/*-----------------------------------------------------------------------------------*/

function woo_tumblog_audio( $post_id = 0, $count = 0, $pagetype = '' ) {
    $service = get_option('woo_url_shorten');
    ?>
    <div id="post-<?php echo $count; ?>" class="post audio">

               <h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

<div class="media">
<div class="audioplayer">
                    <div id='mediaspace<?php echo $post_id; ?>'></div>
                    <?php
                    //Post Args
                    $args = array(
                        'post_type' => 'attachment',
                        'numberposts' => -1,
                        'post_status' => null,
                        'post_parent' => $post_id
                    );
                    //Get attachements
                    $attachments = get_posts($args);
                    if ($attachments) {
                        foreach ($attachments as $attachment) {
                            $link_url= $attachment->guid;
                        }
                    }
                    else {
                        $link_url = get_post_meta($post_id,'audio',true);
                    }
                    if(!empty($link_url)) {
                    ?>
                    <script type='text/javascript'>
                      var so = new SWFObject('<?php bloginfo('template_directory'); ?>/includes/tumblog/player.swf','mpl','400','32','9');
                      so.addParam('allowfullscreen','true');
                      so.addParam('allowscriptaccess','always');
                      so.addParam('wmode','opaque');
                      so.addParam('wmode','opaque');
                      so.addVariable('skin', '<?php bloginfo('template_directory'); ?>/includes/tumblog/stylish_slim.swf');
                      so.addVariable('file','<?php echo $link_url; ?>');
                      so.addVariable('backcolor','000000');
                      so.addVariable('frontcolor','FFFFFF');
                      so.write('mediaspace<?php echo $post_id; ?>');
                    </script>
                    <?php } ?>
                </div></div><!-- /.media -->

        <div class="meta">
                 <?php if ( is_single() ) { ?>
                       <div class="meta-but"><?php next_post_link('%link', 'Next'); ?>
                       <?php previous_post_link('%link', 'Previous'); ?></div>
                 <?php } ?>
            <span class="date"><?php the_time(get_option('woo_date')); ?></span>
            <ul>
                <li class="comments"><?php comments_popup_link(__('0 Comments', 'woothemes'), __('1 Comment', 'woothemes'), __('% Comments', 'woothemes')); ?></li>
                <?php $category = get_the_category(); // To show only 1 Category ?>
                <li class="category"><?php _e('Categories','woothemes'); ?></li>
                <li class="meta-link"><?php the_category(); ?></li>
                <li class="tags"><?php _e('Tags','woothemes'); ?></li>
                <?php the_tags('<li class="meta-link">', '', '</li>'); ?>
                <li class="share"><?php _e('Share','woothemes'); ?></li>
                <li class="meta-link"><?php tweetButton(get_permalink(), get_the_title()); ?></li>
                <li class="meta-link"><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>"><?php _e('On Facebook', 'woothemes') ?></a></li>
            </ul>
        </div><!-- /.post-meta -->

           <div class="middle">

            <div class="entry">
                <?php if (( ( get_option('woo_home_content') == 'false' ) && ( is_home() ) ) || (( get_option('woo_archive_content') == 'false' ) && ( is_archive() || is_search() || is_tax() ))) {    the_excerpt(); } elseif ( ( $pagetype == 'archive' ) && ( get_option('woo_archive_content') == 'false' ) ) { the_excerpt(); } elseif ( ( $pagetype == 'home' ) && ( get_option('woo_home_content') == 'false' ) ) { the_excerpt(); } else { the_content(); } ?>
               </div>
               <?php if (!is_singular()) { ?><div class="post-more">
                   <span class="read-more"><?php if (( ( get_option('woo_home_content') == 'false' ) && ( is_home() ) ) || (( get_option('woo_archive_content') == 'false' ) && ( is_archive() || is_search() || is_tax() ))) { ?><a class="but" href="<?php the_permalink() ?>" title="<?php _e('Read More','woothemes'); ?>"><?php _e('Read More','woothemes'); ?></a><?php } else { comments_popup_link(__('Leave a Comment', 'woothemes'), __('Leave a Comment', 'woothemes'), __('Leave a Comment', 'woothemes')); } ?></span>
               </div><?php } ?>
           </div><!-- /.middle -->

        <div class="fix"></div>

    </div><!-- /.post -->
    <?php
}


/*-----------------------------------------------------------------------------------*/
/* Tumblog Feed */
/*-----------------------------------------------------------------------------------*/

//Rewrite rules for custom feed
function tumblog_feed_rewrite($wp_rewrite) {
	$feed_rules = array(
		'feed/(.+)' => 'index.php?feed=' . $wp_rewrite->preg_index(1),
		'(.+).xml' => 'index.php?feed='. $wp_rewrite->preg_index(1)
	);
	$wp_rewrite->rules = $feed_rules + $wp_rewrite->rules;
}
//Add rewrite rules filter
add_filter('generate_rewrite_rules', 'tumblog_feed_rewrite');

//Loads Tumblog RSS feed template
function create_my_tumblogfeed() {
	load_template( TEMPLATEPATH . '/includes/tumblog/theme-tumblog-rss.php');
}
//Action hook
add_action('do_feed_tumblog', 'create_my_tumblogfeed', 10, 1); 

//Custom RSS permalink
function custom_rss_permalink($permalink) {
	global $wp_rewrite;
	
	$permalink = $wp_rewrite->get_feed_permastruct();
	if ( '' != $permalink ) {
		
		if ( get_default_feed() == $permalink )
			$feed = '';

		$permalink = str_replace('%feed%', $feed, $permalink);
		$permalink = preg_replace('#/+#', '/', "/$permalink/tumblog/");
		$output =  get_option('home') . user_trailingslashit($permalink, 'feed');
	} else {
		if ( empty($feed) )
			$feed = get_default_feed();

		$feed='tumblog';

		$output = trailingslashit(get_option('home')) . "?feed={$feed}";
	}

	
	
	return $output;
}
//Filter for RSS permalink
$custom_rss_url = get_option('woo_custom_rss');
if ( (isset($custom_rss_url)) && ($custom_rss_url == 'true') ) {
	add_filter('feed_link', 'custom_rss_permalink');
}

?>