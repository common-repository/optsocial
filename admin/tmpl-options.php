<?php

global $qt_popup_render, $qt_popup_prerender, $qt_popup_x1x_data;

echo "<h2>". __( $qt_popup_x1x_data['full_name'].' Options', $qt_popup_x1x_data['settings_name'] ) . "</h2>";

if ( isset($_REQUEST['settings-updated']) ) {
    echo $qt_popup_render->alert('message','updated','<strong>Options Saved</strong>');
}
?>

	<div class="wrap">
	    <div class="qt-popup-left">

		    <form method="post" action="options.php">

			    <?php settings_fields( $qt_popup_x1x_data['settings_name'] ); ?>
			    <?php //echo "<h4>". __( 'Click on the Tab to open PlugIn Options' ) . "</h4>"; ?>
                <?php $qt_popup_prerender->render_options( $qt_popup_x1x_data['options_name'] ); ?>

			    <p class="submit">
			    <input type="submit" class="button-primary" value="<?php _e('Save Options') ?>" />
			    </p>

		    </form>

	    </div>
	    <div class="qt-popup-right qt-popup-postbox qt-popup-text-center">
<?php

foreach ($qt_popup_x1x_data['owner'] as $t) {
    $tmp_res = null;
    $tmp_tag = 'p';
    if ( isset ( $t['info'] ) ) $tmp_res = $t['info'];
    if ( isset ( $t['img'] ) ) $tmp_res = '<img src="'.$t['img'].'" alt="" />';
    if ( isset ( $t['link'] ) ) $tmp_res = '<a target="_blank" href="'.$t['link'].'">'.$tmp_res.'</a>';
    if ( isset ( $t['tag'] ) ) $tmp_tag = $t['tag'];
    if ( isset ( $t['label'] ) ) $tmp_res = $t['label'].' '.$tmp_res;
    $tmp_res = '<'.$tmp_tag.' class="qt-popup-owner">'.$tmp_res.'</'.$tmp_tag.'>';
    echo $tmp_res;
}

?>
            <p></p>

	    </div>
	</div>
