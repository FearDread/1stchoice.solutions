<?php
/**
 * Template part for displaying posts.
 *
 * @package Uniform
 */
wp_reset_postdata();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php uniform_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
            $image_id = get_post_thumbnail_id();
            $image_path = wp_get_attachment_image_src( $image_id, 'uniform_single_default', true );
            $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
        ?>
            <div class="single-post-image">
                <figure><img src="<?php echo esc_url( $image_path[0] );?>" alt="<?php echo esc_attr( $image_alt );?>" title="<?php the_title();?>" /></figure>
            </div>
        <?php
			the_excerpt();
            //the_content( sprintf(
//				/* translators: %s: Name of current post. */
//				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'uniform' ), array( 'span' => array( 'class' => array() ) ) ),
//				the_title( '<span class="screen-reader-text">"', '"</span>', false )
//			) );
		?>
        <div class="post-readmore"><a href="<?php the_permalink();?>"> Read More </a> </div>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'uniform' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
