<?php
$fs_holder_classes = array();

if ( $fullscreen_menu_in_grid ) {
    $fs_holder_classes = 'qodef-in-grid';
} else {
    $fs_holder_classes = 'qodef-fullwidth';
}
?>
<div id="qodef-fullscreen-area" <?php qode_framework_class_attribute( $fs_holder_classes ); ?>>
	<?php if ( $fullscreen_menu_in_grid ) { ?>
	<div class="qodef-content-grid">
	<?php } ?>

		<div id="qodef-fullscreen-area-inner">
			<?php if ( has_nav_menu( 'fullscreen-menu-navigation' ) ) { ?>
				<nav class="qodef-fullscreen-menu" role="navigation" aria-label="<?php esc_attr_e( 'Full Screen Menu', 'obsius-core' ); ?>">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'fullscreen-menu-navigation',
							'container'      => '',
							'link_before'    => '<span class="qodef-menu-item-text">',
							'link_after'     => '</span>',
							'walker'         => new ObsiusCoreRootMainMenuWalker(),
						)
					);
					?>
				</nav>
			<?php } ?>

            <div class="qodef-fullscreen-area-side-area">
                <?php
                // Include widget area one.
                obsius_core_get_header_widget_area();

                // Include widget area two.
                obsius_core_get_header_widget_area('two');
                ?>
            </div>

		</div>

	<?php if ( $fullscreen_menu_in_grid ) { ?>
	</div>
	<?php } ?>
</div>
