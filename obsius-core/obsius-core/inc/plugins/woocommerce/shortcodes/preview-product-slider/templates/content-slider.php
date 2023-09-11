<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_attr( $slider_attr, 'data-options' ); ?>>
	<ul class="swiper-wrapper">
		<?php
		// Include items
		obsius_core_template_part( 'plugins/woocommerce/shortcodes/preview-product-slider', 'templates/loop', '', $params );
		?>
	</ul>
	<?php obsius_core_template_part( 'content', 'templates/swiper-nav', '', $params ); ?>
	<?php obsius_core_template_part( 'content', 'templates/swiper-pag', '', $params ); ?>
</div>
