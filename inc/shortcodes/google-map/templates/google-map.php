<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_style( $map_styles ); ?>>
	<div class="qodef-m-map" id="<?php echo esc_attr( $holder_id ); ?>" <?php echo wp_kses( $map_data, array( 'data' ) ); ?>></div>
</div>
