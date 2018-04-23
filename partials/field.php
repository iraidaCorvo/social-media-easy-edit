<?php
class field{
    protected $props = [
        'value'    => '',
        'class'    => '',
        'name'     => '',
        'id'       => ''
    ];
    
    function __construct($name = 'name', $id = '', $class = '', $value = ''){
      
    }

    function __get($name){
        switch( $name ):
            case 'ID':
                return $this->props['id'];

        endswitch;
    }
}
?>
