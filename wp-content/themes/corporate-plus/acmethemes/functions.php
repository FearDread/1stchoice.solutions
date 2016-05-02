<?php
/**
 * Callback functions for comments
 *
 * @since Corporate Plus 1.0.0
 *
 * @param $comment
 * @param $args
 * @param $depth
 * @return void
 *
 */
if ( !function_exists('corporate_plus_commment_list') ) :

    function corporate_plus_commment_list($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        extract($args, EXTR_SKIP);
        if ('div' == $args['style']) {
            $tag = 'div';
            $add_below = 'comment';
        }
        else {
            $tag = 'li';
            $add_below = 'div-comment';
        }
        ?>
        <<?php echo $tag ?>
        <?php comment_class(empty($args['has_children']) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
        <?php if ('div' != $args['style']) : ?>
            <div id="div-comment-<?php comment_ID() ?>" class="comment-body clearfix">
        <?php endif; ?>
        <div class="comment-author vcard">
            <?php if ($args['avatar_size'] != 0) echo get_avatar($comment, '64'); ?>
            <?php printf(__('<cite class="fn">%s</cite>', 'corporate-plus' ), get_comment_author_link()); ?>
        </div>
        <?php if ($comment->comment_approved == '0') : ?>
            <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'corporate-plus'); ?></em>
            <br/>
        <?php endif; ?>
        <div class="comment-meta commentmetadata">
            <a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
                <i class="fa fa-clock-o"></i>
                <?php
                /* translators: 1: date, 2: time */
                printf(__('%1$s at %2$s', 'corporate-plus'), get_comment_date(), get_comment_time()); ?>
            </a>
            <?php edit_comment_link(__('(Edit)', 'corporate-plus'), '  ', ''); ?>
        </div>
        <?php comment_text(); ?>
        <div class="reply">
            <?php comment_reply_link( array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
        </div>
        <?php if ('div' != $args['style']) : ?>
            </div>
        <?php endif; ?>
        <?php
    }
endif;

/**
 * Select sidebar according to the options saved
 *
 * @since Corporate Plus 1.0.0
 *
 * @param null
 * @return string
 *
 */
if ( !function_exists('corporate_plus_sidebar_selection') ) :
    function corporate_plus_sidebar_selection( ) {
        global $corporate_plus_customizer_all_values;
        if(
            'left-sidebar' == $corporate_plus_customizer_all_values['corporate-plus-sidebar-layout'] ||
            'no-sidebar' == $corporate_plus_customizer_all_values['corporate-plus-sidebar-layout']
        ){
            $corporate_plus_body_global_class = $corporate_plus_customizer_all_values['corporate-plus-sidebar-layout'];
        }
        else{
            $corporate_plus_body_global_class= 'right-sidebar';
        }
        return $corporate_plus_body_global_class;
    }
endif;

/**
 * BreadCrumb Settings
 */
if( ! function_exists( 'corporate_plus_breadcrumbs' ) ):
    function corporate_plus_breadcrumbs() {
        wp_reset_postdata();
        global $post;
        $trans_home = "<div class='breadcrumb'><i class='fa fa-home'></i></div>";

        $search_result_text = __( 'Search Results for ', 'corporate-plus' );

        $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
        $delimiter = '<span class="bread_arrow fa fa-angle-double-right"></span>'; // delimiter between crumbs
        $home = $trans_home; // text for the 'Home' link
        $showHomeLink = 1;

        $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
        $before = '<span class="current">'; // tag before the current crumb
        $after = '</span>'; // tag after the current crumb

        $homeLink = esc_url( home_url() );
        echo "<div class='breadcrumbs init-animate fadeInDown animated'>";
        if (is_home() || is_front_page()) {

            if ($showOnHome == 1) echo '<div id="corporate-plus-breadcrumbs"><div class="breadcrumb-container"><a href="' . $homeLink . '">' . $home . '</a></div></div>';

        } else {
            if($showHomeLink == 1){
                echo '<div id="corporate-plus-breadcrumbs" class="clearfix"><div class="breadcrumb-container"><a href="' . $homeLink . '">' . $home . '</a> ' . ' ';
            } else {
                echo '<div id="corporate-plus-breadcrumbs" class="clearfix"><div class="breadcrumb-container">' . $home . ' ' . ' ';
            }

            if ( is_category() ) {
                $thisCat = get_category(get_query_var('cat'), false);
                if ($thisCat->parent != 0) echo esc_html( get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ') );
                echo $before .  esc_html( single_cat_title('', false) ) . $after;

            } elseif ( is_search() ) {
                echo $before . $search_result_text.' "' . esc_html( get_search_query() ) . '"' . $after;

            } elseif ( is_day() ) {
                echo '<a href="' . esc_url( get_year_link(get_the_time('Y'))) . '">' . esc_attr( get_the_time('Y') ) . '</a> ' . $delimiter . ' ';
                echo '<a href="' . esc_url( get_month_link(get_the_time('Y'),get_the_time('m'))  ). '">' . esc_html( get_the_time('F') ) . '</a> ' . $delimiter . ' ';
                echo $before . esc_html( get_the_time('d') ) . $after;

            } elseif ( is_month() ) {
                echo '<a href="' . esc_url( get_year_link(get_the_time('Y'))  ). '">' . esc_html( get_the_time('Y') ) . '</a> ' . $delimiter . ' ';
                echo $before . esc_html( get_the_time('F') ) . $after;

            } elseif ( is_year() ) {
                echo $before . esc_html( get_the_time('Y') ) . $after;

            } elseif ( is_single() && !is_attachment() ) {
                if ( get_post_type() != 'post' ) {
                    $post_type = get_post_type_object(get_post_type());
                    $slug = $post_type->rewrite;
                    echo '<a href="' . $homeLink . '/' . esc_html( $slug['slug'] ) . '/">' . esc_html( $post_type->labels->singular_name ). '</a>';
                    if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . esc_html( get_the_title() ) . $after;
                } else {
                    $cat = get_the_category(); $cat = $cat[0];
                    $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                    if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
                    echo $cats;
                    if ($showCurrent == 1) echo $before . esc_html( get_the_title() ) . $after;
                }

            } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
                $post_type = get_post_type_object(get_post_type());
                echo $before . esc_html( $post_type->labels->singular_name ) . $after;

            } elseif ( is_attachment() ) {
                $parent = get_post($post->post_parent);
                $cat = get_the_category($parent->ID); $cat = $cat[0];
                echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                echo '<a href="' . esc_url( get_permalink($parent)) . '">' . esc_html( $parent->post_title ). '</a>';
                if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . esc_html( get_the_title() ) . $after;

            } elseif ( is_page() && !$post->post_parent ) {
                if ($showCurrent == 1) echo $before . esc_html( get_the_title() ). $after;

            } elseif ( is_page() && $post->post_parent ) {
                $parent_id  = $post->post_parent;
                $breadcrumbs = array();
                while ($parent_id) {
                    $page = get_post($parent_id);
                    $breadcrumbs[] = '<a href="' . esc_url( get_permalink($page->ID) ) . '">' . get_the_title($page->ID) . '</a>';
                    $parent_id  = $page->post_parent;
                }
                $breadcrumbs = array_reverse($breadcrumbs);
                for ($i = 0; $i < count($breadcrumbs); $i++) {
                    echo $breadcrumbs[$i];
                    if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
                }
                if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . esc_html( get_the_title() ) . $after;

            } elseif ( is_tag() ) {
                echo $before . __('Posts tagged :','corporate-plus') . esc_html( single_tag_title('', false) ). '"' . $after;

            } elseif ( is_author() ) {
                global $author;
                $userdata = get_userdata($author);
                echo $before . __('Author :','corporate-plus') . $userdata->display_name . $after;

            } elseif ( is_404() ) {
                echo $before . __('Error 404 :','corporate-plus') . $after;
            }
            else
            {

            }
            if ( get_query_var('paged') ) {
                if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
                echo __('Page' , 'corporate-plus') . ' ' . get_query_var('paged');
                if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
            }
            echo '</div></div>';
        }
        echo "</div>";
    }
endif;