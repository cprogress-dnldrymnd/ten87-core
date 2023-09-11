<?php

if ( ! function_exists( 'obsius_core_add_process_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function obsius_core_add_process_shortcode( $shortcodes ) {
		$shortcodes[] = 'ObsiusCore_Process_Shortcode';

		return $shortcodes;
	}

	add_filter( 'obsius_core_filter_register_shortcodes', 'obsius_core_add_process_shortcode' );
}

if ( class_exists( 'ObsiusCore_Shortcode' ) ) {
	class ObsiusCore_Process_Shortcode extends ObsiusCore_Shortcode {

		public function __construct() {
			$this->set_layouts( apply_filters( 'obsius_core_filter_process_layouts', array() ) );

			$options_map   = obsius_core_get_variations_options_map( $this->get_layouts() );
			$default_value = $options_map['default_value'];
			$this->set_extra_options( apply_filters( 'obsius_core_filter_process_extra_options', array(), $default_value ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( OBSIUS_CORE_SHORTCODES_URL_PATH . '/process' );
			$this->set_base( 'obsius_core_process' );
			$this->set_name( esc_html__( 'Process', 'obsius-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds process holder', 'obsius-core' ) );
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'custom_class',
					'title'      => esc_html__( 'Custom Class', 'obsius-core' ),
				)
			);

			$options_map = obsius_core_get_variations_options_map( $this->get_layouts() );

			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'layout',
					'title'         => esc_html__( 'Layout', 'obsius-core' ),
					'options'       => $this->get_layouts(),
					'default_value' => $options_map['default_value'],
					'visibility'    => array( 'map_for_page_builder' => $options_map['visibility'] ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'hide_buttons',
					'title'         => esc_html__( 'Hide Buttons', 'obsius-core' ),
					'options'       => obsius_core_get_select_type_options_pool( 'no_yes', false ),
				)
			);
            $this->set_option(
                array(
                    'field_type'    => 'select',
                    'name'          => 'enable_appear',
                    'title'         => esc_html__( 'Appear Animation', 'obsius-core' ),
                    'options'       => obsius_core_get_select_type_options_pool( 'yes_no', false ),
                    'default_value' => 'yes',
                )
            );
            $this->set_option(
                array(
                    'field_type'    => 'select',
                    'name'          => 'appear_delay',
                    'title'         => esc_html__( 'Appear Delay', 'obsius-core' ),
                    'description'   => esc_html__( 'Set option if content is placed on top of the page', 'obsius-core' ),
                    'dependency'    => array(
                        'show' => array(
                            'enable_appear' => array(
                                'values' => 'yes',
                                'default_value' => '',
                            )
                        ),
                    ),
                    'options'       => obsius_core_get_select_type_options_pool( 'no_yes', false ),
                    'default_value' => 'no',
                )
            );
			$this->set_option(
				array(
					'field_type' => 'repeater',
					'name'       => 'children',
					'title'      => esc_html__( 'Process Items', 'obsius-core' ),
					'items'      => array(
						array(
							'field_type' => 'text',
							'name'       => 'title',
							'title'      => esc_html__( 'Title', 'obsius-core' ),
						),
						array(
							'field_type' => 'textarea',
							'name'       => 'top_description',
							'title'      => esc_html__( 'Top Description', 'obsius-core' ),
						),
                        array(
                            'field_type' => 'textarea',
                            'name'       => 'bottom_description',
                            'title'      => esc_html__( 'Bottom Description', 'obsius-core' ),
                        ),
                        array(
                            'field_type'    => 'text',
                            'name'          => 'button_text',
                            'title'         => esc_html__( 'Button Text', 'obsius-core' ),
                            'default_value' => esc_html__( 'Find Out More', 'obsius-core' ),
                        ),
                        array(
                            'field_type' => 'text',
                            'name'       => 'button_link',
                            'title'      => esc_html__( 'Button Link', 'obsius-core' ),
                        ),
                        array(
                            'field_type'    => 'select',
                            'name'          => 'button_target',
                            'title'         => esc_html__( 'Target', 'obsius-core' ),
                            'options'       => obsius_core_get_select_type_options_pool( 'link_target' ),
                            'default_value' => '_self',
                        ),
					),
				)
			);
			$this->map_extra_options();
		}

		public function render( $options, $content = null ) {
			parent::render( $options );

			$atts                   = $this->get_atts();
			$atts['items']          = $this->parse_repeater_items( $atts['children'] );
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['this_shortcode'] = $this;
			$atts['this_object']    = $this;

			return obsius_core_get_template_part( 'shortcodes/process', '/variations/' . $atts['layout'] . '/templates/' . $atts['layout'], '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-process';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
			$holder_classes[] = ! empty( $atts['hide_buttons'] ) ? 'qodef-hide-buttons--' . $atts['hide_buttons'] : '';
            $holder_classes[] = ! empty ( $atts['enable_appear'] ) && $atts['enable_appear'] == 'yes' ? 'qodef--has-appear' : '';
            $holder_classes[] = ! empty ( $atts['appear_delay'] ) && $atts['appear_delay'] == 'yes' ? 'qodef--appear-delay' : '';

			if ( ! empty( $atts['items'] ) ) {
				$number_of_items = count( $atts['items'] );

				$holder_classes[] = 'qodef-items--' . $number_of_items;

				if ( 0 !== $number_of_items % 2 ) {
					$holder_classes[] = 'qodef-no-of-items--odd';
				}
			}

			if ( ! empty( $atts['columns'] ) ) {
				$holder_classes[] = 'qodef-grid';
				$holder_classes[] = 'qodef-layout--columns';
				$holder_classes[] = 'qodef-responsive--predefined';
				$holder_classes[] = 'qodef-col-num--' . $atts['columns'];
			}

			return implode( ' ', $holder_classes );
		}
	}
}
