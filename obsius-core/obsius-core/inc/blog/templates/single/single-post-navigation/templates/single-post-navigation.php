<?php
$is_enabled = obsius_core_get_post_value_through_levels( 'qodef_blog_single_enable_single_post_navigation' );

if ( 'yes' === $is_enabled ) {
	$through_same_category = 'yes' === obsius_core_get_post_value_through_levels( 'qodef_blog_single_post_navigation_through_same_category' );
	?>
	<div id="qodef-single-post-navigation" class="qodef-m">
		<div class="qodef-m-inner">
			<?php
			$post_navigation = array(
				'prev' => array(
					'label' => '<span class="qodef-m-nav-label">' . esc_html__( 'Prev article', 'obsius-core' ) . '</span>',
					'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
									 width="9px" height="9px" viewBox="0 0 9 9" style="enable-background:new 0 0 9 9;" xml:space="preserve">
								<style type="text/css">
									.post-arrow{fill:#FFFFFF;}
								</style>
								<path class="post-arrow" d="M8,9V1.8L0.9,8.8L0.2,8.1L7.3,1H0V0h9v9H8z"/>
								<path class="post-arrow" d="M8,9V1.8L0.9,8.8L0.2,8.1L7.3,1H0V0h9v9H8z"/>
								</svg>',
				),
				'next' => array(
					'label' => '<span class="qodef-m-nav-label">' . esc_html__( 'Next article', 'obsius-core' ) . '</span>',
					'icon'  =>  '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
									 width="9px" height="9px" viewBox="0 0 9 9" style="enable-background:new 0 0 9 9;" xml:space="preserve">
								<style type="text/css">
									.post-arrow{fill:#FFFFFF;}
								</style>
								<path class="post-arrow" d="M8,9V1.8L0.9,8.8L0.2,8.1L7.3,1H0V0h9v9H8z"/>
								<path class="post-arrow" d="M8,9V1.8L0.9,8.8L0.2,8.1L7.3,1H0V0h9v9H8z"/>
								</svg>',
				),
			);

			if ( $through_same_category ) {
				if ( get_previous_post( true ) !== '' ) {
					$post_navigation['prev']['post'] = get_previous_post( true );
					$post_navigation['prev']['thumbnail'] = get_the_post_thumbnail($post_navigation['prev']['post'], $size = 'full');
					$post_navigation['prev']['title'] = get_the_title($post_navigation['prev']['post']);
				}
				if ( get_next_post( true ) !== '' ) {
					$post_navigation['next']['post'] = get_next_post( true );
					$post_navigation['next']['thumbnail'] = get_the_post_thumbnail($post_navigation['next']['post'], $size = 'full');
					$post_navigation['next']['title'] = get_the_title($post_navigation['next']['post']);
				}
			} else {
				if ( get_previous_post() !== '' ) {
					$post_navigation['prev']['post'] = get_previous_post();
					$post_navigation['prev']['thumbnail'] = get_the_post_thumbnail($post_navigation['prev']['post'], $size = 'full');
					$post_navigation['prev']['title'] = get_the_title($post_navigation['prev']['post']);
				}
				if ( get_next_post() !== '' ) {
					$post_navigation['next']['post'] = get_next_post();
					$post_navigation['next']['thumbnail'] = get_the_post_thumbnail($post_navigation['next']['post'], $size = 'full');
					$post_navigation['next']['title'] = get_the_title($post_navigation['next']['post']);
				}
			}

			/* Single navigation section - RENDERING */
			foreach (array('prev', 'next') as $nav_type) {
				if (isset($post_navigation[$nav_type]['post'])) { ?>
					<a itemprop="url" class="qodef-blog-single-<?php echo esc_attr($nav_type); ?>" href="<?php echo get_permalink($post_navigation[$nav_type]['post']->ID); ?>">
						<?php echo obsius_core_get_formated_output($post_navigation[$nav_type]['thumbnail']); ?>
						<div class="qodef-single-post-text-holder">
							<h5 class="qodef-single-post-nav-title"><?php echo obsius_core_get_formated_output($post_navigation[$nav_type]['title']); ?></h5>
							<span class="qodef-blog-single-nav-text-holder">
		                        <?php if ($nav_type == 'prev'){?>
			                        <?php echo qode_framework_wp_kses_html( 'svg custom', $post_navigation[$nav_type]['icon'] );?>
			                        <?php echo wp_kses($post_navigation[$nav_type]['label'], array('span' => array('class' => true))); ?>
		                        <?php } else {?>
			                        <?php echo wp_kses($post_navigation[$nav_type]['label'], array('span' => array('class' => true))); ?>
			                        <?php echo qode_framework_wp_kses_html( 'svg custom', $post_navigation[$nav_type]['icon'] );?>
		                        <?php }?>
                            </span>
						</div>
					</a>
				<?php }
			}
			?>
		</div>
	</div>
<?php } ?>
