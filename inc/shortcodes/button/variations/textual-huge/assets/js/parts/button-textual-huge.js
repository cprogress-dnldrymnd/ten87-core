(function ( $ ) {
    'use strict';

    $( document ).ready(
        function () {
            qodefButtontextualHuge.init();
        }
    );

    var qodefButtontextualHuge = {
        init: function () {
            this.holder = $( '.qodef-button.qodef-layout--textual-huge' );

            if ( this.holder.length ) {
                this.holder.each(
                    function () {
                        qodefButtontextualHuge.initItem( $( this ) );
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

    qodefCore.shortcodes.obsius_core_button.qodefButtontextualHuge = qodefButtontextualHuge;

})( jQuery );
