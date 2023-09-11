<?php

if ( ! function_exists( 'obsius_core_add_blog_single_related_posts_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function obsius_core_add_blog_single_related_posts_options( $page ) {

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_blog_single_enable_related_posts',
					'title'         => esc_html__( 'Enable Related Posts', 'obsius-core' ),
					'description'   => esc_html__( 'Enabling this option will show related posts section below post content on blog single', 'obsius-core' ),
					'default_value' => 'no',
				)
			);

			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_blog_single_normalize_height',
					'title'         => esc_html__( 'Normalize Height', 'obsius-core' ),
					'description'   => esc_html__( 'If post images are in different size, enabling this option will set height of 194px for related posts and media items on devices with resolution larger than 768px', 'obsius-core' ),
					'default_value' => 'no',
					'dependency'  => array (
						'show' => array (
							'qodef_blog_single_enable_related_posts' => array (
								'values'        => 'yes',
								'default_value' => '',
							),
						),
					),
				)
			);
		}
	}

	add_action( 'obsius_core_action_after_blog_single_options_map', 'obsius_core_add_blog_single_related_posts_options' );
}
