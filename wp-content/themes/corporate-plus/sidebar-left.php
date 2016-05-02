<?php
/**
 * The left sidebar containing the main widget area.
 */
if ( ! is_active_sidebar( 'corporate-plus-sidebar' ) ) {
    return;
}
$sidebar_layout = corporate_plus_sidebar_selection();
?>
<?php if( $sidebar_layout == "left-sidebar" ) : ?>
    <div id="secondary-left" class="widget-area sidebar secondary-sidebar init-animate fadeInDown animated" role="complementary">
        <div id="sidebar-section-top" class="widget-area sidebar clearfix">
            <?php dynamic_sidebar( 'corporate-plus-sidebar' ); ?>
        </div>
    </div>
<?php endif; ?>
