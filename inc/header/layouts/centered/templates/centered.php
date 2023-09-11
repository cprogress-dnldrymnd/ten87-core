<?php
// Include logo
obsius_core_get_header_logo_image();
?>
<div class="qodef-centered-header-wrapper">
	<?php
	// Include widget area two
	obsius_core_get_header_widget_area( 'two' );

	// Include main navigation
	obsius_core_template_part( 'header', 'templates/parts/navigation' );

	// Include widget area one
	obsius_core_get_header_widget_area();
	?>
</div>
