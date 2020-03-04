<?php

namespace SoftGhor\Academy\Admin;

/**
 * The Menu handler class
 */

class Menu {

	function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
	}

	public function admin_menu() {
		add_menu_page( __( 'SoftGhor Academy', 'softghor-academy' ), __( 'Academy', 'softghor-academy' ), 'manage_options', 'softgho-academy', array( $this, 'plugin_page' ), 'dashicons-welcome-learn-more' );
    }
    
    public function plugin_page(){
        echo 'Hello World!';
    }
}

