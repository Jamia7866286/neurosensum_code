<?php
/*
Plugin Name: Liquid Web Varnish Cache Purger
Plugin URI: http://liquidweb.com
Description: Clears items from the Varnish HTTP cache when content on your site changes.
Version: 1.1
Author: Liquid Web <support@liquidweb.com>
Author URI: http://liquidweb.com
*/

/*
	Copyright 2017 Liquid Web

	This file is part of LW Varnish Cache Purger, a plugin for WordPress.

	LW Varnish Cache Purger is free software: you can redistribute it and/or modify
	it under the terms of the Apache License 2.0 license.

	LW Varnish Cache Purger is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.

	Some inspiration and code was taken from Varnish HTTP Purge

	Varnish HTTP Purge

	Copyright 2013-2016: Mika A. Epstein (email: ipstenu@halfelf.org)

	Original Author: Leon Weidauer ( http:/www.lnwdr.de/ )

	Varnish HTTP Purge is free software: you can redistribute it and/or modify
	it under the terms of the Apache License 2.0 license.

	Varnish HTTP Purge is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

class LW_Varnish_Cache_Purger {

	static $instance;
	protected $regex_urls = [];
	protected $exact_urls = [];
	protected $pluginPath = __DIR__;

	private function __construct() {
		add_action( 'activity_box_end', [ $this, 'varnish_rightnow' ], 100 );
	}

	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	public function add_hooks() {
		add_action( 'plugins_loaded', [$this, 'plugins_loaded'] );
	}

	public function plugins_loaded() {
		// Individual posts
		add_action( 'save_post',         [ $this, 'purge_post' ] );
		add_action( 'edit_post',         [ $this, 'purge_post' ] );
		add_action( 'deleted_post',      [ $this, 'purge_post' ] );
		add_action( 'trashed_post',      [ $this, 'purge_post' ] );
		add_action( 'delete_attachment', [ $this, 'purge_post' ] );

		// Overall site change
		add_action( 'switch_theme', [ $this, 'purge_all' ] );

		// Process purging on shutdown
		add_action( 'shutdown', [ $this, 'do_purge' ] );

		// Process purge all from a wp-admin GET request 'vhp_flush_all'
		if ( isset( $_GET['vhp_flush_all'] ) && check_admin_referer( 'vhp-flush-all' ) ) {

			$this->do_purge_all();

			$this->purge_cache_from_mwp_manager();

			// Success: Admin notice when purging
			add_action( 'admin_notices' , [ $this, 'purgeMessage' ] );
		}

		// Checking user permissions for who can and cannot use the admin button
		if (
			// SingleSite - admins can always purge
			( !is_multisite() && current_user_can( 'activate_plugins' ) ) ||
			// Multisite - Network Admin can always purge
			current_user_can( 'manage_network' ) ||
			// Multisite - Site admins can purge UNLESS it's a subfolder install and we're on site #1
			( is_multisite() && current_user_can( 'activate_plugins' ) && ( SUBDOMAIN_INSTALL || ( !SUBDOMAIN_INSTALL && ( BLOG_ID_CURRENT_SITE != $blog_id ) ) ) )
			) {
				add_action( 'admin_bar_menu', [ $this, 'varnish_rightnow_adminbar' ], 100 );
		}

	}

	public function add_base_url( $url ) {
		$this->add_regex_url( $url . '.*' );
	}

	public function add_exact_url( $url ) {
		$this->exact_urls[] = $url;
	}

	public function add_regex_url( $url ) {
		$this->regex_urls[] = $url;
	}

	public function purge_post( $post_id ) {
		$post = get_post( $post_id );
		if ( is_null( $post ) ) {
			return $post_id;
		}

		$urls = [];

		$permalink = get_permalink( $post_id );
		$status = get_post_status( $post_id );

		if ( $permalink && in_array( $status, [ 'publish', 'trash' ] ) ) {

			// Categories
			$categories = get_the_category( $post_id );
			if ( $categories ) {
				foreach ( $categories as $category ) {
					$this->add_base_url( get_category_link( $category->term_id ) );
				}
			}

			// Tags
			$tags = get_the_tags( $post_id );
			if ( $tags ) {
				foreach ( $tags as $tag ) {
					$this->add_base_url( get_tag_link( $tag->term_id ) );
				}
			}

			// Author
			$this->add_base_url( get_author_posts_url( get_post_field( 'post_author', $post_id ) ) );
			$this->add_base_url( get_author_feed_link( get_post_field( 'post_author', $post_id ) ) );

			// Archive
			if ( get_post_type_archive_link( get_post_type( $post_id ) ) ) {
				$this->add_base_url( get_post_type_archive_link( get_post_type( $post_id ) ) );
				$this->add_base_url( get_post_type_archive_feed_link( get_post_type( $post_id ) ) );
			}

			// Post
			$this->add_base_url( $permalink );

			// Add in AMP permalink if Automattic's AMP is installed
			if ( function_exists( 'amp_get_permalink' ) ) {
				$this->add_base_url( amp_get_permalink( $post_id ) );
			}

			// Feeds
			$this->add_base_url( get_bloginfo_rss( 'rdf_url' ) );
			$this->add_base_url( get_bloginfo_rss( 'rss_url' ) );
			$this->add_base_url( get_bloginfo_rss( 'rss2_url' ) );
			$this->add_base_url( get_bloginfo_rss( 'atom_url' ) );
			$this->add_base_url( get_bloginfo_rss( 'comments_rss2_url' ) );
			$this->add_base_url( get_post_comments_feed_link( $post_id ) );

			// Home page (can't do base_url here or it will purge the whole site!)
			$this->add_exact_url( home_url('/') );

			// Pages of the home page
			$this->add_base_url( home_url( '/page/' ) );

			// Blog URL
			if ( get_option( 'show_on_front' ) === 'page' && get_option( 'page_for_posts' ) ) {
				$page_for_posts = get_permalink( get_option( 'page_for_posts' ) );
				$this->add_base_url( $page_for_posts );
			}
		}
	}

	public function purge_url( $url, $regex = false ) {
		$parsed = parse_url( $url );

		$x_purge_method = $regex ? 'regex' : 'exact';

		$path = isset( $parsed['path'] ) ? $parsed['path'] : '';

		$schema = 'http://';

		$host = $parsed['host'];

		$purge_url = $schema . $host . $path;

		if ( ! empty( $parsed['query'] ) ) {
			$purge_url .= '?' . $parsed['query'];
		}

		// Do the PURGE
		$this->send_purge( $purge_url, $parsed['host'], $x_purge_method );
	}

	protected function send_purge( $url, $host, $method ) {
		wp_remote_request( $url, [ 'sslverify' => false, 'method' => 'PURGE', 'headers' => [ 'host' => $host, 'X-Purge-Method' => $method ] ] );
	}

	public function purge_regex_url( $url ) {
		return $this->purge_url( $url, true );
	}

	public function purge_all() {
		add_action( 'shutdown', [ $this, 'do_purge_all' ] );
	}

	public function do_purge() {
		$regex_urls = array_unique( $this->regex_urls );
		$exact_urls = array_unique( $this->exact_urls );

		// Regex URLs
		foreach ( $regex_urls as $url ) {
			$this->purge_regex_url( $url );
		}

		// Exact URLs
		foreach ( $exact_urls as $url ) {
			$this->purge_url( $url );
		}

	}

	public function do_purge_all() {
		$this->purge_regex_url( home_url( '/' ) . '.*' );
	}

	public function purgeMessage() {
		echo "<div id='message' class='notice notice-success fade is-dismissible'><p><strong>".__('Varnish cache emptied!', 'varnish-http-purge')."</strong></p></div>";
	}

    public function varnish_rightnow_adminbar( $admin_bar ){
		$admin_bar->add_menu( array(
			'id'	=> 'purge-varnish-cache-all',
			'title' => __( 'Empty Cache', 'varnish-http-purge' ),
			'href'  => wp_nonce_url( add_query_arg('vhp_flush_all', 1), 'vhp-flush-all'),
			'meta'  => array(
				'title' => __( 'Empty Cache', 'varnish-http-purge' ),
			),
		));
	}

	public function varnish_rightnow() {
		global $blog_id;
		$url = wp_nonce_url( add_query_arg( 'vhp_flush_all', 1 ), 'vhp-flush-all' );
		$intro = sprintf( __( '<a href="%1$s">Varnish HTTP Purge</a> automatically deletes your cached posts when published or updated. When making major site changes, such as with a new theme, plugins, or widgets, you may need to manually empty the cache.', 'varnish-http-purge' ), 'http://wordpress.org/plugins/varnish-http-purge/' );
		$button =  __( 'Press the button below to force it to empty your entire Varnish cache.', 'varnish-http-purge' );
		$button .= '</p><p><span class="button"><a href="'.$url.'"><strong>';
		$button .= __( 'Empty Cache', 'varnish-http-purge' );
		$button .= '</strong></a></span>';
		$nobutton =  __( 'You do not have permission to empty the Varnish cache for the whole site. Please contact your administrator.', 'varnish-http-purge' );

		if (
			// SingleSite - admins can always purge
			( !is_multisite() && current_user_can( 'activate_plugins' ) ) ||
			// Multisite - Network Admin can always purge
			current_user_can( 'manage_network' ) ||
			// Multisite - Site admins can purge UNLESS it's a subfolder install and we're on site #1
			( is_multisite() && current_user_can( 'activate_plugins' ) && ( SUBDOMAIN_INSTALL || ( !SUBDOMAIN_INSTALL && ( BLOG_ID_CURRENT_SITE != $blog_id ) ) ) )
		) {
			$text = $intro.' '.$button;
		} else {
			$text = $intro.' '.$nobutton;
		}
		echo "<p class='varnish-rightnow'>$text</p>\n";
	}

	/**
	 * The Home URL
	 * Get the Home URL and allow it to be filterable
	 * This is for domain mapping plugins that, for some reason, don't filter
	 * on their own (including WPMU, Ron's, and so on).
	 */
	public function the_home_url(){
		$home_url = apply_filters( 'vhp_home_url', home_url() );
		return $home_url;
	}

    public function purge_cache_from_mwp_manager() {
        $headers = array(
            'Content-Type'   => 'application/json',
            'Authorization'  => 'Token ' . LWMWP_API_TOKEN,
        );
        wp_remote_request( LWMWP_SITE_ENDPOINT . 'caches/', array(
            'method'   => 'DELETE',
            'blocking' => false,
            'headers'  => $headers,
        ) );
    }
}

LW_Varnish_Cache_Purger::get_instance()->add_hooks();

// register wp-cli package(s)
if ( defined( 'WP_CLI' ) && WP_CLI ) {
  require_once $this->pluginPath . 'wp-cli-packages/varnish_purge_command.php';
}
