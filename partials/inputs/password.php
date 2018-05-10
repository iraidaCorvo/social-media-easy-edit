<?php 

class input_password extends input{
    function __construct($name, $args=[]){
        parent::__construct($name, array_merge($args, ['type' => 'password']));
        
    }
    function __set($name, $value){
        switch( $name ):
            case 'Value':
                parent::__set($name,'');
            break;
            default: 
               parent::__set($name,$value);
         endswitch;
    }

}


