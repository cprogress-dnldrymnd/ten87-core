(function ( $ ) {
	'use strict';

	// This case is important when theme is not active
	if ( typeof qodef !== 'object' ) {
		window.qodef = {};
	}

	window.qodefCore                = {};
	qodefCore.shortcodes            = {};
	qodefCore.listShortcodesScripts = {
		qodefSwiper: qodef.qodefSwiper,
		qodefPagination: qodef.qodefPagination,
		qodefFilter: qodef.qodefFilter,
		qodefMasonryLayout: qodef.qodefMasonryLayout,
		qodefJustifiedGallery: qodef.qodefJustifiedGallery,
	};

	qodefCore.body         = $( 'body' );
	qodefCore.html         = $( 'html' );
	qodefCore.windowWidth  = $( window ).width();
	qodefCore.windowHeight = $( window ).height();
	qodefCore.scroll       = 0;

	$( document ).ready(
		function () {
			qodefCore.scroll = $( window ).scrollTop();
			qodefInlinePageStyle.init();
			qodefGradientBackground.init();
		}
	);

	$( window ).resize(
		function () {
			qodefCore.windowWidth  = $( window ).width();
			qodefCore.windowHeight = $( window ).height();
		}
	);

	$( window ).scroll(
		function () {
			qodefCore.scroll = $( window ).scrollTop();
		}
	);

	$( window ).load(
		function () {
			qodefParallaxItem.init();
			qodefBlobItem.init();
			qodefRevSliderJs.init();
		}
	);


	$( document ).on(
		'obsius_trigger_get_new_posts',
		function () {
			qodefBlobItem.init();
		}
	);

	/**
	 * Check element to be in the viewport
	 */
	var qodefIsInViewport = {
		check: function ( $element, callback, onlyOnce, callbackOnExit ) {
			if ( $element.length ) {
				var offset = typeof $element.data( 'viewport-offset' ) !== 'undefined' ? $element.data( 'viewport-offset' ) : 0.15; // When item is 15% in the viewport

				var observer = new IntersectionObserver(
					function ( entries ) {
						// isIntersecting is true when element and viewport are overlapping
						// isIntersecting is false when element and viewport don't overlap
						if ( entries[0].isIntersecting === true ) {
							callback.call( $element );

							// Stop watching the element when it's initialize
							if ( onlyOnce !== false ) {
								observer.disconnect();
							}
						} else if ( callbackOnExit && onlyOnce === false ) {
							callbackOnExit.call( $element );
						}
					},
					{ threshold: [offset] }
				);

				observer.observe( $element[0] );
			}
		},
	};

	qodefCore.qodefIsInViewport = qodefIsInViewport;

	var qodefScroll = {
		disable: function () {
			if ( window.addEventListener ) {
				window.addEventListener(
					'wheel',
					qodefScroll.preventDefaultValue,
					{ passive: false }
				);
			}

			// window.onmousewheel = document.onmousewheel = qodefScroll.preventDefaultValue;
			document.onkeydown = qodefScroll.keyDown;
		},
		enable: function () {
			if ( window.removeEventListener ) {
				window.removeEventListener(
					'wheel',
					qodefScroll.preventDefaultValue,
					{ passive: false }
				);
			}
			window.onmousewheel = document.onmousewheel = document.onkeydown = null;
		},
		preventDefaultValue: function ( e ) {
			e = e || window.event;
			if ( e.preventDefault ) {
				e.preventDefault();
			}
			e.returnValue = false;
		},
		keyDown: function ( e ) {
			var keys = [37, 38, 39, 40];
			for ( var i = keys.length; i--; ) {
				if ( e.keyCode === keys[i] ) {
					qodefScroll.preventDefaultValue( e );
					return;
				}
			}
		}
	};

	qodefCore.qodefScroll = qodefScroll;

	var qodefPerfectScrollbar = {
		init: function ( $holder ) {
			if ( $holder.length ) {
				qodefPerfectScrollbar.qodefInitScroll( $holder );
			}
		},
		qodefInitScroll: function ( $holder ) {
			var $defaultParams = {
				wheelSpeed: 0.6,
				suppressScrollX: true
			};

			var $ps = new PerfectScrollbar(
				$holder[0],
				$defaultParams
			);

			$( window ).resize(
				function () {
					$ps.update();
				}
			);
		}
	};

	qodefCore.qodefPerfectScrollbar = qodefPerfectScrollbar;

	var qodefInlinePageStyle = {
		init: function () {
			this.holder = $( '#obsius-core-page-inline-style' );

			if ( this.holder.length ) {
				var style = this.holder.data( 'style' );

				if ( style.length ) {
					$( 'head' ).append( '<style type="text/css">' + style + '</style>' );
				}
			}
		}
	};

	/**
	 * Init parallax item
	 */
	var qodefParallaxItem = {
		init: function () {
			var $items = $( '.qodef-parallax-item' );

			if ( $items.length ) {
				$items.each(
					function () {
						var $currentItem = $( this ),
							$y           = Math.floor( Math.random() * (-100 - (-25)) + (-25) );

						if ( $currentItem.hasClass( 'qodef-grid-item' ) ) {
							$currentItem.children( '.qodef-e-inner' ).attr(
								'data-parallax',
								'{"y": ' + $y + ', "smoothness": ' + '30' + '}'
							);
						} else {
							$currentItem.attr(
								'data-parallax',
								'{"y": ' + $y + ', "smoothness": ' + '30' + '}'
							);
						}
					}
				);
			}

			qodefParallaxItem.initParallax();
		},
		initParallax: function () {
			var parallaxInstances = $( '[data-parallax]' );

			if ( parallaxInstances.length && ! qodefCore.html.hasClass( 'touchevents' ) && typeof ParallaxScroll === 'object' ) {
				ParallaxScroll.init(); //initialization removed from plugin js file to have it run only on non-touch devices
			}
		},
	};

	qodefCore.qodefParallaxItem = qodefParallaxItem;

	/**
	 * Init Blob item
	 */
	var qodefBlobItem = {
		init: function () {
			this.holder = $( '.qodef-svg--blob' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						var $thisHolder = $( this );
						qodefBlobItem.initBlob( $thisHolder );
					}
				);
			}
		},
		initBlob: function ( $currentItem ) {
			var blob = createBlob( {
				element: $currentItem.find( 'path' )[0],
				numPoints: 6,
				centerX: 500,
				centerY: 500,
				minRadius: 170,
				maxRadius: 520,
				// minDuration: 1,
				// maxDuration: 3
				minDuration: 1.5,
				maxDuration: 3
			} );

			var isSafari = qodef.body.hasClass('qodef-browser--safari');

			// if (!isSafari) {
			// 	var filterId = 'blurMe';
			// 	var $filter = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="1000px" height="1000px" viewBox="0 0 1000 1000" xml:space="preserve" preserveAspectRatio="none">' +
			// 		'<filter id="blurMe">\n' +
			// 		'    <feGaussianBlur stdDeviation="15"/>\n' +
			// 		'  </filter></svg>';
			//
			// 	qodefCore.body.prepend($filter);
			// 	$currentItem.parent().css('filter',`url(#${filterId})`);
			// }

			function createBlob( options ) {
				var points     = [];
				var path       = options.element;
				var slice      = (Math.PI * 2) / options.numPoints;
				var startAngle = random( Math.PI * 2 );

				var tl = gsap.timeline( {
					onUpdate: update,
					paused: true,
				} );

				for ( var i = 0; i < options.numPoints; i++ ) {

					var angle    = startAngle + i * slice;
					var duration = random(
						options.minDuration,
						options.maxDuration
					);

					var point = {
						x: options.centerX + Math.cos( angle ) * options.minRadius,
						y: options.centerY + Math.sin( angle ) * options.minRadius
					};

					var tween = gsap.to(
						point,
						duration,
						{
							x: options.centerX + Math.cos( angle ) * options.maxRadius,
							y: options.centerY + Math.sin( angle ) * options.maxRadius,
							ease: Sine.easeInOut,
							repeat: -1,
							yoyo: true,
						}
					);

					tl.add(
						tween,
						-random( duration )
					);
					points.push( point );
				}

				function update() {
					path.setAttribute(
						'd',
						cardinal( points,
							true,
							1
						)
					);
				}

				if ( ! $currentItem.parents( 'rs-module' ).length ) {
					qodefCore.qodefIsInViewport.check(
						$currentItem,
						function () {
							tl.play();
						},
						false,
						function () {
							tl.pause();
						}
					);
				} else {
					qodefCore.qodefIsInViewport.check( //currentItem could be hidden , therefore check for rev intersection
						$currentItem.parents( 'rs-module' ),
						function () {
							tl.play();
						},
						false,
						function () {
							tl.pause();
						}
					);
				}
			}

			// Cardinal spline - a uniform Catmull-Rom spline with a tension option
			function cardinal( data, closed, tension ) {

				if ( data.length < 1 ) return 'M0 0';
				if ( tension == null ) tension = 1;

				var size = data.length - (closed ? 0 : 1);
				var path = 'M' + data[0].x + ' ' + data[0].y + ' C';

				for ( var i = 0; i < size; i++ ) {

					var p0, p1, p2, p3;

					if ( closed ) {
						p0 = data[(i - 1 + size) % size];
						p1 = data[i];
						p2 = data[(i + 1) % size];
						p3 = data[(i + 2) % size];

					} else {
						p0 = i == 0 ? data[0] : data[i - 1];
						p1 = data[i];
						p2 = data[i + 1];
						p3 = i == size - 1 ? p2 : data[i + 2];
					}

					var x1 = p1.x + (p2.x - p0.x) / 6 * tension;
					var y1 = p1.y + (p2.y - p0.y) / 6 * tension;

					var x2 = p2.x - (p3.x - p1.x) / 6 * tension;
					var y2 = p2.y - (p3.y - p1.y) / 6 * tension;

					path += ' ' + x1 + ' ' + y1 + ' ' + x2 + ' ' + y2 + ' ' + p2.x + ' ' + p2.y;
				}

				return closed ? path + 'z' : path;
			}

			function random( min, max ) {
				if ( max == null ) {
					max = min;
					min = 0;
				}
				if ( min > max ) {
					var tmp = min;
					min     = max;
					max     = tmp;
				}
				return min + (max - min) * Math.random();
			}
		}
	};

	qodefCore.qodefBlobItem = qodefBlobItem;

	var qodefRevSliderJs = {
		init: function () {
			var revapis = $( 'rs-module' );

			if ( revapis.length ) {
				revapis.each(
					function () {
						var revapi = $( this );
						var blobs  = revapis.find( '.qodef-svg--blob' );

						revapi.bind(
							'revolution.slide.onloaded',
							function () {
								blobs.each(
									function () {
										var blob = $( this );

										qodefCore.qodefBlobItem.initBlob(blob);
									}
								);
							}
						);
					}
				);
			}
		}
	};

	qodefCore.qodefRevSliderJs = qodefRevSliderJs;

	var qodefGradientBackground = {
		init: function () {
			var $holder = qodefCore.body.closest('.qodef-gradient-background--enabled' );

			if ( $holder.length ) {
				$holder.addClass('qodef--html-loaded');
			}
		}
	};

	qodefCore.qodefGradientBackground = qodefGradientBackground;
})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefBackToTop.init();
		}
	);

	var qodefBackToTop = {
		init: function () {
			this.holder = $( '#qodef-back-to-top' );

			if ( this.holder.length ) {
				// Scroll To Top
				this.holder.on(
					'click',
					function ( e ) {
						e.preventDefault();
						qodefBackToTop.animateScrollToTop();
					}
				);

				qodefBackToTop.showHideBackToTop();
			}
		},
		animateScrollToTop: function () {
			var startPos = qodef.scroll,
				newPos   = qodef.scroll,
				step     = .9,
				animationFrameId;

			var startAnimation = function () {
				if ( newPos === 0 ) {
					return;
				}

				newPos < 0.0001 ? newPos = 0 : null;

				var ease = qodefBackToTop.easingFunction( (startPos - newPos) / startPos );
				$( 'html, body' ).scrollTop( startPos - (startPos - newPos) * ease );
				newPos = newPos * step;

				animationFrameId = requestAnimationFrame( startAnimation );
			};

			startAnimation();

			$( window ).one(
				'wheel touchstart',
				function () {
					cancelAnimationFrame( animationFrameId );
				}
			);
		},
		easingFunction: function ( n ) {
			return 0 == n ? 0 : Math.pow( 1024, n - 1 );
		},
		showHideBackToTop: function () {
			$( window ).scroll(
				function () {
					var $thisItem = $( this ),
						b         = $thisItem.scrollTop(),
						c         = $thisItem.height(),
						d;

					if ( b > 0 ) {
						d = b + c / 2;
					} else {
						d = 1;
					}

					if ( d < 1e3 ) {
						qodefBackToTop.addClass( 'off' );
					} else {
						qodefBackToTop.addClass( 'on' );
					}
				}
			);
		},
		addClass: function ( a ) {
			this.holder.removeClass( 'qodef--off qodef--on' );

			if ( a === 'on' ) {
				this.holder.addClass( 'qodef--on' );
			} else {
				this.holder.addClass( 'qodef--off' );
			}
		}
	};

})( jQuery );

(function ($) {
	"use strict";

	$( window ).on(
		'load',
		function () {
			qodefBackgroundText.init();
		}
	);

	$( window ).resize(
		function () {
			qodefBackgroundText.init();
		}
	);

	var qodefBackgroundText = {
		init                    : function () {
			var $holder = $( '.qodef-background-text' );

			if ($holder.length) {
				$holder.each(
					function () {
						qodefBackgroundText.responsiveOutputHandler( $( this ) );
					}
				);
			}
		},
		responsiveOutputHandler : function ($holder) {
			var breakpoints = {
				3840: 1441,
				1440: 1367,
				1366: 1025,
				1024: 1
			};

			$.each(
				breakpoints,
				function (max, min) {
					if (qodef.windowWidth <= max && qodef.windowWidth >= min) {
						qodefBackgroundText.generateResponsiveOutput( $holder, max );
					}
				}
			);
		},
		generateResponsiveOutput: function ($holder, width) {
			var $textHolder = $holder.find( '.qodef-m-background-text' );

			if ($textHolder.length) {
				$textHolder.css(
					{
						'font-size': $textHolder.data( 'size-' + width ) + 'px',
						'top'      : $textHolder.data( 'vertical-offset-' + width ) + 'px',
					}
				);
			}
		},
	};

	window.qodefBackgroundText = qodefBackgroundText;
})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready( function () {
		qodefCustomCursor.init();
	} );

	$( window ).on(
		'elementor/frontend/init',
		function () {
			qodefCustomCursor.init();
		}
	);

	var qodefCustomCursor = {
		init: function () {
			var cursorHolder = $( 'body:not(.elementor-editor-active) #qodef-custom-cursor' ),
				cursor       = cursorHolder.find( '.qodef-cursor-dot-small' ),
				cursorLarge  = cursorHolder.find( '.qodef-cursor-dot-large' ),
				largeHolder  = $( '#qodef-cursor-dot-large-holder' ),
				smallHolder  = $( '#qodef-cursor-dot-small-holder' ),
				textHolder   = cursorHolder.find( '.qodef-cursor-text-holder' ),
				cursors      = largeHolder.add( smallHolder ).addClass( 'qodef-cursor-active' );


			if ( cursorHolder.length && qodef.windowWidth > 1024 ) {
				//init
				cursors.css( {
					transform: 'matrix(1, 0, 0, 1, ' + qodef.windowWidth / 2 + ', ' + qodef.windowHeight / 2 + ')'
				} );
				textHolder.css( {
					transform: 'matrix(1, 0, 0, 1, ' + qodef.windowWidth / 2 + ', ' + qodef.windowHeight / 2 + ')'
				} );

				//move
				$( document )
				.on(
					'mousemove',
					function ( e ) {

						var x = e.clientX,
							y = e.clientY;

						smallHolder.css( {
							transform: 'matrix(1, 0, 0, 1, ' + x + ', ' + y + ')'
						} );

						setTimeout(
							function () {
								largeHolder.css( {
									transform: 'matrix(1, 0, 0, 1, ' + x + ', ' + y + ')'
								} );
							},
							80
						);

						textHolder.css( {
							transform: 'matrix(1, 0, 0, 1, ' + x + ', ' + y + ')'
						} );

					}
				);

				//hover blend
				var blendSelectors = '.qodef--cursor-blend, .select2-dropdown, .select2, .qodef-accordion-mark, .rbt-list-holder';
				$( document ).on(
					'mouseover',
					blendSelectors,
					function () {
						cursorHolder.addClass( 'qodef--hovering' );
					}
				);
				$( document ).on(
					'mouseleave',
					blendSelectors,
					function () {
						cursorHolder.removeClass( 'qodef--hovering' );
					}
				);

				//hover links
				var linkSelectors = 'a, .swiper-button-next, .swiper-button-prev, button, input, rs-arrow, .qodef-woo-preview-product-slider .qodef-bottom-slider .swiper-slide, .rbt-btn';
				$( document ).on(
					'mouseover',
					linkSelectors,
					function () {
						cursorHolder.addClass( 'qodef--hovering' );
						qodefCustomCursor.linkCursor( cursor );
					}
				);
				$( document ).on(
					'mouseleave',
					linkSelectors,
					function () {
						cursorHolder.removeClass( 'qodef--hovering' );
						qodefCustomCursor.resetSize( cursor );
					}
				);

				//view links
				var viewSelectors = '.qodef-image-with-text:not(.qodef-hover--predefined) .qodef-m-image a';

				$( document ).on(
					'mouseover',
					viewSelectors,
					function () {
						cursorHolder.removeClass( 'qodef--hovering' );
						cursorHolder.addClass( 'qodef--view' );
						qodefCustomCursor.viewCursor( cursor );
					}
				);
				$( document ).on(
					'mouseleave',
					viewSelectors,
					function () {
						cursorHolder.removeClass( 'qodef--view' );
						qodefCustomCursor.resetSize( cursor );
					}
				);

				var viewLightSelectors = '.qodef-portfolio-list.qodef-multiple-rows .qodef-e-post-link, .qodef-portfolio-list:not(.qodef-view-cursor--disabled) article .qodef-e-media-image a, .qodef-woo-product-inner > a, .qodef-frame-slider-holder .swiper-slide  > a,  .qodef-woo-product-category-list.qodef-item-layout--info-on-image .qodef-e a';

				$( document ).on(
					'mouseover',
					viewLightSelectors,
					function () {
						cursorHolder.removeClass( 'qodef--hovering' );
						cursorHolder.addClass( 'qodef--view qodef--view-light' );
						qodefCustomCursor.resetSize( cursor );
						qodefCustomCursor.viewCursor( cursor );
					}
				);
				$( document ).on(
					'mouseleave',
					viewLightSelectors,
					function () {
						cursorHolder.removeClass( 'qodef--view qodef--view-light' );
						qodefCustomCursor.resetSize( cursor );
					}
				);

				var readSelectors = '.qodef-blog.qodef-item-layout--classic .qodef-e-media-image>a';

				$( document ).on(
					'mouseover',
					readSelectors,
					function () {
						cursorHolder.removeClass( 'qodef--hovering' );
						cursorHolder.addClass( 'qodef--read qodef--view qodef--view-light' );
						qodefCustomCursor.resetSize( cursor );
						qodefCustomCursor.viewCursor( cursor );
					}
				);
				$( document ).on(
					'mouseleave',
					readSelectors,
					function () {
						cursorHolder.removeClass( 'qodef--read qodef--view qodef--view-light' );
						qodefCustomCursor.resetSize( cursor );
					}
				);
			}
		},
		resetSize: function ( $cursor ) {
			gsap.to(
				$cursor,
				{
					width: 12,
					height: 12,
					left: 0,
					top: 0,
					delay: 0,
					duration: .35,
					ease: 'power2.out',
				}
			);
		},
		linkCursor: function ( $cursor ) {
			gsap.to(
				$cursor,
				{
					width: 24,
					height: 24,
					left: -6,
					top: -6,
					duration: .35,
					delay: 0,
					ease: 'power2.out',
				}
			);
		},
		viewCursor: function ( $cursor ) {
			gsap.to(
				$cursor,
				{
					width: 112,
					height: 112,
					left: -50,
					top: -50,
					duration: .35,
					delay: 0,
					ease: 'power2.out',
				}
			);
		},
	};

	qodefCore.qodefCustomCursor = qodefCustomCursor;

})( jQuery );

(function ( $ ) {
	'use strict';

	$( window ).on(
		'load',
		function () {
			qodefUncoverFooter.init();
		}
	);

	var qodefUncoverFooter = {
		holder: '',
		init: function () {
			this.holder = $( '#qodef-page-footer.qodef--uncover' );

			if ( this.holder.length && ! qodefCore.html.hasClass( 'touchevents' ) ) {
				qodefUncoverFooter.addClass();
				qodefUncoverFooter.setHeight( this.holder );

				$( window ).resize(
					function () {
						qodefUncoverFooter.setHeight( qodefUncoverFooter.holder );
					}
				);
			}
		},
		setHeight: function ( $holder ) {
			$holder.css( 'height', 'auto' );

			var footerHeight = $holder.outerHeight();

			if ( footerHeight > 0 ) {
				$( '#qodef-page-outer' ).css(
					{
						'margin-bottom': footerHeight,
						'background-color': qodefCore.body.css( 'backgroundColor' )
					}
				);

				$holder.css( 'height', footerHeight );
			}
		},
		addClass: function () {
			qodefCore.body.addClass( 'qodef-page-footer--uncover' );
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefFullscreenMenu.init();
		}
	);

	$( window ).on(
		'resize',
		function () {
			qodefFullscreenMenu.handleHeaderWidth( 'resize' );
		}
	);

	var qodefFullscreenMenu = {
		init: function () {
			var $fullscreenMenuOpener = $( 'a.qodef-fullscreen-menu-opener' ),
				$menuItems            = $( '#qodef-fullscreen-area nav ul li a' );

			if ( $fullscreenMenuOpener.length ) {
				// prevent header changing width when fullscreen menu is open
				qodefFullscreenMenu.handleHeaderWidth( 'init' );

				// open popup menu
				$fullscreenMenuOpener.on(
					'click',
					function ( e ) {
						e.preventDefault();
						var $thisOpener = $( this );

						if ( ! qodefCore.body.hasClass( 'qodef-fullscreen-menu--opened' ) ) {
							qodefFullscreenMenu.openFullscreen( $thisOpener );

							$( document ).keyup(
								function ( e ) {
									if ( e.keyCode === 27 ) {
										qodefFullscreenMenu.closeFullscreen( $thisOpener );
									}
								}
							);
						} else {
							qodefFullscreenMenu.closeFullscreen( $thisOpener );
						}
					}
				);

				// open dropdowns
				$menuItems.on(
					'tap click',
					function ( e ) {
						var $thisItem = $( this );

						if ( $thisItem.parent().hasClass( 'menu-item-has-children' ) ) {
							e.preventDefault();
							qodefFullscreenMenu.clickItemWithChild( $thisItem );
						} else if ( $thisItem.attr( 'href' ) !== 'http://#' && $thisItem.attr( 'href' ) !== '#' ) {
							qodefFullscreenMenu.closeFullscreen( $fullscreenMenuOpener );
						}
					}
				);
			}
		},
		openFullscreen: function ( $opener ) {
			$opener.addClass( 'qodef--opened' );
			qodefCore.body.removeClass( 'qodef-fullscreen-menu-animate--out' ).addClass( 'qodef-fullscreen-menu--opened qodef-fullscreen-menu-animate--in' );
			qodefCore.qodefScroll.disable();
		},
		closeFullscreen: function ( $opener ) {
			$opener.removeClass( 'qodef--opened' );
			qodefCore.body.removeClass( 'qodef-fullscreen-menu--opened qodef-fullscreen-menu-animate--in' ).addClass( 'qodef-fullscreen-menu-animate--out' );
			qodefCore.qodefScroll.enable();
			$( 'nav.qodef-fullscreen-menu ul.sub_menu' ).slideUp( 200 );
		},
		clickItemWithChild: function ( thisItem ) {
			var $thisItemParent  = thisItem.parent(),
				$thisItemSubMenu = $thisItemParent.find( '.sub-menu' ).first();

			if ( $thisItemSubMenu.is( ':visible' ) ) {
				$thisItemSubMenu.slideUp( 300 );
				$thisItemParent.removeClass( 'qodef--opened' );
			} else {
				$thisItemSubMenu.slideDown( 300 );
				$thisItemParent.addClass( 'qodef--opened' ).siblings().find( '.sub-menu' ).slideUp( 400 );
			}
		},
		handleHeaderWidth: function ( state ) {
			var $header               = $( '#qodef-page-header' );
			var $fullscreenMenuOpener = $( 'a.qodef-fullscreen-menu-opener' );

			if ( $header.length && $fullscreenMenuOpener.length ) {
				// if desktop device
				if ( qodefCore.windowWidth > 1024 ) {
					// if page height is greater then window height, scroll bar is visible
					if ( qodefCore.body.height() > qodefCore.windowHeight ) {
						// on resize reset previously set inline width
						if ( 'resize' === state ) {
							$header.css( { 'width': '' } );
						}
						$header.width( $header.width() );
					}
				} else {
					// reset previously set inline width
					$header.css( { 'width': '' } );
				}
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefHeaderScrollAppearance.init();
		}
	);

	var qodefHeaderScrollAppearance = {
		appearanceType: function () {
			return qodefCore.body.attr( 'class' ).indexOf( 'qodef-header-appearance--' ) !== -1 ? qodefCore.body.attr( 'class' ).match( /qodef-header-appearance--([\w]+)/ )[1] : '';
		},
		init: function () {
			var appearanceType = this.appearanceType();

			if ( appearanceType !== '' && appearanceType !== 'none' ) {
				qodefCore[appearanceType + 'HeaderAppearance']();
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
	    function () {
            qodefMobileHeaderAppearance.init();
        }
	);

	/*
	 **	Init mobile header functionality
	 */
	var qodefMobileHeaderAppearance = {
		init: function () {
			if ( qodefCore.body.hasClass( 'qodef-mobile-header-appearance--sticky' ) ) {

				var docYScroll1   = qodefCore.scroll,
					displayAmount = qodefGlobal.vars.mobileHeaderHeight + qodefGlobal.vars.adminBarHeight,
					$pageOuter    = $( '#qodef-page-outer' );

				qodefMobileHeaderAppearance.showHideMobileHeader( docYScroll1, displayAmount, $pageOuter );

				$( window ).scroll(
				    function () {
                        qodefMobileHeaderAppearance.showHideMobileHeader( docYScroll1, displayAmount, $pageOuter );
                        docYScroll1 = qodefCore.scroll;
                    }
				);

				$( window ).resize(
				    function () {
                        $pageOuter.css( 'padding-top', 0 );
                        qodefMobileHeaderAppearance.showHideMobileHeader( docYScroll1, displayAmount, $pageOuter );
                    }
				);
			}
		},
		showHideMobileHeader: function ( docYScroll1, displayAmount, $pageOuter ) {
			if ( qodefCore.windowWidth <= 1024 ) {
				if ( qodefCore.scroll > displayAmount * 2 ) {
					//set header to be fixed
					qodefCore.body.addClass( 'qodef-mobile-header--sticky' );

					//add transition to it
					setTimeout(
						function () {
							qodefCore.body.addClass( 'qodef-mobile-header--sticky-animation' );
						},
						300
					); //300 is duration of sticky header animation

					//add padding to content so there is no 'jumping'
					$pageOuter.css( 'padding-top', qodefGlobal.vars.mobileHeaderHeight );
				} else {
					//unset fixed header
					qodefCore.body.removeClass( 'qodef-mobile-header--sticky' );

					//remove transition
					setTimeout(
						function () {
							qodefCore.body.removeClass( 'qodef-mobile-header--sticky-animation' );
						},
						300
					); //300 is duration of sticky header animation

					//remove padding from content since header is not fixed anymore
					$pageOuter.css( 'padding-top', 0 );
				}

				if ( (qodefCore.scroll > docYScroll1 && qodefCore.scroll > displayAmount) || (qodefCore.scroll < displayAmount * 3) ) {
					//show sticky header
					qodefCore.body.removeClass( 'qodef-mobile-header--sticky-display' );
				} else {
					//hide sticky header
					qodefCore.body.addClass( 'qodef-mobile-header--sticky-display' );
				}
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefNavMenu.init();
		}
	);

	var qodefNavMenu = {
		init: function () {
			qodefNavMenu.dropdownBehavior();
			qodefNavMenu.wideDropdownPosition();
			qodefNavMenu.dropdownPosition();
		},
		dropdownBehavior: function () {
			var $menuItems = $( '.qodef-header-navigation > ul > li' );

			$menuItems.each(
				function () {
					var $thisItem = $( this );

					if ( $thisItem.find( '.qodef-drop-down-second' ).length ) {
						qodef.qodefWaitForImages.check(
							$thisItem,
							function () {
								var $dropdownHolder      = $thisItem.find( '.qodef-drop-down-second' ),
									$dropdownMenuItem    = $dropdownHolder.find( '.qodef-drop-down-second-inner ul' ),
									dropDownHolderHeight = $dropdownMenuItem.outerHeight();

								if ( navigator.userAgent.match( /(iPod|iPhone|iPad)/ ) ) {
									$thisItem.on(
										'touchstart mouseenter',
										function () {
											$dropdownHolder.css(
												{
													'height': dropDownHolderHeight,
													'overflow': 'visible',
													'visibility': 'visible',
													'opacity': '1',
												}
											);
										}
									).on(
										'mouseleave',
										function () {
											$dropdownHolder.css(
												{
													'height': '0px',
													'overflow': 'hidden',
													'visibility': 'hidden',
													'opacity': '0',
												}
											);
										}
									);
								} else {
									if ( qodefCore.body.hasClass( 'qodef-drop-down-second--animate-height' ) ) {
										var animateConfig = {
											interval: 0,
											over: function () {
												setTimeout(
													function () {
														$dropdownHolder.addClass( 'qodef-drop-down--start' ).css(
															{
																'visibility': 'visible',
																'height': '0',
																'opacity': '1',
															}
														);
														$dropdownHolder.stop().animate(
															{
																'height': dropDownHolderHeight,
															},
															400,
															'linear',
															function () {
																$dropdownHolder.css( 'overflow', 'visible' );
															}
														);
													},
													100
												);
											},
											timeout: 100,
											out: function () {
												$dropdownHolder.stop().animate(
													{
														'height': '0',
														'opacity': 0,
													},
													100,
													function () {
														$dropdownHolder.css(
															{
																'overflow': 'hidden',
																'visibility': 'hidden',
															}
														);
													}
												);

												$dropdownHolder.removeClass( 'qodef-drop-down--start' );
											}
										};

										$thisItem.hoverIntent( animateConfig );
									} else {
										var config = {
											interval: 0,
											over: function () {
												setTimeout(
													function () {
														$dropdownHolder.addClass( 'qodef-drop-down--start' ).stop().css( { 'height': dropDownHolderHeight } );
													},
													150
												);
											},
											timeout: 150,
											out: function () {
												$dropdownHolder.stop().css( { 'height': '0' } ).removeClass( 'qodef-drop-down--start' );
											}
										};

										$thisItem.hoverIntent( config );
									}
								}
							}
						);
					}
				}
			);
		},
		wideDropdownPosition: function () {
			var $menuItems = $( '.qodef-header-navigation > ul > li.qodef-menu-item--wide' );

			if ( $menuItems.length ) {
				$menuItems.each(
					function () {
						var $menuItem        = $( this );
						var $menuItemSubMenu = $menuItem.find( '.qodef-drop-down-second' );

						if ( $menuItemSubMenu.length ) {
							$menuItemSubMenu.css( 'left', 0 );

							var leftPosition = $menuItemSubMenu.offset().left;

							if ( qodefCore.body.hasClass( 'qodef--boxed' ) ) {
								//boxed layout case
								var boxedWidth = $( '.qodef--boxed #qodef-page-wrapper' ).outerWidth();
								leftPosition   = leftPosition - (qodefCore.windowWidth - boxedWidth) / 2;
								$menuItemSubMenu.css( { 'left': -leftPosition, 'width': boxedWidth } );

							} else if ( qodefCore.body.hasClass( 'qodef-drop-down-second--full-width' ) ) {
								//wide dropdown full width case
								$menuItemSubMenu.css( { 'left': -leftPosition, 'width': qodefCore.windowWidth } );
							} else {
								//wide dropdown in grid case
								$menuItemSubMenu.css( { 'left': -leftPosition + (qodefCore.windowWidth - $menuItemSubMenu.width()) / 2 } );
							}
						}
					}
				);
			}
		},
		dropdownPosition: function () {
			var $menuItems = $( '.qodef-header-navigation > ul > li.qodef-menu-item--narrow.menu-item-has-children' );

			if ( $menuItems.length ) {
				$menuItems.each(
					function () {
						var $thisItem         = $( this ),
							menuItemPosition  = $thisItem.offset().left,
							$dropdownHolder   = $thisItem.find( '.qodef-drop-down-second' ),
							$dropdownMenuItem = $dropdownHolder.find( '.qodef-drop-down-second-inner ul' ),
							dropdownMenuWidth = $dropdownMenuItem.outerWidth(),
							menuItemFromLeft  = $( window ).width() - menuItemPosition;

						if ( qodef.body.hasClass( 'qodef--boxed' ) ) {
							//boxed layout case
							var boxedWidth   = $( '.qodef--boxed #qodef-page-wrapper' ).outerWidth();
							menuItemFromLeft = boxedWidth - menuItemPosition;
						}

						var dropDownMenuFromLeft;

						if ( $thisItem.find( 'li.menu-item-has-children' ).length > 0 ) {
							dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
						}

						$dropdownHolder.removeClass( 'qodef-drop-down--right' );
						$dropdownMenuItem.removeClass( 'qodef-drop-down--right' );
						if ( menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth ) {
							$dropdownHolder.addClass( 'qodef-drop-down--right' );
							$dropdownMenuItem.addClass( 'qodef-drop-down--right' );
						}
					}
				);
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( window ).on(
		'load',
		function () {
			qodefParallaxBackground.init();
		}
	);

	/**
	 * Init global parallax background functionality
	 */
	var qodefParallaxBackground = {
		init: function ( settings ) {
			this.$sections = $( '.qodef-parallax' );

			// Allow overriding the default config
			$.extend( this.$sections, settings );

			var isSupported = ! qodefCore.html.hasClass( 'touchevents' ) && ! qodefCore.body.hasClass( 'qodef-browser--edge' ) && ! qodefCore.body.hasClass( 'qodef-browser--ms-explorer' );

			if ( this.$sections.length && isSupported ) {
				this.$sections.each(
					function () {
						qodefParallaxBackground.ready( $( this ) );
					}
				);
			}
		},
		ready: function ( $section ) {
			$section.$imgHolder  = $section.find( '.qodef-parallax-img-holder' );
			$section.$imgWrapper = $section.find( '.qodef-parallax-img-wrapper' );
			$section.$img        = $section.find( 'img.qodef-parallax-img' );

			var h           = $section.height(),
				imgWrapperH = $section.$imgWrapper.height();

			$section.movement = 100 * (imgWrapperH - h) / h / 2; //percentage (divided by 2 due to absolute img centering in CSS)

			$section.buffer       = window.pageYOffset;
			$section.scrollBuffer = null;


			//calc and init loop
			requestAnimationFrame(
				function () {
					$section.$imgHolder.animate( { opacity: 1 }, 100 );
					qodefParallaxBackground.calc( $section );
					qodefParallaxBackground.loop( $section );
				}
			);

			//recalc
			$( window ).on(
				'resize',
				function () {
					qodefParallaxBackground.calc( $section );
				}
			);
		},
		calc: function ( $section ) {
			var wH = $section.$imgWrapper.height(),
				wW = $section.$imgWrapper.width();

			if ( $section.$img.width() < wW ) {
				$section.$img.css(
					{
						'width': '100%',
						'height': 'auto',
					}
				);
			}

			if ( $section.$img.height() < wH ) {
				$section.$img.css(
					{
						'height': '100%',
						'width': 'auto',
						'max-width': 'unset',
					}
				);
			}
		},
		loop: function ( $section ) {
			if ( $section.scrollBuffer === Math.round( window.pageYOffset ) ) {
				requestAnimationFrame(
					function () {
						qodefParallaxBackground.loop( $section );
					}
				); //repeat loop

				return false; //same scroll value, do nothing
			} else {
				$section.scrollBuffer = Math.round( window.pageYOffset );
			}

			var wH   = window.outerHeight,
				sTop = $section.offset().top,
				sH   = $section.height();

			if ( $section.scrollBuffer + wH * 1.2 > sTop && $section.scrollBuffer < sTop + sH ) {
				var delta = (Math.abs( $section.scrollBuffer + wH - sTop ) / (wH + sH)).toFixed( 4 ), //coeff between 0 and 1 based on scroll amount
					yVal  = (delta * $section.movement).toFixed( 4 );

				if ( $section.buffer !== delta ) {
					$section.$imgWrapper.css( 'transform', 'translate3d(0,' + yVal + '%, 0)' );
				}

				$section.buffer = delta;
			}

			requestAnimationFrame(
				function () {
					qodefParallaxBackground.loop( $section );
				}
			); //repeat loop
		}
	};

	qodefCore.qodefParallaxBackground = qodefParallaxBackground;

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefReview.init();
		}
	);

	var qodefReview = {
		init: function () {
			var ratingHolder = $( '#qodef-page-comments-form .qodef-rating-inner' );

			var addActive = function ( stars, ratingValue ) {
				for ( var i = 0; i < stars.length; i++ ) {
					var star = stars[i];

					if ( i < ratingValue ) {
						$( star ).addClass( 'active' );
					} else {
						$( star ).removeClass( 'active' );
					}
				}
			};

			ratingHolder.each(
				function () {
					var thisHolder  = $( this ),
						ratingInput = thisHolder.find( '.qodef-rating' ),
						ratingValue = ratingInput.val(),
						stars       = thisHolder.find( '.qodef-star-rating' );

					addActive( stars, ratingValue );

					stars.on(
						'click',
						function () {
							ratingInput.val( $( this ).data( 'value' ) ).trigger( 'change' );
						}
					);

					ratingInput.change(
						function () {
							ratingValue = ratingInput.val();

							addActive( stars, ratingValue );
						}
					);
				}
			);
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefSideArea.init();
		}
	);

	var qodefSideArea = {
		init: function () {
			var $sideAreaOpener = $( 'a.qodef-side-area-opener' ),
				$sideAreaClose  = $( '#qodef-side-area-close' ),
				$sideArea       = $( '#qodef-side-area' );

			qodefSideArea.openerHoverColor( $sideAreaOpener );

			// Open Side Area
			$sideAreaOpener.on(
				'click',
				function ( e ) {
					e.preventDefault();

					if ( ! qodefCore.body.hasClass( 'qodef-side-area--opened' ) ) {
						qodefSideArea.openSideArea();

						$( document ).keyup(
							function ( e ) {
								if ( e.keyCode === 27 ) {
									qodefSideArea.closeSideArea();
								}
							}
						);
					} else {
						qodefSideArea.closeSideArea();
					}
				}
			);

			$sideAreaClose.on(
				'click',
				function ( e ) {
					e.preventDefault();
					qodefSideArea.closeSideArea();
				}
			);

			if ( $sideArea.length && typeof qodefCore.qodefPerfectScrollbar === 'object' ) {
				qodefCore.qodefPerfectScrollbar.init( $sideArea );
			}
		},
		openSideArea: function () {
			var $wrapper      = $( '#qodef-page-wrapper' );
			var currentScroll = $( window ).scrollTop();

			$( '.qodef-side-area-cover' ).remove();
			$wrapper.prepend( '<div class="qodef-side-area-cover"/>' );
			qodefCore.body.removeClass( 'qodef-side-area-animate--out' ).addClass( 'qodef-side-area--opened qodef-side-area-animate--in' );

			$( '.qodef-side-area-cover' ).on(
				'click',
				function ( e ) {
					e.preventDefault();
					qodefSideArea.closeSideArea();
				}
			);

			$( window ).scroll(
				function () {
					if ( Math.abs( qodefCore.scroll - currentScroll ) > 400 ) {
						qodefSideArea.closeSideArea();
					}
				}
			);
		},
		closeSideArea: function () {
			qodefCore.body.removeClass( 'qodef-side-area--opened qodef-side-area-animate--in' ).addClass( 'qodef-side-area-animate--out' );
		},
		openerHoverColor: function ( $opener ) {
			if ( typeof $opener.data( 'hover-color' ) !== 'undefined' ) {
				var hoverColor    = $opener.data( 'hover-color' );
				var originalColor = $opener.css( 'color' );

				$opener.on(
					'mouseenter',
					function () {
						$opener.css( 'color', hoverColor );
					}
				).on(
					'mouseleave',
					function () {
						$opener.css( 'color', originalColor );
					}
				);
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function() {
			qodefSpinner.init();
		}
	);

	$( window ).on(
		'load',
		function () {
			qodefSpinner.windowLoaded = true;

			if (document.visibilityState === 'visible') {
				qodefSpinner.fadeOutLoader();
			} else {
				document.addEventListener("visibilitychange", function() {
					if (document.visibilityState === 'visible') {
						qodefSpinner.fadeOutLoader();
					}
				});
			}
		}
	);

	$( window ).on(
		'elementor/frontend/init',
		function () {
			var isEditMode = Boolean( elementorFrontend.isEditMode() );

			if ( isEditMode ) {
				qodefSpinner.init( isEditMode );
			}
		}
	);

	var qodefSpinner = {
		holder: '',
		windowLoaded: false,
		init: function ( isEditMode ) {
			this.holder = $( '#qodef-page-spinner:not(.qodef--custom-spinner):not(.qodef-layout--textual):not(.qodef-layout--predefined)' );

			if ( this.holder.length ) {
				qodefSpinner.animateSpinner( isEditMode );
				qodefSpinner.fadeOutAnimation();
			}
		},
		animateSpinner: function ( isEditMode ) {

			if ( isEditMode ) {
				qodefSpinner.fadeOutLoader();
			}
		},
		fadeOutLoader: function ( speed, delay, easing ) {
			var $holder = qodefSpinner.holder.length ? qodefSpinner.holder : $( '#qodef-page-spinner:not(.qodef--custom-spinner):not(.qodef-layout--textual):not(.qodef-layout--predefined)' );

			speed  = speed ? speed : 600;
			delay  = delay ? delay : 0;
			easing = easing ? easing : 'swing';

			$holder.delay( delay ).fadeOut( speed, easing );

			$( window ).on(
				'bind',
				'pageshow',
				function ( event ) {
					if ( event.originalEvent.persisted ) {
						$holder.fadeOut( speed, easing );
					}
				}
			);
		},
		fadeOutAnimation: function () {

			// Check for fade out animation
			if ( qodefCore.body.hasClass( 'qodef-spinner--fade-out' ) ) {
				var $pageHolder = $( '#qodef-page-wrapper' ),
					$linkItems  = $( 'a' );

				// If back button is pressed, than show content to avoid state where content is on display:none
				window.addEventListener(
					'pageshow',
					function ( event ) {
						var historyPath = event.persisted || (typeof window.performance !== 'undefined' && window.performance.navigation.type === 2);
						if ( historyPath && ! $pageHolder.is( ':visible' ) ) {
							$pageHolder.show();
						}
					}
				);

				$linkItems.on(
					'click',
					function ( e ) {
						var $clickedLink = $( this );

						if (
							e.which === 1 && // check if the left mouse button has been pressed
							$clickedLink.attr( 'href' ).indexOf( window.location.host ) >= 0 && // check if the link is to the same domain
							! $clickedLink.hasClass( 'remove' ) && // check is WooCommerce remove link
							$clickedLink.parent( '.product-remove' ).length <= 0 && // check is WooCommerce remove link
							$clickedLink.parents( '.woocommerce-product-gallery__image' ).length <= 0 && // check is product gallery link
							typeof $clickedLink.data( 'rel' ) === 'undefined' && // check pretty photo link
							typeof $clickedLink.attr( 'rel' ) === 'undefined' && // check VC pretty photo link
							! $clickedLink.hasClass( 'lightbox-active' ) && // check is lightbox plugin active
							(typeof $clickedLink.attr( 'target' ) === 'undefined' || $clickedLink.attr( 'target' ) === '_self') && // check if the link opens in the same window
							$clickedLink.attr( 'href' ).split( '#' )[0] !== window.location.href.split( '#' )[0] // check if it is an anchor aiming for a different page
						) {
							e.preventDefault();

							$pageHolder.fadeOut(
								600,
								'easeOutSine',
								function () {
									window.location = $clickedLink.attr( 'href' );
								}
							);
						}
					}
				);
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.obsius_core_accordion = {};

	$( document ).ready(
		function () {
			qodefAccordion.init();
		}
	);

	var qodefAccordion = {
		init: function () {
			var $holder = $( '.qodef-accordion' );

			if ( $holder.length ) {
				$holder.each(
					function () {
						var $thisAccordion = $( this );

						qodefAccordion.initItem( $thisAccordion );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			if ( $currentItem.hasClass( 'qodef-behavior--accordion' ) ) {
				qodefAccordion.initAccordion( $currentItem );
			}

			if ( $currentItem.hasClass( 'qodef-behavior--numbered-accordion' ) ) {
				qodefAccordion.initNumberedAccordion( $currentItem );
				qodefAccordion.calcNumberedAccordion( $currentItem ); // must be after init
			}

			if ( $currentItem.hasClass( 'qodef-behavior--toggle' ) ) {
				qodefAccordion.initToggle( $currentItem );
			}

			$currentItem.addClass( 'qodef--init' );
		},
		initAccordion: function ( $accordion ) {
			$accordion.accordion(
				{
					animate: 'swing',
					collapsible: true,
					active: 0,
					icons: '',
					heightStyle: 'content',
				}
			);
		},
		initNumberedAccordion: function ( $accordion ) {
			var $titles = $accordion.find( '.qodef-accordion-title' );

			if ( $titles.length ) {
				$titles.each(
					function (index) {
						index++;
						$( this ).prepend('<span class="qodef-tab-count">' + 0 + index + '</span>');
					}
				);
			}

			$accordion.accordion(
				{
					animate: 'swing',
					collapsible: true,
					active: 0,
					icons: '',
					heightStyle: 'content',
				}
			);
		},
		calcNumberedAccordion: function ( $accordion ) {
			var $accordionCounts = $accordion.find( '.qodef-accordion-title .qodef-tab-count' );
			$accordionCounts.css({'maxHeight': ''}); // remove values because of window resize

			var $accordionTitle 	  	       = $accordion.find( '.qodef-accordion-title' );
			var $accordionTitleActive 	 	   = $accordion.find( '.qodef-accordion-title.ui-state-active' );
			var $accordionTitleTabActiveHeight = $accordionTitleActive.find( '.qodef-tab-title' ).outerHeight();
			var $accordionContentActive 	   = $accordionTitleActive.find( '.qodef-accordion-content' );
			var $accordionActiveCount 	 	   = $accordionTitleActive.find( '.qodef-tab-count' );
			var $count 	 	  		  	 	   = $accordion.find( '.qodef-accordion-title .qodef-tab-count' );
			var $countHeight 	 	  	 	   = $count.outerHeight();
			var $countHeightReduced   	 	   = $countHeight * 0.5482; // ~ 280px on 1920px screen

			/* initial heights */
			$count.css( { 'maxHeight': $countHeightReduced } );
			$accordionActiveCount.css( { 'maxHeight': $countHeight } );
			$accordionContentActive.css( { 'top': ( $accordionTitleTabActiveHeight + 70 + 6 ) } ); // 70 is top position 6 is spacing adjustment
			$accordionContentActive.addClass( 'ui-accordion-content-active' );

			$accordionTitle.on(
				'click',
				function ( e ) {
					e.preventDefault();
					e.stopImmediatePropagation();

					var $accordionContentInactive = $accordion.find( '.qodef-accordion-title:not(.ui-state-active) .qodef-accordion-content' );
					var $accordionCountInactive   = $accordion.find( '.qodef-accordion-title:not(.ui-state-active) .qodef-tab-count' );
					$accordionCountInactive.css( { 'maxHeight': $countHeightReduced } );

					var $thisTitle = $( this );

					if ( $thisTitle.hasClass( 'ui-state-active' ) ) {
						var thisCountActive = $thisTitle.find( '.qodef-tab-count' );
						thisCountActive.css( { 'maxHeight': $countHeight } );

						var thisAccordionContentActive 		  = $thisTitle.find( '.qodef-accordion-content' );
						var thisAccordionTitleTabActiveHeight = $accordionTitleActive.find( '.qodef-tab-title' ).outerHeight();

						thisAccordionContentActive.css( { 'top': ( thisAccordionTitleTabActiveHeight + 70 + 6 ) } ); // 70 is top position 6 is spacing adjustment

						var thisContentActive = $thisTitle.find( '.qodef-accordion-content' );
						thisContentActive.addClass( 'ui-accordion-content-active' );
					}

					$accordionContentInactive.removeClass( 'ui-accordion-content-active' );
				}
			);
		},
		initToggle: function ( $toggle ) {
			var $toggleAccordionTitle = $toggle.find( '.qodef-accordion-title' );

			$toggleAccordionTitle.off().on(
				'mouseenter',
				function () {
					$( this ).addClass( 'ui-state-hover' );
				}
			).on(
				'mouseleave',
				function () {
					$( this ).removeClass( 'ui-state-hover' );
				}
			).on(
				'click',
				function ( e ) {
					e.preventDefault();
					e.stopImmediatePropagation();

					var $thisTitle = $( this );

					if ( $thisTitle.hasClass( 'ui-state-active' ) ) {
						$thisTitle.removeClass( 'ui-state-active' );
						$thisTitle.next().removeClass( 'ui-accordion-content-active' ).slideUp( 700 );
					} else {
						$thisTitle.addClass( 'ui-state-active' );
						$thisTitle.next().addClass( 'ui-accordion-content-active' ).slideDown( 800 );
					}
				}
			);
		}
	};

	qodefCore.shortcodes.obsius_core_accordion.qodefAccordion = qodefAccordion;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.obsius_core_background_highlight_text = {};

	$( document ).ready(
		function () {
			qodefHighlight.init();
		}
	);

	var qodefHighlight = {
		init: function () {
			this.holder = $( '.qodef-background-highlight-text .qodef-highlight-text' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefHighlight.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			var $svgPath              = $currentItem.find( '.qodef-svg--rounding path' );

			gsap.registerPlugin(ScrollTrigger);
			gsap.registerPlugin(DrawSVGPlugin);

			if ( $svgPath.length ) {
				gsap.fromTo(
					$svgPath[0], //[0] is for passing as pure js
					{
						drawSVG: "0%",
					},
					{
						scrollTrigger: {
							trigger: $svgPath[0],
							start: '100% bottom',
							toggleActions: 'play none none none',
						},
						drawSVG: "100%",
						delay: 0.3,
						duration: 0.7,
						ease: Power2.easeInOut,
					}
				);
			}
		},
	};

	qodefCore.shortcodes.obsius_core_background_highlight_text.qodefHighlight = qodefHighlight;
	qodefCore.shortcodes.obsius_core_background_highlight_text.qodefBlobItem = qodefCore.qodefBlobItem;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.obsius_core_button = {};

	$( document ).ready(
		function () {
			qodefButton.init();
		}
	);

	var qodefButton = {
		init: function () {
			this.buttons = $( '.qodef-button' );

			if ( this.buttons.length ) {
				this.buttons.each(
					function () {
						qodefButton.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			qodefButton.buttonHoverColor( $currentItem );
			qodefButton.buttonHoverBgColor( $currentItem );
			qodefButton.buttonHoverBorderColor( $currentItem );
		},
		buttonHoverColor: function ( $button ) {
			if ( typeof $button.data( 'hover-color' ) !== 'undefined' ) {
				var hoverColor    = $button.data( 'hover-color' );
				var originalColor = $button.css( 'color' );

				$button.on(
					'mouseenter touchstart',
					function () {
						qodefButton.changeColor( $button, 'color', hoverColor );
					}
				);
				$button.on(
					'mouseleave touchend',
					function () {
						qodefButton.changeColor( $button, 'color', originalColor );
					}
				);
			}
		},
		buttonHoverBgColor: function ( $button ) {
			if ( typeof $button.data( 'hover-background-color' ) !== 'undefined' ) {
				var hoverBackgroundColor    = $button.data( 'hover-background-color' );
				var originalBackgroundColor = $button.css( 'background-color' );

				$button.on(
					'mouseenter touchstart',
					function () {
						qodefButton.changeColor( $button, 'background-color', hoverBackgroundColor );
					}
				);
				$button.on(
					'mouseleave touchend',
					function () {
						qodefButton.changeColor( $button, 'background-color', originalBackgroundColor );
					}
				);
			}
		},
		buttonHoverBorderColor: function ( $button ) {
			if ( typeof $button.data( 'hover-border-color' ) !== 'undefined' ) {
				var hoverBorderColor    = $button.data( 'hover-border-color' );
				var originalBorderColor = $button.css( 'borderTopColor' );

				$button.on(
					'mouseenter touchstart',
					function () {
						qodefButton.changeColor( $button, 'border-color', hoverBorderColor );
					}
				);
				$button.on(
					'mouseleave touchend',
					function () {
						qodefButton.changeColor( $button, 'border-color', originalBorderColor );
					}
				);
			}
		},
		changeColor: function ( $button, cssProperty, color ) {
			$button.css( cssProperty, color );
		}
	};

	qodefCore.shortcodes.obsius_core_button.qodefButton = qodefButton;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.obsius_core_countdown = {};

	$( document ).ready(
		function () {
			qodefCountdown.init();
		}
	);

	var qodefCountdown = {
		init: function () {
			this.countdowns = $( '.qodef-countdown' );

			if ( this.countdowns.length ) {
				this.countdowns.each(
					function () {
						qodefCountdown.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			var $countdownElement = $currentItem.find( '.qodef-m-date' ),
				dateFormats       = ['week', 'day', 'hour', 'minute', 'second'],
				options           = qodefCountdown.generateOptions( $currentItem, dateFormats );

			qodefCountdown.initCountdown( $countdownElement, options, dateFormats );
		},
		generateOptions: function ( $countdown, dateFormats ) {
			var options = {};

			options.date = typeof $countdown.data( 'date' ) !== 'undefined' ? $countdown.data( 'date' ) : null;

			for ( var i = 0; i < dateFormats.length; i++ ) {
				var label       = dateFormats[i] + 'Label',
					labelPlural = dateFormats[i] + 'LabelPlural';

				options[label]       = typeof $countdown.data( dateFormats[i] + '-label' ) !== 'undefined' ? $countdown.data( dateFormats[i] + '-label' ) : '';
				options[labelPlural] = typeof $countdown.data( dateFormats[i] + '-label-plural' ) !== 'undefined' ? $countdown.data( dateFormats[i] + '-label-plural' ) : '';
			}

			return options;
		},
		initCountdown: function ( $countdownElement, options, dateFormats ) {
			var countDownDate = new Date( options.date ).getTime();

			// Update the count down every 1 second
			var x = setInterval(
				function () {

					// Get today's date and time
					var now = new Date().getTime();

					// Find the distance between now and the count down date
					var distance = countDownDate - now;

					// Time calculations for days, hours, minutes and seconds
					this.weeks   = Math.floor( distance / (1000 * 60 * 60 * 24 * 7) );
					this.days    = Math.floor( (distance % (1000 * 60 * 60 * 24 * 7)) / (1000 * 60 * 60 * 24) );
					this.hours   = Math.floor( (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60) );
					this.minutes = Math.floor( (distance % (1000 * 60 * 60)) / (1000 * 60) );
					this.seconds = Math.floor( (distance % (1000 * 60)) / 1000 );

					for ( var i = 0; i < dateFormats.length; i++ ) {
						var dateName = dateFormats[i] + 's';
						qodefCountdown.initiateDate( $countdownElement, this[dateName], dateFormats[i], options );
					}

					// If the count down is finished, write some text
					if ( distance < 0 ) {
						clearInterval( x );
						qodefCountdown.afterClearInterval( $countdownElement, dateFormats, options );
					}
				},
				1000
			);
		},
		initiateDate: function ( $countdownElement, date, dateFormat, options ) {
			var $holder = $countdownElement.find( '.qodef-' + dateFormat + 's' );

			$holder.find( '.qodef-label' ).html( ( 1 === date ) ? options[dateFormat + 'Label'] : options[dateFormat + 'LabelPlural'] );

			date = (date < 10) ? '0' + date : date;

			$holder.find( '.qodef-digit' ).html( date );
		},
		afterClearInterval: function( $countdownElement, dateFormats, options ) {
			for ( var i = 0; i < dateFormats.length; i++ ) {
				var $holder = $countdownElement.find( '.qodef-' + dateFormats[i] + 's' );

				$holder.find( '.qodef-label' ).html( options[dateFormats[i] + 'LabelPlural'] );
				$holder.find( '.qodef-digit' ).html( '00' );
			}
		}
	};

	qodefCore.shortcodes.obsius_core_countdown.qodefCountdown = qodefCountdown;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.obsius_core_counter = {};

	$( document ).ready(
		function () {
			qodefCounter.init();
		}
	);

	var qodefCounter = {
		init: function () {
			this.counters = $( '.qodef-counter' );

			if ( this.counters.length ) {
				this.counters.each(
					function () {
						qodefCounter.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			var $counterElement = $currentItem.find( '.qodef-m-digit' ),
				options         = qodefCounter.generateOptions( $currentItem );

			qodefCore.qodefIsInViewport.check(
				$currentItem,
				function () {
					qodefCounter.counterScript( $counterElement, options );
				},
				false
			);
		},
		generateOptions: function ( $counter ) {
			var options   = {};
			options.start = typeof $counter.data( 'start-digit' ) !== 'undefined' && $counter.data( 'start-digit' ) !== '' ? $counter.data( 'start-digit' ) : 0;
			options.end   = typeof $counter.data( 'end-digit' ) !== 'undefined' && $counter.data( 'end-digit' ) !== '' ? $counter.data( 'end-digit' ) : null;
			options.step  = typeof $counter.data( 'step-digit' ) !== 'undefined' && $counter.data( 'step-digit' ) !== '' ? $counter.data( 'step-digit' ) : 1;
			options.delay = typeof $counter.data( 'step-delay' ) !== 'undefined' && $counter.data( 'step-delay' ) !== '' ? parseInt( $counter.data( 'step-delay' ), 10 ) : 100;
			options.txt   = typeof $counter.data( 'digit-label' ) !== 'undefined' && $counter.data( 'digit-label' ) !== '' ? $counter.data( 'digit-label' ) : '';

			return options;
		},
		counterScript: function ( $counterElement, options ) {
			var defaults = {
				start: 0,
				end: null,
				step: 1,
				delay: 50,
				txt: '',
			};

			var settings = $.extend( defaults, options || {} );
			var nb_start = settings.start;
			var nb_end   = settings.end;

			$counterElement.text( nb_start + settings.txt );

			// Timer
			// Launches every "settings.delay"
			var counterInterval = setInterval(
				function () {
					// Definition of conditions of arrest
					if ( nb_end !== null && nb_start >= nb_end ) {
						return;
					}

					// incrementation
					nb_start = nb_start + settings.step;

					// Check is ended
					if ( nb_start >= nb_end ) {
						nb_start = nb_end;

						clearInterval( counterInterval );
					}

					// display
					$counterElement.text( nb_start + settings.txt );
				},
				settings.delay
			);
		}
	};

	qodefCore.shortcodes.obsius_core_counter.qodefCounter = qodefCounter;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.obsius_core_fixed_indent_slider = {};

	$( document ).ready(
		function () {
			qodefFixedIndentSlider.init();
		}
	);

	var qodefFixedIndentSlider = {
		init: function () {
			this.holder = $( '.qodef-fixed-indent-slider-holder' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefFixedIndentSlider.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $holder ) {
			var sliderOptions     = typeof $holder.data( 'options' ) !== 'undefined' ? $holder.data( 'options' ) : {},
				sliderScroll      = sliderOptions.sliderScroll !== undefined && sliderOptions.sliderScroll !== 'no' ? sliderOptions.sliderScroll : false,
				loop              = sliderOptions.loop !== undefined && sliderOptions.loop !== '' ? sliderOptions.loop : true,
				autoplay          = sliderOptions.autoplay !== undefined && sliderOptions.autoplay !== '' ? sliderOptions.autoplay : true,
				speed             = sliderOptions.speed !== undefined && sliderOptions.speed !== '' ? parseInt( sliderOptions.speed, 10 ) : 5000,
				speedAnimation    = sliderOptions.speedAnimation !== undefined && sliderOptions.speedAnimation !== '' ? parseInt( sliderOptions.speedAnimation, 10 ) : 800,
				slideAnimation    = sliderOptions.slideAnimation !== undefined && sliderOptions.slideAnimation !== '' ? sliderOptions.slideAnimation : '';

			if ( autoplay !== false && speed !== 5000 ) {
				autoplay = {
					delay: speed,
				};
			}

			var $swiperHolder 	  = $holder.find( '.qodef-m-swiper' ),
				$sliderHolder 	  = $holder.find( '.qodef-m-items' ),
				$pagination   	  = $holder.find( '.swiper-pagination' ),
				slidesPerView 	  = 2.1947,
				slidesPerView1440 = 2.1947,
				slidesPerView1368 = 2.1947,
				slidesPerView1366 = 2.1947,
				slidesPerView1280 = 2.1947,
				slidesPerView1024 = 1.476,
				slidesPerView768  = 1.476,
				slidesPerView680  = 1,
				slidesPerView480  = 1;

			var $swiper = new Swiper(
				$swiperHolder,
				{
					slidesPerView: slidesPerView,
					centeredSlides: false,
					spaceBetween: 30,
					autoplay: autoplay,
					loop: loop,
					speed: speedAnimation,
					pagination: {
						el: $pagination,
						type: 'bullets',
						clickable: true,
					},
					breakpoints: {
						// when window width is < 481px
						0: {
							slidesPerView: slidesPerView480
						},
						// when window width is >= 481px
						481: {
							slidesPerView: slidesPerView680
						},
						// when window width is >= 681px
						681: {
							slidesPerView: slidesPerView768
						},
						// when window width is >= 769px
						769: {
							slidesPerView: slidesPerView1024
						},
						// when window width is >= 1025px
						1025: {
							slidesPerView: slidesPerView1280
						},
						// when window width is >= 1281px
						1281: {
							slidesPerView: slidesPerView1366
						},
						// when window width is >= 1367px
						1367: {
							slidesPerView: slidesPerView1368
						},
						// when window width is >= 1369px
						1369: {
							slidesPerView: slidesPerView1440
						},
						// when window width is >= 1441px
						1441: {
							slidesPerView: slidesPerView
						}
					},
					on: {
						init: function () {
							setTimeout(
								function () {
									$sliderHolder.addClass( 'qodef-swiper--initialized' );
								},
								1500
							);

							if ( sliderScroll ) {
								var scrollStart = false;

								$sliderHolder.on(
									'mousewheel',
									function ( e ) {
										e.preventDefault();

										if ( ! scrollStart ) {
											scrollStart = true;

											if ( e.deltaY < 0 ) {
												$swiper.slideNext();
											} else {
												$swiper.slidePrev();
											}

											setTimeout(
												function () {
													scrollStart = false;
												},
												1000
											);
										}
									}
								);
							}
						}
					},
				}
			);
		}
	};

	qodefCore.shortcodes.obsius_core_fixed_indent_slider.qodefFixedIndentSlider = qodefFixedIndentSlider;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.obsius_core_google_map = {};

	$( document ).ready(
		function () {
			qodefGoogleMap.init();
		}
	);

	var qodefGoogleMap = {
		init: function () {
			this.holder = $( '.qodef-google-map' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefGoogleMap.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			if ( typeof window.qodefGoogleMap !== 'undefined' ) {
				window.qodefGoogleMap.init( $currentItem.find( '.qodef-m-map' ) );
			}
		},
	};

	qodefCore.shortcodes.obsius_core_google_map.qodefGoogleMap = qodefGoogleMap;

})( jQuery );

(function ( $ ) {
    'use strict';

    qodefCore.shortcodes.obsius_core_highlight = {};

    $( document ).ready(
        function () {
            qodefHighlight.init();
        }
    );

    var qodefHighlight = {
        init: function () {
            this.holder = $( '.qodef-highlight .qodef-highlight-text' );

            if ( this.holder.length ) {
                this.holder.each(
                    function () {
                        qodefHighlight.initItem( $( this ) );
                    }
                );
            }
        },
        initItem: function ( $currentItem ) {
            var $svgPath              = $currentItem.find( '.qodef-svg--rounding path' );

            gsap.registerPlugin(ScrollTrigger);
            gsap.registerPlugin(DrawSVGPlugin);

            if ( $svgPath.length ) {
                gsap.fromTo(
                    $svgPath[0], //[0] is for passing as pure js
                    {
                        drawSVG: "0%",
                    },
                    {
                        scrollTrigger: {
                            trigger: $svgPath[0],
                            start: '100% bottom',
                            toggleActions: 'play none none none',
                        },
                        drawSVG: "100%",
                        delay: 0.3,
                        duration: 0.7,
                        ease: Power2.easeInOut,
                    }
                );
            }
        },
    };

    qodefCore.shortcodes.obsius_core_highlight.qodefHighlight = qodefHighlight;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.obsius_core_icon = {};

	$( document ).ready(
		function () {
			qodefIcon.init();
		}
	);

	var qodefIcon = {
		init: function () {
			this.icons = $( '.qodef-icon-holder' );

			if ( this.icons.length ) {
				this.icons.each(
					function () {
						qodefIcon.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			qodefIcon.iconHoverColor( $currentItem );
			qodefIcon.iconHoverBgColor( $currentItem );
			qodefIcon.iconHoverBorderColor( $currentItem );
		},
		iconHoverColor: function ( $iconHolder ) {
			if ( typeof $iconHolder.data( 'hover-color' ) !== 'undefined' ) {
				var spanHolder    = $iconHolder.find( 'span' ).length ? $iconHolder.find( 'span' ) : $iconHolder;
				var originalColor = spanHolder.css( 'color' );
				var hoverColor    = $iconHolder.data( 'hover-color' );

				$iconHolder.on(
					'mouseenter',
					function () {
						qodefIcon.changeColor(
							spanHolder,
							'color',
							hoverColor
						);
					}
				);
				$iconHolder.on(
					'mouseleave',
					function () {
						qodefIcon.changeColor(
							spanHolder,
							'color',
							originalColor
						);
					}
				);
			}
		},
		iconHoverBgColor: function ( $iconHolder ) {
			if ( typeof $iconHolder.data( 'hover-background-color' ) !== 'undefined' ) {
				var hoverBackgroundColor    = $iconHolder.data( 'hover-background-color' );
				var originalBackgroundColor = $iconHolder.css( 'background-color' );

				$iconHolder.on(
					'mouseenter',
					function () {
						qodefIcon.changeColor(
							$iconHolder,
							'background-color',
							hoverBackgroundColor
						);
					}
				);
				$iconHolder.on(
					'mouseleave',
					function () {
						qodefIcon.changeColor(
							$iconHolder,
							'background-color',
							originalBackgroundColor
						);
					}
				);
			}
		},
		iconHoverBorderColor: function ( $iconHolder ) {
			if ( typeof $iconHolder.data( 'hover-border-color' ) !== 'undefined' ) {
				var hoverBorderColor    = $iconHolder.data( 'hover-border-color' );
				var originalBorderColor = $iconHolder.css( 'borderTopColor' );

				$iconHolder.on(
					'mouseenter',
					function () {
						qodefIcon.changeColor(
							$iconHolder,
							'border-color',
							hoverBorderColor
						);
					}
				);
				$iconHolder.on(
					'mouseleave',
					function () {
						qodefIcon.changeColor(
							$iconHolder,
							'border-color',
							originalBorderColor
						);
					}
				);
			}
		},
		changeColor: function ( iconElement, cssProperty, color ) {
			iconElement.css(
				cssProperty,
				color
			);
		}
	};

	qodefCore.shortcodes.obsius_core_icon.qodefIcon = qodefIcon;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.obsius_core_image_gallery                    = {};
	qodefCore.shortcodes.obsius_core_image_gallery.qodefSwiper        = qodef.qodefSwiper;
	qodefCore.shortcodes.obsius_core_image_gallery.qodefMasonryLayout = qodef.qodefMasonryLayout;
	qodefCore.shortcodes.obsius_core_image_gallery.qodefMagnificPopup = qodef.qodefMagnificPopup;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.obsius_core_image_with_text                    = {};
	qodefCore.shortcodes.obsius_core_image_with_text.qodefMagnificPopup = qodef.qodefMagnificPopup;

	$( document ).ready(
		function () {
			qodefImageWithText.init();
		}
	);

	var qodefImageWithText = {
		init: function () {
			this.buttons = $( '.qodef-image-with-text.qodef-hover--predefined' );

			if ( this.buttons.length && qodef.windowWidth > 1024 ) {
				this.buttons.each(
					function () {
						qodefImageWithText.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			var transition = $currentItem.find('svg path')[0];

			$currentItem.on(
				'mouseleave',
				function () {
					$currentItem.addClass('qodef--mouse-leave');

					var onTransitionEnd = ()=>{
						$currentItem.removeClass('qodef--mouse-leave');
						transition.removeEventListener('transitionend', onTransitionEnd);
					}

					transition.addEventListener('transitionend', onTransitionEnd);
				}
			);
		},
	};

	qodefCore.shortcodes.obsius_core_image_with_text .qodefImageWithText = qodefImageWithText;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.obsius_core_process 			 = {};
	qodefCore.shortcodes.obsius_core_process.qodefAppear = qodef.qodefAppear;

	$( document ).ready(
		function () {
			qodefProcess.init();
		}
	);

	var qodefProcess = {
		init: function () {
			this.holder = $( '.qodef-process' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						var $thisHolder = $( this );

						qodefProcess.initItem( $thisHolder );
					}
				);
			}
		},
		initItem: function ( $holder ) {

			qodefCore.qodefIsInViewport.check(
				$holder,
				function () {
					var $item = $holder.find( '.qodef-process-item-holder' );
					$holder.addClass( 'qodef--appeared' );

					$item.each( function ( i, el ) {

						var textWrapper = $( el ).find( '.qodef-process-number' );
						textWrapper.html( textWrapper.text().replace(
							/\S/g,
							'<span class=\'qodef-letter\'>$&</span>'
						) );

						setTimeout(
							function () {
								anime.timeline()
								.add( {
									targets: $( el )[0].querySelectorAll( '.qodef-process-number .qodef-letter' ),
									translateY: [30, 0],
									opacity: [0, 1],
									duration: 400,
									easing: 'easeOutSine',
									delay: ( el, i ) => 150 * (i + 1)
								} );
							},
							300 + (i * 300)
						);
					} );
				},
			);
		},
	};

	qodefCore.shortcodes.obsius_core_process.qodefProcess = qodefProcess;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.obsius_core_progress_bar = {};

	$( document ).ready(
		function () {
			qodefProgressBar.init();
		}
	);

	/**
	 * Init progress bar shortcode functionality
	 */
	var qodefProgressBar = {
		init: function () {
			this.holder = $( '.qodef-progress-bar' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefProgressBar.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			var layout = $currentItem.data( 'layout' );

			qodefCore.qodefIsInViewport.check(
				$currentItem,
				function () {
					$currentItem.addClass( 'qodef--init' );

					var $container = $currentItem.find( '.qodef-m-canvas' ),
						data       = qodefProgressBar.generateBarData( $currentItem, layout ),
						number     = $currentItem.data( 'number' ) / 100;

					switch (layout) {
						case 'circle':
							qodefProgressBar.initCircleBar( $container, data, number );
							break;
						case 'semi-circle':
							qodefProgressBar.initSemiCircleBar( $container, data, number );
							break;
						case 'line':
							data = qodefProgressBar.generateLineData( $currentItem, number );
							qodefProgressBar.initLineBar( $container, data );
							break;
						case 'custom':
							qodefProgressBar.initCustomBar( $container, data, number );
							break;
					}
				},
				false
			);
		},
		generateBarData: function ( thisBar, layout ) {
			var activeWidth   = thisBar.data( 'active-line-width' );
			var activeColor   = thisBar.data( 'active-line-color' );
			var inactiveWidth = thisBar.data( 'inactive-line-width' );
			var inactiveColor = thisBar.data( 'inactive-line-color' );
			var easing        = 'linear';
			var duration      = typeof thisBar.data( 'duration' ) !== 'undefined' && thisBar.data( 'duration' ) !== '' ? parseInt( thisBar.data( 'duration' ), 10 ) : 1600;
			var textColor     = thisBar.data( 'text-color' );

			return {
				strokeWidth: activeWidth,
				color: activeColor,
				trailWidth: inactiveWidth,
				trailColor: inactiveColor,
				easing: easing,
				duration: duration,
				svgStyle: {
					width: '100%',
					height: '100%'
				},
				text: {
					style: {
						color: textColor
					},
					autoStyleContainer: false
				},
				from: {
					color: inactiveColor
				},
				to: {
					color: activeColor
				},
				step: function ( state, bar ) {
					if ( layout !== 'custom' ) {
						bar.setText( Math.round( bar.value() * 100 ) + '%' );
					}
				},
			};
		},
		generateLineData: function ( thisBar, number ) {
			var height         = thisBar.data( 'active-line-width' );
			var activeColor    = thisBar.data( 'active-line-color' );
			var inactiveHeight = thisBar.data( 'inactive-line-width' );
			var inactiveColor  = thisBar.data( 'inactive-line-color' );
			var duration       = typeof thisBar.data( 'duration' ) !== 'undefined' && thisBar.data( 'duration' ) !== '' ? parseInt( thisBar.data( 'duration' ), 10 ) : 1600;
			var textColor      = thisBar.data( 'text-color' );

			return {
				percentage: number * 100,
				duration: duration,
				fillBackgroundColor: activeColor,
				backgroundColor: inactiveColor,
				height: height,
				inactiveHeight: inactiveHeight,
				followText: thisBar.hasClass( 'qodef-percentage--floating' ),
				textColor: textColor,
			};
		},
		initCircleBar: function ( $container, data, number ) {
			if ( qodefProgressBar.checkBar( $container ) ) {
				var $bar = new ProgressBar.Circle( $container[0], data );

				$bar.animate( number );
			}
		},
		initSemiCircleBar: function ( $container, data, number ) {
			if ( qodefProgressBar.checkBar( $container ) ) {
				var $bar = new ProgressBar.SemiCircle( $container[0], data );

				$bar.animate( number );
			}
		},
		initCustomBar: function ( $container, data, number ) {
			if ( qodefProgressBar.checkBar( $container ) ) {
				var $bar = new ProgressBar.Path( $container[0], data );

				$bar.set( 0 );
				$bar.animate( number );
			}
		},
		initLineBar: function ( $container, data ) {
			$container.LineProgressbar( data );
		},
		checkBar: function ( $container ) {
			// check if svg is already in container, elementor fix
			if ( $container.find( 'svg' ).length ) {
				return false;
			}

			return true;
		}
	};

	qodefCore.shortcodes.obsius_core_progress_bar.qodefProgressBar = qodefProgressBar;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.obsius_core_single_image                    = {};
	qodefCore.shortcodes.obsius_core_single_image.qodefMagnificPopup = qodef.qodefMagnificPopup;

	$( document ).ready(
		function () {
			qodefSingleImage.init();
		}
	);

	var qodefSingleImage = {
		init: function () {
			this.holder = $( '.qodef-single-image.qodef--has-appear' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefSingleImage.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			qodefCore.qodefIsInViewport.check(
				$currentItem,
				function () {
					$currentItem.addClass( 'qodef--appeared' );
				},
			);
		},
	};

	qodefCore.shortcodes.obsius_core_single_image.qodefSingleImage = qodefSingleImage;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.obsius_core_tabs = {};

	$( document ).ready(
		() => {
			qodefTabs.init();
		}
	);

	const qodefTabs = {
		init () {
			this.holder = $( '.qodef-tabs' );

			if ( this.holder.length ) {
				this.holder.each(
					( index, element ) => {
						qodefTabs.initItem( element );
					}
				);
			}
		},
		initItem ( $currentItem ) {
			$currentItem.children( '.qodef-tabs-content' ).each(
				( index, element ) => {
					index = index + 1;

					let $that    = $( element ),
						link     = $that.attr( 'id' ),
						$navItem = $that.parent().find( '.qodef-tabs-navigation li:nth-child(' + index + ') a' ),
						navLink  = $navItem.attr( 'href' );

					link = '#' + link;

					if ( link.indexOf( navLink ) > -1 ) {
						$navItem.attr(
							'href',
							link
						);
					}
				}
			);

			$currentItem.addClass( 'qodef--init' ).tabs();
		},
		setHeight ( $holder ) {
			const $navigation = $holder.find('.qodef-tabs-navigation');
			const $content    = $holder.find('.qodef-tabs-content');
			let   navHeight,
				  contentHeight,
				  maxContentHeight = 0;

			if ( $navigation.length ) {
				navHeight = $navigation.outerHeight( true );
			}

			if ( $content.length ) {
				$content.each(
					( index, element ) => {
						contentHeight = $( element ).outerHeight( true );
						maxContentHeight = contentHeight > maxContentHeight ? contentHeight : maxContentHeight;
					}
				)
			}

			$holder.height(navHeight + maxContentHeight);
		}
	};

	qodefCore.shortcodes.obsius_core_tabs.qodefTabs = qodefTabs;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.obsius_core_text_marquee = {};

	$( document ).ready(
		function () {
			qodefTextMarquee.init();
		}
	);

	var qodefTextMarquee = {
		init: function () {
			this.holder = $( '.qodef-text-marquee' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefTextMarquee.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			qodefTextMarquee.initMarquee( $currentItem );
			qodefTextMarquee.initResponsive( $currentItem.find( '.qodef-m-content' ) );
		},
		initResponsive: function ( thisMarquee ) {
			var fontSize,
				lineHeight,
				coef1 = 1,
				coef2 = 1;

			if ( qodefCore.windowWidth < 1480 ) {
				coef1 = 0.8;
			}

			if ( qodefCore.windowWidth < 1200 ) {
				coef1 = 0.7;
			}

			if ( qodefCore.windowWidth < 768 ) {
				coef1 = 0.55;
				coef2 = 0.65;
			}

			if ( qodefCore.windowWidth < 600 ) {
				coef1 = 0.45;
				coef2 = 0.55;
			}

			if ( qodefCore.windowWidth < 480 ) {
				coef1 = 0.4;
				coef2 = 0.5;
			}

			fontSize = parseInt( thisMarquee.css( 'font-size' ) );

			if ( fontSize > 200 ) {
				fontSize = Math.round( fontSize * coef1 );
			} else if ( fontSize > 60 ) {
				fontSize = Math.round( fontSize * coef2 );
			}

			thisMarquee.css( 'font-size', fontSize + 'px' );

			lineHeight = parseInt( thisMarquee.css( 'line-height' ) );

			if ( lineHeight > 70 && qodefCore.windowWidth < 1440 ) {
				lineHeight = '1.2em';
			} else if ( lineHeight > 35 && qodefCore.windowWidth < 768 ) {
				lineHeight = '1.2em';
			} else {
				lineHeight += 'px';
			}

			thisMarquee.css( 'line-height', lineHeight );
		},
		initMarquee: function ( thisMarquee ) {
			var elements = thisMarquee.find( '.qodef-m-text' ),
				delta    = 0.05;

			elements.each(
				function ( i ) {
					$( this ).data( 'x', 0 );
				}
			);

			requestAnimationFrame(
				function () {
					qodefTextMarquee.loop( thisMarquee, elements, delta );
				}
			);
		},
		inRange: function ( thisMarquee ) {
			if ( qodefCore.scroll + qodefCore.windowHeight >= thisMarquee.offset().top && qodefCore.scroll < thisMarquee.offset().top + thisMarquee.height() ) {
				return true;
			}

			return false;
		},
		loop: function ( thisMarquee, elements, delta ) {
			if ( ! qodefTextMarquee.inRange( thisMarquee ) ) {
				requestAnimationFrame(
					function () {
						qodefTextMarquee.loop( thisMarquee, elements, delta );
					}
				);
				return false;
			} else {
				elements.each(
					function ( i ) {
						var el = $( this );
						el.css( 'transform', 'translate3d(' + el.data( 'x' ) + '%, 0, 0)' );
						el.data( 'x', (el.data( 'x' ) - delta).toFixed( 2 ) );
						el.offset().left < -el.width() - 25 && el.data( 'x', 100 * Math.abs( i - 1 ) );
					}
				);
				requestAnimationFrame(
					function () {
						qodefTextMarquee.loop( thisMarquee, elements, delta );
					}
				);
			}
		}
	};

	qodefCore.shortcodes.obsius_core_text_marquee.qodefTextMarquee = qodefTextMarquee;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.obsius_core_video_button                    = {};
	qodefCore.shortcodes.obsius_core_video_button.qodefMagnificPopup = qodef.qodefMagnificPopup;

})( jQuery );

(function ( $ ) {
	'use strict';

	$( window ).on(
		'load',
		function () {
			qodefStickySidebar.init();
		}
	);

	var qodefStickySidebar = {
		init: function () {
			var info = $( '.widget_obsius_core_sticky_sidebar' );

			if ( info.length && qodefCore.windowWidth > 1024 ) {
				info.wrapper = info.parents( '#qodef-page-sidebar' );
				info.offsetM = info.offset().top - info.wrapper.offset().top;
				info.adj     = 15;

				qodefStickySidebar.callStack( info );

				$( window ).on(
					'resize',
					function () {
						if ( qodefCore.windowWidth > 1024 ) {
							qodefStickySidebar.callStack( info );
						}
					}
				);

				$( window ).on(
					'scroll',
					function () {
						if ( qodefCore.windowWidth > 1024 ) {
							qodefStickySidebar.infoPosition( info );
						}
					}
				);
			}
		},
		calc: function ( info ) {
			var content = $( '.qodef-page-content-section' ),
				headerH = qodefCore.body.hasClass( 'qodef-header-appearance--none' ) ? 0 : parseInt( qodefGlobal.vars.headerHeight, 10 );

			// If posts not found set content to have the same height as the sidebar
			if ( qodefCore.windowWidth > 1024 && content.height() < 100 ) {
				content.css( 'height', info.wrapper.height() - content.height() );
			}

			info.start = content.offset().top;
			info.end   = content.outerHeight();
			info.h     = info.wrapper.height();
			info.w     = info.outerWidth();
			info.left  = info.offset().left;
			info.top   = headerH + qodefGlobal.vars.adminBarHeight - info.offsetM;
			info.data( 'state', 'top' );
		},
		infoPosition: function ( info ) {
			if ( qodefCore.scroll < info.start - info.top && qodefCore.scroll + info.h && info.data( 'state' ) !== 'top' ) {
				gsap.to(
					info.wrapper,
					.1,
					{
						y: 5,
					}
				);
				gsap.to(
					info.wrapper,
					.3,
					{
						y: 0,
						delay: .1,
					}
				);
				info.data( 'state', 'top' );
				info.wrapper.css(
					{
						'position': 'static',
					}
				);
			} else if ( qodefCore.scroll >= info.start - info.top && qodefCore.scroll + info.h + info.adj <= info.start + info.end &&
				info.data( 'state' ) !== 'fixed' ) {
				var c = info.data( 'state' ) === 'top' ? 1 : -1;
				info.data( 'state', 'fixed' );
				info.wrapper.css(
					{
						'position': 'fixed',
						'top': info.top,
						'left': info.left,
						'width': info.w,
					}
				);
				gsap.fromTo(
					info.wrapper,
					.2,
					{
						y: 0
					},
					{
						y: c * 10,
						ease: Power4.easeInOut
					}
				);
				gsap.to(
					info.wrapper,
					.2,
					{
						y: 0,
						delay: .2,
					}
				);
			} else if ( qodefCore.scroll + info.h + info.adj > info.start + info.end && info.data( 'state' ) !== 'bottom' ) {
				info.data( 'state', 'bottom' );
				info.wrapper.css(
					{
						'position': 'absolute',
						'top': info.end - info.h - info.adj,
						'left': 'auto',
						'width': info.w,
					}
				);
				gsap.fromTo(
					info.wrapper,
					.1,
					{
						y: 0
					},
					{
						y: -5,
					}
				);
				gsap.to(
					info.wrapper,
					.3,
					{
						y: 0,
						delay: .1,
					}
				);
			}
		},
		callStack: function ( info ) {
			this.calc( info );
			this.infoPosition( info );
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	var shortcode = 'obsius_core_blog_list';

	qodefCore.shortcodes[shortcode] = {};

	if ( typeof qodefCore.listShortcodesScripts === 'object' ) {
		$.each(
			qodefCore.listShortcodesScripts,
			function ( key, value ) {
				qodefCore.shortcodes[shortcode][key] = value;
			}
		);
	}

	qodefCore.shortcodes[shortcode].qodefResizeIframes = qodef.qodefResizeIframes;

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
	    function () {
            qodefVerticalSlidingNavMenu.init();
        }
	);

	/**
	 * Function object that represents vertical menu area.
	 * @returns {{init: Function}}
	 */
	var qodefVerticalSlidingNavMenu = {
		openedScroll: 0,

		initNavigation: function ( $verticalSlidingMenuObject ) {
			var $verticalSlidingNavObject = $verticalSlidingMenuObject.find( '.qodef-header-vertical-sliding-navigation' );

			if ( $verticalSlidingNavObject.hasClass( 'qodef-vertical-sliding-drop-down--below' ) ) {
				qodefVerticalSlidingNavMenu.dropdownClickToggle( $verticalSlidingNavObject );
			} else if ( $verticalSlidingNavObject.hasClass( 'qodef-vertical-sliding-drop-down--side' ) ) {
				qodefVerticalSlidingNavMenu.dropdownFloat( $verticalSlidingNavObject );
			}
		},
		dropdownClickToggle: function ( $verticalSlidingNavObject ) {
			var $menuItems = $verticalSlidingNavObject.find( 'ul li.menu-item-has-children' );

			$menuItems.each(
				function () {
					var $elementToExpand = $( this ).find( ' > .qodef-drop-down-second, > ul' );
					var menuItem         = this;
					var $dropdownOpener  = $( this ).find( '> a' );
					var slideUpSpeed     = 'fast';
					var slideDownSpeed   = 'slow';

					$dropdownOpener.on(
						'click tap',
						function ( e ) {
							e.preventDefault();
							e.stopPropagation();

							if ( $elementToExpand.is( ':visible' ) ) {
								$( menuItem ).removeClass( 'qodef-menu-item--open' );
								$elementToExpand.slideUp( slideUpSpeed );
							} else if ( $dropdownOpener.parent().parent().children().hasClass( 'qodef-menu-item--open' ) && $dropdownOpener.parent().parent().parent().hasClass( 'qodef-vertical-menu' ) ) {
								$( this ).parent().parent().children().removeClass( 'qodef-menu-item--open' );
								$( this ).parent().parent().children().find( ' > .qodef-drop-down-second' ).slideUp( slideUpSpeed );

								$( menuItem ).addClass( 'qodef-menu-item--open' );
								$elementToExpand.slideDown( slideDownSpeed );
							} else {

								if ( ! $( this ).parents( 'li' ).hasClass( 'qodef-menu-item--open' ) ) {
									$menuItems.removeClass( 'qodef-menu-item--open' );
									$menuItems.find( ' > .qodef-drop-down-second, > ul' ).slideUp( slideUpSpeed );
								}

								if ( $( this ).parent().parent().children().hasClass( 'qodef-menu-item--open' ) ) {
									$( this ).parent().parent().children().removeClass( 'qodef-menu-item--open' );
									$( this ).parent().parent().children().find( ' > .qodef-drop-down-second, > ul' ).slideUp( slideUpSpeed );
								}

								$( menuItem ).addClass( 'qodef-menu-item--open' );
								$elementToExpand.slideDown( slideDownSpeed );
							}
						}
					);
				}
			);
		},
		dropdownFloat: function ( $verticalSlidingNavObject ) {
			var $menuItems = $verticalSlidingNavObject.find( 'ul li.menu-item-has-children' );
			var $allDropdowns = $menuItems.find( ' > .qodef-drop-down-second > .qodef-drop-down-second-inner > ul, > ul' );

			$menuItems.each(
				function () {
					var $elementToExpand = $( this ).find( ' > .qodef-drop-down-second > .qodef-drop-down-second-inner > ul, > ul' );
					var menuItem         = this;

					if ( Modernizr.touch ) {
						var $dropdownOpener = $( this ).find( '> a' );

						$dropdownOpener.on(
							'click tap',
							function ( e ) {
								e.preventDefault();
								e.stopPropagation();

								if ( $elementToExpand.hasClass( 'qodef-float--open' ) ) {
									$elementToExpand.removeClass( 'qodef-float--open' );
									$( menuItem ).removeClass( 'qodef-menu-item--open' );
								} else {
									if ( ! $( this ).parents( 'li' ).hasClass( 'qodef-menu-item--open' ) ) {
										$menuItems.removeClass( 'qodef-menu-item--open' );
										$allDropdowns.removeClass( 'qodef-float--open' );
									}

									$elementToExpand.addClass( 'qodef-float--open' );
									$( menuItem ).addClass( 'qodef-menu-item--open' );
								}
							}
						);
					} else {
						//must use hoverIntent because basic hover effect doesn't catch dropdown
						//it doesn't start from menu item's edge
						$( this ).hoverIntent(
							{
								over: function () {
									$elementToExpand.addClass( 'qodef-float--open' );
									$( menuItem ).addClass( 'qodef-menu-item--open' );
								},
								out: function () {
									$elementToExpand.removeClass( 'qodef-float--open' );
									$( menuItem ).removeClass( 'qodef-menu-item--open' );
								},
								timeout: 300
							}
						);
					}
				}
			);
		},
		verticalSlidingAreaScrollable: function ( $verticalSlidingMenuObject ) {
			return $verticalSlidingMenuObject.hasClass( 'qodef-with-scroll' );
		},
		initVerticalSlidingAreaScroll: function ( $verticalSlidingMenuObject ) {
			if ( qodefVerticalSlidingNavMenu.verticalSlidingAreaScrollable( $verticalSlidingMenuObject ) && typeof qodefCore.qodefPerfectScrollbar === 'object' ) {
				qodefCore.qodefPerfectScrollbar.init( $verticalSlidingMenuObject );
			}
		},
		verticalSlidingAreaShowHide: function ( $verticalSlidingMenuObject ) {
			var $verticalSlidingMenuOpener = $verticalSlidingMenuObject.find( '.qodef-vertical-sliding-menu-opener' );

			$verticalSlidingMenuOpener.on(
				'click',
				function ( e ) {
					e.preventDefault();

					var $thisOpener = $( this );

					if ( ! $verticalSlidingMenuObject.hasClass( 'qodef-vertical-sliding-menu--opened' ) ) {
						$thisOpener.addClass( 'qodef--opened' );
						$verticalSlidingMenuObject.addClass( 'qodef-vertical-sliding-menu--opened' );
						qodefVerticalSlidingNavMenu.openedScroll = qodef.window.scrollTop();
					} else {
						$thisOpener.removeClass( 'qodef--opened' );
						$verticalSlidingMenuObject.removeClass( 'qodef-vertical-sliding-menu--opened' );
					}
				}
			);
		},
		verticalSlidingAreaCloseOnScroll: function ( $verticalSlidingMenuObject ) {
			var ignoreClickOnMenu = document.getElementById('qodef-page-header');

			document.addEventListener('click', function(event) {
				var isClickInsideElement = ignoreClickOnMenu.contains(event.target);

				if (!isClickInsideElement && $verticalSlidingMenuObject.hasClass( 'qodef-vertical-sliding-menu--opened' )) {
					$verticalSlidingMenuObject.find( '.qodef-vertical-sliding-menu-opener' ).removeClass( 'qodef--opened' );
					$verticalSlidingMenuObject.removeClass( 'qodef-vertical-sliding-menu--opened' );
				}
			});

			qodef.window.on(
				'scroll',
				function () {
					if ( $verticalSlidingMenuObject.hasClass( 'qodef-vertical-sliding-menu--opened' ) && Math.abs( qodef.scroll - qodefVerticalSlidingNavMenu.openedScroll ) > 400 ) {
						$verticalSlidingMenuObject.find( '.qodef-vertical-sliding-menu-opener' ).removeClass( 'qodef--opened' );
						$verticalSlidingMenuObject.removeClass( 'qodef-vertical-sliding-menu--opened' );
					}
				}
			);
		},
		init: function () {
			var $verticalSlidingMenuObject = $( '.qodef-header--vertical-sliding #qodef-page-header' );

			if ( $verticalSlidingMenuObject.length ) {
				qodefVerticalSlidingNavMenu.verticalSlidingAreaShowHide( $verticalSlidingMenuObject );
				qodefVerticalSlidingNavMenu.verticalSlidingAreaCloseOnScroll( $verticalSlidingMenuObject );
				qodefVerticalSlidingNavMenu.initNavigation( $verticalSlidingMenuObject );
				qodefVerticalSlidingNavMenu.initVerticalSlidingAreaScroll( $verticalSlidingMenuObject );
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	var fixedHeaderAppearance = {
		showHideHeader: function ( $pageOuter, $header ) {
			if ( qodefCore.windowWidth > 1024 ) {
				if ( qodefCore.scroll <= 0 ) {
					qodefCore.body.removeClass( 'qodef-header--fixed-display' );
					$pageOuter.css( 'padding-top', '0' );
					$header.css( 'margin-top', '0' );
				} else {
					qodefCore.body.addClass( 'qodef-header--fixed-display' );
					$pageOuter.css( 'padding-top', parseInt( qodefGlobal.vars.headerHeight + qodefGlobal.vars.topAreaHeight ) + 'px' );
					$header.css( 'margin-top', parseInt( qodefGlobal.vars.topAreaHeight ) + 'px' );
				}
			}
		},
		init: function () {

			if ( ! qodefCore.body.hasClass( 'qodef-header--vertical' ) ) {
				var $pageOuter = $( '#qodef-page-outer' ),
					$header    = $( '#qodef-page-header' );

				fixedHeaderAppearance.showHideHeader( $pageOuter, $header );

				$( window ).scroll(
					function () {
						fixedHeaderAppearance.showHideHeader( $pageOuter, $header );
					}
				);

				$( window ).resize(
					function () {
						$pageOuter.css( 'padding-top', '0' );
						fixedHeaderAppearance.showHideHeader( $pageOuter, $header );
					}
				);
			}
		}
	};

	qodefCore.fixedHeaderAppearance = fixedHeaderAppearance.init;

})( jQuery );

(function ( $ ) {
	'use strict';

	var stickyHeaderAppearance = {
		header: '',
		docYScroll: 0,
		init: function () {
			var displayAmount = stickyHeaderAppearance.displayAmount();

			// Set variables
			stickyHeaderAppearance.header 	  = $( '.qodef-header-sticky' );
			stickyHeaderAppearance.docYScroll = $( document ).scrollTop();

			// Set sticky visibility
			stickyHeaderAppearance.setVisibility( displayAmount );

			$( window ).scroll(
				function () {
					stickyHeaderAppearance.setVisibility( displayAmount );
				}
			);
		},
		displayAmount: function () {
			if ( qodefGlobal.vars.qodefStickyHeaderScrollAmount !== 0 ) {
				return parseInt( qodefGlobal.vars.qodefStickyHeaderScrollAmount, 10 );
			} else {
				return parseInt( qodefGlobal.vars.headerHeight + qodefGlobal.vars.adminBarHeight, 10 );
			}
		},
		setVisibility: function ( displayAmount ) {
			var isStickyHidden = qodefCore.scroll < displayAmount;

			if ( stickyHeaderAppearance.header.hasClass( 'qodef-appearance--up' ) ) {
				var currentDocYScroll = $( document ).scrollTop();

				isStickyHidden = (currentDocYScroll > stickyHeaderAppearance.docYScroll && currentDocYScroll > displayAmount) || (currentDocYScroll < displayAmount);

				stickyHeaderAppearance.docYScroll = $( document ).scrollTop();
			}

			stickyHeaderAppearance.showHideHeader( isStickyHidden );
		},
		showHideHeader: function ( isStickyHidden ) {
			if ( isStickyHidden ) {
				qodefCore.body.removeClass( 'qodef-header--sticky-display' );
			} else {
				qodefCore.body.addClass( 'qodef-header--sticky-display' );
			}
		},
	};

	qodefCore.stickyHeaderAppearance = stickyHeaderAppearance.init;

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefSearchCoversHeader.init();
		}
	);

	var qodefSearchCoversHeader = {
		init: function () {
			var $searchOpener = $( 'a.qodef-search-opener' ),
				$searchForm   = $( '.qodef-search-cover-form' ),
				$searchClose  = $searchForm.find( '.qodef-m-close' );

			if ( $searchOpener.length && $searchForm.length ) {
				$searchOpener.on(
					'click',
					function ( e ) {
						e.preventDefault();
						qodefSearchCoversHeader.openCoversHeader( $searchForm );
					}
				);
				$searchClose.on(
					'click',
					function ( e ) {
						e.preventDefault();
						qodefSearchCoversHeader.closeCoversHeader( $searchForm );
					}
				);
			}
		},
		openCoversHeader: function ( $searchForm ) {
			qodefCore.body.addClass( 'qodef-covers-search--opened qodef-covers-search--fadein' );
			qodefCore.body.removeClass( 'qodef-covers-search--fadeout' );

			setTimeout(
				function () {
					$searchForm.find( '.qodef-m-form-field' ).focus();
				},
				600
			);
		},
		closeCoversHeader: function ( $searchForm ) {
			qodefCore.body.removeClass( 'qodef-covers-search--opened qodef-covers-search--fadein' );
			qodefCore.body.addClass( 'qodef-covers-search--fadeout' );

			setTimeout(
				function () {
					$searchForm.find( '.qodef-m-form-field' ).val( '' );
					$searchForm.find( '.qodef-m-form-field' ).blur();
					qodefCore.body.removeClass( 'qodef-covers-search--fadeout' );
				},
				300
			);
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefSearchFullscreen.init();
		}
	);

	var qodefSearchFullscreen = {
		init: function () {
			var $searchOpener = $( 'a.qodef-search-opener' ),
				$searchHolder = $( '.qodef-fullscreen-search-holder' ),
				$searchClose  = $searchHolder.find( '.qodef-m-close' );

			if ( $searchOpener.length && $searchHolder.length ) {
				$searchOpener.on(
					'click',
					function ( e ) {
						e.preventDefault();
						if ( qodefCore.body.hasClass( 'qodef-fullscreen-search--opened' ) ) {
							qodefSearchFullscreen.closeFullscreen( $searchHolder );
						} else {
							qodefSearchFullscreen.openFullscreen( $searchHolder );
						}
					}
				);
				$searchClose.on(
					'click',
					function ( e ) {
						e.preventDefault();
						qodefSearchFullscreen.closeFullscreen( $searchHolder );
					}
				);

				//Close on escape
				$( document ).keyup(
					function ( e ) {
						if ( e.keyCode === 27 && qodefCore.body.hasClass( 'qodef-fullscreen-search--opened' ) ) { //KeyCode for ESC button is 27
							qodefSearchFullscreen.closeFullscreen( $searchHolder );
						}
					}
				);
			}
		},
		openFullscreen: function ( $searchHolder ) {
			qodefCore.body.removeClass( 'qodef-fullscreen-search--fadeout' );
			qodefCore.body.addClass( 'qodef-fullscreen-search--opened qodef-fullscreen-search--fadein' );

			setTimeout(
				function () {
					$searchHolder.find( '.qodef-m-form-field' ).focus();
				},
				900
			);

			qodefCore.qodefScroll.disable();
		},
		closeFullscreen: function ( $searchHolder ) {
			qodefCore.body.removeClass( 'qodef-fullscreen-search--opened qodef-fullscreen-search--fadein' );
			qodefCore.body.addClass( 'qodef-fullscreen-search--fadeout' );

			setTimeout(
				function () {
					$searchHolder.find( '.qodef-m-form-field' ).val( '' );
					$searchHolder.find( '.qodef-m-form-field' ).blur();
					qodefCore.body.removeClass( 'qodef-fullscreen-search--fadeout' );
				},
				300
			);

			qodefCore.qodefScroll.enable();
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefSearch.init();
		}
	);

	var qodefSearch = {
		init: function () {
			this.search = $( 'a.qodef-search-opener' );

			if ( this.search.length ) {
				this.search.each(
					function () {
						var $thisSearch = $( this );

						qodefSearch.searchHoverColor( $thisSearch );
					}
				);
			}
		},
		searchHoverColor: function ( $searchHolder ) {
			if ( typeof $searchHolder.data( 'hover-color' ) !== 'undefined' ) {
				var hoverColor    = $searchHolder.data( 'hover-color' ),
					originalColor = $searchHolder.css( 'color' );

				$searchHolder.on(
					'mouseenter',
					function () {
						$searchHolder.css( 'color', hoverColor );
					}
				).on(
					'mouseleave',
					function () {
						$searchHolder.css( 'color', originalColor );
					}
				);
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefSpinner.init();
		}
	);

	$( window ).on(
		'load',
		function () {
			if ( document.visibilityState === 'visible' ) {
				qodefSpinner.windowLoaded = true;
			} else {
				document.addEventListener(
					'visibilitychange',
					function () {
						if ( document.visibilityState === 'visible' ) {
							qodefSpinner.windowLoaded = true;
						}
					}
				);
			}
		}
	);

	$( window ).on(
		'elementor/frontend/init',
		function () {
			var isEditMode = Boolean( elementorFrontend.isEditMode() );

			if ( isEditMode ) {
				qodefSpinner.init( isEditMode );
			}
		}
	);

	var qodefSpinner = {
		holder: '',
		windowLoaded: false,
		init: function ( isEditMode ) {
			this.holder = $( '#qodef-page-spinner.qodef-layout--predefined' );

			if ( this.holder.length ) {
				qodefSpinner.animateSpinner(
					isEditMode,
					this.holder
				);
				qodefSpinner.fadeOutAnimation();
			}
		},
		animateSpinner: function ( isEditMode, $holder ) {
			if ( isEditMode ) {
				qodefSpinner.fadeOutLoader();
			} else {
				var $contentSvg = $( '#qodef-content-spinner-svg img' );

				var $svgHolder       = $holder.find( '.qodef-m-spinner' ),
					$lines           = $svgHolder.find( 'line' ),
					startAngles      = [],
					endAngles        = [],
					delays           = [],
					loopsNum         = 2,
					currentIteration = 0,

					$bgHolder        = $holder.find( '.qodef-m-inner' ),
					contentSvgWidth,
					loaderSvgLeft,
					loaderSvgTop;

				if ( $contentSvg.length ) {//in case loader is positioned in the page content as well
					function calculateLogoPosition() {
						var contentSvgStyles = $contentSvg[0].getBoundingClientRect(),
							contentSvgLeft   = contentSvgStyles.left,
							contentSvgTop    = contentSvgStyles.top;

						contentSvgWidth = contentSvgStyles.width;
						loaderSvgLeft   = contentSvgLeft;
						loaderSvgTop    = contentSvgTop;
					}

					calculateLogoPosition();

					function animateSpinnerToLogoPosition() {
						gsap.to(
							$svgHolder,
							{
								width: contentSvgWidth,
								top: loaderSvgTop,
								left: loaderSvgLeft,
								xPercent: 0,
								yPercent: 0,
								duration: .5,
							},
						);
					}

					$( window ).resize( function () {
						calculateLogoPosition();
						animateSpinnerToLogoPosition();
					} );
				}

				function fadeInSpinner() {
					var tl = gsap.to(
						$svgHolder,
						{
							opacity: 1,
							duration: 1,
							onStart: () => {
								if ( $contentSvg.length ) {//in case loader is positioned in the page content as well
									qodefCore.body.addClass( 'qodef--spiner-custom-behaviour' );
									qodefCore.qodefScroll.disable();
									window.scrollTo(
										0,
										0
									);
								}
							}
						}
					)

					return tl;
				}
				function partialFadeOutSpinnerBackground() {
					var tl = gsap.to(
						$bgHolder,
						{
							backgroundColor: 'rgba(0, 0, 0, .100)',
							duration: 4,
							ease: 'power2.in'
						}
					)

					return tl;
				}
				function animateLinesToFinalPosition(){
					var tl = gsap.to(
						$lines,
						{
							rotate: '0deg',
							duration: 1.4,
							onComplete: () => {
								gsap.to(
									$lines,
									{
										rotate: ( i ) => endAngles[i],
										duration: 1.2,
										delay: .5,
										onComplete: () => {
											setTimeout(
												function () {
													$holder.addClass( 'qodef--loaded' );
												},
												700
											);
										}
									}
								);
							}
						},
					);

					return tl;
				}
				function completeFadeOutSpinnerBackground() {
					var tl = gsap.to(
						$bgHolder,
						{
							backgroundColor: 'rgba(0, 0, 0, 0.000)',
							duration: 2,
							ease: 'power2.in'
						},
					);
					return tl;
				}
				function enablePageInteraction() {
					window.scrollTo(
						0,
						0
					);
					qodefCore.qodefScroll.enable();
					qodefCore.body.addClass( 'qodef--page-loaded' );
				}
				function animateSpinnerToCustomPosition() {
					var tl = gsap.to(
						$svgHolder,
						{
							width: contentSvgWidth,
							top: loaderSvgTop,
							left: loaderSvgLeft,
							xPercent: 0,
							yPercent: 0,
							rotate: '360deg',
							duration: 1.2,
							onStart: () => {
								enablePageInteraction();
							},
						}
					)

					return tl;
				}
				function fadeOutSpinnerCustom() {
					var customTl = gsap.timeline();
						customTl
						.add(animateSpinnerToCustomPosition())
						.add(animateLinesToFinalPosition(),'.2')
						.add(completeFadeOutSpinnerBackground(),'.2')

					return tl;
				}
				function spinnerLoop() {
					var tl = gsap.fromTo(
							$lines,
							{
								rotate: ( i ) => startAngles[i],
							},
							{
								rotate: ( i ) => endAngles[i],
								duration: 2.2,
								stagger: 0.08,
								repeat: -1,
								onRepeat: () => {
									currentIteration++;
									if ( currentIteration > loopsNum && qodefSpinner.windowLoaded ) {
										if ( ! $contentSvg.length ) {
											qodefSpinner.fadeOutLoader();
										} else {//custom behaviour, loader icon stays on page
											tl.pause();
											fadeOutSpinnerCustom();
										}
									}
								},
							}
						);

					return tl;
				}


				for ( let i = 0; i < $lines.length; i++ ) {
					var compStyle  = getComputedStyle( $lines[i] ),
						startAngle = compStyle.getPropertyValue( '--qodef-rotate-start' ),
						endAngle   = compStyle.getPropertyValue( '--qodef-rotate-end' )

					startAngles.push( startAngle );
					endAngles.push( endAngle );
				}

				gsap.set(
					$lines,
					{
						rotate: ( i ) => startAngles[i],
						svgOrigin: '10.3 27.5',
					}
				);

				var tl = gsap.timeline();

				tl
				.add(fadeInSpinner())
				.add(partialFadeOutSpinnerBackground(), '.1')
				.add(spinnerLoop(), '.1')
			}
		},
		fadeOutLoader: function ( speed, delay, easing ) {
			var $holder = qodefSpinner.holder.length ? qodefSpinner.holder : $( '#qodef-page-spinner.qodef-layout--predefined' );

			speed  = speed ? speed : 600;
			delay  = delay ? delay : 0;
			easing = easing ? easing : 'swing';

			$holder.delay( delay ).fadeOut(
				speed,
				easing
			);

			$( window ).on(
				'bind',
				'pageshow',
				function ( event ) {
					if ( event.originalEvent.persisted ) {
						$holder.fadeOut(
							speed,
							easing
						);
					}
				}
			);
		},
		fadeOutAnimation: function () {

			// Check for fade out animation
			if ( qodefCore.body.hasClass( 'qodef-spinner--fade-out' ) ) {
				var $pageHolder = $( '#qodef-page-wrapper' ),
					$linkItems  = $( 'a' );

				// If back button is pressed, than show content to avoid state where content is on display:none
				window.addEventListener(
					'pageshow',
					function ( event ) {
						var historyPath = event.persisted || (typeof window.performance !== 'undefined' && window.performance.navigation.type === 2);
						if ( historyPath && ! $pageHolder.is( ':visible' ) ) {
							$pageHolder.show();
						}
					}
				);

				$linkItems.on(
					'click',
					function ( e ) {
						var $clickedLink = $( this );

						if (
							e.which === 1 && // check if the left mouse button has been pressed
							$clickedLink.attr( 'href' ).indexOf( window.location.host ) >= 0 && // check if the link is to the same domain
							! $clickedLink.hasClass( 'remove' ) && // check is WooCommerce remove link
							$clickedLink.parent( '.product-remove' ).length <= 0 && // check is WooCommerce remove link
							$clickedLink.parents( '.woocommerce-product-gallery__image' ).length <= 0 && // check is product gallery link
							typeof $clickedLink.data( 'rel' ) === 'undefined' && // check pretty photo link
							typeof $clickedLink.attr( 'rel' ) === 'undefined' && // check VC pretty photo link
							! $clickedLink.hasClass( 'lightbox-active' ) && // check is lightbox plugin active
							(typeof $clickedLink.attr( 'target' ) === 'undefined' || $clickedLink.attr( 'target' ) === '_self') && // check if the link opens in the same window
							$clickedLink.attr( 'href' ).split( '#' )[0] !== window.location.href.split( '#' )[0] // check if it is an anchor aiming for a different page
						) {
							e.preventDefault();

							$pageHolder.fadeOut(
								600,
								'easeOutSine',
								function () {
									window.location = $clickedLink.attr( 'href' );
								}
							);
						}
					}
				);
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function() {
			qodefProgressBarSpinner.init();
		}
	);

	$( window ).on(
		'load',
		function () {
			qodefProgressBarSpinner.windowLoaded = true;
			qodefProgressBarSpinner.completeAnimation();
		}
	);

	$( window ).on(
		'elementor/frontend/init',
		function () {
			var isEditMode = Boolean( elementorFrontend.isEditMode() );

			if ( isEditMode ) {
				qodefProgressBarSpinner.init( isEditMode );
			}
		}
	);

	var qodefProgressBarSpinner = {
		holder: '',
		windowLoaded: false,
		percentNumber: 0,
		init: function ( isEditMode ) {
			this.holder = $( '#qodef-page-spinner.qodef-layout--progress-bar' );

			if ( this.holder.length ) {
				qodefProgressBarSpinner.animateSpinner( this.holder, isEditMode );
			}
		},
		animateSpinner: function ( $holder, isEditMode ) {
			var $numberHolder = $holder.find( '.qodef-m-spinner-number-label' ),
				$spinnerLine  = $holder.find( '.qodef-m-spinner-line-front' );

			$spinnerLine.animate(
				{ 'width': '100%' },
				10000,
				'linear'
			);

			var numberInterval = setInterval(
				function () {
					qodefProgressBarSpinner.animatePercent( $numberHolder, qodefProgressBarSpinner.percentNumber );

					if ( qodefProgressBarSpinner.windowLoaded ) {
						clearInterval( numberInterval );
					}
				},
				100
			);

			if ( isEditMode ) {
				qodefProgressBarSpinner.fadeOutLoader( $holder );
			}
		},
		completeAnimation: function () {
			var $holder = qodefProgressBarSpinner.holder.length ? qodefProgressBarSpinner.holder : $( '#qodef-page-spinner.qodef-layout--progress-bar' );

			var numberIntervalFastest = setInterval(
				function () {

					if ( qodefProgressBarSpinner.percentNumber >= 100 ) {
						clearInterval( numberIntervalFastest );

						$holder.find( '.qodef-m-spinner-line-front' ).stop().animate(
							{ 'width': '100%' },
							500
						);

						$holder.addClass( 'qodef--finished' );

						setTimeout(
							function () {
								qodefProgressBarSpinner.fadeOutLoader( $holder );
							},
							600
						);
					} else {
						qodefProgressBarSpinner.animatePercent(
							$holder.find( '.qodef-m-spinner-number-label' ),
							qodefProgressBarSpinner.percentNumber
						);
					}
				},
				6
			);
		},
		animatePercent: function ( $numberHolder, percentNumber ) {
			if ( percentNumber < 100 ) {
				percentNumber += 5;
				$numberHolder.text( percentNumber );

				qodefProgressBarSpinner.percentNumber = percentNumber;
			}
		},
		fadeOutLoader: function ( $holder, speed, delay, easing ) {
			speed  = speed ? speed : 600;
			delay  = delay ? delay : 0;
			easing = easing ? easing : 'swing';

			$holder.delay( delay ).fadeOut( speed, easing );

			$( window ).on(
				'bind',
				'pageshow',
				function ( event ) {
					if ( event.originalEvent.persisted ) {
						$holder.fadeOut( speed, easing );
					}
				}
			);
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		() => {
			qodefTextualSpinner.init();
		}
	);

	$( window ).on(
		'load',
		() => {
			qodefTextualSpinner.windowLoaded = true;
		}
	);

	$( window ).on(
		'elementor/frontend/init',
		() => {
			const isEditMode = Boolean( elementorFrontend.isEditMode() );

			if ( isEditMode ) {
				qodefTextualSpinner.init( isEditMode );
			}
		}
	);

	const qodefTextualSpinner = {
		init ( isEditMode ) {
			const $holder = $( '#qodef-page-spinner.qodef-layout--textual' );

			if ( $holder.length ) {
				if ( isEditMode ) {
					qodefTextualSpinner.fadeOutLoader( $holder );
				} else {
					qodefTextualSpinner.splitText( $holder );
				}
			}
		},
		splitText ( $holder ) {
			const $textHolder = $holder.find( '.qodef-m-text' );

			if ( $textHolder.length ) {
				let text     = $textHolder.text().trim(),
					chars    = text.split( '' ),
					cssClass = '';

				$textHolder.empty();

				chars.forEach(
					( element ) => {
						cssClass = (element === ' ' ? 'qodef-m-empty-char' : ' ');
						$textHolder.append( '<span class="qodef-m-char ' + cssClass + '">' + element + '</span>' );
					}
				);

				setTimeout(
					() => {
						qodefTextualSpinner.animateSpinner( $holder );
					}, 100
				);
			}
		},
		animateSpinner ( $holder ) {
			$holder.addClass( 'qodef--init' );

			function animationLoop ( animationProps ) {
				const $chars      = $holder.find( '.qodef-m-char' ),
					  charsLength = $chars.length - 1;

				if ( $chars.length ) {
					$chars.each(
						( index, element ) => {
							const $thisChar = $( element );

							setTimeout(
								() => {
									$thisChar.animate(
									    animationProps.type,
										animationProps.duration,
										animationProps.easing,
										() => {
											if ( index === charsLength ) {
												if ( 1 === animationProps.repeat ) {
													animationLoop(
													    {
                                                            type: { opacity: 0 },
                                                            duration: 1200,
                                                            easing: 'swing',
                                                            delay: 0,
                                                            repeat: 0,
                                                        }
													);
												} else {
													if ( ! qodefTextualSpinner.windowLoaded ) {
														animationLoop(
														    {
                                                                type: { opacity: 1 },
                                                                duration: 1800,
                                                                easing: 'swing',
                                                                delay: 160,
                                                                repeat: 1,
                                                            }
														);
													} else {
														qodefTextualSpinner.fadeOutLoader(
															$holder,
															600,
															0,
															'swing'
														);

														setTimeout(
															() => {
																const $revSlider = $( '.qodef-after-spinner-rev rs-module' );

																if ( $revSlider.length ) {
																	$revSlider.revstart();
																}
															}, 800
														);
													}
												}
											}
										}
									);
								}, index * animationProps.delay
							);
						}
					);
				}
			}

			animationLoop (
			    {
                    type: { opacity: 1 },
                    duration: 1800,
                    easing: 'swing',
                    delay: 160,
                    repeat: 1,
                }
			);
		},
		fadeOutLoader( $holder, speed, delay, easing ) {
			speed  = speed ? speed : 500;
			delay  = delay ? delay : 0;
			easing = easing ? easing : 'swing';

			if ( $holder.length ) {
				$holder.delay( delay ).fadeOut( speed, easing );

				$( window ).on(
					'bind',
					'pageshow',
					function( event ) {

						if ( event.originalEvent.persisted ) {
							$holder.fadeOut( speed, easing );
						}
					}
				);
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.obsius_core_instagram_list = {};

	$( document ).ready(
		function () {
		}
	);

	$( window ).load(
		function () {
			qodefInstagramSliderLegacy.init();
			qodefInstagramGallery.init();
			qodefInstagramSlider.init();
		}
	);

	var qodefInstagramSliderLegacy = {
		init: function () {
			this.holder = $( '.sbi.qodef-instagram-swiper-container' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefInstagramSliderLegacy.initSlider( $( this ) );
					}
				);
			}
		},
		initSlider: function ( $currentItem, $initAllItems ) {
			var sliderOptions   = $currentItem.parent().attr( 'data-options' ),
				$instagramImage = $currentItem.find( '.sbi_item.sbi_type_image' ),
				$imageHolder    = $currentItem.find( '#sbi_images' );

			$currentItem.attr( 'data-options', sliderOptions );

			$imageHolder.addClass( 'swiper-wrapper' );

			if ( $instagramImage.length ) {
				$instagramImage.each(
					function () {
						$( this ).addClass( 'qodef-e qodef-image-wrapper swiper-slide' );
					}
				);
			}

			if ( typeof qodef.qodefSwiper === 'object' ) {

				if ( false === $initAllItems ) {
					qodef.qodefSwiper.initSlider( $currentItem );
				} else {
					qodef.qodefSwiper.init( $currentItem );
				}
			}
		},
	};

	var qodefInstagramGallery = {
		init: function () {
			this.holder = $( '.qodef-sbi-instagram-plugin .sbi' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefInstagramGallery.initGallery( $( this ) );
					}
				);
			}
		},
		initGallery: function ( $currentItem ) {
			var galleryNumOfItems = $currentItem.parent().attr( 'data-num' );

			$currentItem.attr( 'data-num', galleryNumOfItems );
			$currentItem.attr( 'data-nummobile', galleryNumOfItems );

		},
	};

	var qodefInstagramSlider = {
		init: function () {
			this.holder = $( '.qodef-sbi-instagram-plugin .qodef-instagram-list.qodef-layout--slider' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						//qodefInstagramSlider.initSliderItems( $( this ) );
						qodefInstagramSlider.initSlider( $( this ) );
					}
				);
			}
		},
		initSliderItems: function ( $currentItem ) {
			var galleryNumOfItems = $currentItem.attr( 'data-num' ),
				swiperHolder	  = $currentItem.find( '.sbi' );

			swiperHolder.attr( 'data-num', galleryNumOfItems );
			swiperHolder.attr( 'data-nummobile', galleryNumOfItems );

		},
		initSlider: function ( $currentItem, $initAllItems ) {
			var swiperHolder		 = $currentItem.find( '.sbi' ),
				sliderOptions   	 = $currentItem.attr( 'data-options' ),
				$instagramImage 	 = $currentItem.find( '.sbi_item.sbi_type_image' ),
				$imageHolder    	 = $currentItem.find( '#sbi_images' ),
				$carouselItems		 = $currentItem.find('.sbi_type_carousel'),
				sliderNumOfItems 	 = $currentItem.attr( 'data-num' ),
				$carouselHiddenItems = $currentItem.find('.sbi_num_diff_hide'); // available when script is loaded on load

			$carouselItems.remove(); // remove default instagram items

			swiperHolder.addClass('qodef-instagram-swiper-container');

			swiperHolder.attr( 'data-options', sliderOptions );

			$imageHolder.addClass( 'swiper-wrapper' );

			$carouselHiddenItems.remove(); // remove hidden items

			// controlling number of items in swiper
			if ( $instagramImage.length > sliderNumOfItems ) {
				var numberOfItemsToRemove = $instagramImage.length - sliderNumOfItems;
				$instagramImage = $currentItem.find( '.sbi_item.sbi_type_image:nth-last-child(-n+' + numberOfItemsToRemove + ')' ).remove();

				// find swiper items again since we have removed some
				$instagramImage = $currentItem.find( '.sbi_item.sbi_type_image' );
			}

			if ( $instagramImage.length ) {

				$instagramImage.each(
					function () {
						$( this ).addClass( 'qodef-e qodef-image-wrapper swiper-slide' );
					}
				);
			}

			if ( typeof qodef.qodefSwiper === 'object' ) {

				setTimeout(
					function () {

						if ( false === $initAllItems ) {
							qodef.qodefSwiper.initSlider( swiperHolder );
						} else {
							qodef.qodefSwiper.init( swiperHolder );
						}

					},
					100
				);
			}
		},
	};

	qodefCore.shortcodes.obsius_core_instagram_list.qodefInstagramSliderLegacy = qodefInstagramSliderLegacy;
	qodefCore.shortcodes.obsius_core_instagram_list.qodefInstagramGallery 	   = qodefInstagramGallery;
	qodefCore.shortcodes.obsius_core_instagram_list.qodefInstagramSlider 	   = qodefInstagramSlider;
	qodefCore.shortcodes.obsius_core_instagram_list.qodefSwiper    			   = qodef.qodefSwiper;

})( jQuery );

(function ( $ ) {
	'use strict';

	/*
	 **	Re-init scripts on gallery loaded
	 */
	$( document ).on(
		'yith_wccl_product_gallery_loaded',
		function () {

			if ( typeof qodefCore.qodefWooMagnificPopup === 'function' ) {
				qodefCore.qodefWooMagnificPopup.init();
			}
		}
	);

})( jQuery );

(function ($) {
	'use strict';

	$(document).on(
		'qv_loader_stop qv_variation_gallery_loaded',
		function () {
			qodefYithSelect2.init();
		}
	);

	var qodefYithSelect2 = {
		init: function (settings) {
			this.holder = [];
			this.holder.push(
				{
					holder: $('#yith-quick-view-modal .variations select'),
					options: {
						minimumResultsForSearch: Infinity
					}
				}
			);

			// Allow overriding the default config
			$.extend(this.holder, settings);

			if (typeof this.holder === 'object') {
				$.each(
					this.holder,
					function (key, value) {
						qodefYithSelect2.createSelect2(value.holder, value.options);
					}
				);
			}
		},
		createSelect2: function ($holder, options) {
			if (typeof $holder.select2 === 'function') {
				$holder.select2(options);
			}
		}
	};

})(jQuery);

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.obsius_core_preview_product_slider = {};

	$( document ).ready(
		function () {
			qodefPreviewProductSlider.init();
		}
	);

	var qodefPreviewProductSlider = {
		init: function () {
			this.holder = $( '.qodef-woo-preview-product-slider' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						var $thisHolder = $( this );

						qodefPreviewProductSlider.fullHeightCalc( $thisHolder );
						qodefPreviewProductSlider.initItem( $thisHolder );

						$( window ).resize( function () {
							qodefPreviewProductSlider.fullHeightCalc( $thisHolder );
						} );
					}
				);
			}
		},
		fullHeightCalc: function ( $holder ) {
			var windowHeight  = (window.innerHeight || document.documentElement.clientHeight);
			var contentHeight = '';
			var useFullHeight = true;

			if ( useFullHeight && qodefCore.windowWidth > 1024 ) {
				contentHeight = windowHeight - qodefGlobal.vars.headerHeight - qodefGlobal.vars.topAreaHeight - qodefGlobal.vars.adminBarHeight;

				if ( qodefCore.body.hasClass( 'qodef-header--transparent' ) ) {
					contentHeight += qodefGlobal.vars.headerHeight
				}

				if ( qodefCore.body.hasClass( 'qodef--passepartout' ) ) {
					var passepartoutSize = parseInt( qodefCore.body.css( 'padding-top' ) );

					contentHeight -= passepartoutSize;
				}

			} else if ( useFullHeight && qodefCore.windowWidth <= 1024 ) {
				contentHeight = windowHeight /*- qodefGlobal.vars.mobileHeaderHeight*/ - qodefGlobal.vars.adminBarHeight;
			} else {
				contentHeight = 'auto';
			}

			$holder.height( contentHeight );
		},
		initItem: function ( $holder ) {
			var sliderOptions     = typeof $holder.data( 'options' ) !== 'undefined' ? $holder.data( 'options' ) : {},
				sliderScroll      = sliderOptions.sliderScroll !== undefined && sliderOptions.sliderScroll !== '' ? sliderOptions.sliderScroll : false,
				loop              = sliderOptions.loop !== undefined && sliderOptions.loop !== '' ? sliderOptions.loop : true,
				autoplay          = sliderOptions.autoplay !== undefined && sliderOptions.autoplay !== '' ? sliderOptions.autoplay : true,
				speed             = sliderOptions.speed !== undefined && sliderOptions.speed !== '' ? parseInt( sliderOptions.speed, 10 ) : 5000,
				speedAnimation    = sliderOptions.speedAnimation !== undefined && sliderOptions.speedAnimation !== '' ? parseInt( sliderOptions.speedAnimation, 10 ) : 800,
				slideAnimation    = sliderOptions.slideAnimation !== undefined && sliderOptions.slideAnimation !== '' ? sliderOptions.slideAnimation : '';

			if ( autoplay !== false && speed !== 5000 ) {
				autoplay = {
					delay: speed
				};
			}

			var $swiperHolderTop  = $holder.find( '.qodef-top-slider .qodef-m-swiper' ),
				$paginationTop    = $holder.find( '.qodef-top-slider .swiper-pagination' ),
				slidesPerView 	   = 1;

			var $swiperTop = new Swiper(
				$swiperHolderTop,
				{
					direction: 'horizontal',
					effect: 'fade',
					fadeEffect: {
						crossFade: true
					},
					runCallbacksOnInit: true,
					slidesPerView: slidesPerView,
					centeredSlides: false,
					spaceBetween: 0,
					sliderScroll: sliderScroll,
					autoplay: false, // controlling with other slide so this is false
					loop: loop,
					loopedSlides: 4,
					speed: speedAnimation,
					pagination: {
						el: $paginationTop,
						type: 'bullets',
						clickable: true,
					},
					on: {
						init: function () {
							setTimeout(
								function () {
									if ( ! $holder.hasClass( 'qodef-swiper--initialized' ) ) {
										$holder.addClass( 'qodef-swiper--initialized' );
									}
								},
								1500
							);
						}
					},
				}
			);

			var $swiperHolderBottom  = $holder.find( '.qodef-bottom-slider .qodef-m-swiper' ),
				$paginationBottom    = $holder.find( '.qodef-bottom-slider .swiper-pagination' ),
				nextNavigationBottom = $swiperHolderBottom.find( '.swiper-button-next' ),
				prevNavigationBottom = $swiperHolderBottom.find( '.swiper-button-prev' ),
				slidesPerViewBottom	 = 5,
				slidesPerView1440Bottom = 3,
				slidesPerView1368Bottom = 3,
				slidesPerView1366Bottom = 3,
				slidesPerView1280Bottom = 3,
				slidesPerView1024Bottom = 3,
				slidesPerView768Bottom  = 3,
				slidesPerView680Bottom  = 1,
				slidesPerView480Bottom  = 1;

			var $swiperBottom = new Swiper(
				$swiperHolderBottom,
				{
					direction: 'horizontal',
					runCallbacksOnInit: true,
					slidesPerView: slidesPerViewBottom,
					centeredSlides: true,
					spaceBetween: 69,
					sliderScroll: sliderScroll,
					touchRatio: 0.2,
					slideToClickedSlide: true,
					autoplay: autoplay,
					loop: loop,
					loopedSlides: 4,
					speed: speedAnimation,
					navigation: { nextEl: nextNavigationBottom, prevEl: prevNavigationBottom },
					pagination: {
						el: $paginationBottom,
						type: 'bullets',
						clickable: true,
					},
					breakpoints: {
						// when window width is < 481px
						0: {
							slidesPerView: slidesPerView480Bottom
						},
						// when window width is >= 481px
						481: {
							slidesPerView: slidesPerView680Bottom
						},
						// when window width is >= 681px
						681: {
							slidesPerView: slidesPerView768Bottom
						},
						// when window width is >= 769px
						769: {
							slidesPerView: slidesPerView1024Bottom
						},
						// when window width is >= 1025px
						1025: {
							slidesPerView: slidesPerView1280Bottom
						},
						// when window width is >= 1281px
						1281: {
							slidesPerView: slidesPerView1366Bottom
						},
						// when window width is >= 1367px
						1367: {
							slidesPerView: slidesPerView1368Bottom
						},
						// when window width is >= 1369px
						1369: {
							slidesPerView: slidesPerView1440Bottom
						},
						// when window width is >= 1441px
						1441: {
							slidesPerView: slidesPerViewBottom
						}
					},
					on: {
						init: function () {
							setTimeout(
								function () {
									if ( ! $holder.hasClass( 'qodef-swiper--initialized' ) ) {
										$holder.addClass( 'qodef-swiper--initialized' );
									}
								},
								1500
							);
						}
					},
				}
			);

			$swiperTop.controller.control = $swiperBottom;
			$swiperBottom.controller.control = $swiperTop;
		}
	};

	qodefCore.shortcodes.obsius_core_preview_product_slider.qodefPreviewProductSlider = qodefPreviewProductSlider;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.obsius_core_product_category_list                    = {};
	qodefCore.shortcodes.obsius_core_product_category_list.qodefMasonryLayout = qodef.qodefMasonryLayout;
	qodefCore.shortcodes.obsius_core_product_category_list.qodefSwiper        = qodef.qodefSwiper;

})( jQuery );

(function ( $ ) {
	'use strict';

	var shortcode = 'obsius_core_product_list';

	qodefCore.shortcodes[shortcode] = {};

	if ( typeof qodefCore.listShortcodesScripts === 'object' ) {
		$.each(
			qodefCore.listShortcodesScripts,
			function ( key, value ) {
				qodefCore.shortcodes[shortcode][key] = value;
			}
		);
	}

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefDropDownCart.init();
		}
	);

	var qodefDropDownCart = {
		init: function () {
			var $holder = $( '.qodef-widget-dropdown-cart-content' );

			if ( $holder.length ) {
				$holder.off().each(
					function () {
						var $thisHolder = $( this );

						qodefDropDownCart.trigger( $thisHolder );

						qodefCore.body.on(
							'added_to_cart removed_from_cart',
							function () {
								qodefDropDownCart.init();
							}
						);
					}
				);
			}
		},
		trigger: function ( $holder ) {
			var $items = $holder.find( '.qodef-woo-mini-cart' );
			if ( $items.length && typeof qodefCore.qodefPerfectScrollbar === 'object' ) {
				qodefCore.qodefPerfectScrollbar.init( $items );
			}
		},
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.obsius_core_clients_list             = {};
	qodefCore.shortcodes.obsius_core_clients_list.qodefSwiper = qodef.qodefSwiper;

})( jQuery );

(function ( $ ) {
	'use strict';

	var shortcode = 'obsius_core_portfolio_list';

	qodefCore.shortcodes[shortcode] = {};

	if ( typeof qodefCore.listShortcodesScripts === 'object' ) {
		$.each(
			qodefCore.listShortcodesScripts,
			function ( key, value ) {
				qodefCore.shortcodes[shortcode][key] = value;
			}
		);
	}

	qodefCore.shortcodes[shortcode].qodefBlobItem = qodefCore.qodefBlobItem;

	$( document ).ready(
		function () {
			qodefPortfolioListAppear.init();
		}
	);

	$( document ).on(
		'obsius_trigger_get_new_posts',
		function () {
			qodefPortfolioListAppear.init();
		}
	);

	var qodefPortfolioListAppear = {
		init: function () {
			this.holder = $( '.qodef-portfolio-list.qodef--has-appear' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						var $thisHolder = $( this );

						qodefPortfolioListAppear.initItem( $thisHolder );
					}
				);
			}
		},
		initItem: function ( $holder ) {
			var $items = $holder.find( '.qodef-e:not(.qodef-with--decoration-shape):not(.qodef-with--decoration-glow)');

			if ( $items.length ) {
				$items.each(
					function () {
						var $item = $( this );

						qodefCore.qodefIsInViewport.check(
							$item,
							function () {
								$item.addClass( 'qodef--appeared' );
							},
						);
					}
				);
			}
		},
	};

	qodefCore.shortcodes[shortcode].qodefPortfolioListAppear = qodefPortfolioListAppear;

})( jQuery );

(function ( $ ) {
	'use strict';

	var shortcode = 'obsius_core_portfolio_list_double_image';

	qodefCore.shortcodes[shortcode] = {};

	if ( typeof qodefCore.listShortcodesScripts === 'object' ) {
		$.each(
			qodefCore.listShortcodesScripts,
			function ( key, value ) {
				qodefCore.shortcodes[shortcode][key] = value;
			}
		);
	}

	$( document ).ready(
		function () {
			qodefPortfolioListDoubleImage.init();
		}
	);

	var qodefPortfolioListDoubleImage = {
		init: function () {
			this.holder = $( '.qodef-portfolio-list-double-image.qodef--has-appear .qodef-e' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						var $thisHolder = $( this );

						qodefPortfolioListDoubleImage.initItem( $thisHolder );
					}
				);
			}
		},
		initItem: function ( $holder ) {

			qodefCore.qodefIsInViewport.check(
				$holder,
				function () {
					$holder.addClass( 'qodef--appeared' );
				},
			);
		},
	};

	qodefCore.shortcodes.obsius_core_portfolio_list_double_image = {};

	qodefCore.shortcodes.obsius_core_portfolio_list_double_image.qodefPortfolioListDoubleImage = qodefPortfolioListDoubleImage;

})( jQuery );

(function ( $ ) {
	'use strict';

	var shortcode = 'obsius_core_portfolio_list_double_image';

	qodefCore.shortcodes[shortcode] = {};

	if ( typeof qodefCore.listShortcodesScripts === 'object' ) {
		$.each(
			qodefCore.listShortcodesScripts,
			function ( key, value ) {
				qodefCore.shortcodes[shortcode][key] = value;
			}
		);
	}

})( jQuery );

(function ( $ ) {
	'use strict';

	var shortcode = 'obsius_core_team_list';

	qodefCore.shortcodes[shortcode] = {};

	if ( typeof qodefCore.listShortcodesScripts === 'object' ) {
		$.each(
			qodefCore.listShortcodesScripts,
			function ( key, value ) {
				qodefCore.shortcodes[shortcode][key] = value;
			}
		);
	}

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.obsius_core_testimonials_list             = {};
	qodefCore.shortcodes.obsius_core_testimonials_list.qodefSwiper = qodef.qodefSwiper;

})( jQuery );

(function ( $ ) {
    'use strict';

    $( document ).ready(
        function () {
            qodefButtontextualHuge.init();
        }
    );

    var qodefButtontextualHuge = {
        init: function () {
            this.holder = $( '.qodef-button.qodef-layout--textual-huge' );

            if ( this.holder.length ) {
                this.holder.each(
                    function () {
                        qodefButtontextualHuge.initItem( $( this ) );
                    }
                );
            }
        },
        initItem: function ( $currentItem ) {
            var $svgPath              = $currentItem.find( '.qodef-svg--rounding path' );

            gsap.registerPlugin(ScrollTrigger);
            gsap.registerPlugin(DrawSVGPlugin);

            if ( $svgPath.length ) {
                gsap.fromTo(
                    $svgPath[0], //[0] is for passing as pure js
                    {
                        drawSVG: "0%",
                    },
                    {
                        scrollTrigger: {
                            trigger: $svgPath[0],
                            start: '100% bottom',
                            toggleActions: 'play none none none',
                        },
                        drawSVG: "100%",
                        delay: 0.3,
                        duration: 0.7,
                        ease: Power2.easeInOut,
                    }
                );
            }
        },
    };

    qodefCore.shortcodes.obsius_core_button.qodefButtontextualHuge = qodefButtontextualHuge;

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefInfoFollow.init();
		}
	);

	$( document ).on(
		'obsius_trigger_get_new_posts',
		function () {
			qodefInfoFollow.init();
		}
	);

	var qodefInfoFollow = {
		init: function () {
			var $gallery = $( '.qodef-hover-animation--follow' );

			if ( $gallery.length ) {
				qodefCore.body.append( '<div class="qodef-e-content-follow"><div class="qodef-e-top-holder"></div><div class="qodef-e-text"></div></div>' );

				var $contentFollow = $( '.qodef-e-content-follow' ),
					$topHolder     = $contentFollow.find( '.qodef-e-top-holder' ),
					$textHolder    = $contentFollow.find( '.qodef-e-text' );

				$gallery.each(
					function () {
						$gallery.find( '.qodef-e-inner' ).each(
							function () {
								var $thisItem = $( this );

								//info element position
								$thisItem.on(
									'mousemove',
									function ( e ) {
										if ( e.clientX + 20 + $contentFollow.width() > qodefCore.windowWidth ) {
											$contentFollow.addClass( 'qodef-right' );
										} else {
											$contentFollow.removeClass( 'qodef-right' );
										}

										$contentFollow.css(
											{
												top: e.clientY + 20,
												left: e.clientX + 20,
											}
										);
									}
								);

								//show/hide info element
								$thisItem.on(
									'mouseenter',
									function () {
										var $thisItemTopHolder  = $( this ).find( '.qodef-e-top-holder' ),
											$thisItemTextHolder = $( this ).find( '.qodef-e-text' );

										if ( $thisItemTopHolder.length ) {
											$topHolder.html( $thisItemTopHolder.html() );
										}

										if ( $thisItemTextHolder.length ) {
											$textHolder.html( $thisItemTextHolder.html() );
										}

										if ( ! $contentFollow.hasClass( 'qodef-is-active' ) ) {
											$contentFollow.addClass( 'qodef-is-active' );
										}
									}
								).on(
									'mouseleave',
									function () {
										if ( $contentFollow.hasClass( 'qodef-is-active' ) ) {
											$contentFollow.removeClass( 'qodef-is-active' );
										}
									}
								);
							}
						);
					}
				);
			}
		},
	};

	qodefCore.shortcodes.obsius_core_portfolio_list.qodefInfoFollow = qodefInfoFollow;

})( jQuery );
