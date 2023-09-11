<article <?php post_class( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<div class="qodef-e-content">
			<div class="qodef-e-top-holder">
				<div class="qodef-e-info">
					<?php
					// Include post date info
					obsius_core_theme_template_part( 'blog', 'templates/parts/post-info/date' );

					// Include post read more
					obsius_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/explore-more', '', $params );
					?>
				</div>
			</div>
			<div class="qodef-e-text">
				<?php

				// Include post title
				obsius_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/title', '', $params );

				// Include post excerpt
				obsius_core_theme_template_part( 'blog', 'templates/parts/post-info/excerpt', '', $params );
				?>
			</div>
			<div class="qodef-e-bottom-holder">
				<div class="qodef-e-info">
					<?php
					// Include post read more
					obsius_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/read-more', '', $params );
					?>
				</div>
			</div>
		</div>
	</div>
</article>
