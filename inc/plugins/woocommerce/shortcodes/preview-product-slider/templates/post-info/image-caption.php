<?php
$product_list_image = get_post_meta( get_the_ID(), 'qodef_product_list_image', true );
$has_image          = ! empty( $product_list_image ) || has_post_thumbnail();
$image_id           = $product_list_image ? $product_list_image : get_post_thumbnail_id();
$caption            = wp_get_attachment_caption( $image_id );

if ( $has_image && $caption && ! empty( $show_image_caption ) && 'yes' === $show_image_caption ) {
    ?>
    <span class="qodef-image-caption">
        <span class="qodef-caption-icon"><?php esc_html_e('*', 'obsius-core'); ?></span>
        <span class="qodef-caption-text">
        <?php
        echo esc_html($caption);
        ?>
        </span>
		</span>
    <?php
}
?>