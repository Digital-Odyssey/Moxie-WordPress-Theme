<?php $enableBreadCrumbs = get_theme_mod('enableBreadCrumbs', 'on'); ?>




<!-- Breadcrumbs -->
<?php if( function_exists('is_shop') ) {//Woocommerce enabled ?>

	<?php if( is_shop() || is_product() || is_product_category() || is_product_tag()  ) { ?>
	
		<?php if($enableBreadCrumbs === 'on') : ?>
                    
            <div class="pm-sub-header-breadcrumbs">
            	
                <div class="container">
                	<div class="row">
                    	<div class="col-lg-12">

                            <?php				
								$args = array(
										'delimiter' => '<li><i class="fa fa-angle-right"></i></li>',
										'wrap_before' => '<ul class="pm-breadcrumbs">',
										'wrap_after' => '</ul>',
										'before' => '<li>',
										'after' => '</li>',
								);
							?>
							
							<?php woocommerce_breadcrumb( $args ); ?>
                            
                            <?php if(is_single()) : ?>
                            	<ul class="pm-post-navigation">
                                    <li class="pm_tip_static_top" title="Prev. Post"><?php previous_post_link('%link', '<i class="fa fa-angle-left"></i>'); ?></li>
                                    <li class="pm_tip_static_top" title="Next Post"><?php next_post_link('%link', '<i class="fa fa-angle-right"></i>'); ?></li>
                                </ul>
                            <?php endif; ?>
                            
                        </div>
                    </div>
                </div>
                
            </div>
        
        <?php endif; ?>
		
	<?php } else { ?>
	
		<?php if( !is_tax('gallerycats') && !is_tax('gallerytags') ) : ?>
			
			<?php if($enableBreadCrumbs === 'on'){ ?>
            
            		<div class="pm-sub-header-breadcrumbs">
            	
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                                                        
                                    <?php moxie_theme_breadcrumbs();  ?>
                                    
                                    <?php if(is_single()) : ?>
                                        <ul class="pm-post-navigation">
                                            <li class="pm_tip_static_top" title="Prev. Post"><?php previous_post_link('%link', '<i class="fa fa-angle-left"></i>'); ?></li>
                                        	<li class="pm_tip_static_top" title="Next Post"><?php next_post_link('%link', '<i class="fa fa-angle-right"></i>'); ?></li>
                                        </ul>
                                    <?php endif; ?>
                                    
                                </div>
                            </div>
                        </div>
                        
                    </div>
            
                    
                    
			<?php } ?>
		
		<?php endif ?>    
	
	<?php } ?>	

<?php } else {//Woocommerce not enabled ?>

	<?php if( !is_tax('gallerycats') && !is_tax('gallerytags') ) : ?>
		
		<?php if($enableBreadCrumbs === 'on'){ ?>
				
                <div class="pm-sub-header-breadcrumbs">
            	
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                
                                <ul class="pm-breadcrumbs">
                                
                                    <li><a href="<?php echo site_url(); ?>"><?php esc_html_e('Home', 'moxietheme') ?> </a></li>
                                    <li><i class="fa fa-angle-right"></i></li>
                                    
                                    <?php if(is_category()) { ?>
                            
                                        <li><?php esc_html_e('Category', 'moxietheme') ?></li>
                                        <li><i class="fa fa-angle-right"></i></li>
                                        <li><?php $cat = get_category( get_query_var( 'cat' ) ); echo esc_attr($cat->name); ?></li>
                                    
                                    <?php } elseif(is_single()) { ?>
                                    
                                        <li><?php $the_title = get_the_title(); echo moxie_theme_string_limit_words($the_title, 3) ?>...</li>
                                        
                                    <?php } elseif(is_tag()) { ?>
                                    
                                        <li><?php esc_html_e('Tag', 'moxietheme') ?></li>
                                        <li><i class="fa fa-angle-right"></i></li>
                                        <li><?php echo get_query_var('tag'); ?></li>
                                        
                                    <?php } elseif(is_404()) { ?>
                                
                                        <li><?php esc_html_e('404 Error', 'moxietheme'); ?></li>
                                        
                                    <?php } elseif(is_search()) { ?>
                                
                                        <li>"<?php echo get_search_query(); ?>"</li>
                                        
                                    <?php } elseif(is_archive()) { ?>
                                    
                                    		<li><?php esc_html_e('Archive', 'moxietheme') ?></li>
                                            <li><i class="fa fa-angle-right"></i></li>
                                            <li>"<?php single_tag_title(); ?>"</li>
                                        
                                    <?php } else { ?>
                                    
                                        <li><?php $the_title = get_the_title(); echo moxie_theme_string_limit_words($the_title, 5) ?></li>
                                    
                                    <?php } ?>
                                    
                                </ul>
                                
                                <?php if(is_single()) : ?>
                                
									<?php
                                        $previous_post = get_adjacent_post(false, '', true);
                                        $next_post = get_adjacent_post(false, '', false);
                                    ?>
                                                               
                                    <ul class="pm-post-navigation">
                                    
                                    	<?php if ($previous_post): // if there are older articles ?>
                                            <li class="pm_tip_static_top" title="<?php echo get_the_title($previous_post); ?>"><a href="<?php echo moxie_theme_make_href_root_relative(get_permalink($previous_post)); ?>"><i class="fa fa-angle-left"></i></a></li>
                                        <?php endif; ?>
                                        
                                        <?php if ($next_post): // if there are newer articles ?>
                                            <li class="pm_tip_static_top" title="<?php echo get_the_title($next_post); ?>"><a href="<?php echo moxie_theme_make_href_root_relative(get_permalink($next_post)); ?>"><i class="fa fa-angle-right"></i></a></li>
                                        <?php endif; ?>
                                    
                                        
                                    </ul>
                                <?php endif; ?>
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
                
		<?php } ?>
	
	<?php endif ?>  

<?php } ?>