<?php
	
// Do not delete these lines

if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');

if ( post_password_required() ) { ?>
	<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'woothemes') ?></p>

<?php return; } ?>

<?php $comments_by_type = &separate_comments($comments); ?>    

<!-- You can start editing here. -->

<div id="comments">

<?php if ( have_comments() ) : ?>

	<?php if ( ! empty($comments_by_type['comment']) ) : ?>

		<div id="commentsheader" class="middle">
				
			<h3><?php comments_number(__('No Comments', 'woothemes'), __('1 Comment', 'woothemes'), __('% Comments', 'woothemes') );?></h3>
			
			<span class="leavecomment">
				<div class="fl"><img id="ajax-loader" src="<?php echo get_bloginfo('template_directory'); ?>/images/ajax-loader.gif" /></div><div class="fr"><a onclick="woo_ajax_write_a_comment('<?php echo $post->ID; ?>','');" class="but" title="Write a Comment"><?php _e('Write a Comment', 'woothemes'); ?></a></div>
			</span>
			
			<div class="fix"></div>	

		</div><!-- /#commentsheader -->

		<ol class="commentlist">
		
			<?php wp_list_comments('reverse_top_level=true&avatar_size=40&callback=custom_comment&type=comment'); ?>
		
		</ol>

		<div class="com-nav">
			<div class="fl"><?php previous_comments_link() ?></div>
			<div class="fr"><?php next_comments_link() ?></div>
			<div class="fix"></div>
		</div><!-- /.com-nav -->    

	<?php endif; ?>
		    
	<?php if ( ! empty($comments_by_type['pings']) ) : ?>
    		
        <h3 id="pings"><?php _e('Trackbacks/Pingbacks', 'woothemes') ?></h3>
    
        <ol class="pinglist">
            <?php wp_list_comments('type=pings&callback=list_pings'); ?>
        </ol>
    	
	<?php endif; ?>
    	
<?php else : // this is displayed if there are no comments so far ?>

		<?php if ('open' == $post->comment_status) : ?>
			<!-- If comments are open, but there are no comments. -->
			
			<div id="commentsheader">
					
				<h3><?php _e('No comments yet.', 'woothemes') ?></h3>
			
				<span class="leavecomment">
					<div class="fl"><img id="ajax-loader" src="<?php echo get_bloginfo('template_directory'); ?>/images/ajax-loader.gif" /></div><div class="fr"><a onclick="woo_ajax_write_a_comment('<?php echo $post->ID; ?>','');" class="but" title="Write a comment"><?php _e('Write a Comment', 'woothemes'); ?></a></div>
				</span>
			
				<div class="fix"></div>			
			</div><!-- /#commentsheader -->
			
			<ol class="commentlist"></ol>
			
		<?php else : // comments are closed ?>
			<!-- If comments are closed. -->			
			<div id="commentsheader">
					
				<h3><?php _e('Comments are closed.', 'woothemes') ?></h3>
			
				<span class="leavecomment">
					<div class="fl"><img id="ajax-loader" src="<?php echo get_bloginfo('template_directory'); ?>/images/ajax-loader.gif" /></div><div class="fr"><a onclick="woo_ajax_write_a_comment('<?php echo $post->ID; ?>','');" title="Write a comment"><?php _e('Write a Comment', 'woothemes'); ?></a></div>
				</span>
			
				<div class="fix"></div>			
			</div><!-- /#commentsheader -->

		<?php endif; ?>

<?php endif; ?>

</div> <!-- /#comments_wrap -->

<?php if ('open' == $post->comment_status) : ?>

<div id="respond">
<div class="respond-head">
	<h3><?php comment_form_title( __('Leave a Reply', 'woothemes'), __('Leave a Reply to %s', 'woothemes') ); ?></h3>
	
	<div class="cancel-comment-reply">
		<small style="display:none;"><?php cancel_comment_reply_link(); ?></small>
		<small><a style="display:none;" title="Submit Comment" id="custom-cancel-reply"><?php _e('Click here to cancel reply', 'woothemes'); ?></a></small>
	</div><!-- /.cancel-comment-reply -->

	<?php if ( get_option('comment_registration') && !$user_ID ) : //If registration required & not logged in. ?>

		<p><?php _e('You must be', 'woothemes') ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e('logged in', 'woothemes') ?></a> <?php _e('to post a comment.', 'woothemes') ?></p>

	<?php else : //No registration required ?>

</div>
<div class="respond-form">
	
		<form id="commentform">

		<?php if ( $user_ID ) : //If user is logged in ?>

			<p><?php _e('Logged in as', 'woothemes') ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(); ?>" title="<?php _e('Log out of this account', 'woothemes') ?>"><?php _e('Logout', 'woothemes') ?> &raquo;</a></p>
			
			<?php 
			$user = wp_get_current_user();
			if ( $user->ID ) {
				if ( empty( $user->display_name ) )
					$user->display_name=$user->user_login;
				$comment_author       = $wpdb->escape($user->display_name);
				$comment_author_email = $wpdb->escape($user->user_email);
				$comment_author_url   = $wpdb->escape($user->user_url);
				$comment_userid = $wpdb->escape($user->ID);
			}
			?>
			
			<input type="hidden" name="userid" class="txt" id="userid" value="<?php echo $comment_userid; ?>" />
			
			<input type="hidden" name="author" class="txt" id="author" value="<?php echo $comment_author; ?>" />
			
			<input type="hidden" name="email" class="txt" id="email" value="<?php echo $comment_author_email; ?>" />
			
			<input type="hidden" name="url" class="txt" id="url" value="<?php echo $comment_author_url; ?>" />
				
		<?php else : //If user is not logged in ?>

			<p>
				<input type="text" name="author" class="txt" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
			
				<input type="text" name="email" class="txt" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
			
				<input type="text" name="url" class="txt" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
			</p>

		<?php endif; // End if logged in ?>

		<!--<p><strong>XHTML:</strong> <?php _e('You can use these tags', 'woothemes'); ?>: <?php echo allowed_tags(); ?></p>-->

		<p>
			<textarea name="comment" id="comment" rows="10" cols="50" tabindex="4"></textarea><div class="textarea-results"></div>
			<p class="atkey"><?php _e('Hit @ to reply to other authors', 'woothemes'); ?></p>
			<?php do_action('comment_form', $post->ID); ?>
			
		</p>
		
		
		
		<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
		
		<?php comment_id_fields(); ?>
		
		<a class="form-btn" onclick="woo_ajax_post_a_comment();" title="Submit Comment"><?php _e('Submit Comment', 'woothemes'); ?></a>
		<input type="text" id="comment-author-hidden" name="comment-author-hidden" value="" />		
		</form><!-- /#commentform -->

</div>
<div class="respond-btm"></div>

	<?php endif; // If registration required ?>

	<div class="fix"></div>

</div><!-- /#respond -->

<script type='text/javascript'>

	//Setup the write panel and preview on page load
	jQuery('#respond').attr('style', 'display:none;');

</script>

<?php endif; // if you delete this the sky will fall on your head ?>
