<?php
class Giphy_Widget extends WP_Widget {

    protected $api_key;
    protected $api_url;

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'giphy_widget',
			'description' => 'Set avatar from random giphys',
		);
		parent::__construct( 'giphy_widget', 'Giphy Widget', $widget_ops);
        $this->api_key = 'WIAHeiK4fDly68vuuciLOwlbmU1tU3U3';
        $this->api_url = 'https://api.giphy.com/v1/';
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) 
    {
		echo $args['before_widget'];
		
        $words = get_option('giphy_words');

        if(!$words){
            echo 'Please configure this plugin first.';
            return;
        }
        
		$endpoint = $this->api_url . 'gifs/search?api_key=' . $this->api_key . '&limit=9&q=' . $words;
        
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
        $response = curl_exec($ch);
        curl_close($ch);
		
        $decoded = json_decode($response, true);
        $data = $decoded['data'];

		$random_keys = array_rand($data, 5);
        $images = array();

		foreach($random_keys as $key)
        {
			$giphy = $data[$key]['images']['fixed_height_small_still'];
            $images[] = $giphy;
		}

		include plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/giphy-generator-public-display.php';

		echo $args['after_widget'];
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
	}
}