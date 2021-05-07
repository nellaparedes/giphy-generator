<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       nella.com
 * @since      1.0.0
 *
 * @package    Giphy_Generator
 * @subpackage Giphy_Generator/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Giphy_Generator
 * @subpackage Giphy_Generator/admin
 * @author     Giannella Paredes <nella.paredes@gmail.com>
 */
class Giphy_Generator_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

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
		 * defined in Giphy_Generator_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Giphy_Generator_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/giphy-generator-admin.css', array(), $this->version, 'all' );

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
		 * defined in Giphy_Generator_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Giphy_Generator_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/giphy-generator-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function register_settings(){
		register_setting( 'giphy_options', 'giphy_words' );
	}

	public function create_menu() 
	{
		add_menu_page('Giphy Generator Settings', 'Settings', 'administrator', 'giphy-generator', array( __CLASS__, 'settings_page' ));
	}

	public function settings_page(){
		include plugin_dir_path( __FILE__ ) . 'partials/giphy-generator-admin-display.php';
	}

	public function register_widget(){
		register_widget( 'Giphy_Widget' );
	}
}
