<?php

require_once( ABSPATH . WPINC . '/class-wp-customize-control.php' );

class moxie_theme_Customizer {
	
	public static function register ( $wp_customize ) {
		
		/*** Remove default wordpress sections ***/
		$wp_customize->remove_section('background_image');
		$wp_customize->remove_section('colors');
		$wp_customize->remove_section('header_image');
		
		/**** Google Options ****/
		$wp_customize->add_section( 'google_options' , array(
			'title'    => esc_html__( 'Google Options', 'moxietheme' ),
			'priority' => 1,
		));
		
		$wp_customize->add_setting(
			'googleAPIKey', array(
				'default' => "",
				'sanitize_callback' => 'esc_attr'
			)
		);

		$wp_customize->add_control(
			'googleAPIKey',
			 array(
				'label' => esc_html__( 'API KEY', 'moxietheme' ),
			 	'section' => 'google_options',
				'description' => __('Insert your Google API key (browser key) to activate Google services such as Google Maps and Google Places.', 'moxietheme'),
				'priority' => 1,
			 )
		);
		
		/**** Header Options ****/
		$wp_customize->add_section( 'header_options' , array(
			'title'    => esc_html__( 'Header Options', 'moxietheme' ),
			'priority' => 20,
		));
		
		//Upload Options
		$wp_customize->add_setting('companyLogo', array(
			'default' => get_template_directory_uri() . '/img/moxie.png',
			'sanitize_callback' => 'esc_url_raw',
		));
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'companyLogo', 
			array(
				'label'    => esc_html__( 'Company Logo', 'moxietheme' ),
				'section'  => 'header_options',
				'settings' => 'companyLogo',
				'priority' => 1,
				) 
			) 
		);
		
		$wp_customize->add_setting( 'globalHeaderImage', array(
			'sanitize_callback' => 'esc_url_raw',
		));
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'globalHeaderImage', 
			array(
				'label'    => esc_html__( 'Global Header Image (Pages and Posts)', 'moxietheme' ),
				'section'  => 'header_options',
				'settings' => 'globalHeaderImage',
				'priority' => 2,
				) 
			) 
		);
		
		$wp_customize->add_setting( 'globalHeaderImage2', array(
			'sanitize_callback' => 'esc_url_raw',
		));
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'globalHeaderImage2', 
			array(
				'label'    => esc_html__( 'Global Header Image (Archives, 404, etc.)', 'moxietheme' ),
				'section'  => 'header_options',
				'settings' => 'globalHeaderImage2',
				'priority' => 3,
				) 
			) 
		);
		
		
		$wp_customize->add_setting('enableLanguageSelector', array(
			'default' => 'off',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('enableLanguageSelector', array(
			'label'      => esc_html__('Enable WPML Language selector?', 'moxietheme'),
			'section'    => 'header_options',
			'settings'   => 'enableLanguageSelector',
			'priority' => 9,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		
		$wp_customize->add_setting('floatNavAboveSubHeader', array(
			'default' => 'off',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('floatNavAboveSubHeader', array(
			'label'      => esc_html__('Float Nav above header?', 'moxietheme'),
			'section'    => 'header_options',
			'settings'   => 'floatNavAboveSubHeader',
			'description'		 => esc_attr__('Applies to all resolutions.','moxietheme'),
			'priority' => 10,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('floatNavAboveSubHeaderMobile', array(
			'default' => 'off',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('floatNavAboveSubHeaderMobile', array(
			'label'      => esc_html__('Float Nav above header for mobile?', 'moxietheme'),
			'section'    => 'header_options',
			'settings'   => 'floatNavAboveSubHeaderMobile',
			'description'		 => esc_attr__('Applies to mobile resolutions (767px and lower).','moxietheme'),
			'priority' => 11,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		
		$wp_customize->add_setting('displaySearchField', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('displaySearchField', array(
			'label'      => esc_html__('Display Search Field?', 'moxietheme'),
			'section'    => 'header_options',
			'settings'   => 'displaySearchField',
			'description'		 => esc_attr__('Enable or disable the search field in the slide out menu.','moxietheme'),
			'priority' => 12,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		
		$wp_customize->add_setting('displaySubHeader', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('displaySubHeader', array(
			'label'      => esc_html__('Display Sub-Header?', 'moxietheme'),
			'section'    => 'header_options',
			'settings'   => 'displaySubHeader',
			'description'		 => esc_attr__('Enable or disable the sub-header area.','moxietheme'),
			'priority' => 13,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
				
		$wp_customize->add_setting(
			'companyLogoAltTag', array(
				'default' => "",
				'sanitize_callback' => 'esc_attr'
			)
		);

		$wp_customize->add_control(
			'companyLogoAltTag',
			 array(
				'label' => esc_html__( 'Company Logo Alt Tag', 'moxietheme' ),
			 	'section' => 'header_options',
				'priority' => 16,
			 )
		);
		
		$wp_customize->add_setting(
			'companyLogoURL', array(
				'default' => "",
				'sanitize_callback' => 'esc_attr'
			)
		);

		$wp_customize->add_control(
			'companyLogoURL',
			 array(
				'label' => esc_html__( 'Company Logo URL', 'moxietheme' ),
			 	'section' => 'header_options',
				'priority' => 17,
			 )
		);	
		
		
		$wp_customize->add_setting(
			'searchFieldText', array(
				'default' => esc_attr__('Search Articles...', 'moxietheme'),
				'sanitize_callback' => 'esc_attr'
			)
		);

		$wp_customize->add_control(
			'searchFieldText',
			 array(
				'label' => esc_html__( 'Search Field message', 'moxietheme' ),
			 	'section' => 'header_options',
				'priority' => 17,
			 )
		);	
		
		
		
		//sliders
		$wp_customize->add_setting( 'mainNavBgOpacity', array(
			'default' => 80,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'refresh', //postMessage
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'mainNavBgOpacity', array(
			'type' => 'range',
			'section' => 'header_options',
			'label'   => esc_html__( 'Nav background opacity', 'moxietheme' ),
			'description' => esc_html__('Adjust the background opacity of the main navigation. (Requires window refresh)', 'moxietheme'),
			'priority' => 20,
			'input_attrs' => array(
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );
		

		$wp_customize->add_setting( 'headerPadding', array(
			'default' => 5,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage', //postMessage
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'headerPadding', array(
			'type' => 'range',
			'section' => 'header_options',
			'label'   => esc_html__( 'Header Padding', 'moxietheme' ),
			'description' => esc_html__('Adjust the vertical padding of the header area.', 'moxietheme'),
			'priority' => 21,
			'input_attrs' => array(
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );

		
		$wp_customize->add_setting( 'headerOpacity', array(
			'default' => 80,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'refresh', //postMessage
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'headerOpacity', array(
			'type' => 'range',
			'section' => 'header_options',
			'label'   => esc_html__( 'Header Opacity', 'moxietheme' ),
			'description' => esc_html__('Adjust the background opacity of the header area. (Requires window refresh)', 'moxietheme'),
			'priority' => 22,
			'input_attrs' => array(
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );

				
		//Header Option Colors
		$headerOptionColors = array();
		
		$headerOptionColors[] = array(
			'slug'=>'headerBackgroundColor', 
			'default' => '#000000',
			'label' => esc_html__('Header Background Color', 'moxietheme'),
			'transport' => 'refresh', //postMessage
			'description' => esc_html__('Adjust the background color of the header area. (Requires window refresh)', 'moxietheme'),
		);
		
		$headerOptionColors[] = array(
			'slug'=>'mainNavBackgroundColor', 
			'default' => '#1c1c1c',
			'label' => esc_html__('Menu Background Color', 'moxietheme'),
			'transport' => 'refresh', //postMessage
			'description' => esc_html__('Adjust the background color of the main navigation. (Requires window refresh)', 'moxietheme'),
		);
		$headerOptionColors[] = array(
			'slug'=>'menuBorderColor', 
			'default' => '#353535',
			'label' => esc_html__('Menu Border Color', 'moxietheme'),
			'transport' => 'refresh', //postMessage
			'description' => esc_html__('Adjust the border color of the main navigation. (Requires window refresh)', 'moxietheme'),
		);
		$headerOptionColors[] = array(
			'slug'=>'mobileNavToggleColor', 
			'default' => '#fa2d65',
			'label' => esc_html__('Nav Toggle Color', 'moxietheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the color of the main navigation toggle button.', 'moxietheme'),
		);
		
		$headerOptionColors[] = array(
			'slug'=>'subpageHeaderBackgroundColor', 
			'default' => '#7c7c7c',
			'label' => esc_html__('Subpage Header Background Color', 'moxietheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the background color of the sub-page header area.', 'moxietheme'),
		);
		
		
		
		$priorityHeaderColors = 50;
		
		foreach( $headerOptionColors as $color ) {
			
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'transport' => $color['transport'],
					'description' => $color['description'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr'
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'section' => 'header_options',
					'transport' => $color['transport'],
					'description' => $color['description'],
					'priority' => $priorityHeaderColors,
					'settings' => $color['slug'])
				)
			);
			
			$priorityHeaderColors = $priorityHeaderColors + 10;
			
		}//end of foreach
		
		
			
		/**** Layout Options ****/
		$wp_customize->add_section( 'layout_options' , array(
			'title'    => esc_html__( 'Layout Options', 'moxietheme' ),
			'priority' => 60,
		));
		
		//Radio Options
		$wp_customize->add_setting('enableBoxMode',  array(
			'default' => 'off',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('enableBoxMode', array(
			'label'      => esc_html__('1170 Boxed Mode', 'moxietheme'),
			'section'    => 'layout_options',
			'settings'   => 'enableBoxMode',
			'priority' => 10,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting(
			'homepageLayout', array(
				'default' => 'no-sidebar',
				'sanitize_callback' => 'esc_attr'
			)
		);
		
		$wp_customize->add_control( new moxie_theme_Customize_Radio_Control( 
			$wp_customize, 'homepageLayout', 
				array(
					'label'   => esc_html__( 'Homepage Layout', 'moxietheme' ),
					'section' => 'layout_options',
					'settings'   => 'homepageLayout',
					'type'     => 'radio',
					'mode'     => 'image',
					'choices'  => array(
						'no-sidebar' => get_template_directory_uri() . '/css/img/layouts/no-sidebar.png',
						'left-sidebar' => get_template_directory_uri() . '/css/img/layouts/left-sidebar.png',
						'right-sidebar' => get_template_directory_uri() . '/css/img/layouts/right-sidebar.png',
					),
				) 
			) 
		);
		
		$wp_customize->add_setting(
			'universalLayout', array(
				'default' => 'no-sidebar',
				'sanitize_callback' => 'esc_attr'
			)
		);
		
		$wp_customize->add_control( new moxie_theme_Customize_Radio_Control( 
			$wp_customize, 'universalLayout', 
				array(
					'label'   => esc_html__( 'Universal Layout (Tag - Archive - Category)', 'moxietheme' ),
					'section' => 'layout_options',
					'settings'   => 'universalLayout',
					'type'     => 'radio',
					'mode'     => 'image',
					'choices'  => array(
						'no-sidebar' => get_template_directory_uri() . '/css/img/layouts/no-sidebar.png',
						'left-sidebar' => get_template_directory_uri() . '/css/img/layouts/left-sidebar.png',
						'right-sidebar' => get_template_directory_uri() . '/css/img/layouts/right-sidebar.png',
					),
				) 
			) 
		);
		
		$wp_customize->add_setting(
			'footerLayout', array(
				'default' => 'footer-four-columns',
				'sanitize_callback' => 'esc_attr'
			)
		);
		
		$wp_customize->add_control( new moxie_theme_Customize_Radio_Control( 
			$wp_customize, 'footerLayout', 
				array(
					'label'   => esc_html__( 'Footer Layout', 'moxietheme' ),
					'section' => 'layout_options',
					'settings'   => 'footerLayout',
					'type'     => 'radio',
					'mode'     => 'image',
					'choices'  => array(
						'footer-one-column' => get_template_directory_uri() . '/css/img/layouts/footer-one-column.png',
						'footer-two-columns' => get_template_directory_uri() . '/css/img/layouts/footer-two-columns.png',
						'footer-three-columns' => get_template_directory_uri() . '/css/img/layouts/footer-three-columns.png',
						'footer-four-columns' => get_template_directory_uri() . '/css/img/layouts/footer-four-columns.png',
						'footer-three-wide-left' => get_template_directory_uri() . '/css/img/layouts/footer-three-wide-left.png',
						'footer-three-wide-right' => get_template_directory_uri() . '/css/img/layouts/footer-three-wide-right.png',
					),
				) 
			) 
		);
		
		
		/**** Footer Options ****/
		$wp_customize->add_section( 'footer_options' , array(
			'title'    => esc_html__( 'Footer Options', 'moxietheme' ),
			'priority' => 70,
		));
			
		//Images
		
		$wp_customize->add_setting( 'fatFooterBackgroundImage', array(
			'sanitize_callback' => 'esc_url_raw',
		));
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'fatFooterBackgroundImage', 
			array(
				'label'    => esc_html__( 'Fat Footer Background Image', 'moxietheme' ),
				'section'  => 'footer_options',
				'settings' => 'fatFooterBackgroundImage',
				'priority' => 2,
				) 
			) 
		);
		
		$wp_customize->add_setting( 'returnToTopImage', array(
			'sanitize_callback' => 'esc_url_raw',
		));
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'returnToTopImage', 
			array(
				'label'    => esc_html__( 'Return To Top Image', 'moxietheme' ),
				'section'  => 'footer_options',
				'settings' => 'returnToTopImage',
				'priority' => 3,
				) 
			) 
		);

			
		//Radio Options
		$wp_customize->add_setting('toggle_fatfooter', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('toggle_fatfooter', array(
			'label'      => esc_html__('Fat Footer', 'moxietheme'),
			'section'    => 'footer_options',
			'settings'   => 'toggle_fatfooter',
			'type'       => 'radio',
			'priority' => 4,
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));

		
		$wp_customize->add_setting('toggle_footerNav', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('toggle_footerNav', array(
			'label'      => esc_html__('Footer', 'moxietheme'),
			'section'    => 'footer_options',
			'settings'   => 'toggle_footerNav',
			'type'       => 'radio',
			'priority' => 5,
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));


		
		$wp_customize->add_setting('toggleParallaxFooter', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('toggleParallaxFooter', array(
			'label'      => esc_html__('Run Parallax on Fat Footer?', 'moxietheme'),
			'section'    => 'footer_options',
			'settings'   => 'toggleParallaxFooter',
			'type'       => 'radio',
			'priority' => 6,
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		
		$wp_customize->add_setting('toggleFooterNewsletter', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('toggleFooterNewsletter', array(
			'label'      => esc_html__('Display Footer Newsletter sign-up?', 'moxietheme'),
			'section'    => 'footer_options',
			'settings'   => 'toggleFooterNewsletter',
			'type'       => 'radio',
			'priority' => 7,
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('displayCopyright', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('displayCopyright', array(
			'label'      => esc_html__('Display Copyright?', 'moxietheme'),
			'section'    => 'footer_options',
			'settings'   => 'displayCopyright',
			'type'       => 'radio',
			'priority' => 8,
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));

		//Textfields
		$wp_customize->add_setting(
			'copyrightInfo', array(
				'default' => 'Moxie. All rights reserved.',
				'sanitize_callback' => 'esc_attr'
			)
		);
				
		$wp_customize->add_control( 'copyrightInfo', array(
			'label'   => esc_html__( 'Copyright info', 'moxietheme' ),
			'section' => 'footer_options',
			'settings' => 'copyrightInfo',
			'type'    => 'text',
			'priority' => 9,
		) );
		
		$wp_customize->add_setting(
			'returnToTopIcon', array(
				'default' => 'fa fa-chevron-up',
				'sanitize_callback' => 'esc_attr'
			)
		);
				
		$wp_customize->add_control( 'returnToTopIcon', array(
			'label'   => esc_html__( 'Return to top icon', 'moxietheme' ),
			'section' => 'footer_options',
			'settings' => 'returnToTopIcon',
			'type'    => 'text',
			'priority' => 10,
		) );
		
		
		$wp_customize->add_setting(
			'newsletterURL', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr'
			)
		);
				
		$wp_customize->add_control( 'newsletterURL', array(
			'label'   => esc_html__( 'Mailchimp Form Action URL', 'moxietheme' ),
			'section' => 'footer_options',
			'settings' => 'newsletterURL',
			'type'    => 'text',
			'priority' => 11,
		) );

		//Slider elements
		$wp_customize->add_setting( 'fatFooterPadding', array(
			'default' => 100,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage', //postMessage
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'fatFooterPadding', array(
			'type' => 'range',
			'section' => 'footer_options',
			'label'   => esc_html__( 'Fat Footer Padding', 'moxietheme' ),
			'description' => esc_html__('Adjust the vertical padding of the fat footer.', 'moxietheme'),
			'priority' => 12,
			'input_attrs' => array(
				'min' => 0,
				'max' => 120,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );

		
		
		$FooterColors = array();

		$FooterColors[] = array(
			'slug'=>'fatFooterBackgroundColor', 
			'default' => '#283339',
			'label' => esc_html__('Fat Footer Background Color', 'moxietheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the background color of the fat footer.', 'moxietheme'),
		);
		$FooterColors[] = array(
			'slug'=>'footerBackgroundColor', 
			'default' => '#ffffff',
			'label' => esc_html__('Footer Background Color', 'moxietheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the background color of the footer.', 'moxietheme'),
		);
		
		
		$footerColorsCounter = 50;
		
		foreach( $FooterColors as $color ) {
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'transport' => $color['transport'],
					'description' => $color['description'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr'
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'priority' => $footerColorsCounter,
					'label' => $color['label'], 
					'section' => 'footer_options',
					'transport' => $color['transport'],
					'description' => $color['description'],
					'settings' => $color['slug'])
				)
			);
			
			$footerColorsCounter = $footerColorsCounter + 10;
			
			
		}//end of foreach
		
		
		/**** Global Options ****/
		$wp_customize->add_section( 'global_options' , array(
			'title'    => esc_html__( 'Global Options', 'moxietheme' ),
			'priority' => 80,
		));
		
		$wp_customize->add_setting( 'pagePreloaderImage', array(
			'sanitize_callback' => 'esc_url_raw',
		));
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'pagePreloaderImage', 
			array(
				'label'    => esc_html__( 'Page Preloader Animation', 'moxietheme' ),
				'section'  => 'global_options',
				'settings' => 'pagePreloaderImage',
				'priority' => 1,
				) 
			) 
		);
		
		$wp_customize->add_setting( 'pageBackgroundImage', array(
			'sanitize_callback' => 'esc_url_raw',
		));
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'pageBackgroundImage', 
			array(
				'label'    => esc_html__( 'Background image', 'moxietheme' ),
				'section'  => 'global_options',
				'settings' => 'pageBackgroundImage',
				'priority' => 1,
				) 
			) 
		);
		
		$wp_customize->add_setting('repeatBackground',  array(
			'default' => 'repeat',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('repeatBackground', array(
			'label'      => esc_html__('Background Repeat', 'moxietheme'),
			'section'    => 'global_options',
			'settings'   => 'repeatBackground',
			'priority' => 2,
			'type'       => 'radio',
			'choices'    => array(
				'repeat'  => 'Repeat',
				'repeat-x'  => 'Repeat X',
				'repeat-y'  => 'Repeat Y',
				'no-repeat'   => 'No Repeat',
			),
		));

		
		$wp_customize->add_setting('enableTooltip', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('enableTooltip', array(
			'label'      => esc_html__('ToolTip', 'moxietheme'),
			'section'    => 'global_options',
			'settings'   => 'enableTooltip',
			'type'       => 'radio',
			'priority' => 4,
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('retinaSupport',  array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('retinaSupport', array(
			'label'      => esc_html__('Retina Support', 'moxietheme'),
			'section'    => 'global_options',
			'settings'   => 'retinaSupport',
			'priority' => 7,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('enablePagePreloader',  array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('enablePagePreloader', array(
			'label'      => esc_html__('Enable Page Preloader?', 'moxietheme'),
			'section'    => 'global_options',
			'settings'   => 'enablePagePreloader',
			'priority' => 8,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		
		$wp_customize->add_setting(
			'ulListIcon', array(
				'default' => 'f105',
				'sanitize_callback' => 'esc_attr'
			)
		);
		
		$wp_customize->add_control( 'ulListIcon', array(
			'label'   => esc_html__('UL List Icon', 'moxietheme'),
			'section' => 'global_options',
			'settings' => 'ulListIcon',
			'priority' => 8,
			'type'    => 'text',
		) );
		
		//List options
		$wp_customize->add_setting('globalPageContainerPadding',
			array(
				'default' => 'default',
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control('globalPageContainerPadding',
			array(
				'type' => 'select',
				'priority' => 9,
				'label' => esc_attr__('Global Bootstrap Container Padding', 'moxietheme' ),
				'description' => esc_attr__('Use this option to apply a global container padding across all pages. The "Default padding" option will apply the actual page bootstrap container padding amount instead.', 'luxortheme' ),
				'section' => 'global_options',
				'choices' => array(
					'default' => 'Default padding',
					0 => 0,
					10 => 10,
					20 => 20,
					30 => 30,
					40 => 40,
					50 => 50,
					60 => 60,
					70 => 70,
					80 => 80,
					90 => 90,
					100 => 100,
					110 => 110,
					120 => 120,
				),
			)
		);
		
		
		$GlobalColors = array();
		
		$GlobalColors[] = array(
			'slug'=>'pageBackgroundColor', 
			'default' => '#FFFFFF',
			'label' => esc_html__('Background Color', 'moxietheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the background color of the theme.', 'moxietheme'),
		);
		$GlobalColors[] = array(
			'slug'=>'boxedModeContainerColor', 
			'default' => '#FFFFFF',
			'label' => esc_html__('Boxed Mode Container Color', 'moxietheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the background color of the boxed mode container. Only applies of Boxed Mode is enabled under Layout Options.', 'moxietheme'),
		);
		$GlobalColors[] = array(
			'slug'=>'primaryColor', 
			'default' => '#5cc9c1',
			'label' => esc_html__('Primary Color', 'moxietheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the primary color of the Moxie theme. Applies to multiple elements for a consistent design. Please note that not all elements update in real-time - please save your progress and review your final changes on the front-end.', 'moxietheme'),
		);
		$GlobalColors[] = array(
			'slug'=>'secondaryColor', 
			'default' => '#2e3049',
			'label' => esc_html__('Secondary Color', 'moxietheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the secondary color of the Moxie theme. Applies to multiple elements for a consistent design. Please note that not all elements update in real-time - please save your progress and review your final changes on the front-end.', 'moxietheme'),
		);
		$GlobalColors[] = array(
			'slug'=>'offsetColor', 
			'default' => '#fa2d65',
			'label' => esc_html__('Offset Color', 'moxietheme'), 
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the offset color of the Moxie theme. Applies to multiple elements for a consistent design. Please note that not all elements update in real-time - please save your progress and review your final changes on the front-end.', 'moxietheme'),
		);
		$GlobalColors[] = array(
			'slug'=>'dividerColor', 
			'default' => '#d3d3d3',
			'label' => esc_html__('Divider/Border Color', 'moxietheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the divider / border color of the Moxie theme. Applies to multiple elements for a consistent design. Please note that not all elements update in real-time - please save your progress and review your final changes on the front-end.', 'moxietheme'),
		);
		$GlobalColors[] = array(
			'slug'=>'tooltipColor', 
			'default' => '#5cc9c1',
			'label' => esc_html__('ToolTip Color', 'moxietheme'),
			'transport' => 'refresh', //postMessage
			'description' => esc_html__('Adjust the background color of the tooltip popup. (Requires window refresh)', 'moxietheme'),
		);
		$GlobalColors[] = array(
			'slug'=>'ulListIconColor', 
			'default' => '#5cc9c1',
			'label' => esc_html__('UL List icon color', 'moxietheme'),
			'transport' => 'refresh', //postMessage
			'description' => esc_html__('Adjust the background color of the tooltip popup. (Requires window refresh)', 'moxietheme'),
		);
		
		$priority = 50;
		
		foreach( $GlobalColors as $color ) {
			
			$priority = $priority + 10;
			
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'transport' => $color['transport'],
					'description' => $color['description'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr'
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'transport' => $color['transport'],
					'description' => $color['description'],
					'section' => 'global_options',
					'settings' => $color['slug'],
					'priority' => $priority,
					)
				)
			);
		}//end of foreach
					
				
		/**** Business Info ****/
		$wp_customize->add_section( 'business_info' , array(
			'title'    => esc_html__( 'Business Info', 'moxietheme' ),
			'priority' => 100,
		));
		
		//Textfields
		
		
		//Facebook Icon
		$wp_customize->add_setting(
			'facebooklink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr'
			)
		);
				
		$wp_customize->add_control( 'facebooklink', array(
			'label'   => esc_html__( 'Facebook URL', 'moxietheme' ),
			'section' => 'business_info',
			'settings' => 'facebooklink',
			'type'    => 'text',
		) );
		
		//Twitter Icon
		$wp_customize->add_setting(
			'twitterlink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr'
			)
		);
				
		$wp_customize->add_control( 'twitterlink', array(
			'label'   => esc_html__( 'Twitter URL', 'moxietheme' ),
			'section' => 'business_info',
			'settings' => 'twitterlink',
			'type'    => 'text',
		) );
		
		//Google Plus Icon
		$wp_customize->add_setting(
			'googlelink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr'
			)
		);
				
		$wp_customize->add_control( 'googlelink', array(
			'label'   => esc_html__( 'Google Plus URL', 'moxietheme' ),
			'section' => 'business_info',
			'settings' => 'googlelink',
			'type'    => 'text',
		) );
		
		//Linkedin Icon
		$wp_customize->add_setting(
			'linkedinLink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr'
			)
		);
				
		$wp_customize->add_control( 'linkedinLink', array(
			'label'   => esc_html__( 'Linkedin URL', 'moxietheme' ),
			'section' => 'business_info',
			'settings' => 'linkedinLink',
			'type'    => 'text',
		) );
		
		//Vimeo Icon
		$wp_customize->add_setting(
			'vimeolink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr'
			)
		);
				
		$wp_customize->add_control( 'vimeolink', array(
			'label'   => esc_html__( 'Vimeo URL', 'moxietheme' ),
			'section' => 'business_info',
			'settings' => 'vimeolink',
			'type'    => 'text',
		) );
		
		//Youtube Icon
		$wp_customize->add_setting(
			'youtubelink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr'
			)
		);
				
		$wp_customize->add_control( 'youtubelink', array(
			'label'   => esc_html__( 'YouTube URL', 'moxietheme' ),
			'section' => 'business_info',
			'settings' => 'youtubelink',
			'type'    => 'text',
		) );
		
		//Dribbble Icon
		$wp_customize->add_setting(
			'dribbblelink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr'
			)
		);
				
		$wp_customize->add_control( 'dribbblelink', array(
			'label'   => esc_html__( 'Dribbble URL', 'moxietheme' ),
			'section' => 'business_info',
			'settings' => 'dribbblelink',
			'type'    => 'text',
		) );
		
		//Pinterest Icon
		$wp_customize->add_setting(
			'pinterestlink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr'
			)
		);
				
		$wp_customize->add_control( 'pinterestlink', array(
			'label'   => esc_html__( 'Pinterest URL', 'moxietheme' ),
			'section' => 'business_info',
			'settings' => 'pinterestlink',
			'type'    => 'text',
		) );
		
		//Instagram Icon
		$wp_customize->add_setting(
			'instagramlink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr'
			)
		);
				
		$wp_customize->add_control( 'instagramlink', array(
			'label'   => esc_html__( 'Instagram URL', 'moxietheme' ),
			'section' => 'business_info',
			'settings' => 'instagramlink',
			'type'    => 'text',
		) );

		
		//Skype Icon
		$wp_customize->add_setting(
			'skypelink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr'
			)
		);
				
		$wp_customize->add_control( 'skypelink', array(
			'label'   => esc_html__( 'Skype Name', 'moxietheme' ),
			'section' => 'business_info',
			'settings' => 'skypelink',
			'type'    => 'text',
		) );
		
		//Flickr Icon
		$wp_customize->add_setting(
			'flickrlink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr'
			)
		);
				
		$wp_customize->add_control( 'flickrlink', array(
			'label'   => esc_html__( 'Flickr URL', 'moxietheme' ),
			'section' => 'business_info',
			'settings' => 'flickrlink',
			'type'    => 'text',
		) );
		
		//Tumblr Icon
		$wp_customize->add_setting(
			'tumblrlink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr'
			)
		);
				
		$wp_customize->add_control( 'tumblrlink', array(
			'label'   => esc_html__( 'Tumblr URL', 'moxietheme' ),
			'section' => 'business_info',
			'settings' => 'tumblrlink',
			'type'    => 'text',
		) );
		
		//Stumbleupon
		$wp_customize->add_setting(
			'stumbleuponlink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr'
			)
		);
				
		$wp_customize->add_control( 'stumbleuponlink', array(
			'label'   => esc_html__( 'StumbleUpon URL', 'moxietheme' ),
			'section' => 'business_info',
			'settings' => 'stumbleuponlink',
			'type'    => 'text',
		) );
		
		//Reddit
		$wp_customize->add_setting(
			'redditlink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr'
			)
		);
				
		$wp_customize->add_control( 'redditlink', array(
			'label'   => esc_html__( 'Reddit URL', 'moxietheme' ),
			'section' => 'business_info',
			'settings' => 'redditlink',
			'type'    => 'text',
		) );
		
		//RSS Icon
		$wp_customize->add_setting(
			'rssLink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr'
			)
		);
				
		$wp_customize->add_control( 'rssLink', array(
			'label'   => esc_html__( 'RSS URL', 'moxietheme' ),
			'section' => 'business_info',
			'settings' => 'rssLink',
			'type'    => 'text',
		) );
		
		
		/**** Post Options ****/
		$wp_customize->add_section( 'post_options' , array(
			'title'    => esc_html__( 'Post Options', 'moxietheme' ),
			'priority' => 120,
		));
		
		/* Upload options */
		$wp_customize->add_setting( 'authorBackgroundImage', array(
			'sanitize_callback' => 'esc_url_raw',
		));
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'authorBackgroundImage', 
			array(
				'label'    => esc_html__( 'Author Background Image', 'moxietheme' ),
				'section'  => 'post_options',
				'settings' => 'authorBackgroundImage',
				'priority' => 1,
				) 
			) 
		);
		
		$wp_customize->add_setting( 'commentsBackgroundImage', array(
			'sanitize_callback' => 'esc_url_raw',
		));
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'commentsBackgroundImage', 
			array(
				'label'    => esc_html__( 'Comments Background Image', 'moxietheme' ),
				'section'  => 'post_options',
				'settings' => 'commentsBackgroundImage',
				'priority' => 2,
				) 
			) 
		);
	
		
		//Radio options
		$wp_customize->add_setting('displaySocialFeatures', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('displaySocialFeatures', array(
			'label'      => esc_html__('Display Social Features?', 'moxietheme'),
			'section'    => 'post_options',
			'settings'   => 'displaySocialFeatures',
			'type'       => 'radio',
			'priority' => 3,
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('displayAuthorProfile', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('displayAuthorProfile', array(
			'label'      => esc_html__('Display Author Profile?', 'moxietheme'),
			'section'    => 'post_options',
			'settings'   => 'displayAuthorProfile',
			'type'       => 'radio',
			'priority' => 4,
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('displayRelatedPosts', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('displayRelatedPosts', array(
			'label'      => esc_html__('Display Related Posts?', 'moxietheme'),
			'section'    => 'post_options',
			'settings'   => 'displayRelatedPosts',
			'type'       => 'radio',
			'priority' => 5,
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		
		$wp_customize->add_setting('displayComments', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('displayComments', array(
			'label'      => esc_html__('Display Comments?', 'moxietheme'),
			'section'    => 'post_options',
			'settings'   => 'displayComments',
			'type'       => 'radio',
			'priority' => 6,
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		
		//$PostColors = array();
		$PostColors[] = array(
			'slug'=>'authorCommentsBgColor', 
			'default' => '#29343A',
			'label' => esc_html__('Author / Comments Background Color', 'moxietheme'),
			'transport' => 'refresh', //postMessage
			'description' => esc_html__('Adjust the background color of the author and comments area on the single post template.', 'moxietheme'),
		);
		
		foreach( $PostColors as $color ) {
			
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'transport' => $color['transport'],
					'description' => $color['description'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr'
				)
			);
			
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'transport' => $color['transport'],
					'description' => $color['description'],
					'section' => 'post_options',
					'settings' => $color['slug'],
					)
				)
			);
			
		}//end of foreach
				
		
		/**** Micro Slider Options ****/
		$wp_customize->add_section( 'pulseslider_options' , array(
			'title'    => esc_html__( 'Micro Slider Options', 'moxietheme' ),
		));
		
		//Upload Options
		$wp_customize->add_setting( 'sliderActionBtnImage', array(
			'sanitize_callback' => 'esc_url_raw',
		));
		
		$wp_customize->add_control( 
			new WP_Customize_Image_Control($wp_customize, 'sliderActionBtnImage', 
			array(
				'label'    => esc_html__( 'Slider Action Button Image', 'moxietheme' ),
				'section'  => 'pulseslider_options',
				'settings' => 'sliderActionBtnImage',
				'priority' => 1,
				) 
			) 
		);
		
		
		$wp_customize->add_setting(
			'sliderActionBtnIcon', array(
				'default' => "fa fa-chevron-down",
				'sanitize_callback' => 'esc_attr'
			)
		);

		$wp_customize->add_control(
			'sliderActionBtnIcon',
			 array(
				'label' => esc_html__( 'Slider Action Button Icon', 'moxietheme' ),
			 	'section' => 'pulseslider_options',
				'priority' => 2,
			 )
		);
		
		$wp_customize->add_setting(
			'sliderActionBtnTarget', array(
				'default' => "",
				'sanitize_callback' => 'esc_attr'
			)
		);

		$wp_customize->add_control(
			'sliderActionBtnTarget',
			 array(
				'label' => esc_html__( 'Slider Action Button Target', 'moxietheme' ),
			 	'section' => 'pulseslider_options',
				'priority' => 3,
			 )
		);
				
		
		$wp_customize->add_setting('enableActionBtn', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('enableActionBtn', array(
			'label'      => esc_html__('Enable Action Button?', 'moxietheme'),
			'section'    => 'pulseslider_options',
			'settings'   => 'enableActionBtn',
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));		
		
		$wp_customize->add_setting('enablePulseSlider', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('enablePulseSlider', array(
			'label'      => esc_html__('Enable Micro Slider?', 'moxietheme'),
			'section'    => 'pulseslider_options',
			'settings'   => 'enablePulseSlider',
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		
		$wp_customize->add_setting('enableSlideShow', array(
			'default' => 'true',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('enableSlideShow', array(
			'label'      => esc_html__('Enable SlideShow?', 'moxietheme'),
			'section'    => 'pulseslider_options',
			'settings'   => 'enableSlideShow',
			'type'       => 'radio',
			'choices'    => array(
				'true'   => 'ON',
				'false'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('slideLoop', array(
			'default' => 'true',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('slideLoop', array(
			'label'      => esc_html__('Loop Slides?', 'moxietheme'),
			'section'    => 'pulseslider_options',
			'settings'   => 'slideLoop',
			'type'       => 'radio',
			'choices'    => array(
				'true'   => 'ON',
				'false'  => 'OFF',
			),
		));

		$wp_customize->add_setting('enableControlNav', array(
			'default' => 'true',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('enableControlNav', array(
			'label'      => esc_html__('Enable Bullets?', 'moxietheme'),
			'section'    => 'pulseslider_options',
			'settings'   => 'enableControlNav',
			'type'       => 'radio',
			'choices'    => array(
				'true'   => 'ON',
				'false'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('pauseOnHover', array(
			'default' => 'true',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('pauseOnHover', array(
			'label'      => esc_html__('Pause on hover?', 'moxietheme'),
			'section'    => 'pulseslider_options',
			'settings'   => 'pauseOnHover',
			'type'       => 'radio',
			'choices'    => array(
				'true'   => 'ON',
				'false'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('showArrows', array(
			'default' => 'true',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('showArrows', array(
			'label'      => esc_html__('Display arrows?', 'moxietheme'),
			'section'    => 'pulseslider_options',
			'settings'   => 'showArrows',
			'type'       => 'radio',
			'choices'    => array(
				'true'   => 'ON',
				'false'  => 'OFF',
			),
		));

		$wp_customize->add_setting('animationType', array(
			'default' => 'slide',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('animationType', array(
			'label'      => esc_html__('Animation Type', 'moxietheme'),
			'section'    => 'pulseslider_options',
			'settings'   => 'animationType',
			'type'       => 'radio',
			'choices'    => array(
				'fade'   => 'Fade',
				'slide'  => 'Slide',
			),
		));

		
		//sliders
		$wp_customize->add_setting( 'slideShowSpeed', array(
			'default' => 8000,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'refresh', //postMessage
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'slideShowSpeed', array(
			'type' => 'range',
			'section' => 'pulseslider_options',
			'label'   => esc_html__( 'Slide Show Speed', 'moxietheme' ),
			'description' => esc_html__('Adjust the slide show speed of the Micro Slider. Only applies if the slideshow option is enabled. (Requires window refresh)', 'moxietheme'),
			//'priority' => 12,
			'input_attrs' => array(
				'min' => 1000,
				'max' => 10000,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );
		

		$wp_customize->add_setting('slideSpeed', array(
			'default' => 800,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'refresh', //postMessage
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control('slideSpeed', array(
			'type' => 'range',
			'section' => 'pulseslider_options',
			'label'   => esc_html__( 'Slide Speed', 'moxietheme' ),
			'description' => esc_html__('Adjust the slide speed of the Micro Slider. Only applies if the "Animation Type" option is set to "Slide". (Requires window refresh)', 'moxietheme'),
			//'priority' => 12,
			'input_attrs' => array(
				'min' => 500,
				'max' => 1000,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );




		$wp_customize->add_setting( 'buttonBGOpacity', array(
			'default' => 0,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'refresh', //postMessage
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'buttonBGOpacity', array(
			'type' => 'range',
			'section' => 'pulseslider_options',
			'label'   => esc_html__( 'Action Button Opacity', 'moxietheme' ),
			'description' => esc_html__('Adjust the background opacity of the Micro Slider action button. (Requires window refresh)', 'moxietheme'),
			//'priority' => 12,
			'input_attrs' => array(
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );

		


						
		//Color options
		$pulseSliderOptionColors = array();

		$pulseSliderOptionColors[] = array(
			'slug'=>'pulseSliderBtnColor', 
			'default' => '#ffffff',
			'label' => esc_html__('Action Button Color', 'moxietheme'),
			'transport' => 'refresh', //postMessage
			'description' => esc_html__('Adjust the color of the Micro Slider action button. (Requires window refresh)', 'moxietheme'),
		);
		
		$pulseSliderOptionColors[] = array(
			'slug'=>'pulseSliderBtnBgColor', 
			'default' => '#000000',
			'label' => esc_html__('Action Button Background Color', 'moxietheme'),
			'transport' => 'refresh', //postMessage
			'description' => esc_html__('Adjust the background color of the Micro Slider action button. (Requires window refresh)', 'moxietheme'),
		);
		
		foreach( $pulseSliderOptionColors as $color ) {
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'transport' => $color['transport'],
					'description' => $color['description'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr'
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'transport' => $color['transport'],
					'description' => $color['description'],
					'section' => 'pulseslider_options',
					'settings' => $color['slug'])
				)
			);
		}//end of foreach
		
				
		
		/**** Shortcode Options ****/
		$wp_customize->add_section( 'shortcode_options' , array(
			'title'    => esc_html__( 'Shortcode Options', 'moxietheme' ),
		));
		
		
				
		//Shortcode Option Colors
		$shortcodeOptionColors = array();

		$shortcodeOptionColors[] = array(
			'slug'=>'accordionContentBgColor', 
			'default' => '#f7f7f7',
			'label' => esc_html__('Accordion content background color', 'moxietheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the background color of the accordion menu content area.', 'moxietheme'),
		);
		
		$shortcodeOptionColors[] = array(
			'slug'=>'tabContentBgColor', 
			'default' => '#f7f7f7',
			'label' => esc_html__('Tab content background color', 'moxietheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the background color of the tab system content area.', 'moxietheme'),
		);
		
		$shortcodeOptionColors[] = array(
			'slug'=>'data_table_title_color', 
			'default' => '#306173',
			'label' => esc_html__('Data Table title color', 'moxietheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the background color of the data table title column.', 'moxietheme'),
		);
		
		$shortcodeOptionColors[] = array(
			'slug'=>'data_table_info_color', 
			'default' => '#e0e0e0',
			'label' => esc_html__('Data Table info color', 'moxietheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the background color of the data table info column.', 'moxietheme'),
		);

		
		$shortcodeOptionColors[] = array(
			'slug'=>'timetable_font_color', 
			'default' => '#ffffff',
			'label' => esc_html__('Time Table font color', 'moxietheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the font color of the time table shortcode.', 'moxietheme'),
		);
		
		$shortcodeOptionColors[] = array(
			'slug'=>'timetable_border_color', 
			'default' => '#cccccc',
			'label' => esc_html__('Time Table border color', 'moxietheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the border color of the time table shortcode.', 'moxietheme'),
		);
		
		$shortcodeOptionColors[] = array(
			'slug'=>'pricing_table_font_color', 
			'default' => '#ffffff',
			'label' => esc_html__('Pricing Table font color', 'moxietheme'),
			'transport' => 'refresh', //postMessage
			'description' => esc_html__('Adjust the font color of the pricing table shortcode. (Requires window refresh)', 'moxietheme'),
		);

				
		foreach( $shortcodeOptionColors as $color ) {
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'transport' => $color['transport'],
					'description' => $color['description'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr'
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'transport' => $color['transport'],
					'description' => $color['description'],
					'section' => 'shortcode_options',
					'settings' => $color['slug'])
				)
			);
		}//end of foreach
		
		
		/**** Alert Options ****/
		/*$wp_customize->add_section( 'alert_options' , array(
			'title'    => esc_html__( 'Alert Options', 'moxietheme' ),
		));
				
		$alertColors = array();
		
		$alertColors[] = array(
			'slug'=>'alert_success_color', 
			'default' => '#2c5e83',
			'label' => esc_html__('Success Color', 'moxietheme')
		);
		$alertColors[] = array(
			'slug'=>'alert_info_color', 
			'default' => '#cbb35e',
			'label' => esc_html__('Info Color', 'moxietheme')
		);
		$alertColors[] = array(
			'slug'=>'alert_warning_color', 
			'default' => '#ea6872',
			'label' => esc_html__('Warning Color', 'moxietheme')
		);
		$alertColors[] = array(
			'slug'=>'alert_danger_color', 
			'default' => '#5f3048',
			'label' => esc_html__('Danger Color', 'moxietheme')
		);
		$alertColors[] = array(
			'slug'=>'alert_notice_color', 
			'default' => '#49c592',
			'label' => esc_html__('Notice Color', 'moxietheme')
		);
		
		$priority = 0;
		
		foreach( $alertColors as $color ) {
			
			$priority = $priority + 10;
			
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr'
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'section' => 'alert_options',
					'settings' => $color['slug'],
					'priority' => $priority,
					)
				)
			);
		}//end of foreach*/
		
		
		/**** Woocommerce Options ****/
		 
		$wp_customize->add_section( 'woo_options' , array(
			'title'    => esc_attr__( 'Woocommerce Options', 'moxietheme' ),
			'priority' => 100,
		));
		
		$wp_customize->add_setting('products_per_page',
			array(
				'default' => '8',
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control('products_per_page',
			array(
				'type' => 'select',
				'label' => esc_attr__( 'Products Per Page', 'moxietheme' ),
				'section' => 'woo_options',
				'choices' => array(
					'4' => '4',
					'8' => '8',
					'12' => '12',
					'16' => '16',
					'20' => '20',
					'24' => '24',
					'28' => '28',
					'32' => '32',
				),
			)
		);
		
		
		//Radio Options		
		$wp_customize->add_setting(
			'woocommShopLayout', array(
				'default' => 'no-sidebar',
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control( new moxie_theme_Customize_Radio_Control( 
			$wp_customize, 'woocommShopLayout', 
				array(
					'label'   => esc_attr__('Woocommerce layout', 'moxietheme' ),
					'section' => 'woo_options',
					'settings'   => 'woocommShopLayout',
					'type'     => 'radio',
					'mode'     => 'image',
					'description' => esc_attr__('Applies to all Woocommerce templates.', 'moxietheme' ),
					'choices'  => array(
						'no-sidebar' => get_template_directory_uri() . '/css/img/layouts/no-sidebar.png',
						'left-sidebar' => get_template_directory_uri() . '/css/img/layouts/left-sidebar.png',
						'right-sidebar' => get_template_directory_uri() . '/css/img/layouts/right-sidebar.png',
					),
				) 
			) 
		);
		
		
		//Upload Options
		$wp_customize->add_setting( 'wooCategoryHeaderImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'wooCategoryHeaderImage', 
			array(
				'label'    => esc_attr__( 'Category/Tag Page Header Image', 'moxietheme' ),
				'section'  => 'woo_options',
				'settings' => 'wooCategoryHeaderImage',
				) 
			) 
		);
		
		$wp_customize->add_setting( 'wooSingleProductHeaderImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'wooSingleProductHeaderImage', 
			array(
				'label'    => esc_attr__( 'Product Post Header Image', 'moxietheme' ),
				'section'  => 'woo_options',
				) 
			) 
		);
		
				
   }//end of function
     
}//end of class


if (class_exists('WP_Customize_Control')) {
	
	//Custom radio with image support
	class moxie_theme_Customize_Radio_Control extends WP_Customize_Control {

		public $type = 'radio';
		public $description = '';
		public $mode = 'radio';
		public $subtitle = '';
	
		public function enqueue() {
	
			if ( 'buttonset' == $this->mode || 'image' == $this->mode ) {
				wp_enqueue_script( 'jquery-ui-button' );
				wp_register_style('customizer-styles', get_template_directory_uri() . '/css/customizer/pulsar-customizer.css');  
				wp_enqueue_style('customizer-styles');
			}
	
		}
	
		public function render_content() {
	
			if ( empty( $this->choices ) ) {
				return;
			}
	
			$name = '_customize-radio-' . $this->id;
	
			?>
			<span class="customize-control-title">
				<?php echo esc_html( $this->label ); ?>
			</span>
            
            <?php if ( isset( $this->description ) && '' != $this->description ) { ?>
                <p><?php echo strip_tags( esc_html( $this->description ) ); ?></p>
            <?php } ?>
	
			<div id="input_<?php echo $this->id; ?>" class="<?php echo $this->mode; ?>">
				<?php if ( '' != $this->subtitle ) : ?>
					<div class="customizer-subtitle"><?php echo $this->subtitle; ?></div>
				<?php endif; ?>
				<?php
	
				// JqueryUI Button Sets
				if ( 'buttonset' == $this->mode ) {
	
					foreach ( $this->choices as $value => $label ) : ?>
						<input type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo $this->id . $value; ?>" <?php $this->link(); checked( $this->value(), $value ); ?>>
							<label for="<?php echo $this->id . $value; ?>">
								<?php echo esc_html( $label ); ?>
							</label>
						</input>
						<?php
					endforeach;
	
				// Image radios.
				} elseif ( 'image' == $this->mode ) {
	
					foreach ( $this->choices as $value => $label ) : ?>
						<input class="image-select" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo $this->id . $value; ?>" <?php $this->link(); checked( $this->value(), $value ); ?>>
							<label for="<?php echo $this->id . $value; ?>">
								<img src="<?php echo esc_html( $label ); ?>">
							</label>
						</input>
						<?php
					endforeach;
	
				// Normal radios
				} else {
	
					foreach ( $this->choices as $value => $label ) :
						?>
						<label class="customizer-radio">
							<input class="kirki-radio" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
							<?php echo esc_html( $label ); ?><br/>
						</label>
						<?php
					endforeach;
	
				}
				?>
			</div>
			<?php if ( 'buttonset' == $this->mode || 'image' == $this->mode ) { ?>
				<script>
				jQuery(document).ready(function($) {
					$( '[id="input_<?php echo $this->id; ?>"]' ).buttonset();
				});
				</script>
			<?php }
	
		}
	}
	
	//jQuery UI Slider class
	class moxie_theme_Customize_Sliderui_Control extends WP_Customize_Control {

		public $type = 'slider';
		public $description = '';
		public $subtitle = '';
	
		public function enqueue() {
	
			wp_enqueue_script( 'jquery-ui-core' );
			wp_enqueue_script( 'jquery-ui-slider' );
	
		}
	
		public function render_content() { ?>
			<label>
	
				<span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
					<?php if ( isset( $this->description ) && '' != $this->description ) { ?>
						<a href="#" class="button tooltip" title="<?php echo strip_tags( esc_html( $this->description ) ); ?>">?</a>
					<?php } ?>
				</span>
	
				<?php if ( '' != $this->subtitle ) : ?>
					<div class="customizer-subtitle"><?php echo esc_attr($this->subtitle); ?></div>
				<?php endif; ?>
	
				<input type="text" class="kirki-slider" id="input_<?php echo $this->id; ?>" disabled value="<?php echo $this->value(); ?>" <?php $this->link(); ?>/>
	
			</label>
	
			<div id="slider_<?php echo $this->id; ?>" class="ss-slider"></div>
			<script>
			jQuery(document).ready(function($) {
				$( '[id="slider_<?php echo $this->id; ?>"]' ).slider({
						value : <?php echo $this->value(); ?>,
						min   : <?php echo $this->choices['min']; ?>,
						max   : <?php echo $this->choices['max']; ?>,
						step  : <?php echo $this->choices['step']; ?>,
						slide : function( event, ui ) { $( '[id="input_<?php echo $this->id; ?>"]' ).val(ui.value).keyup(); }
				});
				$( '[id="input_<?php echo $this->id; ?>"]' ).val( $( '[id="slider_<?php echo $this->id; ?>"]' ).slider( "value" ) );
			});
			</script>
			<?php
	
		}
	}
	
	//Custom classes for extending the theme customizer
	class moxie_theme_Customize_Textarea_Control extends WP_Customize_Control {
		public $type = 'textarea';
	 
		public function render_content() {
			?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<textarea rows="5" class="customize-full-width" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
				</label>
			<?php
		}
	}

}


add_action( 'customize_register' , array( 'moxie_theme_Customizer' , 'register' ) );

?>