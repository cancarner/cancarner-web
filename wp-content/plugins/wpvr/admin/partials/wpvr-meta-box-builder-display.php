<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://rextheme.com/
 * @since      1.0.0
 *
 * @package    Wpvr
 * @subpackage Wpvr/admin/partials
 */
?>
<?php
$post = '';
$id = '';
$postdata = array();
$post = get_post();
$id = $post->ID;
$postdata = get_post_meta( $id, 'panodata', true );
$panoid = 'pano'.$id;

if (isset($postdata['vidid'])) {
  ?>
  <div class="iframe-wrapper">
    <i class="fa fa-times" id="cross"></i>
    <div id="custom-ifram" style="display: none;">

    </div>
    <div id="<?php echo 'pano'.$id; ?>" class="pano-wrap" style="height: 100%;">
          <?php  
          echo $postdata['panoviddata'];
          ?>
        <?php
        if ($postdata['vidtype'] == 'selfhost') {
          ?>
            <script>
            videojs(<?php echo $postdata['vidid']; ?>, {
                plugins: {
                    pannellum: {}
                }
            });
          </script>
          <?php
        }
        ?>  
    </div>
  </div>

  <div class="rex-add-coordinates" style="text-align: center;">
    <ul>
      <li>
        <div id="panodata" style="text-align: center; font-weight: bold;">  
        </div>
      </li>
      <li class="rex-hide-coordinates add-pitch">
          <span class="rex-tooltiptext">Add This Position into active Hotspot</span>
          <i class="fa fa-arrow-down toppitch"></i>
      </li>
    </ul>
  </div>
  <?php
}
else {
$control = false;
if (isset($postdata['showControls'])) {
  $control = $postdata['showControls'];
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


  $default_data = array();
  $default_data = array("firstScene"=>$default_scene,"sceneFadeDuration"=>$scene_fade_duration);
  $scene_data = array();

  if (!empty($panodata)) {
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
          "URL"=>$hotspot_data["hotspot-url"],
          "clickHandlerArgs"=>$hotspot_data["hotspot-content"],
          "createTooltipArgs"=>$hotspot_data["hotspot-hover"],
          "sceneId"=>$hotspot_data["hotspot-scene"],
          "targetPitch"=>(float)$hotspot_scene_pitch,
          "targetYaw"=>(float)$hotspot_scene_yaw);
        array_push($hotspots, $hotspot_info);
        if (empty($hotspot_data["hotspot-scene"])) {
          unset($hotspot_info['targetPitch']);
          unset($hotspot_info['targetYaw']);
        }
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
  $pano_response = array("autoLoad"=>$autoload,"showControls"=>$control,'compass'=>$compass,"preview"=>$preview,"autoRotate"=>$autorotation,"autoRotateInactivityDelay"=>$autorotationinactivedelay,"autoRotateStopDelay"=>$autorotationstopdelay,"default"=>$default_data,"scenes"=>$scene_data);

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
?>

<div class="iframe-wrapper">
  <i class="fa fa-times" id="cross"></i>
  <div id="custom-ifram" style="display: none;">

  </div>
  <div id="<?php echo 'pano'.$id; ?>" class="pano-wrap">

  </div>
</div>

<div class="rex-add-coordinates" style="text-align: center;">
  <ul>
    <li>
      <div id="panodata" style="text-align: center; font-weight: bold;">  
      </div>
    </li>
    <li class="rex-hide-coordinates add-pitch">
        <span class="rex-tooltiptext">Add This Position into active Hotspot</span>
        <i class="fa fa-arrow-down toppitch"></i>
    </li>
  </ul>
</div>


<script>

  var response = <?php echo $response; ?>;
  var scenes = response[1];
  if (scenes) {
    $.each(scenes.scenes, function (i) {    
        $.each(scenes.scenes[i]['hotSpots'], function (key, val) {            
            if (val["clickHandlerArgs"] != "") {
              val["clickHandlerFunc"] = wpvrhotspot;
            }
            if (val["createTooltipArgs"] != "") {
              val["createTooltipFunc"] = wpvrtooltip;
            }                
        });
    });
  }

  if (response[1]['scenes'] != "") {
    var panoshow = pannellum.viewer(response[0]["panoid"], scenes);
  }

  function wpvrhotspot(hotSpotDiv, args) {
      var argst = args.replace(/\\/g, '');
      $("#custom-ifram").html(argst);
      $("#custom-ifram").fadeToggle();
      $(".iframe-wrapper").toggleClass("show-modal");
  }

  function wpvrtooltip(hotSpotDiv, args) {
      hotSpotDiv.classList.add('custom-tooltip');
      var span = document.createElement('span');
      if (args != null) {
        args = args.replace(/\\/g, "");  
      }
      span.innerHTML = args;
      hotSpotDiv.appendChild(span);
      span.style.marginLeft = -(span.scrollWidth - hotSpotDiv.offsetWidth) / 2 + 'px';
      span.style.marginTop = -span.scrollHeight - 12 + 'px';
  }
    
  jQuery(document).ready(function($){
   $("#cross").on("click", function(e){
         e.preventDefault();
         $("#custom-ifram").fadeOut();
         $(".iframe-wrapper").removeClass("show-modal");
         $('iframe').attr('src', $('iframe').attr('src'));
      });
  });
</script>
  <?php
}



