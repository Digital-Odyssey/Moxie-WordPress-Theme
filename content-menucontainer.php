<!-- Menu container -->
<nav class="pm-menu-container" id="pm-menu-container">
    <!-- menu window -->
    <div class="pm-menu-columns">
        <div class="container">
        
            <div class="row">
                <div class="col-lg-12 pm-center">
                    <p>Menu</p>
                    <div class="pm-menu-divider"></div>
                </div>          
            </div>
            
            <div class="row">
            
            	<?php if( is_home() || is_front_page() ) { ?>
                
                	<?php
						wp_nav_menu(array(
							'container' => '',
							'container_class' => '',
							'menu_class' => 'pm-main-menu-list',
							'menu_id' => 'pm-main-nav',
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
							'menu_class' => 'pm-main-menu-list',
							'menu_id' => 'pm-main-nav',
							'theme_location' => 'sub_menu',
							'fallback_cb' => 'moxie_theme_sub_menu',
						   )
						);
					?>
                
                <?php } ?>
            
            	
            
            </div>
            
            <?php 
			
				$displaySearchField = get_theme_mod('displaySearchField', 'on');
			
			?>
        
        
        	<?php if($displaySearchField === 'on') : ?>
            
            	<div class="row">
                    <div class="col-lg-12 pm-center">
                        <p><?php _e('Search Articles','moxietheme') ?></p>
                        <div class="pm-menu-divider"></div>
                    </div>          
                </div>
                
                <div class="row">
                    <div class="col-lg-12">                       
                        <div class="pm-search-box">
                            <form name="searchform" id="pm-searchform" method="get" action="#">
                                <input type="text" name="s" placeholder="<?php _e('Type Keywords...','moxietheme') ?>">
                            </form>
                        </div>
                    </div>
                </div>
            
            <?php endif; ?>
            
            
            <div class="row">                    
                <div class="col-lg-12">
                    <i class="fa fa-times pm-menu-exit" id="pm-menu-exit"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- menu window end -->  
</nav>
<!-- Menu container end -->