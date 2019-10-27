<?php 

//Redux options
$moxie_options = moxie_theme_get_moxie_options();
	
//Header options
$companyLogoAltTag = get_theme_mod('companyLogoAltTag');
$companyLogoURL = get_theme_mod('companyLogoURL');

//Footer Options
$footerLogo = get_theme_mod('footerLogo', get_template_directory_uri() . '/img/moxie.png');
$toggle_fatfooter = get_theme_mod('toggle_fatfooter', 'on');
$toggle_footerNav = get_theme_mod('toggle_footerNav', 'on');
$toggleParallaxFooter = get_theme_mod('toggleParallaxFooter', 'on');
$displayCopyright = get_theme_mod('displayCopyright', 'on');
$copyrightInfo = get_theme_mod('copyrightInfo');

//Layout Options
$footerLayout = get_theme_mod('footerLayout', 'footer-four-columns');

//Business Info
$facebooklink = get_theme_mod('facebooklink', '');
$twitterlink = get_theme_mod('twitterlink', '');
$googlelink = get_theme_mod('googlelink', '');
$linkedinLink = get_theme_mod('linkedinLink', '');
$vimeolink = get_theme_mod('vimeolink', '');
$youtubelink = get_theme_mod('youtubelink', '');
$dribbblelink = get_theme_mod('dribbblelink', '');
$pinterestlink = get_theme_mod('pinterestlink', '');
$instagramlink = get_theme_mod('instagramlink', '');
$skypelink = get_theme_mod('skypelink', '');
$flickrlink = get_theme_mod('flickrlink', '');
$tumblrlink = get_theme_mod('tumblrlink', '');
$stumbleuponlink = get_theme_mod('stumbleuponlink', '');
$redditlink = get_theme_mod('redditlink', '');
$rssLink = get_theme_mod('rssLink', '');


?>

		<?php if($toggle_fatfooter == 'on') : ?>
        
             <div id="pm-fat-footer" class="pm-fat-footer <?php echo esc_attr($toggleParallaxFooter) === 'on' ? ' pm-parallax-panel' : ''; ?>" <?php echo esc_attr($toggleParallaxFooter) === 'on' ? 'data-stellar-background-ratio="0.5"' : ''; ?>>
                        
                <div class="container">
                    <div class="row">
                    
                        <!-- Widget layouts -->   
                        <?php if($footerLayout == 'footer-three-wide-left') { ?>
                    
                            <div class="col-lg-6 col-md-6 col-sm-6 pm-widget-footer"> 
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column1_widget")) ; ?>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column2_widget")) ; ?>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column3_widget")) ; ?>
                            </div>
                                            
                        <?php } ?>
                        
                        <?php if($footerLayout == 'footer-three-wide-right') { ?>
                        
                            <div class="col-lg-3 col-md-3 col-sm-3 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column1_widget")) ; ?>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column2_widget")) ; ?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column3_widget")) ; ?>
                            </div>
                                            
                        <?php } ?>
                        
                        <?php if($footerLayout == 'footer-one-column') { ?>
                        
                            <div class="col-lg-12 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column1_widget")) ; ?>
                            </div>
                                            
                        <?php } ?>
                        
                        <?php if($footerLayout == 'footer-two-columns') { ?>
                        
                            <div class="col-lg-6 col-md-6 col-sm-6 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column1_widget")) ; ?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column2_widget")) ; ?>
                            </div>
                                            
                        <?php } ?>
                    
                        <?php if($footerLayout == 'footer-three-columns') { ?>
                        
                            <div class="col-lg-4 col-md-4 col-sm-4 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column1_widget")) ; ?>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column2_widget")) ; ?>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column3_widget")) ; ?>
                            </div>
                                            
                        <?php } ?>
                        
                        <?php if($footerLayout == 'footer-four-columns') { ?>
                                                        
                                <div class="col-lg-3 col-md-3 col-sm-12 pm-widget-footer">
                                    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column1_widget")) ; ?>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 pm-widget-footer">
                                    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column2_widget")) ; ?>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 pm-widget-footer">
                                    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column3_widget")) ; ?>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 pm-widget-footer">
                                    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column4_widget")) ; ?>
                                </div>
                        
                        <?php } ?>
                        <!-- Widget layouts end -->  
                        
                        <?php $toggleFooterNewsletter = get_theme_mod('toggleFooterNewsletter', 'on'); ?>
                        
                        <div class="col-lg-12 pm-clear-element">
                        
                            <div class="pm-footer-newsletter-divider"></div>
                            
                            <?php if($toggleFooterNewsletter === 'on') : ?>
                            
                                <div class="pm-home-newsletter-form-container" id="pm-home-newsletter-form-container">
                                
                                    <p class="pm-home-newsletter-title">Newsletter Registration</p>
                                    
                                    <?php $newsletterURL = get_theme_mod('newsletterURL', ''); ?>
                                
                                    <form novalidate target="_blank" class="validate pm-footer-newsletter-subscribe-form" name="mc-embedded-subscribe-form" id="mc-embedded-subscribe-form" method="post" action="<?php echo esc_html($newsletterURL); ?>">  
                                        <input type="text" placeholder="<?php esc_html_e('First Name', 'moxietheme'); ?>" id="MERGE1" name="MERGE1" class="pm-home-newsletter-field">
                                        <input type="text" placeholder="<?php esc_html_e('Email Address', 'moxietheme'); ?>" id="MERGE0" name="MERGE0" class="pm-home-newsletter-field">
                                        <!--<input type="submit" class="pm-newsletter-submit-btn" value="subscribe &plus;" id="mc-embedded-subscribe" name="subscribe">-->
                                    </form>
                                    <a href="#" class="pm-home-newsletter-btn" id="pm-footer-newsletter-btn"><i class="fa fa-mail-forward"></i></a>
                                    
                                </div>
                            
                            <?php endif; ?>
                            
                        </div>
                        
                        <?php $enableTooltip = get_theme_mod('enableTooltip', 'on'); ?>
                        
                        <div class="col-lg-12 pm-clear-element">
                        
                            <div class="pm-footer-social-icons-container">
                                
                                <ul class="pm-social-navigation">
                                                        
                                    <?php if($facebooklink !== '') : ?>
                                        <li class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top' : '' ?>" <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Facebook', 'moxietheme') .'"' : '' ?>><a href="<?php echo esc_html($facebooklink); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                    <?php endif; ?>
                                    
                                    <?php if($twitterlink !== '') : ?>
                                        <li class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top' : '' ?>" <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Twitter', 'moxietheme') .'"' : '' ?>><a href="<?php echo esc_html($twitterlink); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                    <?php endif; ?>
                                    
                                    <?php if($googlelink !== '') : ?>
                                        <li class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top' : '' ?>" <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Google Plus', 'moxietheme') .'"' : '' ?>><a href="<?php echo esc_html($googlelink); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                    <?php endif; ?>
                                    
                                    <?php if($linkedinLink !== '') : ?>
                                        <li class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top' : '' ?>" <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Linkedin', 'moxietheme') .'"' : '' ?>><a href="<?php echo esc_html($linkedinLink); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                    <?php endif; ?>
                                    
                                    <?php if($vimeolink !== '') : ?>
                                        <li class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top' : '' ?>" <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Vimeo', 'moxietheme') .'"' : '' ?>><a href="<?php echo esc_html($vimeolink); ?>" target="_blank"><i class="fa fa-vimeo"></i></a></li>
                                    <?php endif; ?>
                                    
                                    <?php if($youtubelink !== '') : ?>
                                        <li class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top' : '' ?>" <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('YouTube', 'moxietheme') .'"' : '' ?>><a href="<?php echo esc_html($youtubelink); ?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
                                    <?php endif; ?>
                                    
                                    <?php if($dribbblelink !== '') : ?>
                                        <li class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top' : '' ?>" <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Dribbble', 'moxietheme') .'"' : '' ?>><a href="<?php echo esc_html($dribbblelink); ?>" target="_blank"><i class="fa fa-dribbble"></i></a></li>
                                    <?php endif; ?>
                                    
                                    <?php if($pinterestlink !== '') : ?>
                                        <li class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top' : '' ?>" <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Pinterest', 'moxietheme') .'"' : '' ?>><a href="<?php echo esc_html($pinterestlink); ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>
                                    <?php endif; ?>
                                    
                                    <?php if($instagramlink !== '') : ?>
                                        <li class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top' : '' ?>" <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Instagram', 'moxietheme') .'"' : '' ?>><a href="<?php echo esc_html($instagramlink); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
                                    <?php endif; ?>
                                    
                                    <?php if($skypelink !== '') : ?>
                                        <li class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top' : '' ?>" <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Skype', 'moxietheme') .'"' : '' ?>><a href="skype:<?php echo esc_attr($skypelink); ?>?call"><i class="fa fa-skype"></i></a></li>
                                    <?php endif; ?>
                                    
                                    <?php if($flickrlink !== '') : ?>
                                        <li class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top' : '' ?>" <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Flickr', 'moxietheme') .'"' : '' ?>><a href="<?php echo esc_html($flickrlink); ?>" target="_blank"><i class="fa fa-flickr"></i></a></li>
                                    <?php endif; ?>
                                    
                                    <?php if($tumblrlink !== '') : ?>
                                        <li class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top' : '' ?>" <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Tumblr', 'moxietheme') .'"' : '' ?>><a href="<?php echo esc_html($tumblrlink); ?>" target="_blank"><i class="fa fa-tumblr"></i></a></li>
                                    <?php endif; ?>
                                    
                                     <?php if($stumbleuponlink !== '') : ?>
                                        <li class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top' : '' ?>" <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('StumbleUpon', 'moxietheme') .'"' : '' ?>><a href="<?php echo esc_html($stumbleuponlink); ?>" target="_blank"><i class="fa fa-stumbleupon"></i></a></li>
                                    <?php endif; ?>
                                    
                                    <?php if($redditlink !== '') : ?>
                                        <li class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top' : '' ?>" <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Reddit', 'moxietheme') .'"' : '' ?>><a href="<?php echo esc_html($redditlink); ?>" target="_blank"><i class="fa fa-reddit"></i></a></li>
                                    <?php endif; ?> 
                                    
                                    <?php if($rssLink !== '') : ?>
                                        <li class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top' : '' ?>" <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('RSS Feed', 'moxietheme') .'"' : '' ?>><a href="<?php echo esc_html($rssLink); ?>" target="_blank"><i class="fa fa-rss"></i></a></li>
                                    <?php endif; ?> 
                                    
                                </ul>
                                
                            </div>
                            
                            <?php if($displayCopyright === 'on') : ?>
                            
                            	<?php 
    
									$allowed_html = array(
										'a' => array(
											'href' => array(),
											'title' => array()
										),
										'br' => array(),
										'em' => array(),
										'strong' => array(),
										'h6' => array(),
										'p' => array(),
										'span' => array(),
									);
								
								?>
                            
                            	<div class="pm-footer-copyright">
                                
                                	<?php 
                            
										if($copyrightInfo !== ''){ ?>
											<p>&copy; <?php echo date('Y'); ?> <?php echo wp_kses($copyrightInfo, $allowed_html); ?></p>
										<?php } else { ?>
											<p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name');  ?>. <?php esc_html_e('All rights reserved.','moxietheme') ?></p>
										<?php }
									
									?> 
                                
                                </div>
                            
                            <?php endif; ?>                            
                            
                        </div>
                        
                    </div>	
                </div>
                
            </div>
        
        <?php endif; ?>

		<?php if($toggle_footerNav === 'on') : ?>
        
        	<footer>
            
                <div class="pm-footer-scroll-up">
                
                  <div class="pm-footer-scroll-up-btn-container">
                  
                        <?php 
                        
                            $returnToTopImage = get_theme_mod('returnToTopImage',''); 
                            $returnToTopIcon = get_theme_mod('returnToTopIcon','fa fa-chevron-up'); 
                            
                        ?>
                    
                      <div class="pm-footer-scroll-up-btn-shadow">
                      
                        <?php if($returnToTopImage !== '') { ?>
                            <a href="#" id="back-top-last" class="pm-footer-scroll-up-btn"><img src="<?php echo esc_url(esc_html($returnToTopImage)); ?>" width="21" height="29" /></a>
                        <?php } else { ?>
                            <a href="#" id="back-top-last" class="pm-footer-scroll-up-btn"><i class="<?php echo esc_attr($returnToTopIcon); ?>"></i></a>
                        <?php } ?>
                      
                        
                      </div>
                    
                    </div>
                    
                </div>
            
                    
            </footer>
        
        <?php endif; ?>
    
	</div><!-- /pm_layout_wrapper -->
    
    <p id="back-top" class="back-top-container visible-lg visible-md visible-sm">
    	<a href="#" class="fa fa-chevron-up" id="back-top-scroll-up"></a>
        <span id="back-top-status">0</span>
        <a href="#" class="fa fa-chevron-down" id="back-top-scroll-down"></a>
    </p>
        
        <?php 
			
			$enablePagePreloader = get_theme_mod('enablePagePreloader', 'on');
			$pagePreloaderImage = get_theme_mod('pagePreloaderImage', get_template_directory_uri() . '/img/preloader.gif');
					
		?>
        
        <?php if($enablePagePreloader === 'on') : ?>
        	<!-- Add page preloader -->
        	<div class="preloader"><div class="top"></div><div class="bottom"></div><div class="logo"><img src="<?php echo esc_attr($pagePreloaderImage); ?>" /></div><div class="percent">0%</div></div>
        <?php endif; ?>
        
		<?php wp_footer(); ?> 
    </body>
</html>