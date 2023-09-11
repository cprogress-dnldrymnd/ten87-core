<article <?php post_class( $item_classes ); ?>>
	<div class="qodef-e-inner" <?php qode_framework_inline_style( $this_shortcode->get_list_item_style( $params ) ); ?>>
        <div class="qodef-e-content">
            <div class="qodef-e-title-holder">
                <?php obsius_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list-table', 'post-info/title', '', $params ); ?>
            </div>

            <div class="qodef-e-category-holder">
                <?php obsius_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list-table', 'post-info/categories', '', $params ); ?>
            </div>

            <div class="qodef-e-client-holder">
                <?php obsius_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list-table', 'post-info/client', '', $params ); ?>
            </div>

            <div class="qodef-e-year-holder">
                <?php obsius_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list-table', 'post-info/year', '', $params ); ?>
            </div>

            <div class="qodef-e-button-holder">
                <?php obsius_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list-table', 'post-info/read-more', '', $params ); ?>
            </div>
        </div>
	</div>
</article>
