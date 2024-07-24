<?php
    /*
        Template Name: Home Page
        This was originally used for UX magazine and 
        repurposed by Gerry Gaffney
    */
?>
<?php get_header(); ?>

	<ul class="rslides">
	     <?php
	       $options = get_option( 'ux-options-fields' );
	       $section_1 = $options['section-1'];
	       $section_2 = $options['section-2'];
	       $section_3 = $options['section-3'];
	       $query = new WP_Query(array('post_type' => 'slider'));
	       if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
	       $postid = get_the_ID();
	       $image = get_post_meta($postid, 'wpcf-slider-image', true);
	       $url = get_post_meta($postid, 'wpcf-slider-url', true);
	       
	       ?>
	 <li><a href="<?php echo $url;?>" ><img src="<?php echo $image;?>" alt="<?php the_title();?> - <?php echo strip_tags(get_the_content());?>"/><div class="slider-caption"><span><?php the_title();?></span><?php the_content();?></div></a></li>
	<?php endwhile; endif; wp_reset_query();?>
	</ul>
	

	<form action="<?php bloginfo('siteurl'); ?>" id="searchform-mobile" class="group" method="get">
	<label for="s">Search: </label>
	<input class="search" type="text" id="s" name="s" />
	<input type="image" src="<?php echo bloginfo('template_url');?>/images/search-bg.png" id="submit" alt="search"/>
	</form>
	<div class="sidebar home-sidebar-1 " role="complementary">
        <?php if ( !function_exists('dynamic_sidebar')
	|| !dynamic_sidebar('home-widgets-1') ) : ?>
	<?php endif; ?>
	</div>
	<div id="content" role="main">
	     <?php    $query2 = new WP_Query(array('order_by' => 'DESC','posts_per_page' => $section_1,));
	      if ($query2->have_posts()) : while ($query2->have_posts()) : $query2->the_post();
	       ?>
		<div class="post home group">
		   <a class="post-title" href="<?php the_permalink();?>" title="<?php the_title();?>"><h2><?php the_title();?></h2></a>
			
			<!--<?php comments_popup_link('0', '1', '%', 'comments-count', ''); ?>-->
			<div class="home-excerpt group">
			<?php if (has_post_thumbnail()) {?>
			<img class="thumbnail" src="<?php $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' ); echo $thumbnail[0];?>"
						       alt="<?php $alt = get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true);echo $alt;?>"/> 
						       
			<?php } ?>
			<p class="post-authors"><?php ux_authors();?></p>
			<p><?php echo get_the_excerpt();?> <a class="read-more" href="<?php the_permalink();?>" >[<?php ux_read_more_link(); ?>]</a></p>
			</div>
			<!--<a href="<?php the_permalink();?>" class="read-more">Read More</a>-->
			<div class="separator"></div>
		
		</div>
		<?php endwhile; endif; wp_reset_query();?>
	</div>
	<div class="sidebar-sec home-sidebar-2" role="complementary">
        <?php if ( !function_exists('dynamic_sidebar')
	|| !dynamic_sidebar('home-widgets-2') ) : ?>
	<?php endif; ?>
	</div>		
	<div class="sidebar-sec home-ads wide-ads">
	<?php if ( !function_exists('dynamic_sidebar')
	|| !dynamic_sidebar('home-ads') ) : ?>
	<?php endif; ?>
	</div>
	
	<!--
	Omit repeated content at bottom of page
	<div id="content-home" role="main">
	     <?php    $query2 = new WP_Query(array('order_by' => 'DESC','posts_per_page' => $section_2 ,'offset' =>$section_1));
	      if ($query2->have_posts()) : while ($query2->have_posts()) : $query2->the_post();
	       ?>
		<div class="post home">
		      	<a class="post-title" href="<?php the_permalink();?>" title="<?php the_title();?>"><h2><?php the_title();?></h2></a>
			<p class="post-authors"><?php ux_authors();?></p>
			<div class="separator"></div>
		</div>
		<?php endwhile; endif; wp_reset_query();?>
	</div> 
	-->


	<div id="content-bottom" role="main">

	<!--
	Omit RUBES:
	<div class="comic">
	<?php    $query3 = new WP_Query(array('order_by' => 'DESC','posts_per_page' => 1 ,'category_name' =>'rubes'));
	if ($query3->have_posts()) : while ($query3->have_posts()) : $query3->the_post();
	?>
	<a href="<?php the_permalink();?>"><?php grab_attachment_image($post->ID);?></a>
	<?php endwhile; endif; wp_reset_query();?>
	<p class="rubes-copyright"> (c) 2010, Leigh Rubin, Syndicated Cartoonist<br/>
        <?php ux_leigh_blurb(); ?></p>
	</div> 
	-->
	
	<!-- 
	Omit "posts" at bottom of page
	<div class="posts">
	     <?php    $query2 = new WP_Query(array('order_by' => 'DESC','posts_per_page' => $section_3 ,'offset' =>$section_1+$section_2));
	      if ($query2->have_posts()) : while ($query2->have_posts()) : $query2->the_post();
	       ?>
			<a class="post-title-small" href="<?php the_permalink();?>" title="<?php the_title();?>"><h2><?php the_title();?></h2></a>
			<p class="post-authors"><?php ux_authors();?></p>
			
	<?php endwhile; endif; wp_reset_query();?>
	</div> 
	-->
	
	</div>

	<div class="sidebar-sec home-ads mobile-ads" role="complementary">
	<?php if ( !function_exists('dynamic_sidebar')
	|| !dynamic_sidebar('home-ads') ) : ?>
	<?php endif; ?>
	</div>

	
	<div class="sidebar-sec mobile-sec" role="complementary">
        <?php if ( !function_exists('dynamic_sidebar')
	|| !dynamic_sidebar('home-widgets-2') ) : ?>
	<?php endif; ?>
	</div>

        <?php get_footer(); ?>