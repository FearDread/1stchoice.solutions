<?php
/**
 * Custom function defines 
 * 
 * @package Uniform
 */
 
 /**
 * Enqueue script and style for admin 
 * 
 */

add_action( 'admin_enqueue_scripts', 'uniform_admin_scripts_styles' ); 

if( ! function_exists( 'uniform_admin_scripts_styles' ) ):
    function uniform_admin_scripts_styles() {
        
        /**
         * Add custom css for admin section
         */
        wp_register_style( 'custom_wp_admin_css', UNIFORM_ADMIN_URL . '/css/admin-style.css', false, UNIFORM_THEME_VERSION );
        wp_enqueue_style( 'custom_wp_admin_css' );
        
        /**
         * Add custom script for admin section
         */    
        wp_enqueue_script( 'custom_wp_admin_script', UNIFORM_ADMIN_URL . '/js/admin-scripts.js', array(), UNIFORM_THEME_VERSION, true );
         
    }
endif;

/*=====================================================================================================*/ 
 /**
 * Enqueue scripts and styles.
 */
if( !function_exists( 'uniform_scripts' ) ):
    function uniform_scripts() {
        
        $query_args = array(
            'family' => 'Open+Sans:400,400italic,300italic,300,600,600italic',
        );
        
        wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/font-awesome/css/font-awesome.min.css', array(), '4.5.0' );

        wp_enqueue_style( 'uniform-google-fonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ) );
        
        wp_enqueue_style( 'uniform-style', get_stylesheet_uri(), array(), UNIFORM_THEME_VERSION );
        
        wp_enqueue_style( 'uniform-responsive', get_template_directory_uri() . '/css/responsive.css');

    	wp_enqueue_script( 'bxSlider', UNIFORM_JS_URL . '/jquery.bxslider.js', array( 'jquery' ), '4.1.2', true );
        
        wp_enqueue_script( 'uniform-navigation', UNIFORM_JS_URL . '/navigation.js', array(), '20120206', true );

    	wp_enqueue_script( 'uniform-skip-link-focus-fix', UNIFORM_JS_URL . '/skip-link-focus-fix.js', array(), '20130115', true );
        
        if (get_theme_mod('sticky_menu_option', 0) == 1) {
              wp_enqueue_script( 'uniform-sticky-menu', UNIFORM_JS_URL. '/sticky/jquery.sticky.js', array( 'jquery' ), '20150309', true );
        
              wp_enqueue_script( 'uniform-sticky-menu-setting', UNIFORM_JS_URL. '/sticky/sticky-setting.js', array( 'uniform-sticky-menu' ), '20150309', true );
        }

        wp_enqueue_script( 'uniform-custom-scripts', UNIFORM_JS_URL . '/custom-scripts.js', array( 'jquery' ), UNIFORM_THEME_VERSION, true );	
        
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    		wp_enqueue_script( 'comment-reply' );
    	}
    }
endif;
add_action( 'wp_enqueue_scripts', 'uniform_scripts' );

if( !function_exists( 'uniform_dynamic_styles' ) ):
    function uniform_dynamic_styles() {
        wp_enqueue_style('uniform-dynamic-style', UNIFORM_CSS_URL . '/styles.php', array(), UNIFORM_THEME_VERSION );
    }
endif;
add_action('wp_enqueue_scripts', 'uniform_dynamic_styles', 15);

/*=====================================================================================================*/
/**
 * Add filter in wp_hed
 */

add_filter( 'wp_head', 'uniform_wp_head' );
 
if( !function_exists( 'uniform_wp_head' ) ):
    function uniform_wp_head() {
        $homeslider_control = ( get_theme_mod( 'slider_control_option', 'hide' ) == 'show' ) ? 'true' : 'false';
        $homeslider_pager = ( get_theme_mod( 'slider_pager_option', 'show' ) == 'show' ) ? 'true' : 'false';
        $homeslider_transaction = ( get_theme_mod( 'slider_transaction_option', 'auto' ) == 'auto' ) ? 'true' : 'false';
    ?>
        <script type="text/javascript">
                jQuery(function($) {
                    $('#homepage-slider .bx-slider').bxSlider({
                        adaptiveHeight: true,
                        pager: <?php echo $homeslider_pager ;?>,
                        controls: <?php echo $homeslider_control ;?>,
                        auto: <?php echo $homeslider_transaction ;?>
                    });
                    
                     $('.testimonials-slider').bxSlider({
                            adaptiveHeight: true,
                            pager:false,
                       });
                });
        </script>
    <?php
    }
endif;

/*=====================================================================================================*/ 
add_filter( 'body_class', 'uniform_custom_body_class' );
/**
 * Added custom body class
 */

if( !function_exists( 'uniform_custom_body_class' ) ):
    
    function uniform_custom_body_class( $classes ) {
    	global $post;

    	if( $post ) { $sidebar_meta = get_post_meta( $post->ID, 'uniform_page_sidebar', true ); }
        
    	if( is_home() ) {
    		$queried_id = get_option( 'page_for_posts' );
    		$sidebar_meta = get_post_meta( $queried_id, 'uniform_page_sidebar', true );
    	}
    	if( empty( $sidebar_meta ) || is_archive() || is_search() ) { $sidebar_meta = 'default_sidebar'; }
    	$uniform_default_sidebar = get_theme_mod( 'uniform_archive_sidebar', 'right_sidebar' );

    	$uniform_default_page_sidebar = get_theme_mod( 'uniform_default_page_sidebar', 'right_sidebar' );
    	$uniform_default_post_sidebar = get_theme_mod( 'uniform_default_single_posts_sidebar', 'right_sidebar' );
        
    	if( $sidebar_meta == 'default_sidebar' ) {
    		if( is_page() ) {
    			if( $uniform_default_page_sidebar == 'right_sidebar' ) { $classes[] = ''; }
    			elseif( $uniform_default_page_sidebar == 'left_sidebar' ) { $classes[] = 'left-sidebar'; }
    			elseif( $uniform_default_page_sidebar == 'no_sidebar_full_width' ) { $classes[] = 'no-sidebar-full-width'; }
    		}
    		elseif( is_single() ) {
    			if( $uniform_default_post_sidebar == 'right_sidebar' ) { $classes[] = ''; }
    			elseif( $uniform_default_post_sidebar == 'left_sidebar' ) { $classes[] = 'left-sidebar'; }
    			elseif( $uniform_default_post_sidebar == 'no_sidebar_full_width' ) { $classes[] = 'no-sidebar-full-width'; }
    		}
    		elseif( $uniform_default_sidebar == 'right_sidebar' ) { $classes[] = ''; }
    		elseif( $uniform_default_sidebar == 'left_sidebar' ) { $classes[] = 'left-sidebar'; }
    		elseif( $uniform_default_sidebar == 'no_sidebar_full_width' ) { $classes[] = 'no-sidebar-full-width'; }
    	}
    	elseif( $sidebar_meta == 'right_sidebar' ) { $classes[] = ''; }
    	elseif( $sidebar_meta == 'left_sidebar' ) { $classes[] = 'left-sidebar'; }
    	elseif( $sidebar_meta == 'no_sidebar_full_width' ) { $classes[] = 'no-sidebar-full-width'; }

    	if( get_theme_mod( 'site_layout_option', 'wide_layout' ) == 'wide_layout' ) {
        		$classes[] = 'fullwidth-layout';
        	}
        	elseif( get_theme_mod( 'site_layout_option', 'wide_layout' ) == 'boxed_layout' ) {
        		$classes[] = 'boxed-layout';
        	}

    	return $classes;
    }
endif;

/*=====================================================================================================*/ 
if ( ! function_exists( 'uniform_sidebar_select' ) ) :
/**
 * Function to select the sidebar
 */
    function uniform_sidebar_select() {
    	global $post;

    	if( $post ) { $sidebar_meta = get_post_meta( $post->ID, 'uniform_page_sidebar', true ); }

    	if( is_home() ) {
    		$queried_id = get_option( 'page_for_posts' );
    		$sidebar_meta = get_post_meta( $queried_id, 'uniform_page_sidebar', true );
    	}

    	if( empty( $sidebar_meta ) || is_archive() || is_search() ) { $sidebar_meta = 'default_sidebar'; }
    	$uniform_default_sidebar = get_theme_mod( 'uniform_default_sidebar', 'right_sidebar' );

    	$uniform_default_page_sidebar = get_theme_mod( 'uniform_default_page_sidebar', 'right_sidebar' );
    	$uniform_default_post_sidebar = get_theme_mod( 'uniform_default_single_posts_sidebar', 'right_sidebar' );

    	if( $sidebar_meta == 'default_sidebar' ) {
    		if( is_page() ) {
    			if( $uniform_default_page_sidebar == 'right_sidebar' ) { get_sidebar(); }
    			elseif ( $uniform_default_page_sidebar == 'left_sidebar' ) { get_sidebar( 'left' ); }
    		}
    		if( is_single() ) {
    			if( $uniform_default_post_sidebar == 'right_sidebar' ) { get_sidebar(); }
    			elseif ( $uniform_default_post_sidebar == 'left_sidebar' ) { get_sidebar( 'left' ); }
    		}
    		elseif( $uniform_default_sidebar == 'right_sidebar' ) { get_sidebar(); }
    		elseif ( $uniform_default_sidebar == 'left_sidebar' ) { get_sidebar( 'left' ); }
    	}
    	elseif( $sidebar_meta == 'right_sidebar' ) { get_sidebar(); }
    	elseif( $sidebar_meta == 'left_sidebar' ) { get_sidebar( 'left' ); }
    }
endif;

/*=====================================================================================================*/
/**
 * Top Header  
 */
if( !function_exists( 'uniform_top_header' ) ):
    function uniform_top_header() {
        $header_show_option = get_theme_mod( 'top_header_option', '0' );
        if( $header_show_option != '1' ) {
            $top_email = get_theme_mod( 'top_header_email', 'info@example.com' );
            $top_phone = get_theme_mod( 'top_header_phone', '+167-157-5987' );
            $top_fb = get_theme_mod( 'social_fb_link', 'https://facebook.com/' );
            $top_tw = get_theme_mod( 'social_tw_link', 'https://twitter.com/' );
            $top_gp = get_theme_mod( 'social_gp_link', 'https://plus.google.com/' );
            $top_lnk = get_theme_mod( 'social_lnk_link', 'https://linkedin.com/' );
            $top_yt = get_theme_mod( 'social_yt_link', 'https://youtube.com/' );
            $top_vm = get_theme_mod( 'social_vm_link', 'https://vimeo.com/' );
            $top_pin = get_theme_mod( 'social_pin_link', 'https://www.pinterest.com/' );
            $top_insta = get_theme_mod( 'social_insta_link', 'https://www.instagram.com/' );
        ?>
            <div class="top-header-wrapper clearfix">
                <div class="mt-container">
                    <div class="left-section">
                        <?php if( !empty( $top_email ) ){ ?><span class="cnt-info"><a href="mailto:<?php echo esc_attr ( $top_email ); ?>"><i class="fa fa-envelope"></i><?php echo esc_attr( $top_email ); ?></a></span><?php } ?>
                        <?php if( !empty( $top_phone ) ){ ?><span class="cnt-info"><a href="tel:<?php echo esc_attr( $top_phone ); ?>"><i class="fa fa-phone"></i><?php echo esc_attr( $top_phone ); ?></a></span><?php } ?>
                    </div>
                    <div class="right-section">
                        <?php if( !empty( $top_fb ) ){ ?><span class="social-link"><a href="<?php echo esc_url( $top_fb ); ?>" target="_blank"><i class="fa  fa-facebook"></i></a></span><?php } ?>
                        <?php if( !empty( $top_tw ) ){ ?><span class="social-link"><a href="<?php echo esc_url( $top_tw ); ?>" target="_blank"><i class="fa fa-twitter"></i></a></span><?php } ?>
                        <?php if( !empty( $top_gp ) ){ ?><span class="social-link"><a href="<?php echo esc_url( $top_gp ); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></span><?php } ?>
                        <?php if( !empty( $top_lnk ) ){ ?><span class="social-link"><a href="<?php echo esc_url( $top_lnk ); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></span><?php } ?>
                        <?php if( !empty( $top_yt ) ){ ?><span class="social-link"><a href="<?php echo esc_url( $top_yt ); ?>" target="_blank"><i class="fa fa-youtube"></i></a></span><?php } ?>
                        <?php if( !empty( $top_vm ) ){ ?><span class="social-link"><a href="<?php echo esc_url( $top_vm ); ?>" target="_blank"><i class="fa fa-vimeo"></i></a></span><?php } ?>
                        <?php if( !empty( $top_pin ) ){ ?><span class="social-link"><a href="<?php echo esc_url( $top_pin ); ?>" target="_blank"><i class="fa fa-pinterest"></i></a></span><?php } ?>
                        <?php if( !empty( $top_insta ) ){ ?><span class="social-link"><a href="<?php echo esc_url( $top_insta ); ?>" target="_blank"><i class="fa fa-instagram"></i></a></span><?php } ?>
                    </div>
                </div>
            </div>
        <?php
        }
    }
endif;

/*=====================================================================================================*/
/**
 * BreadCrumb
 */
if( !function_exists( 'uniform_breadcrumbs' ) ):
    function uniform_breadcrumbs() {
        global $post;
        $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show

        $delimiter = '&raquo;';

        $home = __( 'Home', 'uniform' );

        $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
        $before = '<span class="current">'; // tag before the current crumb
        $after = '</span>'; // tag after the current crumb

        $homeLink = home_url();

        if (is_home() || is_front_page()) {

            if ($showOnHome == 1)
                echo '<div id="uniform-breadcrumb"><a href="' . $homeLink . '">' . $home . '</a></div></div>';
        } else {

            echo '<div id="uniform-breadcrumb"><div class="mt-container"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';

            if (is_category()) {
                $thisCat = get_category(get_query_var('cat'), false);
                if ($thisCat->parent != 0)
                    echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
                echo $before . __( 'Archive by category', 'uniform' ).' "' . single_cat_title('', false) . '"' . $after;
            } elseif (is_search()) {
                echo $before . __( 'Search results for', 'uniform' ). '"' . get_search_query() . '"' . $after;
            } elseif (is_day()) {
                echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
                echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
                echo $before . get_the_time('d') . $after;
            } elseif (is_month()) {
                echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
                echo $before . get_the_time('F') . $after;
            } elseif (is_year()) {
                echo $before . get_the_time('Y') . $after;
            } elseif (is_single() && !is_attachment()) {
                if (get_post_type() != 'post') {
                    $post_type = get_post_type_object(get_post_type());
                    $slug = $post_type->rewrite;
                    echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
                    if ($showCurrent == 1)
                        echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
                } else {
                    $cat = get_the_category();
                    $cat = $cat[0];
                    $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                    if ($showCurrent == 0)
                        $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
                    echo $cats;
                    if ($showCurrent == 1)
                        echo $before . get_the_title() . $after;
                }
            } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
                $post_type = get_post_type_object(get_post_type());
                echo $before . $post_type->labels->singular_name . $after;
            } elseif (is_attachment()) {
                if ($showCurrent == 1) echo ' ' . $before . get_the_title() . $after;
            } elseif (is_page() && !$post->post_parent) {
                if ($showCurrent == 1)
                    echo $before . get_the_title() . $after;
            } elseif (is_page() && $post->post_parent) {
                $parent_id = $post->post_parent;
                $breadcrumbs = array();
                while ($parent_id) {
                    $page = get_page($parent_id);
                    $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                    $parent_id = $page->post_parent;
                }
                $breadcrumbs = array_reverse($breadcrumbs);
                for ($i = 0; $i < count($breadcrumbs); $i++) {
                    echo $breadcrumbs[$i];
                    if ($i != count($breadcrumbs) - 1)
                        echo ' ' . $delimiter . ' ';
                }
                if ($showCurrent == 1)
                    echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
            } elseif (is_tag()) {
                echo $before . __( 'Posts tagged','uniform' ).' "' . single_tag_title('', false) . '"' . $after;
            } elseif (is_author()) {
                global $author;
                $userdata = get_userdata($author);
                echo $before . __( 'Articles posted by ','uniform' ). $userdata->display_name . $after;
            } elseif (is_404()) {
                echo $before .  __( 'Error 404 ','uniform' ) . $after;
            }

            if (get_query_var('paged')) {
                if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                    echo ' (';
                echo __('Page', 'uniform') . ' ' . get_query_var('paged');
                if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                    echo ')';
            }

            echo '</div></div>';
        }
    }
endif;

/*=====================================================================================================*/
/**
 * Custom Excerpt type 
 */
if( !function_exists( 'uniform_excerpt_more' ) ):
    function uniform_excerpt_more( $excerpt ) {
    	//return str_replace( '[...]', '...', $excerpt );
        return ' .....';
    }
endif;
add_filter( 'excerpt_more', 'uniform_excerpt_more' );