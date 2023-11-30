<?php

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

if (!function_exists('adem_setup')) {
	function adem_setup()
	{
		add_theme_support('woocommerce');
		add_theme_support('title-tag');
		add_theme_support('post-thumbnails');
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);
		add_theme_support('editor-styles');
		add_editor_style();

		register_nav_menus(
			array(
				'menu_main' => 'Основное меню',
				'menu_burger' => 'Меню бургер',
				'menu_footer' => 'Меню футера',
			)
		);
	}

	//	register thumbnails
	add_image_size('180x300', 180, 300, true);

	// register post types
	register_post_type('collection', [
		'label' => null,
		'labels' => [
			'name' => 'Коллекции',
			'singular_name' => 'Коллекция',
			'add_new' => 'Добавить новую коллекцию',
			'add_new_item' => 'Добавить новую коллекцию',
			'edit_item' => 'Редактировать коллекцию',
			'new_item' => 'Новая коллекция',
			'view_item' => 'Смотреть коллекцию',
			'search_items' => 'Найти коллекцию',
			'not_found' => 'Не найдено',
			'not_found_in_trash' => 'Не найдено в корзине',
			'menu_name' => 'Коллекции',
		],
		'public' => true,
		'show_in_menu' => true,
		'menu_position' => 25,
		'menu_icon' => 'dashicons-images-alt2',
		'supports' => ['title', 'editor', 'thumbnail'],
		'taxonomies' => ['collection_type'],
		'has_archive' => true,
		'rewrite' => true,
		'query_var' => true,
		'publicly_queryable' => true
	]);
}

add_action('after_setup_theme', 'adem_setup');

// Return classic widgets
add_filter('gutenberg_use_widgets_block_editor', '__return_false');
add_filter('use_widgets_block_editor', '__return_false');

add_action('wp_enqueue_scripts', 'adem_scripts');
function adem_scripts()
{
	wp_dequeue_style('wp-block-library');
	wp_dequeue_style('wp-block-library-theme');
	wp_dequeue_style('wc-block-style');
	wp_dequeue_style('global-styles');
	wp_dequeue_style('classic-theme-styles');
	wp_enqueue_style('fancybox', get_template_directory_uri() . '/assets/vendor/css/fancybox.css', array(), '5.0.23');
	wp_enqueue_script('fancybox', get_template_directory_uri() . '/assets/vendor/js/fancybox.umd.js', array(), '5.0.23', true);
	wp_enqueue_style('swiper', get_template_directory_uri() . '/assets/vendor/css/swiper-bundle.min.css', array(), '10.3.1');
	wp_enqueue_script('swiper', get_template_directory_uri() . '/assets/vendor/js/swiper-bundle.min.js', array(), '10.3.1', true);
	wp_enqueue_style('adem', get_stylesheet_uri(), array(), _S_VERSION);
	wp_enqueue_script('adem', get_template_directory_uri() . '/assets/js/main.js', array(), _S_VERSION, true); //! Change to min.js
	wp_localize_script('adem', 'adem_ajax', array('url' => admin_url('admin-ajax.php')));
}

// disable scale images
add_filter('big_image_size_threshold', '__return_false');

// remove prefix in archive title
add_filter( 'get_the_archive_title_prefix', '__return_empty_string' );

// Custom breadcrumbs yoast
add_filter( 'wpseo_breadcrumb_links', 'custom_breadcrumbs' );

function custom_breadcrumbs( $links ) {
	global $post;

	if ( is_tax( 'product_cat' ) ) {
		$breadcrumb[] = array(
			'url' => wc_get_page_permalink( 'shop' ),
			'text' => 'Katalog',
		);

		array_splice( $links, 1, -2, $breadcrumb );
	} else if ( is_singular( 'product_cat' ) ) {
		$breadcrumb[] = array(
			'url' => wc_get_page_permalink( 'shop' ),
			'text' => 'Katalog',
		);

		array_splice( $links, 1, -2, $breadcrumb );
	}

	return $links;
}

// excerpt
function adem_excerpt($limit, $ID = null)
{
	return mb_substr(get_the_excerpt($ID), 0, $limit) . '...';
}

//SearchWP plugin configs
add_filter( 'searchwp_live_search_configs', 'adem_searchwp_live_search_configs' );

function adem_searchwp_live_search_configs( $configs ) {
	$configs['default'] = array(
		'engine' => 'default',
		'input' => array(
			'delay'     => 300,
			'min_chars' => 1,
		),
		'parent_el' => '.modal__search-result',
		'results' => array(
			'position'  => 'bottom',
			'width'     => 'auto',
			'offset'    => array(
				'x' => 0,
				'y' => 15
			),
		),
		'spinner' => array(
			'lines'     => 0,
			'length'    => 0,
			'width'     => 'auto',
			'radius'    => 0,
			'scale'     => 1,
			'corners'   => 0,
			'color'     => 'inherit',
			'fadeColor' => 'transparent',
			'speed'     => 1,
			'rotate'    => 0,
			'direction' => 1,
			'className' => 'loader',
			'top'       => '50%',
			'left'      => '50%',
			'position'  => 'absolute'
		),
	);

	return $configs;
}

add_filter( 'searchwp_live_search_base_styles', '__return_false' );

require 'inc/acf.php';
require 'inc/login.php';
require 'inc/registeration.php';
require 'inc/load-more.php';
require 'inc/mail.php';
require 'inc/svg.php';
require 'inc/tiny-mce.php';
require 'inc/traffic.php';
require 'inc/wc-add-to-cart.php';
require 'inc/woocommerce.php';
