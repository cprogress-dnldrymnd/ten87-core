(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.obsius_core_instagram_list = {};

	$( document ).ready(
		function () {
		}
	);

	$( window ).load(
		function () {
			qodefInstagramSliderLegacy.init();
			qodefInstagramGallery.init();
			qodefInstagramSlider.init();
		}
	);

	var qodefInstagramSliderLegacy = {
		init: function () {
			this.holder = $( '.sbi.qodef-instagram-swiper-container' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefInstagramSliderLegacy.initSlider( $( this ) );
					}
				);
			}
		},
		initSlider: function ( $currentItem, $initAllItems ) {
			var sliderOptions   = $currentItem.parent().attr( 'data-options' ),
				$instagramImage = $currentItem.find( '.sbi_item.sbi_type_image' ),
				$imageHolder    = $currentItem.find( '#sbi_images' );

			$currentItem.attr( 'data-options', sliderOptions );

			$imageHolder.addClass( 'swiper-wrapper' );

			if ( $instagramImage.length ) {
				$instagramImage.each(
					function () {
						$( this ).addClass( 'qodef-e qodef-image-wrapper swiper-slide' );
					}
				);
			}

			if ( typeof qodef.qodefSwiper === 'object' ) {

				if ( false === $initAllItems ) {
					qodef.qodefSwiper.initSlider( $currentItem );
				} else {
					qodef.qodefSwiper.init( $currentItem );
				}
			}
		},
	};

	var qodefInstagramGallery = {
		init: function () {
			this.holder = $( '.qodef-sbi-instagram-plugin .sbi' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefInstagramGallery.initGallery( $( this ) );
					}
				);
			}
		},
		initGallery: function ( $currentItem ) {
			var galleryNumOfItems = $currentItem.parent().attr( 'data-num' );

			$currentItem.attr( 'data-num', galleryNumOfItems );
			$currentItem.attr( 'data-nummobile', galleryNumOfItems );

		},
	};

	var qodefInstagramSlider = {
		init: function () {
			this.holder = $( '.qodef-sbi-instagram-plugin .qodef-instagram-list.qodef-layout--slider' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						//qodefInstagramSlider.initSliderItems( $( this ) );
						qodefInstagramSlider.initSlider( $( this ) );
					}
				);
			}
		},
		initSliderItems: function ( $currentItem ) {
			var galleryNumOfItems = $currentItem.attr( 'data-num' ),
				swiperHolder	  = $currentItem.find( '.sbi' );

			swiperHolder.attr( 'data-num', galleryNumOfItems );
			swiperHolder.attr( 'data-nummobile', galleryNumOfItems );

		},
		initSlider: function ( $currentItem, $initAllItems ) {
			var swiperHolder		 = $currentItem.find( '.sbi' ),
				sliderOptions   	 = $currentItem.attr( 'data-options' ),
				$instagramImage 	 = $currentItem.find( '.sbi_item.sbi_type_image' ),
				$imageHolder    	 = $currentItem.find( '#sbi_images' ),
				$carouselItems		 = $currentItem.find('.sbi_type_carousel'),
				sliderNumOfItems 	 = $currentItem.attr( 'data-num' ),
				$carouselHiddenItems = $currentItem.find('.sbi_num_diff_hide'); // available when script is loaded on load

			$carouselItems.remove(); // remove default instagram items

			swiperHolder.addClass('qodef-instagram-swiper-container');

			swiperHolder.attr( 'data-options', sliderOptions );

			$imageHolder.addClass( 'swiper-wrapper' );

			$carouselHiddenItems.remove(); // remove hidden items

			// controlling number of items in swiper
			if ( $instagramImage.length > sliderNumOfItems ) {
				var numberOfItemsToRemove = $instagramImage.length - sliderNumOfItems;
				$instagramImage = $currentItem.find( '.sbi_item.sbi_type_image:nth-last-child(-n+' + numberOfItemsToRemove + ')' ).remove();

				// find swiper items again since we have removed some
				$instagramImage = $currentItem.find( '.sbi_item.sbi_type_image' );
			}

			if ( $instagramImage.length ) {

				$instagramImage.each(
					function () {
						$( this ).addClass( 'qodef-e qodef-image-wrapper swiper-slide' );
					}
				);
			}

			if ( typeof qodef.qodefSwiper === 'object' ) {

				setTimeout(
					function () {

						if ( false === $initAllItems ) {
							qodef.qodefSwiper.initSlider( swiperHolder );
						} else {
							qodef.qodefSwiper.init( swiperHolder );
						}

					},
					100
				);
			}
		},
	};

	qodefCore.shortcodes.obsius_core_instagram_list.qodefInstagramSliderLegacy = qodefInstagramSliderLegacy;
	qodefCore.shortcodes.obsius_core_instagram_list.qodefInstagramGallery 	   = qodefInstagramGallery;
	qodefCore.shortcodes.obsius_core_instagram_list.qodefInstagramSlider 	   = qodefInstagramSlider;
	qodefCore.shortcodes.obsius_core_instagram_list.qodefSwiper    			   = qodef.qodefSwiper;

})( jQuery );
