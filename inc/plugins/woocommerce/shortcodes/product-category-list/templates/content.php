<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
    <?php
    // Include top info
    obsius_core_template_part( 'plugins/woocommerce/shortcodes/product-category-list', 'templates/top-info', '', $params );
    ?>
	<div class="qodef-grid-inner clear">
		<?php
		// Include global masonry template from theme
		obsius_core_theme_template_part( 'masonry', 'templates/sizer-gutter', '', $params['behavior'] );

		// Include items
		obsius_core_template_part( 'plugins/woocommerce/shortcodes/product-category-list', 'templates/loop', '', $params );
		?>
	</div>
</div>
