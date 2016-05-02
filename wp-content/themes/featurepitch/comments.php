<?php
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'woothemes' ); ?></p>
	<?php
		return;
	}
?>
 
<!-- You can start editing here. -->

<div id="comments">

<?php if ( have_comments() ) : ?>

	<h3 class="count"><?php comments_number(__('No Responses', 'woothemes' ),__('1 Response', 'woothemes' ),__('% Responses', 'woothemes' ));?> to &#8220;<?php the_title(); ?>&#8221;</h3>

	<ol class="commentlist">
	<?php wp_list_comments('avatar_size=48&callback=custom_comment&type=comment'); ?>
	</ol>    

	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
		<div class="fix"></div>
	</div>
	<br />
    
	<?php if ( $comments_by_type['pings'] ) : ?>
    <h2 id="pings"><?php _e('Trackbacks/Pingbacks', 'woothemes' ); ?></h2>
    <ol class="commentlist">
    <?php wp_list_comments('type=pings'); ?>
    </ol>
    <?php endif; ?>

    
 
<?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments"><?php _e('Comments are closed.', 'woothemes' ); ?></p>

	<?php endif; ?>

<?php endif; ?>

</div> <!-- end #comments_wrap -->

<?php if ('open' == $post->comment_status) : ?>

<div id="respond">

<h3><?php comment_form_title( __('Leave a Reply', 'woothemes' ), __('Leave a Reply to %s', 'woothemes' ) ); ?></h3>
<div class="cancel-comment-reply">
	<small><?php cancel_comment_reply_link(); ?></small>
</div>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>

<p><?php _e('You must be', 'woothemes' ); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>" rel="nofollow"><?php _e('logged in', 'woothemes' ); ?></a> <?php _e('to post a comment.', 'woothemes' ); ?></p>

<?php else : ?>
<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : ?>

<p><?php _e('Logged in as', 'woothemes' ); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(); ?>" title="<?php _e('Log out of this account', 'woothemes' ); ?>"><?php _e('Logout', 'woothemes' ); ?> &raquo;</a></p>

<?php else : ?>

<input class="txt" type="text" name="author" id="author" value="<?php _e('Name', 'woothemes' ); ?>" onfocus="if (this.value == '<?php _e('Name', 'woothemes' ); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Name', 'woothemes' ); ?>';}" tabindex="1" />

<input class="txt" type="text" name="email" id="email" value="<?php _e('Email', 'woothemes' ); ?>" onfocus="if (this.value == '<?php _e('Email', 'woothemes' ); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Email', 'woothemes' ); ?>';}" tabindex="2" />

<input class="txt last" type="text" name="url" id="url" value="<?php _e('URL (optional)', 'woothemes' ); ?>" onfocus="if (this.value == '<?php _e('URL (optional)', 'woothemes' ); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('URL (optional)', 'woothemes' ); ?>';}" tabindex="3" />

<?php endif; ?>

<!--<p><small><strong>XHTML:</strong> You can use these tags: <?php echo allowed_tags(); ?></small></p>-->

<textarea name="comment" id="comment" cols="50" rows="5" tabindex="4"></textarea>

<p><input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit', 'woothemes' ); ?>" class="submit" />
<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
</p>
<?php comment_id_fields(); ?>
<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If logged in ?>

<div class="fix"></div>
</div> <!-- end #respond -->

<?php endif; // if you delete this the sky will fall on your head ?>
