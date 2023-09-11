<?php

// row

if ( ! function_exists( 'obsius_core_vc_row_background_text' ) ) {
	/**
	 * Map VC Row shortcode
	 * Hooks on vc_after_init action
	 */
	function obsius_core_vc_row_background_text() {

		/******* VC Row shortcode - begin *******/

		//Background text options

		vc_add_param(
			'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'background_text_enable',
				'heading'    => esc_html__( 'Enable Background Text', 'obsius-core' ),
				'value'      => array(
					esc_html__( 'Default', 'obsius-core' ) => '',
					esc_html__( 'Yes', 'obsius-core' ) => 'yes',
					esc_html__( 'No', 'obsius-core' )  => 'no',
				),
				'group'      => esc_html__( 'Obsius Core Settings', 'obsius-core' ),
			)
		);

		vc_add_param(
			'vc_row',
			array(
				'type'       => 'textfield',
				'param_name' => 'background_text',
				'heading'    => esc_html__( 'Background Text', 'obsius-core' ),
				'group'      => esc_html__( 'Obsius Core Settings', 'obsius-core' ),
				'dependency' => array(
					'element' => 'background_text_enable',
					'value'   => array( 'yes' ),
				),
			)
		);

		vc_add_param(
			'vc_row',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'background_text_color',
				'heading'    => esc_html__( 'Background Text  Color', 'obsius-core' ),
				'group'      => esc_html__( 'Obsius Core Settings', 'obsius-core' ),
				'dependency' => array(
					'element' => 'background_text_enable',
					'value'   => array( 'yes' ),
				),
			)
		);

		vc_add_param(
			'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'background_text_size',
				'heading'     => esc_html__( 'Background Text Size', 'obsius-core' ),
				'description' => esc_html( 'Set the background text size in px or em', 'obsius-core' ),
				'group'       => esc_html__( 'Obsius Core Settings', 'obsius-core' ),
				'dependency'  => array(
					'element' => 'background_text_enable',
					'value'   => array( 'yes' ),
				),
			)
		);

		vc_add_param(
			'vc_row',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'background_text_outline_color',
				'heading'    => esc_html__( 'Text Outline Color', 'obsius-core' ),
				'group'      => esc_html__( 'Obsius Core Settings', 'obsius-core' ),
				'dependency' => array(
					'element' => 'background_text_enable',
					'value'   => array( 'yes' ),
				),
			)
		);

		vc_add_param(
			'vc_row',
			array(
				'type'       => 'textfield',
				'param_name' => 'background_text_outline_stroke_width',
				'heading'    => esc_html__( 'Text Outline Width', 'obsius-core' ),
				'group'      => esc_html__( 'Obsius Core Settings', 'obsius-core' ),
				'dependency' => array(
					'element' => 'background_text_enable',
					'value'   => array( 'yes' ),
				),
			)
		);

		vc_add_param(
			'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'background_text_align',
				'heading'    => esc_html__( 'Background Text Align', 'obsius-core' ),
				'value'      => array(
					esc_html__( 'Default', 'obsius-core' ) => '',
					esc_html__( 'Left', 'obsius-core' )  => 'left',
					esc_html__( 'Center', 'obsius-core' ) => 'center',
					esc_html__( 'Right', 'obsius-core' ) => 'right',
				),
				'group'      => esc_html__( 'Obsius Core Settings', 'obsius-core' ),
				'dependency' => array(
					'element' => 'background_text_enable',
					'value'   => array( 'yes' ),
				),
			)
		);

		vc_add_param(
			'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'background_text_vertical_align',
				'heading'    => esc_html__( 'Background Text Vertical Align', 'obsius-core' ),
				'value'      => array(
					esc_html__( 'Default', 'obsius-core' ) => '',
					esc_html__( 'Top', 'obsius-core' ) => 'flex-start',
					esc_html__( 'Middle', 'obsius-core' ) => 'center',
					esc_html__( 'Bottom', 'obsius-core' ) => 'flex-end',
				),
				'group'      => esc_html__( 'Obsius Core Settings', 'obsius-core' ),
				'dependency' => array(
					'element' => 'background_text_enable',
					'value'   => array( 'yes' ),
				),
			)
		);

		/******* VC Row shortcode - end *******/

	}

	add_action( 'obsius_core_action_additional_vc_row_params', 'obsius_core_vc_row_background_text' );
}

// row inner

if ( ! function_exists( 'obsius_core_vc_row_inner_background_text' ) ) {
	/**
	 * Map VC Row inner shortcode
	 * Hooks on vc_after_init action
	 */
	function obsius_core_vc_row_inner_background_text() {

		/******* VC Row Inner shortcode - begin *******/

		vc_add_param(
			'vc_row_inner',
			array(
				'type'       => 'dropdown',
				'param_name' => 'background_text_enable',
				'heading'    => esc_html__( 'Enable Background Text', 'obsius-core' ),
				'value'      => array(
					esc_html__( 'Default', 'obsius-core' ) => '',
					esc_html__( 'Yes', 'obsius-core' ) => 'yes',
					esc_html__( 'No', 'obsius-core' )  => 'no',
				),
				'group'      => esc_html__( 'Obsius Core Settings', 'obsius-core' ),
			)
		);

		vc_add_param(
			'vc_row_inner',
			array(
				'type'       => 'textfield',
				'param_name' => 'background_text',
				'heading'    => esc_html__( 'Background Text', 'obsius-core' ),
				'group'      => esc_html__( 'Obsius Core Settings', 'obsius-core' ),
				'dependency' => array(
					'element' => 'background_text_enable',
					'value'   => array( 'yes' ),
				),
			)
		);

		vc_add_param(
			'vc_row_inner',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'background_text_color',
				'heading'    => esc_html__( 'Background Text  Color', 'obsius-core' ),
				'group'      => esc_html__( 'Obsius Core Settings', 'obsius-core' ),
				'dependency' => array(
					'element' => 'background_text_enable',
					'value'   => array( 'yes' ),
				),
			)
		);

		vc_add_param(
			'vc_row_inner',
			array(
				'type'       => 'textfield',
				'param_name' => 'background_text_size',
				'heading'    => esc_html__( 'Background Text Size', 'obsius-core' ),
				'group'      => esc_html__( 'Obsius Core Settings', 'obsius-core' ),
				'dependency' => array(
					'element' => 'background_text_enable',
					'value'   => array( 'yes' ),
				),
			)
		);

		vc_add_param(
			'vc_row_inner',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'background_text_outline_color',
				'heading'    => esc_html__( 'Text Outline Color', 'obsius-core' ),
				'group'      => esc_html__( 'Obsius Core Settings', 'obsius-core' ),
				'dependency' => array(
					'element' => 'background_text_enable',
					'value'   => array( 'yes' ),
				),
			)
		);

		vc_add_param(
			'vc_row_inner',
			array(
				'type'        => 'textfield',
				'param_name'  => 'background_text_outline_stroke_width',
				'heading'     => esc_html__( 'Text Outline Width', 'obsius-core' ),
				'description' => esc_html( 'Set the background text size in px or em', 'obsius-core' ),
				'group'       => esc_html__( 'Obsius Core Settings', 'obsius-core' ),
				'dependency'  => array(
					'element' => 'background_text_enable',
					'value'   => array( 'yes' ),
				),
			)
		);

		vc_add_param(
			'vc_row_inner',
			array(
				'type'       => 'dropdown',
				'param_name' => 'background_text_align',
				'heading'    => esc_html__( 'Background Text Align', 'obsius-core' ),
				'value'      => array(
					esc_html__( 'Default', 'obsius-core' ) => '',
					esc_html__( 'Left', 'obsius-core' )  => 'flex-start',
					esc_html__( 'Center', 'obsius-core' ) => 'center',
					esc_html__( 'Right', 'obsius-core' ) => 'flex-end',
				),
				'group'      => esc_html__( 'Obsius Core Settings', 'obsius-core' ),
				'dependency' => array(
					'element' => 'background_text_enable',
					'value'   => array( 'yes' ),
				),
			)
		);

		vc_add_param(
			'vc_row_inner',
			array(
				'type'       => 'dropdown',
				'param_name' => 'background_text_vertical_align',
				'heading'    => esc_html__( 'Background Text Vertical Align', 'obsius-core' ),
				'value'      => array(
					esc_html__( 'Default', 'obsius-core' ) => '',
					esc_html__( 'Top', 'obsius-core' ) => 'flex-start',
					esc_html__( 'Middle', 'obsius-core' ) => 'center',
					esc_html__( 'Bottom', 'obsius-core' ) => 'flex-end',
				),
				'group'      => esc_html__( 'Obsius Core Settings', 'obsius-core' ),
				'dependency' => array(
					'element' => 'background_text_enable',
					'value'   => array( 'yes' ),
				),
			)
		);

		/******* VC Row Inner shortcode - end *******/

	}

	add_action( 'obsius_core_action_additional_vc_row_inner_params', 'obsius_core_vc_row_inner_background_text' );
}

if ( ! function_exists( 'obsius_core_add_background_text' ) ) {
	function obsius_core_add_background_text( $html, $atts ) {

		$params = array();

		//text
		$params['text'] = $atts['background_text'];

		//content style
		$background_text_content_style = array();
		if ( '' !== $atts['background_text_align'] ) {
			$background_text_content_style[] = 'justify-content:' . $atts['background_text_align'];
		}

		if ( '' !== $atts['background_text_vertical_align'] ) {
			$background_text_content_style[] = 'align-items:' . $atts['background_text_vertical_align'];
		}
		$params['background_text_content_style'] = implode( '; ', $background_text_content_style );

		//text style
		$background_text_style = array();
		if ( '' !== $atts['background_text_color'] ) {
			$background_text_style [] = 'color:' . $atts['background_text_color'];
		}

		if ( '' !== $atts['background_text_size'] ) {
			$background_text_style [] = 'font-size:' . intval( $atts['background_text_size'] ) . 'px';
		}

		if ( '' !== $atts['background_text_outline_stroke_width'] ) {
			$background_text_style [] = '-webkit-text-stroke-width:' . intval( $atts['background_text_outline_stroke_width'] ) . 'px';
		}

		if ( '' !== $atts['background_text_outline_color'] ) {
			$background_text_style [] = '-webkit-text-stroke-color:' . $atts['background_text_outline_color'];
		}

		$params['background_text_style'] = implode( '; ', $background_text_style );

		if ( '' !== $atts['background_text'] ) {
			$html .= obsius_core_get_template_part( 'background-text', 'templates/background-text', '', $params );
		}

		return $html;
	}

	add_filter( 'obsius_core_filter_vc_row_after_wrapper_open', 'obsius_core_add_background_text', 10, 2 );
	add_filter( 'obsius_core_filter_vc_row_inner_after_wrapper_open', 'obsius_core_add_background_text', 10, 2 );
}

if ( ! function_exists( 'obsius_core_add_additional_classes_on_row_text' ) ) {
	function obsius_core_add_additional_classes_on_row_text( $classes, $base, $atts ) {

		if ( 'vc_row' === $base || 'vc_row_inner' === $base ) {
			if ( 'yes' === $atts['background_text_enable'] ) {
				$classes .= ' qodef-background-text';
			}

			if ( '' !== $atts['background_text_align'] ) {
				$classes .= ' qodef-background-text-alignment--' . $atts['background_text_align'];
			}
		}

		return $classes;
	}

	add_filter( 'vc_shortcodes_css_class', 'obsius_core_add_additional_classes_on_row_text', 10, 3 );
}
