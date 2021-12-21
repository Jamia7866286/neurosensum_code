<?php

/**
	This file is part of Varnish HTTP Purge, a plugin for WordPress.

	Varnish HTTP Purge is free software: you can redistribute it and/or modify
	it under the terms of the Apache License 2.0 license.

	Varnish HTTP Purge is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.

*/

if (!defined('ABSPATH')) {
    die();
}

// Bail if WP-CLI is not present
if ( !defined( 'WP_CLI' ) ) return;

/**
 * Purges Varnish Cache
 */
class LW_WP_CLI_Varnish_Purge_Command extends WP_CLI_Command {

	private $wildcard = false;

	public function __construct() {
		$this->varnish_purge = LW_Varnish_Cache_Purger::get_instance();
	}

    /**
     * Forces a full Varnish Purge of the entire site (provided
     * regex is supported).
     *
     * ## EXAMPLES
     *
     *		wp varnish purge
     *
     *		wp varnish purge http://example.com/wp-content/themes/twentyeleventy/style.css
     *
	 *		wp varnish purge "/wp-content/themes/twentysixty/style.css"
	 *
     *		wp varnish purge http://example.com/wp-content/themes/ --wildcard
     *
     *		wp varnish purge "/wp-content/themes/" --wildcard
     *
     */

	function purge( $args , $assoc_args ) {

		$wp_version = get_bloginfo( 'version' );
		$cli_version = WP_CLI_VERSION;

		// Set the URL/path
		if ( !empty($args) ) { list( $url ) = $args; }

		// If wildcard is set, or the URL argument is empty
		// then treat this as a full purge
		$pregex = $wild = '';
		if ( isset( $assoc_args['wildcard'] ) || empty($url) ) {
			//$pregex = '/?vhp-regex';
			$wild = ".*";
		}

		wp_create_nonce('vhp-flush-cli');

		// Make sure the URL is a URL:
		if ( !empty($url) ) {
			$url = $this->varnish_purge->the_home_url() . esc_url( $url );
		} else {
			$url = $this->varnish_purge->the_home_url();
		}

		$this->varnish_purge->purge_url( $url.$wild, $wild );


		WP_CLI::success( sprintf('The Varnish cache was purged.') );
	}

}

WP_CLI::add_command( 'varnish', 'LW_WP_CLI_Varnish_Purge_Command' );
