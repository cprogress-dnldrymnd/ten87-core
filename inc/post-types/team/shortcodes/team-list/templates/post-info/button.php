<?php
$button_text = get_post_meta( get_the_ID(), 'qodef_team_button_text', true);
$button_link = get_post_meta( get_the_ID(), 'qodef_team_button_link', true);
$team_info = get_post_meta( get_the_ID(), 'qodef_show_team_label', true);
$button_params = array(
    'link' => $button_link,
    'button_layout' => 'textual',
    'text' => $button_text,
    'target' => '_blank',
	'size' => 'large'
);

if( ! empty( $button_text ) &&  ( 'yes' === $team_info) ) { ?>
	<div class="qodef-e-team-label">
		<?php
	    if (class_exists( 'ObsiusCore_Button_Shortcode' )) { ?>
	    <a class='qodef-e-link' href='<?php echo $button_link?>' target='_blank'></a>
	    <div class="qodef-e-team-label-button">
	        <?php
	        echo ObsiusCore_Button_Shortcode::call_shortcode( $button_params ); ?>
	    </div>
		<?php } ?>
	</div>
<?php } ?>

