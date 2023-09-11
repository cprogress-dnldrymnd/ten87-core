<?php

if ( ! function_exists( 'obsius_core_add_fixed_indent_slider_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function obsius_core_add_fixed_indent_slider_shortcode( $shortcodes ) {
		$shortcodes[] = 'ObsiusCore_Fixed_Indent_Slider_Shortcode';

		return $shortcodes;
	}

	add_filter( 'obsius_core_filter_register_shortcodes', 'obsius_core_add_fixed_indent_slider_shortcode' );
}

if ( class_exists( 'ObsiusCore_Shortcode' ) ) {
	class ObsiusCore_Fixed_Indent_Slider_Shortcode extends ObsiusCore_Shortcode {

		public function __construct() {
			$this->set_layouts( apply_filters( 'obsius_core_filter_fixed_indent_slider_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'obsius_core_filter_fixed_indent_slider_extra_options', array() ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( OBSIUS_CORE_SHORTCODES_URL_PATH . '/fixed-indent-slider' );
			$this->set_base( 'obsius_core_fixed_indent_slider' );
			$this->set_name( esc_html__( 'Fixed Indent Slider', 'obsius-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds fixed indent slider element', 'obsius-core' ) );
			$this->set_scripts(
				array(
					'swiper'                 => array(
						'registered' => true,
					),
					'obsius-main-js' => array(
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
                    'field_type' => 'select',
                    'name'       => 'slider_position',
                    'title'      => esc_html__( 'Slider Position', 'obsius-core' ),
                    'options'    => array(
                        ''     => esc_html__( 'Default', 'obsius-core' ),
                        'left' => esc_html__( 'Left', 'obsius-core' ),
                    ),
                    'default_value' => '',
                )
            );
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'slider_loop',
					'title'      => esc_html__( 'Enable Slider Loop', 'obsius-core' ),
					'options'    => obsius_core_get_select_type_options_pool( 'yes_no' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'slider_scroll',
					'title'         => esc_html__( 'Enable Slider Scroll', 'obsius-core' ),
					'options'       => obsius_core_get_select_type_options_pool( 'yes_no', false ),
                    'default_value' => 'no',
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'slider_autoplay',
					'title'      => esc_html__( 'Enable Slider Autoplay', 'obsius-core' ),
					'options'    => obsius_core_get_select_type_options_pool( 'yes_no' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'slider_speed',
					'title'       => esc_html__( 'Slide Duration', 'obsius-core' ),
					'description' => esc_html__( 'Default value is 5000 (ms)', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'slider_speed_animation',
					'title'       => esc_html__( 'Slide Animation Duration', 'obsius-core' ),
					'description' => esc_html__( 'Speed of slide animation in milliseconds. Default value is 800.', 'obsius-core' ),
				)
			);
            $this->set_option(
                array(
                    'field_type'  => 'select',
                    'name'        => 'show_holder_top_border',
                    'title'       => esc_html__( 'Show Holder Top Border', 'obsius-core' ),
                    'options'     => obsius_core_get_select_type_options_pool( 'yes_no', false ),
                    'description' => esc_html__( 'Enabling this option will display top border for the element holder.', 'obsius-core' ),
                )
            );
            $this->set_option(
                array(
                    'field_type'  => 'select',
                    'name'        => 'show_holder_bottom_border',
                    'title'       => esc_html__( 'Show Holder Bottom Border', 'obsius-core' ),
                    'options'     => obsius_core_get_select_type_options_pool( 'yes_no', false ),
                    'description' => esc_html__( 'Enabling this option will display bottom border for the element holder.', 'obsius-core' ),
                )
            );
            $this->set_option(
                array(
                    'field_type'  => 'select',
                    'name'        => 'show_image_borders',
                    'title'       => esc_html__( 'Show Image Borders', 'obsius-core' ),
                    'options'     => obsius_core_get_select_type_options_pool( 'yes_no', false ),
                    'description' => esc_html__( 'Enabling this option will display borders around images.', 'obsius-core' ),
                )
            );
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'link_target',
					'title'         => esc_html__( 'Link Target', 'obsius-core' ),
					'options'       => obsius_core_get_select_type_options_pool( 'link_target' ),
					'default_value' => '_self',
				)
			);
			$this->set_option(
				array(
					'field_type' => 'repeater',
					'name'       => 'children',
					'title'      => esc_html__( 'Child elements', 'obsius-core' ),
					'items'      => array(
						array(
							'field_type'    => 'text',
							'name'          => 'item_link',
							'title'         => esc_html__( 'Link', 'obsius-core' ),
							'default_value' => '',
						),
						array(
							'field_type' => 'image',
							'name'       => 'item_image',
							'title'      => esc_html__( 'Image', 'obsius-core' ),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'info_title',
					'title'       => esc_html__( 'Info Title', 'obsius-core' ),
					'group'       => esc_html__( 'Info Content', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'line_break_positions',
					'title'       => esc_html__( 'Positions of Line Break', 'obsius-core' ),
					'description' => esc_html__( 'Enter the positions of the words after which you would like to create a line break. Separate the positions with commas (e.g. if you would like the first, third, and fourth word to have a line break, you would enter "1,3,4")', 'obsius-core' ),
					'group'       => esc_html__( 'Info Content', 'obsius-core' ),
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
					'group'         => esc_html__( 'Info Content', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'textarea',
					'name'        => 'info_text',
					'title'       => esc_html__( 'Info Text', 'obsius-core' ),
					'group'       => esc_html__( 'Info Content', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'button_link',
					'title'       => esc_html__( 'Button Link', 'obsius-core' ),
					'group'       => esc_html__( 'Info Content', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'button_target',
					'title'         => esc_html__( 'Button Target', 'obsius-core' ),
					'options'       => obsius_core_get_select_type_options_pool( 'link_target' ),
					'default_value' => '_self',
					'group'         => esc_html__( 'Info Content', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'button_text',
					'title'       => esc_html__( 'Info Text', 'obsius-core' ),
					'group'       => esc_html__( 'Info Content', 'obsius-core' ),
				)
			);
			$this->map_extra_options();
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes']       = $this->get_holder_classes( $atts );
			$atts['holder_outer_classes'] = $this->get_holder_outer_classes( $atts );
			$atts['info_title']           = $this->get_modified_info_title( $atts );
			$atts['slider_data']          = $this->get_slider_data( $atts );
            $atts['data_attrs']           = $this->get_slider_inner_data_attrs( $atts );
			$atts['items']                = $this->parse_repeater_items( $atts['children'] );
			$atts['this_shortcode']       = $this;

			return obsius_core_get_template_part( 'shortcodes/fixed-indent-slider', 'templates/fixed-indent-slider', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-fixed-indent-slider';
			$holder_classes[] = 'yes' === $atts['disable_title_break_words'] ? 'qodef-title-break--disabled' : '';
			$holder_classes[] = 'yes' === $atts['show_image_borders'] ? 'qodef-show-image-borders--yes' : '';

			return implode( ' ', $holder_classes );
		}

		private function get_holder_outer_classes( $atts ) {
			$holder_outer_classes   = $this->init_holder_classes();

			$holder_outer_classes[] = 'qodef-fixed-indent-slider-holder-outer';
            $holder_outer_classes[] = 'yes' === $atts['show_holder_top_border'] ? 'qodef-show-holder-top-border--yes' : '';
            $holder_outer_classes[] = 'yes' === $atts['show_holder_bottom_border'] ? 'qodef-show-holder-bottom-border--yes' : '';
            $holder_outer_classes[] = 'left' === $atts['slider_position'] ? 'qodef-slider--left' : '';

			return implode( ' ', $holder_outer_classes );
		}

		private function get_modified_info_title( $atts ) {
			$title = $atts['info_title'];

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

        private function get_slider_inner_data_attrs( $atts ) {
            $data = array();

            if ( ! empty( $atts['slider_position'] ) ) {
                $data['dir'] = 'rtl';
            }

            return $data;
        }

		private function get_slider_data( $atts ) {
			$data = array();

			$data['loop']           = isset( $atts['slider_loop'] ) ? 'no' !== $atts['slider_loop'] : true;
			$data['autoplay']       = isset( $atts['slider_autoplay'] ) ? 'no' !== $atts['slider_autoplay'] : true;
			$data['speed']          = isset( $atts['slider_speed'] ) ? $atts['slider_speed'] : '';
			$data['speedAnimation'] = isset( $atts['slider_speed_animation'] ) ? $atts['slider_speed_animation'] : '';
			$data['slideAnimation'] = isset( $atts['slider_slide_animation'] ) ? $atts['slider_slide_animation'] : '';
			$data['sliderScroll']   = isset( $atts['slider_scroll'] ) ? $atts['slider_scroll'] : '';

			return json_encode( $data );
		}
	}
}
