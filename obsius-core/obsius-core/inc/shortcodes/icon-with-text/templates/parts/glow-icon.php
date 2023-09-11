<?php if ( 'glow-icon' === $icon_type && ! empty( $glow_shape ) ) { ?>
	<?php if ( ! empty( $link ) ) : ?>
		<a itemprop="url" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
	<?php endif; ?>
            <span class="qodef-glow-icon-holder">
                <span class="qodef-glow-icon qodef-one"></span>
                <span class="qodef-glow-icon qodef-two"></span>
                <span class="qodef-glow-icon qodef-three"></span>

                <?php
                if ( 'shape-four' === $glow_shape ) { ?>
                    <span class="qodef-glow-icon qodef-four"></span>
                <?php
                }
                ?>
            </span>
	<?php if ( ! empty( $link ) ) : ?>
		</a>
	<?php endif; ?>
<?php } ?>
