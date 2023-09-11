<a <?php qode_framework_class_attribute( $holder_classes ); ?> href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>" <?php qode_framework_inline_attrs( $data_attrs ); ?> <?php qode_framework_inline_style( $styles ); ?>>
    <span class="qodef-border-holder qodef-border-1"></span>
	<span class="qodef-hidden-content">
        <span class="qodef-m-text"><?php echo esc_html( $text ); ?></span>
        <?php obsius_core_render_svg_icon( 'button-arrow' ); ?>
    </span>
    <span class="qodef-initial-arrow">
	    <span class="qodef-border-holder qodef-border-2"></span>
        <?php obsius_core_render_svg_icon( 'button-arrow' ); ?>
    </span>
</a>
