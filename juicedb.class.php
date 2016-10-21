<?php

/**
 * A class for interfacing with the JuiceDB API
 *
 * @category Class
 * @package JuiceDB
 * @author Ændrew Rininsland <aendrew>
 */

require 'vendor/autoload.php';
use linclark\MicrodataPHP\MicrodataPhp;

class JuiceDB {
	/**
	 * Endpoint base URL
	 *
	 * @var [string]
	 */
	protected $api_url (string) ;

	/**
	 * JuiceDB API key
	 *
	 * @var [string]
	 */
	protected $api_key (string) ;

	/**
	 * Constructor
	 *
	 * @param [string] $api_key JuiceDB API token.
	 */
	public function __construct( $api_key ) {
		$this->api_key = $api_key;
		$this->api_url = 'https://api.juicedb.com';
		add_shortcode( 'juicedb', array( $this, 'shortcode' ) );
	}

	/**
	 * Parses shortcodes and returns embedded widget
	 *
	 * @param  [WP_Shortcode_Atts] $atts WP Shortcode API attributes.
	 * @return [string] Markup for attribute.
	 */
	public function shortcode( $atts ) {
		$queries (array) ;

		switch ( array_keys( $atts ) ) {
			case 'juice':
				array_push( $queries, $this->get_juice( $atts['juice'] ) );
			case 'company':
				array_push( $queries, $this->get_company( $atts['company'] ) );
			case 'user':
				array_push( $queries, $this->get_user( $atts['user'] ) );
			case 'review':
				array_push( $queries, $this->get_review( $atts['review'] ) );
			break;
		}

		return '';
	}

	public function get_juice( id ) {
		$endpoint = "{$api_url}/juice/${id}";
	}

	public function get_company( id ) {
		$endpoint = "{$api_url}/business/${id}";
	}

	public function get_user( username ) {
		$endpoint = "{$api_url}/user/${username}";
	}

	public function get_review( id ) {
		$endpoint = "{$api_url}/review/${id}";
	}
}
