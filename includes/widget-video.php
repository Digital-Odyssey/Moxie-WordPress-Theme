<?php 

add_action('widgets_init','pulsar_video_widgets');

function pulsar_video_widgets() {
	register_widget('pulsar_video_widgets');
	
	}

class pulsar_video_widgets extends WP_Widget {
	
	function pulsar_video_widgets() {
			
		$widget_ops = array('classname' => 'pulsar-videos','description' => esc_html__('Video Widget - supports Youtube, Vimeo, Dailymotion','moxietheme'));
		parent::__construct('pulsar-videos',esc_html__('[Micro Themes] - Videos','moxietheme'),$widget_ops);

	}
		
	function widget( $args, $instance ) {
		extract( $args );
		/* User-selected settings. */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? esc_html__( 'Video', 'moxietheme' ) : $instance['title'], $instance, $this->id_base );
		$type = empty( $instance['type'] ) ? 'Youtube' : $instance['type'];
		$id = empty( $instance['id'] ) ? '0' : $instance['id'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
?>
	<?php if($type == 'Youtube') { ?>
		<iframe height="235" src="http://www.youtube.com/embed/<?php echo esc_attr($id); ?>?rel=0" allowfullscreen></iframe>
	<?php } elseif($type == 'Vimeo') { ?>
		<iframe src="http://player.vimeo.com/video/<?php echo esc_attr($id); ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ba0d16" height="235"></iframe>
	<?php } elseif($type == 'Dailymotion') { ?>
		<iframe frameborder="0" height="235" src="http://www.dailymotion.com/embed/video/<?php echo esc_attr($id) ?>?logo=0"></iframe>
	<?php } ?>
<?php 
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['type'] = $new_instance['type'];
		$instance['id'] = $new_instance['id'];

		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 
			'title' => esc_html__('Videos','moxietheme'), 
			//'fa_icon' => 'fa fa-video-camera',
			'type' => 'Youtube',
			'id' => ''
 			);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	
		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Title:', 'moxietheme') ?></label>
		<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>"  class="widefat" />
		</p>

        <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'type' )); ?>"><?php esc_html_e('Video Type:', 'moxietheme') ?></label>
        <select id="<?php echo esc_attr($this->get_field_id( 'type' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'type' )); ?>" class="widefat">
            <option <?php if ( 'Youtube' == $instance['type'] ) echo 'selected="selected"'; ?>><?php esc_html_e('Youtube', 'moxietheme') ?></option>
            <option <?php if ( 'Vimeo' == $instance['type'] ) echo 'selected="selected"'; ?>><?php esc_html_e('Vimeo', 'moxietheme') ?></option>
            <option <?php if ( 'Dailymotion' == $instance['type'] ) echo 'selected="selected"'; ?>><?php esc_html_e('Dailymotion', 'moxietheme') ?></option>
        </select>
        </p>

		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'id' )); ?>"><?php esc_html_e('Video ID:', 'moxietheme'); ?></label>
		<input id="<?php echo esc_attr($this->get_field_id( 'id' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'id' )); ?>" value="<?php echo esc_attr($instance['id']); ?>" class="widefat" />
		</p>

        
   <?php 
}
	} //end class