jQuery(document).ready(function($) {

	/* === Adding Contacts === */
	$( document ).on( 'click', '#wpproj-add-new-contact', function(e){

		// no linky
		e.preventDefault();

		var current = $(this);

		$.post( WPPROJ.ajaxurl, { action: 'get_add_contact_form' }, function ( response ){

			if ( response.success === true ){
				$(current).parent('p').append(response.data);
			} else {
				$(current).parent('p').append(response.data).find('.error').delay(4000).fadeOut(4000);
			}

		}, 'json' );

	});

	/**
	 * Getting all our form fields
	 *
	 * @since 0.1
	 * @author SFNdesign, Curtis McHale
	 */
	$( document ).on( 'submit', '.wpproj-form', function(e){

		e.preventDefault();

		var form            = $(this);
		var formaction      = $(form).attr('action');
		var ajaxloader      = $(form).find('.ajax-loader');
		var userfeedback    = $(form).find('.user-feedback');

		var ajaxresponse    = $( '#show-contacts' ).find( 'tr:first-child' );

		$(ajaxloader).show();

		$(form).ajaxSubmit({
			data: {
				action: formaction,
				_nonce: WPPROJ.formsubmitnonce
			}, // data
			type: 'POST',
			clearForm: true,
			dataType: 'json',
			url: WPPROJ.ajaxurl,
			success: function( responseText, statusText, xhr, $form ){
				$(ajaxloader).hide();
				$( ajaxresponse ).after( responseText.data.returncontent );
				$( userfeedback ).empty().append( responseText.data.message ).addClass( 'success' ).show().delay( 4000 ).fadeOut( 4000 );
			}
		}); // ajaxSubmit

	});

});