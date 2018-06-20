<?php 
class smee_social_base{
    protected $config = [];
    protected $platform; // Esto viene de la bd 

    function __construct() {
       global $smee_menu;
       showArray($smee_menu->get_config($this->platform));
    }
    function __get($name){
        switch( $name ):
            default:
        endswitch;
    }

    function __set($name, $value){
        switch( $name ):
           default:
        endswitch;
    }
    function like(){

    }
    function share(){
        
    }
    function timeline(){
        
    }
    function comment(){
        
    }
    function post(){
        
    }
}