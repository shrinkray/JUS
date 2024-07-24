<?php function greybox_fn($atts, $content = null ){
$output="<div class=\"greybox\">";
$output.=$content;
$output.="</div>";
return $output;
}
add_shortcode('greybox', 'greybox_fn');  
function bluebox_fn($atts, $content = null ){
$output="<div class=\"bluebox\">";
$output.=$content;
$output.="</div>";
return $output;
}
add_shortcode('bluebox', 'bluebox_fn');
add_action('init', 'add_button');
function add_button() {  
       if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )  
       {  
         add_filter('mce_external_plugins', 'add_plugin');  
         add_filter('mce_buttons', 'register_button');  
       }  
}
function register_button($buttons) {  
      array_push($buttons, "Greybox");  
      return $buttons;  
}
function add_plugin($plugin_array) {  
     $plugin_array['greybox'] = get_bloginfo('template_url').'/js/admin.js';  
     return $plugin_array;  
}
add_action('init', 'add_button_blue');
function add_button_blue() {  
       if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )  
       {  
         add_filter('mce_external_plugins', 'add_plugin_blue');  
         add_filter('mce_buttons', 'register_button_blue');  
       }  
}
function register_button_blue($buttons) {  
      array_push($buttons, "Bluebox");  
      return $buttons;  
}
function add_plugin_blue($plugin_array) {  
     $plugin_array['bluebox'] = get_bloginfo('template_url').'/js/admin.js';  
     return $plugin_array;  
}
?>