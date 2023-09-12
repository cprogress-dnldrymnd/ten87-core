<?php if ('no' !== $slider_navigation) {
	$nav_next_classes = '';
	$nav_prev_classes = '';

	if (isset($unique) && !empty($unique)) {
		$nav_next_classes = 'swiper-button-outside swiper-button-next-' . esc_attr($unique);
		$nav_prev_classes = 'swiper-button-outside swiper-button-prev-' . esc_attr($unique);
	}
?>
	<div class="swiper-button-prev <?php echo esc_attr($nav_prev_classes); ?>">
		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="57.846" height="51.715" viewBox="0 0 57.846 51.715">
			<defs>
				<clipPath id="clip-path">
					<rect id="Rectangle_37" data-name="Rectangle 37" width="57.846" height="51.715" fill="#1d1d1d" />
				</clipPath>
			</defs>
			<g id="Group_165" data-name="Group 165" transform="translate(57.846 51.683) rotate(180)">
				<g id="Group_44" data-name="Group 44" transform="translate(0 -0.033)" clip-path="url(#clip-path)">
					<path id="Path_126" data-name="Path 126" d="M57.845,21.858v7.856l-22.024,22-5.093-5.172L44.017,33.269A2.142,2.142,0,0,0,42.5,29.611H0V22.1H42.566a2.142,2.142,0,0,0,1.513-3.661L30.728,5.171,35.822,0,57.846,21.858Z" transform="translate(0 0)" fill="#1d1d1d" />
				</g>
			</g>
		</svg>
	</div>
	<div class="swiper-button-next <?php echo esc_attr($nav_next_classes); ?>">
		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="57.846" height="51.77" viewBox="0 0 57.846 51.77">
			<defs>
				<clipPath id="clip-path">
					<rect id="Rectangle_37" data-name="Rectangle 37" width="57.846" height="51.77" fill="#1d1d1d" />
				</clipPath>
			</defs>
			<g id="Group_164" data-name="Group 164" transform="translate(0)">
				<g id="Group_44" data-name="Group 44" transform="translate(0 0)" clip-path="url(#clip-path)">
					<path id="Path_126" data-name="Path 126" d="M57.845,21.882v7.864L35.821,51.77l-5.093-5.177L44.017,33.3A2.145,2.145,0,0,0,42.5,29.643H0V22.128H42.566a2.145,2.145,0,0,0,1.513-3.665L30.728,5.177,35.822,0,57.846,21.882Z" transform="translate(0 0)" fill="#1d1d1d" />
				</g>
			</g>
		</svg>
	</div>
<?php } ?>