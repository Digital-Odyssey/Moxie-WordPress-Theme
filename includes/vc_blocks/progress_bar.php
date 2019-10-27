<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_progress_bar extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"id" => 1,
			"percentage" => '50',
			"text" => '',
			"bar_color" => '#E9E9E9',
			"track_color" => '#5CC9C1'
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="skill" data-animated="200">
            <div class="name uppercase"><?php esc_attr_e($text); ?></div>
            <div class="bar" style="background-color:<?php esc_attr_e($bar_color); ?>;">
                <div class="value" style="background-color:<?php esc_attr_e($track_color); ?>;">
                    <div class="count"><?php esc_attr_e($percentage); ?></div>
                </div>
            </div>
        </div>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_progress_bar",
    "name"      => __("Progress Bar", 'moxietheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Moxie Shortcodes", 'moxietheme'),
    "params"    => array(
		
		/*array(
            "type" => "dropdown",
            "heading" => __("Element ID Number", 'moxietheme'),
            "param_name" => "el_id",
            "description" => __("Enter a unique ID number to avoid conflicts with multiple progress bars on the same page.", 'moxietheme'),
			"value"      => array( '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10' ), //Add default value in $atts
        ),*/
		
		array(
            "type" => "textfield",
            "heading" => __("Percentage", 'moxietheme'),
            "param_name" => "percentage",
            "description" => __("Enter a positive integer value between 0 and 100.", 'moxietheme'),
			"value" => '50'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Short Message", 'moxietheme'),
            "param_name" => "text",
            "description" => __("Enter a short message to display.", 'moxietheme'),
			"value" => ''
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Bar Color", 'moxietheme'),
            "param_name" => "bar_color",
            //"description" => __("Enter a short message to display.", 'moxietheme'),
			"value" => '#E9E9E9'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Track Color", 'moxietheme'),
            "param_name" => "track_color",
            //"description" => __("Enter a short message to display.", 'moxietheme'),
			"value" => '#5CC9C1'
        ),
		

    )

));