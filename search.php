<?php get_header(); ?>
<div class="container pm-containerPadding100 pm-search-results">
    <div class="row">
    
    	<div class="col-lg-12 col-md-12 col-sm-12 pm-search-results">
        
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                                         
                <?php get_template_part( 'content', 'post' ); ?>
            
            <?php endwhile; else: ?>
            
            	<p class="pm-404-error"><?php esc_html_e('Your search entry for', 'moxietheme'); ?><br> "<b><?php echo get_search_query(); ?>"</b> <br><?php esc_html_e('yielded no results.', 'moxietheme'); ?> </p>
                
                <br>

                <p class="pm-404-error"><?php esc_html_e('Try a new search query:', 'moxietheme'); ?></p>
                
                <br>
                                
                <form action="<?php echo home_url('/'); ?>" method="get" id="search-form-page">
                    <input class="pm_text_field search" type="text" name="s" placeholder="<?php esc_html_e('Type keywords...', 'moxietheme') ?>">

                    <input name="" type="button" class="comment-reply-link search" id="pm-search-submit-page" value="<?php esc_html_e('Search', 'moxietheme') ?>">
                </form>
                 
            <?php endif; ?> 
            
            <?php get_template_part( 'content', 'pagination' ); ?>
        
        </div>
    </div>
</div>
<?php get_footer(); ?>