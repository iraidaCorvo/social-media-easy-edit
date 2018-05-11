<?php 

class input extends field{
    const INFINITE_SIZE = -1;
    protected $type;
    private $minLength = self::INFINITE_SIZE;

    function __construct($name, $args=[]){
        $this->readOnlyProps[]='type';
        $this->view = 'input';
        parent::__construct($name, $args);        
    }

    function __set($name, $value){
        $name_prop= strtolower($name);
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

    function render(){
        $attrs = parent::render();
        extract($attrs);
        
        
        include SMEE_VIEWS . $this->view . '.php';
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

