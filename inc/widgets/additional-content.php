<?php
/*
Plugin Name: Post extra content widget
Plugin URI: 
Description: Displays article additional content
Author: Milenko Subotic
Version: 1.1
Author URI: 
*/
 
 
class PostContent extends WP_Widget
{
  function PostContent()
  {
    $widget_ops = array('classname' => 'PostContent', 'description' => 'Displays article extra content' );
    $this->WP_Widget('PostContent', 'Post extra content', $widget_ops);
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
 
    //echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
    $postid = get_the_ID();
    $content = get_post_meta($postid, 'wpcf-additional-content', true);
    if (!empty($content)){
    echo "<div id='post-extra' class='widget PostIssue group'>";
    if (!empty($title))
      echo $before_title . $title . $after_title;;
 
    // WIDGET CODE GOES HERE

    echo $content;   
    echo "</div>";
    }
    //echo $after_widget;
  }
 
}
add_action('widgets_init',function() { register_widget('PostContent'); });
//add_action( 'widgets_init', create_function('', 'return register_widget("PostContent");') );?>