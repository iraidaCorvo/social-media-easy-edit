<?php

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
    
    protected $option_name  = '';
    protected $section_name = '';
    
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
            
            case 'Field_Name':
                $option_name = $this->option_name;
                $section_name = $this->section_name; 
                $field_name = $this->props['name']; 
                return "$option_name[$section_name][$field_name]";
            
            case 'Label':
                return $this->label;

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
    
    function sanitize($value){return $value;}

    function serialize_attrs(){
        $props = $this->props;
        $attrs = '';
        foreach(array_keys( $props ) as $attr):
            if( !empty($props[$attr])):
                $attrs .= "$attr='" .(($props[$attr] === true ) ? null : $props[$attr]) ."' ";
            endif;
        endforeach;
        return $attrs;
        
       
    }

    function add_settings_field( string $domain, string $page_slug){
        add_settings_field(
            $this->ID,
            __( $this->Label, $domain ),
            [$this,'render'],
            $page_slug,
            $section->ID,
            
            [
                'label_for'         => $field->ID,
                'class'             => 'wporg_row',
                'wporg_custom_data' => 'custom',
            ]
        );
    }

   function __toString(){
        return $this-> render();
    }
    function render(){
        return [
            'serialize_attrs' => $this->serialize_attrs(),
            'label' => $this->label,
            'value'=> $this->props['value']
        ];
        

    } 
}
