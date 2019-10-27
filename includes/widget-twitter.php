<?php 

add_action('widgets_init','lateset_tweets');

function lateset_tweets() {
	register_widget('lateset_tweets');
	
	}

class lateset_tweets extends WP_Widget {
	function lateset_tweets() {
			
		$widget_ops = array('classname' => 'tweets','description' => esc_html__('Twitter Widget - displays Latest Tweets','moxietheme'));

		parent::__construct('pm-ln-latest-tweets',esc_html__('[Micro Themes] - Twitter','moxietheme'),$widget_ops);

		}
		
	function widget( $args, $instance ) {
		extract( $args );
		/* User-selected settings. */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? esc_html__( 'Latest Tweets', 'moxietheme' ) : $instance['title'], $instance, $this->id_base );
		$twitterWidgetID = empty( $instance['twitterWidgetID'] ) ? '0' : $instance['twitterWidgetID'];
		$twitterHandlerID = empty( $instance['twitterHandlerID'] ) ? '0' : $instance['twitterHandlerID'];
		$count = empty( $instance['count'] ) ? '3' : $instance['count'];
		$enableLinks = empty($instance['enableLinks']) ? '0' : $instance['enableLinks'];
		$showUser = empty($instance['showUser']) ? '0' : $instance['showUser'];
		$showTime = empty($instance['showTime']) ? '0' : $instance['showTime'];
		$showInteraction = empty($instance['showInteraction']) ? '0' : $instance['showInteraction'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
?>

			<div id="pm-twitter-news-shortcode-<?php echo $twitterHandlerID; ?>" class="pm-tweet-list"></div> 
            
			<script type="text/javascript">
							  
				(function($) {
					
					$(document).ready(function(e) {
												
						var twitterConfig = {
						  "id": '<?php echo esc_attr($twitterWidgetID); ?>',
						  "domId": 'pm-twitter-news-shortcode-<?php echo esc_attr($twitterHandlerID); ?>',
						  "maxTweets": <?php echo esc_attr($count); ?>,
						  "enableLinks": <?php echo esc_attr($enableLinks) == 1 ? 'true' : 'false' ?>,
						  "showUser": <?php echo esc_attr($showUser) == 1 ? 'true' : 'false' ?>,
						  "showTime": <?php echo esc_attr($showTime) == 1 ? 'true' : 'false' ?>,
						  "dateFunction": '',
						  "showRetweet": true,
						  "customCallback": handleTweets,
						  "showInteraction": <?php echo esc_attr($showInteraction) == 1 ? 'true' : 'false' ?>,
						};
												
						function handleTweets(tweets){
							var x = tweets.length;
							var n = 0;
							var elementID = 'pm-twitter-news-shortcode-<?php echo esc_attr($twitterHandlerID); ?>';
							var element = document.getElementById(elementID);
							var html = '<ul>';
							while(n < x) {
							  html += '<li><div class="tweet_container">' + tweets[n] + '</div></li>';
							  n++;
							}
							html += '</ul>';
							element.innerHTML = html;
						}
						
						twitterFetcher.fetch(twitterConfig);
												
					});
				  
				})(jQuery);
				
			</script>
			
<?php 
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['twitterWidgetID'] = strip_tags( $new_instance['twitterWidgetID'] );
		$instance['twitterHandlerID'] = strip_tags( $new_instance['twitterHandlerID'] );
		$instance['count'] = $new_instance['count'];
		$instance['enableLinks'] = strip_tags($new_instance['enableLinks']);
		$instance['showUser'] = strip_tags($new_instance['showUser']);
		$instance['showTime'] = strip_tags($new_instance['showTime']);
		$instance['showInteraction'] = strip_tags($new_instance['showInteraction']);

		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => esc_html__('Twitter','moxietheme'), 
			'twitterWidgetID' => '', 
			'twitterHandlerID' => '',
			'count' => 3,
			'enableLinks' => 0,
			'showUser' => 0,
			'showTime' => 0,
			'showInteraction' => 0,
 			);
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		$title = $instance['title'];
		$twitterWidgetID = $instance['twitterWidgetID'];
		$twitterHandlerID = $instance['twitterHandlerID'];
		$count = $instance['count'];
		$enableLinks = $instance['enableLinks'];
		$showUser = $instance['showUser'];
		$showTime = $instance['showTime'];
		$showInteraction = $instance['showInteraction'];
		?>
	
    	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Title:', 'moxietheme') ?></label>
		<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($title); ?>"  class="widefat" />
		</p>

		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'twitterWidgetID' )); ?>"><?php esc_html_e('Twitter Widget ID:', 'moxietheme'); ?> <a href="https://www.pulsarmedia.ca/generating-a-twitter-widget-id/" target="_blank"><?php esc_html_e('More info', 'moxietheme'); ?></a></label>
		<input id="<?php echo esc_attr($this->get_field_id( 'twitterWidgetID' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'twitterWidgetID' )); ?>" value="<?php echo esc_attr($twitterWidgetID); ?>" class="widefat" />
		</p>
        
        <p>
		<label for="<?php echo esc_attr($this->get_field_id( 'twitterHandlerID' )); ?>"><?php esc_html_e('Handler ID:', 'moxietheme'); ?> <?php esc_html_e('Enter a unique handler ID for multiple instances. (ex. twitterWidget1)', 'moxietheme'); ?></a></label>
		<input id="<?php echo esc_attr($this->get_field_id( 'twitterHandlerID' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'twitterHandlerID' )); ?>" value="<?php echo esc_attr($twitterHandlerID); ?>" class="widefat" />
		</p>

		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'count' )); ?>"><?php esc_html_e('Number of tweets to display:', 'moxietheme') ?></label>
		<input id="<?php echo esc_attr($this->get_field_id( 'count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'count' )); ?>" value="<?php echo esc_attr($count); ?>" class="widefat" />
		</p>
        
        <p>  
            <input id="<?php echo $this->get_field_id('enableLinks'); ?>" name="<?php echo esc_attr($this->get_field_name('enableLinks')); ?>" type="checkbox" value="1" <?php checked( '1', $instance['enableLinks'] ); ?>/>   
            <label for="<?php echo esc_attr($this->get_field_id( 'enableLinks' )); ?>"><?php esc_html_e('Activate Links?', 'moxietheme'); ?></label>  
        </p>
        
        
        
        
        <p>  
            <input id="<?php echo esc_attr($this->get_field_id('showUser')); ?>" name="<?php echo esc_attr($this->get_field_name('showUser')); ?>" type="checkbox" value="1" <?php checked( '1', $instance['showUser'] ); ?>/>   
            <label for="<?php echo esc_attr($this->get_field_id( 'showUser' )); ?>"><?php esc_html_e('Display User Thumbnail?', 'moxietheme'); ?></label>  
        </p>
        
        <p>  
            <input id="<?php echo esc_attr($this->get_field_id('showTime')); ?>" name="<?php echo esc_attr($this->get_field_name('showTime')); ?>" type="checkbox" value="1" <?php checked( '1', $instance['showTime'] ); ?>/>   
            <label for="<?php echo esc_attr($this->get_field_id( 'showTime' )); ?>"><?php esc_html_e('Display time of tweet?', 'moxietheme'); ?></label>  
        </p>
        
        <p>  
            <input id="<?php echo esc_attr($this->get_field_id('showInteraction')); ?>" name="<?php echo esc_attr($this->get_field_name('showInteraction')); ?>" type="checkbox" value="1" <?php checked( '1', $instance['showInteraction'] ); ?>/>   
            <label for="<?php echo esc_attr($this->get_field_id( 'showInteraction' )); ?>"><?php esc_html_e('Display Interaction Links?', 'moxietheme'); ?></label>  
        </p>
        
   <?php 
}
	} //end class