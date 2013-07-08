<?php
/*
Plugin Name: WP Project Management
Plugin URI: http://wp-project-management.com
Description: Project management, run on WordPress
Version: 0.1
Author: SFNdesign, Curtis McHale
Author URI: http://sfndesign.ca
License: GPLv2 or later
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

class WP_Proj{

	function __construct(){

		// Register hooks that are fired when the plugin is activated, deactivated, and uninstalled, respectively.
		register_activation_hook( __FILE__, array( $this, 'activate' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );
		register_uninstall_hook( __FILE__, array( __CLASS__, 'uninstall' ) );

		$this->constants();
		$this->includes();

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );

	} // construct

	/**
	 * Enqueues scripts and styles the WordPress way
	 *
	 * @since 0.1
	 * @author SFNdesign, Curtis McHale
	 * @access public
	 *
	 * @uses wp_enqueue_script()        Registers and calls script
	 * @uses wp_localize_script()       Localizing our script so I have ajax in it
	 * @uses wp_enqueue_style()         Registers and calls our frontend styles the WordPress way
	 */
	public function enqueue(){

		wp_enqueue_script( 'wpproj-frontend-js', plugins_url( '/wp-project-management/js/frontend-scripts.min.js' ), array( 'jquery', 'jquery-form' ), '0.1', true );
		wp_localize_script(
			'wpproj-frontend-js',
			'WPPROJ',
			array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'formsubmitnonce' => wp_create_nonce( 'ajax-form-submit-nonce' )
			)
		);

		wp_enqueue_style( 'wpproj-frontend-styles', plugins_url( '/wp-project-management/css/frontend-styles.css' ), '', '0.1', 'all' );

	} // enqueue

	/**
	 * Includes any files we need for our plugin
	 *
	 * @since 0.1
	 * @author  SFNdesign, Curtis McHale
	 * @access private
	 */
	private function includes(){

		// Classes
		include( WP_PROJ_FOLDER . '/class/class.WP_Proj_Contacts.php' );
		include( WP_PROJ_FOLDER . '/class/class.Queries.php' );

		// P2P
		include( WP_PROJ_FOLDER . '/lib/p2p/posts-to-posts.php' );

		// misc
		include( WP_PROJ_FOLDER . '/includes/shortcodes.php' );
		include( WP_PROJ_FOLDER . '/includes/template-tags.php' );

	} // includes

	/**
	 * Defines any constants we need for the site
	 *
	 * @since 0.1
	 * @author SFNdesign, Curtis McHale
	 * @access public
	 */
	public function constants(){
		define( 'WP_PROJ_FOLDER', dirname( __FILE__ ) );
	} // constants

	/**
	 * Fired when plugin is activated
	 *
	 * @param   bool    $network_wide   TRUE if WPMU 'super admin' uses Network Activate option
	 */
	public function activate( $network_wide ){

		add_role( 'wp_proj_client', 'Client' );

		// setting new caps for admins
		$role = get_role( 'administrator' );

		$role->add_cap( 'create_contact' );
		$role->add_cap( 'read_contact' );
		$role->add_cap( 'update_contact' );
		$role->add_cap( 'delete_contact' );

		$role->add_cap( 'create_projects' );
		$role->add_cap( 'read_projects' );
		$role->add_cap( 'update_projects' );
		$role->add_cap( 'delete_projects' );

		$role->add_cap( 'create_tasks' );
		$role->add_cap( 'read_tasks' );
		$role->add_cap( 'update_tasks' );
		$role->add_cap( 'delete_tasks' );

		// @todo I don't think this will actually work on activate because the taxonomy doesn't exist yet
		//      - probably need to convert this to a single schedule cron event and put any population stuff on that event
		$contacts = new WP_Proj_Contacts();
		$contacts->populate_positions();

	} // activate

	/**
	 * Fired when plugin is deactivated
	 *
	 * @param   bool    $network_wide   TRUE if WPMU 'super admin' uses Network Activate option
	 */
	public function deactivate( $network_wide ){

		// removing new caps for admins
		$role = get_role( 'administrator' );

		$role->remove_cap( 'create_contact' );
		$role->remove_cap( 'read_contact' );
		$role->remove_cap( 'update_contact' );
		$role->remove_cap( 'delete_contact' );

		$role->remove_cap( 'create_projects' );
		$role->remove_cap( 'read_projects' );
		$role->remove_cap( 'update_projects' );
		$role->remove_cap( 'delete_projects' );

		$role->remove_cap( 'create_tasks' );
		$role->remove_cap( 'read_tasks' );
		$role->remove_cap( 'update_tasks' );
		$role->remove_cap( 'delete_tasks' );

	} // deactivate

	/**
	 * Fired when plugin is uninstalled
	 *
	 * @param   bool    $network_wide   TRUE if WPMU 'super admin' uses Network Activate option
	 */
	public function uninstall( $network_wide ){

	} // uninstall

} // WP_Proj

$GLOBALS['wp_proj'] = new WP_Proj();