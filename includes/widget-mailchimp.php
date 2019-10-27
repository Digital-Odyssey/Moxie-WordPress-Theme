<?php

/*

Plugin Name: MailChimp Widget 
Plugin URI: http://www.pulsarmedia.ca
Description: A widget that displays a mailchimp newsletter signup form
Version: 1.0
Author: Micro Themes
Author URI: http://www.pulsarmedia.ca
License: GPLv2

*/

// use widgets_init action hook to execute custom function
add_action('widgets_init', 'pm_newsletter_widget');

//register our widget
function pm_newsletter_widget() {
	register_widget('pm_mailchimp_widget');
}

//pm_mailchimp_widget class
class pm_mailchimp_widget extends WP_Widget {
	
	//process the new widget
	function pm_mailchimp_widget() {
	
		$widget_ops = array(
			'classname' => 'pm_mailchimp_widget',
			'description' => esc_html__('Setup a mailchimp powered newsletter signup form','moxietheme')
		);
		
		parent::__construct('pm_mailchimp_widget', esc_html__('[Micro Themes] - Mailchimp Newsletter Form','moxietheme'), $widget_ops);
		
	}//end of pm_widget_my_info function
	
	//build the widget settings form
	function form($instance){
		
		$defaults = array( 
			'title' => esc_html__('Subscribe to our newsletter', 'moxietheme'),
			'desc' => '',
			'color' => 'Light',
			'url' => '',
			'unsuburl' => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = $instance['title'];
		$desc = $instance['desc'];
		$color = $instance['color'];
		$url = $instance['url'];
		$unsuburl = $instance['unsuburl'];
		
		?>
        
        
        	<p><?php esc_html_e('Title','moxietheme') ?>: <input class="widefat" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
            
            
            <p><?php esc_html_e('Description','moxietheme') ?>: <textarea class="widefat" name="<?php echo esc_attr($this->get_field_name('desc')); ?>" cols="3" rows="3"><?php echo esc_attr($desc); ?></textarea></p>
            
            <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'color' )); ?>"><?php esc_html_e('Form Color:', 'moxietheme') ?></label>
            <select id="<?php echo esc_attr($this->get_field_id( 'color' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'color' )); ?>" class="widefat">
                <option <?php if ( 'Light' == $instance['color'] ) echo 'selected="selected"'; ?>><?php esc_html_e('Light', 'moxietheme') ?></option>
                <option <?php if ( 'Dark' == $instance['color'] ) echo 'selected="selected"'; ?>><?php esc_html_e('Dark', 'moxietheme') ?></option>
            </select>
            </p>
            <p><?php esc_html_e('Newsletter URL','moxietheme') ?>: <input class="widefat" name="<?php echo esc_attr($this->get_field_name('url')); ?>" type="text" value="<?php echo esc_attr($url); ?>" /></p>
            <p><?php esc_html_e('Unsubscribe URL','moxietheme') ?>: <input class="widefat" name="<?php echo esc_attr($this->get_field_name('unsuburl')); ?>" type="text" value="<?php echo esc_attr($unsuburl); ?>" /></p>
                    
        <?php
		
	}//end of form function
	
	//save the widget settings
	function update($new_instance, $old_instance) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['desc'] = strip_tags( $new_instance['desc'] );
		$instance['color'] = strip_tags( $new_instance['color'] );
		$instance['url'] = strip_tags( $new_instance['url'] );
		$instance['unsuburl'] = strip_tags( $new_instance['unsuburl'] );
		
		return $instance;
		
	}//end of update function
	
	//display the widget
	function widget($args, $instance){
		
		extract($args);
		
		echo $before_widget;
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? esc_html__( 'Mailchimp Newsletter', 'moxietheme' ) : $instance['title'], $instance, $this->id_base );
		$desc = empty( $instance['desc'] ) ? '' : $instance['desc'];
		$color = empty( $instance['color'] ) ? 'Light' : $instance['color'];
		$url = empty( $instance['url'] ) ? '' : $instance['url'];
		$unsuburl = empty( $instance['unsuburl'] ) ? '' : $instance['unsuburl'];
		
		if( !empty($title) ){
			
			echo  $before_title . $title . $after_title;
			
		}//end of if
		
		echo '<div class="pm-sidebar-padding">';
		
		//form code here
		if(trim($desc) !== ''){
			echo '<p class="pm-margin-bottom-20">'.$desc.'</p>';
		}
		
		echo '<form action="'.htmlspecialchars(esc_html($url)).'" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>  
			<input name="MERGE1" type="text" class="pm_quick_contact_field '.esc_attr($color).'" id="MERGE1" placeholder="'.esc_html__('first name','moxietheme').'">
			<input name="MERGE0" type="email" class="pm_quick_contact_field '.esc_attr($color).'" id="MERGE0" placeholder="'.esc_html__('email address','moxietheme').'">
			<input name="subscribe" id="mc-embedded-subscribe" type="submit" value="'.esc_html__('Subscribe','moxietheme').'" class="pm_quick_contact_submit">
		</form>';
		
		echo '
			<p class="pm-center pm-mailchimp-text">'.esc_html__('To unsubscribe', 'moxietheme').' <a href="'.esc_html($unsuburl).'" class="pm-primary pm-font-size-12" target="_blank">'.esc_html__('click here', 'moxietheme').'</a></p></div>
		';
				
		echo $after_widget;
		
	}//end of widget function
	
}//end of class

?>