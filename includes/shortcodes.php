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
	 * @uses WP_Prok_Contacts->show_contact_table       Returns us the contact table
	 * @uses current_user_can()                         Checks if the current user has the specified permissions
	 */
	public function show_users(){

		if ( ! current_user_can( 'read_contact' ) ) return '<p class="error">You do not have permission to view this content</p>';

		$contact = new WP_Proj_Contacts();

		$html = $contact->show_contact_table();

		return $html;

	} // show_clients

} // WPProj_Shortcodes

new WPProj_Shortcodes();