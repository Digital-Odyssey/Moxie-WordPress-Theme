<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_client_carousel extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"target" => '_self',
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

		//Redux options
		global $moxie_options;

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <?php if($moxie_options) : ?>        
        	<?php $clients = $moxie_options['opt-client-slides']; ?>	
            <div id="pm-brands-carousel" class="owl-carousel owl-theme">            
            	<?php if(count($clients) > 0) { ?>                
                	<?php foreach($clients as $c) { ?>            
                        <div class="pm-brand-item">
                            <span></span>
                            <a href="<?php echo esc_url($c['url']); ?>" target="<?php esc_attr_e($target); ?>"><?php esc_attr_e($c['title']); ?></a>
                            <img src="<?php echo esc_url($c['image']); ?>" class="img-responsive" alt="<?php esc_attr_e($c['title']); ?>">
                        </div>	                    
                    <?php }//end of foreach ?>                
                <?php } ?>                
            </div>            
            <div class="pm-brand-carousel-btns" id="pm-brand-carousel-btns"><a class="btn pm-owl-prev fa fa-chevron-left"></a><a class="btn pm-owl-play fa fa-play" id="pm-owl-play"></a><a class="btn pm-owl-next fa fa-chevron-right"></a></div>        
        <?php endif;//end of if ?>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_client_carousel",
    "name"      => __("Client Carousel", 'moxietheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Moxie Shortcodes", 'moxietheme'),
    "params"    => array(
	
		array(
            "type" => "dropdown",
            "heading" => __("Target Window", 'moxietheme'),
            "param_name" => "target",
            "description" => __("Set the target window panel link.", 'moxietheme'),
			"value"      => array( '_self' => '_self', '_blank' => '_blank' ), //Add default value in $atts
        ),

    )

));