<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://rextheme.com/
 * @since             1.0.0
 * @package           Wpvr
 *
 * @wordpress-plugin
 * Plugin Name:       WP VR
 * Plugin URI:        https://rextheme.com/wpvr/
 * Description:       WP VR - 360 Panorama and virtual tour creator for WordPress is a customized panaroma & virtual builder tool for WordPress Website.
 * Version:           2.8.0
 * Author:            Rextheme
 * Author URI:        http://rextheme.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wpvr
 * Domain Path:       /languages
 */
// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
    die;
}
require plugin_dir_path( __FILE__ ) . 'elementor/elementor.php';
/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WPVR', '1.0.0' );
define( "WPVR_PLUGIN_DIR_URL", plugin_dir_url( __FILE__ ) );
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wpvr-activator.php
 */
function activate_wpvr()
{
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-wpvr-activator.php';
    Wpvr_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wpvr-deactivator.php
 */
function deactivate_wpvr()
{
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-wpvr-deactivator.php';
    Wpvr_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wpvr' );
register_deactivation_hook( __FILE__, 'deactivate_wpvr' );
/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */

require plugin_dir_path( __FILE__ ) . 'includes/class-wpvr.php';
/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wpvr()
{
    $plugin = new Wpvr();
    $plugin->run();
}

run_wpvr();
/**
 * array information checker
 */
function wpvr_in_array_r( $needle, $haystack, $strict = false )
{
    foreach ( $haystack as $item ) {
        if ( (( $strict ? $item === $needle : $item == $needle )) || is_array( $item ) && wpvr_in_array_r( $needle, $item, $strict ) ) {
            return true;
        }
    }
    return false;
}

function wpvr_activation_redirect( $plugin )
{

    if ( $plugin == plugin_basename( __FILE__ ) ) {
        exit( wp_redirect( admin_url( 'admin.php?page=wpvr' ) ) );
    }
}

add_action( 'activated_plugin', 'wpvr_activation_redirect' );
 

/**
 * Initialize the plugin tracker
 *
 * @return void
 */
function appsero_init_tracker_wpvr() {
 
    if ( ! class_exists( 'AppSero\WPVRInsights' ) ) {
        require_once __DIR__ . '/wpvrinsights.php';
    }
    $insights = new AppSero\WPVRInsights( 'cab9761e-b067-4824-9c71-042df5d58598', 'WP VR', __FILE__);
    $insights->optin();
    $insights->init_plugin();
    
}
 
add_action( 'init', 'appsero_init_tracker_wpvr' );

function wpvr_block() {
    wp_register_script(
        'wpvr-block',
        plugins_url( 'build/index.build.js', __FILE__ ),
        array( 'wp-blocks', 'wp-element', 'wp-components', 'wp-editor' )
    );
    wp_enqueue_style(
		'gutyblocks/guty-block',
        plugins_url( 'src/view.css', __FILE__ ),
        array()
	);

    if (function_exists('register_block_type')) {
         register_block_type( 'wpvr/wpvr-block', array(
         'attributes'      => array(
            'id' => array(
                'type' => 'string',
                'default' => '0',
            ),
            'width' => array(
                'type' => 'string',
                'default' => '600',
            ),
            'height' => array(
                'type' => 'string',
                'default' => '400',
            ),
            'content' => array(
                'type' => 'string',
                'source'=> 'html',
                'default'=> '<script>          </script>'
            ),
        ),
        'editor_script' => 'wpvr-block',
        'render_callback' => 'wpvr_block_render',
    ) ); 
    }
}
add_action( 'init', 'wpvr_block' );

function wpvr_block_render( $attributes ) {

    // $id = $attributes['id'];
    if (isset($attributes['id'])) {
        $id = $attributes['id'];
    }
    else {
        $id = 0;
    }
    if (isset($attributes['width'])) {
        $width = $attributes['width'];
    }
    if (isset($attributes['height'])) {
        $height = $attributes['height'];
    }
    

    $postdata = get_post_meta( $id, 'panodata', true );
    $panoid = 'pano'.$id;

    if (isset($postdata['vidid'])) {
        if (empty($width)) {
            $width = '600';
        }
        if (empty($height)) {
            $height = '400';
        }
        $videourl = $postdata['vidurl'];

        if (strpos($videourl, 'youtube') > 0) {
          $explodeid = '';
          $explodeid = explode("=",$videourl);
          $foundid = '';
          $foundid = $explodeid[1];
          $html = '';
          $html .= '<div style="text-align:center; max-width:100%; height:auto; margin: 0 auto;">';
            $html .= '<iframe width="'.$width.'" height="'.$height.'" src="https://www.youtube.com/embed/'.$foundid.'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
          $html .='</div>';
        } elseif (strpos($videourl, 'vimeo') > 0) {

          $explodeid = '';
          $explodeid = explode("/",$videourl);
          $foundid = '';
          $foundid = $explodeid[3];
          $html = '';
          $html .= '<div style="text-align:center; max-width:100%; height:auto; margin: 0 auto;">';
            $html .= '<iframe src="https://player.vimeo.com/video/'.$foundid.'" width="'.$width.'" height="'.$height.'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
          $html .='</div>';
        } else {
            $html = '';
            $html .= '<div id="pano'.$id.'" class="pano-wrap" style="width: '.$width.'px; height: '.$height.'px; margin: 0 auto;">';
                $html .= '<div style="width:100%; height:100%; ">'.$postdata['panoviddata'].'</div>';
                $html .= '<script>';
                    $html .= 'videojs('.$postdata['vidid'].', {';
                        $html .= 'plugins: {';
                            $html .= 'pannellum: {}';
                        $html .= '}';
                    $html .= '});';
                $html .= '</script>';
            $html .= '</div>';
        }
        return $html;
    } 

    $control = false;
    if (isset($postdata['showControls'])) {
        $control = $postdata['showControls'];
    }
    
    $gyro = false;
    if (isset($postdata['gyro'])) {
      $gyro = $postdata['gyro'];
    }

    $compass = false;
    if (isset($postdata['compass'])) {
      $compass = $postdata['compass'];
    }
    
    $autoload = false;

    if (isset($postdata['autoLoad'])) {
        $autoload = $postdata['autoLoad'];
    }
    
    $default_scene = '';
    if (isset($postdata['defaultscene'])) {
        $default_scene = $postdata['defaultscene'];
    }

    $preview = '';
    if (isset($postdata['preview'])) {
      $preview = $postdata['preview'];
    }

    $autorotation = '';
    if (isset($postdata["autoRotate"])) {
      $autorotation = $postdata["autoRotate"];
    }
    $autorotationinactivedelay = '';
    if (isset($postdata["autoRotateInactivityDelay"])) {
      $autorotationinactivedelay = $postdata["autoRotateInactivityDelay"];
    }
    $autorotationstopdelay = '';
    if (isset($postdata["autoRotateStopDelay"])) {
      $autorotationstopdelay = $postdata["autoRotateStopDelay"];
    }
    
    $scene_fade_duration = '';
    if (isset($postdata['scenefadeduration'])) {
        $scene_fade_duration = $postdata['scenefadeduration'];
    }
    
    $panodata = '';
    if (isset($postdata['panodata'])) {
        $panodata = $postdata['panodata'];
    }
    $hotspoticoncolor = '#00b4ff';
    $hotspotblink = 'on';
      $default_data = array();
      $default_data = array('firstScene'=>$default_scene, 'sceneFadeDuration'=>$scene_fade_duration);
      $scene_data = array();

      if (!empty($panodata['scene-list'])) {
            foreach ($panodata['scene-list'] as $panoscenes) {


            $scene_ititle = '';
            if (isset($panoscenes["scene-ititle"])) {
              $scene_ititle = sanitize_text_field($panoscenes["scene-ititle"]);
            }
                
            $scene_author = '';
            if (isset($panoscenes["scene-author"])) {
              $scene_author = sanitize_text_field($panoscenes["scene-author"]);
            }  

            $default_scene_pitch = '';
            if (isset($panoscenes["scene-pitch"])) {
              $default_scene_pitch = $panoscenes["scene-pitch"];
            }
            
            $default_scene_yaw = '';
            if (isset($panoscenes["scene-yaw"])) {
              $default_scene_yaw = $panoscenes["scene-yaw"];
            }

            $scene_max_pitch = '';
            if (isset($panoscenes["scene-maxpitch"])) {
              $scene_max_pitch = (float)$panoscenes["scene-maxpitch"];
            }
            

            $scene_min_pitch = '';
            if (isset($panoscenes["scene-minpitch"])) {
              $scene_min_pitch = (float)$panoscenes["scene-minpitch"];
            }
            

            $scene_max_yaw = '';
            if (isset($panoscenes["scene-maxyaw"])) {
              $scene_max_yaw = (float)$panoscenes["scene-maxyaw"];
            }
            

            $scene_min_yaw = '';
            if (isset($panoscenes["scene-minyaw"])) {
              $scene_min_yaw = (float)$panoscenes["scene-minyaw"];
            }
                  
            $default_zoom = 100;
            if (isset($panoscenes["scene-zoom"])) {
              $default_zoom = $panoscenes["scene-zoom"];
            }
            
            if (!empty($default_zoom)) {
              $default_zoom = (int)$default_zoom;
            }
            else {
              $default_zoom = 100;
            }

            $max_zoom = 120;
            if (isset($panoscenes["scene-maxzoom"])) {
              $max_zoom = $panoscenes["scene-maxzoom"];
            }
            
            if (!empty($max_zoom)) {
              $max_zoom = (int)$max_zoom;
            }
            else {
              $max_zoom = 120;
            }

            $min_zoom = 50;
            if (isset($panoscenes["scene-minzoom"])) {
              $min_zoom = $panoscenes["scene-minzoom"];
            }
            
            if (!empty($min_zoom)) {
              $min_zoom = (int)$min_zoom;
            }
            else {
              $min_zoom = 50;
            } 

            $hotspot_datas = array();
            if (isset($panoscenes['hotspot-list'])) {
                $hotspot_datas = $panoscenes['hotspot-list'];
            }
            
            $hotspots = array();
            foreach ($hotspot_datas as $hotspot_data) {
                $status  = get_option( 'wpvr_edd_license_status' );
                if( $status !== false && $status == 'valid' ) {
                    if (isset($hotspot_data["hotspot-customclass-pro"]) && $hotspot_data["hotspot-customclass-pro"] != 'none') {
                      $hotspot_data["hotspot-customclass"] = $hotspot_data["hotspot-customclass-pro"];
                      $hotspoticoncolor = $hotspot_data["hotspot-customclass-color-icon-value"];  
                    }
                    if (isset($hotspot_data['hotspot-blink'])) {
                      $hotspotblink = $hotspot_data['hotspot-blink'];
                    }
                }
              $hotspot_scene_pitch = '';
              if (isset($hotspot_data["hotspot-scene-pitch"])) {
                $hotspot_scene_pitch = $hotspot_data["hotspot-scene-pitch"];
              }
              $hotspot_scene_yaw = '';
              if (isset($hotspot_data["hotspot-scene-yaw"])) {
                $hotspot_scene_yaw = $hotspot_data["hotspot-scene-yaw"];
              }
              $hotspot_info = array(
                'text'=>$hotspot_data['hotspot-title'],
                'pitch'=>$hotspot_data['hotspot-pitch'],
                'yaw'=>$hotspot_data['hotspot-yaw'],
                'type'=>$hotspot_data['hotspot-type'],
                'cssClass'=>$hotspot_data['hotspot-customclass'],
                'URL'=>$hotspot_data['hotspot-url'],
                'clickHandlerArgs'=>$hotspot_data['hotspot-content'],
                'createTooltipArgs'=>$hotspot_data['hotspot-hover'],
                "sceneId"=>$hotspot_data["hotspot-scene"],
                "targetPitch"=>(float)$hotspot_scene_pitch,
                "targetYaw"=>(float)$hotspot_scene_yaw);
              if ($hotspot_data["hotspot-customclass"] == 'none' || $hotspot_data["hotspot-customclass"] == '') {
                unset($hotspot_info["cssClass"]);
              }
              if (empty($hotspot_data["hotspot-scene"])) {
                unset($hotspot_info['targetPitch']);
                unset($hotspot_info['targetYaw']);
              }
              array_push($hotspots, $hotspot_info);
            }

            $scene_info = array();
            $scene_info = array('type'=>$panoscenes['scene-type'],'panorama'=>$panoscenes['scene-attachment-url'],"pitch"=>$default_scene_pitch,"maxPitch"=>$scene_max_pitch,"minPitch"=>$scene_min_pitch,"maxYaw"=>$scene_max_yaw,"minYaw"=>$scene_min_yaw,"yaw"=>$default_scene_yaw,"hfov"=>$default_zoom,"maxHfov"=>$max_zoom,"minHfov"=>$min_zoom,"title"=>$scene_ititle,"author"=>$scene_author,'hotSpots'=>$hotspots);

            if (isset($panoscenes["ptyscene"])) {
              if ($panoscenes["ptyscene"] == "off") {
                unset($scene_info['pitch']);
                unset($scene_info['yaw']);
              }
            }
            if (empty($panoscenes["scene-ititle"])) {
               unset($scene_info['title']);
            }
            if (empty($panoscenes["scene-author"])) {
               unset($scene_info['author']);
            }

            if (isset($panoscenes["cvgscene"])) {
              if ($panoscenes["cvgscene"] == "off") {
                 unset($scene_info['maxPitch']);
                 unset($scene_info['minPitch']);
              }
            }
            if (empty($panoscenes["scene-maxpitch"])) {
              unset($scene_info['maxPitch']);
            }

            if (empty($panoscenes["scene-minpitch"])) {
              unset($scene_info['minPitch']);
            }

            if (isset($panoscenes["chgscene"])) {
              if ($panoscenes["chgscene"] == "off") {
                 unset($scene_info['maxYaw']);
                unset($scene_info['minYaw']);
              }
            }
            if (empty($panoscenes["scene-maxyaw"])) {
              unset($scene_info['maxYaw']);
            }

            if (empty($panoscenes["scene-minyaw"])) {
              unset($scene_info['minYaw']);
            }

            if (isset($panoscenes["czscene"])) {
              if ($panoscenes["czscene"] == "off") {
                  unset($scene_info['hfov']);
                  unset($scene_info['maxHfov']);
                  unset($scene_info['minHfov']);
                }
            }
            
            $scene_array = array();
            $scene_array = array(
              $panoscenes['scene-id']=>$scene_info
            );
            $scene_data[$panoscenes['scene-id']] = $scene_info;
        }   
      }

      $pano_id_array = array();
      $pano_id_array = array('panoid'=>$panoid);
      $pano_response = array();
      $pano_response = array('autoLoad'=>$autoload,'showControls'=>$control,'compass'=>$compass,"preview"=>$preview,"autoRotate"=>$autorotation,"autoRotateInactivityDelay"=>$autorotationinactivedelay,"autoRotateStopDelay"=>$autorotationstopdelay,'default'=>$default_data,'scenes'=>$scene_data);
      if (empty($autorotation)) {
          unset($pano_response['autoRotate']);
          unset($pano_response['autoRotateInactivityDelay']);
          unset($pano_response['autoRotateStopDelay']);
      }
      if (empty($autorotationinactivedelay)) {
          unset($pano_response['autoRotateInactivityDelay']);
      }
      if (empty($autorotationstopdelay)) {
          unset($pano_response['autoRotateStopDelay']);
      }
      
      $response = array();
      $response = array($pano_id_array,$pano_response);
      if (!empty($response)) {
        $response = json_encode($response);
    }
    if (empty($width)) {
        $width = '600';
    }
    if (empty($height)) {
        $height = '400';
    }
    
    $foreground_color = '#fff';
	$pulse_color = wpvr_hex2rgb($hotspoticoncolor);
	$rgb = wpvr_HTMLToRGB($hotspoticoncolor);
	$hsl = wpvr_RGBToHSL($rgb);
	if($hsl->lightness > 200) {
	  $foreground_color = '#000000';
	}
	else {
		$foreground_color = '#fff';
	}

    $class = 'myclass';
    $html = 'test';
    $html = '';
    $html .= '<style>';
      $html .= '#'.$panoid.' div.pnlm-hotspot-base.fas,
          #'.$panoid.' div.pnlm-hotspot-base.fab,
          #'.$panoid.' div.pnlm-hotspot-base.far {
              display: block !important; 
              background-color: '.$hotspoticoncolor.';
              color: '.$foreground_color.';
              border-radius: 100%; 
              width: 30px;
              height: 30px;
              animation: icon-pulse'.$panoid.' 1.5s infinite cubic-bezier(.25, 0, 0, 1);
          }';
          if ($hotspotblink == 'on') {
            $html .= '@-webkit-keyframes icon-pulse'.$panoid.' {
                0% {
                    box-shadow: 0 0 0 0px rgba('.$pulse_color[0].', 1);
                }
                100% {
                    box-shadow: 0 0 0 10px rgba('.$pulse_color[0].', 0);
                }
            }
            @keyframes icon-pulse'.$panoid.' {
                0% {
                    box-shadow: 0 0 0 0px rgba('.$pulse_color[0].', 1);
                }
                100% {
                    box-shadow: 0 0 0 10px rgba('.$pulse_color[0].', 0);
                }
            }'; 
          }

          $status  = get_option( 'wpvr_edd_license_status' );
          if( $status !== false && $status == 'valid' ) {
            if (!$gyro) {
              $html .= '#'.$panoid.' div.pnlm-orientation-button {
                    display: none;
                }';   
            } 
          }
          else {
            $html .= '#'.$panoid.' div.pnlm-orientation-button {
                    display: none;
                }';
          }
       
      $html .= '</style>';

    $html .= '<div id="pano'.$id.'" class="pano-wrap" style=" text-align:center; width: '.$width.'px; height: '.$height.'px; margin: 0 auto;">';
        $html .= '<i class="fa fa-times  cross"></i>';
        $html .= '<div class="custom-ifram" style="display: none;">';
        $html .= '</div>';
    $html .= '</div>';

    //script started
    $html .= '<script>';
        $html .= 'var response = '.$response.';';
        $html .= 'var scenes = response[1];';
        $html .= 'if(scenes) {';
            $html .= 'var scenedata = scenes.scenes;';
            $html .= 'for(var i in scenedata) {';
                $html .= 'var scenehotspot = scenedata[i].hotSpots;';
                $html .= 'for(var i = 0; i < scenehotspot.length; i++) {';
                    $html .= 'if(scenehotspot[i]["clickHandlerArgs"] != "") {';
                        $html .= 'scenehotspot[i]["clickHandlerFunc"] = wpvrhotspot;';
                    $html .= '}'; 
                    $html .= 'if(scenehotspot[i]["createTooltipArgs"] != "") {';
                        $html .= 'scenehotspot[i]["createTooltipFunc"] = wpvrtooltip;';
                    $html .= '}';   
                $html .= '}';    
            $html .= '}';
        $html .= '}';    
        $html .= 'pannellum.viewer(response[0]["panoid"], scenes);';
    $html .= '</script>';
    //script end
    return $html;
}

function wpvr_upgrade_to_pro_link( $links ) {
    $links = array_merge( array(
        '<a href="' . esc_url( 'https://rextheme.com/wpvr/' ) . '">' . __( 'Upgrade to pro', 'wpvr' ) . '</a>'
    ), $links );
    return $links;
}
if(!is_plugin_active( 'wpvr-pro/wpvr-pro.php' )) {
  add_action( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'wpvr_upgrade_to_pro_link' );
}



function wpvr_hex2rgb( $colour ) {
        if ( $colour[0] == '#' ) {
                $colour = substr( $colour, 1 );
        }
        if ( strlen( $colour ) == 6 ) {
                list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
        } elseif ( strlen( $colour ) == 3 ) {
                list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
        } else {
                return false;
        }
        $r = hexdec( $r );
        $g = hexdec( $g );
        $b = hexdec( $b );
        return array( $r.', '.$g.', '.$b );
}

function wpvr_HTMLToRGB($htmlCode)
  {
    if($htmlCode[0] == '#')
      $htmlCode = substr($htmlCode, 1);

    if (strlen($htmlCode) == 3)
    {
      $htmlCode = $htmlCode[0] . $htmlCode[0] . $htmlCode[1] . $htmlCode[1] . $htmlCode[2] . $htmlCode[2];
    }

    $r = hexdec($htmlCode[0] . $htmlCode[1]);
    $g = hexdec($htmlCode[2] . $htmlCode[3]);
    $b = hexdec($htmlCode[4] . $htmlCode[5]);

    return $b + ($g << 0x8) + ($r << 0x10);
  }

function wpvr_RGBToHSL($RGB) {
    $r = 0xFF & ($RGB >> 0x10);
    $g = 0xFF & ($RGB >> 0x8);
    $b = 0xFF & $RGB;

    $r = ((float)$r) / 255.0;
    $g = ((float)$g) / 255.0;
    $b = ((float)$b) / 255.0;

    $maxC = max($r, $g, $b);
    $minC = min($r, $g, $b);

    $l = ($maxC + $minC) / 2.0;

    if($maxC == $minC)
    {
      $s = 0;
      $h = 0;
    }
    else
    {
      if($l < .5)
      {
        $s = ($maxC - $minC) / ($maxC + $minC);
      }
      else
      {
        $s = ($maxC - $minC) / (2.0 - $maxC - $minC);
      }
      if($r == $maxC)
        $h = ($g - $b) / ($maxC - $minC);
      if($g == $maxC)
        $h = 2.0 + ($b - $r) / ($maxC - $minC);
      if($b == $maxC)
        $h = 4.0 + ($r - $g) / ($maxC - $minC);

      $h = $h / 6.0; 
    }

    $h = (int)round(255.0 * $h);
    $s = (int)round(255.0 * $s);
    $l = (int)round(255.0 * $l);

    return (object) Array('hue' => $h, 'saturation' => $s, 'lightness' => $l);
  }

add_action('rest_api_init', 'wpvr_rest_data_route');
function wpvr_rest_data_route() {
    register_rest_route( 'wpvr/v1', '/panodata/', array(
        'methods' => 'GET',
        'callback' => 'wpvr_rest_data_set',
      ) );
}
function wpvr_rest_data_set() {
    $query = new WP_Query(array(
        'post_type' => 'wpvr_item',
        'posts_per_page' => -1,
    ));
    
    $wpvr_list = array();
    $list_none = array('value'=>'0','label'=>'None');
    array_push($wpvr_list,$list_none);
    while ($query->have_posts()) {
        $query->the_post();
        $title = get_the_title();
        $post_id = get_the_ID();
        $list_ob = array('value'=>$post_id,'label'=>$title);
        array_push($wpvr_list,$list_ob);
    }
    return $wpvr_list;
}

