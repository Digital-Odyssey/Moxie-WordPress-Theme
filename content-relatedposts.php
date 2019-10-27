<?php
	//The default template for retrieving related blog post(s)
	
	$tags = wp_get_post_tags(get_the_ID());  
	
?>

<?php if (!empty($tags)) : ?>

	<div class="container pm-containerPadding-top-100 pm-containerPadding-bottom-70 container-scroll" id="related-posts">
        <div class="row">
            <div class="col-lg-12">
            
                <h4 class="pm-primary"><?php esc_html_e('Related Posts', 'moxietheme') ?></h4>
                
                <div class="pm-single-blog-post-related-posts">
    
        
                        <?php  
                                                                
                            $tag_ids = array();  
                        
                            foreach($tags as $individual_tag) {
                                $tag_ids[] = $individual_tag->term_id; 
                            }
                         
                            $args = array(  
                                'tag__in' => $tag_ids,  
                                'post__not_in' => array(get_the_ID()),  
                                'posts_per_page' => 4, // Number of related posts to display.  
                                'ignore_sticky_posts' => 1  
                            );  
                          
                            $my_query = new wp_query( $args );  
                            
                            if(!$my_query->have_posts()){
                                echo '<p>'.esc_html__('There are currently no articles related to this post.', 'moxietheme').'</p>';	
                            }
                            
                            echo '<ul class="pm-related-blog-posts">';
                      
                                while( $my_query->have_posts() ) {  
                                    $my_query->the_post();  
                                    
                                    if ( has_post_thumbnail() ) {
                                       $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'small');
                                    }
                                    
                                ?>  
                                
                                    <li>
                                        <a href="<?php the_permalink()?>" class="pm-related-post-btn fa fa-arrow-circle-o-right"></a>
                                        
                                        <?php if(has_post_thumbnail()) { ?>
                                                <div class="pm-related-blog-post-thumb"><img src="<?php echo esc_url(esc_html($image_url[0])); ?>" alt="<?php the_title(); ?>" /></div>
                                        <?php } else { ?>
                                                <!-- no thumb to display -->
                                        <?php } ?>
                                        
                                        <div class="pm-related-blog-post-details">
                                            <a href="<?php the_permalink()?>"><?php the_title(); ?></a>
                                            <p class="pm-date"><i class="fa fa-clock-o"></i> <?php the_time( 'M' ); ?> <?php the_time( 'd' ); ?>, <?php the_time( 'Y' ); ?> - <?php the_author(); ?></p>
                                        </div>
                                    </li>
                              
                                <?php } 
                            
                            echo '</ul>'; 
                            
                            wp_reset_query();                         
                             
                        ?>
                
                </div>
                    
            </div>
        </div>
    </div>

<?php endif; ?>