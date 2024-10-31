<?php

function qt_popup_z_head() {
    global $qt_popup_x1x_data;
    $qt_popup_tmpl_options = get_option( $qt_popup_x1x_data['options_name'] );

    if ($qt_popup_tmpl_options['load_grid']) {
        wp_enqueue_style( 'qt-popup-style', plugins_url( '/css/qtstyle.css', __FILE__), null, QT_POPUP_VERSION );
    }
    wp_enqueue_style( 'qt-popup-popup', plugins_url( '/css/tmpl.css', __FILE__ ), null, QT_POPUP_VERSION );
}
add_action('wp_head', 'qt_popup_z_head');

function qt_popup_lib_cookies_script() {
    wp_enqueue_script( 'qt-popup-script-cookies', plugins_url('/js/jquery.cookie.js', __FILE__), array( 'jquery' ), '', true );
}
add_action( 'wp_enqueue_scripts', 'qt_popup_lib_cookies_script' );

function qt_popup_z_timer() {
    global $qt_popup_x1x_data;
    $qt_popup_tmpl_options = get_option( $qt_popup_x1x_data['options_name'] );

?>
<script type="text/javascript">
jQuery('#qt_fb_clk').click(function(){jQuery.cookie("QT_OAUTH","FB");});
jQuery('#qt_gp_clk').click(function(){jQuery.cookie("QT_OAUTH","GP");});
function qt_popup_up(){
jQuery('body').prepend('<div class="qt_popup_overlay"></div>');
<?php
if (!$qt_popup_tmpl_options['popup_scroll_to_top']) {
echo "pTop = jQuery(window).scrollTop();jQuery('#qt_popup_popup.qt-popup-display-content').css('top', pTop + 25 + 'px');";
}else{
echo "jQuery('html, body').animate({ scrollTop: 0 }, 'slow');\n";
}
?>
jQuery('#qt_popup_popup').fadeIn(1000);
<?php
if (!$qt_popup_tmpl_options['popup_scroll']) {
echo "jQuery('html, body').css({'overflow': 'hidden','height': '100%'});jQuery('body').bind('touchmove', function(e){e.preventDefault()});";
}
?>
<?php if(isset($qt_popup_x1x_data['qt_popup_up']))echo $qt_popup_x1x_data['qt_popup_up'];?>
}
<?php
    $tmp_go = false;

    if (!empty($qt_popup_tmpl_options['whitelisted_pages'])) {
        $pages_whitelist = $qt_popup_tmpl_options['whitelisted_pages'];
    } else {
        $pages_whitelist = 99999; // 0
    }
    if ( $qt_popup_tmpl_options['pages_whitelist_disable']>0 ) {
        if ( !is_page( $pages_whitelist ) ) {
            $tmp_go = true;
        }
    } else {
        if ( is_page( $pages_whitelist ) ) {
            $tmp_go = true;
        }
    }

?>

<?php if ($tmp_go) { ?>
jQuery(document).ready(function(){setTimeout(qt_popup_pop_it,<?php echo $qt_popup_tmpl_options['interval']; ?>);});function qt_popup_pop_it(){qt_popup_up();}
<?php } ?>
</script>
<script type="text/javascript">function qt_popup_down(){
<?php
if (!$qt_popup_tmpl_options['popup_scroll']) {
echo "jQuery('html, body').css({'overflow': 'auto','height': 'auto'});jQuery('body').unbind('touchmove');";
}
?>
jQuery('#qt_popup_popup').fadeOut(500);jQuery('.qt_popup_overlay').remove();
}
</script>
<script type="text/javascript">jQuery('#qt_popup_close').on('click', qt_popup_down);</script>
<?php
}

function qt_popup_head() {
    global $qt_popup_x1x_data, $qt_popup_functions;

    $qt_popup_tmpl_options              = get_option( $qt_popup_x1x_data['options_name'] );

    $qt_popup_tmp_overlay_color         = $qt_popup_tmpl_options["overlay_color"];

    $root_id                            = $qt_popup_tmpl_options['popup_template'];

    $tmp_background_fixed               = '';
    if ( get_post_meta($root_id, "background_fixed", true) ) {
        $tmp_background_fixed           = 'fixed';
    }

    $tmp_background_att                 = '';
    if ( get_post_meta($root_id, "background_cover", true) ) {
        $tmp_background_att             = '-webkit-background-size:cover;-moz-background-size:cover;-o-background-size:cover;background-size:cover;';
    }

    $tmp_bg_align                       = get_post_meta($root_id, "background_align", true);

    $tmp_top                            = '10';
    if (get_post_meta($root_id, "qt_popup_top", true)) {
        $tmp_top                        = get_post_meta($root_id, "qt_popup_top", true);
    }

    $qt_popup_tmp_popup_width           = '600';
    if (get_post_meta($root_id, "qt_popup_width", true)) {
        $qt_popup_tmp_popup_width       = get_post_meta($root_id, "qt_popup_width", true);
    }

    $tmp_hdr_color                       = '';
    if (get_post_meta($root_id, "header_color", true)) {
        $tmp_hdr_color                   = get_post_meta($root_id, "header_color", true);
    }

    $tmp_bg_color                       = '#fff';
    if (get_post_meta($root_id, "background_color", true)) {
        $tmp_bg_color                   = get_post_meta($root_id, "background_color", true);
    }

    $tmp_prefooter_color                = $tmp_bg_color;
    if (get_post_meta($root_id, "prefooter_bg_color", true)) {
        $tmp_prefooter_color            = get_post_meta($root_id, "prefooter_bg_color", true);
    }

    $tmp_footer_color                   = $tmp_bg_color;
    if (get_post_meta($root_id, "footer_bg_color", true)) {
        $tmp_footer_color               = get_post_meta($root_id, "footer_bg_color", true);
    }

    $tmp_text_color                     = '#000';
    if (get_post_meta($root_id, "text_color", true)) {
        $tmp_text_color                 = get_post_meta($root_id, "text_color", true);
    }

    $tmp_text_shadow                    = '';
    if (get_post_meta($root_id, "text_shadow", true)) {
        $tmp_text_shadow                = 'text-shadow: 4px 3px 4px '.get_post_meta($root_id, "text_shadow_color", true).';';
    }

    $tmp_font_size                      = '1';
    if (get_post_meta($root_id, "font_size", true)) {
        $tmp_font_size                  = get_post_meta($root_id, "font_size", true);
    }

    $tmp_gff                            = 'Arial Black';
    if (get_post_meta($root_id, "gfont_family", true)) {
        $tmp_gff                        = get_post_meta($root_id, "gfont_family", true);
    }

    $tmp_gfont_id                       = $qt_popup_functions->font2id($tmp_gff);



echo "<style>\n\n";

if ( get_post_meta($root_id, "gfont_family_load", true) ) {
    $tmp_grepo                          = get_post_meta($root_id, "gfont_repo", true);
    $tmp_gweight                        = get_post_meta($root_id, "gfont_weights", true);
    echo "@import url('".$tmp_grepo."/css?family=".$tmp_gfont_id.":".$tmp_gweight."');\n";
}
/*
#qt_popup_popup #qt-popup-top-seal{background:url('<?php echo get_post_meta($root_id, 'top_seal', true); ?>') center center no-repeat;}
*/
?>

.qt_popup_overlay{background:<?php echo $qt_popup_tmp_overlay_color; ?>;}

#qt_popup_popup .qt_popup_prefooter{background:<?php echo $tmp_prefooter_color; ?>;}

#qt_popup_popup .qt_popup_footer{background:<?php echo $tmp_footer_color; ?>;}

#qt_popup_popup.qt-popup-display-content{font-family:'<?php echo $tmp_gff; ?>',sans-serif;font-size:<?php echo $tmp_font_size; ?>em;color:<?php echo $tmp_text_color; if($tmp_bg_color!=''){?>;background:<?php echo $tmp_bg_color; }?>;<?php echo $tmp_text_shadow;?>}

<?php if(get_post_meta($root_id, 'use_image_background', true)) { ?>
#qt_popup_popup .qt_popup_bg{background:url('<?php echo get_post_meta($root_id, 'background_big', true); ?>') center <?php echo $tmp_bg_align; ?> <?php echo $tmp_background_fixed; ?> no-repeat; <?php echo $tmp_background_att; ?>}

<?php
}
if ($tmp_hdr_color!='') {
?>
#qt_popup_popup .qt_popup_header{background:<?php echo $tmp_hdr_color; ?>;}
<?php
}
?>
@media (min-width:760px) {#qt_popup_popup.qt-popup-display-content{top:<?php echo $tmp_top; ?>px;max-width:<?php echo $qt_popup_tmp_popup_width; ?>px;}}

<?php

if ( get_post_meta($root_id, "custom_css", true) ) {
    echo get_post_meta($root_id, "custom_css", true);
}

echo "</style>\n";
}
