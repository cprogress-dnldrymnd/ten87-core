<?php
// Load title image template
obsius_core_get_page_title_image();
?>
<?php
// Load breadcrumbs template
obsius_core_breadcrumbs();
?>
<div class="qodef-m-content <?php echo esc_attr( obsius_core_get_page_title_content_classes() ); ?>">
	<<?php echo esc_attr( $title_tag ); ?> class="qodef-m-title entry-title">
		<?php
		if ( qode_framework_is_installed( 'theme' ) ) {
			echo esc_html( obsius_get_page_title_text() );
		} else {
			echo get_option( 'blogname' );
		}
		?>
	</<?php echo esc_attr( $title_tag ); ?>>
</div>
