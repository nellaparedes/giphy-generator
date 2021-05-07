<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       nella.com
 * @since      1.0.0
 *
 * @package    Giphy_Generator
 * @subpackage Giphy_Generator/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Giphy_Generator
 * @subpackage Giphy_Generator/public
 * @author     Giannella Paredes <nella.paredes@gmail.com>
 */
class Giphy_Generator_Public {

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
		 * defined in Giphy_Generator_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Giphy_Generator_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/giphy-generator-public.css', array(), $this->version, 'all' );

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
		 * defined in Giphy_Generator_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Giphy_Generator_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/giphy-generator-public.js', array( 'jquery' ), $this->version, false );

		 wp_localize_script( $this->plugin_name, 'giphy', array(
			'url'    => admin_url( 'admin-ajax.php' ),
			'nonce'  => wp_create_nonce( 'ajax-nonce' ),
			'action' => 'set_avatar'
		) );

	}

	public function set_avatar(){

		ob_start();

		$url = $_POST['avatar'];
		$nonce = sanitize_text_field( $_POST['nonce'] );

		if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) ) {
			
			$response = [
				'status' => 'error',
				'message' =>'Invalid request'
			];
		}
		else{
			$response = $this->update_avatar($url);
		}
		
		ob_end_clean();
		echo json_encode($response);
		wp_die();
	}

	protected function update_avatar($url){

		if(!$url){
			$response = [
				'status' => 'error',
				'message' =>'No avatar sent'
			];
			return $response;
		}

		if(get_option('giphy_avatar') !== false){
			update_option('giphy_avatar', $url);
		}
		else{
			add_option('giphy_avatar', $url);
		}


		$response = [
			'status' => 'success',
			'message' =>'Avatar updated'
		];

		return $response;

	}

	public function get_avatar($avatar){		

		if(get_option('giphy_avatar')){
			$avatar = "<img width='64' height='64' src='" . get_option('giphy_avatar') . "' class='avatar photo' />";
		}

		return $avatar;
	}

}
