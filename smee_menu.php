<?php 
class smee_menu_page{
    private $parent_slug = null;
    private $pages = [];
    private $current_page_slug = null; //Apunta a la página usada recientemente

    public function add_page(  ){
        $args = func_get_args();
        $func_num_args = func_num_args();
        if( $func_num_args === 1 ):
            if(is_array($args[0])):
                extract($args[0]);
            else:
                die('not valid');
            endif;
            //showArrayAndDie($args[0]);
        elseif( $func_num_args === 4):
            $page_title = $args[0];
            $menu_title = $args[1];
            $capability = $args[2];
            $menu_slug  = $args[3];
        else: 
            die('not valid');            
        endif;

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

    public function borjis_builder(array $configuration_pages){
        foreach( $configuration_pages as $page_slug => $configuration_page ):
            $this->add_page($configuration_page['page_attrs']);
            foreach($configuration_page['sections'] as $section_slug => $section ):
                $this->add_section($section['section_attrs']);
                foreach( $section['fields'] as $field_slug => $field ):
                    $this->add_field($field);
                endforeach;
            endforeach;
        endforeach;
        return $this;

    }
}