<?php 
include_once SMEE_PARTIALS_PATH . 'inputs/baseInput.php';
class input_hidden extends input{
    
    function __construct($name, $args=[]){
        $this->props['type']='hidden';
        parent::__construct($name, $args); 
    }
 
    function __set($name, $value){
        switch( $name ):
        default: 
            parent::__set($name,$value);
        endswitch;
    }


}