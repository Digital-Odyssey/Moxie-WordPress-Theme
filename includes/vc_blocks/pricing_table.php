<?php

if(!class_exists('WPBakeryShortCode')) return;

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_pm_ln_pricing_table extends WPBakeryShortCodesContainer {
		
		protected function content($atts, $content = null) {

			//$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;
	
			extract(shortcode_atts(array(
				"title" => 'Basic Package',
				"featured" => 'no',
				"featured_icon" => 'fa fa-thumbs-up',
				"price" => '19',
				"payment_text" => 'Choose to pay monthly or annually at a discounted price of $149.99',
				"currency_symbol" => '$',
				"subscript" => '/ mo',
				"button_text" => 'Purchase Plan',
				"button_link" => '#',
				"target_window" => '_self',
				"button_message" => '* valid credit card required',
				"bg_image" => ''
			), $atts));
	
	
			/* ================  Render Shortcodes ================ */
	
			ob_start();
	
			?>
			
			<?php 
				$img = wp_get_attachment_image_src($bg_image, "large"); 
				$bg_image = $img[0];
			?>
	
			<!-- Element Code start -->
			<?php if( $bg_image !== '' ) { ?>
				<div class="pm-pricing-table-container" style="background-image:url(<?php echo esc_url($bg_image); ?>)">
			<?php } else { ?>
				<div class="pm-pricing-table-container">
			<?php } ?>	
				<div class="pm-pricing-table-title-container">
					<p><?php esc_attr_e($title); ?></p>
					<?php if($featured === 'yes') { ?>
						<div class="pm-pricing-table-featured-icon">
							<i class="<?php esc_attr_e($featured_icon); ?>"></i>
						</div>
					<?php } ?>
				</div>
				<div class="pm-pricing-table-pricing-container">
					<p class="price"><?php esc_attr_e($currency_symbol); ?> <?php esc_attr_e($price); ?> <sub><?php esc_attr_e($subscript); ?></sub></p>
					<p class="desc"><?php esc_attr_e($payment_text); ?></p>
				</div>
				<ul><?php echo $content; ?></ul>
				<div class="pm-pricing-table-purchase-container">
					<a href="<?php echo esc_url($button_link); ?>" target="<?php esc_attr_e($target_window); ?>"><?php esc_attr_e($button_text); ?> <i class="fa fa-arrow-circle-o-right"></i></a>
					<p><?php esc_attr_e($button_message); ?></p>
				</div>
			</div>
			<!-- Element Code / END -->
	
			<?php
	
			$output = ob_get_clean();
	
			/* ================  Render Shortcodes ================ */
	
			return $output;
	
		}
		
    }
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_pm_ln_pricing_table_item extends WPBakeryShortCode {
		
		protected function content($atts, $content = null) {

			//$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;
	
			extract(shortcode_atts(array(
				"title" => 'iOS 8 DESIGN',
				"sub_title" => 'Fundamentals',
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
            <li>
                <a href="#" class="pm-pricing-table-details-expander fa fa-angle-down"></a>
                    <div class="pm-pricing-table-details-container">
                    <p class="title"><?php esc_attr_e($title); ?></p>
                    <p class="sub-title"><?php esc_attr_e($sub_title); ?></p>
                    <div class="pm-pricing-table-details-info">
                        <?php echo $content ?>
                    </div>
                </div>
            </li>
			<!-- Element Code / END -->
	
			<?php
	
			$output = ob_get_clean();
	
			/* ================  Render Shortcodes ================ */
	
			return $output;
	
		}
		
    }
}


vc_map( array(
    "name" => __("Pricing Table", 'moxietheme'),
    "base" => "pm_ln_pricing_table",
	"category"  => __("Moxie Shortcodes", 'moxietheme'),
    "as_parent" => array('only' => 'pm_ln_pricing_table_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element" => true,
    "show_settings_on_create" => false,
    "is_container" => true,
    "params" => array(
	
        // add params same as with any other content element
       array(
            "type" => "textfield",
            "heading" => __("Title", 'moxietheme'),
            "param_name" => "title",
			"value" => 'Basic Package'
            //"description" => __("Enter a CSS class if required.", 'moxietheme')
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Featured Icon", 'moxietheme'),
            "param_name" => "featured_icon",
			"value" => 'fa fa-thumbs-up',
            "description" => __("Accepts a FontAwesome 4 value. (Ex. fa fa-thumbs-up)", 'moxietheme')
        ),			
	
		array(
            "type" => "dropdown",
            "heading" => __("Featured?", 'moxietheme'),
            "param_name" => "featured",
            "description" => __("Display a featured icon symbol.", 'moxietheme'),
			"value"      => array( 'no' => 'no', 'yes' => 'yes' ), //Add default value in $atts
        ),		
		
		array(
            "type" => "textfield",
            "heading" => __("Price", 'moxietheme'),
            "param_name" => "price",
			"value" => '19'
            //"description" => __("Enter a CSS class if required.", 'moxietheme')
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Message", 'moxietheme'),
            "param_name" => "payment_text",
			"value" => 'Choose to pay monthly or annually at a discounted price of $149.99'
            //"description" => __("Enter a CSS class if required.", 'moxietheme')
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Currency Symbol", 'moxietheme'),
            "param_name" => "currency_symbol",
			"value" => '$'
            //"description" => __("Enter a CSS class if required.", 'moxietheme')
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Subscript", 'moxietheme'),
            "param_name" => "subscript",
			"value" => '/mo'
            //"description" => __("Enter a CSS class if required.", 'moxietheme')
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Button Text", 'moxietheme'),
            "param_name" => "button_text",
			"value" => 'Purchase Plan'
            //"description" => __("Enter a CSS class if required.", 'moxietheme')
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Button URL", 'moxietheme'),
            "param_name" => "button_link",
			"value" => '#'
            //"description" => __("Enter a CSS class if required.", 'moxietheme')
        ),
		
		
		array(
            "type" => "dropdown",
            "heading" => __("Target Window", 'moxietheme'),
            "param_name" => "target_window",
            //"description" => __("Display a featured icon symbol.", 'moxietheme'),
			"value"      => array( '_self' => '_self', '_blank' => '_blank' ), //Add default value in $atts
        ),	
		
		array(
            "type" => "textfield",
            "heading" => __("Button Message", 'moxietheme'),
            "param_name" => "button_message",
			"value" => '* valid credit card required'
            //"description" => __("Enter a CSS class if required.", 'moxietheme')
        ),
		
		array(
            "type" => "attach_image",
            "heading" => __("Background Image", 'moxietheme'),
            "param_name" => "bg_image",
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'moxietheme')
        ),
	   
    ),
    "js_view" => 'VcColumnView'
) );

vc_map( array(
    "name" => __("Pricing Table Info Box", 'moxietheme'),
    "base" => "pm_ln_pricing_table_item",
	"category"  => __("Moxie Shortcodes", 'moxietheme'),
    "content_element" => true,
    "as_child" => array('only' => 'pm_ln_pricing_table'), // Use only|except attributes to limit parent (separate multiple values with comma)
    "params" => array(
	
        // add params same as with any other content element
        array(
            "type" => "textfield",
            "heading" => __("Title", 'moxietheme'),
            "param_name" => "title",
            //"description" => __("Enter a title", 'moxietheme'),
			"value" => 'iOS 8 DESIGN'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Sub-Title", 'moxietheme'),
            "param_name" => "sub_title",
            //"description" => __("Enter a title", 'moxietheme'),
			"value" => 'Fundamentals'
        ),
		
		array(
            "type" => "textarea_html",
            "heading" => __("Content", 'moxietheme'),
            "param_name" => "content",
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'moxietheme')
        ),
		
    )
) );