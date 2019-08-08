<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://rextheme.com/
 * @since      1.0.0
 *
 * @package    Wpvr
 * @subpackage Wpvr/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wpvr
 * @subpackage Wpvr/public
 * @author     Rextheme <sakib@coderex.co>
 */
class Wpvr_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wpvr_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wpvr_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		$plugin_url = plugin_dir_url( dirname(__FILE__) );
		wp_enqueue_style( $this->plugin_name . 'fontawesome', 'https://use.fontawesome.com/releases/v5.7.2/css/all.css', array(), $this->version, 'all' );
		wp_enqueue_style('panellium-css', plugin_dir_url( __FILE__ ) . 'lib/pannellum/src/css/pannellum.css', array(), true);
		wp_enqueue_style('videojs-css', plugin_dir_url( __FILE__ ) . 'lib/pannellum/src/css/video-js.css', array(), true);
		wp_enqueue_style( 'owl-css', plugin_dir_url( __FILE__ ) . 'css/owl.carousel.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wpvr-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wpvr_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wpvr_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script('panellium-js', plugin_dir_url( __FILE__ ) . 'lib/pannellum/src/js/pannellum.js', array(), true);
		wp_enqueue_script('panelliumlib-js', plugin_dir_url( __FILE__ ) . 'lib/pannellum/src/js/libpannellum.js', array(), true);
		wp_enqueue_script('videojs-js', plugin_dir_url( __FILE__ ) . 'js/video.js', array(), true);
		wp_enqueue_script('panelliumvid-js', plugin_dir_url( __FILE__ ) . 'lib/pannellum/src/js/videojs-pannellum-plugin.js', array(), true);
		wp_enqueue_script( 'owl-js', plugin_dir_url( __FILE__ ) . 'js/owl.carousel.js', array( 'jquery' ), false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wpvr-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Init the edit screen of the plugin post type item
	 *
	 * @since 1.0.0
	 */
	public function public_init() {
		add_shortcode( $this->plugin_name, array( $this , 'wpvr_shortcode') );
	}

	/**
	 * Shortcode output for the plugin
	 *
	 * @since 1.0.0
	 */
	public function wpvr_shortcode( $atts ) {
		
		extract(
			shortcode_atts(
				array(
					'id' => 0,
					'width' => NULL,
					'height' => NULL,
					'radius' => NULL
				), $atts
			)
		);

		if ( !$id ) {
			$obj = get_page_by_path( $slug, OBJECT, $this->post_type );
			if ( $obj ) {
				$id = $obj->ID;
			} else {
				return __('Invalid Wpvr slug attribute', $this->plugin_name);
			}
		}

		$postdata = get_post_meta( $id, 'panodata', true );
		$panoid = 'pano'.$id;

		if (isset($postdata['vidid'])) {
			if (empty($width)) {
				$width = '600px';
			}
			if (empty($height)) {
				$height = '400px';
			}

			$videourl = $postdata['vidurl'];

			if (strpos($videourl, 'youtube') > 0) {
	          $explodeid = '';
	          $explodeid = explode("=",$videourl);
	          $foundid = '';
	          $foundid = $explodeid[1];
	          $html = '';
	          $html .= '<div style="text-align: center; max-width:100%; height:auto; margin: 0 auto;">';
	          	$html .= '<iframe width="'.trim($width,'px').'" height="'.trim($height,'px').'" src="https://www.youtube.com/embed/'.$foundid.'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
	          $html .= '</div>';
	          
	        } elseif (strpos($videourl, 'vimeo') > 0) {

	          $explodeid = '';
	          $explodeid = explode("/",$videourl);
	          $foundid = '';
	          $foundid = $explodeid[3];
	          $html = '';
	          $html .= '<div style="text-align: center; max-width:100%; height:auto; margin: 0 auto;">';
	          	$html .= '<iframe src="https://player.vimeo.com/video/'.$foundid.'" width="'.trim($width,'px').'" height="'.trim($height,'px').'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
	           $html .= '</div>';
	          
	        } else {
	        	$html = '';
				$html .= '<div id="pano'.$id.'" class="pano-wrap" style="width: '.$width.'; height: '.$height.'; margin: 0 auto;">';
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

		$vrgallery = false;
		if (isset($postdata['vrgallery'])) {
			$vrgallery = $postdata['vrgallery'];
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
		  $default_data = array("firstScene"=>$default_scene,"sceneFadeDuration"=>$scene_fade_duration);
		  $scene_data = array();

		  if (!empty($panodata["scene-list"])) {
			  	foreach ($panodata["scene-list"] as $panoscenes) {

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
			  	if (isset($panoscenes["hotspot-list"])) {
			  		$hotspot_datas = $panoscenes["hotspot-list"];
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
			        "text"=>$hotspot_data["hotspot-title"],
			        "pitch"=>$hotspot_data["hotspot-pitch"],
			        "yaw"=>$hotspot_data["hotspot-yaw"],
			        "type"=>$hotspot_data["hotspot-type"],
			        "cssClass"=>$hotspot_data["hotspot-customclass"],
			        "URL"=>$hotspot_data["hotspot-url"],
			        "clickHandlerArgs"=>$hotspot_data["hotspot-content"],
			        "createTooltipArgs"=>$hotspot_data["hotspot-hover"],
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
			    $scene_info = array("type"=>$panoscenes["scene-type"],"panorama"=>$panoscenes["scene-attachment-url"],"pitch"=>$default_scene_pitch,"maxPitch"=>$scene_max_pitch,"minPitch"=>$scene_min_pitch,"maxYaw"=>$scene_max_yaw,"minYaw"=>$scene_min_yaw,"yaw"=>$default_scene_yaw,"hfov"=>$default_zoom,"maxHfov"=>$max_zoom,"minHfov"=>$min_zoom,"title"=>$scene_ititle,"author"=>$scene_author,"hotSpots"=>$hotspots);

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
			      $panoscenes["scene-id"]=>$scene_info
			    );
			    $scene_data[$panoscenes["scene-id"]] = $scene_info;
			}	
		  }

		  $pano_id_array = array();
		  $pano_id_array = array("panoid"=>$panoid);
		  $pano_response = array();
		  $pano_response = array("autoLoad"=>$autoload,"showControls"=>$control,"orientationSupport"=>'false',"compass"=>$compass,"preview"=>$preview,"autoRotate"=>$autorotation,"autoRotateInactivityDelay"=>$autorotationinactivedelay,"autoRotateStopDelay"=>$autorotationstopdelay,"default"=>$default_data,"scenes"=>$scene_data);

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
			$width = '600px';
		}
		if (empty($height)) {
			$height = '400px';
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
	    if ($width == 'fullwidth') {
	    	if (wpvr_isMobileDevice()) {
	    		if ($radius) {
	    			$html .= '<div id="pano'.$id.'" class="pano-wrap" style="text-align:center; border-radius:'.$radius.';">';
	    		}
	    		else {
	    			$html .= '<div id="pano'.$id.'" class="pano-wrap" style="text-align:center;">';
	    		}
	    		
	    	}
	    	else {
	    		if ($radius) {
	    			$html .= '<div id="pano'.$id.'" class="pano-wrap vrfullwidth" style=" text-align:center; height: '.$height.'; border-radius:'.$radius.';" >';
	    		}
	    		else {
	    			$html .= '<div id="pano'.$id.'" class="pano-wrap vrfullwidth" style=" text-align:center; height: '.$height.';" >';
	    		}
	    		
	    	}
	    }
	    else {
	    	if ($radius) {
	    		$html .= '<div id="pano'.$id.'" class="pano-wrap" style=" text-align:center; width: '.$width.'; height: '.$height.'; margin: 0 auto; border-radius:'.$radius.';">';
	    	}
	    	else {
	    		$html .= '<div id="pano'.$id.'" class="pano-wrap" style=" text-align:center; width: '.$width.'; height: '.$height.'; margin: 0 auto;">';
	    	}
	    	
	    }

	    	if ($vrgallery) {
	    		//===Carousal setup===//
	    		$html .= '<div id="vrgcontrols">';

	    			$html .= '<div class="vrgctrl vrbounce">';
	    			$html .= '</div>';
	    		$html .= '</div>';

		    	$html .= '<div id="sccontrols" class="scene-gallery vrowl-carousel owl-theme">';
		    		if (isset($panodata["scene-list"])) {
		    			foreach ($panodata["scene-list"] as $panoscenes) {
		    				$scene_key = $panoscenes['scene-id'];
		    				$img_src_url = $panoscenes['scene-attachment-url'];
		    				$html .= '<ul style="width:150px;"><li title="Double click to view scene"><img class="scctrl" id="'.$scene_key.'_gallery_'.$id.'" src="'.$img_src_url.'"></li></ul>';
		    			}
		    		}
		    	$html .= '</div>';
		    
		    	//===Carousal setup end===//	
	    	}


	        $html .= '<i class="fa fa-times cross"></i>';
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

	        $html .= 'var panoshow'.$id.' = pannellum.viewer(response[0]["panoid"], scenes);';
	        $html .= 'var touchtime = 0;';
	        if ($vrgallery) {
	        	if (isset($panodata["scene-list"])) {
	    			foreach ($panodata["scene-list"] as $panoscenes) {
	    				$scene_key = $panoscenes['scene-id'];
	    				$scene_key_gallery = $panoscenes['scene-id'].'_gallery_'.$id;
	    				$img_src_url = $panoscenes['scene-attachment-url'];
	    				$html .= 'document.getElementById("'.$scene_key_gallery.'").addEventListener("click", function(e) { ';
	    					$html .= 'if (touchtime == 0) {';
	    						$html .= 'touchtime = new Date().getTime();';
	    					$html .= '} else {';
	    						$html .= 'if (((new Date().getTime()) - touchtime) < 800) {';
	    							$html .= 'panoshow'.$id.'.loadScene("'.$scene_key.'");';
	    							$html .= 'touchtime = 0;';
	    						$html .= '} else {';
	    							$html .= 'touchtime = new Date().getTime();';
	    						$html .= '}';

	    					$html .= '}';
	    					 
	    				$html .= '});';
	    			}
	    		}	
	        }
	        
	    $html .= '</script>';
	    //script end

	    return $html;
	}

}
