<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://wdvillage.com
 * @since      1.0.0
 *
 * @package    Wdv_About_Me_Widget
 * @subpackage Wdv_About_Me_Widget/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wdv_About_Me_Widget
 * @subpackage Wdv_About_Me_Widget/includes
 * @author     wdvillage <wdvillage100@gmail.com>
 */
class Wdv_About_Me_Widget_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wdv-about-me-widget',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
