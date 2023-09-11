<?php if ( isset( $enable_top_info ) && 'yes' === $enable_top_info ) {
	?>
	<div class="qodef-m-top-info">
		<div class="qodef-title-inner">
			<?php if ( ! empty( $top_info_title ) ) { ?>
				<h2 class="qodef-m-title">
					<span class="qodef-m-title-inner">
						<span class="qodef-m-title-text">
							<?php echo esc_html( $top_info_title ); ?>
						</span>
					</span>
				</h2>
			<?php } ?>

			<?php if ( ! empty( $top_info_subtitle ) ) { ?>
				<p class="qodef-m-subtitle">
					<span class="qodef-m-subtitle-inner">
						<span class="qodef-m-subtitle-text">
							<?php echo esc_html( $top_info_subtitle ); ?>
						</span>
					</span>
				</p>
			<?php } ?>
		</div>

		<?php if ( ! empty( $top_info_more_text ) ) { ?>
			<div class="qodef-m-more">
				<?php if ( ! empty( $top_info_more_link ) ) : ?>
				<a itemprop="url" href="<?php echo esc_url( $top_info_more_link ); ?>"
				   target="<?php echo esc_attr( $top_info_more_target ); ?>">
					<?php endif; ?>
					<p class="qodef-m-more-text">
						<?php echo esc_html( $top_info_more_text ); ?>
					</p>
					<?php obsius_core_render_svg_icon( 'button-arrow' ); ?>
					<?php if ( ! empty( $top_info_more_link ) ) : ?>
				</a>
			<?php endif; ?>
			</div>
		<?php } ?>

	</div>
<?php } ?>
