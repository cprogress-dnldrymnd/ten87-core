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
