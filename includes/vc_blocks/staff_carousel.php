<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_staff_carousel extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"post_order" => 'DESC',
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();
		
		//Method to retrieve a single post
		$arguments = array(
				'post_type' => 'post_staff',
				'post_status' => 'publish',
				//'posts_per_page' => -1,
				'order' => (string) $post_order,
				'posts_per_page' => -1,
				//'tag' => get_query_var('tag')
			);
	
	
		$post_query = new WP_Query($arguments);
				
		$staffCounter1 = 1;
		$staffCounter2 = 1;	

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="pm-staff-member-system" id="pm-staff-member-system">
        
            <ul class="pm-staff-member-system-profile-image-list">
            
                <?php if ($post_query->have_posts()) : while ($post_query->have_posts()) : $post_query->the_post(); ?>
                
                    <?php $pm_staff_image_meta = get_post_meta(get_the_ID(), 'pm_staff_image_meta', true); ?>
                
                    <?php if($staffCounter1 === 1) { ?>
                        <li class="active"><div class="pm-staff-member-system-profile-image profile<?php esc_attr_e($staffCounter1); ?>" style="background-image:url(<?php echo esc_url($pm_staff_image_meta); ?>);"></div></li>
                    <?php } else { ?>
                        <li><div class="pm-staff-member-system-profile-image profile<?php esc_attr_e($staffCounter1); ?>" style="background-image:url(<?php echo esc_url($pm_staff_image_meta); ?>);"></div></li>
                    <?php } ?>
                    
                    <?php $staffCounter1++; ?>
        
               <?php  endwhile; else: endif; ?>
            
            </ul>
            
            
            <div class="pm-staff-member-system-controls<?php echo $staffCounter1 > 2 ? '' : ' hide-controls' ?>">
                <div class="pm-staff-member-system-controls-vertical-divider"></div>
                <div class="pm-staff-member-system-controls-horizontal-divider"></div>
                <a href="#" class="pm-staff-member-system-controls-btn prev fa fa-angle-left"></a>
                <a href="#" class="pm-staff-member-system-controls-btn next fa fa-angle-right"></a>
            </div>
            
            
            <ul class="pm-staff-member-system-bio-list">
            
                <?php if ($post_query->have_posts()) : while ($post_query->have_posts()) : $post_query->the_post(); ?>
                
                	<?php 
					
                    //retrieve post meta
                    $pm_staff_title_meta = get_post_meta(get_the_ID(), 'pm_staff_title_meta', true);
                    $pm_staff_twitter_meta = get_post_meta(get_the_ID(), 'pm_staff_twitter_meta', true);
                    $pm_staff_facebook_meta = get_post_meta(get_the_ID(), 'pm_staff_facebook_meta', true);
                    $pm_staff_gplus_meta = get_post_meta(get_the_ID(), 'pm_staff_gplus_meta', true);
                    $pm_staff_linkedin_meta = get_post_meta(get_the_ID(), 'pm_staff_linkedin_meta', true);
                    $pm_staff_email_address_meta = get_post_meta(get_the_ID(), 'pm_staff_email_address_meta', true);
                    $enableTooltip = get_theme_mod('enableTooltip','on');
					
					?>
        
                    <?php if($staffCounter2 === 1) { ?>
                        <li class="active">
                    <?php } else { ?>
                        <li>
                    <?php } ?>
                        <div class="pm-staff-member-system-bio">
                
                            <p class="pm-staff-member-system-bio-name"><?php the_title(); ?></p>
                            <div class="pm-staff-member-system-bio-divider"></div>
                            <p class="pm-staff-member-system-bio-title"><?php esc_attr_e($pm_staff_title_meta); ?></p>
                            
                            <ul class="pm-staff-member-system-bio-social-icons">
                            
                                <?php if($pm_staff_twitter_meta !== '') : ?>
                                    <li class="<?php echo ($enableTooltip === 'on' ? 'pm_tip_static_top' : ''); ?>" <?php echo ($enableTooltip === 'on' ? 'title="'. __('Twitter', 'moxietheme') .'"' : ''); ?> data-tip-offset-x="5" data-tip-offset-y="-30"><a href="#" class="fa fa-twitter"></a></li>
                                <?php endif; ?>
                                
                                <?php if($pm_staff_facebook_meta !== '') : ?>
                                    <li class="<?php echo ($enableTooltip === 'on' ? 'pm_tip_static_top' : ''); ?>" <?php echo ($enableTooltip === 'on' ? 'title="'. __('Facebook', 'moxietheme') .'"' : '') ?> data-tip-offset-x="5" data-tip-offset-y="-30"><a href="#" class="fa fa-facebook"></a></li>
                                <?php endif; ?>
                                
                                <?php if($pm_staff_gplus_meta !== '') : ?>
                                    <li class="<?php echo ($enableTooltip === 'on' ? 'pm_tip_static_top' : ''); ?>" <?php echo ($enableTooltip === 'on' ? 'title="'. __('Google Plus', 'moxietheme') .'"' : '') ?> data-tip-offset-x="5" data-tip-offset-y="-30"><a href="#" class="fa fa-google-plus"></a></li>
                                <?php endif; ?>
                                
                                <?php if($pm_staff_linkedin_meta !== '') : ?>
                                    <li class="<?php echo ($enableTooltip === 'on' ? 'pm_tip_static_top' : ''); ?>" <?php echo ($enableTooltip === 'on' ? 'title="'. __('Linkedin', 'moxietheme') .'"' : '') ?> data-tip-offset-x="5" data-tip-offset-y="-30"><a href="#" class="fa fa-linkedin"></a></li>
                                <?php endif; ?>
                                
                                <?php if($pm_staff_email_address_meta !== '') : ?>
                                    <li class="<?php echo ($enableTooltip === 'on' ? 'pm_tip_static_top' : ''); ?>" <?php echo ($enableTooltip === 'on' ? 'title="'. __('Email Me!', 'moxietheme') .'"' : ''); ?> data-tip-offset-x="5" data-tip-offset-y="-30"><a href="mailto:'.$pm_staff_email_address_meta.'" class="fa fa-inbox"></a></li>
                                <?php endif; ?>
                                
                            </ul>
                            
                            <p class="pm-staff-member-system-bio-desc"><?php the_excerpt(); ?></p>
                            
                            <div class="pm-staff-member-system-bio-divider-dotted"></div>
                            
                            <a href="<?php the_permalink(); ?>" class="pm-staff-member-system-bio-view-profile"><?php esc_attr_e('View Profile', 'moxietheme'); ?> <i class="fa fa-arrow-circle-o-right"></i></a>
                            
                        </div>
                    </li>
                    
        
                    <?php $staffCounter2++; ?>
        
                <?php endwhile; else: endif; ?>
            
            </ul>
        
        </div>
        
        <!-- Element Code / END -->

		<?php wp_reset_postdata(); ?>

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_staff_carousel",
    "name"      => __("Staff Carousel", 'moxietheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Moxie Shortcodes", 'moxietheme'),
    "params"    => array(
	
		array(
            "type" => "dropdown",
            "heading" => __("Post Order", 'moxietheme'),
            "param_name" => "post_order",
            "description" => __("Set the order in which staff posts are displayed. DESC = Descending / ASC = Ascending", 'moxietheme'),
			"value"      => array( 'DESC' => 'DESC', 'ASC' => 'ASC' ), //Add default value in $atts
        ),

    )

));