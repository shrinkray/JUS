<?php get_header(); ?>
	<form action="<?php bloginfo('siteurl'); ?>" id="searchform-mobile" class="group" method="get">
	<label for="s">Search: </label>
	<input class="search" type="text" id="s" name="s" />
	<input type="image" src="<?php echo bloginfo('template_url');?>/images/search-bg.png" id="submit"  alt="search"/>
	</form>


	<!-- Remove the sliders because curently JUS doesn't have an image for each issue:

	<ul class="rslides">
	 <li><img src="<?php get_issue_meta('cover');?>" alt="<?php get_issue_meta('title'); ?>" /><div class="slider-caption"><span><?php get_issue_meta('title');?></span><p><?php _(term_description( '', get_query_var( 'issue' ) ));?></p></div></li>
	</ul>
	-->

	<div class="sidebar " role="complementary">
        <?php if ( !function_exists('dynamic_sidebar')
	|| !dynamic_sidebar('issue-widgets') ) : ?>
	<?php endif; ?>
	</div>

<div id="content" class="group" role="main">

		<?php
		if (have_posts()) : ?>

 			<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
			<?php while (have_posts()) : the_post(); ?>
			
			<div class="post home group">
			<a class="post-title" href="<?php the_permalink();?>" title="<?php the_title();?>"><h2><?php the_title();?></h2></a>
			<!--<?php comments_popup_link('0', '1', '%', 'comments-count', ''); ?>-->
			<div class="home-excerpt group">
			<?php if (has_post_thumbnail()) {?>
			<img class="thumbnail" src="<?php $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' ); echo $thumbnail[0];?>"
						       alt="<?php $alt = get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true);echo $alt;?>" title="<?php echo get_the_title();?>"/> 
						       
			<?php } ?>
			<p class="post-authors"><?php ux_authors();?></p>
			<p><?php echo get_the_excerpt();?> <a class="read-more" href="<?php the_permalink();?>" >[<?php ux_read_more_link(); ?>]</a></p>
			</div>
			<div class="separator"></div>
		
			</div>

			


	<?php endwhile; endif; ?>

</div>
 	<div class="sidebar-sec home-ads wide-ads" role="complementary">
	<?php if ( !function_exists('dynamic_sidebar')
	|| !dynamic_sidebar('home-ads') ) : ?>
	<?php endif; ?>
	</div> 
	<div class="sidebar-sec home-ads mobile-ads" role="complementary">
	<?php if ( !function_exists('dynamic_sidebar')
	|| !dynamic_sidebar('home-ads') ) : ?>
	<?php endif; ?>
	</div>


<?php get_footer(); ?>