<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AcmeThemes
 * @subpackage AcmeBlog
 */

/**
 * corporate_plus_action_before_head hook
 * @since Corporate Plus 1.0.0
 *
 * @hooked corporate_plus_set_global -  0
 * @hooked corporate_plus_doctype -  10
 */
do_action( 'corporate_plus_action_before_head' );?>
	<head>

		<?php
		/**
		 * corporate_plus_action_before_wp_head hook
		 * @since Corporate Plus 1.0.0
		 *
		 * @hooked corporate_plus_before_wp_head -  10
		 */
		do_action( 'corporate_plus_action_before_wp_head' );

		wp_head();
		?>

	</head>
<body <?php body_class();?>>

<?php
/**
 * corporate_plus_action_before hook
 * @since Corporate Plus 1.0.0
 *
 * @hooked corporate_plus_site_start - 20
 */
do_action( 'corporate_plus_action_before' );

/**
 * corporate_plus_action_before_header hook
 * @since Corporate Plus 1.0.0
 *
 * @hooked corporate_plus_skip_to_content - 10
 */
do_action( 'corporate_plus_action_before_header' );


/**
 * corporate_plus_action_header hook
 * @since Corporate Plus 1.0.0
 *
 * @hooked corporate_plus_header - 10
 */
do_action( 'corporate_plus_action_header' );


/**
 * corporate_plus_action_after_header hook
 * @since Corporate Plus 1.0.0
 *
 * @hooked null
 */
do_action( 'corporate_plus_action_after_header' );


/**
 * corporate_plus_action_before_content hook
 * @since Corporate Plus 1.0.0
 *
 * @hooked null
 */
do_action( 'corporate_plus_action_before_content' );