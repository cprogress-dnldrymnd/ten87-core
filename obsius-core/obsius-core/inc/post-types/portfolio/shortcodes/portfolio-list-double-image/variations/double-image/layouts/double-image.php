<article <?php post_class( $item_classes ); ?>>
	<div class="qodef-e-inner" <?php qode_framework_inline_style( $this_shortcode->get_list_item_style( $params ) ); ?>>
        <div class="qodef-e-content">
            <div class="qodef-e-text">
                <?php obsius_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list-double-image', 'post-info/title', '', $params ); ?>

                <?php obsius_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list-double-image', 'post-info/read-more', '', $params ); ?>
            </div>
        </div>

        <div class="qodef-e-images-holder">
            <div class="qodef-e-images-holder-inner">
                <div class="qodef-e-image">
                    <?php obsius_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list-double-image', 'post-info/image', '', $params ); ?>
                </div>
                <div class="qodef-e-image qodef-two">
                    <?php obsius_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list-double-image', 'post-info/image-two', '', $params ); ?>

                    <?php obsius_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list-double-image', 'post-info/excerpt', '', $params ); ?>
                </div>
            </div>
        </div>
	</div>
</article>
