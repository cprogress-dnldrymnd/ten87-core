<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_attr( $slider_attr, 'data-options' ); ?> <?php qode_framework_inline_attrs( $gallery_attr ); ?>>
    <?php obsius_core_template_part( 'plugins/instagram/shortcodes/instagram-list', 'templates/parts/profile-name', '', $params ); ?>
	<?php echo do_shortcode( "[instagram-feed class=qodef-instagram-swiper-container $instagram_params]" ); // XSS OK ?>
</div>
