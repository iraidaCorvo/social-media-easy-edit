<?php 
require_once "field.php";
class select extends field{

    function __construct($name = 'name', $id = '', $class = '', $value = ''){
        parent::__construct($name, $id, $class, $value);
    }

    function render(){}
    function sanitize(){}

    function __toString(){
        $id    = $this->id ;
        $name  = $this->name;
        $class = $this->class;
        $type  = $this->type;
        $value = $this->value;

        $text = parent::__toString();        
        $text .= '
            <form action="#" method="POST">   
                <select id="'.$id.'" class="'.$class.'" name="'.$name.'" value="'.$value.'">
                    <option value="rojo">Rojo</option>
                    <option value="verde">Verde</option>
                    <option value="azul">Azul</option>
                    <option value="negro">Negro</option>
                </select>
            </form>
        ';
        $select = $_POST[$name];  
        return $text;
    }

}