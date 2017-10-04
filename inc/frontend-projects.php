<?php

class WPP_Front_Projects{

	private static $instance;

	/**
	 * Spins up the instance of the plugin so that we don't get many instances running at once
	 *
	 * @since 1.0
	 * @author SFNdesign, Curtis McHale
	 *
	 * @uses $instance->init()                      The main get it running function
	 */
	public static function instance(){

		if ( ! self::$instance ){
			self::$instance = new WPP_Front_Projects();
			self::$instance->init();
		}

	} // instance

	/**
	 * Spins up all the actions/filters in the plugin to really get the engine running
	 *
	 * @since 1.0
	 * @author SFNdesign, Curtis McHale
	 */
	public function init(){

		add_shortcode( 'wppm', array( $this, 'wppm' ) );

	} // init

	public function wppm(){

		$html = '';

			$html .= 'return all projects';
			// get projects you have access to
				// if no projects and 'client' then give option to contact site admin somehow
				// if no projcets and 'admin' give option to add a project

		return $html;

	}

}

WPP_Front_Projects::instance();
