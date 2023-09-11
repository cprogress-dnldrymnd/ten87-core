<?php

if ( ! function_exists( 'obsius_core_add_portfolio_project_info_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function obsius_core_add_portfolio_project_info_shortcode( $shortcodes ) {
		$shortcodes[] = 'ObsiusCore_Portfolio_Project_Info_Shortcode';

		return $shortcodes;
	}

	add_filter( 'obsius_core_filter_register_shortcodes', 'obsius_core_add_portfolio_project_info_shortcode' );
}

if ( class_exists( 'ObsiusCore_Shortcode' ) ) {
	class ObsiusCore_Portfolio_Project_Info_Shortcode extends ObsiusCore_Shortcode {

		public function __construct() {
			$this->set_layouts( apply_filters( 'obsius_core_filter_portfolio_project_info_layouts', array() ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( OBSIUS_CORE_CPT_URL_PATH . '/portfolio/shortcodes/portfolio-project-info' );
			$this->set_base( 'obsius_core_portfolio_project_info' );
			$this->set_name( esc_html__( 'Portfolio Project Info', 'obsius-core' ) );
			$this->set_description( esc_html__( 'Shortcode that display list of category items', 'obsius-core' ) );
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
					'name'       => 'portfolio_id',
					'title'      => esc_html__( 'Portfolio Item', 'obsius-core' ),
					'options'    => qode_framework_get_cpt_items( 'portfolio-item', '', true ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'project_info_type',
					'title'      => esc_html__( 'Project Info Type', 'obsius-core' ),
					'options'    => array(
						'title'      => esc_html__( 'Title', 'obsius-core' ),
						'categories' => esc_html__( 'Category', 'obsius-core' ),
						'tags'       => esc_html__( 'Tag', 'obsius-core' ),
						'author'     => esc_html__( 'Author', 'obsius-core' ),
						'date'       => esc_html__( 'Date', 'obsius-core' ),
						'image'      => esc_html__( 'Featured Image', 'obsius-core' ),
					),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'project_info_label',
					'title'       => esc_html__( 'Project Info Label', 'obsius-core' ),
					'description' => esc_html__( 'Add project info label before project info element/s', 'obsius-core' ),
				)
			);
		}

		public function render( $options, $content = null ) {
			parent::render( $options );

			$atts = $this->get_atts();

			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['project_id']     = ! empty( $atts['portfolio_id'] ) ? $atts['portfolio_id'] : get_the_ID();
			$atts['this_shortcode'] = $this;

			return obsius_core_get_template_part( 'post-types/portfolio/shortcodes/portfolio-project-info', 'templates/content', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-portfolio-project-info';

			return implode( ' ', $holder_classes );
		}
	}
}
