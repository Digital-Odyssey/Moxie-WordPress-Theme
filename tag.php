<?php get_header(); ?>

<?php 
$universalLayout = get_theme_mod('universalLayout', 'no-sidebar');
?>

<?php
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	$arguments = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'paged' => $paged,
		'tag' => get_query_var('tag')
	);

	$blog_query = new WP_Query($arguments);

	moxie_theme_set_query($blog_query);
	
?>

<div class="container pm-containerPadding-top-110 pm-containerPadding-bottom-110">
    <div class="row">

		<?php if($universalLayout === 'no-sidebar') { ?>
        
        	<div class="col-lg-12 col-md-12 col-sm-12 pm-main-posts">
            
            	<?php if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
        		
                	<?php get_template_part( 'content', 'post' ); ?>
                
                <?php endwhile; else: ?>
                     <p><?php esc_html_e('No posts were found.', 'moxietheme'); ?></p>
                <?php endif; ?> 
                
                <?php get_template_part( 'content', 'pagination' ); ?>
                
                <?php moxie_theme_restore_query(); ?> 
            
            </div>
        
        <?php } else if($universalLayout === 'right-sidebar') {?>
                
            <!-- Retrive right sidebar post template -->
            <div class="col-lg-8 col-md-8 col-sm-8 pm-main-posts">
            
				<?php if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
        		
                	<?php get_template_part( 'content', 'post' ); ?>
                
                <?php endwhile; else: ?>
                     <p><?php esc_html_e('No posts were found.', 'moxietheme'); ?></p>
                <?php endif; ?> 
                
                <?php get_template_part( 'content', 'pagination' ); ?>
                
                <?php moxie_theme_restore_query(); ?> 
                            
            </div>
            
             <!-- Right Sidebar -->
             <?php get_sidebar('blog'); ?>
             <!-- /Right Sidebar -->
        
        <?php } else if($universalLayout === 'left-sidebar') { ?>
                
        	 <!-- Left Sidebar -->
             <?php get_sidebar('blog'); ?>
             <!-- /Left Sidebar -->
        
            <!-- Retrive right sidebar post template -->
            <div class="col-lg-8 col-md-8 col-sm-8 pm-main-posts">
            
				<?php if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
        		
                	<?php get_template_part( 'content', 'post' ); ?>
                
                <?php endwhile; else: ?>
                     <p><?php esc_html_e('No posts were found.', 'moxietheme'); ?></p>
                <?php endif; ?> 
                
                <?php get_template_part( 'content', 'pagination' ); ?>
                
                <?php moxie_theme_restore_query(); ?> 
            
            </div>
                    
        <?php } else {//default full width layout ?>
        
        	<div class="col-lg-12 col-md-12 col-sm-12 pm-main-posts">
            
				<?php if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                
                    <?php get_template_part( 'content', 'post' ); ?>
        
                <?php endwhile; else: ?>
                     <p><?php esc_html_e('No posts were found.', 'moxietheme'); ?></p>
                <?php endif; ?> 
                
                <?php get_template_part( 'content', 'pagination' ); ?>
                
                <?php moxie_theme_restore_query(); ?>                 
            
            </div>
        
        <?php }  ?>
    
	</div> <!-- /row -->
</div> <!-- /container -->

<?php get_footer(); ?>