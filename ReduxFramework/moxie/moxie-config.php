<?php

/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://docs.reduxframework.com
 * */

if (!class_exists('Redux_Framework_sample_config')) {

    class Redux_Framework_sample_config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (  true == Redux_Helpers::isTheme(__FILE__) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            //$this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            //add_action( 'redux/loaded', array( $this, 'remove_demo' ) );
            
            // Function to test the compiler hook and demo CSS output.
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 3);
            
            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
            
            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );
            
            // Dynamically add a section. Can be also used to modify sections/fields
            //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**

          This is a test function that will let you see when the compiler hook occurs.
          It only runs if a field set with compiler=>true is changed.

         * */
        function compiler_action($options, $css, $changed_values) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r($changed_values); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

            /*
              // Demo of how to use the dynamic CSS and write your own static CSS file
              $filename = dirname(__FILE__) . '/style' . '.css';
              global $wp_filesystem;
              if( empty( $wp_filesystem ) ) {
                require_once( ABSPATH .'/wp-admin/includes/file.php' );
              WP_Filesystem();
              }

              if( $wp_filesystem ) {
                $wp_filesystem->put_contents(
                    $filename,
                    $css,
                    FS_CHMOD_FILE // predefined mode settings for WP files
                );
              }
             */
        }

        /**

          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.

          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons

         * */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => __('Section via hook', 'moxietheme'),
                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'moxietheme'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }

        /**

          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

         * */
        function change_arguments($args) {
            //$args['dev_mode'] = true;

            return $args;
        }

        /**

          Filter hook for filtering the default value of any given field. Very useful in development mode.

         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }

        public function setSections() {

            /**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url    = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns        = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode('.', $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'moxietheme'), $this->theme->display('Name'));
            
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview', 'moxietheme'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview', 'moxietheme'); ?>" />
                <?php endif; ?>

                <h4><?php echo $this->theme->display('Name'); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'moxietheme'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'moxietheme'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', 'moxietheme') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
            <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.', 'moxietheme') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'moxietheme'), $this->theme->parent()->display('Name'));
            }
            ?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            if (file_exists(dirname(__FILE__) . '/info-html.html')) {
                /** @global WP_Filesystem_Direct $wp_filesystem  */
                global $wp_filesystem;
                if (empty($wp_filesystem)) {
                    require_once(ABSPATH . '/wp-admin/includes/file.php');
                    WP_Filesystem();
                }
                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }

            /***** ACTUAL DECLARATION OF SECTIONS ******/
			      

            // HEADER OPTIONS
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Header Fonts', 'moxietheme'),
			  'heading'   => __('Manage fonts for the header area.', 'moxietheme'),
			  'desc'      => __('<p class="description">Edit fonts for the header area and activate or deactivate the google map for the contact page template.</p>', 'moxietheme'),
			
			  'fields'    => array(
			  
			    //Fields go here
				array(
					'id'            => 'opt-nav-font',
					'type'          => 'typography',
					'title'         => __('Navigation Font', 'moxietheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					//'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
					//'subsets'       => false, // Only appears if google is true and subsets not set to false
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.sf-menu a', '.pm-search-field-mobile'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.sf-menu a', '.pm-search-field-mobile'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the main navigation.', 'moxietheme'),
					'default'       => array(
						'color'         => '#ffffff',
						'font-weight'    => '400',
						'font-family'   => 'Roboto',
						'google'        => true,
						'font-size'     => '14px',
						'line-height'   => '32px'
					),
				),
				  
				array(
					'id'            => 'opt-page-title-font',
					'type'          => 'typography',
					'title'         => __('Page Title', 'moxietheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					//'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
					//'subsets'       => false, // Only appears if google is true and subsets not set to false
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.single-post .pm-subheader-container h2', '.pm-subheader-decription'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.single-post .pm-subheader-container h2', '.pm-subheader-decription'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the Page Title.', 'moxietheme'),
					'default'       => array(
						'color'         => '#0db7c4',
						'font-weight'    => '900',
						'font-family'   => 'Raleway',
						'google'        => true,
						'font-size'     => '36px',
						'line-height'   => '40px',
						'text-transform' => 'uppercase'
					),
				),
				
				
				
				
				
				array(
					'id'            => 'opt-message-font',
					'type'          => 'typography',
					'title'         => __('Page Message', 'moxietheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					//'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
					//'subsets'       => false, // Only appears if google is true and subsets not set to false
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-single-news-post-title-decription', '.pm-subheader-decription'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-single-news-post-title-decription', '.pm-subheader-decription'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the header page message.', 'moxietheme'),
					'default'       => array(
						'color'         => '#FFFFFF',
						'font-weight'    => '300',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'     => '20px',
						'line-height'   => '40px',
					),
				),
				
				
				
				/*array(
					'id'            => 'opt-breadcrumb-font',
					'type'          => 'typography',
					'title'         => __('Breadcrumb Font', 'moxietheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					//'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
					//'subsets'       => false, // Only appears if google is true and subsets not set to false
					//'font-size'     => false,
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-breadcrumbs li', '.pm-breadcrumbs li a'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-breadcrumbs li', '.pm-breadcrumbs li a'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the breadcrumb trail font.', 'moxietheme'),
					'default'       => array(
						'color'         => '#5b5b5b',
						'font-weight'    => '300',
						'font-family'   => 'Raleway',
						'google'        => true,
						'font-size'     => '12px',
						'line-height'   => '24px'
					),
				),*/
				
				array(
					'id'            => 'opt-page-title-date',
					'type'          => 'typography',
					'title'         => __('Post Title Date', 'moxietheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					//'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
					//'subsets'       => false, // Only appears if google is true and subsets not set to false
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-post-title-date'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-post-title-date'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the Page title date.', 'moxietheme'),
					'default'       => array(
						'color'         => '#ffffff',
						'font-weight'    => '900',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'     => '20px',
						'line-height'   => '40px',
						'text-transform' => 'uppercase'
					),
				),
			
			  )//end of fields
			
			);//end of section
			
			// FOOTER OPTIONS
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Footer Fonts', 'moxietheme'),
			  'heading'   => __('Manage fonts for the footer area.', 'moxietheme'),
			  //'desc'      => __('<p class="description">This is the Description. Again HTML is allowed2</p>', 'moxietheme'),
			
			  'fields'    => array(
				  
				//Fields go here
				array(
					'id'            => 'opt-footer-widget-title',
					'type'          => 'typography',
					'title'         => __('Footer Widget Title', 'moxietheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					//'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
					//'subsets'       => false, // Only appears if google is true and subsets not set to false
					//'font-size'     => false,
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-widget-footer h6'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-widget-footer h6'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the Footer Widget Title.', 'moxietheme'),
					'default'       => array(
						'color'         => '#ffffff',
						'font-family'   => 'Raleway',
						'google'        => true,
						'font-size'     => '22px',
						'line-height'   => '30px',
						'font-weight'   => '300',
					),
				),//end of field

				
				array(
					'id'            => 'opt-footer-info-font',
					'type'          => 'typography',
					'title'         => __('Fat Footer Font', 'moxietheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					//'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
					//'subsets'       => false, // Only appears if google is true and subsets not set to false
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					//'color'         => false,
					//'preview'       => false, // Disable the previewer
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-widget-footer p', '.pm-widget-footer .textwidget', '.tweet_list li', '.pm-widget-footer .widget_archive ul li', '.tweet_list li a', '.pm-widget-footer a', '.pm-widget-footer .widget_meta ul li a', 'pm-widget-footer .widget_categories ul li  a', '.pm-widget-footer .widget_rss ul li', '.widget_nav_menu ul li a', '.pm-widget-footer .pm-sidebar-search-field', '.pm-footer-copyright-info'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-widget-footer p', '.pm-widget-footer .textwidget', '.tweet_list li', '.pm-widget-footer .widget_archive ul li', '.tweet_list li a', '.pm-widget-footer a', '.pm-widget-footer .widget_meta ul li a', 'pm-widget-footer .widget_categories ul li  a', '.pm-widget-footer .widget_rss ul li', '.widget_nav_menu ul li a', '.pm-widget-footer .pm-sidebar-search-field', '.pm-footer-copyright-info'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling in the fat footer area.', 'moxietheme'),
					'default'       => array(
						'color'         => '#ffffff',
						'font-weight'    => '300',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '14px',
						'line-height'   => '24px'
					),
				),//end of field


				
				array(
					'id'            => 'opt-footer-tag-font',
					'type'          => 'typography',
					'title'         => __('Footer Tag Font', 'moxietheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					//'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
					//'subsets'       => false, // Only appears if google is true and subsets not set to false
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					//'color'         => false,
					//'preview'       => false, // Disable the previewer
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-widget-footer .tagcloud a'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-widget-footer .tagcloud a'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for social footer area.', 'moxietheme'),
					'default'       => array(
						'color'         => '#ffffff',
						'font-weight'    => '700',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '14px',
					),
				),//end of field
				
			
			  )//end of fields
			
			);//end of section
				
			
			//SHORTCODE OPTIONS
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Shortcode Fonts', 'moxietheme'),
			  'heading'   => __('Manages fonts for particular shortcodes.', 'moxietheme'),
			  //'desc'      => __('<p class="description">This is the Description. Again HTML is allowed2</p>', 'moxietheme'),
			
			  'fields'    => array(
				  
				//Fields go here
				
				/*array(
					'id'            => 'opt-testimonials-quote-font',
					'type'          => 'typography',
					'title'         => __('Testimonials Carousel', 'moxietheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.testimonial p', '.testimonial .info'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.testimonial p', '.testimonial .info'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the testimonials carousel.', 'moxietheme'),
					'default'       => array(
						'color'         => '#ccc',
						'font-weight'    => '500',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'     => '14px',
						'line-height'	=> '50px',
					),
				),//end of field*/

				
				array(
					'id'            => 'opt-countdown-font',
					'type'          => 'typography',
					'title'         => __('Tab and Accordion button font', 'moxietheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.panel-heading .panel-title', '.pm-nav-tabs li a'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.panel-heading .panel-title', '.pm-nav-tabs li a'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the button font styling for the tab and accordion system.', 'moxietheme'),
					'default'       => array(
						'color'         => '#FFFFFF',
						'font-style'	=> 'normal',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '42px',
					),
				),//end of field
				
							
				array(
					'id'            => 'opt-alerts-font',
					'type'          => 'typography',
					'title'         => __('Alerts', 'moxietheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.alert'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.alert'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for Alert shortcode.', 'moxietheme'),
					'default'       => array(
						'color'         => '#FFFFFF',
						'font-style'	=> 'normal',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '14px',
					),
				),//end of field
								
				
				array(
					'id'            => 'opt-pie-chart-font',
					'type'          => 'typography',
					'title'         => __('Pie Chart / Milestone', 'moxietheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-pie-chart .pm-pie-chart-percent', '.pm-pie-chart-description', '.milestone .milestone-description', '.milestone.alt .milestone-description', '.pm-countdown-container', '.milestone .milestone-value'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-pie-chart .pm-pie-chart-percent', '.pm-pie-chart-description', '.milestone .milestone-description', '.milestone.alt .milestone-description', '.pm-countdown-container', '.milestone .milestone-value'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the Pie Chart and Milestone shortcode.', 'moxietheme'),
					'default'       => array(
						'color'         => '#5e5e5e',
						'font-style'	=> 'normal',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'     => '14px',
					),
				),//end of field
				
				
				array(
					'id'            => 'opt-price-table-title-font',
					'type'          => 'typography',
					'title'         => __('Pricing Table Title', 'moxietheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-pricing-table-title-container p'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-pricing-table-title-container p'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the Pricing table shortcode.', 'moxietheme'),
					'default'       => array(
						'color'         => '#ffffff',
						'font-style'	=> 'normal',
						'font-family'   => 'Oswald',
						'google'        => true,
						'font-size'     => '24px',
					),
				),//end of field
				
				array(
					'id'            => 'opt-price-table-font',
					'type'          => 'typography',
					'title'         => __('Pricing Table content', 'moxietheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-pricing-table-pricing-container .desc', '.pm-pricing-table-details-container .title', '.pm-pricing-table-details-container .sub-title', '.pm-pricing-table-purchase-container a', '.pm-pricing-table-purchase-container p', '.pm-pricing-table-pricing-container .price'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-pricing-table-pricing-container .desc', '.pm-pricing-table-details-container .title', '.pm-pricing-table-details-container .sub-title', '.pm-pricing-table-purchase-container a', '.pm-pricing-table-purchase-container p', '.pm-pricing-table-pricing-container .price'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the Pricing table shortcode.', 'moxietheme'),
					'default'       => array(
						'color'         => '#5e5e5e',
						'font-style'	=> 'normal',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'     => '14px',
					),
				),//end of field
				
				array(
					'id'            => 'opt-time-table-font',
					'type'          => 'typography',
					'title'         => __('Time Table Group', 'moxietheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-timetable-panel-title a', '.pm-timetable-accordion-panel .pm-timetable-panel-heading a.pm-accordion-horizontal-open', '.pm-timetable-panel-content-body ul li'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-timetable-panel-title a', '.pm-timetable-accordion-panel .pm-timetable-panel-heading a.pm-accordion-horizontal-open', '.pm-timetable-panel-content-body ul li'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the Time Table Group shortcode.', 'moxietheme'),
					'default'       => array(
						'color'         => '#ffffff',
						'font-style'	=> 'normal',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'     => '14px',
					),
				),//end of field
				
				array(
					'id'            => 'opt-quote-box',
					'type'          => 'typography',
					'title'         => __('Quote Box Font', 'moxietheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-single-testimonial-box p', '.pm-single-testimonial-author-info .name', '.pm-single-testimonial-author-info .title'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-single-testimonial-box p', '.pm-single-testimonial-author-info .name', '.pm-single-testimonial-author-info .title'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the Quote box shortcode.', 'moxietheme'),
					'default'       => array(
						'color'         => '#5f5f5f',
						'font-weight'    => '100',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '14px',
					),
				),//end of field
				
			
			  )//end of fields
			
			);//end of section
			
			
			//WIDGET OPTIONS
			/*$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Widget Options', 'moxietheme'),
			  'heading'   => __('Manage options and font styles for particular widgets.', 'moxietheme'),
			  //'desc'      => __('<p class="description">This is the Description. Again HTML is allowed2</p>', 'moxietheme'),
			
			  'fields'    => array(
				  
				//Fields go here				
				array(
					'id'            => 'opt-classes-date-font',
					'type'          => 'typography',
					'title'         => __('Classes Widget Date', 'moxietheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-widget-class-post-date .month', '.pm-widget-class-post-date .day'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-widget-class-post-date .month', '.pm-widget-class-post-date .day'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the Classes widget info text.', 'moxietheme'),
					'default'       => array(
						'color'         => '#000000',
						'font-weight'    => '300',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'     => '14px',
						'text-transform' => 'uppercase',
						'line-height' => '30px'
					),
				),//end of field
			
			  )//end of fields
			
			);//end of section*/
			
			
			//GLOBAL FONTS
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Global Fonts', 'moxietheme'),
			  'heading'   => __('Manage Global Font Styles.', 'moxietheme'),
			  //'desc'      => __('<p class="description">This is the Description. Again HTML is allowed2</p>', 'moxietheme'),
			
			  'fields'    => array(
				  
				//Fields go here
				
				array(
					'id'            => 'opt-body-font',
					'type'          => 'typography',
					'title'         => __('Body Font', 'moxietheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('body', '.pm-comment-html-tags span', '.pm-home-news-post-title', '.pm-news-post-excerpt', '.pm-news-post-content p'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('body', '.pm-comment-html-tags span', '.pm-home-news-post-title', '.pm-news-post-excerpt', '.pm-news-post-content p'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Update the font styling for the Header 1 tag.', 'moxietheme'),
					'default'       => array(
						'color'         => '#878787',
						'font-weight'    => '300',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '14px',
					),
				),//end of field
				
							
								
				array(
					'id'            => 'opt-header1',
					'type'          => 'typography',
					'title'         => __('H1', 'moxietheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('h1'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('h1'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Update the font styling for the Header 1 tag.', 'moxietheme'),
					'default'       => array(
						'color'         => '#2A5C81',
						'font-weight'    => '300',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '48px',
					),
				),//end of field
				
				array(
					'id'            => 'opt-header2',
					'type'          => 'typography',
					'title'         => __('H2', 'moxietheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('h2'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('h2'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Update the font styling for the Header 2 tag.', 'moxietheme'),
					'default'       => array(
						'color'         => '#595959',
						'font-weight'    => '300',
						'font-family'   => 'Lato',
						'google'        => true,
						'font-size'     => '30px'
					),
				),//end of field
				
				array(
					'id'            => 'opt-header3',
					'type'          => 'typography',
					'title'         => __('H3', 'moxietheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('h3'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('h3'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Update the font styling for the Header 3 tag.', 'moxietheme'),
					'default'       => array(
						'color'         => '#2b5d83',
						'font-weight'    => '100',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '30px'
					),
				),//end of field
				
				array(
					'id'            => 'opt-header4',
					'type'          => 'typography',
					'title'         => __('H4', 'moxietheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('h4'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('h4'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Update the font styling for the Header 4 tag.', 'moxietheme'),
					'default'       => array(
						'color'         => '#ffffff',
						'font-weight'    => '900',
						'font-family'   => 'Oswald',
						'google'        => true,
						'text-transform' => 'uppercase',
						'font-size'     => '30px',
					),
				),//end of field
				
				array(
					'id'            => 'opt-header5',
					'type'          => 'typography',
					'title'         => __('H5', 'moxietheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('h5'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('h5'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Update the font styling for the Header 5 tag.', 'moxietheme'),
					'default'       => array(
						'color'         => '#f6d600;',
						'font-weight'    => '300',
						'font-family'   => 'Lato',
						'google'        => true,
						'font-size'     => '18px',
						'line-height'   => '32px',
						'text-transform' => 'uppercase',
					),
				),//end of field
				
				array(
					'id'            => 'opt-header6',
					'type'          => 'typography',
					'title'         => __('H6', 'moxietheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('h6'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('h6'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Update the font styling for the Header 6 tag.', 'moxietheme'),
					'default'       => array(
						'color'         => '#5f5f5f',
						'font-weight'    => '100',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'line-height'   => '28px'
					),
				),//end of field
				
				array(
					'id'            => 'opt-button-font',
					'type'          => 'typography',
					'title'         => __('Button Font', 'moxietheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-rounded-btn', '#pm-load-more', '.pm-form-submit-btn', '.pm_quick_contact_submit', '.pm-comment-submit-btn', '.comment-reply-link', '.pm-post-nav-btn p', '.pm-staff-member-system-bio-view-profile', '.pm-home-news-post-continue'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-rounded-btn', '#pm-load-more', '.pm-form-submit-btn', '.pm_quick_contact_submit', '.pm-comment-submit-btn', '.comment-reply-link', '.pm-post-nav-btn p', '.pm-staff-member-system-bio-view-profile', '.pm-home-news-post-continue'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for all buttons.', 'moxietheme'),
					'default'       => array(
						'color'         => '#cccccc',
						'font-style'    => 'bold',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'     => '14px',
					),
				),//end of field
				
				array(
					'id'            => 'opt-sidebar-widget-header',
					'type'          => 'typography',
					'title'         => __('Sidebar Widget Title', 'moxietheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-sidebar .pm-widget h6', '.widget.woocommerce > h6'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-sidebar .pm-widget h6', '.widget.woocommerce > h6'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the widget title in the sidebar area.', 'moxietheme'),
					'default'       => array(
						'color'         => '#ffffff',
						'font-weight'    => '500',
						'font-family'   => 'Raleway',
						'google'        => true,
						'font-size'     => '20px',
					),
				),//end of field
				
				array(
					'id'            => 'opt-sidebar-tag-button',
					'type'          => 'typography',
					'title'         => __('Sidebar Tag Font', 'moxietheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-sidebar .tagcloud a', '.pm-sidebar .pm-square-btn.event', '.pm-sidebar .pm-square-btn.class-widget'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-sidebar .tagcloud a', '.pm-sidebar .pm-square-btn.event', '.pm-sidebar .pm-square-btn.class-widget'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing'=> true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the button font styling for the tags widget.', 'moxietheme'),
					'default'       => array(
						'color'         => '#ffffff',
						'font-style'    => 'bold',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'     => '14px',
						'text-transform' => 'uppercase',
						'line-height' => '40px',
						'text-align' => 'center',
					),
				),//end of field
				
				array(
					'id'            => 'opt-sidebar-font',
					'type'          => 'typography',
					'title'         => __('Sidebar Font', 'moxietheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-sidebar .textwidget p', '.pm-sidebar .textwidget', '.pm-tweet-list ul li'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-sidebar .textwidget p', '.pm-sidebar .textwidget', '.pm-tweet-list ul li'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing'=> true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the sidebar area.', 'moxietheme'),
					'default'       => array(
						'color'         => '#626161',
						'font-weight'   => '300',
						'font-family'   => 'Lato',
						'google'        => true,
						'font-size'     => '15px',
					),
				),//end of field
				

				
				/*array(
					'id'            => 'opt-sidebar-meta-font',
					'type'          => 'typography',
					'title'         => __('Sidebar Meta Font', 'moxietheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.widget_recent_entries .pm-widget-spacer ul li span'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.widget_recent_entries .pm-widget-spacer ul li span'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing'=> true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for all links in the sidebar.', 'moxietheme'),
					'default'       => array(
						'color'         => '#9c8d00',
						'font-weight'    => '300',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'     => '12px',
						'line-height'     => '24px',
					),
				),//end of field*/

				
				array(
					'id'            => 'opt-tooltip-font',
					'type'          => 'typography',
					'title'         => __('Tooltip Font', 'moxietheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('#pm_marker_tooltip'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('#pm_marker_tooltip'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the tooltip.', 'moxietheme'),
					'default'       => array(
						'color'         => '#FFFFFF',
						'font-weight'    => '100',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'     => '12px',
					),
				),//end of field
				
				array(
					'id'            => 'opt-undordered-list-font',
					'type'          => 'typography',
					'title'         => __('Unordered List Font', 'moxietheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('ul'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('ul'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the undordered and orderded lists.', 'moxietheme'),
					'default'       => array(
						'color'         => '#5f5f5f',
						'font-weight'   => '100',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '14px',
					),
				),//end of field
				
				array(
					'id'            => 'opt-ordered-list-font',
					'type'          => 'typography',
					'title'         => __('Ordered List Font', 'moxietheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('ol'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('ol'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the undordered and orderded lists.', 'moxietheme'),
					'default'       => array(
						'color'         => '#5f5f5f',
						'font-weight'   => '100',
						'font-family'   => 'Raleway',
						'google'        => true,
						'font-size'     => '14px',
					),
				),//end of field

				
				
				array(
					'id'            => 'opt-block-quote-font',
					'type'          => 'typography',
					'title'         => __('Block Quote Font', 'moxietheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('blockquote', 'blockquote p'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('blockquote', 'blockquote p'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the blockquote tag.', 'moxietheme'),
					'default'       => array(
						'color'         => '#5f5f5f',
						'font-weight'    => '100',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '14px',
					),
				),//end of field
				
				
				array(
					'id'            => 'opt-comment-notification-font',
					'type'          => 'typography',
					'title'         => __('Comments Form Font', 'moxietheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('#cancel-comment-reply-link', '.comment-form p', '.comment-form a', '.pm-comment p', '.pm-comment-box-avatar-container p'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('#cancel-comment-reply-link', '.comment-form p', '.comment-form a', '.pm-comment p', '.pm-comment-box-avatar-container p'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for comment forms.', 'moxietheme'),
					'default'       => array(
						'color'         => '#000000',
						'font-weight'    => '300',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '13px',
					),
				),//end of field


			
			  )//end of fields
			
			);//end of section
			
			
			//POST Fonts
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Post Fonts', 'moxietheme'),
			  'heading'   => __('Manage fonts for News Posts.', 'moxietheme'),
			  //'desc'      => __('<p class="description">This is the Description. Again HTML is allowed2</p>', 'moxietheme'),
			
			  'fields'    => array(
				  
				//Fields go here
				array(
					'id'            => 'opt-post-title-font',
					'type'          => 'typography',
					'title'         => __('Post Title', 'moxietheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-news-post-category', '.pm-home-news-post-category', '.pm-news-post-title', '.pm-related-blog-post-details a', '.pm-recent-blog-post-details a', '.pm-home-news-post-title'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-news-post-category', '.pm-home-news-post-category', '.pm-news-post-title', '.pm-related-blog-post-details a', '.pm-recent-blog-post-details a', '.pm-home-news-post-title'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the post title and category link.', 'moxietheme'),
					'default'       => array(
						'color'         => '#FFFFFF',
						'font-weight'    => 'bold',
						'font-family'   => 'Oswald',
						'google'        => true,
						'font-size'     => '18px',
						'text-transform' => 'uppercase',
						'line-height'   => '24px'
					),
				),//end of field			
							
				
				/*array(
					'id'            => 'opt-post-meta-font',
					'type'          => 'typography',
					'title'         => __('Meta Information Font', 'moxietheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page 
					'output'        => array('pm-blog-post-meta-info-list li', '.pm-single-post-tags .tags a'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('pm-blog-post-meta-info-list li', '.pm-single-post-tags .tags a'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for the post category and tag links.', 'moxietheme'),
					'default'       => array(
						'color'         => '#0db7c4',
						'font-weight'    => '300',
						'font-family'   => 'Oswald',
						'google'        => true,
						'font-size'     => '14px',
						'text-transform' => 'uppercase',
						'line-height'   => '24px'
					),
				),//end of field*/
				
				array(
					'id'            => 'opt-post-sections-font',
					'type'          => 'typography',
					'title'         => __('Post Sections Font', 'moxietheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-post-column-title', '.pm-author-column-title', '#related-posts h4', '.pm-comment-header h3', '.comment-reply-title'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-post-column-title', '.pm-author-column-title', '#related-posts h4', '.pm-comment-header h3', '.comment-reply-title'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for each section on a single post page.', 'moxietheme'),
					'default'       => array(
						'color'         => '#0db7c4',
						'font-weight'    => '300',
						'font-family'   => 'Raleway',
						'google'        => true,
						'font-size'     => '30px',
						'line-height'   => '26px',
					),
				),//end of field
				
				/*array(
					'id'            => 'opt-staff-profile-font',
					'type'          => 'typography',
					'title'         => __('Staff / Gallery post type font', 'moxietheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-staff-profile-name', '.pm-staff-profile-title', '.pm-gallery-item-title p'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-staff-profile-name', '.pm-staff-profile-title', '.pm-gallery-item-title p'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the font styling for name and title in the staff profile post and the title in the Gallery post.', 'moxietheme'),
					'default'       => array(
						'color'         => '#0db7c4',
						'font-weight'	=> 'bold',
						'font-family'   => 'Oswald',
						'google'        => true,
						'font-size'     => '20px',
						'text-transform' => 'uppercase'
					),
				),//end of field*/
									
			
			  )//end of fields
			
			);//end of section
						

			//TwitterFetch
			/*$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Twitter Carousel', 'moxietheme'),
			  'heading'   => __('Twitter Carousel', 'moxietheme'),
			  'desc'      => __('<p class="description">Configure the settings for the twitterFeed shortcode</p>', 'moxietheme'),
			
			  'fields'    => array(
				  
				//Fields go here
				array(
                        'id'        => 'opt-twitter-widget-id',
                        'type'      => 'text',
                        'title'     => __('Twitter Widget ID', 'moxietheme'),
                        'subtitle'  => __('Insert your Twitter Widget ID. <a href="https://www.pulsarmedia.ca/generating-a-twitter-widget-id/">More info</a>', 'moxietheme'),
                        //'desc'      => __('NOTE: if you would like your slider to sit underneath the navigation bar than wrap your shortcode within the "sliderContainer" shortcode.', 'moxietheme'),
                        //'validate'  => 'html',
						'default' => ''
                ),
				
				array(
					'id'       => 'opt-twitter-widget-count',
					'type'     => 'select',
					'title'    => __('Twitter Feed Count', 'moxietheme'), 
					'desc'     => __('Select the number of tweets to display.', 'moxietheme'),
					// Must provide key => value pairs for select options
					'options'  => array(
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5',
						'6' => '6'
					),
					'default'  => '3',
				),
											
			  )//end of fields
			
			);//end of section	*/	
									
			
			//WOOCOMMERCE FONTS
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Woocommerce Fonts', 'localization'),
			  'heading'   => __('Woocommerce Fonts', 'localization'),
			  'desc'      => __('Use this area to manage font styles for the Woocommerce shopping area.', 'localization'),
			
			  'fields'    => array(
			  
			  array(
					'id'            => 'opt-woo-product-archive-title-font',
					'type'          => 'typography',
					'title'         => __('Product Archive Title Font', 'localization'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.woocommerce-loop-product__title'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.woocommerce-loop-product__title'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the product title font on the Woocommerce shop.', 'localization'),
					'default'       => array(
						'color'         => '#7f6631',
						'font-weight'    => '300',
						'font-family'   => 'Raleway',
						'google'        => true,
						'font-size'   => '20px'
					),
				),//end of field
				
				
				array(
					'id'            => 'opt-woo-product-archive-link-font',
					'type'          => 'typography',
					'title'         => __('Product Archive Link Font', 'localization'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.products .product a'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.products .product a'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the product links font on the Woocommerce shop.', 'localization'),
					'default'       => array(
						'color'         => '#00b7c2',
						'font-weight'    => '300',
						'font-family'   => 'Roboto',
						'google'        => true,
						'font-size'   => '14px'
					),
				),//end of field
				
				array(
					'id'            => 'opt-woo-price-font',
					'type'          => 'typography',
					'title'         => __('Price Font', 'localization'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.woocommerce-Price-amount.amount'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.woocommerce-Price-amount.amount'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the product price font - applies to the shop and details page', 'localization'),
					'default'       => array(
						'color'         => '#606060',
						'font-weight'    => '300',
						'font-family'   => 'Roboto',
						'google'        => true,
						'font-size'   => '17px'
					),
				),//end of field
				
				array(
					'id'            => 'opt-woo-product-single-title-font',
					'type'          => 'typography',
					'title'         => __('Product Single Title Font', 'localization'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.product_title'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.product_title'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the product title font on a product item details page.', 'localization'),
					'default'       => array(
						'color'         => '#00b7c2',
						'font-weight'    => '300',
						'font-family'   => 'Roboto',
						'google'        => true,
						'font-size'   => '28px'
					),
				),//end of field

								
				array(
					'id'            => 'opt-woo-tab-title-font',
					'type'          => 'typography',
					'title'         => __('Tab Button Font', 'localization'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.woocommerce-tabs .tabs li a'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.woocommerce-tabs .tabs li a'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the tab title font for Woocommerce tab systems.', 'localization'),
					'default'       => array(
						'color'         => '#232323',
						'font-weight'    => '300',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '24px',
					),
				),//end of field
				
				
				array(
					'id'            => 'opt-woo-tab-title-font2',
					'type'          => 'typography',
					'title'         => __('Tab Title Font', 'localization'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.woocommerce-Tabs-panel > h2', '.woocommerce #reviews #comments h2'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.woocommerce-Tabs-panel > h2', '.woocommerce #reviews #comments h2'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the tab title font for Woocommerce tab systems.', 'localization'),
					'default'       => array(
						'color'         => '#232323',
						'font-weight'    => '300',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '18px',
					),
				),//end of field
				
				
				
				array(
					'id'            => 'opt-woo-form-title-font',
					'type'          => 'typography',
					'title'         => __('Form Title Font', 'localization'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.cart_totals > h2', '.woocommerce-billing-fields > h3', '.woocommerce-additional-fields > h3', '#order_review_heading', '.related.products > h2', '#reply-title'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.cart_totals > h2', '.woocommerce-billing-fields > h3', '.woocommerce-additional-fields > h3', '#order_review_heading', '.related.products > h2', '#reply-title'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the title font for Woocommerce forms.', 'localization'),
					'default'       => array(
						'color'         => '#565656',
						'font-weight'    => '300',
						'font-family'   => 'Roboto',
						'google'        => true,
						'font-size'     => '22px'
					),
				),//end of field
								
				
				array(
					'id'            => 'opt-woo-message-font',
					'type'          => 'typography',
					'title'         => __('Message Font', 'localization'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.woocommerce-message'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.woocommerce-message'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'subtitle'      => __('Updates the pop-up message font throughout Woocommerce sections. (ex. when adding an item to the cart)', 'localization'),
					'default'       => array(
						'color'         => '#383838',
						'font-weight'    => '300',
						'font-family'   => 'Roboto',
						'google'        => true,
						'font-size'   => '14px'
					),
				),//end of field

							
			  )//end of fields
			
			);//end of section
			
			//FORM OPTIONS
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Form Options', 'moxietheme'),
			  'heading'   => __('Form Options', 'moxietheme'),
			  //'desc'      => __('<p class="description">This is the Description. Again HTML is allowed2</p>', 'moxietheme'),
			
			  'fields'    => array(
				  
				//Fields go here
								
				array(
					'id'        => 'opt-first-name-error',
					'type'      => 'text',
					'title'     => __('First Name field error message', 'moxietheme'),
					//'subtitle'  => __('Quickly add some CSS to your theme by adding it to this block.', 'moxietheme'),
					'desc'      => __('Input a custom error message for the First Name field of the contact form.', 'moxietheme'),
					'validate'  => 'no_html',
					'default'   => __('Please fill in your first name.', 'moxietheme'),
				),
				
				array(
					'id'        => 'opt-last-name-error',
					'type'      => 'text',
					'title'     => __('Last Name field error message', 'moxietheme'),
					//'subtitle'  => __('Quickly add some CSS to your theme by adding it to this block.', 'moxietheme'),
					'desc'      => __('Input a custom error message for the First Name field of the contact form.', 'moxietheme'),
					'validate'  => 'no_html',
					'default'   => __('Please fill in your last name.', 'moxietheme'),
				),
				
				array(
					'id'        => 'opt-email-address-error',
					'type'      => 'text',
					'title'     => __('Email address field error message', 'moxietheme'),
					//'subtitle'  => __('Quickly add some CSS to your theme by adding it to this block.', 'moxietheme'),
					'desc'      => __('Input a custom error message for the Email address field across all forms.', 'moxietheme'),
					'validate'  => 'no_html',
					'default'   => __('Please provide a valid email address.', 'moxietheme'),
				),
				
				array(
					'id'        => 'opt-form-message-error',
					'type'      => 'text',
					'title'     => __('Message error message', 'moxietheme'),
					//'subtitle'  => __('Quickly add some CSS to your theme by adding it to this block.', 'moxietheme'),
					'desc'      => __('Input a custom error message for the Message field across all forms.', 'moxietheme'),
					'validate'  => 'no_html',
					'default'   => __('Please provide a message for your inquiry.', 'moxietheme'),
				),
				
				
				
				array(
					'id'        => 'opt-invalid-security-code-error',
					'type'      => 'text',
					'title'     => __('Re-captcha field error message', 'moxietheme'),
					//'subtitle'  => __('Quickly add some CSS to your theme by adding it to this block.', 'moxietheme'),
					'desc'      => __('Input a custom error message for the Google Re-captcha field of the contact form.', 'moxietheme'),
					'validate'  => 'no_html',
					'default'   => __('Invalid security code entered.', 'moxietheme'),
				),
				
				array(
					'id'        => 'opt-form-success-message',
					'type'      => 'text',
					'title'     => __('Form success message', 'moxietheme'),
					//'subtitle'  => __('Quickly add some CSS to your theme by adding it to this block.', 'moxietheme'),
					'desc'      => __('Input a custom success message for all forms - this message will appear after a form has been successfully submitted.', 'moxietheme'),
					'validate'  => 'no_html',
					'default'   => __('Your inquiry has been received, thank you.', 'moxietheme'),
				),
				
				array(
					'id'        => 'opt-form-error-message',
					'type'      => 'text',
					'title'     => __('Form error message', 'moxietheme'),
					//'subtitle'  => __('Quickly add some CSS to your theme by adding it to this block.', 'moxietheme'),
					'desc'      => __('Input a custom error message for all forms - this message will appear if a system error has occurred.', 'moxietheme'),
					'validate'  => 'no_html',
					'default'   => __('A system error occurred. Please try again later.', 'moxietheme'),
				),
				
				
				array(
					'id'        => 'opt-quick-contact-name-error-message',
					'type'      => 'text',
					'title'     => __('Name error message', 'moxietheme'),
					//'subtitle'  => __('Quickly add some CSS to your theme by adding it to this block.', 'moxietheme'),
					'desc'      => __('Input a custom error message for the Name field of the quick contact form.', 'moxietheme'),
					'validate'  => 'no_html',
					'default'   => __('Please provide your full name.', 'moxietheme'),
				),
				
				
				array(
					'id'        => 'opt-form-validation-message',
					'type'      => 'text',
					'title'     => __('Form validation message', 'moxietheme'),
					//'subtitle'  => __('Quickly add some CSS to your theme by adding it to this block.', 'moxietheme'),
					'desc'      => __('Input a custom error message for the form validation message across all forms.', 'moxietheme'),
					'validate'  => 'no_html',
					'default'   => __('Validating fields...', 'moxietheme'),
				),
				


											
			  )//end of fields
			
			);//end of section
			
			
			
			
			//CLIENTS/BRANDS CAROUSEL
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Clients Carousel', 'moxietheme'),
			  'heading'   => __('Clients Carousel', 'moxietheme'),
			  //'desc'      => __('<p class="description">This is the Description. Again HTML is allowed2</p>', 'moxietheme'),
			
			  'fields'    => array(
				  
				//Fields go here
				array(
					'id'        => 'opt-client-slides',
					'type'      => 'slides',
					'title'     => __('Client Slides', 'moxietheme'),
					'subtitle'  => __('Unlimited slides with drag and drop sortings.', 'moxietheme'),
					'desc'      => __('This field will store all slides values into a multidimensional array to use into a foreach loop.', 'moxietheme'),
					'placeholder'   => array(
						'title'         => __('Client name', 'moxietheme'),
						'description'   => __('Featured Text', 'moxietheme'),
						'url'           => __('Client URL', 'moxietheme'),
					),
				),
											
			  )//end of fields
			
			);//end of section
			
			
			//PANELS CAROUSEL
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Panels Carousel', 'moxietheme'),
			  'heading'   => __('Panels Carousel', 'moxietheme'),
			  //'desc'      => __('<p class="description">This is the Description. Again HTML is allowed2</p>', 'moxietheme'),
			
			  'fields'    => array(
				  
				//Fields go here
				array(
					'id'        => 'opt-panel-slides',
					'type'      => 'slides',
					'title'     => __('Panel Slides', 'moxietheme'),
					'subtitle'  => __('Unlimited slides with drag and drop sortings.', 'moxietheme'),
					'desc'      => __('This field will store all slides values into a multidimensional array to use into a foreach loop.', 'moxietheme'),
					'placeholder'   => array(
						'title'         => __('Title', 'moxietheme'),
						'description'   => __('Description', 'moxietheme'),
						'url'           => __('Icon - URL', 'moxietheme'),
					),
				),
											
			  )//end of fields
			
			);//end of section
			
			
			
			//BIO CAROUSEL
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Bio Carousel', 'moxietheme'),
			  'heading'   => __('Bio Carousel', 'moxietheme'),
			  //'desc'      => __('<p class="description">This is the Description. Again HTML is allowed2</p>', 'moxietheme'),
			
			  'fields'    => array(
				  
				//Fields go here
				array(
					'id'        => 'opt-bio-slides',
					'type'      => 'slides',
					'title'     => __('Bio Slides', 'moxietheme'),
					'subtitle'  => __('Unlimited slides with drag and drop sortings.', 'moxietheme'),
					'desc'      => __('This field will store all slides values into a multidimensional array to use into a foreach loop.', 'moxietheme'),
					'placeholder'   => array(
						'title'         => __('Date - Sub-title - Icon (ex. Jan 2010 - Getting the gears in motion - fa fa-gears)', 'moxietheme'),
						'description'   => __('Description', 'moxietheme'),
						'url'           => __('Title', 'moxietheme'),
					),
				),
											
			  )//end of fields
			
			);//end of section
			
			
			//Micro Slider
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Micro Slider', 'moxietheme'),
			  'heading'   => __('Micro Slider', 'moxietheme'),
			  //'desc'      => __('<p class="description">This is the Description. Again HTML is allowed2</p>', 'moxietheme'),
			
			  'fields'    => array(
			  			  
			  	//Caption Font
			  	array(
					'id'            => 'opt-pulse-slider-caption-font',
					'type'          => 'typography',
					'title'         => __('Slide Title Font', 'moxietheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
					'subsets'       => true, // Only appears if google is true and subsets not set to false
					'font-size'     => true,
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,
					//'color'         => false,
					//'preview'       => false, // Disable the previewer
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-caption h1'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-caption h1'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling Micro Slider caption text.', 'moxietheme'),
					'default'       => array(
						'color'         => '#FFFFFF',
						'font-weight'    => 'bold',
						'font-family'   => 'Raleway',
						'font-size'     => '36px',
					),
				),
				
				array(
					'id'            => 'opt-pulse-slider-sub-title-font',
					'type'          => 'typography',
					'title'         => __('Slide Sub-Title Font', 'moxietheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
					'subsets'       => true, // Only appears if google is true and subsets not set to false
					'font-size'     => true,
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,
					//'color'         => false,
					//'preview'       => false, // Disable the previewer
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-caption-decription'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-caption-decription'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling Micro Slider caption text.', 'moxietheme'),
					'default'       => array(
						'color'         => '#FFFFFF',
						'font-weight'    => 'normal',
						'font-family'   => 'Lato',
						'font-size'     => '32px',
					),
				),
				
				//Description Font
			  	array(
					'id'            => 'opt-pulse-slider-desc-font',
					'type'          => 'typography',
					'title'         => __('Slide Description Font', 'moxietheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					//'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
					//'subsets'       => false, // Only appears if google is true and subsets not set to false
					//'font-size'     => false,
					//'line-height'   => false,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,
					//'color'         => false,
					//'preview'       => false, // Disable the previewer
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-caption-excerpt'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-caption-excerpt'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling Micro Slider description text.', 'moxietheme'),
					'default'       => array(
						'color'         => '#000000',
						'font-weight'    => '300',
						'font-family'   => 'Open Sans',
						'font-size'     => '18px',
					),
				),
				
				array(
					'id'            => 'opt-pulse-slider-btn-font',
					'type'          => 'typography',
					'title'         => __('Slide Button Font', 'moxietheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					//'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
					//'subsets'       => false, // Only appears if google is true and subsets not set to false
					//'font-size'     => false,
					//'line-height'   => false,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,
					//'color'         => false,
					//'preview'       => false, // Disable the previewer
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-slide-btn'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-slide-btn'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling Micro Slider description text.', 'moxietheme'),
					'default'       => array(
						'color'         => '#FFFFFF',
						'font-weight'    => '700',
						'font-family'   => 'Open Sans',
						'font-size'     => '14px',
					),
				),

				
				//Micro Slides
				array(
					'id'        => 'opt-pulse-slides',
					'type'      => 'slides',
					'title'     => __('Slides', 'moxietheme'),
					'subtitle'  => __('Unlimited slides with drag and drop sortings.', 'moxietheme'),
					'desc'      => __('This field will store all slides values into a multidimensional array to use into a foreach loop.', 'moxietheme'),
					'placeholder'   => array(
						'title'         => __('Slide Title - Sub-Title', 'moxietheme'),
						'description'   => __('Slide Message', 'moxietheme'),
						'url'           => __('Button text / Button text flip - URL (ex. View More / of my projects - http://www.yourdomain.com/more)', 'moxietheme'), //"Button name - URL" format
					),
				),
				
											
			  )//end of fields
			
			);//end of section
			
			
			//Custom Slider
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Custom Slider', 'moxietheme'),
			  'heading'   => __('Custom Slider', 'moxietheme'),
			  //'desc'      => __('<p class="description">This is the Description. Again HTML is allowed2</p>', 'moxietheme'),
			
			  'fields'    => array(
				  
				//Fields go here
				array(
                        'id'        => 'opt-custom-slider',
                        'type'      => 'text',
                        'title'     => __('Homepage Slider', 'moxietheme'),
                        'subtitle'  => __('You can display a custom slider on the default index page by providing a slider shortcode here. (ex. [rev_slider alias="homepage"])', 'moxietheme'),
                        //'desc'      => __('NOTE: if you would like your slider to sit underneath the navigation bar than wrap your shortcode within the "sliderContainer" shortcode.', 'moxietheme'),
                        //'validate'  => 'html',
						'default' => ''
                ),
				
											
			  )//end of fields
			
			);//end of section
			
			//PRETTYPHOTO OPTIONS
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('PrettyPhoto Options', 'moxietheme'),
			  'heading'   => __('PrettyPhoto Options', 'moxietheme'),
			  //'desc'      => __('<p class="description">This is the Description. Again HTML is allowed2</p>', 'moxietheme'),
			
			  'fields'    => array(
				  
				//Fields go here
				array(
					'id'        => 'ppAutoPlay',
					'type'      => 'select',
					'title'     => __('Enable Slideshow?', 'moxietheme'),
					'subtitle'  => __('Allow the slider to animate to next slide automatically.', 'moxietheme'),
					//'desc'      => __('This is the description field, again good for additional info.', 'moxietheme'),
					
					//Must provide key => value pairs for select options
					'options'   => array(
						'true' => 'True', 
						'false' => 'False'
					),
					'default'   => 'true'
				),//end of field
				
				array(
					'id'        => 'ppShowTitle',
					'type'      => 'select',
					'title'     => __('Show Caption?', 'moxietheme'),
					'subtitle'  => __('Display the caption of each slide in the PrettyPhoto carousel.', 'moxietheme'),
					//'desc'      => __('This is the description field, again good for additional info.', 'moxietheme'),
					
					//Must provide key => value pairs for select options
					'options'   => array(
						'true' => 'True', 
						'false' => 'False'
					),
					'default'   => 'true'
				),//end of field
				
				array(
					'id'            => 'ppSlideShowSpeed',
					'type'          => 'slider',
					'title'         => __('Slideshow Speed', 'moxietheme'),
					//'desc'      => __('This example displays the value in a text box', 'moxietheme'),
					'subtitle'          => __('Set the speed of the slideshow cycling. A value of around 5000 for this field is recommended.', 'moxietheme'),
					'default'       => 5000,
					'min'           => 2000,
					'step'          => 5,
					'max'           => 10000,
					'display_value' => 'text'
				),//end of field
					
				array(
					'id'        => 'ppAnimationSpeed',
					'type'      => 'select',
					'title'     => __('Animation Speed', 'moxietheme'),
					'subtitle'  => __('Select your desired speed of the slide animation.', 'moxietheme'),
					//'desc'      => __('This is the description field, again good for additional info.', 'moxietheme'),
					
					//Must provide key => value pairs for select options
					'options'   => array(
						'fast' => 'Fast', 
						'slow' => 'Slow',
						'normal' => 'Normal',
					),
					'default'   => 'normal'
				),//end of field
				  
				array(
					'id'        => 'ppColorTheme',
					'type'      => 'select',
					'title'     => __('Color Theme', 'moxietheme'),
					'subtitle'  => __('Set the color theme for the PrettyPhoto carousel.', 'moxietheme'),
					//'desc'      => __('This is the description field, again good for additional info.', 'moxietheme'),
					
					//Must provide key => value pairs for select options
					'options'   => array(
						'light_rounded' => 'Light Rounded', 
						'dark_rounded' => 'Dark Rounded',
						'light_square' => 'Light Square',
						'dark_square' => 'Dark Square',
					),
					'default'   => 'light_rounded'
				),//end of field
				
				array(
					'id'        => 'ppSocialTools',
					'type'      => 'select',
					'title'     => __('Display Social Tools?', 'moxietheme'),
					'subtitle'  => __('Enable or disable the social icons in the prettyPhoto carousel.', 'moxietheme'),
					//'desc'      => __('This is the description field, again good for additional info.', 'moxietheme'),
					
					//Must provide key => value pairs for select options
					'options'   => array(
						'true' => 'True', 
						'false' => 'False',
					),
					'default'   => 'true'
				),//end of field
				
				array(
					'id'        => 'ppControls',
					'type'      => 'select',
					'title'     => __('Display Carousel Controls?', 'moxietheme'),
					'subtitle'  => __('Enable or disable the prettyPhoto carousel control features.', 'moxietheme'),
					//'desc'      => __('This is the description field, again good for additional info.', 'moxietheme'),
					
					//Must provide key => value pairs for select options
					'options'   => array(
						'true' => 'True', 
						'false' => 'False',
					),
					'default'   => 'true'
				),//end of field
													
			  )//end of fields
			  			
			);//end of section
			
            
			
			      

			// IMPORT / EXPORT SETTINGS
            $this->sections[] = array(
                'title'     => __('Import / Export', 'moxietheme'),
                'desc'      => __('Import and Export your Redux Framework settings from file, text or URL.', 'moxietheme'),
                'icon'      => 'el-icon-refresh',
                'fields'    => array(
                    array(
                        'id'            => 'opt-import-export',
                        'type'          => 'import_export',
                        'title'         => 'Import Export',
                        'subtitle'      => 'Save and restore your Redux options',
                        'full_width'    => false,
                    ),
                ),
            );                     
            
			// TAB DIVIDER
            $this->sections[] = array(
                'type' => 'divide',
            );

			// THEME INFORMATION
            $this->sections[] = array(
                'icon'      => 'el-icon-info-sign',
                'title'     => __('Theme Information', 'moxietheme'),
                'desc'      => __('<p class="description">This is the Description. Again HTML is allowed</p>', 'moxietheme'),
                'fields'    => array(
                    array(
                        'id'        => 'opt-raw-info',
                        'type'      => 'raw',
                        'content'   => $item_info,
                    )
                ),
            );
			
        }

        /*public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => __('Theme Information 1', 'moxietheme'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'moxietheme')
            );

            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => __('Theme Information 2', 'moxietheme'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'moxietheme')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'moxietheme');
        }*/

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'          => 'moxie_options',            // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'      => $theme->get('Name'),     // Name that appears at the top of your panel
                'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
                'menu_type'         => 'menu',                  // Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'    => true,                    // Show the sections below the admin menu item or not
                'menu_title'        => __('Moxie Options', 'moxietheme'),
                'page_title'        => __('Moxie Options', 'moxietheme'),
                
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => 'AIzaSyDBQJU8Cqmk_fxV1jvZeOdA3IpFL0Sq0js', // Must be defined to add google fonts to the typography module
                
                'async_typography'  => false,                    // Use a asynchronous font on the front end or font string
                'admin_bar'         => true,                    // Show the panel pages on the admin bar
                'global_variable'   => '',                      // Set a different name for your global variable other than the opt_name
                'dev_mode'          => false,                    // Show the time the page took to load, etc
                'customizer'        => false,                    // Enable basic customizer support
                //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.


                // OPTIONAL -> Give you extra features
                'page_priority'     => null,                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'       => 'themes.php',            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions'  => 'manage_options',        // Permissions needed to access the options panel.
                'menu_icon'         => '',                      // Specify a custom URL to an icon
                'last_tab'          => '',                      // Force your panel to always open to a specific tab (by id)
                'page_icon'         => 'icon-themes',           // Icon displayed in the admin panel next to your menu_title
                'page_slug'         => '_options',              // Page slug used to denote the panel
                'save_defaults'     => true,                    // On load save the defaults to DB before user clicks save or not
                'default_show'      => false,                   // If true, shows the default value next to each field that is not the default value.
                'default_mark'      => '',                      // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,                   // Shows the Import/Export panel when not used as a field.
                
                // CAREFUL -> These options are for advanced use only
                'transient_time'    => 60 * MINUTE_IN_SECONDS,
                'output'            => true,                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'        => true,                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
                
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'              => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'           => false, // REMOVE

                // HINTS
                'hints' => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'         => 'light',
                        'shadow'        => true,
                        'rounded'       => false,
                        'style'         => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show'          => array(
                            'effect'        => 'slide',
                            'duration'      => '500',
                            'event'         => 'mouseover',
                        ),
                        'hide'      => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                )
            );


            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $this->args['share_icons'][] = array(
                'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
                'title' => 'Visit us on GitHub',
                'icon'  => 'el-icon-github'
                //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
            );
            $this->args['share_icons'][] = array(
                'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
                'title' => 'Like us on Facebook',
                'icon'  => 'el-icon-facebook'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://twitter.com/reduxframework',
                'title' => 'Follow us on Twitter',
                'icon'  => 'el-icon-twitter'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://www.linkedin.com/company/redux-framework',
                'title' => 'Find us on LinkedIn',
                'icon'  => 'el-icon-linkedin'
            );

            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace('-', '_', $this->args['opt_name']);
                }
                $this->args['intro_text'] = sprintf(__('<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'moxietheme'), $v);
            } else {
                $this->args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'moxietheme');
            }

            // Add content after the form.
            $this->args['footer_text'] = __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'moxietheme');
        }

    }
    
    global $reduxConfig;
    $reduxConfig = new Redux_Framework_sample_config();
}

/**
  Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')):
    function redux_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;

/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')):
    function redux_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';

        /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;
