<?php

class WPPM_Tasks_Frontend{

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
			self::$instance = new WPPM_Tasks_Frontend();
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
		add_shortcode( 'wppm_tasks', array( $this, 'tasks' ) );
	} // init

	public function tasks(){

		$html = '';

			$id = get_the_ID();

			echo $id;

			// get any tasks related to the current post_id

		return $html;

	}

}

WPPM_Tasks_Frontend::instance();
