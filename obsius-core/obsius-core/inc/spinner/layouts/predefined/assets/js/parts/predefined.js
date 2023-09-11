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
