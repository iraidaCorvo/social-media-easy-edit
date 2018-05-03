<?php 
include_once SMEE_PARTIALS_PATH . 'inputs/baseInput.php';
class input_text extends input{
    
    function __construct($name = 'name', $id = '', $class = '', $value = ''){
        parent::__construct($name, $id, $class, $value);
    }
 
    function __set($name, $value){
        switch( $name ):

        default: 
            parent::__set($name,$value);
        endswitch;
    }


}