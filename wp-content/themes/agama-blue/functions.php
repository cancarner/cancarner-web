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
    wp_enqueue_style( 'main-css', get_stylesheet_directory_uri() . '/css/main.css', array(), '20190806');
}
add_action('wp_enqueue_scripts', 'nt_css');

/* JS IN WORDPRESS */
function nt_js() {
     wp_enqueue_script( 'main-js', get_stylesheet_directory_uri() . '/js/main.js', array( 'jquery' ),  '20190319');
}
// add_action('wp_enqueue_scripts', 'nt_js');


function create_referencia_field_ct7( $posted_data )
{
    $posted_data['referencia'] = sprintf('%06x', mt_rand(0, 0xffff)    );
    return $posted_data;
};
add_filter( 'wpcf7_posted_data', 'create_referencia_field_ct7', 10, 1 );

/**
* Crea shortcode [statebar]
* [statebar total="200000" actual="100000"][/statebar]
*/
function statebar_shortcode( $atts, $content = null ) {
	$statebar_atts = shortcode_atts( array(
		'total' => 200000,
		'actual' => 100000,
	), $atts );

    $total = esc_attr( $statebar_atts['total'] );
    $actual = esc_attr( $statebar_atts['actual'] );
    $percentatge = $actual / $total * 100;
    // $dataFinal = New Date();

    $statebar = '<blockquote class="wp-block-quote"><div class="info-campanya">';
    $statebar .= '<span class="hashtag">#ArrelemCanCarner</span>';
    $statebar .= '<div class="info-money">';
    $statebar .=   '<div class="left big">'. number_format($actual, 0, ',', '.') .'€</div>';
    $statebar .=   '<div class="right"> ' . 5 . ' dies<i class="far fa-clock"></i></div>';
    $statebar .= '</div>';
    $statebar .= '<div class="bar-wrapper">' ;
    $statebar .=   '<span class="bar graphic-design" style="width:' . $percentatge . '%"></span>';
    $statebar .= '</div>';
    $statebar .= '<div class="info-money">';
    $statebar .=   '<div class="left">'. $percentatge .'% de ' . number_format($total, 0, ',', '.') . '€</div>';
    $statebar .= '</div>';
    $statebar .= '<p class="claim">La campanya encara esta en marxa, no perdis l\'oportunitat de formar-hi part!</p>';
    $statebar .= '<div class="participa-link btn">Vull participar</div>';
	$statebar .='</div></blockquote>';

	return $statebar;

// <h3>Total recaudat: 100.000€</h3>
// <p>(BARRA DE PROGRÉS)</p><p>
//
// <span>Falten X díes per acabar la campanya</span>
// </p><p>(BOTO AJUDA’NS</p>

}
add_shortcode( 'statebar', 'statebar_shortcode' );
