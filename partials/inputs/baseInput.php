<?php 

class input extends field{
    const INFINITE_SIZE = -1;
    protected $type;
    private $minLength = self::INFINITE_SIZE;
    function __construct($name = 'name', $id = '', $class = '', $value = '', $type = 'text'){
        parent::__construct($name, $id, $class, $value);
        
        $this->props['type'] = $type;
    }
    function __set($name, $value){
        switch( $name ):
            case 'MinLength':
                if(!is_int($value)) throw new InvalidArgumentException('Not an integer.');
                $this->minLength = (int)$value;
            break;
            default: 
                parent::__set($name,$value);
        endswitch;
    }
    function sanitize($value){
        if( 
            $this->INFINITE_SIZE != $this->minLength and 
            strlen($value) < $this->minLength 
        ) throw new min_length('Field too small.');
        return parent::sanitize($value);
    }


    function __toString(){
        $attrs = $this->serialize_attrs();
        return "<input $attrs>";
    }


}

