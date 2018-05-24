<?php 
require_once SMEE_INPUTS_PATH . 'hidden.php';
require_once SMEE_INPUTS_PATH . 'password.php';
require_once SMEE_INPUTS_PATH . 'submit.php';
require_once SMEE_INPUTS_PATH . 'text.php';
require_once SMEE_PARTIALS_PATH . 'field.php';
require_once SMEE_SELECT_PATH . 'select.php';

class forms {
    private $fields = [];

    private $errors = [];
    private $groups = [];
    private $hasErrors = false;
    private $method = 'POST';
    private $action = '';
    private $submit_enable;

    function __construct(bool $submit_enable = true){
       $this->submit_enable = $submit_enable ;
    }
    function __get($name){
        switch( $name ):
            case 'Method':
                return $this->method;
            
            case 'Action':
                return $this->action;
            case 'Fields':
                return $this->fields;
        endswitch;
    }

    function __set($name, $value){
        switch( $name ):
            case 'Method':
                $value_upper=strtoupper($value);
                if( ! in_array( $value_upper, ['POST','GET'] ) ) return;

                $this->method=$value_upper;
            break;
            case 'Action':
                $this->action=$value;
            break;
            

        endswitch;
    }
    private function add_field($field){
         $this->fields[$field->Name] = $field;
         return $this;
    }

    private function add_field_din($fieldType, $args){
        $field = new $fieldType($args);
        $this->fields[$field->ID] = $field;
    }
    public function add_hidden( array $args ){
        if(!$args['name']) {
            return false;
        }
        if( ! $args['id'] ) $args['id'] = $args['name'];
        $input = new input_hidden($args['name'], $args);
        return $this->add_field($input); 
          
    }
    public function add_password( array $args ){
        if(!$args['name']) {
            return false;
        }
        if( ! $args['id'] ) $args['id'] = $args['name'];
        $password = new input_password($args['name'], $args);
        return $this->add_field($password);
        
        /*$this->add_field_din('input_password',[
            'id'    => $passwordId,
            'name'  => $passwordName,
            'value' => ( isset($_POST[$passwordName]) ) ? $_POST[$passwordName] : ''
        ]);*/
        
    }
    public function add_select( array $args){

        if(!$args['name']) {
            return false;
        }
        $input = new select($args['name'], $args);
        return $this->add_field($input);
   
    }
    public function add_submit( array $args ){
    
        $input = new input_submit($args);
         return $this->add_field($input);

    }
    public function add_text( array $args ){
        if(!$args['name']) {
            return false;
        }
        if( ! $args['id'] ) $args['id'] = $args['name'];
        $input = new input_text($args['name'], $args);
        return $this->add_field($input); 
          
    }
    public function generate_form($fields){
        foreach($fields as $field):
            $func = 'add_' . $field['type'];
            $args = $field['args'];
            $this->$func($args);
        endforeach;
    }

    public function set_values($values){

        foreach($this->fields as $field => $value):
            if( ! array_key_exists($field, $values)) continue;
            $this->fields[$field]->Value = $values[$field];
        endforeach;  
    }

    public function createGroup(){
        $this->group[]=[
            'class' => '',
            'type'  => '',
            'fields' => [
                ''
            ]
        ];
    }

    public function check_form(){
        $this->hasErrors = false;
        foreach($this->fields as $id => $field):
            $error = $field->validate();
            if($error !== false){
                $this->errors[$id] = $error;
                $this->hasErrors = true;
                /*
                    error = [
                        'type'    => 'notEmpty',
                        'message' => 'Es obligatorio'
                    ]
                */
            }
        endforeach;
        return $this->hasErrors;
    }


    public function render(){
        $method = $this->method;
        $action = $this->action;
        if($this->submit_enable):
            $this->add_submit([
                'value' => 'Enviar',
            ]);
        endif;
        
        $fields = $this->fields;
        
        include SMEE_VIEWS . 'form.php';
    }

    public function showForm(){
        showArray($this->fields);
    }
}