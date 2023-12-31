<?php

if ( ! function_exists( 'obsius_core_add_portfolio_category_list_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function obsius_core_add_portfolio_category_list_shortcode( $shortcodes ) {
		$shortcodes[] = 'ObsiusCore_Portfolio_Category_List_Shortcode';

		return $shortcodes;
	}

	add_filter( 'obsius_core_filter_register_shortcodes', 'obsius_core_add_portfolio_category_list_shortcode' );
}

if ( class_exists( 'ObsiusCore_List_Shortcode' ) ) {
	class ObsiusCore_Portfolio_Category_List_Shortcode extends ObsiusCore_List_Shortcode {

		public function __construct() {
			$this->set_layouts( apply_filters( 'obsius_core_filter_portfolio_category_list_layouts', array() ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( OBSIUS_CORE_CPT_URL_PATH . '/portfolio/shortcodes/portfolio-category-list' );
			$this->set_base( 'obsius_core_portfolio_category_list' );
			$this->set_name( esc_html__( 'Portfolio Category List', 'obsius-core' ) );
			$this->set_description( esc_html__( 'Shortcode that display list of category items', 'obsius-core' ) );
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'custom_class',
					'title'      => esc_html__( 'Custom Class', 'obsius-core' ),
				)
			);
			$this->map_list_options();
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'taxonomy',
					'title'      => esc_html__( 'Taxonomy', 'obsius-core' ),
					'options'    => qode_framework_get_framework_root()->get_custom_post_type_taxonomies( 'portfolio-item' ),
					'group'      => esc_html__( 'Query', 'obsius-core' ),
				)
			);
			$this->map_query_options( array( 'exclude_option' => array( 'additional_params' ) ) );
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'hide_empty',
					'title'      => esc_html__( 'Hide Empty', 'obsius-core' ),
					'options'    => obsius_core_get_select_type_options_pool( 'no_yes', false ),
					'group'      => esc_html__( 'Query', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'additional_params',
					'title'      => esc_html__( 'Additional Params', 'obsius-core' ),
					'options'    => array(
						''   => esc_html__( 'No', 'obsius-core' ),
						'id' => esc_html__( 'Taxonomy IDs', 'obsius-core' ),
					),
					'group'      => esc_html__( 'Query', 'obsius-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'taxonomy_ids',
					'title'       => esc_html__( 'Taxonomy IDs', 'obsius-core' ),
					'description' => esc_html__( 'Separate taxonomy IDs with commas', 'obsius-core' ),
					'group'       => esc_html__( 'Query', 'obsius-core' ),
					'dependency'  => array(
						'show' => array(
							'additional_params' => array(
								'values'        => 'id',
								'default_value' => '',
							),
						),
					),
				)
			);
			$this->map_layout_options( array( 'layouts' => $this->get_layouts() ) );
		}

		public function render( $options, $content = null ) {
			parent::render( $options );

			$atts = $this->get_atts();

			$atts['taxonomy_items'] = get_terms( obsius_core_get_custom_post_type_taxonomy_query_args( $atts ) );
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['slider_attr']    = $this->get_slider_data( $atts );

			$atts['this_shortcode'] = $this;

			return obsius_core_get_template_part( 'post-types/portfolio/shortcodes/portfolio-category-list', 'templates/content', $atts['behavior'], $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-portfolio-category-list';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';

			$list_classes   = $this->get_list_classes( $atts );
			$holder_classes = array_merge( $holder_classes, $list_classes );

			return implode( ' ', $holder_classes );
		}

		public function get_item_classes( $atts ) {
			$item_classes = $this->init_item_classes();

			$list_item_classes = $this->get_list_item_classes( $atts );

			$item_classes = array_merge( $item_classes, $list_item_classes );

			return implode( ' ', $item_classes );
		}

		public function get_title_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['text_transform'] ) ) {
				$styles[] = 'text-transform: ' . $atts['text_transform'];
			}

			return $styles;
		}
	}
}
