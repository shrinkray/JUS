<?php
function add_custom_taxonomies() {
	// Add new "Locations" taxonomy to Posts
register_taxonomy('issue', 'post', array(
		// Hierarchical taxonomy (like categories)
		'hierarchical' => true,
		// This array of options controls the labels displayed in the WordPress Admin UI
		'labels' => array(
			'name' => _x( 'Issue', 'taxonomy general name' ),
			'singular_name' => _x( 'Issue', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Issues' ),
			'all_items' => __( 'All Issues' ),
			'parent_item' => __( 'Parent Issue' ),
			'parent_item_colon' => __( 'Parent Issue:' ),
			'edit_item' => __( 'Edit Issue' ),
			'update_item' => __( 'Update Issue' ),
			'add_new_item' => __( 'Add New Issue' ),
			'new_item_name' => __( 'New Issue Name' ),
			'menu_name' => __( 'Issues' ),
		),
                'rewrite' => array(
			'slug' => 'issue', // This controls the base slug that will display before each term
			'with_front' => false, // Don't display the category base before "/locations/"
			'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
		),
		// Control the slugs used for this taxonomy
		
	));
}
add_action( 'init', 'add_custom_taxonomies', 0 );

global $meta_sections;
$meta_sections = array();
// first meta section
$meta_sections[] = array(
'title' => 'Issue Details', // section title
'taxonomies' => array('issue'), // list of taxonomies. Default is array('category', 'post_tag'). Optional
'id' => 'issue_details', // ID of each section, will be the option name
'fields' => array( // list of meta fields
array(
'name' => 'Banner Cover', // field name
'desc' => 'Format: 920px x 310px', // field description, optional
'id' => 'image', // field id, i.e. the meta key
'type' => 'image', // text box
'std' => '', // default value, optional
),
array(
'name' => 'Full Size Cover', // field name
'desc' => 'Format: 212px x 274px', // field description, optional
'id' => 'image-full', // field id, i.e. the meta key
'type' => 'image', // text box
'std' => '', // default value, optional
),
	array(
'name' => 'Issue Date: ',
'id' => 'issue_date',
'type' => 'date',	// time
'format' => 'MM, yy'	// time format, default hh:mm. Optional. See more formats here: http://goo.gl/hXHWz
),
array(
'name' => 'Editor Notes: ',
'id' => 'notes',
'type' => 'textarea',	// time
'desc' => 'Short introduction to the issue.'
),
array(
'name' => 'Published',	// checkbox
'id' => 'issue_published',
'type' => 'checkbox',
'desc' => 'Check to publish the issue on website'
),
array(
'name' => 'Protected',	// checkbox
'id' => 'issue_protected',
'type' => 'checkbox',
'desc' => 'Restrict access to UXPA members only'
)
)
);

function issue_register_taxonomy_meta_boxes()
{
// Make sure there's no errors when the plugin is deactivated or during upgrade
if ( !class_exists( 'RW_Taxonomy_Meta' ) )
return;

global $meta_sections;
foreach ( $meta_sections as $meta_section )
{
new RW_Taxonomy_Meta( $meta_section );
}
}
add_action( 'admin_init', 'issue_register_taxonomy_meta_boxes' );

function get_issue_meta($meta_field){
$terms = get_the_terms( $post->ID, 'issue' );
if ($terms){
foreach ($terms as $term){
$term_id = $term-> term_id;
$term_title = $term-> name;
}
$meta = get_option('issue_details');
if (empty($meta)) $meta = array();
if (!is_array($meta)) $meta = (array) $meta;
$meta = isset($meta[$term_id]) ? $meta[$term_id] : array();
if ($meta_field=="cover"){
$issue_cover= $meta['image'];
foreach ($issue_cover as $att) {
// get image's source based on size, can be 'thumbnail', 'medium', 'large', 'full' or registed post thumbnails sizes
$src = wp_get_attachment_image_src($att, 'full');
echo $src[0];
}
}
else if($meta_field=="date"){
    $issue_date= $meta['issue_date'];
    _e($issue_date);
}
else if($meta_field=="title"){
     _e($term_title);
}
else if($meta_field=="notes"){
    $issue_notes= $meta['notes'];
     _e($issue_notes); 
}
else if($meta_field=="protected"){
    $issue_protected= $meta['issue_protected'];
    return $issue_protected;
}
else if($meta_field=="published"){
    $issue_published= $meta['issue_published'];
    return $issue_published;
}
}
}
function get_issue_published($issue){
$term_id = $issue-> term_id;
$term_title = $issue-> name;
$meta = get_option('issue_details');
if (empty($meta)) $meta = array();
if (!is_array($meta)) $meta = (array) $meta;
$meta = isset($meta[$term_id]) ? $meta[$term_id] : array();
$issue_published= $meta['issue_published'];
return $issue_published;   
}
function get_issue_cover_full($issue){
$term_id = $issue-> term_id;
$term_title = $issue-> name;
$meta = get_option('issue_details');
if (empty($meta)) $meta = array();
if (!is_array($meta)) $meta = (array) $meta;
$meta = isset($meta[$term_id]) ? $meta[$term_id] : array();

$issue_cover= $meta['image-full'];
foreach ($issue_cover as $att) {
// get image's source based on size, can be 'thumbnail', 'medium', 'large', 'full' or registed post thumbnails sizes
$src = wp_get_attachment_image_src($att, 'full');
return $src[0];
}
}

//Callback to set up the metabox  
function myprefix_mytaxonomy_metabox( $post ) {  
    //Get taxonomy and terms  
    $taxonomy = 'issue';  
  
    //Set up the taxonomy object and get terms  
    $tax = get_taxonomy($taxonomy);  
    $terms = get_terms($taxonomy,array('hide_empty' => 0));  
  
    //Name of the form  
    $name = 'tax_input[' . $taxonomy . ']';  
  
    //Get current and popular terms  
    $postterms = get_the_terms( $post->ID,$taxonomy );  
    $current = ($postterms ? array_pop($postterms) : false);  
    $current = ($current ? $current->term_id : 0);  
    ?>  
  
    <div id="taxonomy-<?php echo $taxonomy; ?>" class="categorydiv">  
  
        <!-- Display tabs-->  
        <ul id="<?php echo $taxonomy; ?>-tabs" class="category-tabs">  
            <li class="tabs"><a href="#<?php echo $taxonomy; ?>-all" tabindex="3"><?php echo $tax->labels->all_items; ?></a></li>  
        </ul>  
  
        <!-- Display taxonomy terms -->  
        <div id="<?php echo $taxonomy; ?>-all" class="tabs-panel">  
            <ul id="<?php echo $taxonomy; ?>checklist" class="list:<?php echo $taxonomy?> categorychecklist form-no-clear">  
                <?php   foreach($terms as $term){  
                    $id = $taxonomy.'-'.$term->term_id;  
                    echo "<li id='$id' style='margin-bottom:5px;'><label class='selectit'>";  
                    echo "<input type='radio' id='in-$id' name='{$name}'".checked($current,$term->term_id,false)."value='$term->term_id' />$term->name - $term->description<br />";  
                   echo "</label></li>";  
                }?>  
           </ul>  
        </div>  
  
       
  
    </div>  
    <?php  
}
    add_action( 'admin_menu', 'myprefix_remove_meta_box');  
    function myprefix_remove_meta_box(){  
       remove_meta_box('issuediv', 'post', 'normal');  
    }
     add_action( 'add_meta_boxes', 'myprefix_add_meta_box');  
 function myprefix_add_meta_box() {  
     add_meta_box( 'mytaxonomy_id', 'Issue','myprefix_mytaxonomy_metabox','post' ,'side','core');  
 }  
  
 
?>