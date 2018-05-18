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

include_once 'form.php';


    function generate_form($form, $with_submit=true){
         
        $miForm = new forms($with_submit);
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
            'Social Media',
            'social_media_options_twitter',
            'dashicons-groups',
            '40'
        );

        add_submenu_page( 'Social Media', 'Twitter', 'Twitter', 'manage_options', 'Social Media');
        add_submenu_page( 'Social Media', 'Facebook', 'Facebook', 'manage_options', 'SM_options_facebook', 'SM_options_facebook');
        add_submenu_page( 'Social Media', 'Linkedin', 'Linkedin', 'manage_options', 'SM_options_submenu1');
        add_submenu_page( 'Social Media', 'Spotify', 'Spotify', 'manage_options', 'SM_options_submenu2');
    }

