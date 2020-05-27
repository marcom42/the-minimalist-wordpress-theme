<?php
// The MIT License (MIT)
//
// Copyright (c) 2020 Marco Matta
//
// Permission is hereby granted, free of charge, to any person obtaining a copy
// of this software and associated documentation files (the "Software"), to deal
// in the Software without restriction, including without limitation the rights
// to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
// copies of the Software, and to permit persons to whom the Software is
// furnished to do so, subject to the following conditions:
//
// The above copyright notice and this permission notice shall be included
// in all copies or substantial portions of the Software.
//
// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
// IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
// FITNESS FOR A PARTICULAR PURPOSE AND NON-INFRINGEMENT. IN NO EVENT SHALL THE
// AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
// LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
// OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
// SOFTWARE.

function load_stylesheets() {
	wp_enqueue_style( 'tacit', get_stylesheet_uri() );
	wp_enqueue_style( 'tacit-css', get_template_directory_uri() . '/css/tacit-css.min.css' );


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

function the_minimalist_options($wp_customize) {
 	// Theming section
	$wp_customize->add_section(
		'theminimalist_theme_options',
		array(
			'title' => __('Theming', 'theminimalist'),
			'priority' => 80,
			'capability' => 'edit_theme_options',
			'description' => __('Theme The Minimalist', 'theminimalist')
		)
	);
	// Theme body background color setting
	$wp_customize->add_setting('theme_body_bg_color',
		array(
			'default' => 'ffffff'
		)
	);
	// Theme body background color control
	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		'theme_body_bg_color',
		array(
			'label' => __('Body background color', 'theminimalist'),
			'section' => 'theminimalist_theme_options',
			'settings' => 'theme_body_bg_color',
			'priority' => 40
		)
	));
	// Theme article background color setting
	$wp_customize->add_setting('theme_article_bg_color',
		array(
			'default' => 'ffffff'
		)
	);
	// Theme article background color control
	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		'theme_article_bg_color',
		array(
			'label' => __('Body foreground <i>(article)</i> background color', 'theminimalist'),
			'section' => 'theminimalist_theme_options',
			'settings' => 'theme_article_bg_color',
			'priority' => 40
		)
	));
	// Theme font color setting
	$wp_customize->add_setting('theme_ft_color',
		array(
			'default' => '000000'
		)
	);
	// Theme font color control
	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		'theme_ft_color',
		array(
			'label' => __('Foreground <i>(article)</i> font color', 'theminimalist'),
			'section' => 'theminimalist_theme_options',
			'settings' => 'theme_ft_color',
			'priority' => 40
		)
	));

	// Footer section
	$wp_customize->add_section(
		'theminimalist_footer_options',
		array(
			'title' => __('Footer Settings', 'theminimalist'),
			'priority' => 100,
			'capability' => 'edit_theme_options',
			'description' => __('Change the footer options', 'theminimalist')
		)
	);
	// Footer background color setting
	$wp_customize->add_setting('footer_bg_color',
		array(
			'default' => 'ffffff'
		)
	);
	// Footer background color control
	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		'footer_bg_color',
		array(
			'label' => __('Background color', 'theminimalist'),
			'section' => 'theminimalist_footer_options',
			'settings' => 'footer_bg_color',
			'priority' => 40
		)
	));
	// Footer font color setting
	$wp_customize->add_setting('footer_ft_color',
		array(
			'default' => '000000'
		)
	);
	// Footer font color control
	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		'footer_ft_color',
		array(
			'label' => __('Font color', 'theminimalist'),
			'section' => 'theminimalist_footer_options',
			'settings' => 'footer_ft_color',
			'priority' => 40
		)
	));
	// First line in the footer
	$wp_customize->add_setting( 'footer_line_1',
		array(
			'default' => 'Lorem Ipsum',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control( 'theminimalist_footer_text_setting_id_1',
		array(
			'type' => 'text',
			'section' => 'theminimalist_footer_options',
			'settings' => 'footer_line_1',
			'label' => __( 'Text line #1' ),
			'description' => __( 'The first line of text to appear in the footer (leave empty to remove it).<br>Write [year] to print current year<br>Wrap in [i][/i] for italics and [b][/b] for bold', 'theminimalist' ),
			'priority' => 20
		)
	);
	// Second line in the footer
	$wp_customize->add_setting( 'footer_line_2',
		array(
			'default' => 'Proudly powered by Wordpress.',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control( 'theminimalist_footer_text_setting_id_2',
		array(
			'type' => 'text',
			'section' => 'theminimalist_footer_options',
			'settings' => 'footer_line_2',
			'label' => __( 'Text line #2' ),
			'description' => __( 'The second line of text to appear in the footer (leave empty to remove it).<br>Write [year] to print current year<br>Wrap in [i][/i] for italics and [b][/b] for bold', 'theminimalist' ),
			'priority' => 20
		)
	);
}
add_action('customize_register', 'the_minimalist_options');

function dynamic_css() {
		?>
			<style type='text/css'>
				body {
					background-color: <?php echo get_theme_mod('theme_body_bg_color'); ?>;
				}
				article {
					background-color: <?php echo get_theme_mod('theme_article_bg_color'); ?>;
					color: <?php echo get_theme_mod('theme_ft_color'); ?>;
				}
				footer {
					background-color: <?php echo get_theme_mod('footer_bg_color'); ?>;
					color: <?php echo get_theme_mod('footer_ft_color'); ?>;
				}
			</style>
		<?php
}
add_action( 'wp_head' , 'dynamic_css' );

// Live preview theme Settings
function my_customizer_preview() {
	wp_enqueue_script(
		'my_theme_customizer',
		get_template_directory_uri() . '/js/theme-customizer.js',
		array(  'jquery', 'customize-preview' ),
		'',
		true
	);
}
add_action( 'customize_preview_init' , 'my_customizer_preview' );

// Substitutes tags in square brakets with relative HTML tags to allow proper formatting through WordPress customizer.
function substitute_tags_for_formatting($s) {
	$s = str_replace('[year]', date('Y'), $s);
	$s = str_replace('[i]', '<i>', $s);
	$s = str_replace('[/i]', '</i>', $s);
	$s = str_replace('[b]', '<b>', $s);
	$s = str_replace('[/b]', '</b>', $s);
	return $s;
}
?>
