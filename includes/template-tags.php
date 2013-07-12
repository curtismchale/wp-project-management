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

	$html = '<p><a href="#" class="button" id="wpproj-add-new-contact">'. esc_attr( $text ) .'</a></p>';

	return $html;

} // wpproj_get_add_contact_button

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