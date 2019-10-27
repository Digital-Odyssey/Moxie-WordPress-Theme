<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_milestone extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"speed" => "",
			"stop" => "",
			"caption" => "",
			"icon" => "",
			"icon_color" => '#ffffff',
			"bg_color" => '#164d61',
			"text_color" => '#0db7c4',
			"text_size" => '16',
			"border_radius" => '99',
			"padding" => '35',
			"width" => "160",
			"height" => "160",
			"font_size" => '90',	
			"line_height" => '1'	
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="milestone">
            <?php if($icon !== '') : ?>
            
            	<i class="<?php esc_attr_e($icon); ?>" style="background-color:<?php esc_attr_e($bg_color); ?>; line-height:<?php esc_attr_e($line_height); ?>; color:<?php esc_attr_e($icon_color); ?>; border-radius:<?php esc_attr_e($border_radius); ?>px; padding:<?php esc_attr_e($padding); ?>px; font-size:<?php esc_attr_e($font_size); ?>px; width:<?php esc_attr_e($width); ?>px; height:<?php esc_attr_e($height); ?>px;"></i>
            <?php endif; ?>
            <div class="milestone-content" style="font-size:<?php esc_attr_e($font_size); ?>px;">                         
                <span data-speed="<?php esc_attr_e($speed); ?>" data-stop="<?php esc_attr_e($stop); ?>" class="milestone-value" style="color:<?php esc_attr_e($text_color); ?>;"></span>
                <div class="milestone-description" style="font-size:<?php esc_attr_e($text_size); ?>px;"><?php esc_attr_e($caption); ?></div>
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

    "base"      => "pm_ln_milestone",
    "name"      => __("Milestone", 'moxietheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Moxie Shortcodes", 'moxietheme'),
    "params"    => array(
	

		array(
            "type" => "textfield",
            "heading" => __("Speed", 'moxietheme'),
            "param_name" => "speed",
            "description" => __("Enter a positive integer value.", 'moxietheme'),
			"value" => ''
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Stop value", 'moxietheme'),
            "param_name" => "stop",
            "description" => __("Enter a positive integer value.", 'moxietheme'),
			"value" => ''
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Caption", 'moxietheme'),
            "param_name" => "caption",
            "description" => __("Enter a short caption.", 'moxietheme'),
			"value" => ''
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Icon", 'moxietheme'),
            "param_name" => "icon",
            "description" => __("Enter a FontAwesome 4 icon value. (Ex. fa fa-cog)", 'moxietheme'),
			"value" => ''
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Icon Color", 'moxietheme'),
            "param_name" => "icon_color",
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'moxietheme'),
			"value" => '#ffffff'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Background Color", 'moxietheme'),
            "param_name" => "bg_color",
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'moxietheme'),
			"value" => '#164d61'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Text Color", 'moxietheme'),
            "param_name" => "text_color",
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'moxietheme'),
			"value" => '#0db7c4'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Text Size", 'moxietheme'),
            "param_name" => "text_size",
            "description" => __("Accepts a positive integer value.", 'moxietheme'),
			"value" => '16'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Border Radius", 'moxietheme'),
            "param_name" => "border_radius",
            "description" => __("Accepts a positive integer value.", 'moxietheme'),
			"value" => '99'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Padding", 'moxietheme'),
            "param_name" => "padding",
            "description" => __("Accepts a positive integer value.", 'moxietheme'),
			"value" => '35'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Width", 'moxietheme'),
            "param_name" => "width",
            "description" => __("Accepts a positive integer value.", 'moxietheme'),
			"value" => '160'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Height", 'moxietheme'),
            "param_name" => "height",
            "description" => __("Accepts a positive integer value.", 'moxietheme'),
			"value" => '160'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Font Size", 'moxietheme'),
            "param_name" => "font_size",
            "description" => __("Accepts a positive integer value.", 'moxietheme'),
			"value" => '90'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Line Height", 'moxietheme'),
            "param_name" => "line_height",
            "description" => __("Control the vertical positioning of the icon. Accepts a positive integer value.", 'moxietheme'),
			"value" => '1'
        ),
						

    )

));