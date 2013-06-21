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

	} // construct

	/**
	 * Includes any files we need for our plugin
	 *
	 * @since 0.1
	 * @author  SFNdesign, Curtis McHale
	 * @access private
	 */
	private function includes(){

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

	} // activate

	/**
	 * Fired when plugin is deactivated
	 *
	 * @param   bool    $network_wide   TRUE if WPMU 'super admin' uses Network Activate option
	 */
	public function deactivate( $network_wide ){

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