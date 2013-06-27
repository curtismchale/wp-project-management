jQuery(document).ready(function($) {

	/* === Adding Contacts === */
	$( document ).on( 'click', '#wpproj-add-new-contact', function(e){

		// no linky
		e.preventDefault();
		console.log('test');

		$.post( WPPROJ.ajaxurl, { action: 'get_add_contact_form' }, function ( response ){
			console.log('after test');
			console.log( response );

		}, 'json' );

	});

});