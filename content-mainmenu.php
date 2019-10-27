<?php 

$companyLogo = get_theme_mod('companyLogo');
$companyLogoAltTag = get_theme_mod('companyLogoAltTag', '');
$companyLogoURL = get_theme_mod('companyLogoURL', '');

$displaySearchField = get_theme_mod('displaySearchField', 'on');
$searchFieldText = get_theme_mod('searchFieldText', esc_attr__('Search Articles...', 'moxietheme'));

$enableTooltip = get_theme_mod('enableTooltip', 'on');

//Business Info
$businessPhone = get_theme_mod('businessPhone', '');
$businessEmail = get_theme_mod('businessEmail', '');
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

<!-- Main slide out menu -->
  <div class="pm-mobile-menu-overlay" id="pm-mobile-menu-overlay"></div>
  <div class="pm-mobile-menu-hover-close-btn" id="pm-mobile-menu-hover-close-btn"><i class="fa fa-close"></i></div>
  
  <div class="pm-mobile-global-menu" id="pm-mobile-global-menu">
  
    
    <div class="pm-mobile-global-menu-logo">
        <a href="<?php echo esc_attr($companyLogoURL) !== '' ? esc_html($companyLogoURL) : site_url() ?>"><img src="<?php echo esc_url(esc_attr($companyLogo)) !== '' ? esc_url(esc_html($companyLogo)) : get_template_directory_uri() . '/img/moxie.png'; ?>" alt="<?php echo esc_attr($companyLogoAltTag); ?>" class="img-responsive"></a> 
    </div>
            
    <!-- Main navigation menu -->        
    <div class="pm-mobile-global-menu-container active">
    
        <?php if($displaySearchField === 'on') : ?>
        
        	<div class="pm-mobile-global-menu-search">
                <form method="get" id="searchformenu" action="<?php echo home_url( '/' ); ?>">
                    <input name="s" type="text" class="pm-search-field-mobile" placeholder="<?php echo esc_attr($searchFieldText); ?>">
                </form>
            </div>
        
        <?php endif; ?>
        
        <?php if( is_home() || is_front_page() ) { ?>
                
                	<?php
						wp_nav_menu(array(
							'container' => '',
							'container_class' => '',
							'menu_class' => 'sf-menu pm-nav',
							'menu_id' => '',
							'theme_location' => 'main_menu',
							'fallback_cb' => 'moxie_theme_main_menu',
						   )
						);
					?>
                
                <?php } else { ?>
                
                	<?php
						wp_nav_menu(array(
							'container' => '',
							'container_class' => '',
							'menu_class' => 'sf-menu pm-nav',
							'menu_id' => '',
							'theme_location' => 'sub_menu',
							'fallback_cb' => 'moxie_theme_sub_menu',
						   )
						);
					?>
                
                <?php } ?>
        
    
    </div><!-- /.pm-mobile-global-menu-container -->
    
    <!-- Main navigation menu end -->        
        
  </div>
  <!-- /.pm-mobile-global-menu -->