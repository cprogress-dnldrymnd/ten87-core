<?php

if ( ! function_exists( 'obsius_core_include_blog_single_related_posts_template' ) ) {
	/**
	 * Function which includes additional module on single posts page
	 */
	function obsius_core_include_blog_single_related_posts_template() {
		if ( is_single() ) {
			include_once OBSIUS_CORE_INC_PATH . '/blog/templates/single/related-posts/templates/related-posts.php';
		}
	}

	add_action( 'obsius_action_after_blog_post_item', 'obsius_core_include_blog_single_related_posts_template', 130 );  // permission 25 is set to define template position
}
