<?php

if ( isset( $media ) && ! empty( $media ) ) {
	// Wrapper elements
	$wrapped_start = '';
	$wrapped_end   = '';

	if ( isset( $media_type ) && 'gallery' === $media_type ) {
		$wrapped_start = '<div class="qodef-grid-item">';
		$wrapped_end   = '</div>';
	}
	// Video player settings
	$settings = apply_filters(
		'obsius_core_filter_video_format_settings',
		array(
			'loop' => true,
		)
	);

	$oembed = wp_oembed_get( $media );
	if ( ! empty( $oembed ) ) {
		echo sprintf( '%s%s%s', $wrapped_start, wp_oembed_get( $media, $settings ), $wrapped_end );
	} else {
		echo sprintf( '%s%s%s', $wrapped_start, wp_video_shortcode( array_merge( array( 'src' => esc_url( $media ) ), $settings ) ), $wrapped_end );
	}
}
