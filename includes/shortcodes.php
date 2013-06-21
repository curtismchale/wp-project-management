<?php

class WPProj_Shortcodes{

	function __construct(){

		add_shortcode( 'wpproj_users', array( $this, 'show_users' ) );

	} // __construct

	/**
	 * Builds us a listing of all users for WP Project Management
	 *
	 * @since 0.1
	 * @author SFNdesign, Curtis McHale
	 * @access public
	 *
	 * @return string   All the HTML we just built
	 *
	 * @uses WP_Proj_User_Query()           WP_Query tailored for plugin users
	 */
	public function show_users(){

		$users = new WP_Proj_User_Query();

		$html = '<section id="wpproj-users">';

			if ( $users->have_posts() ) : while ( $users->have_posts() ) : $users->the_post();

				$html .= get_the_title();

			endwhile; else:

				$html .= 'Sorry there are no users matching that query';

			endif;

		$html .= '</section><!-- /#wpproj-users -->';

		wp_reset_postdata();

		return $html;

	} // show_clients

} // WPProj_Shortcodes

new WPProj_Shortcodes();