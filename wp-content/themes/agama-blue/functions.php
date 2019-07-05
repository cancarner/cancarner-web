<?php

// Do not allow direct access to the file.
if( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Include Customizer File
get_template_part( 'includes/customizer' );

/**
 * Theme Setup
 *
 * @since 1.0
 */
add_action( 'after_setup_theme', 'agama_blue_after_setup_theme' );
function agama_blue_after_setup_theme() {

	/**
	 * THEME SETUP
	 */

}

/**
 * After Theme Switch
 *
 * @since 1.0.5
 */
add_action( 'after_switch_theme', 'agamablue_setup_options' );
function agamablue_setup_options() {

	set_theme_mod( 'agama_primary_color', '#00a4d0' );

}

/* Omit closing PHP tag to avoid "Headers already sent" issues. */


/* SASS IN WORDPRESS */
function nt_css() {
    wp_enqueue_style( 'main-css', get_stylesheet_directory_uri() . '/css/main.css', array(), '20190319');
}
add_action('wp_enqueue_scripts', 'nt_css');

/* JS IN WORDPRESS */
function nt_js() {
     wp_enqueue_script( 'main-js', get_stylesheet_directory_uri() . '/js/main.js', array( 'jquery' ),  '20190319');
}
// add_action('wp_enqueue_scripts', 'nt_js');
