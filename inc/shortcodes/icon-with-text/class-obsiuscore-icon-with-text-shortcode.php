<?php

if ( ! function_exists( 'obsius_core_add_icon_with_text_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function obsius_core_add_icon_with_text_shortcode( $shortcodes ) {
		$shortcodes[] = 'ObsiusCore_Icon_With_Text_Shortcode';

		return $shortcodes;
	}

	add_filter( 'obsius_core_filter_register_shortcodes', 'obsius_core_add_icon_with_text_shortcode' );
}

if ( class_exists( 'ObsiusCore_Shortcode' ) ) {
	class ObsiusCore_Icon_With_Text_Shortcode extends ObsiusCore_Shortcode {

		public function __construct() {
			$this->set_layouts( apply_filters( 'obsius_core_filter_icon_with_text_layouts', array() ) );

			$options_map   = obsius_core_get_variations_options_map( $this->get_layouts() );
			$default_value = $options_map['default_value'];

			$this->set_extra_options( apply_filters( 'obsius_core_filter_icon_with_text_extra_options', array(), $default_value ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( OBSIUS_CORE_SHORTCODES_URL_PATH . '/icon-with-text' );
			$this->set_base( 'obsius_core_icon_with_text' );
			$this->set_name( esc_html__( 'Icon With Text', 'obsius-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds icon with text element', 'obsius-core' ) );
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
					'field_type'    => 'text',
					'name'          => 'link',
					'title'         => esc_html__( 'Link', 'obsius-core' ),
					'default_value' => '',
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'target',
					'title'         => esc_html__( 'Link Target', 'obsius-core' ),
					'options'       => obsius_core_get_select_type_options_pool( 'link_target' ),
					'default_value' => '_self',
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'icon_type',
					'title'         => esc_html__( 'Icon Type', 'obsius-core' ),
					'description'   => esc_html__( 'Choose icon type (Note that Glow Icon only work for Top layout).', 'obsius-core' ),
					'options'       => array(
						'icon-pack'     => esc_html__( 'Icon Pack', 'obsius-core' ),
						'custom-icon'   => esc_html__( 'Custom Icon', 'obsius-core' ),
						'glow-icon'     => esc_html__( 'Glow Icon', 'madelyn-core' ),
						'asterisk-icon' => esc_html__( 'Asterisk Icon', 'madelyn-core' ),
					),
					'default_value' => 'icon-pack',
					'group'         => esc_html__( 'Icon', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'image',
					'name'       => 'custom_icon',
					'title'      => esc_html__( 'Custom Icon', 'obsius-core' ),
					'group'      => esc_html__( 'Icon', 'obsius-core' ),
					'dependency' => array(
						'show' => array(
							'icon_type' => array(
								'values'        => 'custom-icon',
								'default_value' => 'icon-pack',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'retina_scaling',
					'title'         => esc_html__( 'Enable Retina Scaling', 'obsius-core' ),
					'description'   => esc_html__( 'Image uploaded should be two times the height.', 'obsius-core' ),
					'options'       => obsius_core_get_select_type_options_pool( 'no_yes', false ),
					'default_value' => 'no',
					'group'         => esc_html__( 'Icon', 'obsius-core' ),
					'dependency'    => array(
						'show' => array(
							'icon_type' => array(
								'values'        => 'custom-icon',
								'default_value' => 'icon-pack',
							),
						),
					),
				)
			);
			$this->import_shortcode_options(
				array(
					'shortcode_base'    => 'obsius_core_icon',
					'exclude'           => array( 'custom_class', 'link', 'target', 'margin' ),
					'additional_params' => array(
						'nested_group' => esc_html__( 'Icon', 'obsius-core' ),
						'dependency'   => array(
							'show' => array(
								'icon_type' => array(
									'values'        => 'icon-pack',
									'default_value' => 'icon-pack',
								),
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'glow_shape',
					'title'         => esc_html__( 'Glow Shape', 'obsius-core' ),
					'options'       => array(
						'shape-one'   => esc_html__( 'Shape One', 'obsius-core' ),
						'shape-two'   => esc_html__( 'Shape Two', 'obsius-core' ),
						'shape-three' => esc_html__( 'Shape Three', 'obsius-core' ),
						'shape-four'  => esc_html__( 'Shape Four', 'obsius-core' ),
					),
					'default_value' => 'shape-one',
					'group'         => esc_html__( 'Icon', 'obsius-core' ),
					'dependency'    => array(
						'show' => array(
							'icon_type' => array(
								'values'        => 'glow-icon',
								'default_value' => 'icon-pack',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'glow_shape_animation',
					'title'         => esc_html__( 'Glow Shape Animations', 'obsius-core' ),
					'options'       => obsius_core_get_select_type_options_pool( 'yes_no', false ),
					'default_value' => 'no',
					'group'         => esc_html__( 'Icon', 'obsius-core' ),
					'dependency'    => array(
						'show' => array(
							'icon_type' => array(
								'values'        => 'glow-icon',
								'default_value' => 'icon-pack',
							),
						),
					),
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
					'field_type'    => 'select',
					'name'          => 'title_tag',
					'title'         => esc_html__( 'Title Tag', 'obsius-core' ),
					'options'       => obsius_core_get_select_type_options_pool( 'title_tag' ),
					'default_value' => 'h3',
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
					'name'       => 'title_margin_top',
					'title'      => esc_html__( 'Title Margin Top', 'obsius-core' ),
					'group'      => esc_html__( 'Title Style', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'textarea',
					'name'          => 'text',
					'title'         => esc_html__( 'Text', 'obsius-core' ),
					'default_value' => esc_html__( 'Contrary to popular belief, Lorem Ipsum is not simply random text.', 'obsius-core' ),
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
					'name'       => 'text_max_width',
					'title'      => esc_html__( 'Text Max Width', 'obsius-core' ),
					'group'      => esc_html__( 'Text Style', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'text',
					'name'          => 'button_text',
					'title'         => esc_html__( 'Button Text', 'obsius-core' ),
					'default_value' => esc_html__( 'Explore', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'button_link',
					'title'      => esc_html__( 'Button Link', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'button_target',
					'title'         => esc_html__( 'Button Link Target', 'obsius-core' ),
					'options'       => obsius_core_get_select_type_options_pool( 'link_target' ),
					'default_value' => '_self',
				)
			);
			$this->map_extra_options();
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes']    = $this->get_holder_classes( $atts );
			$atts['image_styles']      = $this->get_image_styles( $atts );
			$atts['title_styles']      = $this->get_title_styles( $atts );
			$atts['text_styles']       = $this->get_text_styles( $atts );
			$atts['after_text_styles'] = $this->get_after_text_styles( $atts );
			$atts['icon_params']       = $this->generate_icon_params( $atts );

			return obsius_core_get_template_part( 'shortcodes/icon-with-text', 'variations/' . $atts['layout'] . '/templates/' . $atts['layout'], '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-icon-with-text';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
			$holder_classes[] = ! empty( $atts['icon_type'] ) ? 'qodef--' . $atts['icon_type'] : '';
			$holder_classes[] = ! empty( $atts['glow_shape'] ) ? 'qodef--glow-' . $atts['glow_shape'] : '';
			$holder_classes[] = ! empty( $atts['glow_shape_animation'] ) ? 'qodef-glow-shape-animation--' . $atts['glow_shape_animation'] : '';
			$holder_classes[] = ( 'yes' === $atts['retina_scaling'] ) ? 'qodef--retina' : '';

			$holder_classes = apply_filters( 'obsius_core_filter_icon_with_text_variation_classes', $holder_classes, $atts );

			return implode( ' ', $holder_classes );
		}

		private function get_image_styles( $atts ) {
			$styles = array();

			if ( 'yes' === $atts['retina_scaling'] && ! empty( $atts['custom_icon'] ) ) {
				$image_meta = wp_get_attachment_metadata( $atts['custom_icon'] );

				if ( ! empty( $image_meta['width'] ) ) {
					$styles[] = 'width: ' . round( $image_meta['width'] / 2 ) . 'px';
				}
			}

			return $styles;
		}

		private function get_title_styles( $atts ) {
			$styles = array();

			if ( '' !== $atts['title_margin_top'] ) {
				if ( qode_framework_string_ends_with_space_units( $atts['title_margin_top'] ) ) {
					$styles[] = 'margin-top: ' . $atts['title_margin_top'];
				} else {
					$styles[] = 'margin-top: ' . intval( $atts['title_margin_top'] ) . 'px';
				}
			}

			if ( ! empty( $atts['title_color'] ) ) {
				$styles[] = 'color: ' . $atts['title_color'];
			}

			return $styles;
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

			if ( ! empty( $atts['text_color'] ) ) {
				$styles[] = 'color: ' . $atts['text_color'];
			}

			return $styles;
		}

		private function get_after_text_styles( $atts ) {
			$styles = array();

			//text max width
			if ( '' !== $atts['text_max_width'] ) {
				if ( qode_framework_string_ends_with_space_units( $atts['text_max_width'] ) ) {
					$styles[] = 'max-width: ' . $atts['text_max_width'];
				} else {
					$styles[] = 'max-width: ' . intval( $atts['text_max_width'] ) . 'px';
				}
			}

			return $styles;
		}

		private function generate_icon_params( $atts ) {
			$params = $this->populate_imported_shortcode_atts(
				array(
					'shortcode_base' => 'obsius_core_icon',
					'exclude'        => array( 'custom_class', 'link', 'target', 'margin' ),
					'atts'           => $atts,
				)
			);

			return $params;
		}
	}
}
