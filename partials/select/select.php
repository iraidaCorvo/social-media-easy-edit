<?php 
class select extends field{
    protected $values = [
        'value1'    => '',
        'value2'    => '',
        'value3'     => '',
        'value4'       => ''
    ];

    //array con opciones
    function __construct($name = 'name', $args=[]){
        foreach($this->values as $field => $value){
            $this->props[$field] = $value[$field];
        }
        $this->view = 'select';
        parent::__construct($name, $args);
    }

    function __set($name, $value){
        switch( $name ):
        default: 
            parent::__set($name,$value);
        endswitch;
    }
    function render(){
        $attrs = parent::render();
        extract($attrs);
        
        
        include SMEE_VIEWS . $this->view . '.php';
    }   
}