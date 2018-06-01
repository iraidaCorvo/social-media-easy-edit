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


$configpage = new configurationPage(
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
    //string $page_title, string $menu_title, string $capability, string $menu_slug

/*$configpage->add_page(
    'Social Media Easy Edit1',
    'SM Easy Edit1',
    'manage_options',
    'SocialMedia1'
);*/


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

