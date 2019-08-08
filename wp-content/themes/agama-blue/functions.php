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
    wp_enqueue_style( 'main-css', get_stylesheet_directory_uri() . '/css/main.css', array(), '20190808-3');
}
add_action('wp_enqueue_scripts', 'nt_css');

/* JS IN WORDPRESS */
// function nt_js() {
//      wp_enqueue_script( 'main-js', get_stylesheet_directory_uri() . '/js/main.js', array( 'jquery' ),  '20190808');
// }
// add_action('wp_enqueue_scripts', 'nt_js');


function create_extra_fields_ct7( $posted_data )
{
    //es un formulari Arrelem
    if(isset($posted_data['import-total']) && isset($posted_data['numero-titols'])){
        $posted_data['import-total'] = $posted_data['numero-titols'] * 100;
    }

    //es un formulari Socia
    if(isset($posted_data['import-total']) && isset($posted_data['tipus-socia'])){
        switch ($posted_data['tipus-socia'][0]){
            case 'Sòcia expectant (100€ + 36€ anuals)': $baseImport = 136; break;
            case 'Sòcia col·laboradora (100€)': $baseImport = 100; break;
            default: $baseImport = 100; break;
        }
        $posted_data['import-total'] = $baseImport + $posted_data['aportacio-voluntaria'];
    }

    //es formulari Arrelem o Socia
    if(isset($posted_data['referencia'])){
        $posted_data['referencia'] = sprintf('%06x', mt_rand(0, 0xffffff)    );
    }
    return $posted_data;
};
add_filter( 'wpcf7_posted_data', 'create_extra_fields_ct7', 10, 1 );
