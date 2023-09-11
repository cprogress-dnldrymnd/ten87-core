<?php

$button_params = array(
    'link'          => $button_link,
    'text'          => $button_text,
    'target'        => $button_target,
    'button_layout' => 'outlined-revealing',
    'custom_class'  => 'qodef-m-button',
);

if ( ! empty( $button_params ) && ! empty( $button_params['link'] ) && class_exists( 'ObsiusCore_Button_Shortcode' ) ) {
    echo ObsiusCore_Button_Shortcode::call_shortcode( $button_params );
}