<?php

class WPProj_Shortcodes{

	function __construct(){

		add_shortcode( 'wpproj_clients', array( $this, 'show_clients' ) );

	} // __construct

	public function show_clients(){
		echo 'clients';
	} // show_clients

} // WPProj_Shortcodes

new WPProj_Shortcodes();