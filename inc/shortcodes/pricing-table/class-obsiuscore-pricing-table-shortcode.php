<?php

if ( ! function_exists( 'obsius_core_add_pricing_table_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function obsius_core_add_pricing_table_shortcode( $shortcodes ) {
		$shortcodes[] = 'ObsiusCore_Pricing_Table_Shortcode';

		return $shortcodes;
	}

	add_filter( 'obsius_core_filter_register_shortcodes', 'obsius_core_add_pricing_table_shortcode' );
}

if ( class_exists( 'ObsiusCore_Shortcode' ) ) {
	class ObsiusCore_Pricing_Table_Shortcode extends ObsiusCore_Shortcode {

		public function __construct() {
			$this->set_layouts( apply_filters( 'obsius_core_filter_pricing_table_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'obsius_core_filter_pricing_table_extra_options', array() ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( OBSIUS_CORE_SHORTCODES_URL_PATH . '/pricing-table' );
			$this->set_base( 'obsius_core_pricing_table' );
			$this->set_name( esc_html__( 'Pricing Table', 'obsius-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds pricing table element', 'obsius-core' ) );
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
					'name'          => 'featured_table',
					'title'         => esc_html__( 'Featured Table', 'obsius-core' ),
					'options'       => obsius_core_get_select_type_options_pool( 'no_yes' ),
					'default_value' => 'no',
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'table_background_color',
					'title'      => esc_html__( 'Background Color', 'obsius-core' ),
					'group'      => esc_html__( 'Content Style', 'obsius-core' ),
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
					'field_type' => 'color',
					'name'       => 'title_color',
					'title'      => esc_html__( 'Title Color', 'obsius-core' ),
					'group'      => esc_html__( 'Title Style', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'text',
					'name'          => 'price',
					'title'         => esc_html__( 'Price', 'obsius-core' ),
					'default_value' => esc_html__( '99', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'price_color',
					'title'      => esc_html__( 'Price Color', 'obsius-core' ),
					'group'      => esc_html__( 'Price Style', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'text',
					'name'          => 'currency',
					'title'         => esc_html__( 'Currency', 'obsius-core' ),
					'default_value' => esc_html__( '$', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'currency_color',
					'title'      => esc_html__( 'Currency Color', 'obsius-core' ),
					'group'      => esc_html__( 'Currency Style', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'html',
					'name'          => 'content',
					'title'         => esc_html__( 'Content', 'obsius-core' ),
					'default_value' => esc_html__( 'Contrary to popular belief, Lorem Ipsum is not simply random text.', 'obsius-core' ),
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
			$this->map_extra_options();
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes']  = $this->get_holder_classes( $atts );
			$atts['holder_styles']   = $this->get_holder_styles( $atts );
			$atts['title_styles']    = $this->get_title_styles( $atts );
			$atts['price_styles']    = $this->get_price_styles( $atts );
			$atts['currency_styles'] = $this->get_currency_styles( $atts );
			$atts['button_params']   = $this->generate_button_params( $atts );
			$atts['content']         = $this->get_editor_content( $content, $options );

			return obsius_core_get_template_part( 'shortcodes/pricing-table', 'variations/' . $atts['layout'] . '/templates/' . $atts['layout'], '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-pricing-table';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
			$holder_classes[] = ! empty( $atts['featured_table'] ) && 'yes' === $atts['featured_table'] ? 'qodef-status--featured' : 'qodef-status--regular';

			return implode( ' ', $holder_classes );
		}

		private function get_holder_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['table_background_color'] ) ) {
				$styles[] = 'background-color: ' . $atts['table_background_color'];
			}

			return $styles;
		}

		private function get_title_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['title_color'] ) ) {
				$styles[] = 'color: ' . $atts['title_color'];
			}

			return $styles;
		}

		private function get_price_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['price_color'] ) ) {
				$styles[] = 'color: ' . $atts['price_color'];
			}

			return $styles;
		}

		private function get_currency_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['currency_color'] ) ) {
				$styles[] = 'color: ' . $atts['currency_color'];
			}

			return $styles;
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
	}
}
