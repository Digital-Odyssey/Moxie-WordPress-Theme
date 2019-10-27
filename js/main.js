(function($) {
	
	'use strict';

	
	var isMobile = {
		Android: function() {
			return navigator.userAgent.match(/Android/i);
		},
		BlackBerry: function() {
			return navigator.userAgent.match(/BlackBerry/i);
		},
		iOS: function() {
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		},
		Opera: function() {
			return navigator.userAgent.match(/Opera Mini/i);
		},
		Windows: function() {
			return navigator.userAgent.match(/IEMobile/i);
		},
		any: function() {
			return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		}
	};

	var menuLoop = '',
	menuOpen = false,
	menuHover = true,
	pagePercentage = 0,
	activeMap = '',
	latLong = '';
	
	$(window).load(function() { // makes sure the whole site is loaded
	  
		/* ==========================================================================
		   Gallery Isotope activation
		   ========================================================================== */
		   if($("#gallery-posts").length > 0){
			   
			   $('#pm-isotope-item-container').isotope({
				  itemSelector : '.isotope-item',
				  //percentPosition: true,
				  transitionDuration: '0.6s',
				  masonry: {
					columnWidth: '.grid-sizer'
				  }
			  });
			  
		   }
		   
		   if( $('.pm-subheader-post-navigation').length > 0 ){			   
			   
			   if( $('.pm-subheader-post-navigation').length < 2 ) {
				   
				   $('.pm-subheader-post-navigation li:eq(0)').css({
						'margin-top' : 0   
				   });
				   
			   }
			   
		   }
	  
    });
	
	
	
	$(document).ready(function(e) {
		
		// global
		var Modernizr = window.Modernizr;
		
			
		// support for CSS Transitions & transforms
		var support = Modernizr.csstransitions && Modernizr.csstransforms;
		var support3d = Modernizr.csstransforms3d;
		// transition end event name and transform name
		// transition end event name
		var transEndEventNames = {
								'WebkitTransition' : 'webkitTransitionEnd',
								'MozTransition' : 'transitionend',
								'OTransition' : 'oTransitionEnd',
								'msTransition' : 'MSTransitionEnd',
								'transition' : 'transitionend'
							},
		transformNames = {
						'WebkitTransform' : '-webkit-transform',
						'MozTransform' : '-moz-transform',
						'OTransform' : '-o-transform',
						'msTransform' : '-ms-transform',
						'transform' : 'transform'
					};
					
		if( support ) {
			this.transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ] + '.PMMain';
			this.transformName = transformNames[ Modernizr.prefixed( 'transform' ) ];
			//console.log('this.transformName = ' + this.transformName);
		}
		
	
	/* ==========================================================================
	   Page preloader
	   ========================================================================== */
		
		function preloadShow() {
			
			// Setup HTML
			/*if($('.preloader')) {
				$('.preloader').remove();
			}*/
			
			/*var preloader = '<div class="preloader"><div class="top"></div><div class="bottom"></div><div class="logo">' + ("undefined" === typeof $('body').attr('data-preloadable-logo') ? 'Logo' : $('body').attr('data-preloadable-logo')) + '</div><div class="percent">0%</div></div>';*/
			
			//$('body').append(preloader);
			
			var $preloader = $('.preloader');
	
			// Attach image loaded callback
			var $images     = $('img');
			if(0 < $images.length) {
				var current = 0;
				var total   = $images.length;
				$images.imgpreload({each: function() {
					var percent = Math.round((++current / total) * 100);
					$preloader.find('.percent').html(percent + '%');
					$preloader.find('.bar .value').width(percent + '%');
					if(100 === percent) {
						setTimeout(preloadHide, 1000);
					}
				}});
			}
		}
		
		function preloadHide() {
			// Skip if no preloader
			var $preloader  = $('.preloader');
			if(0 === $preloader.length) {
				return;
			}
	
			// Remove the preloader
			$preloader.find('.logo, .bar, .percent').css('opacity', 0);
			setTimeout(function() {
				$preloader.find('.top, .bottom').css('height', 0);
			}, 500);
			setTimeout(function() {
				$preloader.remove();
				$('body').triggerHandler('preload-removed');
			}, 1000);
		}
		
		
		if($('body').is('.preloadable')) {
			$('body').removeClass('preloadable');
			preloadShow();
			var preloadTimeout = setTimeout(preloadHide, 5000);
			$('body').on('preload-removed', function() {
				clearTimeout(preloadTimeout);
			});
		}
		
	/* ==========================================================================
	   Main menu interaction
	   ========================================================================== */
	   if($('.pm-nav').length > 0) {
		   
		   var currBtn = '',
		   prevBtn = '';
		   
		   $('.pm-nav').children('li').each(function(index, element) {
           
		   		var btn = $(this).find('a');
				
				btn.on('click', function(e) {
					
					if(currBtn !== ''){
						prevBtn = currBtn;
						currBtn = $(this);
						prevBtn.removeClass('active');
					} else {
						currBtn = $(this);	
					}
					
					
					$(this).addClass('active');
					
					
				});
		    
           });
		   
		   //superfish activation
			$('.pm-nav').superfish({
				delay: 0,
				animation: {opacity:'show',height:'show'},
				speed: 300,
				dropShadows: false,
			});
			
			$('.sf-sub-indicator').html('<i class="fa fa-angle-down"></i>');
			
			$('.sf-menu ul .sf-sub-indicator').html('<i class="fa fa-angle-right"></i>');
		   
	   }
	   

		
	/* ==========================================================================
	   Comment form
	   ========================================================================== */
		if($('.pm-comment-reply-btn').length > 0) {
			
			$('.pm-comment-reply-btn').on('click', function(e) {
				
				$('.comments-area .comment-respond').css({
					'display' : 'block'	
				});
				
			});
			
			$('#cancel-comment-reply-link').on('click', function(e) {
				
				$('.comments-area .comment-respond').css({
					'display' : 'none'	
				});
				
			});
				
		}
		
	/* ==========================================================================
	   Google maps shortcode
	   ========================================================================== */
		if( $(".googleMap").length > 0 ){
			
			
			$(".googleMap").each(function(index, element) {
                
				var $this = $(this),
				id = $this.attr('id'),
				latitude = $this.data("latitude"),
				longitude = $this.data("longitude"),
				zoom = $this.data("mapZoom"),
				message = $this.data("message"),
				mapType = $this.data("mapType");
								
				methods.initializeGoogleMap(id, latitude, longitude, zoom, mapType, message);
				
            });
			
			
		}//end if
		
		
	/* ==========================================================================
	   postItems shortcode carousel
	   ========================================================================== */
	   if( $("#pm-postItems-carousel").length > 0 ){
		   
		    var postOwl = $("#pm-postItems-carousel");
			
			postOwl.owlCarousel({
				
				items : 3, //10 items above 1000px browser width
				itemsDesktop : [5000,3],
				itemsDesktopSmall : [991,2],
				itemsTablet: [767,2],
				itemsTabletSmall: [720,1],
				itemsMobile : [320,1],
				
				//Playback
				//autoPlay : 0,
				//slideSpeed : 200,
				//stopOnHover : true,
				//paginationSpeed : 800,
				
				//Pagination
				pagination : false,
				paginationNumbers: false,
				
		   });
		   
	   }
	   
	/* ==========================================================================
	   services system owl activation for mobile devices
	   ========================================================================== */
	   if( $(".pm-services-tab-system-list").length > 0 ){
			   
		   $(".pm-services-tab-system-list").owlCarousel({
			
				items : 4, //10 items above 1000px browser width
				itemsDesktop : [5000,4],
				itemsDesktopSmall : [991,3],
				itemsTablet: [767,1],
				itemsTabletSmall: [720,1],
				itemsMobile : [320,1],
				
				//Playback
				//autoPlay : 0,
				//slideSpeed : 200,
				//stopOnHover : true,
				//paginationSpeed : 800,
				
				//Pagination
				pagination : false,
				paginationNumbers: false,
				
		   });
		   
		   
	   }
	   
		
	/* ==========================================================================
	   Flexslider
	   ========================================================================== */
	   if( $("#pm-gallery-post-slider").length > 0 ){
		   
		   $("#pm-gallery-post-slider").flexslider({
				animation:"slide", 
				controlNav: false, 
				directionNav: true, 
				animationLoop: true, 
				slideshow: false, 
				arrows: true, 
				touch: false, 
				prevText : "", 
				nextText : "",
				/*start : function() {
					$('.flex-direction-nav').find('li').eq(0).append('<div class="flex-prev-shadow" />');
					$('.flex-direction-nav').find('li').eq(1).append('<div class="flex-next-shadow" />');
				},*/
			});
		   
	   }
	   
	/* ==========================================================================
	   Panels carousel
	   ========================================================================== */
	   if ( $('#pm-interactive-panels-owl').length > 0 ){
			
			//Activate Own Carousel
			$("#pm-interactive-panels-owl").owlCarousel({
			
				 // Most important owl features
				items : 3,
				itemsCustom : false,
				itemsDesktop : [1200,3],
				itemsDesktopSmall : [991,2],
				itemsTablet: [767,1],
				itemsTabletSmall: [720,1],
				itemsMobile : [320,1],
				singleItem : false,
				itemsScaleUp : false,
				 
				//Basic Speeds
				slideSpeed : 800,
				paginationSpeed : 800,
				rewindSpeed : 1000,
				 
				//Autoplay
				autoPlay : false,
				stopOnHover : false,
				 
				// Responsive
				responsive: true,
				responsiveRefreshRate : 200,
				responsiveBaseWidth: window,
				 
				// CSS Styles
				baseClass : "owl-carousel",
				theme : "owl-theme",
				 
				//Lazy load
				lazyLoad : false,
				lazyFollow : true,
				lazyEffect : "fade",
				 
				//Auto height
				autoHeight : true,
				 
				//Mouse Events
				dragBeforeAnimFinish : true,
				mouseDrag : true,
				touchDrag : true,
				 
			});
			
		}
		
	/* ==========================================================================
	   Animated progress bars
	   ========================================================================== */
		if( $('.count').length > 0 ){
			
			$('.count').each(function() {
				var $this   = $(this);
				$this.data('target', parseInt($this.html(), 10));
				$this.data('counted', false);
				$this.html('0');
			});
						
			$(window).on('scroll', function() {
				var speed   = 3000;
				$(".count:in-viewport").each(function() {
					var $this   = $(this);
					if(!$this.data('counted') && $(window).scrollTop() + $(window).height() >= $this.offset().top) {
						$this.data('counted', true);
						$this.animate({dummy: 1}, {
							duration: speed,
							step:     function(now) {
								var $this   = $(this);
								var val     = Math.round($this.data('target') * now);
								$this.html(val);
								if(0 < $this.parent('.value').length) {
									$this.parent('.value').css('width', val + '%');
								}
							}
						});
					}
				});
			}).triggerHandler('scroll');
			
		}
		
		
		
		
	/* ==========================================================================
	   Print page
	   ========================================================================== */
		if( $('#pm-print-btn').length > 0 ){
			var printBtn = $('#pm-print-btn');
			printBtn.on('click', function() {
				window.print();
				return false;	
			});
		}
		
	/* ==========================================================================
	   Widget search
	   ========================================================================== */
	   if($('.pm-sidebar-search-icon-btn').length > 0){
			var $submitBtn = $('.pm-sidebar-search-icon-btn');
			//alert($submitBtn.attr('id'));
			$submitBtn.on('click', function(e) {
				$('#searchform').submit();
				e.preventDefault();	
			});
		}
		
	/* ==========================================================================
	   Add rollover features to Flicker widget
	   ========================================================================== */
	   if( $('.flickr_badge_image', '#flickr_badge_wrapper').length > 0 ){
	   	
			var flickrATag = $('.flickr_badge_image', '#flickr_badge_wrapper').find('a');
			flickrATag.prepend('<span></span><i class="fa fa-search-plus"></i>');
		
	   }
		
		
	/* ==========================================================================
	   Format footer widget titles
	   ========================================================================== */
		
		if( $('.pm-widget-footer', '#pm-fat-footer').length > 0 ){
				
			$('.pm-widget-footer', '#pm-fat-footer').each(function(index, element) {
                
				var header = $(this).find('h6');
				
				if( header.length > 0 ){
					
					header.html(header.html().replace(/^(\w+)/, '<span>$1</span>'));
				
					header.addClass('pm-fat-footer-title');
					header.append('<span class="pm-fat-footer-title-border"></span>');
					
				}
				
            });
				
		}
		
	/* ==========================================================================
	   Footer newsletter subscribe
	   ========================================================================== */
	    if( $('#pm-footer-newsletter-btn').length > 0 ){
							
			$('#pm-footer-newsletter-btn').on('click', function(e) {
				
				e.preventDefault();
				
				$('.pm-footer-newsletter-subscribe-form', '#pm-home-newsletter-form-container').submit();
				
			});
				
		}
		
	/* ==========================================================================
	   Format sidebar widget titles
	   ========================================================================== */
		
		if( $('#pm-sidebar').length > 0 ){
							
			$('.widget-title').each(function(index, element) {
                
				var $this = $(element);
				
				$this.html($this.html().replace(/^(\w+)/, '<span>$1</span>'));
				
				$this.append('<span class="pm-sidebar-title-border"></span>');
								
            });
				
		}
		
		if( $('.widget.woocommerce > h6').length > 0 ){
							
			$('.widget.woocommerce > h6').each(function(index, element) {
                
				var $this = $(element);
				
				$this.html($this.html().replace(/^(\w+)/, '<span>$1</span>'));
				
				$this.append('<span class="pm-sidebar-title-border"></span>');
								
            });
				
		}
		
		
		
	/* ==========================================================================
	   Newsletter submit
	   ========================================================================== */
		if( $('#pm-home-newsletter-btn').length > 0 ){
				
			$('#pm-home-newsletter-btn').on('click', function(e) {
				
				e.preventDefault();
				
				$('#mc-embedded-subscribe-form').submit();
				
			});
				
		}
		
	/* ==========================================================================
	   Skills table
	   ========================================================================== */
	   
	   function animateSkillsTable() {
		   
		   if( $('.pm-skills-container').length > 0 ){
			   
			   //Calculations
				var cWidth = $('.pm-skills-inner').width(),
				numOfCircles = $('.pm-skills-logo').length,
				totalSpots = cWidth / numOfCircles,
				centerX = (cWidth / 2) - 25,
				centerY = centerX,
				radiusX = cWidth / 2,
				radiusY = radiusX,
				speed = 0.07,
				interval = 200,
				circleCounter = 1,
				timer = null;
								
				$(".pm-skills-container:in-viewport").each(function() {
					
					if (!$('.pm-skills-container').hasClass('already-animated')) {
						
						$('.pm-skills-inner').css({
							'-webkit-transform' : 'scale(1)',
						    '-moz-transform'    : 'scale(1)',
						    '-ms-transform'     : 'scale(1)',
						    '-o-transform'      : 'scale(1)',
						    'transform'         : 'scale(1)'	
						});
				   
					   $('.pm-skills-container').addClass('already-animated');
					   
					   timer = setInterval(animateCircles, 200);
									
						$('.pm-skills-logo').each(function(index, element) {
							
							//set the start positions
							$('.pm-skills-logo').css({
								'top' : (cWidth / 2) - ($('.pm-skills-logo').height() / 2),
								'left' : (cWidth / 2) - ($('.pm-skills-logo').width() / 2),
							});
							
							$(this).on('click mouseover mouseout', function(e) {
								
								e.preventDefault();
								
								var $this = $(this);
								
								/*if(e.type === 'mouseover') {
									$this.addClass('active');	
								}*/
								
								if(e.type === 'click') {
									
									$('.pm-skills-logo').removeClass('active');
									$(this).addClass('active');
									
									var id = $(this).attr('id'),
									idNum = id.substr(id.lastIndexOf("-") + 1);
									
									$('.pm-skills-logo-text').removeClass('active');
									$('#pm-skills-logo-text-'+idNum+'').addClass('active');
									
									//Animate milestone
									var dataStop = $(this).attr("data-stop"),
									dataSpeed = $(this).attr("data-speed"),
									targetMilestone = $('#pm-skills-logo-text-percentage-'+ idNum +'');
									
									animateSkillsMilestones(dataStop, dataSpeed, targetMilestone);
									
								}
								
								
							});
							
						});
					   
				   }//end if
					
				});//end of viewport check
				
			}
			
			function animateCircles() {
				
				if(circleCounter >= numOfCircles){
					clearInterval(timer);
				}
				
				var angle = circleCounter * ((Math.PI * 2) / numOfCircles),
				dx = Math.cos(angle)*radiusX+centerX,
				dy = Math.sin(angle)*radiusY+centerY;
							
				var currCircle = $('#pm-skills-logo-'+ circleCounter +''),
				circleID = currCircle.attr('id'),
				circleIDNum = circleID.substr(circleID.lastIndexOf("-") + 1),
				topPosition = Math.round( (dx / cWidth) * 100 ) + '%',
				leftPosition = Math.round( (dy / cWidth) * 100 ) + '%'; //convert top and left values to percentages for responsiveness
				
				currCircle.animate({
					'top' : topPosition,
					'left' : leftPosition,
					'opacity' : 1
				}, 600, 'easeInOutBack');
				
				if(circleCounter == 1){
					
					$('#pm-skills-logo-text-'+circleIDNum+'').addClass('active');
					currCircle.addClass('active');
					
					//Animate milestone
					var dataStop = currCircle.attr("data-stop"),
					dataSpeed = currCircle.attr("data-speed"),
					targetMilestone = $('#pm-skills-logo-text-percentage-'+ circleIDNum +'');
					
					animateSkillsMilestones(dataStop, dataSpeed, targetMilestone);
				}
				
				//console.log('dx = ' + dx);
				circleCounter++;
				
			}
		   
	   }
	   	
		
	/* ==========================================================================
	   Newsletter forms submission
	   ========================================================================== */
		if( $('#pm-home-newsletter-btn').length > 0 ){
			
			$('#pm-home-newsletter-btn').on('click', function(e) {
				
				e.preventDefault();
				
				$('#mc-embedded-subscribe-form').submit();
				
			});
			
		}
		
		if( $('#pm-sidebar-newsletter-btn').length > 0 ){
			
			$('#pm-sidebar-newsletter-btn').on('click', function(e) {
				
				e.preventDefault();
				
				$('#mc-embedded-subscribe-form2').submit();
				
			});
			
		}
		
	/* ==========================================================================
	   Set inital position of float menu
	   ========================================================================== */
		var windowWidth = $(window).width() / 2,
		floatMenuWidth = $('#pm-float-menu-container').outerWidth() / 2;
				
		$('#pm-float-menu-container').css({
			'left' : windowWidth - floatMenuWidth
		});

		
	/* ==========================================================================
	   Initialize animations
	   ========================================================================== */
		animateMilestones();
		animatePieCharts();
		//animateProgressBars();
		//setDimensionsPieCharts();
		
		
	/* ==========================================================================
	   Initialize WOW plugin for element animations
	   ========================================================================== */
		if( $(window).width() > 991 ){
			
			if( typeof WOW != 'undefined'  ){	
				new WOW().init();
			}
			
			
		}
		
	/* ==========================================================================
	   Shortcode news posts img interaction
	   ========================================================================== */
	   if( $('.pm-home-news-post-info-container', 'article').length > 0 ){
		   
		   $('.pm-home-news-post-info-container', 'article').each(function(index, element) {
           
		   		var $container = $(this),
				$expandBtn = $container.find('.pm-home-news-post-info-expand-btn'),
				$linksContainer = $container.find('.pm-home-news-post-links-container'),
				$meta = $container.find('.pm-home-news-post-info-meta-container'),
				$excerpt = $container.find('.pm-home-news-post-excerpt-container'),
				$likes = $container.find('.pm-home-news-post-likes-container'),
				$category = $container.parent().find('.pm-home-news-post-category');
				
				$expandBtn.on('click touchstart', function(e) {
					
					e.preventDefault();
					
					var $this = $(this);
					
					if( !$(this).hasClass('active') ){
						
						$(this).addClass('active');
						
						$(this).find('i').removeClass('icon-size-fullscreen').addClass('icon-size-actual');
						
						$container.animate({
							'top' : '380px'	
						}, 600, 'easeInOutBack');
						
						$linksContainer.animate({
							'right' : '0px'	
						}, 600, 'easeInOutBack');
						
						$category.animate({
							'left' : '20px'	
						}, 600, 'easeInOutBack');
						
						$meta.css({
							'opacity' : 0	
						});
						
						$excerpt.css({
							'opacity' : 0	
						});
						
						$likes.css({
							'opacity' : 0	
						});
						
						
					} else {
						
						$(this).removeClass('active');
						
						$(this).find('i').removeClass('icon-size-actual').addClass('icon-size-fullscreen');
						
						$container.animate({
							'top' : '160px'	
						}, 600, 'easeInOutBack');
						
						$linksContainer.animate({
							'right' : '-150px'	
						}, 600, 'easeInOutBack');
						
						$category.animate({
							'left' : '-160px'	
						}, 600, 'easeInOutBack');
						
						$meta.css({
							'opacity' : 1	
						});
						
						$excerpt.css({
							'opacity' : 1	
						});
						
						$likes.css({
							'opacity' : 1	
						});
							
					}
					
				});
		    
           });
		   
	   }
	   
	   
	/* ==========================================================================
	   animatePieCharts
	   ========================================================================== */
	
		function animatePieCharts() {
	
			if(typeof $.fn.easyPieChart != 'undefined'){
	
				$(".pm-pie-chart:in-viewport").each(function() {
		
					var $t = $(this);
					var n = $t.parent().width();
					var r = $t.attr("data-barSize");
					
					if (n < r) {
						r = n;
					}
					
					$t.easyPieChart({
						animate: 1300,
						lineCap: "square",
						lineWidth: $t.attr("data-lineWidth"),
						size: r,
						barColor: $t.attr("data-barColor"),
						trackColor: $t.attr("data-trackColor"),
						scaleColor: "transparent",
						onStep: function(from, to, percent) {
							$(this.el).find('.pm-pie-chart-percent span').text(Math.round(percent));
						}
		
					});
					
				});
				
			}
	
		}
	   
	/* ==========================================================================
	   Blog news posts img interaction
	   ========================================================================== */
	   if( $('.pm-news-post-container', 'article').length > 0 ){
		
			$('.pm-news-post-container', 'article').each(function(index, element) {
           
		   		var $this = $(this),
				$expandBtn = $this.find('.pm-gallery-post-expand-btn-blog'),
				$imgContainer = $this.find('.pm-news-post-img-container'),
				height = $imgContainer.find('img').height();
				
				$expandBtn.on('click touchstart', function(e) {
					
					e.preventDefault();
					
					if( !$(this).hasClass('active') ){
						
						$(this).addClass('active');
						
						$imgContainer.animate({
							'height' : height	
						}, 600, 'easeInOutBack');
						
						$(this).parent().animate({
							'top' : height - 50
						}, 'slow');
						
					} else {
						
						$(this).removeClass('active');
						
						$imgContainer.animate({
							'height' : '325px'	
						}, 370);
						
						$(this).parent().animate({
							'top' : '276px'
						});
							
					}
					
				});
		    
           });
		   
	   }
	   
		
		
	/* ==========================================================================
	   Menu system
	   ========================================================================== */
		$('.pm-header-menu-button').on('click', function(e) {
			
			if( !menuOpen ){
				
				menuOpen = true;
				$('body').removeClass('menu-collapsed').addClass('menu-opened');
				$('#pm-mobile-menu-overlay').addClass('active');
				
				//Show the neccessary menu
				$('.pm-mobile-global-menu-container', '#pm-mobile-global-menu').addClass('active');
				
				//Hide other menus
				$('.pm-mobile-global-sign-in-container', '#pm-mobile-global-menu').removeClass('active');
				$('.pm-mobile-global-registration-container', '#pm-mobile-global-menu').removeClass('active');
				
				methods.activateCloseMenuBtn();
				
			} 
			
			e.preventDefault();
			
		});
		
		$('#pm-mobile-menu-overlay').on('click', function(e) { 
						
			if( menuOpen ){
				menuOpen = false;
				$('body').removeClass('menu-opened').addClass('menu-collapsed');
				$('#pm-mobile-menu-overlay').removeClass('active');
				
				methods.hideCloseMenuBtn();
				
			}
			
			e.preventDefault();
			
		});
		
		
	/* ==========================================================================
	   Timeline container
	   ========================================================================== */
		if($('#pm-timeline-container').length > 0){
			
			var counter = 1,
			listHeight = 0,
			totalListItems = $('.pm-timeline-dates').children().length;
			
			//Hide prev btn on load
			$('#pm-timeline-bar-prev-btn').hide();
						
			$('#pm-timeline-bar-next-btn').on('click', function(e) {
				
				e.preventDefault();
				
				//increment counter
				if(counter < totalListItems){
					
					counter++;	
					
					$('#pm-timeline-bar-prev-btn').fadeIn();
									
					//animate bullets
					var $firstBullet = $('.pm-timeline-controller-bullet.first'),
					$secondBullet = $('.pm-timeline-controller-bullet.second'),
					$thirdBullet = $('.pm-timeline-controller-bullet.third');
					
					$secondBullet.stop().animate({
						'top' : 0,
						'opacity' : 0
					}, 1000, function(e) {
					
						//reset position for next animation
						$secondBullet.css({
							'top' : '47%',
							'opacity' : 1	
						});
						
					});
					
					$thirdBullet.stop().animate({
						'top' : '47%',
						'opacity' : 1
					}, 1000, function(e) {
					
						//reset position for next animation
						$thirdBullet.css({
							'top' : '90%',
							'opacity' : 0	
						});
						
					});
							
					listHeight += 180;
							
					//animate list items		
					$('.pm-timeline-dates li').stop().animate({
						'top' : -listHeight	
					}, 1000);
					
					//animate descriptions
					var currDesc = $('.pm-timeline-descriptions').find('li.active'),
					nextDesc = currDesc.next();
					
					currDesc.removeClass('active');
					nextDesc.addClass('active');
					
					if(counter == totalListItems){
						$(this).fadeOut();
					}
										
					//console.log('listHeight = ' + listHeight);
										
				}//end if
				
				//console.log('counter = ' + counter);
				
			});
			
			$('#pm-timeline-bar-prev-btn').on('click', function(e) {
				
				e.preventDefault();
												
				//decrement counter
				if(counter > 1){
					
					counter--;
					
					$('#pm-timeline-bar-next-btn').fadeIn();
					
					//animate bullets
					var $firstBullet = $('.pm-timeline-controller-bullet.first'),
					$secondBullet = $('.pm-timeline-controller-bullet.second'),
					$thirdBullet = $('.pm-timeline-controller-bullet.third');
					
					$firstBullet.stop().animate({
						'top' : '47%',
						'opacity' : 1
					}, 1000, function(e) {
					
						//reset position for next animation
						$firstBullet.css({
							'top' : 0,
							'opacity' : 0	
						});
						
					});
					
					$secondBullet.stop().animate({
						'top' : '90%',
						'opacity' : 0
					}, 1000, function(e) {
					
						//reset position for next animation
						$secondBullet.css({
							'top' : '47%',
							'opacity' : 1	
						});
						
					});
					
					//animate list items in reverse
					listHeight -= 180;
					
					$('.pm-timeline-dates li').stop().animate({
						'top' : -listHeight
					}, 1000);
					
					//animate descriptions
					var currDesc = $('.pm-timeline-descriptions').find('li.active'),
					prevDesc = currDesc.prev();
					
					currDesc.removeClass('active');
					prevDesc.addClass('active');
					
					if(counter == 1){
						$(this).fadeOut();
					}
					
					//console.log('listHeight = ' + listHeight);
					
				}//end if
				
				//console.log('counter = ' + counter);
				
			});
			
		}
		
		
	/* ==========================================================================
	   Staff member system
	   ========================================================================== */
	   if($('#pm-staff-member-system').length > 0){
		   
		   var staffCounter = 1,
		   totalStaffListItems = $('.pm-staff-member-system-profile-image-list', '#pm-staff-member-system').children().length;
		   
		   //Display the first bio upon page load
		   $('.pm-staff-member-system-bio-list', '#pm-staff-member-system').find('li.active').fadeIn(1000);
		   
		   //Hide prev btn on load
		   $('.pm-staff-member-system-controls-btn.prev', '#pm-staff-member-system').animate({ 'opacity' : 0 });
		   
		   $('.pm-staff-member-system-controls-btn.next', '#pm-staff-member-system').on('click', function(e) {
			   
			   e.preventDefault();
			   
			   //increment counter
				if(staffCounter < totalStaffListItems){
					
					staffCounter++;
					
					$('.pm-staff-member-system-controls-btn.prev', '#pm-staff-member-system').animate({ 'opacity' : 1 });
					
					//animate bio pics
					var currPic = $('.pm-staff-member-system-profile-image-list', '#pm-staff-member-system').find('li.active'),
					nextPic = currPic.next();
					
					if( $(window).width() > 480 ){
						
						currPic.removeClass('active animated-once shrink');
						nextPic.addClass('active animated-once shrink');
						
					} else {
						
						currPic.removeClass('active animated-once');
						nextPic.addClass('active animated-once');
							
					}					
					
					//animate bio info
					var currBio = $('.pm-staff-member-system-bio-list', '#pm-staff-member-system').find('li.active'),
					nextBio = currBio.next();
					
					currBio.removeClass('active').fadeOut(500);
					nextBio.addClass('active').fadeIn(1000);
					
					if(staffCounter == totalStaffListItems){
						$(this).animate({ 'opacity' : 0 });
					}
					
				}//end if
			   
		   });
		   
		    $('.pm-staff-member-system-controls-btn.prev', '#pm-staff-member-system').on('click', function(e) {
				
				e.preventDefault();
				
				//decrement counter
				if(staffCounter > 1){
					
					staffCounter--;
					
					$('.pm-staff-member-system-controls-btn.next', '#pm-staff-member-system').animate({ 'opacity' : 1 });
					
					//animate bio pics
					var currPic = $('.pm-staff-member-system-profile-image-list', '#pm-staff-member-system').find('li.active'),
					prevPic = currPic.prev();
					
					
					if( $(window).width() > 480 ){
						
						currPic.removeClass('active animated-once shrink');
						prevPic.addClass('active animated-once shrink');
						
					} else {
						
						currPic.removeClass('active animated-once');
						prevPic.addClass('active animated-once');
							
					}
										
					//animate bio info
					var currBio = $('.pm-staff-member-system-bio-list', '#pm-staff-member-system').find('li.active'),
					prevBio = currBio.prev();
					
					currBio.removeClass('active').fadeOut(500);
					prevBio.addClass('active').fadeIn(1000);
					
					if(staffCounter == 1){
						$(this).animate({ 'opacity' : 0 });
					}
					
				}//end if
				
			   
		   });
		   
	   }
		
		
	/* ==========================================================================
	   Isotope menu expander (mobile only)
	   ========================================================================== */
	   if($('#pm-portfolio-system-filter-expand').length > 0){
		   
		   var totalHeight = 0;
		   
		   $('#pm-portfolio-system-filter-expand').on('click', function(e) {
			   
			   var $this = $(this),
			   $parentUL = $this.parent('ul');
			   			   
			   //get the height of the total li elements
			   $parentUL.children('li').each(function(index, element) {
					totalHeight += $(this).outerHeight();
			   });
			   			   
			   if( !$parentUL.hasClass('expanded') ){
				   
				    //expand the menu
					$parentUL.addClass('expanded');
				   				  
				    $parentUL.css({
					  "height" : totalHeight	  
				    });
					
					$this.find('i').removeClass('fa-angle-down').addClass('fa-close');
				   
			   } else {
				
					//close the menu
					$parentUL.removeClass('expanded');
				   				  
				    $parentUL.css({
					  "height" : 90 
				    });
					
					$this.find('i').removeClass('fa-close').addClass('fa-angle-down');
									   
			   }
			   
			   //reset totalheight
			   totalHeight = 0;
			   
		   });
		   
	   }
	   
	   
	/* ==========================================================================
	   Gallery filter re-ordering (mobile only)
	   ========================================================================== */
		$('#pm-portfolio-system-filter').children().each(function(i,e) {
						
			$(e).find('a').on('click', function(e) {
					
				e.preventDefault();				
				
				if( $(window).width() < 760 ){
					//Capture parent li index for list reordering
					var listItem = $(this).closest('li');
					var listItemIndex = $(this).closest('li').index();
					//console.log( "Index: " +  listItemIndex );
					
					//$('.pm-isotope-filter-system').insertAfter(listItem, $('.pm-isotope-filter-system').find("li").index(0));
					
					$('#pm-portfolio-system-filter').find("li").eq(0).after(listItem);
				}
									
			});	
			
		});
		
		
	/* ==========================================================================
	   Gallery System
	   ========================================================================== */
		if( $('#gallery-posts').length > 0 ){
			
			$('.pm-gallery-post-container', '#gallery-posts').each(function(index, element) {
				
				var $expandBtn = $(this).find('.pm-gallery-post-expand-btn'),
				$expandBtnContainer = $(this).find('.pm-gallery-post-expand-btn-container'),
				$detailsContainer = $(this).find('.pm-gallery-post-details'),
				$detailsClose = $(this).find('.pm-gallery-post-details-close-btn'),
				$detailsBorder = $(this).find('.pm-gallery-post-details-border'),
				$detailsList = $(this).find('.pm-gallery-post-details-btns'),
				$likeBox = $(this).find('.pm-gallery-post-like-box-container'),
				$overlay = $(this).find('.pm-gallery-post-overlay'); 
				
				$expandBtn.on('click touchstart', function(e) {
				
					e.preventDefault();
					
					/*if(e.type === 'mouseover'){ }*/
					
					$likeBox.animate({
						'opacity' : 0,
						'top' : '-100px'			
					}, 600, 'easeInOutBack'); //easeOutBounce
					
					$expandBtnContainer.animate({
						'opacity' : 0,
						'bottom' : '-100px'			
					}, 600, 'easeInOutBack'); //easeOutBounce

					
					$detailsContainer.animate({
						'top' : '180px' 
					}, 800, 'easeInOutBack'); //easeOutBounce
					
					
					$detailsBorder.animate({
						'height' : '99%',
						'padding' : '20px',
						'opacity' : 1,		
					}, 800, 'easeInOutBack'); //easeOutBounce
					
					$overlay.css({
						'opacity' : 0	
					});
					
				});
				
				$detailsClose.on('click', function(e) {
					
					e.preventDefault();
					
					$likeBox.animate({
						'opacity' : 1,
						'top' : '25px'			
					}, 600, 'easeInOutBack'); //easeOutBounce
					
					$expandBtnContainer.animate({
						'opacity' : 1,
						'bottom' : '25px'			
					}, 600, 'easeInOutBack'); //easeOutBounce
					
					$detailsContainer.animate({
						'top' : '300px' 
					}, 800, 'easeInOutBack'); //easeOutBounce
					
					$detailsBorder.animate({
						'height' : '2px',
						'padding' : '0px',
						'opacity' : 0,		
					}, 800, 'easeInOutBack'); //easeOutBounce
					
					$overlay.css({
						'opacity' : 1	
					});
					
				});
				
            });
				
			
		}
		
		//Filter system - active bar
		if( $('#pm-portfolio-system-filter').length > 0 ){
			
			if( $(window).width() > 760 ){
				methods.animateGalleryBar( $('#pm-portfolio-system-filter-active-bar') );
			}
			
		}
		
	/* ==========================================================================
	   Pricing table system
	   ========================================================================== */
	   if( $('.pm-pricing-table-container').length > 0 ){
		   
		   
		   $('.pm-pricing-table-container').each(function(index, element) {
           
		   		var $expander = $(this).find('.pm-pricing-table-details-expander');
				
				$expander.each(function(index, element) {
                    
					var $desc = $(this).parent().find('.pm-pricing-table-details-info'),
					$container = $(this).parent().find('.pm-pricing-table-details-container');
					
					$(this).on('click', function(e) {
					
						e.preventDefault();
						
						if( !$(this).hasClass('active') ){
							
							$(this).parent().addClass('active');
							
							$(this).addClass('active');
							
							$(this).removeClass('fa fa-angle-down').addClass('fa fa-close');
							
							$container.css({
								'height' : 	$desc.height() + 80
							});
							
						} else {
							
							$(this).parent().removeClass('active');
						
							$(this).removeClass('active');
							
							$(this).removeClass('fa fa-close').addClass('fa fa-angle-down');
							
							$container.css({
								'height' : 	50
							});
							
						}
					
					});
					
                });
		    
           });
		   
	   }
		
		
	/* ==========================================================================
	   Services Tab system
	   ========================================================================== */
	   if( $('.pm-services-tab-system-container').length > 0 ){
			  
			  //set initial arrow position
			  methods.animateServicesArrow( $('#pm-services-tab-system-container-arrow') );
			  
			  //activate first description box
			  $('.pm-services-tab-system-desc:first').addClass('active');
			  			  
			  //Assign click events
			  $('.pm_services_tab_icon_container').each(function(index, element) {
              
			  		var $this = $(this);
					
					$this.find('a').on('click', function(e) {
						
						e.preventDefault();
						
						//extract id number
						var id = $(this).attr('id'),
						idNum = id.substring(id.lastIndexOf('-') + 1);
						
						//Get target description
						var targetDesc = $('#pm-services-tab-system-desc-' + idNum);
						
						//remove active class on descriptions
						$('.pm-services-tab-system-desc').removeClass('active');
						
						//add active class on target description
						
						targetDesc.addClass('active');
												
						//swap active class on parent container
						$('.pm_services_tab_icon_container').removeClass('active');
						$this.addClass('active');
						
						//Desktop interaction
						if( $(window).width() > 767 ){
																											
							//recalculate arrow position
							methods.animateServicesArrow( $('#pm-services-tab-system-container-arrow') );
							
						} 
								
					});
			    
              });
			  
			  //Assign click events to expander
			  $('.pm-services-tab-system-desc-expander').each(function(index, element) {
              
			  	  var $this = $(this);
				  
				  var currDesc = $this.parents().find('.pm-services-tab-system-desc');
				  
				  if(currDesc.hasClass('active')){
					  
					  $this.on('click', function(e) {
					 
						 e.preventDefault();
						 
						 //grab the id
						 var id = $this.attr('id'),
						 numID = id.substr(id.lastIndexOf("-") + 1),
						 target = $('#pm-services-tab-system-desc-' + numID),//target the container
						 descContainer = target.find('.pm-services-tab-system-desc-text'),
				  		 wrapper = target.find('.pm-services-tab-system-desc-wrapper');
						 
						 if( !$(this).hasClass('expanded') ){
							 
							 $(this).addClass('expanded');
							 $(this).removeClass('fa fa-angle-down').addClass('fa fa-angle-up');
							 
							 wrapper.css({
								'height' : descContainer.height()
							 });
							 
							 
						 } else {
							
							$(this).removeClass('expanded');
							$(this).removeClass('fa fa-angle-up').addClass('fa fa-angle-down');
							 
							 wrapper.css({
								'height' : 220
							 });
							 
						 }							 
						  
					  });
					  
				  }
				  
			    
              });
			   
	   }
	   
	/* ==========================================================================
	   Gallery Isotope filter activation
	   ========================================================================== */
	   
	   if( $('#pm-portfolio-system-filter').length > 0 ){
		   
		   $('#pm-portfolio-system-filter').children().each(function(i,e) {
						
			$(e).find('a').on('click', function(e) {
					
				e.preventDefault();
				
				$('#pm-portfolio-system-filter').children().find('a').removeClass('active');
				$(this).addClass('active');
				
				if( $(window).width() > 760 ){
					methods.animateGalleryBar( $('#pm-portfolio-system-filter-active-bar') );
				}
				
				var id = $(this).attr('id');
				$('#pm-isotope-item-container').isotope({ filter: '.'+$(this).attr('id') });
				
			});
						
			
		});
		   
	   }
	   		
		
	/* ==========================================================================
	   Timetable shortcode interaction
	   ========================================================================== */
	   if( $('.pm-timetable-container').length > 0 ){
		   
		   //Add active class to first accordion item
		   $('.pm-timetable-container').each(function(index, element) {
            
				$(this).find('.pm-timetable-accordion-panel:first').addClass('active');
			
        	});
		   
		   //Click functionality
		   $('.pm-accordion-horizontal').on('click', function(e) {
			  
			  e.preventDefault();
			  
			  var parentAccordion = $(this).data('collapse'),
			  targetPanel = $(this).data('panel');
			  
			  //console.log('expand ' + targetPanel + ' in parent accordion ' + parentAccordion);
			  
			  $('#'+parentAccordion).find('.pm-timetable-accordion-panel').each(function(index, element) {
					$(this).removeClass('active');
              });
			  
			  $('#'+targetPanel).addClass('active');
			   
		   });
		   
	   }//endif
		
		
	/* ==========================================================================
	   animateMilestones
	   ========================================================================== */
	
		function animateMilestones() {
	
			$(".milestone:in-viewport").each(function() {
				
				var $t = $(this);
				var	n = $t.find(".milestone-value").attr("data-stop");
				var	r = parseInt($t.find(".milestone-value").attr("data-speed"), 10);
					
				if (!$t.hasClass("already-animated")) {
					$t.addClass("already-animated");
					$({
						countNum: $t.find(".milestone-value").text()
					}).animate({
						countNum: n
					}, {
						duration: r,
						easing: "linear",
						step: function() {
							$t.find(".milestone-value").text(Math.floor(this.countNum));
						},
						complete: function() {
							$t.find(".milestone-value").text(this.countNum);
						}
					});
				}
				
			});
	
		}
		
		function animateSkillsMilestones(dataStop, dataSpeed, target) {
					
			var $t = target;
			var	n = dataStop;
			var	r = parseInt(dataSpeed, 10);
				
			$({
					countNum: $t.find(".milestone-value").text()
				}).animate({
					countNum: n
				}, {
					duration: r,
					easing: "linear",
					step: function() {
						$t.find(".milestone-value").text(Math.floor(this.countNum) + '%');
					},
					complete: function() {
						$t.find(".milestone-value").text(this.countNum + '%');
					}
				});
	
		}
		
	/* ==========================================================================
	   animateProgressBars
	   ========================================================================== */
	
		function animateProgressBars() {
				
			$(".pm-progress-bar .pm-progress-bar-outer:in-viewport").each(function() {
				
				var $t = $(this),
				progressID = $t.attr('id'),
				numID = progressID.substr(progressID.lastIndexOf("-") + 1),
				targetDesc = '#pm-progress-bar-desc-' + numID,
				$target = $(targetDesc).find('span'),
				$diamond = $(targetDesc).find('.pm-progress-bar-diamond'),
				dataWidth = $t.attr("data-width");
								
				
				if (!$t.hasClass("already-animated")) {
					
					$t.addClass("already-animated");
					$t.animate({
						width: dataWidth + "%"
					}, 2000);
					$target.animate({
						"left" : dataWidth + "%",
						"opacity" : 1
					}, 2000);
					$diamond.animate({
						"left" : dataWidth + "%",
						"opacity" : 1
					}, 2000);
					
				}
				
			});
	
		}
	
		
	/* ==========================================================================
	   Brand carousel (homepage)
	   ========================================================================== */
	   if( $("#pm-brands-carousel").length > 0 ){
		   
		    var owl = $("#pm-brands-carousel");
			var isPlaying = false;
		   
		    owl.owlCarousel({
				
				items : 4, //10 items above 1000px browser width
				itemsDesktop : [5000,4],
				itemsDesktopSmall : [991,2],
				itemsTablet: [767,2],
				itemsTabletSmall: [720,1],
				itemsMobile : [320,1],
				
				//Pagination
				pagination : false,
				paginationNumbers: false,
				
		   });
		   
		    // Custom Navigation Events
			$(".pm-owl-next", '#pm-brand-carousel-btns').on('click', function(){
				owl.trigger('owl.next');
			})
			$(".pm-owl-prev", '#pm-brand-carousel-btns').on('click', function(){
				owl.trigger('owl.prev');
			})
			
				
			$("#pm-owl-play", '#pm-brand-carousel-btns').on('click', function(){
				
				if(!isPlaying){
					isPlaying = true;
					$(this).removeClass('fa fa-play').addClass('fa fa-stop');
					owl.trigger('owl.play',3000); //owl.play event accept autoPlay speed as second parameter
				} else {
					isPlaying = false;
					$(this).removeClass('fa fa-stop').addClass('fa fa-play');
					owl.trigger('owl.stop');
				}
				
				
			});
			
			//Hover interaction	
			
			$('.pm-brand-item', '#pm-brands-carousel').on('mouseover mouseout', function(e) {
			
				if(e.type === 'mouseover') {
										
					var span = $(this).find('span'),
					aTag = $(this).find('a');
									
					span.css({
						'height' : 70	
					});
					
					aTag.css({
						'bottom' : 20	
					});
					
				} else if (e.type === 'mouseout') {
					
					var span = $(this).find('span'),
					aTag = $(this).find('a');
					
					span.css({
						'height' : 0	
					});
					
					aTag.css({
						'bottom' : -30	
					});
					
				}
				
			});
					
				
		   
	   }
		
	/* ==========================================================================
	   Flexslider (homepage)
	   ========================================================================== */
	   if( $("#pm-flexslider-home").length > 0 ){
		   
		   $("#pm-flexslider-home").flexslider({
				animation:"slide", 
				controlNav: false, 
				directionNav: true, 
				animationLoop: true, 
				slideshow: false, 
				arrows: true, 
				touch: false, 
				prevText : "", 
				nextText : "",
				start : function() {
					$('.flex-direction-nav').find('li').eq(0).append('<div class="flex-prev-shadow" />');
					$('.flex-direction-nav').find('li').eq(1).append('<div class="flex-next-shadow" />');
				},
			});
		   
	   }
		
	/* ==========================================================================
	   PrettyPhoto activation
	   ========================================================================== */
	   methods.loadPrettyPhoto();	  
	   
		
	/* ==========================================================================
	   Homepage slider
	   ========================================================================== */
		if($('#pm-slider').length > 0){
						
			$('#pm-slider').PMSlider({
				speed : wordpressOptionsObject.slideSpeed, //get parameter fron wp
				easing : 'ease',
				loop : wordpressOptionsObject.slideLoop == 'true' ? true : false, //get parameter fron wp
				controlNav : wordpressOptionsObject.enableControlNav == 'true' ? true : false, //false = no bullets / true = bullets / 'thumbnails' activates thumbs //get parameter fron wp
				controlNavThumbs : true,
				animation : wordpressOptionsObject.animationType, //get parameter fron wp
				fullScreen : false,
				slideshow : wordpressOptionsObject.enableSlideShow == 'true' ? true : false, //get parameter fron wp
				slideshowSpeed : wordpressOptionsObject.slideShowSpeed, //get parameter fron wp
				pauseOnHover : wordpressOptionsObject.pauseOnHover == 'true' ? true : false, //get parameter fron wp
				arrows : wordpressOptionsObject.showArrows == 'true' ? true : false, //get parameter fron wp
				fixedHeight : wordpressOptionsObject.fixedHeight == 'true' ? true : false,
				fixedHeightValue : wordpressOptionsObject.sliderHeight,
				touch : true,
				progressBar : false
			});
			
		}
		
		
	/* ==========================================================================
	   Panel scrolling
	   ========================================================================== */
	   $('#back-top-scroll-up').on('click', function(e){
		   
		   e.preventDefault();
		   
		   //Find the container that is in the view
		   $('html, body').stop().animate({
				scrollTop: 0
			}, 1000);
		   
	   });
	   
	   $('#back-top-scroll-down').on('click', function(e){
		   
		   e.preventDefault();
		   
		   var height = $('#pm_layout_wrapper').outerHeight();
		   		   
		   $('html, body').stop().animate({
				scrollTop:height 
			}, 1000);
		   
	   });
		
		
	/* ==========================================================================
	   Isotope menu expander (mobile only)
	   ========================================================================== */
	   if($('.pm-isotope-filter-system-expand').length > 0){
		   
		   var totalHeight = 0;
		   
		   $('.pm-isotope-filter-system-expand').on('click', function(e) {
			   
			   var $this = $(this),
			   $parentUL = $this.parent('ul');
			   			   
			   //get the height of the total li elements
			   $parentUL.children('li').each(function(index, element) {
					totalHeight += $(this).height() + 5;
			   });
			   			   
			   if( !$parentUL.hasClass('expanded') ){
				   
				    //expand the menu
					$parentUL.addClass('expanded');
				   				  
				    $parentUL.css({
					  "height" : totalHeight	  
				    });
					
					$this.find('i').removeClass('fa-angle-down').addClass('fa-close');
				   
			   } else {
				
					//close the menu
					$parentUL.removeClass('expanded');
				   				  
				    $parentUL.css({
					  "height" : 94
				    });
					
					$this.find('i').removeClass('fa-close').addClass('fa-angle-down');
									   
			   }
			   
			   //reset totalheight
			   totalHeight = 0;
			   
		   });
		   
		   
		   $('.pm-isotope-filter-system').children().each(function(i,e) {
						
				if(i > 0){
					
					//add click functionality
					$(e).find('a').on('click', function(e) {
						
						e.preventDefault();
																	
												
						if( $(window).width() < 991 ){
							//Capture parent li index for list reordering
							var listItem = $(this).closest('li');
							var listItemIndex = $(this).closest('li').index();
							console.log( "Index: " +  listItemIndex );
							
							//$('.pm-isotope-filter-system').insertAfter(listItem, $('.pm-isotope-filter-system').find("li").index(0));
							
							$('.pm-isotope-filter-system').find("li").eq(0).after(listItem);
						}
											
					});
					
				}
							
				
			});
		   
		   
	   }//end of if
		
		
	/* ==========================================================================
	   Language Selector drop down
	   ========================================================================== */
		if($('.pm-dropdown.pm-language-selector-menu').length > 0){
			$('.pm-dropdown.pm-language-selector-menu').on('mouseover', methods.dropDownMenu).on('mouseleave', methods.dropDownMenu);
		}

				
	/* ==========================================================================
	   isTouchDevice - return true if it is a touch device
	   ========================================================================== */
	
		function isTouchDevice() {
			return !!('ontouchstart' in window) || ( !! ('onmsgesturechange' in window) && !! window.navigator.maxTouchPoints);
		}
				
		
		//dont load parallax on mobile devices
		function runParallax() {
			
			//enforce check to make sure we are not on a mobile device
			if( !isMobile.any()){
							
				//stellar parallax
				$.stellar({
				  horizontalOffset: 0,
				  verticalOffset: 0,
				  horizontalScrolling: false,
				});
				
				$('.pm-parallax-panel').stellar();
				
								
			}
			
		}//end of function

	   
	   
	 /* ==========================================================================
	   Google map reset for tabs
	   ========================================================================== */
		if( $('.pm-nav-tabs').length > 0){
			
			$('.pm-nav-tabs').children().find('a').on('click', function(e) {
				
				var targetId = $(this).attr('href');
				
				var targetMap = $(targetId).find('.googleMap');
				
				if(targetMap.length > 0){
										
					var id = targetMap.data('id'),
					mapType = targetMap.data('mapType'),
					zoom = targetMap.data('mapZoom'),
					latitude = targetMap.data('latitude'),
					longitude = targetMap.data('longitude'),
					message = targetMap.data('message');
					
					methods.initializeGoogleMap(id, latitude, longitude, zoom, mapType, message);
					
					$(this).on('shown.bs.tab', function(e){
						google.maps.event.trigger(activeMap, 'resize');
						activeMap.setCenter(latLong)
					});
					
				}
				
				//alert();
				
			});
			
		}
	   
    /* ==========================================================================
	   Accordion and Tabs
	   ========================================================================== */
	   
	    $('#accordion').collapse({
		  toggle: true
		});
	    $('#accordion2').collapse({
		  toggle: true
		});
	   
		if($('.panel-title').length > 0){
			
			var $prevItem = null;
			var $currItem = null;
			
			$('.pm-accordion-link').on('click', function(e) {
								
				var $this = $(this);
				
				if($prevItem == null){
					$prevItem = $this;
					$currItem = $this;
				} else {
					$prevItem = $currItem;
					$currItem = $this;
				}				
				
				//reset Google map if found
				var targetId = $this.attr('href');
					
				var targetMap = $(targetId).find('div').find('.googleMap');
				
				if(targetMap.length > 0){
										
					var id = targetMap.data('id'),
					mapType = targetMap.data('mapType'),
					zoom = targetMap.data('mapZoom'),
					latitude = targetMap.data('latitude'),
					longitude = targetMap.data('longitude'),
					message = targetMap.data('message');
									
					methods.initializeGoogleMap(id, latitude, longitude, zoom, mapType, message);
					
					$(targetId).on('shown.bs.collapse', function(e){
						google.maps.event.trigger(activeMap, 'resize');
						activeMap.setCenter(latLong)
					});
					
				}
				
				if( $currItem.attr('href') != $prevItem.attr('href') ) {
										
					//toggle previous item
					if( $prevItem.parent().find('i').hasClass('fa fa-minus') ){
						$prevItem.parent().find('i').removeClass('fa fa-minus').addClass('fa fa-plus');
					}
					
					$currItem.parent().find('i').removeClass('fa fa-plus').addClass('fa fa-minus');
					
				} else if($currItem.attr('href') == $prevItem.attr('href')) {
										
					//else toggle same item
					if( $currItem.parent().find('i').hasClass('fa fa-minus') ){
						$currItem.parent().find('i').removeClass('fa fa-minus').addClass('fa fa-plus');
					} else {
						$currItem.parent().find('i').removeClass('fa fa-plus').addClass('fa fa-minus');
					}
						
				} else {
					
					//console.log('toggle current item');
					$currItem.parent().find('i').removeClass('fa fa-plus').addClass('fa fa-minus');
					
				}
				
				
			});

			
		}
		
		//tab menu
		if($('.nav-tabs').length > 0){
			
			//actiavte first tab of tab menu
			$('.nav-tabs a:first').tab('show');
			$('.nav.nav-tabs li:first-child').addClass('active');
			$('.pm-tab-content div:first-child').addClass('active');
		}
		
	/* ==========================================================================
	   Back to top button
	   ========================================================================== */
		$('#back-top-last').on('click', function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});

		
	/* ==========================================================================
	   When the window is scrolled, do
	   ========================================================================== */
		$(window).scroll(function () {
			
			animateMilestones();
			animateSkillsTable();
			animatePieCharts();
						
			//toggle back to top btn
			var endZone = $('.pm-fat-footer').offset().top - $(window).height();
			
			//console.log(endZone);
			
			if($(this).scrollTop() > endZone && $(window).width() > 991) {
					
				if( support ) {
					$('#back-top').css({ right : -100 });
				} else {
					$('#back-top').animate({ right : -100 });
				}
							
					
			} else  if ($(this).scrollTop() > 250 && $(window).width() > 991) {
					
				if( support ) {
					$('#back-top').css({ right : 20 });
				} else {
					$('#back-top').animate({ right : 20 });
				}
					
			} else {
				if( support ) {
					$('#back-top').css({ right : -100 });
				} else {
					$('#back-top').animate({ right : -100 });
				}
			}
			
			
			
			if ($(this).scrollTop() > 190) {
					
				$('#pm-float-menu-container').addClass('active');
								
			} else {
				
				$('#pm-float-menu-container').removeClass('active');
									
			}//end of if
			
			//toggle fixed nav
			if( $(window).width() > 991 ){
				
				if ($(this).scrollTop() > 190) {
					
					$('.pm-nav-container').addClass('fixed');
									
				} else {
					
					$('.pm-nav-container').removeClass('fixed');
										
				}//end of if
				
				
				//Calculate window scroll status
				var base = this,
				container = $(base);
				
				var wrapper = $('#pm_layout_wrapper'),
				viewportHeight = $(window).height(), 
				scrollbarHeight = viewportHeight / wrapper.height() * viewportHeight,
				progress = $(window).scrollTop() / (wrapper.height() - viewportHeight);
				//distance = progress * (viewportHeight - scrollbarHeight) + scrollbarHeight / 2 - container.height() / 2;
				
				$('#back-top-status').text(Math.round(progress * 100) + '%');
				
				//track this for global purposes
				pagePercentage = Math.round(progress * 100);
				
				//console.log(pagePercentage);
			
			}
						
		});
		
	/* ==========================================================================
	   Detect page scrolls on buttons
	   ========================================================================== */
		if( $('.pm-page-scroll').length > 0 ){
			
			$('.pm-page-scroll').on('click', function(e){
												
				e.preventDefault();
				var $this = $(this);
				var sectionID = $this.attr('href');
								
				$('html, body').animate({
					scrollTop : $(sectionID).offset().top - 50
				}, 1000);
				
			});
			
		}
		
		if( $('.pm-page-scroll-nav').length > 0 ){
			
			$('.pm-page-scroll-nav').find('a').on('click', function(e){
												
				e.preventDefault();
				var $this = $(this);
				var sectionID = $this.attr('href');
								
				$('html, body').animate({
					scrollTop : $(sectionID).offset().top - 50
				}, 1000);
				
			});
			
		}

	
	/* ==========================================================================
	   Back to top button
	   ========================================================================== */
		$('#pm-back-to-top').on('click', function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
		
	/* ==========================================================================
	   Accordion menu
	   ========================================================================== */
		if($('#accordionMenu').length > 0){
			$('#accordionMenu').collapse({
				toggle: false,
				parent: false,
			});
		}
		
		
	/* ==========================================================================
	   Tab menu
	   ========================================================================== */
		if($('.pm-nav-tabs').length > 0){
			//actiavte first tab of tab menu
			$('.pm-nav-tabs a:first').tab('show');
			$('.pm-nav-tabs li:first-child').addClass('active');
		}

	/* ==========================================================================
	   Parallax check
	   ========================================================================== */
		var $window = $(window);
		var $windowsize = 0;
		
		function checkWidth() {
			$windowsize = $window.width();
			if ($windowsize < 980) {
				//if the window is less than 980px, destroy parallax...
				$.stellar('destroy');
			} else {
				runParallax();	
			}
		}
		
		// Execute on load
		checkWidth();
		// Bind event listener
		$(window).resize(checkWidth);

		
	/* ==========================================================================
	   Window resize call
	   ========================================================================== */
		$(window).resize(function(e) {
			methods.windowResize();
		});

		
	/* ==========================================================================
	   Tooltips
	   ========================================================================== */
		if( $('.pm_tip').length > 0 ){
			$('.pm_tip').PMToolTip();
		}
		if( $('.pm_tip_static_bottom').length > 0 ){
			$('.pm_tip_static_bottom').PMToolTip({
				floatType : 'staticBottom'
			});
		}
		if( $('.pm_tip_static_top').length > 0 ){
			$('.pm_tip_static_top').PMToolTip({
				floatType : 'staticTop'
			});
		}
		
	/* ==========================================================================
	   TinyNav
	   ========================================================================== */
		//$(".pm-footer-navigation").tinyNav();
		
			
	}); //end of document ready

	
	/* ==========================================================================
	   Options
	   ========================================================================== */
		var options = {
			dropDownSpeed : 100,
			slideUpSpeed : 200,
			slideDownTabSpeed: 50,
			changeTabSpeed: 200,
		}
	
	/* ==========================================================================
	   Methods
	   ========================================================================== */
		var methods = {
			
			dropDownMenu : function(e){  
					
				var body = $(this).find('> :last-child');
				var head = $(this).find('> :first-child');
				
				if (e.type == 'mouseover'){
					body.fadeIn(options.dropDownSpeed);
				} else {
					body.fadeOut(options.dropDownSpeed);
				}
				
			},
			
			animateGalleryBar : function(element) {
				
				var $e = $(element);
				
				var activeTarget = $('.pm-portfolio-system-filter').find('a.active'),
			    activeTargetWidth = activeTarget.width() / 2,
			    activeTargetPos = activeTarget.offset().left;
				
				$e.css({
				  'left' : activeTargetPos,
				  'width' : activeTarget.outerWidth()
			    });
								
			},
			
			animateServicesArrow : function(element) {
				
				var $e = $(element);
				
				var activeTarget = $('.pm_services_tab_icon_container.active'),
				activeTargetWidth = activeTarget.width() / 2,
				activeTargetPos = (activeTarget.offset().left + activeTargetWidth) - 10;
				  
				$e.css({
					'left' : activeTargetPos
				});
				
			},
			
			scrollToServiceDescription : function(element) {
								
				var $e = $(element);
				
				$('html, body').stop().animate({
					scrollTop: $e.offset().top
				}, 1000);
				
			},
			
			
			
			initializeGoogleMap : function(id, latitude, longitude, mapZoom, mapType, message) {
				
				  var myLatlng = new google.maps.LatLng(latitude,longitude);
				  latLong = myLatlng;
				  var myOptions = {
					center: myLatlng, 
					scrollwheel: false,
					zoom: 13,
					mapTypeId : 'Styled', //custom styles
					mapTypeControlOptions : {
						mapTypeIds : [ 'Styled' ]
					}
				  };
				  
				  
				  var styleArray = [
					  {
						featureType: "all",
						stylers: [
						  { saturation: -80 }
						]
					  },{
						featureType: "road",
						stylers: [
						  { hue: wordpressOptionsObject.secondaryColor },
						  { saturation: 0 }
						]
					  },{
						featureType: "road.arterial",
						elementType: "geometry",
						stylers: [
						  { hue: wordpressOptionsObject.primaryColor },
						  { saturation: 100 }
						]
					  },{
						featureType: "poi.business",
						elementType: "labels",
						stylers: [
						  { visibility: "off" }
						]
					  }
					];
				  
				  //alert(document.getElementById(id).getAttribute('id'));
				  
				  //clear the html div first
				  document.getElementById(id).innerHTML = "";
				  
				  var map = new google.maps.Map(document.getElementById(id), myOptions);
				  
				  var styledMapType = new google.maps.StyledMapType(styleArray, {
						name : 'Styled'
				  });
				  map.mapTypes.set('Styled', styledMapType);
				  		 
				  var contentString = message;
				  var infowindow = new google.maps.InfoWindow({
					  content: contentString
				  });
				   
				  var marker = new google.maps.Marker({
					  position: myLatlng
				  });
				   
				  google.maps.event.addListener(marker, "click", function() {
					  infowindow.open(map,marker);
				  });
				   
				  marker.setMap(map);
				  
				  activeMap = map;
				
			},
			
			activateCloseMenuBtn : function(e) {
				
				var xOffset = 20,
				yOffset = -20,
				contentWidth = $('body').width(),
				mouseX = 0, 
				mouseY = 0;
				
				// cache the selector
				var follower = $("#pm-mobile-menu-hover-close-btn");
				var xp = 0, 
				yp = 0,
				speed = 4;
				
				$("#pm-mobile-menu-overlay").css("cursor", "none");
				
				$('#pm-mobile-menu-hover-close-btn').animate({
					'opacity' : 1	
				});
				
				$("#pm-mobile-menu-overlay").on('mousemove mouseleave', function(e) {
					
					if( e.type === 'mousemove' ){
						
						if( menuHover === true ) {
							
							menuHover = false;
							follower.css({
								"opacity" : 1	
							});
							
						}
						
						mouseX = e.pageX;
   						mouseY = e.pageY; 	
						
						follower.css({"left" : mouseX + xOffset, "top" : mouseY + yOffset});
						
					} else if( e.type === 'mouseleave' ){
						
						menuHover = true;
						follower.css({
							"opacity" : 0	
						});
						
						follower.css({"left" : 0, "top" : 0});
						
					} else {
						//	
					}
									
				});
				
				/*menuLoop = setInterval(function () {
				
					// change 12 to alter damping higher is slower
					xp += ((mouseX - xp) / speed) + xOffset;
					yp += ((mouseY - yp) / speed) + yOffset;
					follower.css({left:xp, top:yp});
					
				}, 30);*/
				
			},
			
			hideCloseMenuBtn : function(e) {
				
				$('#pm-mobile-menu-hover-close-btn').animate({
					'opacity' : 0	
				}, 'fast');
				
				clearInterval(menuLoop);				
				
			},
			
			loadPrettyPhoto : function() {
				
				if( $("a[data-rel^='prettyPhoto']").length > 0 ){
		  							
					$("a[data-rel^='prettyPhoto']").prettyPhoto({
						animation_speed: wordpressOptionsObject.ppAnimationSpeed.toString(), /* fast/slow/normal */
						slideshow: wordpressOptionsObject.ppSlideShowSpeed, /* false OR interval time in ms */
						autoplay_slideshow: wordpressOptionsObject.ppAutoPlay == 'false' ? false : true, /* true/false */
						opacity: 0.80, /* Value between 0 and 1 */
						show_title: wordpressOptionsObject.ppShowTitle == 'false' ? false : true, /* true/false */
						social_tools: wordpressOptionsObject.ppSocialTools == 'false' ? false : '<div class="pp_social"><div class="twitter"><a href="http://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div><div class="facebook"><iframe src="http://www.facebook.com/plugins/like.php?locale=en_US&href='+location.href+'&amp;layout=button_count&amp;show_faces=true&amp;width=500&amp;action=like&amp;font&amp;colorscheme=light&amp;height=23" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:500px; height:23px;" allowTransparency="true"></iframe></div></div>', /* true/false */
						//allow_resize: true, /* Resize the photos bigger than viewport. true/false */
						//default_width: 640,
						//default_height: 480,
						counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
						theme: wordpressOptionsObject.ppColorTheme.toString(), /* light_rounded / dark_rounded / light_square / dark_square / facebook */
						horizontal_padding: 20, /* The padding on each side of the picture */
						hideflash: true, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
						wmode: 'opaque', /* Set the flash wmode attribute */
						autoplay: true, /* Automatically start videos: True/False */
						modal: false, /* If set to true, only the close button will close the window */
						deeplinking: true, /* Allow prettyPhoto to update the url to enable deeplinking. */
						overlay_gallery: true, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
						keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
						changepicturecallback: function(){}, /* Called everytime an item is shown/changed */
						
					});
					
				}
				
				if( $("a[data-rel^='prettyPhoto1']").length > 0 ){
					
					$("a[data-rel^='prettyPhoto1']").prettyPhoto({
						slideshow: false, /* false OR interval time in ms */
						autoplay_slideshow: false, /* true/false */
						opacity: 0.80, /* Value between 0 and 1 */
						show_title: wordpressOptionsObject.ppShowTitle == 'false' ? false : true, /* true/false */
						//allow_resize: true, /* Resize the photos bigger than viewport. true/false */
						//default_width: 640,
						//default_height: 480,
						counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
						theme: wordpressOptionsObject.ppColorTheme.toString(), /* light_rounded / dark_rounded / light_square / dark_square / facebook */
						horizontal_padding: 20, /* The padding on each side of the picture */
						hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
						wmode: 'opaque', /* Set the flash wmode attribute */
						autoplay: true, /* Automatically start videos: True/False */
						modal: false, /* If set to true, only the close button will close the window */
						deeplinking: true, /* Allow prettyPhoto to update the url to enable deeplinking. */
						overlay_gallery: true, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
						keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
						changepicturecallback: function(){}, /* Called everytime an item is shown/changed */
					});
					
				}
				
				
				
			},
					
			windowResize : function() {
				//resize calls
				
				var windowWidth = $(window).width() / 2,
				floatMenuWidth = $('#pm-float-menu-container').outerWidth() / 2;
				
				$('#pm-float-menu-container').css({
					'left' : windowWidth - floatMenuWidth
				});
				
				if( $(window).width() > 767 ){
					
					if( $('#pm-portfolio-system-filter').length > 0 ){
						methods.animateGalleryBar( $('#pm-portfolio-system-filter-active-bar') );
					}
					
					if( $('.pm-services-tab-system-container').length > 0 ){
						methods.animateServicesArrow( $('#pm-services-tab-system-container-arrow') );
					}
					
					
					$('#pm-portfolio-system-filter').css({
						'height' : 'auto'	
					});
					
				} else {
					
					$('#pm-portfolio-system-filter').css({
						'height' : 90	
					}).removeClass('expanded');
					
					$('.pm-portfolio-system-filter-expand').find('i').removeClass('fa fa-close').addClass('fa fa-angle-down');
					
				}
				
			},
			
		};
		
	
	
})(jQuery);

