<?php

/**
 * Returns the add contact button for use is shortcodes and the like
 *
 * @since 0.1
 * @author SFNdesign, Curtis McHale
 *
 * @param string    $text   optional    The text we want in the button
 *
 * @return string           Our built out button
 *
 * @uses esc_attr()         Makes our text safe
 */
function wpproj_get_add_contact_button( $text = 'Add Contact' ){

	$html = '<li class="tab"><a href="#" class="button" id="wpproj-add-new-contact">'. esc_attr( $text ) .'</a></li>';

	return $html;

} // wpproj_get_add_contact_button

/**
 * Returns the add company button for use is shortcodes and the like
 *
 * @since 0.1
 * @author SFNdesign, Curtis McHale
 *
 * @param string    $text   optional    The text we want in the button
 *
 * @return string           Our built out button
 *
 * @uses esc_attr()         Makes our text safe
 */
function wpproj_get_add_company_button( $text = 'Add Company' ){

	$html = '<li class="tab"><a href="#" class="button" id="wpproj-add-new-company">'. esc_attr( $text ) .'</a></li>';

	return $html;

} // wpproj_get_add_company_button

/**
 * Wraps the get contact button and just echos it
 *
 * @since 0.1
 * @author SFNdesign, Curtis McHale
 *
 * @param string $text  optional    The text we want on the button
 *
 * @uses wpproj_get_add_contact_button()        Retuns the HTML for the concat button
 */
function wpproj_show_add_contact_button( $text = 'Add Contact' ){
	echo wpproj_get_add_contact_button( $text );
} // wpproj_get_add_contact_button

/**
 * Gets us the phone no matter what CPT it's saved under
 *
 * @since 0.1
 * @author SFNdesign, Curtis McHale
 *
 * @param int   $post_id    required        The id of the post we are getting a phone for
 *
 * @return string|void      $phone          The phone number if it exists
 *
 * @uses get_post_type()                    Returns string name of the post type given
 * @uses get_post_meta()                    Returns meta given key and post_id
 * @uses esc_attr()                         Saftey safety
 */
function wpproj_get_phone( $post_id ){

	$post_id = (int) $post_id;

	if ( get_post_type( $post_id ) === 'wpproj_users' ){
		$phone = get_post_meta( $post_id, 'contact-phone-primary', true );
	} elseif ( get_post_type( $post_id ) === 'wpproj_company' ){
		$phone = get_post_meta( $post_id, 'company-phone-primary', true );
	} else {
		$phone = '';
	}
	return esc_attr( $phone );
} // wpproj_get_phone

/**
 * Returns class based on user type
 *
 * @since 0.1
 * @author SFNdesign, Curtis McHale
 *
 * @param int   $post_id    required    The post_id we are getting a class for
 *
 * @return string                       The class based on contact type
 *
 * @uses get_post_type()                Returns string based on the post type
 */
function wpproj_type_class( $post_id ){

	$post_id = isset( $post_id ) ? (int) $post_id : null;

	if ( get_post_type( $post_id ) === 'wpproj_users' ){
		$class = 'user';
	} elseif ( get_post_type( $post_id ) === 'wpproj_company' ){
		$class = 'business';
	} else {
		$class = '';
	}

	return (string) $class;

} // wpproj_type_class

/**
 * Returns the name of the contact
 *
 * @param   int     $post_id    required    The post id we want meta for
 *
 * @return string|void      $name           The name
 *
 * @uses get_post_meta()                    Gets post meta given key and id
 * @uses esc_attr()                         Saftef first
 */
function wpproj_get_first_name( $post_id ){

	$name = get_post_meta( $post_id, 'contact-first-name', true );

	$name = isset( $name ) ? $name : '';

	return (string) $name;

} // wpproj_get_first_name

/**
 * Returns the last name of the contact
 *
 * @param   int     $post_id    required    The post id we want meta for
 *
 * @return string|void      $name           The name
 *
 * @uses get_post_meta()                    Gets post meta given key and id
 * @uses esc_attr()                         Saftef first
 */
function wpproj_get_last_name( $post_id ){

	$name = get_post_meta( $post_id, 'contact-last-name', true );

	$name = isset( $name ) ? $name : '';

	return esc_attr( $name );

} // wpproj_get_last_name

/**
 * Gets the term id for the user position
 *
 * @since 0.1
 * @author SFNdesign, Curtis McHale
 *
 * @param int   $post_id    required    The id of the post we are trying to get terms for
 *
 * @return int  term_id
 *
 * @uses wp_get_object_terms()          Gets the terms of the given tax
 */
function wpproj_get_position_id( $post_id ){

	$terms = wp_get_object_terms( $post_id, 'wpproj_position', array( 'fields' => 'ids' ) );

	return (int) $terms['0'];

} // wpproj_get_position_id

/**
 * Returns the id of the connected company
 *
 * @since 0.1
 * @author SFNdesign, Curtis McHale
 *
 * @param int   $post_id    required    The id of the post/contact
 *
 * @return  $id      Company id
 */
function wpproj_get_company_id( $post_id ){

	$post_object = get_post( $post_id );

	$related = p2p_type( 'wpproj_comp_to_wpproj_users' )->get_related( $post_object );

	$pid = wp_list_pluck( $related->posts, 'ID' );

	print_r( $pid );

} // wpproj_get_company_id

/**
 * Returns the link to the contact page
 *
 * @since 0.1
 * @author SFNdesign, Curtis McHale
 *
 * @uses get_page_by_title()        Returns the page object based on a matching title
 * @uses ge_permalink()             Returns the link to the object by given ID
 *
 * @return string
 */
function wppm_get_contact_page_link(){

	$page = get_page_by_title( 'Contacts' );

	$link = get_permalink( $page->ID );

	return $link;

} // wppm_get_contact_page_link
