<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_gallery_items extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"post_order" => 'DESC',
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();
		
		$arguments = array(
			'post_type' => 'post_galleries',
			'post_status' => 'publish',
			//'posts_per_page' => -1,
			'order' => (string) $post_order,
			'posts_per_page' => -1,
			//'tag' => get_query_var('tag')
		);
		
		$post_query = new WP_Query($arguments);
		
		$terms = get_terms('gallerycats');

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="pm-portfolio-system-filter-container">
	
            <ul class="pm-portfolio-system-filter" id="pm-portfolio-system-filter">
                        
                <li class="pm-portfolio-system-filter-expand" id="pm-portfolio-system-filter-expand"><?php esc_attr_e('Currently Viewing', 'moxietheme') ?>: <i class="fa fa-angle-down"></i></li>
            
                <li><a id="all" href="#" class="active">all</a></li>
                
                <?php foreach ($terms as $term) { ?>
                    <li><a href="#" id="<?php echo $term->slug; ?>"><?php echo ucfirst($term->name); ?></a></li>	
                <?php } ?>
                
            </ul>
        
            <div class="pm-portfolio-system-filter-active-bar" id="pm-portfolio-system-filter-active-bar"></div>
        
        </div>
        
        
        <?php if ($post_query->have_posts()) { ?>
            <div class="pm-portfolio-system-container" id="gallery-posts"><div id="pm-isotope-item-container"><div class="grid-sizer"></div>
        <?php } ?>
        
        
        <?php if ($post_query->have_posts()) : while ($post_query->have_posts()) : $post_query->the_post(); ?>
        
        	<?php 
			
				$pm_gallery_thumb_image_meta = get_post_meta(get_the_ID(), 'pm_gallery_thumb_image_meta', true);	
				$pm_gallery_image_meta = get_post_meta(get_the_ID(), 'pm_gallery_image_meta', true);	
				$pm_gallery_item_caption_meta = get_post_meta(get_the_ID(), 'pm_gallery_item_caption_meta', true);	
				$likes = get_post_meta(get_the_ID(), 'pm_total_likes', true);	
				
				$pm_featured_project_caption = get_post_meta(get_the_ID(), 'pm_featured_project_caption', true);	
				$pm_enable_video_mode = get_post_meta(get_the_ID(), 'pm_enable_video_mode', true);
				$pm_featured_video_url = get_post_meta(get_the_ID(), 'pm_featured_video_url', true);
			
				$terms = get_the_terms(get_the_ID(), 'gallerycats' );
				$terms_slug_str = '';
				if ($terms && ! is_wp_error($terms)) :
					$term_slugs_arr = array();
					foreach ($terms as $term) {
						$term_slugs_arr[] = $term->slug;
					}
					$terms_slug_str = join(" ", $term_slugs_arr);
				endif;
			
			?>
            
            <div class="isotope-item <?php echo ($terms_slug_str != '' ? $terms_slug_str : ''); ?> all">
                        
                <div class="pm-gallery-post-container">
                
                    <div class="pm-gallery-post-overlay"></div>    
                
                    <div class="pm-gallery-post-img-container">
                        <img src="<?php echo esc_url($pm_gallery_thumb_image_meta); ?>" alt="<?php the_title(); ?>" />
                    </div>
                
                    <div class="pm-gallery-post-like-box-container">
                        <a href="#" class="pm-gallery-post-like-box icon-heart pm-like-this-btn" id="<?php echo get_the_ID(); ?>"></a>
                        
                        <?php if($likes === '') { ?>
                            <span id="pm-post-total-likes-count-<?php echo get_the_ID(); ?>">0</span>
                        <?php } else { ?>
                            <span id="pm-post-total-likes-count-<?php echo get_the_ID(); ?>"><?php echo $likes; ?></span>
                        <?php } ?>
                        
                        
                    </div>
                    
                    <div class="pm-gallery-post-expand-btn-container">
                        <a href="#" class="pm-gallery-post-expand-btn"></a>
                    </div>
                    
                    <div class="pm-gallery-post-details-container">
                        
                        <div class="pm-gallery-post-details">
                            
                            <ul class="pm-gallery-post-details-btns">
                                <li class="pm_tip_static_top" title="<?php esc_attr_e('View Post', 'moxietheme'); ?>" data-tip-offset-x="5" data-tip-offset-y="-27"><a href="<?php the_permalink(); ?>" class="fa fa-bars"></a></li>
                                
                                <?php if( $pm_enable_video_mode === 'yes' ){ ?>
                                    
                                    <li class="pm_tip_static_top" title="<?php esc_attr_e('View Video', 'moxietheme'); ?>" data-tip-offset-x="5" data-tip-offset-y="-27"><a href="//www.youtube.com/watch?v=<?php esc_attr_e($pm_featured_video_url); ?>" data-rel="prettyPhoto1[video]" title="<?php esc_attr_e($pm_featured_project_caption); ?>" class="fa fa-video-camera lightbox"></a></li>	
                                    
                                <?php } else { ?>
                                    
                                    <li class="pm_tip_static_top" title="<?php esc_attr_e('View Image', 'moxietheme'); ?>" data-tip-offset-x="5" data-tip-offset-y="-27"><a href="<?php echo esc_url($pm_gallery_image_meta); ?>" data-rel="prettyPhoto[portfolio]" title="<?php esc_attr_e($pm_featured_project_caption); ?>" class="fa fa-camera lightbox"></a></li>	
                                    
                                <?php } ?>
                                                
                                
                                <li class="pm_tip_static_top" title="<?php esc_attr_e('Close', 'moxietheme'); ?>" data-tip-offset-x="5" data-tip-offset-y="-27"><a href="#" class="fa fa-close pm-gallery-post-details-close-btn"></a></li>
                            </ul>
                            
                            <p class="title"><?php the_title(); ?></p>
                            
                        </div>
                        
                    </div>
                    
                </div>
            </div>
    
        
        <?php endwhile; else: ?>
             <div class="col-lg-12 pm-column-spacing">
             	<p><?php esc_attr_e('No gallery items were found.', 'moxietheme'); ?></p>
             </div>
        <?php endif; ?>
        
        
        <?php if ($post_query->have_posts()) { ?>
            </div></div>
        <?php } ?>
        
        <!-- Element Code / END -->
        
        <?php wp_reset_postdata(); ?>

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_gallery_items",
    "name"      => __("Gallery Posts", 'moxietheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Moxie Shortcodes", 'moxietheme'),
    "params"    => array(
		
		array(
            "type" => "dropdown",
            "heading" => __("Post Order", 'moxietheme'),
            "param_name" => "post_order",
            "description" => __("Set the order in which gallery posts are displayed. DESC = Descending / ASC = Ascending", 'moxietheme'),
			"value"      => array( 'DESC' => 'DESC', 'ASC' => 'ASC' ), //Add default value in $atts
        ),

    )

));