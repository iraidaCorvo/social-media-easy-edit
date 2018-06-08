<?php 
class textarea extends field{

    function __construct($name = 'name', $args=[]){
        $this->props['rows'] = 4;
        $this->props['cols'] = 50;
        $this->view = 'textarea';
        parent::__construct($name, $args);
    }

    function __set($name, $value){
        switch( $name ):
        default: 
            parent::__set($name,$value);
        endswitch;
    }
    function render(){  
        $value = $this->props['value'];
        unset($this->props['value']);
        $attrs = parent::render();
        
        extract($attrs);
        //showArray($attrs);
        include SMEE_VIEWS . $this->view . '.php';
    }   
}