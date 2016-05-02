<?php
/**
 * Sanitization and definitions 
 * 
 * @package Uniform
 */
 
    //Text
    function uniform_sanitize_text( $input ) {
        return wp_kses_post( force_balance_tags( $input ) );
    }
    
    //Email
    function uniform_sanitize_email( $input ) {
        return sanitize_email( $input );
    }
    
    //Checkboxes
    function uniform_sanitize_checkbox( $input ) {
        if ( $input == 1 ) {
            return 1;
        } else {
            return 0;
        }
    }
    
    //Posts per page option
    function uniform_posts_perpage_option( $input ) {
        $valid = array(
            'allposts' => __( 'All Posts', 'uniform' ),
            'countposts' => __( 'Numbers of Posts', 'uniform' )
        );
        if ( array_key_exists( $input, $valid ) ) {
            return $input;
        } else {
            return '';
        }
    }
    
    //Footer widget areas
    function uniform_sanitize_footer_widget( $input ) {        
        $valid = array(
            'column1'     => __( 'One', 'uniform' ),
            'column2'     => __( 'Two', 'uniform' ),
            'column3'     => __( 'Three', 'uniform' ),
            'column4'     => __( 'Four', 'uniform' )
        );
        if ( array_key_exists( $input, $valid ) ) {
            return $input;
        } else {
            return '';
        }
    }
    
    // site layout
    function uniform_sanitize_site_layout( $input ) {
        $valid_keys = array(
            'wide_layout' => __( 'Wide Layout', 'uniform' ),
            'boxed_layout' => __( 'Boxed Layout', 'uniform' )
            );
        if ( array_key_exists( $input, $valid_keys ) ) {
            return $input;
        } else {
            return '';
        }
   }
   
   // Show/Hide  control
    function uniform_show_hide_sanitize( $input ) {
        $valid_keys = array(
                'show'     => __( 'Show', 'uniform' ),
                'hide'   => __( 'Hide', 'uniform' ),
            );
        if ( array_key_exists( $input, $valid_keys ) ) {
            return $input;
        } else {
            return '';
        }
   }

   // Enable/Disable  control
    function uniform_sanitize_enable_disable( $input ) {
        $valid_keys = array(
                'enable'     => __( 'Enable', 'uniform' ),
                'disable'   => __( 'Disable', 'uniform' ),
            );
        if ( array_key_exists( $input, $valid_keys ) ) {
            return $input;
        } else {
            return '';
        }
   }
   
   // Slider  pager
    function uniform_sanitize_slider_pager( $input ) {
        $valid_keys = array(
                'show'     => __( 'Show', 'uniform' ),
                'hide'   => __( 'Hide', 'uniform' ),
            );
        if ( array_key_exists( $input, $valid_keys ) ) {
            return $input;
        } else {
            return '';
        }
   }
   
   // Slider  transaction
    function uniform_sanitize_slider_transaction( $input ) {
        $valid_keys = array(
                'auto'     => __( 'Auto', 'uniform' ),
                'manual'   => __( 'Manual', 'uniform' ),
            );
        if ( array_key_exists( $input, $valid_keys ) ) {
            return $input;
        } else {
            return '';
        }
   }
   
   // Slider  description
    function uniform_sanitize_slider_description( $input ) {
        $valid_keys = array(
                'show'     => __( 'Show', 'uniform' ),
                'hide'   => __( 'Hide', 'uniform' ),
            );
        if ( array_key_exists( $input, $valid_keys ) ) {
            return $input;
        } else {
            return '';
        }
   }
   
   /*// Call to Action control
    function uniform_sanitize_cta( $input ) {
        $valid_keys = array(
                'show'     => __( 'Show', 'uniform' ),
                'hide'   => __( 'Hide', 'uniform' ),
            );
        if ( array_key_exists( $input, $valid_keys ) ) {
            return $input;
        } else {
            return '';
        }
   }*/
   
   //Design layout for post/page/archvie
    function uniform_page_layout_sanitize($input) {
   	$valid_keys = array(
            'right_sidebar' => UNIFORM_ADMIN_IMAGES_URL . '/right-sidebar.png',
			'left_sidebar' => UNIFORM_ADMIN_IMAGES_URL . '/left-sidebar.png',
			'no_sidebar_full_width'	=> UNIFORM_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png'
      );
      if ( array_key_exists( $input, $valid_keys ) ) {
         return $input;
      } else {
         return '';
      }
   }
   
   
   //Sticky menu
    function uniform_sanitize_sticky( $input ) {
        $valid = array(
            'sticky'     => __( 'Sticky', 'uniform' ),
            'static'   => __( 'Static', 'uniform' ),
        );
        if ( array_key_exists( $input, $valid ) ) {
            return $input;
        } else {
            return '';
        }
    }
    
    //Blog Layout
    function uniform_sanitize_blog( $input ) {
        $valid = array(
            'classic'    => __( 'Classic', 'uniform' ),
            'fullwidth'  => __( 'Full width (no sidebar)', 'uniform' ),
            'masonry-layout'    => __( 'Masonry (grid style)', 'uniform' )
    
        );
        if ( array_key_exists( $input, $valid ) ) {
            return $input;
        } else {
            return '';
        }
    }
    
    //Menu style
    function uniform_sanitize_menu_style( $input ) {
        $valid = array(
            'inline'     => __( 'Inline', 'uniform' ),
            'centered'   => __( 'Centered (menu and site logo)', 'uniform' ),
        );
        if ( array_key_exists( $input, $valid ) ) {
            return $input;
        } else {
            return '';
        }
    }
    
    function uniform_flip_section_switch_option( $input ) {
        $valid = array(
            'left' => __( 'Left', 'uniform' ),
            'right' => __( 'Right', 'uniform' ),
        );
        if ( array_key_exists( $input, $valid ) ) {
            return $input;
        } else {
            return '';
        }
    }
    
    function __return_false_value($value) {
        return $value;
    }    
    add_filter('__return_false', '__return_false_value');