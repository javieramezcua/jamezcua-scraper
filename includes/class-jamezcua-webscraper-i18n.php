<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://mandalorianscode.com
 * @since      1.0.0
 *
 * @package    Jamezcua_Webscraper
 * @subpackage Jamezcua_Webscraper/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Jamezcua_Webscraper
 * @subpackage Jamezcua_Webscraper/includes
 * @author     Jamezcua <javieramezcuaduran@gmail.com>
 */
class Jamezcua_Webscraper_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'jamezcua-webscraper',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
