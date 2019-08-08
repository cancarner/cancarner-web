<?php
/**
 * @package CanCarner Campaign
 */
/*
Plugin Name: Can Carner Campaign
Plugin URI: https://cancarner.cat
Description: Post type for campaign
Version: 1.0
Author: Situ
*/

add_action('wp_enqueue_scripts', 'can_carner_campaign_script');

if ( ! function_exists( 'can_carner_campaign_script' ) ) {
    function can_carner_campaign_script() {
        wp_enqueue_script( 'sticky-js', plugins_url( '/includes/js/jquery.sticky.js', __FILE__ ), array( 'jquery' ));
        wp_enqueue_script( 'shortcode-sticky-js', plugins_url( '/includes/js/main.js', __FILE__ ), array( 'jquery' ));

    }
}

add_action( 'init', 'can_carner_campaign_init');

if ( ! function_exists( 'can_carner_campaign_init' ) ) {
    function can_carner_campaign_init() {
        register_post_type( 'Campaign',
            array(
            'labels' => array(
                'name'               =>  'Campanyes',
                'singular_name'      =>  'Campanya',
                'menu_name'          =>  'Campanyes',
                'name_admin_bar'     =>  'Campanyes',
                'add_new'            =>  'Afegir nova campanya',
                'add_new_item'       =>  'Afegir nova campanya',
                'new_item'           =>  'Afegir nova campanya',
                'edit_item'          =>  'editar campanya',
                'view_item'          =>  'Veure campanya',
                'all_items'          =>  'Totes les campanyes',
                'search_items'       =>  'Cercar campanyes',
                'not_found'          =>  'No s\'ha trobat cap campanya.',
                'not_found_in_trash' =>  'No hi ha cap campanya a la papelera.',
            ),
            'public' => true,
            'publicly_queryable' => true,
            'has_archive' => true,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'campaigns'),
            'capability_type' => 'post',
            'hierarchical' => false,
            'menu_position' => 4,
            'exclude_from_search' => true,
            'menu_icon' => 'dashicons-megaphone',
            'supports' =>
                array(
                    'title',
                    'custom-fields',
                    'author'
                )
            )
        );

        /**
        * Crea shortcode [statebar]
        */
        function statebar_shortcode( $atts, $content = null ) {
            $campaigns = get_posts( ['post_type'=> 'campaign', 'order'    => 'ASC'] );
            if(sizeof($campaigns) > 0){
                $campaign = $campaigns[0];

                $total = esc_attr(get_post_meta($campaign->ID, 'cancarner_totalToObtain', TRUE));
                $actual = esc_attr(get_post_meta($campaign->ID, 'cancarner_totalObtained', TRUE));
                $deadline = get_post_meta($campaign->ID, 'cancarner_deadline', TRUE);
                $percentatge = round($actual / $total * 100);

                date_default_timezone_set('Europe/Madrid');

                $deadlineTime = strtotime($deadline);
                $now = strtotime("now");
                $diff= $deadlineTime - $now ;
                $days = floor($diff / 86400);
                $hours = floor($diff / 3600);
                $minutes = floor($diff / 60);

                $statebar = '<blockquote class="wp-block-quote sticky-shortcode"><div class="info-campanya">';
                $statebar .= '<span class="hashtag">#ArrelemCanCarner</span>';
                $statebar .= '<div class="info-money">';
                $statebar .=   '<div class="left big">'. number_format($actual, 0, ',', '.') .'€</div>';
                if($days > 0){
                    $statebar .=   '<div class="right"> ' . $days . ($days > 1 ? ' dies' : ' dia') .'<i class="far fa-clock"></i></div>';
                }else if ($hours > 0){
                    $statebar .=   '<div class="right"> ' . $hours . ($hours > 1 ? ' hores' : ' hora') .'<i class="far fa-clock"></i></div>';
                }else if($minutes > 0){
                    $statebar .=   '<div class="right"> ' . $minutes . ($minutes > 1 ? ' minuts' : ' minut') .'<i class="far fa-clock"></i></div>';
                }
                $statebar .= '</div>';
                $statebar .= '<div class="bar-wrapper">' ;
                $statebar .=   '<span class="bar graphic-design" style="width:' . $percentatge . '%"></span>';
                $statebar .= '</div>';
                $statebar .= '<div class="info-money">';
                $statebar .=   '<div class="left">'. $percentatge .'% de ' . number_format($total, 0, ',', '.') . '€</div>';
                $statebar .= '</div>';
                if($minutes > 0){
                    $statebar .= '<p class="claim">La campanya encara està en marxa, no perdis l\'oportunitat de formar-ne part!</p>';
                    $statebar .= '<div class="participa-link btn">Vull participar</div>';
                }else{
                    $statebar .= '<p class="claim">La campanya ha finalitzat.<br/>Gràcies pel teu suport :)</p>';
                }
            	$statebar .='</div></blockquote>';

            	return $statebar;
            }
            return '';
        }
        add_shortcode( 'statebar', 'statebar_shortcode' );
    }
}
