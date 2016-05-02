<?php
	
// Do not delete these lines

if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ( 'Please do not load this page directly. Thanks!' );

if ( post_password_required() ) { ?>
	<p class="nocomments"><?php _e( 'This post is password protected. Enter the password to view comments.', 'woothemes' ) ?></p>

<?php return; } ?>

<?php $comments_by_type = &separate_comments($comments); ?>    

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>

<div id="comments">

	<?php if ( ! empty($comments_by_type['comment']) ) : ?>

		<h3><?php comments_number(__( 'No Responses', 'woothemes' ), __( 'One Response', 'woothemes' ), __( '% Responses', 'woothemes' ) );?> <?php _e( 'to', 'woothemes' ) ?> &#8220;<?php the_title(); ?>&#8221;</h3>

		<ol class="commentlist">
	
			<?php wp_list_comments( 'avatar_size=28&callback=custom_comment&type=comment' ); ?>
		
		</ol>    

		<div class="navigation">
			<div class="fl"><?php previous_comments_link() ?></div>
			<div class="fr"><?php next_comments_link() ?></div>
			<div class="fix"></div>
		</div><!-- /.navigation -->
	<?php endif; ?>
		    
	<?php if ( ! empty($comments_by_type['pings']) ) : ?>
    		
        <h3 id="pings"><?php _e( 'Trackbacks/Pingbacks', 'woothemes' ) ?></h3>
    
        <ol class="pinglist">
            <?php wp_list_comments( 'type=pings&callback=list_pings' ); ?>
        </ol>
    	
	<?php endif; ?>
    	
</div> <!-- /#comments_wrap -->

<?php else : // this is displayed if there are no comments so far ?>

<div id="comments">

	<?php 
		// If there are no comments and comments are closed, let's leave a little note, shall we?
		if ( ! comments_open() && is_singular() ) { ?><h5 class="nocomments"><?php _e( 'Comments are closed.', 'woothemes' ); ?></h5><?php }
		else { ?><h5 class="nocomments"><?php _e( 'No comments yet.', 'woothemes' ); ?></h5><?php }
	?>

</div> <!-- /#comments_wrap -->

<?php endif; ?>

<?php if ( 'open' == $post->comment_status ) : ?>

<div id="respond">

	<h3><?php comment_form_title( __( 'Leave a Reply', 'woothemes' ), __( 'Leave a Reply to %s', 'woothemes' ) ); ?></h3>
	
	<?php if ( get_option('comment_registration') && !$user_ID ) : //If registration required & not logged in. ?>

		<p><?php _e( 'You must be', 'woothemes' ); ?> <a href="<?php echo get_option( 'siteurl' ); ?>/wp-login.php?redirect_to=<?php echo urlencode( get_permalink() ); ?>"><?php _e( 'logged in', 'woothemes' ); ?></a> <?php _e('to post a comment.', 'woothemes') ?></p>

	<?php else : //No registration required ?>
	
		<form action="<?php echo get_option( 'siteurl' ); ?>/wp-comments-post.php" method="post" id="commentform">
		
		<div class="cancel-comment-reply">
			<small><?php cancel_comment_reply_link(); ?></small>
		</div><!-- /.cancel-comment-reply -->

		<?php if ( $user_ID ) : //If user is logged in ?>

			<p><?php _e( 'Logged in as', 'woothemes' ); ?> <a href="<?php echo get_option( 'siteurl' ); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(); ?>" title="<?php _e( 'Log out of this account', 'woothemes' ); ?>"><?php _e( 'Logout', 'woothemes' ); ?> &raquo;</a></p>

		<?php else : //If user is not logged in ?>

			<p class="field">
				<input type="text" name="author" class="txt" id="author" onFocus="clearText(this)" onBlur="clearText(this)" value="<?php if($comment_author) { echo $comment_author; } else { echo __( 'Name', 'woothemes' ).' '; if ($req) echo '('.__( 'Required', 'woothemes' ).')'; } ?>" size="22" tabindex="1" />
			</p>

			<p class="field">
				<input type="text" name="email" class="txt" id="email" onFocus="clearText(this)" onBlur="clearText(this)" value="<?php if($comment_author_email) { echo $comment_author_email; } else { echo __( 'Mail (will not be published)', 'woothemes' ).' '; if ($req) echo '('.__( 'Required', 'woothemes' ).')'; } ?>" size="22" tabindex="2" />
			</p>

			<p class="field last">
				<input type="text" name="url" class="txt" id="url" onFocus="clearText(this)" onBlur="clearText(this)" value="<?php if ($comment_author_url) echo $comment_author_url; else echo __( 'Website', 'woothemes' ); ?>" size="22" tabindex="3" />
			</p>

		<?php endif; // End if logged in ?>

		<!--<p><strong>XHTML:</strong> <?php _e('You can use these tags', 'woothemes'); ?>: <?php echo allowed_tags(); ?></p>-->

		<p><textarea name="comment" id="comment" rows="10" cols="50" tabindex="4"></textarea></p>

		<input name="submit" type="submit" id="submit" class="button" tabindex="5" value="<?php _e('Submit Comment', 'woothemes') ?>" />
		<?php /*<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />*/ ?>
		
		<?php comment_id_fields(); ?>
		<?php do_action( 'comment_form', $post->ID ); ?>
		
		<span class="faker"></span>

		</form><!-- /#commentform -->

	<?php endif; // If registration required ?>

	<div class="fix"></div>

</div><!-- /#respond -->

<?php endif; // if you delete this the sky will fall on your head ?>