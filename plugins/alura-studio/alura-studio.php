<?php 
/**
 * Plugin Name: Alura Studio
 * Plugin URI: http://alura-studio.com
 * Description: Add shortcodes and custom post types for Alura Studio theme
 * Version: 1.0.0
 * Author: Alura Studio
 * Author URI: http://alura-studio.com
 */
class AluraStudio_Plugin{

	function __construct(){

		$this->include_files();
		$this->register_widgets();

		/* Allow to add shortcodes in the Text widget */
		add_filter('widget_text', 'do_shortcode');
	}
	
	function include_files(){
		
		require_once ('functions.php');
		
		$file_names = array('register', 'shortcodes');
		foreach( $file_names as $file_name ){
			$file = plugin_dir_path( __FILE__ ) . '/includes/' . $file_name . '.php';
			if( file_exists($file) ){
				require_once($file);
			}
		}		
	}

	function register_widgets(){

		$file_names = array('instagram', 'brands_slider', 'footer');
		foreach( $file_names as $file_name ){
			$file = plugin_dir_path( __FILE__ ) . '/widgets/' . $file_name . '.php';
			if( file_exists($file) ){
				require_once($file);
			}
		}		
	}
	
}
new AluraStudio_Plugin();

?>