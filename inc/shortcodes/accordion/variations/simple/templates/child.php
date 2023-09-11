<div class="qodef-accordion-title">
	<<?php echo esc_attr( $title_tag ); ?> class="qodef-tab-title"><?php echo esc_html( $title ); ?></<?php echo esc_attr( $title_tag ); ?>>
	<span class="qodef-accordion-mark">
		<span class="qodef-icon--plus"><?php obsius_core_render_svg_icon( 'accordions-plus' ); ?></span>
		<span class="qodef-icon--minus"><?php obsius_core_render_svg_icon( 'accordions-minus' ); ?></span>
	</span>
    <div class="qodef-accordion-content">
        <div class="qodef-accordion-content-inner">
            <?php echo do_shortcode( $content ); ?>
        </div>
    </div>
</div>
<div class="qodef-accordion-content">
	<div class="qodef-accordion-content-inner">
		<?php echo do_shortcode( $content ); ?>
	</div>
</div>
