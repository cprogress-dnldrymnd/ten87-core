<?php

$portfolio_list_client = get_post_meta( get_the_ID(), 'qodef_portfolio_list_client', true );

if ( ! empty( $portfolio_list_client ) ) { ?>
    <span class="qodef-e-client">
        <?php echo esc_html( $portfolio_list_client ); ?>
    </span>
<?php
}