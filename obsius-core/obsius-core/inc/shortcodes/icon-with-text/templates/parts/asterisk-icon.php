<?php if ( 'asterisk-icon' === $icon_type ) { ?>
	<?php if ( ! empty( $link ) ) : ?>
		<a itemprop="url" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
	<?php endif; ?>
            <span class="qodef-asterisk-icon-holder">
                <?php echo obsius_core_render_svg_icon( 'decoration' ); ?>
            </span>
	<?php if ( ! empty( $link ) ) : ?>
		</a>
	<?php endif; ?>
<?php } ?>
