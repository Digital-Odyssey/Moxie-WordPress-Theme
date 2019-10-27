<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_bio_carousel extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"title" => 'Our History',
			"bg_image" => '',
			"parallax" => 'on',
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

		global $moxie_options;
	
		$bioPanels = '';
		$panelCounter1 = 1;
		$panelCounter2 = 1;
					
		if( isset($moxie_options['opt-bio-slides']) && !empty($moxie_options['opt-bio-slides']) ){
			$bioPanels = $moxie_options['opt-bio-slides'];
		}

        ?>
        
        <?php 
			$img = wp_get_attachment_image_src($bg_image, "large"); 
			$bg_image = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="pm-timeline-wrapper <?php echo ($parallax === 'on' ? 'pm-parallax-panel' : ''); ?>" <?php echo ($bg_image !== '' ? 'style="background-image:url('. esc_url($bg_image) .')"' : ''); ?> <?php echo ($parallax === 'on' ? 'data-stellar-background-ratio="0.5"' : ''); ?>>
	
            <div class="pm-timeline-bg-overlay"></div>
            
            <div class="pm-timeline-text-underlay"><div class="pm-timeline-text-underlay-title"><?php esc_attr_e($title); ?></div></div>
            
            <div class="pm-timeline-mobile-title"><?php esc_attr_e($title); ?></div>
        
            <div class="pm-timeline-container" id="pm-timeline-container">
        
            <ul class="pm-timeline-dates">
            
                <?php 
				
				if(is_array($bioPanels)){
                        
                    foreach($bioPanels as $p) {
                        
                        $dashCount = substr_count($p['title'], ' - ');
                        
                        $date = '';
                        $subTitle = '';
                        $icon = '';
                        
                        if($dashCount > 0) {
                        
                            $pieces = explode(" - ", $p['title']);
                        
                            $date = $pieces[0];
                            $subTitle = $pieces[1];
                            $icon = $pieces[2];
                            
                        } else {
                            
                            $date = $p['url'];
                                
                        }
                        
                        if($panelCounter1 == 1) {
                            echo '<li class="active">';
                        } else {
                            echo '<li>';
                        }
                                echo '<i class="'.$icon.'"></i>';
                                echo '<p class="pm-timeline-dates-date">'.$date.'</p>';
                                echo '<p class="pm-timeline-dates-message">'.$subTitle.'</p>';
                            echo '</li>';
                        
                        $panelCounter1++;
                        
                    }//end of foreach
                    
                }//end if
				
				?>
                            
                </ul>
                
                <div class="pm-timeline-controller">
                    
                    <div class="pm-timeline-bar"></div>
                    <a href="#" class="pm-timeline-bar-prev-btn fa fa-chevron-up" id="pm-timeline-bar-prev-btn"></a>
                    <a href="#" class="pm-timeline-bar-next-btn fa fa-chevron-down" id="pm-timeline-bar-next-btn"></a>
                    
                    <div class="pm-timeline-controller-bullet first"></div>
                    <div class="pm-timeline-controller-bullet second"></div>
                    <div class="pm-timeline-controller-bullet third"></div>
                    
                </div>
                
                <ul class="pm-timeline-descriptions">
                
                	<?php 
					
                    if(is_array($bioPanels)){
                        
                        foreach($bioPanels as $p) {
                            
                            $desc = $p['description'];
                            $mainTitle = $p['url'];
                            
                            if($panelCounter2 == 1) {
                                echo '<li class="active">';
                            } else {
                                echo '<li>';
                            }
                                    echo '<span class="pm-timeline-descriptions-title">'.$mainTitle.'</span>';
                                    echo '<div class="pm-timeline-descriptions-divider"></div>';
                                    
                                    echo '<p>'.$desc.'</p>';
                                echo '</li>';
                            
                            $panelCounter2++;
                            
                        }//end of foreach	
                        
                    }//end if
					
					?>
                    
                </ul>
                
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

    "base"      => "pm_ln_bio_carousel",
    "name"      => __("Bio Carousel", 'moxietheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Moxie Shortcodes", 'moxietheme'),
    "params"    => array(
			
		array(
            "type" => "textfield",
            "heading" => __("Title", 'moxietheme'),
            "param_name" => "title",
            //"description" => __("Enter a CSS class if required.", 'moxietheme'),
			"value" => ''
        ),
			
		array(
            "type" => "attach_image",
            "heading" => __("Background Image", 'moxietheme'),
            "param_name" => "bg_image",
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'moxietheme')
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Parallax Mode", 'moxietheme'),
            "param_name" => "parallax",
            "description" => __("Choose the divider style you desire.", 'moxietheme'),
			"value"      => array( 'on' => 'on', 'off' => 'off' ), //Add default value in $atts
        ),
	
		
		

    )

));