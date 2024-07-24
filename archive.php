<?php get_header(); ?>
	<form action="<?php bloginfo('siteurl'); ?>" id="searchform-mobile" class="group" method="get">
	<label for="s">Search: </label>
	<input class="search" type="text" id="s" name="s" />
	<input type="image" src="<?php echo bloginfo('template_url');?>/images/search-bg.png" id="submit" alt="search"/>
	</form>
<div id="content" class="group" role="main">
		<?php if (have_posts()) : ?>

 			<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

			<?php /* If this is a category archive */ if (is_category()) { ?>
			<div class="title-area">
				<h2>All <?php single_cat_title(); ?> articles</h2>
			</div>
			<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
			<div class="title-area">
				<h2>Articles about <?php single_tag_title(); ?></h2>
			</div>
			<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
				<h2>Archive for <?php the_time('F jS, Y'); ?></h2>

			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
				<h2>Archive for <?php the_time('F, Y'); ?></h2>

			<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
				<h2>Archive for <?php the_time('Y'); ?></h2>


			<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				<h2>Blog Archives</h2>
			
			<?php } ?>

			<?php include (TEMPLATEPATH . '/inc/nav.php' ); ?>

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

			<?php endwhile; ?>

			
	<?php else : ?>

		<h2>Nothing found</h2>

	<?php endif; ?>
</div>
<?php get_sidebar(); ?>

<?php get_footer(); ?>