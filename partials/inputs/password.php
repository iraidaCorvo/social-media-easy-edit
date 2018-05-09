<?php 

class input_password extends input{
    function __construct($name = 'name', $id = '', $class = '', $value = '', $label = ''){
        
        parent::__construct($name, $id, $class, $value, 'password', $label);
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


