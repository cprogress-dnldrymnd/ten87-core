<?php if ( comments_open() ) { ?>
	<a itemprop="url" href="<?php comments_link(); ?>" class="qodef-e-info-comments-link">
		<?php comments_number( '0 ' . esc_html__( 'Comments', 'obsius-core' ), '1 ' . esc_html__( 'Comment', 'obsius-core' ), '% ' . esc_html__( 'Comments', 'obsius-core' ) ); ?>
	</a><div class="qodef-info-separator-end"></div>
<?php } ?>
