<?php if ( ! post_password_required() && class_exists( 'ObsiusCore_Button_Shortcode' ) ) { ?>
	<div class="qodef-e-read-more">
		<?php
		$button_params = array(
            'button_layout' => 'outlined-revealing',
			'link'          => get_the_permalink(),
			'text'          => esc_html__( 'Explore', 'obsius-core' ),
		);

		echo ObsiusCore_Button_Shortcode::call_shortcode( $button_params );
		?>
	</div>
<?php } ?>
