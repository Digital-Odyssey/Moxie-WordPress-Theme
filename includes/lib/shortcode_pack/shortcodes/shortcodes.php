<?php 

/*
Plugin Name: Shortcode Pack for Moxie Theme
Plugin URI: http://www.microthemes.ca
Description: Shortcode Pack for Moxie Theme
Version: 1.0
Author: Micro Themes
Author URI:http://www.microthemes.ca
License: GPLv2
*/

add_action('admin_init', 'moxie_theme_add_tiny_shortcodes');  
add_action('wp_enqueue_scripts', 'pm_load_shortcode_scripts');

add_filter( 'the_content', 'moxie_theme_run_shortcodes', 7 );
add_filter( 'widget_text', 'moxie_theme_run_shortcodes', 7 );

//Language support
add_action('plugins_loaded', 'moxie_theme_shortcodes_languages'); //LOAD LANGUAGE FILES FOR LOCALIZATION SUPPORT


//localization support
function moxie_theme_shortcodes_languages() { 
	load_plugin_textdomain( 'moxieShortcodePack', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' ); 
} 

function moxie_theme_run_shortcodes( $content ) {
	
    global $shortcode_tags;
	
	add_shortcode("sliderCarousel", "sliderCarousel");//COMPLETE
	add_shortcode("sliderItem", "sliderItem");//COMPLETE
	
	add_shortcode("pricingTable", "pricingTable");//COMPLETE
	add_shortcode("pricingTableInfoBox", "pricingTableInfoBox");//COMPLETE
	
	add_shortcode("tabGroup", "tabGroup");//COMPLETE
	add_shortcode("tabItem", "tabItem");//COMPLETE
	
	add_shortcode("accordionGroup", "accordionGroup");//COMPLETE
	add_shortcode("accordionItem", "accordionItem");//COMPLETE
	
	add_shortcode("timeTableGroup", "timeTableGroup");//COMPLETE
	add_shortcode("timeTableItem", "timeTableItem");//COMPLETE
	
	add_shortcode("dataTableGroup", "dataTableGroup");//COMPLETE
	add_shortcode("dataTableItem", "dataTableItem");//COMPLETE	
	
	add_shortcode("skillsTableGroup", "skillsTableGroup");//COMPLETE
	add_shortcode("skillsTableItem", "skillsTableItem");//COMPLETE	
	
	add_shortcode("servicesGroup", "servicesGroup");//COMPLETE
	add_shortcode("servicesGroupItem", "servicesGroupItem");//COMPLETE	
	
	add_shortcode("staffCarousel", "staffCarousel");//COMPLETE
	add_shortcode("bioCarousel", "bioCarousel");//COMPLETE
	add_shortcode("galleryItems", "galleryItems");//COMPLETE
	add_shortcode("youtubeVideo", "youtubeVideo");//COMPLETE
	add_shortcode("vimeoVideo", "vimeoVideo");//COMPLETE
	add_shortcode("html5Video", "html5Video");//COMPLETE
	
	//Pulsar shortcodes
	
	add_shortcode("googleMap", "googleMap");//COMPLETE
	add_shortcode("postItems", "postItems");//COMPLETE
	add_shortcode("panelsCarousel", "panelsCarousel");//COMPLETE
	add_shortcode("clientCarousel", "clientCarousel");//COMPLETE
	add_shortcode("progressBar", "progressBar");//COMPLETE
	add_shortcode("iconElement", "iconElement");//COMPLETE
	add_shortcode("divider", "divider");//COMPLETE
	add_shortcode("standardButton", "standardButton");//COMPLETE
	add_shortcode("milestone", "milestone");//COMPLETE
	add_shortcode("piechart", "piechart");//COMPLETE
	add_shortcode("contactForm", "contactForm");//COMPLETE
	add_shortcode("alert", "alert");//COMPLETE
	add_shortcode("quoteBox", "quoteBox"); //COMPLETE
	
	//Bootstrap 3
	add_shortcode("bootstrapContainer", "bootstrapContainer");//COMPLETE
	add_shortcode("bootstrapRow", "bootstrapRow");//COMPLETE
	add_shortcode("bootstrapColumn", "bootstrapColumn");//COMPLETE
	add_shortcode("nestedRow", "nestedRow");//COMPLETE
	add_shortcode("nestedColumn", "nestedColumn");//COMPLETE
	
    // Do the shortcode (only the one above is registered)
    $content = do_shortcode( $content );
    return $content;
	
}




function pm_load_shortcode_scripts() {

	//wp_enqueue_script( 'pulsar-staffjs', plugin_dir_url(__FILE__) . 'js/pm-staff-admin.js', array(), '1.0', true );
	wp_enqueue_style( 'pulsar-shortcode-styles', plugin_dir_url(__FILE__) . 'css/pm-shortcodes.css' );
	
}


function moxie_theme_add_tiny_shortcodes() { 

	if ( current_user_can('edit_posts') && current_user_can('edit_pages') ) {
		 
		 //Bootstrap 3
		 add_filter('mce_external_plugins', 'add_plugin_bootstrapContainer');  
     	 add_filter('mce_buttons_3', 'register_bootstrapContainer'); 
		 
		 add_filter('mce_external_plugins', 'add_plugin_bootstrapRow');  
     	 add_filter('mce_buttons_3', 'register_bootstrapRow'); 
		 
		 add_filter('mce_external_plugins', 'add_plugin_bootstrapColumn');  
     	 add_filter('mce_buttons_3', 'register_bootstrapColumn'); 
		 
		 add_filter('mce_external_plugins', 'add_plugin_alert');  
     	 add_filter('mce_buttons_3', 'register_alert'); 
		 
		 //Add "standardButton" button
		 add_filter('mce_external_plugins', 'add_plugin_standardButton');  
		 add_filter('mce_buttons_3', 'register_standardButton');  
		 		 
		 //Add "Progress bar"
		 add_filter('mce_external_plugins', 'add_plugin_progressBar');  
		 add_filter('mce_buttons_3', 'register_progressBar');

		 
		 //Add "divider" button
		 add_filter('mce_external_plugins', 'add_plugin_divider');  
		 add_filter('mce_buttons_3', 'register_divider'); 
		 
		 //Videos
		 add_filter('mce_external_plugins', 'add_plugin_youtubeVideo');  
     	 add_filter('mce_buttons_3', 'register_youtubeVideo'); 
		 
		 add_filter('mce_external_plugins', 'add_plugin_vimeoVideo');  
     	 add_filter('mce_buttons_3', 'register_vimeoVideo'); 
		 
		 add_filter('mce_external_plugins', 'add_plugin_html5Video');  
     	 add_filter('mce_buttons_3', 'register_html5Video'); 
		 
		 //postItems
		 add_filter('mce_external_plugins', 'add_plugin_postItems');  
     	 add_filter('mce_buttons_3', 'register_postItems'); 
		 
		 //galleryItems
		add_filter('mce_external_plugins', 'add_plugin_galleryItems');  
     	add_filter('mce_buttons_3', 'register_galleryItems');

		 
		 //Tab Group
		 add_filter('mce_external_plugins', 'add_plugin_tabGroup');  
     	 add_filter('mce_buttons_3', 'register_tabGroup');
		 
		  //timeTableGroup Group
		 add_filter('mce_external_plugins', 'add_plugin_timeTableGroup');  
     	 add_filter('mce_buttons_3', 'register_timeTableGroup');
		 
		 //Accordion Group
		 add_filter('mce_external_plugins', 'add_plugin_accordionGroup');  
     	 add_filter('mce_buttons_3', 'register_accordionGroup');

		 
		 //Contact Form
		 add_filter('mce_external_plugins', 'add_plugin_contactForm');  
     	 add_filter('mce_buttons_3', 'register_contactForm');	

		 
		 //Google Map
		 add_filter('mce_external_plugins', 'add_plugin_googleMap');  
     	 add_filter('mce_buttons_3', 'register_googleMap');	
		 
		 //CTA Box
		 //add_filter('mce_external_plugins', 'add_plugin_ctaBox');  
     	 //add_filter('mce_buttons_3', 'register_ctaBox');
		 
		  //Icon Element
		 add_filter('mce_external_plugins', 'add_plugin_iconElement');  
     	 add_filter('mce_buttons_3', 'register_iconElement');	
		 
		 //Flexslider Carousel
		 add_filter('mce_external_plugins', 'add_plugin_sliderCarousel');  
     	 add_filter('mce_buttons_3', 'register_sliderCarousel');
		 
		 //Client Carousel
		 add_filter('mce_external_plugins', 'add_plugin_clientCarousel');  
     	 add_filter('mce_buttons_3', 'register_clientCarousel');
		 
		 //Panels Carousel
		 add_filter('mce_external_plugins', 'add_plugin_panelsCarousel');  
     	 add_filter('mce_buttons_3', 'register_panelsCarousel');
		 
		 //Pie Chart
		 add_filter('mce_external_plugins', 'add_plugin_piechart');  
     	 add_filter('mce_buttons_3', 'register_piechart');
		 
		 //Milestone
		 add_filter('mce_external_plugins', 'add_plugin_milestone');  
     	 add_filter('mce_buttons_3', 'register_milestone');
		 
		 //Quote Box
		 add_filter('mce_external_plugins', 'add_plugin_quoteBox');  
     	 add_filter('mce_buttons_3', 'register_quoteBox');	
		 
		 //Pricing Table
		 add_filter('mce_external_plugins', 'add_plugin_pricingTable');  
     	 add_filter('mce_buttons_3', 'register_pricingTable');	 

		 //Data Table
		 add_filter('mce_external_plugins', 'add_plugin_dataTableGroup');  
     	 add_filter('mce_buttons_3', 'register_dataTableGroup');
		 
		 //Skills Table
		 add_filter('mce_external_plugins', 'add_plugin_skillsTableGroup');  
     	 add_filter('mce_buttons_3', 'register_skillsTableGroup');
		 
		 //Services Group
		 add_filter('mce_external_plugins', 'add_plugin_servicesGroup');  
     	 add_filter('mce_buttons_3', 'register_servicesGroup');
		 
		 //Staff Profile
		 add_filter('mce_external_plugins', 'add_plugin_staffCarousel');  
     	 add_filter('mce_buttons_3', 'register_staffCarousel');
		 
		 //bio carousel
		 add_filter('mce_external_plugins', 'add_plugin_bioCarousel');  
     	 add_filter('mce_buttons_3', 'register_bioCarousel'); 

		
		
	}

}


//BIO CAROUSEL
function bioCarousel($atts, $content = null) {

	extract(shortcode_atts(array(  
		"bg_image" => '',
		"parallax" => 'on',
		"title" => 'Our History'
    ), $atts)); 
	
	
	//Redux options
	global $moxie_options;
	
	$bioPanels = '';
	$panelCounter1 = 1;
	$panelCounter2 = 1;
				
	if( isset($moxie_options['opt-bio-slides']) && !empty($moxie_options['opt-bio-slides']) ){
		$bioPanels = $moxie_options['opt-bio-slides'];
	}
	
	$html = '';
	
	$html .= '<div class="pm-timeline-wrapper '. ($parallax === 'on' ? 'pm-parallax-panel' : '') .'" '. ($bg_image !== '' ? 'style="background-image:url('.$bg_image.')"' : '') .' '. ($parallax === 'on' ? 'data-stellar-background-ratio="0.5"' : '') .'>';
	
		$html .= '<div class="pm-timeline-bg-overlay"></div>';
		
		$html .= '<div class="pm-timeline-text-underlay"><div class="pm-timeline-text-underlay-title">'.$title.'</div></div>';
		
		$html .= '<div class="pm-timeline-mobile-title">'.$title.'</div>';
	
		$html .= '<div class="pm-timeline-container" id="pm-timeline-container">';
	
		$html .= '<ul class="pm-timeline-dates">';
		
			if(is_array($bioPanels)){
					
				foreach($bioPanels as $p) {
					
					$dashCount = substr_count($p['title'], ' - ');
					
					$date = '';
					$subTitle = '';
					$icon = '';
					
					if($dashCount > 0) {
					
						$pieces = explode(" - ", $p['title']);
					
						$date = $pieces[0];
						$subTitle = $pieces[1];
						$icon = $pieces[2];
						
					} else {
						
						$date = $p['url'];
							
					}
					
					if($panelCounter1 == 1) {
						$html .= '<li class="active">';
					} else {
						$html .= '<li>';	
					}
							$html .= '<i class="'.$icon.'"></i>';
							$html .= '<p class="pm-timeline-dates-date">'.$date.'</p>';
							$html .= '<p class="pm-timeline-dates-message">'.$subTitle.'</p>';
						$html .= '</li>';
					
					$panelCounter1++;
					
				}//end of foreach
				
			}//end if
						
			$html .= '</ul>';
			
			$html .= '<div class="pm-timeline-controller">';
				
				$html .= '<div class="pm-timeline-bar"></div>';
				$html .= '<a href="#" class="pm-timeline-bar-prev-btn fa fa-chevron-up" id="pm-timeline-bar-prev-btn"></a>';
				$html .= '<a href="#" class="pm-timeline-bar-next-btn fa fa-chevron-down" id="pm-timeline-bar-next-btn"></a>';
				
				$html .= '<div class="pm-timeline-controller-bullet first"></div>';
				$html .= '<div class="pm-timeline-controller-bullet second"></div>';
				$html .= '<div class="pm-timeline-controller-bullet third"></div>';
				
			$html .= '</div>';
			
			$html .= '<ul class="pm-timeline-descriptions">';
			
				if(is_array($bioPanels)){
					
					foreach($bioPanels as $p) {
						
						$desc = $p['description'];
						$mainTitle = $p['url'];
						
						if($panelCounter2 == 1) {
							$html .= '<li class="active">';
						} else {
							$html .= '<li>';	
						}
								$html .= '<span class="pm-timeline-descriptions-title">'.$mainTitle.'</span>';
								$html .= '<div class="pm-timeline-descriptions-divider"></div>';
								
								$html .= '<p>'.$desc.'</p>';
							$html .= '</li>';
						
						$panelCounter2++;
						
					}//end of foreach	
					
				}//end if
				
			$html .= '</ul>';
			
		$html .= '</div>';
		
	$html .= '</div>';
					
    return $html;
	
}


//GALLERY ITEMS
function galleryItems($atts, $content = null) {
	
	extract(shortcode_atts(array(
		"post_order" => 'DESC',
		), 
	$atts));
	
	$arguments = array(
		'post_type' => 'post_galleries',
		'post_status' => 'publish',
		//'posts_per_page' => -1,
		'order' => (string) $post_order,
		'posts_per_page' => -1,
		//'tag' => get_query_var('tag')
	);
	
	$post_query = new WP_Query($arguments);

	moxie_theme_set_query($post_query);
	
	$terms = get_terms('gallerycats');
	
	$html = '';
	
	$html .= '<div class="pm-portfolio-system-filter-container">';
	
		$html .= '<ul class="pm-portfolio-system-filter" id="pm-portfolio-system-filter">';
                	
			$html .= '<li class="pm-portfolio-system-filter-expand" id="pm-portfolio-system-filter-expand">Currently Viewing: <i class="fa fa-angle-down"></i></li>';
		
			$html .= '<li><a id="all" href="#" class="active">all</a></li>';
			
			foreach ($terms as $term) {
				$html .= '<li><a href="#" id="'.$term->slug.'">'.ucfirst($term->name).'</a></li>';	
			}
			
		$html .= '</ul>';
	
		$html .= '<div class="pm-portfolio-system-filter-active-bar" id="pm-portfolio-system-filter-active-bar"></div>';
	
	$html .= '</div>';
	
	
	if ($post_query->have_posts()) {
		$html .= '<div class="pm-portfolio-system-container" id="gallery-posts"><div id="pm-isotope-item-container"><div class="grid-sizer"></div>';
	}
	
	
	if ($post_query->have_posts()) : while ($post_query->have_posts()) : $post_query->the_post();
	
		$pm_gallery_thumb_image_meta = get_post_meta(get_the_ID(), 'pm_gallery_thumb_image_meta', true);	
		$pm_gallery_image_meta = get_post_meta(get_the_ID(), 'pm_gallery_image_meta', true);	
		$pm_gallery_item_caption_meta = get_post_meta(get_the_ID(), 'pm_gallery_item_caption_meta', true);	
		$likes = get_post_meta(get_the_ID(), 'pm_total_likes', true);	
		
		$pm_featured_project_caption = get_post_meta(get_the_ID(), 'pm_featured_project_caption', true);	
		$pm_enable_video_mode = get_post_meta(get_the_ID(), 'pm_enable_video_mode', true);
	 	$pm_featured_video_url = get_post_meta(get_the_ID(), 'pm_featured_video_url', true);
	
		$terms = get_the_terms(get_the_ID(), 'gallerycats' );
		$terms_slug_str = '';
		if ($terms && ! is_wp_error($terms)) :
			$term_slugs_arr = array();
			foreach ($terms as $term) {
				$term_slugs_arr[] = $term->slug;
			}
			$terms_slug_str = join(" ", $term_slugs_arr);
		endif;
		
		$html .= '<div class="isotope-item '. ($terms_slug_str != '' ? $terms_slug_str : '') .' all">';
                    
			$html .= '<div class="pm-gallery-post-container">';
			
				$html .= '<div class="pm-gallery-post-overlay"></div>';

			
				$html .= '<div class="pm-gallery-post-img-container">';
					$html .= '<img src="'.$pm_gallery_thumb_image_meta.'" alt="'.get_the_title().'" />';
				$html .= '</div>';
			
				$html .= '<div class="pm-gallery-post-like-box-container">';
					$html .= '<a href="#" class="pm-gallery-post-like-box icon-heart pm-like-this-btn" id="'.get_the_ID().'"></a>';
					
					if($likes === '') {
						$html .= '<span id="pm-post-total-likes-count-'.get_the_ID().'">0</span>';
					} else {
						$html .= '<span id="pm-post-total-likes-count-'.get_the_ID().'">'.$likes.'</span>';
					}
					
					
				$html .= '</div>';
				
				$html .= '<div class="pm-gallery-post-expand-btn-container">';
					$html .= '<a href="#" class="pm-gallery-post-expand-btn"></a>';
				$html .= '</div>';
				
				$html .= '<div class="pm-gallery-post-details-container">';
					
					$html .= '<div class="pm-gallery-post-details">';
						
						$html .= '<ul class="pm-gallery-post-details-btns">';
							$html .= '<li class="pm_tip_static_top" title="'.__('View Post', 'moxieShortcodePack').'" data-tip-offset-x="5" data-tip-offset-y="-27"><a href="'.get_the_permalink().'" class="fa fa-bars"></a></li>';
							
							if( $pm_enable_video_mode === 'yes' ){
								
								$html .= '<li class="pm_tip_static_top" title="'.__('View Video', 'moxieShortcodePack').'" data-tip-offset-x="5" data-tip-offset-y="-27"><a href="//www.youtube.com/watch?v='.esc_attr($pm_featured_video_url).'" data-rel="prettyPhoto1[video]" title="'.esc_attr($pm_featured_project_caption).'" class="fa fa-video-camera lightbox"></a></li>';	
								
							} else {
								
								$html .= '<li class="pm_tip_static_top" title="'.__('View Image', 'moxieShortcodePack').'" data-tip-offset-x="5" data-tip-offset-y="-27"><a href="'.esc_html($pm_gallery_image_meta).'" data-rel="prettyPhoto[portfolio]" title="'.esc_attr($pm_featured_project_caption).'" class="fa fa-camera lightbox"></a></li>';	
								
							}
											
							
							$html .= '<li class="pm_tip_static_top" title="'.__('Close', 'moxieShortcodePack').'" data-tip-offset-x="5" data-tip-offset-y="-27"><a href="#" class="fa fa-close pm-gallery-post-details-close-btn"></a></li>';
						$html .= '</ul>';
						
						$html .= '<p class="title">'.get_the_title().'</p>';
						
					$html .= '</div>';
					
				$html .= '</div>';
				
			$html .= '</div>';
		$html .= '</div>';

	
	endwhile; else:
		 $html .= '<div class="col-lg-12 pm-column-spacing">';
		 $html .= '<p>'.__('No gallery items were found.', 'moxieShortcodePack').'</p>';
		 $html .= '</div>';
	endif;
	
	
	if ($post_query->have_posts()) {
		$html .= '</div></div>';
	}
	
	moxie_theme_restore_query();
	
	return $html;
	
}

//POST ITEMS
function postItems($atts, $content = null) {
		
	extract(shortcode_atts(array(
		"num_of_posts" => '3',
		"post_order" => 'DESC',
		"text_color" => '#ffffff',
		"blog_url" => '',
		"tag" => '',
		"category" => '',
		"class" => 'wow fadeInUp'
		), 
	$atts));
	
	//Fetch data
	if($tag !== ''){
		
		$arguments = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'order' => (string) $post_order,
			'tax_query' => array(
					array(
						'taxonomy' => 'post_tag',
						'field' => 'slug',
						'terms' => array( $tag )
					)
			),
			//'posts_per_page' => -1,
			'posts_per_page' => $num_of_posts,
			'ignore_sticky_posts' => 1
			//'tag' => get_query_var('tag')
		);
		
	} else if($category !== '') {
		
		$arguments = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'order' => (string) $post_order,
			'tax_query' => array(
					array(
						'taxonomy' => 'category',
						'field' => 'slug',
						'terms' => array( $category )
					)
			),
			//'posts_per_page' => -1,
			'posts_per_page' => $num_of_posts,
			'ignore_sticky_posts' => 1
			//'tag' => get_query_var('tag')
		);
		
	} else {
		
		$arguments = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			//'posts_per_page' => -1,
			'order' => (string) $post_order,
			'posts_per_page' => $num_of_posts,
			'ignore_sticky_posts' => 1
			//'tag' => get_query_var('tag')
		);
		
	}	
	
	$post_query = new WP_Query($arguments);

	moxie_theme_set_query($post_query);

	$animationCounter = 3;
	
	$html = '';
	
	//Display Items
	$html .= '<div'. ($num_of_posts > 3 ? ' id="pm-postItems-carousel"' : '') .'>';
		
		if ($post_query->have_posts()) : while ($post_query->have_posts()) : $post_query->the_post();
		
			$categories = get_the_category();
	 
			if ( has_post_thumbnail() ) {
			  $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
			}
			
			if($num_of_posts == "1"){
				$html .= '<div class="col-lg-12">';
			} elseif($num_of_posts == "2") {
				$html .= '<div class="col-lg-6 col-md-6 col-sm-12">';
			} elseif($num_of_posts == "3") {
				$html .= '<div class="col-lg-4 col-md-4 col-sm-12">';
			} else {
				$html .= '<div class="pm-postItem-carousel-item">';	
			}
			
				$html .= '<article>';	
				
					$html .= '<div class="pm-home-news-post-container" '. ( has_post_thumbnail() ? 'style="background-image:url('.$image_url[0].');"' : '' ) .'>';     
					
						foreach ( $categories as $category ) {
							$cat = get_category( $category );
							$html .= '<a href="'.get_category_link( $cat->term_id ).'" class="pm-home-news-post-category">'.$cat->cat_name.'</a>';	
						}
					
						$html .= '<div class="pm-home-news-post-info-container">';
						
							$html .= '<a href="#" class="pm-home-news-post-info-expand-btn"><i class="icon-size-fullscreen"></i></a>';
							
							$html .= '<div class="pm-home-news-post-links-container">';
							
								$html .= '<ul class="pm-home-news-post-links-list">';
									$html .= '<li><a href="https://twitter.com/share?url='. urlencode(get_the_permalink()) .'&amp;text='. urlencode(get_the_title()) .'" target="_blank"><i class="fa fa-twitter"></i></a></li>';
									$html .= '<li><a href="'.get_the_permalink().'"><i class="fa fa-bars"></i></a></li>';
								$html .= '</ul>';
							
							$html .= '</div>';
						
							$html .= '<div class="pm-home-news-post-info-meta-container">';
							
								$html .= '<ul class="pm-home-news-post-info-meta-list">';
									$html .= '<li><i class="icon-clock"></i> <br>'.get_the_time( 'M' ).' <br>'.get_the_time( 'd' ).'</li>';
									$html .= '<li><i class="icon-user"></i> <br>'.get_the_author().'</li>';
								$html .= '</ul>';
							
							$html .= '</div>';
							
							$html .= '<div class="pm-home-news-post-excerpt-container">';
							
								$html .= '<h6><a href="'.get_the_permalink().'" class="pm-home-news-post-title">'.get_the_title().'</a></h6>';
								
								$excerpt = get_the_excerpt();
								
								$html .= '<p class="pm-home-news-post-excerpt">'. moxie_theme_string_limit_words($excerpt, 12) .' <a href="'.get_the_permalink().'">[...]</a></p>';
							
							$html .= '</div>';
														
							$html .= '<div class="pm-home-news-post-likes-container">';
							
								$likes = get_post_meta(get_the_ID(), 'pm_total_likes', true);
								$views = get_post_meta(get_the_ID(), 'post_views', true);
								$comments = get_comments_number( get_the_ID() );
							
								$html .= '<ul class="pm-home-news-post-likes-list">';
									$html .= '<li><i class="icon-eye"></i> '. ( $views !== '' ? $views : '0' ) .'</li>';
									$html .= '<li><i class="icon-bubble"></i> '.$comments.'</li>';
									$html .= '<li><a href="#" id="'. get_the_ID() .'" class="icon-heart pm-like-this-btn"></a> <span id="pm-post-total-likes-count-'. get_the_ID() .'">'. ( $likes !== '' ? $likes : '0' ) .'</span></li>';
								$html .= '</ul>';
							
							$html .= '</div>';
													
						$html .= '</div>';
						
					$html .= '</div>';
										
				$html .= '</article>';
				
				$animationCounter += 3;
			
			$html .= '</div>';
			
			
		
		endwhile; else:
			$html .= '<div class="col-lg-12 pm-column-spacing">';
			 $html .= '<p>'.__('No posts were found.', 'moxieShortcodePack').'</p>';
			$html .= '</div>';
		endif;
		
		if($blog_url !== '') : 
		
			$html .= '<div class="row">';
				$html .= '<div class="col-lg-12 pm-center pm-containerPadding-top-60 pm-news-shortcode-blog-continue-container">';
					$html .= '<a class="pm-home-news-post-continue" href="'.$blog_url.'">'.__('Continue to blog','moxieShortcodePack').' &nbsp;<i class="fa fa-angle-right"></i></a>';
				$html .= '</div>';
			$html .= '</div>';
		
		endif;
		
	
	$html .= '</div>';
				
	moxie_theme_restore_query();
	
	return $html;
	
		
}

//STAFF PROFILE
function staffCarousel( $atts, $content = null ){
	
	extract(shortcode_atts(array(
		"post_order" => 'DESC',
		), 
	$atts));
	
	//Method to retrieve a single post
	$arguments = array(
			'post_type' => 'post_staff',
			'post_status' => 'publish',
			//'posts_per_page' => -1,
			'order' => (string) $post_order,
			'posts_per_page' => -1,
			//'tag' => get_query_var('tag')
		);


	$post_query = new WP_Query($arguments);
	
	moxie_theme_set_query($post_query);
	
	$staffCounter1 = 1;
	$staffCounter2 = 1;		
	
	$html = '';
	
	$html .= '<div class="pm-staff-member-system" id="pm-staff-member-system">';
        
		$html .= '<ul class="pm-staff-member-system-profile-image-list">';
		
			if ($post_query->have_posts()) : while ($post_query->have_posts()) : $post_query->the_post();
			
				//retrieve post meta
				$pm_staff_image_meta = get_post_meta(get_the_ID(), 'pm_staff_image_meta', true);
			
				if($staffCounter1 === 1) {
					$html .= '<li class="active"><div class="pm-staff-member-system-profile-image profile'.$staffCounter1.'" style="background-image:url('.esc_html($pm_staff_image_meta).');"></div></li>';
				} else {
					$html .= '<li><div class="pm-staff-member-system-profile-image profile'.$staffCounter1.'" style="background-image:url('.esc_html($pm_staff_image_meta).');"></div></li>';
				}
				
				$staffCounter1++;
	
			endwhile; else: endif;
		
		$html .= '</ul>';
		
		
		$html .= '<div class="pm-staff-member-system-controls">';
			$html .= '<div class="pm-staff-member-system-controls-vertical-divider"></div>';
			$html .= '<div class="pm-staff-member-system-controls-horizontal-divider"></div>';
			$html .= '<a href="#" class="pm-staff-member-system-controls-btn prev fa fa-angle-left"></a>';
			$html .= '<a href="#" class="pm-staff-member-system-controls-btn next fa fa-angle-right"></a>';
		$html .= '</div>';
		
		
		$html .= '<ul class="pm-staff-member-system-bio-list">';
		
			if ($post_query->have_posts()) : while ($post_query->have_posts()) : $post_query->the_post();
			
				//retrieve post meta
				$pm_staff_title_meta = get_post_meta(get_the_ID(), 'pm_staff_title_meta', true);
				$pm_staff_twitter_meta = get_post_meta(get_the_ID(), 'pm_staff_twitter_meta', true);
				$pm_staff_facebook_meta = get_post_meta(get_the_ID(), 'pm_staff_facebook_meta', true);
				$pm_staff_gplus_meta = get_post_meta(get_the_ID(), 'pm_staff_gplus_meta', true);
				$pm_staff_linkedin_meta = get_post_meta(get_the_ID(), 'pm_staff_linkedin_meta', true);
				$pm_staff_email_address_meta = get_post_meta(get_the_ID(), 'pm_staff_email_address_meta', true);
				$enableTooltip = get_theme_mod('enableTooltip','on');
	
				if($staffCounter2 === 1) {
					$html .= '<li class="active">';
				} else {
					$html .= '<li>';
				}
					$html .= '<div class="pm-staff-member-system-bio">';
			
						$html .= '<p class="pm-staff-member-system-bio-name">'.get_the_title().'</p>';
						$html .= '<div class="pm-staff-member-system-bio-divider"></div>';
						$html .= '<p class="pm-staff-member-system-bio-title">'.esc_attr($pm_staff_title_meta).'</p>';
						
						$html .= '<ul class="pm-staff-member-system-bio-social-icons">';
						
							if($pm_staff_twitter_meta !== '') :
								$html .= '<li class="'. ($enableTooltip === 'on' ? 'pm_tip_static_top' : '') .'" '. ($enableTooltip === 'on' ? 'title="'. __('Twitter', 'moxieShortcodePack') .'"' : '') .' data-tip-offset-x="5" data-tip-offset-y="-30"><a href="#" class="fa fa-twitter"></a></li>';
							endif;
							
							if($pm_staff_facebook_meta !== '') :
								$html .= '<li class="'. ($enableTooltip === 'on' ? 'pm_tip_static_top' : '') .'" '. ($enableTooltip === 'on' ? 'title="'. __('Facebook', 'moxieShortcodePack') .'"' : '') .' data-tip-offset-x="5" data-tip-offset-y="-30"><a href="#" class="fa fa-facebook"></a></li>';
							endif;
							
							if($pm_staff_gplus_meta !== '') :
								$html .= '<li class="'. ($enableTooltip === 'on' ? 'pm_tip_static_top' : '') .'" '. ($enableTooltip === 'on' ? 'title="'. __('Google Plus', 'moxieShortcodePack') .'"' : '') .' data-tip-offset-x="5" data-tip-offset-y="-30"><a href="#" class="fa fa-google-plus"></a></li>';
							endif;
							
							if($pm_staff_linkedin_meta !== '') :
								$html .= '<li class="'. ($enableTooltip === 'on' ? 'pm_tip_static_top' : '') .'" '. ($enableTooltip === 'on' ? 'title="'. __('Linkedin', 'moxieShortcodePack') .'"' : '') .' data-tip-offset-x="5" data-tip-offset-y="-30"><a href="#" class="fa fa-linkedin"></a></li>';
							endif;
							
							if($pm_staff_email_address_meta !== '') :
								$html .= '<li class="'. ($enableTooltip === 'on' ? 'pm_tip_static_top' : '') .'" '. ($enableTooltip === 'on' ? 'title="'. __('Email Me!', 'moxieShortcodePack') .'"' : '') .' data-tip-offset-x="5" data-tip-offset-y="-30"><a href="mailto:'.$pm_staff_email_address_meta.'" class="fa fa-inbox"></a></li>';
							endif;
							
						$html .= '</ul>';
						
						$html .= '<p class="pm-staff-member-system-bio-desc">'.get_the_excerpt().'</p>';
						
						$html .= '<div class="pm-staff-member-system-bio-divider-dotted"></div>';
						
						$html .= '<a href="'.get_the_permalink().'" class="pm-staff-member-system-bio-view-profile">'.__('View Profile', 'moxieShortcodePack').' <i class="fa fa-arrow-circle-o-right"></i></a>';
						
					$html .= '</div>';
				$html .= '</li>';
				
	
				$staffCounter2++;
	
			endwhile; else: endif;
		
		$html .= '</ul>';
	
	$html .= '</div>';
	
	moxie_theme_restore_query();
			
	return $html;
	
}


//SERVICES TABLE GROUP
function servicesGroup( $atts, $content = null ){
	
	extract(shortcode_atts(array(
		'parallax' => 'on',
		'bg_image' => '',
	), $atts));
	
	$GLOBALS['pm_services_group_item_count'] = 1;
	
	do_shortcode( $content );
	
	if( is_array( $GLOBALS['servicesGroupItems'] ) ){
	
		//Render skills buttons $buttons['title']
		foreach( $GLOBALS['servicesGroupItems'] as $button ){
			
			$buttons[] = '<li><div class="pm_services_tab_icon_container active"><div class="pm_services_tab_icon shadow"><div class="front face"><i class="'.$button['icon'].'"></i></div><div class="back face center"><a href="#" id="pm-services-tab-btn-'.$button['id'].'">'.$button['rollover_text'].'</a></div></div></div><p>'.$button['title'].'</p></li>';
			
			/*$buttons[] = '<li>
                            <div class="pm_services_tab_icon_container active">
                                <div class="pm_services_tab_icon shadow">
                                  <div class="front face">
                                    <i class="'.$buttons['icon'].'"></i>
                                  </div>
                                  <div class="back face center">
                                    <a href="#" id="pm-services-tab-btn-'.$buttons['id'].'">'.$buttons['rollover_text'].'</a>
                                  </div>
                                </div>
                            </div>
                            <p>'.$buttons['title'].'</p>
                        </li>';*/
			
	
		}
		
		
		//Render description area
		foreach( $GLOBALS['servicesGroupItems'] as $description ){
			
			$descriptions[] = '<div class="pm-services-tab-system-desc" id="pm-services-tab-system-desc-'.$description['id'].'"><div class="pm-services-tab-system-desc-wrapper"><div class="pm-services-tab-system-desc-text"><h5>'.$description['title'].' <i class="'.$description['icon'].'"></i></h5><div class="pm-services-tab-divider"></div><p>'.$description['content'].'</p></div></div><a href="#" class="pm-services-tab-system-desc-expander fa fa-angle-down" id="pm-services-tab-system-desc-expander-'.$description['id'].'"></a></div>';
	
		}

		//return wrapper plus servicesGroupItem
		$return = '<div class="pm-services-tab-system-container '. ($parallax === 'on' ? 'pm-parallax-panel' : '') .'" '. ($parallax === 'on' ? 'data-stellar-background-ratio="0.5"' : '') .' '.( $bg_image !== '' ? 'style="background-image:url('.$bg_image.');"' : '' ).'><div class="pm-services-tab-system"><ul class="pm-services-tab-system-list">'.implode( "\n", $buttons ).'</ul></div></div><div id="pm-services-tab-system-container-arrow"></div><div id="pm-services-tab-system-scrollto"></div>'.implode( "\n", $descriptions ).'';

	}

	return $return;

}

function servicesGroupItem( $atts, $content = null ){

	extract(shortcode_atts(array(
		'title' => 'Sample Title',
		'icon' => 'fa fa-wifi',
		'rollover_text' => 'Sample text',
	), $atts));

	$x = $GLOBALS['pm_services_group_item_count'];

	$GLOBALS['servicesGroupItems'][$x] = array( 
											'id' => $GLOBALS['pm_services_group_item_count'],
											'title' => sprintf( $title, $GLOBALS['pm_services_group_item_count'] ), 
											'icon' => sprintf( $icon, $GLOBALS['pm_services_group_item_count'] ), 
											'rollover_text' => sprintf( $rollover_text, $GLOBALS['pm_services_group_item_count'] ),
											'content' =>  do_shortcode($content) 
											);

	$GLOBALS['pm_services_group_item_count']++;

}


//SKILLS TABLE GROUP
function skillsTableGroup( $atts, $content = null ){
	
	$GLOBALS['pm_skills_table_item_count'] = 1;
	
	do_shortcode( $content );
	
	if( is_array( $GLOBALS['skillsTableItems'] ) ){
	
		foreach( $GLOBALS['skillsTableItems'] as $item ){
			
			$items[] = '<div class="pm-skills-logo" id="pm-skills-logo-'.$item['id'].'" data-stop="'.$item['percentage'].'" data-speed="'.$item['speed'].'"><i class="'.$item['icon'].'"></i></div><div class="pm-skills-logo-text" id="pm-skills-logo-text-'.$item['id'].'"><p class="pm-skills-logo-text-title">'.$item['title'].'</p><p class="pm-skills-logo-text-percentage" id="pm-skills-logo-text-percentage-'.$item['id'].'"><span class="milestone-value"></span></p><p class="pm-skills-logo-text-desc">'.$item['content'].'</p></div>';
			
			/*$items[] = '<div class="pm-skills-logo '.$item['icon'].'" id="pm-skills-logo-'.$GLOBALS['pm_skills_table_item_count'].'" data-stop="'.$item['percentage'].'" data-speed="'.$item['speed'].'"></div>
						<div class="pm-skills-logo-text" id="pm-skills-logo-text-1">
							<p class="pm-skills-logo-text-title">'.$item['title'].'</p>
							<p class="pm-skills-logo-text-percentage" id="pm-skills-logo-text-percentage-'.$GLOBALS['pm_skills_table_item_count'].'"><span class="milestone-value"></span></p>
							<p class="pm-skills-logo-text-desc">'.$item['content'].'</p>
						</div>';*/
	
		}

		//return wrapper plus skillsTableItems
		$return = '<div class="pm-skills-container"><div class="pm-skills-inner">'.implode( "\n", $items ).'</div></div>';

	}

	return $return;

}

function skillsTableItem( $atts, $content = null ){

	extract(shortcode_atts(array(

		'title' => 'Sample Title',
		'icon' => 'fa fa-wifi',
		'percentage' => 50,
		'speed' => 1500,
		

	), $atts));

	$x = $GLOBALS['pm_skills_table_item_count'];

	$GLOBALS['skillsTableItems'][$x] = array( 
											'id' => $GLOBALS['pm_skills_table_item_count'],
											'title' => sprintf( $title, $GLOBALS['pm_skills_table_item_count'] ), 
											'icon' => sprintf( $icon, $GLOBALS['pm_skills_table_item_count'] ), 
											'percentage' => sprintf( $percentage, $GLOBALS['pm_skills_table_item_count'] ), 
											'speed' => sprintf( $speed, $GLOBALS['pm_skills_table_item_count'] ), 
											'content' =>  do_shortcode($content) 
											);

	$GLOBALS['pm_skills_table_item_count']++;

}


//DATA TABLE GROUP
function dataTableGroup( $atts, $content = null ){
	
	extract(shortcode_atts(array(
		'id' => '1'
	), $atts));
	
	$GLOBALS['pm_date_table_item_id'] = (int) $id;
	$GLOBALS['pm_date_table_item_count'] = 0;
	
	do_shortcode( $content );
	
	if( is_array( $GLOBALS['dataTableItems'. $GLOBALS['pm_date_table_item_id']] ) ){
	
		foreach( $GLOBALS['dataTableItems'. $GLOBALS['pm_date_table_item_id']] as $tableItem ){
			
			$items[] = '<div class="row"><div class="col-lg-4 col-md-4 col-sm-12 pm-workshop-table-title"><p>'.$tableItem['title'].'</p></div><div class="col-lg-8 col-md-8 col-sm-12 pm-workshop-table-content"><p>'.$tableItem['content'].'</p></div></div>';
			
		}
		
		//return wrapper plus dataTableItems
		$return = '<div class="pm-workshop-table">'.implode( "\n", $items ).'</div>';
		
	}

	return $return;

}

function dataTableItem( $atts, $content = null ){

	extract(shortcode_atts(array(

		'title' => 'Sample Title'

	), $atts));

	$x = $GLOBALS['pm_date_table_item_count'];

	$GLOBALS['dataTableItems' . $GLOBALS['pm_date_table_item_id']][$x] = array( 'title' => sprintf( $title, $GLOBALS['pm_date_table_item_count'] ), 'content' =>  do_shortcode($content) );

	$GLOBALS['pm_date_table_item_count']++;

}

//PRICING TABLE INFO BOX
function pricingTableInfoBox($atts, $content = null) {
	
	extract(shortcode_atts(array(
		"title" => 'iOS 8 DESIGN',
		"sub_title" => 'Fundamentals',
		), 
	$atts));
	
	$html = '';
	$html .= '<li><a href="#" class="pm-pricing-table-details-expander fa fa-angle-down"></a>';
	
		$html .= '<div class="pm-pricing-table-details-container">';
		$html .= '<p class="title">'.$title.'</p>';
		$html .= '<p class="sub-title">'.$sub_title.'</p>';
		$html .= '<div class="pm-pricing-table-details-info">';
			$html .= $content;
		$html .= '</div>';
	$html .= '</div></li>';
	
	return $html;
	
}

//PRICING TABLE
function pricingTable($atts, $content = null) {

	extract(shortcode_atts(array(
		"title" => 'Basic Package',
		"featured_icon" => 'fa fa-thumbs-up',
		"featured" => 'no',
		"price" => '100',
		"payment_text" => 'Choose to pay monthly or annually at a discounted price of $149.99',
		"currency_symbol" => '$',
		"subscript" => '/ mo',
		"button_text" => 'Purchase Plan',
		"button_link" => '#',
		"button_message" => '* valid credit card required',
		"bg_image" => ''
		), 
	$atts));
	
	$html = '';
		
	if( $bg_image !== '' ) {
		
		$html .= '<div class="pm-pricing-table-container" style="background-image:url('.$bg_image.')">';
		
	} else {
		$html .= '<div class="pm-pricing-table-container">';
	}
                        
		$html .= '<div class="pm-pricing-table-title-container">';
			$html .= '<p>'.$title.'</p>';
			
			if($featured === 'yes') {
				$html .= '<div class="pm-pricing-table-featured-icon">';
					$html .= '<i class="'.$featured_icon.'"></i>';
				$html .= '</div>';
			}
			
		$html .= '</div>';
		
		$html .= '<div class="pm-pricing-table-pricing-container">';
			$html .= '<p class="price">'.$currency_symbol.''.$price.' <sub>'.$subscript.'</sub></p>';
			$html .= '<p class="desc">'.$payment_text.'</p>';
		$html .= '</div>';
		
		$html .= '<ul>'.do_shortcode($content, true).'</ul>';
		
		$html .= '<div class="pm-pricing-table-purchase-container">';
			$html .= '<a href="'.$button_link.'">'.$button_text.' <i class="fa fa-arrow-circle-o-right"></i></a>';
			$html .= '<p>'.$button_message.'</p>';
		$html .= '</div>';
	
	$html .= '</div>';
	
	return $html;
	
}

//QUOTE BOX
function quoteBox($atts, $content = null){
	
	extract(shortcode_atts(array(
		"author_name" => '',
		"author_title" => '',
		"avatar" => '',
		"text_color" => '#ffffff',
		"name_color" => '#4D4D4D'
		), 
	$atts));
	
	$html = '';
	
	$html .= '<div class="pm-single-testimonial-container">';
		$html .= '<div class="pm-single-testimonial-box">';
			$html .= '<p style="color:'.$text_color.';">'.$content.'</p>';
		$html .= '</div>';
		$html .= '<div class="pm-single-testimonial-author-container">';
			$html .= '<div class="pm-single-testimonial-author-avatar">';
				$html .= '<img src="'.$avatar.'" width="74" height="74" alt="avatar">';
			$html .= '</div>';
			$html .= '<div class="pm-single-testimonial-author-info">';
				$html .= '<p class="name" style="color:'.$name_color.';">'.$author_name.'</p>';
				$html .= '<p class="title" style="color:'.$name_color.';">'.$author_title.'</p>';
			$html .= '</div>';
		$html .= '</div>';
	$html .= '</div>';
	
	return $html;
		
}

//PIE CHART
function piechart($atts, $content = null){
	
	extract(shortcode_atts(array(
			"bar_size" => 220,
			"line_width" => 12,
			"track_color" => "#dbdbdb",
			"bar_color" => "#2B5C84", 
			"text_color" => "#ffffff",
			"percentage" => 75,
			"icon" => "typcn typcn-thumbs-up",
			"caption" => "Cost Reduction",
			"font_size" => 40
		), 
	$atts));
	
	$html = '';
	
	$html .= '<div data-barsize="'.$bar_size.'" data-linewidth="'.$line_width.'" data-trackcolor="'.$track_color.'" data-barcolor="'.$bar_color.'" data-percent="'.$percentage.'" class="pm-pie-chart">';
		$html .= '<div class="pm-pie-chart-percent" style="font-size:'.$font_size.'px; color:'.$text_color.'">';
			$html .= '<span style="color:'.$text_color.'"></span>%';
		$html .= '</div>';			
	$html .= '</div>';
	$html .= '<div class="pm-pie-chart-description" style="color:'.$text_color.'">';
		$html .= '<i class="'.$icon.'" style="color:'.$text_color.'"></i>';
		$html .= $caption;
	$html .= '</div>';
	
	return $html;
	
}

//MILESTONE
function milestone($atts, $content = null){
	
	extract(shortcode_atts(array(
			"speed" => "",
			"stop" => "",
			"caption" => "",
			"icon" => "",
			"icon_color" => '#fff',
			"bg_color" => '#333',
			"text_color" => '#333333',
			"text_size" => '24',
			"border_radius" => '99',
			"padding" => '10',
			"width" => "100",
			"height" => "100",
			"font_size" => 60,	
		), 
	$atts));
	
	$html = '';
	
	$html .= '<div class="milestone">';
		if($icon !== '') :
		$html .= '<i class="'.$icon.'" style="background-color:'.$bg_color.'; color:'.$icon_color.'; border-radius:'.$border_radius.'px; padding:'.$padding.'px; font-size:'.$font_size.'px; width:'.$width.'px; height:'.$height.'px;"></i>';
		endif;
		$html .= '<div class="milestone-content" style="font-size:'.$font_size.'px;"> ';                        
			$html .= '<span data-speed="'.(int)$speed.'" data-stop="'.(int)$stop.'" class="milestone-value" style="color:'.$text_color.'; font-size:'.$text_size.'px;"></span>';
			$html .= '<div class="milestone-description" style="font-size:'.$text_size.'px;">'.$caption.'</div>';
		$html .= '</div>';
	$html .= '</div>';
	
	return $html;
	
}


//SLIDER CONTAINER
function customSlider($atts, $content = null){
	
	extract(shortcode_atts(array(
			"id" => ''
			), 
	$atts));
	
	return '<div class="pm-slider-container">'.$content.'</div>';
}

//GOOGLE MAP
function googleMap($atts, $content = null) {
	
    extract(shortcode_atts(array(
		"id" => 'myMap', 
		"type" => 'road', 
		"latitude" => '43.656885', 
		"longitude" => '-79.383904', 
		"zoom" => '13', 
		"message" => 'This is the message...',
		"responsive" => 1, 
		"width" => '300', 
		"height" => '450'), 
	$atts));
     
    $mapType = '';
    if($type == "satellite")
        $mapType = "SATELLITE";
    else if($type == "terrain")
        $mapType = "TERRAIN"; 
    else if($type == "hybrid")
        $mapType = "HYBRID";
    else
        $mapType = "ROADMAP";     
     
	if($responsive == 1){
		return '<div id="'.$id.'" data-id="'.$id.'" data-latitude="'.$latitude.'" data-longitude="'.$longitude.'" data-mapType="'.$mapType.'" data-mapZoom="'.$zoom.'" data-message="'.$message.'" style="width:100%; height:'.$height.'px;" class="googleMap"></div>';
	} else {
		return '<div id="'.$id.'" data-id="'.$id.'" data-latitude="'.$latitude.'" data-longitude="'.$longitude.'" data-mapType="'.$mapType.'" data-mapZoom="'.$zoom.'" data-message="'.$message.'" style="width:'.$width.'px; height:'.$height.'px;" class="googleMap"></div>';
	}
        
} 


//BOOTSTRAP ALERT
function alert( $atts, $content = null ) {
	
	extract(shortcode_atts(array(  
        "close" => 'true',
		"type" => 'success',
		"icon" => 'typcn typcn-tick',
    ), $atts)); 
	
	$html = '';
	
	$html .= '<div class="alert alert-'.$type.' alert-dismissible" role="alert">';
	  if($close == 'true'){
		 $html .= '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
	  }
	  $html .= '<i class="'.$icon.'"></i>';
	  $html .= $content;
	$html .= '</div>';
	
	return $html;

}

//DIVIDER
function divider( $atts, $content = null ) {
	
	extract(shortcode_atts(array(  
		"icon" => 'fa fa-star',
		"margin_top" => 40,
		"margin_bottom" => 20,
    ), $atts)); 
	
	
	return '<div class="pm-divider" style="margin-top:'.$margin_top.'px; margin-bottom:'.$margin_bottom.'px;"><span class="pm-divider-left"></span><i class="'.$icon.' pm-divider-icon"></i><span class="pm-divider-right"></span></div>';
	
}


//STANDARD BUTTON
function standardButton($atts, $content = null) {  
    extract(shortcode_atts(array(  
		"link" => '#',
		"margin_top" => 0,
		"margin_bottom" => 0,
		"target" => '_self',
		"icon" => '',
		"text_color" => '#ffffff',
		"bg_color" => '#5CC9C1',
		"animated" => 'off',
		"class" => '',
    ), $atts));  
	
	$html = '';
	
	$html .= '<a class="pm-rounded-btn '.($class !== '' ? $class : '').' '. ( $animated == 'on' ? 'animated' : '' ) .'" href="'.$link.'" target="'.$target.'" style="margin-top:'.$margin_top.'px; background-color:'.$bg_color.'; color:'.$text_color.'; margin-bottom:'.$margin_bottom.'px;">'.$content.''. ($icon !== '' ? ' &nbsp;<i class="'.$icon.'"></i>' : '') .'</a>';
	
	return $html;
		 
}  


//PROGRESS BAR
function progressBar($atts) { 

	extract(shortcode_atts(array(  
        "percentage" => '50',
		"text" => '',
		"id" => 1
    ), $atts));
	
	$html = '';
	
	$html .= '<div class="skill" data-animated="200">';
		$html .= '<div class="name uppercase">'.$text.'</div>';
		$html .= '<div class="bar">';
			$html .= '<div class="value">';
				$html .= '<div class="count">'.$percentage.'</div>';
			$html .= '</div>';
		$html .= '</div>';
	$html .= '</div>';
	
	return $html;

}



//IMAGE PANEL
function imagePanel($atts, $content = null) {
			
	extract( shortcode_atts( array(
		'icon' => 'fa fa-link',
		'link' => '',
		'image' => '',
	), $atts ) );
	
	$html = '';
    
    $html .= '<div class="pm_image_panel">';
        
		$html .= '<div class="pm-hover-item-image-panel">';
		
			$html .= '<div class="pm-hover-item-icon"><a class="'.$icon.'" href="'.$link.'"></a></div>';
		
			$html .= '<div class="pm-image-panel-hover"></div>';
		
			$html .= '<div class="pm-hover-item-image-panel-img"><img src="'.$image.'" /></div>';
			
		$html .= '</div>';   
    
    $html .= '</div>';
    
	return $html;
	
}


//ICON  
function iconElement($atts, $content = null) {
	extract(shortcode_atts(array( 
		"button_mode" => 'off',
		"link" => '',
        "icon" => 'fa fa-twitter',
		"icon_color" => '#164D61',
		"icon_size" => '30',
		"width" => '50',
		"height" => '50',
		"padding" => '14',
		"border_color" => '#164D61',
		"margin_top" => 20,
		"margin_bottom" => 20
    ), $atts));
		
	if( $button_mode === 'on' ){
		return '<a href="'.$link.'" class="'.$icon.' pm-icon-btn btn-mode" style="color:'.$icon_color.'; margin-top:'.$margin_top.'px; margin-bottom:'.$margin_bottom.'px; font-size:'.$icon_size.'px !important; width:'.$width.'px; height:'.$height.'px; padding:'.$padding.'px; border:3px solid '.$border_color.';"></a>';
	} else {
		return '<i class="'.$icon.' pm-icon-btn" style="color:'.$icon_color.'; margin-top:'.$margin_top.'px; margin-bottom:'.$margin_bottom.'px; font-size:'.$icon_size.'px !important; width:'.$width.'px; height:'.$height.'px; padding:'.$padding.'px; border:3px solid'.$border_color.';"></i>';	
	}
		
	
	
} 

// YOUTUBE SHORTCODE
function youtubeVideo($atts) {  
    extract(shortcode_atts(array(  
        "id" => '',
		"width" => 300,
		"height" => 250,
		"responsive" => 0,
    ), $atts));  
	
	if($responsive == 1){
		$finalWidth = 100 .'%';
	} else {
		$finalWidth = $width;	
	}
	
    return '<iframe src="http://www.youtube.com/embed/'.$id.'" width="'.$finalWidth.'" height="'.$height.'"></iframe>';  
}  


// VIMEO SHORTCODE
function vimeoVideo($atts) {  
    extract(shortcode_atts(array(  
        "id" => '',
		"width" => 300,
		"height" => 250,
		"responsive" => 0,
    ), $atts));  
	
	if($responsive == 1){
		$finalWidth = 100 .'%';
	} else {
		$finalWidth = $width;	
	}
	
    return '<iframe src="//player.vimeo.com/video/'.$id.'?title=0&amp;byline=0&amp;color=ffffff" width="'.$finalWidth.'" height="'.$height.'"></iframe>';  
}



//HTML5 VIDEO
function html5Video($atts, $content = null) {
	extract(shortcode_atts(array(  
        "webm" => '',
		"mp4" => '',
		"ogg" => '',
		'width' => '400',
		'height' => '400',
		"responsive" => 0,
    ), $atts)); 
	
	return '<div class="pm-video-container"><video id="pm-video-background" style="width:100%;" autoplay loop muted="muted" preload="auto"><source src="'.$mp4.'" type="video/mp4"><source src="'.$webm.'" type="video/webm"><source src="'.$ogg.'" type="video/ogg">HTML5 Video Mime Type not found.</video></div>';
	
}


//TIME TABLE
function timeTableGroup( $atts, $content ){
	
	extract(shortcode_atts(array(
		'id' => '1'
	), $atts));
	
	$GLOBALS['pm_timetable_container_id'] = (int) $id;
	$GLOBALS['pm_timetable_accordion_count'] = 0;
	
	do_shortcode( $content );
	
	if( is_array( $GLOBALS['pm-timetable-container-' . $GLOBALS['pm_timetable_container_id']] ) ){
	
		foreach( $GLOBALS['pm-timetable-container-' . $GLOBALS['pm_timetable_container_id']] as $item ){
	
			//Expanded code
			/*$panels[] = '
			<div class="pm-timetable-accordion-panel" id="pm-timetable-accordion-'.$GLOBALS['pm_timetable_container_id'].'-'.$item['accordion_count'].'" style="background-color:'.$item['bg_color'].';">
			   <div class="pm-timetable-panel-heading">
				  <h3 class="pm-timetable-panel-title">
					<a data-panel="pm-timetable-accordion-'.$GLOBALS['pm_timetable_container_id'].'-'.$item['accordion_count'].'" data-collapse="pm-timetable-container-'.$GLOBALS['pm_timetable_container_id'].'" class="pm-accordion-horizontal" href="#"><i class="'.$item['icon'].'"></i>'.$item['title'].'</a>
				  </h3>
					<a data-panel="pm-timetable-accordion-'.$GLOBALS['pm_timetable_container_id'].'-'.$item['accordion_count'].'" data-collapse="pm-timetable-container-'.$GLOBALS['pm_timetable_container_id'].'" class="pm-accordion-horizontal pm-accordion-horizontal-open read-more" href="#">Open<i class="fa fa-caret-down"></i></a>
			   </div>
			   <div class="pm-timetable-panel-content">
				   <div class="pm-timetable-panel-content-body">'.$item['content'].'</div>
			   </div>
		    </div>
			';*/
			
			//Minified code
			$panels[] = '<div class="pm-timetable-accordion-panel" id="pm-timetable-accordion-'.$GLOBALS['pm_timetable_container_id'].'-'.$item['accordion_count'].'" style="background-color:'.$item['bg_color'].';"><div class="pm-timetable-panel-heading"><h3 class="pm-timetable-panel-title"><a data-panel="pm-timetable-accordion-'.$GLOBALS['pm_timetable_container_id'].'-'.$item['accordion_count'].'" data-collapse="pm-timetable-container-'.$GLOBALS['pm_timetable_container_id'].'" class="pm-accordion-horizontal" href="#"><i class="'.$item['icon'].'"></i>'.$item['title'].'</a></h3><a data-panel="pm-timetable-accordion-'.$GLOBALS['pm_timetable_container_id'].'-'.$item['accordion_count'].'" data-collapse="pm-timetable-container-'.$GLOBALS['pm_timetable_container_id'].'" class="pm-accordion-horizontal pm-accordion-horizontal-open read-more" href="#">Open<i class="fa fa-caret-down"></i></a></div><div class="pm-timetable-panel-content"><div class="pm-timetable-panel-content-body">'.$item['content'].'</div></div></div>';
	
		}

		//return wrapper plus timeTableItems
		$return = '<div class="pm-timetable-container" id="pm-timetable-container-'.$GLOBALS['pm_timetable_container_id'].'">'.implode( "\n", $panels ).'</div>';

	}

	return $return;

}

function timeTableItem( $atts, $content ){

	extract(shortcode_atts(array(

		'title' => 'Sample Title',
		'icon' => 'fa fa-clock-o',
		'bg_color' => '#3dc5d0'

	), $atts));

	//fetch accordion count
	$x = $GLOBALS['pm_timetable_accordion_count'];

	//create accordions array
	$GLOBALS['pm-timetable-container-' . $GLOBALS['pm_timetable_container_id']][$x] = array( 
															'accordion_count' => $GLOBALS['pm_timetable_accordion_count'],
															'title' => sprintf( $title, $GLOBALS['pm_timetable_accordion_count'] ), 
															'icon' => $icon,
															'bg_color' => $bg_color,
															'content' =>  do_shortcode($content)
															);

	//increment accordion count
	$GLOBALS['pm_timetable_accordion_count']++;

}


//TABS
function tabGroup( $atts, $content ){
	
	extract(shortcode_atts(array(
		'id' => '1'
	), $atts));
	
	$GLOBALS['moxie_theme_tab_id'] = (int) $id;
	$GLOBALS['moxie_theme_tab_count'] = 0;
	
	do_shortcode( $content );
	
	if( is_array( $GLOBALS['tabs'. $GLOBALS['moxie_theme_tab_id']] ) ){
	
		foreach( $GLOBALS['tabs'. $GLOBALS['moxie_theme_tab_id']] as $tab ){
	
			$tabs[] = '<li><a data-toggle="tab" href="#'.$GLOBALS['moxie_theme_tab_id'].''.str_replace( ' ', '', $tab['title'] ).'">'.$tab['title'].'</a></li>';
		
			$panes[] = '<div class="tab-pane" id="'.$GLOBALS['moxie_theme_tab_id'].''.str_replace( ' ', '', $tab['title'] ).'">'.$tab['content'].'</div>';
	
		}

		$return = "\n".'<ul class="nav nav-tabs pm-nav-tabs">'.implode( "\n", $tabs ).'</ul>'."\n".'<div class="tab-content pm-tab-content shortcode">'.implode( "\n", $panes ).'</div>'."\n";

	}

	return $return;

}

function tabItem( $atts, $content ){

	extract(shortcode_atts(array(

		'title' => 'Tab %d'

	), $atts));

	$x = $GLOBALS['moxie_theme_tab_count'];

	$GLOBALS['tabs' . $GLOBALS['moxie_theme_tab_id']][$x] = array( 'title' => sprintf( $title, $GLOBALS['moxie_theme_tab_count'] ), 'content' =>  do_shortcode($content) );

	$GLOBALS['moxie_theme_tab_count']++;

}

//ACCORDION
function accordionGroup($atts, $content = null) { 

	extract(shortcode_atts(array(
		'id' => '1'
	), $atts));

	$GLOBALS['moxie_theme_accordion_id'] = (int) $id;
	$GLOBALS['moxie_theme_accordion_count'] = 0;
	
    return '<div class="panel-group" id="accordion'.$GLOBALS['moxie_theme_accordion_id'].'" role="tablist" aria-multiselectable="true">'.do_shortcode($content).'</div>';
	
}  

function accordionItem($atts, $content = null) { 

	extract(shortcode_atts(array(  
		"title" => 'Accordion Item 1',
		"button_color" => '#E0E0E0',
		"button_text_color" => '#5b5b5b',
    ), $atts)); 
	
	$html = '';
	  
	 $html .= '<div class="panel panel-default">';
		$html .= '<div class="panel-heading" role="tab" id="heading'.$GLOBALS['moxie_theme_accordion_count'].'">';
		
			$html .= '<h4 class="panel-title"><i class="fa fa-plus"></i><a class="pm-accordion-link" href="#'.$GLOBALS['moxie_theme_accordion_id'].'collapse'.$GLOBALS['moxie_theme_accordion_count'].'" data-parent="#accordion'.$GLOBALS['moxie_theme_accordion_id'].'" data-toggle="collapse" style="background-color:'.$button_color.'; color:'.$button_text_color.';" aria-expanded="true">'.$title.'</a></h4>';
			
		$html .= '</div>';
		$html .= '<div id="'.$GLOBALS['moxie_theme_accordion_id'].'collapse'.$GLOBALS['moxie_theme_accordion_count'].'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'.$GLOBALS['moxie_theme_accordion_count'].'">';
			$html .= '<div class="panel-body">';
				$html .= ''.do_shortcode($content).'';
			$html .= '</div>';
		$html .= '</div>';
	 $html .= '</div>';
	
	$GLOBALS['moxie_theme_accordion_count']++;
	
    return $html;
	
} 

function sliderCarousel($atts, $content = null) { 

	extract(shortcode_atts(array(  
		"animation" => 'slide',
    ), $atts)); 

	if(!isset($GLOBALS['moxie_theme_flexslider_count'])){
		$GLOBALS['moxie_theme_flexslider_count'] = 0;
	}
	
	$html = '';
	
	$html .= '<div class="flexslider pm-carousel-slider" id="pm-flexslider-carousel-'.$GLOBALS['moxie_theme_flexslider_count'].'" style="width:100%;"><ul class="slides">'.do_shortcode($content).'</ul></div>';
	
	$html .= '<script>(function($) {$(document).ready(function(e) {$("#pm-flexslider-carousel-'.$GLOBALS['moxie_theme_flexslider_count'].'").flexslider({animation:"'.$animation.'", controlNav: false, directionNav: true, animationLoop: true, slideshow: false, arrows: true, touch: false, prevText : "", nextText : "" }); }); })(jQuery); </script>';
	
	//increment for next possible carousel slider
	$GLOBALS['moxie_theme_flexslider_count']++;
	
    return $html;
	
}  

function sliderItem($atts, $content = null) {

	extract(shortcode_atts(array(  
		"img" => '',
		"title" => ''
    ), $atts)); 
	
	$html = '<li><img src="' . $img . '" alt="' . $title . '" /></li>';
		
    return $html;
	
}    

//CLIENTS CAROUSEL
function clientCarousel($atts, $content = null) { 

	extract(shortcode_atts(array(  
		"target" => '_blank',
    ), $atts)); 
	
	$html = '<div id="pm-brands-carousel" class="owl-carousel owl-theme">';
	
	//Redux options
	global $moxie_options;
	
	if($moxie_options){
		
		$clients = $moxie_options['opt-client-slides'];
		
		if(count($clients) > 0){
			
			foreach($clients as $c) {
				
				$html .= '<div class="pm-brand-item">';
					$html .= '<span></span>';
					$html .= '<a href="http://'.$c['url'].'" target="'.$target.'">'.$c['url'].'</a>';
					$html .= '<img src="'.$c['image'].'" class="img-responsive" alt="'.$c['title'].'">';
				$html .= '</div>';				
				
			}//end of foreach
			
		}//end of if
		
	}//end of if
			
	$html .= '</div>';
	
	$html .= '<div class="pm-brand-carousel-btns" id="pm-brand-carousel-btns">';
		$html .= '<a class="btn pm-owl-prev fa fa-chevron-left"></a>';
		$html .= '<a class="btn pm-owl-play fa fa-play" id="pm-owl-play"></a>';
		$html .= '<a class="btn pm-owl-next fa fa-chevron-right"></a>';
	$html .= '</div>';
	
    return $html;
	
}  




//PANELS CAROUSEL
function panelsCarousel($atts, $content = null) { 

	extract(shortcode_atts(array(  
		"target" => '_self',
    ), $atts)); 
	
	$html = '<ul class="pm-interactive-panels-carousel" id="pm-interactive-panels-owl">';
	
	//Redux options
	global $moxie_options;
	
	$panels = '';
				
	if( isset($moxie_options['opt-panel-slides']) && !empty($moxie_options['opt-panel-slides']) ){
		$panels = $moxie_options['opt-panel-slides'];
	}
	
	if(is_array($panels)){
			
		foreach($panels as $p) {
			
			$dashCount = substr_count($p['url'], ' - ');
			
			$icon = '';
			$url = '';
			
			if($dashCount > 0) {
			
				$pieces = explode(" - ", $p['url']);
			
				$icon = $pieces[0];
				$url = $pieces[1];
				
			} else {
				
				$icon = $p['url'];
					
			}
						
			$html .= '<li>';
				$html .= '<div class="pm-icon-bundle">';
					$html .= '<i class="'.$icon.'"></i>';
					$html .= '<div class="pm-icon-bundle-content">';
						$html .= '<p><a '. ($url !== '' ? 'href="'.$url.'" target="'.$target.'"' : '') .'>'.$p['title'].' '. ($url !== '' ? '<i class="fa fa-angle-right"></i>' : '') .'</a></p>';
					$html .= '</div>';
					$html .= '<div class="pm-icon-bundle-info">';
						$html .= '<p>'.$p['description'].'</p>';
					$html .= '</div>';
				 $html .= '</div>';
			$html .= '</li>';
			
		}//end of foreach
		
	}//end of if
			
	$html .= '</ul>';
	
    return $html;
	
}  


//PANEL HEADER
function panelHeader($atts, $content = null) {
	extract(shortcode_atts(array(  
		"panel_style" => 1,
		"link" => '',
		"target" => '_self',
		"color" => '#00BC9D',
		"show_button" => 'true',
		"button_text" => '',
		"margin_bottom" => 10,
		"icon" => 'fa-link',
		"tip" => '',
		"bg_color" => '#F3F3F3',
    ), $atts));
		
	if($panel_style == 1){
		
		//panel header style 1
		if($show_button == 'true'){
			return '<div class="pm_span_header" style="margin-bottom:'.$margin_bottom.'px;"><h4 style="color:'.$color.';">'.$content.'</h4><div class="pm_span_header_btn"><a class="pm-custom-button pm-btn-animated pm-btn-small pm-post-btn p_header" href="'.$link.'" target="'.$target.'"><span>'.$button_text.' <i class="fa '.$icon.'"></i></span></a></div></div>';
		} else {
			return '<div class="pm_span_header" style="margin-bottom:'.$margin_bottom.'px;"><h4 style="color:'.$color.';">'.$content.'</h4></div>';
		}
		
	} elseif($panel_style == 2){
		
		//panel header style2
		if($show_button == 'true'){
			return '<div style="margin-bottom:'.$margin_bottom.'px !important; overflow:hidden;" class="pm_span_header_style2"><h4 style="background-color:'.$bg_color.';"><span>'.$content.'</span><a target="_self" '.($tip !== '' ? 'title="'.$tip.'"' : '').'  '. ($tip !== '' ? 'class="pm_tip"' : '') .' href="'.$link.'"><i class="fa '.$icon.'"></i></a></h4></div>';
		} else {
			return '<div style="margin-bottom:'.$margin_bottom.'px !important; overflow:hidden;" class="pm_span_header_style2"><h4 style="background-color:'.$bg_color.';"><span>'.$content.'</span></h4></div>';
		}
		
	} elseif($panel_style == 3){
		
		//panel header style3
		if($show_button == 'true'){
			return '<div class="pm_span_header_style3_divider"></div><div style="margin-bottom:'.$margin_bottom.'px !important; overflow:hidden;" class="pm_span_header_style3"><h4 style="background-color:'.$bg_color.';"><span>'.$content.'</span><a target="_self" '.($tip !== '' ? 'title="'.$tip.'"' : '').'  '. ($tip !== '' ? 'class="pm_tip"' : '') .' href="'.$link.'"><i class="fa '.$icon.'"></i></a></h4></div>';
		} else {
			return '<div class="pm_span_header_style3_divider"></div><div style="margin-bottom:'.$margin_bottom.'px !important; overflow:hidden;" class="pm_span_header_style3"><h4 style="background-color:'.$bg_color.';"><span>'.$content.'</span></h4></div>';
		}
		
	} else {
		return "";	
	}
	
     
}

//COLUMN HEADER
function columnHeader($atts, $content = null) {
	extract(shortcode_atts(array(  
		"color" => 'grey',
		"margin_bottom" => 0
    ), $atts));
	
	return '<div class="pm-column-header" style="margin-bottom:'.$margin_bottom.'px;"><h2 style="border-bottom:1px solid '.$color.';">'.$content.'</h2><div class="pm-column-header-block" style="background-color:'.$color.';"></div></div>';
     
}



//CONTACT FORM
function contactForm($atts) {

	extract(shortcode_atts(array(  
		"recipient_email" => '',
		"text_color" => '#ccc',
    ), $atts)); 
	
	
	$html = '';
	
		$html .= '<div class="pm-contact-form-container">';
	
			$html .= '<form action="#" method="post" id="pm-contact-form">';
			
				$html .= '<div class="col-lg-6 col-md-6 col-sm-12 pm-contact-form-column">';
					$html .= '<input name="pm_s_first_name" id="pm_s_first_name" class="pm_text_field" type="text" placeholder="'.__('First Name *', 'moxieShortcodePack').'">';
				$html .= '</div>';
				$html .= '<div class="col-lg-6 col-md-6 col-sm-12 pm-contact-form-column">';
					$html .= '<input name="pm_s_last_name" id="pm_s_last_name" class="pm_text_field" type="text" placeholder="'.__('Last Name *', 'moxieShortcodePack').'">';
				$html .= '</div>';
				$html .= '<div class="col-lg-6 col-md-6 col-sm-12 pm-contact-form-column">';
					$html .= '<input name="pm_s_email_address" id="pm_s_email_address" class="pm_text_field" type="text" placeholder="'.__('Email Address *', 'moxieShortcodePack').'">';
				$html .= '</div>';
				$html .= '<div class="col-lg-6 col-md-6 col-sm-12 pm-contact-form-column">';
					$html .= '<input name="pm_s_phone_number" id="pm_s_phone_number" class="pm_text_field" type="tel" placeholder="'.__('Phone Number', 'moxieShortcodePack').'">';
				$html .= '</div>';
				$html .= '<div class="col-lg-12 pm-clear-element">';
					$html .= '<textarea name="pm_s_message" id="pm_s_message" class="pm_textarea" cols="50" rows="10" placeholder="'.__('Message *', 'moxieShortcodePack').'"></textarea>';
				$html .= '</div>';
								
				$html .= '<div class="col-lg-12 pm-center">';
					$html .= '<a class="pm-contact-form-submit" id="pm-contact-form-btn" href="#">'.__('Submit', 'moxieShortcodePack').'</a>';
					$html .= '<div id="pm-contact-form-response"></div>	';
					$html .= '<p class="pm-contact-form-message" style="color:'.$text_color.';">'.__('Fields marked with * are required', 'moxieShortcodePack').'</p>';
				$html .= '</div>';
				$html .= '<input type="hidden" name="pm_s_email_address_contact" id="pm_s_email_address_contact" value="'.esc_attr($recipient_email).'" />';
				
				 wp_nonce_field('moxie_theme_nonce_action','moxie_theme_send_contact_nonce'); 
				
			$html .= '</form>';
			
		$html .= '</div>';
					
	return $html;
	
}


/******** BOOTSTRAP 3 COLUMNS ***********/

//COLUMN CONTAINER
function bootstrapContainer($atts, $content = null) { 

	extract(shortcode_atts(array(  
		"fullscreen" => 'off',
		"fullscreen_container" => 'off',
		"bg_color" => 'transparent',
		"bg_image" => '',
		"bg_position" => 'static',
		"bg_repeat" => 'repeat-x',
		"alignment" => 'left',
		"padding_top" => 20,
		"padding_bottom" => 20,
		"parallax" => 'on',
		"overlay" => '',
		"class" => '',
		"id" => ''
    ), $atts)); 
	
	if($fullscreen == 'on'){
		
		return '<div'. ($id !== '' ? ' id="'.$id.'"' : '') .' class="pm-column-container fullscreen '.$class.'" '. ($parallax === 'on' ? ' data-parallax="'.$bg_image.'"' : '') .' style="'. ($bg_image !== '' ? 'background-image:url('.$bg_image.');' : '') .' background-repeat:'.$bg_repeat.'; background-attachment:'.$bg_position.' !important; background-color:'.$bg_color.'; text-align:'.$alignment.'; padding-top:'.$padding_top.'px; padding-bottom:'.$padding_bottom.'px;"> '. ( $overlay !== '' ? '<div class="overlay overlay-'.$overlay.'"></div>' : '' ) .' '. ($fullscreen_container !== 'off' ? '<div class="container">' : '') .' '.do_shortcode($content).''. ($fullscreen_container !== 'off' ? '</div>' : '') .'</div>';
		
	} else {
		
		return '<div'. ($id !== '' ? ' id="'.$id.'"' : '') .' class="pm-column-container '.$class.'" '. ($parallax === 'on' ? ' data-parallax="'.$bg_image.'"' : '') .' style="'. ($bg_image !== '' ? 'background-image:url('.$bg_image.');' : '') .' background-repeat:'.$bg_repeat.'; background-attachment:'.$bg_position.' !important; background-color:'.$bg_color.'; text-align:'.$alignment.'; padding-top:'.$padding_top.'px; padding-bottom:'.$padding_bottom.'px;"> '. ( $overlay !== '' ? '<div class="overlay overlay-'.$overlay.'"></div>' : '' ) .' <div class="container">'.do_shortcode($content).'</div></div>';
		
	}
    
}  

//COLUMN CONTAINER
function bootstrapRow($atts, $content = null) {	

	extract(shortcode_atts(array(  
		"class" => ''
    ), $atts)); 

	if($class !== ''){
		return '<div class="row '.$class.'">'.do_shortcode($content).'</div>';
	} else {
		return '<div class="row '.$class.'">'.do_shortcode($content).'</div>';
	}

	
}

//NESTED ROW
function nestedRow($atts, $content = null) {	

	extract(shortcode_atts(array(  
		"class" => ''
    ), $atts)); 

	if($class !== ''){
		return '<div class="row '.$class.'">'.do_shortcode($content).'</div>';
	} else {
		return '<div class="row '.$class.'">'.do_shortcode($content).'</div>';
	}

	
}

//COLUMN
function bootstrapColumn($atts, $content = null) {
	
	extract(shortcode_atts(array(  
        "col_large" => 12,
		"col_medium" => 12,
		"col_small" => 12,
		"col_extrasmall" => 12,
		"class" => 'wow fadeInUp',
		'animation_delay' => 0.3
    ), $atts)); 

	return '<div class="col-lg-'.$col_large.' col-md-'.$col_medium.' col-sm-'.$col_small.' col-xs-'.$col_extrasmall.' '.$class.'" data-wow-delay="'.$animation_delay.'s" data-wow-offset="50" data-wow-duration="1s">'.do_shortcode($content).'</div>';	
}

//NESTED COLUMN
function nestedColumn($atts, $content = null) {
	
	extract(shortcode_atts(array(  
        "col_large" => 12,
		"col_medium" => 12,
		"col_small" => 12,
		"col_extrasmall" => 12,
		"class" => ''
    ), $atts)); 

	return '<div class="col-lg-'.$col_large.' col-md-'.$col_medium.' col-sm-'.$col_small.' col-xs-'.$col_extrasmall.' '.$class.'">'.do_shortcode($content).'</div>';	
}

/******** BOOTSTRAP 3 COLUMNS END ***********/


//ACTIVE
function register_staffCarousel($buttons) { //Registers the TinyMCE button 
   array_push($buttons, "staffCarousel");  
   return $buttons;  
} 
function add_plugin_staffCarousel($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['staffCarousel'] = plugins_url( '/js/tinymce-btns.js', __FILE__ ) ;    
   return $plugin_array;  
} 

function register_dataTableGroup($buttons) { //Registers the TinyMCE button 
   array_push($buttons, "dataTableGroup");  
   return $buttons;  
} 
function add_plugin_dataTableGroup($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['dataTableGroup'] = plugins_url( '/js/tinymce-btns.js', __FILE__ ) ;    
   return $plugin_array;  
} 

function register_skillsTableGroup($buttons) { //Registers the TinyMCE button 
   array_push($buttons, "skillsTableGroup");  
   return $buttons;  
} 

function add_plugin_skillsTableGroup($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['skillsTableGroup'] = plugins_url( '/js/tinymce-btns.js', __FILE__ ) ;    
   return $plugin_array;  
} 

function register_servicesGroup($buttons) { //Registers the TinyMCE button 
   array_push($buttons, "servicesGroup");  
   return $buttons; 
} 

function add_plugin_servicesGroup($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['servicesGroup'] = plugins_url( '/js/tinymce-btns.js', __FILE__ ) ;    
   return $plugin_array;  
} 

function register_standardButton($buttons) { //Registers the TinyMCE button 
   array_push($buttons, "standardButton");  
   return $buttons;  
} 
function add_plugin_standardButton($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['standardButton'] = plugins_url( '/js/tinymce-btns.js', __FILE__ ) ;    
   return $plugin_array;  
}  

function register_progressBar($buttons) { //Registers the TinyMCE button
   array_push($buttons, "progressBar");  
   return $buttons;  
}
function add_plugin_progressBar($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['progressBar'] = plugins_url( '/js/tinymce-btns.js', __FILE__ ) ;    
   return $plugin_array;  
}

function register_bootstrapContainer($buttons) { //Registers the TinyMCE button
   array_push($buttons, "bootstrapContainer");  
   return $buttons;  
}
function add_plugin_bootstrapContainer($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['bootstrapContainer'] = plugins_url( '/js/tinymce-btns.js', __FILE__ ) ;    
   return $plugin_array;  
}

function register_bootstrapRow($buttons) { //Registers the TinyMCE button
   array_push($buttons, "bootstrapRow");  
   return $buttons;  
}
function add_plugin_bootstrapRow($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['bootstrapRow'] = plugins_url( '/js/tinymce-btns.js', __FILE__ ) ;    
   return $plugin_array;  
}

function register_bootstrapColumn($buttons) { //Registers the TinyMCE button
   array_push($buttons, "bootstrapColumn");  
   return $buttons;  
}
function add_plugin_bootstrapColumn($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['bootstrapColumn'] = plugins_url( '/js/tinymce-btns.js', __FILE__ ) ;    
   return $plugin_array;  
}

function register_youtubeVideo($buttons) { //Registers the TinyMCE button
   array_push($buttons, "youtubeVideo");  
   return $buttons;  
}
function add_plugin_youtubeVideo($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['youtubeVideo'] = plugins_url( '/js/tinymce-btns.js', __FILE__ ) ;    
   return $plugin_array;  
}

function register_vimeoVideo($buttons) { //Registers the TinyMCE button
   array_push($buttons, "vimeoVideo");  
   return $buttons;  
}
function add_plugin_vimeoVideo($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['vimeoVideo'] = plugins_url( '/js/tinymce-btns.js', __FILE__ ) ;    
   return $plugin_array;  
}

function register_html5Video($buttons) { //Registers the TinyMCE button
   array_push($buttons, "html5Video");  
   return $buttons;  
}
function add_plugin_html5Video($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['html5Video'] = plugins_url( '/js/tinymce-btns.js', __FILE__ ) ;    
   return $plugin_array;  
}

function register_tabGroup($buttons) { //Registers the TinyMCE button
   array_push($buttons, "tabGroup");  
   return $buttons;  
}
function add_plugin_tabGroup($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['tabGroup'] = plugins_url( '/js/tinymce-btns.js', __FILE__ ) ;    
   return $plugin_array;  
}

function register_timeTableGroup($buttons) { //Registers the TinyMCE button
   array_push($buttons, "timeTableGroup");  
   return $buttons;  
}
function add_plugin_timeTableGroup($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['timeTableGroup'] = plugins_url( '/js/tinymce-btns.js', __FILE__ ) ;    
   return $plugin_array;  
}

function register_accordionGroup($buttons) { //Registers the TinyMCE button
   array_push($buttons, "accordionGroup");  
   return $buttons;  
}
function add_plugin_accordionGroup($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['accordionGroup'] = plugins_url( '/js/tinymce-btns.js', __FILE__ ) ;    
   return $plugin_array;  
}

function register_contactForm($buttons) { //Registers the TinyMCE button
   array_push($buttons, "contactForm");  
   return $buttons;  
}
function add_plugin_contactForm($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['contactForm'] = plugins_url( '/js/tinymce-btns.js', __FILE__ ) ;    
   return $plugin_array;  
}

function register_googleMap($buttons) { //Registers the TinyMCE button
   array_push($buttons, "googleMap");  
   return $buttons;  
}
function add_plugin_googleMap($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['googleMap'] = plugins_url( '/js/tinymce-btns.js', __FILE__ ) ;    
   return $plugin_array;  
}

function register_alert($buttons) { //Registers the TinyMCE button
   array_push($buttons, "alert");  
   return $buttons;  
}
function add_plugin_alert($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['alert'] = plugins_url( '/js/tinymce-btns.js', __FILE__ ) ;    
   return $plugin_array;  
}

function register_divider($buttons) {  
   array_push($buttons, "divider");  
   return $buttons;  
}
function add_plugin_divider($plugin_array) {  
   $plugin_array['divider'] = plugins_url( '/js/tinymce-btns.js', __FILE__ ) ;    
   return $plugin_array;  
}

function register_iconElement($buttons) {  
   array_push($buttons, "iconElement");  
   return $buttons;  
}
function add_plugin_iconElement($plugin_array) {  
   $plugin_array['iconElement'] = plugins_url( '/js/tinymce-btns.js', __FILE__ ) ;    
   return $plugin_array;  
}

function register_sliderCarousel($buttons) {  
   array_push($buttons, "sliderCarousel");  
   return $buttons;  
}
function add_plugin_sliderCarousel($plugin_array) {  
   $plugin_array['sliderCarousel'] = plugins_url( '/js/tinymce-btns.js', __FILE__ ) ;    
   return $plugin_array;  
}

function register_clientCarousel($buttons) {  
   array_push($buttons, "clientCarousel");  
   return $buttons;  
}
function add_plugin_clientCarousel($plugin_array) {  
   $plugin_array['clientCarousel'] = plugins_url( '/js/tinymce-btns.js', __FILE__ ) ;    
   return $plugin_array;  
}

function register_panelsCarousel($buttons) {  
   array_push($buttons, "panelsCarousel");  
   return $buttons;  
}

function add_plugin_panelsCarousel($plugin_array) {  
   $plugin_array['panelsCarousel'] = plugins_url( '/js/tinymce-btns.js', __FILE__ ) ;    
   return $plugin_array;  
}

function register_piechart($buttons) {  
   array_push($buttons, "piechart");  
   return $buttons;  
}
function add_plugin_piechart($plugin_array) {  
   $plugin_array['piechart'] = plugins_url( '/js/tinymce-btns.js', __FILE__ ) ;    
   return $plugin_array;  
}

function register_milestone($buttons) {  
   array_push($buttons, "milestone");  
   return $buttons;  
}
function add_plugin_milestone($plugin_array) {  
   $plugin_array['milestone'] = plugins_url( '/js/tinymce-btns.js', __FILE__ ) ;    
   return $plugin_array; 
}

function register_quoteBox($buttons) {  
   array_push($buttons, "quoteBox");  
   return $buttons;  
}
function add_plugin_quoteBox($plugin_array) {  
   $plugin_array['quoteBox'] = plugins_url( '/js/tinymce-btns.js', __FILE__ ) ;    
   return $plugin_array;  
}

function register_pricingTable($buttons) {  
   array_push($buttons, "pricingTable");  
   return $buttons;  
}
function add_plugin_pricingTable($plugin_array) {  
   $plugin_array['pricingTable'] = plugins_url( '/js/tinymce-btns.js', __FILE__ ) ;    
   return $plugin_array;  
}


function register_postItems($buttons) { //Registers the TinyMCE button
   array_push($buttons, "postItems");  
   return $buttons;  
}
function add_plugin_postItems($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['postItems'] = plugins_url( '/js/tinymce-btns.js', __FILE__ ) ;    
   return $plugin_array; 
}


function register_bioCarousel($buttons) { //Registers the TinyMCE button
   array_push($buttons, "bioCarousel");  
   return $buttons;  
}
function add_plugin_bioCarousel($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['bioCarousel'] = plugins_url( '/js/tinymce-btns.js', __FILE__ ) ;    
   return $plugin_array; 
}



function register_galleryItems($buttons) { //Registers the TinyMCE button
   array_push($buttons, "galleryItems");  
   return $buttons;  
}
function add_plugin_galleryItems($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['galleryItems'] = plugins_url( '/js/tinymce-btns.js', __FILE__ ) ;    
   return $plugin_array; 
}



?>