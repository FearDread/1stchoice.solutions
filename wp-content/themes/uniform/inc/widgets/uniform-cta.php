<?php
/**
 * Call to Action widget used in homepage.
 *
 * @package Uniform
 */
add_action( 'widgets_init', 'register_uniform_cta_widget' );

function register_uniform_cta_widget() {
    register_widget( 'uniform_cta' );
}

class Uniform_Cta extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
                'uniform_cta', 'Uniform : Call to Action', array(
            'description' => __( 'A widget that shows Call to Action.', 'uniform' )
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $fields = array(
            'title' => array(
                'uniform_widgets_name' => 'title',
                'uniform_widgets_title' => __( 'Title', 'uniform' ),
                'uniform_widgets_field_type' => 'text',
            ),
            'action_text' => array(
                'uniform_widgets_name' => 'action_text',
                'uniform_widgets_title' => __( 'Enter your call to action.', 'uniform' ),
                'uniform_widgets_field_type' => 'textarea',
                'uniform_widgets_row' => 5,
            ),            
            'action_btn_link' => array(
                'uniform_widgets_name' => 'action_btn_link',
                'uniform_widgets_title' => __( 'Link for the Button', 'uniform' ),
                'uniform_widgets_field_type' => 'url',
            ),
            'action_btn_text' => array(
                'uniform_widgets_name' => 'action_btn_text',
                'uniform_widgets_title' => __( 'Title for the Button', 'uniform' ),
                'uniform_widgets_field_type' => 'text',
            ),
            'inline' => array(
                'uniform_widgets_name' => 'inline',
                'uniform_widgets_title' => __( 'Display the button inline with the text?', 'uniform' ),
                'uniform_widgets_field_type' => 'checkbox',
            ),
        );
        return $fields;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        extract($args);

        if( empty( $instance ) ) {
            return;
        }
        $uniform_cta_title = $instance['title'];
        $uniform_cta_content = $instance['action_text'];
        $uniform_cta_button_link = $instance['action_btn_link'];
        $uniform_cta_button_text = $instance['action_btn_text'];
        $uniform_cta_button_inline = $instance['inline'];
        

        if ( $uniform_cta_button_inline == 1 ) {
            $aside_style = 'aside-style';
        } else {
            $aside_style = '';
        }
        echo $before_widget;

        ?>
        <div class="section-actionbox <?php echo $aside_style; ?>">
            <div class="action-wrap">
                <?php
                    if ( $uniform_cta_title ) echo $before_title . $uniform_cta_title . $after_title;
                    if ( $uniform_cta_content !='' ) { 
                ?>
                <div class="action-content"><?php echo esc_textarea( $uniform_cta_content ); ?></div>
                <?php } ?>
            </div>
                <div class="action-link">
                    <a href="<?php echo esc_url( $uniform_cta_button_link ); ?>" class="section-button border"><?php echo esc_html( $uniform_cta_button_text ); ?></a>
                </div>          
        </div>

        <?php 
        echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param	array	$new_instance	Values just sent to be saved.
     * @param	array	$old_instance	Previously saved values from database.
     *
     * @uses	uniform_widgets_updated_field_value()		defined in widget-fields.php
     *
     * @return	array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            extract( $widget_field );

            // Use helper function to get updated field values
            $instance[$uniform_widgets_name] = uniform_widgets_updated_field_value( $widget_field, $new_instance[$uniform_widgets_name] );
        }

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param	array $instance Previously saved values from database.
     *
     * @uses	uniform_widgets_show_widget_field()		defined in widget-fields.php
     */
    public function form( $instance ) {
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            // Make array elements available as variables
            extract( $widget_field );
            $uniform_widgets_field_value = !empty( $instance[$uniform_widgets_name]) ? esc_attr($instance[$uniform_widgets_name] ) : '';
            uniform_widgets_show_widget_field( $this, $widget_field, $uniform_widgets_field_value );
        }
    }

}
