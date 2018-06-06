<?php
/*
* Plugin Name: Social Media Easy Edit
* Description: Plugin for editing social media
* Version 1.0
* Author: Iraida Artiles Corvo
* License: GPL2
**/
define( 'SMEE_PATH', plugin_dir_path(__FILE__));
define( 'SMEE_PARTIALS_PATH', SMEE_PATH . 'partials/');
define( 'SMEE_INPUTS_PATH', SMEE_PARTIALS_PATH . 'inputs/');
define( 'SMEE_VIEWS', SMEE_PATH . 'views/');
define( 'SMEE_SELECT_PATH', SMEE_PARTIALS_PATH . 'select/');
define( 'SMEE_PLUGIN_SHORT_NAME' , 'smee');
define( 'SMEE_PLUGIN_DOMAIN'     , 'smee');
include_once 'section.php';
include_once 'configurationPage.php';
include_once 'smee_menu.php';


/*$configpage = new configurationPage(
    'Social Media Easy Edit',
    'SM Easy Edit',
    'manage_options',
    'social_media'
);



$configpage

->add_section([
        'id'    => 'test_section',
        'title' => 'test title'
    ])

    ->add_field([
        'type' => 'text',
        'name' => 'testing'
    ])

    ->add_field([
        'type' => 'text',
        'name' => 'testings'
    ])

    ->add_section([
        'id'    => 'test_section2',
        'title' => 'test title'
    ])

    ->add_field([
        'type' => 'text',
        'name' => 'testing2'
    ])
    ->add_page(
        'Social Media Easy Edit1',
        'SM Easy Edit1',
        'manage_options',
        'social_media2'
    )
    ->add_section([
        'id'    => 'test_section2',
        'title' => 'test title'
    ])
    ->add_field([
        'type' => 'text',
        'name' => 'testing2'
    ])
    ;
*/
    $smee_menu = new smee_menu_page();
    $smee_menu
    ->add_page(
        'Social Media Easy Edit',
        'SM Easy Edit',
        'manage_options',
        'social_media'
    )
    ->add_section([
        'id'    => 'config_section',
        'title' => 'Configuration Page'
    ])
    
    ->add_field([
        'type' => 'text',
        'name' => 'testing',
        'label' => 'Configuration',
        'placeholder' => 'Text'
    ])
    ->add_page(
        'Facebook',
        'Facebook',
        'manage_options',
        'social_media3'
    )
    ->add_section([
        'id'    => 'facebook_section',
        'title' => 'Configuration Page Facebook'
    ])
    ->add_field([
        'type' => 'text',
        'name' => 'fb-app-id',
        'label' =>'App ID',
        'placeholder' => 'app id'
    ])
    ->add_field([
        'type' => 'password',
        'name' => 'fb-secret',
        'label' => 'Secret Facebook',
        'placeholder' => 'secret facebook'
    ])
    ->add_field([
        'type' => 'text',
        'name' => 'page-id',
        'label' =>'Page ID',
        'placeholder' => 'page id'
    ])
    ->add_page(
        'Instagram',
        'Instagram',
        'manage_options',
        'social_media6'
    )
    ->add_section([
        'id'    => 'instagram_section',
        'title' => 'Configuration Page Instagram'
    ])
    ->add_field([
        'type' => 'text',
        'name' => 'inst-client-id',
        'label' =>'Client Instagram ID',
        'placeholder' => 'client id'
    ])
    ->add_field([
        'type' => 'password',
        'name' => 'inst-client-secret',
        'label' => 'Client Instagram secret',
        'placeholder' => 'client secret'
    ])
    ->add_field([
        'type' => 'text',
        'name' => 'inst-access-token',
        'label' =>'Access token',
        'placeholder' => 'access token'
    ])
    ->add_field([
        'type' => 'text',
        'name' => 'inst-callback',
        'label' =>'Callback URL',
        'placeholder' => 'callback url'
    ])

    ->add_page(
        'Linkedin',
        'Linkedin',
        'manage_options',
        'social_media4'
    )
    ->add_page(
        'Spotify',
        'Spotify',
        'manage_options',
        'social_media5'
    )
    ->add_page(
        'Twitter',
        'Twitter',
        'manage_options',
        'social_media2'
    )
    ->add_section([
        'id'    => 'twitter_section',
        'title' => 'Configuration Page Twitter'
    ])
    ->add_field([
        'type' => 'text',
        'name' => 'tw-key',
        'label' =>'Consumer Twitter Key',
        'placeholder' => 'twitter key'
    ])
    ->add_field([
        'type' => 'password',
        'name' => 'tw-secret',
        'label' =>'Consumer Twitter Secret',
        'placeholder' => 'twitter secret'
    ])
    ->add_field([
        'type' => 'text',
        'name' => 'tw-token',
        'label' =>'Oauth Twitter Token',
        'placeholder' => 'twitter oauth token'
    ])
    ->add_field([
        'type' => 'password',
        'name' => 'tw-token-secret',
        'label' =>'Oauth Twitter Token secret',
        'placeholder' => 'twitter oauth secret'
    ])

    ;
    function generate_form($form, $with_submit=true){
         
        $miForm = new section($with_submit);
        $miForm->generate_form($form);
        $miForm->set_values($_POST);
        $miForm->render();
        $miForm->Method='GET';

    }


    function socialMedia_menu(){
        add_action('admin_menu','socialMedia_menu');
        //$sesuSettingsPage = new SectionSettings( );
        add_menu_page(
            'Social Media Easy Edit',
            'SM Easy Edit',
            'manage_options',
            'SocialMedia',
            'social_media_options_twitter',
            'dashicons-groups',
            '40'
        );

        add_submenu_page( 'SocialMedia', 'Twitter', 'Twitter', 'manage_options', 'Social Media');
        add_submenu_page( 'SocialMedia', 'Facebook', 'Facebook', 'manage_options', 'SM_options_facebook', 'SM_options_facebook');
        add_submenu_page( 'SocialMedia', 'Linkedin', 'Linkedin', 'manage_options', 'SM_options_submenu1');
        add_submenu_page( 'SocialMedia', 'Spotify', 'Spotify', 'manage_options', 'SM_options_submenu2');
    }

