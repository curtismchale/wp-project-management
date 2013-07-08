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

		if ( ! current_user_can( 'read_contact' ) ) return '<p class="error">You do not have permission to view this content</p>';

		$users = new WP_Proj_User_Query();

		$html = '<section id="wpproj-users">';

			$html .= wpproj_get_add_contact_button();

			$html .= '<table id="show-contacts">';

			$html .= '<tr>';
				$html .= '<th>Type</th>';
				$html .= '<th>Name</th>';
				$html .= '<th>Position</th>';
				$html .= '<th>Main Phone</th>';
				$html .= '<th>Email</th>';
			$html .= '</tr>';

			if ( $users->have_posts() ) : while ( $users->have_posts() ) : $users->the_post();

				$html .= '<tr>';
					$html .= '<td>icon for type</td>';
					$html .= '<td>'. get_the_title() .'</td>';

					$position = get_the_terms( get_the_ID(), 'wpproj_position' );

					if ( isset( $position ) && ! is_wp_error( $position ) && ! empty( $position ) ){
						$term = wp_list_pluck( $position, 'name' );
						$key = key( $term );
					} else {
						$term = '&nbsp;';
					}

					$html .= '<td>'. $term[$key] .'</td>';

					$phone = get_post_meta( get_the_ID(), 'contact-phone-primary', true );
					$phone = ! empty( $phone ) ? esc_attr( $phone ) : '&nbsp';

					$html .= '<td>'. $phone .'</td>';

					$email = get_post_meta( get_the_ID(), 'contact-email', true );
					$email = ! empty( $email ) ? '<a href="mailto:'. esc_attr( $email ) .'">'. esc_attr( $email ) .'</a>' : '&nbsp';

					$html .= '<td>'. $email .'</td>';
				$html .= '</tr>';

			endwhile; else:

				$html .= 'Sorry there are no users matching that query';

			endif;

			$html .= '</table><!-- /#show-contacts -->';

		$html .= '</section><!-- /#wpproj-users -->';

		wp_reset_postdata();

		return $html;

	} // show_clients

} // WPProj_Shortcodes

new WPProj_Shortcodes();