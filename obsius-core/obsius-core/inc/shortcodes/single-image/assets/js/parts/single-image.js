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
