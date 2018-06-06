<?php
class configurationPage{
    /* WP non optionals */
    private $menu_slug;
    private $menu_title;
    private $page_title ;
    
    // WP optionals
    private $capability  = '';
    private $function    = '';
    private $icon_url    = '';
    private $parent_slug = null;
    private $position    = '';
 
    // SMEE props
    private $prefix      = 'smee_';
    private $sections    = [];

    private $recent_section = '';
    
    function __construct( string $page_title, string $menu_title, string $capability, string $menu_slug, string $parent_slug = null){
        $this->page_title  = $page_title;
        $this->menu_title  = $menu_title;
        $this->capability  = $capability;
        $this->Menu_Slug   = $menu_slug; 
        $this->parent_slug = $parent_slug;
        $this->sections=[];
        

        add_action('admin_init', [$this,'admin_init']);
        add_action('admin_menu', [$this,'admin_menu']);
    }

    function __get($name){
        switch( $name ):
            case 'Page_Slug':
                return $this->menu_slug;
            case 'Domain':
                return SMEE_PLUGIN_DOMAIN;
            case 'Option_Group':
                return $this->Page_Slug;
            case 'Option_Name':
                return $this->prefix . $this->menu_slug;
            default:
        endswitch;
    }

    function __set($name, $value){
        switch( $name ):
            case 'Menu_Slug':
                $this->menu_slug = str_replace(' ','_', strtolower($value));
            default:
        endswitch;
    }

    public function add_section( array $args ){
        extract($args);
        $this->recent_section = $id;
            $this->sections[$id] = new section ([
                'id'    => $id,
                'title' => $title,
                'page'  => $this->menu_slug
            ],false);
        return $this;
    }
    public function add_field( array $args ){
        extract($args);  
        $section_id = $this->recent_section;
        //callable
        if(!empty($section_id)):
            $add_field = 'add_' . $args['type'];
            $this->sections[$section_id]->$add_field([
                'name'  => $this->set_field_name($section_id, $name),
                'id'    => $name,
                'label' => $args['label'],
                'placeholder' => $args['placeholder'],
            ]);
        endif;

        return $this;
    }

    public function admin_init(){
        register_setting( $this->Option_Group, $this->Option_Name );
        $page_settings=get_option($this->Option_Name);
       /*showText($this->Page_Slug);
       showArray($this->sections);*/
        foreach( $this->sections as $section_id => $section ):
            add_settings_section(
                $section->ID,
                __( $section->Title, $this->Domain ),
                [$section,'render'],
                $this->Page_Slug
            );
            foreach($section->Fields as $field_id => $field):
                $field ->Value = $page_settings[$section_id][$field_id];
                add_settings_field(
                    $field->ID,
                    __( $field->Label, $this->Domain ),
                    [$field,'render'],
                    $this->Page_Slug,
                    $section->ID,
                    
                    [
                        'label_for'         => $field->ID,
                        'class'             => 'wporg_row',
                        'wporg_custom_data' => 'custom',
                    ]
                );
            endforeach;
                // register a new field in the "wporg_section_developers" section, inside the "wporg" page
        endforeach;

    }
    public function admin_menu(){
        $parent_slug = $this->parent_slug;
       
        if(empty($parent_slug)):
            $parent_slug = $this->menu_slug;
            add_menu_page(
                $this->page_title,
                $this->menu_title,
                $this->capability,
                $this->menu_slug,
                [$this,'wporg_options_page_html']
            );
        else:
        endif;
        /*showText($parent_slug, '$parent_slug');
        showText($this->menu_slug, '$this->menu_slug');*/
        add_submenu_page( 
            $parent_slug,
            $this->page_title,
            $this->menu_title,
            $this->capability,
            $this->menu_slug,
            [$this,'wporg_options_page_html']
        );
        //showText($parent_slug);
    }
    private function set_field_name(string $section_name, string $field_name){
        return $this->Option_Name . "[$section_name][$field_name]";
    }
    function crear_campos( $args ) {
        // get the value of the setting we've registered with register_setting()
        $options = get_option( $this->Option_Name );
        // output the field
        ?>
        <select id="<?php echo esc_attr( $args['label_for'] ); ?>"
        data-custom="<?php echo esc_attr( $args['wporg_custom_data'] ); ?>"
        name="<?php echo $this->prefix . $this->menu_slug ?>[<?php echo esc_attr( $args['label_for'] ); ?>]"
        >
        <option value="red" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'red', false ) ) : ( '' ); ?>>
        <?php esc_html_e( 'red pill', 'wporg' ); ?>
        </option>
        <option value="blue" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'blue', false ) ) : ( '' ); ?>>
        <?php esc_html_e( 'blue pill', 'wporg' ); ?>
        </option>
        </select>
        <p class="description">
        <?php esc_html_e( 'You take the blue pill and the story ends. You wake in your bed and you believe whatever you want to believe.', 'wporg' ); ?>
        </p>
        <p class="description">
        <?php esc_html_e( 'You take the red pill and you stay in Wonderland and I show you how deep the rabbit-hole goes.', 'wporg' ); ?>
        </p>
        <?php
    }
    function wporg_options_page_html() {
        // check user capabilities
        if ( ! current_user_can( 'manage_options' ) ) {
        return;
        }
        
        // add error/update messages
        
        // check if the user have submitted the settings
        // wordpress will add the "settings-updated" $_GET parameter to the url
        if ( isset( $_GET['settings-updated'] ) ) {
        // add settings saved message with the class of "updated"
        add_settings_error( 'wporg_messages', 'wporg_message', __( 'Settings Saved', 'wporg' ), 'updated' );
        }
        
        // show error/update messages
        settings_errors( 'wporg_messages' );
        ?>
        <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form action="options.php" method="post">
        <?php
        // output security fields for the registered setting "wporg"
        settings_fields( $this->Option_Group );
        // output setting sections and their fields
        // (sections are registered for "wporg", each field is registered to a specific section)
        do_settings_sections( $this->Page_Slug );
        // output save settings button
        submit_button( 'Save Settings' );
        ?>
        </form>
        </div>
        <?php
       }
    
       public function render(){
        
    }
    public function borgis_builder(){
        
    }
    

    function crea_secciones( $args ) {
    ?>
        <p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Follow the white rabbit.', $this->Domain ); ?></p>
    <?php
    }
     
}