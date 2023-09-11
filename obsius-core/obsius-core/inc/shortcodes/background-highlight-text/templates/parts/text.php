<?php if ( ! empty( $title ) ) { ?>
	<?php if ( ! empty( $link ) ) : ?>
		<a class="qodef-e-link" itemprop="url" href="<?php echo esc_url( $link ); ?>"
		   target="<?php echo esc_attr( $target ); ?>"></a>
	<?php endif; ?>
	<div class="qodef-e-blob-element">
		<?php obsius_core_render_svg_icon( 'blob' ); ?>
	</div>
	<div class="qodef-e-text">
			<span  <?php qode_framework_inline_style( $title_styles ); ?>>
				<?php echo qode_framework_wp_kses_html( '', $title ); ?>
			</span>
	</div>

	<?php
}
