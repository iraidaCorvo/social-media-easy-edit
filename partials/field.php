<?php
//namespace \partials\field;
//echo __NAMESPACE__;
class field{
    protected $props = [
        'value'    => '',
        'class'    => '',
        'name'     => '',
        'id'       => '',
        'placeholder' => '',
        'required' => '',
        'readOnly' => ''
    ];

    protected $readOnlyProps=['name'];
    protected $label = null ;
    protected $view  = 'field';
    
    function __construct( string $name, array $args=[]){
        //showArray($this->readOnlyProps);
        if(!is_array($args)) $args=[];
        if( empty($args['id']) ) $args['id'] = rand(); 
        $args['name']=$name;
        foreach($this->props as $prop=>$value):
            if(! isset($args[$prop])) continue;
            $this->props[$prop]=$args[$prop];

        endforeach;

        if(isset($args['label'])) $this->label = $args['label'];
        //showArray($args);
        
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
        $name_prop= strtolower($name);
        switch( $name ):
            case 'Required':
                if( true === $value ) $this->props[$name_prop] = $value;
                else unset( $this->props[$name_prop]);
                break;
            case 'Value':
                $this->props[$name_prop] = $this->sanitize($value);
                break;
    
                default:
                if(!in_array($name_prop, $this->readOnlyProps) and in_array( $name_prop, array_keys($this->props))):

                    $this->props[$name_prop] = (string) $value;
                endif;
                break;
        endswitch;
    }

    function serialize_attrs(){
        //showArray($this->props);
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
            'attrsValues'=> $this->props
        ];
        

    } 
}
