<?php
/**
 * Custom calsses and definitions
 *
 * @package Uniform
 * 
 */
 
if ( class_exists( 'WP_Customize_Control' ) ) {
    
    class WP_Customize_Category_Control extends WP_Customize_Control {
        /**
         * Render the control's content.
         *
         * @since 3.4.0
         */
        public function render_content() {
            $dropdown = wp_dropdown_categories(
                array(
                    'name'              => '_customize-dropdown-categories-' . $this->id,
                    'echo'              => 0,
                    'show_option_none'  => __( '&mdash; Select Category &mdash;', 'uniform' ),
                    'option_none_value' => '0',
                    'selected'          => $this->value(),
                )
            );
 
            // Hackily add in the data link parameter.
            $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
 
            printf(
                '<label class="customize-control-select"><span class="customize-control-title">%s</span><span class="description customize-control-description">%s</span> %s </label>',
                $this->label,
                $this->description,
                $dropdown
            );
        }
    }
    
    /**
     * Class to create a custom post control
     */
    class Post_Dropdown_Custom_Control extends WP_Customize_Control {
        private $posts = false;
        public function __construct($manager, $id, $args = array(), $options = array())
        {
            $postargs = wp_parse_args($options, array('numberposts' => '-1'));
            $this->posts = get_posts($postargs);
            parent::__construct( $manager, $id, $args );
        }
        /**
        * Render the content on the theme customizer page
        */
        public function render_content()
        {
            if(!empty($this->posts))
            {
                ?>
                    <label>
                        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                        <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                        <select data-customize-setting-link="<?php echo $this->id; ?>" name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>">
                            <option value="" <?php if ( get_theme_mod($this->id) == '' ) echo 'selected="selected"'; ?>><?php _e( '--Select Post--', 'uniform' ); ?></option>
                        <?php
                            foreach ( $this->posts as $post )
                            {
                                printf('<option value="%s" %s>%s</option>', $post->ID, selected($this->value(), $post->ID, false), $post->post_title);
                            }
                        ?>
                        </select>
                    </label>
                <?php
            }
        }
    }
    
    /**
     * Class to create dropdown menu for select page
     */
    class WP_Customize_Page_Control extends WP_Customize_Control {
        /**
         * Render the control's content.
         *
         * @since 3.4.0
         */
        public function render_content() {
            $dropdown = wp_dropdown_pages(
                array(
                    'name'              => '_customize-dropdown-pages-' . $this->id,
                    'echo'              => 0,
                    'show_option_none'  => __( '&mdash; Select Pages &mdash;', 'uniform' ),
                    'option_none_value' => '0',
                    'selected'          => $this->value(),
                )
            );
 
            // Hackily add in the data link parameter.
            $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
 
            printf(
                '<label class="customize-control-select"><span class="customize-control-title">%s</span><span class="description customize-control-description">%s</span> %s </label>',
                $this->label,
                $this->description,
                $dropdown
            );
        }
    }
    
    /**
     * Section info 
     */
     class Uniform_Section_Info extends WP_Customize_Control {
        public $type = 'section_info';
        public $label = '';
        public function render_content() {
        ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
            </label>
        <?php
        }
    }
    
    /**
     * Cutomize control for switch option
     */
    
    class WP_Customize_Switch_Control extends WP_Customize_Control {
		public $type = 'switch';    
		public function render_content() {
		  $choises_options = $this->choices;
          $s_count = 0;
		?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
		        <div class="switch_options">
                    <?php foreach( $choises_options as $key=>$value ) { $s_count++; ?>
                      <span id="switch_<?php echo esc_attr( $s_count ); ?>" class="switch_<?php echo esc_attr( $key ); ?>"> <?php echo esc_attr ( $value ); ?> </span>
                    <?php } ?>
                  <input type="hidden" id="enable_switch_option" <?php $this->link(); ?> value="<?php echo $this->value(); ?>" />
                </div>
            </label>
		<?php
		}
	}
    
    /**
     * Image control by radtion button 
     */
    class Uniform_Image_Radio_Control extends WP_Customize_Control {

 		public function render_content() {

			if ( empty( $this->choices ) )
				return;

			$name = '_customize-radio-' . $this->id;

			?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
			<ul class="controls" id ="uniform-img-container">
			<?php
				foreach ( $this->choices as $value => $label ) :
					$class = ($this->value() == $value)?'uniform-radio-img-selected uniform-radio-img-img':'uniform-radio-img-img';
					?>
					<li style="display: inline;">
					<label>
						<input <?php $this->link(); ?>style = 'display:none' type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
						<img src = '<?php echo esc_html( $label ); ?>' class = '<?php echo $class; ?>' />
					</label>
					</li>
					<?php
				endforeach;
			?>
			</ul>
			<?php
		}
	}
    
    /**
     * Customize for textarea, extend the WP customizer
     */
    class Textarea_Custom_Control extends WP_Customize_Control{
    	/**
    	 * Render the control's content.
    	 * 
    	 */
    	public $type = 'uniform_textarea';
      public function render_content() {
    		?>
    		<label>
    			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
    			<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
          <textarea class="large-text" cols="20" rows="5" <?php $this->link(); ?>>
    				<?php echo esc_textarea( $this->value() ); ?>
    			</textarea>
    		</label>
    		<?php
    	}
    }
    
    /**
     * Section Re-order
     * A class to re-order section by using drag and drop 
     */

    class Uniform_Section_Re_Order extends WP_Customize_Control {
      
      public $type = 'dragndrop';
        /**
         * Render the content of the category dropdown
         *
         * @return HTML
         */
        public function render_content() {

            if ( empty( $this->choices ) ){
              return;
            }
        ?>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
              <span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
        <ul class="controls" id ="uniform-sections-reorder">
        <?php
            $default_short_array = array();
            foreach ( $this->choices as $value => $label ) {
                  $default_short_array[$value] = $label;
            }
            $order_save_value = get_theme_mod( $this->id );
            
            if( !empty( $order_save_value ) ) {
              $order_save_array = explode( ',' , $order_save_value);
              $order_save_array_pop = array_pop( $order_save_array );
              foreach ($order_save_array as $key => $value) {
        ?>

                <li class="uniform-section-element" data-section-name="<?php echo esc_attr( $value );?>" id="<?php echo esc_attr( $value ); ?>"><?php echo esc_attr( $default_short_array[$value] ); ?></li>
        <?php      
              }
              $section_order_list = $order_save_value;

            } else {
            $order_array = array();
                foreach ( $this->choices as $value => $label ) {
                    $order_array[] = $value;            
        ?>
                    <li class="uniform-section-element" data-section-name="<?php echo esc_attr( $value );?>" id="<?php echo esc_attr( $value ); ?>"><?php echo esc_attr( $label ); ?></li>
        <?php
                }
            $section_order_list = implode ( "," , $order_array );
            }
        ?>
        <input id="shortui-order" type="hidden" <?php $this->link(); ?> value="<?php echo $section_order_list; ?>" />  
        </ul>        
    <?php
        }
    }

    /**
     * Theme info 
     */
     class Uniform_Theme_Info extends WP_Customize_Control {
        public $type = 'uniform_theme_info';
        public $label = '';
        public function render_content() {
        ?>
            <label class="customize-control-select">
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
            </label>
        <?php
        }
    }
    
}