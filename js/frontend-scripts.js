jQuery(document).ready(function($) {

	/* === Adding Contacts === */
	$( document ).on( 'click', '#wpproj-add-new-contact', function(e){

		// no linky
		e.preventDefault();

		var current = $(this);

		$.post( WPPROJ.ajaxurl, { action: 'get_add_contact_form' }, function ( response ){

			if ( response.success === true ){
				console.log( 'yes' );
			} else {
				$(current).parent('p').append(response.value).find('.error').delay(4000).fadeOut(4000);
			}

		}, 'json' );

	});

});