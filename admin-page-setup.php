<?php 

$config_page_data = [
    'main_config_page' => [
        'page_attrs' => [
            'page_title' => 'Social Media Easy Edit',
            'menu_title' => 'SM Easy Edit',
            'capability' => 'manage_options',
            'menu_slug'  => 'main_config_page'
        ],
        'sections' => [
            'config_section' => [
                'section_attrs' => [
                    'id'    => 'config_section',
                    'title' => 'Configuration Page'
                ],
                'fields' => [
                    'testing' => [
                        'type' => 'text',
                        'name' => 'testing',
                        'label' => 'Configuration',
                        'placeholder' => 'Text'
                    ],                        
                ]
            ]
        ]
    ],
    'facebook_config_page' => [
        'page_attrs' => [
            'page_title' => 'Facebook',
            'menu_title' => 'Facebook',
            'capability' => 'manage_options',
            'menu_slug'  => 'facebook_config_page'
        ],
        'sections' => [
            'facebook_section' => [
                'section_attrs' => [
                    'id'    => 'facebook_section',
                    'title' => 'Configuration Page Facebook'
                ],
                'fields' => [
                    'fb-app-id' => [
                        'type' => 'text',
                        'name' => 'fb-app-id',
                        'label' =>'App ID',
                        'placeholder' => 'app id'
                    ],
                    'fb-secret' => [
                        'type' => 'password',
                        'name' => 'fb-secret',
                        'label' => 'Secret Facebook',
                        'placeholder' => 'secret facebook'
                    ],
                    'page-id' => [
                        'type' => 'text',
                        'name' => 'page-id',
                        'label' =>'Page ID',
                        'placeholder' => 'page id'
                    ],
                ]
            ]
        ]
    ],
    'instagram_config_page' => [
        'page_attrs' => [
            'page_title' => 'Instagram',
            'menu_title' => 'Instagram',
            'capability' => 'manage_options',
            'menu_slug'  => 'instagram_config_page'
        ],
        'sections' => [
            'instagram_section' => [
                'section_attrs' => [
                    'id'    => 'instagram_section',
                    'title' => 'Configuration Page Instagram'
                ],
                'fields' => [
                    'inst-client-id' => [
                        'type' => 'text',
                        'name' => 'inst-client-id',
                        'label' =>'Client Instagram ID',
                        'placeholder' => 'client id'
                    ],
                    'inst-client-secret' => [
                        'type' => 'password',
                        'name' => 'inst-client-secret',
                        'label' => 'Client Instagram secret',
                        'placeholder' => 'client secret'
                    ],
                    'inst-access-token' => [
                        'type' => 'text',
                        'name' => 'inst-access-token',
                        'label' =>'Access token',
                        'placeholder' => 'access token'
                    ],
                    'inst-callback' => [
                        'type' => 'text',
                        'name' => 'inst-callback',
                        'label' =>'Callback URL',
                        'placeholder' => 'callback url'
                    ],
                ]
            ]
        ]
    ],
    'twitter_config_page' => [
        'page_attrs' => [
            'page_title' => 'Twitter',
            'menu_title' => 'Twitter',
            'capability' => 'manage_options',
            'menu_slug'  => 'twitter_config_page'
        ],
        'sections' => [
            'twitter_section' => [
                'section_attrs' => [
                    'id'    => 'twitter_section',
                    'title' => 'Configuration Page Twitter'
                ],
                'fields' => [
                    'tw-key' => [
                        'type' => 'text',
                        'name' => 'tw-key',
                        'label' =>'Consumer Twitter Key',
                        'placeholder' => 'twitter key'
                    ],
                    'tw-secret' => [
                        'type' => 'password',
                        'name' => 'tw-secret',
                        'label' =>'Consumer Twitter Secret',
                        'placeholder' => 'twitter secret'
                    ],
                    'tw-token' => [
                        'type' => 'text',
                        'name' => 'tw-token',
                        'label' =>'Oauth Twitter Token',
                        'placeholder' => 'twitter oauth token'
                    ],
                    'tw-token-secret' => [
                        'type' => 'password',
                        'name' => 'tw-token-secret',
                        'label' =>'Oauth Twitter Token secret',
                        'placeholder' => 'twitter oauth secret'
                    ],
                ]
            ]
        ]
    ],

];