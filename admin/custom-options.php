<?php

global $qt_popup_x1x_custom_options;

$qt_popup_x1x_custom_options = array (

    'tab10' => array (
        'name' => 'PopUp',
        'options' => array (

            'qt_popup_top' => array(
                'name' => 'qt_popup_top',
                'type' => 'number',
                'data' => 'int',
                'print' => __(''),
                'help' => 'Use this option to shift pop-up down (px). This option is useful in case you want to manually adjust vertical position of the pop-up.',
                'value' => '40',
                'items' => array (
                        'min' => '0',
                        'max' => '600',
                        'step' => '10',
                    )
            ),

            'qt_popup_width' => array(
                'name' => 'qt_popup_width',
                'type' => 'number',
                'data' => 'int',
                'print' => __(''),
                'help' => 'This option will change pop-up width (px). Use it wisely.<br />For <strong>standard</strong> template recommended with - 860px<br />for <strong>lite</strong> template recommended with - 460px',
                'value' => '860',
                'items' => array (
                    'min' => '120',
                    'max' => '1280',
                    'step' => '10',
                )
            ),

        )
    ),

    'tab20' => array (
        'name' => 'Typography',
        'options' => array (

           'text_color' => array(

                'name' => 'text_color',
                'type' => 'color',
                'print' => __(''),
                'help' => 'Main Pop-Up Text Color',
                'data' => 'color',
                'value' => '#000000',

            ),

            'text_shadow' => array(

                'name' => 'text_shadow',
                'type' => 'check',
                'print' => __(''),
                'help' => 'This option controls (Enable or Disable - Default) Pop-Up Text Shadow. Useful when you have contrast background image. Use with Text Shadow Color Option.',
                'data' => 'bool',
                'value' => '0',

            ),

            'text_shadow_color' => array(

                'name' => 'text_shadow_color',
                'type' => 'color',
                'print' => __(''),
                'help' => 'Pop-Up Text Shadow Color',
                'data' => 'color',
                'value' => '#aaaaaa',

            ),


        )
    ),

    'tab30' => array (
        'name' => 'Google Fonts',
        'options' => array (


            'gfont_family' => array(

                'name' => 'gfont_family',
                'type' => 'dropdown',
                'print' => __(''),
                'help' => 'Google Font name. You can use any desired Google Font.',
                'data' => 'text',
                'value' => 'Titillium Web',
                'items' => qt_popup_populate_g()

            ),

            'gfont_weights' => array(

                'name' => 'gfont_weights',
                'type' => 'input',
                'data' => 'text',
                'value' => '400,200,300,600',
                'print' => __(''),
                'help' => 'List of all available Current Font weights (comma separated)',

            ),


            'font_size' => array(

                'name' => 'font_size',
                'type' => 'number',
                'data' => 'float',
                'print' => __(''),
                'help' => '<strong>ADVANCED OPTION</strong> <i>Do not change unless absolutely necessary!</i><br /><br />Main font size option (in em) Use this option to fine-tune your popup font size. If font on pop-up form looks too big you may consider to decrease the value to 0.9, if text looks too small you may consider to increase the value to 1.1 or more.',
                'value' => '1',
                'items' => array (

                    'min' => '0.2',
                    'max' => '2',
                    'step' => '0.1',

                )

            ),

            'gfont_family_load' => array(

                'name' => 'gfont_family_load',
                'type' => 'check',
                'print' => __(''),
                'help' => '<strong>ADVANCED OPTION</strong> <i>Do not change unless absolutely necessary!</i><br /><br />Switch (on/off) to pre-load Google Font. You may Disable this option if your theme already uses desired font to avoid conflicts and speed loading. If Font does not appear Enable (default) this option.',
                'data' => 'bool',
                'value' => '1',

            ),

            'gfont_repo' => array(

                'name' => 'gfont_repo',
                'type' => 'dropdown',
                'print' => __(''),
                'help' => '<strong>ADVANCED OPTION</strong> <i>Do not change unless absolutely necessary!</i><br /><br />In some countries Google repository may be not accessible or slow. Change Fonts repository ONLY if your fonts not loading.',
                'data' => 'text',
                'value' => 'https://fonts.googleapis.com',
                'items' => array ( 'https://fonts.googleapis.com' => 'GoogleApis', 'http://fonts.useso.com' => 'UseSo', )

            ),

        )
    ),

    'tab40' => array (
        'name' => 'Background',
        'options' => array (

            'header_color' => array(

                'name' => 'header_color',
                'type' => 'color',
                'print' => __('Pop-Up Header Color'),
                'help' => 'Pop-Up Header Color.',
                'data' => 'color',
                'value' => '',

            ),

            'background_color' => array(

                'name' => 'background_color',
                'type' => 'color',
                'print' => __('PopUp Main Background Color'),
                'help' => 'Main Pop-Up Background Color. Backrgound image (if used) will overlap it.',
                'data' => 'color',
                'value' => '',

            ),

            'prefooter_bg_color' => array(

                'name' => 'prefooter_bg_color',
                'type' => 'color',
                'print' => __('PreFooter Background Color'),
                'help' => 'PreFooter Background Color.',
                'data' => 'color',
                'value' => '#ffffff',

            ),

            'footer_bg_color' => array(

                'name' => 'footer_bg_color',
                'type' => 'color',
                'print' => __('Footer Background Color'),
                'help' => 'Footer Background Color.',
                'data' => 'color',
                'value' => '#ffffff',

            ),

        )
    ),

    'tab50' => array (
        'name' => 'Custom CSS',
        'options' => array (

            'custom_css' => array (

                'name' => 'custom_css',
                'type' => 'longtext',
                'data' => 'html',
                'value' => __(''),
                'print' => __(''),
                'help' => 'Custom CSS',

            ),


        )
    ),


);
