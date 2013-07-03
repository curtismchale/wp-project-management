<?php

class WP_Proj_Contacts{

	function __construct(){

		add_action( 'init', array( $this, 'user_cpt' ) );
		add_action( 'init', array( $this, 'company_cpt' ) );

		add_action( 'admin_menu', array( $this, 'add_contact_menu' ) );

		add_action( 'p2p_init', array( $this, 'set_contact_connections' ) );

		/** AJAX **/
		add_action( 'wp_ajax_get_add_contact_form', array( $this, 'get_add_contact_form' ) );
		add_action( 'wp_ajax_nopriv_get_add_contact_form', array( $this, 'get_add_contact_form' ) );

	} // __construct

	/**
	 * Builds out our create contact form
	 *
	 * @since 0.1
	 * @auther SFNdesign, Curtis McHale
	 * @access public
	 *
	 * @return array
	 *
	 * @uses current_user_can()         Checks cap listed against current user
	 * @uses wp_nonce_field()           Generates a nonce field that we can check later
	 */
	public function get_add_contact_form(){

		if ( current_user_can( 'create_contact' ) ){

			$html = '<form id="create-contact">';

				$html .= '<h4>Add Contact</h4>';

				ob_start();
				do_action( 'wpproj_top_contact_field' );
				$html .= ob_get_contents();
				ob_clean();

				$html .= '<label for="contact-first-name">First Name</label>';
				$html .= '<input type="text" name="contact-first-name" id="contact-first-name" value="" />';

				$html .= '<label for="contact-last-name">Last Name</label>';
				$html .= '<input type="text" name="contact-last-name" id="contact-last-name" value="" />';

				$html .= '<label for="contact-position">Position</label>';
				$html .= '<input type="text" name="contact-position" id="contact-position" value="" />';

				$html .= '<label for="contact-email">Email</label>';
				$html .= '<input type="text" name="contact-email" id="contact-email" value="" />';

				$html .= '<label for="contact-phone-primary">Primary Phone</label>';
				$html .= '<input type="text" name="contact-phone-primary" id="contact-phone-primary" value="" />';

				$html .= '<label for="contact-phone-primary-ext">Primary Phone Extension</label>';
				$html .= '<input type="text" name="contact-phone-primary-ext" id="contact-phone-primary-ext" value="" />';

				$html .= '<label for="contact-mobile">Mobile</label>';
				$html .= '<input type="text" name="contact-mobile" id="contact-mobile" value="" />';

				$html .= '<label for="contact-fax">Fax</label>';
				$html .= '<input type="text" name="contact-fax" id="contact-fax" value="" />';

				$html .= '<h5>Address</h5>';

				$html .= '<label for="contact-street">Street</label>';
				$html .= '<input type="text" name="contact-street" id="contact-street" value="" />';
				$html .= '<input type="text" name="contact-street-second" id="contact-street-second" value="" />';

				$html .= '<label for="contact-city">City</label>';
				$html .= '<input type="text" name="contact-city" id="contact-city" value="" />';

				$html .= '<label for="contact-prov-state">Province/State</label>';
				$html .= '<input type="text" name="contact-prov-state" id="contact-prov-state" value="" />';

				$html .= '<label for="contact-prov-state">Province/State</label>';
				$html .= '<input type="text" name="contact-prov-state" id="contact-prov-state" value="" />';

				$html .= '<label for="contact-zip-postal">Zip/Postal Code</label>';
				$html .= '<input type="text" name="contact-zip-postal" id="contact-zip-postal" value="" />';

				$html .= '<label for="contact-country">Country</label>';
				$html .= $this->get_available_countries_dropdown();

				ob_start();
				do_action( 'wpproj_bottom_contact_field' );
				$html .= ob_get_contents();
				ob_clean();

				$html .= wp_nonce_field( 'create-contact', '_create_contact_nonce', '', false );
				$html .= '<input type="submit" id="create-new-contact" value="Create New Contact" />';

			$html .= '</form><!-- #create-contact -->';

			$ajax_response = array(
				'success'   => true,
				'value'     => $html,
			);

		} else {
			$ajax_response = array(
				'success'   => false,
				'value'     => '<p class="error">You do not have permission to add contacts</p>',
			);
		} // if ( current_user_can( 'create_contact' )

		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ){
			echo json_encode( $ajax_response );
			die;
		} else {
			return $ajax_response;
		}

	} // get_add_contact_form

	private function get_available_countries_dropdown(){

		$html = '<select name="contact-country" id="contact-country">';
			$html .= '<option>something</option>';
		$html .= '</select>';

		return $html;

	} // get_available_countries_dropdown

	/**
	 * Builds out the custom post types for the site
	 *
	 * @uses    register_post_type
	 *
	 * @since   0.1
	 * @author  SFNdesign, Curtis McHale
	 */
	public function user_cpt(){

		$labels = array(
			'name'                  => __('WP Proj Users'),
			'singular_name'         => __('WP Proj User'),
			'add_new'               => __('Add New'),
			'add_new_item'          => __('Add New WP Proj User'),
			'edit'                  => __('Edit'),
			'edit_item'             => __('Edit WP Proj User'),
			'new_item'              => __('New WP Proj User'),
			'view'                  => __('View WP Proj User'),
			'view_item'             => __('View WP Proj User'),
			'search_items'          => __('Search WP Proj Users'),
			'not_found'             => __('No WP Proj Users Found'),
			'not_found_in_trash'    => __('No WP Proj Users found in Trash')
		);

		$arguments = array(
			'labels'                => apply_filters( 'wpproj_register_user_cpt_labels', $labels ),
			'public'                => true,
			'show_in_menu'          => 'wpproj/contacts.php',
			'menu_position'         => 5, // sets admin menu position
			//'menu_icon'           => get_stylesheet_directory_uri().'/assets/images/show-post-icon.png',
			'hierarchical'          => false, // funcions like posts
			'supports'              => array('title', 'editor', 'revisions', 'excerpt', 'thumbnail'),
			'rewrite'               => array('slug' => 'clients', 'with_front' => true,), // permalinks format
			'can_export'            => true,
		);

		register_post_type(
			'wpproj_users',
			apply_filters( 'wpproj_register_user_cpt_args', $arguments )
		);

	} // user_cpt

		/**
	 * Builds out the custom post types for the site
	 *
	 * @uses    register_post_type
	 *
	 * @since   0.1
	 * @author  SFNdesign, Curtis McHale
	 */
	public function company_cpt(){

		$labels = array(
			'name'                  => __('WP Proj Company'),
			'singular_name'         => __('WP Proj Company'),
			'add_new'               => __('Add New'),
			'add_new_item'          => __('Add New WP Proj Company'),
			'edit'                  => __('Edit'),
			'edit_item'             => __('Edit WP Proj Company'),
			'new_item'              => __('New WP Proj Company'),
			'view'                  => __('View WP Proj Company'),
			'view_item'             => __('View WP Proj Company'),
			'search_items'          => __('Search WP Proj Companys'),
			'not_found'             => __('No WP Proj Companys Found'),
			'not_found_in_trash'    => __('No WP Proj Companys found in Trash')
		);

		$arguments = array(
			'labels'                => apply_filters( 'wpproj_register_comp_cpt_labels', $labels ),
			'public'                => true,
			'show_in_menu'          => 'wpproj/contacts.php',
			'menu_position'         => 5, // sets admin menu position
			//'menu_icon'           => get_stylesheet_directory_uri().'/assets/images/show-post-icon.png',
			'hierarchical'          => false, // funcions like posts
			'supports'              => array('title', 'editor', 'revisions', 'excerpt', 'thumbnail'),
			'rewrite'               => array('slug' => 'company', 'with_front' => true,), // permalinks format
			'can_export'            => true,
		);

		register_post_type(
			'wpproj_company',
			apply_filters( 'wpproj_register_comp_cpt_args', $arguments )
		);

	} // company_cpt

	/**
	 * Puts the contact admin menu in place
	 *
	 * @todo should really hide this later and make it available with a 'dev' constant
	 *
	 * @since 0.1
	 * @author SFNdesign, Curtis McHale
	 * @access public
	 *
	 * @uses add_menu_page()            Adds menu page given args
	 */
	public function add_contact_menu(){

		add_menu_page( 'Contact', 'WPProj Contacts', 'create_contact', 'wpproj/contacts.php', '', '', 100 );

	} // add_contact_menu

	/**
	 * Registering the connections needed in our contact class
	 *
	 * @since 0.1
	 * @auther SFNdesign, Curtis McHale
	 * @access public
	 *
	 * @uses p2p_register_connection_type()         Adds p2p connection given args
	 */
	public function set_contact_connections(){

		$connection_args = array(
			'name'      => 'wpproj_comp_to_wpproj_users',
			'from'      => 'wpproj_company',
			'to'        => 'wpproj_users',
		);

		p2p_register_connection_type( $connection_args );

		$connection_args = array(
			'name'      => 'wpproj_users_to_users',
			'from'      => 'wpproj_users',
			'to'        => 'user',
		);

		p2p_register_connection_type( $connection_args );

	} // set_contact_connections

} // WP_Proj_Users

new WP_Proj_Contacts();