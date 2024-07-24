<?php get_header(); ?>
	<form action="<?php bloginfo('siteurl'); ?>" id="searchform-mobile" class="group" method="get">
	<label for="s">Search: </label>
	<input class="search" type="text" id="s" name="s" />
	<input type="image" src="<?php echo bloginfo('template_url');?>/images/search-bg.png" id="submit"  alt="search"/>
	</form>
<div id="content" role="main">
	<?php if (have_posts()) : ?>
		<div class="title-area">
		<h2>Search Results</h2>
		</div>
		<?php while (have_posts()) : the_post(); ?>

			<div class="post home group">
			<a class="post-title" href="<?php the_permalink();?>" title="<?php the_title();?>"><h2><?php the_title();?></h2></a>
			<p class="post-authors"> <?php ux_authors();?> - <?php ux_issue(", ");?></p>
			<!--<?php comments_popup_link('0', '1', '%', 'comments-count', ''); ?>-->
			<div class="home-excerpt group">
			<?php the_excerpt();?>
			</div>
			<a href="<?php the_permalink();?>" class="read-more">Read More</a>
			<div class="separator"></div>
		
			</div>

		<?php endwhile; ?>


	<?php else : ?>

		<h2>No posts found.</h2>

	<?php endif; ?>
</div>
<?php get_sidebar(); ?>

<?php get_footer(); ?>