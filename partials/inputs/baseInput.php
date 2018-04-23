<?php 
//namespace SMEE\fields\input;
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
    class min_length extends Exception
    {
        // Redefinir la excepción, por lo que el mensaje no es opcional
        public function __construct($message, $code = 0, Exception $previous = null) {
            // algo de código
        
            // asegúrese de que todo está asignado apropiadamente
            parent::__construct($message, $code, $previous);
        }
    
        // representación de cadena personalizada del objeto
        public function __toString() {
            return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
        }
    
        public function funciónPersonalizada() {
            echo "Una función personalizada para este tipo de excepción\n";
        }
    }

