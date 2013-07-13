<?php

class WP_Proj_Contacts{

	public $countries;  // var array of countries

	function __construct(){

		add_action( 'init', array( $this, 'user_cpt' ) );
		add_action( 'init', array( $this, 'company_cpt' ) );
		add_action( 'init', array( $this, 'position_tax' ) );

		add_action( 'admin_menu', array( $this, 'add_contact_menu' ) );

		add_action( 'p2p_init', array( $this, 'set_contact_connections' ) );

		/** AJAX **/
		// contacts
		add_action( 'wp_ajax_get_add_contact_form', array( $this, 'get_add_contact_form' ) );
		add_action( 'wp_ajax_nopriv_get_add_contact_form', array( $this, 'get_add_contact_form' ) );

		add_action( 'wp_ajax_add_update_contact', array( $this, 'add_update_contact' ) );
		add_action( 'wp_ajax_nopriv_add_update_contact', array( $this, 'add_update_contact' ) );

		// companies
		add_action( 'wp_ajax_get_add_company_form', array( $this, 'get_add_company_form' ) );
		add_action( 'wp_ajax_nopriv_get_add_company_form', array( $this, 'get_add_company_form' ) );

		add_action( 'wp_ajax_add_update_company', array( $this, 'add_update_company' ) );
		add_action( 'wp_ajax_nopriv_add_update_company', array( $this, 'add_update_company' ) );

		$this->countries = apply_filters('wpproj_countries', array(
			'AF' => __( 'Afghanistan', 'wpproj' ),
			'AX' => __( '&#197;land Islands', 'wpproj' ),
			'AL' => __( 'Albania', 'wpproj' ),
			'DZ' => __( 'Algeria', 'wpproj' ),
			'AD' => __( 'Andorra', 'wpproj' ),
			'AO' => __( 'Angola', 'wpproj' ),
			'AI' => __( 'Anguilla', 'wpproj' ),
			'AQ' => __( 'Antarctica', 'wpproj' ),
			'AG' => __( 'Antigua and Barbuda', 'wpproj' ),
			'AR' => __( 'Argentina', 'wpproj' ),
			'AM' => __( 'Armenia', 'wpproj' ),
			'AW' => __( 'Aruba', 'wpproj' ),
			'AU' => __( 'Australia', 'wpproj' ),
			'AT' => __( 'Austria', 'wpproj' ),
			'AZ' => __( 'Azerbaijan', 'wpproj' ),
			'BS' => __( 'Bahamas', 'wpproj' ),
			'BH' => __( 'Bahrain', 'wpproj' ),
			'BD' => __( 'Bangladesh', 'wpproj' ),
			'BB' => __( 'Barbados', 'wpproj' ),
			'BY' => __( 'Belarus', 'wpproj' ),
			'BE' => __( 'Belgium', 'wpproj' ),
			'PW' => __( 'Belau', 'wpproj' ),
			'BZ' => __( 'Belize', 'wpproj' ),
			'BJ' => __( 'Benin', 'wpproj' ),
			'BM' => __( 'Bermuda', 'wpproj' ),
			'BT' => __( 'Bhutan', 'wpproj' ),
			'BO' => __( 'Bolivia', 'wpproj' ),
			'BQ' => __( 'Bonaire, Saint Eustatius and Saba', 'wpproj' ),
			'BA' => __( 'Bosnia and Herzegovina', 'wpproj' ),
			'BW' => __( 'Botswana', 'wpproj' ),
			'BV' => __( 'Bouvet Island', 'wpproj' ),
			'BR' => __( 'Brazil', 'wpproj' ),
			'IO' => __( 'British Indian Ocean Territory', 'wpproj' ),
			'VG' => __( 'British Virgin Islands', 'wpproj' ),
			'BN' => __( 'Brunei', 'wpproj' ),
			'BG' => __( 'Bulgaria', 'wpproj' ),
			'BF' => __( 'Burkina Faso', 'wpproj' ),
			'BI' => __( 'Burundi', 'wpproj' ),
			'KH' => __( 'Cambodia', 'wpproj' ),
			'CM' => __( 'Cameroon', 'wpproj' ),
			'CA' => __( 'Canada', 'wpproj' ),
			'CV' => __( 'Cape Verde', 'wpproj' ),
			'KY' => __( 'Cayman Islands', 'wpproj' ),
			'CF' => __( 'Central African Republic', 'wpproj' ),
			'TD' => __( 'Chad', 'wpproj' ),
			'CL' => __( 'Chile', 'wpproj' ),
			'CN' => __( 'China', 'wpproj' ),
			'CX' => __( 'Christmas Island', 'wpproj' ),
			'CC' => __( 'Cocos (Keeling) Islands', 'wpproj' ),
			'CO' => __( 'Colombia', 'wpproj' ),
			'KM' => __( 'Comoros', 'wpproj' ),
			'CG' => __( 'Congo (Brazzaville)', 'wpproj' ),
			'CD' => __( 'Congo (Kinshasa)', 'wpproj' ),
			'CK' => __( 'Cook Islands', 'wpproj' ),
			'CR' => __( 'Costa Rica', 'wpproj' ),
			'HR' => __( 'Croatia', 'wpproj' ),
			'CU' => __( 'Cuba', 'wpproj' ),
			'CW' => __( 'Cura&Ccedil;ao', 'wpproj' ),
			'CY' => __( 'Cyprus', 'wpproj' ),
			'CZ' => __( 'Czech Republic', 'wpproj' ),
			'DK' => __( 'Denmark', 'wpproj' ),
			'DJ' => __( 'Djibouti', 'wpproj' ),
			'DM' => __( 'Dominica', 'wpproj' ),
			'DO' => __( 'Dominican Republic', 'wpproj' ),
			'EC' => __( 'Ecuador', 'wpproj' ),
			'EG' => __( 'Egypt', 'wpproj' ),
			'SV' => __( 'El Salvador', 'wpproj' ),
			'GQ' => __( 'Equatorial Guinea', 'wpproj' ),
			'ER' => __( 'Eritrea', 'wpproj' ),
			'EE' => __( 'Estonia', 'wpproj' ),
			'ET' => __( 'Ethiopia', 'wpproj' ),
			'FK' => __( 'Falkland Islands', 'wpproj' ),
			'FO' => __( 'Faroe Islands', 'wpproj' ),
			'FJ' => __( 'Fiji', 'wpproj' ),
			'FI' => __( 'Finland', 'wpproj' ),
			'FR' => __( 'France', 'wpproj' ),
			'GF' => __( 'French Guiana', 'wpproj' ),
			'PF' => __( 'French Polynesia', 'wpproj' ),
			'TF' => __( 'French Southern Territories', 'wpproj' ),
			'GA' => __( 'Gabon', 'wpproj' ),
			'GM' => __( 'Gambia', 'wpproj' ),
			'GE' => __( 'Georgia', 'wpproj' ),
			'DE' => __( 'Germany', 'wpproj' ),
			'GH' => __( 'Ghana', 'wpproj' ),
			'GI' => __( 'Gibraltar', 'wpproj' ),
			'GR' => __( 'Greece', 'wpproj' ),
			'GL' => __( 'Greenland', 'wpproj' ),
			'GD' => __( 'Grenada', 'wpproj' ),
			'GP' => __( 'Guadeloupe', 'wpproj' ),
			'GT' => __( 'Guatemala', 'wpproj' ),
			'GG' => __( 'Guernsey', 'wpproj' ),
			'GN' => __( 'Guinea', 'wpproj' ),
			'GW' => __( 'Guinea-Bissau', 'wpproj' ),
			'GY' => __( 'Guyana', 'wpproj' ),
			'HT' => __( 'Haiti', 'wpproj' ),
			'HM' => __( 'Heard Island and McDonald Islands', 'wpproj' ),
			'HN' => __( 'Honduras', 'wpproj' ),
			'HK' => __( 'Hong Kong', 'wpproj' ),
			'HU' => __( 'Hungary', 'wpproj' ),
			'IS' => __( 'Iceland', 'wpproj' ),
			'IN' => __( 'India', 'wpproj' ),
			'ID' => __( 'Indonesia', 'wpproj' ),
			'IR' => __( 'Iran', 'wpproj' ),
			'IQ' => __( 'Iraq', 'wpproj' ),
			'IE' => __( 'Republic of Ireland', 'wpproj' ),
			'IM' => __( 'Isle of Man', 'wpproj' ),
			'IL' => __( 'Israel', 'wpproj' ),
			'IT' => __( 'Italy', 'wpproj' ),
			'CI' => __( 'Ivory Coast', 'wpproj' ),
			'JM' => __( 'Jamaica', 'wpproj' ),
			'JP' => __( 'Japan', 'wpproj' ),
			'JE' => __( 'Jersey', 'wpproj' ),
			'JO' => __( 'Jordan', 'wpproj' ),
			'KZ' => __( 'Kazakhstan', 'wpproj' ),
			'KE' => __( 'Kenya', 'wpproj' ),
			'KI' => __( 'Kiribati', 'wpproj' ),
			'KW' => __( 'Kuwait', 'wpproj' ),
			'KG' => __( 'Kyrgyzstan', 'wpproj' ),
			'LA' => __( 'Laos', 'wpproj' ),
			'LV' => __( 'Latvia', 'wpproj' ),
			'LB' => __( 'Lebanon', 'wpproj' ),
			'LS' => __( 'Lesotho', 'wpproj' ),
			'LR' => __( 'Liberia', 'wpproj' ),
			'LY' => __( 'Libya', 'wpproj' ),
			'LI' => __( 'Liechtenstein', 'wpproj' ),
			'LT' => __( 'Lithuania', 'wpproj' ),
			'LU' => __( 'Luxembourg', 'wpproj' ),
			'MO' => __( 'Macao S.A.R., China', 'wpproj' ),
			'MK' => __( 'Macedonia', 'wpproj' ),
			'MG' => __( 'Madagascar', 'wpproj' ),
			'MW' => __( 'Malawi', 'wpproj' ),
			'MY' => __( 'Malaysia', 'wpproj' ),
			'MV' => __( 'Maldives', 'wpproj' ),
			'ML' => __( 'Mali', 'wpproj' ),
			'MT' => __( 'Malta', 'wpproj' ),
			'MH' => __( 'Marshall Islands', 'wpproj' ),
			'MQ' => __( 'Martinique', 'wpproj' ),
			'MR' => __( 'Mauritania', 'wpproj' ),
			'MU' => __( 'Mauritius', 'wpproj' ),
			'YT' => __( 'Mayotte', 'wpproj' ),
			'MX' => __( 'Mexico', 'wpproj' ),
			'FM' => __( 'Micronesia', 'wpproj' ),
			'MD' => __( 'Moldova', 'wpproj' ),
			'MC' => __( 'Monaco', 'wpproj' ),
			'MN' => __( 'Mongolia', 'wpproj' ),
			'ME' => __( 'Montenegro', 'wpproj' ),
			'MS' => __( 'Montserrat', 'wpproj' ),
			'MA' => __( 'Morocco', 'wpproj' ),
			'MZ' => __( 'Mozambique', 'wpproj' ),
			'MM' => __( 'Myanmar', 'wpproj' ),
			'NA' => __( 'Namibia', 'wpproj' ),
			'NR' => __( 'Nauru', 'wpproj' ),
			'NP' => __( 'Nepal', 'wpproj' ),
			'NL' => __( 'Netherlands', 'wpproj' ),
			'AN' => __( 'Netherlands Antilles', 'wpproj' ),
			'NC' => __( 'New Caledonia', 'wpproj' ),
			'NZ' => __( 'New Zealand', 'wpproj' ),
			'NI' => __( 'Nicaragua', 'wpproj' ),
			'NE' => __( 'Niger', 'wpproj' ),
			'NG' => __( 'Nigeria', 'wpproj' ),
			'NU' => __( 'Niue', 'wpproj' ),
			'NF' => __( 'Norfolk Island', 'wpproj' ),
			'KP' => __( 'North Korea', 'wpproj' ),
			'NO' => __( 'Norway', 'wpproj' ),
			'OM' => __( 'Oman', 'wpproj' ),
			'PK' => __( 'Pakistan', 'wpproj' ),
			'PS' => __( 'Palestinian Territory', 'wpproj' ),
			'PA' => __( 'Panama', 'wpproj' ),
			'PG' => __( 'Papua New Guinea', 'wpproj' ),
			'PY' => __( 'Paraguay', 'wpproj' ),
			'PE' => __( 'Peru', 'wpproj' ),
			'PH' => __( 'Philippines', 'wpproj' ),
			'PN' => __( 'Pitcairn', 'wpproj' ),
			'PL' => __( 'Poland', 'wpproj' ),
			'PT' => __( 'Portugal', 'wpproj' ),
			'QA' => __( 'Qatar', 'wpproj' ),
			'RE' => __( 'Reunion', 'wpproj' ),
			'RO' => __( 'Romania', 'wpproj' ),
			'RU' => __( 'Russia', 'wpproj' ),
			'RW' => __( 'Rwanda', 'wpproj' ),
			'BL' => __( 'Saint Barth&eacute;lemy', 'wpproj' ),
			'SH' => __( 'Saint Helena', 'wpproj' ),
			'KN' => __( 'Saint Kitts and Nevis', 'wpproj' ),
			'LC' => __( 'Saint Lucia', 'wpproj' ),
			'MF' => __( 'Saint Martin (French part)', 'wpproj' ),
			'SX' => __( 'Saint Martin (Dutch part)', 'wpproj' ),
			'PM' => __( 'Saint Pierre and Miquelon', 'wpproj' ),
			'VC' => __( 'Saint Vincent and the Grenadines', 'wpproj' ),
			'SM' => __( 'San Marino', 'wpproj' ),
			'ST' => __( 'S&atilde;o Tom&eacute; and Pr&iacute;ncipe', 'wpproj' ),
			'SA' => __( 'Saudi Arabia', 'wpproj' ),
			'SN' => __( 'Senegal', 'wpproj' ),
			'RS' => __( 'Serbia', 'wpproj' ),
			'SC' => __( 'Seychelles', 'wpproj' ),
			'SL' => __( 'Sierra Leone', 'wpproj' ),
			'SG' => __( 'Singapore', 'wpproj' ),
			'SK' => __( 'Slovakia', 'wpproj' ),
			'SI' => __( 'Slovenia', 'wpproj' ),
			'SB' => __( 'Solomon Islands', 'wpproj' ),
			'SO' => __( 'Somalia', 'wpproj' ),
			'ZA' => __( 'South Africa', 'wpproj' ),
			'GS' => __( 'South Georgia/Sandwich Islands', 'wpproj' ),
			'KR' => __( 'South Korea', 'wpproj' ),
			'SS' => __( 'South Sudan', 'wpproj' ),
			'ES' => __( 'Spain', 'wpproj' ),
			'LK' => __( 'Sri Lanka', 'wpproj' ),
			'SD' => __( 'Sudan', 'wpproj' ),
			'SR' => __( 'Suriname', 'wpproj' ),
			'SJ' => __( 'Svalbard and Jan Mayen', 'wpproj' ),
			'SZ' => __( 'Swaziland', 'wpproj' ),
			'SE' => __( 'Sweden', 'wpproj' ),
			'CH' => __( 'Switzerland', 'wpproj' ),
			'SY' => __( 'Syria', 'wpproj' ),
			'TW' => __( 'Taiwan', 'wpproj' ),
			'TJ' => __( 'Tajikistan', 'wpproj' ),
			'TZ' => __( 'Tanzania', 'wpproj' ),
			'TH' => __( 'Thailand', 'wpproj' ),
			'TL' => __( 'Timor-Leste', 'wpproj' ),
			'TG' => __( 'Togo', 'wpproj' ),
			'TK' => __( 'Tokelau', 'wpproj' ),
			'TO' => __( 'Tonga', 'wpproj' ),
			'TT' => __( 'Trinidad and Tobago', 'wpproj' ),
			'TN' => __( 'Tunisia', 'wpproj' ),
			'TR' => __( 'Turkey', 'wpproj' ),
			'TM' => __( 'Turkmenistan', 'wpproj' ),
			'TC' => __( 'Turks and Caicos Islands', 'wpproj' ),
			'TV' => __( 'Tuvalu', 'wpproj' ),
			'UG' => __( 'Uganda', 'wpproj' ),
			'UA' => __( 'Ukraine', 'wpproj' ),
			'AE' => __( 'United Arab Emirates', 'wpproj' ),
			'GB' => __( 'United Kingdom', 'wpproj' ),
			'US' => __( 'United States', 'wpproj' ),
			'UY' => __( 'Uruguay', 'wpproj' ),
			'UZ' => __( 'Uzbekistan', 'wpproj' ),
			'VU' => __( 'Vanuatu', 'wpproj' ),
			'VA' => __( 'Vatican', 'wpproj' ),
			'VE' => __( 'Venezuela', 'wpproj' ),
			'VN' => __( 'Vietnam', 'wpproj' ),
			'WF' => __( 'Wallis and Futuna', 'wpproj' ),
			'EH' => __( 'Western Sahara', 'wpproj' ),
			'WS' => __( 'Western Samoa', 'wpproj' ),
			'YE' => __( 'Yemen', 'wpproj' ),
			'ZM' => __( 'Zambia', 'wpproj' ),
			'ZW' => __( 'Zimbabwe', 'wpproj' )
		));

	} // __construct

	/**
	 * Builds the headers for the contact table and calls the single row item
	 *
	 * @since 0.1
	 * @author SFNdesign, Curtis McHale
	 * @access public
	 *
	 * @return string       Our built table
	 *
	 * @uses WP_Proj_Contact_Query()                Wrapper for WP_Query that has defaults for our contact CPTs
	 * @uses wpproj_get_add_contact_button()        Gets the button that allows you to add contacts
	 * @uses $this->get_single_table_row()          Gets a single row for our table
	 * @uses get_the_ID()                           Returns the post_id inside a loop
	 * @uses wp_reset_postdata()                    Makes sure we clean up our globals after ourselves
	 */
	public function show_contact_table(){

			$users = new WP_Proj_Contact_Query();

			$html = '<section id="wpproj-users">';

			$html .= '<ul class="tab-wrapper">';
				$html .= wpproj_get_add_contact_button();
				$html .= wpproj_get_add_company_button();
			$html .= '</ul><!-- /.tab-wrapper -->';

			$html .= '<table id="show-contacts">';

			$html .= '<tr>';
				$html .= '<th>Type</th>';
				$html .= '<th>Name</th>';
				$html .= '<th>Position</th>';
				$html .= '<th>Main Phone</th>';
				$html .= '<th>Email</th>';
			$html .= '</tr>';

			if ( $users->have_posts() ) : while ( $users->have_posts() ) : $users->the_post();

				$html .= $this->get_single_table_row( get_the_ID() );

			endwhile; else:

				$html .= '<tr class="no-query"><td colspan=5>Sorry there are no users matching that query</td></tr>';

			endif;

			$html .= '</table><!-- /#show-contacts -->';

		$html .= '</section><!-- /#wpproj-users -->';

		wp_reset_postdata();

		return $html;

	} // show_contact_table

	/**
	 * Gets a single table row for the contacts
	 *
	 * @since 0.1
	 * @author SFNdesign, Curtis McHale
	 * @access private
	 *
	 * @param   int     $post_id    required        The post_id we are getting information for
	 *
	 * @return string               Our assembled HTML for the table row
	 *
	 * @uses get_the_title()        Returns the title
	 * @uses get_the_terms()        Gets the array of terms
	 * @uses wp_list_pluck          Preforms wizardry on arrays to pluck like keys out
	 * @uses wpproj_get_phone()     Gets phone from company or from users CPTs
	 * @uses esc_attr()             Keeps things safe
	 */
	private function get_single_table_row( $post_id ){

		$html = '<tr>';
			// @todo get that icon based on the type of contact
			$html .= '<td><p class="genericon '. wpproj_type_class( $post_id ) .'"></p></td>';
			$html .= '<td>'. get_the_title( $post_id ) .'</td>';

			$position = get_the_terms( $post_id, 'wpproj_position' );

			if ( isset( $position ) && ! is_wp_error( $position ) && ! empty( $position ) ){
				$term = wp_list_pluck( $position, 'name' );
				$key = key( $term );
			} else {
				$term = '&nbsp;';
			}

			// @todo this is a terrible var name
			$final_term = isset( $key ) ? $term[$key] : '';

			$html .= '<td>'. $final_term .'</td>';

			$html .= '<td>'. wpproj_get_phone( $post_id ) .'</td>';

			$email = get_post_meta( $post_id, 'contact-email', true );
			$email = ! empty( $email ) ? '<a href="mailto:'. esc_attr( $email ) .'">'. esc_attr( $email ) .'</a>' : '&nbsp';

			$html .= '<td>'. $email .'</td>';
		$html .= '</tr>';

		return $html;

	} // get_single_table_row

	/**
	 * Saves or updates our companies
	 *
	 * @since 0.1
	 * @author SFNdesign, Curtis McHale
	 * @access public
	 *
	 * @uses wp_verify_nonce()          Helps us make sure that we are safe
	 * @uses wp_get_current_user()      Gets WP User object for the current user
	 * @uses esc_attr()                 Keeping our data safe
	 * @uses wp_kses_post()             Sanitize like post_content
	 * @uses wp_insert_post()           Creates/updates a post based on provided args
	 * @uses update_post_meta()         Updates the meta on a post
	 * @uses wp_send_json_sucess()      Returns a success=true json object to our AJAX call and does all our die stuff
	 * @uses wp_send_json_error()       Returns a success=false json object to our AJAX call and does all our die stuff
	 */
	public function add_update_company(){

		$is_error = array();

		if ( isset( $_POST['_nonce'] ) && wp_verify_nonce( $_POST['_nonce'], 'ajax-form-submit-nonce' ) && current_user_can( 'create_contact' ) || current_user_can( 'update_contact' ) ){

			$current_user = wp_get_current_user();

			// setting our post title
			$post_title = $_POST['company-name'];

			$post_id = isset( $_POST['post_id'] ) ? $_POST['post_id'] : null;

			$post_content = isset( $_POST['company_comments'] ) ? $_POST['contact_comments'] : '';

			$author = $current_user->ID;

			$post_args = array(
				'ID'            => (int) $post_id,
				'post_title'    => esc_attr( $post_title ),
				'post_content'  => wp_kses_post( $post_content ),
				'post_type'     => 'wpproj_company',
				'post_author'   => (int) $author,
				'post_status'   => 'publish',
			);

			$id = wp_insert_post( $post_args );

			if ( isset( $id ) && ! is_wp_error( $id ) ){

				if ( isset( $_POST['company-name'] ) )
					update_post_meta( $id, 'company-name', esc_attr( $_POST['company-name'] ) );

				if ( isset( $_POST['company-phone-primary'] ) )
					update_post_meta( $id, 'company-phone-primary', esc_attr( $_POST['company-phone-primary'] ) );

				if ( isset( $_POST['company-phone-primary-ext'] ) )
					update_post_meta( $id, 'company-phone-primary-ext', esc_attr( $_POST['company-phone-primary-ext'] ) );

				if ( isset( $_POST['company-fax'] ) )
					update_post_meta( $id, 'company-fax', esc_attr( $_POST['company-fax'] ) );

				if ( isset( $_POST['company-street'] ) )
					update_post_meta( $id, 'company-street', esc_attr( $_POST['company-street'] ) );

				if ( isset( $_POST['company-street-second'] ) )
					update_post_meta( $id, 'company-street-second', esc_attr( $_POST['company-street-second'] ) );

				if ( isset( $_POST['company-city'] ) )
					update_post_meta( $id, 'company-city', esc_attr( $_POST['company-city'] ) );

				if ( isset( $_POST['company-prov-state'] ) )
					update_post_meta( $id, 'company-prov-state', esc_attr( $_POST['company-prov-state'] ) );

				if ( isset( $_POST['company-zip-postal'] ) )
					update_post_meta( $id, 'company-zip-postal', esc_attr( $_POST['company-zip-postal'] ) );

				$is_error = apply_filters( 'wpproj_add_update_company_extra_fields', $id, $_POST );
				// @todo need to handle the error if people send it back

			} // isset( $id ) && ! is_wp_error

			$success = apply_filters( 'wpproj_form_success_message', $_POST['success_message'], $_POST );

			$return_data = array(
				'message'           => $success,
				'returncontent'     => $this->get_single_table_row( $id ),
			);

			wp_send_json_success( $return_data );
		} else {
			$error = apply_filters( 'wpproj_form_error_message', $_POST['error_message'], $_POST );;
			wp_send_json_error( $error );
		}

	} // add_update_company

	/**
	 * Saves or updates our contacts
	 *
	 * @since 0.1
	 * @author SFNdesign, Curtis McHale
	 * @access public
	 *
	 * @uses wp_verify_nonce()          Helps us make sure that we are safe
	 * @uses wp_get_current_user()      Gets WP User object for the current user
	 * @uses esc_attr()                 Keeping our data safe
	 * @uses wp_kses_post()             Sanitize like post_content
	 * @uses wp_insert_post()           Creates/updates a post based on provided args
	 * @uses update_post_meta()         Updates the meta on a post
	 * @uses wp_send_json_sucess()      Returns a success=true json object to our AJAX call and does all our die stuff
	 * @uses wp_send_json_error()       Returns a success=false json object to our AJAX call and does all our die stuff
	 */
	public function add_update_contact(){

		$is_error = array();

		if ( isset( $_POST['_nonce'] ) && wp_verify_nonce( $_POST['_nonce'], 'ajax-form-submit-nonce' ) && current_user_can( 'create_contact' ) || current_user_can( 'update_contact' ) ){

			$current_user = wp_get_current_user();

			// setting our post title
			$post_title = $_POST['contact-first-name'];
			if ( isset( $_POST['contact-last-name'] ) ) $post_title = $post_title .' '. $_POST['contact-last-name'];

			$post_id = isset( $_POST['post_id'] ) ? $_POST['post_id'] : null;

			$post_content = isset( $_POST['contact_comments'] ) ? $_POST['contact_comments'] : '';

			$author = $current_user->ID;

			$post_args = array(
				'ID'            => (int) $post_id,
				'post_title'    => esc_attr( $post_title ),
				'post_content'  => wp_kses_post( $post_content ),
				'post_type'     => 'wpproj_users',
				'post_author'   => (int) $author,
				'post_status'   => 'publish',
			);

			$id = wp_insert_post( $post_args );

			if ( isset( $id ) && ! is_wp_error( $id ) ){

				if ( isset( $_POST['contact-first-name'] ) )
					update_post_meta( $id, 'contact-first-name', esc_attr( $_POST['contact-first-name'] ) );

				if ( isset( $_POST['contact-last-name'] ) )
					update_post_meta( $id, 'contact-last-name', esc_attr( $_POST['contact-last-name'] ) );

				if ( isset( $_POST['contact-position'] ) )
					wp_set_object_terms( $id, (int) $_POST['contact-position'], 'wpproj_position' );

				if ( isset( $_POST['contact-email'] ) && is_email( $_POST['contact-email'] ) ){
					update_post_meta( $id, 'contact-email', esc_attr( $_POST['contact-email'] ) );
				} else {
					$is_error[] = array( 'field_id' => 'contact-email', 'message' => 'That is not a valid email' );
				}

				if ( isset( $_POST['contact-phone-primary'] ) )
					update_post_meta( $id, 'contact-phone-primary', esc_attr( $_POST['contact-phone-primary'] ) );

				if ( isset( $_POST['contact-phone-primary-ext'] ) )
					update_post_meta( $id, 'contact-phone-primary-ext', esc_attr( $_POST['contact-phone-primary-ext'] ) );

				if ( isset( $_POST['contact-mobile'] ) )
					update_post_meta( $id, 'contact-mobile', esc_attr( $_POST['contact-mobile'] ) );

				if ( isset( $_POST['contact-fax'] ) )
					update_post_meta( $id, 'contact-fax', esc_attr( $_POST['contact-fax'] ) );

				if ( isset( $_POST['contact-fax'] ) )
					update_post_meta( $id, 'contact-fax', esc_attr( $_POST['contact-fax'] ) );

				if ( isset( $_POST['contact-street'] ) )
					update_post_meta( $id, 'contact-street', esc_attr( $_POST['contact-street'] ) );

				if ( isset( $_POST['contact-street-second'] ) )
					update_post_meta( $id, 'contact-street-second', esc_attr( $_POST['contact-street-second'] ) );

				if ( isset( $_POST['contact-city'] ) )
					update_post_meta( $id, 'contact-city', esc_attr( $_POST['contact-city'] ) );

				if ( isset( $_POST['contact-prov-state'] ) )
					update_post_meta( $id, 'contact-prov-state', esc_attr( $_POST['contact-prov-state'] ) );

				if ( isset( $_POST['contact-zip-postal'] ) )
					update_post_meta( $id, 'contact-zip-postal', esc_attr( $_POST['contact-zip-postal'] ) );

				if ( isset( $_POST['company-list'] ) && ! empty( $_POST['company-list'] ) ){
					p2p_type( 'wpproj_comp_to_wpproj_users' )->connect( $_POST['company-list'], $id, array( 'date' => current_time( 'mysql' ) ) );
				}

				$is_error = apply_filters( 'wpproj_add_update_contact_extra_fields', $id, $_POST );
				// @todo need to handle the error if people send it back

			} // isset( $id ) && ! is_wp_error

			$success = apply_filters( 'wpproj_form_success_message', $_POST['success_message'], $_POST );

			$return_data = array(
				'message'           => $success,
				'returncontent'     => $this->get_single_table_row( $id ),
			);

			wp_send_json_success( $return_data );
		} else {
			$error = apply_filters( 'wpproj_form_error_message', $_POST['error_message'], $_POST );;
			wp_send_json_error( $error );
		}

	} // add_update_contact

	/**
	 * Builds out our create company form
	 *
	 * @since 0.1
	 * @auther SFNdesign, Curtis McHale
	 * @access public
	 *
	 * @return array
	 *
	 * @uses current_user_can()                             Checks cap listed against current user
	 * @uses wp_nonce_field()                               Generates a nonce field that we can check later
	 * @uses $this->get_available_countries_dropdown()      Returns dropdown with available countries
	 * @uses wp_send_json_sucess()                          Returns a success=true json object to our AJAX call and does all our die stuff
	 * @uses wp_send_json_error()                           Returns a success=false json object to our AJAX call and does all our die stuff
	 */
	public function get_add_company_form(){

		if ( current_user_can( 'create_contact' ) ){

			$html = '<form id="create-company" class="wpproj-form" action="add_update_company">';

				$html .= '<h4>Add Comany</h4>';

				ob_start();
				do_action( 'wpproj_top_company_field' );
				$html .= ob_get_contents();
				ob_clean();

				$html .= '<p id="company-name">';
				$html .= '<label for="company-name">Company Name</label>';
				$html .= '<input type="text" name="company-name" id="company-name" value="" />';
				$html .= '</p>';

				$html .= '<p id="phone-primary">';
				$html .= '<label for="company-phone-primary">Primary Phone</label>';
				$html .= '<input type="text" name="company-phone-primary" id="company-phone-primary" value="" />';
				$html .= '</p>';

				$html .= '<p id="primary-ext">';
				$html .= '<label for="company-phone-primary-ext">Primary Phone Extension</label>';
				$html .= '<input type="text" name="company-phone-primary-ext" id="company-phone-primary-ext" value="" />';
				$html .= '</p>';

				$html .= '<p id="mobile">';
				$html .= '<label for="company-billing">Billing Departement</label>';
				$html .= '<input type="text" name="company-billing" id="company-billing" value="" />';
				$html .= '</p>';

				$html .= '<p id="fax">';
				$html .= '<label for="company-fax">Fax</label>';
				$html .= '<input type="text" name="company-fax" id="company-fax" value="" />';
				$html .= '</p>';

				ob_start();
				do_action( 'wpproj_before_address_section' );
				$html .= ob_get_contents();
				ob_clean();

				$html .= '<h5>Address</h5>';

				$html .= '<p id="street-address">';
				$html .= '<label for="company-street">Street</label>';
				$html .= '<input type="text" name="company-street" id="company-street" value="" /><br />';
				$html .= '<input type="text" name="company-street-second" id="company-street-second" value="" />';
				$html .= '</p>';

				$html .= '<p id="city">';
				$html .= '<label for="company-city">City</label>';
				$html .= '<input type="text" name="company-city" id="company-city" value="" />';
				$html .= '</p>';

				$html .= '<p id="prov-state">';
				$html .= '<label for="company-prov-state">Province/State</label>';
				$html .= '<input type="text" name="company-prov-state" id="company-prov-state" value="" />';
				$html .= '</p>';

				$html .= '<p id="zip-postal">';
				$html .= '<label for="company-zip-postal">Zip/Postal Code</label>';
				$html .= '<input type="text" name="company-zip-postal" id="company-zip-postal" value="" />';
				$html .= '</p>';

				$html .= '<p id="country">';
				$html .= '<label for="company-country">Country</label>';
				$html .= $this->get_available_countries_dropdown();
				$html .= '</p>';

				ob_start();
				do_action( 'wpproj_bottom_company_field' );
				$html .= ob_get_contents();
				ob_clean();

				$html .= '<input type="hidden" name="success_message" value="Contact Saved" />';
				$html .= '<input type="hidden" name="error_message" value="Sorry the contact was not saved" />';
				$html .= '<input type="submit" class="button-primary" id="create-new-company" value="Create New Company" />';
				$html .= '<input type="submit" class="button-secondary" id="stop-new-company" value="Done" />';
				$html .= '<img class="ajax-loader" src="'. plugins_url( '/wp-project-management/images/ajax-loader.gif' ) .'" />';
				$html .= '<p class="user-feedback"></p>';

			$html .= '</form><!-- #create-company -->';

			wp_send_json_success( $html );

		} else {
			wp_send_json_error( 'Sorry you do not have permission to add companies' );
		} // if ( current_user_can( 'create_contact' )

	} // get_add_company_form

	/**
	 * Builds out our create contact form
	 *
	 * @since 0.1
	 * @auther SFNdesign, Curtis McHale
	 * @access public
	 *
	 * @return array
	 *
	 * @uses current_user_can()                             Checks cap listed against current user
	 * @uses wp_nonce_field()                               Generates a nonce field that we can check later
	 * @uses $this->get_available_countries_dropdown()      Returns dropdown with available countries
	 * @uses wp_send_json_sucess()                          Returns a success=true json object to our AJAX call and does all our die stuff
	 * @uses wp_send_json_error()                           Returns a success=false json object to our AJAX call and does all our die stuff
	 *
	 * Need to finish adding the forms
	 *  @todo add the company dropdown if companies exist
	 */
	public function get_add_contact_form(){

		if ( current_user_can( 'create_contact' ) ){

			$html = '<form id="create-contact" class="wpproj-form" action="add_update_contact">';

				$html .= '<h4>Add Contact</h4>';

				ob_start();
				do_action( 'wpproj_top_contact_field' );
				$html .= ob_get_contents();
				ob_clean();

				$html .= '<p id="first-name">';
				$html .= '<label for="contact-first-name">First Name</label>';
				$html .= '<input type="text" name="contact-first-name" id="contact-first-name" value="" />';
				$html .= '</p>';

				$html .= '<p id="last-name">';
				$html .= '<label for="contact-last-name">Last Name</label>';
				$html .= '<input type="text" name="contact-last-name" id="contact-last-name" value="" />';
				$html .= '</p>';

				$html .= '<p id="position">';
				$html .= '<label for="contact-position">Position</label>';
				$html .= $this->get_available_positions_dropdown();
				$html .= '</p>';

				$html .= $this->get_company_dropdown();

				$html .= '<p id="email">';
				$html .= '<label for="contact-email">Email</label>';
				$html .= '<input type="text" name="contact-email" id="contact-email" value="" />';
				$html .= '</p>';

				$html .= '<p id="phone-primary">';
				$html .= '<label for="contact-phone-primary">Primary Phone</label>';
				$html .= '<input type="text" name="contact-phone-primary" id="contact-phone-primary" value="" />';
				$html .= '</p>';

				$html .= '<p id="primary-ext">';
				$html .= '<label for="contact-phone-primary-ext">Primary Phone Extension</label>';
				$html .= '<input type="text" name="contact-phone-primary-ext" id="contact-phone-primary-ext" value="" />';
				$html .= '</p>';

				$html .= '<p id="mobile">';
				$html .= '<label for="contact-mobile">Mobile</label>';
				$html .= '<input type="text" name="contact-mobile" id="contact-mobile" value="" />';
				$html .= '</p>';

				$html .= '<p id="fax">';
				$html .= '<label for="contact-fax">Fax</label>';
				$html .= '<input type="text" name="contact-fax" id="contact-fax" value="" />';
				$html .= '</p>';

				ob_start();
				do_action( 'wpproj_before_address_section' );
				$html .= ob_get_contents();
				ob_clean();

				$html .= '<h5>Address</h5>';

				$html .= '<p id="street-address">';
				$html .= '<label for="contact-street">Street</label>';
				$html .= '<input type="text" name="contact-street" id="contact-street" value="" /><br />';
				$html .= '<input type="text" name="contact-street-second" id="contact-street-second" value="" />';
				$html .= '</p>';

				$html .= '<p id="city">';
				$html .= '<label for="contact-city">City</label>';
				$html .= '<input type="text" name="contact-city" id="contact-city" value="" />';
				$html .= '</p>';

				$html .= '<p id="prov-state">';
				$html .= '<label for="contact-prov-state">Province/State</label>';
				$html .= '<input type="text" name="contact-prov-state" id="contact-prov-state" value="" />';
				$html .= '</p>';

				$html .= '<p id="zip-postal">';
				$html .= '<label for="contact-zip-postal">Zip/Postal Code</label>';
				$html .= '<input type="text" name="contact-zip-postal" id="contact-zip-postal" value="" />';
				$html .= '</p>';

				$html .= '<p id="country">';
				$html .= '<label for="contact-country">Country</label>';
				$html .= $this->get_available_countries_dropdown();
				$html .= '</p>';

				ob_start();
				do_action( 'wpproj_bottom_contact_field' );
				$html .= ob_get_contents();
				ob_clean();

				$html .= '<input type="hidden" name="success_message" value="Contact Saved" />';
				$html .= '<input type="hidden" name="error_message" value="Sorry the contact was not saved" />';
				$html .= '<input type="submit" class="button-primary" id="create-new-contact" value="Create New Contact" />';
				$html .= '<input type="submit" class="button-secondary" id="stop-new-contact" value="Done" />';
				$html .= '<img class="ajax-loader" src="'. plugins_url( '/wp-project-management/images/ajax-loader.gif' ) .'" />';
				$html .= '<p class="user-feedback"></p>';

			$html .= '</form><!-- #create-contact -->';

			wp_send_json_success( $html );

		} else {
			wp_send_json_error( 'Sorry you do not have permission to add contacts' );
		} // if ( current_user_can( 'create_contact' )

	} // get_add_contact_form

	/**
	 * Returns a dropdown of companies that we can then link to users
	 *
	 * @since 0.1
	 * @author SFNdesign, Curtis McHale
	 * @access private
	 *
	 * @return string       The dropdown
	 *
	 * @uses get_posts()        Returns post objects given args
	 * @uses esc_attr()         Safety
	 * @uses get_the_title()    Returns title, post_id optional
	 */
	private function get_company_dropdown(){

		$args = array(
			'post_type'         => 'wpproj_company',
			'posts_per_page'    => -1
		);
		$comp = get_posts( $args );

		if ( ! empty( $comp) ){

			$html = '<p id="company-list">';

				$html .= '<label for="company-list">Company</label>';

				$html .= '<select class="chzn" name="company-list" id="company-list">';
					$html .= '<option value=""></option>';
					foreach( $comp as $c ){
						$html .= '<option value="'. esc_attr( $c->ID ) .'">'. get_the_title( $c->ID ) .'</option>';
					}
				$html .= '</select>';

				$html .= '<a href="#" id="create-new-company" class="small link">Create New Company</a>';

			$html .= '</p><!-- /#company-list -->';

		} else {
			$html = '';
		}

		return $html;

	} // get_company_dropdown

	/**
	 * Builds us a dropdown for our available contact positions
	 *
	 * @since 0.1
	 * @author SFNdesign, Curtis McHale
	 * @access private
	 *
	 * @return string       The built out dropdown
	 *
	 * @uses get_terms()        Gets terms for given taxonomy based on args
	 * @uses esc_attr()         Safety first
	 */
	private function get_available_positions_dropdown(){

		$positions = get_terms( 'wpproj_position', array( 'hide_empty' => false ) );

		$html = '<select class="chzn" name="contact-position" id="contact-position">';
			foreach( $positions as $p ){
				$html .= '<option value="'. esc_attr( $p->term_id ) .'">'. esc_attr( $p->name ) .'</option>';
			}
		$html .= '</select>';

		return $html;

	} // get_available_positions_dropdown

	/**
	 * Builds us a dropdown of the available countries for our contacts
	 *
	 * @since 0.1
	 * @author SFNdesign, Curtis McHale
	 * @access private
	 *
	 * @return string
	 *
	 * @uses $this->countries       Array of countries
	 * @uses esc_attr()             Keeping things safe
	 */
	private function get_available_countries_dropdown(){

		$countries = $this->countries;

		$html = '<select name="contact-country" id="contact-country">';
			foreach( $countries as $key => $value ){
				$html .= '<option value="'. esc_attr( $key ) .'">'. esc_attr( $value ) .'</option>';
			}
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
	 * Adding taxonomy to hold the position of contacts in a company
	 *
	 * @since 0.1
	 * @author SFNdesign, Curtis McHale
	 * @access public
	 *
	 * @uses register_taxonomy()        Registers tax given args
	 *
	 * @todo need to hide this and show based on dev constant
	 */
	public function position_tax(){

		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name'              => _x( 'Position', 'taxonomy general name' ),
			'singular_name'     => _x( 'Position', 'taxonomy singular name' ),
			'search_items'      =>  __( 'Search Positions' ),
			'all_items'         => __( 'All Positions' ),
			'parent_item'       => __( 'Parent Position' ),
			'parent_item_colon' => __( 'Parent Position:' ),
			'edit_item'         => __( 'Edit Position' ),
			'update_item'       => __( 'Update Position' ),
			'add_new_item'      => __( 'Add New Position' ),
			'new_item_name'     => __( 'New Position Name' ),
			'menu_name'         => __( 'Position' ),
		);

		register_taxonomy( 'wpproj_position', array( 'wpproj_users' ), array(
			'labels'       => $labels,
			'hierarchical' => true,
			'show_ui'      => true,
			'query_var'    => true,
			'rewrite'      => array( 'slug' => 'positions' ),
		));

	} // position_tax

	/**
	 * Populates the position taxonomy when called but only if there are no terms in the taxonomy already
	 *
	 * @since 0.1
	 * @author SFNdesign, Curtis McHale
	 * @access protected
	 *
	 * @uses get_terms()            Gets terms for taxonomy given args
	 * @uses term_exists()          Returns true if the term already exists in given taxonomy
	 * @uses wp_insert_term()       Inserts term to the database
	 */
	public function populate_positions(){

		$defined_positions = array(
			'0' => array( 'name' => 'Billing', 'short' => 'billing' ),
			'1' => array( 'name' => 'Owner', 'short' => 'owner' ),
			'2' => array( 'name' => 'Assistant', 'short' => 'assistant' ),
			'3' => array( 'name' => 'Designer', 'short' => 'designer' ),
			'4' => array( 'name' => 'Developer', 'short' => 'developer' ),
			'5' => array( 'name' => 'Marketing', 'short' => 'marketing' ),
			'6' => array( 'name' => 'Project Lead', 'short' => 'project-lead' ),
		);

		$position = get_terms( 'wpproj_position', array( 'hide_empty' => false ) );

		if ( empty( $position ) ){
			foreach ( $defined_positions as $dposition ){
				if ( ! term_exists( $dposition['name'], 'wpproj_position' ) ){
					wp_insert_term( $dposition['name'], 'wpproj_position', array( 'slug', $dposition['short'] ) );
				} // if
			} // foreach
		} // if empty( $position
	}

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