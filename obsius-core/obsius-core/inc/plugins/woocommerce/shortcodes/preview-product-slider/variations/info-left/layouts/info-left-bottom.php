<li <?php wc_product_class( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<?php if ( has_post_thumbnail() ) { ?>
			<div class="qodef-woo-product-image">
				<?php obsius_core_template_part( 'plugins/woocommerce/shortcodes/preview-product-slider', 'templates/post-info/image', '', $params ); ?>
                <?php
                // Hook to include additional content inside product list item image
                do_action( 'obsius_core_action_preview_product_slider_item_additional_image_content' );
                ?>
				<?php obsius_core_template_part( 'plugins/woocommerce/shortcodes/preview-product-slider', 'templates/post-info/link' ); ?>
			</div>
		<?php } ?>
		<div class="qodef-woo-product-content">
			<?php obsius_core_template_part( 'plugins/woocommerce/shortcodes/preview-product-slider', 'templates/post-info/title-span', '', $params ); ?>
            <?php obsius_core_template_part( 'plugins/woocommerce/shortcodes/preview-product-slider', 'templates/post-info/category', '', $params ); ?>
			<?php
			// Hook to include additional content inside product list item content
			do_action( 'obsius_core_action_preview_product_slider_item_additional_content' );
			?>
		</div>
	</div>
</li>
