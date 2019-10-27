<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_post_items extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"num_of_posts" => '1',
			"post_order" => 'DESC',
			"text_color" => '#ffffff',
			"blog_url" => '',
			"tag" => '',
			"category" => '',
			"class" => 'wow fadeInUp'
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();
		
		
		//Fetch data
		if($tag !== ''){
			
			$arguments = array(
				'post_type' => 'post',
				'post_status' => 'publish',
				'order' => (string) $post_order,
				'tax_query' => array(
						array(
							'taxonomy' => 'post_tag',
							'field' => 'slug',
							'terms' => array( $tag )
						)
				),
				//'posts_per_page' => -1,
				'posts_per_page' => $num_of_posts,
				'ignore_sticky_posts' => 1
				//'tag' => get_query_var('tag')
			);
			
		} else if($category !== '') {
			
			$arguments = array(
				'post_type' => 'post',
				'post_status' => 'publish',
				'order' => (string) $post_order,
				'tax_query' => array(
						array(
							'taxonomy' => 'category',
							'field' => 'slug',
							'terms' => array( $category )
						)
				),
				//'posts_per_page' => -1,
				'posts_per_page' => $num_of_posts,
				'ignore_sticky_posts' => 1
				//'tag' => get_query_var('tag')
			);
			
		} else {
			
			$arguments = array(
				'post_type' => 'post',
				'post_status' => 'publish',
				//'posts_per_page' => -1,
				'order' => (string) $post_order,
				'posts_per_page' => $num_of_posts,
				'ignore_sticky_posts' => 1
				//'tag' => get_query_var('tag')
			);
			
		}	
		
		$post_query = new WP_Query($arguments);
		
		$animationCounter = 3;

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div<?php echo ($num_of_posts > 3 || $num_of_posts == -1 ? ' id="pm-postItems-carousel"' : ''); ?>>
		
            <?php if ($post_query->have_posts()) : while ($post_query->have_posts()) : $post_query->the_post(); ?>
            
                <?php 
				
					$categories = get_the_category();
			 
					if ( has_post_thumbnail() ) {
					  $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
					}
				
				?>
                
                <?php if($num_of_posts == "1"){ ?>
                    <div class="col-lg-12">
                <?php } elseif($num_of_posts == "2") { ?>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                <?php } elseif($num_of_posts == "3") { ?>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                <?php } else { ?>
                    <div class="pm-postItem-carousel-item">	
                <?php } ?>
                
                    <article>	                    
                        <div class="pm-home-news-post-container" <?php echo ( has_post_thumbnail() ? 'style="background-image:url('. esc_url($image_url[0]) .');"' : '' ); ?>>     
                        
                            <?php foreach ( $categories as $category ) { ?>
                            
                                <?php $cat = get_category( $category ); ?>
                                <a href="<?php echo get_category_link( $cat->term_id ); ?>" class="pm-home-news-post-category"><?php echo $cat->cat_name; ?></a>	
                                
                            <?php } ?>
                        
                            <div class="pm-home-news-post-info-container">
                            
                                <a href="#" class="pm-home-news-post-info-expand-btn"><i class="icon-size-fullscreen"></i></a>                                
                                <div class="pm-home-news-post-links-container">                                
                                    <ul class="pm-home-news-post-links-list">
                                        <li><a href="https://twitter.com/share?url=<?php echo urlencode(get_the_permalink()); ?>&amp;text=<?php echo get_the_title(); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="<?php the_permalink(); ?>"><i class="fa fa-bars"></i></a></li>
                                    </ul>                                
                                </div>
                            
                                <div class="pm-home-news-post-info-meta-container">                                
                                    <ul class="pm-home-news-post-info-meta-list">
                                        <li><i class="icon-clock"></i> <br><?php echo get_the_time( 'M' ); ?> <br><?php echo get_the_time( 'd' ); ?></li>
                                        <li><i class="icon-user"></i> <br><?php echo get_the_author(); ?></li>
                                    </ul>                                
                                </div>
                                
                                <div class="pm-home-news-post-excerpt-container">                                
                                    <h6><a href="<?php the_permalink(); ?>" class="pm-home-news-post-title"><?php the_title(); ?></a></h6>                                    
                                    <?php $excerpt = get_the_excerpt(); ?>                                    
                                    <p class="pm-home-news-post-excerpt"><?php echo moxie_theme_string_limit_words($excerpt, 12); ?> <a href="<?php the_permalink(); ?>">[...]</a></p>                                
                                </div>
                                                            
                                <div class="pm-home-news-post-likes-container">
                                
                                	<?php 
										$likes = get_post_meta(get_the_ID(), 'pm_total_likes', true);
										$views = get_post_meta(get_the_ID(), 'post_views', true);
										$comments = get_comments_number( get_the_ID() );
									?>
                                
                                    <ul class="pm-home-news-post-likes-list">
                                        <li><i class="icon-eye"></i> <?php echo ( $views !== '' ? $views : '0' ); ?></li>
                                        <li><i class="icon-bubble"></i> <?php echo $comments ?></li>
                                        <li><a href="#" id="<?php echo get_the_ID(); ?>" class="icon-heart pm-like-this-btn"></a> <span id="pm-post-total-likes-count-<?php echo get_the_ID(); ?>"><?php echo ( $likes !== '' ? $likes : '0' ); ?></span></li>
                                    </ul>                                
                                </div>                                                        
                            </div>                            
                        </div>                                            
                    </article>
                    
                    <?php $animationCounter += 3; ?>
                
                </div>
                
                
            
            <?php endwhile; else: ?>
                <div class="col-lg-12 pm-column-spacing">
                	<p><?php esc_attr_e('No posts were found.', 'moxietheme'); ?></p>
                </div>
            <?php endif; ?>
                    
        </div>
        
         <?php if($blog_url !== '') : ?>
            
            <div class="row">
                <div class="col-lg-12 pm-center pm-containerPadding-top-60 pm-news-shortcode-blog-continue-container">
                    <a class="pm-home-news-post-continue" href="<?php echo esc_url($blog_url); ?>"><?php esc_attr_e('Continue to blog','moxietheme'); ?> &nbsp;<i class="fa fa-angle-right"></i></a>
                </div>
            </div>
        
        <?php endif; ?>
                    
        <?php wp_reset_postdata(); ?>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_post_items",
    "name"      => __("News Posts", 'moxietheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Moxie Shortcodes", 'moxietheme'),
    "params"    => array(
		
		array(
            "type" => "dropdown",
            "heading" => __("Amount of News Posts to display:", 'moxietheme'),
            "param_name" => "num_of_posts",
            "description" => __("Choose how many news posts you would like to display. A value of -1 will retrieve all news posts.", 'moxietheme'),
			"value"      => array( '-1' => '-1', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10' ), //Add default value in $atts
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Post Order", 'moxietheme'),
            "param_name" => "post_order",
            "description" => __("Set the order in which news posts will be displayed.", 'moxietheme'),
			"value"      => array( 'DESC' => 'DESC', 'ASC' => 'ASC'), //Add default value in $atts
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Text Color", 'moxietheme'),
            "param_name" => "text_color",
            //"description" => __("Enter a tag slug to display news posts by a specific tag.", 'moxietheme'),
			"value"      => '#ffffff', //Add default value in $atts
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Blog URL", 'moxietheme'),
            "param_name" => "blog_url",
            "description" => __("Leave this field blank if you do not wish to display th Blog link.", 'moxietheme'),
			"value"      => '', //Add default value in $atts
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Tag slug", 'moxietheme'),
            "param_name" => "tag",
            "description" => __("Enter a tag slug to display news posts by a specific tag.", 'moxietheme'),
			"value"      => '', //Add default value in $atts
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Category slug", 'moxietheme'),
            "param_name" => "category",
            "description" => __("Enter a category slug to display news posts by a specific category.", 'moxietheme'),
			"value"      => '', //Add default value in $atts
        ),
		
		/*array(
            "type" => "textfield",
            "heading" => __("Class", 'moxietheme'),
            "param_name" => "class",
            "description" => __("Apply a custom CSS class if required.", 'moxietheme'),
			"value"      => 'wow fadeInUp', //Add default value in $atts
        ),*/

    )

));