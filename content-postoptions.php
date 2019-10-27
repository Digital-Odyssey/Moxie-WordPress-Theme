<?php
//Use this file to display page options (print and share icons)

$enableTooltip = get_theme_mod('enableTooltip', 'on');

?>

<ul class="pm-single-post-social-icons">
    <li class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top' : '' ?>" <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Twitter', 'moxietheme') .'"' : '' ?> data-tip-offset-x="-1" data-tip-offset-y="-1"><a href="https://twitter.com/share?url=<?php echo urlencode(get_the_permalink()); ?>&amp;text=<?php echo urlencode(get_the_title()); ?>" title="<?php esc_html_e('Share on Twitter', 'moxietheme'); ?>" class="fa fa-twitter" target="_blank"></a></li>
    <li class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top' : '' ?>" <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Facebook', 'moxietheme') .'"' : '' ?> data-tip-offset-x="-1" data-tip-offset-y="-1"><a href="http://www.facebook.com/share.php?u=<?php urlencode(the_permalink()); ?>" title="<?php esc_html_e('Share on Facebook', 'moxietheme'); ?>" class="fa fa-facebook" target="_blank"></a></li>
    
    <li class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top' : '' ?>" <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Google Plus', 'moxietheme') .'"' : '' ?> data-tip-offset-x="-1" data-tip-offset-y="-1"><a href="https://plus.google.com/share?url=<?php urlencode(the_permalink()); ?>" title="<?php esc_html_e('Share on Google Plus', 'moxietheme'); ?>" class="fa fa-google-plus" target="_blank"></a></li>
    
    <li class="<?php echo esc_attr($enableTooltip) == 'on' ? 'pm_tip_static_top' : '' ?>" <?php echo esc_attr($enableTooltip) == 'on' ? 'title="'. esc_html__('Print Page', 'moxietheme') .'"' : '' ?> data-tip-offset-x="-1" data-tip-offset-y="-1"><a href="#" id="pm-print-btn" title="<?php esc_html_e('Print Page', 'moxietheme'); ?>" class="fa fa-print" target="_blank"></a></li>
</ul>

