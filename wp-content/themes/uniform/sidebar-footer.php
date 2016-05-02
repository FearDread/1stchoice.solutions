<?php
/**
 * The Sidebar containing the footer widget areas.
 *
 * @package Uniform
 */
?>

<?php
/**
 * The footer widget area is triggered if any of the areas
 * have widgets. So let's check that first.
 *
 * If none of the sidebars have widgets, then let's bail early.
 */
 
if( !is_active_sidebar( 'uniform_footer_sidebar_one' ) &&
	!is_active_sidebar( 'uniform_footer_sidebar_two' ) &&
   !is_active_sidebar( 'uniform_footer_sidebar_three' ) &&
   !is_active_sidebar( 'uniform_footer_sidebar_four' ) ) {
	return;
}
$uniform_footer_layout = get_theme_mod( 'footer_widget_option', 'column4' );
?>
<div class="footer-widgets-wrapper clearfix">
	<div class="mt-container <?php echo esc_attr( $uniform_footer_layout ); ?> ">
		<div class="footer-widgets-area clearfix">
            <div class="mt-footer-widget-wrapper clearfix">
            		<div class="mt-first-footer-widget mt-footer-widget">
            			<?php
            			if ( !dynamic_sidebar( 'uniform_footer_sidebar_one' ) ):
            			endif;
            			?>
            		</div>
        		<?php if( $uniform_footer_layout != 'column1' ){ ?>
                    <div class="mt-second-footer-widget mt-footer-widget">
            			<?php
            			if ( !dynamic_sidebar( 'uniform_footer_sidebar_two' ) ):
            			endif;
            			?>
            		</div>
                <?php } ?>
                <?php if( $uniform_footer_layout == 'column3' || $uniform_footer_layout == 'column4' ){ ?>
                    <div class="mt-third-footer-widget mt-footer-widget">
                       <?php
                       if ( !dynamic_sidebar( 'uniform_footer_sidebar_three' ) ):
                       endif;
                       ?>
                    </div>
                <?php } ?>
                <?php if( $uniform_footer_layout == 'column4' ){ ?>
                    <div class="mt-fourth-footer-widget mt-footer-widget">
                       <?php
                       if ( !dynamic_sidebar( 'uniform_footer_sidebar_four' ) ):
                       endif;
                       ?>
                    </div>
                <?php } ?>
            </div>
		</div>
	</div>
</div>