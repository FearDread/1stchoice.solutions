<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Comments Template
 *
 * This template file handles the display of comments, pingbacks and trackbacks.
 *
 * External functions are used to display the various types of comments.
 *
 * @package WooFramework
 * @subpackage Template
 */

// Do not delete these lines
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die ( 'Please do not load this page directly. Thanks!' );
}

if ( post_password_required() ) { ?>
	<p class="nocomments"><?php _e( 'This post is password protected. Enter the password to view comments.', 'woothemes' ); ?></p>
<?php return; } ?>

<?php $comments_by_type = &separate_comments( $comments ); ?>    

<!-- You can start editing here. -->

<?php if ( have_comments() ) { ?>

<div id="comments">

	<?php if ( ! empty( $comments_by_type['comment'] ) ) { ?>
		<h3><?php comments_number( __( 'No Responses', 'woothemes' ), __( 'One Response', 'woothemes' ), __( '% Responses', 'woothemes' ) ); ?> <?php _e( 'to', 'woothemes' ); ?> &#8220;<?php the_title(); ?>&#8221;</h3>

		<ol class="commentlist">
	
			<?php wp_list_comments( 'avatar_size=60&callback=custom_comment&type=comment' ); ?>
		
		</ol>    

		<nav class="navigation fix">
			<div class="fl"><?php previous_comments_link(); ?></div>
			<div class="fr"><?php next_comments_link(); ?></div>
		</nav><!-- /.navigation -->
	<?php } ?>
		    
	<?php if ( ! empty( $comments_by_type['pings'] ) ) { ?>
    		
        <h3 id="pings"><?php _e( 'Trackbacks/Pingbacks', 'woothemes' ); ?></h3>
    
        <ol class="pinglist">
            <?php wp_list_comments( 'type=pings&callback=list_pings' ); ?>
        </ol>
    	
	<?php }; ?>
    	
</div> <!-- /#comments_wrap -->

<?php } else { // this is displayed if there are no comments so far ?>


	<?php 
		// If there are no comments and comments are closed, let's leave a little note, shall we?
		if ( comments_open() && is_singular() ) { ?>
			<div id="comments">
				<h5 class="nocomments"><?php _e( 'No comments yet.', 'woothemes' ); ?></h5>
			</div>
		<?php } ?>

<?php
	} // End IF Statement
	
	/* The Respond Form. Uses filters in the theme-functions.php file to customise the form HTML. */
	if ( comments_open() ) {
		if ( is_user_logged_in() ) { // if user logged in , we need to make text area full width.
		$comments_args = array(
        // redefining the textarea (the comment body)
        'comment_field' => '<p class="comment-form-comment"><textarea rows="5" id="comment" name="comment" aria-required="true">Comment</textarea></p><div class="fix"></div>',
);
		}
		else { 
		$comments_args = array(
        // redefining the textarea (the comment body)
        'comment_field' => '<p class="comment-form-comment fr"><textarea cols="45" rows="5" id="comment" name="comment" aria-required="true">Comment</textarea></p><div class="fix"></div>',
);
		}
comment_form($comments_args);
	}	
?>