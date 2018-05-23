<?php
class configurationPage{
    private $args=[];

    function __construct(bool $args){
        $this->args['titulo']= '';
        $this->args['sections']= [];
        $this->args['slug']= '';
     }
     public function add_section( array $args ){
    
    }
    public function render(){
        
    }
     
}