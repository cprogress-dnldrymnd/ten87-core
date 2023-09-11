<?php

if ( ! function_exists( 'obsius_core_add_section_title_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function obsius_core_add_section_title_shortcode( $shortcodes ) {
		$shortcodes[] = 'ObsiusCore_Section_Title_Shortcode';

		return $shortcodes;
	}

	add_filter( 'obsius_core_filter_register_shortcodes', 'obsius_core_add_section_title_shortcode' );
}

if ( class_exists( 'ObsiusCore_Shortcode' ) ) {
	class ObsiusCore_Section_Title_Shortcode extends ObsiusCore_Shortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( OBSIUS_CORE_SHORTCODES_URL_PATH . '/section-title' );
			$this->set_base( 'obsius_core_section_title' );
			$this->set_name( esc_html__( 'Section Title', 'obsius-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds section title element', 'obsius-core' ) );
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'custom_class',
					'title'      => esc_html__( 'Custom Class', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'text',
					'name'          => 'title',
					'title'         => esc_html__( 'Title', 'obsius-core' ),
					'default_value' => esc_html__( 'Title Text', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'line_break_positions',
					'title'       => esc_html__( 'Positions of Line Break', 'obsius-core' ),
					'description' => esc_html__( 'Enter the positions of the words after which you would like to create a line break. Separate the positions with commas (e.g. if you would like the first, third, and fourth word to have a line break, you would enter "1,3,4")', 'obsius-core' ),
					'group'       => esc_html__( 'Title Style', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'disable_title_break_words',
					'title'         => esc_html__( 'Disable Title Line Break', 'obsius-core' ),
					'description'   => esc_html__( 'Enabling this option will disable title line breaks for screen size 1024 and lower', 'obsius-core' ),
					'options'       => obsius_core_get_select_type_options_pool( 'no_yes', false ),
					'default_value' => 'no',
					'group'         => esc_html__( 'Title Style', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'title_tag',
					'title'         => esc_html__( 'Title Tag', 'obsius-core' ),
					'options'       => obsius_core_get_select_type_options_pool( 'title_tag' ),
					'default_value' => 'h2',
					'group'         => esc_html__( 'Title Style', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'title_color',
					'title'      => esc_html__( 'Title Color', 'obsius-core' ),
					'group'      => esc_html__( 'Title Style', 'obsius-core' ),
				)
			);
            $this->set_option(
                array(
                    'field_type' => 'text',
                    'name'       => 'title_custom_font_size',
                    'title'      => esc_html__( 'Title Custom Font Size', 'obsius-core' ),
                    'group'      => esc_html__( 'Title Style', 'obsius-core' ),
                )
            );
            $this->set_option(
                array(
                    'field_type' => 'text',
                    'name'       => 'title_custom_line_height',
                    'title'      => esc_html__( 'Title Custom Line Height', 'obsius-core' ),
                    'group'      => esc_html__( 'Title Style', 'obsius-core' ),
                )
            );
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'link',
					'title'      => esc_html__( 'Title Custom Link', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'target',
					'title'         => esc_html__( 'Custom Link Target', 'obsius-core' ),
					'options'       => obsius_core_get_select_type_options_pool( 'link_target' ),
					'default_value' => '_self',
					'dependency'    => array(
						'show' => array(
							'image_action' => array(
								'values'        => 'custom-link',
								'default_value' => '',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'textarea',
					'name'          => 'subtitle_text',
					'title'         => esc_html__( 'Text', 'obsius-core' ),
					'default_value' => esc_html__( 'Contrary to popular belief, Lorem Ipsum is not simply random text.', 'obsius-core' ),
				)
			);
            $this->set_option(
                array(
                    'field_type'  => 'text',
                    'name'        => 'text_line_break_positions',
                    'title'       => esc_html__( 'Positions of Line Break', 'obsius-core' ),
                    'description' => esc_html__( 'Enter the positions of the words after which you would like to create a line break. Separate the positions with commas (e.g. if you would like the first, third, and fourth word to have a line break, you would enter "1,3,4")', 'obsius-core' ),
                    'group'       => esc_html__( 'Text Style', 'obsius-core' ),
                )
            );
            $this->set_option(
                array(
                    'field_type'    => 'select',
                    'name'          => 'disable_text_break_words',
                    'title'         => esc_html__( 'Disable Text Line Break', 'obsius-core' ),
                    'description'   => esc_html__( 'Enabling this option will disable text line breaks for screen size 1024 and lower', 'obsius-core' ),
                    'options'       => obsius_core_get_select_type_options_pool( 'no_yes', false ),
                    'default_value' => 'no',
                    'group'         => esc_html__( 'Text Style', 'obsius-core' ),
                )
            );
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'text_color',
					'title'      => esc_html__( 'Text Color', 'obsius-core' ),
					'group'      => esc_html__( 'Text Style', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'text_margin_top',
					'title'      => esc_html__( 'Text Margin Top', 'obsius-core' ),
					'group'      => esc_html__( 'Text Style', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'text_font_size',
					'title'      => esc_html__( 'Text Font Size', 'obsius-core' ),
					'group'      => esc_html__( 'Text Style', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'text_line_height',
					'title'      => esc_html__( 'Text Line Height', 'obsius-core' ),
					'group'      => esc_html__( 'Text Style', 'obsius-core' ),
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
            $this->import_shortcode_options(
                array(
                    'shortcode_base'    => 'obsius_core_button',
                    'exclude'           => array( 'custom_class' ),
                    'additional_params' => array(
                        'nested_group' => esc_html__( 'Button', 'obsius-core' ),
                    ),
                )
            );
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['title']          = $this->get_modified_title( $atts );
			$atts['title_styles']   = $this->get_title_styles( $atts );
            $atts['subtitle_text']  = $this->get_modified_text( $atts );
			$atts['text_styles']    = $this->get_text_styles( $atts );
            $atts['button_params']  = $this->generate_button_params( $atts );

			return obsius_core_get_template_part( 'shortcodes/section-title', 'templates/section-title', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-section-title';
			$holder_classes[] = ! empty( $atts['content_alignment'] ) ? 'qodef-alignment--' . $atts['content_alignment'] : 'qodef-alignment--left';
			$holder_classes[] = 'yes' === $atts['disable_title_break_words'] ? 'qodef-title-break--disabled' : '';
            $holder_classes[] = 'yes' === $atts['disable_text_break_words'] ? 'qodef-text-break--disabled' : '';

			return implode( ' ', $holder_classes );
		}

        private function generate_button_params( $atts ) {
            $params = $this->populate_imported_shortcode_atts(
                array(
                    'shortcode_base' => 'obsius_core_button',
                    'exclude'        => array( 'custom_class' ),
                    'atts'           => $atts,
                )
            );

            return $params;
        }

		private function get_modified_title( $atts ) {
			$title = $atts['title'];

			if ( ! empty( $title ) && ! empty( $atts['line_break_positions'] ) ) {
				$split_title          = explode( ' ', $title );
				$line_break_positions = explode( ',', str_replace( ' ', '', $atts['line_break_positions'] ) );

				foreach ( $line_break_positions as $position ) {
					$position = intval( $position );
					if ( isset( $split_title[ $position - 1 ] ) && ! empty( $split_title[ $position - 1 ] ) ) {
						$split_title[ $position - 1 ] = $split_title[ $position - 1 ] . '<br />';
					}
				}

				$title = implode( ' ', $split_title );
			}

			return $title;
		}

		private function get_title_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['title_color'] ) ) {
				$styles[] = 'color: ' . $atts['title_color'];
			}

            if ( ! empty( $atts['title_custom_font_size'] ) ) {
                if ( qode_framework_string_ends_with_typography_units( $atts['title_custom_font_size'] ) ) {
                    $styles[] = 'font-size: ' . $atts['title_custom_font_size'];
                } else {
                    $styles[] = 'font-size: ' . intval( $atts['title_custom_font_size'] ) . 'px';
                }
            }

            $line_height = $atts['title_custom_line_height'];
            if ( ! empty( $line_height ) ) {
                if ( qode_framework_string_ends_with_typography_units( $line_height ) ) {
                    $styles[] = 'line-height: ' . $line_height;
                } else {
                    $styles[] = 'line-height: ' . intval( $line_height ) . 'px';
                }
            }

			return $styles;
		}

        private function get_modified_text( $atts ) {
            $title = $atts['subtitle_text'];

            if ( ! empty( $title ) && ! empty( $atts['text_line_break_positions'] ) ) {
                $split_title          = explode( ' ', $title );
                $line_break_positions = explode( ',', str_replace( ' ', '', $atts['text_line_break_positions'] ) );

                foreach ( $line_break_positions as $position ) {
                    $position = intval( $position );
                    if ( isset( $split_title[ $position - 1 ] ) && ! empty( $split_title[ $position - 1 ] ) ) {
                        $split_title[ $position - 1 ] = $split_title[ $position - 1 ] . '<br />';
                    }
                }

                $title = implode( ' ', $split_title );
            }

            return $title;
        }

		private function get_text_styles( $atts ) {
			$styles = array();

			if ( '' !== $atts['text_margin_top'] ) {
				if ( qode_framework_string_ends_with_space_units( $atts['text_margin_top'] ) ) {
					$styles[] = 'margin-top: ' . $atts['text_margin_top'];
				} else {
					$styles[] = 'margin-top: ' . intval( $atts['text_margin_top'] ) . 'px';
				}
			}

			if ( ! empty( $atts['text_font_size'] ) ) {
				$styles[] = 'font-size: ' . $atts['text_font_size'];
			}


			if ( ! empty( $atts['text_line_height'] ) ) {
				$styles[] = 'line-height: ' . $atts['text_line_height'];
			}

			if ( ! empty( $atts['text_color'] ) ) {
				$styles[] = 'color: ' . $atts['text_color'];
			}

			return $styles;
		}
	}
}
