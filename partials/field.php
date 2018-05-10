<?php
//namespace \partials\field;
//echo __NAMESPACE__;
class field{
    protected $props = [
        'value'    => '',
        'class'    => '',
        'name'     => '',
        'id'       => ''
    ];
    protected $label = null ;
     //function __autoload($classname) {
    //     $filename = "./". $classname .".php";
    //     include_once($filename);
    // }
    
    /*function __autoload($class) {
    $class = 'classes\' . str_replace('\\', '/', $class) . '.php';
        require_once($class);
    
    }*/
    
    function __construct( string $name, array $args=[]){
        if(!is_array($args)) $args=[];
        if( empty($args['id']) ) $args['id'] = rand(); 
        $args['name']=$name;
        foreach($this->props as $prop=>$value):
            if(! isset($args[$prop])) continue;
            $this->props[$prop]=$args[$prop];

        endforeach;

        if(isset($args['label'])) $this->label = $args['label'];
        
    }

    function __get($name){
        switch( $name ):
            case 'ID':
                return $this->props['id'];
            
            case 'Name':
                return $this->props['name'];

        endswitch;
    }

    function __set($name, $value){
        switch( $name ):
            case 'Required':
                if( true === $value ) $this->props['required'] = $value;
                else unset( $this->props['required']);
                break;
            case 'Value':
                $this->props['value'] = $this->sanitize($value);
                break;

            case 'Label':
                $this->props['label'] = $value;
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
   
    function __toString(){
        return $this-> render();
    }
    function render(){
        return [
            'attrs' => $this->serialize_attrs(),
            'label' => $this->label,
            'attrsValues'   => $this->props
        ];

    } 
}
