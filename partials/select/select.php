<?php 
class select extends field{
    protected $options = [];

    //array con opciones
    function __construct($name = 'name', $args=[]){
        //showArray($args);
        if(!empty($args['options']) and is_array($args['options'])): 
            $this->options = $args['options'];
        endif;

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
        
        $attrs['options']=$this->options;
        //showArray($attrs);
        $selected = $attrs['value'];
        //showArray($attrs);
        extract($attrs);
        include SMEE_VIEWS . $this->view . '.php';
    }   
}