/**
 * File customize-preview.js.
 *
 * Instantly live-update customizer settings in the preview for improved user experience.
 */

(function( $ ) {

	// Collect information from customize-controls.js about which panels are opening.
	wp.customize.bind( 'preview-ready', function() {

		// Initially hide the theme option placeholders on load
		$( '.panel-placeholder' ).hide();

		wp.customize.preview.bind( 'section-highlight', function( data ) {

			// Only on the front page.
			if ( ! $( 'body' ).hasClass( 'procast_theme-front-page' ) ) {
				return;
			}

			// When the section is expanded, show and scroll to the content placeholders, exposing the edit links.
			if ( true === data.expanded ) {
				$( 'body' ).addClass( 'highlight-front-sections' );
				$( '.panel-placeholder' ).slideDown( 200, function() {
					$.scrollTo( $( '#panel1' ), {
						duration: 600,
						offset: { 'top': -70 } // Account for sticky menu.
					});
				});

			// If we've left the panel, hide the placeholders and scroll back to the top.
			} else {
				$( 'body' ).removeClass( 'highlight-front-sections' );
				// Don't change scroll when leaving - it's likely to have unintended consequences.
				$( '.panel-placeholder' ).slideUp( 200 );
			}
		});
	});
	
	//Header textfields
	wp.customize( 'headerPostsListSelector', function( value ) {
		value.bind( function( to ) {
			$( '#pro-cast-posts-selector li.activator' ).text( to );
		});
	});
	
	//Reviews textfields
	wp.customize( 'keyRating1Text', function( value ) {
		value.bind( function( to ) {
			$( '.pro-cast-review-rating-score-bar.level-one p' ).text( to );
		});
	});
	
	
	//Footer textfields
	wp.customize( 'newsletterFieldText', function( value ) {
		value.bind( function( to ) {
			$( '.pro-cast-newsletter-field' ).val( to );
		});
	});
		
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		});
	});
		
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		});
	});

	
	
	//Header Colors
	wp.customize( 'mobileNavToggleColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
			
				$( '.pm-header-menu-btn i' ).css({
					color : to
					//borderLeft : '1px solid' + to
				});
				
			}			
		});		
	});	
	
	wp.customize( 'subpageHeaderBackgroundColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
			
				$( '.pm-subheader-container' ).css({
					backgroundColor : to
					//borderLeft : '1px solid' + to
				});
				
			}			
		});		
	});	

				
	
	//end Header Colors
	
	//Header slider options	
	
	wp.customize( 'headerHeight', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
	
				$( 'header' ).css({
					height : to + 'px',
					//opacity : to / 100
				});				
			}			
		});		
	});
	
	wp.customize( 'headerPadding', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
	
				$( 'header' ).css({
					paddingTop : to + 'px',
					paddingBottom : to  + 'px'
					//opacity : to / 100
				});				
			}			
		});		
	});


	//Footer slider options	
	wp.customize( 'fatFooterPadding', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '#pm-fat-footer' ).css({
					paddingTop : to + 'px',
					paddingBottom : to  + 'px'
					//opacity : to / 100
				});				
			}			
		});		
	});
	
	
	wp.customize( 'fatFooterBackgroundColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
			
				$( '.pm-fat-footer' ).css({
					backgroundColor : to
					//borderLeft : '1px solid' + to
				});
				
			}			
		});		
	});	
	
	wp.customize( 'footerBackgroundColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
			
				$( 'footer' ).css({
					backgroundColor : to
					//borderLeft : '1px solid' + to
				});
				
			}			
		});		
	});	


	wp.customize( 'pageBackgroundColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
			
				$( 'body' ).css({
					backgroundColor : to
					//borderLeft : '1px solid' + to
				});
				
			}			
		});		
	});	
	
	wp.customize( 'boxedModeContainerColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
			
				$( '.pm-boxed-mode' ).css({
					backgroundColor : to
					//borderLeft : '1px solid' + to
				});
				
			}			
		});		
	});	
	
	
	wp.customize( 'primaryColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
			
				$( '.woocommerce .widget_price_filter .ui-slider .ui-slider-range' ).css({
					backgroundColor : to
					//borderLeft : '1px solid' + to
				});
				
				$( '.woocommerce div.product form.cart .reset_variations' ).css({
					backgroundColor : to
					//borderLeft : '1px solid' + to
				});
				
				$( '.pm-gallery-post-expand-btn-blog' ).css({
					backgroundColor : to
					//borderLeft : '1px solid' + to
				});
				
				$( '.pm-home-news-post-links-list li a' ).css({
					backgroundColor : to
					//borderLeft : '1px solid' + to
				});
				
				$( '.pm-home-news-post-info-expand-btn' ).css({
					backgroundColor : to
					//borderLeft : '1px solid' + to
				});	
				
				$( '.pm-timeline-bar' ).css({
					backgroundColor : to
					//borderLeft : '1px solid' + to
				});	
				
				$( '.pm-timeline-dates li i' ).css({
					backgroundColor : to
					//borderLeft : '1px solid' + to
				});	
				
				$( '.pm-rounded-btn' ).css({
					backgroundColor : to
					//borderLeft : '1px solid' + to
				});	
				
				$( '.pm-gallery-post-details-btns li a' ).css({
					backgroundColor : to
					//borderLeft : '1px solid' + to
				});	
				
				$( '.pm-home-news-post-category' ).css({
					backgroundColor : to
					//borderLeft : '1px solid' + to
				});	
				
				$( '.pm-divider-left' ).css({
					backgroundColor : to
					//borderLeft : '1px solid' + to
				});
				
				$( '.pm-divider-right' ).css({
					backgroundColor : to
					//borderLeft : '1px solid' + to
				});	
				
				$( '.flexslider .flex-next' ).css({
					backgroundColor : convertHex(to, 95)
					//borderLeft : '1px solid' + to
				});	
				
				$( '.flexslider .flex-prev' ).css({
					backgroundColor : convertHex(to)
					//borderLeft : '1px solid' + to
				});
				
				$( '.pm-dots span.pm-currentDot' ).css({
					backgroundColor : convertHex(to)
					//borderLeft : '1px solid' + to
				});
				
				$( '.pm-news-post-like-box' ).css({
					backgroundColor : convertHex(to)
					//borderLeft : '1px solid' + to
				});
				
				$( '.pm-news-post-category' ).css({
					backgroundColor : convertHex(to)
					//borderLeft : '1px solid' + to
				});
				
				$( '.pm-home-news-post-category' ).css({
					backgroundColor : convertHex(to)
					//borderLeft : '1px solid' + to
				});
				
				$( '.pm-sidebar .pm-widget .tagcloud a' ).css({
					backgroundColor : convertHex(to)
					//borderLeft : '1px solid' + to
				});
				
				$( '.pm-sidebar .tagcloud a' ).css({
					backgroundColor : convertHex(to)
					//borderLeft : '1px solid' + to
				});
				
				$( '.pagination_multi li' ).css({
					backgroundColor : convertHex(to),
					borderColor : to
				});
				
				$( '.owl-item .pm-brand-item span' ).css({
					backgroundColor : convertHex(to)
					//borderLeft : '1px solid' + to
				});
				
				$( '.pm-rounded-btn.cta-btn' ).css({
					backgroundColor : convertHex(to)
					//borderLeft : '1px solid' + to
				});
				
				$( '.product_meta > span > a' ).css({
					color : to
					//borderLeft : '1px solid' + to
				});
				
				$( '.woocommerce div.product p.price' ).css({
					color : to
					//borderLeft : '1px solid' + to
				});
				
				$( '.woocommerce div.product span.price' ).css({
					color : to
					//borderLeft : '1px solid' + to
				});
				
				$( '.pm-sidebar .pm-widget h6' ).css({
					//color : to
					borderLeft : '13px solid' + to
				});
				
				$( '.widget.woocommerce > h6' ).css({
					//color : to
					borderLeft : '13px solid' + to
				});
				
				$( '.pm-home-news-post-title' ).css({
					color : to
					//borderLeft : '1px solid' + to
				});
				
				$( '.pm-home-news-post-info-meta-list li i' ).css({
					color : to
					//borderLeft : '1px solid' + to
				});
				
				$( '.pm-gallery-post-expand-btn-container' ).css({
					//color : to
					border : '2px solid' + to
				});
				
				$( '.pm-skills-inner' ).css({
					//color : to
					borderColor : to
				});
				
				$( '.pm-skills-logo' ).css({
					//color : to
					borderColor : to
				});
				
				$( '.pm-skills-logo-text-title' ).css({
					color : to
					//borderLeft : '1px solid' + to
				});
				
				$( '.pm-comment-avatar' ).css({
					//color : to
					border : '3px solid' + to
				});
				
				$( '.pm-comment' ).css({
					//color : to
					borderTop : '1px solid' + to
				});
				
				$( '.pm-menu-divider' ).css({
					//color : to
					borderTop : '3px solid' + to
				});
				
				$( '.pm-gallery-post-details-divider' ).css({
					//color : to
					borderTop : '2px solid' + to
				});
				
				$( '.pm-gallery-post-details .desc a' ).css({
					color : to
					//borderLeft : '1px solid' + to
				});
				
				$( 'blockquote' ).css({
					//color : to
					borderLeft : '10px solid' + to
				});
				
				$( '.pm-divider-icon' ).css({
					color : to
					//borderLeft : '1px solid' + to
				});
				
				$( '.pm-pricing-table-details-container .title' ).css({
					color : to
					//borderLeft : '1px solid' + to
				});
				
				$( '.pm-home-news-post-date i' ).css({
					color : to
					//borderLeft : '1px solid' + to
				});
				
				$( '.pm-home-news-post-twitter' ).css({
					color : to
					//borderLeft : '1px solid' + to
				});
				
				$( '.pm-home-news-post-read-more i' ).css({
					color : to
					//borderLeft : '1px solid' + to
				});
				
				$( '.pm-slider-scroll-down-btn' ).css({
					//color : to
					border : '2px solid' + to
				});
				
				$( '.pm-news-post-date i' ).css({
					color : to
					//borderLeft : '1px solid' + to
				});
				
				$( '.pm-news-post-btn' ).css({
					color : to
					//borderLeft : '1px solid' + to
				});
				
				$( '.pm-news-post-btn-mobile' ).css({
					color : to
					//borderLeft : '1px solid' + to
				});
				
				$( '.pm-fat-footer-title span' ).css({
					color : to
					//borderLeft : '1px solid' + to
				});
				
				$( '.pm-footer-copyright p' ).css({
					color : to
					//borderLeft : '1px solid' + to
				});
				
				$( '.pm-footer-scroll-up' ).css({
					//color : to
					borderTop : '3px solid' + to
				});
				
				$( '.pm-footer-scroll-up-btn' ).css({
					//color : to
					border : '2px solid' + to
				});
				
				$( '.pm-header-social-icons li a' ).css({
					color : to
					//borderLeft : '1px solid' + to
				});
				
				$( '.pm-sidebar .pm-widget h6 span' ).css({
					color : to
					//borderLeft : '1px solid' + to
				});
				
				$( '.widget.woocommerce > h6 span' ).css({
					color : to
					//borderLeft : '1px solid' + to
				});
				
				$( '.pm-sidebar-title-border' ).css({
					backgroundColor : to
					//borderLeft : '1px solid' + to
				});
				
				$( '.pm-recent-post-btn' ).css({
					backgroundColor : to
					//borderLeft : '1px solid' + to
				});
				
				$( '.pm-tweet-list ul li a' ).css({
					color : to
					//borderLeft : '1px solid' + to
				});
				
				$( '.btn.pm-owl-next' ).css({
					color : to
					//borderLeft : '1px solid' + to
				});
				
				$( '.btn.pm-owl-prev' ).css({
					color : to
					//borderLeft : '1px solid' + to
				});
				
				$( '.pm-related-blog-posts .pm-date i' ).css({
					color : to
					//borderLeft : '1px solid' + to
				});
				
				$( 'a' ).css({
					color : to
					//borderLeft : '1px solid' + to
				});
				
				$( '.pm-twitter-feed-bullets li a.active' ).css({
					color : to
					//borderLeft : '1px solid' + to
				});
				
				$( '.pm-comment-form-textarea' ).css({
					//color : to
					borderBottom : '3px solid' + to
				});
				
				$( '.pm-dropmenu-active ul' ).css({
					backgroundColor : to
					//borderBottom : '3px solid' + to
				});
				
				$( '.pm-twitter-news-list li .tweet a' ).css({
					color : to
					//borderLeft : '1px solid' + to
				});
				
				$( '.portfolio .overlay' ).css({
					backgroundColor : convertHex(to, 80)
					//borderBottom : '3px solid' + to
				});
				
				$( '.hostingicon i' ).css({
					backgroundColor : to
					//borderBottom : '3px solid' + to
				});
				
				$( '.service .circle .fa' ).css({
					color : to
					//borderLeft : '1px solid' + to
				});
				
				$( '.button' ).css({
					backgroundColor : to
					//borderBottom : '3px solid' + to
				});
				
				$( '.tp-button' ).css({
					backgroundColor : to
					//borderBottom : '3px solid' + to
				});
				
				$( '.pm-widget-footer .tweet_list li a' ).css({
					color : to
					//borderLeft : '1px solid' + to
				});
				
				$( '.pm-blog-post-category-container a' ).css({
					backgroundColor : to
					//borderBottom : '3px solid' + to
				});
				
				$( '.pm-blog-post-read-more-btn' ).css({
					backgroundColor : to
					//borderBottom : '3px solid' + to
				});
				
				$( '.pm-sticky-post-icon' ).css({
					backgroundColor : to
					//borderBottom : '3px solid' + to
				});
				
				$( '.pm-blog-post-category-divider' ).css({
					backgroundColor : to
					//borderBottom : '3px solid' + to
				});
				
				$( '.pm-blog-post-category-divider-bottom' ).css({
					backgroundColor : to
					//borderBottom : '3px solid' + to
				});
				
				$( '.pm-blog-post-img-container' ).css({
					//backgroundColor : to
					borderLeft : '2px solid' + to
				});
				
				$( '.pm-blog-post-meta-info-list li i' ).css({
					color : to
					//borderLeft : '1px solid' + to
				});
				
				$( '.pm-blog-post-excerpt a' ).css({
					color : to
					//borderLeft : '1px solid' + to
				});
				
				$( '.pm-blog-post-social-share-list li a' ).css({
					color : to,
					border : '1px solid' + to
				});
				
				$( '.pm-author-name' ).css({
					color : to
					//borderLeft : '1px solid' + to
				});
				
				$( '.pm-author-title' ).css({
					color : to
					//borderLeft : '1px solid' + to
				});
				
				$( '.pm-author-bio-img-bg' ).css({
					//color : to
					border : '5px solid' + to
				});
				
				$( '.pm-single-post-tags-list li i' ).css({
					color : to
					//borderLeft : '1px solid' + to
				});
				
				$( '.pm-single-post-social-icons li a' ).css({
					color : to,
					border : '2px solid' + to
				});
				
				$( '.pm-primary' ).css({
					color : to
					//border : '2px solid' + to
				});
				
				$( '.pm-sidebar-search-container i' ).css({
					color : to
					//border : '2px solid' + to
				});
				
				$( '.pm_quick_contact_submit' ).css({
					backgroundColor : to
					//borderBottom : '3px solid' + to
				});
				
				$( '.pm-recent-blog-posts .pm-date-published' ).css({
					color : to
					//border : '2px solid' + to
				});
				
				$( '.pm-widget-footer .pm-recent-blog-post-details a' ).css({
					color : to
					//border : '2px solid' + to
				});
				
				$( '.pm-recent-blog-post-divider' ).css({
					backgroundColor : to
					//borderBottom : '3px solid' + to
				});
				
				$( '.pm-widget-footer .tweet_list li a' ).css({
					color : to
					//border : '2px solid' + to
				});
				
				$( '.pm-fat-footer-title' ).css({
					//color : to
					borderRight : '13px solid' + to
				});
				
				$( '.pm-fat-footer-title-border' ).css({
					backgroundColor : to
					//borderBottom : '3px solid' + to
				});
				
				$( '.pm-fat-footer-title-divider' ).css({
					backgroundColor : to
					//borderBottom : '3px solid' + to
				});
				
				$( '.pm-pagination li.current' ).css({
					backgroundColor : to
					//borderBottom : '3px solid' + to
				});
				
				$( '.pm_quick_contact_field' ).css({
					//backgroundColor : to
					border : '1px solid' + to
				});
				
				$( '.pm_quick_contact_textarea' ).css({
					//backgroundColor : to
					border : '1px solid' + to
				});
				
				$( '.pm_quick_contact_field.invalid_field' ).css({
					backgroundColor : to
					//borderBottom : '3px solid' + to
				});
				
				$( '.pm_quick_contact_textarea.invalid_field' ).css({
					backgroundColor : to
					//borderBottom : '3px solid' + to
				});
				
				$( '.pm-post-navigation li a' ).css({
					backgroundColor : to
					//borderBottom : '3px solid' + to
				});
				
				$( '.pm-single-post-tags .tags' ).css({
					color : to
					//border : '2px solid' + to
				});
				
				$( '.pm-fat-footer a' ).css({
					color : to
					//border : '2px solid' + to
				});
				
				$( '#portfolio-list li .more' ).css({
					backgroundColor : to,
					border : '2px solid' + to
				});
				
				$( '.feature-box > .fa' ).css({
					color : to
					//border : '2px solid' + to
				});
				
				$( '.bullets li.active a' ).css({
					backgroundColor : to
					//borderBottom : '3px solid' + to
				});
				
				$( '.testimonial .info em' ).css({
					color : to
					//border : '2px solid' + to
				});
				
				$( '.skill .bar .value' ).css({
					backgroundColor : to
					//borderBottom : '3px solid' + to
				});
				
				$( '.milestone .milestone-value' ).css({
					color : to
					//border : '2px solid' + to
				});
				
				$( '.portfolio-filter .filter.active' ).css({
					backgroundColor : to
					//borderBottom : '3px solid' + to
				});
				
				$( '.portfolio-filter li.active a' ).css({
					backgroundColor : to
					//borderBottom : '3px solid' + to
				});
				
				$( '.pm-dropdown.pm-categories-menu .pm-menu-title' ).css({
					color : to
					//border : '2px solid' + to
				});
				
				$( '.pm-dropdown.pm-categories-menu .pm-dropmenu i' ).css({
					color : to
					//border : '2px solid' + to
				});
				
				$( '.pm-comment-form-textfield' ).css({
					//color : to
					borderBottom : '3px solid' + to
				});
				
				$( '.tweet_list li a' ).css({
					color : to
					//border : '2px solid' + to
				});
				
				$( '.pm-newsletter-submit-btn' ).css({
					backgroundColor : to
					//borderBottom : '3px solid' + to
				});
				
				$( '.pm-single-testimonial-shortcode .name' ).css({
					color : to
					//border : '2px solid' + to
				});
				
				$( '.pm-single-testimonial-shortcode .title' ).css({
					color : to
					//border : '2px solid' + to
				});
				
				$( '.pm-single-testimonial-shortcode .date' ).css({
					color : to
					//border : '2px solid' + to
				});
				
				$( '.pm-newsletter-form-container input[type="text"]' ).css({
					color : to,
					border : '1px solid' + to
				});
				
				$( '.pm-single-testimonial-img-bg' ).css({
					//color : to,
					border : '5px solid' + to
				});
				
				$( '.pm-icon-bundle' ).css({
					backgroundColor : to
					//borderBottom : '3px solid' + to
				});
				
				$( '.pm-cta-message' ).css({
					//color : to,
					borderLeft : '5px solid' + to
				});
				
				$( '.pm-form-submit-btn' ).css({
					backgroundColor : to
					//borderBottom : '3px solid' + to
				});
				
				$( '.sf-menu a.active' ).css({
					backgroundColor : to
					//borderBottom : '3px solid' + to
				});
				
				$( '.pm-pricing-table-purchase-container p' ).css({
					color : to
					//border : '2px solid' + to
				});
				
				$( '.pm-pricing-table-container ul li.active' ).css({
					//color : to,
					borderLeft : '5px solid' + to
				});
				
				$( '.pm-pricing-table-container ul' ).css({
					//color : to,
					borderTop : '1px solid' + to,
					borderBottom : '1px solid' + to
				});
							
			}			
		});		
	});	
	
			
				
	wp.customize( 'secondaryColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
			
				$( '.woocommerce .widget_price_filter .ui-slider .ui-slider-handle' ).css({
					backgroundColor : to
					//borderLeft : '1px solid' + to
				});
				
				$( '.woocommerce span.onsale' ).css({
					backgroundColor : to
					//borderLeft : '1px solid' + to
				});
				
				$( '.woocommerce ul.products li.product .price' ).css({
					//backgroundColor : to
					//borderLeft : '1px solid' + to
					color : to
				});
				
				$( '.woocommerce div.product .woocommerce-tabs ul.tabs li.active > a' ).css({
					backgroundColor : to
					//borderLeft : '1px solid' + to
					//color : to
				});
				
				$( '.woocommerce .star-rating span' ).css({
					//backgroundColor : to
					//borderLeft : '1px solid' + to
					color : to
				});
				
				$( '.woocommerce p.stars a' ).css({
					//backgroundColor : to
					//borderLeft : '1px solid' + to
					color : to
				});
				
				$( '.woocommerce-review-link' ).css({
					//backgroundColor : to
					//borderLeft : '1px solid' + to
					color : to
				});
				
				$( '.woocommerce form .form-row.woocommerce-invalid .select2-container' ).css({
					//backgroundColor : to
					//borderLeft : '1px solid' + to
					//color : to
					borderColor : to
				});
				
				$( '.woocommerce form .form-row.woocommerce-invalid input.input-text' ).css({
					//backgroundColor : to
					//borderLeft : '1px solid' + to
					//color : to
					borderColor : to
				});
				
				$( '.woocommerce form .form-row.woocommerce-invalid select' ).css({
					//backgroundColor : to
					//borderLeft : '1px solid' + to
					//color : to
					borderColor : to
				});
				
				$( '.woocommerce form .form-row.woocommerce-invalid label' ).css({
					//backgroundColor : to
					//borderLeft : '1px solid' + to
					color : to
					//borderColor : to
				});
				
				$( '.woocommerce form .form-row .required' ).css({
					//backgroundColor : to
					//borderLeft : '1px solid' + to
					color : to
					//borderColor : to
				});
				
				$( '.woocommerce a.remove' ).css({
					backgroundColor : to
					//borderLeft : '1px solid' + to
					//color : to
					//borderColor : to
				});
				
				$( '.woocommerce-error' ).css({
					//backgroundColor : to
					borderTop : '3px solid' + to
					//color : to
					//borderColor : to
				});
				
				$( '.woocommerce-info' ).css({
					//backgroundColor : to
					borderTop : '3px solid' + to
					//color : to
					//borderColor : to
				});
				
				$( '.woocommerce-message' ).css({
					//backgroundColor : to
					borderTop : '3px solid' + to
					//color : to
					//borderColor : to
				});
				
				$( '.woocommerce ul.products li.product .price' ).css({
					//backgroundColor : to
					//borderTop : '3px solid' + to
					color : to
					//borderColor : to
				});
				
				$( '.woocommerce form .form-row.woocommerce-validated .select2-container' ).css({
					//backgroundColor : to
					//borderTop : '3px solid' + to
					//color : to
					borderColor : to
				});
				
				$( '.woocommerce form .form-row.woocommerce-validated input.input-text' ).css({
					//backgroundColor : to
					//borderTop : '3px solid' + to
					//color : to
					borderColor : to
				});
				
				$( '.woocommerce form .form-row.woocommerce-validated select' ).css({
					//backgroundColor : to
					//borderTop : '3px solid' + to
					//color : to
					borderColor : to
				});
				
				$( '.woocommerce #respond input#submit.alt' ).css({
					backgroundColor : to
					//borderTop : '3px solid' + to
					//color : to
					//borderColor : to
				});
				
				$( '.woocommerce a.button.alt' ).css({
					backgroundColor : to
					//borderTop : '3px solid' + to
					//color : to
					//borderColor : to
				});
				
				$( '.woocommerce button.button.alt' ).css({
					backgroundColor : to
					//borderTop : '3px solid' + to
					//color : to
					//borderColor : to
				});
				
				$( '.woocommerce input.button.alt' ).css({
					backgroundColor : to
					//borderTop : '3px solid' + to
					//color : to
					//borderColor : to
				});
				
				$( '.woocommerce #respond input#submit' ).css({
					backgroundColor : to
					//borderTop : '3px solid' + to
					//color : to
					//borderColor : to
				});
				
				$( '.woocommerce a.button' ).css({
					backgroundColor : to
					//borderTop : '3px solid' + to
					//color : to
					//borderColor : to
				});
				
				$( '.woocommerce button.button' ).css({
					backgroundColor : to
					//borderTop : '3px solid' + to
					//color : to
					//borderColor : to
				});
				
				$( '.woocommerce input.button' ).css({
					backgroundColor : to
					//borderTop : '3px solid' + to
					//color : to
					//borderColor : to
				});
				
				$( '.pm-404-error b' ).css({
					//backgroundColor : to
					//borderTop : '3px solid' + to
					color : to
					//borderColor : to
				});
				
				$( '.pm-portfolio-system-filter li a' ).css({
					backgroundColor : to
					//borderTop : '3px solid' + to
					//color : to
					//borderColor : to
				});
				
				$( '.pm-services-tab-system-desc-text h5 i' ).css({
					//backgroundColor : to
					//borderTop : '3px solid' + to
					color : to
					//borderColor : to
				});
				
				$( '.pm-gallery-post-expand-btn-blog' ).css({
					//backgroundColor : to
					border : '2px solid' + convertHex(to, 30)
					//color : to
					//borderColor : to
				});
				
				$( '.pm-gallery-post-expand-btn-container-blog' ).css({
					backgroundColor : convertHex(to, 80)
					//border : '2px solid' + convertHex(to, 30)
					//color : to
					//borderColor : to
				});
				
				$( '.pm-home-news-post-info-container' ).css({
					backgroundColor : convertHex(to, 80)
					//border : '2px solid' + convertHex(to, 30)
					//color : to
					//borderColor : to
				});
				
				$( '.pm-timeline-bar' ).css({
					//backgroundColor : convertHex(to, 80)
					border : '1px solid' + convertHex(to, 30)
					//color : to
					//borderColor : to
				});
				
				$( '.pm-timeline-wrapper' ).css({
					backgroundColor : to
					//border : '1px solid' + convertHex(to, 30)
					//color : to
					//borderColor : to
				});
				
				$( '.pm-timeline-bg-overlay' ).css({
					backgroundColor : convertHex(to, 80)
					//border : '1px solid' + convertHex(to, 30)
					//color : to
					//borderColor : to
				});
				
				$( '.pm-gallery-post-details' ).css({
					backgroundColor : convertHex(to, 80)
					//border : '1px solid' + convertHex(to, 30)
					//color : to
					//borderColor : to
				});
				
				$( '.pm-gallery-post-overlay' ).css({
					backgroundColor : convertHex(to, 80)
					//border : '1px solid' + convertHex(to, 30)
					//color : to
					//borderColor : to
				});
				
				$( '.pm-skills-logo' ).css({
					backgroundColor : to
					//border : '1px solid' + convertHex(to, 30)
					//color : to
					//borderColor : to
				});
				
				$( '.pm-staff-member-system-bio-view-profile' ).css({
					//backgroundColor : to
					//border : '1px solid' + convertHex(to, 30)
					color : to
					//borderColor : to
				});
				
				$( '.pm-staff-member-system-profile-image' ).css({
					//backgroundColor : to
					border : '9px solid' + convertHex(to, 30)
					//color : to
					//borderColor : to
				});
				
				$( '.pm-staff-member-system-controls-btn' ).css({
					//backgroundColor : to
					//border : '1px solid' + convertHex(to, 30)
					color : to
					//borderColor : to
				});
				
				$( '.pm-pricing-table-container' ).css({
					backgroundColor : to
					//border : '1px solid' + convertHex(to, 30)
					//color : to
					//borderColor : to
				});
				
				$( '.pm-pricing-table-pricing-container .price' ).css({
					//backgroundColor : to
					//border : '1px solid' + convertHex(to, 30)
					color : to
					//borderColor : to
				});
				
				$( '.pm-pricing-table-purchase-container a' ).css({
					//backgroundColor : to
					//border : '1px solid' + convertHex(to, 30)
					color : to
					//borderColor : to
				});
				
				$( '.pm-pricing-table-details-container .sub-title' ).css({
					//backgroundColor : to
					//border : '1px solid' + convertHex(to, 30)
					color : to
					//borderColor : to
				});
				
				$( '.pm-pricing-table-featured-icon i' ).css({
					//backgroundColor : to
					//border : '1px solid' + convertHex(to, 30)
					color : to
					//borderColor : to
				});
				
				$( '.pm_textarea' ).css({
					backgroundColor : to
					//border : '1px solid' + convertHex(to, 30)
					//color : to
					//borderColor : to
				});
				
				$( '.pm_text_field' ).css({
					backgroundColor : to
					//border : '1px solid' + convertHex(to, 30)
					//color : to
					//borderColor : to
				});
				
				$( '.panel-title i' ).css({
					backgroundColor : to
					//border : '1px solid' + convertHex(to, 30)
					//color : to
					//borderColor : to
				});
				
				$( '.pm-secondary' ).css({
					//backgroundColor : to
					//border : '1px solid' + convertHex(to, 30)
					color : to
					//borderColor : to
				});
				
				$( '.pm-nav-tabs > li > a' ).css({
					backgroundColor : to
					//border : '1px solid' + convertHex(to, 30)
					//color : to
					//borderColor : to
				});
				
				$( '#project-container .project-content .title' ).css({
					//backgroundColor : to
					//border : '1px solid' + convertHex(to, 30)
					color : to
					//borderColor : to
				});
				
				
			}			
		});		
	});			
	
	
					
	wp.customize( 'offsetColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
			
				$( '.pm_services_tab_icon' ).css({
					//backgroundColor : to
					border : '4px solid' + to
					//color : to
					//borderColor : to
				});
				
				$( '.pm-portfolio-system-filter li a.active' ).css({
					backgroundColor : to
					//border : '4px solid' + to
					//color : to
					//borderColor : to
				});
				
				$( '.pm-services-tab-system-desc-text h5' ).css({
					backgroundColor : to
					//border : '4px solid' + to
					//color : to
					//borderColor : to
				});
				
				$( '.pm-header-menu-btn' ).css({
					//backgroundColor : to
					border : '2px solid' + to
					//color : to
					//borderColor : to
				});
				
				$( '.flickr_badge_image a span' ).css({
					backgroundColor : convertHex(to, 80)
					//border : '2px solid' + to
					//color : to
					//borderColor : to
				});
				
				$( '.pm-home-news-post-continue' ).css({
					//backgroundColor : convertHex(to, 80)
					border : '2px solid' + to
					//color : to
					//borderColor : to
				});
				
				$( '.pm-portfolio-system-filter-active-bar' ).css({
					backgroundColor : to
					//border : '2px solid' + to
					//color : to
					//borderColor : to
				});
				
				$( '.pm-header-menu-btn.slider' ).css({
					//backgroundColor : to
					border : '2px solid' + to
					//color : to
					//borderColor : to
				});
				
				$( '.pm-home-news-post-likes-list li i' ).css({
					//backgroundColor : to
					//border : '2px solid' + to
					color : to
					//borderColor : to
				});
				
				$( '.pm-home-news-post-likes-list li a' ).css({
					//backgroundColor : to
					//border : '2px solid' + to
					color : to
					//borderColor : to
				});
				
				$( '.pm-staff-member-system-bio-view-profile' ).css({
					//backgroundColor : to
					border : '3px solid' + to
					//color : to
					//borderColor : to
				});
				
				$( '.pm-staff-member-system-bio-social-icons li a' ).css({
					backgroundColor : to
					//border : '3px solid' + to
					//color : to
					//borderColor : to
				});
				
				$( '.pm-timeline-text-underlay' ).css({
					backgroundColor : to
					//border : '3px solid' + to
					//color : to
					//borderColor : to
				});
				
				$( '.pm-skills-logo.active' ).css({
					backgroundColor : to,
					borderColor : to
					//color : to
					//borderColor : to
				});
				
				$( '.pm-services-tab-system-desc-expander' ).css({
					backgroundColor : to
					//border : '3px solid' + to
					//color : to
					//borderColor : to
				});
				
				$( '.pm-gallery-post-like-box' ).css({
					//backgroundColor : to
					//border : '3px solid' + to
					color : to
					//borderColor : to
				});
				
				$( '.pm-staff-member-system-bio-divider-dotted' ).css({
					//backgroundColor : to
					borderTop : '1px solid' + to
					//color : to
					//borderColor : to
				});
				
				$( '.pm-pricing-table-title-container' ).css({
					backgroundColor : to
					//border : '3px solid' + to
					//color : to
					//borderColor : to
				});
				
				$( '.pm_textarea' ).css({
					//backgroundColor : to
					border : '1px solid' + to
					//color : to
					//borderColor : to
				});
				
				$( '.pm_text_field' ).css({
					//backgroundColor : to
					border : '1px solid' + to
					//color : to
					//borderColor : to
				});
				
				$( '.pm-slider-scroll-down-btn' ).css({
					backgroundColor : to
					//border : '3px solid' + to
					//color : to
					//borderColor : to
				});
				
				$( '.pm-social-navigation li a' ).css({
					//backgroundColor : to
					border : '2px solid' + to
					//color : to
					//borderColor : to
				});
				
				$( '.pm-footer-scroll-up-btn' ).css({
					backgroundColor : to
					//border : '3px solid' + to
					//color : to
					//borderColor : to
				});
				
				$( '.pm-widget-footer .pm-recent-blog-post-details .pm-date i' ).css({
					//backgroundColor : to
					//border : '3px solid' + to
					color : to
					//borderColor : to
				});
				
				$( '.pm-pricing-table-featured-icon' ).css({
					//backgroundColor : to
					border : '2px solid' + to
					//color : to
					//borderColor : to
				});
				
				$( '.pm-pricing-table-container ul li' ).css({
					//backgroundColor : to
					borderLeft : '5px solid' + to
					//color : to
					//borderColor : to
				});
				
			}			
		});		
	});		
			
				
	wp.customize( 'dividerColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
			
				$( '.woocommerce table.shop_table tbody th' ).css({
					//backgroundColor : to
					borderTop : '1px solid' + to
				});
				
				$( '.woocommerce table.shop_table tfoot td' ).css({
					//backgroundColor : to
					borderTop : '1px solid' + to
				});
				$( '.woocommerce table.shop_table tfoot th' ).css({
					//backgroundColor : to
					borderTop : '1px solid' + to
				});
				
				$( '.woocommerce .widget_shopping_cart .total' ).css({
					//backgroundColor : to
					borderTop : '1px solid' + to
				});
				
				$( '.woocommerce.widget_shopping_cart .total' ).css({
					//backgroundColor : to
					borderTop : '1px solid' + to
				});
				
				$( '.woocommerce .woocommerce-ordering select' ).css({
					//backgroundColor : to
					border : '1px solid' + to
				});
				
				$( '.woocommerce #reviews #comment' ).css({
					//backgroundColor : to
					border : '1px solid' + to
				});
				
				$( '.input-text.qty.text' ).css({
					//backgroundColor : to
					border : '1px solid' + to
				});
				
				$( '.woocommerce #reviews #comments ol.commentlist li .comment-text' ).css({
					//backgroundColor : to
					border : '1px solid' + to
				});
				
				$( '.woocommerce div.product form.cart .variations select' ).css({
					//backgroundColor : to
					border : '1px solid' + to
				});
				
				$( '.woocommerce table.shop_table' ).css({
					//backgroundColor : to
					border : '1px solid' + to
				});
				
				$( '.woocommerce table.shop_table td' ).css({
					//backgroundColor : to
					borderTop : '1px solid' + to
				});
				
				$( '.woocommerce form .form-row input.input-text' ).css({
					//backgroundColor : to
					border : '1px solid' + to
				});
				
				$( '.woocommerce form .form-row textarea' ).css({
					//backgroundColor : to
					border : '1px solid' + to
				});
				
				$( '.woocommerce form .form-row select' ).css({
					//backgroundColor : to
					border : '1px solid' + to
				});
				
				$( '.pm-news-post-img-container' ).css({
					//backgroundColor : to
					border : '1px solid' + to
				});
				
				$( '.pm-sidebar-search-container' ).css({
					//backgroundColor : to
					border : '1px solid' + to
				});
				
				$( '.pm-nav-tabs' ).css({
					//backgroundColor : to
					borderBottom : '1px solid' + to
				});
				
				$( '.pm-services-tab-divider' ).css({
					backgroundColor : to
					//borderBottom : '1px solid' + to
				});
				
				$( '.pm-author-divider' ).css({
					backgroundColor : to
					//borderBottom : '1px solid' + to
				});
				
				$( '.hostingborder' ).css({
					backgroundColor : to
					//borderBottom : '1px solid' + to
				});
				
			}			
		});		
	});		
	

	
	wp.customize( 'authorCommentsBgColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
			
				$( '.pm-author-container' ).css({
					backgroundColor : to
					//borderTop : '1px solid' + to
				});
				
				$( '.pm-comments-container' ).css({
					backgroundColor : to
					//borderTop : '1px solid' + to
				});
				
			}			
		});		
	});	
	
	wp.customize( 'accordionContentBgColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
			
				$( '.panel-collapse' ).css({
					backgroundColor : to
					//borderTop : '1px solid' + to
				});
				
			}			
		});		
	});	
	
	wp.customize( 'tabContentBgColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
			
				$( '.pm-tab-content' ).css({
					backgroundColor : to
					//borderTop : '1px solid' + to
				});
				
			}			
		});		
	});	
	
	wp.customize( 'data_table_title_color', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
			
				$( '.pm-workshop-table-title' ).css({
					backgroundColor : to
					//borderTop : '1px solid' + to
				});
				
			}			
		});		
	});	
	
	wp.customize( 'data_table_info_color', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
			
				$( '.pm-workshop-table-content' ).css({
					backgroundColor : to
					//borderTop : '1px solid' + to
				});
				
			}			
		});		
	});	
	
	wp.customize( 'timetable_font_color', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
			
				$( '.pm-timetable-panel-content-body ul li' ).css({
					color : to
					//borderTop : '1px solid' + to
				});
				
				$( '.pm-timetable-panel-title a' ).css({
					color : to
					//borderTop : '1px solid' + to
				});
				
				$( '.pm-timetable-accordion-panel .pm-timetable-panel-heading a.pm-accordion-horizontal-open' ).css({
					color : to
					//borderTop : '1px solid' + to
				});
				
				
			}			
		});		
	});		
	
	wp.customize( 'timetable_border_color', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
			
				$( '.pm-timetable-panel-content-body ul li' ).css({
					//color : to
					borderBottom : '1px solid' + to
				});
				
				
			}			
		});		
	});		
	
	wp.customize( 'pricing_table_font_color', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
			
				$( '.pm-pricing-table-pricing-container .price' ).css({
					color : to
					//borderBottom : '1px solid' + to
				});
				
				$( '.pm-pricing-table-pricing-container .desc' ).css({
					color : to
					//borderBottom : '1px solid' + to
				});
				
				$( '.pm-pricing-table-details-container .sub-title' ).css({
					color : to
					//borderBottom : '1px solid' + to
				});
				
				$( '.pm-pricing-table-details-info' ).css({
					color : to
					//borderBottom : '1px solid' + to
				});
				
				$( '.pm-pricing-table-purchase-container a' ).css({
					color : to
					//borderBottom : '1px solid' + to
				});
				
				$( '.pm-pricing-table-pricing-container .price sub' ).css({
					color : to
					//borderBottom : '1px solid' + to
				});
				
				
			}			
		});		
	});		
	


	// Page layouts.
	/*wp.customize( 'page_layout', function( value ) {
		value.bind( function( to ) {
			if ( 'one-column' === to ) {
				$( 'body' ).addClass( 'page-one-column' ).removeClass( 'page-two-column' );
			} else {
				$( 'body' ).removeClass( 'page-one-column' ).addClass( 'page-two-column' );
			}
		} );
	} );*/
	
	//convertHex('#A7D136',50)
	function convertHex(hex,opacity){
		hex = hex.replace('#','');
		r = parseInt(hex.substring(0,2), 16);
		g = parseInt(hex.substring(2,4), 16);
		b = parseInt(hex.substring(4,6), 16);
	
		result = 'rgba('+r+','+g+','+b+','+opacity/100+')';
		return result;
	}

	// Whether a header image is available.
	function hasHeaderImage() {
		var image = wp.customize( 'header_image' )();
		return '' !== image && 'remove-header' !== image;
	}

	// Whether a header video is available.
	function hasHeaderVideo() {
		var externalVideo = wp.customize( 'external_header_video' )(),
			video = wp.customize( 'header_video' )();

		return '' !== externalVideo || ( 0 !== video && '' !== video );
	}

	// Toggle a body class if a custom header exists.
	/*$.each( [ 'external_header_video', 'header_image', 'header_video' ], function( index, settingId ) {
		wp.customize( settingId, function( setting ) {
			setting.bind(function() {
				if ( hasHeaderImage() ) {
					$( document.body ).addClass( 'has-header-image' );
				} else {
					$( document.body ).removeClass( 'has-header-image' );
				}

				if ( ! hasHeaderVideo() ) {
					$( document.body ).removeClass( 'has-header-video' );
				}
			} );
		} );
	} );*/

} )( jQuery );