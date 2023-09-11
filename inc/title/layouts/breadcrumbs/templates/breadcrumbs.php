<?php
// Load title image template
obsius_core_get_page_title_image();
?>
<div class="qodef-m-content <?php echo esc_attr( obsius_core_get_page_title_content_classes() ); ?>">
	<?php
	// Load breadcrumbs template
	obsius_core_breadcrumbs();
	?>
</div>
