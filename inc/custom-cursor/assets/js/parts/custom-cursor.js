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
