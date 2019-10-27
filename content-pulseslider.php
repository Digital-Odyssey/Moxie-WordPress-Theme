<?php 
	$moxie_options = moxie_theme_get_moxie_options();
	
	$slides = '';
	
	if( isset($moxie_options['opt-pulse-slides']) && !empty($moxie_options['opt-pulse-slides']) ){
		$slides = $moxie_options['opt-pulse-slides'];
	}
	
	$enableFixedHeight = get_theme_mod('enableFixedHeight','off');
		
?>  

<?php 
							
if(is_array($slides)) :
	
	$sliderCounter = 0;

	if(count($slides) > 0){
		
		echo '<div id="pm-pulse-loader"><img src="'.get_template_directory_uri().'/js/pulse/img/ajax-loader.gif" /></div>';
		
		echo '<div id="pm-slider" class="pm-slider'. ($enableFixedHeight === 'false' ? ' scalable' : '') .'">';
		
			echo '<div id="pm-slider-progress-bar"></div>';
			
			echo '<ul class="pm-slides-container" id="pm_slides_container">';
			
				foreach($slides as $s) {
					
					$title = '';
					$subTitle = '';
					$btnPiece1 = '';
					$btnPiece2 = '';
					$btnUrl = '';
					$desc = '';
														
					if(!empty($s['title'])){
						$titlePieces = explode(" - ", $s['title']);
						$title = $titlePieces[0];
						$subTitle = $titlePieces[1];
					}
					
					if(!empty($s['url'])){
						$btnPieces = explode(" / ", $s['url']);
						$btnPiece1 = $btnPieces[0];
						
						$btnUrlPiece = explode(" - ", $btnPieces[1]);
						$btnPiece2 = $btnUrlPiece[0];
						$btnUrl = $btnUrlPiece[1];
						
					}
					
					if(!empty($s['description'])){
						$desc = $s['description'];	
					}
					
					
					echo '<li data-thumb="'.esc_url(esc_html($s['image'])).'" class="pmslide_'.$sliderCounter.'"><img src="'.esc_url(esc_html($s['image'])).'" alt="'. esc_attr($title) .'" />';
					
						echo '<div class="pm-holder'. ($enableFixedHeight === 'false' ? ' scalable' : '') .'">';
                            echo '<div class="pm-caption'. ($enableFixedHeight === 'false' ? ' scalable' : '') .'">';
                                echo '<h1>';
                                    echo '<span class="pm-pulse-slider-caption-divider"></span>';
                                        echo esc_attr($title);
                                        echo '<span class="pm-caption-decription'. ($enableFixedHeight === 'false' ? ' scalable' : '') .'">';
                                            echo esc_attr($subTitle);
                                        echo '</span>';
                                    echo '<span class="pm-pulse-slider-caption-divider"></span>';
                                echo '</h1>';
                                echo '<span class="pm-caption-excerpt'. ($enableFixedHeight === 'false' ? ' scalable' : '') .'">';
                                	echo esc_attr($desc);
                                echo '</span>';
								
								if (strpos($btnUrl, '#') !== FALSE) {
									echo '<a href="'.esc_html($btnUrl).'" class="pm-slide-btn'. ($enableFixedHeight === 'false' ? ' scalable' : '') .' pm-page-scroll">';
								} else {
									echo '<a href="'.esc_html($btnUrl).'" class="pm-slide-btn'. ($enableFixedHeight === 'false' ? ' scalable' : '') .'">';
								}								
                                    echo '<div class="pm-slider-btn-faceflip-top">';
                                        echo '<p>'.esc_attr($btnPiece1).'</p>';
                                    echo '</div>';
                                    echo '<div class="pm-slider-btn-faceflip-bottom">';
                                        echo '<p>'.esc_attr($btnPiece2).'</p>';
                                    echo '</div>';
                                echo '</a>';
                            echo '</div>';
                        echo '</div>';
					
					echo '</li> ';
					
					$sliderCounter++;
							
				}
											
			echo '</ul>';
		
		echo '</div>';
		
		$enableActionBtn = get_theme_mod('enableActionBtn', 'on');
		$sliderActionBtnImage = get_theme_mod('sliderActionBtnImage', '');
		$sliderActionBtnIcon = get_theme_mod('sliderActionBtnIcon', 'fa fa-chevron-down');
		$sliderActionBtnTarget = get_theme_mod('sliderActionBtnTarget', '');
		
		if($enableActionBtn === 'on') :
		
			echo '<div class="pm-slider-scroll-down">';
        	
			  echo '<div class="pm-slider-scroll-down-btn-container">';
				
				  echo '<div class="pm-slider-scroll-down-btn-shadow">';
				  
				  	if($sliderActionBtnImage !== '') { 
						echo '<a href="'.esc_html($sliderActionBtnTarget).'" class="pm-slider-scroll-down-btn pm-page-scroll"><img src="'.esc_url(esc_html($sliderActionBtnImage)).'" /></a>';
					} else { 
						echo '<a href="'.esc_html($sliderActionBtnTarget).'" class="pm-slider-scroll-down-btn pm-page-scroll"><i class="'.esc_attr($sliderActionBtnIcon).'" /></i></a>';
					}
					
				  echo '</div>';
				
			   echo ' </div>';
				
			echo '</div>';
		
		endif;
				
	}//end of if
	
endif;//endif
			
?> 