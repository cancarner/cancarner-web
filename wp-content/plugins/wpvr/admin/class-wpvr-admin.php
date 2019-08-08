<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://rextheme.com/
 * @since      1.0.0
 *
 * @package    Wpvr
 * @subpackage Wpvr/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wpvr
 * @subpackage Wpvr/admin
 * @author     Rextheme <sakib@coderex.co>
 */
class Wpvr_Admin {

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
	 * The post type of this plugin.
	 *
	 * @since 1.0.0
	 */
	private $post_type;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $post_type ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->post_type = $post_type;
	}

	/**
	 * Register the stylesheets for the admin area.
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

		// wp_enqueue_style( $this->plugin_name . 'fontawesome', 'https://use.fontawesome.com/releases/v5.7.2/css/all.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . 'fontawesome', plugin_dir_url( __FILE__ ) . 'lib/fontawesome/css/all.css', array(), $this->version, 'all' );
		// wp_enqueue_style( 'materialize-icons', 'https://fonts.googleapis.com/icon?family=Material+Icons', array(), $this->version, 'all' );
		wp_enqueue_style( 'materialize-icons', plugin_dir_url( __FILE__ ) . 'lib/materializeicon.css', array(), $this->version, 'all' );

        $screen = get_current_screen();

        if ($screen->id=="toplevel_page_wpvr") {
        	wp_enqueue_style( 'materialize-css', plugin_dir_url( __FILE__ ) . 'css/materialize.min.css', array(), $this->version, 'all' );
        }
		wp_enqueue_style('panellium-css', plugin_dir_url( __FILE__ ) . 'lib/pannellum/src/css/pannellum.css', array(), true);
		wp_enqueue_style('videojs-css', plugin_dir_url( __FILE__ ) . 'lib/pannellum/src/css/video-js.css', array(), true);
		 if ($screen->id=="wpvr_item") {
		 	wp_enqueue_style( 'icon-picker-css', plugin_dir_url( __FILE__ ) . 'css/jquery.fonticonpicker.min.css', array(), $this->version, 'all' );
			wp_enqueue_style( 'icon-picker-css-theme', plugin_dir_url( __FILE__ ) . 'css/jquery.fonticonpicker.grey.min.css', array(), $this->version, 'all' );
			wp_enqueue_style( 'owl-css', plugin_dir_url( __FILE__ ) . 'css/owl.carousel.css', array(), $this->version, 'all' );
		 }

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wpvr-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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
		wp_enqueue_script( 'wp-api' );
		$adscreen = get_current_screen();
		wp_enqueue_media();
		if ($adscreen->id=="wpvr_item") {
			wp_enqueue_script('icon-picker', plugin_dir_url( __FILE__ ) . 'lib/jquery.fonticonpicker.min.js', array(), true);
		}
		wp_enqueue_script('panellium-js', plugin_dir_url( __FILE__ ) . 'lib/pannellum/src/js/pannellum.js', array(), true);
		wp_enqueue_script('panelliumlib-js', plugin_dir_url( __FILE__ ) . 'lib/pannellum/src/js/libpannellum.js', array(), true);
		wp_enqueue_script( 'videojs-js', plugin_dir_url( __FILE__ ) .'js/video.js', array('jquery'), true);
		wp_enqueue_script('panelliumvid-js', plugin_dir_url( __FILE__ ) . 'lib/pannellum/src/js/videojs-pannellum-plugin.js', array(), true);


        if ($adscreen->id=="toplevel_page_wpvr") {
        	wp_enqueue_script( 'materialize-js', plugin_dir_url( __FILE__ ) . 'js/materialize.min.js', array( 'jquery' ), $this->version, false );
        }
		wp_enqueue_script( 'jquery-repeater', plugin_dir_url( __FILE__ ) .'js/jquery.repeater.min.js', array('jquery'), true);
		if ($adscreen->id=="wpvr_item") {
			wp_enqueue_script('icon-picker', plugin_dir_url( __FILE__ ) . 'lib/jquery.fonticonpicker.min.js', array(), true);
			wp_enqueue_script( 'owl', plugin_dir_url( __FILE__ ) . 'js/owl.carousel.js', array( 'jquery' ), false );
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wpvr-admin.js', array( 'jquery' ), $this->version, false );
		}

		wp_localize_script( $this->plugin_name, 'wpvr_obj', array(
	        'ajaxurl' => admin_url( 'admin-ajax.php' ),
	        'ajax_nonce' => wp_create_nonce('wpvr'),
	    ) );

	}

	/**
	 * Init the edit screen of the plugin post type item
	 *
	 * @since 1.0.0
	 */
	public function wpvr_admin_init() {
		/*
		 *  Documentation : https://developer.wordpress.org/reference/functions/add_meta_box/
		 */

		add_meta_box(
			$this->post_type . '_builder_box',
			__('Tour Preview', $this->plugin_name),
			array($this, 'wpvr_display_meta_box_builder'),
			$this->post_type,
			'advanced',
			'high'
		);

		add_meta_box(
			$this->post_type . '_shortcode_box',
			__('Using this VR', $this->plugin_name),
			array($this, 'wpvr_display_meta_box_shortcode'),
			$this->post_type,
			'side'
		);
	}

	/**
	 * Register the custom post type
	 *
	 * @since 1.0.0
	 */
	public function wpvr_add_plugin_custom_post_type() {
		$labels = array(
			'name'              => __( 'Tour', $this->plugin_name ),
			'singular_name'     => __( 'Tour', $this->plugin_name ),
			'add_new'           => __( 'Add New Tour', $this->plugin_name ),
			'add_new_item'      => __( 'Add New Tour', $this->plugin_name ),
			'edit_item'         => __( 'Edit Tour', $this->plugin_name ),
			'new_item'          => __( 'New Tour', $this->plugin_name ),
			'view_item'         => __( 'View Tour', $this->plugin_name ),
			'search_items'      => __( 'Search Wpvr Tour', $this->plugin_name ),
			'not_found'         => __( 'No Wpvr Tour found', $this->plugin_name ),
			'not_found_in_trash'=> __( 'No Wpvr Tour found in Trash', $this->plugin_name ),
			'parent_item_colon' => '',
			'all_items'         => __( 'All Tours', $this->plugin_name ),
			'menu_name'         => __( 'Wpvr', $this->plugin_name ),
		);

		$args = array(
			'labels'          => $labels,
			'public'          => false,
			'show_ui'         => true,
			'show_in_menu'       => false,
			'menu_position'   => 100,
			'supports'        => array( 'title' ),
		);

		/**
		 * Documentation : https://codex.wordpress.org/Function_Reference/register_post_type
		 */
		register_post_type( $this->post_type, $args );
	}

	/**
	 * Populates the data in the custom columns
	 *
	 * @since 1.0.0
	 */
	function wpvr_manage_posts_custom_column( $column_name ){
		$post = get_post();

		switch( $column_name ) {
			case 'shortcode' :
				echo '<code>[wpvr id="' . $post->ID . '"]</code>';
				break;
			default:
				break;
		}
	}

	/**
	 * Adds the custom columns to the post type admin screen
	 *
	 * @since 1.0.0
	 */
	public function wpvr_manage_post_columns() {
		$columns = array(
			'cb'        => '<input type="checkbox" />',
			'title'     => __( 'Title', $this->plugin_name),
			'shortcode' => __( 'Shortcodes', $this->plugin_name),
			'author'    => __( 'Author', $this->plugin_name),
			'date'      => __( 'Date', $this->plugin_name)
		);
		return $columns;
	}

	/**
	 * Sets the messages for the custom post type
	 *
	 * @since 1.0.0
	 */
	public function wpvr_post_updated_messages( $messages ) {
		$messages[$this->post_type][1] = __( 'Wpvr item updated.', $this->plugin_name);
		$messages[$this->post_type][4] = __( 'Wpvr item updated.', $this->plugin_name);

		return $messages;
	}

	/**
	 * Render the shortcode box for this plugin.
	 *
	 * @since 1.0.0
	 */
	public function wpvr_display_meta_box_shortcode() {

		include_once( 'partials/wpvr-meta-box-shortcode-display.php' );
	}

	/**
	 * Render the builder box for this plugin.
	 *
	 * @since 1.0.0
	 */
	public function wpvr_display_meta_box_builder() {
		include_once( 'partials/wpvr-meta-box-builder-display.php' );
	}

	/**
	 * Custom Metabox
	*/
    public function wpvr_add_setup_metabox(){
        add_meta_box( 'setup', __( 'Setup' ), array($this, 'wpvr_setup'), 'wpvr_item', 'normal', 'low' );
    }
	public function wpvr_setup($post) {


		$data_limit = 5;

		$scene_limit = $data_limit + 1;
		$postdata = get_post_meta( $post->ID, 'panodata', true );


		$autoload = true;
		if (isset($postdata["autoLoad"])) {
			$autoload = $postdata["autoLoad"];
		}

		$control = true;
		if (isset($postdata["showControls"])) {
			$control = $postdata["showControls"];
		}

		$default_scene = '';
		if (isset($postdata["defaultscene"])) {
			$default_scene = $postdata["defaultscene"];
		}

		$preview = '';
		if (isset($postdata['preview'])) {
		  $preview = $postdata['preview'];
		}

		$autorotation = '';
		if (isset($postdata["autoRotate"])) {
			$autorotation = $postdata["autoRotate"];
		}
		else {
			$autorotation = -5;
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
		if (isset($postdata["scenefadeduration"])) {
			$scene_fade_duration = $postdata["scenefadeduration"];
		}

		$pano_data = '';
		if (isset($postdata["panodata"])) {
			$pano_data = $postdata["panodata"];
		}

		$custom_icon_array = new Wpvr_fontawesome_icons();
		$custom_icon = $custom_icon_array->icon;

		$html = '';

		$html .= '<div class="pano-setup">';

        $html .= '<div class="pano-alert scene-alert">';
            $html .= '<span class="destroy"><i class="fa fa-times"></i></span>';
            $html .= '<p></p>';
        $html .= '</div>';

        $html .='<div class="rex-pano-tabs">';
            $html .='<nav class="rex-pano-tab-nav rex-pano-nav-menu main-nav">';
                $html .='<ul>';
                    $html .='<li class="general active"><span data-href="#general"><i class="fa fa-cogs"></i> '.__('general','wpvr').'</span></li>';
                    $html .='<li class="scene"><span data-href="#scenes"><i class="fa fa-image"></i> '.__('Scenes','wpvr').'</span></li>';
                    $html .='<li class="hotspot"><span data-href="#scenes"><i class="far fa-dot-circle"></i> '.__('hotspot','wpvr').'</span></li>';
                    $html .='<li class="video"><span data-href="#video"><i class="fas fa-video"></i> '.__('Video','wpvr').'</span></li>';
                $html .='</ul>';
            $html .='</nav>';

            $html .='<div class="rex-pano-tab-content">';
                $html .='<div class="rex-pano-tab general active" id="general">';

                        $html .= '<h6 class="title"> '.__('General Settings : ','wpvr').'</h6>';

                        //=Control Setup=
                        if ($control == false) {
                            $html .= '<div class="single-settings controls">';
                                $html .= '<span>'.__('Show Controls: ','wpvr').'</span>';
                                $html .= '<ul>';
                                    $html .= '<li class="radio-btn">';
                                        $html .= '<input class="styled-radio" id="styled-radio-3" type="radio" name="controls" value="off" checked>';
                                        $html .= '<label for="styled-radio-3">Off</label>';
                                    $html .= '</li>';

                                    $html .= '<li class="radio-btn">';
                                        $html .= '<input class="styled-radio" id="styled-radio-4" type="radio" name="controls" value="on" >';
                                        $html .= '<label for="styled-radio-4">On</label>';
                                    $html .= '</li>';
                                $html .= '</ul>';
                            $html .= '</div>';
                        }
                        else {
                            $html .= '<div class="single-settings controls">';
                                $html .= '<span>'.__('Show Controls: ','wpvr').'</span>';
                                $html .= '<ul>';
                                    $html .= '<li class="radio-btn">';
                                        $html .= '<input class="styled-radio" id="styled-radio-3" type="radio" name="controls" value="off" >';
                                        $html .= '<label for="styled-radio-3">Off</label>';
                                    $html .= '</li>';

                                    $html .= '<li class="radio-btn">';
                                        $html .= '<input class="styled-radio" id="styled-radio-4" type="radio" name="controls" value="on" checked>';
                                        $html .= '<label for="styled-radio-4">On</label>';
                                    $html .= '</li>';
                                $html .= '</ul>';
                            $html .= '</div>';
                        }
                        //=Control setup End=//

                        //=scene fade duration=//
                        $html .= '<div class="single-settings scene-fade-duration">';
                            $html .= '<span>'.__('Scene Fade Duration: ','wpvr').'</span>';
                            $html .= '<input type="number" name="scene-fade-duration" value="'.$scene_fade_duration.'" />';
                        $html .= '</div>';
                        //=scene fade duration End=//

        				//=Autoload setup=//
                        if ($autoload == true) {
                            $html .= '<div class="single-settings autoload">';
                                $html .= '<span>'.__('Autoload: ','wpvr').'</span>';
                                $html .= '<ul>';
                                    $html .= '<li class="radio-btn">';
                                        $html .= '<input class="styled-radio" id="styled-radio-1" type="radio" name="autoload" value="off">';
                                        $html .= '<label for="styled-radio-1">Off</label>';
                                    $html .= '</li>';

                                    $html .= '<li class="radio-btn">';
                                        $html .= '<input class="styled-radio" id="styled-radio-2" type="radio" name="autoload" value="on" checked >';
                                        $html .= '<label for="styled-radio-2">On</label>';
                                    $html .= '</li>';
                                $html .= '</ul>';
                            $html .= '</div>';
                        }
                        else {
                            $html .= '<div class="single-settings autoload">';
                                $html .= '<span>'.__('Autoload: ','wpvr').' </span>';
                                $html .= '<ul>';
                                    $html .= '<li class="radio-btn">';
                                        $html .= '<input class="styled-radio" id="styled-radio-1" type="radio" name="autoload" value="off" checked >';
                                        $html .= '<label for="styled-radio-1">Off</label>';
                                    $html .= '</li>';

                                    $html .= '<li class="radio-btn">';
                                        $html .= '<input class="styled-radio" id="styled-radio-2" type="radio" name="autoload" value="on">';
                                        $html .= '<label for="styled-radio-2">On</label>';
                                    $html .= '</li>';
                                $html .= '</ul>';
                            $html .= '</div>';
                        }
                        //=Autoload setup End=//

                        //===preview image===//
                        if (!empty($preview)) {
                        	$html .= '<div class="single-settings preview-setting">';
                                $html .= '<span>'.__('Preview Upload or add link : ','wpvr').'</span>';
	                            $html .= '<div class="form-group">';
	                                $html .= '<img class="prev-img" src="'.$preview.'">';
	                                $html .= '<input type="text" name="preview-attachment-url" class="preview-attachment-url" value="'.$preview.'"><br>';
	                                $html .= '<input type="button" class="preview-upload" data-info="" value="Upload"/>';
	                            $html .= '</div>';
	                        $html .= '</div>';
                        }
                        else {
                        	$html .= '<div class="single-settings preview-setting">';
	                            $html .= '<span>'.__('Preview Upload or add link : ','wpvr').'</span>';
	                            $html .= '<div class="form-group">';
	                                $html .= '<img class="prev-img" src="" style="display: none;">';
	                                $html .= '<input type="text" name="preview-attachment-url" class="preview-attachment-url" value=""><br>';
	                                $html .= '<input type="button" class="preview-upload" data-info="" value="Upload"/>';
	                            $html .= '</div>';
	                        $html .= '</div>';
                        }
                        //===preview image end===//

                        //===Autorotation on off set==//
                        if (isset($postdata["autoRotate"])) {
                        	$html .= '<div class="single-settings autoload">';
	                            $html .= '<span>'.__('Auto Rotation: ','wpvr').' </span>';
	                            $html .= '<ul>';
	                                $html .= '<li class="radio-btn">';
	                                    $html .= '<input class="styled-radio" id="styled-radio-11" type="radio" name="autorotation" value="off" >';
	                                    $html .= '<label for="styled-radio-11">Off</label>';
	                                $html .= '</li>';

	                                $html .= '<li class="radio-btn">';
	                                    $html .= '<input class="styled-radio" id="styled-radio-12" type="radio" name="autorotation" value="on" checked >';
	                                    $html .= '<label for="styled-radio-12">On</label>';
	                                $html .= '</li>';
	                            $html .= '</ul>';
	                        $html .= '</div>';
                        }
                        else {
                        	$html .= '<div class="single-settings autoload">';
	                            $html .= '<span>'.__('Auto Rotation: ','wpvr').' </span>';
	                            $html .= '<ul>';
	                                $html .= '<li class="radio-btn">';
	                                    $html .= '<input class="styled-radio" id="styled-radio-11" type="radio" name="autorotation" value="off" checked >';
	                                    $html .= '<label for="styled-radio-11">Off</label>';
	                                $html .= '</li>';

	                                $html .= '<li class="radio-btn">';
	                                    $html .= '<input class="styled-radio" id="styled-radio-12" type="radio" name="autorotation" value="on">';
	                                    $html .= '<label for="styled-radio-12">On</label>';
	                                $html .= '</li>';
	                            $html .= '</ul>';
	                        $html .= '</div>';
                        }
                        //===Autorotation on off set==//

                        //=Auto Rotation=//
                        $html .= '<div class="single-settings scene-fade-duration autorotationdata" >';
                            $html .= '<span>'.__('Auto Rotation: ','wpvr').'</span>';
                            $html .= '<input type="number" name="auto-rotation" value="'.$autorotation.'" placeholder="-5" />';
                            $html .= '<div class="field-tooltip">';
                                $html .= '<i class="fa fa-question-circle"></i>';
                                $html .= '<span>'.__('Will automatically rotate the panorama for each page load. You can define rotation speed with number values. Positive number for counter-clockwise and negative number for clockwise. As an example "-5" will rotate the panorama clockwise.','wpvr').'</span>';
                            $html .= '</div>';
                        $html .= '</div>';
                        //=Auto Rotation=//

                        //=Auto rotation inactive delay=//
                        $html .= '<div class="single-settings scene-fade-duration autorotationdata" >';
                            $html .= '<span>'.__('Auto Rotation Inactive Delay: ','wpvr').'</span>';
                            $html .= '<input type="number" name="auto-rotation-inactive-delay" value="'.$autorotationinactivedelay.'" placeholder="2000" />';
                            $html .= '<div class="field-tooltip">';
                                $html .= '<i class="fa fa-question-circle"></i>';
                                $html .= '<span>'.__('Will pause the rotation for few times. You can put the time value in miliseconds. As an example "2000" will pause the rotation for 2 seconds.','wpvr').'</span>';
                            $html .= '</div>';
                        $html .= '</div>';
                        //=Auto rotation inactive delay=//

                        //=Auto rotation stop delay=//
                        $html .= '<div class="single-settings scene-fade-duration autorotationdata" >';
                            $html .= '<span>'.__('Auto Rotation Stop Delay: ','wpvr').'</span>';
                            $html .= '<input type="number" name="auto-rotation-stop-delay" value="'.$autorotationstopdelay.'" placeholder="2000" />';
                            $html .= '<div class="field-tooltip">';
                                $html .= '<i class="fa fa-question-circle"></i>';
                                $html .= '<span>'.__('Will stop the auto rotation after given time value. As an example for "2000" the roation will stop after 2 seconds on each page load.','wpvr').'</span>';
                            $html .= '</div>';
                        $html .= '</div>';
                        //=Auto rotation stop delay=//

                $html .='</div>';
                //---end general tab----

                $html .='<div class="rex-pano-tab" id="scenes">';

                    //=Scene and Hotspot repeater=//
                    if (empty($pano_data)) {
                        $html .= '<div class="scene-setup rex-pano-sub-tabs" data-limit="'.$scene_limit.'">';

                            $html .= '<nav class="rex-pano-tab-nav rex-pano-nav-menu scene-nav">';
                                $html .= '<ul>';
                                    $html .= '<li class="active"><span data-index="1" data-href="#scene-1"><i class="fa fa-image"></i></span></li>';
                                    $html .= '<li class="add" data-repeater-create><span><i class="fa fa-plus-circle"></i></span></li>';
                                $html .= '</ul>';
                            $html .= '</nav>';

                            $html .= '<div data-repeater-list="scene-list" class="rex-pano-tab-content">';

                            	$html .= '<div data-repeater-item class="single-scene rex-pano-tab" data-title="0" id="scene-0">';

                                    $html .= '<div class="scene-content">';
                                        $html .= '<h6 class="title"><i class="fa fa-cog"></i> Scene Setting </h6>';

                                        //==Set Default Scene==//
			                        	$html .= '<div class="single-settings dscene">';
			                                $html .= '<span>'.__('Set as default: ','wpvr').'</span>';
			                                $html .= '<select class="dscen" name="dscene">';
                                                $html .= '<option value="on"> Yes</option>';
                                                $html .= '<option value="off" selected > No</option>';
                                            $html .= '</select>';
			                            $html .= '</div>';
			                        	//==Set Default Scene end==//
                                        $html .= '<div class=scene-setting>';
                                            $html .= '<label for="scene-id">'.__('Scene ID : ','wpvr').'</label>';
                                            $html .= '<input class="sceneid" type="text" name="scene-id"/>';
                                        $html .= '</div>';

                                        $html .= '<div class=scene-setting>';
                                            $html .= '<label for="scene-type">'.__('Scene Type : ','wpvr').'</label>';
                                            $html .= '<input type="text" name="scene-type" value="equirectangular" disabled/>';
                                        $html .= '</div>';

                                        $html .= '<div class=scene-setting>';
                                            $html .= '<label for="scene-upload">'.__('Scene Upload: ','wpvr').'</label>';
                                            $html .= '<div class="form-group">';
                                                $html .= '<img src="" style="display: none;"><br>';
                                                $html .= '<input type="button" class="scene-upload" data-info="" value="Upload"/>';
                                                $html .= '<input type="hidden" name="scene-attachment-url" class="scene-attachment-url" value="">';
                                            $html .= '</div>';
                                        $html .= '</div>';
                                    $html .= '</div>';

                                    //--hotspot setup--
                                    $html .= '<div class="hotspot-setup rex-pano-sub-tabs" data-limit="'.$data_limit.'">';

                                        $html .= '<nav class="rex-pano-tab-nav rex-pano-nav-menu hotspot-nav">';
                                            $html .= '<ul>';
                                                $html .= '<li class="active"><span data-index="1" data-href="#scene-0-hotspot-1"><i class="far fa-dot-circle"></i></span></li>';
                                                $html .= '<li class="add" data-repeater-create><span><i class="fa fa-plus-circle"></i> </span></li>';
                                            $html .= '</ul>';
                                        $html .= '</nav>';

                                        $html .= '<div data-repeater-list="hotspot-list" class="rex-pano-tab-content">';
                                            $html .= '<div data-repeater-item class="single-hotspot rex-pano-tab active clearfix" id="scene-0-hotspot-1">';

                                                $html .= '<h6 class="title"><i class="fa fa-cog"></i> Hotspot Setting </h6>';

                                                $html .= '<div class="wrapper">';
                                                    $html .= '<div class="hotspot-setting">';
                                                        $html .= '<label for="hotspot-title">'.__('Hotspot ID : ','wpvr').'</label>';
                                                        $html .= '<input type="text" id="hotspot-title" name="hotspot-title"/>';
                                                    $html .= '</div>';

                                                    $html .= '<div class="hotspot-setting">';
                                                        $html .= '<label for="hotspot-pitch">'.__('Pitch: ','wpvr').'</label>';
                                                        $html .= '<input type="text" class="hotspot-pitch" name="hotspot-pitch"/>';
                                                    $html .= '</div>';

                                                    $html .= '<div class="hotspot-setting">';
                                                        $html .= '<label for="hotspot-yaw">'.__('Yaw: ','wpvr').'</label>';
                                                        $html .= '<input type="text" class="hotspot-yaw" name="hotspot-yaw"/>';
                                                    $html .= '</div>';

													$html .= '<div class="hotspot-setting">';
                                                    	$html .= '<label for="hotspot-customclass">'.__('Hotspot custom icon class: ','wpvr').'</label>';
                                                    	$html .= '<input type="text" id="hotspot-customclass" name="hotspot-customclass"/>';
                                                	$html .= '</div>';

                                                $html .= '</div>';

                                                $html .= '<div class="hotspot-type hotspot-setting">';
                                                    $html .= '<label for="hotspot-type">'.__('Hotspot-Type: ','wpvr').'</label>';
                                                    $html .= '<select name="hotspot-type">';
                                                        $html .= '<option value="info" selected> Info</option>';
                                                        $html .= '<option value="scene"> Scene</option>';
                                                    $html .= '</select>';

                                                    $html .= '<div class="hotspot-url">';
                                                        $html .= '<label for="hotspot-url">'.__('URL: ','wpvr').' </label>';
                                                        $html .= '<input type="url" name="hotspot-url" value="" />';
                                                    $html .= '</div>';

                                                    $html .= '<div class="hotspot-content">';
                                                        $html .= '<label for="hotspot-content">'.__('On click Content: ','wpvr').'</label>';
                                                        $html .= '<textarea name="hotspot-content"></textarea>';
                                                    $html .= '</div>';

                                                    $html .= '<div class="hotspot-hover">';
                                                        $html .= '<label for="hotspot-hover">'.__('On hover Content: ','wpvr').'</label>';
                                                        $html .= '<textarea name="hotspot-hover"></textarea>';
                                                    $html .= '</div>';

                                                    $html .= '<div class="hotspot-scene" style="display:none;" >';
                                                        $html .= '<label for="hotspot-scene">'.__('Select Target Scene from List: ','wpvr').'</label>';
                                                        $html .= '<select class="hotspotscene" name="hotspot-scene-list">';
                                                        	$html .= '<option value="none" selected> None</option>';
                                                    	$html .= '</select>';
                                                    $html .= '</div>';

                                                    $html .= '<div class="hotspot-scene" style="display:none;" >';
                                                        $html .= '<label for="hotspot-scene">'.__('Target Scene ID: ','wpvr').' </label>';
                                                        $html .= '<input class="hotspotsceneinfodata" type="text" name="hotspot-scene" disabled/>';
                                                    $html .= '</div>';

                                                $html .= '</div>';
                                                //=Hotspot type End=//
                                                $html .= '<button data-repeater-delete title="Delete Hotspot" type="button" class="delete-hotspot"><i class="far fa-trash-alt"></i></button>';
                                            $html .= '</div>';
                                        $html .= '</div>';

                                    $html .= '</div>';
                                    $html .= '<button data-repeater-delete type="button" title="Delete Scene" class="delete-scene"><i class="far fa-trash-alt"></i></button>';
                           		$html .= '</div>';


                                $html .= '<div data-repeater-item class="single-scene rex-pano-tab active" data-title="1" id="scene-1">';

                                    $html .= '<div class="scene-content">';
                                        $html .= '<h6 class="title"><i class="fa fa-cog"></i> Scene Setting </h6>';

                                        //==Set Default Scene==//
			                        	$html .= '<div class="single-settings dscene">';
			                                $html .= '<span>'.__('Set as default: ','wpvr').'</span>';
			                                $html .= '<select class="dscen" name="dscene">';
                                                $html .= '<option value="on"> Yes</option>';
                                                $html .= '<option value="off" selected > No</option>';
                                            $html .= '</select>';
			                            $html .= '</div>';
			                        	//==Set Default Scene end==//

                                        $html .= '<div class=scene-setting>';
                                            $html .= '<label for="scene-id">'.__('Scene ID : ','wpvr').'</label>';
                                            $html .= '<input class="sceneid" type="text" name="scene-id"/>';
                                        $html .= '</div>';

                                        $html .= '<div class=scene-setting>';
                                            $html .= '<label for="scene-type">'.__('Scene Type : ','wpvr').'</label>';
                                            $html .= '<input type="text" name="scene-type" value="equirectangular" disabled/>';
                                        $html .= '</div>';

                                        $html .= '<div class=scene-setting>';
                                            $html .= '<label for="scene-upload">'.__('Scene Upload: ','wpvr').'</label>';
                                            $html .= '<div class="form-group">';
                                                $html .= '<img src="" style="display: none;"><br>';
                                                $html .= '<input type="button" class="scene-upload" data-info="" value="Upload"/>';
                                                $html .= '<input type="hidden" name="scene-attachment-url" class="scene-attachment-url" value="">';
                                            $html .= '</div>';
                                        $html .= '</div>';
                                    $html .= '</div>';

                                    //--hotspot setup--//
                                    $html .= '<div class="hotspot-setup rex-pano-sub-tabs" data-limit="'.$data_limit.'">';

                                        $html .= '<nav class="rex-pano-tab-nav rex-pano-nav-menu hotspot-nav">';
                                            $html .= '<ul>';
                                                $html .= '<li class="active"><span data-index="1" data-href="#scene-1-hotspot-1"><i class="far fa-dot-circle"></i></span></li>';
                                                $html .= '<li class="add" data-repeater-create><span><i class="fa fa-plus-circle"></i> </span></li>';
                                            $html .= '</ul>';
                                        $html .= '</nav>';

                                        $html .= '<div data-repeater-list="hotspot-list" class="rex-pano-tab-content">';
                                            $html .= '<div data-repeater-item class="single-hotspot rex-pano-tab active clearfix" id="scene-1-hotspot-1">';

                                                $html .= '<h6 class="title"><i class="fa fa-cog"></i> Hotspot Setting </h6>';

                                                $html .= '<div class="wrapper">';
                                                    $html .= '<div class="hotspot-setting">';
                                                        $html .= '<label for="hotspot-title">'.__('Hotspot ID : ','wpvr').'</label>';
                                                        $html .= '<input type="text" id="hotspot-title" name="hotspot-title"/>';
                                                    $html .= '</div>';

                                                    $html .= '<div class="hotspot-setting">';
                                                        $html .= '<label for="hotspot-pitch">'.__('Pitch: ','wpvr').'</label>';
                                                        $html .= '<input type="text" class="hotspot-pitch" name="hotspot-pitch"/>';
                                                    $html .= '</div>';

                                                    $html .= '<div class="hotspot-setting">';
                                                        $html .= '<label for="hotspot-yaw">'.__('Yaw: ','wpvr').'</label>';
                                                        $html .= '<input type="text" class="hotspot-yaw" name="hotspot-yaw"/>';
                                                    $html .= '</div>';

													$html .= '<div class="hotspot-setting">';
                                                    	$html .= '<label for="hotspot-customclass">'.__('Hotspot custom icon class: ','wpvr').'</label>';
                                                    	$html .= '<input type="text" id="hotspot-customclass" name="hotspot-customclass"/>';
                                                	$html .= '</div>';

                                                $html .= '</div>';

                                                $html .= '<div class="hotspot-type hotspot-setting">';
                                                    $html .= '<label for="hotspot-type">'.__('Hotspot-Type: ','wpvr').'</label>';
                                                    $html .= '<select name="hotspot-type">';
                                                        $html .= '<option value="info" selected> Info</option>';
                                                        $html .= '<option value="scene"> Scene</option>';
                                                    $html .= '</select>';

                                                    $html .= '<div class="hotspot-url">';
                                                        $html .= '<label for="hotspot-url">'.__('URL: ','wpvr').'</label>';
                                                        $html .= '<input type="url" name="hotspot-url" value="" />';
                                                    $html .= '</div>';

                                                    $html .= '<div class="hotspot-content">';
                                                        $html .= '<label for="hotspot-content">'.__('On click Content: ','wpvr').'</label>';
                                                        $html .= '<textarea name="hotspot-content"></textarea>';
                                                    $html .= '</div>';

                                                    $html .= '<div class="hotspot-hover">';
                                                        $html .= '<label for="hotspot-hover">'.__('On hover Content: ','wpvr').'</label>';
                                                        $html .= '<textarea name="hotspot-hover"></textarea>';
                                                    $html .= '</div>';

                                                    $html .= '<div class="hotspot-scene" style="display:none;" >';
                                                        $html .= '<label for="hotspot-scene">'.__('Select Target Scene from List: ','wpvr').'</label>';
                                                        $html .= '<select class="hotspotscene" name="hotspot-scene-list">';
                                                        	$html .= '<option value="none"> None</option>';
                                                    	$html .= '</select>';
                                                    $html .= '</div>';
                                                    $html .= '<div class="hotspot-scene" style="display:none;" >';
                                                        $html .= '<label for="hotspot-scene">'.__('Target Scene ID: ','wpvr').'</label>';
                                                        $html .= '<input class="hotspotsceneinfodata" type="text" name="hotspot-scene" disabled/>';
                                                    $html .= '</div>';

                                                $html .= '</div>';
                                                //=Hotspot type End=//
                                                $html .= '<button data-repeater-delete title="Delete Hotspot" type="button" class="delete-hotspot"><i class="far fa-trash-alt"></i></button>';
                                            $html .= '</div>';
                                        $html .= '</div>';
                                    $html .= '</div>';
                                    $html .= '<button data-repeater-delete type="button" title="Delete Scene" class="delete-scene"><i class="far fa-trash-alt"></i></button>';
                                $html .= '</div>';
                            $html .= '</div>';

                        $html .= '</div>';
                    }
                    else {
                        $html .= '<div class="scene-setup rex-pano-sub-tabs" data-limit="'.$scene_limit.'">';

                            $html .= '<nav class="rex-pano-tab-nav rex-pano-nav-menu scene-nav">';
                                $html .= '<ul>';
                                $i = 1;
                                $firstvalue = reset($pano_data["scene-list"]);
                                foreach ($pano_data["scene-list"] as $pano_scenes) {
                                	if ($pano_scenes['scene-id'] == $firstvalue['scene-id']) {
                                		$html .= '<li class="active"><span data-index="'.$i.'" data-href="#scene-'.$i.'"><i class="fa fa-image"></i></span></li>';
                                	}
                                	else {
                                		$html .= '<li><span data-index="'.$i.'" data-href="#scene-'.$i.'"><i class="fa fa-image"></i></span></li>';
                                	}
                                	$i++;
                                }
                                    $html .= '<li class="add" data-repeater-create><span><i class="fa fa-plus-circle"></i></span></li>';
                                $html .= '</ul>';
                            $html .= '</nav>';


                            $html .= '<div data-repeater-list="scene-list" class="rex-pano-tab-content">';

                             //===Default empty repeater declared by nazmus sakib===//
                            $html .= '<div data-repeater-item class="single-scene rex-pano-tab" data-title="0" id="scene-0">';

                                    $html .= '<div class="scene-content">';
                                        $html .= '<h6 class="title"><i class="fa fa-cog"></i> Scene Setting </h6>';

                                        //==Set Default Scene==//
			                        	$html .= '<div class="single-settings dscene">';
			                                $html .= '<span>'.__('Set as default: ','wpvr').'</span>';
			                                $html .= '<select class="dscen" name="dscene">';
                                                $html .= '<option value="on"> Yes</option>';
                                                $html .= '<option value="off" selected > No</option>';
                                            $html .= '</select>';
			                            $html .= '</div>';
			                        	//==Set Default Scene end==//
                                        $html .= '<div class=scene-setting>';
                                            $html .= '<label for="scene-id">'.__('Scene ID : ','wpvr').'</label>';
                                            $html .= '<input class="sceneid" type="text" name="scene-id"/>';
                                        $html .= '</div>';

                                        $html .= '<div class=scene-setting>';
                                            $html .= '<label for="scene-type">'.__('Scene Type : ','wpvr').'</label>';
                                            $html .= '<input type="text" name="scene-type" value="equirectangular" disabled/>';
                                        $html .= '</div>';

                                        $html .= '<div class=scene-setting>';
                                            $html .= '<label for="scene-upload">'.__('Scene Upload: ','wpvr').'</label>';
                                            $html .= '<div class="form-group">';
                                                $html .= '<img src="" style="display: none;"><br>';
                                                $html .= '<input type="button" class="scene-upload" data-info="" value="Upload"/>';
                                                $html .= '<input type="hidden" name="scene-attachment-url" class="scene-attachment-url" value="">';
                                            $html .= '</div>';
                                        $html .= '</div>';
                                    $html .= '</div>';

                                    //--hotspot setup--//
                                    $html .= '<div class="hotspot-setup rex-pano-sub-tabs" data-limit="'.$data_limit.'">';

                                        $html .= '<nav class="rex-pano-tab-nav rex-pano-nav-menu hotspot-nav">';
                                            $html .= '<ul>';
                                                $html .= '<li class="active"><span data-index="1" data-href="#scene-0-hotspot-1"><i class="far fa-dot-circle"></i></span></li>';
                                                $html .= '<li class="add" data-repeater-create><span><i class="fa fa-plus-circle"></i> </span></li>';
                                            $html .= '</ul>';
                                        $html .= '</nav>';

                                        $html .= '<div data-repeater-list="hotspot-list" class="rex-pano-tab-content">';
                                            $html .= '<div data-repeater-item class="single-hotspot rex-pano-tab active clearfix" id="scene-0-hotspot-1">';

                                                $html .= '<h6 class="title"><i class="fa fa-cog"></i> Hotspot Setting </h6>';

                                                $html .= '<div class="wrapper">';
                                                    $html .= '<div class="hotspot-setting">';
                                                        $html .= '<label for="hotspot-title">'.__('Hotspot ID : ','wpvr').'</label>';
                                                        $html .= '<input type="text" id="hotspot-title" name="hotspot-title"/>';
                                                    $html .= '</div>';

                                                    $html .= '<div class="hotspot-setting">';
                                                        $html .= '<label for="hotspot-pitch">'.__('Pitch: ','wpvr').'</label>';
                                                        $html .= '<input type="text" class="hotspot-pitch" name="hotspot-pitch"/>';
                                                    $html .= '</div>';

                                                    $html .= '<div class="hotspot-setting">';
                                                        $html .= '<label for="hotspot-yaw">'.__('Yaw: ','wpvr').'</label>';
                                                        $html .= '<input type="text" class="hotspot-yaw" name="hotspot-yaw"/>';
                                                    $html .= '</div>';

													$html .= '<div class="hotspot-setting">';
                                                    	$html .= '<label for="hotspot-customclass">'.__('Hotspot custom icon class: ','wpvr').'</label>';
                                                    	$html .= '<input type="text" id="hotspot-customclass" name="hotspot-customclass"/>';
                                                	$html .= '</div>';

                                                $html .= '</div>';

                                                $html .= '<div class="hotspot-type hotspot-setting">';
                                                    $html .= '<label for="hotspot-type">'.__('Hotspot-Type: ','wpvr').'</label>';
                                                    $html .= '<select name="hotspot-type">';
                                                        $html .= '<option value="info" selected> Info</option>';
                                                        $html .= '<option value="scene"> Scene</option>';
                                                    $html .= '</select>';

                                                    $html .= '<div class="hotspot-url">';
                                                        $html .= '<label for="hotspot-url">'.__('URL: ','wpvr').' </label>';
                                                        $html .= '<input type="url" name="hotspot-url" value="" />';
                                                    $html .= '</div>';

                                                    $html .= '<div class="hotspot-content">';
                                                        $html .= '<label for="hotspot-content">'.__('On click Content: ','wpvr').'</label>';
                                                        $html .= '<textarea name="hotspot-content"></textarea>';
                                                    $html .= '</div>';

                                                    $html .= '<div class="hotspot-hover">';
                                                        $html .= '<label for="hotspot-hover">'.__('On hover Content: ','wpvr').'</label>';
                                                        $html .= '<textarea name="hotspot-hover"></textarea>';
                                                    $html .= '</div>';

                                                    $html .= '<div class="hotspot-scene" style="display:none;" >';
                                                        $html .= '<label for="hotspot-scene">'.__('Select Target Scene from List: ','wpvr').'</label>';
                                                        $html .= '<select class="hotspotscene" name="hotspot-scene-list">';
                                                        	$html .= '<option value="none" selected> None</option>';
                                                    	$html .= '</select>';
                                                    $html .= '</div>';

                                                    $html .= '<div class="hotspot-scene" style="display:none;" >';
                                                        $html .= '<label for="hotspot-scene">'.__('Target Scene ID: ','wpvr').' </label>';
                                                        $html .= '<input class="hotspotsceneinfodata" type="text" name="hotspot-scene" disabled/>';
                                                    $html .= '</div>';

                                                $html .= '</div>';
                                                //=Hotspot type End=//
                                                $html .= '<button data-repeater-delete title="Delete Hotspot" type="button" class="delete-hotspot"><i class="far fa-trash-alt"></i></button>';
                                            $html .= '</div>';
                                        $html .= '</div>';

                                    $html .= '</div>';
                                    $html .= '<button data-repeater-delete type="button" title="Delete Scene" class="delete-scene"><i class="far fa-trash-alt"></i></button>';
                            $html .= '</div>';
                            //==Empty repeater end==//

                            	$s = 1;
                                foreach ($pano_data["scene-list"] as $pano_scenes) {
                                	$dscene = '';
                                	if (isset($pano_scenes['dscene'])) {
                                		$dscene = $pano_scenes['dscene'];
                                	}
                                    $scene_id = '';
                                    $scene_id = $pano_scenes["scene-id"];
                                    $scene_type = 'equirectangular';
                                    $scene_type = $pano_scenes["scene-type"];
                                    $scene_photo = '';
                                    $scene_photo = $pano_scenes["scene-attachment-url"];

                                    $pano_hotspots = array();
                                    if (isset($pano_scenes["hotspot-list"])) {
                                    	$pano_hotspots = $pano_scenes["hotspot-list"];
                                    }

                                    $firstvalueset = reset($pano_data["scene-list"]);
                                    if ($pano_scenes['scene-id'] == $firstvalueset['scene-id']) {
	                                    $html .= '<div data-repeater-item  class="single-scene rex-pano-tab active" data-title="1" id="scene-'.$s.'">';

	                                        $html .= '<div class="scene-content">';
	                                            $html .= '<h6 class="title"><i class="fa fa-cog"></i> Scene Setting </h6>';
	                                            //==Set Default Scene==//
	                                            if ($dscene == 'on') {
	                                            	$html .= '<div class="single-settings dscene">';
						                                $html .= '<span>'.__('Set as default: ','wpvr').'</span>';
						                                $html .= '<select class="dscen" name="dscene">';
			                                                $html .= '<option value="on" selected > Yes</option>';
			                                                $html .= '<option value="off"> No</option>';
			                                            $html .= '</select>';
					                            	$html .= '</div>';

	                                            }
	                                            else {
	                                            	$html .= '<div class="single-settings dscene">';
						                                $html .= '<span>'.__('Set as default: ','wpvr').'</span>';
						                                $html .= '<select class="dscen" name="dscene">';
			                                                $html .= '<option value="on"> Yes</option>';
			                                                $html .= '<option value="off" selected > No</option>';
			                                            $html .= '</select>';
					                            	$html .= '</div>';
	                                            }
					                        	//==Set Default Scene end==//
	                                            $html .= '<div class=scene-setting>';
	                                                $html .= '<label for="scene-id">'.__('Scene ID : ','wpvr').'</label>';
	                                                $html .= '<input class="sceneid" type="text" name="scene-id" value="'.$scene_id.'" />';
	                                            $html .= '</div>';

	                                            $html .= '<div class=scene-setting>';
	                                                $html .= '<label for="scene-type">'.__('Scene Type : ','wpvr').'</label>';
	                                                $html .= '<input type="text" name="scene-type" value="equirectangular" disabled/>';
	                                            $html .= '</div>';

	                                            $html .= '<div class=scene-setting>';
	                                                $html .= '<label for="scene-upload">'.__('Scene Upload: ','wpvr').'</label>';
	                                                $html .= '<div class="form-group">';
	                                                    $html .= '<img name ="scene-photo" src="'.$scene_photo.'"> <br/>';
	                                                    $html .= '<input type="button" class="scene-upload" data-info="" value="Upload"/>';
	                                                    $html .= '<input type="hidden" name="scene-attachment-url" class="scene-attachment-url" value="'.$scene_photo.'">';
	                                                $html .= '</div>';
	                                            $html .= '</div>';
	                                        $html .= '</div>';

	                                        if (!empty($pano_hotspots)) {
	                                            $html .= '<div class="hotspot-setup rex-pano-sub-tabs" data-limit="'.$data_limit.'">';

	                                                $html .= '<nav class="rex-pano-tab-nav rex-pano-nav-menu hotspot-nav">';
	                                                    $html .= '<ul>';
	                                                    $j = 1;
	                                                    $firstvaluehotspot = reset($pano_hotspots);
	                                                    foreach ($pano_hotspots as $pano_hotspot) {

	                                                    	if ($pano_hotspot['hotspot-title'] == $firstvaluehotspot['hotspot-title']) {
	                                                        	$html .= '<li class="active"><span data-index="'.$j.'" data-href="#scene-'.$s.'-hotspot-'.$j.'"><i class="far fa-dot-circle"></i></span></li>';
	                                                    	}
	                                                    	else {
	                                                        $html .= '<li><span data-index="'.$j.'" data-href="#scene-'.$s.'-hotspot-'.$j.'"><i class="far fa-dot-circle"></i></span></li>';
	                                                    	}
	                                                    $j++;
	                                                    }
	                                                        $html .= '<li class="add" data-repeater-create><span><i class="fa fa-plus-circle"></i></span></li>';
	                                                    $html .= '</ul>';
	                                                $html .= '</nav>';

	                                                $html .= '<div data-repeater-list="hotspot-list" class="rex-pano-tab-content">';

	                                            	$h = 1;
	                                            	$firstvaluehotspotset = reset($pano_hotspots);
	                                                foreach ($pano_hotspots as $pano_hotspot) {
	                                                    $hotspot_title = '';
	                                                    $hotspot_title = $pano_hotspot['hotspot-title'];
	                                                    $hotspot_pitch = '';
	                                                    $hotspot_pitch = $pano_hotspot['hotspot-pitch'];
	                                                    $hotspot_yaw = '';
	                                                    $hotspot_yaw = $pano_hotspot['hotspot-yaw'];
	                                                    $hotspot_type = '';
	                                                    $hotspot_type = $pano_hotspot['hotspot-type'];
	                                                    $hotspot_url = '';
	                                                    $hotspot_url = $pano_hotspot['hotspot-url'];
	                                                    $hotspot_content = '';
	                                                    $hotspot_content = $pano_hotspot['hotspot-content'];
	                                                    $hotspot_hover = '';
	                                                    $hotspot_hover = $pano_hotspot['hotspot-hover'];
	                                                    $hotspot_target_scene = '';
	                                                    $hotspot_target_scene = $pano_hotspot['hotspot-scene'];
	                                                    $hotspot_custom_class = '';
	                                                    if (isset($pano_hotspot['hotspot-customclass'])) {
	                                                    	$hotspot_custom_class = $pano_hotspot['hotspot-customclass'];
	                                                    }

	                                                    if ($pano_hotspot['hotspot-title'] == $firstvaluehotspotset['hotspot-title']) {
		                                                    $html .= '<div data-repeater-item class="single-hotspot rex-pano-tab active clearfix" id="scene-'.$s.'-hotspot-'.$h.'">';

		                                                        $html .= '<h6 class="title"><i class="fa fa-cog"></i> Hotspot Setting </h6>';

		                                                        $html .= '<div class="wrapper">';
		                                                            $html .= '<div class="hotspot-setting">';
		                                                                $html .= '<label for="hotspot-title">'.__('Hotspot ID : ','wpvr').'</label>';
		                                                                $html .= '<input type="text" id="hotspot-title" name="hotspot-title" value="'.$hotspot_title.'" />';
		                                                            $html .= '</div>';

		                                                            $html .= '<div class="hotspot-setting">';
		                                                                $html .= '<label for="hotspot-pitch">'.__('Pitch: ','wpvr').'
		                                                                </label>';
		                                                                $html .= '<input type="text" class="hotspot-pitch" name="hotspot-pitch" value="'.$hotspot_pitch.'" />';
		                                                            $html .= '</div>';

		                                                            $html .= '<div class="hotspot-setting">';
		                                                                $html .= '<label for="hotspot-yaw">'.__('Yaw: ','wpvr').'</label>';
		                                                                $html .= '<input type="text" class="hotspot-yaw" name="hotspot-yaw" value="'.$hotspot_yaw.'" />';
		                                                            $html .= '</div>';

																	$html .= '<div class="hotspot-setting">';
	                                                                	$html .= '<label for="hotspot-customclass">'.__('Hotspot custom icon class: ','wpvr').'</label>';
	                                                                	$html .= '<input type="text" id="hotspot-customclass" name="hotspot-customclass" value="'.$hotspot_custom_class.'"/>';
	                                                            	$html .= '</div>';

		                                                        $html .= '</div>';

		                                                        //=Hotspot type=//
		                                                        if ($hotspot_type == "info") {

		                                                            $html .= '<div class="hotspot-type hotspot-setting">';
		                                                                $html .= '<label for="hotspot-type">'.__('Hotspot-Type: ','wpvr').'</label>';
		                                                                $html .= '<select name="hotspot-type">';
		                                                                    $html .= '<option value="info" selected> Info</option>';
		                                                                    $html .= '<option value="scene"> Scene</option>';
		                                                                $html .= '</select>';

		                                                                $html .= '<div class="hotspot-url">';
		                                                                    $html .= '<label for="hotspot-url">'.__('URL: ','wpvr').' </label>';
		                                                                    $html .= '<input type="url" name="hotspot-url" value="'.$hotspot_url.'" />';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-content">';
		                                                                    $html .= '<label for="hotspot-content">'.__('On click Content: ','wpvr').'</label>';
		                                                                    $html .= '<textarea name="hotspot-content">'.$hotspot_content.'</textarea>';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-hover">';
		                                                                    $html .= '<label for="hotspot-hover">'.__('On hover Content: ','wpvr').' </label>';
		                                                                    $html .= '<textarea name="hotspot-hover">'.$hotspot_hover.'</textarea>';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-scene" style="display:none;" >';
					                                                        $html .= '<label for="hotspot-scene">'.__('Select Target Scene from List: ','wpvr').'</label>';
					                                                        $html .= '<select class="hotspotscene" name="hotspot-scene-list">';
					                                                        	$html .= '<option value="none" selected> None</option>';
					                                                    	$html .= '</select>';
					                                                    $html .= '</div>';

		                                                                $html .= '<div class="hotspot-scene" style="display:none;" >';
		                                                                    $html .= '<label for="hotspot-scene"> '.__('Target Scene ID: ','wpvr').'</label>';
		                                                                    $html .= '<input class="hotspotsceneinfodata" type="text" name="hotspot-scene" disabled/>';
		                                                                $html .= '</div>';

		                                                            $html .= '</div>';

		                                                        }
		                                                        else {

		                                                            $html .= '<div class="hotspot-type hotspot-setting">';
		                                                                $html .= '<label for="hotspot-type">'.__('Hotspot-Type: ','wpvr').'</label>';
		                                                                $html .= '<select class="trtr" name="hotspot-type">';
		                                                                    $html .= '<option value="info"> Info</option>';
		                                                                    $html .= '<option value="scene" selected> Scene</option>';
		                                                                $html .= '</select>';

		                                                                $html .= '<div class="hotspot-url" style="display:none;">';
		                                                                    $html .= '<label for="hotspot-url">'.__('URL: ','wpvr').'</label>';
		                                                                    $html .= '<input type="url" name="hotspot-url" />';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-content" style="display:none;">';
		                                                                    $html .= '<label for="hotspot-content">'.__('On click Content: ','wpvr').' </label>';
		                                                                    $html .= '<textarea name="hotspot-content"></textarea>';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-hover">';
		                                                                    $html .= '<label for="hotspot-hover">'.__('On hover Content: ','wpvr').'</label>';
		                                                                    $html .= '<textarea name="hotspot-hover">'.$hotspot_hover.'</textarea>';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-scene" >';
					                                                        $html .= '<label for="hotspot-scene">'.__('Select Target Scene from List: ','wpvr').'</label>';
					                                                        $html .= '<select class="hotspotscene" name="hotspot-scene-list">';
					                                                        	$html .= '<option value="none" selected> None</option>';
					                                                    	$html .= '</select>';
					                                                    $html .= '</div>';

		                                                                $html .= '<div class="hotspot-scene">';
		                                                                    $html .= '<label for="hotspot-scene">'.__('Target Scene ID: ','wpvr').'</label>';
		                                                                    $html .= '<input class="hotspotsceneinfodata" type="text" name="hotspot-scene" value="'.$hotspot_target_scene.'" disabled />';
		                                                                $html .= '</div>';

		                                                            $html .= '</div>';

		                                                        }
		                                                        //=Hotspot type End=//
		                                                        $html .= '<button data-repeater-delete type="button" title="Delete Hotspot" class="delete-hotspot"><i class="far fa-trash-alt"></i></button>';
		                                                    $html .= '</div>';
	                                                    }
	                                                    else {
	                                                    	$html .= '<div data-repeater-item class="single-hotspot rex-pano-tab clearfix" id="scene-'.$s.'-hotspot-'.$h.'">';

		                                                        $html .= '<h6 class="title"><i class="fa fa-cog"></i> Hotspot Setting </h6>';

		                                                        $html .= '<div class="wrapper">';
		                                                            $html .= '<div class="hotspot-setting">';
		                                                                $html .= '<label for="hotspot-title">'.__('Hotspot ID : ','wpvr').'</label>';
		                                                                $html .= '<input type="text" id="hotspot-title" name="hotspot-title" value="'.$hotspot_title.'" />';
		                                                            $html .= '</div>';

		                                                            $html .= '<div class="hotspot-setting">';
		                                                                $html .= '<label for="hotspot-pitch">'.__('Pitch: ','wpvr').'</label>';
		                                                                $html .= '<input type="text" class="hotspot-pitch" name="hotspot-pitch" value="'.$hotspot_pitch.'" />';
		                                                            $html .= '</div>';

		                                                            $html .= '<div class="hotspot-setting">';
		                                                                $html .= '<label for="hotspot-yaw">'.__('Yaw: ','wpvr').'</label>';
		                                                                $html .= '<input type="text" class="hotspot-yaw" name="hotspot-yaw" value="'.$hotspot_yaw.'" />';
		                                                            $html .= '</div>';

																	$html .= '<div class="hotspot-setting">';
	                                                                	$html .= '<label for="hotspot-customclass">'.__('Hotspot custom icon class: ','wpvr').'</label>';
	                                                                	$html .= '<input type="text" id="hotspot-customclass" name="hotspot-customclass" value="'.$hotspot_custom_class.'"/>';
	                                                            	$html .= '</div>';

		                                                        $html .= '</div>';

		                                                        //=Hotspot type=//
		                                                        if ($hotspot_type == "info") {

		                                                            $html .= '<div class="hotspot-type hotspot-setting">';
		                                                                $html .= '<label for="hotspot-type">'.__('Hotspot-Type: ','wpvr').'</label>';
		                                                                $html .= '<select name="hotspot-type">';
		                                                                    $html .= '<option value="info" selected> Info</option>';
		                                                                    $html .= '<option value="scene"> Scene</option>';
		                                                                $html .= '</select>';

		                                                                $html .= '<div class="hotspot-url">';
		                                                                    $html .= '<label for="hotspot-url">'.__('URL: ','wpvr').' </label>';
		                                                                    $html .= '<input type="url" name="hotspot-url" value="'.$hotspot_url.'" />';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-content">';
		                                                                    $html .= '<label for="hotspot-content">'.__('On click Content: ','wpvr').'</label>';
		                                                                    $html .= '<textarea name="hotspot-content">'.$hotspot_content.'</textarea>';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-hover">';
		                                                                    $html .= '<label for="hotspot-hover">'.__('On hover Content: ','wpvr').'</label>';
		                                                                    $html .= '<textarea name="hotspot-hover">'.$hotspot_hover.'</textarea>';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-scene" style="display:none;" >';
					                                                        $html .= '<label for="hotspot-scene">'.__('Select Target Scene from List: ','wpvr').'</label>';
					                                                        $html .= '<select class="hotspotscene" name="hotspot-scene-list">';
					                                                        	$html .= '<option value="none" selected> None</option>';
					                                                    	$html .= '</select>';
					                                                    $html .= '</div>';

		                                                                $html .= '<div class="hotspot-scene" style="display:none;" >';
		                                                                    $html .= '<label for="hotspot-scene">'.__('Target Scene ID: ','wpvr').'</label>';
		                                                                    $html .= '<input class="hotspotsceneinfodata" type="text" name="hotspot-scene" disabled />';
		                                                                $html .= '</div>';

		                                                            $html .= '</div>';

		                                                        }
		                                                        else {

		                                                            $html .= '<div class="hotspot-type hotspot-setting">';
		                                                                $html .= '<label for="hotspot-type">'.__('Hotspot-Type: ','wpvr').'</label>';
		                                                                $html .= '<select class="trtr" name="hotspot-type">';
		                                                                    $html .= '<option value="info"> Info</option>';
		                                                                    $html .= '<option value="scene" selected> Scene</option>';
		                                                                $html .= '</select>';

		                                                                $html .= '<div class="hotspot-url" style="display:none;">';
		                                                                    $html .= '<label for="hotspot-url">'.__('URL: ','wpvr').'</label>';
		                                                                    $html .= '<input type="url" name="hotspot-url" />';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-content" style="display:none;">';
		                                                                    $html .= '<label for="hotspot-content">'.__('On click Content: ','wpvr').'</label>';
		                                                                    $html .= '<textarea name="hotspot-content"></textarea>';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-hover">';
		                                                                    $html .= '<label for="hotspot-hover">'.__('On hover Content: ','wpvr').' </label>';
		                                                                    $html .= '<textarea name="hotspot-hover">'.$hotspot_hover.'</textarea>';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-scene" >';
					                                                        $html .= '<label for="hotspot-scene">'.__('Select Target Scene from List: ','wpvr').'</label>';
					                                                        $html .= '<select class="hotspotscene" name="hotspot-scene-list">';
					                                                        	$html .= '<option value="none" selected> None</option>';
					                                                    	$html .= '</select>';
					                                                    $html .= '</div>';

		                                                                $html .= '<div class="hotspot-scene">';
		                                                                    $html .= '<label for="hotspot-scene">'.__('Target Scene ID: ','wpvr').'</label>';
		                                                                    $html .= '<input class="hotspotsceneinfodata" type="text" name="hotspot-scene" value="'.$hotspot_target_scene.'" disabled />';
		                                                                $html .= '</div>';

		                                                            $html .= '</div>';

		                                                        }
		                                                        //=Hotspot type End=//
		                                                        $html .= '<button data-repeater-delete type="button" title="Delete Hotspot" class="delete-hotspot"><i class="far fa-trash-alt"></i></button>';
		                                                    $html .= '</div>';
	                                                    }
	                                                $h++;
	                                                }
	                                                $html .= '</div>';
	                                            $html .= '</div>';
	                                        }
	                                        else {
	                                        	$html .= '<div class="hotspot-setup rex-pano-sub-tabs" data-limit="'.$data_limit.'">';

			                                        $html .= '<nav class="rex-pano-tab-nav rex-pano-nav-menu hotspot-nav">';
			                                            $html .= '<ul>';
			                                                $html .= '<li class="active"><span data-index="1" data-href="#scene-'.$s.'-hotspot-1"><i class="far fa-dot-circle"></i></span></li>';
			                                                $html .= '<li class="add" data-repeater-create><span><i class="fa fa-plus-circle"></i> </span></li>';
			                                            $html .= '</ul>';
			                                        $html .= '</nav>';

			                                        $html .= '<div data-repeater-list="hotspot-list" class="rex-pano-tab-content">';
			                                            $html .= '<div data-repeater-item class="single-hotspot rex-pano-tab active clearfix" id="scene-'.$s.'-hotspot-1">';

			                                                $html .= '<h6 class="title"><i class="fa fa-cog"></i> Hotspot Setting </h6>';

			                                                $html .= '<div class="wrapper">';
			                                                    $html .= '<div class="hotspot-setting">';
			                                                        $html .= '<label for="hotspot-title">'.__('Hotspot ID : ','wpvr').'</label>';
			                                                        $html .= '<input type="text" id="hotspot-title" name="hotspot-title"/>';
			                                                    $html .= '</div>';

			                                                    $html .= '<div class="hotspot-setting">';
			                                                        $html .= '<label for="hotspot-pitch">'.__('Pitch: ','wpvr').'</label>';
			                                                        $html .= '<input type="text" class="hotspot-pitch" name="hotspot-pitch"/>';
			                                                    $html .= '</div>';

			                                                    $html .= '<div class="hotspot-setting">';
			                                                        $html .= '<label for="hotspot-yaw">'.__('Yaw: ','wpvr').'</label>';
			                                                        $html .= '<input type="text" class="hotspot-yaw" name="hotspot-yaw"/>';
			                                                    $html .= '</div>';

																$html .= '<div class="hotspot-setting">';
		                                                        	$html .= '<label for="hotspot-customclass">'.__('Hotspot custom icon class: ','wpvr').'</label>';
		                                                        	$html .= '<input type="text" id="hotspot-customclass" name="hotspot-customclass"/>';
		                                                    	$html .= '</div>';

			                                                $html .= '</div>';

			                                                $html .= '<div class="hotspot-type hotspot-setting">';
			                                                    $html .= '<label for="hotspot-type">'.__('Hotspot-Type: ','wpvr').'</label>';
			                                                    $html .= '<select name="hotspot-type">';
			                                                        $html .= '<option value="info" selected> Info</option>';
			                                                        $html .= '<option value="scene"> Scene</option>';
			                                                    $html .= '</select>';

			                                                    $html .= '<div class="hotspot-url">';
			                                                        $html .= '<label for="hotspot-url">'.__('URL: ','wpvr').'</label>';
			                                                        $html .= '<input type="url" name="hotspot-url" value="" />';
			                                                    $html .= '</div>';

			                                                    $html .= '<div class="hotspot-content">';
			                                                        $html .= '<label for="hotspot-content">'.__('On click Content: ','wpvr').'</label>';
			                                                        $html .= '<textarea name="hotspot-content"></textarea>';
			                                                    $html .= '</div>';

			                                                    $html .= '<div class="hotspot-hover">';
			                                                        $html .= '<label for="hotspot-hover">'.__('On hover Content: ','wpvr').'</label>';
			                                                        $html .= '<textarea name="hotspot-hover"></textarea>';
			                                                    $html .= '</div>';

			                                                    $html .= '<div class="hotspot-scene" style="display:none;" >';
			                                                        $html .= '<label for="hotspot-scene">'.__('Select Target Scene from List: ','wpvr').'</label>';
			                                                        $html .= '<select class="hotspotscene" name="hotspot-scene-list">';
			                                                        	$html .= '<option value="none"> None</option>';
			                                                    	$html .= '</select>';
			                                                    $html .= '</div>';
			                                                    $html .= '<div class="hotspot-scene" style="display:none;" >';
			                                                        $html .= '<label for="hotspot-scene">'.__('Target Scene ID: ','wpvr').'</label>';
			                                                        $html .= '<input class="hotspotsceneinfodata" type="text" name="hotspot-scene" disabled/>';
			                                                    $html .= '</div>';

			                                                $html .= '</div>';
			                                                //=Hotspot type End=//
			                                                $html .= '<button data-repeater-delete title="Delete Hotspot" type="button" class="delete-hotspot"><i class="far fa-trash-alt"></i></button>';
			                                            $html .= '</div>';
			                                        $html .= '</div>';
			                                    $html .= '</div>';
	                                        }
	                                        $html .= '<button data-repeater-delete type="button" title="Delete Scene" class="delete-scene"><i class="far fa-trash-alt"></i></button>';
	                                    $html .= '</div>';
                                    }
                                    else {
                                    	$html .= '<div data-repeater-item  class="single-scene rex-pano-tab" data-title="1" id="scene-'.$s.'">';

	                                        $html .= '<div class="scene-content">';
	                                            $html .= '<h6 class="title"><i class="fa fa-cog"></i> Scene Setting </h6>';

	                                            //==Set Default Scene==//
												if ($dscene == 'on') {
													$html .= '<div class="single-settings dscene">';
												        $html .= '<span>'.__('Set as default: ','wpvr').'</span>';
												        $html .= '<select class="dscen" name="dscene">';
			                                                $html .= '<option value="on" selected > Yes</option>';
			                                                $html .= '<option value="off"> No</option>';
			                                            $html .= '</select>';
													$html .= '</div>';

												}
												else {
													$html .= '<div class="single-settings dscene">';
												        $html .= '<span>'.__('Set as default: ','wpvr').'</span>';
												        $html .= '<select class="dscen" name="dscene">';
			                                                $html .= '<option value="on"> Yes</option>';
			                                                $html .= '<option value="off" selected> No</option>';
			                                            $html .= '</select>';
													$html .= '</div>';
												}
												//==Set Default Scene end==//

	                                            $html .= '<div class=scene-setting>';
	                                                $html .= '<label for="scene-id">'.__('Scene ID : ','wpvr').'</label>';
	                                                $html .= '<input class="sceneid" type="text" name="scene-id" value="'.$scene_id.'" />';
	                                            $html .= '</div>';

	                                            $html .= '<div class=scene-setting>';
	                                                $html .= '<label for="scene-type">'.__('Scene Type : ','wpvr').'</label>';
	                                                $html .= '<input type="text" name="scene-type" value="equirectangular" disabled/>';
	                                            $html .= '</div>';

	                                            $html .= '<div class=scene-setting>';
	                                                $html .= '<label for="scene-upload">'.__('Scene Upload: ','wpvr').'</label>';
	                                                $html .= '<div class="form-group">';
	                                                    $html .= '<img name ="scene-photo" src="'.$scene_photo.'"> <br/>';
	                                                    $html .= '<input type="button" class="scene-upload" data-info="" value="Upload"/>';
	                                                    $html .= '<input type="hidden" name="scene-attachment-url" class="scene-attachment-url" value="'.$scene_photo.'">';
	                                                $html .= '</div>';
	                                            $html .= '</div>';
	                                        $html .= '</div>';

	                                        if (!empty($pano_hotspots)) {
	                                            $html .= '<div class="hotspot-setup rex-pano-sub-tabs" data-limit="'.$data_limit.'">';

	                                                $html .= '<nav class="rex-pano-tab-nav rex-pano-nav-menu hotspot-nav">';
	                                                    $html .= '<ul>';
	                                                    $j = 1;
	                                                    foreach ($pano_hotspots as $pano_hotspot) {
	                                                    	if ($pano_hotspot['hotspot-title'] == $pano_hotspots[0]['hotspot-title']) {
	                                                        	$html .= '<li class="active"><span data-index="'.$j.'" data-href="#scene-'.$s.'-hotspot-'.$j.'"><i class="far fa-dot-circle"></i></span></li>';
	                                                    	}
	                                                    	else {
	                                                        $html .= '<li><span data-index="'.$j.'" data-href="#scene-'.$s.'-hotspot-'.$j.'"><i class="far fa-dot-circle"></i></span></li>';
	                                                    	}
	                                                    $j++;
	                                                    }
	                                                        $html .= '<li class="add" data-repeater-create><span><i class="fa fa-plus-circle"></i></span></li>';
	                                                    $html .= '</ul>';
	                                                $html .= '</nav>';

	                                                $html .= '<div data-repeater-list="hotspot-list" class="rex-pano-tab-content">';

	                                            	$h = 1;
	                                                foreach ($pano_hotspots as $pano_hotspot) {
	                                                    $hotspot_title = '';
	                                                    $hotspot_title = $pano_hotspot['hotspot-title'];
	                                                    $hotspot_pitch = '';
	                                                    $hotspot_pitch = $pano_hotspot['hotspot-pitch'];
	                                                    $hotspot_yaw = '';
	                                                    $hotspot_yaw = $pano_hotspot['hotspot-yaw'];
	                                                    $hotspot_type = '';
	                                                    $hotspot_type = $pano_hotspot['hotspot-type'];
	                                                    $hotspot_url = '';
	                                                    $hotspot_url = $pano_hotspot['hotspot-url'];
	                                                    $hotspot_content = '';
	                                                    $hotspot_content = $pano_hotspot['hotspot-content'];
	                                                    $hotspot_hover = '';
	                                                    $hotspot_hover = $pano_hotspot['hotspot-hover'];
	                                                    $hotspot_target_scene = '';
	                                                    $hotspot_target_scene = $pano_hotspot['hotspot-scene'];
	                                                    $hotspot_custom_class = '';
	                                                    if (isset($pano_hotspot['hotspot-customclass'])) {
	                                                    	$hotspot_custom_class = $pano_hotspot['hotspot-customclass'];
	                                                    }

	                                                    if ($pano_hotspot['hotspot-title'] == $pano_hotspots[0]['hotspot-title']) {
		                                                    $html .= '<div data-repeater-item class="single-hotspot rex-pano-tab active clearfix" id="scene-'.$s.'-hotspot-'.$h.'">';

		                                                        $html .= '<h6 class="title"><i class="fa fa-cog"></i> Hotspot Setting </h6>';

		                                                        $html .= '<div class="wrapper">';
		                                                            $html .= '<div class="hotspot-setting">';
		                                                                $html .= '<label for="hotspot-title">'.__('Hotspot ID : ','wpvr').'</label>';
		                                                                $html .= '<input type="text" id="hotspot-title" name="hotspot-title" value="'.$hotspot_title.'" />';
		                                                            $html .= '</div>';

		                                                            $html .= '<div class="hotspot-setting">';
		                                                                $html .= '<label for="hotspot-pitch">'.__('Pitch: ','wpvr').'</label>';
		                                                                $html .= '<input type="text" class="hotspot-pitch" name="hotspot-pitch" value="'.$hotspot_pitch.'" />';
		                                                            $html .= '</div>';

		                                                            $html .= '<div class="hotspot-setting">';
		                                                                $html .= '<label for="hotspot-yaw">'.__('Yaw: ','wpvr').'</label>';
		                                                                $html .= '<input type="text" class="hotspot-yaw" name="hotspot-yaw" value="'.$hotspot_yaw.'" />';
		                                                            $html .= '</div>';

																	$html .= '<div class="hotspot-setting">';
	                                                                	$html .= '<label for="hotspot-customclass">'.__('Hotspot custom icon class: ','wpvr').'</label>';
	                                                                	$html .= '<input type="text" id="hotspot-customclass" name="hotspot-customclass" value="'.$hotspot_custom_class.'"/>';
	                                                            	$html .= '</div>';

		                                                        $html .= '</div>';

		                                                        //=Hotspot type=//
		                                                        if ($hotspot_type == "info") {

		                                                            $html .= '<div class="hotspot-type hotspot-setting">';
		                                                                $html .= '<label for="hotspot-type">'.__('Hotspot-Type: ','wpvr').'</label>';
		                                                                $html .= '<select name="hotspot-type">';
		                                                                    $html .= '<option value="info" selected> Info</option>';
		                                                                    $html .= '<option value="scene"> Scene</option>';
		                                                                $html .= '</select>';

		                                                                $html .= '<div class="hotspot-url">';
		                                                                    $html .= '<label for="hotspot-url">'.__('URL: ','wpvr').' </label>';
		                                                                    $html .= '<input type="url" name="hotspot-url" value="'.$hotspot_url.'" />';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-content">';
		                                                                    $html .= '<label for="hotspot-content">'.__('On click Content: ','wpvr').' </label>';
		                                                                    $html .= '<textarea name="hotspot-content">'.$hotspot_content.'</textarea>';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-hover">';
		                                                                    $html .= '<label for="hotspot-hover">'.__('On hover Content: ','wpvr').' </label>';
		                                                                    $html .= '<textarea name="hotspot-hover">'.$hotspot_hover.'</textarea>';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-scene" style="display:none;" >';
					                                                        $html .= '<label for="hotspot-scene">'.__('Select Target Scene from List: ','wpvr').'</label>';
					                                                        $html .= '<select class="hotspotscene" name="hotspot-scene-list">';
					                                                        	$html .= '<option value="none" selected> None</option>';
					                                                    	$html .= '</select>';
					                                                    $html .= '</div>';

		                                                                $html .= '<div class="hotspot-scene" style="display:none;" >';
		                                                                    $html .= '<label for="hotspot-scene">'.__('Target Scene ID: ','wpvr').' </label>';
		                                                                    $html .= '<input class="hotspotsceneinfodata" type="text" name="hotspot-scene"/>';
		                                                                $html .= '</div>';

		                                                            $html .= '</div>';

		                                                        }
		                                                        else {

		                                                            $html .= '<div class="hotspot-type hotspot-setting">';
		                                                                $html .= '<label for="hotspot-type">'.__('Hotspot-Type: ','wpvr').'</label>';
		                                                                $html .= '<select class="trtr" name="hotspot-type">';
		                                                                    $html .= '<option value="info"> Info</option>';
		                                                                    $html .= '<option value="scene" selected> Scene</option>';
		                                                                $html .= '</select>';

		                                                                $html .= '<div class="hotspot-url" style="display:none;">';
		                                                                    $html .= '<label for="hotspot-url">'.__('URL: ','wpvr').' </label>';
		                                                                    $html .= '<input type="url" name="hotspot-url" />';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-content" style="display:none;">';
		                                                                    $html .= '<label for="hotspot-content">'.__('On click Content: ','wpvr').'</label>';
		                                                                    $html .= '<textarea name="hotspot-content"></textarea>';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-hover">';
		                                                                    $html .= '<label for="hotspot-hover">'.__('On hover Content: ','wpvr').' </label>';
		                                                                    $html .= '<textarea name="hotspot-hover">'.$hotspot_hover.'</textarea>';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-scene" >';
					                                                        $html .= '<label for="hotspot-scene">'.__('Select Target Scene from List: ','wpvr').'</label>';
					                                                        $html .= '<select class="hotspotscene" name="hotspot-scene-list">';
					                                                        	$html .= '<option value="none" selected> None</option>';
					                                                    	$html .= '</select>';
					                                                    $html .= '</div>';

		                                                                $html .= '<div class="hotspot-scene">';
		                                                                    $html .= '<label for="hotspot-scene">'.__('Target Scene ID: ','wpvr').'</label>';
		                                                                    $html .= '<input class="hotspotsceneinfodata" type="text" name="hotspot-scene" value="'.$hotspot_target_scene.'" disabled />';
		                                                                $html .= '</div>';

		                                                            $html .= '</div>';

		                                                        }
		                                                        //=Hotspot type End=//
		                                                        $html .= '<button data-repeater-delete type="button" title="Delete Hotspot" class="delete-hotspot"><i class="far fa-trash-alt"></i></button>';
		                                                    $html .= '</div>';
	                                                    }
	                                                    else {
	                                                    	$html .= '<div data-repeater-item class="single-hotspot rex-pano-tab clearfix" id="scene-'.$s.'-hotspot-'.$h.'">';

		                                                        $html .= '<h6 class="title"><i class="fa fa-cog"></i> Hotspot Setting</h6>';

		                                                        $html .= '<div class="wrapper">';
		                                                            $html .= '<div class="hotspot-setting">';
		                                                                $html .= '<label for="hotspot-title">'.__('Hotspot ID : ','wpvr').'</label>';
		                                                                $html .= '<input type="text" id="hotspot-title" name="hotspot-title" value="'.$hotspot_title.'" />';
		                                                            $html .= '</div>';

		                                                            $html .= '<div class="hotspot-setting">';
		                                                                $html .= '<label for="hotspot-pitch">'.__('Pitch: ','wpvr').'</label>';
		                                                                $html .= '<input type="text" class="hotspot-pitch" name="hotspot-pitch" value="'.$hotspot_pitch.'" />';
		                                                            $html .= '</div>';

		                                                            $html .= '<div class="hotspot-setting">';
		                                                                $html .= '<label for="hotspot-yaw">'.__('Yaw: ','wpvr').'</label>';
		                                                                $html .= '<input type="text" class="hotspot-yaw" name="hotspot-yaw" value="'.$hotspot_yaw.'" />';
		                                                            $html .= '</div>';

																	$html .= '<div class="hotspot-setting">';
	                                                                	$html .= '<label for="hotspot-customclass">'.__('Hotspot custom icon class: ','wpvr').'</label>';
	                                                                	$html .= '<input type="text" id="hotspot-customclass" name="hotspot-customclass" value="'.$hotspot_custom_class.'"/>';
	                                                            	$html .= '</div>';

		                                                        $html .= '</div>';

		                                                        //=Hotspot type=//
		                                                        if ($hotspot_type == "info") {

		                                                            $html .= '<div class="hotspot-type hotspot-setting">';
		                                                                $html .= '<label for="hotspot-type">'.__('Hotspot-Type: ','wpvr').'</label>';
		                                                                $html .= '<select name="hotspot-type">';
		                                                                    $html .= '<option value="info" selected> Info</option>';
		                                                                    $html .= '<option value="scene"> Scene</option>';
		                                                                $html .= '</select>';

		                                                                $html .= '<div class="hotspot-url">';
		                                                                    $html .= '<label for="hotspot-url">'.__(' URL: ','wpvr').'</label>';
		                                                                    $html .= '<input type="url" name="hotspot-url" value="'.$hotspot_url.'" />';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-content">';
		                                                                    $html .= '<label for="hotspot-content">'.__('On click Content: ','wpvr').' </label>';
		                                                                    $html .= '<textarea name="hotspot-content">'.$hotspot_content.'</textarea>';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-hover">';
		                                                                    $html .= '<label for="hotspot-hover">'.__('On hover Content: ','wpvr').' </label>';
		                                                                    $html .= '<textarea name="hotspot-hover">'.$hotspot_hover.'</textarea>';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-scene" style="display:none;" >';
					                                                        $html .= '<label for="hotspot-scene">'.__('Select Target Scene from List: ','wpvr').'</label>';
					                                                        $html .= '<select class="hotspotscene" name="hotspot-scene-list">';
					                                                        	$html .= '<option value="none" selected> None</option>';
					                                                    	$html .= '</select>';
					                                                    $html .= '</div>';

		                                                                $html .= '<div class="hotspot-scene" style="display:none;" >';
		                                                                    $html .= '<label for="hotspot-scene">'.__('Target Scene ID: ','wpvr').' </label>';
		                                                                    $html .= '<input class="hotspotsceneinfodata" type="text" name="hotspot-scene" disabled />';
		                                                                $html .= '</div>';

		                                                            $html .= '</div>';

		                                                        }
		                                                        else {

		                                                            $html .= '<div class="hotspot-type hotspot-setting">';
		                                                                $html .= '<label for="hotspot-type">'.__('Hotspot-Type: ','wpvr').'</label>';
		                                                                $html .= '<select class="trtr" name="hotspot-type">';
		                                                                    $html .= '<option value="info"> Info</option>';
		                                                                    $html .= '<option value="scene" selected> Scene</option>';
		                                                                $html .= '</select>';

		                                                                $html .= '<div class="hotspot-url" style="display:none;">';
		                                                                    $html .= '<label for="hotspot-url">'.__('URL: ','wpvr').' </label>';
		                                                                    $html .= '<input type="url" name="hotspot-url" />';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-content" style="display:none;">';
		                                                                    $html .= '<label for="hotspot-content">'.__('On click Content: ','wpvr').' </label>';
		                                                                    $html .= '<textarea name="hotspot-content"></textarea>';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-hover">';
		                                                                    $html .= '<label for="hotspot-hover">'.__('On hover Content: ','wpvr').'</label>';
		                                                                    $html .= '<textarea name="hotspot-hover">'.$hotspot_hover.'</textarea>';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-scene" >';
					                                                        $html .= '<label for="hotspot-scene">'.__('Select Target Scene from List: ','wpvr').'</label>';
					                                                        $html .= '<select class="hotspotscene" name="hotspot-scene-list">';
					                                                        	$html .= '<option value="none" selected> None</option>';
					                                                    	$html .= '</select>';
					                                                    $html .= '</div>';

		                                                                $html .= '<div class="hotspot-scene">';
		                                                                    $html .= '<label for="hotspot-scene">'.__('Target Scene ID: ','wpvr').' </label>';
		                                                                    $html .= '<input class="hotspotsceneinfodata" type="text" name="hotspot-scene" value="'.$hotspot_target_scene.'" disabled />';
		                                                                $html .= '</div>';

		                                                            $html .= '</div>';

		                                                        }
		                                                        //=Hotspot type End=//
		                                                        $html .= '<button data-repeater-delete type="button" title="Delete Hotspot" class="delete-hotspot"><i class="far fa-trash-alt"></i></button>';
		                                                    $html .= '</div>';
	                                                    }
	                                                $h++;
	                                                }
	                                                $html .= '</div>';
	                                            $html .= '</div>';
	                                        }
	                                        else {
	                                        	$html .= '<div class="hotspot-setup rex-pano-sub-tabs" data-limit="'.$data_limit.'">';

			                                        $html .= '<nav class="rex-pano-tab-nav rex-pano-nav-menu hotspot-nav">';
			                                            $html .= '<ul>';
			                                                $html .= '<li class="active"><span data-index="1" data-href="#scene-'.$s.'-hotspot-1"><i class="far fa-dot-circle"></i></span></li>';
			                                                $html .= '<li class="add" data-repeater-create><span><i class="fa fa-plus-circle"></i> </span></li>';
			                                            $html .= '</ul>';
			                                        $html .= '</nav>';

			                                        $html .= '<div data-repeater-list="hotspot-list" class="rex-pano-tab-content">';
			                                            $html .= '<div data-repeater-item class="single-hotspot rex-pano-tab active clearfix" id="scene-'.$s.'-hotspot-1">';

			                                                $html .= '<h6 class="title"><i class="fa fa-cog"></i> Hotspot Setting </h6>';

			                                                $html .= '<div class="wrapper">';
			                                                    $html .= '<div class="hotspot-setting">';
			                                                        $html .= '<label for="hotspot-title">'.__('Hotspot ID : ','wpvr').'</label>';
			                                                        $html .= '<input type="text" id="hotspot-title" name="hotspot-title"/>';
			                                                    $html .= '</div>';

			                                                    $html .= '<div class="hotspot-setting">';
			                                                        $html .= '<label for="hotspot-pitch">'.__('Pitch: ','wpvr').'</label>';
			                                                        $html .= '<input type="text" class="hotspot-pitch" name="hotspot-pitch"/>';
			                                                    $html .= '</div>';

			                                                    $html .= '<div class="hotspot-setting">';
			                                                        $html .= '<label for="hotspot-yaw">'.__('Yaw: ','wpvr').'</label>';
			                                                        $html .= '<input type="text" class="hotspot-yaw" name="hotspot-yaw"/>';
			                                                    $html .= '</div>';

																$html .= '<div class="hotspot-setting">';
		                                                        	$html .= '<label for="hotspot-customclass">'.__('Hotspot custom icon class: ','wpvr').'</label>';
		                                                        	$html .= '<input type="text" id="hotspot-customclass" name="hotspot-customclass"/>';
		                                                    	$html .= '</div>';

			                                                $html .= '</div>';

			                                                $html .= '<div class="hotspot-type hotspot-setting">';
			                                                    $html .= '<label for="hotspot-type">'.__('Hotspot-Type: ','wpvr').'</label>';
			                                                    $html .= '<select name="hotspot-type">';
			                                                        $html .= '<option value="info" selected> Info</option>';
			                                                        $html .= '<option value="scene"> Scene</option>';
			                                                    $html .= '</select>';

			                                                    $html .= '<div class="hotspot-url">';
			                                                        $html .= '<label for="hotspot-url">'.__('URL: ','wpvr').'</label>';
			                                                        $html .= '<input type="url" name="hotspot-url" value="" />';
			                                                    $html .= '</div>';

			                                                    $html .= '<div class="hotspot-content">';
			                                                        $html .= '<label for="hotspot-content">'.__('On click Content: ','wpvr').'</label>';
			                                                        $html .= '<textarea name="hotspot-content"></textarea>';
			                                                    $html .= '</div>';

			                                                    $html .= '<div class="hotspot-hover">';
			                                                        $html .= '<label for="hotspot-hover">'.__('On hover Content: ','wpvr').'</label>';
			                                                        $html .= '<textarea name="hotspot-hover"></textarea>';
			                                                    $html .= '</div>';

			                                                    $html .= '<div class="hotspot-scene" style="display:none;" >';
			                                                        $html .= '<label for="hotspot-scene">'.__('Select Target Scene from List: ','wpvr').'</label>';
			                                                        $html .= '<select class="hotspotscene" name="hotspot-scene-list">';
			                                                        	$html .= '<option value="none"> None</option>';
			                                                    	$html .= '</select>';
			                                                    $html .= '</div>';
			                                                    $html .= '<div class="hotspot-scene" style="display:none;" >';
			                                                        $html .= '<label for="hotspot-scene">'.__('Target Scene ID: ','wpvr').'</label>';
			                                                        $html .= '<input class="hotspotsceneinfodata" type="text" name="hotspot-scene" disabled/>';
			                                                    $html .= '</div>';

			                                                $html .= '</div>';
			                                                //=Hotspot type End=//
			                                                $html .= '<button data-repeater-delete title="Delete Hotspot" type="button" class="delete-hotspot"><i class="far fa-trash-alt"></i></button>';
			                                            $html .= '</div>';
			                                        $html .= '</div>';
			                                    $html .= '</div>';
	                                        }
	                                        $html .= '<button data-repeater-delete type="button" title="Delete Scene" class="delete-scene"><i class="far fa-trash-alt"></i></button>';
	                                    $html .= '</div>';
                                    }
                                	$s++;
                                }
                            $html .= '</div>';

                        $html .= '</div>';
                    }

                    $html .= '<div class="preview-btn-wrapper">';
                        $html .= '<div class="preview-btn-area clearfix">';

                             $html .= '<button id="panolenspreview">'.__('Preview','wpvr').'</button>';
                        $html .= '</div>';
			        $html .= '</div>';
                $html .='</div>';
                //---end scenes tab----
                $html .= '<div id="error_occured"></div>';
                //----start video tab content---------
                $html .='<div class="rex-pano-tab video" id="video">';
                    $html .= '<h6 class="title"> '.__('Video Settings : ','wpvr').'</h6>';
                    //==Video Setup==//
                	if (isset($postdata['vidid'])) {
                		$vidautoplay = $postdata['vidautoplay'];
                		$vidautoplay_on = '';
                		$vidautoplay_off = '';
                		if (!empty($vidautoplay)) {
                			$vidautoplay_on = 'checked';
                		}
                		else {
                			$vidautoplay_off = 'checked';
                		}

                		$vidcontrol = $postdata['vidcontrol'];
                		$vidcontrol_on = '';
                		$vidcontrol_off = '';
                		if (!empty($vidcontrol)) {
                			$vidcontrol_on = 'checked';
                		}
                		else {
                			$vidcontrol_off = 'checked';
                		}
						$html .= '<div class="single-settings videosetup">';
                            $html .= '<span>Enable Video: </span>';
                            $html .= '<ul>';
                                $html .= '<li class="radio-btn">';
                                    $html .= '<input class="styled-radio" id="styled-radio" type="radio" name="panovideo" value="off" >';
                                    $html .= '<label for="styled-radio">Off</label>';
                                $html .= '</li>';

                                $html .= '<li class="radio-btn">';
                                    $html .= '<input class="styled-radio" id="styled-radio-0" type="radio" name="panovideo" value="on" checked>';
                                    $html .= '<label for="styled-radio-0">On</label>';
                                $html .= '</li>';
                            $html .= '</ul>';
                        $html .= '</div>';


                        $html .= '<div class="video-setting" style="display:none;">';
                            $html .= '<div class="single-settings">';
                                $html .= '<span>Upload or add link: </span>';
                                $html .= '<div class="form-group">';
                                    $html .= '<input type="text" name="video-attachment-url" placeholder="Paste Youtube or Vimeo link or upload" class="video-attachment-url" value="'.$postdata['vidurl'].'">';
                                    $html .= '<input type="button" class="video-upload" data-info="" value="Upload" />';
                                $html .= '</div>';
                            $html .= '</div>';
                            $html .= '<button id="videopreview">Preview</button>';
                        $html .= '</div>';
					}
					else {
						$html .= '<div class="single-settings videosetup">';
                            $html .= '<span>Enable Video: </span>';
                            $html .= '<ul>';
                                $html .= '<li class="radio-btn">';
                                    $html .= '<input class="styled-radio" id="styled-radio" type="radio" name="panovideo" value="off" checked >';
                                    $html .= '<label for="styled-radio">Off</label>';
                                $html .= '</li>';

                                $html .= '<li class="radio-btn">';
                                    $html .= '<input class="styled-radio" id="styled-radio-0" type="radio" name="panovideo" value="on" >';
                                    $html .= '<label for="styled-radio-0">On</label>';
                                $html .= '</li>';
                            $html .= '</ul>';
                        $html .= '</div>';

                    //==Video setup end==//

                    //==Video Setting==/
                        $html .= '<div class="video-setting" style="display:none;">';
                            $html .= '<div class="single-settings">';
                                $html .= '<span>Upload or add link: </span>';
                                $html .= '<div class="form-group">';
                                    $html .= '<input type="text" placeholder="Paste Youtube or Vimeo link or upload" name="video-attachment-url" class="video-attachment-url" value="">';
                                    $html .= '<input type="button" class="video-upload" data-info="" value="Upload"/>';
                                $html .= '</div>';
                            $html .= '</div>';
                            $html .= '<button id="videopreview">Preview</button>';
                        $html .= '</div>';
					}
                    //==Video Setting End==//
                $html .='</div>';
                //---end video tab----
            $html .='</div>';
            //---end rex-pano-tab-content----
        $html .='</div>';
        //---end rex-pano-tabs---
	$html .= '</div>';
	echo $html;
	}

}
