<?php
$is_enabled = obsius_core_get_post_value_through_levels( 'qodef_portfolio_enable_navigation' );

if ( 'yes' === $is_enabled ) {
	$through_same_category = 'yes' === obsius_core_get_post_value_through_levels( 'qodef_portfolio_navigation_through_same_category' );
	?>
	<div id="qodef-single-portfolio-navigation" class="qodef-m">
		<div class="qodef-m-inner">
			<?php
			$navigation_icon_params = array(
				'icon_attributes' => array(
					'class' => 'qodef-m-nav-icon',
				),
			);
			$post_navigation        = array(
				'prev'      => array(
					'label' => '<span class="qodef-m-nav-label">' . esc_html__( 'Prev project', 'obsius-core' ) . '</span>',
					'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
									 width="9px" height="9px" viewBox="0 0 9 9" style="enable-background:new 0 0 9 9;" xml:space="preserve">
								<style type="text/css">
									.portfolio-arrow{fill:#FFFFFF;}
								</style>
								<path class="portfolio-arrow" d="M8,9V1.8L0.9,8.8L0.2,8.1L7.3,1H0V0h9v9H8z"/>
								<path class="portfolio-arrow" d="M8,9V1.8L0.9,8.8L0.2,8.1L7.3,1H0V0h9v9H8z"/>
								</svg>',
				),
				'back-link' => array(),
				'next'      => array(
					'label' => '<span class="qodef-m-nav-label">' . esc_html__( 'Next project', 'obsius-core' ) . '</span>',
					'icon'  =>  '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
									 width="9px" height="9px" viewBox="0 0 9 9" style="enable-background:new 0 0 9 9;" xml:space="preserve">
								<style type="text/css">
									.portfolio-arrow{fill:#FFFFFF;}
								</style>
								<path class="portfolio-arrow" d="M8,9V1.8L0.9,8.8L0.2,8.1L7.3,1H0V0h9v9H8z"/>
								<path class="portfolio-arrow" d="M8,9V1.8L0.9,8.8L0.2,8.1L7.3,1H0V0h9v9H8z"/>
								</svg>',
				),
			);

            if ( ! function_exists( 'obsius_core_exclude_decoration_portfolio_items_from_navigation' ) ) {
                /**
                 * Function that is excluding portfolio items with decoration from single portfolio navigation
                 *
                 * @param string $where
                 *
                 * @return null|string
                 */
                function obsius_core_exclude_decoration_portfolio_items_from_navigation( $where ) {
                    global $wpdb;

                    return $where . " AND p.ID NOT IN ( SELECT post_id FROM $wpdb->postmeta WHERE ($wpdb->postmeta.post_id = p.ID ) AND $wpdb->postmeta.meta_key = 'replace_image_with_decoration_portfolio_item' AND meta_value != '' )";
                }

                add_filter( 'get_previous_post_where', 'obsius_core_exclude_decoration_portfolio_items_from_navigation' );
                add_filter( 'get_next_post_where', 'obsius_core_exclude_decoration_portfolio_items_from_navigation' );
            }

			if ( $through_same_category ) {
				if ( get_adjacent_post( true, '', true, 'portfolio-category') !== '' ) {
					$post_navigation['prev']['post'] = get_adjacent_post( true, '', true, 'portfolio-category');
					$post_navigation['prev']['thumbnail'] = get_the_post_thumbnail($post_navigation['prev']['post'], $size = 'portrait');
					$post_navigation['prev']['title'] = get_the_title($post_navigation['prev']['post']);
				}
				if ( get_adjacent_post( true, '', false, 'portfolio-category' ) !== '' ) {
					$post_navigation['next']['post'] = get_adjacent_post( true, '', false, 'portfolio-category' );
					$post_navigation['next']['thumbnail'] = get_the_post_thumbnail($post_navigation['next']['post'], $size = 'portrait');
					$post_navigation['next']['title'] = get_the_title($post_navigation['next']['post']);
				}
			} else {
				if ( get_adjacent_post(false, '', true) !== '' ) {
					$post_navigation['prev']['post'] = get_adjacent_post(false, '', true);
					$post_navigation['prev']['thumbnail'] = get_the_post_thumbnail($post_navigation['prev']['post'], $size = 'portrait');
					$post_navigation['prev']['title'] = get_the_title($post_navigation['prev']['post']);
				}
				if ( get_adjacent_post(false, '', false) !== '' ) {
					$post_navigation['next']['post'] = get_adjacent_post(false, '', false);
					$post_navigation['next']['thumbnail'] = get_the_post_thumbnail($post_navigation['next']['post'], $size = 'portrait');
					$post_navigation['next']['title'] = get_the_title($post_navigation['next']['post']);
				}
			}

			$back_to_link = get_post_meta( get_the_ID(), 'qodef_portfolio_single_back_to_link', true );

			if ( '' !== $back_to_link ) {
				$post_navigation['back-link'] = array(
					'post'    => true,
					'post_id' => $back_to_link,
					'icon'    => qode_framework_icons()->render_icon( 'icon_menu', 'elegant-icons', $navigation_icon_params ),
				);
			}

			foreach ( $post_navigation as $key => $value ) {

				if ( isset( $post_navigation[ $key ]['post'] ) && $key != 'back-link' ) {?>
					<a itemprop="url" class="qodef-portfolio-single-<?php echo esc_attr($key); ?>" href="<?php echo get_permalink($post_navigation[$key]['post']->ID); ?>">
						<?php echo obsius_core_get_formated_output($post_navigation[$key]['thumbnail']); ?>
						<div class="qodef-single-portfolio-text-holder">
							<h5 class="qodef-single-portfolio-nav-title"><?php echo obsius_core_get_formated_output($post_navigation[$key]['title']); ?></h5>
							<span class="qodef-portfolio-single-nav-text-holder">
		                         <?php if ( $key == 'prev') { ?>
			                         <?php echo qode_framework_wp_kses_html( 'svg custom', $post_navigation[$key]['icon'] );?>
			                         <?php echo wp_kses($post_navigation[$key]['label'], array('span' => array('class' => true))); ?>
		                         <?php } else {?>
			                         <?php echo wp_kses($post_navigation[$key]['label'], array('span' => array('class' => true))); ?>
			                         <?php echo qode_framework_wp_kses_html( 'svg custom', $post_navigation[$key]['icon'] );?>
		                         <?php }?>
	                        </span>
						</div>
					</a>
				<?php }

				if ( $key == 'back-link' ) {
                    if ( isset( $post_navigation[ $key ]['post'] ) ) {
					$current_post = $value['post'];
					$post_id      = isset( $value['post_id'] ) && ! empty( $value['post_id'] ) ? $value['post_id'] : $current_post->ID;
					?>
					<a itemprop="url" class="qodef-m-nav qodef--<?php echo esc_attr( $key ); ?>" href="<?php echo esc_url( get_permalink( $post_id ) ); ?>">
						<?php if ( ! empty( $value['icon'] ) ) {
							echo wp_kses( $value['icon'], array( 'span' => array( 'class' => true ) ) );
						} ?>
						<?php if ( ! empty( $value['label'] ) ) {
							echo wp_kses( $value['label'], array( 'span' => array( 'class' => true ) ) );
						} ?>
					</a>
				<?php }
                }

			}
			?>
		</div>
	</div>
<?php } ?>
