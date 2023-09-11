<?php

if ( ! function_exists( 'obsius_core_add_instagram_list_shortcode' ) ) {
	/**
	 * Function that is adding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function obsius_core_add_instagram_list_shortcode( $shortcodes ) {
		if ( qode_framework_is_installed( 'instagram' ) ) {
			$shortcodes[] = 'ObsiusCore_Instagram_List_Shortcode';
		}

		return $shortcodes;
	}

	add_filter( 'obsius_core_filter_register_shortcodes', 'obsius_core_add_instagram_list_shortcode' );
}

if ( class_exists( 'ObsiusCore_Shortcode' ) ) {
	class ObsiusCore_Instagram_List_Shortcode extends ObsiusCore_Shortcode {
		public function map_shortcode() {
			$this->set_shortcode_path( OBSIUS_CORE_PLUGINS_URL_PATH . '/instagram/shortcodes/instagram-list' );
			$this->set_base( 'obsius_core_instagram_list' );
			$this->set_name( esc_html__( 'Instagram List', 'obsius-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays instagram list', 'obsius-core' ) );
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
					'name'       => 'photos_number',
					'title'      => esc_html__( 'Number of Photos', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'columns_number',
					'title'         => esc_html__( 'Number of Columns', 'obsius-core' ),
					'options'       => array(
						'1'  => esc_html__( 'One', 'obsius-core' ),
						'2'  => esc_html__( 'Two', 'obsius-core' ),
						'3'  => esc_html__( 'Three', 'obsius-core' ),
						'4'  => esc_html__( 'Four', 'obsius-core' ),
						'5'  => esc_html__( 'Five', 'obsius-core' ),
						'6'  => esc_html__( 'Six', 'obsius-core' ),
						'7'  => esc_html__( 'Seven', 'obsius-core' ),
						'8'  => esc_html__( 'Eight', 'obsius-core' ),
						'9'  => esc_html__( 'Nine', 'obsius-core' ),
						'10' => esc_html__( 'Ten', 'obsius-core' ),
					),
					'default_value' => '3',
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'space',
					'title'         => esc_html__( 'Padding Around Images', 'obsius-core' ),
					'options'       => obsius_core_get_select_type_options_pool( 'items_space' ),
					'default_value' => 'small',
				)
			);
            if ( ! qode_framework_is_installed( 'instagram6' ) ) {
                $this->set_option(
                    array(
                        'field_type' => 'select',
                        'name' => 'image_resolution',
                        'title' => esc_html__('Image Resolution', 'obsius-core'),
                        'options' => array(
                            'auto' => esc_html__('Auto-detect (recommended)', 'obsius-core'),
                            'thumb' => esc_html__('Thumbnail (150x150)', 'obsius-core'),
                            'medium' => esc_html__('Medium (306x306)', 'obsius-core'),
                            'full' => esc_html__('Full (640x640)', 'obsius-core'),
                        ),
                        'default_value' => 'auto',
                    )
                );
            }
			if ( ! class_exists( 'SB_Instagram_Feed_Pro' ) ) {
				$this->set_option(
					array(
						'field_type'    => 'select',
						'name'          => 'behavior',
						'title'         => esc_html__( 'List Appearance', 'obsius-core' ),
						'options'       => obsius_core_get_select_type_options_pool( 'list_behavior', false, array( 'masonry', 'justified-gallery' ) ),
						'default_value' => 'columns',
					)
				);
                $this->set_option(
                    array(
                        'field_type'    => 'select',
                        'name'          => 'columns_responsive',
                        'title'         => esc_html__( 'Columns Responsive', 'obsius-core' ),
                        'options'       => obsius_core_get_select_type_options_pool( 'columns_responsive' ),
                        'default_value' => 'predefined',
                        'dependency'    => array(
                            'hide' => array(
                                'behavior' => array(
                                    'values'        => 'justified-gallery',
                                    'default_value' => 'columns',
                                ),
                            ),
                        ),
                    )
                );
                $this->set_option(
                    array(
                        'field_type'    => 'select',
                        'name'          => 'columns_1440',
                        'title'         => esc_html__( 'Number of Columns 1367px - 1440px', 'obsius-core' ),
                        'options'       => obsius_core_get_select_type_options_pool( 'columns_number' ),
                        'default_value' => '3',
                        'dependency'    => array(
                            'show' => array(
                                'columns_responsive' => array(
                                    'values'        => 'custom',
                                    'default_value' => '3',
                                ),
                            ),
                        ),
                    )
                );
                $this->set_option(
                    array(
                        'field_type'    => 'select',
                        'name'          => 'columns_1366',
                        'title'         => esc_html__( 'Number of Columns 1025px - 1366px', 'obsius-core' ),
                        'options'       => obsius_core_get_select_type_options_pool( 'columns_number' ),
                        'default_value' => '3',
                        'dependency'    => array(
                            'show' => array(
                                'columns_responsive' => array(
                                    'values'        => 'custom',
                                    'default_value' => '3',
                                ),
                            ),
                        ),
                    )
                );
                $this->set_option(
                    array(
                        'field_type'    => 'select',
                        'name'          => 'columns_1024',
                        'title'         => esc_html__( 'Number of Columns 769px - 1024px', 'obsius-core' ),
                        'options'       => obsius_core_get_select_type_options_pool( 'columns_number' ),
                        'default_value' => '3',
                        'dependency'    => array(
                            'show' => array(
                                'columns_responsive' => array(
                                    'values'        => 'custom',
                                    'default_value' => '3',
                                ),
                            ),
                        ),
                    )
                );
                $this->set_option(
                    array(
                        'field_type'    => 'select',
                        'name'          => 'columns_768',
                        'title'         => esc_html__( 'Number of Columns 681px - 768px', 'obsius-core' ),
                        'options'       => obsius_core_get_select_type_options_pool( 'columns_number' ),
                        'default_value' => '3',
                        'dependency'    => array(
                            'show' => array(
                                'columns_responsive' => array(
                                    'values'        => 'custom',
                                    'default_value' => '3',
                                ),
                            ),
                        ),
                    )
                );
                $this->set_option(
                    array(
                        'field_type'    => 'select',
                        'name'          => 'columns_680',
                        'title'         => esc_html__( 'Number of Columns 481px - 680px', 'obsius-core' ),
                        'options'       => obsius_core_get_select_type_options_pool( 'columns_number' ),
                        'default_value' => '3',
                        'dependency'    => array(
                            'show' => array(
                                'columns_responsive' => array(
                                    'values'        => 'custom',
                                    'default_value' => '3',
                                ),
                            ),
                        ),
                    )
                );
                $this->set_option(
                    array(
                        'field_type'    => 'select',
                        'name'          => 'columns_480',
                        'title'         => esc_html__( 'Number of Columns 0 - 480px', 'obsius-core' ),
                        'options'       => obsius_core_get_select_type_options_pool( 'columns_number' ),
                        'default_value' => '3',
                        'dependency'    => array(
                            'show' => array(
                                'columns_responsive' => array(
                                    'values'        => 'custom',
                                    'default_value' => '3',
                                ),
                            ),
                        ),
                    )
                );
                $this->set_option(
                    array(
                        'field_type'    => 'text',
                        'name'          => 'profile_name',
                        'title'         => esc_html__( 'Profile Name', 'obsius-core' ),
                        'description'   => esc_html__( 'Enter profile name', 'obsius-core' ),
                        'default_value' => '',
                    )
                );
                $this->set_option(
                    array(
                        'field_type'    => 'text',
                        'name'          => 'profile_link',
                        'title'         => esc_html__( 'Profile Link', 'obsius-core' ),
                        'description'   => esc_html__( 'Enter profile link', 'obsius-core' ),
                        'default_value' => '',
                    )
                );
                $this->set_option(
                    array(
                        'field_type'    => 'select',
                        'name'          => 'title_tag',
                        'title'         => esc_html__( 'Profile Name Tag', 'obsius-core' ),
                        'options'       => obsius_core_get_select_type_options_pool( 'title_tag' ),
                        'default_value' => 'h2',
                    )
                );
			}
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'obsius_core_instagram_list', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function render( $options, $content = null ) {
			parent::render( $options );

			$atts = $this->get_atts();

			$atts['behavior']         = isset( $atts['behavior'] ) ? $atts['behavior'] : '';
			$atts['holder_classes']   = $this->get_holder_classes( $atts );
			$atts['instagram_params'] = $this->get_instagram_params( $atts );
			$atts['slider_attr']      = $this->get_slider_data( $atts );
            $atts['gallery_attr']     = $this->get_gallery_data( $atts );

			return obsius_core_get_template_part( 'plugins/instagram/shortcodes/instagram-list', 'templates/instagram-list', $atts['behavior'], $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-instagram-list';
			$holder_classes[] = ( 'columns' === $atts['behavior'] ) ? 'qodef-layout--columns qodef--no-bottom-space' : '';
			$holder_classes[] = ( 'slider' === $atts['behavior'] ) ? 'qodef-layout--slider' : '';
			$holder_classes[] = ! empty( $atts['space'] ) ? 'qodef-gutter--' . $atts['space'] : '';
			$holder_classes[] = ! empty( $atts['columns_number'] ) ? 'qodef-col-num--' . $atts['columns_number'] : '';

            if ( ! empty( $atts['columns_responsive'] ) && 'custom' === $atts['columns_responsive'] ) {
                $holder_classes[] = 'qodef-responsive--custom';
                $holder_classes[] = ! empty( $atts['columns_1440'] ) ? 'qodef-col-num--1440--' . $atts['columns_1440'] : 'qodef-col-num--1440--' . $atts['columns'];
                $holder_classes[] = ! empty( $atts['columns_1366'] ) ? 'qodef-col-num--1366--' . $atts['columns_1366'] : 'qodef-col-num--1366--' . $atts['columns'];
                $holder_classes[] = ! empty( $atts['columns_1024'] ) ? 'qodef-col-num--1024--' . $atts['columns_1024'] : 'qodef-col-num--1024--' . $atts['columns'];
                $holder_classes[] = ! empty( $atts['columns_768'] ) ? 'qodef-col-num--768--' . $atts['columns_768'] : 'qodef-col-num--768--' . $atts['columns'];
                $holder_classes[] = ! empty( $atts['columns_680'] ) ? 'qodef-col-num--680--' . $atts['columns_680'] : 'qodef-col-num--680--' . $atts['columns'];
                $holder_classes[] = ! empty( $atts['columns_480'] ) ? 'qodef-col-num--480--' . $atts['columns_480'] : 'qodef-col-num--480--' . $atts['columns'];
            } else {
                $holder_classes[] = 'qodef-responsive--predefined';
            }

			$holder_classes = array_merge( $holder_classes );

			return implode( ' ', $holder_classes );
		}

		private function get_instagram_params( $atts ) {
			$params = array();

			$params['num']              = isset( $atts['photos_number'] ) && ! empty( $atts['photos_number'] ) ? $atts['photos_number'] : 6;
			$params['cols']             = isset( $atts['columns_number'] ) && ! empty( $atts['columns_number'] ) ? $atts['columns_number'] : 3;
			$params['imagepadding']     = 0;
			$params['imagepaddingunit'] = 'px';
			$params['showheader']       = false;
			$params['showfollow']       = false;
			$params['showbutton']       = false;
			$params['imageres']         = isset( $atts['image_resolution'] ) && ! empty( $atts['image_resolution'] ) ? $atts['image_resolution'] : 'auto';

			if ( is_array( $params ) && count( $params ) ) {
				foreach ( $params as $key => $value ) {
					if ( '' !== $value ) {
						$params[] = $key . "='" . esc_attr( str_replace( ' ', '', $value ) ) . "'";
					}
				}
			}

			return implode( ' ', $params );
		}

		private function get_slider_data( $atts ) {
			$data = array();

			$data['slidesPerView'] = isset( $atts['columns_number'] ) ? $atts['columns_number'] : 4;
			$data['spaceBetween']  = isset( $atts['space'] ) ? ( obsius_core_get_space_value( $atts['space'] ) * 2 ) : 0; // double half space for slider

            if ( ! empty( $atts['columns_responsive'] ) && 'custom' === $atts['columns_responsive'] ) {
                $data['customStages']      = true;
                $data['slidesPerView1440'] = ! empty( $atts['columns_1440'] ) ? $atts['columns_1440'] : $atts['columns'];
                $data['slidesPerView1366'] = ! empty( $atts['columns_1366'] ) ? $atts['columns_1366'] : $atts['columns'];
                $data['slidesPerView1024'] = ! empty( $atts['columns_1024'] ) ? $atts['columns_1024'] : $atts['columns'];
                $data['slidesPerView768']  = ! empty( $atts['columns_768'] ) ? $atts['columns_768'] : $atts['columns'];
                $data['slidesPerView680']  = ! empty( $atts['columns_680'] ) ? $atts['columns_680'] : $atts['columns'];
                $data['slidesPerView480']  = ! empty( $atts['columns_480'] ) ? $atts['columns_480'] : $atts['columns'];
            }

			return json_encode( $data );
		}

        private function get_gallery_data( $atts ) {
            $data = array();

            if ( isset( $atts['photos_number'] ) && ! empty( $atts['photos_number'] ) ) {
                $data['data-num'] = $atts['photos_number'];
            }

            return $data;
        }
	}
}
