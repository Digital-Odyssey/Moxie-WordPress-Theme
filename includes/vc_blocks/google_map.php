<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_google_map extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"el_id" => 'map1', 
			"el_latitude" => '', 
			"el_longitude" => '', 
			"el_message" => '',
			"el_type" => 'ROADMAP',
			"el_zoom" => '13',
			"el_height" => '450',
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();


        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_logo, "large"); 
			//$el_logo = $img[0];
		?>

        <!-- Element Code start -->
        
        <!-- Google Map -->

        <div data-id="<?php esc_attr_e($el_id); ?>" data-latitude="<?php esc_attr_e($el_latitude); ?>" data-longitude="<?php esc_attr_e($el_longitude); ?>" data-mapType="<?php esc_attr_e($el_type); ?>" data-mapZoom="<?php esc_attr_e($el_zoom); ?>" data-message="<?php esc_attr_e($el_message); ?>" style="width:100%; height:<?php esc_attr_e($el_height); ?>px;" id="<?php esc_attr_e($el_id); ?>" class="googleMap"></div>
            
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_google_map",
    "name"      => __("Google Map", 'moxietheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Moxie Shortcodes", 'moxietheme'),
    "params"    => array(
	
		array(
            "type" => "textfield",
            "heading" => __("Map ID", 'moxietheme'),
            "param_name" => "el_id",
            "description" => __("Enter a unique map ID value - this will prevent conflicts with multiple Google Maps on the same page.", 'moxietheme'),
			"value" => 'map1'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Latitude", 'moxietheme'),
            "param_name" => "el_latitude",
            "description" => __("Enter the latitude for your map.", 'moxietheme'),
			"value" => ''
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Longitude", 'moxietheme'),
            "param_name" => "el_longitude",
            "description" => __("Enter the longitude for your map.", 'moxietheme'),
			"value" => ''
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Address / Message", 'moxietheme'),
            "param_name" => "el_message",
            "description" => __("Enter your address or a message for your map marker tooltip.", 'moxietheme'),
			"value" => ''
        ),
		
		
		/*array(
            "type" => "dropdown",
            "heading" => __("Map Type", 'moxietheme'),
            "param_name" => "el_type",
            "description" => __("Choose the map type rendering.", 'moxietheme'),
			"value"      => array('ROADMAP' => 'ROADMAP', 'SATELLITE' => 'SATELLITE', 'TERRAIN' => 'TERRAIN', 'HYBRID' => 'HYBRID' ), //Add default value in $atts
        ),*/
		
		/*array(
            "type" => "textfield",
            "heading" => __("Zoom level", 'moxietheme'),
            "param_name" => "el_zoom",
            "description" => __("Set your zoom level - accepts a positive integer value.", 'moxietheme'),
			"value" => '13'
        ),*/
		
		array(
            "type" => "textfield",
            "heading" => __("Map Height", 'moxietheme'),
            "param_name" => "el_height",
            //"description" => __("Set your zoom level - accepts a positive integer value.", 'moxietheme'),
			"value" => '450'
        ),
		
	
	

    )

));