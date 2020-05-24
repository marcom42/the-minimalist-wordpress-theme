<?php

function load_stylesheets() {

	wp_enqueue_style( 'based', get_stylesheet_uri() );
	wp_enqueue_style( 'based-css', get_template_directory_uri() . '/css/tacit-css.min.css' );


	wp_register_style('style', get_template_directory_uri() . '/style.css', array(), false, 'all');
	wp_enqueue_style('style');
}
add_action('wp_enqueue_scripts', 'load_stylesheets');

add_theme_support('menus');
function register_menus() {
	register_nav_menus(
		array(
			'header-menu' => __('Header Menu', 'theme'),
			'footer-menu' => __('Footer Menu', 'theme')
		)
	);
}
add_action('init', 'register_menus');

?>
