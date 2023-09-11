<?php

if ( ! function_exists( 'obsius_core_add_portfolio_list_table_shortcode' ) ) {
	/**
	 * Function that isadding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function obsius_core_add_portfolio_list_table_shortcode( $shortcodes ) {
		$shortcodes[] = 'ObsiusCore_Portfolio_List_Table_Shortcode';

		return $shortcodes;
	}

	add_filter( 'obsius_core_filter_register_shortcodes', 'obsius_core_add_portfolio_list_table_shortcode' );
}

if ( class_exists( 'ObsiusCore_List_Shortcode' ) ) {
	class ObsiusCore_Portfolio_List_Table_Shortcode extends ObsiusCore_List_Shortcode {

		public function __construct() {
			$this->set_post_type( 'portfolio-item' );
			$this->set_post_type_taxonomy( 'portfolio-category' );
			$this->set_post_type_additional_taxonomies( array( 'portfolio-tag' ) );
			$this->set_layouts( apply_filters( 'obsius_core_filter_portfolio_list_table_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'obsius_core_filter_portfolio_list_table_extra_options', array() ) );
			$this->set_hover_animation_options( apply_filters( 'obsius_core_filter_portfolio_list_table_hover_animation_options', array() ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( OBSIUS_CORE_CPT_URL_PATH . '/portfolio/shortcodes/portfolio-list-table' );
			$this->set_base( 'obsius_core_portfolio_list_table' );
			$this->set_name( esc_html__( 'Portfolio List Table', 'obsius-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays list of portfolios', 'obsius-core' ) );
			$this->set_scripts( apply_filters( 'obsius_core_filter_portfolio_list_table_register_assets', array() ) );
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'custom_class',
					'title'      => esc_html__( 'Custom Class', 'obsius-core' ),
				)
			);
            $this->set_option(
                array(
                    'field_type'    => 'select',
                    'name'          => 'enable_top_info',
                    'title'         => esc_html__( 'Enable Top Info', 'obsius-core' ),
                    'options'       => obsius_core_get_select_type_options_pool( 'no_yes', false ),
                    'default_value' => 'no',
                    'group'         => esc_html__( 'Top Info', 'obsius-core' ),
                )
            );
            $this->set_option(
                array(
                    'field_type' => 'text',
                    'name'       => 'top_info_title',
                    'title'      => esc_html__( 'Top Info Title', 'obsius-core' ),
                    'dependency'    => array(
                        'show' => array(
                            'enable_top_info' => array(
                                'values'        => 'yes',
                                'default_value' => '',
                            ),
                        ),
                    ),
                    'group'      => esc_html__( 'Top Info', 'obsius-core' ),
                )
            );
            $this->set_option(
                array(
                    'field_type' => 'text',
                    'name'       => 'top_info_subtitle',
                    'title'      => esc_html__( 'Top Info Subtitle', 'obsius-core' ),
                    'dependency'    => array(
                        'show' => array(
                            'enable_top_info' => array(
                                'values'        => 'yes',
                                'default_value' => '',
                            ),
                        ),
                    ),
                    'group'      => esc_html__( 'Top Info', 'obsius-core' ),
                )
            );
            $this->set_option(
                array(
                    'field_type'  => 'text',
                    'name'        => 'subtitle_line_break_positions',
                    'title'       => esc_html__( 'Positions of Subtitle Line Break', 'obsius-core' ),
                    'description' => esc_html__( 'Enter the positions of the words after which you would like to create a line break. Separate the positions with commas (e.g. if you would like the first, third, and fourth word to have a line break, you would enter "1,3,4")', 'obsius-core' ),
                    'group'       => esc_html__( 'Top Info', 'obsius-core' ),
                )
            );
            $this->set_option(
                array(
                    'field_type'    => 'select',
                    'name'          => 'disable_subtitle_break_words',
                    'title'         => esc_html__( 'Disable Subtitle Line Break', 'obsius-core' ),
                    'description'   => esc_html__( 'Enabling this option will disable text line breaks for screen size 680 and lower', 'obsius-core' ),
                    'options'       => obsius_core_get_select_type_options_pool( 'no_yes', false ),
                    'default_value' => 'no',
                    'group'         => esc_html__( 'Top Info', 'obsius-core' ),
                )
            );
            $this->set_option(
                array(
                    'field_type'    => 'text',
                    'name'          => 'top_info_more_text',
                    'title'         => esc_html__( 'Top Info More Text', 'obsius-core' ),
                    'default_value' => esc_html__( 'Explore All', 'obsius-core' ),
                    'dependency'    => array(
                        'show' => array(
                            'enable_top_info' => array(
                                'values'        => 'yes',
                                'default_value' => '',
                            ),
                        ),
                    ),
                    'group'      => esc_html__( 'Top Info', 'obsius-core' ),
                )
            );
            $this->set_option(
                array(
                    'field_type' => 'text',
                    'name'       => 'top_info_more_link',
                    'title'      => esc_html__( 'Top Info More Link', 'obsius-core' ),
                    'dependency'    => array(
                        'show' => array(
                            'enable_top_info' => array(
                                'values'        => 'yes',
                                'default_value' => '',
                            ),
                        ),
                    ),
                    'group'      => esc_html__( 'Top Info', 'obsius-core' ),
                )
            );
            $this->set_option(
                array(
                    'field_type'    => 'select',
                    'name'          => 'top_info_more_target',
                    'title'         => esc_html__( 'Top Info More Target', 'obsius-core' ),
                    'options'       => obsius_core_get_select_type_options_pool( 'link_target' ),
                    'default_value' => '_self',
                    'dependency'    => array(
                        'show' => array(
                            'enable_top_info' => array(
                                'values'        => 'yes',
                                'default_value' => '',
                            ),
                        ),
                    ),
                    'group'      => esc_html__( 'Top Info', 'obsius-core' ),
                )
            );
			$this->map_query_options( array( 'post_type' => $this->get_post_type() ) );
			$this->map_layout_options(
				array(
					'layouts'                 => $this->get_layouts(),
					'hover_animations'        => $this->get_hover_animation_options(),
                    'default_value_title_tag' => 'h3'
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'custom_margin',
					'title'         => esc_html__( 'Use Item Custom Margin', 'obsius-core' ),
					'description'   => esc_html__( 'If you set this option to “Yes”, the margin values defined in the Portfolio Item Custom Margin field will be applied', 'obsius-core' ),
					'options'       => obsius_core_get_select_type_options_pool( 'no_yes', false ),
					'default_value' => 'no',
					'dependency'    => array(
						'show' => array(
							'behavior' => array(
								'values'        => array( 'columns', 'masonry' ),
								'default_value' => 'columns',
							),
						),
					),
					'group'         => esc_html__( 'Layout', 'obsius-core' ),
				)
			);
			$this->map_additional_options();
			$this->map_extra_options();
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'obsius_core_portfolio_list_table', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function load_assets() {
			parent::load_assets();

			do_action( 'obsius_core_action_portfolio_list_table_load_assets', $this->get_atts() );
		}

		public function render( $options, $content = null ) {
			parent::render( $options );

			$atts = $this->get_atts();

            // fixed atts
            $atts['behavior']           = 'columns';
            $atts['columns']            = 'one';
            $atts['images_proportion']  = 'full';
            $atts['space']              = 'no';
            $atts['columns_responsive'] = 'custom';
            $atts['columns_1440']       = 1;
            $atts['columns_1366']       = 1;
            $atts['columns_1024']       = 1;
            $atts['columns_768']        = 1;
            $atts['columns_680']        = 1;
            $atts['columns_480']        = 1;

			$atts['post_type']       = $this->get_post_type();
			$atts['taxonomy_filter'] = $this->get_post_type_filter_taxonomy( $atts );

			// Additional query args
			$atts['additional_query_args'] = $this->get_additional_query_args( $atts );

			$atts['query_result']      = new \WP_Query( obsius_core_get_query_params( $atts ) );
			$atts['holder_classes']    = $this->get_holder_classes( $atts );
			$atts['slider_attr']       = $this->get_slider_data( $atts );
            $atts['top_info_subtitle'] = $this->get_modified_subtitle( $atts );
			$atts['data_attr']         = obsius_core_get_pagination_data( OBSIUS_CORE_REL_PATH, 'post-types/portfolio/shortcodes', 'portfolio-list-table', 'portfolio', $atts );

			$atts['this_shortcode'] = $this;

			return obsius_core_get_template_part( 'post-types/portfolio/shortcodes/portfolio-list-table', 'templates/content', $atts['behavior'], $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-portfolio-list-table';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-item-layout--' . $atts['layout'] : '';
            $holder_classes[] = 'yes' === $atts['disable_subtitle_break_words'] ? 'qodef-subtitle-break--disabled' : '';

            if ( ! empty( $atts['pinterest_slider'] ) && 'yes' === $atts['pinterest_slider'] ) {
                $holder_classes[] = 'qodef--pinterest-slider';

                $holder_classes[] = ! empty( $atts['pinterest_slider_layout'] ) ? 'qodef--' . $atts['pinterest_slider_layout'] : '';
            }

			$list_classes            = $this->get_list_classes( $atts );
			$hover_animation_classes = $this->get_hover_animation_classes( $atts );
			$holder_classes          = array_merge( $holder_classes, $list_classes, $hover_animation_classes );

			return implode( ' ', $holder_classes );
		}

		public function get_item_classes( $atts ) {
			$item_classes = $this->init_item_classes();

			$list_item_classes = $this->get_list_item_classes( $atts );

			if ( isset( $atts['custom_margin'] ) && 'yes' === $atts['custom_margin'] ) {
				$list_item_classes[] = 'qodef-custom-margin';
			}

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

        private function get_modified_subtitle( $atts ) {
            $title = $atts['top_info_subtitle'];

            if ( ! empty( $title ) && ! empty( $atts['subtitle_line_break_positions'] ) ) {
                $split_title          = explode( ' ', $title );
                $line_break_positions = explode( ',', str_replace( ' ', '', $atts['subtitle_line_break_positions'] ) );

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

		public function get_list_item_style( $atts ) {
			$styles = array();

			if ( isset( $atts['custom_margin'] ) && 'yes' === $atts['custom_margin'] ) {
				$margin = get_post_meta( get_the_ID(), 'qodef_portfolio_item_padding', true );

				if ( isset( $margin ) && '' !== $margin ) {
					$styles[] = 'margin: ' . get_post_meta(get_the_ID(), 'qodef_portfolio_item_padding', true);
				}
			}

			return $styles;
		}
	}
}
