<?php if ( ! empty( $button_params ) && class_exists( 'ObsiusCore_Button_Shortcode' ) ) { ?>
	<div class="qodef-m-button">
		<?php echo ObsiusCore_Button_Shortcode::call_shortcode( $button_params ); ?>
	</div>
<?php } ?>
