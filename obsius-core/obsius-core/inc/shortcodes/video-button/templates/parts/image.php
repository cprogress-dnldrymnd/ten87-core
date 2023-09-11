<?php if ( ! empty( $video_link ) ) : ?>
	<div class="qodef-m-image">
		<?php echo wp_get_attachment_image( $video_image, 'full' ); ?>

        <a itemprop="url" class="qodef-m-play qodef-magnific-popup qodef-popup-item" <?php echo qode_framework_get_inline_style( $play_button_styles ); ?> href="<?php echo esc_url( $video_link ); ?>" data-type="iframe">
		<span class="qodef-m-play-inner">
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="242.5px" height="281.7px" viewBox="0 0 242.5 281.7" style="enable-background:new 0 0 242.5 281.7;" xml:space="preserve">
				<style type="text/css">
					.video_player{fill:none;stroke:#FFFFFF;stroke-miterlimit:10;}
				</style>
				<polygon class="video_player" points="0.5,0.9 0.5,280.9 241.5,140.9 "/>
			</svg>
		</span>
        </a>
	</div>
<?php endif; ?>
