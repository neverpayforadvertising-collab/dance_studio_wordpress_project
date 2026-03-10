<?php
/**
 * Widget Social Links
 *
 * @package museum_exhibition
 */

// register Museum_Exhibition_Social_Links widget 
function museum_exhibition_register_social_links_widget() {
    register_widget( 'Museum_Exhibition_Social_Links' );
}
add_action( 'widgets_init', 'museum_exhibition_register_social_links_widget' );

if( ! class_exists( 'Museum_Exhibition_Social_Links' ) ): 
 /**
 * Adds Museum_Exhibition_Social_Links widget.
 */
class Museum_Exhibition_Social_Links extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'museum_exhibition_social_links', // Base ID
			esc_html__( 'TI: Social Links', 'museum-exhibition' ), // Name
			array( 'description' => esc_html__( 'A Social Links Widget', 'museum-exhibition' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
	   
        $museum_exhibition_title      = ! empty( $instance['title'] ) ? $instance['title'] : '';		
        $museum_exhibition_facebook   = ! empty( $instance['facebook'] ) ? $instance['facebook'] : '' ;
        $museum_exhibition_instagram  = ! empty( $instance['instagram'] ) ? $instance['instagram'] : '' ;
        $museum_exhibition_twitter    = ! empty( $instance['twitter'] ) ? $instance['twitter'] : '' ;
        $museum_exhibition_pinterest  = ! empty( $instance['pinterest'] ) ? $instance['pinterest'] : '' ;
        $museum_exhibition_linkedin   = ! empty( $instance['linkedin'] ) ? $instance['linkedin'] : '' ;
        $museum_exhibition_youtube    = ! empty( $instance['youtube'] ) ? $instance['youtube'] : '' ;
        $museum_exhibition_tiktok    = ! empty( $instance['tiktok'] ) ? $instance['tiktok'] : '' ;
        
        if( $museum_exhibition_facebook || $museum_exhibition_instagram || $museum_exhibition_twitter || $museum_exhibition_pinterest || $museum_exhibition_linkedin || $museum_exhibition_youtube || $museum_exhibition_tiktok ){ 
        echo $args['before_widget'];
        if($museum_exhibition_title)
        echo $args['before_title'] . apply_filters( 'widget_title', $museum_exhibition_title, $instance, $this->id_base ) . $args['after_title'];
        ?>
            <ul class="social-networks">
				<?php if( $museum_exhibition_facebook ){ ?>
                <li><a href="<?php echo esc_url( $museum_exhibition_facebook ); ?>" title="<?php esc_attr_e( 'Facebook', 'museum-exhibition' ); ?>" ><i class="fa fa-facebook"></i></a></li>
				<?php } if( $museum_exhibition_instagram ){ ?>
                <li><a href="<?php echo esc_url( $museum_exhibition_instagram ); ?>" title="<?php esc_attr_e( 'Instagram', 'museum-exhibition' ); ?>"><i class="fa fa-instagram"></i></a></li>
                <?php } if( $museum_exhibition_twitter ){ ?>
                <li><a href="<?php echo esc_url( $museum_exhibition_twitter ); ?>" title="<?php esc_attr_e( 'Twitter', 'museum-exhibition' ); ?>"><i class="fa fa-twitter"></i></a></li>
				<?php } if( $museum_exhibition_pinterest ){ ?>
                <li><a href="<?php echo esc_url( $museum_exhibition_pinterest ); ?>"  title="<?php esc_attr_e( 'Pinterest', 'museum-exhibition' ); ?>"><i class="fa fa-pinterest-p"></i></a></li>
				<?php } if( $museum_exhibition_linkedin ){ ?>
                <li><a href="<?php echo esc_url( $museum_exhibition_linkedin ); ?>" title="<?php esc_attr_e( 'Linkedin', 'museum-exhibition' ); ?>"><i class="fa fa-linkedin"></i></a></li>
				<?php } if( $museum_exhibition_youtube ){ ?>
                <li><a href="<?php echo esc_url( $museum_exhibition_youtube ); ?>" title="<?php esc_attr_e( 'YouTube', 'museum-exhibition' ); ?>"><i class="fa fa-youtube"></i></a></li>
                <?php } if( $museum_exhibition_tiktok ){ ?>
                <li><a href="<?php echo esc_url( $museum_exhibition_tiktok ); ?>" title="<?php esc_attr_e( 'Tiktok', 'museum-exhibition' ); ?>"><i class="fab fa-tiktok"></i></a></li>
                <?php } ?>
			</ul>
        <?php
        echo $args['after_widget'];
        }
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
        
        $museum_exhibition_title      = ! empty( $instance['title'] ) ? $instance['title'] : '';		
        $museum_exhibition_facebook   = ! empty( $instance['facebook'] ) ? $instance['facebook'] : '' ;
        $museum_exhibition_instagram  = ! empty( $instance['instagram'] ) ? $instance['instagram'] : '' ;
        $museum_exhibition_twitter    = ! empty( $instance['twitter'] ) ? $instance['twitter'] : '' ;
        $museum_exhibition_pinterest  = ! empty( $instance['pinterest'] ) ? $instance['pinterest'] : '' ;
        $museum_exhibition_linkedin   = ! empty( $instance['linkedin'] ) ? $instance['linkedin'] : '' ;
        $museum_exhibition_youtube    = ! empty( $instance['youtube'] ) ? $instance['youtube'] : '' ;
        $museum_exhibition_tiktok    = ! empty( $instance['tiktok'] ) ? $instance['tiktok'] : '' ;
        
        ?>
		
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'museum-exhibition' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $museum_exhibition_title ); ?>" />
		</p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>"><?php esc_html_e( 'Facebook', 'museum-exhibition' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'facebook' ) ); ?>" type="text" value="<?php echo esc_attr( $museum_exhibition_facebook ); ?>" />
		</p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>"><?php esc_html_e( 'Instagram', 'museum-exhibition' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'instagram' ) ); ?>" type="text" value="<?php echo esc_attr( $museum_exhibition_instagram ); ?>" />
		</p>
                
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>"><?php esc_html_e( 'Twitter', 'museum-exhibition' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twitter' ) ); ?>" type="text" value="<?php echo esc_attr( $museum_exhibition_twitter ); ?>" />
		</p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>"><?php esc_html_e( 'Pinterest', 'museum-exhibition' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'pinterest' ) ); ?>" type="text" value="<?php echo esc_attr( $museum_exhibition_pinterest ); ?>" />
		</p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>"><?php esc_html_e( 'LinkedIn', 'museum-exhibition' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'linkedin' ) ); ?>" type="text" value="<?php echo esc_attr( $museum_exhibition_linkedin ); ?>" />
		</p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>"><?php esc_html_e( 'YouTube', 'museum-exhibition' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'youtube' ) ); ?>" type="text" value="<?php echo esc_attr( $museum_exhibition_youtube ); ?>" />
		</p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'tiktok' ) ); ?>"><?php esc_html_e( 'Tiktok', 'museum-exhibition' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'tiktok' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tiktok' ) ); ?>" type="text" value="<?php echo esc_attr( $museum_exhibition_tiktok ); ?>" />
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		
        $instance = array();
		
        $instance['title']     = ! empty( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) :'';
        $instance['facebook']  = ! empty( $new_instance['facebook'] ) ? esc_url_raw( $new_instance['facebook'] ) : '';
        $instance['instagram'] = ! empty( $new_instance['instagram'] ) ? esc_url_raw( $new_instance['instagram'] ) : '';
        $instance['twitter']   = ! empty( $new_instance['twitter'] ) ? esc_url_raw( $new_instance['twitter'] ) : '';
        $instance['pinterest'] = ! empty( $new_instance['pinterest'] ) ? esc_url_raw( $new_instance['pinterest'] ) : '';
        $instance['linkedin']  = ! empty( $new_instance['linkedin'] ) ? esc_url_raw( $new_instance['linkedin'] ) : '';
        $instance['youtube']   = ! empty( $new_instance['youtube'] ) ? esc_url_raw( $new_instance['youtube'] ) : '';
        $instance['tiktok']    = ! empty( $new_instance['tiktok'] ) ? esc_url_raw( $new_instance['tiktok'] ) : '';
		
        return $instance;
                
	}

} // class Museum_Exhibition_Social_Links 
endif;