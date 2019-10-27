<?php

if(!class_exists('WPBakeryShortCode')) return;

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_pm_ln_services_group extends WPBakeryShortCodesContainer {
		
		protected function content($atts, $content = null) {

			//$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;
	
			extract(shortcode_atts(array(
				'parallax' => 'on',
				'bg_image' => '',
				'expandable_text' => 'on'
			), $atts));
	
	
			/* ================  Render Shortcodes ================ */
	
			ob_start();
			
			$GLOBALS['pm_services_group_item_count'] = 1;
	
			do_shortcode( $content );
	
			?>
            
            <?php 
				$img = wp_get_attachment_image_src($bg_image, "large"); 
				$bg_image = $img[0];
			?>
			
            <!-- Element Code start -->
            
			<?php 
			
				if( is_array( $GLOBALS['servicesGroupItems'] ) ){
	
					//Render skills buttons $buttons['title']
					foreach( $GLOBALS['servicesGroupItems'] as $button ){
						
						$buttons[] = '<li><div class="pm_services_tab_icon_container active"><div class="pm_services_tab_icon shadow"><div class="front face"><i class="'.$button['icon'].'"></i></div><div class="back face center"><a href="#" id="pm-services-tab-btn-'.$button['id'].'">'.$button['rollover_text'].'</a></div></div></div><p>'.$button['title'].'</p></li>';
						
					}
					
					
					//Render description area
					foreach( $GLOBALS['servicesGroupItems'] as $description ){
						
						$descriptions[] = '<div class="pm-services-tab-system-desc" id="pm-services-tab-system-desc-'.$description['id'].'"><div class="pm-services-tab-system-desc-wrapper '. ($expandable_text === 'off' ? 'no-expand' : '') .'"><div class="pm-services-tab-system-desc-text"><h5>'.$description['title'].' <i class="'.$description['icon'].'"></i></h5><div class="pm-services-tab-divider"></div><p>'.$description['content'].'</p></div></div><a href="#" class="pm-services-tab-system-desc-expander '. ($expandable_text === 'off' ? 'no-expand' : '') .' fa fa-angle-down" id="pm-services-tab-system-desc-expander-'.$description['id'].'"></a></div>';
				
					}
			
					//return wrapper plus servicesGroupItem
					echo '<div class="pm-services-tab-system-container '. ($parallax === 'on' ? 'pm-parallax-panel' : '') .'" '. ($parallax === 'on' ? 'data-stellar-background-ratio="0.5"' : '') .' '.( $bg_image !== '' ? 'style="background-image:url('.$bg_image.');"' : '' ).'><div class="pm-services-tab-system"><ul class="pm-services-tab-system-list">'.implode( "\n", $buttons ).'</ul></div></div><div id="pm-services-tab-system-container-arrow"></div><div id="pm-services-tab-system-scrollto"></div>'.implode( "\n", $descriptions ).'';
					
				}
				
			?>
            
			<!-- Element Code / END -->
	
			<?php
	
			$output = ob_get_clean();
	
			/* ================  Render Shortcodes ================ */
	
			return $output;
	
		}
		
    }
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_pm_ln_services_group_item extends WPBakeryShortCode {
		
		protected function content($atts, $content = null) {

			//$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;
	
			extract(shortcode_atts(array(
				'title' => 'Sample Title',
				'icon' => 'fa fa-wifi',
				'rollover_text' => 'Sample text',
				), 
			$atts));
	
	
			/* ================  Render Shortcodes ================ */
	
			ob_start();
				
			?>
			
			<?php 
				//$img = wp_get_attachment_image_src($el_image, "large"); 
				//$imgSrc = $img[0];
			?>
	
			<!-- Element Code start -->
			<?php 
			
				$x = $GLOBALS['pm_services_group_item_count'];

				$GLOBALS['servicesGroupItems'][$x] = array( 
														'id' => $GLOBALS['pm_services_group_item_count'],
														'title' => sprintf( $title, $GLOBALS['pm_services_group_item_count'] ), 
														'icon' => sprintf( $icon, $GLOBALS['pm_services_group_item_count'] ), 
														'rollover_text' => sprintf( $rollover_text, $GLOBALS['pm_services_group_item_count'] ),
														'content' =>  do_shortcode($content) 
														);
			
				$GLOBALS['pm_services_group_item_count']++;
			
			?>
            
			<!-- Element Code / END -->
	
			<?php
	
			$output = ob_get_clean();
	
			/* ================  Render Shortcodes ================ */
	
			return $output;
	
		}
		
    }
}


vc_map( array(
    "name" => __("Services Carousel", 'moxietheme'),
    "base" => "pm_ln_services_group",
	"category"  => __("Moxie Shortcodes", 'moxietheme'),
    "as_parent" => array('only' => 'pm_ln_services_group_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element" => true,
    "show_settings_on_create" => false,
    "is_container" => true,
    "params" => array(
	
        // add params same as with any other content element	
		array(
            "type" => "dropdown",
            "heading" => __("Parallax Mode", 'moxietheme'),
            "param_name" => "parallax",
            //"description" => __("Assign a unique number value for this Data Table Menu. If you are creating multiple Data Table menus on a single page please make sure each Data Table menu has a unique number assigned to it to avoid any possible conflicts between Data table menus.", 'moxietheme'),
			"value"      => array( 'on' => 'on', 'off' => 'off' ), //Add default value in $atts
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Expandable Text?", 'moxietheme'),
            "param_name" => "expandable_text",
            "description" => __("Use this option to make your service descriptions expandable or not.", 'moxietheme'),
			"value"      => array( 'on' => 'on', 'off' => 'off' ), //Add default value in $atts
        ),
		
		array(
            "type" => "attach_image",
            "heading" => __("Background Image", 'moxietheme'),
            "param_name" => "bg_image",
            //"description" => __("Assign a unique number value for this Data Table Menu. If you are creating multiple Data Table menus on a single page please make sure each Data Table menu has a unique number assigned to it to avoid any possible conflicts between Data table menus.", 'moxietheme'),
			//"value"      => array( 'on' => 'on', 'off' => 'off' ), //Add default value in $atts
        ),
				
				
		
    ),
    "js_view" => 'VcColumnView'
) );

vc_map( array(
    "name" => __("Services Carousel Item", 'moxietheme'),
    "base" => "pm_ln_services_group_item",
	"category"  => __("Moxie Shortcodes", 'moxietheme'),
    "content_element" => true,
    "as_child" => array('only' => 'pm_ln_services_group'), // Use only|except attributes to limit parent (separate multiple values with comma)
    "params" => array(

        // add params same as with any other content element
        array(
            "type" => "textfield",
            "heading" => __("Title", 'moxietheme'),
            "param_name" => "title",
            //"description" => __("Enter a title", 'moxietheme'),
			"value" => 'Sample Title'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Icon", 'moxietheme'),
            "param_name" => "icon",
            "description" => __("Accepts a FontAwesome 4 value. (Ex. fa fa-wifi)", 'moxietheme'),
			"value" => 'fa fa-wifi'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Rollover Text", 'moxietheme'),
            "param_name" => "rollover_text",
            //"description" => __("Accepts a FontAwesome 4 value. (Ex. fa fa-wifi)", 'moxietheme'),
			"value" => 'Sample text'
        ),
		
		array(
            "type" => "textarea_html",
            "heading" => __("Content", 'moxietheme'),
            "param_name" => "content",
            //"description" => __("Accepts a FontAwesome 4 value. (Ex. fa fa-wifi)", 'moxietheme'),
			//"value" => 'Sample text'
        ),
		
    )
) );