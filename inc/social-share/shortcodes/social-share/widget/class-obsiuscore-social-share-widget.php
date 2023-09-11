<?php

if ( ! function_exists( 'obsius_core_add_social_share_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function obsius_core_add_social_share_widget( $widgets ) {
		$widgets[] = 'ObsiusCore_Social_Share_Widget';

		return $widgets;
	}

	add_filter( 'obsius_core_filter_register_widgets', 'obsius_core_add_social_share_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class ObsiusCore_Social_Share_Widget extends QodeFrameworkWidget {

		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options(
				array(
					'shortcode_base' => 'obsius_core_social_share',
				)
			);

			if ( $widget_mapped ) {
				$this->set_base( 'obsius_core_social_share' );
				$this->set_name( esc_html__( 'Obsius Social Share', 'obsius-core' ) );
				$this->set_description( esc_html__( 'Add a social share element into widget areas', 'obsius-core' ) );
			}
		}

		public function render( $atts ) {
			echo ObsiusCore_Social_Share_Shortcode::call_shortcode( $atts ); // XSS OK
		}
	}
}
