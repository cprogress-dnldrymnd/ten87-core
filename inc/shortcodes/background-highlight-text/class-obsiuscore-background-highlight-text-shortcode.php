<?php

if ( ! function_exists( 'obsius_core_add_background_highlight_text_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function obsius_core_add_background_highlight_text_shortcode( $shortcodes ) {
		$shortcodes[] = 'ObsiusCore_Background_Highlight_Text_Shortcode';

		return $shortcodes;
	}

	add_filter( 'obsius_core_filter_register_shortcodes', 'obsius_core_add_background_highlight_text_shortcode' );
}

if ( class_exists( 'ObsiusCore_Shortcode' ) ) {
	class ObsiusCore_Background_Highlight_Text_Shortcode extends ObsiusCore_Shortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( OBSIUS_CORE_SHORTCODES_URL_PATH . '/background-highlight-text' );
			$this->set_base( 'obsius_core_background_highlight_text' );
			$this->set_name( esc_html__( 'Background Highlight Text', 'obsius-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds background highlight text element', 'obsius-core' ) );
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
			$this->set_option(
				array(
					'field_type'    => 'textarea',
					'name'          => 'title',
					'title'         => esc_html__( 'Text', 'obsius-core' ),
                    'default_value' => esc_html__( 'nostrud exercitation Eullamco laboris nisi ut aliquip ea commodore Cons quat estate', 'obsius-core' ),
				)
			);
            $this->set_option(
                array(
                    'field_type'    => 'select',
                    'name'          => 'text_font_size',
                    'title'         => esc_html__( 'Text Font Size', 'obsius-core' ),
                    'options'       => array(
                        'default'   => esc_html__( 'Default', 'obsius-core' ),
                        'big'       => esc_html__( 'Big', 'obsius-core' ),
                    ),
                    'default_value' => 'default',
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
                    'field_type' => 'text',
                    'name'       => 'link',
                    'title'      => esc_html__( 'Text Custom Link', 'obsius-core' ),
                    'group'      => esc_html__( 'Text Style', 'obsius-core' ),
                )
            );
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'line_break_positions',
					'title'       => esc_html__( 'Positions of Line Break', 'obsius-core' ),
					'description' => esc_html__( 'Enter the positions of the words after which you would like to create a line break. Separate the positions with commas (e.g. if you would like the first, third, and fourth word to have a line break, you would enter "1,3,4")', 'obsius-core' ),
					'group'       => esc_html__( 'Text Style', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'disable_title_break_words',
					'title'         => esc_html__( 'Disable Text Line Break', 'obsius-core' ),
					'description'   => esc_html__( 'Enabling this option will disable text line breaks for screen size 1024 and lower', 'obsius-core' ),
					'options'       => obsius_core_get_select_type_options_pool( 'no_yes', false ),
					'default_value' => 'no',
					'group'         => esc_html__( 'Text Style', 'obsius-core' ),
				)
			);
            $this->set_option(
                array(
                    'field_type'  => 'text',
                    'name'        => 'highlight_position',
                    'title'       => esc_html__( 'Highlight Text Position', 'obsius-core' ),
                    'description' => esc_html__( 'Enter the positions of the words you would like to display as "highlight" text. Separate start and end positions with commas (e.g. if you would like to wrap from fifth to ninth words, you would enter "5,9") or if you want to highlight whole text fill -1', 'obsius-core' ),
                    'group'       => esc_html__( 'Text Style', 'obsius-core' ),
                )
            );
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'title_color',
					'title'      => esc_html__( 'Text Color', 'obsius-core' ),
					'group'      => esc_html__( 'Text Style', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'target',
					'title'         => esc_html__( 'Custom Link Target', 'obsius-core' ),
					'options'       => obsius_core_get_select_type_options_pool( 'link_target' ),
					'default_value' => '_self',
					'group'         => esc_html__( 'Text Style', 'obsius-core' ),
				)
			);
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes']      = $this->get_holder_classes( $atts );
			$atts['title']               = $this->get_modified_title( $atts );
			$atts['title_styles']        = $this->get_title_styles( $atts );

			return obsius_core_get_template_part( 'shortcodes/background-highlight-text', 'templates/background-highlight-text', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-background-highlight-text';
			$holder_classes[] = 'yes' === $atts['disable_title_break_words'] ? 'qodef-text-break--disabled' : '';
			$holder_classes[] = ! empty( $atts['text_font_size'] ) ? 'qodef-text-font-size--' . $atts['text_font_size'] : '';
            $holder_classes[] = ! empty( $atts['content_alignment'] ) ? 'qodef-alignment--' . $atts['content_alignment'] : 'qodef-alignment--center';

			return implode( ' ', $holder_classes );
		}

        private function get_modified_title( $atts ) {
            $text               = $atts['title'];
            $text_after_prefix  = '<span class="qodef-m-text">';
            $text_before_suffix = '</span>';

            if ( ! empty( $text ) && ! empty( $atts['highlight_position'] ) ) {

                if ( ! empty( $atts['show_arrow_after_highlight_text'] ) && 'yes' === $atts['show_arrow_after_highlight_text'] ) {
                    $text_arrow = obsius_core_get_svg_icon( 'highlight-arrow' );
                } else {
                    $text_arrow = '';
                }

                $highlight_position = $atts['highlight_position'];
                $text_prefix        = '<span class="qodef-highlight-text">' . $text_after_prefix;
                $text_suffix        = $text_before_suffix . '<span class="qodef-svg-rounding-holder">' .  obsius_core_get_svg_icon('rounding') . '</span></span>' . $text_arrow;
                $text_break         = '<br>';

                if ( '-1' === $highlight_position ) {

                    if ( ! empty( $atts['line_break_positions'] ) ) {
                        $split_title          = explode( ' ', $text );
                        $line_break_positions = explode( ',', str_replace( ' ', '', $atts['line_break_positions'] ) );

                        foreach ( $line_break_positions as $position ) {
                            $position = intval( $position );
                            if ( isset( $split_title[ $position - 1 ] ) && ! empty( $split_title[ $position - 1 ] ) ) {
                                $split_title[ $position - 1 ] = $split_title[ $position - 1 ] . $text_break;
                            }
                        }

                        $text = implode( ' ', $split_title );
                    }

                    $text = $text_prefix . $text . $text_suffix;
                } else {
                    $split_text           = explode( ' ', $text );
                    $highlight_position   = explode( ',', str_replace( ' ', '', $atts['highlight_position'] ) );
                    $line_break_positions = explode( ',', str_replace( ' ', '', $atts['line_break_positions'] ) );
                    $positions            = array_filter(
                        array(
                            'start' => isset( $highlight_position[0] ) ? $highlight_position[0] : '',
                            'end'   => isset( $highlight_position[1] ) ? $highlight_position[1] : '',
                        )
                    );
                    $positions            = array_merge( $positions, $line_break_positions );
                    asort( $positions );

                    if ( ! empty( $positions ) ) {
                        foreach ( $positions as $key => $value ) {
                            $text_prefix_html = 'start' === $key ? $text_prefix : '';
                            $text_suffix_html = 'end' === $key ? $text_suffix : '';
                            $text_break_html  = in_array( $value, $line_break_positions, true ) && 'start' !== $key && 'end' !== $key ? $text_break : '';

                            if ( isset( $split_text[ intval( $value ) - 1 ] ) && ! empty( $split_text[ intval( $value ) - 1 ] ) ) {
                                $split_text[ $value - 1 ] = $text_prefix_html . $split_text[ $value - 1 ] . $text_suffix_html . $text_break_html;
                            }
                        }

                        $text = implode( ' ', $split_text );
                    }
                }
            } else {
                $text_break = '<br>';
                if ( ! empty( $atts['line_break_positions'] ) ) {
                    $split_title          = explode( ' ', $text );
                    $line_break_positions = explode( ',', str_replace( ' ', '', $atts['line_break_positions'] ) );

                    foreach ( $line_break_positions as $position ) {
                        $position = intval( $position );
                        if ( isset( $split_title[ $position - 1 ] ) && ! empty( $split_title[ $position - 1 ] ) ) {
                            $split_title[ $position - 1 ] = $split_title[ $position - 1 ] . $text_break;
                        }
                    }

                    $text = implode( ' ', $split_title );
                }
            }

            return $text;
        }

		private function get_title_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['title_color'] ) ) {
				$styles[] = 'color: ' . $atts['title_color'];
			}

			return $styles;
		}
	}
}
