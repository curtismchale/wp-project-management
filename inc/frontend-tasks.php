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

			$project = get_the_ID();
			$tasks = wppm_get_task_ids_for_project( absint( $project ) );

			if ( isset( $tasks ) && ! empty( $tasks ) ){
				$html .= self::display_tasks( $tasks );
			}

			$html .= self::new_task_form( absint( $project ) );

		echo $html;

	}

	public static function new_task_form( $project_id ){

		$html = '';

		$html .= '<p>new task button</p>';

		return $html;

	}

	private static function display_tasks( $tasks ){

		$html = '';

		$html .= 'show my tasks';

		return $html;


	}

}

WPPM_Tasks_Frontend::instance();
