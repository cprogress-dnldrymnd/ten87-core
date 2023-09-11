<?php if ( ! empty( $subtitle_text ) ) { ?>
	<p class="qodef-m-subtitle-text" <?php qode_framework_inline_style( $text_styles ); ?>>
        <?php echo qode_framework_wp_kses_html( 'content', $subtitle_text ); ?>
    </p>
<?php } ?>
