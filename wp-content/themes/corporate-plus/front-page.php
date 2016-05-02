<?php
/**
 * The front-page template file.
 *
 * @package AcmeThemes
 * @subpackage Corporate Plus
 * @since Corporate Plus 1.1.0
 */
get_header(); ?>
<?php
/**
 * corporate_plus_action_front_page hook
 * @since Corporate Plus 1.1.0
 *
 * @hooked corporate_plus_featured_slider -  10
 * @hooked corporate_plus_front_page -  20
 */
do_action( 'corporate_plus_action_front_page' );
?>
<?php get_footer();