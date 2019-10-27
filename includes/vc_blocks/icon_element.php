<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_icon_element extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"button_mode" => 'off',
			"link" => '#',
			"target_window" => '_self',
			"icon" => 'fa fa-twitter',
			"icon_color" => '#164D61',
			"icon_size" => 30,
			"width" => 50,
			"height" => 50,
			"padding" => 14,
			"border_color" => '#164D61',
			"margin_top" => 20,
			"margin_bottom" => 20
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <?php if( $button_mode === 'on' ){ ?>
        
            <a href="<?php echo esc_url($link); ?>" target="<?php echo esc_url($target_window); ?>" class="<?php esc_attr_e($icon); ?> pm-icon-btn btn-mode" style="color:<?php esc_attr_e($icon_color); ?>; margin-top:<?php esc_attr_e($margin_top); ?>px; margin-bottom:<?php esc_attr_e($margin_bottom); ?>px; font-size:<?php esc_attr_e($icon_size); ?>px !important; width:<?php esc_attr_e($width); ?>px; height:<?php esc_attr_e($height); ?>px; padding:<?php esc_attr_e($padding); ?>px; border:3px solid <?php esc_attr_e($border_color); ?>;"></a>
            
        <?php } else { ?>
        
            <i class="<?php esc_attr_e($icon); ?> pm-icon-btn" style="color:<?php esc_attr_e($icon_color); ?>; margin-top:<?php esc_attr_e($margin_top); ?>px; margin-bottom:<?php esc_attr_e($margin_bottom); ?>px; font-size:<?php esc_attr_e($icon_size); ?>px !important; width:<?php esc_attr_e($width); ?>px; height:<?php esc_attr_e($height); ?>px; padding:<?php esc_attr_e($padding); ?>px; border:3px solid <?php esc_attr_e($border_color); ?>;"></i>
            
        <?php } ?>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_icon_element",
    "name"      => __("Icon Element", 'moxietheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Moxie Shortcodes", 'moxietheme'),
    "params"    => array(

		array(
            "type" => "dropdown",
            "heading" => __("Button Mode", 'moxietheme'),
            "param_name" => "button_mode",
            //"description" => __("", 'moxietheme'),
			"value"      => array( 'off' => 'off', 'on' => 'on' ), //Add default value in $atts
        ),


		array(
            "type" => "textfield",
            "heading" => __("Link", 'moxietheme'),
            "param_name" => "link",
            //"description" => __("Leave this field blank if you wish to only display the icon.", 'moxietheme'),
			"value" => '#'
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Target Window", 'moxietheme'),
            "param_name" => "target_window",
            //"description" => __("", 'moxietheme'),
			"value"      => array( '_self' => '_self', '_blank' => '_blank' ), //Add default value in $atts
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Icon", 'moxietheme'),
            "param_name" => "icon",
            "description" => __("Accepts a FontAwesome 4 icon value. (Ex. fa fa-twitter)", 'moxietheme'),
			"value" => 'fa fa-twitter'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Icon Color", 'moxietheme'),
            "param_name" => "icon_color",
            //"description" => __("Accepts a FontAwesome 4 or Lineicons value.", 'moxietheme'),
			"value" => '#164D61'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Icon Size", 'moxietheme'),
            "param_name" => "icon_size",
            "description" => __("Accepts a positive integer value.", 'moxietheme'),
			"value" => 30
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Width", 'moxietheme'),
            "param_name" => "width",
            "description" => __("Accepts a positive integer value.", 'moxietheme'),
			"value" => 50
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Height", 'moxietheme'),
            "param_name" => "height",
            "description" => __("Accepts a positive integer value.", 'moxietheme'),
			"value" => 50
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Padding", 'moxietheme'),
            "param_name" => "padding",
            "description" => __("Accepts a positive integer value.", 'moxietheme'),
			"value" => 14
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Border Color", 'moxietheme'),
            "param_name" => "border_color",
            //"description" => __("Accepts a FontAwesome 4 or Lineicons value.", 'moxietheme'),
			"value" => '#164D61'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Margin Top", 'moxietheme'),
            "param_name" => "margin_top",
            "description" => __("Accepts a positive integer value.", 'moxietheme'),
			"value" => 20
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Margin Bottom", 'moxietheme'),
            "param_name" => "margin_bottom",
            "description" => __("Accepts a positive integer value.", 'moxietheme'),
			"value" => 20
        ),
		
		

    )

));