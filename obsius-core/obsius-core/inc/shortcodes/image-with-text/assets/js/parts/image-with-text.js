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
