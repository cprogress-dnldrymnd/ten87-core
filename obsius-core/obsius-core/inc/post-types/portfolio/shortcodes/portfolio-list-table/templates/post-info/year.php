<?php

$portfolio_list_year = get_post_meta( get_the_ID(), 'qodef_portfolio_list_year', true );

if ( ! empty( $portfolio_list_year ) ) { ?>
    <span class="qodef-e-year">
        <?php echo esc_html( $portfolio_list_year ); ?>
    </span>
<?php
}