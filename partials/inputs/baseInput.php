<?php 

class input extends field{
    protected $type;
    function __construct($name = 'name', $id = '', $class = '', $value = '', $type = 'text'){
        parent::__construct($name, $id, $class, $value);
        
        $this->props['type'] = $type;
    }
}

