<?php
//Child Theme Functions File

add_action( 'wp_enqueue_scripts', 'enqueue_wp_child_theme' );

function enqueue_wp_child_theme() 
{
    if((esc_attr(get_option('spepyio_setting_4')) != "No")) 
    {
	   wp_enqueue_style('parent-css', get_template_directory_uri().'/style.css' );
    }
	wp_enqueue_style('child-css', get_stylesheet_uri());

	wp_enqueue_script('child-js', get_stylesheet_directory_uri() . '/js/script.js', array( 'jquery' ), '1.0', true );
	//Ad Google Fonts
	wp_enqueue_style('child-googlefonts', 'https://fonts.googleapis.com/css?family=Playfair+Display&display=swap');
}

function child_theme_logo() {
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 400,
		'flex-width' => true,
		'flex-height' => true
	) );
}
add_action( 'after_setup_theme', 'child_theme_logo',11 );

?>

