<?php
if ( ! empty( $profile_name ) && ! empty( $profile_link ) ) {
    ?>
    <div class="qodef-profile-name-holder">
        <<?php echo esc_attr( $title_tag ); ?> class="qodef-m-title">
            <a itemprop="url" href="<?php echo esc_url( $profile_link ); ?>" target="blank">
                <span class="qodef-profile-text"><?php echo esc_html( $profile_name ); ?></span>
            </a>
        </<?php echo esc_attr( $title_tag ); ?>>
    </div>
    <?php
}
?>
