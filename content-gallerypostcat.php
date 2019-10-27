<?php
/**
 * The default template for displaying a single post.
 */
?>

<?php 
	 
	 $categories = wp_get_post_terms($post->ID,'gallerycats');
	 $pm_gallery_image_meta = get_post_meta(get_the_ID(), 'pm_gallery_image_meta', true);
	              
?>

<!-- Blog post 1 -->
<article <?php post_class($post_classes); ?> id="article-<?php echo get_the_ID(); ?>">

    <div class="pm-news-post-container">
        
        <?php if ( $pm_gallery_image_meta !== '' ) : ?>
            <div class="pm-news-post-img-container">
                
                <div class="pm-news-post-image">
                
                    <div class="pm-gallery-post-expand-btn-container-blog">
                    
                    	<?php 
							$likes = get_post_meta(get_the_ID(), 'pm_total_likes', true);
						?>
                    
                    	<ul class="pm-home-news-post-likes-list post">
                            <li><a href="#" id="<?php echo get_the_ID(); ?>" class="icon-heart pm-like-this-btn"></a> <span id="pm-post-total-likes-count-<?php echo get_the_ID(); ?>"><?php echo esc_attr($likes) !== '' ? esc_attr($likes) : '0'; ?></span></li>
                        </ul>
                    
                        <a href="#" class="pm-gallery-post-expand-btn-blog"></a>
                        
                    </div>
                    
                    <img src="<?php echo esc_url(esc_html($pm_gallery_image_meta)); ?>" width="<?php echo esc_attr($image_url[1]); ?>" height="<?php echo esc_attr($image_url[2]); ?>" alt="<?php the_title(); ?>" />
                    
                </div>
                            
                <?php 
         
                    foreach ( $categories as $category ) {
                        $cat = get_category( $category );
                        echo '<a href="'.get_category_link( $cat->term_id ).'" class="pm-news-post-category">'.esc_attr($cat->cat_name).'</a>';	
                    }
                 
                ?>
                
            </div>
        <?php endif; ?>
        
        <div class="pm-news-post-title-container">
            <h2 class="pm-news-post-title">
				<?php if(is_sticky()) : ?>
                	<i class="fa fa-thumb-tack pm-primary pm-sticky-icon"></i>&nbsp;
                <?php endif; ?>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>
            <p class="pm-news-post-date"><i class="fa fa-clock-o"></i> <?php the_time( 'M' ); ?> <?php the_time( 'd' ); ?>, <?php the_time( 'Y' ); ?> &nbsp; <i class="fa fa-user"></i> <?php the_author(); ?>
            	<?php if ( !$pm_gallery_image_meta ) : ?>
                    &nbsp; <a href="#" class="fa fa-thumbs-up pm-like-this-btn" id="<?php echo get_the_ID(); ?>"></a> <span id="pm-post-total-likes-count-<?php echo get_the_ID(); ?>"><?php echo esc_attr($likes); ?></span>   
                <?php endif; ?>
            </p>
        </div>
        
        <div class="pm-news-post-divider"></div>
        
        <a href="<?php the_permalink(); ?>" class="pm-news-post-btn fa fa-arrow-circle-o-right"></a>
        
        <p class="pm-news-post-excerpt"><?php $excerpt = get_the_excerpt(); echo esc_attr(pm_ln_string_limit_words($excerpt, 40)); ?> <a href="<?php the_permalink(); ?>">[...]</a></p>
        
        <a href="<?php the_permalink(); ?>" class="pm-news-post-btn-mobile fa fa-arrow-circle-o-right"></a>
        
    </div>
    
</article>
<!-- Blog post 1 end -->