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

    function __set($name, $value){
        switch( $name ):
            case 'Required':
                if( true === $value ) $this->props['required'] = $value;
                else unset( $this->props['required']);
                break;
            case 'Value':
                $this->value = $this->sanitize($value);
                break;

        endswitch;
    }
    function serialize_attrs(){
        $attrs = '';
        foreach(array_keys( $this->props ) as $attr):
            if( !empty($this->props[$attr])):
                $attrs .= "$attr='" .(($this->props[$attr] === true ) ? null : $this->props[$attr]) ."' ";
            endif;
        endforeach;
        return $attrs;
    }

    function sanitize($value){return $value;}
}
?>
