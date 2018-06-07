<?php 

class input_password extends input{
    function __construct($name, $args=[]){
        $this->props['type']='password';
        parent::__construct($name, $args);
        
    }
    function __set($name, $value){
        switch( $name ):
            // case 'Value':
            //     parent::__set($name,'');
            // break;
            default: 
               parent::__set($name,$value);
         endswitch;
    }

}


