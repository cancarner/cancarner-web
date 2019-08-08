<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://rextheme.com/
 * @since      1.0.0
 *
 * @package    Wpvr
 * @subpackage Wpvr/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Wpvr
 * @subpackage Wpvr/includes
 * @author     Rextheme <sakib@coderex.co>
 */

class Wpvr {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Wpvr_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * The post type for the plugin
	 *
	 * @since 1.0.0
	 */
	protected $post_type;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		if ( defined( 'WPVR' ) ) {
			$this->version = WPVR;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'wpvr';
		$this->post_type = 'wpvr_item';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Wpvr_Loader. Orchestrates the hooks of the plugin.
	 * - Wpvr_i18n. Defines internationalization functionality.
	 * - Wpvr_Admin. Defines all hooks for the admin area.
	 * - Wpvr_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wpvr-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wpvr-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wpvr-admin-pages.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wpvr-admin.php';

		/**
		 * The class responsible for defining all JQuery Ajax.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wpvr-ajax.php';

		/**
		 * The class responsible for defining all JQuery Ajax.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wpvr-icon.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-wpvr-public.php';

		$this->loader = new Wpvr_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Wpvr_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Wpvr_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		include_once(ABSPATH.'wp-admin/includes/plugin.php');
		if(is_plugin_active( 'wpvr-pro/wpvr-pro.php' )) {
			if (file_exists(ABSPATH . '/wp-content/plugins/wpvr-pro/wpvr-pro.php')) {
				if (class_exists('Wpvrpro')) {
					$plugin_admin = new Wpvrpro( $this->get_plugin_name(), $this->get_version(), $this->get_post_type() );
				}
				else {
					$plugin_admin = new Wpvr_Admin( $this->get_plugin_name(), $this->get_version(), $this->get_post_type() );
				}

			}
			else {
				$plugin_admin = new Wpvr_Admin( $this->get_plugin_name(), $this->get_version(), $this->get_post_type() );
			}
		}else {
			$plugin_admin = new Wpvr_Admin( $this->get_plugin_name(), $this->get_version(), $this->get_post_type() );
		}

		if(is_plugin_active( 'wpvr-pro/wpvr-pro.php' )) {
			if (file_exists(ABSPATH . '/wp-content/plugins/wpvr-pro/wpvr-pro.php')) {
				if (class_exists('Wpvr_Admin_Pages_pro')) {
					$plugin_admin_page = new Wpvr_Admin_Pages_pro();
				}
				else {
					$plugin_admin_page = new Wpvr_Admin_Pages();
				}

			}
			else {
				$plugin_admin_page = new Wpvr_Admin_Pages();
			}
		}else {
			$plugin_admin_page = new Wpvr_Admin_Pages();
		}

		$plugin_admin_ajax = new Wpvr_Ajax();

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		$this->loader->add_action( 'admin_menu', $plugin_admin_page, 'wpvr_add_admin_pages' );
		$this->loader->add_action( 'init', $plugin_admin, 'wpvr_add_plugin_custom_post_type' );
		$this->loader->add_filter( 'manage_edit-' . $this->post_type . '_columns', $plugin_admin, 'wpvr_manage_post_columns' );
		$this->loader->add_filter( 'post_updated_messages', $plugin_admin, 'wpvr_post_updated_messages' );
		$this->loader->add_filter( 'manage_' . $this->post_type . '_posts_custom_column', $plugin_admin, 'wpvr_manage_posts_custom_column' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'wpvr_admin_init' );
		$this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'wpvr_add_setup_metabox' );
		$this->loader->add_action( 'wp_ajax_wpvr_preview', $plugin_admin_ajax, 'wpvr_show_preview' );
		$this->loader->add_action( 'wp_ajax_wpvr_save', $plugin_admin_ajax, 'wpvr_save_data' );
		$this->loader->add_action( 'wp_ajax_wpvr_save', $plugin_admin_ajax, 'wpvr_save_data' );
		$this->loader->add_action( 'wp_ajax_wpvrvideo_preview', $plugin_admin_ajax, 'wpvrvideo_preview' );
		$this->loader->add_action( 'wp_ajax_wpvr_file_import', $plugin_admin_ajax, 'wpvr_file_import' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		include_once(ABSPATH.'wp-admin/includes/plugin.php');
		if(is_plugin_active( 'wpvr-pro/wpvr-pro.php' )) {
			if (file_exists(ABSPATH . '/wp-content/plugins/wpvr-pro/wpvr-pro.php')) {
				if (class_exists('Wpvrpropublic')) {
					$plugin_public = new Wpvrpropublic( $this->get_plugin_name(), $this->get_version() );
				}
				else {
					$plugin_public = new Wpvr_Public( $this->get_plugin_name(), $this->get_version() );
				}

			}
			else {
				$plugin_public = new Wpvr_Public( $this->get_plugin_name(), $this->get_version() );
			}
		}else {
			$plugin_public = new Wpvr_Public( $this->get_plugin_name(), $this->get_version() );
		}

		// $plugin_public = new Wpvr_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		$plugin_public->public_init();

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Wpvr_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Retrieve the post type of the plugin.
	 *
	 * @since 1.0.0
	 */
	public function get_post_type() {
		return $this->post_type;
	}

}
