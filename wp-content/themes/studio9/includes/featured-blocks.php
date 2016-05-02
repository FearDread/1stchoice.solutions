<?php 
	global $woo_options;
?>
<?php if ( '' != $woo_options['woo_homepage_featured_blocks'] ) { ?>

		<section id="featured-blocks" class="overflow featured-blocks-sc home-section fix">
				<article class="one">
					<?php if ( !empty($woo_options['woo_homepage_block1_link'] ) ) { ?>
					<h4><a href="<?php echo $woo_options['woo_homepage_block1_link']; ?>"><?php echo $woo_options['woo_homepage_block1_title']; ?></a></h4>
					<?php } else { ?>
					<h4><?php echo $woo_options['woo_homepage_block1_title']; ?></h4>
					<?php } ?>
					<p><?php echo nl2br( do_shortcode( $woo_options['woo_homepage_block1_message'] ) ); ?></p>


				<figure class="over">
					<div class="overview" style="visibility: hidden;">
						<?php if ( !empty($woo_options['woo_homepage_block1_link'] ) ) { ?>
						<span class="over-view"><a href="<?php echo $woo_options['woo_homepage_block1_image']; ?>" class="over-cap item drop-shadow curved curved-hz-1" title="" data-rel="lightbox"></a><a href="<?php echo $woo_options['woo_homepage_block1_link']; ?>" class="over-details"></a></span>
						<?php }?>
					</div>
						<?php woo_image( 'width=214&height=125&src=' . $woo_options['woo_homepage_block1_image'] ); ?>
				</figure>

				</article>

				<article class="one">
					<?php if ( !empty($woo_options['woo_homepage_block2_link'] ) ) { ?>
					<h4><a href="<?php echo $woo_options['woo_homepage_block2_link']; ?>"><?php echo $woo_options['woo_homepage_block2_title']; ?></a></h4>
					<?php } else { ?>
					<h4><?php echo $woo_options['woo_homepage_block2_title']; ?></h4>
					<?php } ?>
					<p><?php echo nl2br( do_shortcode( $woo_options['woo_homepage_block2_message'] ) ); ?></p>


				<figure class="over">
					<div class="overview" style="visibility: hidden;">
						<?php if ( !empty($woo_options['woo_homepage_block2_link'] ) ) { ?>
						<span class="over-view"><a href="<?php echo $woo_options['woo_homepage_block2_image']; ?>" class="over-cap item drop-shadow curved curved-hz-1" title="" data-rel="lightbox"></a><a href="<?php echo $woo_options['woo_homepage_block2_link']; ?>" class="over-details"></a></span>
						<?php }?>
					</div>
						<?php woo_image( 'width=213&height=125&src=' . $woo_options['woo_homepage_block2_image'] ); ?>
				</figure>

				</article>


				<article class="one">
					<?php if ( !empty($woo_options['woo_homepage_block3_link'] ) ) { ?>
					<h4><a href="<?php echo $woo_options['woo_homepage_block3_link']; ?>"><?php echo $woo_options['woo_homepage_block3_title']; ?></a></h4>
					<?php } else { ?>
					<h4><?php echo $woo_options['woo_homepage_block3_title']; ?></h4>
					<?php } ?>
					<p><?php echo nl2br( do_shortcode( $woo_options['woo_homepage_block3_message'] ) ); ?></p>


				<figure class="over">
					<div class="overview" style="visibility: hidden;">
						<?php if ( !empty($woo_options['woo_homepage_block3_link'] ) ) { ?>
						<span class="over-view"><a href="<?php echo $woo_options['woo_homepage_block3_image']; ?>" class="over-cap item drop-shadow curved curved-hz-1" title="" data-rel="lightbox"></a><a href="<?php echo $woo_options['woo_homepage_block3_link']; ?>" class="over-details"></a></span>
						<?php }?>
					</div>
						<?php woo_image( 'width=213&height=125&src=' . $woo_options['woo_homepage_block3_image'] ); ?>
				</figure>

				</article>


				<article class="one last">
					<?php if ( !empty($woo_options['woo_homepage_block4_link'] ) ) { ?>
					<h4><a href="<?php echo $woo_options['woo_homepage_block4_link']; ?>"><?php echo $woo_options['woo_homepage_block4_title']; ?></a></h4>
					<?php } else { ?>
					<h4><?php echo $woo_options['woo_homepage_block4_title']; ?></h4>
					<?php } ?>
					<p><?php echo nl2br( do_shortcode( $woo_options['woo_homepage_block4_message'] ) ); ?></p>


				<figure class="over">
					<div class="overview" style="visibility: hidden;">
						<?php if ( !empty($woo_options['woo_homepage_block4_link'] ) ) { ?>
						<span class="over-view"><a href="<?php echo $woo_options['woo_homepage_block4_image']; ?>" class="over-cap item drop-shadow curved curved-hz-1" title="" data-rel="lightbox"></a><a href="<?php echo $woo_options['woo_homepage_block4_link']; ?>" class="over-details"></a></span>
						<?php }?>
					</div>
						<?php woo_image( 'width=213&height=125&src=' . $woo_options['woo_homepage_block4_image'] ); ?>
				</figure>

				</article>

		</section>

<!--/#featured blocks -->
<?php  
}?>