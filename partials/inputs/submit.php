<?php 
include_once SMEE_PARTIALS_PATH . 'inputs/baseInput.php';
class input_submit extends input{
    
    function __construct($name, $args=[]){
        parent::__construct($name, array_merge($args, ['type' => 'submit']));
        
    }
 
    function __set($name, $value){
        switch( $name ):
        default: 
            parent::__set($name,$value);
            
        endswitch;
    }


}