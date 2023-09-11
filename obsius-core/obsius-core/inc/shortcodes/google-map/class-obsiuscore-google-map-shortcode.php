<?php

if ( ! function_exists( 'obsius_core_add_google_map_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function obsius_core_add_google_map_shortcode( $shortcodes ) {
		$shortcodes[] = 'ObsiusCore_Google_Map_Shortcode';

		return $shortcodes;
	}

	add_filter( 'obsius_core_filter_register_shortcodes', 'obsius_core_add_google_map_shortcode' );
}

if ( class_exists( 'ObsiusCore_Shortcode' ) ) {
	class ObsiusCore_Google_Map_Shortcode extends ObsiusCore_Shortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( OBSIUS_CORE_SHORTCODES_URL_PATH . '/google-map' );
			$this->set_base( 'obsius_core_google_map' );
			$this->set_name( esc_html__( 'Google Map', 'obsius-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays google map with provided parameters', 'obsius-core' ) );
			$this->set_scripts(
				array(
					'google-map-api'           => array(
						'registered' => true,
					),
					'obsius-core-google-map' => array(
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
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'address1',
					'title'      => esc_html__( 'Address 1', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'address2',
					'title'      => esc_html__( 'Address 2', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'address3',
					'title'      => esc_html__( 'Address 3', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'address4',
					'title'      => esc_html__( 'Address 4', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'image',
					'name'       => 'pin',
					'title'      => esc_html__( 'Pin Icon', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'text',
					'name'          => 'map_height',
					'title'         => esc_html__( 'Map Height (px)', 'obsius-core' ),
					'default_value' => '300',
				)
			);
            $this->set_option(
                array(
                    'field_type'    => 'select',
                    'name'          => 'show_map_border',
                    'title'         => esc_html__( 'Show Map Border', 'obsius-core' ),
                    'options'       => obsius_core_get_select_type_options_pool( 'yes_no', false ),
                    'default_value' => 'yes',
                )
            );
            $this->set_option(
                array(
                    'field_type' => 'color',
                    'name'       => 'border_color',
                    'title'      => esc_html__( 'Border Color', 'obsius-core' ),
                    'dependency' => array(
                        'show' => array(
                            'show_map_border' => array(
                                'values'        => 'yes',
                                'default_value' => 'yes',
                            ),
                        ),
                    ),
                )
            );
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'obsius_core_google_map', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function load_assets() {
			wp_enqueue_script( 'google-map-api' );
			wp_enqueue_script( 'obsius-core-google-map' );
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$rand_number            = rand( 0, 1000 );
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['map_styles']     = $this->get_map_styles( $atts );
			$atts['rand_number']    = $rand_number;
			$atts['holder_id']      = 'qodef-map-id--' . $rand_number;
			$atts['map_data']       = $this->get_map_data( $atts );

			return obsius_core_get_template_part( 'shortcodes/google-map', 'templates/google-map', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-google-map';
            $holder_classes[] = ! empty( $atts['show_map_border'] ) ? 'qodef-show-map-border--' . $atts['show_map_border'] : '';

			return implode( ' ', $holder_classes );
		}

        private function get_map_styles( $atts ) {
            $styles = array();

            if ( ! empty( $atts['border_color'] ) ) {
                $styles[] = 'border-color: ' . $atts['border_color'];
            }

            return $styles;
        }

		private function get_map_data( $atts ) {
			$map_data = array();

			$addresses_array = array();
			if ( '' !== $atts['address1'] ) {
				array_push( $addresses_array, esc_attr( $atts['address1'] ) );
			}
			if ( '' !== $atts['address2'] ) {
				array_push( $addresses_array, esc_attr( $atts['address2'] ) );
			}
			if ( '' !== $atts['address3'] ) {
				array_push( $addresses_array, esc_attr( $atts['address3'] ) );
			}
			if ( '' !== $atts['address4'] ) {
				array_push( $addresses_array, esc_attr( $atts['address4'] ) );
			}

			if ( '' !== $atts['pin'] && is_array( wp_get_attachment_image_src( $atts['pin'] ) ) ) {
				$map_pin = wp_get_attachment_image_src( $atts['pin'], 'full', true );
				$map_pin = $map_pin[0];
			} else {
				$map_pin = OBSIUS_CORE_INC_URL_PATH . '/maps/assets/img/pin.png';
			}

			$map_data[] = "data-addresses='[\"" . implode( '","', $addresses_array ) . "\"]'";
			$map_data[] = 'data-pin=' . $map_pin;
			$map_data[] = 'data-unique-id=' . $atts['rand_number'];
			$map_data[] = 'data-height=' . $atts['map_height'];

			return implode( ' ', $map_data );
		}
	}
}
