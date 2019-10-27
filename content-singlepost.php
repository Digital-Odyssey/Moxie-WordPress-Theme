<?php
/**
 * The default template for displaying a single post.
 */
?>

<?php 

	 //$category = get_the_category();
	 $categories = wp_get_post_categories(get_the_ID());
	 
	 $num_comments = get_comments_number();
	 $comments = '';
	 
	 if ( has_post_thumbnail()) {
	   $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
	 }
	 
	 $post_classes = array(
		'pm-column-spacing',
		'news-post',
	 );
	 
	 $displayAuthorProfile = get_theme_mod('displayAuthorProfile', 'on');
	 $displaySocialFeatures = get_theme_mod('displaySocialFeatures', 'on');
	 $displayRelatedPosts = get_theme_mod('displayRelatedPosts', 'on');
	 $displayComments = get_theme_mod('displayComments', 'on');
	 
	 $likes = get_post_meta(get_the_ID(), 'pm_total_likes', true);
	              
?>

<!-- PANEL 1 -->
<div class="container pm-containerPadding-top-110 pm-containerPadding-bottom-80 container-scroll">

    <div class="row">
        
        <!-- Blog post area -->
        <div class="col-lg-12">
            
            <!-- Blog post -->
            <article <?php post_class($post_classes); ?>>
            
                <div class="pm-news-post-container single-post">
                    
                    <?php if ( has_post_thumbnail()) : ?>
                        <div class="pm-news-post-img-container single-post">
                        
                            <div class="pm-news-post-image-single">
                                <div class="pm-gallery-post-expand-btn-container-blog">
                                
                                	<?php 
										$likes = get_post_meta(get_the_ID(), 'pm_total_likes', true);
										$views = get_post_meta(get_the_ID(), 'post_views', true);
										$comments = get_comments_number( get_the_ID() );
									?>
								
									<ul class="pm-home-news-post-likes-list post">
										<li><i class="icon-eye"></i> <?php echo esc_attr($views) !== '' ? esc_attr($views) : '0'; ?></li>
										<li><i class="icon-bubble"></i> <?php echo esc_attr($comments) ?></li>
										<li><a href="#" id="<?php echo get_the_ID(); ?>" class="icon-heart pm-like-this-btn"></a> <span id="pm-post-total-likes-count-<?php echo get_the_ID(); ?>"><?php echo esc_attr($likes) !== '' ? esc_attr($likes) : '0'; ?></span></li>
									</ul>
                                
                                    <a href="#" class="pm-gallery-post-expand-btn-blog"></a>
                                </div>
                                <img src="<?php echo esc_url(esc_html($image_url[0])); ?>" alt="<?php the_title(); ?>" />
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
                            <?php the_title(); ?>
                        </h2>
                        <p class="pm-news-post-date">
                        	<i class="fa fa-clock-o"></i> <?php the_time( 'M' ); ?> <?php the_time( 'd' ); ?>, <?php the_time( 'Y' ); ?> &nbsp; <i class="fa fa-user"></i> <?php the_author(); ?>
                        	<?php if ( !has_post_thumbnail()) : ?>
                                &nbsp; <a href="#" class="fa fa-thumbs-up pm-like-this-btn" id="<?php echo get_the_ID(); ?>"></a> <span id="pm-post-total-likes-count-<?php echo get_the_ID(); ?>"><?php echo esc_attr($likes); ?></span>   
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
										$cat = get_category( $category );
										echo '<li><a href="'.get_category_link( $cat->term_id ).'">'.esc_attr($cat->cat_name).'</a></li>';	
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


<?php
    
	//author info
	$display_name = get_the_author_meta('display_name');
	$first_name = get_the_author_meta('first_name');
	$last_name = get_the_author_meta('last_name');
	$author_title = get_the_author_meta( 'author_title' ); 
	$description = get_the_author_meta('description');
	
	$toggleParallaxAuthor = get_theme_mod('toggleParallaxAuthor', 'on');
	
?> 

<?php if($displayAuthorProfile === 'on') : ?>

<!-- PANEL 2 -->
<div class="pm-column-container pm-containerPadding-bottom-50 pm-parallax-panel container-scroll pm-author-container" id="author-profile" data-stellar-background-ratio="0.5">

    <div class="container pm-containerPadding80">
        <div class="row">
            <div class="col-lg-12">
                
                <h4 class="pm-author-column-title"><?php esc_html_e('About the author', 'moxietheme') ?></h4>
                
                <div class="row pm-containerPadding-top-30">
                    
                    <div class="col-lg-3 col-md-12 col-sm-12">
                        
                        <?php $avatar = moxie_theme_get_avatar_url(get_avatar( get_the_author_meta( 'ID' ), 190 )); ?>
                        
                        <div class="pm-author-bio-img-bg"><img src="<?php echo esc_url(esc_html($avatar)); ?>" alt="<?php echo esc_attr($first_name); ?> <?php echo esc_attr($last_name); ?>" /></div>
                        
                        
                    </div>
                    
                    <div class="col-lg-9 col-md-12 col-sm-12 pm-author-profile-column">
                        <p class="pm-author-name"><?php echo esc_attr($first_name); ?> <?php echo esc_attr($last_name); ?></p>
                        <p class="pm-author-title"><?php echo esc_attr($author_title); ?></p>
                        <div class="pm-author-divider"></div>
                        <p class="pm-author-bio"><?php echo esc_attr($description); ?></p>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>

</div>
<!-- PANEL 2 end -->

<?php endif; ?>

	<?php if($displayRelatedPosts === 'on') : ?>
    
    <!-- PANEL 3 -->
    <?php get_template_part('content', 'relatedposts'); ?>
    <!-- PANEL 3 end-->


<?php endif; ?>

<?php if($displayComments === 'on') : ?>

	<?php if ( comments_open() ) : ?>
    
    	<?php if ($num_comments > 0 ) : ?>
        
        	<!-- PANEL 4 -->
            <div class="pm-column-container pm-containerPadding100 pm-parallax-panel container-scroll pm-comments-container" id="pm-comments-column" data-stellar-background-ratio="0.5">
            
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            
                            <?php comments_template(); ?>
                            
                        </div>
                    </div>
                </div>
            
            </div>
            <!-- PANEL 4 end -->
        
        <?php endif; ?>
    
    <?php endif; ?>

	<!-- PANEL 5 -->

	<?php if ( comments_open() ) : ?>
        
        <div class="container pm-containerPadding-top-100 pm-containerPadding-bottom-80 container-scroll" id="submit-comment">
                
            <div class="row">
              
                
                <?php 
                
                    $args = array(
                        
                          'id_form'           => 'commentform',
                          'class_form'      => 'comment-form',
                          'id_submit'         => 'submit',
                          'class_submit'      => 'submit',
                          'name_submit'       => 'submit',
                          'title_reply'       => esc_html__( 'Leave a Reply', 'moxietheme' ),
                          'title_reply_to'    => esc_html__( 'Leave a Reply to %s', 'moxietheme' ),
                          'cancel_reply_link' => esc_html__( 'Cancel Reply', 'moxietheme' ),
                          'label_submit'      => esc_html__( 'Post Comment', 'moxietheme' ),
                          'format'            => 'xhtml',
                          
                          
                          'fields' => apply_filters( 'comment_form_default_fields', 
                          
                              array(
                            
                                'author' =>
                                  '<div class="col-lg-4 col-md-4 col-sm-12 pm-form-clear-left-padding"><input required id="author" name="author" type="text" class="respond_author pm-comment-form-textfield" size="22" value=""  placeholder="'. esc_html__('Name *', 'moxietheme') .'" /></div>',
                            
                                'email' =>
                                  '<div class="col-lg-4 col-md-4 col-sm-12 pm-form-clear-mobile-padding"><input required id="email" name="email" type="text" class="respond_email pm-comment-form-textfield" size="22" value=""  placeholder="'. esc_html__('Email *', 'moxietheme') .'" /></div>',
                            
                                'url' =>
                                  '<div class="col-lg-4 col-md-4 col-sm-12 pm-form-clear-right-padding"><input id="url" name="url" type="text" value="" size="30" class="respond_url pm-comment-form-textfield" placeholder="'. esc_html__('Website', 'moxietheme') .'" /></div>'
                                )//end of array
                            
                            ),//end of apply_filters
                            
                            'comment_field' => '<div class="col-lg-12 pm-form-clear-padding pm-clear-element pm-form-margin-spacing"><textarea id="comment" class="pm-comment-form-textarea" name="comment" cols="45" rows="8" aria-required="true" placeholder="'. esc_html__('Comment...', 'moxietheme') .'"></textarea></div>',
                        
                        );
                
                ?>      
        
                <?php comment_form($args); ?>
                
            
        </div>

    </div>
        
	<?php endif; ?>
    
<?php endif; ?>

<!-- PANEL 5 end-->
