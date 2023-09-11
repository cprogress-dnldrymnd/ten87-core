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
