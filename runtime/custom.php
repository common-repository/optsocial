<?php

function qt_popup_get_post_info($id,$what) {
    $tmp = get_post($id); 
    $res = $tmp->$what;
    return $res;
}

function qt_popup_get_custom_post_data_by_slug($type,$slug,$obj){
    $res = null;
    $posts = get_posts(array(
            'name' => $slug,
            'posts_per_page' => 1,
            'post_type' => $type,
            'post_status' => 'publish'
    ));
    
    if( $posts ) {
        $res = $posts[0]->$obj;
    }

    return $res;
}
