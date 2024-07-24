<?php
/*
Plugin Name: Post Author Widget
Plugin URI: 
Description: Displays article authors and their bio
Author: Milenko Subotic
Version: 1.1
Author URI: 
*/
 
 
class PostAuthor extends WP_Widget
{
  function PostAuthor()
  {
    $widget_ops = array('classname' => 'PostAuthor', 'description' => 'Displays article authors' );
    $this->WP_Widget('PostAuthor', 'Post authors', $widget_ops);
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
    $coauthors = get_coauthors();
    echo "<ul class='authors-list'>";
      foreach( $coauthors as $coauthor ){
        
        echo "<li class='group'>";
      //$avtr = get_avatar( $coauthor->ID, 50, '' );
      echo get_avatar( $coauthor->user_email, '50' );
      echo "<a href='".get_bloginfo('url')."/author/".$coauthor->user_nicename."'>".$coauthor->display_name."</a>";
      echo "<br/><p>";
      _e($coauthor->description);
      echo "</p>";
      echo "</li>";
      };
  echo "</ul>";
    echo $after_widget;
  }
 
}
add_action('widgets_init',function() { register_widget('PostAuthor'); });
//add_action( 'widgets_init', create_function('', 'return register_widget("PostAuthor");') );
?>