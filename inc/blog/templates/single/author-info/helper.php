<?php

if ( ! function_exists( 'obsius_core_include_blog_single_author_info_template' ) ) {
	/**
	 * Function which includes additional module on single posts page
	 */
	function obsius_core_include_blog_single_author_info_template() {
		if ( is_single() ) {
			include_once OBSIUS_CORE_INC_PATH . '/blog/templates/single/author-info/templates/author-info.php';
		}
	}

	add_action( 'obsius_action_after_blog_post_item', 'obsius_core_include_blog_single_author_info_template', 15 );  // permission 15 is set to define template position
}

if ( ! function_exists( 'obsius_core_get_author_social_networks' ) ) {
	/**
	 * Function which includes author info templates on single posts page
	 */
	function obsius_core_get_author_social_networks( $user_id ) {
		$icons           = array();
		$social_networks = array(
			'facebook',
			'twitter',
			'linkedin',
			'instagram',
			'pinterest',
		);

		foreach ( $social_networks as $network ) {
			$network_meta = get_the_author_meta( 'qodef_user_' . $network, $user_id );

			if ( ! empty( $network_meta ) ) {
				$$network = array(
					'url'   => $network_meta,
					'icon'  => 'social_' . $network,
					'class' => 'qodef-user-social-' . $network,
				);

				$icons[ $network ] = $$network;
			}
		}

		return $icons;
	}
}


if ( ! function_exists( 'obsius_core_get_author_social_icons' ) ) {
	/**
	 * Function which includes author info templates on single posts page
	 */
	function obsius_core_get_author_social_icons( $social_icon ) {

		switch ( $social_icon ) {
			case 'social_facebook':
				$icon = 'Fb';
				break;

			case 'social_twitter':
				$icon = 'Tw';
				break;

			case 'social_linkedin':
				$icon = 'Ln';
				break;

			case 'social_instagram':
				$icon = 'Ig';
				break;

			case 'social_pinterest':
				$icon = 'Pi';
				break;

			default:
				$icon = '';
		}

		return $icon;
	}
}
