<?php

class WPPM_CPTS {

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
			self::$instance = new WPPM_CPTS();
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
		add_action( 'init', array( $this, 'add_projects_cpt' ) );
	} // init

	/**
	 * Builds out the custom post types for the site
	 *
	 * @uses    register_post_type
	 *
	 * @since   1.0
	 * @author  SFNdesign, Curtis McHale
	 */
	public function add_projects_cpt(){

		register_post_type( 'wppm_project', // http://codex.wordpress.org/Function_Reference/register_post_type
			array(
				'labels'                => array(
					'name'                  => __('Projects'),
					'singular_name'         => __('Project'),
					'add_new'               => __('Add New'),
					'add_new_item'          => __('Add New Project'),
					'edit'                  => __('Edit'),
					'edit_item'             => __('Edit Project'),
					'new_item'              => __('New Project'),
					'view'                  => __('View Projects'),
					'view_item'             => __('View Project'),
					'search_items'          => __('Search Projects'),
					'not_found'             => __('No Projects Found'),
					'not_found_in_trash'    => __('No Projects found in Trash')
				), // end array for labels
				'public'                => true,
				'menu_position'         => 5, // sets admin menu position
				'menu_icon'             => 'dashicons-portfolio',
				'hierarchical'          => false, // funcions like posts
				'supports'              => array('title', 'editor', 'revisions', 'excerpt', 'thumbnail'),
				'rewrite'               => array('slug' => 'projects', 'with_front' => true,), // permalinks format
				'can_export'            => true,
			)
		);

	}

}

WPPM_CPTS::instance();
