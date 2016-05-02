<?php
/**
 * Comment Form
 *
 * @since Corporate Plus 1.0.0
 *
 * @param array $form
 * @return array $form
 *
 */
if ( !function_exists('corporate_plus_alter_comment_form') ) :

    function corporate_plus_alter_comment_form($form) {

        $required = get_option('require_name_email');
        $req = $required ? 'aria-required="true"' : '';
        $form['fields']['author'] = '<p class="comment-form-author"><label for="author"></label><input id="author" name="author" type="text" placeholder="'.__( 'Name', 'corporate-plus' ).'" value="" size="30" ' . $req . '/></p>';
        $form['fields']['email'] = '<p class="comment-form-email"><label for="email"></label> <input id="email" name="email" type="email" value="" placeholder="'.__( 'Email', 'corporate-plus' ).'" size="30"' . $req . '/></p>';
        $form['fields']['url'] = '<p class="comment-form-url"><label for="url"></label> <input id="url" name="url" placeholder="'.__( 'Website URL', 'corporate-plus' ).'" type="url" value="" size="30" /></p>';
        $form['comment_field'] = '<p class="comment-form-comment"><label for="comment"></label> <textarea id="comment" name="comment" placeholder="'.__( 'Comment', 'corporate-plus' ).'" cols="45" rows="8" aria-required="true"></textarea></p>';
        $form['comment_notes_before'] = '';
        $form['label_submit'] = __( 'Add Comment', 'corporate-plus' );
        $form['title_reply'] = sprintf( __( '%s Leave a Comment', 'corporate-plus' ), '<span></span>' );

        return $form;
    }

endif;

add_filter('comment_form_defaults', 'corporate_plus_alter_comment_form');