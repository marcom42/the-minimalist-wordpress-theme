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

function hierarchical_category_tree( $cat = 0 ) {
  $next = get_categories('hide_empty=false&orderby=name&order=ASC&parent=' . $cat);

  if( $next ) :
    foreach( $next as $cat ) :
	    echo '<ul><li>';
	    echo '<a href="' . get_category_link( $cat->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $cat->name ) . '" ' . '>'.$cat->name.' ('. $cat->count . ')</a>  ';
	    hierarchical_category_tree( $cat->term_id );
    endforeach;
  endif;

  echo '</li></ul>'; echo "\n";
}

?>
