<?php if ( class_exists( 'ObsiusCore_Social_Share_Shortcode' ) ) { ?>
	<div class="qodef-e qodef-info--social-share">
		<?php
		$params = array(
			'title'  => esc_html__( 'Share', 'obsius-core' ),
			'layout' => 'text',
		);

		echo ObsiusCore_Social_Share_Shortcode::call_shortcode( $params );
		?>
	</div>
<?php } ?>
