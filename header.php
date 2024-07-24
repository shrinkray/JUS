<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="<?php bloginfo('charset'); ?>" />
	<title>
		   <?php
		      if (function_exists('is_tag') && is_tag()) {
		         single_tag_title("Topic Archive for &quot;"); echo '&quot; - '; }
		      elseif (is_archive()) {
		         wp_title(''); echo ' Archive - '; }
		      elseif (is_search()) {
		         echo 'Search for &quot;'.wp_specialchars($s).'&quot; - '; }
		      elseif (!(is_404()) && (is_single()) || (is_page())) {
		         wp_title('');  }
		      elseif (is_404()) {
		         echo 'Not Found - '; }

		      if (is_front_page()) {
		        echo bloginfo('title'); echo ' - '; bloginfo('description');
		      }
		      else {
		          bloginfo('name'); }
		      if ($paged>1) {
		         echo ' - page '. $paged; }
		   ?>
	</title>
	<meta name="description" content="<?php echo bloginfo('name'); echo ' - '; echo bloginfo('description'); ?>"
	<meta name="author" content="User Experience Magazine">
	<?php if (is_search()) { ?>
	   <meta name="robots" content="noindex, nofollow" /> 
	<?php } ?>

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
  ================================================== -->
	<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<?php if ( is_singular() ) wp_enqueue_script('comment-reply'); ?>

	<?php wp_head(); ?>

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="<?php bloginfo('template_url');?>/favicon.ico">
	<link rel="apple-touch-icon" href="<?php bloginfo('template_url');?>/images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('template_url');?>/images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('template_url');?>/images/apple-touch-icon-114x114.png">
	<!--<script src="<?php bloginfo('template_url');?>/js/responsiveslides.min.js"></script>-->
	<!--<script src="<?php bloginfo('template_url');?>/js/modernizr.js"></script>-->
	<!--<script type="text/javascript">
	Modernizr.load({
	test: Modernizr.mq('only all'),
	nope: 'js/respond.min.js'
	});
	</script>-->
	<script src="<?php bloginfo('template_url');?>/js/custom.js"></script>

</head>
<body <?php body_class(); ?>>
	<div id="header-wrap">
		<div id="header">
		<div id="skip"><a href="#content">Skip to Main Content</a></div>
			<?php wp_nav_menu( array( 'menu' => 'main-menu','container' => false, 'menu_class' => 'nav', 'items_wrap' => '<ul id="%1$s" class="%2$s" role="navigation" >%3$s</ul>') ); ?>
			<?php wp_nav_menu(    array( 
                            'show_description' => false,
                            'menu' => 'main-nav', 
                            'items_wrap'     => '<label for="select-menu" role="navigation" class="hide">Select a page</label><select class="selectnav" id="select-menu"><option value="">Select a page...</option>%3$s</select>',
                            'container' => false,
                            'walker'  => new Walker_Nav_Menu_Dropdown(),
                            'theme_location' => 'main-menu'));
			?>
			<div role="form">
			<form  role="search" action="<?php bloginfo('siteurl'); ?>" id="searchform" method="get">
			<label for="search">Search: </label>
			<input class="search" type="text" id="search" name="s" /> 
			<input type="image" src="<?php echo bloginfo('template_url');?>/images/search-bg.png" id="submit" alt="search"/>
			</form>
			</div>
			<div role="banner">
			<a class="logo" href="<?php echo bloginfo('url');?>"><img src="<?php bloginfo('template_url');?>/images/JUSlogo11I13_web_150x541px.png" alt="JUS logo" /></a>
	<!--	<h1 class="user-experience" />JUS</h1>  -->
	<!--	<p class="tagline"><?php _e(bloginfo('description'), 'ux'); ?></p> -->
			<div id="social-media">				
			<a class="facebook" href="https://www.facebook.com/groups/404691612915081/" target="_blank">UXPA Facebook page</a>
			<a class="twitter" href="https://twitter.com/UXPA_Int" target="_blank">UXPA Twitter</a>
			<a class="linkedin" href="http://www.linkedin.com/groups/User-Experience-Professionals-Association-717?home=&gid=717" target="_blank">UXPA LinkedIn profile</a>
			</div>
			</div>
		</div>
		
	</div>
	<div id="container" class="group">