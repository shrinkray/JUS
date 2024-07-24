<?php
add_action( 'admin_menu', 'ux_options' );  
function ux_options() {  
        add_menu_page( 'UX Theme Options', 'UX Theme Options ', 'edit_theme_options', 'ux_options_page', 'ux', get_template_directory_uri().'/images/options.png' );  
}  
function ux() {  
?>
<div class="wrap">  
            <div><br></div>  
            <h2>UX theme options</h2>  
      
            <form method="post" action="options.php">  
                <?php wp_nonce_field( 'update-options-nonce' ); ?>
                <?php settings_fields( 'ux-options-fields' ); ?>
                <?php do_settings_sections( 'ux-options-fields' ); ?>
                <?php submit_button(); ?>
                </form>  
        </div>  
<?php  
}  
      
    add_action( 'admin_init', 'my_register_admin_settings' );  
    function my_register_admin_settings() {  
        register_setting( 'ux-options-fields', 'ux-options-fields' );  
        add_settings_section( 'ux-options-section', 'Home page settings', 'options_description', 'ux-options-fields' );  
        add_settings_field( 'section-1', 'Number of posts in current issue (inc introduction):', 'section_one_field', 'ux-options-fields', 'ux-options-section' );  

        # add_settings_field( 'section-2', 'Number of posts in second section:', 'section_two_field', 'ux-options-fields', 'ux-options-section' );
        # add_settings_field( 'section-3', 'Number of posts in third section:', 'section_three_field', 'ux-options-fields', 'ux-options-section' );  

}
    function options_description(){
}
    function section_one_field() {  
        $options = (array) get_option( 'ux-options-fields' );  
        $current = '2';  
      
        if ( isset( $options['section-1'] ) )  
            $current = $options['section-1'];  
?>
<input type="text" name="ux-options-fields[section-1]" value="<?php echo $current;?>"  />
<?php  
    }  
 function section_two_field() {  
        $options = (array) get_option( 'ux-options-fields' );  
        $current = '2';  
      
        if ( isset( $options['section-2'] ) )  
            $current = $options['section-2'];  
        ?>
        <input type="text" name="ux-options-fields[section-2]" value="<?php echo $current;?>"  />
<?php  
    }
     function section_three_field() {  
        $options = (array) get_option( 'ux-options-fields' );  
        $current = '2';  
      
        if ( isset( $options['section-3'] ) )  
            $current = $options['section-3'];  
?>
<input type="text" name="ux-options-fields[section-3]" value="<?php echo $current;?>"  />
<?php  
    }  
?>