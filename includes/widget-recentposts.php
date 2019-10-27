<?php

/*
Plugin Name: Recent Posts Widget 
Plugin URI: http://www.pulsarmedia.ca
Description: A widget that displays your most recent posts
Version: 1.0
Author: Micro Themes
Author URI: http://www.pulsarmedia.ca
License: GPLv2
*/

// use widgets_init action hook to execute custom function
add_action('widgets_init', 'pm_recent_posts_widget');

//register our widget
function pm_recent_posts_widget() {
	register_widget('pm_recentposts_widget');
}

//pm_recentposts_widget class
class pm_recentposts_widget extends WP_Widget {
	
	//process the new widget
	function pm_recentposts_widget() {
	
		$widget_ops = array(
			'classname' => 'pm_recentposts_widget',
			'description' => esc_html__('Display recent posts with style.','moxietheme')
		);
		
		parent::__construct('pm_recentposts_widget', esc_html__('[Micro Themes] - Recent Posts','moxietheme'), $widget_ops);
		
	}//end of pm_widget_my_info function
	
	//build the widget settings form
	function form($instance){
		
		$defaults = array( 
			'title' => esc_html__('Recent Posts', 'moxietheme'), 
			'numOfPosts' => '3',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = $instance['title'];
		$numOfPosts = $instance['numOfPosts'];
		
		?>
        
        	<p><?php esc_html_e('Title:', 'moxietheme') ?> <input class="widefat" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

            <p><?php esc_html_e('Number of Posts to display:', 'moxietheme') ?> <input class="widefat" name="<?php echo esc_attr($this->get_field_name('numOfPosts')); ?>" type="text" value="<?php echo esc_attr($numOfPosts); ?>" /></p>

                    
        <?php
		
	}//end of form function
	
	//save the widget settings
	function update($new_instance, $old_instance) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['numOfPosts'] = strip_tags( $new_instance['numOfPosts'] );
		
		return $instance;
		
	}//end of update function
	
	//display the widget
	function widget($args, $instance){
		
		extract($args);
		
		echo $before_widget;
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? esc_html__( 'Recent Posts', 'moxietheme' ) : $instance['title'], $instance, $this->id_base );
		$numOfPosts = empty( $instance['numOfPosts'] ) ? '3' : $instance['numOfPosts'];
		
		if( !empty($title) ){
			
			echo $before_title . $title . $after_title;
			
		}//end of if
		
		//retrieve recent posts
		$args = array(
				'numberposts' => $numOfPosts,
				'offset' => 0,
				'category' => 0,
				'orderby' => 'post_date',
				'order' => 'DESC',
				'include' => '',
				'exclude' => '',
				'meta_key' => '',
				'meta_value' => '',
				'post_type' => 'post',
				'post_status' => 'publish',
				'suppress_filters' => true 
		);
				
						
		$recent_posts = wp_get_recent_posts($args, ARRAY_A);
		
		echo '<ul class="pm-recent-blog-posts">';
		
		//front-end widget code here
		foreach( $recent_posts as $recent ){
			
			$featuredPostThumb = wp_get_attachment_thumb_url( get_post_thumbnail_id( $recent["ID"] ) );
			$excerpt = $recent["post_excerpt"];
			$title = $recent["post_title"];
			$excerpt = $recent["post_excerpt"];
			$date = $recent["post_date"];
			$month = date("M", strtotime($date));
			$day = date("d", strtotime($date));
			$year = date("Y", strtotime($date));
			$author = $recent["post_author"];
			$user_info = get_userdata($author);
			
			echo '<li>';
			
				echo '<a href="'.get_permalink($recent["ID"]).'" class="pm-recent-post-btn fa fa-arrow-circle-o-right"></a>';
				
				if($featuredPostThumb !== '') :
					echo '<div class="pm-recent-blog-post-thumb"><img src="'.esc_url(esc_html($featuredPostThumb)).'" alt="'.get_the_title().'" /></div>';
				endif;
				
				echo '<div class="pm-recent-blog-post-details">';
					echo '<a href="'.get_permalink($recent["ID"]).'">'.esc_attr($title).'</a>';
					echo '<p class="pm-date"><i class="fa fa-clock-o"></i> &nbsp;'.esc_attr($month).' '.esc_attr($day).' '.esc_attr($year).' - '. esc_attr($user_info->display_name)  .'</p>';
				echo '</div>';
				
			echo '</li>';
			
		}//end of foreach
		
		echo '</ul>';
						
		echo $after_widget;
				
	}//end of widget function
	
}//end of class

?>