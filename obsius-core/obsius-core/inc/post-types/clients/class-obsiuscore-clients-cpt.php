<?php

if ( ! function_exists( 'obsius_core_register_clients_for_meta_options' ) ) {
	/**
	 * Function that add custom post type into global meta box allowed items array for saving meta box options
	 *
	 * @param array $post_types
	 *
	 * @return array
	 */
	function obsius_core_register_clients_for_meta_options( $post_types ) {
		$post_types[] = 'clients';

		return $post_types;
	}

	add_filter( 'qode_framework_filter_meta_box_save', 'obsius_core_register_clients_for_meta_options' );
	add_filter( 'qode_framework_filter_meta_box_remove', 'obsius_core_register_clients_for_meta_options' );
}

if ( ! function_exists( 'obsius_core_add_clients_custom_post_type' ) ) {
	/**
	 * Function that adds clients custom post type
	 *
	 * @param array $cpts
	 *
	 * @return array
	 */
	function obsius_core_add_clients_custom_post_type( $cpts ) {
		$cpts[] = 'ObsiusCore_Clients_CPT';

		return $cpts;
	}

	add_filter( 'obsius_core_filter_register_custom_post_types', 'obsius_core_add_clients_custom_post_type' );
}

if ( class_exists( 'QodeFrameworkCustomPostType' ) ) {
	class ObsiusCore_Clients_CPT extends QodeFrameworkCustomPostType {

		public function map_post_type() {
			$name = esc_html__( 'Clients', 'obsius-core' );
			$this->set_base( 'clients' );
			$this->set_menu_position( 10 );
			$this->set_menu_icon( 'dashicons-groups' );
			$this->set_slug( 'clients' );
			$this->set_name( $name );
			$this->set_path( OBSIUS_CORE_CPT_PATH . '/clients' );
			$this->set_labels(
				array(
					'name'          => esc_html__( 'Obsius Clients', 'obsius-core' ),
					'singular_name' => esc_html__( 'Client', 'obsius-core' ),
					'add_item'      => esc_html__( 'New Client', 'obsius-core' ),
					'add_new_item'  => esc_html__( 'Add New Client', 'obsius-core' ),
					'edit_item'     => esc_html__( 'Edit Client', 'obsius-core' ),
				)
			);
			$this->set_public( false );
			$this->set_archive( false );
			$this->set_supports(
				array(
					'title',
					'thumbnail',
				)
			);
			$this->add_post_taxonomy(
				array(
					'base'          => 'clients-category',
					'slug'          => 'clients-category',
					'singular_name' => esc_html__( 'Category', 'obsius-core' ),
					'plural_name'   => esc_html__( 'Categories', 'obsius-core' ),
				)
			);
		}
	}
}
