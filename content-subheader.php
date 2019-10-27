<!-- SUBHEADER AREA -->

<?php 
		
	//Sub-header options
	$globalHeaderImage = get_theme_mod('globalHeaderImage');
	$globalHeaderImage2 = get_theme_mod('globalHeaderImage2');

?>

<!-- Subpage Header layouts -->
<?php if( function_exists( 'is_shop' ) ) { //woocommerce installed ?>

        <?php if( is_shop() ) { //Load Woocommerce shop header ?>
        
                <?php 
                    $pageid = get_option('woocommerce_shop_page_id');
                    $pageHeaderImage = get_post_meta($pageid, 'pm_header_image_meta', true);
                ?>
                
                <?php if($pageHeaderImage !== '') { ?>
            
                    	<div class="pm-subheader-container woocomm_image pm-parallax-panel" data-stellar-background-ratio="0.5">
                
                <?php } else { ?>
                
                    	<div class="pm-subheader-container">
                
                <?php } ?>
                
        <?php } elseif( is_product() ) {//Load Woocommerce product header ?>
        
                <?php 
                    $wooSingleProductHeaderImage = get_theme_mod('wooSingleProductHeaderImage'); 
                ?>
                
                <?php if($wooSingleProductHeaderImage !== '') { ?>
            
                    	<div class="pm-subheader-container woocomm_image pm-parallax-panel" data-stellar-background-ratio="0.5">
                
                <?php } else { ?>
                
                    	<div class="pm-subheader-container">
                
                <?php } ?>
        
        <?php } elseif( is_product_category() || is_product_tag() ) {//Load Woocommerce archive header ?>
        
                <?php 
                    $wooCategoryHeaderImage = get_theme_mod('wooCategoryHeaderImage'); 
                ?>
                
                <?php if($wooCategoryHeaderImage !== '') { ?>
            
                        <div class="pm-subheader-container woocomm_image pm-parallax-panel" data-stellar-background-ratio="0.5">
                
                <?php } else { ?>
                
                        <div class="pm-subheader-container">
                
                <?php } ?>
        
        <?php } elseif( is_404() || is_search() || is_tag() || is_category() || is_archive() ) {  ?>
        
                <?php if($globalHeaderImage2 !== '') { ?>
            
                    	<div class="pm-subheader-container global-image-2 pm-parallax-panel" data-stellar-background-ratio="0.5">
                
                <?php } else { ?>
                
                        <div class="pm-subheader-container">
                
                <?php } ?>
                
                
        <?php } elseif( get_post_type() === 'post_staff' ) {//Display Page header on pages ?>
        
        	<?php
				$pm_staff_header_image_meta = get_post_meta(get_the_ID(), 'pm_staff_header_image_meta', true); 
			?>
            
            <?php if($pm_staff_header_image_meta !== '') { ?>
            
                    <div class="pm-subheader-container page-header-staff-image pm-parallax-panel" data-stellar-background-ratio="0.5">
                
            <?php } elseif($globalHeaderImage !== '') { ?>
            
                    <div class="pm-subheader-container global-image-1 pm-parallax-panel" data-stellar-background-ratio="0.5">
            
            <?php } else { ?>
                            
                    <div class="pm-subheader-container">
            
            <?php } ?>
            
       <?php } elseif( get_post_type() === 'post_galleries' ) {//Display Page header on pages ?>
        
        	<?php
				$pm_gallery_header_image_meta = get_post_meta(get_the_ID(), 'pm_gallery_header_image_meta', true); 
			?>
            
            <?php if($pm_gallery_header_image_meta !== '') { ?>
            
                    <div class="pm-subheader-container page-header-gallery-image pm-parallax-panel" data-stellar-background-ratio="0.5">
                
            <?php } elseif($globalHeaderImage !== '') { ?>
            
                    <div class="pm-subheader-container global-image-1 pm-parallax-panel" data-stellar-background-ratio="0.5">
            
            <?php } else { ?>
                            
                    <div class="pm-subheader-container">
            
            <?php } ?>       
                
            
        <?php } else {  ?>
        
                <?php
                    $pageHeaderImage = get_post_meta(get_the_ID(), 'pm_header_image_meta', true); 
                ?>
        
                <?php if($pageHeaderImage !== '') { ?>
            
                        <div class="pm-subheader-container page-header-image pm-parallax-panel" data-stellar-background-ratio="0.5">
                    
                <?php } elseif($globalHeaderImage !== '') { ?>
                
                		<div class="pm-subheader-container global-image-1 pm-parallax-panel" data-stellar-background-ratio="0.5">
				
				<?php } else { ?>
                                
                        <div class="pm-subheader-container">
                
                <?php } ?>

        
        <?php } ?>

<?php } else {//woocommerce not installed ?>

        <?php if( is_404() || is_search() || is_tag() || is_category() || is_archive() ) {//Display Global header image on these pages ?>
        
            <?php if($globalHeaderImage2 !== '') { ?>
            
                	<div class="pm-subheader-container global-image-2 pm-parallax-panel" data-stellar-background-ratio="0.5">
            
            <?php } else { ?>
            
                    <div class="pm-subheader-container">
            
            <?php } ?>
        
        <?php } elseif( get_post_type() === 'post_staff' ) {//Display Page header on pages ?>
        
        	<?php
				$pm_staff_header_image_meta = get_post_meta(get_the_ID(), 'pm_staff_header_image_meta', true); 
			?>
            
            <?php if($pm_staff_header_image_meta !== '') { ?>
            
                    <div class="pm-subheader-container page-header-staff-image pm-parallax-panel" data-stellar-background-ratio="0.5">
                
            <?php } elseif($globalHeaderImage !== '') { ?>
            
                    <div class="pm-subheader-container global-image-1 pm-parallax-panel" data-stellar-background-ratio="0.5">
            
            <?php } else { ?>
                            
                    <div class="pm-subheader-container">
            
            <?php } ?>
            
        <?php } elseif( get_post_type() === 'post_galleries' ) {//Display Page header on pages ?>
        
        	<?php
				$pm_gallery_header_image_meta = get_post_meta(get_the_ID(), 'pm_gallery_header_image_meta', true); 
			?>
            
            <?php if($pm_gallery_header_image_meta !== '') { ?>
            
                    <div class="pm-subheader-container page-header-gallery-image pm-parallax-panel" data-stellar-background-ratio="0.5">
                
            <?php } elseif($globalHeaderImage !== '') { ?>
            
                    <div class="pm-subheader-container global-image-1 pm-parallax-panel" data-stellar-background-ratio="0.5">
            
            <?php } else { ?>
                            
                    <div class="pm-subheader-container">
            
            <?php } ?>
        
        <?php } else {//Display Page header on pages ?>
        
                <?php
                    $pageHeaderImage = get_post_meta(get_the_ID(), 'pm_header_image_meta', true); 
                ?>
        
                <?php if($pageHeaderImage !== '') { ?>
            
                        <div class="pm-subheader-container page-header-image pm-parallax-panel" data-stellar-background-ratio="0.5">
                    
                <?php } elseif($globalHeaderImage !== '') { ?>
                
                		<div class="pm-subheader-container global-image-1 pm-parallax-panel" data-stellar-background-ratio="0.5">
				
				<?php } else { ?>
                                
                        <div class="pm-subheader-container">
                
                <?php } ?>
        
        <?php } ?>

<?php } ?>

			<div class="pm-subheader-title">
            	
                <h2>
                    
						<?php if( function_exists('is_shop') ) {//Woocommerce enabled ?>
                        
                        
                            <?php if( is_search() && is_shop() ) { ?>
                            
                            	<?php esc_html_e('Search Results for:', 'luxortheme'); ?>
                                <span class="pm-subheader-decription"><?php echo get_search_query(); ?></span>
                            
                            <?php } else if( is_shop() ) { ?>
                            
                            	<?php woocommerce_page_title(); ?>
                                
                                <?php
									$pageid = get_option('woocommerce_shop_page_id');
									$pm_header_message_meta = get_post_meta($pageid, 'pm_header_message_meta', true); 
								?>
                                
                                <span class="pm-subheader-decription"><?php echo esc_attr($pm_header_message_meta); ?></span>
                            
                            <?php } else if(is_product()) { ?>
                            
                            	<?php the_title(); ?>
                                
                            <?php } else if( is_product_category() || is_product_tag() ) { ?>
                            
                            	<?php esc_html_e('Products in', 'moxietheme'); ?>
                                
                                <span class="pm-subheader-decription">"<?php woocommerce_page_title(); ?>"</span>
                            
                            <?php } else if( is_404() ) { ?>
                            
                            	<?php esc_html_e('404 Error', 'moxietheme') ?>
                        		<span class="pm-subheader-decription"><?php esc_html_e('Page Not Found', 'moxietheme') ?></span>
                            
                            <?php } else if( is_search() ) { ?>
                            
                            	<?php esc_html_e('Search Results for:', 'moxietheme'); ?>
                                <span class="pm-subheader-decription">"<?php echo get_search_query(); ?>"</span>
                            
                            <?php } else if(is_tag()) { ?>
                            
                            	<?php esc_html_e('News tagged with:', 'moxietheme'); ?>
                                <span class="pm-subheader-decription">"<?php echo get_query_var('tag'); ?>"</span>
                            
                            <?php } else if(is_category()) { ?>
                            
                            	<?php esc_html_e('News filed in:', 'moxietheme'); ?>
                                <span class="pm-subheader-decription">"<?php $cat = get_category( get_query_var( 'cat' ) ); echo esc_attr($cat->name); ?>"</span>
                                
                            <?php } else if(is_tax('gallerycats') ) { ?>
                            
                                <?php esc_html_e('Gallery archive for', 'moxietheme'); ?>
                                <span class="pm-subheader-decription">
                                    '<?php single_tag_title();  ?>'
                                </span>
                                
                            <?php } elseif( get_post_type() === 'post_staff' ) {//Display Page header on pages ?> 
                                
                                <?php the_title(); ?>
                                
                            <?php } else if(is_single()) { ?>
                            	
								<?php the_title(); ?>
                                <span class="pm-single-news-post-title-decription"><i class="fa fa-clock-o"></i> <?php the_time( 'M' ); ?> <?php the_time( 'd' ); ?>, <?php the_time( 'Y' ); ?></span>
                            
                            <?php } else if( is_archive() ) { ?>
                            
                            	<?php esc_html_e('Archive for', 'moxietheme'); ?>
                                
                                <span class="pm-subheader-decription">
                                	<?php
                                		if (is_day()) {
                                            the_time('F jS, Y');
                                        }
                                        elseif (is_month()) {
                                            the_time('F, Y');
                                        }
                                        elseif (is_year()) {
                                            the_time('Y');
                                        }
                                        elseif (is_author()) {
                                            echo"<li>". esc_html__('Archive for', 'moxietheme') .""; echo'</li>';
                                        } else {
											//do nothing
										}
									?>
                                </span>
                            
                            
                            <?php } else { ?>
                            
                            	<?php
									$pm_header_message_meta = get_post_meta(get_the_ID(), 'pm_header_message_meta', true); 
								?>
                                
                                <?php the_title(); ?>
                                <span class="pm-subheader-decription"><?php echo esc_attr($pm_header_message_meta); ?></span>
                            
                            <?php } ?>
                            
                            
                            
                         <?php } else {//Woocomm not installed ?>  
                         
                            <?php if( is_404() ) { ?>
                            
                            	<?php esc_html_e('404 Error', 'moxietheme') ?>
                        		<span class="pm-subheader-decription"><?php esc_html_e('Page Not Found', 'moxietheme') ?></span>
                            
                            
                            <?php } else if( is_search() ) { ?>
                            
								<?php esc_html_e('Search Results for:', 'moxietheme'); ?>
                                <span class="pm-subheader-decription">"<?php echo get_search_query(); ?>"</span>
                            
                            <?php } else if(is_tag()) { ?>
                            
                            	<?php esc_html_e('News tagged with:', 'moxietheme'); ?>
                                <span class="pm-subheader-decription">"<?php echo get_query_var('tag'); ?>"</span>
                            
                            <?php } else if(is_category()) { ?>
                            
                            	<?php esc_html_e('News filed in:', 'moxietheme'); ?>
                                <span class="pm-subheader-decription">"<?php $cat = get_category( get_query_var( 'cat' ) ); echo esc_attr($cat->name); ?>"</span>
                            
                            <?php } else if(is_tax('gallerycats') ) { ?>
                            
                                <?php esc_html_e('Gallery archive for', 'moxietheme'); ?>
                                <span class="pm-subheader-decription">
                                    '<?php single_tag_title();  ?>'
                                </span>
                                
                            <?php } elseif( get_post_type() === 'post_staff' ) {//Display Page header on pages ?> 
                                
                                <?php the_title(); ?>
                            
                            <?php } else if(is_single()) { ?>
                            	
								<?php the_title(); ?>
                                <span class="pm-single-news-post-title-decription"><i class="fa fa-clock-o"></i> <?php the_time( 'M' ); ?> <?php the_time( 'd' ); ?>, <?php the_time( 'Y' ); ?></span>
                                                            
                            <?php } else if( is_archive() ) { ?>
                            
                            	<?php esc_html_e('Archive for', 'moxietheme'); ?>
                                
                                <span class="pm-subheader-decription">
                                	<?php
                                		if (is_day()) {
                                            the_time('F jS, Y');
                                        }
                                        elseif (is_month()) {
                                            the_time('F, Y');
                                        }
                                        elseif (is_year()) {
                                            the_time('Y');
                                        }
                                        elseif (is_author()) {
                                            echo"<li>". esc_html__('Archive for', 'moxietheme') .""; echo'</li>';
                                        } else {
											//do nothing
										}
									?>
                                </span>
                            
                            
                            <?php } else { ?>
                            
                            	<?php
									$pm_header_message_meta = get_post_meta(get_the_ID(), 'pm_header_message_meta', true); 
								?>
                                
                                <?php the_title(); ?>
                                <span class="pm-subheader-decription"><?php echo esc_attr($pm_header_message_meta); ?></span>
                            
                            <?php } ?>
                         
                         <?php } ?>
                                        
                    
                </h2>
                
            </div>
                        
            <?php if( get_post_type() === 'post_staff' ) { ?>
            
            	<!-- post navigation -->
                <ul class="pm-subheader-post-navigation">
                
                	<?php 
						$prev_post = get_adjacent_post(false, '', true);						
					?>
                
                	<?php if(!empty($prev_post)) : ?>
                    
                    	<?php $title = moxie_theme_string_limit_words($prev_post->post_title, 4); ?>
                    
                    	<li>
                            <a href="<?php echo get_permalink($prev_post->ID) ?>" class="pm-post-nav-btn">
                                <div class="pm-post-nav-btn-faceflip-top">
                                    <p><i class="fa fa-arrow-circle-o-left"></i> <?php esc_html_e('Prev. Staff Profile', 'moxietheme') ?></p>
                                </div>
                            </a>
                        </li>
                    
                    <?php endif; ?>
                    
                    <?php 
						$next_post = get_adjacent_post(false, '', false);
					?>
                    
                    <?php if(!empty($next_post)) : ?>
                    
                    	<?php $next_title = moxie_theme_string_limit_words($next_post->post_title, 4); ?>
                    
                    	<li>
                            <a href="<?php echo get_permalink($next_post->ID) ?>" class="pm-post-nav-btn">
                                <div class="pm-post-nav-btn-faceflip-top">
                                    <p><?php esc_html_e('Next Staff Profile', 'moxietheme') ?> <i class="fa fa-arrow-circle-o-right"></i></p>
                                </div>
                            </a>
                        </li>
                    
                    <?php endif; ?>
                    
                    
                </ul>
                <!-- post navigation end -->
            
            <?php } elseif( is_single() ) { ?>
            
            	<!-- post navigation -->
                <ul class="pm-subheader-post-navigation">
                
                	<?php 
						$prev_post = get_adjacent_post(false, '', true);						
					?>
                
                	<?php if(!empty($prev_post)) : ?>
                    
                    	<?php $title = moxie_theme_string_limit_words($prev_post->post_title, 4); ?>
                    
                    	<li>
                            <a href="<?php echo get_permalink($prev_post->ID) ?>" class="pm-post-nav-btn">
                                <div class="pm-post-nav-btn-faceflip-top">
                                    <p><i class="fa fa-arrow-circle-o-left"></i> <?php esc_html_e('Prev. Post', 'moxietheme') ?></p>
                                </div>
                            </a>
                        </li>
                    
                    <?php endif; ?>
                    
                    <?php 
						$next_post = get_adjacent_post(false, '', false);
					?>
                    
                    <?php if(!empty($next_post)) : ?>
                    
                    	<?php $next_title = moxie_theme_string_limit_words($next_post->post_title, 4); ?>
                    
                    	<li>
                            <a href="<?php echo get_permalink($next_post->ID) ?>" class="pm-post-nav-btn">
                                <div class="pm-post-nav-btn-faceflip-top">
                                    <p><?php esc_html_e('Next Post', 'moxietheme') ?> <i class="fa fa-arrow-circle-o-right"></i></p>
                                </div>
                            </a>
                        </li>
                    
                    <?php endif; ?>
                    
                    
                </ul>
                <!-- post navigation end -->
            
            <?php } else { ?>
            
            <?php } ?>
                                      
</div><!-- container close -->
