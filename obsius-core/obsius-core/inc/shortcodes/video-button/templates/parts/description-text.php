<?php if ( ! empty( $description_text ) ) {
    ?>
    <div class="qodef-m-description-text">
        <div class="qodef-m-description-text-inner">
            <?php obsius_core_render_svg_icon( 'decoration' ); ?>
            <p class="qodef-m-more-text">
                <?php echo esc_html( $description_text ); ?>
            </p>
        </div>
    </div>
<?php } ?>
