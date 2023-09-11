<?php
$custom_icon    = obsius_core_get_custom_svg_opener_icon_html( 'back_to_top' );
$holder_classes = array();
if ( empty( $custom_icon ) ) {
	$holder_classes[] = 'qodef--predefined';
}
?>
<a id="qodef-back-to-top" href="#" <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<span class="qodef-back-to-top-label">
		<?php
		esc_html_e( 'TAKE ME TO THE TOP', 'obsius-core' );
		?>
	</span>
	<span class="qodef-back-to-top-icon">
		<svg xmlns="http://www.w3.org/2000/svg" width="12.728" height="12.728">
			<path d="m5.657 12.02 5.091-5.09-9.97-.071v-.99h10.04L5.658.707 6.364 0l6.364 6.364-6.364 6.364Z"></path>
			<path d="m5.657 12.02 5.091-5.09-9.97-.071v-.99h10.04L5.658.707 6.364 0l6.364 6.364-6.364 6.364Z"></path>
		</svg>
	</span>
</a>
