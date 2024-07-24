	<a id="toTop" title="Scroll to top"></a>
	</div>
	<div id="footer-wrap">
		<div id="footer" class="group" role="contentinfo">
			<?php if ( !function_exists('dynamic_sidebar')
			|| !dynamic_sidebar('footer-widgets') ) : ?>
			<?php endif; ?>
			<?php wp_nav_menu(    array( 
                            'show_description' => false,
                            'menu' => 'main-nav', 
                            'items_wrap'     => '<label for="select-nav-footer" class="hide">Select a page</label><select class="selectnav" id="select-nav-footer"><option value="">Select a page...</option>%3$s</select>',
                            'container' => false,
                            'walker'  => new Walker_Nav_Menu_Dropdown(),
                            'theme_location' => 'main-menu'));
			?>
		<p class="copyright">© Copyright <?php echo date('Y');?> UXPA | All rights reserved | uxmagazine@usabilityprofessionals.org</p>
		</div>
	</div>
	<?php wp_footer(); ?>
</body>
</html>
