<?php
/**
 * Abstracts the basic WP Proj Users Query
 *
 * @class   WP_Query
 * @uses    wp_parse_args
 *
 * @since   0.1
 * @author  SFNdesign, Curtis McHale
 */
class WP_Proj_User_Query extends WP_Query{

	function __construct( $args = array() ){

		$args = wp_parse_args( $args, array(
			'post_type'         => 'wpproj_users',
			'posts_per_page'    => -1,
		) );

		$args = apply_filters( 'wpproj_basic_users_query', $args );

		parent::__construct( $args );

	} // __construct

} // WP_Proj_User_Query