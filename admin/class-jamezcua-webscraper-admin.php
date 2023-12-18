<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://mandalorianscode.com
 * @since      1.0.0
 *
 * @package    Jamezcua_Webscraper
 * @subpackage Jamezcua_Webscraper/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Jamezcua_Webscraper
 * @subpackage Jamezcua_Webscraper/admin
 * @author     Jamezcua <javieramezcuaduran@gmail.com>
 */
class Jamezcua_Webscraper_Admin {

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

		add_action('admin_menu', array($this, 'addAdminMenuItems'), 9);

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/jamezcua-webscraper-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/jamezcua-webscraper-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function jamezcua_scrapfunctions(){
		
		$url 	=	$_REQUEST['url'];
		$html = 	file_get_contents_curl($url);                    
		$doc 	= 	new DOMDocument();
		@$doc->loadHTML($html);
		$nodes 	= 	$doc->getElementsByTagName('title');
		$title 	= 	limpiarString($nodes->item(0)->nodeValue);
		$metas 	= 	$doc->getElementsByTagName('meta');
		for ($i = 0; $i < $metas->length; $i++):
		$meta = $metas->item($i);
				if($meta->getAttribute('name') == 'description')
					$description = limpiarString($meta->getAttribute('content'));
				if($meta->getAttribute('name') == 'keywords')
					$keywords = limpiarString($meta->getAttribute('content'));
		endfor;
	}

	public function addAdminMenuItems() {
		//add_menu_page( string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '', string $icon_url = '', int $position = null )
		add_menu_page(
			$this->plugin_name,
			'News Scraper',
			'administrator',
			$this->plugin_name,
			array(
				$this,
				'displayAdminDashboard',
			),
			'dashicons-admin-site',
			20
		);
	}

	public function displayAdminDashboard() {
		require_once 'partials/' . $this->plugin_name . '-admin-display.php';
	}

	public function file_get_contents_curl($url){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}
	
	public function clean_string($String){ 
			$String = str_replace(array("|","|","[","^","´","`","¨","~","]","'","#","{","}",".",""),"",$String);
			return $String;
	}

}




