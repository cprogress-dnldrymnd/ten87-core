<?php if ( ! post_password_required() ) { ?>
	<div class="qodef-e-read-more">
		<?php
		if ( obsius_post_has_read_more() ) {
			$button_params = array(
				'link'          => get_permalink() . '#more-' . get_the_ID(),
				'button_layout' => 'outlined-revealing',
				'text'          => esc_html__( 'Explore More', 'obsius' ),
			);
		} else {
			$button_params = array(
				'link'          => get_the_permalink(),
				'button_layout' => 'outlined-revealing',
				'text'          => esc_html__( 'Explore More', 'obsius' ),
			);
		}

		obsius_render_button_element( $button_params );
		?>
	</div>
<?php } ?>
