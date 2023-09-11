<?php

if ( ! function_exists( 'obsius_core_add_button_shortcode' ) ) {
	/**
	 * Function that isadding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function obsius_core_add_button_shortcode( $shortcodes ) {
		$shortcodes[] = 'ObsiusCore_Button_Shortcode';

		return $shortcodes;
	}

	add_filter( 'obsius_core_filter_register_shortcodes', 'obsius_core_add_button_shortcode', 9 );
}

if ( class_exists( 'ObsiusCore_Shortcode' ) ) {
	class ObsiusCore_Button_Shortcode extends ObsiusCore_Shortcode {

		public function __construct() {
			$this->set_layouts( apply_filters( 'obsius_core_filter_button_layouts', array() ) );

            $options_map   = obsius_core_get_variations_options_map( $this->get_layouts() );
            $default_value = $options_map['default_value'];

            $this->set_extra_options( apply_filters( 'obsius_core_filter_button_extra_options', array(), $default_value ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( OBSIUS_CORE_SHORTCODES_URL_PATH . '/button' );
			$this->set_base( 'obsius_core_button' );
			$this->set_name( esc_html__( 'Button', 'obsius-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays button with provided parameters', 'obsius-core' ) );
            $this->set_scripts(
                array(
                    'gsap' => array(
                        'registered' => true,
                    ),
                    'ScrollTrigger' => array(
                        'registered' => true,
                    ),
                    'DrawSVGPlugin' => array(
                        'registered' => true,
                    ),
                )
            );
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
					'name'          => 'button_layout',
					'title'         => esc_html__( 'Layout', 'obsius-core' ),
					'options'       => $this->get_layouts(),
					'default_value' => $options_map['default_value'],
					'visibility'    => array(
						'map_for_page_builder' => $options_map['visibility'],
						'map_for_widget'       => $options_map['visibility'],
					),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'size',
					'title'      => esc_html__( 'Size', 'obsius-core' ),
					'options'    => array(
						''      => esc_html__( 'Normal', 'obsius-core' ),
						'small' => esc_html__( 'Small', 'obsius-core' ),
						'large' => esc_html__( 'Large', 'obsius-core' ),
						'full'  => esc_html__( 'Normal Full Width', 'obsius-core' ),
					),
					'dependency' => array(
						'hide' => array(
							'button_layout' => array(
								'values'        => array('textual', 'textual-huge', 'outlined-revealing'),
								'default_value' => 'filled',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'text',
					'name'          => 'text',
					'title'         => esc_html__( 'Button Text', 'obsius-core' ),
					'default_value' => esc_html__( 'Button Text', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'link',
					'title'      => esc_html__( 'Button Link', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'target',
					'title'         => esc_html__( 'Target', 'obsius-core' ),
					'options'       => obsius_core_get_select_type_options_pool( 'link_target' ),
					'default_value' => '_self',
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'color',
					'title'      => esc_html__( 'Text Color', 'obsius-core' ),
					'group'      => esc_html__( 'Style', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'name'       => 'hover_color',
					'field_type' => 'color',
					'title'      => esc_html__( 'Text Hover Color', 'obsius-core' ),
					'group'      => esc_html__( 'Style', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'background_color',
					'title'      => esc_html__( 'Background Color', 'obsius-core' ),
					'group'      => esc_html__( 'Style', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'hover_background_color',
					'title'      => esc_html__( 'Background Hover Color', 'obsius-core' ),
					'group'      => esc_html__( 'Style', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'border_color',
					'title'      => esc_html__( 'Border Color', 'obsius-core' ),
					'group'      => esc_html__( 'Style', 'obsius-core' ),
					'dependency' => array(
						'hide' => array(
							'button_layout' => array(
								'values'        => array('outlined-revealing'),
								'default_value' => 'filled',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'hover_border_color',
					'title'      => esc_html__( 'Border Hover Color', 'obsius-core' ),
					'group'      => esc_html__( 'Style', 'obsius-core' ),
					'dependency' => array(
						'hide' => array(
							'button_layout' => array(
								'values'        => array('outlined-revealing'),
								'default_value' => 'filled',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'margin',
					'title'      => esc_html__( 'Margin', 'obsius-core' ),
					'group'      => esc_html__( 'Style', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'padding',
					'title'      => esc_html__( 'Padding', 'obsius-core' ),
					'group'      => esc_html__( 'Style', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'font_size',
					'title'      => esc_html__( 'Font Size', 'obsius-core' ),
					'group'      => esc_html__( 'Typography Style', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'font_weight',
					'title'      => esc_html__( 'Font Weight', 'obsius-core' ),
					'options'    => obsius_core_get_select_type_options_pool( 'font_weight' ),
					'group'      => esc_html__( 'Typography Style', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'text_transform',
					'title'      => esc_html__( 'Text Transform', 'obsius-core' ),
					'options'    => obsius_core_get_select_type_options_pool( 'text_transform' ),
					'group'      => esc_html__( 'Typography Style', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'enable_responsive_size',
					'title'         => esc_html__( 'Enable Responsive Font Size', 'obsius-core' ),
					'description'   => esc_html__( 'Enabling this option will set font size for screens below 1024px.', 'obsius-core' ),
					'options'       => obsius_core_get_select_type_options_pool( 'no_yes', false ),
					'default_value' => 'yes',
					'group'      => esc_html__( 'Typography Style', 'obsius-core' ),
					'dependency' => array(
						'show' => array(
							'button_layout' => array(
								'values'        => array( 'textual-huge'),
								'default_value' => '',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'html_type',
					'title'         => esc_html__( 'HTML Type', 'obsius-core' ),
					'options'       => array(
						'default' => esc_html__( 'Default', 'obsius-core' ),
						'input'   => esc_html__( 'Input', 'obsius-core' ),
						'submit'  => esc_html__( 'Submit', 'obsius-core' ),
					),
					'default_value' => 'default',
					'visibility'    => array(
						'map_for_page_builder' => false,
					),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'input_name',
					'title'      => esc_html__( 'Input Name', 'obsius-core' ),
					'visibility' => array(
						'map_for_page_builder' => false,
					),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'array',
					'name'       => 'custom_attrs',
					'title'      => esc_html__( 'Custom Data Attributes', 'obsius-core' ),
					'visibility' => array(
						'map_for_page_builder' => false,
					),
				)
			);
            $this->map_extra_options();
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'obsius_core_button', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

        public function load_assets() {
            wp_enqueue_script( 'gsap' );
            wp_enqueue_script( 'ScrollTrigger' );
            wp_enqueue_script( 'DrawSVGPlugin' );
        }

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['data_attrs']     = $this->get_data_attrs( $atts );
			$atts['styles']         = $this->get_styles( $atts );

			return obsius_core_get_template_part( 'shortcodes/button', 'variations/' . $atts['button_layout'] . '/templates/' . $atts['html_type'], '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-button';
			$holder_classes[] = ! empty( $atts['button_layout'] ) ? 'qodef-layout--' . $atts['button_layout'] : '';
			$holder_classes[] = ! empty( $atts['size'] ) ? 'qodef-size--' . $atts['size'] : '';
			if( "yes" === $atts['enable_responsive_size'] ) {
				$holder_classes[] = 'qodef-responsive-size';
			};
			$holder_classes[] = 'default' === $atts['html_type'] ? 'qodef-html--link' : '';

            $holder_classes = apply_filters( 'obsius_core_filter_button_variation_classes', $holder_classes, $atts );

			return implode( ' ', $holder_classes );
		}

		private function get_data_attrs( $atts ) {
			$data = array();

			if ( ! empty( $atts['hover_color'] ) ) {
				$data['data-hover-color'] = $atts['hover_color'];
			}

			if ('outlined-revealing' !== $atts['button_layout']) {
				if ( ! empty( $atts['hover_background_color'] ) ) {
					$data['data-hover-background-color'] = $atts['hover_background_color'];
				}

				if ( ! empty( $atts['hover_border_color'] ) ) {
					$data['data-hover-border-color'] = $atts['hover_border_color'];
				}

				if ( ! empty( $atts['custom_attrs'] ) && is_array( $atts['custom_attrs'] ) ) {
					$data = array_merge( $data, $atts['custom_attrs'] );
				}
			}

			return $data;
		}

		private function get_styles( $atts ) {
			$styles = array();

			if ('outlined-revealing' !== $atts['button_layout']){
				if ( ! empty( $atts['color'] ) ) {
					$styles[] = 'color: ' . $atts['color'];
				}

				if ( ! empty( $atts['background_color'] ) && 'outlined' !== $atts['button_layout'] && 'textual' !== $atts['button_layout'] ) {
					$styles[] = 'background-color: ' . $atts['background_color'];
				}

				if ( ! empty( $atts['border_color'] ) && 'textual' !== $atts['button_layout'] ) {
					$styles[] = 'border-color: ' . $atts['border_color'];
				}
			} else {
				if ( ! empty( $atts['color'] ) ) {
					$styles[] = 'color: ' . $atts['color'];
				}

				if ( ! empty( $atts['background_color'] ) && 'outlined' !== $atts['button_layout'] && 'textual' !== $atts['button_layout'] ) {
					$styles[] = '--qodef-revealing-button-background-color: ' . $atts['background_color'];
				}

				if ( ! empty( $atts['hover_background_color'] ) ) {
					$styles[] = '--qodef-revealing-button-hover-background-color: ' . $atts['hover_background_color'];
				}
			}

			if ( ! empty( $atts['font_size'] ) ) {
				if ( qode_framework_string_ends_with_typography_units( $atts['font_size'] ) ) {
					$styles[] = 'font-size: ' . $atts['font_size'];
				} else {
					$styles[] = 'font-size: ' . intval( $atts['font_size'] ) . 'px';
				}
			}

			if ( ! empty( $atts['font_weight'] ) ) {
				$styles[] = 'font-weight: ' . $atts['font_weight'];
			}

			if ( ! empty( $atts['text_transform'] ) ) {
				$styles[] = 'text-transform: ' . $atts['text_transform'];
			}

			if ( '' !== $atts['margin'] ) {
				$styles[] = 'margin: ' . $atts['margin'];
			}

			if ( '' !== $atts['padding'] ) {
				$styles[] = 'padding: ' . $atts['padding'];
			}

			return $styles;
		}
	}
}
