<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_content_divider extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $margin_top = $margin_bottom = $divider_style = $fancy_title = $color_selection = '' ;

        extract(shortcode_atts(array(  
			"icon" => 'fa fa-star',
			"margin_top" => 40,
			"margin_bottom" => 20,
		), $atts)); 


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>

        <!-- Element Code start -->
        
       	<div class="pm-divider" style="margin-top:<?php esc_attr_e($margin_top); ?>px; margin-bottom:<?php esc_attr_e($margin_bottom); ?>px;"><span class="pm-divider-left"></span><i class="<?php esc_attr_e($icon); ?> pm-divider-icon"></i><span class="pm-divider-right"></span></div>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_content_divider",
    "name"      => __("Content Divider", 'moxietheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Moxie Shortcodes", 'moxietheme'),
    "params"    => array(
	
		array(
            "type" => "textfield",
            "heading" => __("Icon", 'moxietheme'),
            "param_name" => "icon",
            "description" => __("Accepts a FontAwesome 4 icon value. (Ex. fa fa-star)", 'moxietheme'),
			"value" => 'fa fa-star'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Top Margin", 'moxietheme'),
            "param_name" => "margin_top",
            "description" => __("Accepts a positive integer value.", 'moxietheme'),
			"value" => 40
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Bottom Margin", 'moxietheme'),
            "param_name" => "margin_bottom",
            "description" => __("Accepts a positive integer value.", 'moxietheme'),
			"value" => 20
        ),

    )

));