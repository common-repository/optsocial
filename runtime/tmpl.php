<?php

global $qt_popup_x1x_data, $qt_popup_errors, $qt_popup_status;

$qt_popup_tmpl_options      = get_option( $qt_popup_x1x_data['options_name'] );
$root_id                    = $qt_popup_tmpl_options['popup_template'];

$tmp_def                    = "[qtpopup] [qtcol span=12] [qttitle tag='div']Continue with[/qttitle] [/qtcol] [qtcol span=4 offset=1] [qtfb] [/qtcol] [qtcol span=4 offset=2] [qtgp] [/qtcol] [/qtpopup]";

?>
<div id="qt_popup_popup" class="qt-popup-display-content qt_popup_shadow">
<?php
    if ($root_id>1) {
        echo do_shortcode(qt_popup_get_post_info($root_id,'post_content'));
    } else {
        echo do_shortcode($tmp_def);
    }
?>
</div>
