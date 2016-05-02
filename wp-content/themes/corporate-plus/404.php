<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package AcmeThemes
 * @subpackage Corporate Plus
 */
get_header();
global $corporate_plus_customizer_all_values;
?>
<div class="wrapper inner-main-title init-animate fadeInDown animated">
	<header>
		<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'corporate-plus' ); ?></h1>
	</header>
</div>
<div id="content" class="site-content">
	<?php
	if( 1 == $corporate_plus_customizer_all_values['corporate-plus-show-breadcrumb'] ){
		corporate_plus_breadcrumbs();
	}
	?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<section class="error-404 not-found">
				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'corporate-plus' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

</div><!-- #content -->
<?php get_footer(); ?>
