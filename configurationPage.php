<?php
class configurationPage{
    private $page_title ;
    private $menu_title;
    private $menu_slug;
    private $function='';
    private $capability='';
    private $icon_url='';
    private $position='';
    private $parent_slug = null;
    private $subpages=[];
    private $prefix='smee_';

    function __construct( string $page_title, string $menu_title, string $capability, string $menu_slug, string $parent_slug = null){
        $this->page_title  = $page_title;
        $this->menu_title  = $menu_title;
        $this->capability  = $capability;
        $this->menu_slug   = $menu_slug;
        $this->parent_slug = $parent_slug;
        
       
        add_action('admin_init', [$this,'admin_init']);
        add_action('admin_menu', [$this,'admin_menu']);
    }
    
    public function add_section( array $args ){

    }
    public function add_page(string $page_title, string $menu_title, string $capability, string $menu_slug){
        return $this;
        if( ! empty($this->parent_slug )) return $this;
        $this->subpages[$menu_slug] = new configurationPage (
            $page_title, $menu_title, $capability, $menu_slug, $this->menu_slug
        );
    }
    
    public function admin_init(){
        register_setting( 'wporg', $this->prefix . $this->menu_slug );

        add_settings_section(
            'wporg_section_developers',
            __( 'The Matrix has you.', 'wporg' ),
            'wporg_section_developers_cb',
            'wporg'
        );
            
            // register a new field in the "wporg_section_developers" section, inside the "wporg" page
        add_settings_field(
            'wporg_field_pill', // as of WP 4.6 this value is used only internally
            // use $args' label_for to populate the id inside the callback
            __( 'Pill', 'wporg' ),
            [$this,'wporg_field_pill_cb'],
            'wporg',
            'wporg_section_developers',
            [
                'label_for'         => 'wporg_field_pill',
                'class'             => 'wporg_row',
                'wporg_custom_data' => 'custom',
            ]
        );
    }
    function wporg_field_pill_cb( $args ) {
        // get the value of the setting we've registered with register_setting()
        $options = get_option( $this->prefix . $this->menu_slug );
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
    public function admin_menu(){
        add_menu_page(
            $this->page_title,
            $this->menu_title,
            $this->capability,
            $this->menu_slug,
            [$this,'wporg_options_page_html']
        );
        
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
        settings_fields( 'wporg' );
        // output setting sections and their fields
        // (sections are registered for "wporg", each field is registered to a specific section)
        do_settings_sections( 'wporg' );
        // output save settings button
        submit_button( 'Save Settings' );
        ?>
        </form>
        </div>
        <?php
       }
    
       public function render(){
        
    }
    
     
}