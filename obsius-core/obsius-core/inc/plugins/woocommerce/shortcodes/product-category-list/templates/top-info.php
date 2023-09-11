<?php if ( ! empty( $top_info_title ) || ! empty( $top_info_text )  ) {
    ?>
    <div class="qodef-m-top-info">
        <?php if ( ! empty( $top_info_title ) ) { ?>
            <h2 class="qodef-m-title">
                <?php echo esc_html( $top_info_title ); ?>
            </h2>
        <?php } ?>

        <?php if ( ! empty( $top_info_text ) ) { ?>
            <div class="qodef-more-holder">
                <?php obsius_core_render_svg_icon( 'decoration' ); ?>
                <p class="qodef-m-more-text">
                    <?php echo esc_html( $top_info_text ); ?>
                </p>
            </div>
        <?php } ?>

    </div>
<?php } ?>
