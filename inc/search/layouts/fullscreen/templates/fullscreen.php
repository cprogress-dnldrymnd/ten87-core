<div class="qodef-fullscreen-search-holder qodef-m">
	<?php
	// Include logo
	obsius_core_get_header_logo_image();

	obsius_core_get_opener_icon_html(
		array(
			'option_name'  => 'search',
			'custom_class' => 'qodef-m-close',
			'custom_icon'  => 'search',
		),
		false,
		true
	);
	?>
	<div class="qodef-m-inner">
		<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="qodef-m-form" method="get">
			<input type="text" placeholder="<?php esc_attr_e( 'Search', 'obsius-core' ); ?>" name="s" class="qodef-m-form-field" autocomplete="off" required/>
			<?php
			obsius_core_get_opener_icon_html(
				array(
					'html_tag'     => 'button',
					'option_name'  => 'search',
					'custom_icon'  => 'search',
					'custom_class' => 'qodef-m-form-submit',
				)
			);
			?>
            <div class="qodef-m-form-legend">
                <?php esc_html_e('*type at least 1 character to search', 'obsius-core'); ?>
            </div>
			<div class="qodef-m-form-line"></div>
		</form>

        <?php if ( is_active_sidebar( 'qodef-fullscreen-search-area-left' ) || is_active_sidebar( 'qodef-fullscreen-search-area-right' ) ) { ?>
            <div class="qodef-fullscreen-search-side-area">

                <?php if ( is_active_sidebar( 'qodef-fullscreen-search-area-left' ) ) {
                    dynamic_sidebar( 'qodef-fullscreen-search-area-left' );
                }
                ?>

                <?php if ( is_active_sidebar( 'qodef-fullscreen-search-area-right' ) ) {
                    dynamic_sidebar( 'qodef-fullscreen-search-area-right' );
                }
                ?>
            </div>
        <?php } ?>

    </div>
</div>
