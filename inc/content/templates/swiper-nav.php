<?php if ('no' !== $slider_navigation) {
	$nav_next_classes = '';
	$nav_prev_classes = '';

	if (isset($unique) && !empty($unique)) {
		$nav_next_classes = 'swiper-button-outside swiper-button-next-' . esc_attr($unique);
		$nav_prev_classes = 'swiper-button-outside swiper-button-prev-' . esc_attr($unique);
	}
?>
	<div class="swiper-button-prev <?php echo esc_attr($nav_prev_classes); ?>">
		<img src="<?= get_stylesheet_directory_uri() . '/assets/images/arrow-black.svg' ?>" alt="">
	</div>
	<div class="swiper-button-next <?php echo esc_attr($nav_next_classes); ?>">
		<img src="<?= get_stylesheet_directory_uri() . '/assets/images/arrow-black.svg' ?>" alt="">
	</div>
<?php } ?>