<?php
$post_id       = get_the_ID();
$is_enabled    = obsius_core_get_post_value_through_levels( 'qodef_blog_single_enable_related_posts' );
$related_posts = obsius_core_get_custom_post_type_related_posts( $post_id, obsius_core_get_blog_single_post_taxonomies( $post_id ) );
$normalize_height = obsius_core_get_post_value_through_levels( 'qodef_blog_single_normalize_height' );

$holder_classes = array();
if ( !empty( $normalize_height ) && 'yes' === $normalize_height ) {
	$holder_classes[] = 'qodef--normalize-height';
}

if ( 'yes' === $is_enabled && ! empty( $related_posts ) && class_exists( 'ObsiusCore_Blog_List_Shortcode' ) ) { ?>
	<div id="qodef-related-posts">
		<h3 class="qodef-related-blog-label">
			<?php
			esc_html_e('You May Also Like', 'cyberdom-core')
			?>
		</h3>
		<?php
		$params = apply_filters(
			'obsius_core_filter_blog_single_related_posts_params',
			array(
				'custom_class'      => 'qodef--no-bottom-space',
				'columns'           => '3',
				'space'           => 'medium',
				'posts_per_page'    => 3,
				'additional_params' => 'id',
				'post_ids'          => $related_posts['items'],
				'title_tag'         => 'h4',
				'excerpt_length'    => '100',
				'layout'            => 'classic'
			)
		);

		echo ObsiusCore_Blog_List_Shortcode::call_shortcode( $params );
		?>
	</div>
<?php } ?>
