<?php

if ( ! function_exists( 'obsius_core_add_preview_product_slider_shortcode' ) ) {
	/**
	 * Function that is adding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function obsius_core_add_preview_product_slider_shortcode( $shortcodes ) {
		$shortcodes[] = 'ObsiusCore_Preview_Product_Slider_Shortcode';

		return $shortcodes;
	}

	add_filter( 'obsius_core_filter_register_shortcodes', 'obsius_core_add_preview_product_slider_shortcode' );
}

if ( class_exists( 'ObsiusCore_List_Shortcode' ) ) {
	class ObsiusCore_Preview_Product_Slider_Shortcode extends ObsiusCore_List_Shortcode {

		public function __construct() {
			$this->set_post_type( 'product' );
			$this->set_post_type_taxonomy( 'product_cat' );
			$this->set_post_type_additional_taxonomies( array( 'product_tag', 'product_type' ) );
			$this->set_layouts( apply_filters( 'obsius_core_filter_preview_product_slider_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'obsius_core_filter_preview_product_slider_extra_options', array() ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( OBSIUS_CORE_PLUGINS_URL_PATH . '/woocommerce/shortcodes/preview-product-slider' );
			$this->set_base( 'obsius_core_preview_product_slider' );
			$this->set_name( esc_html__( 'Preview Product Slider', 'obsius-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays preview product slider', 'obsius-core' ) );
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
                    'field_type'    => 'select',
                    'name'          => 'show_image_caption',
                    'title'         => esc_html__( 'Show Image Caption', 'obsius-core' ),
                    'description'   => esc_html__( 'Display image caption if set for the image in media library.', 'obsius-core' ),
                    'options'       => obsius_core_get_select_type_options_pool( 'yes_no' ),
                    'default_value' => 'yes',
                )
            );
			$this->map_query_options( array( 'post_type' => $this->get_post_type() ) );
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'filterby',
					'title'         => esc_html__( 'Filter By', 'obsius-core' ),
					'options'       => array(
						''             => esc_html__( 'Default', 'obsius-core' ),
						'on_sale'      => esc_html__( 'On Sale', 'obsius-core' ),
						'featured'     => esc_html__( 'Featured', 'obsius-core' ),
						'top_rated'    => esc_html__( 'Top Rated', 'obsius-core' ),
						'best_selling' => esc_html__( 'Best Selling', 'obsius-core' ),
					),
					'default_value' => '',
					'group'         => esc_html__( 'Query', 'obsius-core' ),
				)
			);
			$this->map_layout_options( array( 'layouts' => $this->get_layouts() ) );
			$this->map_additional_options();
			$this->map_extra_options();
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'obsius_core_preview_product_slider', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function render( $options, $content = null ) {
			parent::render( $options );

			$atts = $this->get_atts();

			// fixed $atts
            $atts['behavior']          = 'preview-slider';
            $atts['images_proportion'] = 'full';
            $atts['slider_navigation'] = 'yes';

			$atts['post_type']       = $this->get_post_type();
			$atts['taxonomy_filter'] = $this->get_post_type_filter_taxonomy( $atts );

			// Additional query args
			$atts['additional_query_args'] = $this->get_additional_query_args( $atts );

			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['query_result']   = new \WP_Query( obsius_core_get_query_params( $atts ) );
			$atts['slider_attr']    = $this->get_slider_data( $atts );
			$atts['data_attr']      = obsius_core_get_pagination_data( OBSIUS_CORE_REL_PATH, 'plugins/woocommerce/shortcodes', 'preview-product-slider', 'product', $atts );

			$atts['this_shortcode'] = $this;

			return obsius_core_get_template_part( 'plugins/woocommerce/shortcodes/preview-product-slider', 'templates/content', $atts['behavior'], $atts );
		}

		public function get_additional_query_args( $atts ) {
			$args = parent::get_additional_query_args( $atts );

			if ( ! empty( $atts['filterby'] ) ) {
				switch ( $atts['filterby'] ) {
					case 'on_sale':
						$sale_products         = wc_get_product_ids_on_sale();
						$args['no_found_rows'] = 1;
						$args['post__in']      = array_merge( array( 0 ), $sale_products );

						if ( ! empty( $atts['additional_params'] ) && 'id' === $atts['additional_params'] && ! empty( $atts['post_ids'] ) ) {
							$post_ids          = array_map( 'intval', explode( ',', $atts['post_ids'] ) );
							$new_sale_products = array();

							foreach ( $post_ids as $post_id ) {
								if ( in_array( $post_id, $sale_products, true ) ) {
									$new_sale_products[] = $post_id;
								}
							}

							if ( ! empty( $new_sale_products ) ) {
								$args['post__in'] = $new_sale_products;
							}
						}

						break;
					case 'featured':
						$featured_tax_query   = WC()->query->get_tax_query();
						$featured_tax_query[] = array(
							'taxonomy'         => 'product_visibility',
							'terms'            => 'featured',
							'field'            => 'name',
							'operator'         => 'IN',
							'include_children' => false,
						);

						if ( isset( $args['tax_query'] ) && ! empty( $args['tax_query'] ) ) {
							$args['tax_query'] = array_merge( $args['tax_query'], $featured_tax_query );
						} else {
							$args['tax_query'] = $featured_tax_query;
						}

						break;
					case 'top_rated':
						$args['meta_key'] = '_wc_average_rating';
						$args['order']    = 'DESC';
						$args['orderby']  = 'meta_value_num';
						break;
					case 'best_selling':
						$args['meta_key'] = 'total_sales';
						$args['order']    = 'DESC';
						$args['orderby']  = 'meta_value_num';
						break;
				}
			}

			return $args;
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-woo-shortcode';
			$holder_classes[] = 'qodef-woo-preview-product-slider';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-item-layout--' . $atts['layout'] : '';
			$holder_classes[] = ! empty( $atts['show_image_caption'] ) ? 'qodef-show-image-caption--' . $atts['show_image_caption'] : '';

			$list_classes   = $this->get_list_classes( $atts );
			$holder_classes = array_merge( $holder_classes, $list_classes );

			return implode( ' ', $holder_classes );
		}

		public function get_item_classes( $atts ) {
			$item_classes      = $this->init_item_classes();

            $list_item_classes   = array();
            $list_item_classes[] = ! empty( $atts['behavior'] ) && 'preview-slider' === $atts['behavior'] ? 'swiper-slide' : 'qodef-grid-item';

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

        public function get_list_item_image_dimension( $atts ) {
            $image_dimension = array();

            if ( ! empty( $atts['behavior'] ) && in_array( $atts['behavior'], array( 'preview-slider' ), true ) ) {
                $image_dimension = array(
                    'size'  => $atts['images_proportion'],
                    'class' => obsius_core_get_custom_image_size_class_name( $atts['images_proportion'] ),
                );
            }

            return $image_dimension;
        }

        public function get_slider_data( $atts, $include = array() ) {
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
