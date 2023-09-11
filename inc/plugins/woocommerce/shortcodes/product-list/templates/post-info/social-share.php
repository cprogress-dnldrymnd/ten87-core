<?php if ( class_exists( 'ObsiusCore_Social_Share_Shortcode' ) ) { ?>
	<div class="qodef-woo-product-social-share">
		<?php
		$params          = array();
		$params['title'] = esc_html__( 'Share:', 'obsius-core' );

		echo ObsiusCore_Social_Share_Shortcode::call_shortcode( $params );
		?>
	</div>
<?php } ?>
