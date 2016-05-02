<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package AcmeThemes
 * @subpackage Corporate Plus
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('init-animate fadeInDown animated'); ?>>
	<div class="single-feat clearfix">
		<?php
		$sidebar_layout = corporate_plus_sidebar_selection();
		if( has_post_thumbnail() ):
			if( $sidebar_layout == "no-sidebar"){
				$thumbnail = 'full';
			}
			else{
				$thumbnail = 'large';
			}
			echo '<figure class="single-thumb single-thumb-full">';
			the_post_thumbnail( $thumbnail );
			echo "</figure>";
		endif;
		?>
	</div><!-- .single-feat-->
	<div class="content-wrapper">
		<div class="entry-content">
			<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'corporate-plus' ),
				'after'  => '</div>',
			) );
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
				/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'corporate-plus' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	</div>

</article><!-- #post-## -->