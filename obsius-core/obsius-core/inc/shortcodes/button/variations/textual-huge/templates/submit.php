<button type="submit" <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_attrs( $data_attrs ); ?> <?php qode_framework_inline_style( $styles ); ?>>
	<span class="qodef-btn-text"><?php echo esc_html( $text ); ?></span>
    <?php obsius_core_render_svg_icon( 'button-arrow-huge' ); ?>
    <span class="qodef-svg-rounding-holder">
        <?php obsius_core_render_svg_icon( 'rounding' ); ?>
    </span>
</button>