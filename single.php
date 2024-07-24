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


<?php
			// Adds the "Article type" above the body
			$JUS_article_type = types_render_field("article_type", array("output"=>"raw"));
			if ($JUS_article_type){ 
			// Output the article type
			printf("<p class='article_type'>");
			printf($JUS_article_type);
			printf("</p>");
			}
			

			// Add the "pp" page number
			$pdf_page_numbers = types_render_field("pages", array("output"=>"raw"));
			if ($pdf_page_numbers){ 
			// Output the page numbers
			printf("<strong>pp</strong>. %s",$pdf_page_numbers);
			}
			

			// Add the "download PDF" link
			$pdf_filename = types_render_field("pdf-file", array("output"=>"raw"));

			if ($pdf_filename){ 
                        // Get the upload directory info (so that we're independent of base URL)
                        $upload_dir = wp_upload_dir();
                        $full_url  = types_render_field("pdf-file", array("post_id" => get_the_ID()));

                        // $full_url = $upload_dir['baseurl']."/pdf/".$pdf_filename; 
                        printf ("<a class='article_link' href=".$full_url.">Download full article (PDF)</a>");
			}
			?>










			<p></p>
			</div>

			<div class="entry">


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