<?php
add_action('admin_menu', 'KodePortfolio_add_admin_menu');
add_action('admin_init', 'KodePortfolio_settings_init');


function KodePortfolio_add_admin_menu()
{

    add_menu_page('KodePortfolio', 'KodePortfolio', 'manage_options', 'kodeportfolio', 'kodeportfolio_options_page');

}

function injectAdminStyles()
{

    echo "<style>input#submit {
    background: #00A65A !important;
    border: none !important;
    border-radius: 0 !important;
    width: 100% !important;
}



</style>";
    return true;
}

function KodePortfolio_settings_init()
{

    register_setting('pluginPage', 'KodePortfolio_settings');


}


function KodePortfolio_options_page()
{


    echo "<form action='options.php' method='post' >
";


    $options = get_option('KodePortfolio_settings');
    $admin = new wsg();
    $args = [
        'config' => [
            'optionsname' => 'KodePortfolio_settings',
            'debug' => 'true',
            'tabs' => 'true',
            'class' => [
                'outerwraper' => 'col-md-12',
                'innerwrapper' => 'col-md-12',
                'wrapper' => 'col-md-12'
            ]
        ],
        'options' => [
            'PostType' => [

                [
                    'class' => 'col-md-12',
                    'type' => 'header',
                    'text' => 'Step 1 : Initial Settings'
                ],
                [
                    'class' => 'col-md-12',
                    'name' => 'custom_post_type',
                    'type' => 'select',
                    'label' => 'Do you wish to use a custom post type',
                    'tooltip' => 'Enable this if you wish to use a custom post type',
                    'options' => [
                        ['value' => 'yes'],
                        ['value' => 'no']
                    ]
                ],
                [
                    'class' => 'col-md-12',
                    'name' => 'cunume',
                    'type' => 'text',
                    'tooltip' => 'This is the name of your custom post type',
                    'label' => 'Now pick a SEO Friendly name ( No spaces )'
                ], [
                    'class' => 'col-md-12',
                    'name' => 'cuslug',
                    'type' => 'text',
                    'tooltip' => 'This is the name of your custom post type',
                    'label' => 'What would you like your custom post type to be called'
                ],
                [
                    'class' => 'col-md-12',
                    'name' => 'parent',
                    'type' => 'number',
                    'label' => 'Load posts from what category,  Not sure?  Just set this to 0'
                ],


            ],
            'Portfolio' => [
                [
                    'class' => 'col-md-12',
                    'type' => 'header',
                    'text' => 'Step 2 : What should be displayed'
                ],
                [
                    'class' => 'col-md-12',
                    'name' => 'imageonly',
                    'type' => 'select',
                    'label' => 'Should I hide posts without featured images',
                    'options' => [
                        ['value' => 'yes'],
                        ['value' => 'no']
                    ]
                ], [
                    'class' => 'col-md-12',
                    'name' => 'readmore',
                    'type' => 'select',
                    'label' => 'Should I show read more',
                    'options' => [
                        ['value' => 'yes'],
                        ['value' => 'no']
                    ]
                ],
                [
                    'class' => 'col-md-12',
                    'name' => 'textblocks',
                    'type' => 'select',
                    'label' => 'Should I enable Text Blocks',
                    'options' => [
                        ['value' => 'yes'],
                        ['value' => 'no']
                    ]
                ],
                [
                    'class' => 'col-md-12',
                    'name' => 'headers',
                    'type' => 'select',
                    'label' => 'Should I enable Headers',
                    'options' => [
                        ['value' => 'yes'],
                        ['value' => 'no']
                    ]
                ], [
                    'class' => 'col-md-12',
                    'name' => 'enablelightbox',
                    'type' => 'select',
                    'label' => 'Should I enable Lightboxes',
                    'options' => [
                        ['value' => 'yes'],
                        ['value' => 'no']
                    ]
                ],

                [
                    'class' => 'col-md-12',
                    'name' => 'youtubethumbnails',
                    'type' => 'select',
                    'label' => 'Should I enable Youtube Thumbnails',
                    'options' => [
                        ['value' => 'yes'],
                        ['value' => 'no']
                    ]
                ],

                [
                    'class' => 'col-md-12',
                    'name' => 'catmenu',
                    'type' => 'select',
                    'label' => 'Should I display the category menus',
                    'options' => [
                        ['value' => 'yes'],
                        ['value' => 'no']
                    ]
                ],
            ],
            'headersstyle' => [

                [
                    'class' => 'col-md-12',
                    'type' => 'header',
                    'text' => 'Step 3 : Design your Headers'
                ],
                [
                    'class' => 'col-md-12',
                    'name' => 'header_colour',
                    'type' => 'colour',
                    'label' => 'Font Color'
                ],
                [
                    'class' => 'col-md-12',
                    'name' => 'header_size',
                    'type' => 'number',
                    'label' => 'Font Size',
                ],
                [
                    'class' => 'col-md-12',
                    'name' => 'headerloc',
                    'type' => 'select',
                    'label' => 'Header Location',
                    'options' => [
                        ['value' => 'top'],
                        ['value' => 'bottom']
                    ]
                ],
                [
                    'class' => 'col-md-12',
                    'name' => 'headerlinks',
                    'type' => 'select',
                    'label' => 'Make the headers links?',
                    'options' => [
                        ['value' => 'yes'],
                        ['value' => 'no']
                    ]
                ],
            ],
            'tiles' => [
                [
                    'class' => 'col-md-12',
                    'type' => 'header',
                    'text' => 'Step 4 : Design look of the tiles'
                ],
                [
                    'class' => 'col-md-12',
                    'name' => 'background_col',
                    'type' => 'colour',
                    'label' => 'Tile Background Colour'
                ],
                [
                    'class' => 'col-md-12',
                    'name' => 'tile_border_col',
                    'type' => 'colour',
                    'label' => 'Tile Background Colour'
                ],
                [
                    'class' => 'col-md-12',
                    'name' => 'tile_border_size',
                    'type' => 'number',
                    'label' => 'Tile Border Size',
                ],
                [
                    'class' => 'col-md-12',
                    'name' => 'tile_padding',
                    'type' => 'number',
                    'label' => 'Tile Padding Size',
                ],
                [
                    'class' => 'col-md-12',
                    'name' => 'tile_animationOnHover',
                    'type' => 'select',
                    'label' => 'animation on hover',
                    'options' => [
                        ['value' => 'none'],
                        ['value' => 'float'],
                        ['value' => 'grow'],
                        ['value' => 'shrink'],
                        ['value' => 'hang'],
                        ['value' => 'skew'],
                        ['value' => 'push'],
                        ['value' => 'pop'],
                    ]
                ],
            ],
            'readmoe' => [
                [
                    'class' => 'col-md-12',
                    'type' => 'header',
                    'text' => 'Step 5 : Design the look of the ReadMe button'
                ],

                [
                    'class' => 'col-md-12',
                    'name' => 'readmore_float',
                    'type' => 'select',
                    'label' => 'Readmore Position',
                    'options' => [
                        ['value' => 'left'],
                        ['value' => 'center'],
                        ['value' => 'right']
                    ]
                ],
                [
                    'class' => 'col-md-12',
                    'name' => 'readmore_prefix',
                    'type' => 'text',
                    'label' => 'Prefix text'
                ],
                [
                    'class' => 'col-md-12',
                    'name' => 'readmore_text',
                    'type' => 'text',
                    'label' => 'Button Text'
                ],
                [
                    'class' => 'col-md-12',
                    'name' => 'readmore_sufix',
                    'type' => 'text',
                    'label' => 'Sufix text'
                ],
                [
                    'class' => 'col-md-12',
                    'name' => 'readmore_colour',
                    'type' => 'colour',
                    'label' => 'Colour'
                ],
                [
                    'class' => 'col-md-12',
                    'name' => 'readmore_size',
                    'type' => 'number',
                    'label' => 'Size',
                ],
            ],
            'catbuttons' => [
                [
                    'class' => 'col-md-12',
                    'type' => 'header',
                    'text' => 'Step 6 : Design your category Buttons'
                ],
                [
                    'class' => 'col-md-12',
                    'name' => 'spaceuptop',
                    'type' => 'number',
                    'label' => 'Add padding under the buttons ( In px )',
                ]
            ],
            'Images' => [
                [
                    'class' => 'col-md-12',
                    'type' => 'header',
                    'text' => 'Step 7 : Setup your Thumbnails'
                ],
                [
                    'class' => 'col-md-12',
                    'name' => 'thumbnailsize',
                    'type' => 'select',
                    'label' => 'Thumbnail sizes',
                    'options' => [
                        ['value' => 'thumbnail'],
                        ['value' => 'custom'],
                        ['value' => 'medium'],
                        ['value' => 'large'],
                        ['value' => 'full']
                    ]
                ],
                [
                    'class' => 'col-md-12',
                    'name' => 'customwidth',
                    'type' => 'bignumber',
                    'label' => 'Custom Width',
                ],
                [
                    'class' => 'col-md-12',
                    'name' => 'customheight',
                    'type' => 'bignumber',
                    'label' => 'Custom Height',
                ],
                [
                    'class' => 'col-md-12',
                    'name' => 'native',
                    'type' => 'select',
                    'label' => 'Use Native image sizes',
                    'options' => [
                        ['value' => 'no'],
                        ['value' => 'yes']
                    ]
                ],
                [
                    'class' => 'col-md-12',
                    'name' => 'fullwidth',
                    'type' => 'select',
                    'label' => 'Force 100% Width Images',
                    'options' => [
                        ['value' => 'yes'],
                        ['value' => 'no']
                    ]
                ],
                [
                    'class' => 'col-md-12',
                    'name' => 'clickimg',
                    'type' => 'select',
                    'label' => 'Image Links to Article',
                    'options' => [
                        ['value' => 'yes'],
                        ['value' => 'no']
                    ]
                ]
            ],

            'Youtube' => [
                [
                    'class' => 'col-md-12',
                    'type' => 'header',
                    'text' => 'Step 8 : Configure your youtube settings'
                ],
                [
                    'class' => 'col-md-12',
                    'name' => 'youtubepriorty',
                    'type' => 'select',
                    'label' => 'Should a Youtube thumbnail overide a Featured image',
                    'options' => [
                        ['value' => 'yes'],
                        ['value' => 'no']
                    ]
                ],
            ],
            'Lightbox' => [
                [
                    'class' => 'col-md-12',
                    'type' => 'header',
                    'text' => 'Step 9 : Configure your Lightbox settings'
                ],

                [
                    'class' => 'col-md-12',
                    'name' => 'lightboxmode',
                    'type' => 'select',
                    'label' => 'What Lightbox should I use ( If enabled )',
                    'options' => [
                        ['value' => 'none'],
                        ['value' => 'fancybox']
                    ]
                ]
            ],
            "Social" =>
                [
                    [
                        'class' => 'col-md-12',
                        'type' => 'header',
                        'text' => 'Step 10 : Configure your Social settings'
                    ],
                    [
                        'class' => 'col-md-12',
                        'name' => 'fbshares',
                        'type' => 'select',
                        'label' => 'Should I enable facebook sharing?',
                        'options' => [
                            ['value' => 'yes'],
                            ['value' => 'no']
                        ]
                    ],
                    [
                        'class' => 'col-md-12',
                        'name' => 'fbshare_img',
                        'type' => 'text',
                        'label' => 'Select a FB Share Image'
                    ],
                ],
            "IncludedFiles" => [
                [
                    'class' => 'col-md-12',
                    'type' => 'header',
                    'text' => 'Included Files'
                ],
                [
                    'class' => 'col-md-12',
                    'name' => 'jquery',
                    'type' => 'select',
                    'label' => 'Should I try to include jQuery',
                    'options' => [
                        ['value' => 'yes'],
                        ['value' => 'no']
                    ]
                ],
                [
                    'class' => 'col-md-12',
                    'name' => 'jqueryui',
                    'type' => 'select',
                    'label' => 'Should I try to include jQuery UI',
                    'options' => [
                        ['value' => 'yes'],
                        ['value' => 'no']
                    ]
                ],
            ],
            "iso" => [
                [
                    'class' => 'col-md-12',
                    'type' => 'header',
                    'text' => 'Step 12 : Configure IsoTope Settings'
                ],
                [
                    'class' => 'col-md-12',
                    'name' => 'iso_resizable',
                    'type' => 'select',
                    'label' => 'Can be resized?',
                    'options' => [
                        ['value' => 'true'],
                        ['value' => 'false']
                    ]
                ],
                [
                    'class' => 'col-md-12',
                    'name' => 'iso_layoutMode',
                    'type' => 'select',
                    'label' => 'Display type?',
                    'options' => [
                        ['value' => 'fitColumns'],
                        ['value' => 'vertical'],
                        ['value' => 'fitRows']
                    ]
                ],
                [
                    'class' => 'col-md-12',
                    'name' => 'iso_imageFix',
                    'type' => 'select',
                    'label' => 'Add in image fix ? for when images dont laod correctly',
                    'options' => [
                        ['value' => 'true'],
                        ['value' => 'false']
                    ]
                ],
                [
                    'class' => 'col-md-12',
                    'name' => 'iso_percent',
                    'type' => 'select',
                    'label' => 'Use Percent Positining?',
                    'options' => [
                        ['value' => 'true'],
                        ['value' => 'false']
                    ]
                ],
                [
                    'class' => 'col-md-12',
                    'name' => 'iso_isOriginLeft',
                    'type' => 'select',
                    'label' => 'Float Elements left?',
                    'options' => [
                        ['value' => 'true'],
                        ['value' => 'false']
                    ]
                ],
                [
                    'class' => 'col-md-12',
                    'name' => 'iso_isOriginTop',
                    'type' => 'select',
                    'label' => 'Float Elements Top?',
                    'options' => [
                        ['value' => 'true'],
                        ['value' => 'false']
                    ]
                ],

                [
                    'class' => 'col-md-12',
                    'name' => 'iso_transitionTime',
                    'type' => 'select',
                    'label' => 'Speed of transition ( advised 0.4 )',
                    'options' => [
                        ['value' => '0.1'],
                        ['value' => '0.2'],
                        ['value' => '0.3'],
                        ['value' => '0.4'],
                        ['value' => '0.5'],
                        ['value' => '0.6'],
                        ['value' => '0.7'],
                        ['value' => '0.8'],
                        ['value' => '0.9'],
                    ]
                ],






            ],
        ]
    ];
    echo $admin->buildSettings($args);

    settings_fields('pluginPage');
    do_settings_sections('pluginPage');
    submit_button();
    ?>
    </form >
<?php


}

?>