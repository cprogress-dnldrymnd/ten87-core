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
