<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_contact_form extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"recipient_email" => 'info@microthemes.ca',
			"text_color" => '#FFF',
			"response_color" => '#7F6631',
			"message" => 'Fields marked with * are required',
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="pm-contact-form-container">	
			<form action="#" method="post" id="pm-contact-form">			
				<div class="col-lg-6 col-md-6 col-sm-12 pm-contact-form-column">
					<input name="pm_s_first_name" id="pm_s_first_name" class="pm_text_field" type="text" placeholder="<?php esc_attr_e('First Name *', 'moxietheme'); ?>">
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 pm-contact-form-column">
					<input name="pm_s_last_name" id="pm_s_last_name" class="pm_text_field" type="text" placeholder="<?php esc_attr_e('Last Name *', 'moxietheme'); ?>">
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 pm-contact-form-column">
					<input name="pm_s_email_address" id="pm_s_email_address" class="pm_text_field" type="text" placeholder="<?php esc_attr_e('Email Address *', 'moxietheme'); ?>">
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 pm-contact-form-column">
					<input name="pm_s_phone_number" id="pm_s_phone_number" class="pm_text_field" type="tel" placeholder="<?php esc_attr_e('Phone Number', 'moxietheme'); ?>">
				</div>
				<div class="col-lg-12 pm-clear-element">
					<textarea name="pm_s_message" id="pm_s_message" class="pm_textarea" cols="50" rows="10" placeholder="<?php esc_attr_e('Message *', 'moxietheme'); ?>"></textarea>
				</div>
								
				<div class="col-lg-12 pm-center">
					<a class="pm-contact-form-submit" id="pm-contact-form-btn" href="#"><?php esc_attr_e('Submit', 'moxietheme'); ?></a>
					<div id="pm-contact-form-response" style="color:<?php esc_attr_e($response_color); ?>;"></div>	
					<p class="pm-contact-form-message" style="color:<?php esc_attr_e($text_color); ?>;"><?php esc_attr_e($message); ?></p>
				</div>
				<input type="hidden" name="pm_s_email_address_contact" id="pm_s_email_address_contact" value="<?php esc_attr_e($recipient_email); ?>" />				
				<?php wp_nonce_field('moxie_theme_nonce_action','moxie_theme_send_contact_nonce'); ?>				
			</form>			
		</div>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_contact_form",
    "name"      => __("Contact Form", 'moxietheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Moxie Shortcodes", 'moxietheme'),
    "params"    => array(

		array(
            "type" => "textfield",
            "heading" => __("Recipient email address", 'moxietheme'),
            "param_name" => "recipient_email",
            //"description" => __("Enter a CSS class if required.", 'moxietheme'),
			"value" => 'info@microthemes.ca'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Text Color", 'moxietheme'),
            "param_name" => "text_color",
            //"description" => __("Enter a CSS class if required.", 'moxietheme'),
			"value" => '#ffffff'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Response Color", 'moxietheme'),
            "param_name" => "response_color",
            //"description" => __("Enter a CSS class if required.", 'moxietheme'),
			"value" => '#7F6631'
        ),
		
		array(
            "type" => "textarea",
            "heading" => __("Message", 'moxietheme'),
            "param_name" => "message",
            //"description" => __("Enter a CSS class if required.", 'moxietheme'),
			"value" => 'Fields marked with * are required'
        ),

    )

));