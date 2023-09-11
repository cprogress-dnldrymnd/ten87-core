(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.obsius_core_accordion = {};

	$( document ).ready(
		function () {
			qodefAccordion.init();
		}
	);

	var qodefAccordion = {
		init: function () {
			var $holder = $( '.qodef-accordion' );

			if ( $holder.length ) {
				$holder.each(
					function () {
						var $thisAccordion = $( this );

						qodefAccordion.initItem( $thisAccordion );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			if ( $currentItem.hasClass( 'qodef-behavior--accordion' ) ) {
				qodefAccordion.initAccordion( $currentItem );
			}

			if ( $currentItem.hasClass( 'qodef-behavior--numbered-accordion' ) ) {
				qodefAccordion.initNumberedAccordion( $currentItem );
				qodefAccordion.calcNumberedAccordion( $currentItem ); // must be after init
			}

			if ( $currentItem.hasClass( 'qodef-behavior--toggle' ) ) {
				qodefAccordion.initToggle( $currentItem );
			}

			$currentItem.addClass( 'qodef--init' );
		},
		initAccordion: function ( $accordion ) {
			$accordion.accordion(
				{
					animate: 'swing',
					collapsible: true,
					active: 0,
					icons: '',
					heightStyle: 'content',
				}
			);
		},
		initNumberedAccordion: function ( $accordion ) {
			var $titles = $accordion.find( '.qodef-accordion-title' );

			if ( $titles.length ) {
				$titles.each(
					function (index) {
						index++;
						$( this ).prepend('<span class="qodef-tab-count">' + 0 + index + '</span>');
					}
				);
			}

			$accordion.accordion(
				{
					animate: 'swing',
					collapsible: true,
					active: 0,
					icons: '',
					heightStyle: 'content',
				}
			);
		},
		calcNumberedAccordion: function ( $accordion ) {
			var $accordionCounts = $accordion.find( '.qodef-accordion-title .qodef-tab-count' );
			$accordionCounts.css({'maxHeight': ''}); // remove values because of window resize

			var $accordionTitle 	  	       = $accordion.find( '.qodef-accordion-title' );
			var $accordionTitleActive 	 	   = $accordion.find( '.qodef-accordion-title.ui-state-active' );
			var $accordionTitleTabActiveHeight = $accordionTitleActive.find( '.qodef-tab-title' ).outerHeight();
			var $accordionContentActive 	   = $accordionTitleActive.find( '.qodef-accordion-content' );
			var $accordionActiveCount 	 	   = $accordionTitleActive.find( '.qodef-tab-count' );
			var $count 	 	  		  	 	   = $accordion.find( '.qodef-accordion-title .qodef-tab-count' );
			var $countHeight 	 	  	 	   = $count.outerHeight();
			var $countHeightReduced   	 	   = $countHeight * 0.5482; // ~ 280px on 1920px screen

			/* initial heights */
			$count.css( { 'maxHeight': $countHeightReduced } );
			$accordionActiveCount.css( { 'maxHeight': $countHeight } );
			$accordionContentActive.css( { 'top': ( $accordionTitleTabActiveHeight + 70 + 6 ) } ); // 70 is top position 6 is spacing adjustment
			$accordionContentActive.addClass( 'ui-accordion-content-active' );

			$accordionTitle.on(
				'click',
				function ( e ) {
					e.preventDefault();
					e.stopImmediatePropagation();

					var $accordionContentInactive = $accordion.find( '.qodef-accordion-title:not(.ui-state-active) .qodef-accordion-content' );
					var $accordionCountInactive   = $accordion.find( '.qodef-accordion-title:not(.ui-state-active) .qodef-tab-count' );
					$accordionCountInactive.css( { 'maxHeight': $countHeightReduced } );

					var $thisTitle = $( this );

					if ( $thisTitle.hasClass( 'ui-state-active' ) ) {
						var thisCountActive = $thisTitle.find( '.qodef-tab-count' );
						thisCountActive.css( { 'maxHeight': $countHeight } );

						var thisAccordionContentActive 		  = $thisTitle.find( '.qodef-accordion-content' );
						var thisAccordionTitleTabActiveHeight = $accordionTitleActive.find( '.qodef-tab-title' ).outerHeight();

						thisAccordionContentActive.css( { 'top': ( thisAccordionTitleTabActiveHeight + 70 + 6 ) } ); // 70 is top position 6 is spacing adjustment

						var thisContentActive = $thisTitle.find( '.qodef-accordion-content' );
						thisContentActive.addClass( 'ui-accordion-content-active' );
					}

					$accordionContentInactive.removeClass( 'ui-accordion-content-active' );
				}
			);
		},
		initToggle: function ( $toggle ) {
			var $toggleAccordionTitle = $toggle.find( '.qodef-accordion-title' );

			$toggleAccordionTitle.off().on(
				'mouseenter',
				function () {
					$( this ).addClass( 'ui-state-hover' );
				}
			).on(
				'mouseleave',
				function () {
					$( this ).removeClass( 'ui-state-hover' );
				}
			).on(
				'click',
				function ( e ) {
					e.preventDefault();
					e.stopImmediatePropagation();

					var $thisTitle = $( this );

					if ( $thisTitle.hasClass( 'ui-state-active' ) ) {
						$thisTitle.removeClass( 'ui-state-active' );
						$thisTitle.next().removeClass( 'ui-accordion-content-active' ).slideUp( 700 );
					} else {
						$thisTitle.addClass( 'ui-state-active' );
						$thisTitle.next().addClass( 'ui-accordion-content-active' ).slideDown( 800 );
					}
				}
			);
		}
	};

	qodefCore.shortcodes.obsius_core_accordion.qodefAccordion = qodefAccordion;

})( jQuery );
