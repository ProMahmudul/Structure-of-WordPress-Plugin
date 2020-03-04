<?php

/**
 * Plugin Name: SoftGhor Academy
 * Description: A test plugin for softghor
 * Plugin URI: https://softghor.com
 * Author: Mahmudul Hassan
 * Author URI: https://mahmudulhassan.me
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: softghor-academy
 */

// if ( ! defined( ‘ABSPATH’ ) ) {
// exit;
// }

require_once __DIR__ . '/vendor/autoload.php';

/**
 * The main plugin class
 */
final class SoftGhor_Academy {

	/**
	 * Plugin Version
	 */
	const VERSION = '1.0';

	/**
	 * Class constructor
	 */
	private function __construct() {
		$this->define_constant();

		register_activation_hook( __FILE__, array( $this, 'activate' ) );

		add_action( 'plugins_loaded', array( $this, 'init_plugin' ) );
	}

	/**
	 * Initialize a singleton instance
	 *
	 * @return \SoftGhor_Academy
	 */
	public static function init() {
		static $instance = false;
		if ( ! $instance ) {
			$instance = new self();
		}
		return $instance;
	}

	/**
	 * Define the required plugin constants
	 *
	 * @return void
	 */
	public function define_constant() {
		define( 'SG_ACADEMY_VERSION', self::VERSION );
		define( 'SG_ACADEMY_FILE', __FILE__ );
		define( 'SG_ACADEMY_PATH', __DIR__ );
		define( 'SG_ACADEMY_URL', plugins_url( '', SG_ACADEMY_FILE ) );
		define( 'SG_ACADEMY_ASSETS', SG_ACADEMY_URL . '/assets' );
	}

    /**
     * Initialize the plugin
     *
     * @return void
     */
	public function init_plugin() {
        if(is_admin()){
            new SoftGhor\Academy\Admin();
        } else {
            new SoftGhor\Academy\Frontend();
        }
        
	}

	/**
	 * Do stuff upon plugin activation
	 *
	 * @return void
	 */
	public function activate() {
		$installed = get_option( 'sg_academy_installed' );

		if ( ! $instance ) {
			update_option( 'sg_academy_installed' );
		}

		update_option( 'sg_academy_version', SG_ACADEMY_VERSION );
	}
}

/**
 * Initialize the main plugin
 *
 * @return \SoftGhor_Academy
 */
function softghor_academy() {
	return SoftGhor_Academy::init();
}

// kick-off the plugin.
softghor_academy();
