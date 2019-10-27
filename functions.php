<?php

/* Add filters, actions, and theme-supported features after theme is loaded */
add_action( 'after_setup_theme', 'moxie_theme_theme_setup' );

function moxie_theme_theme_setup() {
		
	//Define content width
	if ( !isset( $content_width ) ) $content_width = 1170;
	
	/***** LOAD REDUX FRAMEWORK ******/	
	if ( !class_exists( 'ReduxFramework' ) && file_exists( get_template_directory() . '/ReduxFramework/ReduxCore/framework.php' ) ) {
		require_once( get_template_directory() . '/ReduxFramework/ReduxCore/framework.php' );
	}
	if ( !isset( $redux_demo ) && file_exists( get_template_directory() . '/ReduxFramework/moxie/moxie-config.php' ) ) {
		require_once( get_template_directory() . '/ReduxFramework/moxie/moxie-config.php' );
	}
	
		
	/***** REQUIRED INCLUDES ***************************************************************************************************/
			
	//Widgets
	include_once(get_template_directory() . "/includes/widget-twitter.php"); //twitter
	include_once(get_template_directory() . "/includes/widget-facebook.php"); //facebook
	include_once(get_template_directory() . "/includes/widget-video.php"); //video
	include_once(get_template_directory() . "/includes/widget-flickr.php"); //flickr
	include_once(get_template_directory() . "/includes/widget-mailchimp.php"); //mailchimp
	include_once(get_template_directory() . "/includes/widget-quickcontact.php"); //quick contact form
	include_once(get_template_directory() . "/includes/widget-recentposts.php"); //recent posts
	
	//TGM plugin
	require_once(get_template_directory() . "/includes/tgm/class-tgm-plugin-activation.php");
	
	//Theme update notifications library
	require_once(get_template_directory() . "/includes/theme-update-checker.php");
		
	//Bootstrap 3 nav support
	include_once(get_template_directory() . '/includes/moxie_theme_bootstrap_navwalker.php');
	
	//Customizer class
	include_once(get_template_directory() . "/includes/classes/moxie_theme_customizer.class.php");
	
	//Custom functions
	include_once(get_template_directory() . "/includes/wp-functions.php");
	
	//Theme metaboxes
	include_once(get_template_directory() . "/includes/theme-metaboxes.php");
	
	/***** CUSTOM VISUAL COMPOSER SHORTCODES ********************************************************************************/
		if ( moxie_theme_is_plugin_active( 'visual-composer/js_composer.php' ) || moxie_theme_is_plugin_active( 'js_composer/js_composer.php' ) ) {

			if(!class_exists('WPBakeryShortCode')) return;
		
			$de_block_dir = get_template_directory().'/includes/vc_blocks/';
			
			require_once( $de_block_dir . 'standard_button.php' );
			require_once( $de_block_dir . 'divider.php' );
			require_once( $de_block_dir . 'alert.php' );
			require_once( $de_block_dir . 'bio_carousel.php' );
			require_once( $de_block_dir . 'client_carousel.php' );
			require_once( $de_block_dir . 'contact_form.php' );			
			require_once( $de_block_dir . 'gallery_items.php' );
			require_once( $de_block_dir . 'google_map.php' );			
			require_once( $de_block_dir . 'icon_element.php' );
			require_once( $de_block_dir . 'milestone.php' );
			require_once( $de_block_dir . 'panels_carousel.php' );
			require_once( $de_block_dir . 'piechart.php' );
			require_once( $de_block_dir . 'post_items.php' );
			require_once( $de_block_dir . 'progress_bar.php' );
			require_once( $de_block_dir . 'quote_box.php' );
			require_once( $de_block_dir . 'staff_carousel.php' );	
			require_once( $de_block_dir . 'html_video.php' );
			require_once( $de_block_dir . 'vimeo_video.php' );
			require_once( $de_block_dir . 'youtube_video.php' );
			
			//Nested elements go last
			require_once( $de_block_dir . 'pricing_table.php' );
			require_once( $de_block_dir . 'skillstable_group.php' );
			require_once( $de_block_dir . 'services_group.php' );
			require_once( $de_block_dir . 'timetable_group.php' );
			require_once( $de_block_dir . 'accordion_group.php' );
			require_once( $de_block_dir . 'datatable_group.php' );
			require_once( $de_block_dir . 'tab_group.php' );
			require_once( $de_block_dir . 'slider_carousel.php' );
		
		}
		
	/***** MENUS ***************************************************************************************************/
	
	register_nav_menu('main_menu', 'Home Menu');
	register_nav_menu('sub_menu', 'Sub-page Menu');
	//register_nav_menu('footer_menu', 'Footer Menu');
	
	/***** THEME SUPPORT ***************************************************************************************************/
	
	add_theme_support('post-thumbnails');
	add_theme_support('automatic-feed-links');
	add_theme_support('custom-header');
	add_theme_support('custom-background');	
	add_theme_support('title-tag');
		
	/***** CUSTOM FILTERS AND HOOKS ***************************************************************************************************/
			
	//Add your sidebars function to the 'widgets_init' action hook.
	add_action( 'widgets_init', 'moxie_theme_register_custom_sidebars' );
	
	//Load front-end scripts
	add_action( 'wp_enqueue_scripts', 'moxie_theme_scripts_styles' );
	
	//Load admin scripts
	add_action( 'admin_enqueue_scripts', 'moxie_theme_load_admin_scripts' );
	
	add_filter('excerpt_more', 'moxie_theme_new_excerpt_more');
		
	//Add content and widget text shortcode support
	add_filter('the_content', 'do_shortcode');
	add_filter('widget_text', 'do_shortcode');
		
	//Retrieve only Posts from Search function
	add_filter('pre_get_posts','moxie_theme_search_filter');
	
	//Show Post ID's
	add_filter('manage_posts_columns', 'moxie_theme_posts_columns_id', 5);
	add_action('manage_posts_custom_column', 'moxie_theme_posts_custom_id_columns', 5, 2);
	
	//Show Page ID's
	add_filter('manage_pages_columns', 'moxie_theme_posts_columns_id', 5);
    add_action('manage_pages_custom_column', 'moxie_theme_posts_custom_id_columns', 5, 2);
			
	//Custom paginated posts
	add_filter('wp_link_pages_args','moxie_theme_custom_nextpage_links');
	
	//Remove REL tag from posts (this will eliminate HTML5 validation error) 
	add_filter( 'wp_list_categories', 'moxie_theme_remove_category_list_rel' );
	add_filter( 'the_category', 'moxie_theme_remove_category_list_rel' );
	
	//Remove title attributes from WordPress navigation
	add_filter( 'wp_list_pages', 'moxie_theme_remove_title_attributes' );
	
	//Ajax Scripts
	add_action('wp_enqueue_scripts', 'moxie_theme_register_user_scripts');
	
	//Ajax loader function
	add_action('wp_ajax_moxie_theme_load_more', 'moxie_theme_load_more');
	add_action('wp_ajax_nopriv_moxie_theme_load_more', 'moxie_theme_load_more');
	
	add_action('wp_ajax_moxie_theme_load_more_posts', 'moxie_theme_load_more_posts');
	add_action('wp_ajax_nopriv_moxie_theme_load_more_posts', 'moxie_theme_load_more_posts');
	
	//Ajax Contact form
	add_action('wp_ajax_send_contact_form', 'moxie_theme_send_contact_form');
	add_action('wp_ajax_nopriv_send_contact_form', 'moxie_theme_send_contact_form');
	
	//Ajax Quick Contact form
	add_action('wp_ajax_send_quick_contact_form', 'moxie_theme_send_quick_contact_form');
	add_action('wp_ajax_nopriv_send_quick_contact_form', 'moxie_theme_send_quick_contact_form');
	
	//Like feature
	add_action('wp_ajax_moxie_theme_retrieve_likes', 'moxie_theme_retrieve_likes');
	add_action('wp_ajax_nopriv_moxie_theme_retrieve_likes', 'moxie_theme_retrieve_likes');
	
	add_action('wp_ajax_moxie_theme_like_feature', 'moxie_theme_like_feature');
	add_action('wp_ajax_nopriv_moxie_theme_like_feature', 'moxie_theme_like_feature');
	
	//Custom Admin fields
	add_action( 'show_user_profile', 'pm_show_extra_profile_fields' );
	add_action( 'edit_user_profile', 'pm_show_extra_profile_fields' );
	
	add_action( 'personal_options_update', 'pm_save_extra_profile_fields' );
	add_action( 'edit_user_profile_update', 'pm_save_extra_profile_fields' );
	
	//Log post views for trends widget
	add_action('wp_head', 'moxie_theme_log_post_views');
	
	//Output buffer
	add_action('init', 'app_output_buffer');
	
	/**** WOOCOMMERCE ***/
	
	//Declare Woocommerce support
	add_theme_support('woocommerce');
	
	//Woocommerce gallery support for version 3.0
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	
	//Remove Woocommerce breadcrumbs
	add_action( 'init', 'pm_ln_remove_wc_breadcrumbs' );
	
	//Remove default Woocommerce wrapper
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
	
	//Add wrapper to Woocommerce pages - applies to product-archive.php and single-product.php
	add_action('woocommerce_before_main_content', 'pm_ln_woo_wrapper_start', 10);
	add_action('woocommerce_after_main_content', 'pm_ln_woo_wrapper_end', 10);
	
	//Display empty star rating
	add_filter('woocommerce_product_get_rating_html', 'pm_ln_woo_get_rating_html', 10, 2);
	
	//Display number of items per page
	$products_per_page = get_theme_mod('products_per_page', 8);
	add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '.$products_per_page.';' ), 20 );
	
	remove_action( 'woocommerce_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 20 ); 
	add_action('woocommerce_proceed_to_checkout', 'moxie_theme_custom_checkout_button_text');
	
	add_filter( 'gettext', 'moxie_theme_change_woocommerce_return_to_shop_text', 20, 3 );
	
	/**** THEME CUSTOMIZER - NEW in WP 3.4+ ****/
	
	//Output customizer CSS
	add_action ('wp_head', 'moxie_theme_customizer_css', 130);
	add_action( 'customize_preview_init', 'pm_ln_customize_preview_js' );
	//add_action( 'customize_controls_enqueue_scripts', 'pm_ln_panels_js' );
	//add_action( 'wp_enqueue_scripts', 'moxie_theme_customizer_styles_cache', 130 );
	//add_action( 'customize_save_after', 'moxie_theme_reset_style_cache_on_customizer_save' );
	
	//Dashboard customization
	add_filter( 'admin_footer_text', 'moxie_theme_remove_footer_admin' );//footer info
	add_action( 'login_enqueue_scripts', 'moxie_theme_login_logo' );//login logo
	add_filter( 'login_headerurl', 'moxie_theme_login_logo_url' );//login logo url
	add_filter( 'login_headertitle', 'moxie_theme_login_logo_url_title' );//login logo title
	
	//TGM plugin activation
	add_action( 'tgmpa_register', 'pm_ln_register_required_plugins' );
	
	//Theme updates
	//add_action('init', 'pm_ln_check_for_theme_updates');
	
	//Custom settings page for purchase verification
	add_action( 'admin_menu', 'pm_ln_theme_settings_admin_menu' );
	
	//Create theme update options
	add_option('pm_ln_theme_marketplace','');
	add_option('pm_ln_micro_themes_user_email','');
	add_option('pm_ln_micro_themes_purchase_code_themeforest','');
	add_option('pm_ln_micro_themes_purchase_code_mojo','');

					
}//end of after_theme_setup

//localization support - NOTE: This has to be a seperate after theme setup method in order to work
add_action('after_setup_theme', 'moxie_theme_localization_setup');


if( !function_exists('pm_ln_customize_preview_js') ) {
	
	function pm_ln_customize_preview_js() {
		wp_enqueue_script( 'moxie-theme-customize-preview', get_theme_file_uri( '/js/customize-preview.js' ), array( 'customize-preview' ), '1.0', true );
	}
	
}

if( !function_exists('pm_ln_panels_js') ) {
	
	function pm_ln_panels_js() {
		wp_enqueue_script( 'moxie-theme-customize-controls', get_theme_file_uri( '/js/customize-controls.js' ), array(), '1.0', true );
	}
	
}


if ( ! function_exists( 'moxie_theme_change_woocommerce_return_to_shop_text' ) ) {
	
	function moxie_theme_change_woocommerce_return_to_shop_text( $translated_text, $text, $domain ) {

			switch ( $translated_text ) {
	
				case 'Return to shop' :
	
					$translated_text = __( 'Return to Store', 'moxietheme' );
					break;
	
			}
	
		return $translated_text;
	}
	
}



if ( ! function_exists( 'moxie_theme_custom_checkout_button_text' ) ) {
	
	function moxie_theme_custom_checkout_button_text() {
		
	   $checkout_url = WC()->cart->get_checkout_url();
	   ?>
	   	<a href="<?php echo $checkout_url; ?>" class="checkout-button button alt wc-forward"><?php _e( 'Proceed to Checkout', 'moxietheme' ); ?></a>
	   <?php
	   
	}
	
}



if ( ! function_exists( 'pm_ln_remove_wc_breadcrumbs' ) ) {
	
	function pm_ln_remove_wc_breadcrumbs() {
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
	}
	
}



if ( ! function_exists( 'pm_ln_woo_wrapper_start' ) ) {
	
	function pm_ln_woo_wrapper_start() {
		
		  $woocommShopLayout = get_theme_mod('woocommShopLayout', 'no-sidebar');
		
		  echo '<div class="container pm-containerPadding-top-80 pm-containerPadding-bottom-80">';
			 echo '<div class="row">';
			 
				if( $woocommShopLayout === 'left-sidebar' ) {
					get_sidebar('woocommerce');
				}
			 
				echo '<div class="col-lg-'. ( $woocommShopLayout === 'no-sidebar' ? '12' : '8' ) .' col-md-'. ( $woocommShopLayout === 'no-sidebar' ? '12' : '8' ) .' col-sm-12">';	  
		  
		  echo ''; 
	  
	}
	
}

if ( ! function_exists( 'pm_ln_woo_wrapper_end' ) ) {
	
	function pm_ln_woo_wrapper_end() {
		
		$woocommShopLayout = get_theme_mod('woocommShopLayout', 'no-sidebar');
		
	  		echo '</div>';
			
			if( $woocommShopLayout === 'right-sidebar' ) {
				get_sidebar('woocommerce');
			}
			
	  	 echo '</div>';
	  echo '</div>';
	  echo ''; 
	  
	}
	
}


if( !function_exists('pm_ln_woo_get_rating_html') ){
	
	function pm_ln_woo_get_rating_html($rating_html, $rating) {
	
		if ( $rating > 0 ) {
			$title = sprintf( __( 'Rated %s out of 5', 'woocommerce' ), $rating );
		} else {
			$title = 'Not yet rated';
			$rating = 0;
		}
	
		$rating_html  = '<div class="star-rating" title="' . $title . '">';
		$rating_html .= '<span style="width:' . ( ( $rating / 5 ) * 100 ) . '%"><strong class="rating">' . $rating . '</strong> ' . __( 'out of 5', 'woocommerce' ) . '</span>';
		$rating_html .= '</div>';
		
		return $rating_html;
		
	}
	
}

if( !function_exists('pm_ln_register_required_plugins') ){

	function pm_ln_register_required_plugins() {
		
		/*
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(
	
			// This is an example of how to include a plugin bundled with a theme.
			array(
				'name'               => 'Visual Composer', // The plugin name.
				'slug'               => 'js_composer', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/includes/lib/codecanyon-242431-visual-composer-page-builder-for-wordpress-wordpress-plugin.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
	
			array(
				'name'               => 'Customizer Export/Import', // The plugin name.
				'slug'               => 'customizer-export-import', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/includes/lib/customizer-export-import.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
			
						
			array(
				'name'               => 'Moxie Shortcode Pack', // The plugin name.
				'slug'               => 'moxie-shortcode-pack', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/includes/lib/shortcode_pack/shortcodes.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
			
			array(
				'name'               => 'Moxie Gallery Post Type', // The plugin name.
				'slug'               => 'premium-gallery', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/includes/lib/custom_post_types/premium-gallery.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
			
			array(
				'name'               => 'Moxie Staff Members Post Type', // The plugin name.
				'slug'               => 'staff-members', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/includes/lib/custom_post_types/staff-members.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
			
			
	
		);
	
		/*
		 * Array of configuration settings. Amend each line as needed.
		 *
		 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
		 * strings available, please help us make TGMPA even better by giving us access to these translations or by
		 * sending in a pull-request with .po file(s) with the translations.
		 *
		 * Only uncomment the strings in the config array if you want to customize the strings.
		 */
		$config = array(
			'id'           => 'moxietheme',                 // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',                      // Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'parent_slug'  => 'themes.php',            // Parent menu slug.
			'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
	
		);
	
		tgmpa( $plugins, $config );
	}

}


function moxie_theme_login_logo_url() {
	return esc_url( 'https://www.pulsarmedia.ca' );
}

function moxie_theme_login_logo_url_title() {
	return esc_html__('Pulsar Media :: Interactive Design Studio', "moxietheme");
}

function moxie_theme_login_logo() { ?>
	<style type="text/css">
		body.login div#login h1 a {
			background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/pulsar-media-login.png );
			padding-bottom: 0px;
			width:321px !important;
			background-size:100%;
		}
	</style>
<?php }

function moxie_theme_remove_footer_admin () {
	echo '<span id="footer-thankyou">'. esc_html__('Developed by', "moxietheme") .' <a href="http://www.pulsarmedia.ca/" target="_blank">'. esc_html__('Pulsar Media', "moxietheme") .'</a> :: '. esc_html__('Interactive Design Studio', "moxietheme") .' - '. esc_html__('Visit our', "moxietheme") .' <a href="https://github.com/PulsarMedia" target="_blank">'. esc_html__('GitHub account', "moxietheme") . '</a> ' . esc_html__('for more FREE WordPress themes and plugins', 'moxietheme');
}


function moxie_theme_remove_dashboard_widget () {
    remove_meta_box ( 'dashboard_quick_press', 'dashboard', 'side' );
	
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
}

function moxie_theme_add_dashboard_widgets() {
	wp_add_dashboard_widget(
		'pm_ln_dashboard_widget', // Widget slug.
		esc_html__('Micro Themes - Latest News', 'moxietheme'), // Title.
		'pm_ln_dashboard_widget_function' // Display function.
	);
}

function pm_ln_dashboard_widget_function() {
	
	$news_file = wp_remote_get( 'https://www.microthemes.ca/files/theme-news/news.html' );
	
	if( is_array($news_file) ) {
						
	  $header = $news_file['headers']; // array of http header lines
	  $body = $news_file['body']; // use the content
	  
	  $args = array(
			'a' => array(
				'href' => array(),
				'title' => array()
			),
			'br' => array(),
			'em' => array(),
			'strong' => array(),
			'p' => array(),
			'h2' => array(),
		);
	  
	  echo wp_kses($body, $args) ;
	  
	}
	
}


if( !function_exists('pm_ln_check_for_theme_updates') ){
	
	function pm_ln_check_for_theme_updates() {
	
		$theme_update_checker = new ThemeUpdateChecker(
			'moxie-theme',
			'http://updates.microthemes.ca/theme-updates/moxie-theme-updater.php'
			//'http://staging.microthemes.ca/theme-updates/medicallink-theme-updater.php'
		);
		
		$theme_update_checker->checkForUpdates();
			
	}
	
}


if( !function_exists('pm_ln_theme_settings_admin_menu') ){	
	function pm_ln_theme_settings_admin_menu() {	
		add_options_page( esc_attr__('Theme Updates', 'moxietheme'), esc_attr__('Theme Updates', 'moxietheme'), 'manage_options', 'myplugin/myplugin-admin-page.php', 'pm_ln_theme_settings_admin_page', 'dashicons-tickets', 6 );
	}
}


if( !function_exists('pm_ln_theme_settings_admin_page') ){

	function pm_ln_theme_settings_admin_page(){		

		if(isset($_POST['pm_ln_verify_account_update'])){			
			update_option('pm_ln_theme_marketplace', sanitize_text_field($_POST['pm_ln_theme_marketplace']));
			update_option('pm_ln_micro_themes_user_email', sanitize_text_field($_POST['pm_ln_micro_themes_user_email']));
			update_option('pm_ln_micro_themes_purchase_code_themeforest', sanitize_text_field($_POST['pm_ln_micro_themes_purchase_code_themeforest']));
			update_option('pm_ln_micro_themes_purchase_code_mojo', sanitize_text_field($_POST['pm_ln_micro_themes_purchase_code_mojo']));	
			update_option('pm_ln_micro_themes_purchased_product', 1);//Corresponds to products array in verify account script		
		}

		$pm_ln_micro_themes_user_email = get_option('pm_ln_micro_themes_user_email');
		$pm_ln_theme_marketplace = get_option('pm_ln_theme_marketplace');
		$pm_ln_micro_themes_purchase_code_themeforest = get_option('pm_ln_micro_themes_purchase_code_themeforest');	
		$pm_ln_micro_themes_purchase_code_mojo = get_option('pm_ln_micro_themes_purchase_code_mojo');	
		$pm_ln_micro_themes_purchased_product = get_option('pm_ln_micro_themes_purchased_product');		
		
		//Validate account
		$queryArgs = array();
		$queryArgs['customer_email'] = $pm_ln_micro_themes_user_email;	
		$queryArgs['customer_marketplace'] = $pm_ln_theme_marketplace;
		$queryArgs['customer_themeforest_purchase_code'] = $pm_ln_micro_themes_purchase_code_themeforest;
		$queryArgs['customer_mojo_purchase_code'] = $pm_ln_micro_themes_purchase_code_mojo;
		$queryArgs['customer_product'] = $pm_ln_micro_themes_purchased_product;
		
		$account_valid = false;
		
		//args for wp_remote_get
		$options = array(
			'timeout' => 10, //seconds
		);
		
		$url = 'http://updates.microthemes.ca/theme-updates/verify-account.php'; 
		//$url = 'http://staging.microthemes.ca/theme-updates/verify-account.php'; 
		if ( !empty($queryArgs) ){
			$url = add_query_arg($queryArgs, $url); //rebuild url with arguments
		}
		
		//Send the request to Micro Themes
		$response = wp_remote_get($url, $options);
				
		if( is_array($response) ) {
			
		  $header = $response['headers']; // array of http header lines
		  $body = $response['body']; // use the content
		  
		  if( strstr($body, "success") ){
			  $account_valid = true;
		  }
		  
		}

		?>

		<div class="wrap">
        
        	<div class="wpmm-wrapper">
            
            	<div id="content" class="wrapper-cell">
            
					<?php if(isset($_POST['pm_ln_verify_account_update'])){?>
    
                        <div class="notice notice-success is-dismissible">
                            <p><?php esc_attr_e('Your settings were updated', 'moxietheme'); ?></p>
                        </div>
                        
                    <?php } ?>	
        
                    <h2><?php esc_attr_e('Theme verification', 'moxietheme'); ?></h2>
                    <p><?php esc_attr_e('Use the form below to verify your Micro Themes account - this will verify your account for automatic updates.', 'moxietheme'); ?></p>            
        
                    <form method="post" action="">            
        
                        <p><label><?php esc_attr_e('Select your marketplace for purchase verification', 'moxietheme'); ?>:</label></p>                
        
                        <select name="pm_ln_theme_marketplace" id="pm_ln_verify_marketplace_selection">
                            <option value="default" <?php if ( 'default' == $pm_ln_theme_marketplace ) echo 'selected="selected"'; ?>>-- <?php esc_attr_e('Choose Marketplace', 'moxietheme'); ?> --</option>
                            <option value="microthemes" <?php if ( 'microthemes' == $pm_ln_theme_marketplace ) echo 'selected="selected"'; ?>><?php esc_attr_e('Micro Themes', 'moxietheme'); ?></option>
                            <option value="themeforest" <?php if ( 'themeforest' == $pm_ln_theme_marketplace ) echo 'selected="selected"'; ?>><?php esc_attr_e('Themeforest', 'moxietheme'); ?></option>
                            <option value="mojo" <?php if ( 'mojo' == $pm_ln_theme_marketplace ) echo 'selected="selected"'; ?>><?php esc_attr_e('Mojo Marketplace', 'moxietheme'); ?></option>
                        </select>                
        
                        <div id="pm_ln_micro_themes_purchase_code_themeforest" class="pm_ln_micro_themes_purchase_code <?php echo $pm_ln_theme_marketplace == 'themeforest' ? 'active' : ''; ?>">
                            <p><label><?php esc_attr_e('Themeforest item purchase code', 'moxietheme'); ?>:</label></p>
                            <input class="pm-admin-theme-verify-text-field" type="text" name="pm_ln_micro_themes_purchase_code_themeforest" value="<?php esc_attr_e($pm_ln_micro_themes_purchase_code_themeforest); ?>" maxlength="200" />
                        </div> 
                        
                        <div id="pm_ln_micro_themes_purchase_code_mojo" class="pm_ln_micro_themes_purchase_code <?php echo $pm_ln_theme_marketplace == 'mojo' ? 'active' : ''; ?>">
                            <p><label><?php esc_attr_e('Mojo item purchase code', 'moxietheme'); ?>:</label></p>
                            <input class="pm-admin-theme-verify-text-field" type="text" name="pm_ln_micro_themes_purchase_code_mojo" value="<?php esc_attr_e($pm_ln_micro_themes_purchase_code_mojo); ?>" maxlength="200" />
                        </div>                
        
                        <p><label><?php esc_attr_e('Micro Themes account email address', 'moxietheme'); ?>:</label></p>
                        <input class="pm-admin-theme-verify-text-field" type="text" value="<?php esc_attr_e($pm_ln_micro_themes_user_email); ?>" name="pm_ln_micro_themes_user_email" maxlength="200" />             
        
                        <input type="hidden" name="pm_ln_micro_themes_installed_theme" value="Medical-Link" />    
                        <p id="pm_ln_micro_themes_verfication_status"><?php esc_attr_e('Account status', 'moxietheme'); ?>: <span><b><?php echo $account_valid == true ? esc_attr('Verified', 'moxietheme') : esc_attr('Unverified', 'moxietheme'); ?></b></span></p>
        
                        <br />                
        
                        <input name="pm_ln_verify_account_update" class="button button-primary button-large" value="<?php esc_attr_e('Verify Account', 'moxietheme'); ?>" type="submit">            
        
                    </form>
                
                </div><!-- /.wrapper-cell -->
    
                <div id="sidebar" class="wrapper-cell">
                
                    <div class="sidebar_box themes_box">
                        <h3><?php esc_attr_e('More Themes by Micro Themes', 'moxietheme'); ?>:</h3>
                        <div class="inside">
                            <ul>
                            	<li>
                                	<a href="http://demos.microthemes.ca/?product=hope" target="_blank" title="Hope WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/hope.jpg" alt="Hope WordPress Themes"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=quantum" target="_blank" title="Quantum WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/quantum.jpg" alt="Quantum WordPress Themes"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=vienna" target="_blank" title="Vienna WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/vienna.jpg" alt="Vienna WordPress Themes"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=medical-link" target="_blank" title="Medical-Link WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/medical-link.jpg" alt="Medical-Link WordPress Themes"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=energy" target="_blank" title="Energy WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/energy.jpg" alt="Energy WordPress Themes"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=luxor" target="_blank" title="Luxor WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/luxor.jpg" alt="Luxor WordPress Themes"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=moxie" target="_blank" title="Moxie WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/moxie.jpg" alt="Moxie WordPress Themes"></a>
                                </li>	
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=pro-cast" target="_blank" title="Pro-Cast WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/pro-cast.jpg" alt="Pro-Cast WordPress Themes"></a>
                                </li>	
                                			
                            </ul>
                        </div>
                        
                        <h3><?php esc_attr_e('Plug-ins by Micro Themes', 'moxietheme'); ?>:</h3>
                        <div class="inside">
                            <ul>
                            	<li>
                                	<a href="http://demos.microthemes.ca/?product=easy-social-stream" target="_blank" title="Easy Social Stream"><img src="http://microthemes.ca/images/theme-ads/easy-social-stream.jpg" alt="Easy Social Stream"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=easy-social-login" target="_blank" title="Easy Social Login"><img src="http://microthemes.ca/images/theme-ads/easy-social-login.jpg" alt="Easy Social Login"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=premium-presentations" target="_blank" title="Premium Presentations"><img src="http://microthemes.ca/images/theme-ads/premium-presentations.jpg" alt="Premium Presentations"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=premium-paypal-manager" target="_blank" title="Premium Paypal Manager"><img src="http://microthemes.ca/images/theme-ads/premium-paypal-manager.jpg" alt="Premium Paypal Manager"></a>
                                </li>                                			
                            </ul>
                        </div>
                        
                    </div>
                
                </div><!-- /.wrapper-cell #sidebar -->
            
            </div><!-- /.wpmm-wrapper -->

		</div><!-- /.wrap -->

		<?php
	}
}



function moxie_theme_register_user_scripts() {
	
	if(moxie_theme_has_shortcode('contactForm') || moxie_theme_is_plugin_active( 'js_composer/js_composer.php' )) {	
		wp_enqueue_script( 'pulsar-ajaxemail', get_template_directory_uri() . '/js/ajax-contact/ajax-email.js', array('jquery'), '1.0', true );
	}
	
	if(is_active_widget( '', '', 'moxie_theme_quickcontact_widget')) {
		wp_enqueue_script( 'pulsar-quickcontact', get_template_directory_uri() . '/js/ajax-quick-contact/ajax-email.js', array('jquery'), '1.0', true );
	}
	
	//Define AJAX URL and pass to JS
	$js_file = get_template_directory_uri() . '/js/wordpress.js'; 
	wp_enqueue_script( 'moxie_theme_register_script', $js_file );
		$array = array( 
			'moxie_theme_ajax_url' => admin_url('admin-ajax.php'),
	);
		
	wp_localize_script( 'moxie_theme_register_script', 'moxie_theme_register_vars', $array );	

}

/******* Log post views *****/
function moxie_theme_log_post_views() {
   if(is_single()) {
      global $post;
      $count = get_post_meta($post->ID, 'post_views', true);
      $newcount = $count + 1;

      update_post_meta($post->ID, 'post_views', $newcount);
   }
}

/******* Custom Admin fields *****/
function pm_show_extra_profile_fields( $user ) { ?>

	<?php $author_title = get_the_author_meta( 'author_title', $user->ID ); ?>
    <h3><?php esc_html_e('Author Title', 'moxietheme') ?></h3>
	<table class="form-table">
        <tr>
			<th><label for="user_organization"><?php esc_html_e('Author Title', 'moxietheme') ?></label></th>
			<td>
				<input name="author_title" value="<?php echo esc_attr($author_title); ?>" type="text" />
			</td>
		</tr>
	</table>
	
<?php }

function pm_save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'manage_options' )  )
		return false;

	/* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
	$author_title =  sanitize_text_field($_POST['author_title']);
	update_user_meta( $user_id, 'author_title', $author_title );
	
}


/******* Remove title atts from WordPress nav *****/
function moxie_theme_remove_title_attributes($input) {
    return preg_replace('/\s*title\s*=\s*(["\']).*?\1/', '', $input);
}



function app_output_buffer() {
  ob_start();
}


//Remove REL tag from posts (this will eliminate HTML5 validation error)
function moxie_theme_remove_category_list_rel( $output ) {
	// Remove rel attribute from the category list
	return str_replace( ' rel="category tag"', '', $output );
}


//Retrieve only Posts from Search function 
function moxie_theme_search_filter($query) {
	
	if( isset($_GET['post_type']) ){
		
		if($_GET['post_type'] == 'product'){
			
			if ($query->is_search) {
				$query->set('post_type',array('product'));
			}
			
		}
		
		
	} else {
		
		if ($query->is_search) {
			
			$query->set('post_type', array('post', 'page'));	

		}
		
	}
		
	return $query;
}

//Show Post ID's
function moxie_theme_posts_columns_id($defaults){
	$defaults['wps_post_id'] = esc_html__('ID', 'moxietheme');
	return $defaults;
}
function moxie_theme_posts_custom_id_columns($column_name, $id){
		if($column_name === 'wps_post_id'){
				echo $id;
	}
}

//Excerpt filters
function moxie_theme_new_excerpt_more($more) {
	global $post;
	return '... <a href="'. get_permalink($post->ID) . '" class="readmore">[...]</a>';
}

//Custom paginated posts
function moxie_theme_custom_nextpage_links($defaults) {
	$args = array(
		'before' => '<div class="pm_paginated-posts"><p>'. esc_html__('Continue Reading: ', 'moxietheme') .'</p><ul class="pagination_multi clearfix">',
		'after' => '</ul></div>',
		'link_before'      => '<li>',
		'link_after'       => '</li>',
	);
	$r = wp_parse_args($args, $defaults);
	return $r;
}

//Enqueue scripts and styles for admin area
function moxie_theme_load_admin_scripts() {
	
	 wp_enqueue_media();
	
	//Load Media uploader script for custom meta options
	wp_enqueue_script( 'pulsar-mediauploader', get_template_directory_uri() . '/js/media-uploader/pm-image-uploader.js', array(), '1.0', true );
	
	//Custom CSS for meta boxes
	wp_enqueue_style( 'pulsar-wpadmin', get_template_directory_uri() . '/js/wp-admin/wp-admin.css' );
	
	//JS for admin
	wp_enqueue_script( 'pulsar-wpadminjs', get_template_directory_uri() . '/js/wp-admin/wp-admin.js', array(), '1.0', true );
	
	//Date picker for Classes and Event post types
	wp_enqueue_script( 'jquery-ui-core' );
	wp_enqueue_script( 'jquery-ui-datepicker' );
	wp_enqueue_style( 'pulsar-datepicker', get_template_directory_uri() . '/css/datepicker/jquery-ui.min.css' );
	
	$admin_js = get_template_directory_uri() . '/js/wp-admin/wp-admin.js'; 
	
	//Pass admin path to JS
	wp_register_script( 'adminRoot', $admin_js  );
	wp_enqueue_script( 'adminRoot' );
	$array = array( 
		'adminRoot' => home_url('/'),
	);
	wp_localize_script( 'adminRoot', 'adminRootObject', $array ); 
	
}

//Enqueue scripts and styles
function moxie_theme_scripts_styles() {
		
	global $wp_styles;
	global $post;

	// Adds JavaScript to pages with the comment form to support sites with threaded comments (when in use).
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

		//Adds JavaScript for handling the navigation menu hide-and-show behavior.		
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-datepicker' );
		
		//Global js scripts
		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/bootstrap3/js/bootstrap.min.js', array('jquery'), '1.0', true );
		wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.custom.js', array('jquery'), '1.0', false );
		wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array('jquery'), '1.0', true );
		wp_enqueue_script( 'tinynav', get_template_directory_uri() . '/js/tinynav.js', array('jquery'), '1.0', true );
		wp_enqueue_script( 'css-browser-selector', get_template_directory_uri() . '/js/css_browser_selector.js', array('jquery'), '1.0', true );
		wp_enqueue_style( 'jqueryui', get_template_directory_uri() . '/css/jquery-ui/jquery-ui.css', array( 'pulsar-style' ), '20121010' );
		wp_enqueue_script( 'easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array('jquery'), '1.0', true );
		wp_enqueue_script( 'img-preload', get_template_directory_uri() . '/js/jquery.imgpreload.min.js', array('jquery'), '1.0', true );
		wp_enqueue_script( 'superfish', get_template_directory_uri() . '/js/superfish/superfish.js', array('jquery'), '1.0', true );
		
		
		//CONDITIONAL SCRIPTS
		$retinaSupport = get_theme_mod('retinaSupport', 'on');
		if($retinaSupport === 'on'){
			wp_enqueue_script( 'retina', get_template_directory_uri() . '/js/retina.js', array('jquery'), '1.0', true );
		}
		
		$enableToolTip = get_theme_mod('enableTooltip', 'on');
		if( $enableToolTip === 'on' ){
			wp_enqueue_script( 'pulsar-tooltip', get_template_directory_uri() . '/js/jquery.tooltip.js', array('jquery'), '1.0', true );
		}

		if( is_single() || is_page() || is_home() || is_archive() ){
			
			//Load WOW
			wp_enqueue_style( 'wow-css', get_template_directory_uri() . '/js/wow/css/libs/animate.css', array( 'pulsar-style' ), '20121010' );
			wp_enqueue_script( 'wow', get_template_directory_uri() . '/js/wow/wow.min.js', array('jquery'), '1.0', true );
			
			//Load Viewport Selectors for jQuery
			wp_enqueue_script( 'viewport-mini', get_template_directory_uri() . '/js/jquery.viewport.mini.js', array('jquery'), '1.0', true );			
			
			//Load Stellar Parallax
			wp_enqueue_script( 'pulsar-stellar', get_template_directory_uri() . '/js/stellar/jquery.stellar.js', array('jquery'), '1.0', true );
			
		}
		
		if( is_single() || is_page() || is_home() || is_front_page() || is_archive() || is_page_template('template-gallery.php') ){
			
			//Like feature
			wp_enqueue_script( 'pulsar-like', get_template_directory_uri() . '/js/ajax-like-feature/ajax-like-feature.js', array('jquery'), '1.0', true );
			$js_file = get_template_directory_uri() . '/js/wordpress.js'; 
			wp_enqueue_script( 'jcustom', $js_file );
			$array = array( 
				'ajaxurl' => admin_url('admin-ajax.php'),
				'nonce' => wp_create_nonce('pulsar_ajax'),
				'loading' => esc_html__('Loading...', 'moxietheme')
			);
			wp_localize_script( 'jcustom', 'pulsarajax', $array );
			
		}
		
		if( is_home() || is_front_page() ){
			
			//Load pulse slider
			wp_enqueue_script( 'pulse-slider', get_template_directory_uri() . '/js/pulse/jquery.PMSlider.js', array('jquery'), '1.0', true );
			wp_enqueue_style( 'pulse-slider-css', get_template_directory_uri() . '/js/pulse/pm-slider.css', array( 'pulsar-style' ), '20121010' );
			
		}
		
		//Like feature
		if( is_single() || is_page_template('template-blog.php') || moxie_theme_has_shortcode('postItems') || moxie_theme_has_shortcode('galleryItems') || moxie_theme_is_plugin_active( 'js_composer/js_composer.php' )){
			wp_enqueue_script( 'pulsar-like', get_template_directory_uri() . '/js/ajax-like-feature/ajax-like-feature.js', array('jquery'), '1.0', true );
		}	
		
		
		//SHORTCODE CONDITIONALS
		if( moxie_theme_has_shortcode('sliderCarousel') || get_post_type() === 'post_galleries' || moxie_theme_is_plugin_active( 'js_composer/js_composer.php' )) {			
			//Flexslider
			wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/flexslider/jquery.flexslider-min.js', array('jquery'), '1.0', true );
			wp_enqueue_style( 'flexslider-css', get_template_directory_uri() . '/js/flexslider/flexslider-post.css', array( 'pulsar-style' ), '20121010' );	
		}		
		
		
		if(moxie_theme_has_shortcode('galleryItems') || moxie_theme_is_plugin_active( 'js_composer/js_composer.php' ) ) {
			
			//Isotope
			wp_enqueue_style( 'isotope-css', get_template_directory_uri() . '/js/isotope/isotope.css', array( 'pulsar-style' ), '20121010' );
			wp_enqueue_script( 'isotope-js', get_template_directory_uri() . '/js/isotope/isotope.pkgd.min.js', array('jquery'), '1.0', true );
			
			//PrettyPhoto
			wp_enqueue_style( 'prettyPhoto-css', get_template_directory_uri() . '/js/prettyphoto/css/prettyPhoto.css', array( 'pulsar-style' ), '20121010' );
			wp_enqueue_script( 'prettyphoto-js', get_template_directory_uri() . '/js/prettyphoto/js/jquery.prettyPhoto.js', array('jquery'), '1.0', true );
			wp_enqueue_script( 'jquery-migrate', get_template_directory_uri() . '/js/jquery-migrate-1.2.1.js', array('jquery'), '1.0', true );
			
		}		
		
		if(moxie_theme_has_shortcode('servicesGroup') || moxie_theme_has_shortcode('postItems') || moxie_theme_is_plugin_active( 'js_composer/js_composer.php' )) {			
			
			//load owl carousel
			wp_enqueue_style( 'owl-carousel-css', get_template_directory_uri() . '/js/owl-carousel/owl.carousel.css', array( 'pulsar-style' ), '20121010' );
			wp_enqueue_script( 'owl-carousel-js', get_template_directory_uri() . '/js/owl-carousel/owl.carousel.js', array('jquery'), '1.0', true );
			
		}
		
		if(moxie_theme_has_shortcode('googleMap') || moxie_theme_is_plugin_active( 'js_composer/js_composer.php' )) {			
			
			$googleAPIKey = get_theme_mod('googleAPIKey');
			
			wp_register_script('google-maps', ('//maps.google.com/maps/api/js?key='.$googleAPIKey.''), false, null, true);
			wp_enqueue_script('google-maps');
			
		}
		
		if(moxie_theme_has_shortcode('milestone') || moxie_theme_has_shortcode('piechart') || moxie_theme_is_plugin_active( 'js_composer/js_composer.php' )) {			
			
			wp_enqueue_script( 'pulsar-easypiechart', get_template_directory_uri() . '/js/easypiechart/jquery.easypiechart.min.js', array(), '1.0', true );
			
		}					
			
		//WIDGET CONDITIONALS
		if(is_active_widget( '', '', 'pm-ln-latest-tweets')) {
			wp_enqueue_script( 'pulsar-twitter', get_template_directory_uri() . '/js/twitter-post-fetcher/twitterFetcher_min.js', array('jquery'), '1.0', true );
		}		
			
		
		//Load main theme script
		wp_enqueue_script( 'pulsar-main', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0', true );
				
		//Loads our main stylesheet.
		wp_enqueue_style( 'pulsar-style', get_stylesheet_uri() );
		
		//Load main styles
		wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/bootstrap3/css/bootstrap.min.css', array( 'pulsar-style' ), '20121010' );
		wp_enqueue_style( 'master-css', get_template_directory_uri() . '/css/master.css', array( 'pulsar-style' ), '20121010' );
	
		//Global stylesheets
		wp_enqueue_style( 'pulsar-superfish', get_template_directory_uri() . '/css/superfish/superfish.css', array( 'pulsar-style' ), '20121010' );
		wp_enqueue_style( 'pulsar-fontawesome', get_template_directory_uri() . '/css/fontawesome/font-awesome.min.css', array( 'pulsar-style' ), '20121010' );
		wp_enqueue_style( 'pulsar-typicons', get_template_directory_uri() . '/css/typicons/typicons.min.css', array( 'pulsar-style' ), '20121010' );
		wp_enqueue_style( 'pulsar-simplelineicons', get_template_directory_uri() . '/css/lineicons/simple-line-icons.css', array( 'pulsar-style' ), '20121010' );
		
		//Responsive css - load this last
		wp_enqueue_style( 'pulsar-responsive', get_template_directory_uri() . '/css/responsive.css', array( 'pulsar-style' ), '20121010' );
		
		/****** JAVASCRIPT LOCALIZATION ********/
		
		//Redux options
		$moxie_options = moxie_theme_get_moxie_options();
		
		//Define a JS file to store variables
		$js_file = get_template_directory_uri() . '/js/wordpress.js'; 
				
		
		//Form translations
		
		/** Global messages **/		
		$securityError = $moxie_options['opt-invalid-security-code-error'];
		$successMessage = $moxie_options['opt-form-success-message']; 
		$failedMessage = $moxie_options['opt-form-error-message'];  
		$fieldValidation = $moxie_options['opt-form-validation-message']; 
		
		/** Contact form **/
		$contactForm1 = $moxie_options['opt-first-name-error'];   
		$contactForm2 = $moxie_options['opt-last-name-error'];   
		$contactForm3 = $moxie_options['opt-email-address-error'];    
		$contactForm4 = $moxie_options['opt-form-message-error'];  
		
		/** Quick contact **/
		$quickContact1 = $moxie_options['opt-quick-contact-name-error-message'];  
		$quickContact2 = $moxie_options['opt-email-address-error'];  
		$quickContact3 = $moxie_options['opt-form-message-error'];  
		
		//Get Pulse slider settings for JS
		$enableSlideShow = get_theme_mod('enableSlideShow', 'true');
		$slideLoop = get_theme_mod('slideLoop', 'true');
		$enableControlNav = get_theme_mod('enableControlNav', 'true');
		$pauseOnHover = get_theme_mod('pauseOnHover', 'true');
		$showArrows = get_theme_mod('showArrows', 'true');
		$animationType = get_theme_mod('animationType', 'slide');
		$slideShowSpeed = get_theme_mod('slideShowSpeed', 8000);
		$slideSpeed = get_theme_mod('slideSpeed', 800);
		$sliderHeight = get_theme_mod('sliderHeight', 755);
		$enableFixedHeight = get_theme_mod('enableFixedHeight', 'true');		
		
		//Localize PrettyPhoto settings
		$ppAnimationSpeed = $moxie_options['ppAnimationSpeed'];
		$ppAutoPlay = $moxie_options['ppAutoPlay'];
		$ppShowTitle = $moxie_options['ppShowTitle'];
		$ppColorTheme = $moxie_options['ppColorTheme'];
		$ppSlideShowSpeed = $moxie_options['ppSlideShowSpeed'];
		$ppSocialTools = $moxie_options['ppSocialTools'];
		$ppControls = $moxie_options['ppControls'];
		
		//Pass primary and secondary color to js
		$primaryColor1 = get_option('primaryColor', '#5cc9c1');
		$secondaryColor1 = get_option('secondaryColor', '#2e3049');
		$offsetColor1 = get_option('offsetColor', '#fa2d65');		
		
		//Javascript Object	
		$wordpressOptionsArray = array( 
			'urlRoot' => home_url(),
			'templateDir' => get_template_directory_uri(),
			'primaryColor' => $primaryColor1,
			'secondaryColor' => $secondaryColor1,
			'offsetColor' => $offsetColor1,
			'ppAnimationSpeed' => $ppAnimationSpeed,
			'ppAutoPlay' => $ppAutoPlay,
			'ppShowTitle' => $ppShowTitle,
			'ppColorTheme' => $ppColorTheme,
			'ppSlideShowSpeed' => $ppSlideShowSpeed,
			'ppSocialTools' => $ppSocialTools,
			'ppControls' => $ppControls,
			'enableSlideShow' => $enableSlideShow,
			'slideLoop' => $slideLoop,
			'enableControlNav' => $enableControlNav,
			'animationType' => $animationType,
			'pauseOnHover' => $pauseOnHover,
			'showArrows' => $showArrows,
			'slideShowSpeed' => $slideShowSpeed,
			'slideSpeed' => $slideSpeed,
			'sliderHeight' => $sliderHeight,
			'fixedHeight' => $enableFixedHeight,
			'securityError' => $securityError,
			'successMessage' => $successMessage,
			'failedMessage' => $failedMessage,
			'contactForm1' => $contactForm1,
			'contactForm2' => $contactForm2,
			'contactForm3' => $contactForm3,
			'contactForm4' => $contactForm4,
			'quickContact1' => $quickContact1,
			'quickContact2' => $quickContact2,
			'quickContact3' => $quickContact3,
			'fieldValidation' => $fieldValidation
		);
		
		wp_enqueue_script('wordpressOptions', get_template_directory_uri() . '/js/wordpress.js');
		wp_localize_script( 'wordpressOptions', 'wordpressOptionsObject', $wordpressOptionsArray );
		
}

function moxie_theme_register_custom_sidebars() {
		
	if (function_exists('register_sidebar')) {
		
		//DEFAULT TEMPLATE
		register_sidebar(array(
								
								'name' => esc_html__('Default Template','moxietheme'),
								'id' => 'default_widget',
								'description'   => '',
								'class'         => '',
								'before_widget' => '<div id="%1$s" class="widget pm-widget %2$s"><div class="pm-widget-spacer">',
								'after_widget'  => '</div></div>',
								'before_title' => '<h6 class="widget-title">',
								'after_title' => '</h6>',
		));
		
		//HOMEPAGE
		register_sidebar(array(
								
								'name' => esc_html__('Home Page','moxietheme'),
								'id' => 'home_page_widget',
								'description'   => '',
								'class'         => '',
								'before_widget' => '<div id="%1$s" class="widget pm-widget %2$s"><div class="pm-widget-spacer">',
								'after_widget'  => '</div></div>',
								'before_title' => '<h6 class="widget-title">',
								'after_title' => '</h6>',
		));

		//NEWS POSTS PAGE
		register_sidebar(array(
								'name' => esc_html__('Blog Page','moxietheme'),
								'id' => 'blog_page_widget',
								'description'   => '',
								'class'         => '',
								'before_widget' => '<div id="%1$s" class="widget pm-widget %2$s"><div class="pm-widget-spacer">',
								'after_widget'  => '</div></div>',
								'before_title' => '<h6 class="widget-title">',
								'after_title' => '</h6>',
		));

				
		//FOOTER
		register_sidebar(array(
								
								'name' => esc_html__('Footer Column 1','moxietheme'),
								'id' => 'footer_column1_widget',
								'description'   => '',
								'class'         => '',
								'before_widget' => '<div id="%1$s" class="widget %2$s">',
								'after_widget'  => '</div>',
								'before_title' => '<h6>',
								'after_title' => '</h6>',
		));
		
		register_sidebar(array(
								'name' => esc_html__('Footer Column 2','moxietheme'),
								'id' => 'footer_column2_widget',
								'description'   => '',
								'class'         => '',
								'before_widget' => '<div id="%1$s" class="widget %2$s">',
								'after_widget'  => '</div>',
								'before_title' => '<h6>',
								'after_title' => '</h6>',
		));
		
		register_sidebar(array(
								'name' => esc_html__('Footer Column 3','moxietheme'),
								'id' => 'footer_column3_widget',
								'description'   => '',
								'class'         => '',
								'before_widget' => '<div id="%1$s" class="widget %2$s">',
								'after_widget'  => '</div>',
								'before_title' => '<h6>',
								'after_title' => '</h6>',
		));
		
		register_sidebar(array(
								'name' => esc_html__('Footer Column 4','moxietheme'),
								'id' => 'footer_column4_widget',
								'description'   => '',
								'class'         => '',
								'before_widget' => '<div id="%1$s" class="widget %2$s">',
								'after_widget'  => '</div>',
								'before_title' => '<h6>',
								'after_title' => '</h6>',
		));
		
		register_sidebar(array(
								
							'name' => esc_attr__('Woocommerce',"moxietheme"),
							'id' => 'woocommerce_widget',
							'description'   => '',
							'class'         => '',
							'before_widget' => '<div id="%1$s" class="widget %2$s">',
							'after_widget'  => '</div>',
							'before_title' => '<h6>',
							'after_title' => '</h6>',
		));
		
		
	}//end of if function_exists
	
}//end of moxie_theme_register_custom_sidebars


//localization support - Remember to define WPLANG in wp-config.php file -> define('WPLANG', 'ja');
function moxie_theme_localization_setup() {
	// Retrieve the directory for the localization files
	$lang_dir = get_template_directory() . '/languages';
	// Set the theme's text domain using the unique identifier from above
	load_theme_textdomain('moxietheme', $lang_dir);
} // end custom_theme_setup
	


//Custom Pagination - http://www.kriesi.at/archives/how-to-build-a-wordpress-post-pagination-without-plugin
function moxie_theme_kriesi_pagination($style = '', $pages = '', $range = 2){
	
	 $showitems = ($range * 2)+1;

	 global $paged;
	 if(empty($paged)) $paged = 1;

	 if($pages == '')
	 {
		 global $wp_query;
		 $pages = $wp_query->max_num_pages;
		 if(!$pages)
		 {
			 $pages = 1;
		 }
	 }

	 if(1 != $pages){
		 		 
		 echo "<ul class='pm-pagination ".esc_attr($style)." clearfix reset-pulse-sizing'>";
		 if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a class='button-small grey' href='".get_pagenum_link(1)."'>&laquo;</a></li>";
		 if($paged > 1 && $showitems < $pages) echo "<a class='button-small-theme' href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

		 for ($i=1; $i <= $pages; $i++)
		 {
			 if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
			 {
				 echo ($paged == $i)? "<li class='current'><span class='current'>".$i."</span></li>":"<li class='inactive'><a class='inactive' href='".get_pagenum_link($i)."' >".$i."</a></li>";
			 }
		 }

		 if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a></li>";
		 if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>&raquo;</a></li>";
		 
		 $args = array(
			'before'           => '<li>' . esc_html__('Pages:', 'moxietheme'),
			'after'            => '</li>',
			'link_before'      => '',
			'link_after'       => '',
			'next_or_number'   => 'number',
			'nextpagelink'     => esc_html__('Next page', 'moxietheme'),
			'previouspagelink' => esc_html__('Previous page', 'moxietheme'),
			'pagelink'         => '%',
			'echo'             => 1
		);
		
		echo "</ul>\n";
		 
	 }
	 
	 
}


/*** Theme Customizer CSS ****/
function moxie_theme_customizer_css(){
?>
        <style type="text/css">
		<?php
		
			global $moxie_options;
			$ppControls = $moxie_options['ppControls']; //CSS control
			if($ppControls === 'false'){
				echo '
					.pp_nav {
						display:none !important;	
					}
				';
			}
		
			//Global Options
			$pageBackgroundImage = get_theme_mod('pageBackgroundImage');
			$repeatBackground = get_theme_mod('repeatBackground', 'repeat');
			$pageBackgroundColor = get_option('pageBackgroundColor', '#FFFFFF');
			$primaryColor = get_option('primaryColor', '#5cc9c1');
			$primaryColors = moxie_theme_hex2rgb($primaryColor); //Array of colors R,G,B
			$secondaryColor = get_option('secondaryColor', '#2e3049');
			$secondaryColors = moxie_theme_hex2rgb($secondaryColor); //Array of colors R,G,B
			$offsetColor = get_option('offsetColor', '#fa2d65');
			$offsetColors = moxie_theme_hex2rgb($offsetColor); //Array of colors R,G,B
			$dividerColor = get_option('dividerColor', '#e3e3e3');
			$tooltipColor = get_option('tooltipColor', '#5cc9c1');
			$blockQuoteColor = get_option('blockQuoteColor', '#0DB7C4');
			$ulListIcon = get_theme_mod('ulListIcon', 'f105');
			$ulListIconColor = get_option('ulListIconColor', '#5cc9c1');
			$boxedModeContainerColor = get_option('boxedModeContainerColor', '#ffffff');
			
			echo '
						
				.woocommerce .widget_price_filter .ui-slider .ui-slider-handle {
					background-color:'. $secondaryColor .';	
				}
				
				.woocommerce .widget_price_filter .ui-slider .ui-slider-range {
					background-color:'. $primaryColor .' !important;	
					background-image: none !important;		
				}
			
				.woocommerce table.shop_table tbody th, .woocommerce table.shop_table tfoot td, .woocommerce table.shop_table tfoot th {
					border-top: 1px solid '.$dividerColor.';	
				}
			
				.woocommerce .widget_shopping_cart .total, .woocommerce.widget_shopping_cart .total {
					border-top: 1px solid '.$dividerColor.';
				}
				
				.woocommerce .woocommerce-ordering select {
					border: 1px solid '.$dividerColor.';
				}
				
				.woocommerce #reviews #comment {
					border:1px solid '.$dividerColor.';
				}
				
				.input-text.qty.text {
					border:1px solid '.$dividerColor.';	
				}
				
				.woocommerce #reviews #comments ol.commentlist li .comment-text {
					border: 1px solid '.$dividerColor.';	
				}
				
				.woocommerce div.product form.cart .variations select {
					border:1px solid '.$dividerColor.';	
				}
				
				.woocommerce table.shop_table {
					border:1px solid '.$dividerColor.';	
				}
				
				.woocommerce table.shop_table td {
					border-top:1px solid '.$dividerColor.';	
				}
				
				.woocommerce form .form-row input.input-text, .woocommerce form .form-row textarea {
					border:1px solid '.$dividerColor.';	
				}
				
				
				.woocommerce form .form-row select {
					border:1px solid '.$dividerColor.';
				}	
				
				.woocommerce span.onsale {
					background-color:'. $secondaryColor .';
				}
				
				.woocommerce ul.products li.product .price {
					color:'. $secondaryColor .';
				}
				
				.woocommerce div.product .woocommerce-tabs ul.tabs li.active > a {
					background-color: '. $secondaryColor .';	
				}
				
				.woocommerce .star-rating span {
					color:'. $secondaryColor .';	
				}
				
				.woocommerce p.stars a {
					color:'. $secondaryColor .';	
				}
				
				.woocommerce-review-link {
					color:'. $secondaryColor .' !important;	
				}
				
				.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover {
					background-color:'. $secondaryColor .';
					color:white;	
				}
				
				.woocommerce-info::before {
					color: '. $secondaryColor .';
				}
				
				.woocommerce-error::before {
					color: '. $secondaryColor .';
				}

				.woocommerce form .form-row.woocommerce-invalid .select2-container, .woocommerce form .form-row.woocommerce-invalid input.input-text, .woocommerce form .form-row.woocommerce-invalid select {
					border-color: '. $secondaryColor .';
				}
				
				.woocommerce form .form-row.woocommerce-invalid label {
					color: '. $secondaryColor .';	
				}
				
				.woocommerce form .form-row .required {
					color:'. $secondaryColor .';
				}
				
				.woocommerce a.remove {
					background-color: '. $secondaryColor .';
					color: white !important;
				}
				
				.woocommerce-error, .woocommerce-info, .woocommerce-message {
					border-top:3px solid '. $secondaryColor .';
				}
				
				.woocommerce-message::before {
					color:'. $secondaryColor .';
				}
				
				.woocommerce ul.products li.product .price {
					color:'. $secondaryColor .';
				}
				
				.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover {
					background-color: '. $secondaryColor .';
					color: #fff;
				}
				
				.woocommerce div.product form.cart .reset_variations:hover {
					background-color: '. $secondaryColor .';
				}
				
				.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover {
					background-color: '. $secondaryColor .' !important;	
					color:white !important;
				}
				
				.woocommerce form .form-row.woocommerce-validated .select2-container, .woocommerce form .form-row.woocommerce-validated input.input-text, .woocommerce form .form-row.woocommerce-validated select {
					border-color:'. $secondaryColor .';
				}				
				
				.page-numbers.current, a.page-numbers:hover {
					background-color: '.$secondaryColor.' !important;
					color:white !important;		
				}
				
				
				.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt {
					background-color: '.$secondaryColor.';
				}
				
				.product_meta > span > a {
					color: '. $primaryColor .';
				}
				
				.product_meta > span > a:hover {
					color: '. $secondaryColor .';
				}
				
				
				.woocommerce #reviews #comment:focus {
					background-color:'.$primaryColor.';
				}
				
				.woocommerce div.product form.cart .reset_variations {
					background-color: '.$primaryColor.';
				}
				
				.woocommerce #respond input#submit.alt.disabled, .woocommerce #respond input#submit.alt.disabled:hover, .woocommerce #respond input#submit.alt:disabled, .woocommerce #respond input#submit.alt:disabled:hover, .woocommerce #respond input#submit.alt[disabled]:disabled, .woocommerce #respond input#submit.alt[disabled]:disabled:hover, .woocommerce a.button.alt.disabled, .woocommerce a.button.alt.disabled:hover, .woocommerce a.button.alt:disabled, .woocommerce a.button.alt:disabled:hover, .woocommerce a.button.alt[disabled]:disabled, .woocommerce a.button.alt[disabled]:disabled:hover, .woocommerce button.button.alt.disabled, .woocommerce button.button.alt.disabled:hover, .woocommerce button.button.alt:disabled, .woocommerce button.button.alt:disabled:hover, .woocommerce button.button.alt[disabled]:disabled, .woocommerce button.button.alt[disabled]:disabled:hover, .woocommerce input.button.alt.disabled, .woocommerce input.button.alt.disabled:hover, .woocommerce input.button.alt:disabled, .woocommerce input.button.alt:disabled:hover, .woocommerce input.button.alt[disabled]:disabled, .woocommerce input.button.alt[disabled]:disabled:hover {
					background-color:'.$secondaryColor.';
				}
				
				.woocommerce a.remove:hover {
					background-color: '.$primaryColor.';
				}
				
				.woocommerce form .form-row input.input-text:focus, .woocommerce form .form-row textarea:focus {
					border:1px solid '.$primaryColor.';	
					background-color:'.$primaryColor.';
				}
				
				.woocommerce div.product p.price, .woocommerce div.product span.price {
					color:'. $primaryColor .';	
				}	
			
				.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button {
					background-color: '.$secondaryColor.';	
					color:white !important;
				}
				
				.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover {
					background-color:'. $primaryColor .' !important;	
					color:black !important;
				}
			
				.woocommerce .woocommerce-breadcrumb a:hover, .breadcrumbs li a:hover {
					color: '. $secondaryColor .';
					text-decoration:none !important;
				}
			
			
				body {
					background-repeat:'.$repeatBackground.';
					background-color:'.$pageBackgroundColor.';
					'. ( $pageBackgroundImage !== '' ? 'background-image:url('.$pageBackgroundImage.')' : '' ) .'	
				}
				
				.pm-sidebar .pm-widget h6, .widget.woocommerce > h6 {
					border-left: 13px solid '. $primaryColor .';	
				}
				
				.pm_services_tab_icon:before {
					background-color: '.$offsetColor.';
				}
				
				.pm_services_tab_icon {
    				border: 4px solid '.$offsetColor.';
				}
				
				.pm-404-error b {
					color:'.$secondaryColor.';	
				}
				
				.pm-portfolio-system-filter li a.active {
					background-color: '.$offsetColor.';	
					color:white !important;	
				}
				
				.pm-news-post-excerpt a:hover {
					color:'.$offsetColor.';	
				}
				
				.pm-tweet-list ul li a:hover {
					color:'.$offsetColor.';		
				}
				
				.pm-news-post-btn:hover, .pm-news-post-btn-mobile:hover, .pm-recent-post-btn:hover {
					color:'.$offsetColor.';	
				}
				
				.pm-news-post-title a:hover {
					color:'.$offsetColor.';
				}
				
				.pm-portfolio-system-filter li a {
					background-color: '.$secondaryColor.';	
				}
				
				.pm-portfolio-system-filter li a:hover {
					background-color: '.$offsetColor.';	
				}
				
				.pm-post-nav-btn-faceflip-top:hover {
					border: 3px solid '.$offsetColor.';
					background-color: '.$offsetColor.';
				}
				
				.pm-services-tab-divider {
					background-color: '.$dividerColor.';
				}
				
				.pm-services-tab-system-desc-text h5 {
					background-color: '.$offsetColor.';		
				}
				
				.pm-services-tab-system-desc-text h5 i {
					color: '.$secondaryColor.';		
				}
				
				.pm-header-menu-btn {
					border:2px solid '.$offsetColor.';	
				}
				
				.pm-header-menu-btn:hover {
					background-color: '.$offsetColor.';	
				}
				
				.flickr_badge_image a span {
					background-color:rgba('.$offsetColors[0].','.$offsetColors[1].','.$offsetColors[2].',.8);	
				}
				
				.pm-news-post-img-container {
					border:1px solid '.$dividerColor.';	
				}
				
				.pm-gallery-post-expand-btn-blog {
					background-color:'.$primaryColor.';
					border:2px solid rgba('.$secondaryColors[0].','.$secondaryColors[1].','.$secondaryColors[2].',.3);
				}
				
				.pm-gallery-post-expand-btn-blog:hover {
					background-color:'.$offsetColor.';	
				}
				
				.pm-gallery-post-expand-btn-container-blog {
					background-color:rgba('.$secondaryColors[0].','.$secondaryColors[1].','.$secondaryColors[2].',.8);
				}
				
				.pm-pricing-table-purchase-container a:hover {
					color:'.$offsetColor.' !important;	
				}
				
				.pm-header-social-icons li a:hover {
					color:'.$offsetColor.';
				}
				
				.pm-home-news-post-continue { 
					border: 2px solid '.$offsetColor.';	
				}
				
				.pm-home-news-post-continue:hover {
					background-color:'.$offsetColor.';	
					color:white;	
				}
				
				.pm-portfolio-system-filter-active-bar {
					background-color:'.$offsetColor.';
				}
				
				.pm-gallery-post-expand-btn-container:hover {
					background-color:'.$primaryColor.';	
				}
				
				#back-top-scroll-up:hover, #back-top-scroll-down:hover {
					color:'.$offsetColor.';			
				}
				
				.pm-header-menu-btn.slider {
					border: 2px solid '.$offsetColor.';	
				}
				
				.pm-header-menu-btn.slider:hover {
					background-color:'.$offsetColor.';		
				}
				
				.pm-home-news-post-links-list li a {
					background-color:'.$primaryColor.';
				}
				
				.pm-home-news-post-links-list li a:hover {
					background-color:'.$offsetColor.';
				}
				
				.pm-home-news-post-likes-list li i, .pm-home-news-post-likes-list li a {
					color:'.$offsetColor.';	
				}
				
				.pm-home-news-post-likes-list li a:hover {
					color:'.$primaryColor.';		
				}
				
				.pm-home-news-post-title {
					color:'.$primaryColor.';	
				}
				
				.pm-home-news-post-title:hover {
					color:'.$offsetColor.' !important;	
				}

				
				.pm-home-news-post-info-meta-list li i {
					color:'.$primaryColor.';
				}
				
				.pm-home-news-post-info-expand-btn:hover {
					background-color:'.$offsetColor.';	
				}
				
				.pm-home-news-post-info-container {
					background-color:rgba('.$secondaryColors[0].','.$secondaryColors[1].','.$secondaryColors[2].',.8);
				}
				
				.pm-home-news-post-info-expand-btn {
					background-color:'.$primaryColor.';
				}
				
				.pm-staff-member-system-bio-view-profile {
					border:3px solid '.$offsetColor.';	
				}
				
				.pm-staff-member-system-bio-view-profile:hover {
					background-color:'.$offsetColor.';	
					color:white !important;
				}
				
				.pm-staff-member-system-bio-social-icons li a {
					background-color:'.$offsetColor.';	
				}
				
				.pm-staff-member-system-bio-social-icons li a:hover {
					background-color:'.$primaryColor.';
				}
				
				.pm-timeline-bar {
					background-color: '.$primaryColor.';
					border:1px solid '.$secondaryColor.';
				}
				
				.pm-timeline-text-underlay {
					background-color: '.$offsetColor.';	
				}
				
				.pm-timeline-dates li i {
					background-color: '.$primaryColor.';	
				}
				
				.pm-timeline-wrapper {
					background-color: '.$secondaryColor.';		
				}
				
				.pm-timeline-bg-overlay {
					background-color:rgba('.$secondaryColors[0].','.$secondaryColors[1].','.$secondaryColors[2].',.8);
				}
				
				.pm-gallery-post-details {
					background-color:rgba('.$secondaryColors[0].','.$secondaryColors[1].','.$secondaryColors[2].',.8);
				}
				
				.pm-gallery-post-expand-btn-container {
					border:2px solid '.$primaryColor.';	
				}
				
				.pm-gallery-post-overlay {
					background-color:rgba('.$secondaryColors[0].','.$secondaryColors[1].','.$secondaryColors[2].',.7);	
				}
				
				.pm-skills-logo {
					background-color: '.$secondaryColor.';	
				}
				
				.pm-skills-inner, .pm-skills-logo {
					border-color:'.$primaryColor.';	
				}
				
				.pm-skills-logo:hover {
					background-color: '.$offsetColor.';
					border-color:'.$offsetColor.';
				}
				
				.pm-skills-logo.active {
					background-color:'.$offsetColor.';
					border-color:'.$offsetColor.';
				}
				
				.pm-skills-logo-text-title {
					color:'.$primaryColor.';	
				}
				
				.pm-comment-avatar {
					border: 3px solid '.$primaryColor.';
				}
				
				.pm-rounded-btn {
					background-color:'.$primaryColor.';	
				}
				
				.pm-comment {
   					 border-top: 1px solid '.$primaryColor.';
				}
				
				.pm-home-news-post-container h2 a:hover {
					color:'.$primaryColor.' !important;
				}	
				
				.pm-menu-divider {
					border-top: 3px dotted '.$primaryColor.';
				}
				
				.pm-footer-scroll-up-btn:hover {
					background-color:'.$primaryColor.';
				}
				
				.pm-services-tab-system-desc-expander {
					background-color: '.$offsetColor.';		
				}
				
				.pm-services-tab-system-desc-expander:hover {
					background-color:'.$primaryColor.';	
				}				
				
				.pm-home-news-post-read-more:hover {
					color: '.$primaryColor.' !important;
				}
				
				.pm-home-news-post-category {
					background-color: '.$primaryColor.';
				}
				
				.pm-home-news-post-category:hover {
					background-color: '.$offsetColor.';	
				}
				
				.pm-gallery-post-details-divider {
					border-top: 2px dotted '.$primaryColor.';		
				}
				
				.pm-gallery-post-details-btns li a {
					background-color:'.$primaryColor.';
				}
				
				.pm-gallery-post-details-btns li a:hover {
					background-color:'.$offsetColor.' !important;
				}
				
				.pm-gallery-post-details .desc a {
					color:'.$primaryColor.';
				}
				
				.pm-gallery-post-like-box {
					color:'.$offsetColor.';
				}
				
				.pm-gallery-post-like-box:hover {
					color:'.$primaryColor.';
				}
				
				.pm-staff-member-system-bio-view-profile {
					color: '.$secondaryColor.' !important;	
				}
				
				.pm-timeline-controller-bullet {
					background-color:'.$primaryColor.';	
				}
				
				.pm-staff-member-system-profile-image {
					border: 9px solid '.$secondaryColor.';	
				}
				
				.pm-staff-member-system-controls-btn {
					color:'.$secondaryColor.';		
				}
				
				blockquote {
				  border-left: 10px solid '.$primaryColor.';
				}
				blockquote:before {
				  color: '.$primaryColor.';
				}
				
				.pm-staff-member-system-bio-divider-dotted {
					border-top:1px dotted '.$offsetColor.';
				}
								
				.pm-divider-left, .pm-divider-right {
					background-color:'.$primaryColor.';
				}
				
				.pm-staff-member-system-controls-btn:hover {
					color:'.$offsetColor.';	
				}
				
				.pm-post-navigation li:hover {
					background-color:'.$primaryColor.';
				}
								
				.pm-sub-navigation a i:hover {
					color:'.$primaryColor.';
				}
				
				.pm-divider-icon {
					color:'.$primaryColor.';	
				}
				
				.pm-pricing-table-title-container {
    				background-color:'.$offsetColor.';
				}
				
				.pm-pricing-table-container {
					background-color:'.$secondaryColor.';	
				}
				
				.pm-pricing-table-pricing-container .price, .pm-pricing-table-purchase-container a {
					color:'.$secondaryColor.';	
				}
				
				.pm-pricing-table-details-container .title {
					color:'.$primaryColor.' !important;
				}
				
				.pm-pricing-table-details-container .sub-title {
					color:'.$secondaryColor.';
				}
				
				.pm-pricing-table-featured-icon i {
					color:'.$secondaryColor.';	
				}
								
				.pm_textarea, .pm_text_field {
					background-color:'.$secondaryColor.';
					border:1px solid '.$offsetColor.';
				}
				
				.pm_textarea:focus, .pm_text_field:focus {
					background-color:'.$primaryColor.';
				}
				
				.flexslider .flex-next, .flexslider .flex-prev {
					background-color:rgba('.$primaryColors[0].', '.$primaryColors[1].', '.$primaryColors[2].', .95);
				}
				
				.flexslider .flex-next:hover, .flexslider .flex-prev:hover {
					background-color:'.$secondaryColor.';	
				}
				
				a:hover {
					color:'.$primaryColor.';
				}
				
				.pm-home-news-post-date i, .pm-home-news-post-twitter, .pm-home-news-post-read-more i {
					color: '.$primaryColor.';	
				}
				
				.pm-main-menu-list li a:hover {
					color:'.$secondaryColor.' !important;	
				}
				
				.pm-slider-scroll-down-btn {
					border: 2px solid '.$primaryColor.';	
					background-color:'.$offsetColor.';	
				}
								
				.pm-dots span.pm-currentDot {
					background-color: '.$primaryColor.';
				}
				
				.pm-dots span:hover {
					background-color: '.$primaryColor.';	
				}
				
				.pm-news-post-like-box {
					background-color:'.$primaryColor.';
				}
				
				.pm-news-post-like-box:hover {
					background-color:'.$secondaryColor.';	
				}
				
				.pm-news-post-category, .pm-home-news-post-category {
					background-color: '.$primaryColor.';
				}
				
				.pm-news-post-category:hover {
					background-color: '.$offsetColor.';	
				}
				
				.pm-news-post-date i {
					color:'.$primaryColor.';	
				}
				
				.pm-news-post-btn {
					color:'.$primaryColor.';	
				}
				
				.pm-news-post-btn-mobile {
					color:'.$primaryColor.';	
				}
				
				.pm-fat-footer-title span {
					color:'.$primaryColor.';
				}
				
				.pm-social-navigation li a {
					border: 2px solid '.$offsetColor.';	
				}
				
				.pm-social-navigation li a:hover {
					background-color:'.$offsetColor.';
				}
				
				.pm-home-newsletter-field:focus {
					background-color:'.$primaryColor.';
					border:1px solid '.$primaryColor.';
				}
				
				.pm-footer-copyright p {
					color:'.$primaryColor.';
				}
				
				.pm-footer-scroll-up {
					border-top:3px solid '.$primaryColor.';
				}
					
				.pm-footer-scroll-up-btn {
					border:2px solid '.$primaryColor.';
					background-color:'.$offsetColor.';
				}				
						
				.pm-home-newsletter-btn:hover {
					color:'.$offsetColor.' !important;	
				}
								
				.pm-header-social-icons li a {
					color:'.$primaryColor.';	
				}
				
				.pm-sidebar .pm-widget h6 span, .widget.woocommerce > h6 span {
					color:'.$primaryColor.';		
				}
				
				.pm-sidebar-title-border {
					background-color:'.$primaryColor.';		
				}
				
				.pm-recent-post-btn {
					color:'.$primaryColor.';
				}
				
				.pm-sidebar .pm-widget .tagcloud a, .pm-sidebar .tagcloud a {
					background-color:'.$primaryColor.';
				}
				
				.pm-sidebar .pm-widget .tagcloud a:hover, .pm-sidebar .tagcloud a:hover {
					color:white;
					background-color:'.$offsetColor.' !important;
				}
				
				.pagination_multi li {
					background-color: '.$primaryColor.';
					border-color:'.$primaryColor.';
					color:white !important;
				}
				
				.pagination_multi a li:hover {
					background-color: '.$primaryColor.' !important;
					border-color:'.$primaryColor.' !important;
					color:white !important;
				}
				
				.pm-tweet-list ul li:before, .pm-tweet-list ul li a {
					color: '.$primaryColor.';
				}
				
				.owl-item .pm-brand-item span {
					background-color:'.$primaryColor.';			
				}
				
				.btn.pm-owl-next, .btn.pm-owl-prev {
					color:'.$primaryColor.'	
				}
				
				.btn.pm-owl-next:hover, .btn.pm-owl-prev:hover {
					color:'.$secondaryColor.'	
				}
				
				.pm-rounded-btn.cta-btn {
					background-color:'.$primaryColor.';			
				}
				
				.pm-rounded-btn.cta-btn:hover {
					background-color:'.$secondaryColor.' !important;
				}
				
				.panel-title i {
					background-color:'.$secondaryColor.';		
				}
				
				.panel-title > a:hover {
					background-color:'.$secondaryColor.' !important;	
					color:white !important;	
				}
				
				.pm-sidebar .widget_categories ul a:before, .pm-sidebar .widget_archive ul a:before, .pm-sidebar .widget_meta ul a:before, .pm-sidebar .widget_pages ul a:before, .widget_recent_entries .pm-widget-spacer ul a:before, .pm-sidebar .widget_meta ul li:before, .pm-sidebar .widget_archive ul li:before, .pm-sidebar .widget_pages ul li:before {
					color:'.$primaryColor.';	
				}
				
				
				.pm-comment-form-textarea {
					border-bottom:3px solid '.$primaryColor.';
				}
				
				.pm-comment-form-textfield:focus, .pm-comment-form-textarea:focus {
					background-color:'.$primaryColor.' !important;
					color:white !important;	
				}
				
				.pm-related-blog-posts .pm-date i {
					color:'.$primaryColor.';		
				}
				
				.pm-square-btn:hover, .comment-reply-link:hover {
					background-color:'.$offsetColor.';
					border:3px solid '.$offsetColor.';
				}
				
				.form-submit .submit:hover {
					background-color: '.$offsetColor.';
   					border: 3px solid '.$offsetColor.';
					color:white !important;
				}
				
				.pm-author-divider {
					background-color:'.$dividerColor.';
				}
				
				ul li:before {
					content: "\\'.$ulListIcon.'";
					color:'.$ulListIconColor.';
				}
				
				a {
					color:'.$primaryColor.';
				}
				
				.pm-twitter-feed-bullets li a.active { 
					color:'.$primaryColor.';
				}
				
				.pm-dropmenu-active ul {
					background-color:'.$primaryColor.';	
				}
				
				.pm-twitter-news-list li:before {
					color:'.$primaryColor.';	
				}
				
				.pm-twitter-news-list li .tweet a {
					color:'.$primaryColor.';		
				}
				
				.pm-twitter-news-list li .interact a:hover {
					color:'.$primaryColor.';		
				}
				
				.service:hover .circle {
				  box-shadow: 0 0 0 5px '.$primaryColor.' inset;
				}
				.team:hover {
					background-color:'.$primaryColor.';	
				}
				
				.pm-form-textfield:focus, .pm-form-textarea:focus {
					background-color:'.$primaryColor.';	
					border:1px solid '.$primaryColor.';	
				}
				
				.portfolio .overlay {
					background: rgba('.$primaryColors[0].', '.$primaryColors[1].', '.$primaryColors[2].', 0.8) none repeat scroll 0 0;
				}
				
				.hostingicon i {
					background-color:'.$primaryColor.';	
				}
				
				.service .circle .fa {
					color: '.$primaryColor.';
				}
				
				.button, .tp-button {
					background-color: '.$primaryColor.';
				}
				
				.hostingborder {
					background-color:'.$dividerColor.';		
				}
				
				.pm-widget-footer .tweet_list li a {
					color:'.$primaryColor.';	
				}
				#pm_marker_tooltip { 
					background-color:'.$tooltipColor.';
				}
				#pm_marker_tooltip.pm_tip_arrow_top:after {
					border-left: 6px solid transparent;
					border-right: 6px solid transparent;
					border-top: 6px solid '.$tooltipColor.';
				}
				
				#pm_marker_tooltip.pm_tip_arrow_bottom:after {
					border-left: 8px solid transparent;
					border-right: 8px solid transparent;
					border-bottom: 8px solid '.$tooltipColor.';
				}
				.pm-blog-post-category-container a, .pm-blog-post-read-more-btn {
					background-color:'.$primaryColor.';	
				}
				.pm-blog-post-category-container a:hover, .pm-blog-post-read-more-btn:hover {
					background-color:'.$secondaryColor.';	
				}
				.pm-sticky-post-icon {
					background-color:'.$primaryColor.';		
				}
				.pm-blog-post-category-divider, .pm-blog-post-category-divider-bottom {
					background-color:'.$primaryColor.';			
				}
				.pm-blog-post-img-container {
					border-left: 2px solid '.$primaryColor.';
				}
				.pm-blog-post-meta-info-list li i {
					color:'.$primaryColor.';		
				}
				.pm-blog-post-excerpt a:hover {
					color:'.$secondaryColor.';	
				}
				.pm-blog-post-excerpt a {
					color:'.$primaryColor.';		
				}
				.pm-blog-post-social-share-list li a {
					border: 1px solid '.$primaryColor.';
					color: '.$primaryColor.';
				}
				.pm-blog-post-social-share-list li a:hover {
					background-color: '.$primaryColor.';
				}
				
				.pm-author-name {
					color: '.$primaryColor.';
				}
				
				.pm-author-title {
					color:'.$primaryColor.';
				}
				
				.pm-author-bio-img-bg {
					border:5px solid '.$primaryColor.';
				}
				
				.pm-single-post-tags-list li i {
					color:'.$primaryColor.';	
				}
				
				.pm-single-post-tags-list li:after {
					color:'.$primaryColor.';		
				}
				
				.pm-single-post-social-icons li a {
					border: 2px solid '.$primaryColor.';
					color:'.$primaryColor.';
				}
				
				.pm-single-post-social-icons li a:hover {
					background-color: '.$offsetColor.';
					border: 2px solid '.$offsetColor.';
				}
				
				.pm-breadcrumbs li a:hover {
					color:'.$primaryColor.';
				}
				.pm-primary {
					color: '.$primaryColor.';	
				}
				.pm-secondary {
					color: '.$secondaryColor.';	
				}
				.pm-sidebar .tagcloud a:hover {
					background-color: '.$primaryColor.';	
				}
				.pm-sidebar-search-container i {
					color: '.$primaryColor.';
				}
				.pm-sidebar-search-container {
					border: 1px solid '.$dividerColor.';
				}
				.pm_quick_contact_submit {
					color:white !important;
					background-color: '.$primaryColor.';	
				}
				.pm_quick_contact_submit:hover {
					background-color: '.$offsetColor.' !important;	
				}
				.pm-widget-footer .tagcloud a:hover {
					background-color: '.$offsetColor.' !important;		
					color:white !important;
				}
				.pm-recent-blog-posts .pm-date-published {
					color: '.$primaryColor.';		
				}	
				.pm-widget-footer .pm-recent-blog-post-details a {
					color: '.$primaryColor.';		
				}
				.pm-widget-footer .pm-recent-blog-post-details a:hover {
					color: '.$offsetColor.';		
				}
				.pm-widget-footer .pm-recent-blog-post-details .pm-date i {
					color:'.$offsetColor.';		
				}
				.pm-recent-blog-post-divider {
					background-color:'.$primaryColor.';		
				}
				.tweet_list li:before {
					color: '.$primaryColor.';		
				}
				.pm-widget-footer .tweet_list li a {
					color: '.$primaryColor.';
				}
				.pm-fat-footer-title {
					border-right:13px solid '.$primaryColor.';
				}
				.pm-fat-footer-title-border {
					background-color:'.$primaryColor.';
				}
				.pm-fat-footer-title-divider {
					background-color:'.$primaryColor.';
				}
				.pm-pagination li.current {
					background-color: '.$primaryColor.';
				}
				.pm-pagination li:hover {
					background-color: '.$primaryColor.';
				}
				.pm_quick_contact_field, .pm_quick_contact_textarea {
					border: 1px solid '.$primaryColor.';		
				}
				
				.pm_quick_contact_field.invalid_field, .pm_quick_contact_textarea.invalid_field {
					background-color:'.$primaryColor.';
					color:white;	
				}
				
				.pm_quick_contact_field:focus, .pm_quick_contact_textarea:focus {
					background-color: '.$primaryColor.';
					border:1px solid '.$primaryColor.';
				}
				.pm-post-navigation li a {
					background-color: '.$primaryColor.';	
				}
				.pm-post-navigation li a:hover {
					background-color: '.$secondaryColor.';	
				}
				.pm-single-post-tags .tags {
					color:'.$primaryColor.';
				}
				.pm-single-post-tags .tags a:hover {
					color:'.$primaryColor.';	
				}
				.pm-fat-footer a {
					color:'.$primaryColor.';	
				}
				.pm-main-nav li:hover {
					border-bottom:1px solid '.$primaryColor.';	
				}
				.social a:hover {
					color:'.$primaryColor.';	
				}
				.pm-main-nav li:hover:after {
					background-color:'.$primaryColor.';
				}
				#portfolio-list li .more {
					background: '.$primaryColor.' none repeat scroll 0 0;
					border: 2px solid '.$primaryColor.';
				}
				.feature-box > .fa {
					color: '.$primaryColor.';
				}
				.overlay-pat {
					background: rgba(0, 0, 0, 0) url("'. get_template_directory_uri() .'/img/assets/pat-dark-2.png") repeat scroll 0 0;
				}
				.service .circle:before {
					background-color:'.$primaryColor.';	
				}
				.bullets li.active a {
					background-color:'.$primaryColor.';	
				}
				.testimonial .info em {
					color: '.$primaryColor.';	
				}
				.skill .bar .value {
					background-image:url('.get_template_directory_uri().'/img/assets/skill-sprite.png);
				}
				.skill .bar .value {
					background-color: '.$primaryColor.';
				}
				.milestone .milestone-value {
					color: '.$primaryColor.';	
				}
				.portfolio-filter .filter.active, .portfolio-filter li.active a {
					background-color: '.$primaryColor.';
					color:white;		
				}
				.pm-dropdown.pm-categories-menu .pm-menu-title {
					color:'.$primaryColor.';
				}
				.pm-dropdown.pm-categories-menu .pm-dropmenu-active ul li:hover {
					background-color:'.$primaryColor.';
					border:3px solid '.$primaryColor.';
				}
				.pm-related-blog-posts a:hover {
					color:'.$primaryColor.';
				}
				.pm-dropdown.pm-categories-menu .pm-dropmenu i {
					color:'.$primaryColor.';
				}
				.pm-comment-form-textfield {
					border-bottom:3px solid '.$primaryColor.';	
				}
				.tweet_list li a {
					color:'.$primaryColor.' !important;
				}
				
				.pm-rounded-btn:hover {
					background-color:'.$offsetColor.' !important;	
				}
				.pm-nav-tabs {
					border-bottom: 1px solid '.$dividerColor.';	
				}
				.pm-nav-tabs > li.active > a, .pm-nav-tabs > li.active > a:hover, .pm-nav-tabs > li.active > a:focus {
					background-color:'.$primaryColor.';	
					color:white !important;
				}
				.pm-nav-tabs > li > a {
					background-color:'.$secondaryColor.';		
				}
				
				.pm-nav-tabs > li > a:hover {
					background-color:'.$primaryColor.';	
					color:white !important;	
				}
				
				.pm-newsletter-submit-btn {
					background-color:'.$primaryColor.';	
				}
				
				.pm-newsletter-submit-btn:hover {
					color:white !important;
					background-color:'.$secondaryColor.';
				}
				
				.pm-newsletter-form-container input[type="text"]:focus {
					background-color:'.$primaryColor.';	
					color:white !important;
				}
				
				.pm-single-testimonial-shortcode .name, .pm-single-testimonial-shortcode .title, .pm-single-testimonial-shortcode .date {
					color:'.$primaryColor.';		
				}
				
				#project-container .project-content .title {
					color:'.$secondaryColor.';			
				}

				.pm-newsletter-form-container input[type="text"] {
					border: 1px solid '.$primaryColor.';
					color:'.$primaryColor.';
				}
				
				.pm-single-testimonial-img-bg {
					border: 5px solid '.$primaryColor.';
				}
				
				.pm-icon-bundle {
					background-color:'.$primaryColor.';		
				}
				
				.pm-icon-bundle:hover {
					background-color: '.$secondaryColor.';	
					border-color: '.$secondaryColor.';	
				}
				
				.pm-cta-message {
					border-left:5px solid '.$primaryColor.';			
				}

				.pm-form-submit-btn {
					background-color:'.$primaryColor.';		
				}
				
				.pm-boxed-mode {
					background-color:'.$boxedModeContainerColor.';
				}

			';
			
					
			//Header Options & Colors
			$mainNavBackgroundColor = get_option('mainNavBackgroundColor', '#1c1c1c');
			$mainNavBackgroundColors = moxie_theme_hex2rgb($mainNavBackgroundColor);		
			$getMainNavBgOpacity = get_theme_mod('mainNavBgOpacity', 80);
			$mainNavBgOpacity = $getMainNavBgOpacity / 100;
			$mobileNavToggleColor = get_option('mobileNavToggleColor', '#fa2d65');
			$subpageHeaderBackgroundColor = get_option('subpageHeaderBackgroundColor', '#7c7c7c');
			$menuBorderColor = get_option('menuBorderColor', '#353535');
			$headerPadding = get_theme_mod('headerPadding', 5);
			$getHeaderOpacity = get_theme_mod('headerOpacity', 80);
			$headerOpacity = $getHeaderOpacity / 100;
			$headerBackgroundColor = get_option('headerBackgroundColor', '#000000');
			$headerBackgroundColors = moxie_theme_hex2rgb($headerBackgroundColor);
			
			echo '				
				
				header {
					padding: '.$headerPadding .'px 0;	
					background-color: rgba('.$headerBackgroundColors[0].', '.$headerBackgroundColors[1].', 0'.$headerBackgroundColors[2].', '.$headerOpacity.');	
				}
						
				.pm-float-menu-container {
					background-color:rgba('.$primaryColors[0].', '.$primaryColors[1].', '.$primaryColors[2].', '.$mainNavBgOpacity.');	
				}
				
				.pm-mobile-global-menu {
					background-color: rgba('.$mainNavBackgroundColors[0].', '.$mainNavBackgroundColors[1].', 0'.$mainNavBackgroundColors[2].', '.$mainNavBgOpacity.');	
					border-left: 1px solid '.$menuBorderColor.';	
				}
				
				.pm-mobile-global-menu {
					border-left: 1px solid '.$menuBorderColor.';	
				}
				
				.sf-menu a:hover {
					background-color:'.$primaryColor.' !important;	
				}
				
				.sf-menu a.active {
					background-color:'.$primaryColor.';	
				}
				
				.pm-search-field-mobile {
					border-top:1px solid '.$menuBorderColor.';		
				}
				
				.sf-menu li {
					border-top: 1px solid '.$menuBorderColor.';	
				}
				
				.sf-menu li:last-child {
					border-bottom: 1px solid '.$menuBorderColor.';	
				}
				
				.pm-header-menu-btn i {
					color: '.$mobileNavToggleColor.';
				}
				.pm-subheader-container {
					background-color: '.$subpageHeaderBackgroundColor.';	
				}
			';
			
			//Sub-header options
			$globalHeaderImage = get_theme_mod('globalHeaderImage', '');
			$globalHeaderImage2 = get_theme_mod('globalHeaderImage2', '');
			$page_object = get_queried_object();
			$page_id     = get_queried_object_id();
			$pageHeaderImage = get_post_meta($page_id, 'pm_header_image_meta', true); 

			if( post_type_exists( 'post_staff' ) ){
				
				$pm_staff_header_image_meta = get_post_meta(get_the_ID(), 'pm_staff_header_image_meta', true); 
				
				echo '	
						.pm-subheader-container.page-header-staff-image {
							background-image:url('.esc_url($pm_staff_header_image_meta).');	
						}
				';
				
			}
			
			if( post_type_exists( 'post_galleries' ) ){
				
				$pm_gallery_header_image_meta = get_post_meta(get_the_ID(), 'pm_gallery_header_image_meta', true); 
				
				echo '	
						.pm-subheader-container.page-header-gallery-image {
							background-image:url('.esc_url($pm_gallery_header_image_meta).');	
						}
				';
				
			}
			
			
			
			if( function_exists( 'is_shop' ) ) :
			
				if( is_shop() ) :
				
					$pageid = get_option('woocommerce_shop_page_id');
					$pageHeaderImage = get_post_meta($pageid, 'pm_header_image_meta', true);
					
					if($pageHeaderImage){
					
						echo '
								
							.pm-subheader-container.woocomm_image {
								background-image:url('.esc_url($pageHeaderImage).');	
							}
						
						';
						
					}
				
				endif;
				
				if( is_product_category() || is_product_tag() ) :
				
					$wooCategoryHeaderImage = get_theme_mod('wooCategoryHeaderImage'); 
					
					if($wooCategoryHeaderImage){
					
						echo '
								
							.pm-subheader-container.woocomm_image {
								background-image:url('.esc_url($wooCategoryHeaderImage).');	
							}
						
						';
						
					}
				
				endif;
				
				if( is_product() ) :
				
					$wooSingleProductHeaderImage = get_theme_mod('wooSingleProductHeaderImage'); 
					
					if($wooSingleProductHeaderImage){
					
						echo '
								
							.pm-subheader-container.woocomm_image {
								background-image:url('.esc_url($wooSingleProductHeaderImage).');	
							}
						
						';
						
					}
				
				endif;
			
			endif;
			
			
			if($pageHeaderImage){
				
				echo '
					.pm-subheader-container.page-header-image {
						background-image:url('.esc_url(esc_html($pageHeaderImage)).');	
					}
				';
				
			}	
			
			
			if($globalHeaderImage){
				
				echo '
					.pm-subheader-container.global-image-1 {
						background-image:url('.esc_url(esc_html($globalHeaderImage)).');	
					}
				';
				
			}	
			
			if($globalHeaderImage2){
				
				echo '	
					.pm-subheader-container.global-image-2 {
						background-image:url('.esc_url(esc_html($globalHeaderImage2)).');	
					}
				';
				
			}	
			
			
			//Footer Options & Colors
			$fatFooterBackgroundColor = get_option('fatFooterBackgroundColor', '#283339');
			$fatFooterBackgroundImage = get_theme_mod('fatFooterBackgroundImage');
			$footerBackgroundColor = get_option('footerBackgroundColor', '#00D6FF');
			$fatFooterPadding = get_theme_mod('fatFooterPadding', 100);
						
			echo '
				.pm-fat-footer {
					background-color:'.$fatFooterBackgroundColor.';	
					padding:'.$fatFooterPadding.'px 0;	
					'.( $fatFooterBackgroundImage !== '' ? 'background-image:url('.$fatFooterBackgroundImage.')' : '' ).'
				}
				footer {
					background-color:'.$footerBackgroundColor.';	
				}
			';
			
			//Shortcode options
			$accordionContentBgColor = get_option('accordionContentBgColor', '#f7f7f7');
			$tabContentBgColor = get_option('tabContentBgColor', '#f7f7f7');
			$quote_box_color = get_option('quote_box_color', '#0DB7C4');
			$data_table_title_color = get_option('data_table_title_color', '#306173');
			$data_table_info_color = get_option('data_table_info_color', '#e0e0e0');
			$timetable_font_color = get_option('timetable_font_color', '#ffffff');
			$timetable_border_color = get_option('timetable_border_color', '#cccccc');
			$pricing_table_font_color = get_option('pricing_table_font_color', '#ffffff');
			
			echo '
			
				.pm-pricing-table-pricing-container .price, .pm-pricing-table-pricing-container .desc, .pm-pricing-table-details-container .sub-title, .pm-pricing-table-details-info, .pm-pricing-table-purchase-container a, .pm-pricing-table-pricing-container .price sub {
					color:'.$pricing_table_font_color.' !important;
				}
				
				.pm-pricing-table-purchase-container p {
					color:'.$primaryColor.' !important;	
				}
				
				.pm-pricing-table-featured-icon {
					border: 2px solid '.$offsetColor.';	
				}
				
				.pm-pricing-table-container ul li.active {
					border-left:5px solid '.$primaryColor.';
				}
				
				.pm-pricing-table-container ul li {
					border-left: 5px solid '.$offsetColor.';	
				}
				
				.pm-pricing-table-container ul {
					border-top:1px dotted '.$primaryColor.';
					border-bottom:1px dotted '.$primaryColor.';
				}
			
				.pm-workshop-table-title {
					background-color:'.$data_table_title_color.';	
				}
				.pm-workshop-table-content {
					background-color:'.$data_table_info_color.';		
				}
			
				.pm-tab-content {
					background-color:'.$tabContentBgColor.';	
				}
				
				.panel-collapse {
					background-color:'.$accordionContentBgColor.';	
				}
				.pm-single-testimonial-box:before {
					border-top: 8px solid '.$quote_box_color.';
				}
				.pm-single-testimonial-box {
					background-color:'.$quote_box_color.';		
				}
				.pm-timetable-panel-content-body ul li, .pm-timetable-panel-title a, .pm-timetable-accordion-panel .pm-timetable-panel-heading a.pm-accordion-horizontal-open {
					color:'.$timetable_font_color.';	
				}
				.pm-timetable-panel-content-body ul li {
					border-bottom: 1px solid '.$timetable_border_color.';
				}
			';
			
			//Alert options
			$alert_success_color = get_option('alert_success_color', '#2c5e83');
			$alert_info_color = get_option('alert_info_color', '#cbb35e');
			$alert_warning_color = get_option('alert_warning_color', '#ea6872');
			$alert_danger_color = get_option('alert_danger_color', '#5f3048');
			$alert_notice_color = get_option('alert_notice_color', '#49c592');
			
			echo '
				.alert-warning {
					background-color:'.$alert_warning_color.';	
				}
				
				.alert-success {
					background-color:'.$alert_success_color.';	
				}
				
				.alert-danger {
					background-color:'.$alert_danger_color.';	
				}
				
				.alert-info {
					background-color:'.$alert_info_color.';	
				}
				
				.alert-notice {
					background-color:'.$alert_notice_color.';	
				}
	
			';
			
			//Post options
			$authorBackgroundImage = get_theme_mod('authorBackgroundImage', '');
			$commentsBackgroundImage = get_theme_mod('commentsBackgroundImage', '');
			$authorCommentsBgColor = get_option('authorCommentsBgColor', '#29343A');
						
			echo '
				.pm-author-container {
					'. ($authorBackgroundImage !== '' ? 'background-image:url('.$authorBackgroundImage.')' : '') .';
					background-color:'.$authorCommentsBgColor.';
				}
				.pm-comments-container {
					'. ($commentsBackgroundImage !== '' ? 'background-image:url('.$commentsBackgroundImage.')' : '') .';
					background-color:'.$authorCommentsBgColor.';
				}
			';
					
			//Pulse slider options
			$pulseSliderBtnColor = get_option('pulseSliderBtnColor', '#ffffff');
			
			$getbuttonBGOpacity = get_theme_mod('buttonBGOpacity', 0);
			$buttonBGOpacity = $getbuttonBGOpacity / 100;
			
			$pulseSliderBtnBgColor = get_option('pulseSliderBtnBgColor', '#000000');
			$pulseSliderBtnBgColors = moxie_theme_hex2rgb($pulseSliderBtnBgColor); //Array of colors R,G,B
			
			$floatNavAboveSubHeaderMobile = get_theme_mod('floatNavAboveSubHeaderMobile', 'off');
			
			echo '
				.pm-slider-btn-faceflip-top, .pm-slider-btn-faceflip-bottom {
					border: 3px solid '.$pulseSliderBtnColor.';
					background-color:rgba('.$pulseSliderBtnBgColors[0].','.$pulseSliderBtnBgColors[1].','.$pulseSliderBtnBgColors[2].', '. esc_attr($buttonBGOpacity) .');
				}
				
				.pm-slide-btn p {
					color:'.$pulseSliderBtnColor.';	
					
				}
			';
			
			if($floatNavAboveSubHeaderMobile === 'on') {
				
				echo '
					@media only screen and (max-width: 767px) {
						header {
							position:relative !important;	
							padding-bottom:30px !important;	
						}
					}
				';
				
			}
			
			$displaySubHeader = get_theme_mod('displaySubHeader', 'on');
			
			if($displaySubHeader === 'off') :
				echo '
					header {
						position:relative;	
					}
				';
			endif;
						
		 ?>
	</style>
    
    <?php
}


/* Cache customizer */
function moxie_theme_customizer_styles_cache() {
	
	global $wp_customize;

	// Check we're not on the Customizer.
	// If we're on the customizer then DO NOT cache the results.
	if ( ! isset( $wp_customize ) ) {

		// Get the theme_mod from the database
		$data = get_theme_mod( 'my_customizer_styles', false );

		// If the theme_mod does not exist, then create it.
		if ( $data == false ) {
			// We'll be adding our actual CSS using a filter
			$data = apply_filters( 'my_styles_filter', null );
			// Set the theme_mod.
			set_theme_mod( 'my_customizer_styles', $data );
		}

	// If we're not on the customizer, get all the styles using our filter
	} else {

		$data = apply_filters( 'my_styles_filter', null );

	}

	// Add the CSS inline.
	// Please note that you must first enqueue the actual 'my-styles' stylesheet.
	// See http://codex.wordpress.org/Function_Reference/wp_add_inline_style#Examples
	wp_add_inline_style( 'pm-ln-customizer-css', $data );

}


/* Reset the cache when saving the customizer */
function moxie_theme_reset_style_cache_on_customizer_save() {
	remove_theme_mod( 'my_customizer_styles' );
}