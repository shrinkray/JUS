<?php
/*
Plugin Name: Issue Notes Widget
Plugin URI: 
Description: Displays article issue
Author: Milenko Subotic
Version: 1
Author URI: 
*/
 
 
class IssueNotes extends WP_Widget
{
  function IssueNotes()
  {
    $widget_ops = array('classname' => 'IssueNotes', 'description' => 'Displays issue editor notes.' );
    $this->WP_Widget('IssueNotes', 'Issue Notes', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
 
    if (!empty($title))
      echo $before_title . $title . $after_title;;
 
    // WIDGET CODE GOES HERE
    get_issue_meta('notes');
    echo $after_widget;
  }
 
}
add_action('widgets_init',function() { register_widget('IssueNotes'); });
//add_action( 'widgets_init', create_function('', 'return register_widget("IssueNotes");') );?>