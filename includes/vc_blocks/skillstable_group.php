<?php

if(!class_exists('WPBakeryShortCode')) return;

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_pm_ln_skillstable_group extends WPBakeryShortCodesContainer {
		
		protected function content($atts, $content = null) {

			//$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;
	
			extract(shortcode_atts(array(
				'el_id' => '',
			), $atts));
	
	
			/* ================  Render Shortcodes ================ */
	
			ob_start();
			
			$GLOBALS['pm_skills_table_item_count'] = 1;
	
			do_shortcode( $content );
	
			?>
			
            <!-- Element Code start -->
            
			<?php 
			
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
					echo '<div class="pm-skills-container"><div class="pm-skills-inner">'.implode( "\n", $items ).'</div></div>';
			
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
    class WPBakeryShortCode_pm_ln_skillstable_group_item extends WPBakeryShortCode {
		
		protected function content($atts, $content = null) {

			//$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;
	
			extract(shortcode_atts(array(
				'title' => 'Sample Title',
				'icon' => 'fa fa-wifi',
				'percentage' => 50,
				'speed' => 1500,
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
    "name" => __("Skills Carousel", 'moxietheme'),
    "base" => "pm_ln_skillstable_group",
	"category"  => __("Moxie Shortcodes", 'moxietheme'),
    "as_parent" => array('only' => 'pm_ln_skillstable_group_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element" => true,
    "show_settings_on_create" => false,
    "is_container" => true,
    "params" => array(
	
        // add params same as with any other content element	
		/*array(
            "type" => "dropdown",
            "heading" => __("Element ID", 'moxietheme'),
            "param_name" => "el_id",
            "description" => __("Assign a unique number value for this Data Table Menu. If you are creating multiple Data Table menus on a single page please make sure each Data Table menu has a unique number assigned to it to avoid any possible conflicts between Data table menus.", 'moxietheme'),
			"value"      => array( '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10' ), //Add default value in $atts
        ),*/
		
		
    ),
    "js_view" => 'VcColumnView'
) );

vc_map( array(
    "name" => __("Skills Carousel Item", 'moxietheme'),
    "base" => "pm_ln_skillstable_group_item",
	"category"  => __("Moxie Shortcodes", 'moxietheme'),
    "content_element" => true,
    "as_child" => array('only' => 'pm_ln_skillstable_group'), // Use only|except attributes to limit parent (separate multiple values with comma)
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
            "heading" => __("Percentage", 'moxietheme'),
            "param_name" => "percentage",
            //"description" => __("Accepts a FontAwesome 4 value. (Ex. fa fa-wifi)", 'moxietheme'),
			"value" => 50
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Speed", 'moxietheme'),
            "param_name" => "speed",
            //"description" => __("Accepts a FontAwesome 4 value. (Ex. fa fa-wifi)", 'moxietheme'),
			"value" => 1500
        ),	
		
		array(
            "type" => "textarea_html",
            "heading" => __("Content", 'moxietheme'),
            "param_name" => "content",
            //"description" => __("Accepts a FontAwesome 4 value. (Ex. fa fa-wifi)", 'moxietheme'),
			//"value" => 1500
        ),		
				
		
    )
) );