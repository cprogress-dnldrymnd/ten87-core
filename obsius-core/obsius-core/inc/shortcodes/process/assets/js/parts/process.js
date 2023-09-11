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
