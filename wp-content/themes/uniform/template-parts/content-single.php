<?php
/**
 * Template part for displaying single posts.
 *
 * @package Uniform
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php uniform_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
            $image_id = get_post_thumbnail_id();
            $image_path = wp_get_attachment_image_src( $image_id, 'uniform_single_default', true );
            $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
        ?>
            <div class="single-post-image">
                <figure><img src="<?php echo esc_url( $image_path[0] );?>" alt="<?php echo esc_attr( $image_alt );?>" title="<?php the_title(); ?>" /></figure>
            </div>
        <?php 
        	the_content();
        	
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'uniform' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
    <footer class="entry-footer">
        <?php edit_post_link( esc_html__( 'Edit', 'uniform' ), '<span class="edit-link">', '</span>' ); ?>
    </footer><!-- .entry-footer -->
    
</article><!-- #post-## -->