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
