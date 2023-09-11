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
                            <?php echo qode_framework_wp_kses_html( 'content', $top_info_subtitle ); ?>
						</span>
					</span>
				</p>
			<?php } ?>
		</div>

        <?php
        $button_params = array(
            'link'          => $top_info_more_link,
            'text'          => $top_info_more_text,
            'target'        => $top_info_more_target,
            'button_layout' => 'outlined',
            'custom_class'  => 'qodef-m-button',
        );

        if ( ! empty( $button_params['text'] ) && ! empty( $button_params['link'] ) && class_exists( 'ObsiusCore_Button_Shortcode' ) ) {
            echo ObsiusCore_Button_Shortcode::call_shortcode( $button_params );
        }
        ?>

	</div>
<?php } ?>
