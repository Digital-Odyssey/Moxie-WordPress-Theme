<!DOCTYPE html>
<html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="format-detection" content="telephone=no">
    
	<!-- Atoms & Pingback -->
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
    <link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
    <link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />    
                            
    <?php wp_head(); ?>
</head>

<?php 

//Redux options
$moxie_options = moxie_theme_get_moxie_options();

//Moxie options
$customSlider = $moxie_options['opt-custom-slider'];

//Global options
$enableTooltip = get_theme_mod('enableTooltip', 'on');

//Layout Options
$enableBoxMode = get_theme_mod('enableBoxMode', 'off');

//Header options
$companyLogo = get_theme_mod('companyLogo', get_template_directory_uri() . '/img/moxie.png');
$companyLogoAltTag = get_theme_mod('companyLogoAltTag', 'Moxie Theme');
$companyLogoURL = get_theme_mod('companyLogoURL', '');

$enableSearch = get_theme_mod('enableSearch', 'on');
$enableCategoryList = get_theme_mod('enableCategoryList', 'on');
$enableCart = get_theme_mod('enableCart', 'off');
$enableLanguageSelector = get_theme_mod('enableLanguageSelector', 'off');

$enablePagePreloader = get_theme_mod('enablePagePreloader', 'on');
$pagePreloaderImage = get_theme_mod('pagePreloaderImage');

//Pulse slider options
$floatNavAboveSubHeader = get_theme_mod('floatNavAboveSubHeader', 'off');

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

$woocommShopLayout = get_theme_mod('woocommShopLayout', 'no-sidebar');
$woocommLayout = 'woocomm-' . $woocommShopLayout;

$bodyClasses = array();

?>

<?php if($enablePagePreloader === 'on') { ?>
	<body <?php body_class( array('preloadable', $woocommLayout) ); ?> data-scroll-speed="1000">
<?php } else { ?>
	<body <?php body_class($woocommLayout); ?> data-scroll-speed="1000">
<?php } ?>

<?php get_template_part('content', 'floatingmenu'); ?>

<?php if($enableBoxMode === 'on') { ?>
     <div class="pm-boxed-mode" id="pm_layout_wrapper">
<?php } else { ?>
     <div class="pm-full-mode" id="pm_layout_wrapper">
<?php }?>

	<?php get_template_part('content', 'mainmenu'); ?>

	<!-- Header area -->
    <header <?php echo $floatNavAboveSubHeader === 'on' ? 'class="pm-float-header"' : '' ?>>
    
        <ul class="pm-header-social-icons">
            
            <?php if($facebooklink !== '') : ?>
                <li><a href="<?php echo esc_html($facebooklink); ?>" target="_blank" class="fa fa-facebook"></a></li>
            <?php endif; ?>
            
            <?php if($twitterlink !== '') : ?>
                <li><a href="<?php echo esc_html($twitterlink); ?>" target="_blank" class="fa fa-twitter"></a></li>
            <?php endif; ?>
            
            <?php if($googlelink !== '') : ?>
                <li><a href="<?php echo esc_html($googlelink); ?>" target="_blank" class="fa fa-google-plus"></a></li>
            <?php endif; ?>
            
            <?php if($linkedinLink !== '') : ?>
                <li><a href="<?php echo esc_html($linkedinLink); ?>" target="_blank" class="fa fa-linkedin"></a></li>
            <?php endif; ?>
            
            <?php if($vimeolink !== '') : ?>
                <li><a href="<?php echo esc_html($vimeolink); ?>" target="_blank" class="fa fa-vimeo"></a></li>
            <?php endif; ?>
            
            <?php if($youtubelink !== '') : ?>
                <li><a href="<?php echo esc_html($youtubelink); ?>" target="_blank" class="fa fa-youtube"></a></li>
            <?php endif; ?>
            
            <?php if($dribbblelink !== '') : ?>
                <li><a href="<?php echo esc_html($dribbblelink); ?>" target="_blank" class="fa fa-dribbble"></a></li>
            <?php endif; ?>
            
            <?php if($pinterestlink !== '') : ?>
                <li><a href="<?php echo esc_html($pinterestlink); ?>" target="_blank" class="fa fa-pinterest"></a></li>
            <?php endif; ?>
            
            <?php if($instagramlink !== '') : ?>
                <li><a href="<?php echo esc_html($instagramlink); ?>" target="_blank" class="fa fa-instagram"></a></li>
            <?php endif; ?>
            
            <?php if($skypelink !== '') : ?>
                <li><a href="skype:<?php echo esc_attr($skypelink); ?>?call" class="fa fa-skype"></a></li>
            <?php endif; ?>
            
            <?php if($flickrlink !== '') : ?>
                <li><a href="<?php echo esc_html($flickrlink); ?>" target="_blank" class="fa fa-flickr"></a></li>
            <?php endif; ?>
            
            <?php if($tumblrlink !== '') : ?>
                <li><a href="<?php echo esc_html($tumblrlink); ?>" target="_blank" class="fa fa-tumblr"></a></li>
            <?php endif; ?>
            
             <?php if($stumbleuponlink !== '') : ?>
                <li><a href="<?php echo esc_html($stumbleuponlink); ?>" target="_blank" class="fa fa-stumbleupon"></a></li>
            <?php endif; ?>
            
            <?php if($redditlink !== '') : ?>
                <li><a href="<?php echo esc_html($redditlink); ?>" target="_blank" class="fa fa-reddit"></a></li>
            <?php endif; ?> 
            
            <?php if($rssLink !== '') : ?>
                <li><a href="<?php echo esc_html($rssLink); ?>" target="_blank" class="fa fa-rss"</a></li>
            <?php endif; ?> 
            
        </ul>
            
        <div class="pm-header-menu-btn-container">
        
        	<?php if($enableLanguageSelector === 'on') : ?>
				<?php moxie_theme_icl_post_languages(); ?> 
            <?php endif; ?>
        
        	<?php if(is_home() || is_front_page()) {//Display Homepage btns ?>
            
            	<a href="#" class="pm-header-menu-btn slider pm-header-menu-button" id="pm-header-menu-btn"><i class="fa fa-bars"></i></a>
                
            <?php } else {//Display sub-header btns ?>
            
            	<a href="#" class="pm-header-menu-btn pm-header-menu-button" id="pm-header-menu-btn"> <i class="fa fa-bars"></i></a> <a href="<?php echo site_url('/'); ?>" class="pm-header-menu-btn"><i class="fa fa-home"></i></a>
                
            <?php } ?>
            
        </div>
    
        <div class="pm-header-logo">
            <a href="<?php echo esc_html($companyLogoURL) !== '' ? esc_html($companyLogoURL) : site_url(); ?>"><img src="<?php echo esc_url(esc_html($companyLogo)); ?>" alt="<?php echo esc_attr($companyLogoAltTag) !== '' ? esc_attr($companyLogoAltTag) : 'Logo'; ?>"/></a> 
        </div>
                
    </header>
    <!-- /Header area end -->
               
    <?php if(is_home() || is_front_page()) {//Display Homepage Slider ?>
            
        
        <!-- SLIDER AREA -->
        <?php $enablePulseSlider = get_theme_mod('enablePulseSlider', 'on'); ?>
        
        
        <?php if($enablePulseSlider === 'on') : ?>
        
            <?php get_template_part('content', 'pulseslider'); ?>     
        
        <?php endif; ?>
        
        <?php 
		
			if($customSlider !== '') { 
			   
			   ?>
				<div id="hero">
    
					<?php echo do_shortcode($customSlider); ?>
				
				</div>
                
                <?php
			   
        	} 
			
		?>
        
        <!-- SLIDER AREA end -->
    
            
    <?php } else {//display sub-header ?>
    
    	<?php $displaySubHeader = get_theme_mod('displaySubHeader', 'on'); ?>
        
    	<?php 
		
			if($displaySubHeader === 'on') :
				get_template_part('content', 'subheader'); 
			endif;
		
		?>
    
<?php } ?>