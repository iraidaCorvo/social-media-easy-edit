<?php 

class input_date extends input{

    private $format = 'Y-m-d H:i:s';

    function __construct($name = 'name', $id = '', $class = '', $value = ''){
        parent::__construct($name, $id, $class, $value, 'date');
    }
 
    function __set($name, $value){
        switch( $name ):
            case 'Value':
                if( $this->validate($value)) $this->value = $value;
                else $this->value = 'Wrong date format';
                break;

            case 'Format':
                $this->setDateTimeFormat($value);
                break;

            default: 
                parent::__set($name,$value);

        endswitch;
    }

    function setDateTimeFormat($format){
        $this->format = $format;
    }

    private function validate($date){
        $d = DateTime::createFromFormat($this->format, $date);
        return $d && $d->format($this->format) == $date;
    }

   function render(){}

}