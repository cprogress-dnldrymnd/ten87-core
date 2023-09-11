<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<div class="qodef-process-holder">
		<?php $i = 1; ?>
		<?php foreach ( $items as $item ) { ?>
		<div class="qodef-process-item-holder">
			<div class="qodef-process-item">
				<div class="qodef-process-content">
					<?php obsius_core_template_part( 'shortcodes/process', 'templates/parts/title', '', $item ); ?>

					<div class="qodef-m-item-text">
						<?php obsius_core_template_part( 'shortcodes/process', 'templates/parts/top-description', '', $item ); ?>
                        <?php obsius_core_template_part( 'shortcodes/process', 'templates/parts/bottom-description', '', $item ); ?>
					</div>

                    <?php obsius_core_template_part( 'shortcodes/process', 'templates/parts/button', '', $item ); ?>
				</div>
			</div>
		</div>
			<?php
			$i ++;
		}
		?>
	</div>
</div>
