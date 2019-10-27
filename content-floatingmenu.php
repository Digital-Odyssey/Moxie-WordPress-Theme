<?php 


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

<!-- Floating Menu container -->
<div class="pm-float-menu-container" id="pm-float-menu-container">
    
    <ul class="pm-header-social-icons micro">
    
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
    
    <a href="#" class="pm-header-menu-btn micro pm-header-menu-button" id="pm-header-menu-btn-micro">
        <i class="fa fa-bars"></i>
    </a>
    
</div>
<!-- Floating Menu container end -->