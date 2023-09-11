<?php

if ( ! function_exists( 'obsius_core_add_custom_font_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function obsius_core_add_custom_font_shortcode( $shortcodes ) {
		$shortcodes[] = 'ObsiusCore_Custom_Font_Shortcode';

		return $shortcodes;
	}

	add_filter( 'obsius_core_filter_register_shortcodes', 'obsius_core_add_custom_font_shortcode' );
}

if ( class_exists( 'ObsiusCore_Shortcode' ) ) {
	class ObsiusCore_Custom_Font_Shortcode extends ObsiusCore_Shortcode {

		public function __construct() {
			$this->set_layouts( apply_filters( 'obsius_core_filter_custom_font_layouts', array() ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( OBSIUS_CORE_SHORTCODES_URL_PATH . '/custom-font' );
			$this->set_base( 'obsius_core_custom_font' );
			$this->set_name( esc_html__( 'Custom Font', 'obsius-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays custom font with provided parameters', 'obsius-core' ) );

			$options_map = obsius_core_get_variations_options_map( $this->get_layouts() );

			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'layout',
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
					'field_type' => 'text',
					'name'       => 'custom_class',
					'title'      => esc_html__( 'Custom Class', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'textarea',
					'name'          => 'title',
					'title'         => esc_html__( 'Title Text', 'obsius-core' ),
					'default_value' => esc_html__( 'Custom Title Text', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'text',
					'name'          => 'superscript_text',
					'title'         => esc_html__( 'Superscript Text', 'obsius-core' ),
					'description'   => esc_html__( 'Enter superscript text that will positioned at the end of the title.', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'title_tag',
					'title'         => esc_html__( 'Title Tag', 'obsius-core' ),
					'options'       => obsius_core_get_select_type_options_pool( 'title_tag' ),
					'default_value' => 'h1',
					'group'         => esc_html__( 'Style', 'obsius-core' ),
				)
			);
            $this->set_option(
                array(
                    'field_type' => 'select',
                    'name'       => 'content_alignment',
                    'title'      => esc_html__( 'Content Alignment', 'obsius-core' ),
                    'options'    => array(
                        ''       => esc_html__( 'Default', 'obsius-core' ),
                        'left'   => esc_html__( 'Left', 'obsius-core' ),
                        'center' => esc_html__( 'Center', 'obsius-core' ),
                        'right'  => esc_html__( 'Right', 'obsius-core' ),
                    ),
                )
            );
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'color',
					'title'      => esc_html__( 'Color', 'obsius-core' ),
					'group'      => esc_html__( 'Style', 'obsius-core' ),
				)
			);
            $this->set_option( array(
                'field_type'  => 'text',
                'name'        => 'title_bold_words',
                'title'       => esc_html__( 'Bold Words', 'obsius-core' ),
                'description' => esc_html__( 'Enter the positions of the words you would like to bold. Separate the positions with commas (e.g. if you would like the first, third and fourth word to have bold style, you would enter "1,3-4"). *Note that some fonts may don\'t have bold variant', 'obsius-core' ),
                'group'       => esc_html__( 'Style', 'obsius-core' )
            ) );
            $this->set_option(
                array(
                    'field_type' => 'select',
                    'name'       => 'title_bold_words_font_wight',
                    'title'      => esc_html__( 'Bold Words Font Weight', 'obsius-core' ),
                    'options'    => obsius_core_get_select_type_options_pool( 'font_weight' ),
                    'group'      => esc_html__( 'Style', 'obsius-core' ),
                )
            );
            $this->set_option( array(
                'field_type'    => 'select',
                'name'          => 'title_bold_words_reduce_right_space',
                'title'         => esc_html__( 'Bold Words Reduce Right Space', 'obsius-core' ),
                'description'   => esc_html__( 'Enabling this option right space after bold worlds will be neglected.', 'obsius-core' ),
                'options'       => obsius_core_get_select_type_options_pool( 'no_yes', false ),
                'default_value' => 'no',
                'group'         => esc_html__( 'Style', 'obsius-core' )
            ) );
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'font_family',
					'title'      => esc_html__( 'Font Family', 'obsius-core' ),
					'group'      => esc_html__( 'Style', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'font_size',
					'title'      => esc_html__( 'Font Size', 'obsius-core' ),
					'group'      => esc_html__( 'Style', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'line_height',
					'title'      => esc_html__( 'Line Height', 'obsius-core' ),
					'group'      => esc_html__( 'Style', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'letter_spacing',
					'title'      => esc_html__( 'Letter Spacing', 'obsius-core' ),
					'group'      => esc_html__( 'Style', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'font_weight',
					'title'      => esc_html__( 'Font Weight', 'obsius-core' ),
					'options'    => obsius_core_get_select_type_options_pool( 'font_weight' ),
					'group'      => esc_html__( 'Style', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'font_style',
					'title'      => esc_html__( 'Font Style', 'obsius-core' ),
					'options'    => obsius_core_get_select_type_options_pool( 'font_style' ),
					'group'      => esc_html__( 'Style', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'text_transform',
					'title'      => esc_html__( 'Text Transform', 'obsius-core' ),
					'options'    => obsius_core_get_select_type_options_pool( 'text_transform' ),
					'group'      => esc_html__( 'Style', 'obsius-core' ),
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
					'field_type'  => 'text',
					'name'        => 'font_size_1440',
					'title'       => esc_html__( 'Font Size', 'obsius-core' ),
					'description' => esc_html__( 'Set responsive style value for screen size 1440', 'obsius-core' ),
					'group'       => esc_html__( 'Screen Size 1440 Style', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'line_height_1440',
					'title'       => esc_html__( 'Line Height', 'obsius-core' ),
					'description' => esc_html__( 'Set responsive style value for screen size 1440', 'obsius-core' ),
					'group'       => esc_html__( 'Screen Size 1440 Style', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'letter_spacing_1440',
					'title'       => esc_html__( 'Letter Spacing', 'obsius-core' ),
					'description' => esc_html__( 'Set responsive style value for screen size 1440', 'obsius-core' ),
					'group'       => esc_html__( 'Screen Size 1440 Style', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'font_size_1366',
					'title'       => esc_html__( 'Font Size', 'obsius-core' ),
					'description' => esc_html__( 'Set responsive style value for screen size 1366', 'obsius-core' ),
					'group'       => esc_html__( 'Screen Size 1366 Style', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'line_height_1366',
					'title'       => esc_html__( 'Line Height', 'obsius-core' ),
					'description' => esc_html__( 'Set responsive style value for screen size 1366', 'obsius-core' ),
					'group'       => esc_html__( 'Screen Size 1366 Style', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'letter_spacing_1366',
					'title'       => esc_html__( 'Letter Spacing', 'obsius-core' ),
					'description' => esc_html__( 'Set responsive style value for screen size 1366', 'obsius-core' ),
					'group'       => esc_html__( 'Screen Size 1366 Style', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'font_size_1024',
					'title'       => esc_html__( 'Font Size', 'obsius-core' ),
					'description' => esc_html__( 'Set responsive style value for screen size 1024', 'obsius-core' ),
					'group'       => esc_html__( 'Screen Size 1024 Style', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'line_height_1024',
					'title'       => esc_html__( 'Line Height', 'obsius-core' ),
					'description' => esc_html__( 'Set responsive style value for screen size 1024', 'obsius-core' ),
					'group'       => esc_html__( 'Screen Size 1024 Style', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'letter_spacing_1024',
					'title'       => esc_html__( 'Letter Spacing', 'obsius-core' ),
					'description' => esc_html__( 'Set responsive style value for screen size 1024', 'obsius-core' ),
					'group'       => esc_html__( 'Screen Size 1024 Style', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'font_size_768',
					'title'       => esc_html__( 'Font Size', 'obsius-core' ),
					'description' => esc_html__( 'Set responsive style value for screen size 768', 'obsius-core' ),
					'group'       => esc_html__( 'Screen Size 768 Style', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'line_height_768',
					'title'       => esc_html__( 'Line Height', 'obsius-core' ),
					'description' => esc_html__( 'Set responsive style value for screen size 768', 'obsius-core' ),
					'group'       => esc_html__( 'Screen Size 768 Style', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'letter_spacing_768',
					'title'       => esc_html__( 'Letter Spacing', 'obsius-core' ),
					'description' => esc_html__( 'Set responsive style value for screen size 768', 'obsius-core' ),
					'group'       => esc_html__( 'Screen Size 768 Style', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'font_size_680',
					'title'       => esc_html__( 'Font Size', 'obsius-core' ),
					'description' => esc_html__( 'Set responsive style value for screen size 680', 'obsius-core' ),
					'group'       => esc_html__( 'Screen Size 680 Style', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'line_height_680',
					'title'       => esc_html__( 'Line Height', 'obsius-core' ),
					'description' => esc_html__( 'Set responsive style value for screen size 680', 'obsius-core' ),
					'group'       => esc_html__( 'Screen Size 680 Style', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'letter_spacing_680',
					'title'       => esc_html__( 'Letter Spacing', 'obsius-core' ),
					'description' => esc_html__( 'Set responsive style value for screen size 680', 'obsius-core' ),
					'group'       => esc_html__( 'Screen Size 680 Style', 'obsius-core' ),
				)
			);
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'obsius_core_custom_font', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['unique_class']   = 'qodef-custom-font-' . rand( 0, 1000 );
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['holder_styles']  = $this->get_holder_styles( $atts );
            $atts['title']          = $this->get_modified_title( $atts );

			$this->set_responsive_styles( $atts );

			return obsius_core_get_template_part( 'shortcodes/custom-font', 'variations/' . $atts['layout'] . '/templates/custom-font', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-custom-font';
			$holder_classes[] = $atts['unique_class'];
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
            $holder_classes[] = ! empty( $atts['content_alignment'] ) ? 'qodef-alignment--' . $atts['content_alignment'] : 'qodef-alignment--left';

			return implode( ' ', $holder_classes );
		}

		private function get_holder_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['color'] ) ) {
				$styles[] = 'color: ' . $atts['color'];
			}

			if ( ! empty( $atts['font_family'] ) ) {
				$styles[] = 'font-family: ' . $atts['font_family'];
			}

			$font_size = $atts['font_size'];
			if ( ! empty( $font_size ) ) {
				if ( qode_framework_string_ends_with_typography_units( $font_size ) ) {
					$styles[] = 'font-size: ' . $font_size;
				} else {
					$styles[] = 'font-size: ' . intval( $font_size ) . 'px';
				}
			}

			$line_height = $atts['line_height'];
			if ( ! empty( $line_height ) ) {
				if ( qode_framework_string_ends_with_typography_units( $line_height ) ) {
					$styles[] = 'line-height: ' . $line_height;
				} else {
					$styles[] = 'line-height: ' . intval( $line_height ) . 'px';
				}
			}

			$letter_spacing = $atts['letter_spacing'];
			if ( '' !== $letter_spacing ) {
				if ( qode_framework_string_ends_with_typography_units( $letter_spacing ) ) {
					$styles[] = 'letter-spacing: ' . $letter_spacing;
				} else {
					$styles[] = 'letter-spacing: ' . intval( $letter_spacing ) . 'px';
				}
			}

			if ( ! empty( $atts['font_weight'] ) ) {
				$styles[] = 'font-weight: ' . $atts['font_weight'];
			}

			if ( ! empty( $atts['font_style'] ) ) {
				$styles[] = 'font-style: ' . $atts['font_style'];
			}

			if ( ! empty( $atts['text_transform'] ) ) {
				$styles[] = 'text-transform: ' . $atts['text_transform'];
			}

			if ( '' !== $atts['margin'] ) {
				$styles[] = 'margin: ' . $atts['margin'];
			}

			return $styles;
		}

		private function set_responsive_styles( $atts ) {
			$unique_class = '.' . $atts['unique_class'];
			$screen_sizes = array( '1440', '1366', '1024', '768', '680' );
			$option_keys  = array( 'font_size', 'line_height', 'letter_spacing' );

			foreach ( $screen_sizes as $screen_size ) {
				$styles = array();

				foreach ( $option_keys as $option_key ) {
					$option_value = $atts[ $option_key . '_' . $screen_size ];
					$style_key    = str_replace( '_', '-', $option_key );

					if ( '' !== $option_value ) {
						if ( qode_framework_string_ends_with_typography_units( $option_value ) ) {
							$styles[ $style_key ] = $option_value . '!important';
						} else {
							$styles[ $style_key ] = intval( $option_value ) . 'px !important';
						}
					}
				}

				if ( ! empty( $styles ) ) {
					add_filter(
						'obsius_core_filter_add_responsive_' . $screen_size . '_inline_style_in_footer',
						function ( $style ) use ( $unique_class, $styles ) {
							$style .= qode_framework_dynamic_style( $unique_class, $styles );

							return $style;
						}
					);
				}
			}
		}

        private function get_modified_title( $atts ) {
            $title                  = $atts['title'];
            $superscript_text       = $atts['superscript_text'];
            $bold_words_styles      = $this->get_bold_words_styles( $atts );
            $title_bold_words       = explode( ',', $atts['title_bold_words'] );
            $split_title            = explode( ' ', $title );
            $reduce_right_space     = $atts['title_bold_words_reduce_right_space'];
            $bold_text_holder_class = 'qodef-m-bold';

            if ( ! empty( $atts['title_bold_words'] ) ) {

                if ( ! empty( $reduce_right_space ) && 'yes' === $reduce_right_space ) {
                    $bold_text_holder_class .= ' qodef-reduce-right-space';
                }

                foreach ( $title_bold_words as $value ) {

                    $new_value  = explode('-', $value);

                    if(count($new_value) === 1) {
                        $i = intval($new_value[0]);
                        if ( ! empty( $split_title[ $i - 1 ] ) ) {
                            $split_title[ $i - 1 ] = '<span class="' . esc_attr( $bold_text_holder_class ) . '" ' . qode_framework_get_inline_style( $bold_words_styles ) . '><span class="qodef-m-regular-style">' . $split_title[ $i - 1 ] . '</span><span class="qodef-m-bold-style">' . $split_title[ $i - 1 ] . '</span></span>';
                        }
                    } else if (count($new_value) === 2) {
                        $begin = intval($new_value[0]);
                        $end = intval($new_value[1]);

                        if ( ! empty( $split_title[ $begin - 1 ] ) && ! empty ($split_title [ $end - 1]) ) {
                            $split_title[ $begin - 1  ] = '<span class="' . esc_attr( $bold_text_holder_class ) . '"><span class="qodef-m-regular-style">' . $split_title[ $begin - 1 ] . '</span><span class="qodef-m-bold-style">' . $split_title[ $begin - 1 ] . '</span>';
                            $split_title[ $end - 1 ] .= '</span>';
                        }
                    }
                }
            }

            if ( ! empty( $superscript_text ) ) {

                $split_title_count = count( $split_title ) - 1; // -1 because it is starting from 0

                $split_title[ $split_title_count ] .= '<span class="qodef-sup">' . esc_html( $superscript_text ) . '</span>';

                $title = implode( ' ', $split_title );
            }

            return $title;
        }

        private function get_bold_words_styles( $atts ) {
            $styles = array();

            if ( ! empty( $atts['title_bold_words_font_wight'] ) ) {
                $styles[] = 'font-weight: ' . $atts['title_bold_words_font_wight'];
            }

            return $styles;
        }
	}
}
