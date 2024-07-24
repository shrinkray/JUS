<?php
    /*
        Template Name: Test Page
    */
?>
<?php get_header(); ?>
<div id="content">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<div class="title-area">
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<p class="post-authors">by <?php ux_authors();?></p>
			</div>

			<div class="entry">
	        	 <?php
			if ( is_user_logged_in() ) {
			?>

			<?php
			 the_content();

			 ?>
			 <div class="separator"></div>
			 
			<?php
			the_tags('<p class="post-meta">Topics: ',', ','</p>');
			?>
			<p class="post-meta">Published in: 
			<?php ux_issue(', ');?>
			</p>
			<div class="separator"></div>
			<?php
			comments_template();
			} else {
			 the_excerpt();
			
			 ?>
			 <div id="ux-wrap" class="group">
				<div class="ux-left">
				<h3>For UXPA members</h3>
				<a class="ux-link form-expand"  href="#">Read full article</a>
				</div>
				<div class="ux-right">
				<h3>Not a member?</h3>
				<a class="ux-link" href="" target="_clank">Join UXPA</a>
				</div>
				 <form id="uxform" action="">
				<label for="username" >UXPA id:</label>
				<input type="text" name="username" id="UxId" placeholder="UXPA id here"/>
				<label for="username" >UXPA password:</label>
				<input type="password" name="password" id="UxPass" placeholder="UXPA password here"/>
				<?php wp_nonce_field('security-checker-nonce-uxpa','ux_nonce'); ?>
				<input type="submit" value="SUBMIT" id="uxlogin" disabled/>
				<div id="progress"></div>
			 </form>
			 </div>
			 <?php
			}
			
			?> 


				
			</div>
			
			<?php edit_post_link('Edit this entry','','.'); ?>
			
		</div>


	<?php endwhile; endif; ?>
		</div>
	<div class="sidebar ">
        <?php if ( !function_exists('dynamic_sidebar')
	|| !dynamic_sidebar('single-widgets') ) : ?>
	<?php endif; ?>
	</div>

<?php get_footer(); ?>