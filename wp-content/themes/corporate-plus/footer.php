<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AcmeThemes
 * @subpackage Corporate Plus
 */


/**
 * corporate_plus_action_after_content hook
 * @since Corporate Plus 1.0.0
 *
 * @hooked null
 */
do_action( 'corporate_plus_action_after_content' );

/**
 * corporate_plus_action_before_footer hook
 * @since Corporate Plus 1.0.0
 *
 * @hooked null
 */
do_action( 'corporate_plus_action_before_footer' );

/**
 * corporate_plus_action_footer hook
 * @since Corporate Plus 1.0.0
 *
 * @hooked corporate_plus_footer - 10
 */
do_action( 'corporate_plus_action_footer' );

/**
 * corporate_plus_action_after_footer hook
 * @since Corporate Plus 1.0.0
 *
 * @hooked null
 */
do_action( 'corporate_plus_action_after_footer' );

/**
 * corporate_plus_action_after hook
 * @since Corporate Plus 1.0.0
 *
 * @hooked corporate_plus_page_end - 10
 */
do_action( 'corporate_plus_action_after' );
?>
<?php wp_footer(); ?>
</body>
</html>