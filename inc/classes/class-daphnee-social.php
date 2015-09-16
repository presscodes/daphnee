<?php

class Daphnee_Social {

	function __construct() {
		add_action( 'tha_header_bottom', array( $this, 'social_links_navigation_content' ), 10 );
	}

	public static function social_networks() {
		$social_networks = get_theme_mod( 'social_links', array() );
		return $social_networks;
	}

	/**
	 * Build the social links
	 */
	function social_links_builder( $before = '', $after = '', $separator = '' ) {

		$social_networks = self::social_networks();

		$content = $before;

		foreach ( $social_networks as $social_network ) { 

				if ( '' != esc_url( $social_network['link'] ) ) {
					$content .= '<li><a role="link" aria-labelledby="' . $social_network['label'] . '" href="' . $social_network['link'] . '" target="_blank" title="' . $social_network['label'] . '"><i class="socicon socicon-' . $social_network['label'] . '"></i>' . $social_network['label'] . '</a></li>';
					$content .= $separator;
			}
		}

		$content .= $after;

		return $content;

	}

	/**
	 * Social links in navbars
	 */
	function social_links_navigation_content() {

		$content = $before = $after = $separator = '';

		$before = '<ul class="navbar-inline-socials">';
		$after     = '</ul>';
		$separator = '';

		$content = $this->social_links_builder( $before, $after, $separator );

		echo $content;

	}

}
