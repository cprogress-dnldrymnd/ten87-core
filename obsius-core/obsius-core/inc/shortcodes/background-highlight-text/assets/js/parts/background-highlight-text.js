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
