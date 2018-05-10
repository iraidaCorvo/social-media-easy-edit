<?php 
include_once SMEE_PARTIALS_PATH . 'inputs/baseInput.php';
class input_text extends input{
    
    function __construct($name, $args=[]){
        parent::__construct($name, array_merge($args, ['type' => 'text']));
        
    }
 
    function __set($name, $value){
        switch( $name ):
        default: 
            parent::__set($name,$value);
        endswitch;
    }


}