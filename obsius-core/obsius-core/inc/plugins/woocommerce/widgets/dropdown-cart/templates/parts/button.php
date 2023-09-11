<?php if ( class_exists( 'ObsiusCore_Button_Shortcode' ) ) { ?>
    <div class="qodef-m-action">
        <?php
        $button_params = array(
            'custom_class'  => 'qodef-m-action-link',
            'button_layout' => 'outlined',
            'link'          => esc_url( wc_get_cart_url() ),
            'text'          => esc_html__( 'View Cart', 'obsius-core' ),
        );

        echo ObsiusCore_Button_Shortcode::call_shortcode( $button_params );
        ?>
    </div>
<?php } ?>
