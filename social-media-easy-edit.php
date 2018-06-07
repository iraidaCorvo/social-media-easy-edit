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


include_once 'admin-page-setup.php';
include_once 'section.php';
include_once 'configurationPage.php';
include_once 'smee_menu.php';


$smee_menu = new smee_menu_page();

$smee_menu->borjis_builder($config_page_data);

    function generate_form($form, $with_submit=true){
       
        $miForm = new section($with_submit);
        $miForm->generate_form($form);
        $miForm->set_values($_POST);
        $miForm->render();
        $miForm->Method='GET';

    }


