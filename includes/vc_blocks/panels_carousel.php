<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_panels_carousel extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"target" => '_self',
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();
		
		//Redux options
		global $moxie_options;
		
		$panels = '';
					
		if( isset($moxie_options['opt-panel-slides']) && !empty($moxie_options['opt-panel-slides']) ){
			$panels = $moxie_options['opt-panel-slides'];
		}

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <ul class="pm-interactive-panels-carousel" id="pm-interactive-panels-owl">
	
        <?php if(is_array($panels)){ ?>
                
            <?php 
			
			foreach($panels as $p) {
                
                $pieces = explode(" - ", $p['url']);
                
                $icon = $pieces[0];
                $url = $pieces[1];
				
				?>
                
                <li>
                    <div class="pm-icon-bundle">
                        <i class="<?php esc_attr_e($icon); ?>"></i>
                        <div class="pm-icon-bundle-content">
                            <p><a href="<?php echo esc_url($url); ?>" target="<?php esc_attr_e($target); ?>"><?php echo $p['title']; ?> <i class="fa fa-angle-right"></i></a></p>
                        </div>
                        <div class="pm-icon-bundle-info">
                            <p><?php echo $p['description']; ?></p>
                        </div>
                     </div>
                </li>
                
                <?php
                
            }//end of foreach
			
			?>
            
        <?php }//end of if ?>
                
        </ul>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_panels_carousel",
    "name"      => __("Panels Carousel", 'moxietheme'),
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