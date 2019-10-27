<?php
/**
 * The default template for displaying a single post.
 */
?>

<?php 
	 	 	 
	 //Staff meta
	 $pm_staff_image_meta = get_post_meta(get_the_ID(), 'pm_staff_image_meta', true);
	 $pm_staff_title_meta = get_post_meta(get_the_ID(), 'pm_staff_title_meta', true);
	 $pm_staff_twitter_meta = get_post_meta(get_the_ID(), 'pm_staff_twitter_meta', true);
	 $pm_staff_facebook_meta = get_post_meta(get_the_ID(), 'pm_staff_facebook_meta', true);
	 $pm_staff_gplus_meta = get_post_meta(get_the_ID(), 'pm_staff_gplus_meta', true);
	 $pm_staff_linkedin_meta = get_post_meta(get_the_ID(), 'pm_staff_linkedin_meta', true);
	 $pm_staff_email_address_meta = get_post_meta(get_the_ID(), 'pm_staff_email_address_meta', true);
	 $enableTooltip = get_theme_mod('enableTooltip','on');
	              
?>

<!-- PANEL 1 -->
<div class="container pm-containerPadding-top-110 pm-containerPadding-bottom-110 container-scroll">

    <div class="row">
        
        <div class="col-lg-3 col-md-3 col-sm-12">
        	
            <div class="pm-staff-member-system-profile-image single-post">
            	<img src="<?php echo esc_url(esc_html($pm_staff_image_meta)); ?>" alt="<?php the_title(); ?>" />
            </div>
            
            <p class="pm-staff-member-system-bio-name single-post"><?php the_title(); ?></p>
            
            <div class="pm-staff-member-system-bio-divider"></div>
            
            <p class="pm-staff-member-system-bio-title single-post"><?php echo esc_attr($pm_staff_title_meta); ?></p>
            
            <ul class="pm-staff-member-system-bio-social-icons">
            
            	<?php if($pm_staff_twitter_meta !== '') : ?>
                
                	<li class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top' : '' ?>" <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Twitter', 'moxietheme') .'"' : '' ?> data-tip-offset-x="5" data-tip-offset-y="-30"><a class="fa fa-twitter" href="<?php echo esc_html($pm_staff_twitter_meta); ?>" target="_blank"></a></li>
                
                <?php endif; ?>
                
                <?php if($pm_staff_facebook_meta !== '') : ?>
                
                	<li class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top' : '' ?>" <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Facebook', 'moxietheme') .'"' : '' ?> data-tip-offset-x="5" data-tip-offset-y="-30"><a class="fa fa-facebook" href="<?php echo esc_html($pm_staff_facebook_meta); ?>" target="_blank"></a></li>
                
                <?php endif; ?>
                
                <?php if($pm_staff_gplus_meta !== '') : ?>
                
                	<li class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top' : '' ?>" <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Google Plus', 'moxietheme') .'"' : '' ?> data-tip-offset-x="5" data-tip-offset-y="-30"><a class="fa fa-google-plus" href="<?php echo esc_html($pm_staff_gplus_meta); ?>" target="_blank"></a></li>
                
                <?php endif; ?>
                
                <?php if($pm_staff_linkedin_meta !== '') : ?>
                
                	<li class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top' : '' ?>" <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Linkedin', 'moxietheme') .'"' : '' ?> data-tip-offset-x="5" data-tip-offset-y="-30"><a class="fa fa-linkedin" href="<?php echo esc_html($pm_staff_linkedin_meta); ?>" target="_blank"></a></li>
                
                <?php endif; ?>
                
                <?php if($pm_staff_email_address_meta !== '') : ?>
                
                	<li class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top' : '' ?>" <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Email me!', 'moxietheme') .'"' : '' ?> data-tip-offset-x="5" data-tip-offset-y="-30"><a class="fa fa-inbox" href="mailto:<?php echo esc_attr($pm_staff_email_address_meta); ?>" target="_blank"></a></li>
                
                <?php endif; ?>
                
            </ul>
            
        </div>
        
        <div class="col-lg-9 col-md-9 col-sm-12">
        	<?php the_content(); ?>
        </div>
        
    </div><!-- /.row --> 

</div>
<!-- PANEL 1 end -->
