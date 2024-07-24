<?php
// Add RSS links to <head> section
add_theme_support('automatic-feed-links');

// Load jQuery
function load_custom_jquery() {
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', get_template_directory_uri() . "/js/jquery-1.9.1.min.js", [], null, true);
        wp_enqueue_script('jquery');
    }
}
add_action('wp_enqueue_scripts', 'load_custom_jquery');

// Clean up the <head>
function remove_head_links() {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_generator');
}
add_action('init', 'remove_head_links');

// Declare sidebar widget zones
function register_custom_sidebars() {
    $sidebars = [
        [
            'name' => 'Sidebar Widgets',
            'id' => 'sidebar-widgets',
            'description' => 'These are widgets for the sidebar.',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2>',
            'after_title' => '</h2>',
        ],
        [
            'name' => 'Home Page Widget 1',
            'id' => 'home-widgets-1',
            'description' => 'These are widgets for the first slot on the home page',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2>',
            'after_title' => '</h2>',
        ],
        [
            'name' => 'Home Page Widget 2',
            'id' => 'home-widgets-2',
            'description' => 'These are widgets for the second slot on the home page',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2>',
            'after_title' => '</h2>',
        ],
        [
            'name' => 'Home Page Ads Widgets',
            'id' => 'home-ads',
            'description' => 'These are widgets for the ads slot on the home page',
            'before_widget' => '<div id="%1$s" class="ad-widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2>',
            'after_title' => '</h2>',
        ],
        [
            'name' => 'Single Article Widgets',
            'id' => 'single-widgets',
            'description' => 'These are widgets for the single article sidebar area',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        ],
        [
            'name' => 'Issue Page Widgets',
            'id' => 'issue-widgets',
            'description' => 'These are widgets for the issue page sidebar area',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        ],
        [
            'name' => 'Footer Widgets',
            'id' => 'footer-widgets',
            'description' => 'These are widgets for the footer area',
            'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2>',
            'after_title' => '</h2>',
        ],
    ];

    foreach ($sidebars as $sidebar) {
        register_sidebar($sidebar);
    }
}
add_action('widgets_init', 'register_custom_sidebars');

add_theme_support('post-thumbnails');
set_post_thumbnail_size(145, 105, true);

// Register Main Navigation Menu
function register_main_menu() {
    register_nav_menu('main-menu', 'Main Menu');
}
add_action('after_setup_theme', 'register_main_menu');

// Add the walker class for the select dropdown menu
class Walker_Nav_Menu_Dropdown extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = array()) {
        // Don't output children opening tag (<ul>)
    }

    function end_lvl(&$output, $depth = 0, $args = array()) {
        // Don't output children closing tag
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        // Add spacing to the title based on the depth
        $item->title = str_repeat("&nbsp;", $depth * 4) . $item->title;

        $attributes  = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' value="' . esc_attr($item->url) . '"' : '';

        // Ensure $args is an object and link_before is set
        $link_before = '';
        if (is_object($args) && property_exists($args, 'link_before')) {
            $link_before = $args->link_before;
        }

        $item_output = '<option' . $attributes . '>';
        $item_output .= $link_before . apply_filters('the_title', $item->title, $item->ID);
        $item_output .= '</option>';

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    function end_el(&$output, $item, $depth = 0, $args = array()) {
        $output .= "</option>\n"; // Replace closing </li> with the option tag
    }
}


// Custom functions
function ux_authors() {
    if (function_exists('coauthors_posts_links')) {
        coauthors_posts_links("&#44; ", '&#44; ', '', '', true);
    } else {
        the_author_posts_link();
    }
}

function ux_issue($separator = '') {
    global $post;
    $terms = get_the_terms($post->ID, 'issue');
    if ($terms) {
        foreach ($terms as $term) {
            $term_id = $term->term_id;
            $term_title = $term->name;
            $slug = $term->slug;
        }
        echo " in <a href='" . get_term_link($term->slug, 'issue') . "'>";
        _e($term_title);
        echo "</a>";
        echo $separator;
    }
}

// Require additional files
require_once get_template_directory() . '/inc/taxonomies.php';
require_once get_template_directory() . '/inc/widgets.php';
require_once get_template_directory() . '/inc/options.php';
require_once get_template_directory() . '/inc/shortcodes.php';

// Custom search filter
function search_filter($query) {
    if ($query->is_search) {
        $query->set('post_type', 'post');
    }
    return $query;
}

// Catch the first image in the post content
function catch_that_image() {
    global $post;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches[1][0];

    // no image found display default image instead
    if (empty($first_img)) {
        $first_img = get_template_directory_uri() . "/images/default.jpg";
    }
    return $first_img;
}

// Grab alt text from attachments
function grab_alt($postID) {
    $args = [
        'post_type' => 'attachment',
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'post_mime_type' => 'image',
        'numberposts' => null,
        'post_parent' => $postID,
    ];
    $attachments = get_posts($args);
    foreach ($attachments as $attachment) {
        $alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
        _e($alt, "UX_Magazine");
    }
}

// Grab attachment image
function grab_attachment_image($postID) {
    $args = [
        'post_type' => 'attachment',
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'post_mime_type' => 'image',
        'numberposts' => null,
        'post_parent' => $postID,
    ];
    $attachments = get_posts($args);
    foreach ($attachments as $attachment) {
        $img = wp_get_attachment_image($attachment->ID, 'medium');
        _e($img, "UX_Magazine");
    }
}

// Custom read more link
function ux_read_more_link() {
    _e("<!--:en-->Read More<!--:--><!--:zh-->阅读详情<!--:--><!--:KO-->자세히 읽기<!--:--><!--:pt-->Leia mais<!--:--><!--:ja-->続きを読む<!--:--><!--:es-->Leer más<!--:-->", 'ux');
}

// Custom leigh blurb
function ux_leigh_blurb() {
    $text = [
        ['lang' => 'en', 'text' => 'Read more Rubes cartoons or download the new daily Rubes app at rubescartoons.com'],
        ['lang' => 'zh', 'text' => '在 rubescartoons.com 阅读更多 Rubes 卡通，或下载最新的每日 Rubes 应用软件'],
        ['lang' => 'KO', 'text' => '기타 Rubes 만화를 일거나 새로운 Rubes 앱을 rubescartoons.com에서 다운로드하십시오.'],
        ['lang' => 'es', 'text' => 'Lea más historietas de Rubes o descargue la nueva aplicación diaria de Rubes en rubescartoons.com'],
        ['lang' => 'pt', 'text' => 'Lei mais cartoons do Rubes ou faça o download do novo aplicativo diário do Rubes em rubescartoons.com'],
        ['lang' => 'ja', 'text' => 'rubescartoons.comで、Rubesコミックの閲覧や新しいRubesアプリをダウンロードすることができます。']
    ];
    $string = '';
    foreach ($text as $langs) {
        $string .= "<!--:" . $langs['lang'] . "-->" . $langs['text'] . "<!--:-->";
    }
    _e($string, 'ux');
}
