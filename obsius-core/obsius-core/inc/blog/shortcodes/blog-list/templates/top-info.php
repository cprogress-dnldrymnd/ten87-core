<?php if ( isset( $enable_top_info ) && 'yes' === $enable_top_info ) {
?>
	<div class="qodef-m-top-info">
	<?php if ( ! empty( $top_info_title ) ) { ?>
		<div class="qodef-m-title">
			<div class="qodef-m-title-inner">
				<h2 class="qodef-m-title-text">
					<?php echo esc_html( $top_info_title ); ?>
				</h2>
			</div>
			<?php if ( ! empty( $top_info_subtitle ) ) { ?>
				<p class="qodef-m-subtitle-text">
					<?php echo esc_html( $top_info_subtitle ); ?>
				</p>
			<?php } ?>
		</div>
	<?php } ?>

	<?php if ( ! empty( $top_info_more_text ) ) { ?>
		<div class="qodef-m-more">
			<?php if ( ! empty( $top_info_more_link ) ) : ?>
				<a itemprop="url" href="<?php echo esc_url( $top_info_more_link ); ?>" target="<?php echo esc_attr( $top_info_more_target ); ?>">
			<?php endif; ?>
				<p class="qodef-m-more-text">
					<?php echo esc_html( $top_info_more_text ); ?>
					<?php obsius_core_render_svg_icon( 'button-arrow' ); ?>
				</p>
			<?php if ( ! empty( $top_info_more_link ) ) : ?>
				</a>
			<?php endif; ?>
		</div>
		<?php } ?>

	</div>
<?php } ?>
