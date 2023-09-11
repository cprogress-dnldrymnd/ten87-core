<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_style( $holder_styles ); ?>>
	<<?php echo esc_attr( $title_tag ); ?> class="qodef-e-title" <?php qode_framework_inline_style( $title_styles ); ?>>
		<?php if ( ! empty( $link ) ) : ?>
			<a itemprop="url" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
		<?php endif; ?>
			<span class="qodef-e-title-inner">
				<span class="qodef-e-title-text"><?php echo esc_html( $title ); ?></span>
			</span>
		<?php if ( ! empty( $link ) ) : ?>
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			     width="35px" height="35px" viewBox="0 0 35 35" style="enable-background:new 0 0 35 35;" xml:space="preserve">
				<style type="text/css">
					.sl{fill:#FFFFFF;}
				</style>
				<path class="sl" d="M32,35V5.1L2.2,34.9l-2.1-2.1L29.9,3H0V0h35v35H32z"/>
				<path class="sl" d="M32,35V5.1L2.2,34.9l-2.1-2.1L29.9,3H0V0h35v35H32z"/>
			</svg>
			</a>
		<?php endif; ?>
	</<?php echo esc_attr( $title_tag ); ?>>
</div>
