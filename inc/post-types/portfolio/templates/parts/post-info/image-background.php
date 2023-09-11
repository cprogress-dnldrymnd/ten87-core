<?php if ( has_post_thumbnail() ) : ?>
    <div class="qodef-img-holder">
        <div class="qodef-img-wrapper">
			<?php the_post_thumbnail( 'full' ); ?>
        </div>
    </div>
<?php endif; ?>