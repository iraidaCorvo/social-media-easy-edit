<?php 
include_once SMEE_PARTIALS_PATH . 'inputs/baseInput.php';
class input_submit extends input{
    
    function __construct($args=[]){
        $this->props['type']='submit';
        parent::__construct('', $args);
        
    }
 
    function __set($name, $value){
        switch( $name ):
        default: 
            parent::__set($name,$value);
            
        endswitch;
    }


}