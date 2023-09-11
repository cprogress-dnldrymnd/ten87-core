<?php
$portfolio_list_image = get_post_meta( get_the_ID(), 'qodef_portfolio_list_image', true );
$has_image            = ! empty( $portfolio_list_image ) || has_post_thumbnail();

if ( $has_image ) {
	$image_dimension               = isset( $image_dimension ) && ! empty( $image_dimension ) && 'custom' !== $image_dimension ? esc_attr( $image_dimension['size'] ) : 'full';
	$image_url                     = obsius_core_get_list_shortcode_item_image_url( $image_dimension, $portfolio_list_image );
	$style                         = ! empty( $image_url ) ? 'background-image: url( ' . esc_url( $image_url ) . ')' : '';
    $replace_image_with_decoration = get_post_meta( get_the_ID(), 'replace_image_with_decoration_portfolio_item', true );
    $image_holder_classes          = array();
    $image_holder_classes[]        = 'qodef-e-media-image qodef--background';

    if ( ! empty( $replace_image_with_decoration ) ) {
        $image_holder_classes[] = 'qodef-replace-image-with--' . $replace_image_with_decoration;
    }
	?>
	<div <?php qode_framework_class_attribute( $image_holder_classes ); ?> <?php qode_framework_inline_style( $style ); ?>>
		<?php echo obsius_core_get_list_shortcode_item_image( $image_dimension, $portfolio_list_image ); ?>

        <?php
        if ( ! empty( $replace_image_with_decoration ) ) { ?>
            <div class="qodef-decoration-holder">
                <?php
                if ( 'decoration-shape' === $replace_image_with_decoration ) {
                    obsius_core_render_svg_icon( 'decoration' );
                } elseif ( 'decoration-glow' === $replace_image_with_decoration ) { ?>
	                <?php obsius_core_render_svg_icon( 'blob' );?>
                <?php
                }
                ?>
            </div>

            <?php
            $image_id = $portfolio_list_image ? $portfolio_list_image : get_post_thumbnail_id();
            $caption  = wp_get_attachment_caption( $image_id );
            ?>

            <?php if ( ! empty( $caption ) ) { ?>
                <span class="qodef-image-caption">
                    <span class="qodef-caption-text">
                    <?php echo esc_html( $caption ); ?>
                    </span>
                </span>
            <?php } ?>

        <?php
        }
        ?>

	</div>
<?php
}
?>
