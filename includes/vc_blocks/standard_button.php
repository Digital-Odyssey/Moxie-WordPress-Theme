<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_standard_button extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"link" => '#',
			"btn_text" => '',
			"margin_top" => 0,
			"margin_bottom" => 0,
			"target" => '_self',
			"icon" => 'fa fa-chevron-right',
			"text_color" => '#ffffff',
			"bg_color" => '#5CC9C1',
			"animated" => 'off',
			"class" => '',
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->	
        
        <a class="pm-rounded-btn <?php echo ($class !== '' ? esc_attr($class) : ''); ?> <?php echo ( $animated == 'on' ? 'animated' : '' ); ?>" href="<?php echo esc_url($link); ?>" target="<?php esc_attr_e($target); ?>" style="margin-top:<?php esc_attr_e($margin_top); ?>px; background-color:<?php esc_attr_e($bg_color); ?>; color:<?php esc_attr_e($text_color); ?> !important; margin-bottom:<?php esc_attr_e($margin_bottom); ?>px;"><?php esc_attr_e($btn_text); ?> <?php echo ($icon !== '' ? ' &nbsp;<i class="'. esc_attr($icon) .'"></i>' : ''); ?></a>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_standard_button",
    "name"      => __("Button", 'moxietheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Moxie Shortcodes", 'moxietheme'),
    "params"    => array(

	
		array(
            "type" => "textfield",
            "heading" => __("Link", 'moxietheme'),
            "param_name" => "link",
            //"description" => __("Enter a CSS class if required.", 'moxietheme'),
			"value" => '#'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Button Text", 'moxietheme'),
            "param_name" => "btn_text",
            //"description" => __("Enter a CSS class if required.", 'moxietheme'),
			"value" => ''
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Margin Top", 'moxietheme'),
            "param_name" => "margin_top",
            "description" => __("Enter a positive integer value.", 'moxietheme'),
			"value" => 0
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Margin Bottom", 'moxietheme'),
            "param_name" => "margin_bottom",
            "description" => __("Enter a positive integer value.", 'moxietheme'),
			"value" => 0
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Target Window", 'moxietheme'),
            "param_name" => "target",
            "description" => __("Set the target window for the button.", 'moxietheme'),
			"value"      => array( '_self' => '_self', '_blank' => '_blank' ), //Add default value in $atts
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Icon", 'moxietheme'),
            "param_name" => "icon",
            "description" => __("Enter a FontAwesome 4 icon value. (Ex. fa fa-chevron-right)", 'moxietheme'),
			"value" => 'fa fa-chevron-right'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Text Color", 'moxietheme'),
            "param_name" => "text_color",
            //"description" => __("Enter an icon value.", 'moxietheme'),
			"value" => '#ffffff'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Background Color", 'moxietheme'),
            "param_name" => "bg_color",
            //"description" => __("Enter an icon value.", 'moxietheme'),
			"value" => '#5CC9C1'
        ),
		
		
		array(
            "type" => "dropdown",
            "heading" => __("Animated", 'moxietheme'),
            "param_name" => "animated",
            "description" => __("Adds a rollover animation to the icon.", 'moxietheme'),
			"value"      => array( 'off' => 'off', 'on' => 'on' ), //Add default value in $atts
        ),
	
		array(
            "type" => "textfield",
            "heading" => __("Class", 'moxietheme'),
            "param_name" => "class",
            "description" => __("Apply a custom CSS class if required.", 'moxietheme'),
			"value" => ''
        ),


    )

));