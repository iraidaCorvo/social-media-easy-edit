<?php 

class input_password extends input{
    function __construct($name = 'name', $id = '', $class = '', $value = ''){
        parent::__construct($name, $id, $class, $value, 'password');
    }

    function __set($name, $value){
        switch( $name ):
            default: 
               parent::__set($name,$value);
         endswitch;
    }

}


