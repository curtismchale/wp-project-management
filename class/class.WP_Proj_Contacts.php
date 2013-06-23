<?php

class WP_Proj_Contacts{

	function __construct(){

		add_action( 'init', array( $this, 'user_cpt' ) );

	} // __construct

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

	} // new_cpt

} // WP_Proj_Users

new WP_Proj_Contacts();