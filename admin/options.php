<?php

global $qt_popup_x1x_options;

$qt_popup_x1x_options = array (

    'tab10' => array (
        'name' => 'PopUp',
        'options' => array (

            'popup_status' => array(

                'name' => 'popup_status',
                'type' => 'check',
                'print' => __(''),
                'help' => 'Switch (On/Off) to Enable/Disable Pop-Up. Default: On.',
                'data' => 'bool',
                'value' => '1',

            ),

            'popup_template' => array(

                'name' => 'popup_template',
                'type' => 'dropdown',
                'print' => __(''),
                'help' => 'This option will set Pop-Up template.',
                'data' => 'text',
                'value' => '',
                'items' => qt_popup_tmpl_index()

            ),

            'overlay_color' => array(

                'name' => 'overlay_color',
                'type' => 'color',
                'print' => __(''),
                'help' => 'Overlay color under the Pop-Up',
                'data' => 'color',
                'value' => '#F6F6F6',

            ),

            'popup_scroll' => array(

                'name' => 'popup_scroll',
                'type' => 'check',
                'print' => __(''),
                'help' => 'Switch (On/Off) ability to scroll page vertically. Default: On.',
                'data' => 'bool',
                'value' => '1',

            ),

            'popup_scroll_to_top' => array(

                'name' => 'popup_scroll_to_top',
                'type' => 'check',
                'print' => __(''),
                'help' => 'Switch (On/Off) to make pop-up appear on top and activate scroll to top. Default: On.',
                'data' => 'bool',
                'value' => '1',

            ),

            'close_popup_button' => array(

                'name' => 'close_popup_button',
                'type' => 'check',
                'print' => __(''),
                'help' => 'Switch (on/off) Pop-Up Close button. If Enabled visitors would be able to close Pop-Up and continue browsing without Signing In.',
                'data' => 'bool',
                'value' => '1',

            ),

            'load_grid' => array(

                'name' => 'load_grid',
                'type' => 'check',
                'print' => __(''),
                'help' => '<strong>ADVANCED OPTION</strong> <i>Do not change unless absolutely necessary!</i><br /><br />Switch (on/off) native Pop-Up grid for example if you use Visual Composer for all templates you may disable this option as Visual Composer uses it`s own grid.',
                'data' => 'bool',
                'value' => '1',

            ),



        )
    ),


    'tab20' => array (
        'name' => 'Show Time',
        'options' => array (

            'popup_show_times' => array(

                'name' => 'popup_show_times',
                'type' => 'number',
                'data' => 'int',
                'print' => __(''),
                'help' => 'This option will set how many times pop-up will show up per time interval. Leave 0 (Default) for unlimited.',
                'value' => '0',
                'items' => array (

                    'min' => '0',
                    'max' => '20',
                    'step' => '1',

                )

            ),

            'popup_show_interval' => array(

                'name' => 'popup_show_interval',
                'type' => 'dropdown',
                'print' => __(''),
                'help' => 'This option will set time interval. One Week is Default.',
                'data' => 'int',
                'value' => '604800',
                'items' => array ( '86400' => 'One Day', '604800' => 'One Week', '2419200' => 'One Month', '29030400' => 'One Year' )

            ),

            'stop_after_cta' => array(

                'name' => 'stop_after_cta',
                'type' => 'check',
                'print' => __('Stop After CTA'),
                'help' => 'Prevent Pop-Up from popping up afer completed Call to Action.',
                'data' => 'bool',
                'value' => '1',

            ),

            'conditional_prefooter' => array(

                'name' => 'conditional_prefooter',
                'type' => 'number',
                'data' => 'int',
                'print' => __(''),
                'help' => 'Set this if you want to delay appearance of PreFooter. Set number of Pop-Up shows before PreFoorer should appear. Leave 0 (default) if you want to display PreFooter all the time. To test this clear cookies.',
                'value' => '0',
                'items' => array (

                    'min' => '0',
                    'max' => '20',
                    'step' => '1',

                )

            ),


        )
    ),


    'tab30' => array (
        'name' => 'Timer',
        'options' => array (

            'interval' => array(

                'name' => 'interval',
                'type' => 'number',
                'data' => 'intpos',
                'print' => __(''),
                'help' => 'Set delay (in milliseconds) before pop-up should appear.<br />Min: 500ms.(0.5sec.), Max: 90,000ms.(90sec.)<br />Default 10,000ms.(10sec.)<br /><small>* Use <strong>Whitelisted Pages</strong> option to Enable/Disable timer trigger on selected pages.</small>',
                'value' => '3500',
                'items' => array (

                        'min' => '500',
                        'max' => '90000',
                        'step' => '500',

                    )

            ),

         )
    ),

    'tab40' => array (
        'name' => 'WhiteList',
        'options' => array (

           'whitelisted_pages' => array(

                'name' => 'whitelisted_pages',
                'type' => 'multiselect',
                'print' => __(''),
                'help' => 'Multi-Select Pages to Whitelist. Works with Timer Only. If click is activated Whitelist will be ignored.<br /><small>*Use <strong>Pages Whitelist Reverse</strong> option, to control pop-up appearance behaviour. Use Ctrl+Click to select multiple pages.</small>',
                'data' => 'multiselect',
                'value' => array (  ),
                'items' => qt_popup_populate_pages()

            ),


            'pages_whitelist_disable' => array(

                'name' => 'pages_whitelist_disable',
                'type' => 'check',
                'print' => __('Pages Whitelist Reverse'),
                'help' => 'If Enabled (Switch On) PopUp will NOT APPEAR on pages selected in <strong>Whitelisted Pages</strong>.<br /><br />If Disabled (Switch Off) PopUp will ONLY APPEAR on pages selected in <strong>Whitelisted Pages</strong>.',
                'data' => 'bool',
                'value' => '1',

            ),
 

        )
    ),

);
