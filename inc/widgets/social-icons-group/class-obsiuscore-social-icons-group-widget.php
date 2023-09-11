<?php

if ( ! function_exists( 'obsius_core_add_social_icons_group_widget' ) ) {
	/**
	 * function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function obsius_core_add_social_icons_group_widget( $widgets ) {
		$widgets[] = 'ObsiusCore_Social_Icons_Group_Widget';

		return $widgets;
	}

	add_filter( 'obsius_core_filter_register_widgets', 'obsius_core_add_social_icons_group_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class ObsiusCore_Social_Icons_Group_Widget extends QodeFrameworkWidget {
		public $no_of_icons = 5;

		public function map_widget() {
			$this->set_base( 'obsius_core_social_icons_group' );
			$this->set_name( esc_html__( 'Obsius Social Icons Group', 'obsius-core' ) );
			$this->set_description( sprintf( esc_html__( 'Use this widget to add a group of up to %s social icons to a widget area.', 'obsius-core' ), $this->no_of_icons ) );
			$this->set_widget_option(
				array(
					'field_type' => 'text',
					'name'       => 'widget_title',
					'title'      => esc_html__( 'Title', 'obsius-core' ),
				)
			);
            $this->set_widget_option(
                array(
                    'field_type' => 'select',
                    'name'       => 'content_alignment',
                    'description' => esc_html__( 'Set widgets content alignment', 'obsius-core' ),
                    'options'     => array(
                        ''              => esc_html__( 'Default', 'obsius-core' ),
                        'left'          => esc_html__( 'Left', 'obsius-core' ),
                        'center'        => esc_html__( 'Center', 'obsius-core' ),
                        'right'         => esc_html__( 'Right', 'obsius-core' ),
                    ),
                )
            );
			$this->set_widget_option(
				array(
					'field_type'    => 'select',
					'name'          => 'icon_layout',
					'title'         => esc_html__( 'Layout', 'obsius-core' ),
					'options'       => array(
						'normal'  => esc_html__( 'Normal', 'obsius-core' ),
						'circle'  => esc_html__( 'Circle', 'obsius-core' ),
						'square'  => esc_html__( 'Square', 'obsius-core' ),
						'textual' => esc_html__( 'Textual', 'obsius-core' ),
					),
					'default_value' => 'normal',
				)
			);
            $this->set_widget_option(
                array(
                    'field_type'    => 'select',
                    'name'          => 'with_circle',
                    'title'         => esc_html__( 'With Circle', 'obsius-core' ),
                    'options'       => obsius_core_get_select_type_options_pool( 'no_yes', false ),
                    'default_value' => 'no',
                    'dependency'    => array(
                        'show' => array(
                            'icon_layout' => array(
                                'values'        => 'textual',
                                'default_value' => 'normal',
                            ),
                        ),
                    ),
                )
            );
			for ( $i = 1; $i <= $this->no_of_icons; $i ++ ) {
				$this->set_widget_option(
					array(
						'field_type' => 'iconpack',
						'name'       => 'main_icon_' . $i,
						'title'      => sprintf( esc_html__( 'Icon %s', 'obsius-core' ), $i ),
						'dependency' => array(
							'hide' => array(
								'icon_layout' => array(
									'values'        => 'textual',
									'default_value' => 'normal',
								),
							),
						),
					)
				);
				$this->set_widget_option(
					array(
						'field_type' => 'text',
						'name'       => 'text_icon_' . $i,
						'title'      => sprintf( esc_html__( 'Text Icon %s', 'obsius-core' ), $i ),
						'dependency' => array(
							'show' => array(
								'icon_layout' => array(
									'values'        => 'textual',
									'default_value' => 'normal',
								),
							),
						),
					)
				);
				$this->set_widget_option(
					array(
						'field_type' => 'text',
						'name'       => 'link_' . $i,
						'title'      => sprintf( esc_html__( 'Link %s', 'obsius-core' ), $i ),
					)
				);
				$this->set_widget_option(
					array(
						'field_type'    => 'select',
						'name'          => 'target_' . $i,
						'title'         => sprintf( esc_html__( 'Link %s Target', 'obsius-core' ), $i ),
						'options'       => obsius_core_get_select_type_options_pool( 'link_target', false ),
						'default_value' => '_blank',
					)
				);
				$this->set_widget_option(
					array(
						'field_type' => 'text',
						'name'       => 'custom_size_' . $i,
						'title'      => sprintf( esc_html__( 'Icon %s Size', 'obsius-core' ), $i ),
						'dependency' => array(
							'hide' => array(
								'icon_layout' => array(
									'values'        => 'textual',
									'default_value' => 'normal',
								),
							),
						),
					)
				);
				$this->set_widget_option(
					array(
						'field_type' => 'text',
						'name'       => 'margin_' . $i,
						'title'      => sprintf( esc_html__( 'Icon %s Margin', 'obsius-core' ), $i ),
					)
				);
				$this->set_widget_option(
					array(
						'field_type' => 'color',
						'name'       => 'icon_color_' . $i,
						'title'      => sprintf( esc_html__( 'Icon %s Color', 'obsius-core' ), $i ),
					)
				);
				$this->set_widget_option(
					array(
						'field_type' => 'color',
						'name'       => 'icon_background_color_' . $i,
						'title'      => sprintf( esc_html__( 'Icon %s Background Color', 'obsius-core' ), $i ),
						'dependency' => array(
							'hide' => array(
								'icon_layout' => array(
									'values'        => 'textual',
									'default_value' => 'normal',
								),
							),
						),
					)
				);
				$this->set_widget_option(
					array(
						'field_type' => 'color',
						'name'       => 'icon_hover_color_' . $i,
						'title'      => sprintf( esc_html__( 'Icon %s Hover Color', 'obsius-core' ), $i ),
					)
				);
				$this->set_widget_option(
					array(
						'field_type' => 'color',
						'name'       => 'icon_hover_background_color_' . $i,
						'title'      => sprintf( esc_html__( 'Icon %s Hover Background Color', 'obsius-core' ), $i ),
						'dependency' => array(
							'hide' => array(
								'icon_layout' => array(
									'values'        => 'textual',
									'default_value' => 'normal',
								),
							),
						),
					)
				);
			}
		}

		public function render( $atts ) {
            $holder_classes = $this->get_holder_classes( $atts );
		    ?>
			<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
				<?php
				for ( $i = 1; $i <= $this->no_of_icons; $i ++ ) {
					$selected_icon_pack = str_replace( '-', '_', $atts[ 'main_icon_' . $i ] );
					$is_textual_icon    = isset( $atts[ 'text_icon_' . $i ] ) && ! empty( $atts[ 'text_icon_' . $i ] );

					if ( $is_textual_icon ) {
						$textual_styles = array();

						if ( ! empty( $atts[ 'icon_color_' . $i ] ) ) {
							$textual_styles[] = 'color: ' . $atts[ 'icon_color_' . $i ];
						}

						if ( ! empty( $atts[ 'margin_' . $i ] ) ) {
							$textual_styles[] = 'margin: ' . $atts[ 'margin_' . $i ];
						}

						$textual_hover_styles = array();
						if ( ! empty( $atts[ 'icon_hover_color_' . $i ] ) ) {
							$textual_hover_styles[] = $atts[ 'icon_hover_color_' . $i ];
						}
						?>
						<span class="qodef-icon-holder qodef--textual" <?php qode_framework_inline_style( $textual_styles ); ?> <?php qode_framework_inline_attr( $textual_hover_styles, 'data-hover-color' ); ?>>
							<?php
							echo sprintf(
								'%s%s%s',
								! empty( $atts[ 'link_' . $i ] ) ? '<a itemprop="url" href="' . esc_url( $atts[ 'link_' . $i ] ) . '" target="' . esc_url( $atts[ 'target_' . $i ] ) . '">' : '',
								esc_html( $atts[ 'text_icon_' . $i ] ),
								! empty( $atts[ 'link_' . $i ] ) ? '</a>' : ''
							);
							?>
						</span>
						<?php
					} elseif ( ! empty( $atts[ 'main_icon_' . $i . '_' . $selected_icon_pack ] ) ) {
						$params = array(
							'main_icon'                        => $atts[ 'main_icon_' . $i ],
							'main_icon_' . $selected_icon_pack => $atts[ 'main_icon_' . $i . '_' . $selected_icon_pack ],
							'link'                             => $atts[ 'link_' . $i ],
							'target'                           => $atts[ 'target_' . $i ],
							'custom_size'                      => $atts[ 'custom_size_' . $i ],
							'margin'                           => $atts[ 'margin_' . $i ],
							'background_color'                 => $atts[ 'icon_background_color_' . $i ],
							'color'                            => $atts[ 'icon_color_' . $i ],
							'hover_background_color'           => $atts[ 'icon_hover_background_color_' . $i ],
							'hover_color'                      => $atts[ 'icon_hover_color_' . $i ],
							'icon_layout'                      => $atts['icon_layout'],
						);

						echo ObsiusCore_Icon_Shortcode::call_shortcode( $params ); // XSS OK
					}
				}
				?>
			</div>
			<?php
		}

        private function get_holder_classes( $atts ) {
            $holder_classes = array();

            $holder_classes[] = 'qodef-social-icons-group';
            $holder_classes[] = ! empty( $atts['content_alignment'] ) ? 'qodef-alignment--' . $atts['content_alignment'] : 'qodef-alignment--left';
            $holder_classes[] = ! empty( $atts['with_circle'] ) ? 'qodef-with-circle--' . $atts['with_circle'] : '';

            return implode( ' ', $holder_classes );
        }
	}
}
