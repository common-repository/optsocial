<?php

add_action('init', 'qt_popup_portfolio_register');
 
function qt_popup_portfolio_register() {
 
	$labels = array(
		'name' => _x('PopUp Templates', 'post type general name'),
		'singular_name' => _x('Template', 'post type singular name'),
		'add_new' => _x('Add New Template', 'portfolio item'),
		'add_new_item' => __('Add New Template'),
		'edit_item' => __('Edit Template'),
		'new_item' => __('New Template'),
		'view_item' => __('View Template'),
		'search_items' => __('Search Template'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => 'dashicons-art',
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 5,
		'supports' => array('title','editor','thumbnail','page-attributes')
	  ); 
 
	register_post_type( 'qt_popup_templates' , $args );
}

/* ---------------------------------------------------------------------- */

function qt_popup_tmpl_index() {
    $res = array( 0 => 'Default' );
    $argsa = array(
	    'post_parent' => 0,
        'post_type'   => 'qt_popup_templates', 
            'sort_column' => 'menu_order',
            'order' => 'DESC',
        'post_status' => 'publish'
    ); 
    $all_children = get_children( $argsa );

    foreach ($all_children as $ttt) {
        $res[$ttt->ID] = $ttt->post_title;
    }

    return $res;
}



/* metaboxes */

function qt_popup_save_meta_box($post_id, $post, $update) {
    global $qt_popup_x1x_custom_options;

    if (!isset($_POST["meta-box-nonce"]) || !wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__))) return $post_id;
 
    if(!current_user_can("edit_post", $post_id)) return $post_id;
 
    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE) return $post_id;
 
    $slug = "qt_popup_templates";
    if($slug != $post->post_type) return $post_id;
 
    foreach ($qt_popup_x1x_custom_options as $tmp_tabs => $tmp_inna) {
        foreach ($tmp_inna['options'] as $tmp_root => $tmp_ara) {
            $tmp_name = $tmp_ara['name'];
            if(isset($_POST[$tmp_name])) {
                $tmp_val = qt_popup_fcheck($tmp_ara['data'], $_POST[$tmp_name]);
                update_post_meta($post_id, $tmp_name, $tmp_val);
            } else {
                if ($tmp_ara['type']=='check') {
                    update_post_meta($post_id, $tmp_name, 0);
                }
            }
        }
    }
}
add_action("save_post", "qt_popup_save_meta_box", 10, 3);

function qt_popup_meta_box_markup($object) {
    global $qt_popup_prerender, $qt_popup_render, $qt_popup_x1x_custom_options, $qt_popup_x1x_data;

    wp_nonce_field(basename(__FILE__), "meta-box-nonce");

            echo '<div id="qt-popup-adm-contain"><div class="qt-popup-adm-accordion">';

            foreach ($qt_popup_x1x_custom_options as $tmp_tabs => $tmp_inna) {

                $tmp_tab_name = $tmp_inna['name'];

                echo '<div id="qt-popup-cus-'.$tmp_tabs.'"><a href="#qt-popup-cus-'.$tmp_tabs.'" class="qt-popup-adm-tab">'.$tmp_tab_name.'</a><div class="qt-popup-adm-content"><table class="form-table">';


                foreach ($tmp_inna['options'] as $tmp_root => $tmp_ara) {


                    $tmp_print = '';
                    if (isset($tmp_ara['print'])) $tmp_print = $tmp_ara['print'];

                    $tmp_help = '';
                    if (isset($tmp_ara['help'])) $tmp_help = $tmp_ara['help'];

                    $field = $qt_popup_prerender->render_preset_x( $tmp_ara['name'], $tmp_print );

    // $name = '';

                    $value = '';
                    if (get_post_meta($object->ID, $tmp_ara['name'], true) != '') {
                        $value = get_post_meta($object->ID, $tmp_ara['name'], true);
                    } else {
                        $value = $tmp_ara['value'];
                    }

                    $res = $qt_popup_render->open_meta( $field['id'], $field['label'], $tmp_help );

                    switch ($tmp_ara['type']) {

                        case 'tizy':
                            $res.= $qt_popup_render->tizy ( );
                            break;
                        case 'input':
                            $res.= $qt_popup_render->input ( $field['id'], $tmp_ara['name'], $value );
                            break;
                        case 'number':
                            $items = $tmp_ara['items'];
                            $res.= $qt_popup_render->number ( $field['id'], $tmp_ara['name'], $value, $items['min'], $items['max'], $items['step'] );
                            break;
                        case 'check':
                            if ($value == 1) {$tmp_enabled = __('On');} else {$tmp_enabled = __('Off'); $value = 0;}
                            $res.= $qt_popup_render->check ( $field['id'], $tmp_ara['name'], $value, $tmp_enabled );
                            break;
                        case 'color':
                            $res.= $qt_popup_render->color ( $field['id'], $tmp_ara['name'], $value );
                            break;
                        case 'longtext':
                            $res.= $qt_popup_render->longtext ( $field['id'], $tmp_ara['name'], $value );
                            break;
                        case 'media':
                            $res.= $qt_popup_render->media ( $field['id'], $tmp_ara['name'], $value );
                            break;
                        case 'multiselect':
                            $field['name']      = $tmp_ara['name'] . "[" . $tmp_ara['name'] . "][]";
                            $xxoptions          = array();

                            foreach ($tmp_ara['items'] as $k => $v ) {
                                $selected = ''; 
                                if (!empty($value)) $selected = ( in_array( $k, $value ) ) ? $qt_popup_render->multiselect_selected() : '';
                                $xxoptions[] = $qt_popup_render->multiselect_option( $k, $v, $selected );
                            }
                            $res.= $qt_popup_render->multiselect ( $field['id'], $field['name'], $xxoptions );
                        break;

                        case 'dropdown':
                            $xxoptions          = array();
                            $tmp_option         = '';

                            foreach ($tmp_ara['items'] as $v => $k) {
                                $selected = ''; 
                                if ($v == $value) {
                                    $selected = $qt_popup_render->dropdown_selected();
                                }
                                $xxoptions[] = $qt_popup_render->dropdown_option( $k, $v, $selected );
                            }

                            if (!empty($xxoptions)) $tmp_option = implode( '', $xxoptions );

                            $res.= $qt_popup_render->dropdown ( $field['id'], $tmp_ara['name'], $tmp_option);
                            break;

                    }

                    $res.= $qt_popup_render->close();
                    echo $res;




                }

                echo '</table></div></div>';

            }

            echo '</div></div>';

    foreach ($qt_popup_x1x_data['owner'] as $tt => $t ) {
        $tmp_res = null;
        $tmp_tag = 'p';
        if ( $tt=='logo' || $tt=='ver' ) continue;
        if ( isset ( $t['info'] ) ) $tmp_res = $t['info'];
        if ( isset ( $t['img2'] ) ) $tmp_res = '<img src="'.$t['img2'].'" alt="" />';
        if ( isset ( $t['link'] ) ) $tmp_res = '<a target="_blank" href="'.$t['link'].'">'.$tmp_res.'</a>';
        if ( isset ( $t['tag'] ) ) $tmp_tag = $t['tag'];
        if ( isset ( $t['label'] ) ) $tmp_res = $t['label'].' '.$tmp_res;
        $tmp_res = '<'.$tmp_tag.' class="qt-popup-owner">'.$tmp_res.'</'.$tmp_tag.'>';
        echo $tmp_res;
    }

}
 
function qt_popup_add_meta_box() {
    add_meta_box("qt-popup-meta-box", "Template Options", "qt_popup_meta_box_markup", "qt_popup_templates", "side", "high", null);
}
add_action("add_meta_boxes", "qt_popup_add_meta_box");

function qt_popup_remove_meta_boxes() {
    remove_meta_box('pageparentdiv', 'qt_popup_templates', 'side');
    remove_meta_box('postimagediv', 'qt_popup_templates', 'side');
    remove_meta_box('slugdiv', 'qt_popup_templates', 'normal');
}
add_action( 'admin_menu', 'qt_popup_remove_meta_boxes' );


function wpse_wpautop_nobr( $content ) {
    return wpautop( $content, false );
}

remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );

add_filter( 'the_content', 'wpse_wpautop_nobr' );
add_filter( 'the_excerpt', 'wpse_wpautop_nobr' );
