<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package AcmeThemes
 * @subpackage Corporate Plus
 */
global $corporate_plus_customizer_all_values;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('init-animate fadeInDown animated'); ?>>
	<div class="content-wrapper">
		<header class="entry-header">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			<?php if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php corporate_plus_posted_on(); ?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<?php
		if ( $corporate_plus_customizer_all_values['corporate-plus-blog-archive-layout'] == 'left-image' && has_post_thumbnail() ) {
			?>
			<!--post thumbnal options-->
			<div class="post-thumb">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( 'thumbnail' );?>
				</a>
			</div><!-- .post-thumb-->
			<?php
		}
		?>

		<div class="entry-summary entry-content">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->

		<footer class="entry-footer">
			<?php corporate_plus_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</div>

</article><!-- #post-## -->