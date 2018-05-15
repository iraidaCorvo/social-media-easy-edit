<?php 
require_once "field.php";
class select extends field{
    protected $values = [
        'value1'    => '',
        'value2'    => '',
        'value3'     => '',
        'value4'       => ''
    ];

    //array con opciones
    function __construct($name = 'name', $args=[]){
        $this->props['type']='select';
        parent::__construct($name, $args);
    }

    function __set($name, $value){
        switch( $name ):
        default: 
            parent::__set($name,$value);
        endswitch;
    }
}