<?php
    /*
        Template Name: Newsstand Page
    */
?>
<?php get_header(); ?>
	<form action="<?php bloginfo('siteurl'); ?>" id="searchform-mobile" class="group" method="get">
	<label for="s">Search: </label>
	<input class="search" type="text" id="s" name="s" />
	<input type="image" src="<?php echo bloginfo('template_url');?>/images/search-bg.png" id="submit"  alt="search"/>
	</form>
<div id="content-full" role="main">
		
		<div class="post">
			<div class="title-area">
			<h1><?php the_title();?></h1>
			</div>
			<?php
			$args=array(
			'hide_empty' => 0,
			'orderby' => 'name',
			'posts_per_page' => 50,
			'order' => 'ASC'
			);
			wp_reset_query();
			$issues= get_terms('issue', $args);
			foreach ($issues as $issue ) {
			if ( (get_issue_published($issue)=='on') || (get_issue_published($issue)=='1') ){
			?>

			<div class="JUS-newsstand-wrapper">
			
			
			<h2><?php  _e($issue->name, 'uxpa') ;?></h2>
			<p><?php  _e($issue->description, 'uxpa') ;?></p>
			
			

			<p>Here's an article!</p>			
			



			</div>
			<?php
			}

			else{continue;}
			}
			?>


		</div>
		


</div>
<?php get_footer(); ?>