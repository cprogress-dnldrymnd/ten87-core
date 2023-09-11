<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_attr( $slider_attr, 'data-options' ); ?>>

    <?php
    // Include top info
    obsius_core_template_part( 'post-types/portfolio/shortcodes/portfolio-list-double-image', 'templates/top-info', '', $params );
    ?>
	<div class="swiper-wrapper">
		<?php
		// Include items
		obsius_core_template_part( 'post-types/portfolio/shortcodes/portfolio-list-double-image', 'templates/loop', '', $params );
		?>
	</div>
	<?php obsius_core_template_part( 'content', 'templates/swiper-nav', '', $params ); ?>
	<?php obsius_core_template_part( 'content', 'templates/swiper-pag', '', $params ); ?>
</div>
