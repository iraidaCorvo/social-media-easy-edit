<?php 
class smee_menu_page{
    private $parent_slug = null;
    private $pages = [];
    private $current_page_slug = null; //Apunta a la página usada recientemente

    public function add_page(string $page_title, string $menu_title, string $capability, string $menu_slug){
        $this->current_page_slug = $menu_slug;
        $this->pages[$menu_slug] = new configurationPage (
            $page_title, $menu_title, $capability, $menu_slug, $this->parent_slug
        );
        
        if(empty($this->parent_slug)) $this->parent_slug = $this->current_page_slug;
        return $this;
    }
    public function add_section( array $args ){
        if(!empty($this->current_page_slug)): 
            $current_page_slug = $this->current_page_slug;
            $this->pages[$current_page_slug]->add_section($args);
        endif;
        return $this;
    }
    public function add_field( array $args ){
        if(!empty($this->current_page_slug)): 
            $current_page_slug = $this->current_page_slug;
            $this->pages[$current_page_slug]->add_field($args);
        endif;
        return $this;
    }
}