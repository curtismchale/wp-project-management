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

	/**
	 * Returns the main dashboard for WPPM
	 *
	 * @since 0.1
	 * @author SFNdesign, Curtis McHale
	 */
	public function wppm(){

		$html = '';

			$projects = new WPPM_Projects();

			$html .= '<ul>';

			if ( $projects->have_posts() ) {
				while ( $projects->have_posts() ) {
					$projects->the_post();

						// @todo make sure you have access to this project to see it
						//      - if no projects and 'client' then give option to contact site admin somehow
						//      - if no projcets and 'admin' give option to add a project

						$html .= '<li><a href="'. get_the_permalink() .'">'. get_the_title() .'</a></li>';
				} // end while
			}

			$html .= '</ul>';

			wp_reset_postdata();


		return $html;

	}

}

WPP_Front_Projects::instance();
