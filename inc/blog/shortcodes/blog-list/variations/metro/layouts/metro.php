<article <?php post_class( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<?php obsius_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/image', 'background', $params ); ?>
		<div class="qodef-e-content">
			<div class="qodef-e-top-holder">
				<div class="qodef-e-info">
					<?php
					// Include post category info
					obsius_core_theme_template_part( 'blog', 'templates/parts/post-info/categories' );
					?>
				</div>
			</div>
			<div class="qodef-e-text">
				<?php
				// Include post title
				obsius_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/title', '', $params );
				?>
			</div>
		</div>
		<?php obsius_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/link' ); ?>
	</div>
</article>
