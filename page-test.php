<?php
    /*
        Template Name: Test page
        
    */
?>

<?php get_header(); ?>
	<form action="<?php bloginfo('siteurl'); ?>" id="searchform-mobile" class="group" method="get">
	<label for="s">Search: </label>
	<input class="search" type="text" id="s" name="s" />
	<input type="image" src="<?php echo bloginfo('template_url');?>/images/search-bg.png" id="submit" alt="search"/>
	</form>
<div id="content-full" role="main">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
		<div class="post" id="post-<?php the_ID(); ?>">
			<div class="title-area">
			<h1><?php the_title(); ?></h1>
			</div>
			

			<div class="entry">
				<?php if(isset($_SESSION['ux_legit'])&&($_SESSION['ux_legit']=='1')){
				the_content();
				}
				else{ 
				the_excerpt();
				?>
			 <div id="ux-wrap" class="group">

				<div class="ux-left">
				
				<h3>For UXPA members</h3>
				<a class="ux-link form-expand"  href="#">Read full article</a>
				</div>
				<div class="ux-right">
				<h3>Not a member?</h3>
				<a class="ux-link" href="http://www.uxpa.org/membership/global-sustaining-member" target="_blank">Join UXPA</a>
				</div>

				<form id="uxforms" method="POST" >
				<label for="username" >UXPA user name, ID or email address</label>
				<input type="text" name="username" id="UxId" placeholder="UXPA ID or email address here" required/>
				<label for="password" >UXPA password</label>
				<input type="password" name="password" id="UxPass" placeholder="UXPA password here" required/>

				<?php wp_nonce_field('security-checker-nonce-uxpa','ux_nonce'); ?>
				<input type="submit" value="Sign In" id="uxlogins"/>
				<a style="margin: 2% 15%;" href="http://www.uxpa.org/user/password" target="_blank">Forgot your password?</a>
				<div id="progress"></div>
				
			 </form>
			 </div>
					<?php }?>


			</div>
			
			<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
	
		</div>
		


		<?php endwhile; endif; ?>
</div>
<?php get_footer(); ?>