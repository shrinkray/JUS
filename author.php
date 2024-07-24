<?php get_header(); ?>
	<form action="<?php bloginfo('siteurl'); ?>" id="searchform-mobile" class="group" method="get">
	<label for="s">Search: </label>
	<input class="search" type="text" id="s" name="s" />
	<input type="image" src="<?php echo bloginfo('template_url');?>/images/search-bg.png" id="submit" alt="search"/>
	</form>
<div id="content" class="group" role="main">
	<div class="title-area group">
	<h2>Articles by
	<?php echo get_the_author_meta( 'display_name' ); ?></h2>
	<p><?php
	$email = get_the_author_meta( 'email' );
	 echo get_avatar( $email, '50' ); _e(get_the_author_meta( 'description' )); ?></p>
	</div>
		<?php if (have_posts()) : ?>

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
			<p class="post-authors">by <?php ux_authors();?></p>
			<p><?php echo get_the_excerpt();?> <a class="read-more" href="<?php the_permalink();?>" >[<?php ux_read_more_link(); ?>]</a></p>
			</div>
			<div class="separator"></div>
		
			</div>

	<?php endwhile; endif; ?>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>