<?php 

if( !function_exists('moxie_theme_is_plugin_active') ){
	
	function moxie_theme_is_plugin_active($plugin) {

		include_once (ABSPATH . 'wp-admin/includes/plugin.php');
	
		return is_plugin_active($plugin);
	
	}
	
}

function moxie_theme_get_moxie_options() {
	
	global $moxie_options;
	
	return $moxie_options;
		
}

function moxie_theme_has_shortcode($shortcode = '') {
     
    $post_to_check = get_post(get_the_ID());
     
    // false because we have to search through the post content first
    $found = false;
     
    // if no short code was provided, return false
    if (!$shortcode) {
        return $found;
    }
    // check the post content for the short code
    if ( stripos($post_to_check->post_content, '[' . $shortcode) !== false ) {
        // we have found the short code
        $found = true;
    }
     
    // return our final results
    return $found;
}

function moxie_theme_make_href_root_relative($input) {
    return preg_replace('!http(s)?://' . $_SERVER['SERVER_NAME'] . '/!', '/', $input);
}

//Extract avatar URL
function moxie_theme_get_avatar_url($get_avatar){
    preg_match("/src='(.*?)'/i", $get_avatar, $matches);
    return $matches[1];
}

//WPML custom language selector
function moxie_theme_icl_post_languages(){
	
  if( function_exists('icl_get_languages') ){
	  
	  $languages = icl_get_languages('skip_missing=1');
  
	  if(1 < count($languages)){
		  		  
			echo '<div class="pm-dropdown pm-language-selector-menu">';
				echo '<div class="pm-dropmenu">';
					echo '<p class="pm-menu-title">'.esc_html__('Language','moxietheme').'</p>';
					echo '<i class="fa fa-angle-down"></i>';
				echo '</div>';
				echo '<div class="pm-dropmenu-active">';
					echo '<ul>';
					   foreach($languages as $l){
						if(!$l['active']) echo '<li><img src="'.$l['country_flag_url'].'" alt="'.$l['translated_name'].'" /><a href="'.$l['url'].'">'.$l['translated_name'].'</a></li>';
					   }
					echo '</ul>';
				echo '</div>';
			echo '</div>';
			
		 ;
					
	  }
	  
  }//end of check function
  
}

//Custom WordPress functions
function moxie_theme_set_query($custom_query=null) { 
	global $wp_query, $wp_query_old, $post, $orig_post;
	$wp_query_old = $wp_query;
	$wp_query = $custom_query;
	$orig_post = $post;
}

function moxie_theme_restore_query() {  
	global $wp_query, $wp_query_old, $post, $orig_post;
	$wp_query = $wp_query_old;
	$post = $orig_post;
	setup_postdata($post);
}

//Limit words in paragraphs
function moxie_theme_string_limit_words($string, $word_limit){
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}

//Apply primary color to the first two words in a news post title
function moxie_theme_set_primary_words($title = ''){
	
    $ARR_title = explode(" ", $title);

    if(sizeof($ARR_title) > 2 ){
        $ARR_title[0] = "<span>".$ARR_title[0];
		$ARR_title[1] = $ARR_title[1]."</span>";
        return implode(" ", $ARR_title);
    } else {
        return $title;
    }
  
}

//Count all posts related to current tag
function moxie_theme_get_posts_count_by_tag($tag_name){
    $tags = get_tags(array ('search' => $tag_name) );
    foreach ($tags as $tag) {
      //if ($tag->name == $tag_name) {}
	  return $tag->count;
    }
    return 0;
}

//Count all posts related to current category
function moxie_theme_get_posts_count_by_category($category_name){
    $categories = get_categories(array ('search' => $category_name) );
    foreach ($categories as $category) {
		return $category->count;
    }
    return 0;
}

//Convert HEX to RGB
function moxie_theme_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
	  $r = hexdec(substr($hex,0,1).substr($hex,0,1));
	  $g = hexdec(substr($hex,1,1).substr($hex,1,1));
	  $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
	  $r = hexdec(substr($hex,0,2));
	  $g = hexdec(substr($hex,2,2));
	  $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return $rgb; // returns an array with the rgb values
}

//YOUTUBE Thumbnail Extract
function moxie_theme_parse_yturl($url) {
	$pattern = '#^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=|/watch\?.+&v=))([\w-]{11})(?:.+)?$#x';
	preg_match($pattern, $url, $matches);
	return (isset($matches[1])) ? $matches[1] : false;
}



//Breadcrumb
function moxie_theme_breadcrumbs() {
	
	global $post;
	
	echo '<ul class="pm-breadcrumbs">';	
    
    if (!is_home()) {
        echo '<li><a href="'.home_url('/').'"> Home</a></li>';
        echo '<li><i class="fa fa-angle-right"></i></li>';
		
		if (is_single() && get_post_type() == 'staff_member' ) { //Wordpress doesnt support custom post types for breadcrumbs
		
			echo '<li>';
			the_title();
			echo '</li>';
		
		} else if (is_single()) {
			
            echo '<li>';
			the_title();
            echo '</li>';
			
		} else if (is_404()) {
			
            echo '<li> '.esc_html__('404 Error', 'moxietheme').'</li>';
		
		} else if (is_category()) {	
		
			echo '<li>';
			
            //the_category('</li><li class="separator"> / </li><li>', 'single');
			
			$cat = get_category( get_query_var( 'cat' ) ); 
			echo $cat->name;
			echo '</li>';
				
        } elseif (is_page()) {
			
            if($post->post_parent){
                $anc = get_post_ancestors( $post->ID );
                $title = get_the_title();
                foreach ( $anc as $ancestor ) {
                    $output = '<li><a href="'.get_permalink($ancestor).'" title="'.get_the_title($ancestor).'">'.get_the_title($ancestor).'</a></li> <li><i class="fa fa-angle-right"></i></li>';
                }
                echo $output;
                echo '<li title="'.$title.'"> '.$title.'</li>';
            } else {
                echo '<li> ';
                echo the_title();
                echo '</li>';
            }
        } 
		elseif (is_tag()) {
			echo '<li>'; 
			single_tag_title();
			echo '</li>';
		}
		elseif (is_day()) {
			echo"<li>". esc_attr__('Archive for','moxietheme') ." "; the_time('F jS, Y'); echo'</li>';
		}
		elseif (is_month()) {
			echo"<li>". esc_attr__('Archive for','moxietheme') ." "; the_time('F, Y'); echo'</li>';
		}
		elseif (is_year()) {
			echo"<li>". esc_attr__('Archive for','moxietheme') ." "; the_time('Y'); echo'</li>';
		}
		elseif (is_author()) {
			echo"<li>". esc_attr__('Author Archive','moxietheme') .""; echo'</li>';
		}
		elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {exit;
			echo "<li>". esc_attr__('Blog Archives','moxietheme') .""; echo'</li>';
		}
		elseif (is_search()) {
			echo"<li>". esc_attr__('Search Results','moxietheme') .""; echo'</li>';
		}
    }
	
    echo '</ul>';
	
}

//COMMENTS CONTROL
function moxie_theme_mytheme_comment($comment, $args, $depth) {
	
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class('pm-comment-box-container'); ?> id="li-comment-<?php comment_ID() ?>">
    
	<div class="pm-comment-box-container" id="comment-<?php comment_ID(); ?>">
	
		<div class="comment-author vcard pm-comment-box-avatar-container">
    
    		<div class="pm-comment-avatar">
				<?php echo get_avatar($comment,$size='70'); ?>
            </div>
            
            <ul class="pm-comment-author-list">
                <li><p class="pm-comment-name"><?php comment_author(); ?></p></li>
                <li><p class="pm-comment-date">
                <?php printf(__('<cite class="fn">%s</cite>', 'moxietheme'), get_comment_author_link()) ?> <a href="<?php echo htmlspecialchars(get_comment_link( $comment->comment_ID )) ?>"> <?php printf(__('%1$s at %2$s', 'moxietheme'), get_comment_date(),get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)', 'moxietheme'),' ','') ?>
                </p></li>
            </ul>
                   
		<!-- Leave this space empty (no closing div tag here) -->
    
	</div>
	
	<?php if ($comment->comment_approved == '0') : ?>
		<em class="pm-comment-style"><?php esc_html_e('Your comment is awaiting moderation.', 'moxietheme') ?></em>
	<?php endif; ?>
	 
	 
	<div class="pm-comment"><?php comment_text() ?></div>
    
		<?php if($args['max_depth']!=$depth) { ?>
            <div class="pm-comment-reply-btn">
                <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
            </div>
        <?php } ?>
    
	</div>
	<?php
		
		//Required for Themeforest regulations.
		$comments_args = array(
		  'title_reply'       => esc_html__( 'Leave a Reply', 'moxietheme' ),
		  'title_reply_to'    => esc_html__( 'Leave a Reply to %s', 'moxietheme' ),
		  'cancel_reply_link' => esc_html__( 'Cancel Reply', 'moxietheme' ),
		  'label_submit'      => esc_html__( 'Post Comment', 'moxietheme' ),
		);
	
		
}//end of comments control

//Menu functions
function moxie_theme_main_menu() {
	echo '<ul class="sf-menu pm-nav">';
		  wp_list_pages('title_li=&depth=2'); //http://codex.wordpress.org/Function_Reference/wp_list_pages
	echo '</ul>';
}

function moxie_theme_sub_menu() {
	echo '<ul class="sf-menu pm-nav">';
		  wp_list_pages('title_li=&depth=2'); //http://codex.wordpress.org/Function_Reference/wp_list_pages
	echo '</ul>';
}

function moxie_theme_footer_menu() {
	echo '<ul class="pm-footer-navigation" id="pm-footer-nav">';
		  wp_list_pages('title_li=&depth=1'); //http://codex.wordpress.org/Function_Reference/wp_list_pages
	echo '</ul>';
}


/* Load More AJAX Call */
function moxie_theme_load_more(){
	
	if(!wp_verify_nonce($_POST['nonce'], 'pulsar_ajax')) die('Invalid nonce');
	if( !is_numeric($_POST['page']) || $_POST['page'] < 0 ) die('Invalid page');
	
	$section = '';
		
		
	$args = '';
	if(isset($_POST['section']) && $_POST['section']){
		$section = $_POST['section'];
		$args = 'post_type=post_'.$_POST['section'].'&'; //match the post type name
	}
	
	if($section == 'galleries'){
		
		$gallery_posts_per_load = get_theme_mod('gallery_posts_per_load', '3');
		$galleryPostOrder = get_theme_mod('galleryPostOrder', 'DESC');
		
		$args .= 'post_status=publish&order='.$galleryPostOrder.'&posts_per_page='.$gallery_posts_per_load.'&paged='. $_POST['page'];
		
	} elseif($section == 'staff'){
		
		$staff_posts_per_load = get_theme_mod('staff_posts_per_load', '3');
		$staffPostOrder = get_theme_mod('staffPostOrder', 'DESC');
				
		$args .= 'post_status=publish&order='.$staffPostOrder.'&posts_per_page='.$staff_posts_per_load.'&paged='. $_POST['page'];

		
	} else {
		$args .= 'post_status=publish&posts_per_page=4&paged='. $_POST['page'];
	}
		
	ob_start();
	$query = new WP_Query($args);
	while( $query->have_posts() ){ $query->the_post();
		
		if($section == 'galleries'){//match the post type name
			get_template_part( 'content', 'gallerypost' );
		} else {
			get_template_part( 'content', $section.'post' );	
		}	
		
	}
	
	wp_reset_postdata();
	$content = ob_get_contents();
	ob_end_clean();
	
	echo json_encode(
		array(
			'pages' => $query->max_num_pages,
			'content' => $content
		)
	);
	
	exit;

}


function moxie_theme_load_more_posts(){
	
	if(!wp_verify_nonce($_POST['nonce'], 'pulsar_ajax')) die('Invalid nonce');
	if( !is_numeric($_POST['page']) || $_POST['page'] < 0 ) die('Invalid page');

	$posts_per_load = get_theme_mod('posts_per_load', '3');
	
	$args = '';

	$args .= 'post_status=publish&posts_per_page='.$posts_per_load.'&paged='. $_POST['page'];
		
	ob_start();
	$query = new WP_Query($args);
	while( $query->have_posts() ){ $query->the_post();
				
		get_template_part( 'content', 'post' );	
		
	}
	
	wp_reset_postdata();
	$content = ob_get_contents();
	ob_end_clean();
	
	echo json_encode(
		array(
			'pages' => $query->max_num_pages,
			'content' => $content
		)
	);
	
	exit;

}

function moxie_theme_retrieve_likes() {
	//verify nonce (set in functions.php - line 636)
	if(!wp_verify_nonce($_POST['nonce'], 'pulsar_ajax')) die('Invalid nonce');
	if( !is_numeric($_POST['postID']) || $_POST['postID'] < 0 ) die('Invalid request');
	
	$postID = $_POST['postID'];
	
	$currentLikes = get_post_meta($postID, 'pm_total_likes', true);
	
	echo json_encode(
		array(
			'currentLikes' => $currentLikes,
		)
	);
	
	exit;
	
}

function moxie_theme_like_feature() {
	
	//verify nonce (set in functions.php - line 636)
	if(!wp_verify_nonce($_POST['nonce'], 'pulsar_ajax')) die('Invalid nonce');
	if( !is_numeric($_POST['postID']) || $_POST['postID'] < 0 ) die('Invalid request');
	
	$postID = $_POST['postID'];
	$likes = (int) $_POST['likes'];
	
	//$newLikes = $likes + 1;
	
	update_post_meta($postID, 'pm_total_likes', $likes);
	
	exit;
	
}


//FUNCTIONS

function moxie_theme_validate_email($email){
			
	return filter_var($email, FILTER_VALIDATE_EMAIL);
	
}//end of validate_email()



function moxie_theme_send_contact_form() {
			
	 // Verify nonce
     if( isset( $_POST['moxie_theme_send_contact_nonce'] ) ) {
	
	   if ( !wp_verify_nonce( $_POST['moxie_theme_send_contact_nonce'], 'moxie_theme_nonce_action' ) ) {
		   die( 'A system error has occurred, please try again later.' );
	   }	   
	  
     }

	 //Post values
	 $first_name = sanitize_text_field($_POST['first_name']);
     $last_name = sanitize_text_field($_POST['last_name']);
	 $email_address = sanitize_text_field($_POST['email_address']);
	 $message = sanitize_text_field($_POST['message']);
	 $phone = sanitize_text_field($_POST['phone']);
	 $recipient = sanitize_text_field($_POST['recipient']);
	 
	
	 if ( empty($first_name) ){
		
		echo 'first_name_error';
		die();
		
	} elseif( empty($last_name) ){
		
		echo 'last_name_error';
		die();
		
	} elseif( !moxie_theme_validate_email($email_address) ){
		
		echo 'email_error';
		die();
		
	} elseif( empty($message) ){
		
		echo 'message_error';
		die();
		
	} 
	
	//All good, send email
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$headers .= 'From: '.esc_attr__('donotreply', 'luxortheme').'@'. $_SERVER['SERVER_NAME'] .' <'.esc_attr__('donotreply', 'luxortheme').'@'. $_SERVER['SERVER_NAME'] .'>' . "\r\n";
	
	$multiple_recipients = array(
		$recipient
	);
	
	$subj = esc_attr__('Contact Form Inquiry', 'moxietheme');
	
	$body = ' 
	
	  **** '. esc_html__('THIS IS AN AUTOMATED MESSAGE. PLEASE DO NOT REPLY DIRECTLY TO THIS EMAIL', 'moxietheme') .' **** 
	  
	   '. esc_html__('First Name', 'luxortheme') .': '.$first_name.'
	   '. esc_html__('Last Name', 'luxortheme') .': '.$last_name.'
	   '. esc_html__('Email Address', 'luxortheme') .': '.$email_address.'
	   '. esc_html__('Phone Number', 'luxortheme') .': '.$phone.'
	   '. esc_html__('Message', 'luxortheme') .': '.$message.'
	  
	';
	
	$send_mail = wp_mail( $multiple_recipients, $subj, $body );
	
	if($send_mail) {
		
		echo 'success';
		die();
		
	} else {
		
		echo 'failed';
		die();
			
	}
		
}


function moxie_theme_send_quick_contact_form() {
			
	 // Verify nonce
     if( isset( $_POST['moxie_theme_send_quick_contact_nonce'] ) ) {
	
	   if ( !wp_verify_nonce( $_POST['moxie_theme_send_quick_contact_nonce'], 'moxie_theme_nonce_action' ) ) {
		   die( 'A system error has occurred, please try again later.' );
	   }	   
	  
     }

	 //Post values
	 $full_name = sanitize_text_field($_POST['full_name']);
	 $email_address = sanitize_text_field($_POST['email_address']);
	 $message = sanitize_text_field($_POST['message']);
	 $recipient = sanitize_text_field($_POST['recipient']);
	 
	
	 if ( empty($full_name) ){
		
		echo 'full_name_error';
		die();

		
	} elseif( !moxie_theme_validate_email($email_address) ){
		
		echo 'email_error';
		die();
		
	} elseif( empty($message) ){
		
		echo 'message_error';
		die();
		
	} 
	
	//All good, send email
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$headers .= 'From: '.esc_attr__('donotreply', 'luxortheme').'@'. $_SERVER['SERVER_NAME'] .' <'.esc_attr__('donotreply', 'luxortheme').'@'. $_SERVER['SERVER_NAME'] .'>' . "\r\n";
	
	$multiple_recipients = array(
		$recipient
	);
	
	$subj = esc_attr__('Quick Contact Form Inquiry', 'moxietheme');
	
	$body = ' 
	
	  **** '. esc_html__('THIS IS AN AUTOMATED MESSAGE. PLEASE DO NOT REPLY DIRECTLY TO THIS EMAIL', 'moxietheme') .' **** 
	  
	  '. esc_html__('Name', 'luxortheme') .': '.$full_name.'
	  '. esc_html__('Email Address', 'luxortheme') .': '.$email_address.'
	  '. esc_html__('Message', 'luxortheme') .': '.$message.'
  
	';
	
	$send_mail = wp_mail( $multiple_recipients, $subj, $body );
	
	if($send_mail) {
		
		echo 'success';
		die();
		
	} else {
		
		echo 'failed';
		die();
			
	}
		
}

?>