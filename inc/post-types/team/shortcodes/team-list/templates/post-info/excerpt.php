<?php

if ( post_password_required() ) {
	echo get_the_password_form(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
} else {
	$excerpt = obsius_core_get_custom_post_type_excerpt( isset( $excerpt_length ) ? $excerpt_length : '' );

	if ( ! empty( $excerpt ) ) { ?>
		<p itemprop="description" class="qodef-e-excerpt"><?php echo esc_html( get_the_content() ); ?></p>
		<p>
			<button class="modal-trigger" >Read More</a>
		</p>
		<?php
	}
}
?>
