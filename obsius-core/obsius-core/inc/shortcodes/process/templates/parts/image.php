<?php if ( ! empty( $image_id ) ) { ?>
	<div class="qodef-e-image">
		<?php echo wp_get_attachment_image( $image_id, 'full' ); ?>
	</div>
<?php } ?>
