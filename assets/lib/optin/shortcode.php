<?php

function qt_popup_optin( $atts ) {

global $qt_popup_x1x_data;

    $qt_popup_tmp_options = get_option( $qt_popup_x1x_data['options_name'] );

    $tmp_btn_text = $qt_popup_tmp_options['optin_button_text'];

    $tmp_data = '

<form id="regOpt" method="post">
    <div class="qtcol qtspan5">
        <div class="qtinput-con">
            <input type="text" class="qtinput-text" name="qtpopup_name" placeholder=" Name" value="" size="20" id="user_name" tabindex="1001" />
        </div>
    </div>
    <div class="qtcol qtspan5">
        <div class="qtinput-con">
            <input type="text" class="qtinput-text" name="qtpopup_email" placeholder=" eMail" value="" size="20" id="user_email" tabindex="1002" required/>
        </div>
    </div>
    <div class="qtcol qtspan2">
        <div class="qtinput-btn-con">
            <input type="submit" class="qtinput-btn" id="qtpopup_reg_opt" value="'.$tmp_btn_text.'" />
        </div>
    </div>
            <input type="hidden" name="qtpopup_reg_opt" value="1" />
</form>

';

	return $tmp_data;
}
add_shortcode( 'qtoptin', 'qt_popup_optin' );

function qt_popup_optin2( $atts ) {

global $qt_popup_x1x_data;

    $qt_popup_tmp_options = get_option( $qt_popup_x1x_data['options_name'] );

    $tmp_btn_text = $qt_popup_tmp_options['optin_button_text'];

    $tmp_data = '

<form id="regOpt" method="post">
    <div class="qtcol qtoffset2 qtspan6">
        <div class="qtinput-con">
            <input type="text" class="qtinput-text" name="qtpopup_email" placeholder=" eMail" value="" size="20" id="user_email" tabindex="1002" required/>
        </div>
    </div>
    <div class="qtcol qtspan3">
        <div class="qtinput-btn-con">
            <input type="submit" class="qtinput-btn" id="qtpopup_reg_opt" value="'.$tmp_btn_text.'" />
        </div>
    </div>
            <input type="hidden" name="qtpopup_reg_opt" value="1" />
</form>

';

	return $tmp_data;
}
add_shortcode( 'qtoptinlt', 'qt_popup_optin2' );
