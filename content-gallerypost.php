<?php
/**
 * The default template for displaying a single post.
 */
?>

<?php 

	 $categories = wp_get_post_terms($post->ID,'gallerycats');
	 
	 
	 $num_comments = get_comments_number();
	 $comments = '';
	 
	 if ( has_post_thumbnail()) {
	   $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
	 }
	 
	 $post_classes = array(
		'pm-column-spacing',
		'news-post',
	 );
	 	 
	 $likes = get_post_meta(get_the_ID(), 'pm_total_likes', true);
	 
	 //Caption
	 $pm_featured_project_caption = get_post_meta(get_the_ID(), 'pm_featured_project_caption', true);
	 
	 //Slideshow
	 $pm_enable_slider_system = get_post_meta(get_the_ID(), 'pm_enable_slider_system', true);
	 $pm_featured_projects_gallery_images = get_post_meta(get_the_ID(), 'pm_featured_projects_gallery_images', true);
	 
	 //Video
	 $pm_enable_video_mode = get_post_meta(get_the_ID(), 'pm_enable_video_mode', true);
	 $pm_featured_video_url = get_post_meta(get_the_ID(), 'pm_featured_video_url', true);
	 
	 $displaySocialFeatures = get_theme_mod('enableTooltip','on');
	 $enableTooltip = get_theme_mod('enableTooltip','on');
	              
?>

<!-- PANEL 1 -->
<div class="container pm-containerPadding-top-110 pm-containerPadding-bottom-80 container-scroll">

    <div class="row">
        
        <!-- Blog post area -->
        <div class="col-lg-12">
            
            <!-- Blog post -->
            <article <?php post_class($post_classes); ?>>
            
            
            	<?php 
				
					if($pm_enable_video_mode === 'yes') {
												
						echo '<iframe src="//www.youtube.com/embed/'.esc_attr($pm_featured_video_url).'" height="400" allowfullscreen></iframe>';
						
					} else if($pm_enable_slider_system === 'yes') {
						
						if( is_array($pm_featured_projects_gallery_images) ){
						
							echo '<div class="flexslider" id="pm-gallery-post-slider"><ul class="slides">';
							
								foreach($pm_featured_projects_gallery_images as $img) {
									echo '<li><img src="'.esc_url(esc_html($img)).'"></li>';	
								}
							
							echo'</ul></div>';
							
						}
						
					} else {
						//nothing	
					}
				
								
				?>                
            
                <div class="pm-news-post-container single-post">

                    
                    <div class="pm-news-post-title-container">
                        <h2 class="pm-news-post-title">
							<?php if(is_sticky()) : ?>
                                <i class="fa fa-thumb-tack pm-primary pm-sticky-icon"></i>&nbsp;
                            <?php endif; ?>
                            <?php the_title(); ?>
                        </h2>
                        <p class="pm-news-post-date">
                        	<i class="fa fa-clock-o"></i> <?php the_time( 'M' ); ?> <?php the_time( 'd' ); ?>, <?php the_time( 'Y' ); ?> &nbsp; <i class="fa fa-user"></i> <?php the_author(); ?>
                        	<?php if ( !has_post_thumbnail()) : ?>
                                &nbsp; <a href="#" class="fa fa-thumbs-up pm-like-this-btn <?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top' : '' ?>" <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Like This', 'moxietheme') .'"' : '' ?> data-tip-offset-x="-5" data-tip-offset-y="-50" id="<?php echo get_the_ID(); ?>"></a> <span id="pm-post-total-likes-count-<?php echo get_the_ID(); ?>"><?php echo esc_attr($likes); ?></span>   
                            <?php endif; ?>
                        </p>
                    </div>
                    
                    <div class="pm-news-post-divider single-post"></div>
                    
                    <div class="pm-news-post-content">
                    
                        <?php the_content(); ?>
                        <?php 
    
							$pag_defaults = array(
									'before'           => '<p>' . esc_html__( 'READ MORE:', 'moxietheme' ),
									'after'            => '</p>',
									'link_before'      => '',
									'link_after'       => '',
									'next_or_number'   => 'number',
									'separator'        => ' ',
									'nextpagelink'     => '',
									'previouspagelink' => '',
									'pagelink'         => '%',
									'echo'             => 1
								);
							
							wp_link_pages($pag_defaults); 
						
						?>
                    
                    </div>
                    
                    <div class="pm-news-post-divider margin-top-20 single-post"></div>
                    
                    <div class="pm-single-post-meta">
                    
                    	<?php if ( !has_post_thumbnail()) : ?>
                        
                        	<?php 
         
		 						echo '<ul class="pm-single-post-tags-list">';
									echo '<li><i class="fa fa-folder"></i></li>';
								
									foreach ( $categories as $category ) {
										$term_link = get_term_link( $category );
										echo '<li><a href="'.esc_attr($term_link).'">'.esc_attr($category->name).'</a></li>';	
									}
								
								echo '</ul>';
                             
                            ?>
                        
                        <?php endif; ?>
                    
                    	<?php if(has_tag()) : ?>
                
                			<ul class="pm-single-post-tags-list">
                                <li><i class="fa fa-tags"></i></li>
                                <?php the_tags('<li>', '</li><li>', '</li>'); ?>
                            </ul>
                                                    
                        <?php endif; ?>
                        
                        
                         <?php if($displaySocialFeatures === 'on') : ?>
							<?php get_template_part('content', 'postoptions'); ?>
                         <?php endif; ?>
                        
                    </div>
                    
                    
                </div>
                
            </article>
            <!-- Blog post end -->
            
        </div>
        <!-- Blog post area end -->
        
    </div><!-- /.row --> 

</div>
<!-- PANEL 1 end -->
